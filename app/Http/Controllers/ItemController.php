<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Pendukung;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use File;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $daftar_opd = DB::table('opd')
        ->get();

        $total_opd = DB::table('opd')
        ->count();
        
        $item = DB::table('item_penilaian')
        ->where('id_item', '=', $id)
        ->get();

        $data = DB::table('transaksi')
        ->join('item_penilaian', 'transaksi.id_item', '=', 'item_penilaian.id_item')
        ->where('transaksi.id_item', '=', $id)
        ->where('transaksi.id_user', '=', Auth::guard('web')->user()->id)
        ->first();

        $var = DB::table('item_penilaian')
        ->where('id_item', '=', $id)
        ->first();

        $program = DB::table('rpjmd_prog')
        ->join ('opd', 'rpjmd_prog.idopd', '=', 'opd.id')
        ->join ('nomenklatur', 'rpjmd_prog.kode_rekening', '=', 'nomenklatur.kode_rekening')
        ->get();

        $prog_ada = DB::table('keselarasan')
        ->where('status', '=', 'Ada')
        ->get()->count();

        $prog_tidak = DB::table('keselarasan')
        ->where('status', '=', 'Tidak')
        ->get()->count();

        $file_ab = DB::table('pendukung')
        ->where('id_item','=', $id)
        ->where('label_file', '=', 'Absensi')
        ->first();

        $file_ba = DB::table('pendukung')
        ->where('id_item','=', $id)
        ->where('label_file', '=', 'Berita Acara')
        ->first();

        $file_do = DB::table('pendukung')
        ->where('id_item','=', $id)
        ->where('label_file', '=', 'Dokumentasi')
        ->first();

        $n = DB::table('item_penilaian')
        ->where('id_item', '=', $id)
        ->first();

        if(auth()->user()->level=="admin"){
            if($var == '0'){
                return view('form_admin', compact('daftar_opd', 'total_opd', 'item'));
            }
            else{
                return view('form_update', compact('daftar_opd', 'total_opd','item', 'var'));
            }
        } 
        else{
            if(auth()->user()->level=="user" && $var->var_adm == '0'){
                if($n->tipe != '3'){
                    return redirect()->back()->with('warning', 'Belum Dapat Diisi');
                }
                else {
                    if($data === null){
                        return view('form', compact('daftar_opd', 'total_opd','item', 'program', 'prog_ada', 'prog_tidak', 'file_ab', 'file_ba', 'file_do'));
                    }
                    else{
                        if($data->nama_item == 'Keselarasan Program antara RKPD dengan RPJMD'){
                            return view('form', compact('daftar_opd', 'total_opd','item', 'program', 'prog_ada', 'prog_tidak', 'file_ab', 'file_ba', 'file_do'));
                        } else {
                            return view('form_update', compact('daftar_opd', 'total_opd','item', 'data', 'program', 'prog_ada', 'prog_tidak', 'file_ab', 'file_ba', 'file_do'));
                        }
                    }
                }
            
            } else {
                if($data === null){
                    return view('form', compact('daftar_opd', 'total_opd','item', 'program', 'prog_ada', 'prog_tidak', 'file_ab', 'file_ba', 'file_do'));
                }
                else{
                    return view('form_update', compact('daftar_opd', 'total_opd','item', 'data', 'program', 'prog_ada', 'prog_tidak', 'file_ab', 'file_ba', 'file_do'));

                    // if($data->nama_item == 'Keselarasan Program antara RKPD dengan RPJMD'){
                    //     return view('form', compact('daftar_opd', 'total_opd','item', 'program', 'prog_ada', 'prog_tidak', 'file_ab', 'file_ba', 'file_do'));
                    // } else {
                    //     return view('form_update', compact('daftar_opd', 'total_opd','item', 'data', 'program', 'prog_ada', 'prog_tidak', 'file_ab', 'file_ba', 'file_do'));
                    // }
                }
            }
            
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function form_program($item, $id)
    {

        $program = DB::table('rpjmd_prog')
        ->join ('opd', 'rpjmd_prog.idopd', '=', 'opd.id')
        ->join ('nomenklatur', 'rpjmd_prog.kode_rekening', '=', 'nomenklatur.kode_rekening')
        ->where ('opd.id', '=', $id)
        ->get();

        $opd = DB::table('opd')
        ->where ('opd.id', '=', $id)
        ->first();

        $item = DB::table('item_penilaian')
        ->where ('id_item', '=', $item)
        ->first();

        $data = DB::table('keselarasan')
        ->where('id_opd', '=', $id)
        ->first();

        $d_prog = DB::table('keselarasan')
        ->join ('nomenklatur', 'keselarasan.kode_rekening', '=', 'nomenklatur.kode_rekening')
        ->where('id_opd', '=', $id)
        ->get();
        
        return view('form_selaras', compact('program', 'opd', 'item', 'data', 'd_prog'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     //Input data var_adm
    public function store(Request $request, $id)
    {
        $item = DB::table('item_penilaian')
        -> join ('dimensi', 'item_penilaian.id_dimensi', '=', 'dimensi.id')
        -> where('id_item', '=', $id)
        -> get();

        foreach($item as $i){
            if($i->tipe == 1){
                Transaksi::create([
                    'id_item' => $id,
                    'id_user' =>  Auth::guard('web')->user()->id,
                    'nama_opd' => $checkbox,
                    'nilai_field1' => $request->field1,
                    'nilai_field2' => $request->field2,
                ]);
            }
            else{
                $update = DB::table('item_penilaian')
                ->where('id_item', '=', $id)
                ->update([
                    'var_adm' => $request->var_adm
                ]); 
            }
        }
        
        return redirect('_ikp')->with('success', 'Data Berhasil Disimpan!');;
    }

    public function store1(Request $request, $id)
    {

        $transaksi = DB::table('item_penilaian')
            ->join ('dimensi', 'item_penilaian.id_dimensi', '=', 'dimensi.id')
            ->join ('ikp', 'dimensi.id_ikp', '=', 'ikp.id')
            ->where('id_item','=', $id)
            ->get();

        foreach($transaksi as $x){
            $thn = $x->tahun;
        }

        $jlh = DB::table('transaksi')
            ->selectRaw('sum(transaksi.nilai_field1) as sum')
            ->where('transaksi.id_item','=', $id)
            ->get();    

        $hasil_akhir = 0;

        if($request->tipe == 1){

            foreach ($transaksi as $dt) {

                // if($dt->id_user == Auth::guard('web')->user()->id){
                //     Alert::error('Error', 'Sudah Input');
                //     return back();
                // } else{

                $field1 = count($request->id_opd);

                if(!empty($request->input('id_opd'))){
                    $checkbox = join(',', $request->input('id_opd'));
                }else{
                    $checkbox = '';
                }  

                Transaksi::create([
                    'id_item' => $id,
                    'id_user' =>  Auth::guard('web')->user()->id,
                    'opd' => $checkbox,
                    'nilai_field1' => $field1,
                    'nilai_field2' => $request->field2,
                ]);

                foreach($jlh as $n){
                    $data1 = $request->field2;
                    $bobot = $dt->bobot_item; 

                    if($dt->level_user == 'user'){
                        $data = $n->sum + $field1;
                    }
                    else{
                        $data = $field1;
                    }

                    $hasil = $data/$data1*1;
                    $hasil_akhir = $hasil*$bobot/100;
                }
            }
            
            $update = DB::table('item_penilaian')
            ->where('id_item', '=', $id)
            ->update([
                'nilai' => $hasil_akhir
            ]);

        }elseif($request->tipe == 2){
            Transaksi::create([
                'id_item' => $id,
                'id_user' =>  Auth::guard('web')->user()->id,
                'nilai_field1' => $request->field1,
                'nilai_field2' => $request->field2,
            ]);

            foreach ($transaksi as $dt) {
                foreach($jlh as $n){
                    $data1 = $request->field2;
                    $bobot = $dt->bobot_item; 

                    if($dt->level_user == 'user'){
                        $data = $n->sum + $request->field1;
                    }
                    else{
                        $data = $request->field1;
                    }

                    $hasil = ($data1!=0)?($data/$data1)*1:0;
                    $hasil_akhir = $hasil*$bobot/100;
                }
            }

            
            $update = DB::table('item_penilaian')
            ->where('id_item', '=', $id)
            ->update([
                'nilai' => $hasil_akhir
            ]);

        }elseif($request->tipe == 3){

            $data = $request->option;
            if($data == "Tepat Waktu"){
                $angka = 100;
            }
            elseif($data == "Ada"){
                $angka = 100;
            }
            else{
                $angka = 0;
            }

            foreach ($transaksi as $dt) {
                foreach($jlh as $n){
                    $bobot = $dt->bobot_item; 

                    if($dt->level_user == 'user'){
                        $data1 = $n->sum + $angka;
                        $hasil_akhir = $data1*$bobot/100;
                    }
                    elseif($dt->level_user == 'user1'){
                        $hasil_akhir = $angka*$bobot/100;
                    }

                }
            }

            Transaksi::create([
                'id_item' => $id,
                'id_user' =>  Auth::guard('web')->user()->id,
                'nilai_field1' => $angka,
            ]);

            $update = DB::table('item_penilaian')
            ->where('id_item', '=', $id)
            ->update([
                'nilai' => $hasil_akhir
            ]);

        }elseif($request->tipe == 4){
            Transaksi::create([
                'id_item' => $id,
                'id_user' =>  Auth::guard('web')->user()->id,
                'nilai_field1' => $request->field1,
                'nilai_field2' => $request->field2,
                'nilai_field3' => $request->field3,
                'nilai_field4' => $request->field4,
                'nilai_field5' => $request->field5,
            ]);

            foreach ($transaksi as $dt) {
                $data = $request->field3;
                $bobot = $dt->bobot_item;
                $hasil_akhir = $data*$bobot/100;
            }
            
            $update = DB::table('item_penilaian')
            ->where('id_item', '=', $id)
            ->update([
                'nilai' => $hasil_akhir
            ]);
        }elseif($request->tipe == 5){
            Transaksi::create([
                'id_item' => $id,
                'id_user' =>  Auth::guard('web')->user()->id,
                'nilai_field1' => $request->field1,
                'nilai_field2' => $request->field2,
            ]);

            foreach ($transaksi as $dt) {
                foreach($jlh as $n){
                    $data1 = $request->field2;
                    $bobot = $dt->bobot_item; 

                    if($dt->level_user == 'user'){
                        $data = $n->sum + $request->field1;
                    }
                    else{
                        $data = $request->field1;
                    }
                }
            }

            $hasil = ($data1!=0)?($data/$data1)*1:0;

            if($hasil>=50){
                $nilai = 100;
            }
            elseif($hasil<=50){
                $nilai = 25;
            }

            $hasil_akhir = $nilai*$bobot/100;

            $update = DB::table('item_penilaian')
            ->where('id_item', '=', $id)
            ->update([
                'nilai' => $hasil_akhir
            ]);
        }

        return redirect('_ikp')->with('success', 'Data Berhasil Ditambahkan!');
    }

    public function store_selaras (Request $request, $id)
    {

        $id_item = $request->id_item;
        $id_opd = $request->id_opd;
        $kode_rekening = $request->kode_rekening;
        $status = $request->status;

        $jl_data = count($id_opd);

        if(is_array($status) && count($status)==$jl_data){
            for($i=0;$i<count($id_opd);$i++){      
                $datasave = [
                    'id_item' => $id_item[$i],
                    'id_opd' => $id_opd[$i],
                    'kode_rekening' => $kode_rekening[$i],
                    'status' => $status[$i],
                ];
                DB::table('keselarasan')->insert($datasave);
            }
        }else{
            return redirect()->back()->with('warning', 'Jumlah inputan tidak sesuai');
        }

        return redirect()->action([ItemController::class, 'index'], ['nama' => 'konsistensi', 'id' => '13'])->with('success', 'Data Berhasil Ditambah');
    }

    public function update_selaras (Request $request, $id)
    {

        $id = $request->id_selaras;
        $id_item = $request->id_item;
        $id_opd = $request->id_opd;
        $kode_rekening = $request->kode_rekening;
        $status = $request->status;

        for($i=0;$i<count($id_opd);$i++){
            $datasave = [
                'id_item' => $id_item[$i],
                'id_opd' => $id_opd[$i],
                'kode_rekening' => $kode_rekening[$i],
                'status' => $status[$i],
            ];
            DB::table('keselarasan')->where('id_selaras', $id[$i])->update($datasave);
        }
        
        return redirect()->action([ItemController::class, 'index'], ['nama' => 'konsistensi', 'id' => '13'])->with('success', 'Data Berhasil Diubah');
    }


    public function store_file(Request $request, $id)
    {

        $file = $request->file('file');
        $dokumen = $file->getClientOriginalName();
        $file->move(public_path() . '/color-admin/assets/dokumen', $dokumen);

        Pendukung::create([
            'id_item' => $id,
            'id_user' =>  Auth::guard('web')->user()->id,
            'label_file' => $request->label_file,
            'file' => $dokumen,
        ]);

        return redirect()->action([ItemController::class, 'index'], ['id' => $id])->with('success', 'File Berhasil Ditambah');
    }

    public function update_file(Request $request, $id)
    {

        $file = $request->file('file');
        $dokumen = $file->getClientOriginalName();
        $file->move(public_path() . '/color-admin/assets/dokumen', $dokumen);

        $update = DB::table('pendukung')
        ->where('id_pendukung', '=', $id)
        ->update([
            'label_file' => $request->label_file,
            'file' => $dokumen,
        ]);

        $n = DB::table('pendukung')
        ->where('id_pendukung', '=', $id)
        ->first();

        return redirect()->action([ItemController::class, 'show'], ['id' => $n->id_item])->with('success', 'File Berhasil Diubah');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = DB::table('item_penilaian')
        ->where('id_item','=', $id)
        ->get();

        $transaksi = DB::table('transaksi')
        ->join ('item_penilaian', 'transaksi.id_item', '=', 'item_penilaian.id_item')
        ->where('transaksi.id_item','=', $id)
        ->where('id_user', '=', Auth::guard('web')->user()->id)
        ->get();
        
        $file = DB::table('pendukung')
        ->join ('item_penilaian', 'pendukung.id_item', '=', 'item_penilaian.id_item')
        ->where('pendukung.id_item','=', $id)
        ->where('id_user', '=', Auth::guard('web')->user()->id)
        ->get();

        $adm_transaksi = DB::table('transaksi')
        ->join ('item_penilaian', 'transaksi.id_item', '=', 'item_penilaian.id_item')
        ->join ('users', 'transaksi.id_user', '=', 'users.id')
        ->where('transaksi.id_item','=', $id)
        ->get();
        
        $adm_file = DB::table('pendukung')
        ->join ('item_penilaian', 'pendukung.id_item', '=', 'item_penilaian.id_item')
        ->join ('users', 'pendukung.id_user', '=', 'users.id')
        ->where('pendukung.id_item','=', $id)
        ->get();

        return view('detail_item', compact('item', 'file', 'transaksi', 'adm_transaksi', 'adm_file'));
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
        $transaksi = DB::table('transaksi')
            ->join ('item_penilaian', 'transaksi.id_item', '=', 'item_penilaian.id_item')
            ->join ('dimensi', 'item_penilaian.id_dimensi', '=', 'dimensi.id')
            ->join ('ikp', 'dimensi.id_ikp', '=', 'ikp.id')
            ->where('transaksi.id_item','=', $id)
            ->get();

        $jlh = DB::table('transaksi')
            ->selectRaw('sum(transaksi.nilai_field1) as sum')
            ->where('transaksi.id_item','=', $id)
            ->get();    

        if($request->tipe == 1){

            foreach ($transaksi as $dt) {

                // if($dt->id_user == Auth::guard('web')->user()->id){
                //     Alert::error('Error', 'Sudah Input');
                //     return back();
                // } else{

                // dd($request->id_opd);
                $field1 = count($request->id_opd);

                if(!empty($request->input('id_opd'))){
                    $checkbox = join(',', $request->input('id_opd'));
                }else{
                    $checkbox = '';
                }  

                $update = DB::table('transaksi')
                ->join('item_penilaian', 'transaksi.id_item', '=', 'item_penilaian.id_item')
                ->where('transaksi.id_item', '=', $id)
                ->where('transaksi.id_user', '=', Auth::guard('web')->user()->id)
                ->update([
                    'opd' => $checkbox,
                    'nilai_field1' => $field1,
                    'nilai_field2' => $request->field2,
                ]);


                foreach($jlh as $n){

                    $data1 = $request->field2;
                    $bobot = $dt->bobot_item; 
                    $data = $field1;

                    $hasil = ($data1!=0)?($data/$data1)*1:0;
                    $hasil_akhir = $hasil*$bobot/100;
                }
            }
            
            $update = DB::table('item_penilaian')
            ->where('id_item', '=', $id)
            ->update([
                'nilai' => $hasil_akhir
            ]);

        }elseif($request->tipe == 2){
            $update = DB::table('transaksi')
            ->join('item_penilaian', 'transaksi.id_item', '=', 'item_penilaian.id_item')
            ->where('transaksi.id_item', '=', $id)
            ->where('transaksi.id_user', '=', Auth::guard('web')->user()->id)
            ->update([
                'nilai_field1' => $request->field1,
                'nilai_field2' => $request->field2,
            ]);

            foreach ($transaksi as $dt) {
                foreach($jlh as $n){
                    $data1 = $request->field2;
                    $bobot = $dt->bobot_item; 

                    if($dt->level_user == 'user'){
                        $data = $n->sum + $request->field1;
                    }
                    else{
                        $data = $request->field1;
                    }
                    
                    $hasil = ($data1!=0)?($data/$data1)*1:0;
                    $hasil_akhir = $hasil*$bobot/100;
                }
            }
            
            $update = DB::table('item_penilaian')
            ->where('id_item', '=', $id)
            ->update([
                'nilai' => $hasil_akhir
            ]);

        }elseif($request->tipe == 3){

            $data = $request->option;
            if($data == "Tepat Waktu"){
                $angka = 100;
            }
            elseif($data == "Ada"){
                $angka = 100;
            }
            else{
                $angka = 0;
            }

            foreach ($transaksi as $dt) {
                foreach($jlh as $n){
                    $bobot = $dt->bobot_item; 

                    if($dt->level_user == 'user'){
                        $data1 = $n->sum + $angka;
                        $hasil_akhir = $data1*$bobot/100;
                    }
                    elseif($dt->level_user == 'user1'){
                        $hasil_akhir = $angka*$bobot/100;
                    }
                }
            }
            
            $update = DB::table('item_penilaian')
            ->where('id_item', '=', $id)
            ->update([
                'nilai' => $hasil_akhir
            ]);
            
            $update = DB::table('transaksi')
                ->join('item_penilaian', 'transaksi.id_item', '=', 'item_penilaian.id_item')
                ->where('transaksi.id_item', '=', $id)
                ->where('transaksi.id_user', '=', Auth::guard('web')->user()->id)
                ->update([
                    'nilai_field1' => $angka,
                ]);

        }elseif($request->tipe == 4){
            $update = DB::table('transaksi')
                ->join('item_penilaian', 'transaksi.id_item', '=', 'item_penilaian.id_item')
                ->where('transaksi.id_item', '=', $id)
                ->where('transaksi.id_user', '=', Auth::guard('web')->user()->id)
                ->update([
                    'nilai_field1' => $request->field1,
                    'nilai_field2' => $request->field2,
                    'nilai_field3' => $request->field3,
                    'nilai_field4' => $request->field4,
            ]);
    
            foreach ($transaksi as $dt) {
                $data = $request->field3;
                $bobot = $dt->bobot_item;
                $hasil_akhir = $data*$bobot/100;
            }
            
            $update = DB::table('item_penilaian')
            ->where('id_item', '=', $id)
            ->update([
                'nilai' => $hasil_akhir
            ]);
            
        }elseif($request->tipe == 5){
            $update = DB::table('transaksi')
                ->join('item_penilaian', 'transaksi.id_item', '=', 'item_penilaian.id_item')
                ->where('transaksi.id_item', '=', $id)
                ->where('transaksi.id_user', '=', Auth::guard('web')->user()->id)
                ->update([
                    'nilai_field1' => $request->field1,
                    'nilai_field2' => $request->field2,
            ]);

            foreach ($transaksi as $dt) {
                foreach($jlh as $n){
                    $data1 = $request->field2;
                    $bobot = $dt->bobot_item; 

                    if($dt->level_user == 'user'){
                        $data = $n->sum + $request->field1;
                    }
                    else{
                        $data = $request->field1;
                    }
                }
            }

            $hasil = ($data1!=0)?($data/$data1)*1:0;

            if($hasil>=50){
                $nilai = 100;
            }
            elseif($hasil<=50){
                $nilai = 25;
            }

            $hasil_akhir = $nilai*$bobot/100;

            $update = DB::table('item_penilaian')
            ->where('id_item', '=', $id)
            ->update([
                'nilai' => $hasil_akhir
            ]);
        }
        
        return redirect('_ikp')->with('success', 'Data Berhasil Diubah!');
    }

    public function download($file)
    {
        $file_path = public_path('/color-admin/assets/dokumen/'.$file);
        return response()->download($file_path);
    }

    public function hapus_file($id, $nama)
    {        
        if(File::exists(public_path('/color-admin/assets/dokumen/'.$nama))){
            File::delete(public_path('/color-admin/assets/dokumen/'.$nama));
            Pendukung::where('id_pendukung',$id)->delete();
        }elseif($id == 'kosong'){
            return redirect()->back()->with('warning', 'File tidak ada');
        }

        return back();

    }

    public function get_value($id)
    {
        $dt_ada = DB::table('keselarasan')
        ->where('id_item', '=', $id)
        ->where('status', '=', 'Ada')
        ->count();

        $dt_tdk = DB::table('keselarasan')
        ->where('id_item', '=', $id)
        ->where('status', '=', 'Tidak')
        ->count();

        dd($dt_ada);
        
        return Response::json(['success'=>true, 'info'=>$dt_ada]);
    }
}
