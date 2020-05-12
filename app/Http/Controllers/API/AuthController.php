<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Users\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

        if (! $user || ! Hash::check($request->get('password'), $user->password || !$user->admin)) {
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
            'first_name'     =>  'required|string|max:255',
            'last_name'     =>  'required|string|max:255',
            'email'         =>  'required|string|email|max:255|unique:users',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors'     =>  $validator->failed(),
            ],422);
        }
        $user = $request->user()->update($validator->validated());
        if ($request->get('city')) {
            $user->address->create($request->only(['city','street','number','room']));
        }
        if ($request->get('child_name')) {
            $user->children->create($request->only(['child_name','child_gender','child_birthday']));
        }
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
            ],401);
        }
        $user->update([
            'password'  => Hash::make($request->get('password')),
        ]);
        return response()->json([
            'message'   =>  'Success',
        ],200);
    }
}
