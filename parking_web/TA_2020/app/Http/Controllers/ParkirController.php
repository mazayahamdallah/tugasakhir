<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Parkir;

class ParkirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tgl_awal = $request->tgl_awal;
        $tgl_akhir = $request->tgl_akhir;


        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $parkir = Parkir::with('mahasiswa')->where('status', 'out')->orderBy('jam_keluar', 'desc')->whereBetween('jam_keluar', [$tgl_awal, $tgl_akhir])->get();
            $hasil= "Hasil filter dari tanggal " .$tgl_awal. " s/d tanggal " .$tgl_akhir. ":"; //mendefinisikan var $hasil sebagai output tanggal
            //whereBetween untuk fungsi diantara tgl_awal dan tgl_akhir
            return view('laporan', compact('parkir', 'hasil'));
        } else{
            $parkir = Parkir::with('mahasiswa')->where('status', 'out')->orderBy('jam_keluar', 'desc')->get(); //jika engga ngga masukin if (!empty ..., maka yang tertampil semua data
            return view('laporan', compact('parkir'));
        }
        // dd($parkir);
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
