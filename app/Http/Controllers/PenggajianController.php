<?php

namespace App\Http\Controllers;

use App\Penggajian;
use Illuminate\Http\Request;

class PenggajianController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Penggajian  $penggajian
     * @return \Illuminate\Http\Response
     */
    public function show(Penggajian $penggajian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Penggajian  $penggajian
     * @return \Illuminate\Http\Response
     */
    public function edit(Penggajian $penggajian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Penggajian  $penggajian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penggajian $penggajian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Penggajian  $penggajian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penggajian $penggajian)
    {
        //
    }
}
