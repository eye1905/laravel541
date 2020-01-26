<?php

namespace App\Http\Controllers;

use App\SettingProses;
use Illuminate\Http\Request;
use Auth;
use Route;

class SettingProsesController extends Controller
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
       $data['data'] = SettingProses::all();

        return view('admin.proses.setting',$data);

    }

    public function store(Request $request)
    {
        $data = SettingProses::all();
        
        if (count($data)>0) {
            $persen = array('persen' => $request->setting);

           SettingProses::where("id", $data[0]->id)->update($persen);
        }else{
            $persen = $request->get('setting');
            $setting = new SettingProses();
            $setting->persen = $persen;

            $setting->save();
        }
            
        return redirect('settingproses')->with('Data Setting Berhasil Ditambahkan !');
    }

    public function update(Request $request)
    {   
        $data["persen"] = $request->get('setting');
        //dd($data);
        SettingProses::where("id", $request->get('id_setting'))->update($data);

        return redirect('settingproses')->with('Data Setting Berhasil Ditambahkan !');
    }
}