<?php

namespace App\Http\Controllers;

use App\Jual;
use App\Konsumen;
use App\User;
use Illuminate\Http\Request;
use App\Detailjual;
use App\Barang;
use DB;
use App\Setting;

class JualController extends Controller
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
        $data["masterjual"] = Jual::all();
        $data["masterkonsumen"] = self::toList(Konsumen::select("id", "namaKonsumen")->get(), "id");
        $data["masterkaryawans"] = self::toList(User::all(), "id");

        return view("admin.penjualan.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = null)
    {   
        
        $data["masterkonsumens"]    = Konsumen::select("id", "namaKonsumen")->get();
        $data["masterkaryawans"]    = User::all();
        $data["mastersuppliers"]    = Konsumen::select("id", "namaKonsumen")->get();
        $data["masterjual"]         = [];


        if (isset($id)) {
            $data["masterjual"]         = Detailjual::where("id_jual", $id)->get();
            $data["data"]               = Jual::find($id);
            $data["masterbarangs"]      = self::toList(Barang::all(), 'id');
            $data["id"]                 = $id;
        }

        return view("admin.penjualan.create", $data);
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
            $jual = new Jual();
            $jual->tglPesan = date("Y-m-d");
            $jual->statusBayar = 0;
            $jual->id_konsumen = $request->konsumen;
            $jual->id_users = $request->konsumen;
            $jual->tglKirim = $request->tglKirim;
            $jual->tglPesan = $request->tglPesan;
            $jual->noResi = $request->noResi;
            $jual->tglTerima = $request->tglTerima;
            $jual->statusBayar = $request->statusBayar;

            //dd($jual);
            $jual->save();
            $data = [];
            $data['noNotaJual'] = 'J0000'.$jual->id;
            Jual::where('id',$jual->id)->update($data);


            /*DETAIL JUAL*/
            /*DB::beginTransaction();

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

            DB::commit();*/

        } catch (Exception $e) {
         return redirect()->back()->with('error','Pesanan Barang Gagal Dibuat');
        }

        return redirect("penjualan/create/".$jual->id)->with('success','Pesanan Barang Sukses Dibuat');
 }

    /**
     * Display the specified resource.
     *
     * @param  \App\Jual  $jual
     * @return \Illuminate\Http\Response
     */
    public function show(Jual $jual)
    {
        //
    }

    public function detail($id)
    {
        $data["data"] = Jual::find($id);
        $data["masterjual"] = Detailjual::where("id_jual", $id)->get();
        $data["masterbarangs"] = self::toList(Barang::all(), 'id');
        $data["masterkaryawans"] = User::all();
        $data["id"]             = $id;

        return view("admin.penjualan.detail", $data);
    }    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Jual  $jual
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $data["mastersuppliers"] = Konsumen::select("id", "namaKonsumen")->get();
        $data["masterkaryawans"] = User::all();
        $data["data"]            = Jual::find($id);

        return view("admin.penjualan.create", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jual  $jual
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        try { 
            $jual = new Jual();
            $data['id_konsumen'] = $request->konsumen;
            $data['id_users'] = $request->karyawan;
            $data['tglPesan'] = $request->tglPesan;
            $data['statusBayar'] = $request->statusBayar;
            $data['tglKirim'] = $request->tglKirim;
            $data['tglPesan'] = $request->tglPesan;
            $data['noResi'] = $request->noResi;
            $data['tglTerima'] = $request->tglTerima;

            Jual::where('id',$id)->update($data);
        } catch (Exception $e) {
         return redirect()->back()->with('error','Pesanan Barang Gagal Dibuat');
     }
     
     return redirect("penjualan/create/".$id)->with('success','Pesanan Barang Sukses Dibuat');
 }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jual  $jual
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jual $jual)
    {
        
    }
}