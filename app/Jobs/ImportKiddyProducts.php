<?php

namespace App\Jobs;

use App\Brand\Brand;
use App\Category\Category;
use App\Category\CategoryImport\CategoryImport;
use App\Core\PathManager;
use App\Core\StorageManager;
use App\ProductGroup\Product\Product;
use App\ProductGroup\ProductGroup;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportKiddyProducts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var string
     */
    private $path;

    public $timeout = 1200;
    /**
     * Create a new job instance.
     *
     * @param string $path
     */
    public function __construct(string $path)
    {
        $this->path = $path;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws FileNotFoundException
     */
    public function handle()
    {
        $file = (new StorageManager())->getLocalPublicDisk()->get('kiddy/'.$this->path);
        $rows = explode(PHP_EOL, $file);
        $data = [];

        foreach ($rows as $row)
        {
            $data[] = str_getcsv($row);
        }
        unset($data[0]);
        unset($data[count($data)]);
        foreach ($data as $product) {
            if (isset($product[2]) && isset($product[3])) {
                $brand = Brand::where('out_id',$product[2])->first();
                $import_cat = CategoryImport::where('out_id',$product[3])->first();
                $category = Category::find($import_cat->cat_id);
                if ($brand && $category) {
                    $group = ProductGroup::updateOrCreate([
                        'out_id' =>  $product[0],
                    ],[
                        'title'         => $product[5],
                        'brand_id'      => $brand->getKey(),
                        'category_id'   => $category->getKey(),
                        'age'           => (int)$product[4],
                        'desc'          => $product[6],
                    ]);
                    Product::updateOrCreate([
                        'product_code' =>  $product[0],
                    ],[
                        'product_group_id'  =>  $group->getKey(),
                        'title'             =>  '',
                        'price'             =>  $product[7],
                        'quantity'          =>  100,
                        'minimum'           =>  1,
                        'status'            =>  $product[15],
                        'color'             =>  '#fff',
                    ]);
                }
            }
        }
        (new StorageManager())->deleteFile($this->path,'kiddy');
    }
}
