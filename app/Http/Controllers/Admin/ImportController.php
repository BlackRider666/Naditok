<?php

namespace App\Http\Controllers\Admin;

use App\Brand\Brand;
use App\Category\Category;
use App\Category\CategoryImport\CategoryImport;
use App\Core\StorageManager;
use App\Http\Controllers\Controller;
use App\Http\Requests\Import\Kiddy\KiddyBrandRequest;
use App\Http\Requests\Import\Kiddy\KiddyCategoryRequest;
use App\Http\Requests\Import\Kiddy\KiddyPhotoRequest;
use App\Http\Requests\Import\Kiddy\KiddyProductRequest;
use App\Jobs\ImportKiddyProducts;
use App\ProductGroup\Product\Product;
use App\ProductGroup\Product\ProductImage\ProductImage;
use App\ProductGroup\Product\ProductSize\ProductSize;
use App\ProductGroup\ProductGroup;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\View\View;
use Intervention\Image\Facades\Image;

class ImportController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function kiddy()
    {
        return view('pages.import.kiddy');
    }

    /**
     * @param KiddyBrandRequest $request
     * @return RedirectResponse
     */
    public function kiddyBrand(KiddyBrandRequest $request): RedirectResponse
    {
        if ($request->file('file_brand')->getClientOriginalName() !== "import_brands.csv") {
            return redirect()->back()->withErrors([
                    'file_brand'  => 'Is not a brands'
            ]);
        }
        $file = file_get_contents($request->file('file_brand'));
        $delimiter = ',';
        $rows = explode(PHP_EOL, $file);
        $data = [];

        foreach ($rows as $row)
        {
            $data[] = explode($delimiter, $row);
        }
        unset($data[0]);
        unset($data[count($data)]);
        foreach ($data as $brand) {
            Brand::updateOrCreate([
                'out_id' =>  (int)$brand[0],
            ],[
                'title' =>  substr(substr(trim($brand[1]),1),0,-1),
                'thumb' =>  '',
            ]);
        }
        return redirect()->route('admin.import.kiddy')->with('done','Бренды обновлены!');
    }

    /**
     * @param KiddyCategoryRequest $request
     * @return RedirectResponse
     */
    public function kiddyCategory(KiddyCategoryRequest $request): RedirectResponse
    {
        if ($request->file('file_category')->getClientOriginalName() !== "import_types.csv") {
            return redirect()->back()->withErrors([
                'file_category'  => 'Is not a category'
            ]);
        }
        $file = file_get_contents($request->file('file_category'));
        $delimiter = ',';
        $rows = explode(PHP_EOL, $file);
        $data = [];

        foreach ($rows as $row)
        {
            $data[] = explode($delimiter, $row);
        }
        unset($data[0]);
        unset($data[count($data)]);
        foreach ($data as $cat) {
            if (substr(substr(trim($cat[1]),1),0,-1) !== '') {
                Category::updateOrCreate([
                    'out_id' =>  $cat[0],
                ],[
                    'title'     =>  trim(substr(substr(trim(isset($cat[2])?$cat[1].$cat[2]:$cat[1]),1),0,-1),'\xD0'),
                    'parent_id' =>  10,
                ]);
            }
        }
        return redirect()->route('admin.import.kiddy')->with('done','Категории обновлены!');
    }

    /**
     * @param KiddyProductRequest $request
     * @return RedirectResponse
     */
    public function kiddyProduct(KiddyProductRequest $request): RedirectResponse
    {
        if ($request->file('file_product')->getClientOriginalName() !== "import_products.csv") {
            return redirect()->back()->withErrors([
                'file_product'  => 'Is not a product'
            ]);
        }
        $path = (new StorageManager())->saveFile($request->file('file_product'),'kiddy');
        ImportKiddyProducts::dispatch($path);
        return redirect()->route('admin.import.kiddy')->with('done','Обновление продуктов поставлено в очередь!');
    }

    /**
     * @param KiddyPhotoRequest $request
     * @return RedirectResponse
     */
    public function kiddyPhotos(KiddyPhotoRequest $request): RedirectResponse
    {
        if ($request->file('file_product')->getClientOriginalName() !== "Изображения.zip") {
            return redirect()->back()->withErrors([
                'file_product'  => 'Is not a photos'
            ]);
        }
        dd($request->file('photos'));
    }

    public function test()
    {
        $file = (new StorageManager())->getLocalPublicDisk()->get('torgsoft/import.csv');
        $delimiter = ';';
        $rows = explode(PHP_EOL, $file);
        $data = [];

        foreach ($rows as $row)
        {
            $data[] = explode($delimiter, $row);
        }
        $conn_id = ftp_connect(env('FTP_HOST'));
        ftp_login($conn_id,env('FTP_USER'), env('FTP_PASS'));
        ftp_pasv($conn_id, true);
        $path = '/img/';
        $photo = ftp_nlist($conn_id,$path);
        foreach ($data as $product) {
            if (isset($product[11])) {
                $brand = Brand::firstOrCreate([
                    'title' =>  substr(substr(trim($product[11]),1),0,-1),
                ],[
                    'thumb'     =>  '',
                ]);
            }
            if (isset($product[5])) {
                $cat_import = CategoryImport::where('out_id',(int)$product[5])->first();
                if (isset($cat_import)) {
                    $category = Category::find($cat_import->cat_id);
                } else {
                    $category = null;
                }
            }
            if (isset($brand) && isset($category)) {
                $group = ProductGroup::updateOrCreate([
                    'out_id' =>  substr(substr(trim($product[2]),1),0,-1),
                ],[
                    'title'         => $product[1],
                    'brand_id'      => $brand->getKey(),
                    'category_id'   => $category->getKey(),
                    'age'           => substr(substr(trim($product[13]),1),0,-1)===''?
                        0
                        :
                        is_int(substr(substr(trim($product[13]),1),0,-1))?
                            substr(substr(trim($product[13]),1),0,-1)
                            :
                            0
                    ,
                    'desc'          => $product[3],
                ]);
                $prod = Product::updateOrCreate([
                    'product_code' =>  $product[0],
                ],[
                    'product_group_id'  =>  $group->getKey(),
                    'title'             =>  '',
                    'price'             =>  $product[5],
                    'quantity'          =>  $product[6],
                    'minimum'           =>  $product[7],
                    'status'            =>  'active',
                    'color'             =>  '#fff',
                ]);
                ProductSize::firstOrCreate([
                    'product_id'    => $prod->getKey(),
                    'size'          => substr(substr(trim($product[8]),1),0,-1)
                ]);
                if (in_array($path.$product[0].'.jpeg',$photo))
                {
                    $h = fopen('php://temp', 'r+');
                    ftp_fget($conn_id, $h, $path.$product[0].'.jpeg', FTP_BINARY);
                    $fstats = fstat($h);
                    fseek($h, 0);
                    $image = Image::make(stream_get_contents($h,$fstats['size']))
                        ->resize(1000,null, function ($constraint) {
                            $constraint->aspectRatio();
                        })->save('php://temp');
                    $filename = uniqid(time(), true) . '.jpeg';
                    (new StorageManager())->getLocalPublicDisk()->put('product-image/' . $filename, $image);
                    ProductImage::create([
                        'product_id'    =>  $prod->getKey(),
                        'thumb'         =>  $filename,
                    ]);
                } elseif (in_array($path.$product[0].'.jpg',$photo)) {
                    $h = fopen('php://temp', 'r+');
                    ftp_fget($conn_id, $h, $path.$product[0].'.jpg', FTP_BINARY);
                    $fstats = fstat($h);
                    fseek($h, 0);
                    $image = Image::make(stream_get_contents($h,$fstats['size']))
                        ->resize(1000,null, function ($constraint) {
                            $constraint->aspectRatio();
                        })->save('php://temp');
                    $filename = uniqid(time(), true) . '.jpg';
                    (new StorageManager())->getLocalPublicDisk()->put('product-image/' . $filename, $image);
                    ProductImage::create([
                        'product_id'    =>  $prod->getKey(),
                        'thumb'         =>  $filename,
                    ]);
                }
            }

        }
        ftp_close($conn_id);
    }
}
