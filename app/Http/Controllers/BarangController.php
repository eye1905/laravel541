<?php

namespace App\Http\Controllers;

use App\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarangController extends Controller
{   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $masterbarangs = Barang::all();

        return view('admin.barang.index',['masterbarangs' => $masterbarangs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     return view('admin.barang.create');
 }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $namaBarang = $request->get('namaBarang');
        $satuan = $request->get('satuan');
        $harga = $request->get('harga');


        $masterbarangs = new Barang();
        $masterbarangs->namaBarang=$namaBarang;
        $masterbarangs->stok="0";
        $masterbarangs->satuan=$satuan;
        $masterbarangs->harga=$harga;
        $masterbarangs->status="1";
        $masterbarangs->save();

        return redirect('barang')->with('Data Barang Berhasil Ditambahkan !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $masterbarangs = Barang::whereId($id)->firstOrFail();
        return view('admin.barang.edit',['masterbarangs' => $masterbarangs]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $namaBarang = $request->get('namaBarang');
      $satuan = $request->get('satuan');
      $harga = $request->get('harga');
      $stok = $request->get('stok');

      $masterbarangs = Barang::whereId($id)->firstOrFail();
      $masterbarangs->namaBarang=$namaBarang;

      $masterbarangs->satuan=$satuan;
      $masterbarangs->harga=$harga;
      $masterbarangs->stok=$stok;
      $masterbarangs->status="1";
        //var_dump($masterbarangs);die;
      $masterbarangs->save();

      return redirect('barang')->with('Data Barang Berhasil Diubah !');
  }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $masterbarangs = Barang::whereId($id)->firstOrFail();
        $masterbarangs->delete();
        return redirect('barang')->with('Data Barang Berhasil Di hapus !');
    }

    public function getBarang()
    {
        $data = Barang::where("stok", "<", "20")->get();

        $html = [];
        foreach ($data as $key => $value) {
            $html[$key+1]["nama"] = $value->namaBarang;
            $html[$key+1]["stok"] = $value->stok;
            $html[$key+1]["satuan"] = $value->satuan;
        }

        echo json_encode($html);
    }
}

