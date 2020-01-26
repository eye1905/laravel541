<?php

namespace App\Http\Controllers;

use App\Konsumen;
use Illuminate\Http\Request;
use Auth;
use Route;

class KonsumenController extends Controller
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
        
       $masterkonsumens = Konsumen::all();
        return view('admin.konsumen.index',['masterkonsumens' => $masterkonsumens]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.konsumen.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $namaKonsumen = $request->get('namaKonsumen');
        $alamat = $request->get('alamat');
        $noTelp = $request->get('noTelp');
        //$norekening = $request->get('norekening');
        
        $masterkonsumens = new Konsumen();
        $masterkonsumens->namaKonsumen=$namaKonsumen;
        $masterkonsumens->alamat=$alamat;
        $masterkonsumens->noTelp=$noTelp;
        //$masterkonsumens->norekening=$norekening;

        $masterkonsumens->save();

        return redirect('konsumen')->with('Data Konsumen Berhasil Ditambahkan !');
   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Konsumen  $konsumen
     * @return \Illuminate\Http\Response
     */
    public function show(Konsumen $konsumen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Konsumen  $konsumen
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $masterkonsumens = Konsumen::whereId($id)->firstOrFail();
        return view('admin.konsumen.edit',['masterkonsumens' => $masterkonsumens]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Konsumen  $konsumen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $masterkonsumens = Konsumen::whereId($id)->firstOrFail();
        $masterkonsumens->namaKonsumen =$request->get('namaKonsumen');
        $masterkonsumens->alamat =$request->get('alamat');
        $masterkonsumens->noTelp =$request->get('noTelp');
        //$masterkonsumens->norekening =$request->get('norekening');
        $masterkonsumens->save();
        return redirect('konsumen')->with('status', 'data konsumen berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Konsumen  $konsumen
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $masterkonsumens = Konsumen::whereId($id)->firstOrFail();
        $masterkonsumens->delete();
        return redirect('konsumen');
    }
}
