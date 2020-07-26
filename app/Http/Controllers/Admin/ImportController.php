<?php

namespace App\Http\Controllers\Admin;

use App\Brand\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    public function kiddy()
    {
        return view('pages.import.kiddy');
    }

    public function kiddyBrand(Request $request)
    {
        $file = file_get_contents($request->file('file'));
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
        return redirect()->route('admin.import.kiddy');
    }
}
