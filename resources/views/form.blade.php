@extends('layout.index')

@section('title','Indeks Kualitas Perencanaan')
@section('breadcrumb')
<ol class="breadcrumb pull-right">
	<li><a href="/_ikp">Indeks Kualitas Perencanaan</a></li> <!-- PR -->
    <li class="active">Form</li>
</ol>
@endsection
@section('container')
<!-- begin row -->
<div class="row">
    <!-- begin col-12 -->
	<div class="col-md-12">
		 <!-- begin panel -->
        <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>                        
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                @foreach($item as $i)
                <h4 class="panel-title">{{$i->nama_item}}</h4>
            </div>
        <div class="panel-body">
            @if($i->tipe == 1)
            <a href="#modal-dialog" style="float:right; margin:8px" class="btn btn-sm btn-primary" data-toggle="modal"><i class="fa fa-upload"></i> Upload Evidence</a>
            <form action="/item/input/{{$i->id_item}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="row" style="padding:4px;">
                <div class="col-md-8">
                    <!-- <div class="form-group">
                        <label for="form-field1">{{$i->field1}}</label>
                        <input type="number" name="field1" class="form-control" id="form-field1" placeholder="Enter" value="{{ old('field1') }}" required>
                    </div> -->
                    <div class="form-group">
                        <label for="form-field2">Jumlah OPD keseluruhan</label>
                        <input type="number" name="field2" value="{{$total_opd}}" class="form-control" id="form-field2" placeholder="{{$i->var_adm}}" readonly>
                    </div>
                    <label for="exampleInput">{{$i->field3}}</label>
                    <div class="row">
                         <div class="col-md-12">
                            @foreach($daftar_opd as $opd)
                            <div class="form-check">
                                <input type="checkbox" value="{{$opd->id}}" name="id_opd[]" class="form-check-input" id="{{$opd->id}}">
                                <label class="form-check-label" for="{{$opd->id}}">&nbsp {{$opd->nama_opd}}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                        <input type="hidden" name="tipe" class="form-control" value="{{$i->tipe}}">
                        <button type="submit" class="btn btn-sm pull-right btn-success" style="margin-top:2em">Submit</button>
                        <a href=""><button type="submit" class="btn btn-sm pull-right btn-warning" style="margin-top:2em; margin-right:8px">Cancel</button></a>
                    </div>
            </div>
            </form>
                    <!-- <table id="data-table" class="table table-bordered table-responsive" style="color:black;">
                        <thead>
                            <th>No</th>
                            <th>OPD</th>
                            <th width="50px">Absensi</th>
                            <th width="80px">Berita Acara</th>
                            <th>Dokumentasi</th>
                            <th width="100px">Tanggal Pelaksanaan</th>
                            <th width="110px">Hari Pelaksanaan</th>
                        </thead>
                        <tbody>
                            @foreach($daftar_opd as $opd)
                            <tr>
                                <td>{{$opd->nama_opd}}</td>
                                <td style="text-align:center">
                                    @if($file_ab != null&&$file_ab->id_opd == $opd->id)
                                    <a href="{{route('download', $file_ab->file)}}" class="btn btn-success btn-icon btn-sm"><i class="fa fa-download"></i></a>
                                    <a href="{{route('hapus_file', $file_ab->file)}}" class="btn btn-danger btn-icon btn-sm"><i class="fa fa-trash"></i></a>
                                    @else
                                    <a href="#modal-ab-{{$opd->id}}" class="btn btn-primary btn-icon btn-sm" data-toggle="modal"><i class="fa fa-upload"></i></a>
                                    <a href="{{route('hapus_file', 'kosong')}}" class="btn btn-danger btn-icon btn-sm"><i class="fa fa-trash"></i></a>
                                    @endif
                                </td>
                                <td style="text-align:center">
                                    @if($file_ba != null&&$file_ba->id_opd == $opd->id)
                                    <a href="{{route('download', $file_ba->file)}}" class="btn btn-success btn-icon btn-sm"><i class="fa fa-download"></i></a>
                                    <a href="{{route('hapus_file', $file_ba->file)}}" class="btn btn-danger btn-icon btn-sm"><i class="fa fa-trash"></i></a>
                                    @else
                                    <a href="#modal-ba-{{$opd->id}}" class="btn btn-primary btn-icon btn-sm" data-toggle="modal"><i class="fa fa-upload"></i></a>
                                    <a href="{{route('hapus_file', 'kosong')}}" class="btn btn-danger btn-icon btn-sm"><i class="fa fa-trash"></i></a>
                                    @endif
                                </td>
                                <td style="text-align:center">
                                    @if($file_do != null&&$file_do->id_opd == $opd->id)
                                    <a href="{{route('download', $file_do->file)}}" class="btn btn-success btn-icon btn-sm"><i class="fa fa-download"></i></a>
                                    <a href="{{route('hapus_file', $file_do->file)}}" class="btn btn-danger btn-icon btn-sm"><i class="fa fa-trash"></i></a>
                                    @else
                                    <a href="#modal-do-{{$opd->id}}" class="btn btn-primary btn-icon btn-sm" data-toggle="modal"><i class="fa fa-upload"></i></a>
                                    <a href="{{route('hapus_file', 'kosong')}}" class="btn btn-danger btn-icon btn-sm"><i class="fa fa-trash"></i></a>
                                    @endif
                                </td>
                                <td>
                                    <input type="date" name="tgl_pel" class="form-control input-sm" id="tgl_pel" placeholder="" value="{{ old('tgl_pel') }}">&nbsp
                                </td>
                                <td>
                                    <input type="number" name="hari_pel" class="form-control input-sm" id="hari_pel" onchange="forum()" style='width:6em' placeholder="" value="">&nbsp
                                    Hari
                                </td>
                            </tr> 
                            @endforeach
                        </tbody>
                    </table> -->
                <!-- </div>   -->
            <!-- </div>
            <div class="row" style="margin-top:50px">
                <div class="col-md-6">
                    <table class="table no-bordered" style="color:black;">
                        <tr width="20px">
                            <td></td>
                            <td>Jumlah OPD</td>
                        </tr>
                        <tr>
                            <td>Melaksanakan Forum</td>
                            <td>
                                <input type="number" name="m_forum" class="form-control input-sm" id="melaksanakan" placeholder="0" value="{{ old('field1') }}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td>Tidak Melaksanakan Forum</td>
                            <td>
                                <input type="number" name="t_forum" class="form-control input-sm" id="t_forum" placeholder="0" value="{{ old('field1') }}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td>Tepat Waktu Melaksanakan Forum</td>
                            <td>
                                <input type="number" name="tepat_waktu" class="form-control input-sm" id="tepat_waktu" placeholder="0" value="{{ old('field1') }}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td>Tidak Tepat Waktu Melaksanakan Forum</td>
                            <td>
                                <input type="number" name="tdk_tepat" class="form-control input-sm" id="tdk_tepat" placeholder="0" value="{{ old('field1') }}" readonly>
                            </td>
                        </tr>
                    </table>
                </div> -->
            <!-- modal -->
            <!-- @foreach($daftar_opd as $d)
            <div class="modal" id="modal-ab-{{$d->id}}">
				<div class="modal-dialog">
					<div class="modal-content">	
                        <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h4 class="modal-title">Absensi</h4>
						</div>
				    	<div class="modal-body">
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <form action="/item/upload_file/{{$i->id_item}}" method="POST" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                        <input type="hidden" name="id_opd" value="{{$d->id}}">
                                        <input type="hidden" name="label_file" value="Absensi">
                                        <div class="form-group">
                                            <label for="file">Upload</label>
                                            <input type="file" class="form-control" name="file" value="{{ old('dokumen') }}" required>
                                        </div>
                                </div>
                            </div>
						</div>
						<div class="modal-footer">
                            <button type="submit" class="btn btn-sm pull-right btn-success">Submit</button>&nbsp
                            </form>
						</div>
					</div>
				</div>
			</div>
			<div class="modal" id="modal-ba-{{$d->id}}">
				<div class="modal-dialog">
					<div class="modal-content">	
                        <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h4 class="modal-title">Berita Acara</h4>
						</div>
				    	<div class="modal-body">
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <form action="/item/upload_file/{{$i->id_item}}" method="POST" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                        <input type="hidden" name="id_opd" value="{{$d->id}}">
                                        <input type="hidden" name="label_file" value="Berita Acara">
                                        <div class="form-group">
                                            <label for="file">Upload</label>
                                            <input type="file" class="form-control" name="file" value="{{ old('dokumen') }}" required>
                                        </div>
                                </div>
                            </div>
						</div>
						<div class="modal-footer">
                            <button type="submit" class="btn btn-sm pull-right btn-success">Submit</button>&nbsp
                            </form>
						</div>
					</div>
				</div>
			</div>
            <div class="modal" id="modal-do-{{$d->id}}">
				<div class="modal-dialog">
					<div class="modal-content">	
                        <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h4 class="modal-title">Dokumentasi</h4>
						</div>
				    	<div class="modal-body">
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <form action="/item/upload_file/{{$i->id_item}}" method="POST" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                        <input type="hidden" name="id_opd" value="{{$d->id}}">
                                        <input type="hidden" name="label_file" value="Dokumentasi">
                                        <div class="form-group">
                                            <label for="file">Upload</label>
                                            <input type="file" class="form-control" name="file" value="{{ old('dokumen') }}" required>
                                        </div>
                                </div>
                            </div>
						</div>
						<div class="modal-footer">
                            <button type="submit" class="btn btn-sm pull-right btn-success">Submit</button>&nbsp
                            </form>
						</div>
					</div>
				</div>
			</div>
            @endforeach -->
            <!-- end modal -->
            @elseif($i->nama_item == 'Keselarasan Program antara RKPD dengan RPJMD')
            <div class="row" style="padding:4px;">
                <div class="col-md-12">
                    <table id="data-table" class="table table-bordered table-responsive" style="color:black;">
                        <thead>
                            <th>No</th>
                            <th>Nama Dinas</th>
                            <th width="50px">Opsi</th>
                        </thead>
                        <tbody>
                        <?php $no=1; ?>
                            @foreach($daftar_opd as $opd)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$opd->nama_opd}}</td>
                                <td style="text-align:center">
                                    <!-- <a href="#modal-dialog" style="float:right; margin:8px" class="btn btn-sm btn-primary" data-toggle="modal"><i class="fa fa-upload"></i> Upload Evidence</a> -->
                                    <a href="/program/{{$i->id_item}}/{{$opd->id}}" class="btn btn-primary btn-sm">Pilih</a>
                                    <!-- <a href="#modal-dialog" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#detail-{{$opd->id}}">Pilih</a> -->
                                </td>
                            </tr> 
                            @endforeach
                        </tbody>
                    </table>
                </div>  
            </div>
            <div class="row" style="margin-top:50px">
                <div class="col-md-7">
                <form action="/item/input/{{$i->id_item}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                    <table class="table no-bordered" style="color:black;">
                        <tr>
                            <input type="hidden" name="id_item" onkeyup="isi_otomatis()" id="id_item" value="{{$i->id_item}}">
                            <td>Jumlah program RPJMD yang ada pada RKPD</td>
                            <td>
                                <input type="number" name="field1" class="form-control input-sm" id="dt_ada" placeholder="0" value="{{$prog_ada}}" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td>Jumlah program RPJMD yang tidak ada pada RKPD</td>
                            <td>
                                <input type="number" name="dt_tdk" class="form-control input-sm" id="dt_tdk" placeholder="0" value="{{$prog_tidak}}" readonly>
                            </td>
                        </tr>
                    </table>
                    <input type="hidden" name="field2" value="{{$i->var_adm}}" class="form-control" id="form-field2">
                    <input type="hidden" name="tipe" class="form-control" value="2">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-sm pull-right btn-success" style="margin-top:1em">Submit</button>
                        <a href="/_ikp" style="margin-top:1em; margin-right:12px" class="btn btn-sm pull-right btn-warning">Back</a>
                    </div>
                </form> 
            </div>
            @elseif($i->tipe == 2)
            <a href="#modal-dialog" style="float:right; margin:8px" class="btn btn-sm btn-primary" data-toggle="modal"><i class="fa fa-upload"></i> Upload Evidence</a>
            <div class="row" style="padding:8px;">
                <div class="col-md-10">
                    <form action="/item/input/{{$i->id_item}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                        <div class="form-group">
                            <label for="form-field1">{{$i->field1}}</label>
                            <input type="number" name="field1" class="form-control" id="form-field1" placeholder="Enter" value="{{ old('field1')}}" required>
                        </div>
                        <div class="form-group">
                            <label for="form-field2">{{$i->field2}}</label>
                            @if($i->level_user == 'user1')
                            <input type="number" name="field2" class="form-control" id="form-field2" placeholder="Enter" value="{{ old('field2')}}" required>
                            @else
                            <input type="number" name="field2" value="{{$i->var_adm}}" class="form-control" id="form-field2" placeholder="{{$i->var_adm}}" readonly>
                            @endif
                        </div>
                        <input type="hidden" name="tipe" class="form-control" value="{{$i->tipe}}">
                        <button type="submit" class="btn btn-sm pull-right btn-success">Submit</button>
                        <a href="javascript:history.back()" style="margin-right:8px" class="btn btn-sm pull-right btn-warning">Back</a>
                        </form>
                    </div>
                </div>
            </div>
            @elseif($i->tipe == 3)
            <a href="#modal-dialog" style="float:right; margin:8px" class="btn btn-sm btn-primary" data-toggle="modal"><i class="fa fa-upload"></i> Upload Evidence</a>
            <div class="row" style="padding:8px;">
                <div class="col-md-10">
                    <form action="/item/input/{{$i->id_item}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                        <div class="form-group">
                            <label for="form-field1">{{$i->field1}}</label>
                            <?php $ket = "Ketersediaan Inovasi dalam Dokumen Perencanaan"; ?>
                            @if($i->nama_item == $ket)
                            <div class="radio">
                                <label>
                                    <input type="radio" name="option" value="Ada"/>Ada
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="option" value="Tidak"/>Tidak 
                                </label>
                            </div>
                            @else
                            <div class="radio">
                                <label>
                                    <input type="radio" name="option" value="Tepat Waktu"/>Tepat Waktu
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="option" value="Tidak Tepat Waktu"/>Tidak Tepat Waktu
                                </label>
                            </div>
                            @endif
                        </div>
                        <input type="hidden" name="tipe" class="form-control" value="{{$i->tipe}}">
                        <button type="submit" class="btn btn-sm pull-right btn-success">Submit</button>
                        <a href="javascript:history.back()" style="margin-right:8px" class="btn btn-sm pull-right btn-warning">Back</a>
                        </form>
                    </div>
                </div>
            </div>
            @elseif($i->tipe == 4)
            <a href="#modal-dialog" style="float:right; margin:8px" class="btn btn-sm btn-primary" data-toggle="modal"><i class="fa fa-upload"></i> Upload Evidence</a>
            <div class="row" style="padding:8px;">
                <div class="col-md-10">
                    <form action="/item/input/{{$i->id_item}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="form-field1">{{$i->field1}}</label>
                                    <input type="number" name="field1" class="form-control" id="form-field1" placeholder="Enter" required>
                                </div>
                                <div class="form-group">
                                    <label for="form-field2">{{$i->field2}}</label>
                                    <input type="number" name="field2" class="form-control" id="form-field2" placeholder="Enter" required>
                                </div>
                                <div class="form-group">
                                    <label for="form-field3">{{$i->field3}}</label>
                                    <input type="number" name="field3" class="form-control" id="form-field3" placeholder="Enter" required>
                                </div>
                                <div class="form-group">
                                    <label for="form-field4">{{$i->field4}}</label>
                                    <input type="number" name="field4" class="form-control" id="form-field4" placeholder="Enter" required>
                                </div>
                                <div class="form-group">
                                    <label for="form-field5">{{$i->field5}}</label>
                                    <input type="number" name="field5" class="form-control" id="form-field5" placeholder="Enter" required>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="tipe" class="form-control" value="{{$i->tipe}}">
                        <button type="submit" class="btn btn-sm pull-right btn-success">Submit</button>
                        <a href="javascript:history.back()" style="margin-right:8px" class="btn btn-sm pull-right btn-warning">Back</a>
                        </form>
                    </div>
                </div>
            </div>
            @elseif($i->tipe == 5)
            <a href="#modal-dialog" style="float:right; margin:8px" class="btn btn-sm btn-primary" data-toggle="modal"><i class="fa fa-upload"></i> Upload Evidence</a>
            <div class="row" style="padding:8px;">
                <div class="col-md-10">
                    <form action="/item/input/{{$i->id_item}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                        <div class="form-group">
                            <label for="form-field1">{{$i->field1}}</label>
                            <input type="number" name="field1" class="form-control" id="form-field1" placeholder="Enter" required>
                        </div>
                        <div class="form-group">
                            <label for="form-field2">{{$i->field2}}</label>
                            @if($i->level_user == 'user1')
                            <input type="number" name="field2" class="form-control" id="form-field2" placeholder="Enter" required>
                            @else
                            <input type="number" name="field2" value="{{$i->var_adm}}" class="form-control" id="form-field2" placeholder="{{$i->var_adm}}" readonly>
                            @endif
                        </div>
                        <input type="hidden" name="tipe" class="form-control" value="{{$i->tipe}}">
                        <button type="submit" class="btn btn-sm pull-right btn-success">Submit</button>
                        <a href="javascript:history.back()" style="margin-right:8px" class="btn btn-sm pull-right btn-warning">Back</a>
                        </form>
                    </div>
                </div>
            </div>
            @endif
            <!-- modal -->
			<div class="modal" id="modal-dialog">
				<div class="modal-dialog">
					<div class="modal-content">	
                        <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h4 class="modal-title">Upload Evidence</h4>
						</div>
				    	<div class="modal-body">
                            <div class="row">
                                
                                <div class="col-md-10 col-md-offset-1">
                                    <form action="/item/upload_file/{{$i->id_item}}" method="POST" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                        <div class="form-group">
                                            <label for="form-field1">Nama File</label>
                                            <input type="text" name="label_file" class="form-control" id="form-label" placeholder="Enter" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="file">Upload</label>
                                            <input type="file" class="form-control" name="file" value="{{ old('dokumen') }}" required>
                                        </div>
                                </div>
                            </div>
						</div>
						<div class="modal-footer">
                            <button type="submit" id="submit-evidence" class="btn btn-sm pull-right btn-success">Submit</button>&nbsp
                            </form>
						</div>
					</div>
				</div>
			</div>
            <!-- end modal -->
        @endforeach
        </div>
    <!-- end panel -->
    </div>
    <!-- end col-12 -->
</div>
<!-- end row -->

@include('sweetalert::alert')
@endsection