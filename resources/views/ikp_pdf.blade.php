<!doctype html>
    <html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        @foreach($d_ikp as $i)
        <h4 class="panel-title">Indeks Kualitas Perencanaan Tahun {{$i->tahun}}</h4>
        @endforeach
    </head>
    <body>
    <style type="text/css">
        .table-data{
            width: 100%;
            border-collapse: collapse;
        }
		.table-data tr th,
		.table-data tr td{
            border:1px solid black;
            font-size: 10pt;
            padding: 10px 10px 10px 10px;
		}
	</style>
                            <table class="table-data">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th width="150px">Dimensi Penilaian</th>
                                        <th>Bobot</th>
                                        <th>Nilai</th>
                                        <th>Sub Dimensi</th>
                                        <th>Bobot</th>
                                        <th>Nilai</th>
                                        <th>Item Penilaian</th>
                                        <th>Nilai</th>
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
                                        <td rowspan="10">{{number_format($n->sum, 2, '.', '');}}</td>
                                        @endif
                                        @endforeach
                                        <td rowspan="2">Forum OPD</td>
                                        <td rowspan="2">5%</td>
                                        @foreach($n_sub as $n)
                                        <?php $ket = "Forum OPD"; ?>
                                        @if($n->nama_sub == $ket)
                                        <td rowspan="2">{{number_format($n->sum, 2, '.', '');}}</td>
                                        @endif
                                        @endforeach
                                        <td>Persentase OPD yang melaksanakan Forum OPD</td>
                                        @foreach ($item_penilaian as $dt)
                                        <?php $ket = "Persentase OPD yang melaksanakan Forum OPD"; ?>
                                        @if($dt->nama_item == $ket)
                                        <td>{{number_format($dt->nilai, 2, '.', '');}}</td>
                                        @endif
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td>Ketepatan waktu pelaksanaan Forum OPD</td>
                                        @foreach ($item_penilaian as $dt)
                                        <?php $ket = "Ketepatan waktu pelaksanaan Forum OPD"; ?>
                                        @if($dt->nama_item == $ket)
                                        <td>{{number_format($dt->nilai, 2, '.', '');}}</td>
                                        @endif
                                        @endforeach
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
                                        @foreach ($item_penilaian as $dt)
                                        <?php $ket = "Tingkat Kehadiran Pemangku Kepentingan dalam Konsultasi Publik"; ?>
                                        @if($dt->nama_item == $ket)
                                        <td>{{number_format($dt->nilai, 2, '.', '');}}</td>
                                        @endif
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td>Tingkat Partisipasi Aktif Pemangku Kepentingan dalam Konsultasi Publik</td>
                                        @foreach ($item_penilaian as $dt)
                                        <?php $ket = "Tingkat Partisipasi Aktif Pemangku Kepentingan dalam Konsultasi Publik"; ?>
                                        @if($dt->nama_item == $ket)
                                        <td>{{number_format($dt->nilai, 2, '.', '');}}</td>
                                        @endif
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td>Ketepatan Waktu Pelaksanaan Konsultasi Publik</td>
                                        @foreach ($item_penilaian as $dt)
                                        <?php $ket = "Ketepatan Waktu Pelaksanaan Konsultasi Publik"; ?>
                                        @if($dt->nama_item == $ket)
                                        <td>{{number_format($dt->nilai, 2, '.', '');}}</td>
                                        @endif
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td>Pelaksanaan Konsultasi Publik</td>
                                        @foreach ($item_penilaian as $dt)
                                        <?php $ket = "Pelaksanaan Konsultasi Publik"; ?>
                                        @if($dt->nama_item == $ket)
                                        <td>{{number_format($dt->nilai, 2, '.', '');}}</td>
                                        @endif
                                        @endforeach
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
                                        @foreach ($item_penilaian as $dt)
                                        <?php $ket = "Tingkat Kehadiran Pemangku Kepentingan dalam Musrenbang"; ?>
                                        @if($dt->nama_item == $ket)
                                        <td>{{number_format($dt->nilai, 2, '.', '');}}</td>
                                        @endif
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td>Tingkat Partisipasi Pemangku Kepentingan dalam Musrenbang</td>
                                        @foreach ($item_penilaian as $dt)
                                        <?php $ket = "Tingkat Partisipasi Pemangku Kepentingan dalam Musrenbang"; ?>
                                        @if($dt->nama_item == $ket)
                                        <td>{{number_format($dt->nilai, 2, '.', '');}}</td>
                                        @endif
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td>Ketepatan waktu pelaksanaan Musrenbang Provinsi</td>
                                        @foreach ($item_penilaian as $dt)
                                        <?php $ket = "Ketepatan waktu pelaksanaan Musrenbang Provinsi"; ?>
                                        @if($dt->nama_item == $ket)
                                        <td>{{number_format($dt->nilai, 2, '.', '');}}</td>
                                        @endif
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td>Pelaksanaan Musrebang</td>
                                        @foreach ($item_penilaian as $dt)
                                        <?php $ket = "Pelaksanaan Musrebang"; ?>
                                        @if($dt->nama_item == $ket)
                                        <td>{{number_format($dt->nilai, 2, '.', '');}}</td>
                                        @endif
                                        @endforeach
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
                                        <td>Persentase ketersediaan data IKU</td>
                                        @foreach ($item_penilaian as $dt)
                                        <?php $ket = "Persentase ketersediaan data IKU"; ?>
                                        @if($dt->nama_item == $ket)
                                        <td>{{number_format($dt->nilai, 2, '.', '');}}</td>
                                        @endif
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td>Persentase ketersediaan data IKD</td>
                                        @foreach ($item_penilaian as $dt)
                                        <?php $ket = "Persentase ketersediaan data IKD"; ?>
                                        @if($dt->nama_item == $ket)
                                        <td>{{number_format($dt->nilai, 2, '.', '');}}</td>
                                        @endif
                                        @endforeach
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
                                        @foreach ($item_penilaian as $dt)
                                        <?php $ket = "Keselarasan Program antara RKPD dengan RPJMD"; ?>
                                        @if($dt->nama_item == $ket)
                                        <td>{{number_format($dt->nilai, 2, '.', '');}}</td>
                                        @endif
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td>Konsistensi anggaran per Program antara RKPD dengen RPJMD</td>
                                        @foreach ($item_penilaian as $dt)
                                        <?php $ket = "Konsistensi anggaran per Program antara RKPD dengen RPJMD"; ?>
                                        @if($dt->nama_item == $ket)
                                        <td>{{number_format($dt->nilai, 2, '.', '');}}</td>
                                        @endif
                                        @endforeach
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
                                        @foreach ($item_penilaian as $dt)
                                        <?php $ket = "Ketersediaan Inovasi dalam Dokumen Perencanaan"; ?>
                                        @if($dt->nama_item == $ket)
                                        <td>{{number_format($dt->nilai, 2, '.', '');}}</td>
                                        @endif
                                        @endforeach
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
                                        <td>Persentase capaian IKU</td>
                                        @foreach ($item_penilaian as $dt)
                                        <?php $ket = "Persentase capaian IKU"; ?>
                                        @if($dt->nama_item == $ket)
                                        <td>{{number_format($dt->nilai, 2, '.', '');}}</td>
                                        @endif
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <td>Persentase capaian IKD</td>
                                        @foreach ($item_penilaian as $dt)
                                        <?php $ket = "Persentase capaian IKD"; ?>
                                        @if($dt->nama_item == $ket)
                                        <td>{{number_format($dt->nilai, 2, '.', '');}}</td>
                                        @endif
                                        @endforeach
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
                                        @foreach ($item_penilaian as $dt)
                                        <?php $ket = "Persentase Rekomendasi Hasil Evaluasi yang Ditindaklanjuti oleh OPD"; ?>
                                        @if($dt->nama_item == $ket)
                                        <td>{{number_format($dt->nilai, 2, '.', '');}}</td>
                                        @endif
                                        @endforeach
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
                                        @foreach ($item_penilaian as $dt)
                                        <?php $ket = "Persentase prioritas pembangunan pada RPJMD menjadi anggaran prioritas dalam RKPD"; ?>
                                        @if($dt->nama_item == $ket)
                                        <td>{{number_format($dt->nilai, 2, '.', '');}}</td>
                                        @endif
                                        @endforeach
                                    </tr>
                                    <tr style="font-size:14px">
                                        <td colspan="3">INDEKS KUALITAS PERENCANAAN</td>
                                        @foreach($n_ikp as $n)
                                        <td colspan="6"><b>{{number_format($n->sum, 2, '.', '');}}<b></td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>