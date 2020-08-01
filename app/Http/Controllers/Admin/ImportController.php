<?php

namespace App\Http\Controllers\Admin;

use App\Brand\Brand;
use App\Category\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Import\Kiddy\KiddyBrandRequest;
use App\Http\Requests\Import\Kiddy\KiddyCategoryRequest;
use App\Http\Requests\Import\Kiddy\KiddyProductRequest;

class ImportController extends Controller
{
    public function kiddy()
    {
        return view('pages.import.kiddy');
    }

    public function kiddyBrand(KiddyBrandRequest $request)
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
        return redirect()->route('admin.import.kiddy')->with('done','Brands updated!');
    }
    public function kiddyCategory(KiddyCategoryRequest $request)
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
                $cata = Category::updateOrCreate([
                    'out_id' =>  $cat[0],
                ],[
                    'title'     =>  trim(substr(substr(trim(isset($cat[2])?$cat[1].$cat[2]:$cat[1]),1),0,-1),'\xD0'),
                    'parent_id' =>  10,
                ]);
            }
        }
        return redirect()->route('admin.import.kiddy')->with('done','Categories updated!');
    }

    public function kiddyProduct(KiddyProductRequest $request)
    {
        if ($request->file('file_product')->getClientOriginalName() !== "import_products.csv") {
            return redirect()->back()->withErrors([
                'file_product'  => 'Is not a product'
            ]);
        }
        dd($request->file('file_product'));
        $file = file_get_contents($request->file('file_product'));
        $delimiter = ',';
        $rows = explode(PHP_EOL, $file);
        $data = [];

        foreach ($rows as $row)
        {
            $data[] = explode($delimiter, $row);
        }
        dd($data);
        unset($data[0]);
        unset($data[count($data)]);
        dd($data);
        foreach ($data as $cat) {
            if (substr(substr(trim($cat[1]),1),0,-1) !== '') {
                $cata = Category::updateOrCreate([
                    'out_id' =>  $cat[0],
                ],[
                    'title'     =>  trim(substr(substr(trim(isset($cat[2])?$cat[1].$cat[2]:$cat[1]),1),0,-1),'\xD0'),
                    'parent_id' =>  10,
                ]);
                logs($cata->__toString());
            }
        }
        return redirect()->route('admin.import.kiddy')->with('done','Products updated!');
    }
}
