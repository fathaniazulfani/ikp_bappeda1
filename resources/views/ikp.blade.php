@extends('layout.index')

@section('title','Indeks Kualitas Perencanaan')
@section('breadcrumb')
<ol class="breadcrumb pull-right">
    <li class="active">Indeks Kualitas Perencanaan</li>
</ol>
@endsection
@section('container')
            <!-- begin row -->
            <div class="row">
			    <!-- begin col-12 -->
			    <div class="col-md-12">
			        <!-- begin panel -->
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            @foreach($d_ikp as $i)
                            <h4 class="panel-title">Indeks Kualitas Perencanaan Tahun <?php echo $i->tahun ?></h4>
                            @endforeach
                        </div>
                        <div class="panel-body">
                        @if (auth()->user()->level=="admin") 
                        <div class="row">
                            <div class="col-md-8">
                                <form action="{{route('_ikp')}}" method="POST" class="form-horizontal">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Pilih Tahun</label>
                                        <div class="col-md-3">
                                            <select class="form-control" name="tahun">
                                                @foreach($tahun as $thn)
                                                    @foreach($d_ikp as $d)
                                                    <option value="{{$thn->tahun}}" {{old('tahun', $thn->tahun) == $d->tahun ? 'selected' : ''}}>{{$thn->tahun}}</option>
                                                    @endforeach
                                                @endforeach
                                            </select>
                                        </div>
                                        <div>
                                            <button type="submit" class="btn btn-sm btn-success">Submit</button>
                                        </div>
                                    </div>
                                </form>                           
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                @foreach($d_ikp as $i)
                                <!-- <a href="/cetak_ikp/excel/{{$i->tahun}}" class="color-success">
                                    <button type="button" style="float:right; width:90px;margin:5px" class="btn btn-sm btn-white">Export Excel</button>
                                </a> -->
                                <a href="/cetak_ikp/pdf/{{$i->tahun}}" class="color-success">
                                    <button type="button" style="float:right; width:80px;margin:5px" class="btn btn-sm btn-white">Cetak PDF</button>
                                </a>
                                @endforeach
                                <!-- <a href="#" class="color-success">
                                    <button type="button" style="float:right; width:80px;margin:5px" class="btn btn-sm btn-primary">Input Data</button>
                                </a> -->
                            </div>
                        </div>
                            <table id="data-table" class="table table-bordered table-responsive">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th width="120px">Dimensi Penilaian</th>
                                        <th>Bobot</th>
                                        <th>Nilai</th>
                                        <th width="120px">Sub Dimensi</th>
                                        <th>Bobot</th>
                                        <th>Nilai</th>
                                        <th width="270px">Item Penilaian</th>
                                        <th width="50px">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td rowspan="10">1</td>
                                        <td rowspan="10">Proses</td>
                                        <td rowspan="10">30%</td>
                                        @foreach($n_dimensi as $n)
                                        <?php $ket = "Proses"; ?>
                                        @if($n->nama_dimensi == $ket)
                                            <!-- bobot 20% -->
                                        <td rowspan="10">{{number_format($n->sum, 2, '.', '');}}</td>
                                        @endif
                                        @endforeach
                                        <td rowspan="2">Forum OPD</td>
                                        <td rowspan="2">5%</td>
                                        @foreach($n_sub as $n)
                                        <?php $ket = "Forum OPD"; ?>
                                        @if($n->nama_sub == $ket)
                                            <!-- bobot 5% -->
                                        <td rowspan="2">{{number_format($n->sum, 2, '.', '');}}</td>
                                        @endif
                                        @endforeach
                                        <td>Persentase OPD yang melaksanakan Forum OPD</td>
                                        <td>
                                        @foreach ($item_penilaian as $dt)
                                            <?php $ket = "Persentase OPD yang melaksanakan Forum OPD"; ?>
                                            @if($dt->nama_item == $ket)
                                            <a href="/detail_item/{{$dt->id_item}}" class="btn btn-warning btn-icon btn-circle btn-sm"><i class="fa fa-eye"></i></a>
                                            <button type="submit" class="btn btn-primary btn-icon btn-circle btn-sm" disabled><i class="fa fa-plus"></i></button>
                                            @endif   
                                         @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Ketepatan Waktu Pelaksanaan Forum OPD</td>
                                        <td>
                                        @foreach ($item_penilaian as $dt)
                                            <?php $ket = "Ketepatan waktu pelaksanaan Forum OPD"; ?>
                                            @if($dt->nama_item == $ket)
                                            <a href="/detail_item/{{$dt->id_item}}" class="btn btn-warning btn-icon btn-circle btn-sm" data-toggle="modal"><i class="fa fa-eye"></i></a>
                                            <button type="submit" class="btn btn-primary btn-icon btn-circle btn-sm" disabled><i class="fa fa-plus"></i></button>
                                            @endif   
                                         @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td rowspan="4">Konsultasi Publik</td>
                                        <td rowspan="4">10%</td>
                                        @foreach($n_sub as $n)
                                        <?php $ket = "Konsultasi Publik"; ?>
                                        @if($n->nama_sub == $ket)
                                            <!-- bobot 10% -->
                                        <td rowspan="4">{{number_format($n->sum, 2, '.', '');}}</td>
                                        @endif
                                        @endforeach
                                        <td>Tingkat Kehadiran Pemangku Kepentingan dalam Konsultasi Publik</td>
                                        <td>
                                        @foreach ($item_penilaian as $dt)
                                            <?php $ket = "Tingkat Kehadiran Pemangku Kepentingan dalam Konsultasi Publik"; ?>
                                            @if($dt->nama_item == $ket)
                                            <a href="/detail_item/{{$dt->id_item}}" class="btn btn-warning btn-icon btn-circle btn-sm" data-toggle="modal"><i class="fa fa-eye"></i></a>
                                            <button type="submit" class="btn btn-primary btn-icon btn-circle btn-sm" disabled><i class="fa fa-plus"></i></button>
                                            @endif   
                                         @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tingkat Partisipasi Aktif Pemangku Kepentingan dalam Konsultasi Publik</td>
                                        <td>
                                        <a href="/detail_item/{{$dt->id_item}}" class="btn btn-warning btn-icon btn-circle btn-sm"><i class="fa fa-eye"></i></a>
                                        <button type="submit" class="btn btn-primary btn-icon btn-circle btn-sm" disabled><i class="fa fa-plus"></i></button>    
                                    </td>
                                    </tr>
                                    <tr>
                                        <td>Ketepatan Waktu Pelaksanaan Konsultasi Publik</td>
                                        <td>
                                        <a href="/detail_item/{{$dt->id_item}}" class="btn btn-warning btn-icon btn-circle btn-sm"><i class="fa fa-eye"></i></a>
                                        <button type="submit" class="btn btn-primary btn-icon btn-circle btn-sm" disabled><i class="fa fa-plus"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Pelaksanaan Konsultasi Publik</td>
                                        <td>
                                        <a href="/detail_item/{{$dt->id_item}}" class="btn btn-warning btn-icon btn-circle btn-sm"><i class="fa fa-eye"></i></a>
                                        <button type="submit" class="btn btn-primary btn-icon btn-circle btn-sm" disabled><i class="fa fa-plus"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td rowspan="4">Musrenbang Provinsi</td>
                                        <td rowspan="4">15%</td>
                                        @foreach($n_sub as $n)
                                            <?php $ket = "Musrenbang Provinsi"; ?>
                                            @if($n->nama_sub == $ket)
                                            <!-- bobot 15% -->
                                            <td rowspan="4">{{number_format($n->sum, 2, '.', '');}}</td>
                                            @endif
                                        @endforeach
                                        <td>Tingkat Kehadiran Pemangku Kepentingan dalam Musrenbang</td>
                                        <td>
                                        <a href="/detail_item/{{$dt->id_item}}" class="btn btn-warning btn-icon btn-circle btn-sm"><i class="fa fa-eye"></i></a>
                                        <button type="submit" class="btn btn-primary btn-icon btn-circle btn-sm" disabled><i class="fa fa-plus"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tingkat Partisipasi Pemangku Kepentingan dalam Musrenbang</td>
                                        <td>
                                        <a href="/detail_item/{{$dt->id_item}}" class="btn btn-warning btn-icon btn-circle btn-sm"><i class="fa fa-eye"></i></a>
                                        <button type="submit" class="btn btn-primary btn-icon btn-circle btn-sm" disabled><i class="fa fa-plus"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Ketepatan waktu pelaksanaan Musrenbang Provinsi</td>
                                        <td>
                                        <a href="/detail_item/{{$dt->id_item}}" class="btn btn-warning btn-icon btn-circle btn-sm"><i class="fa fa-eye"></i></a>
                                        <button type="submit" class="btn btn-primary btn-icon btn-circle btn-sm" disabled><i class="fa fa-plus"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Pelaksanaan Musrebang</td>
                                        <td>
                                        <a href="/detail_item/{{$dt->id_item}}" class="btn btn-warning btn-icon btn-circle btn-sm"><i class="fa fa-eye"></i></a>
                                        <button type="submit" class="btn btn-primary btn-icon btn-circle btn-sm" disabled><i class="fa fa-plus"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td rowspan="5">2</td>
                                        <td rowspan="5">Isi</td>
                                        <td rowspan="5">40%</td>
                                        @foreach($n_dimensi as $n)
                                        <?php $ket = "Isi"; ?>
                                        @if($n->nama_dimensi == $ket)
                                            <!-- bobot 20% -->
                                        <td rowspan="5">{{number_format($n->sum, 2, '.', '');}}</td>
                                        @endif
                                        @endforeach
                                        <td rowspan="2">Data Pendukung</td>
                                        <td rowspan="2">15%</td>
                                        @foreach($n_sub as $n)
                                            <?php $ket = "Data Pendukung"; ?>
                                            @if($n->nama_sub == $ket)
                                            <!-- bobot 15% -->
                                            <td rowspan="2">{{number_format($n->sum, 2, '.', '');}}</td>
                                            @endif
                                        @endforeach
                                        <td>Persentase ketersediaan data IKU </td>
                                        <td>
                                        <a href="/detail_item/{{$dt->id_item}}" class="btn btn-warning btn-icon btn-circle btn-sm"><i class="fa fa-eye"></i></a>
                                        <button type="submit" class="btn btn-primary btn-icon btn-circle btn-sm" disabled><i class="fa fa-plus"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Persentase ketersediaan data IKD</td>
                                        <td>
                                        <a href="/detail_item/{{$dt->id_item}}" class="btn btn-warning btn-icon btn-circle btn-sm"><i class="fa fa-eye"></i></a>
                                        <button type="submit" class="btn btn-primary btn-icon btn-circle btn-sm" disabled><i class="fa fa-plus"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td rowspan="2">Konsistensi</td>
                                        <td rowspan="2">20%</td>
                                        @foreach($n_sub as $n)
                                        <?php $ket = "Konsistensi"; ?>
                                        @if($n->nama_sub == $ket)
                                            <!-- bobot 20% -->
                                        <td rowspan="2">{{number_format($n->sum, 2, '.', '');}}</td>
                                        @endif
                                        @endforeach
                                        <td>Keselarasan Program antara RKPD dengan RPJMD</td>
                                        <td>
                                        @foreach ($item_penilaian as $dt)
                                            <?php $ket = "Keselarasan Program antara RKPD dengan RPJMD"; ?>
                                            @if($dt->nama_item == $ket)
                                            <a href="/detail_item/{{$dt->id_item}}" class="btn btn-warning btn-icon btn-circle btn-sm"><i class="fa fa-eye"></i></a>
                                            <a href="/item/{{$dt->id_item}}" class="btn btn-primary btn-icon btn-circle btn-sm"><i class="fa fa-plus"></i></a>
                                            @endif   
                                         @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Konsistensi anggaran per Program antara RKPD dengen RPJMD</td>
                                        <td>
                                        @foreach ($item_penilaian as $dt)
                                            <?php $ket = "Konsistensi anggaran per Program antara RKPD dengen RPJMD"; ?>
                                            @if($dt->nama_item == $ket)
                                            <a href="/detail_item/{{$dt->id_item}}" class="btn btn-warning btn-icon btn-circle btn-sm"><i class="fa fa-eye"></i></a>
                                            <a href="/item/{{$dt->id_item}}" class="btn btn-primary btn-icon btn-circle btn-sm"><i class="fa fa-plus"></i></a>
                                            @endif   
                                         @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Inovasi</td>
                                        <td>5%</td>
                                        @foreach($n_sub as $n)
                                        <?php $ket = "Inovasi"; ?>
                                        @if($n->nama_sub == $ket)
                                            <!-- bobot 5% -->
                                        <td>{{number_format($n->sum, 2, '.', '');}}</td>
                                        @endif
                                        @endforeach
                                        <td>Ketersediaan Inovasi dalam Dokumen Perencanaan</td>
                                        <td>
                                        @foreach ($item_penilaian as $dt)
                                            <?php $ket = "Ketersediaan Inovasi dalam Dokumen Perencanaan"; ?>
                                            @if($dt->nama_item == $ket)
                                            <a href="/detail_item/{{$dt->id_item}}" class="btn btn-warning btn-icon btn-circle btn-sm"><i class="fa fa-eye"></i></a>
                                            <button type="submit" class="btn btn-primary btn-icon btn-circle btn-sm" disabled><i class="fa fa-plus"></i></button>
                                            @endif   
                                         @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td rowspan="4">3</td>
                                        <td rowspan="4">Tindak Lanjut</td>
                                        <td rowspan="4">30%</td>
                                        @foreach($n_dimensi as $n)
                                        <?php $ket = "Tindak Lanjut"; ?>
                                        @if($n->nama_dimensi == $ket)
                                        <td rowspan="4">{{number_format($n->sum, 2, '.', '');}}</td>
                                        @endif
                                        @endforeach
                                        <td rowspan="2">Capaian Kinerja</td>
                                        <td rowspan="2">15%</td>
                                        @foreach($n_sub as $n)
                                        <?php $ket = "Capaian Kinerja"; ?>
                                        @if($n->nama_sub == $ket)
                                        <td rowspan="2">{{number_format($n->sum, 2, '.', '');}}</td>
                                        @endif
                                        @endforeach
                                        <td>Persentase capaian IKU </td>
                                        <td>
                                        @foreach ($item_penilaian as $dt)
                                            <?php $ket = "Persentase capaian IKU"; ?>
                                            @if($dt->nama_item == $ket)
                                            <a href="/detail_item/{{$dt->id_item}}" class="btn btn-warning btn-icon btn-circle btn-sm"><i class="fa fa-eye"></i></a>
                                            <a href="/item/{{$dt->id_item}}" class="btn btn-primary btn-icon btn-circle btn-sm"><i class="fa fa-plus"></i></a>
                                            @endif   
                                         @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Persentase capaian IKD</td>
                                        <td>
                                        @foreach ($item_penilaian as $dt)
                                            <?php $ket = "Persentase capaian IKD"; ?>
                                            @if($dt->nama_item == $ket)
                                            <a href="/detail_item/{{$dt->id_item}}" class="btn btn-warning btn-icon btn-circle btn-sm"><i class="fa fa-eye"></i></a>
                                            <a href="/item/{{$dt->id_item}}" class="btn btn-primary btn-icon btn-circle btn-sm"><i class="fa fa-plus"></i></a>
                                            @endif   
                                         @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Pengendalian Rencana Kerja</td>
                                        <td>10%</td>
                                        @foreach($n_sub as $n)
                                        <?php $ket = "Pengendalian Rencana Kerja"; ?>
                                        @if($n->nama_sub == $ket)
                                        <td>{{number_format($n->sum, 2, '.', '');}}</td>
                                        @endif
                                        @endforeach
                                        <td>Persentase Rekomendasi Hasil Evaluasi yang Ditindaklanjuti oleh OPD</td>
                                        <td>
                                        @foreach ($item_penilaian as $dt)
                                            <?php $ket = "Persentase Rekomendasi Hasil Evaluasi yang Ditindaklanjuti oleh OPD"; ?>
                                            @if($dt->nama_item == $ket)
                                            <a href="/detail_item/{{$dt->id_item}}" class="btn btn-warning btn-icon btn-circle btn-sm"><i class="fa fa-eye"></i></a>
                                            <a href="/item/{{$dt->id_item}}" class="btn btn-primary btn-icon btn-circle btn-sm"><i class="fa fa-plus"></i></a>
                                            @endif   
                                         @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Penganggaran</td>
                                        <td>5%</td>
                                        @foreach($n_sub as $n)
                                        <?php $ket = "Penganggaran"; ?>
                                        @if($n->nama_sub == $ket)
                                        <td>{{number_format($n->sum, 2, '.', '');}}</td>
                                        @endif
                                        @endforeach
                                        <td>Persentase prioritas pembangunan pada RPJMD menjadi anggaran prioritas dalam RKPD</td>
                                        <td>
                                        @foreach ($item_penilaian as $dt)
                                            <?php $ket = "Persentase prioritas pembangunan pada RPJMD menjadi anggaran prioritas dalam RKPD"; ?>
                                            @if($dt->nama_item == $ket)
                                            <a href="/detail_item/{{$dt->id_item}}" class="btn btn-warning btn-icon btn-circle btn-sm"><i class="fa fa-eye"></i></a>
                                            <a href="/item/{{$dt->id_item}}" class="btn btn-primary btn-icon btn-circle btn-sm"><i class="fa fa-plus"></i></a>
                                            @endif   
                                         @endforeach
                                        </td>
                                    </tr>
                                    <tr style="font-size:14px">
                                        <td colspan="3">INDEKS KUALITAS PERENCANAAN</td>
                                        @foreach($n_ikp as $n)
                                        <td colspan="6"><b>{{number_format($n->sum, 2, '.', '');}}<b></td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end panel -->
                    @endif
                    @if (auth()->user()->level=="user") 
                    <!-- start panel -->
                    <div class="col-md-8">
                        <form action="{{route('_ikp')}}" method="POST" class="form-horizontal">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Pilih Tahun</label>
                                    <div class="col-md-3">
                                        <select class="form-control" name="tahun">
                                            @foreach($tahun as $thn)
                                                @foreach($d_ikp as $d)
                                                <option value="{{$thn->tahun}}" {{old('tahun', $thn->tahun) == $d->tahun ? 'selected' : ''}}>{{$thn->tahun}}</option>
                                                @endforeach
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-sm btn-success">Submit</button>
                                    </div>
                                </div>
                            </form>                           
                            </div>
                            <table id="data-table" class="table table-bordered table-responsive">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Dimensi Penilaian</th>
                                        <th>Bobot</th>
                                        <th>Nilai</th>
                                        <th width="120px">Sub Dimensi</th>
                                        <th>Bobot</th>
                                        <th>Nilai</th>
                                        <th width="260px">Item Penilaian</th>
                                        <th width="50px">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td rowspan="3">1</td>
                                        <td rowspan="3">Isi</td>
                                        <td rowspan="3">40%</td>
                                         @foreach($n_dimensi as $n)
                                        <?php $ket = "Isi"; ?>
                                        @if($n->nama_dimensi == $ket)
                                        <td rowspan="3">{{number_format($n->sum, 2, '.', '');}}</td>
                                        @endif
                                        @endforeach
                                        <td rowspan="2">Konsistensi</td>
                                        <td rowspan="2">20%</td>
                                        @foreach($n_sub as $n)
                                        <?php $ket = "Konsistensi"; ?>
                                        @if($n->nama_sub == $ket)
                                            <!-- bobot 20% -->
                                        <td rowspan="2">{{number_format($n->sum, 2, '.', '');}}</td>
                                        @endif
                                        @endforeach
                                        <td>Keselarasan Program antara RKPD dengan RPJMD</td>
                                        <td>
                                        @foreach ($item_penilaian as $dt)
                                            <?php $ket = "Keselarasan Program antara RKPD dengan RPJMD"; ?>
                                            @if($dt->nama_item == $ket)
                                            <a href="/detail_item/{{$dt->id_item}}" class="btn btn-warning btn-icon btn-circle btn-sm" data-toggle="modal"><i class="fa fa-eye"></i></a>
                                            <a href="/item/{{$dt->id_item}}" class="btn btn-primary btn-icon btn-circle btn-sm"><i class="fa fa-plus"></i></a>
                                            @endif   
                                         @endforeach
                                        </td>
                                    <tr>
                                        <td>Konsistensi anggaran per Program antara RKPD dengen RPJMD</td>
                                        <td>
                                        @foreach ($item_penilaian as $dt)
                                            <?php $ket = "Konsistensi anggaran per Program antara RKPD dengen RPJMD"; ?>
                                            @if($dt->nama_item == $ket)
                                            <a href="/detail_item/{{$dt->id_item}}" class="btn btn-warning btn-icon btn-circle btn-sm" data-toggle="modal"><i class="fa fa-eye"></i></a>
                                            <a href="/item/{{$dt->id_item}}" class="btn btn-primary btn-icon btn-circle btn-sm"><i class="fa fa-plus"></i></a>
                                            @endif   
                                         @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Inovasi</td>
                                        <td>5%</td>
                                        @foreach($n_sub as $n)
                                        <?php $ket = "Inovasi"; ?>
                                        @if($n->nama_sub == $ket)
                                            <!-- bobot 5% -->
                                        <td>{{number_format($n->sum, 2, '.', '');}}</td>
                                        @endif
                                        @endforeach
                                        <td>Ketersediaan Inovasi dalam Dokumen Perencanaan</td>
                                        <td>
                                        @foreach ($item_penilaian as $dt)
                                            <?php $ket = "Ketersediaan Inovasi dalam Dokumen Perencanaan"; ?>
                                            @if($dt->nama_item == $ket)
                                            <a href="/detail_item/{{$dt->id_item}}" class="btn btn-warning btn-icon btn-circle btn-sm" data-toggle="modal"><i class="fa fa-eye"></i></a>
                                            <a href="/item/{{$dt->id_item}}" class="btn btn-primary btn-icon btn-circle btn-sm"><i class="fa fa-plus"></i></a>
                                            @endif   
                                         @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td rowspan="4">2</td>
                                        <td rowspan="4">Tindak Lanjut</td>
                                        <td rowspan="4">30%</td>
                                        @foreach($n_dimensi as $n)
                                        <?php $ket = "Tindak Lanjut"; ?>
                                        @if($n->nama_dimensi == $ket)
                                            <!-- bobot 20% -->
                                        <td rowspan="4">{{number_format($n->sum, 2, '.', '');}}</td>
                                        @endif
                                        @endforeach
                                        <td rowspan="2">Capaian Kinerja</td>
                                        <td rowspan="2">15%</td>
                                        @foreach($n_sub as $n)
                                        <?php $ket = "Capaian Kinerja"; ?>
                                        @if($n->nama_sub == $ket)
                                            <!-- bobot 15% -->
                                        <td rowspan="2">{{number_format($n->sum, 2, '.', '');}}</td>
                                        @endif
                                        @endforeach
                                        <td>Persentase capaian IKU </td>
                                        <td>
                                        @foreach ($item_penilaian as $dt)
                                            <?php $ket = "Persentase capaian IKU"; ?>
                                            @if($dt->nama_item == $ket)
                                            <a href="/detail_item/{{$dt->id_item}}" class="btn btn-warning btn-icon btn-circle btn-sm" data-toggle="modal"><i class="fa fa-eye"></i></a>
                                            <a href="/item/{{$dt->id_item}}" class="btn btn-primary btn-icon btn-circle btn-sm"><i class="fa fa-plus"></i></a>
                                            @endif   
                                         @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Persentase capaian IKD</td>
                                        <td>
                                        @foreach ($item_penilaian as $dt)
                                            <?php $ket = "Persentase capaian IKD"; ?>
                                            @if($dt->nama_item == $ket)
                                            <a href="/detail_item/{{$dt->id_item}}" class="btn btn-warning btn-icon btn-circle btn-sm" data-toggle="modal"><i class="fa fa-eye"></i></a>
                                            <a href="/item/{{$dt->id_item}}" class="btn btn-primary btn-icon btn-circle btn-sm"><i class="fa fa-plus"></i></a>
                                            @endif   
                                         @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Pengendalian Rencana Kerja</td>
                                        <td>10%</td>
                                        @foreach($n_sub as $n)
                                        <?php $ket = "Pengendalian Rencana Kerja"; ?>
                                        @if($n->nama_sub == $ket)
                                            <!-- bobot 10% -->
                                        <td>{{number_format($n->sum, 2, '.', '');}}</td>
                                        @endif
                                        @endforeach
                                        <td>Persentase Rekomendasi Hasil Evaluasi yang Ditindaklanjuti oleh OPD</td>
                                        <td>
                                        @foreach ($item_penilaian as $dt)
                                            <?php $ket = "Persentase Rekomendasi Hasil Evaluasi yang Ditindaklanjuti oleh OPD"; ?>
                                            @if($dt->nama_item == $ket)
                                            <a href="/detail_item/{{$dt->id_item}}" class="btn btn-warning btn-icon btn-circle btn-sm" data-toggle="modal"><i class="fa fa-eye"></i></a>
                                            <a href="/item/{{$dt->id_item}}" class="btn btn-primary btn-icon btn-circle btn-sm"><i class="fa fa-plus"></i></a>
                                            @endif   
                                         @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Penganggaran</td>
                                        <td>5%</td>
                                        @foreach($n_sub as $n)
                                        <?php $ket = "Penganggaran"; ?>
                                        @if($n->nama_sub == $ket)
                                            <!-- bobot 5% -->
                                        <td>{{number_format($n->sum, 2, '.', '');}}</td>
                                        @endif
                                        @endforeach
                                        <td>Persentase prioritas pembangunan pada RPJMD menjadi anggaran prioritas dalam RKPD</td>
                                        <td>
                                        @foreach ($item_penilaian as $dt)
                                            <?php $ket = "Persentase prioritas pembangunan pada RPJMD menjadi anggaran prioritas dalam RKPD"; ?>
                                            @if($dt->nama_item == $ket)
                                            <a href="/detail_item/{{$dt->id_item}}" class="btn btn-warning btn-icon btn-circle btn-sm" data-toggle="modal"><i class="fa fa-eye"></i></a>
                                            <a href="/item/{{$dt->id_item}}" class="btn btn-primary btn-icon btn-circle btn-sm"><i class="fa fa-plus"></i></a>
                                            @endif   
                                         @endforeach
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end panel -->
                    @endif
                    
                    @if (auth()->user()->level=="user1") 
                        <div class="col-md-8">
                            <form action="{{route('_ikp')}}" method="POST" class="form-horizontal">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Pilih Tahun</label>
                                    <div class="col-md-3">
                                        <select class="form-control" name="tahun">
                                            @foreach($tahun as $thn)
                                                @foreach($d_ikp as $d)
                                                <option value="{{$thn->tahun}}" {{old('tahun', $thn->tahun) == $d->tahun ? 'selected' : ''}}>{{$thn->tahun}}</option>
                                                @endforeach
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-sm btn-success">Submit</button>
                                    </div>
                                </div>
                            </form>                           
                            </div>
                            <table id="data-table" class="table table-bordered table-responsive">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Dimensi Penilaian</th>
                                        <th>Bobot</th>
                                        <th>Nilai</th>
                                        <th width="120px">Sub Dimensi</th>
                                        <th>Bobot</th>
                                        <th>Nilai</th>
                                        <th width="270px">Item Penilaian</th>
                                        <th width="50px">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    <td rowspan="10">1</td>
                                        <td rowspan="10">Proses</td>
                                        <td rowspan="10">30%</td>
                                        @foreach($n_dimensi as $n)
                                        <?php $ket = "Proses"; ?>
                                        @if($n->nama_dimensi == $ket)
                                            <!-- bobot 20% -->
                                        <td rowspan="10">{{number_format($n->sum, 2, '.', '');}}</td>
                                        @endif
                                        @endforeach
                                        <td rowspan="2">Forum OPD</td>
                                        <td rowspan="2">5%</td>
                                        @foreach($n_sub as $n)
                                        <?php $ket = "Forum OPD"; ?>
                                        @if($n->nama_sub == $ket)
                                            <!-- bobot 5% -->
                                        <td rowspan="2">{{number_format($n->sum, 2, '.', '');}}</td>
                                        @endif
                                        @endforeach
                                        <td>Persentase OPD yang melaksanakan Forum OPD</td>
                                        <td>
                                        @foreach ($item_penilaian as $dt)
                                            <?php $ket = "Persentase OPD yang melaksanakan Forum OPD"; ?>
                                            @if($dt->nama_item == $ket)
                                            <a href="/detail_item/{{$dt->id_item}}" class="btn btn-warning btn-icon btn-circle btn-sm" data-toggle="modal"><i class="fa fa-eye"></i></a>
                                            <a href="/item/{{$dt->id_item}}" class="btn btn-primary btn-icon btn-circle btn-sm"><i class="fa fa-plus"></i></a>
                                            @endif   
                                         @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Ketepatan Waktu Pelaksanaan Forum OPD</td>
                                        <td>
                                        @foreach ($item_penilaian as $dt)
                                            <?php $ket = "Ketepatan waktu pelaksanaan Forum OPD"; ?>
                                            @if($dt->nama_item == $ket)
                                            <a href="/detail_item/{{$dt->id_item}}" class="btn btn-warning btn-icon btn-circle btn-sm" data-toggle="modal"><i class="fa fa-eye"></i></a>
                                            <a href="/item/{{$dt->id_item}}" class="btn btn-primary btn-icon btn-circle btn-sm"><i class="fa fa-plus"></i></a>
                                            @endif   
                                         @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td rowspan="4">Konsultasi Publik</td>
                                        <td rowspan="4">10%</td>
                                        @foreach($n_sub as $n)
                                        <?php $ket = "Konsultasi Publik"; ?>
                                        @if($n->nama_sub == $ket)
                                            <!-- bobot 10% -->
                                        <td rowspan="4">{{number_format($n->sum, 2, '.', '');}}</td>
                                        @endif
                                        @endforeach
                                        <td>Tingkat Kehadiran Pemangku Kepentingan dalam Konsultasi Publik</td>
                                        <td>
                                        @foreach ($item_penilaian as $dt)
                                            <?php $ket = "Tingkat Kehadiran Pemangku Kepentingan dalam Konsultasi Publik"; ?>
                                            @if($dt->nama_item == $ket)
                                            <a href="/detail_item/{{$dt->id_item}}" class="btn btn-warning btn-icon btn-circle btn-sm" data-toggle="modal"><i class="fa fa-eye"></i></a>
                                            <a href="/item/{{$dt->id_item}}" class="btn btn-primary btn-icon btn-circle btn-sm"><i class="fa fa-plus"></i></a>
                                            @endif   
                                         @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tingkat Partisipasi Aktif Pemangku Kepentingan dalam Konsultasi Publik</td>
                                        <td>
                                        @foreach ($item_penilaian as $dt)
                                            <?php $ket = "Tingkat Partisipasi Aktif Pemangku Kepentingan dalam Konsultasi Publik"; ?>
                                            @if($dt->nama_item == $ket)
                                            <a href="/detail_item/{{$dt->id_item}}" class="btn btn-warning btn-icon btn-circle btn-sm" data-toggle="modal"><i class="fa fa-eye"></i></a>
                                            <a href="/item/{{$dt->id_item}}" class="btn btn-primary btn-icon btn-circle btn-sm"><i class="fa fa-plus"></i></a>
                                            @endif   
                                         @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Ketepatan Waktu Pelaksanaan Konsultasi Publik</td>
                                        <td>
                                        @foreach ($item_penilaian as $dt)
                                            <?php $ket = "Ketepatan Waktu Pelaksanaan Konsultasi Publik"; ?>
                                            @if($dt->nama_item == $ket)
                                            <a href="/detail_item/{{$dt->id_item}}" class="btn btn-warning btn-icon btn-circle btn-sm" data-toggle="modal"><i class="fa fa-eye"></i></a>
                                            <a href="/item/{{$dt->id_item}}" class="btn btn-primary btn-icon btn-circle btn-sm"><i class="fa fa-plus"></i></a>
                                            @endif   
                                         @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Pelaksanaan Konsultasi Publik</td>
                                        <td>
                                        @foreach ($item_penilaian as $dt)
                                            <?php $ket = "Pelaksanaan Konsultasi Publik"; ?>
                                            @if($dt->nama_item == $ket)
                                            <a href="/detail_item/{{$dt->id_item}}" class="btn btn-warning btn-icon btn-circle btn-sm" data-toggle="modal"><i class="fa fa-eye"></i></a>
                                            <a href="/item/{{$dt->id_item}}" class="btn btn-primary btn-icon btn-circle btn-sm"><i class="fa fa-plus"></i></a>
                                            @endif   
                                         @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td rowspan="4">Musrenbang Provinsi</td>
                                        <td rowspan="4">15%</td>
                                        @foreach($n_sub as $n)
                                            <?php $ket = "Musrenbang Provinsi"; ?>
                                            @if($n->nama_sub == $ket)
                                            <!-- bobot 15% -->
                                            <td rowspan="4">{{number_format($n->sum, 2, '.', '');}}</td>
                                            @endif
                                        @endforeach
                                        <td>Tingkat Kehadiran Pemangku Kepentingan dalam Musrenbang</td>
                                        <td>
                                        @foreach ($item_penilaian as $dt)
                                            <?php $ket = "Tingkat Kehadiran Pemangku Kepentingan dalam Musrenbang"; ?>
                                            @if($dt->nama_item == $ket)
                                            <a href="/detail_item/{{$dt->id_item}}" class="btn btn-warning btn-icon btn-circle btn-sm" data-toggle="modal"><i class="fa fa-eye"></i></a>
                                            <a href="/item/{{$dt->id_item}}" class="btn btn-primary btn-icon btn-circle btn-sm"><i class="fa fa-plus"></i></a>
                                            @endif   
                                         @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tingkat Partisipasi Pemangku Kepentingan dalam Musrenbang</td>
                                        <td>
                                        @foreach ($item_penilaian as $dt)
                                            <?php $ket = "Tingkat Partisipasi Pemangku Kepentingan dalam Musrenbang"; ?>
                                            @if($dt->nama_item == $ket)
                                            <a href="/detail_item/{{$dt->id_item}}" class="btn btn-warning btn-icon btn-circle btn-sm" data-toggle="modal"><i class="fa fa-eye"></i></a>
                                            <a href="/item/{{$dt->id_item}}" class="btn btn-primary btn-icon btn-circle btn-sm"><i class="fa fa-plus"></i></a>
                                            @endif   
                                         @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Ketepatan waktu pelaksanaan Musrenbang Provinsi</td>
                                        <td>
                                        @foreach ($item_penilaian as $dt)
                                            <?php $ket = "Ketepatan waktu pelaksanaan Musrenbang Provinsi"; ?>
                                            @if($dt->nama_item == $ket)
                                            <a href="/detail_item/{{$dt->id_item}}" class="btn btn-warning btn-icon btn-circle btn-sm" data-toggle="modal"><i class="fa fa-eye"></i></a>
                                            <a href="/item/{{$dt->id_item}}" class="btn btn-primary btn-icon btn-circle btn-sm"><i class="fa fa-plus"></i></a>
                                            @endif   
                                         @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Pelaksanaan Musrebang</td>
                                        <td>
                                        @foreach ($item_penilaian as $dt)
                                            <?php $ket = "Pelaksanaan Musrebang"; ?>
                                            @if($dt->nama_item == $ket)
                                            <a href="/detail_item/{{$dt->id_item}}" class="btn btn-warning btn-icon btn-circle btn-sm" data-toggle="modal"><i class="fa fa-eye"></i></a>
                                            <a href="/item/{{$dt->id_item}}" class="btn btn-primary btn-icon btn-circle btn-sm"><i class="fa fa-plus"></i></a>
                                            @endif   
                                         @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td rowspan="2">2</td>
                                        <td rowspan="2">Isi</td>
                                        <td rowspan="2">40%</td>
                                        @foreach($n_dimensi as $n)
                                        <?php $ket = "Isi"; ?>
                                        @if($n->nama_dimensi == $ket)
                                            <!-- bobot 20% -->
                                        <td rowspan="2">{{number_format($n->sum, 2, '.', '');}}</td>
                                        @endif
                                        @endforeach
                                        <td rowspan="2">Data Pendukung</td>
                                        <td rowspan="2">15%</td>
                                        @foreach($n_sub as $n)
                                            <?php $ket = "Data Pendukung"; ?>
                                            @if($n->nama_sub == $ket)
                                            <!-- bobot 15% -->
                                            <td rowspan="2">{{number_format($n->sum, 2, '.', '');}}</td>
                                            @endif
                                        @endforeach
                                        <td>Persentase ketersediaan data IKU </td>
                                        <td>
                                        @foreach ($item_penilaian as $dt)
                                            <?php $ket = "Persentase ketersediaan data IKU"; ?>
                                            @if($dt->nama_item == $ket)
                                            <a href="/detail_item/{{$dt->id_item}}" class="btn btn-warning btn-icon btn-circle btn-sm" data-toggle="modal"><i class="fa fa-eye"></i></a>
                                            <a href="/item/{{$dt->id_item}}" class="btn btn-primary btn-icon btn-circle btn-sm"><i class="fa fa-plus"></i></a>
                                            @endif   
                                         @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Persentase ketersediaan data IKD</td>
                                        <td>
                                        @foreach ($item_penilaian as $dt)
                                            <?php $ket = "Persentase ketersediaan data IKD"; ?>
                                            @if($dt->nama_item == $ket)
                                            <a href="/detail_item/{{$dt->id_item}}" class="btn btn-warning btn-icon btn-circle btn-sm" data-toggle="modal"><i class="fa fa-eye"></i></a>
                                            <a href="/item/{{$dt->id_item}}" class="btn btn-primary btn-icon btn-circle btn-sm"><i class="fa fa-plus"></i></a>
                                            @endif   
                                         @endforeach
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end panel -->
                    @endif
                </div>
                <!-- end col-12 -->
            </div>
            <!-- end row -->
@include('sweetalert::alert')
@endsection