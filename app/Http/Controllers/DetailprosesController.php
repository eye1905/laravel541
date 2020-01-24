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
use App\HistoryRaw;

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

        //dd($detailproses);
        /// cek untuk ambil barang dan proses raw
        $detail = DetailProses::where("id_proses", $detailproses->id_proses)->where("id_barang", $detailproses->id_barang)->get()->toArray();
        if (count($detail)==1) 
        {
            $data = array('jumlahBarang' => $request->jumlahBarang+$detail[0]["jumlahBarang"]);
            
            DetailProses::where("iddetail", $detail[0]["iddetail"])->update($data);

            return redirect()->back()->with('success', 'Jumlah Barang Sudah Ditambahkan');
        }
        else
        {
            $cek = DetailProses::where("id_proses", $detailproses->id_proses)->where("id_barang", $detailproses->id_barang)->where("status", $detailproses->status)->get()->toArray();

            if (count($cek)>0) 
            {
                return redirect()->back()->with('error', 'Proses Barang Sudah Ada');
            }
            else
            {
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

        $tingkat = Detailproses::select("detailproses.iddetail","detailproses.jumlahBarang","detailproses.id_proses", "detailproses.id_barang","detailproses.status", DB::raw("coalesce(HystoriRaw.jumlah, null) as jumlah"), DB::raw("coalesce(detailproses.parent, 1) as parent"), "detailproses.created_at")
        ->where("id_proses", $id)
        ->leftjoin("HystoriRaw", "detailproses.iddetail", "=", "HystoriRaw.iddetail")
        ->orderBy("detailproses.iddetail", "asc")
        ->orderBy("detailproses.status", "asc")
        ->get();


        $a_data = [];
        foreach ($tingkat as $key => $value) {
            if ($value->status==0 or $value->status==5) {
                $a_data["tingkat0"][$key] = $value;
            }

            if ($value->status==1 or $value->status==6) {
                $a_data["tingkat1"][$key] = $value;
            }

            if ($value->status==2 or $value->status==7) {
                $a_data["tingkat2"][$key] = $value;
            }

            if ($value->status==3 or $value->status==8 or $value->status==4) {
                $a_data["tingkat3"][$key] = $value;
            }

            if ($value->status==4) {
                $a_data["tingkat4"][$key] = $value;
            }
        }  

       // dd($a_data);
        $data["status"] = array(
            "0" => "Barang Masuk", 
            "1" => "Sortir", 
            "2" => "Selesai Sortir", 
            "3"=> "Pengeringan", 
            "4"=> "Selesai Pengeringan",
            "5"=> "Barang Masuk",
            "6" => "Sortir", 
            "7" => "Selesai Sortir", 
            "8"=> "Pengeringan");
        
        $data["detail"] = $a_data;

        $data["id"]     = $id;
        $data["masterbarangs"] = self::toList(Barang::all(), 'id');
        /*$data["masterbarangs"] = self::toList(Barang::where('namaBarang','=','Kaki')->get(), 'id');*/
        $data["barang"] = DB::select("select id_barang,sum(jumlahBarang) as jumlah from detailproses where id_proses='".$id."' and 
            (status='4' or status='0' or status='5') group by id_barang");
        
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
        
        $history = (Double) HistoryPengeringan::where("iddetail", $request->idproses)->sum("jumlah");
        //dd($detail);
        DB::beginTransaction();
        $detailproses = new DetailProses();
        $detailproses->id_proses = $detail->id_proses;
        $detailproses->id_barang = $detail->id_barang;
        $detailproses->jumlahBarang = $request->jumlah;
        $detailproses->parent = $request->parent;
        $detailproses->status =3;

        //dd($detail);  
        $cek = bcadd($request->jumlah, $history, 1);
        //dd($detail["jumlahBarang"]);
        /// cek untuk ambil barang dan proses raw
        if ($cek > $detail["jumlahBarang"]) {
            return redirect()->back()->with('error','jumlah terlalu besar');
        }
        else{
            // simpan detail proses
            $detailproses->save();

            // histori sisa
            $select = HistoryRaw::where("iddetail", $detail->iddetail)->get()->first();

            if (!is_null($select)) {
                $hisdata = [];
                $hisdata["jumlah"] = bcsub($select->jumlah, $request->jumlah, 1);
                //dd($hisdata);
                HistoryRaw::where("iddetail", $detail->iddetail)->update($hisdata);
            }else{

                $history = new HistoryRaw();
                $history->jumlah = bcsub($detail->jumlahBarang, $request->jumlah, 1);
                $history->iddetail = $detail->iddetail;
                //dd($history);
                $history->save();
            }

            // simpan ke pengeringan
            $history = new HistoryPengeringan();
            $history->jumlah = $detailproses->jumlahBarang;
            $history->iddetail = $detail->iddetail;
            $history->save();

            $history = HistoryPengeringan::where("iddetail", $request->idproses)->sum("jumlah");
            $jumlah = (Double) $detail->jumlahBarang;
            
        }

        $total = DetailProses::where("iddetail", $request->idproses)->sum("jumlahBarang");
        $jumlah = DetailProses::where("parent", $request->idproses)->sum("jumlahBarang");

        if ($jumlah>=$total) {
            $update = array('status' => 7);
            DetailProses::where("iddetail", $request->idproses)->update($update);
        }

        DB::commit();
        return redirect()->back()->with('success','Proses Pengeringan Berhasil Ditambahkan !');
    }


    public function sortir(Request $request)
    {
        $detail = DetailProses::where("iddetail", $request->s_idproses)->get()->first();
        $history = (Double) HistoryRaw::where("iddetail", $request->s_idproses)->sum("jumlah");

        $persen = $detail->jumlahBarang*10/100;
        $sisa   = $history-$persen;
        if($sisa<0){
            $sisa = 0;
        }

        DB::beginTransaction();
        $detailproses = new DetailProses();
        $detailproses->id_proses = $detail->id_proses;
        $detailproses->id_barang = $detail->id_barang;
        $detailproses->jumlahBarang = $request->s_jumlah;
        $detailproses->parent = $request->s_parent;
        $detailproses->status = 1;

        /// cek untuk ambil barang dan proses raw
        if ($request->s_jumlah<$sisa or $request->s_jumlah > $detail->jumlahBarang) {
            return redirect()->back()->with('error','jumlah terlalu besar');
        }else{

            $barang = Barang::where("namaBarang", "Raw")->get()->first();

            $total = DetailProses::where("id_barang", $barang["id"])->where("id_proses", $detailproses->id_proses)
            ->where("status", "0")->sum("jumlahBarang");

            $jumlah = DetailProses::where("id_barang", $barang["id"])->where("id_proses", $detailproses->id_proses)
            ->where("status", "1")->sum("jumlahBarang");

            if ($jumlah > $total) {
               return redirect()->back()->with('error','Raw Barang Tidak Boleh Lebih besar dari jumlah asli');
           }else{
            $detailproses->save();

            $select = HistoryRaw::where("iddetail", $detail->iddetail)->get()->first();

            if (!is_null($select)) {
                $hisdata = [];
                $hisdata["jumlah"] = bcsub($select->jumlah, $request->s_jumlah, 1);
                //dd($hisdata);
                HistoryRaw::where("iddetail", $detail->iddetail)->update($hisdata);
            }else{

                $history = new HistoryRaw();
                $history->jumlah = bcsub($detail->jumlahBarang, $request->s_jumlah, 1);
                $history->iddetail = $detail->iddetail;
                //dd($history);
                $history->save();
            }
        }

        $total = DetailProses::where("iddetail", $request->s_idproses)->sum("jumlahBarang");
        $jumlah = DetailProses::where("parent", $request->s_idproses)->sum("jumlahBarang");

        $total = $total-$persen;

        //dd($jumlah);
        if ($jumlah>=$total) {
            $update = array('status' => 5);
            DetailProses::where("iddetail", $request->s_idproses)->update($update);
        }
    }
            //var_dump($update); die;
    DB::commit();
    return redirect()->back()->with('success','Proses Sortir Berhasil Ditambahkan !');
}

public function endsortir(Request $request)
{
    $detail = DetailProses::where("iddetail", $request->e_idproses)->get()->first();
    $history = (Double) HistorySortir::where("iddetail", $request->e_idproses)->sum("jumlah");

    if ($history==0) {
        $persen = $detail->jumlahBarang*10/100;
        $sisa   = $detail->jumlahBarang-$persen;
    }else{
        $persen = $detail->jumlahBarang*10/100;
        $sisa   = $history-$persen;
    }

    DB::beginTransaction();
    $detailproses = new DetailProses();
    $detailproses->id_proses = $detail->id_proses;
    $detailproses->id_barang = $request->e_idbarang;
    $detailproses->jumlahBarang = $request->e_jumlah;
    $detailproses->parent = $request->e_parent;
    $detailproses->status =2;

    $cek = $request->e_jumlah+$history;
    /// cek untuk ambil barang dan proses raw
    if ($request->e_jumlah>$detail->jumlahBarang) {
        return redirect()->back()->with('error','jumlah terlalu besar');
    }else{
        $detailproses->save();

            // insert history untuk sisa
        $select = HistoryRaw::where("iddetail", $detail->iddetail)->get()->first();
        
        if (!is_null($select)) {
            $hisdata = [];
            $hisdata["jumlah"] = bcsub($select->jumlah, $request->e_jumlah, 1);
            
            HistoryRaw::where("iddetail", $detail->iddetail)->update($hisdata);
        }else{

            $history = new HistoryRaw();
            $history->jumlah = bcsub($detail->jumlahBarang, $request->e_jumlah, 1);
            $history->iddetail = $detail->iddetail;
            //dd($history);
            $history->save();
        }

            // insert ke history sortir 
        $history = new HistorySortir();
        $history->jumlah = $detailproses->jumlahBarang;
        $history->iddetail = $detail->iddetail;

        $history->save();

            // cek history lagi setelah di simpan
        $history = (Double) HistorySortir::where("iddetail", $request->e_idproses)->sum("jumlah"); 
    }

    // update status
    $total = DetailProses::where("iddetail", $request->e_idproses)->sum("jumlahBarang");
    $jumlah = DetailProses::where("parent", $request->e_idproses)->sum("jumlahBarang");
        
    if ($jumlah>=$total) {
        $update = array('status' => 6);
        DetailProses::where("iddetail", $request->e_idproses)->update($update);
    }

    //var_dump($update); die;
    DB::commit();
    return redirect()->back()->with('success','Proses Selesai Sortir Berhasil Ditambahkan !');
}

public function endpengeringan(Request $request)
{
    $detail = DetailProses::where("iddetail", $request->k_idproses)->get()->first();
    $history = HistoryRaw::select("jumlah")->where("iddetail", $request->k_idproses)->get()->first();
    
    if (is_null($history)) {
        $persen = $detail->jumlahBarang*10/100;
        $sisa   = $detail->jumlahBarang-$persen;
    }else{
        $persen = $detail->jumlahBarang*10/100;
        $sisa   = $history->jumlah-$persen;
    }

    DB::beginTransaction();
    $detailproses = new DetailProses();
    $detailproses->id_proses = $detail->id_proses;
    $detailproses->id_barang = $detail->id_barang;
    $detailproses->jumlahBarang = $request->k_jumlah;
    $detailproses->parent = $request->k_parent;
    $detailproses->status = 4;

        /// cek untuk ambil barang dan proses raw
    if ($request->k_jumlah<$sisa or $request->k_jumlah>$detail->jumlahBarang) {
        return redirect()->back()->with('error','jumlah terlalu kecil');
    }else{

        $detailproses->save();

        $select = HistoryRaw::where("iddetail", $detail->iddetail)->get()->first();

        if (!is_null($select) and $request->k_jumlah >= $persen) {
            $persen = $select->jumlah*10/100;
            $hisdata = [];
            if ($select->jumlah==$persen) {
                $hisdata["jumlah"] = (Double)$persen;
            }else{
                $hisdata["jumlah"] = bcsub($select->jumlah, $request->k_jumlah, 1);
                //dd($hisdata);
            }

            HistoryRaw::where("iddetail", $detail->iddetail)->update($hisdata);
        }else{

            $history = new HistoryRaw();
            $history->jumlah = bcsub($detail->jumlahBarang, $request->k_jumlah, 1);
            $history->iddetail = $detail->iddetail;
                //dd($history);
            $history->save();
        }
    }

    $total = DetailProses::where("iddetail", $request->k_idproses)->sum("jumlahBarang");
    $jumlah = DetailProses::where("parent", $request->k_idproses)->sum("jumlahBarang");

    $total = $total-$persen;

    if ($jumlah>=$total) {
        if($detail->status==2){
            $update = array('status' => 7);
            DetailProses::where("iddetail", $request->k_idproses)->update($update);
        }else{
            $update = array('status' => 8);
            DetailProses::where("iddetail", $request->k_idproses)->update($update);
        }
    }

    DB::commit();
    return redirect()->back()->with('success','Proses Pengeringan Berhasil Ditambahkan !');
}

public function endproses($id)
{   
    $barang = Barang::where("namaBarang", "Raw")->get()->first();
        // select total raw barang
    $count = Detailproses::select(DB::raw("SUM(jumlahBarang) as jumlah"))->where("id_proses", $id)->where("id_barang", $barang->id)->where("status", 0)
    ->groupBy("id_barang")->get()->first();
    
    $persen =0;
    if ($count!=null) {
        $persen = $count->jumlah-2;   
    }

    // select proses jika ada
    $proses = Proses::findOrFail($id);

    // select total barang yang sudah melalui sortir dan pengeringan
    $jumlah = Detailproses::select(DB::raw("SUM(jumlahBarang) as jumlah"))->where("id_proses", $id)->where("status", 4)->get()->first();
    
    // bandingkan jika total raw dan total barang yang melalui sortir dan pengeringan
    if ($persen>$jumlah->jumlah) {
        return redirect()->back()->with('error','Raw Barang Belum Kosong, Transaksi Tidak Bisa Dilanjut');
    }else{
        try {
            DB::beginTransaction();
                // untuk create beli
            $beli = new Beli();
            $beli->tglBeli = date("Y-m-d");
            $beli->id_suppliers = $proses->id_suppliers;
            $beli->id_users = $proses->id_users;
            $beli->status = 0;

                // pembuatan kode nota beli
            $beli->save();
            $data = [];
            $data['noNotaBeli'] = 'B0000'.$beli->id;
            Beli::where('id',$beli->id)->update($data);

                // create detail beli
            $data = DB::select("select id_barang,sum(jumlahBarang) as jumlah from detailproses where id_proses='".$id."' and (status='4' or status='0')
                group by id_barang");
            
            // iterasi insert to detail belis
            foreach ($data as $key => $value) {
                $detail = new Detailbeli();
                $detail->id_beli = $beli->id;
                $detail->id_barang = $value->id_barang;
                $detail->berat = (Double) $value->jumlah;
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

public function getPersen($jumlah)
{
    $percen =   $jumlah*10/100;
    $percen = $jumlah-$percen;

    return $percen;
}
}
