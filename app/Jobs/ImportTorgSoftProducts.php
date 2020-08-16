<?php

namespace App\Jobs;

use App\Brand\Brand;
use App\Category\Category;
use App\Category\CategoryImport\CategoryImport;
use App\Core\StorageManager;
use App\ProductGroup\Product\Product;
use App\ProductGroup\Product\ProductImage\ProductImage;
use App\ProductGroup\Product\ProductSize\ProductSize;
use App\ProductGroup\ProductGroup;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Intervention\Image\Facades\Image;

class ImportTorgSoftProducts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws FileNotFoundException
     */
    public function handle()
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
                        substr(substr(trim($product[13]),1),0,-1)
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
                    'status'            =>  $product[15],
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
