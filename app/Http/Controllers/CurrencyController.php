<?php

namespace App\Http\Controllers;

use App\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $data = $this->getData("https://kurs.web.id/api/v1/bca");
    }   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }
   
    public function getData($url)
    {   
        $options = array(
          CURLOPT_CUSTOMREQUEST  =>"GET",    // Atur type request, get atau post
          CURLOPT_POST           =>false,    // Atur menjadi GET
          CURLOPT_FOLLOWLOCATION => true,    // Follow redirect aktif
          CURLOPT_CONNECTTIMEOUT => 120,     // Atur koneksi timeout
          CURLOPT_TIMEOUT        => 120,     // Atur response timeout
          );

          $ch      = curl_init( $url );          // Inisialisasi Curl
          curl_setopt_array( $ch, $options );    // Set Opsi
          $content = curl_exec( $ch );           // Eksekusi Curl
          curl_close( $ch );                     // Stop atau tutup script

          return $content;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function show(Currency $currency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function edit(Currency $currency)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Currency $currency)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Currency $currency)
    {
        //
    }
}
