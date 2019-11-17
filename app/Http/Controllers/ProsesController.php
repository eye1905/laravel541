<?php

namespace App\Http\Controllers;

use App\Proses;
use App\Beli;
use App\Supplier;
use App\Karyawan;
use App\User;
use Illuminate\Http\Request;

class ProsesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $data["masterbelis"] = Proses::all();
         $data["mastersuppliers"] = self::toList(Supplier::all(), "id");
         $data["masterkaryawans"] = self::toList(User::all(), "id");

         return view('admin.proses.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $data["masterbelis"] = Beli::all();
         $data["mastersuppliers"] = Supplier::all();
         $data["masterkaryawans"] = User::all();
          
         return view('admin.proses.create', $data);
    }

    public function pengeringan($idbeli, $idbarang)
    {
        
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $proses = new Proses();
        
        $proses->tglProses = date("Y-m-d");
        $proses->id_suppliers = $request->supplier;
        $proses->id_users = $request->karyawan;
        $proses->status = 0;
        $proses->save();

        return redirect('detailproses'."/".$proses->id."/edit")->with('Data Barang Berhasil Ditambahkan !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Proses  $proses
     * @return \Illuminate\Http\Response
     */
    public function show(Proses $proses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Proses  $proses
     * @return \Illuminate\Http\Response
     */
    public function edit(Proses $proses)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Proses  $proses
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proses $proses)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Proses  $proses
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proses $proses)
    {
        //
    }
}
