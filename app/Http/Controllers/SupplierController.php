<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;
use Auth;
use Route;

class SupplierController extends Controller
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
        $mastersuppliers = Supplier::all();
        return view('admin.supplier.index',['mastersuppliers' => $mastersuppliers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('admin.supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $namaSupplier = $request->get('namaSupplier');
        $alamat = $request->get('alamat');
        $noTelp = $request->get('noTelp');

        $mastersuppliers = new Supplier();
        $mastersuppliers->namaSupplier=$namaSupplier;
        $mastersuppliers->alamat=$alamat;
        $mastersuppliers->noTelp=$noTelp;
        $mastersuppliers->noRekening=$request->get('norek');
        $mastersuppliers->save();

        return redirect('supplier')->with('Data Supplier Berhasil Ditambahkan !');
   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mastersuppliers = Supplier::whereId($id)->firstOrFail();
        return view('admin.supplier.edit',['mastersuppliers' => $mastersuppliers]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $mastersuppliers = Supplier::whereId($id)->firstOrFail();

        $mastersuppliers->namaSupplier =$request->get('namaSupplier');
        $mastersuppliers->alamat =$request->get('alamat');
        $mastersuppliers->noTelp =$request->get('noTelp');
        $mastersuppliers->noRekening=$request->get('norek');
        
        $mastersuppliers->save();
        return redirect('supplier')->with('status', 'data supplier berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mastersuppliers = Supplier::whereId($id)->firstOrFail();
        $mastersuppliers->delete();
        return redirect('supplier');
    }
}
