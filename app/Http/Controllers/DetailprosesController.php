<?php

namespace App\Http\Controllers;

use App\Detailproses;
use Illuminate\Http\Request;
use App\Proses;
use App\Barang;
use DB;
use App\Beli;
use App\Detailbeli;
use App\HistorySortir;
use App\HistoryPengeringan;

class DetailprosesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $detailproses = new DetailProses();
        $detailproses->id_proses = $request->id_proses;
        $detailproses->id_barang = $request->barang;
        $detailproses->jumlahBarang = $request->jumlahBarang;
        $detailproses->status =0;

        /// cek untuk ambil barang dan proses raw
        $detail = DetailProses::where("id_proses", $detailproses->id_proses)->where("id_barang", $detailproses->id_barang)->get()->toArray();
        if (count($detail)==1) {
            $data = array('jumlahBarang' => $request->jumlahBarang+$detail[0]["jumlahBarang"]);
            
            DetailProses::where("iddetail", $detail[0]["iddetail"])->update($data);

            return redirect()->back()->with('success', 'Jumlah Barang Sudah Ditambahkan');
        }else{
            $cek = DetailProses::where("id_proses", $detailproses->id_proses)->where("id_barang", $detailproses->id_barang)->where("status", $detailproses->status)->get()->toArray();

            if (count($cek)>0) {
                return redirect()->back()->with('error', 'Proses Barang Sudah Ada');
            }else{
                DB::beginTransaction();
                $detailproses->save();
                DB::commit();
                return redirect()->back()->with('success','Data Detail Proses Berhasil Ditambahkan !');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Detailproses  $detailproses
     * @return \Illuminate\Http\Response
     */
    public function show(Detailproses $detailproses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Detailproses  $detailproses
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data["data"] = Proses::whereId($id)->firstOrFail();
        $data["masterdetailprosess"] = Detailproses::where("id_proses", $id)->get();
        $data["id"]     = $id;
        $data["masterbarangs"] = self::toList(Barang::all(), 'id');
        $data["raw"] = Detailproses::select("id_barang", DB::raw("SUM(jumlahBarang) as jumlah"))
                    ->where("id_proses", $id)->where("status", "5")->groupBy("id_barang")->get()->first();
        $data["barang"] = Detailproses::select("id_barang", DB::raw("SUM(jumlahBarang) as jumlah"))
                    ->where("id_proses", $id)->where("status", "4")->groupBy("id_barang")->get()->toArray();
        //dd($data["barang"]);
        return view('admin.detailproses.index', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Detailproses  $detailproses
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Detailproses $detailproses)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Detailproses  $detailproses
     * @return \Illuminate\Http\Response
     */
    public function destroy(Detailproses $detailproses)
    {
        
    }

    public function pengeringan(Request $request)
    {   
        $detail = DetailProses::where("iddetail", $request->idproses)->get()->first();
        $history = (Int) HistoryPengeringan::where("iddetail", $request->idproses)->sum("jumlah");
        //dd($detail);
        DB::beginTransaction();
        $detailproses = new DetailProses();
        $detailproses->id_proses = $detail->id_proses;
        $detailproses->id_barang = $detail->id_barang;
        $detailproses->jumlahBarang = $request->jumlah;
        $detailproses->status =3;

        //dd($detail);
        /// cek untuk ambil barang dan proses raw
        if ($history>0 and $request->jumlah>$history) {
            return redirect()->back()->with('error','jumlah terlalu besar');
        }else{
            // simpan detail proses
            $detailproses->save();

            // simpan ke pengeringan
            $history = new HistoryPengeringan();
            $history->jumlah = $detailproses->jumlahBarang;
            $history->iddetail = $detail->iddetail;
            $history->save();

            $history = HistoryPengeringan::where("iddetail", $request->idproses)->sum("jumlah");
            $jumlah = (Int) $detail->jumlahBarang;

            if ($history==$detail->jumlahBarang) {
                $data = [];
                $data["status"] = 8;
                $update = DetailProses::where("iddetail", $detail->iddetail)->update($data);
            }
        }
        //var_dump($update); die;
        DB::commit();
        return redirect()->back()->with('success','Proses Pengeringan Berhasil Ditambahkan !');
    }


    public function sortir(Request $request)
    {
       $detail = DetailProses::where("iddetail", $request->s_idproses)->get()->first();

        DB::beginTransaction();
        $detailproses = new DetailProses();
        $detailproses->id_proses = $detail->id_proses;
        $detailproses->id_barang = $detail->id_barang;
        $detailproses->jumlahBarang = $request->s_jumlah;
        $detailproses->status =1;

        /// cek untuk ambil barang dan proses raw
        if ($request->s_jumlah>$detail->jumlahBarang) {
            return redirect()->back()->with('error','jumlah terlalu besar');
        }else{
            $barang = Barang::where("namaBarang", "Raw")->get()->first();
            //dd($barang);
            $detail = DetailProses::where("id_barang", $barang["id"])->where("id_proses", $detailproses->id_proses)->get()->toArray();

            $jumlah = $total = 0;

            foreach ($detail as $key => $value) {
                if ($value["status"]==0) {
                    $total += $value["jumlahBarang"];
                }

                if ($value["status"]!=0) {
                    $jumlah += $value["jumlahBarang"];
                }
            }
            $jumlah = $jumlah+$detailproses->jumlahBarang;

            if ($jumlah > $total) {
               return redirect()->back()->with('error','Raw Barang Tidak Boleh Lebih besar dari jumlah asli');
            }else{
                $detailproses->save();
            }

            $detail = [];
            $detail = DetailProses::where("id_barang", $barang["id"])->where("id_proses", $detailproses->id_proses)->get()->toArray();
            //dd($detail);
            $jumlah = $total = 0;
            foreach ($detail as $key => $value) {
                if ($value["status"]==0) {
                    $total += $value["jumlahBarang"];
                }

                if ($value["status"]!=0) {
                    $jumlah += $value["jumlahBarang"];
                }
            }

            $data = array('status' => 5);
            if ($jumlah >= $total) {
                Detailproses::where("id_barang", $barang["id"])->where("id_proses", $detailproses->id_proses)->where("status", "0")->update($data);
            }

        }
        //var_dump($update); die;
        DB::commit();
        return redirect()->back()->with('success','Proses Sortir Berhasil Ditambahkan !');
    }

    public function endsortir(Request $request)
    {
        $detail = DetailProses::where("iddetail", $request->e_idproses)->get()->first();
        $history = (Int) HistorySortir::where("iddetail", $request->e_idproses)->sum("jumlah");
        
        DB::beginTransaction();
        $detailproses = new DetailProses();
        $detailproses->id_proses = $detail->id_proses;
        $detailproses->id_barang = $request->e_idbarang;
        $detailproses->jumlahBarang = $request->e_jumlah;
        $detailproses->status =2;
        /// cek untuk ambil barang dan proses raw
        if ($history>0 && $request->e_jumlah>$history) {
            return redirect()->back()->with('error','jumlah terlalu besar');
        }else{
            $detailproses->save();
            
            $data = [];
            $data["status"] = 1;

            // insert ke history sortir 
            $history = new HistorySortir();
            $history->jumlah = $detailproses->jumlahBarang;
            $history->iddetail = $detail->iddetail;
            $history->save();

            // cek history lagi setelah di simpan
            $history = (Int) HistorySortir::where("iddetail", $request->e_idproses)->sum("jumlah"); 

            // update status barang awal
            if ($detail->jumlahBarang==$history) {
                $data["status"] = 7;
                $update = DetailProses::where("iddetail", $request->e_idproses)->update($data);
            }
        }

        //var_dump($update); die;
        DB::commit();
        return redirect()->back()->with('success','Proses Selesai Sortir Berhasil Ditambahkan !');
    }

    public function endpengeringan(Request $request)
    {
        $detail = DetailProses::where("iddetail", $request->k_idproses)->get()->first();

        $persen = $detail->jumlahBarang*10/100;
        $sisa   = $detail->jumlahBarang-$persen;

        DB::beginTransaction();
        $detailproses = new DetailProses();
        $detailproses->id_proses = $detail->id_proses;
        $detailproses->id_barang = $detail->id_barang;
        $detailproses->jumlahBarang = $request->k_jumlah;
        $detailproses->status =4;

        /// cek untuk ambil barang dan proses raw
        if ($request->k_jumlah<$sisa or $request->k_jumlah>$detail->jumlahBarang) {
            return redirect()->back()->with('error','jumlah terlalu kecil');
        }else{
            $detailproses->save();

            $data = array('status' => 8);
            $update = DetailProses::where("iddetail", $request->k_idproses)->update($data);

        }
        //var_dump($update); die;
        DB::commit();
        return redirect()->back()->with('success','Proses Pengeringan Berhasil Ditambahkan !');
    }

    public function endproses($id)
    {   
        $barang = Barang::where("namaBarang", "Raw")->get()->first();
        // select total raw barang
        $count = Detailproses::select(DB::raw("SUM(jumlahBarang) as jumlah"))->where("id_proses", $id)->where("id_barang", $barang->id)->where("status", 5)
                ->groupBy("id_barang")->get()->first();

        // select proses jika ada
        $proses = Proses::findOrFail($id);

        // select total barang yang sudah melalui sortir dan pengeringan
        $jumlah = Detailproses::select(DB::raw("SUM(jumlahBarang) as jumlah"))->where("id_proses", $id)->where("status", 4)->get()->first();

        // bandingkan jika total raw dan total barang yang melalui sortir dan pengeringan
        if ($count>$jumlah) {
            return redirect()->back()->with('error','Raw Barang Belum Kosong, Transaksi Tidak Bisa Dilanjut');
        }else{
            try {
                DB::beginTransaction();
                // untuk create beli
                $beli = new Beli();
                $beli->tglBeli = date("Y-m-d");
                $beli->id_supplier = $proses->id_supplier;
                $beli->id_karyawan = $proses->id_karyawan;
                $beli->status = 0;

                // pembuatan kode nota beli
                $beli->save();
                $data = [];
                $data['noNotaBeli'] = 'B0000'.$beli->id;
                Beli::where('id',$beli->id)->update($data);
                
                // create detail beli
                $data = DB::select("select id_proses,id_barang,sum(jumlahBarang) as jumlah from detailproses where status='5' or status='4' group by id_proses,id_barang"); 
                // iterasi insert to detail belis
                foreach ($data as $key => $value) {
                    $detail = new Detailbeli();
                    $detail->id_beli = $beli->id;
                    $detail->id_barang = $value->id_barang;
                    $detail->berat = (Int) $value->jumlah;
                    $detail->harga = 0;
                    $detail->subtotal = $value->jumlah*$detail->harga;
                    $detail->total = 0;
                    $detail->save();
                }
                
                // untuk proses
                $data = array('status' => 1);
                Proses::where("id", $id)->update($data);
                DB::commit();
            } catch (Exception $e) {
                return redirect()->back()->with('error','Transaksi Tidak Bisa Dilanjut, silahkan cek data dulu');
            }

            return redirect()->back()->with('success','Proses Transaksi Berhasil Di Buat');
        }
    }
}
