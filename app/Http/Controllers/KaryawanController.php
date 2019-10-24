<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Auth;
use Route;
use Illuminate\Support\Facades\Validator;

class KaryawanController extends Controller
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
        $masterkaryawans = User::all();
        return view('admin.karyawan.index',['masterkaryawans' => $masterkaryawans]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.karyawan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $namaKaryawan = $request->get('name');
        $jabatan = $request->get('jabatan');
        $email = $request->get('email');
        $password = $request->get('password');
        User::create([
            'email' => $email,
            'password' => bcrypt($password),
            'namaKaryawan' => $namaKaryawan,
            'jabatan' => $jabatan
        ]);
        return redirect('karyawan')->with('Data Karyawan Berhasil Ditambahkan !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function show(Karyawan $karyawan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $masterkaryawans = User::whereId($id)->firstOrFail();
        return view('admin.karyawan.edit',['masterkaryawans' => $masterkaryawans]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $masterkaryawans = User::whereId($id)->firstOrFail();

        $masterkaryawans->namaKaryawan =$request->get('namaKaryawan');
        $masterkaryawans->jabatan =$request->get('jabatan');

        $masterkaryawans->save();
        return redirect('karyawan')->with('status', 'data karyawan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $masterkaryawans = User::whereId($id)->firstOrFail();
        $masterkaryawans->delete();
        return redirect('karyawan');
    }

 /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

   

}
