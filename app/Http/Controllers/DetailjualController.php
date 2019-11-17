<?php

namespace App\Http\Controllers;

use App\Detailjual;
use Illuminate\Http\Request;
use DB;
use App\Setting;
use App\Barang;
use App\Jual;

class DetailjualController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   

        try {
            DB::beginTransaction();

            $detail = Detailjual::where("id_jual", $request->beli)->where("id_barang", $request->barang)->get()->first();
            $barang = Barang::find($request->barang);
            $setting = Setting::all()->first();
            $harga  = $barang->harga+($barang->harga*$setting->persen/100);

            if (!is_null($detail)) {
                $data = array('harga' => $request->harga);
                
                Detailjual::where("id_jual", $request->beli)->where("id_barang", $request->barang)->update($data);
            }else{
                $detailbeli = new Detailjual();
                $detailbeli->id_barang = $request->barang;
                $detailbeli->id_jual = $request->beli;
                $detailbeli->beratJual = $request->berat;
                $detailbeli->harga = $harga;
                
                $detailbeli->save();
            }

            $total = DB::select(DB::raw("select sum(beratJual*harga) as total from detailjuals where id_jual='".$request->beli."'"));

            $a_total = array('total' => (Double)$total[0]->total);

            Jual::where("id", $request->beli)->update($a_total);

            DB::commit();
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Data Detail Jual Gagal Ditambahkan !');
        }

        return redirect()->back()->with('success', 'Data Detail Jual Berhasil Ditambahkan !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Detailjual  $detailjual
     * @return \Illuminate\Http\Response
     */
    public function show(Detailjual $detailjual)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Detailjual  $detailjual
     * @return \Illuminate\Http\Response
     */
    public function edit(Detailjual $detailjual)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Detailjual  $detailjual
     * @return \Illuminate\Http\Response
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Detailjual  $detailjual
     * @return \Illuminate\Http\Response
     */
    public function destroy(Detailjual $detailjual)
    {
        //
    }
}
