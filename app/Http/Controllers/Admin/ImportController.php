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
}
