<?php

namespace App\Http\Controllers;

use App\Beli;
use App\Supplier;
use App\User;
use Illuminate\Http\Request;

class BeliController extends Controller
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
            //dd($this->user->jabatan);
            if ($this->user->jabatan==3 or $this->user->jabatan==4) {
                return redirect('home')->with('Anda Tidak Punya Akses');
            }
            
            return $next($request);
        });
    }

    public function index()

    {
     $data["masterbelis"] = Beli::all();
     $data["mastersuppliers"] = self::toList(Supplier::all(), "id");
     $data["masterkaryawans"] = self::toList(User::all(), "id");

     return view('admin.beli.index', $data);
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
          //var_dump($data["mastersuppliers"]);die;
     return view('admin.beli.create', $data);
 }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $beli = new Beli();
        
        $beli->tglBeli = date("Y-m-d");
        $beli->id_suppliers = $request->supplier;
        $beli->id_users = \Auth::user()->id;
        $beli->status = 0;
       //var_dump($beli);die;
        $beli->save();
        $data = [];
        $data['noNotaBeli'] = 'B0000'.$beli->id;
        Beli::where('id',$beli->id)->update($data);

        return redirect('detailbeli'."/".$beli->id."/edit")->with('Data Barang Berhasil Ditambahkan !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Beli  $beli
     * @return \Illuminate\Http\Response
     */
    public function show(Beli $beli)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Beli  $beli
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data["data"] = Beli::whereId($id)->firstOrFail();
        $data["mastersuppliers"] = Supplier::all();
        $data["masterkaryawans"] = User::all();

        return view('admin.beli.edit', $data);
    }

    public function detail($id)
    {
        $data["data"] = Beli::whereId($id)->firstOrFail();
        $data["mastersuppliers"] = Supplier::all();
        $data["masterkaryawans"] = User::all();
        $data["id"]             = $id;

        return view('admin.beli.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Beli  $beli
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Beli $beli)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Beli  $beli
     * @return \Illuminate\Http\Response
     */
    public function destroy(Beli $beli)
    {
        //
    }

    function generateRandomString($length){ 
        $characters = "0123456789";
        $charsLength = strlen($characters) -1;
        $string = "";
        for($i=0; $i<$length; $i++){
            $randNum = mt_rand(0, $charsLength);
            $string .= $characters[$randNum];
        }
        return $string;
    }

    public function filter(Request $request)
    {
        $data["masterbelis"] = Beli::where()->get();
        $data["mastersuppliers"] = self::toList(Supplier::all(), "id");
        $data["masterkaryawans"] = self::toList(User::all(), "id");
        
        return view('admin.beli.index', $data);
    }
}
