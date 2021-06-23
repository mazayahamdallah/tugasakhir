<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TrackPlat;
use App\Card;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $track_plat = TrackPlat::with('plat_nomor')->where('waktu_pergi', '=', null)->orderBy('waktu_datang', 'desc')->get();
        $card = Card::with('pengguna')->where('waktu_out', '=', null)->orderBy('waktu_in', 'desc')->get();
        // dd($parskir); //mengambil data 'mahasiswa' dimana statusnya 'in' diurutkan berdasarkan 'created at' terbaru paling atas
        return view('home', compact('track_plat','card')); //compact untuk mendefinisikan var parkir agar tertampil di home blade
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
        // date_default_timezone_set('Asia/Jakarta'); //menunjukkan zona waktu jakarta

        // $cek1 = Parkir::where('nim','=', $request->nim)->where('plat_nomor','=',$request->plat_nomor)->where('status','=','in')->get(); //pengecekan pertama dimana nim sama dengan nim, plat nomor sama dengan plat nomor, statusnya adalah 'in'
        // // dd($cek1->first()->id_parkir);

        // $cekAlert1 = Parkir::where('nim', '=', $request->nim)->where('plat_nomor','!=',$request->plat_nomor)->where('status','in')->get(); //pengecekan jika nim sama tapi plat nomor beda pada saat status 'in', maka akan menjalankan $cekAlert1
        // // dd($cekAlert1);

        // $cekAlert2 = Parkir::where('nim','!=', $request->nim)->where('plat_nomor','=',$request->plat_nomor)->get(); //jika nim tidak sesuai tapi plat nomor sama, maka akan menjalankan $cekAlert2
        // // dd($cekAlert2);

        // $data = [
        //     'nim' => $request->nim,
        //     'plat_nomor' => $request->plat_nomor,
        //     'jam_masuk' => date('Y-m-d H:i:s'),
        //     'status' => 'in',

        // ];

        // if ($cekAlert1->isNotEmpty()) {
        //     return redirect()->back()->with('error', 'Data NIM sedang parkir.');
        // }

        // if ($cekAlert2->isNotEmpty()) {
        //     return redirect()->back()->with('error', 'Data Plat Nomor sedang parkir.');
        // }

        // if ($cek1->isNotEmpty()) {
        //     Parkir::where('id_parkir', $cek1->first()->id_parkir)->update(['status' => 'out', 'jam_keluar' => date('Y-m-d H:i:s')]);
        //     return redirect ('home');
            
        // } else{
        //     Parkir::insert($data);
        //     return redirect ('home');
        // }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
