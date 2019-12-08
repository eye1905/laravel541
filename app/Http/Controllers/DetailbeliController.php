<?php

namespace App\Http\Controllers;

use App\Detailbeli;
use Illuminate\Http\Request;
use App\Beli;
use App\Supplier;
use App\Karyawan;
use App\User;
use App\Barang;
use DB;

class DetailbeliController extends Controller
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
    

    public function index($id)
    {
        
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
       
        DB::beginTransaction();
        $detailbeli = new Detailbeli();
        $detailbeli->id_barang = $request->barang;
        $detailbeli->id_beli = $request->beli;
        $detailbeli->berat = $request->berat;
        $detailbeli->harga = $request->harga;
        $detailbeli->subTotal = $request->harga*$request->berat;
        $detailbeli->save();
        $total = Detailbeli::select("subTotal")->where('id_beli', $request->beli)->get();
        $total1 = 0;
        foreach ($total as $key => $value) {
                    $total1 += $value["subTotal"];
        }
        $detail = new Detailbeli();
        $total = array('total' => $total1);
        $end = Detailbeli::where("id_beli", $request->beli)->update($total);

        DB::commit();
        return redirect()->back()->with('Data Detail Beli Berhasil Ditambahkan !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Detailbeli  $detailbeli
     * @return \Illuminate\Http\Response
     */
    public function show(Detailbeli $detailbeli)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Detailbeli  $detailbeli
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $raw = Barang::where("namaBarang", "like", "%Raw%")->get()->first();
        $data["data"] = Beli::whereId($id)->firstOrFail();
        $data["masterdetailbelis"] = Detailbeli::where("id_beli", $id)->where("id_barang", "!=", $raw->id)->get();
        $data["masterbarangs"] = self::toList(Barang::all(), 'id');
        $data["masterkaryawans"] = User::all();
        $data["mastersuppliers"] = self::toList(Supplier::all(), 'id');
        $data["id"]             = $id;

        return view('admin.detailbeli.index', $data);
    }

     public function tutup($id)
    {
       
        $barang=[];
        $Detailbeli = new Detailbeli();
        $mbarang= new Barang();
        $barang= $Detailbeli->getbarang($id);
        $barang2= $mbarang->getbarang();
        /*update stok barang*/
        foreach ($barang as $key => $value) {
            foreach ($barang2 as $key2 => $value2) {
                if ($value->id_barang==$value2->id) {
                    $value2->harga = $value2->harga;
                    if (isset($value2->hpp) and $value2->hpp!=null) {
                        $value2->harga = $value2->hpp;
                    }
                    $harga = $value2->stok*$value2->harga + $value->stok*$value->harga;
                    $bagi = $value2->stok+$value->stok;
                    $hpp = $harga/$bagi;

                    $stok = array('stok' => $value->stok+$value2->stok, 'hpp'=> $hpp);
                    Barang::where("id", $value->id_barang)->update($stok);
                }
            }
        }

        /*update status beli*/
        $status = array('status' => '1'); /*status 1 = tutup*/
        Beli::where("id", $id)->update($status);

        return redirect()->back()->with('Transaksi berhasil ditutup');

    }

    public function cetak($id)
    {
        $raw = Barang::where("namaBarang", "like", "%Raw%")->get()->first();
        $data["data"] = Beli::whereId($id)->firstOrFail();
        $data["masterdetailbelis"] = Detailbeli::where("id_beli", $id)->where("id_barang", "!=", $raw->id)->get();
        $data["masterbarangs"] = self::toList(Barang::all(), 'id');
        $data["masterkaryawans"] = User::all();
        $data["mastersuppliers"] = self::toList(Supplier::all(), 'id');
        $data["id"]             = $id;

        return view('admin.beli.notabeli', $data);

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Detailbeli  $detailbeli
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Detailbeli $detailbeli)
    {
        //
    }

    public function updateharga(Request $request)
    {
        $data = [];
        $data["id_beli"] = $request->beli;
        $data["id_barang"] = $request->barang;
        $data["berat"] = $request->berat;
        $data["harga"] = $request->harga;
        $data["subTotal"] = $data["harga"]*$data["berat"];

        Detailbeli::where("id_barang", $request->barang)->where("id_beli", $request->beli)->update($data);

        return redirect()->back()->with('Harga Berhasil Ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Detailbeli  $detailbeli
     * @return \Illuminate\Http\Response
     */
    public function destroy(Detailbeli $detailbeli)
    {
        //
    }
}
