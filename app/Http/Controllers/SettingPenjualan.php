<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;
use Auth;
use Route;

class SettingPenjualan extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $data['data'] = Setting::all();
        return view('admin.setting.index',$data);

    }

    public function store(Request $request)
    {
        $persen = $request->get('setting');
        $setting = new Setting();
        $setting->persen = $persen;
        $setting->save();
        
        return redirect('setting')->with('Data Setting Berhasil Ditambahkan !');
    }

    public function update(Request $request)
    {   
        $data["persen"] = $request->get('setting');
        
        Setting::where("id_setting", $request->get('id_setting'))->update($data);

        return redirect('setting')->with('Data Setting Berhasil Ditambahkan !');
    }
}