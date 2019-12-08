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

    public function getharga($id)
    {
        $barang  = Barang::where('id', '=', $id)->first();
        $setting = Setting::all()->first();

        if ($barang->hpp > $barang->harga) {
            $barang->harga = $barang->hpp;
        }

        $harga   = $barang->harga+($barang->harga*$setting->persen/100);
        
        /*return $harga;*/

        return response()->json($harga);
    }

    public function getstok($berat, $id_barang)
    {
        $flag = 0; // penanda, 0 berarti oke, 1 berarti tidak memenuhi kebutuhan

        $cekstok = Barang::where('id', '=', $id_barang)->first();

        if ($cekstok->stok < $berat) {
            $flag = 1;
        }

        return response($flag);        
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


        $data["masterbarangs"]  = self::toList(Barang::all(), 'id');
        $data["id"]             = $id;

        if (isset($id)) {
            $data["id"]             = $id;
            $data["masterjual"]     = Detailjual::where("id_jual", $id)->get();
            $data["masterbarangs"]  = self::toList(Barang::all(), 'id');
            $data["data"]           = Jual::find($id);
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
            /* TABLE JUAL */

            /*UNTUK INPUT DI TBL JUAL*/
            $jual = new Jual();
            $jual->id_konsumen   = $request->get('konsumen');
            $jual->id_users      = $request->get('karyawan');
            $jual->tglKirim      = $request->get('tglKirim');
            $jual->noResi        = $request->get('noResi');
            $jual->tglPesan      = $request->get('tglPesan');
            $jual->tglTerima     = $request->get('tglTerima');
            $jual->diskon        = $request->get('diskon');
            $jual->total         = $request->get('total');
            $jual->statusBayar   = 0;

            $jual->save();
            $data = [];
            $data['noNotaJual']  = 'J0000'.$jual->id;
            Jual::where('id',$jual->id)->update($data);

            /* TABLE DETAIL JUAL */
            $barang   = $request->get('barang');
            $berat    = $request->get('berat');
            $harga    = $request->get('harga');

            for ($i=0; $i < count($barang); $i++) {

                $brg = explode(' - ', $barang[$i]);//mecah id dan nama dari barang ke [i], FYI $barang itu array.
                $id_barang = $brg[0];
                $namabarang = $brg[1];

                /*UNTUK INPUT DI TABLE DETAILJUAL*/
                $detailjual = new Detailjual();
                $detailjual->id_barang = $id_barang;
                $detailjual->id_jual   = $jual->id;
                $detailjual->beratJual = $berat[$i];
                $detailjual->harga     = $harga[$i];
                $detailjual->save();

                /*KARENA DIJUAL MAKA STOKNYA BERKURANG DI TBL BARANG, INI CARA NGITUNGNYA*/
                $cekstok = Barang::where('id', '=', $id_barang)->first();
                $stoklama = $cekstok->stok;
                $stokbaru = $stoklama-$berat[$i];

                /*INI CARA UPDATE STOK YANG BARU DI TBL BARANG*/ 
                $updatebarang = DB::table('barangs')
                                ->where('id', '=', $id_barang)
                                ->update([
                                    'stok' => $stokbaru
                                ]);
            }

            /*$detail = Detailjual::where("id_jual", $request->beli)->where("id_barang", $request->barang)->get()->first();

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

        return redirect("penjualan/create/".$jual->id)->with('status','Pesanan Barang Sukses Dibuat');
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
        $data["jual"] = Jual::find($id);
        $data["detailjual"] = Detailjual::where("id_jual", $id)->get();
        $data["masterbarangs"]   = self::toList(Barang::all(), 'id');
        $data["masterkaryawans"] = User::all();
        $data["id"]             = $id;
        $data["total"] = collect(\DB::select("SELECT IFNULL(SUM(beratJual*harga),0) as total FROM detailjuals WHERE id_jual='$id'"))->first();

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
            $jual = Jual::whereId($id)->firstOrFail();

            $jual->statusBayar   = $request->get('statusBayar');
            $jual->tglKirim      = $request->get('tglKirim');
            $jual->noResi        = $request->get('noResi');
            $jual->tglTerima     = $request->get('tglTerima');
            $jual->diskon        = $request->get('diskon');
            $jual->total         = $request->get('total');
            $jual->statusNota    = 1;

            $jual->save();

            $barang   = $request->get('barang');
            $harga   = $request->get('harga');

            for ($i=0; $i < count($barang); $i++) {

                $updatedetailjual = DB::table('detailjuals')
                                ->where('id_barang', '=', $barang[$i])
                                ->where('id_jual', '=', $id)
                                ->update([
                                    'harga' => $harga[$i]
                                ]);

            }

        } catch (Exception $e) {
         return redirect()->back()->with('error','Pesanan Barang Gagal Dibuat');
        }
     
     return redirect("penjualan")->with('status','Nota Penjualan dengan No. Nota : '.$jual->noNotaJual.' berhasil diselesaikan.');
    }

    public function updatebayar($id)
    {   
        $jual = Jual::whereId($id)->firstOrFail();
        $jual->statusBayar    = 1;
        $jual->save();
        return redirect("penjualan")->with('status','Nota Penjualan dengan No. Nota : '.$jual->noNotaJual.' berhasil diubah menjadi lunas.');
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