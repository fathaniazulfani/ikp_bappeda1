<?php

namespace App\Http\Controllers;

use App\Models\IKP;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use PDF;

class IKPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tahun = DB::table('ikp')
        ->get(['tahun']);

        return view('_ikp', compact('tahun'));
    }

    // public function index1($tahun)
    // {
    //     return view('ikp');
    // }

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
        $d_ikp = DB::table('ikp')
        -> where('tahun', '=', $request->tahun)
        ->get();

        foreach ($d_ikp as $dt) {
            $data = $dt->id;
        }

        $tahun = DB::table('ikp')
        ->get(['tahun']);

        //total sub dimensi
        $n_sub = DB::table('item_penilaian')
        -> join ('dimensi', 'item_penilaian.id_dimensi', '=', 'dimensi.id')
        -> join ('subdimensi', 'item_penilaian.id_subdimensi', '=', 'subdimensi.id_sub')
        -> selectRaw('id_subdimensi, item_penilaian.id_dimensi, nama_sub, sum(nilai) as sum')
        -> where('dimensi.id_ikp', '=', $data)
        -> groupBy("id_subdimensi")
        -> get();

        $n_dimensi = DB::table('item_penilaian')
        -> join ('dimensi', 'item_penilaian.id_dimensi', '=', 'dimensi.id')
        -> join ('subdimensi', 'item_penilaian.id_subdimensi', '=', 'subdimensi.id_sub')
        -> selectRaw('item_penilaian.id_dimensi, nama_dimensi, sum(nilai) as sum')
        -> where('dimensi.id_ikp', '=', $data)
        -> groupBy("id_dimensi")
        -> get();

        $n_ikp = DB::table('item_penilaian')
        -> join ('dimensi', 'item_penilaian.id_dimensi', '=', 'dimensi.id')
        -> join ('ikp', 'dimensi.id_ikp', '=', 'ikp.id')
        -> selectRaw('ikp.tahun, sum(item_penilaian.nilai) as sum')
        -> where('dimensi.id_ikp', '=', $data)
        -> get();

        // dd($n_sub);

        $item_penilaian = DB::table('item_penilaian')
        -> join ('dimensi', 'item_penilaian.id_dimensi', '=', 'dimensi.id')
        -> where('dimensi.id_ikp', '=', $data)
        -> get();
        
        return view('ikp', compact('d_ikp', 'tahun', 'item_penilaian', 'n_sub', 'n_dimensi', 'n_ikp'));
    }

    public function cetak($nama, $tahun)
    {
        $d_ikp = DB::table('ikp')
        -> where('tahun', '=', $tahun)
        ->get();

        foreach ($d_ikp as $dt) {
            $data = $dt->id;
        }

        //total sub dimensi
        $n_sub = DB::table('item_penilaian')
        -> join ('dimensi', 'item_penilaian.id_dimensi', '=', 'dimensi.id')
        -> join ('subdimensi', 'item_penilaian.id_subdimensi', '=', 'subdimensi.id_sub')
        -> selectRaw('id_subdimensi, item_penilaian.id_dimensi, nama_sub, sum(nilai) as sum')
        -> where('dimensi.id_ikp', '=', $data)
        -> groupBy("id_subdimensi")
        -> get();

        $n_dimensi = DB::table('item_penilaian')
        -> join ('dimensi', 'item_penilaian.id_dimensi', '=', 'dimensi.id')
        -> join ('subdimensi', 'item_penilaian.id_subdimensi', '=', 'subdimensi.id_sub')
        -> selectRaw('item_penilaian.id_dimensi, nama_dimensi, sum(nilai) as sum')
        -> where('dimensi.id_ikp', '=', $data)
        -> groupBy("id_dimensi")
        -> get();

        $n_ikp = DB::table('item_penilaian')
        -> join ('dimensi', 'item_penilaian.id_dimensi', '=', 'dimensi.id')
        -> join ('ikp', 'dimensi.id_ikp', '=', 'ikp.id')
        -> selectRaw('ikp.tahun, sum(item_penilaian.nilai) as sum')
        -> where('dimensi.id_ikp', '=', $data)
        -> get();

        $item_penilaian = DB::table('item_penilaian')
        -> join ('dimensi', 'item_penilaian.id_dimensi', '=', 'dimensi.id')
        -> where('dimensi.id_ikp', '=', $data)
        -> get();

        if($nama == "pdf"){
            $paper_size = 'A4'; //ukuran kertas
            $orientation = 'landscape'; //format kertas
            $pdf = PDF::loadview('ikp_pdf', compact('d_ikp', 'item_penilaian', 'n_sub', 'n_dimensi', 'n_ikp'));
            $pdf->setPaper('A4', 'landscape');
            return $pdf->stream('laporan-ikp-pdf');
        }
        elseif($nama =="excel"){
            
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IKP  $iKP
     * @return \Illuminate\Http\Response
     */
    public function show(IKP $iKP)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IKP  $iKP
     * @return \Illuminate\Http\Response
     */
    public function edit(IKP $iKP)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IKP  $iKP
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IKP $iKP)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IKP  $iKP
     * @return \Illuminate\Http\Response
     */
    public function destroy(IKP $iKP)
    {
        //
    }
}
