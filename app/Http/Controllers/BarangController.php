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
        //$masterbarangs = Barang::where('namaBarang', '=', 'Kaki')->get();
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
    public function show($id)
    {
        $masterbarangs = Barang::find($id);
       
        return json_encode($masterbarangs);
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
        $data = Barang::where("stok", "<", "20")->where("namaBarang", "!=", "Raw")->get();

        $html = [];
        foreach ($data as $key => $value) {
            $html[$key+1]["nama"] = $value->namaBarang;
            $html[$key+1]["stok"] = $value->stok;
            $html[$key+1]["satuan"] = $value->satuan;
        }

        echo json_encode($html);
    }

    public function currency()
    {
        echo $this->get_currency('USD', 'IDR', 1);
    }

    public function get_currency($from_Currency, $to_Currency, $amount) {
        // const string fromCurrency = $from_Currency;
        // const string toCurrency =  $to_Currency;
        // const double amount = $amount;
        // // For other currency symbols see http://finance.yahoo.com/currency-converter/
        // // Clear the output editor //optional use, AFAIK
        // Output.Clear();

        // // Construct URL to query the Yahoo! Finance API
        // const string urlPattern = "http://finance.yahoo.com/d/quotes.csv?s={0}{1}=X&f=l1";
        // string url = String.Format(urlPattern, fromCurrency, toCurrency);

        // // Get response as string
        // string response = new WebClient().DownloadString(url);

        // // Convert string to number
        // double exchangeRate =
        //     double.Parse(response, System.Globalization.CultureInfo.InvariantCulture);

        // // Output the result
        // Output.Text = String.Format("{0} {1} = {2} {3}",
        //                             amount, fromCurrency,
        //                             amount * exchangeRate, toCurrency);
        
        // die();
        // return round($data[0], 2);
    }
}

