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

}