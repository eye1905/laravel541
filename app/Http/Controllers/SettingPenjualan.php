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
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->user = auth()->user();

            if ($this->user->jabatan==3 or $this->user->jabatan==4) {
                return redirect('home')->with('Anda Tidak Punya Akses');
            }
            
            return $next($request);
        });
    }
    public function index()
    {
       $data['data'] = Setting::all();
        return view('admin.setting.index',$data);

    }

    public function store(Request $request)
    {
        $data = Setting::all();
        
        if (count($data)>0) {
            $persen = array('persen' => $request->setting);

           Setting::where("id_setting", $data[0]->id_setting)->update($persen);
        }else{
            $persen = $request->get('setting');
            $setting = new Setting();
            $setting->persen = $persen;
            $setting->save();
        }
            
        return redirect('setting')->with('Data Setting Berhasil Ditambahkan !');
    }

    public function update(Request $request)
    {   
        $data["persen"] = $request->get('setting');
        
        Setting::where("id_setting", $request->get('id_setting'))->update($data);

        return redirect('setting')->with('Data Setting Berhasil Ditambahkan !');
    }
}