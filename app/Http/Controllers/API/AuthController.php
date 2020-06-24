<?php

namespace App\Http\Controllers\API;

use App\Core\StorageManager;
use App\Http\Controllers\Controller;
use App\Users\User;
use App\Users\UserAddress\UserAddress;
use App\Users\UserChild\UserChild;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors'   =>  $validator->failed(),
            ],422);
        }

        $user = User::where('email',$request->get('email'))->first();

        if (! $user || ! Hash::check($request->get('password'), $user->password)) {
            return response()->json([
                'message'   =>  'Wrong credentials',
            ],401);
        }

        return response()->json([
            'token'     =>  $user->createToken('clinic')->plainTextToken,
        ],200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'first_name'     =>  'required|string|max:255',
            'last_name'     =>  'required|string|max:255',
            'email'         =>  'required|string|email|max:255|unique:users',
            'password'      =>  'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors'     =>  $validator->failed(),
            ],422);
        }
        $data = $validator->validated();
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        return response()->json([
            'token'     =>  $user->createToken('clinic')->plainTextToken,
        ],200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();

        return response()->json('Logout',200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function updateUser(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'first_name'    =>  'required|string|max:255',
            'last_name'     =>  'required|string|max:255',
            'email'         =>  'required|string|email|max:255',
            'phone'         =>  'required|string|max:255',
            'address.region'        =>  'string|max:255',
            'address.city'          =>  'string|max:255',
            'address.street'        =>  'string|max:255',
            'address.number'        =>  'string|max:255',
            'address.room'          =>  'string|max:255',
            'address.branch_number' =>  'integer',
            'children'      =>  'array',
            'children.child_name'       =>  'string|max:255',
            'children.child_gender'     =>  'string|max:255',
            'children.child_birthday'   =>  'date'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors'     =>  $validator->failed(),
            ],422);
        }
        //email => unique:users in validator broke route
        $user = User::where('email', $request->get('email'))->first();
        if (
            $user &&
            $user->getKey() !== $request->user()->getKey()
        ) {
            return response()->json([
                'message'   =>  'Wrong credentials',
                'errors'    => [
                    'email' => 'This email has already been taken.'
                ],
                'status'    =>  false,
            ],422);
        }
        //
        $data = $validator->validated();
        $request->user()->update($data);
        if ($request->get('address')['region']) {
            $data = $request->get('address');
            if(array_key_exists('id',$data))
            {
                UserAddress::find($data['id'])->update($data);
            }
            $data['user_id'] = $request->user()->getKey();
            UserAddress::create($data);
        }
        if ($request->get('children')) {
            foreach ($request->get('children') as $child) {
                $data = $child;
                $data['user_id'] = $request->user()->getKey();
                UserChild::create($data);
            }
        }
        $user = User::find($request->user()->getKey());
        return response()->json($user,200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function changePassword(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'old_password'     =>  'required|string|max:255|min:6',
            'password'     =>  'required|string|max:255|min:6|confirmed',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors'     =>  $validator->failed(),
            ],422);
        }

        $user = $request->user();
        if (! $user || ! Hash::check($request->get('old_password'), $user->password)) {
            return response()->json([
                'message'   =>  'Wrong credentials',
            ],422);
        }
        $user->update([
            'password'  => Hash::make($request->get('password')),
        ]);
        return response()->json([
            'message'   =>  'Success',
        ],200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function updatePhoto(Request $request): JsonResponse
    {
        Validator::make($request->all(), [
            'avatar'    =>  'required|image'
        ]);
        if ($request->user()->avatar !== '') {
            (new StorageManager())->deleteFile($request->user()->avatar,'user_avatar');
        }
        $data['avatar'] = (new StorageManager())
                ->savePicture($request->file('avatar'),'user_avatar',400);
        $request->user()->update($data);
        $user = User::find($request->user()->getKey());

        return response()->json($user,200);
    }

    /**
     * @param string $driver
     * @return JsonResponse|RedirectResponse
     */
    public function redirectToProvider(string $driver)
    {
        if ($driver !== 'google' && $driver !== 'facebook') {
            return response()->json([
                'message'    => 'This auth method not enabled'
            ],401);
        }
        return Socialite::driver($driver)->stateless()->redirect();
    }

    /**
     * @param string $driver
     * @return JsonResponse
     */
    public function handleProviderCallback(string $driver): JsonResponse
    {
        if ($driver !== 'google'|| $driver !== 'facebook') {
           return response()->json([
               'message'    => 'This auth method not enabled'
           ],401);
        }
        $soc = Socialite::driver($driver)->stateless()->user();
        if ($driver === 'google') {
            $user = User::firstOrCreate([
                'email' =>  $soc->email,
            ],[
                'first_name'    =>  $soc->user['given_name'],
                'last_name'     =>  $soc->user['family_name'],
                'password'      =>  Hash::make(Str::random()),
            ]);
        } elseif ($driver === 'facebook') {
            dd($soc);
            $user = User::firstOrCreate([
                'email' =>  $soc->email,
            ],[
                'first_name'    =>  $soc->user['given_name'],
                'last_name'     =>  $soc->user['family_name'],
                'password'      =>  Hash::make(Str::random()),
            ]);
        }
        return response()->json([
            'token'     =>  $user->createToken('clinic')->plainTextToken,
        ],200);
    }
}
