@extends('layout.index')

@section('title','Indeks Kualitas Perencanaan')
@section('breadcrumb')
<ol class="breadcrumb pull-right">
	<li><a href="/_ikp">Indeks Kualitas Perencanaan</a></li> <!-- PR -->
    <li class="active">Detail Item</li>
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
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                @foreach($item as $i)
                <h4 class="panel-title">{{$i->nama_item}}</h4>
            </div>
            <div class="panel-body">
            @if (auth()->user()->level=="admin") 
            @if($i->tipe == 1)
                <div class="row">
                    <div class="col-md-12">
						<table cellspacing="0" cellpadding="0" style="color: black;">
                        @foreach($adm_transaksi as $dt)
                            <!-- <tr>
                                <td width="240px">{{$i->field3}}&nbsp</td>
                                <td>=&nbsp {{$dt->opd}}</td>
                            </tr> -->
                            <!-- <dl class="dl" style="color:black;">
								<dt style="padding:5px;">{{$i->field3}} pada {{$dt->name}} =</dt>
								<dd style="padding:5px;">{{$dt->opd}}</dd> -->
							</dl>
                        @endforeach
                        </table>
                    </div>
                </div>
            @endif
                <div class="row" style="padding:8px;">
                    <div class="col-md-12">
                        <table id="data-table" class="table table-bordered datatable" style="color:black;">
                            <thead>
                                <th width="20px">No</th>
                                <th>File Evidence</th>
                                <th>Bidang</th>
                                <th width="200px">Opsi</th>
                            </thead>
                            <tbody>
                            <?php $no=1; ?>
                            @foreach($adm_file as $f)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$f->label_file}}</td>
                                    <td>{{$f->name}}</td>
                                    <td>
                                        <a href="{{route('download',$f->file)}}"><button type="submit" class="btn btn-sm btn-success">Download</button></a>
                                        <a href="#modal-dialog" data-toggle="modal" data-target="#detail-{{$f->id_pendukung}}"><button type="submit" class="btn btn-sm btn-warning">Update</button></a>
                                        <a href="#"><button type="submit" class="btn btn-sm btn-white delete" data-id="{{$f->id_pendukung}}" data-nama="{{$f->file}}">Delete</button></a>
                                    </td>
                                </tr> 
                            @endforeach
                            </tbody>
                        </table>
                    </div>  
                </div>
                @foreach($adm_file as $n)
                <!-- modal update -->
                <div class="modal" id="detail-{{ $n->id_pendukung }}">
                    <div class="modal-dialog">
                        <div class="modal-content">	
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">Update Evidence</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-10 col-md-offset-1">
                                        <form action="/item/update_file/{{$n->id_pendukung}}" method="POST" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                            <div class="form-group">
                                                <label for="form-field1">Nama File</label>
                                                <input type="text" name="label_file" class="form-control" id="form-label" placeholder="Enter" value="{{$n->label_file}}" required>
                                            </div>
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
                <!-- end modal -->
                @endforeach
            @endif
            @if (auth()->user()->level!="admin") 
            @if($i->tipe == 1)
                <div class="row">
                    <div class="col-md-12">
						<table cellspacing="0" cellpadding="0" style="color: black;">
                        @foreach($transaksi as $dt)
                            <!-- <tr>
                                <td width="240px">{{$i->field3}}&nbsp</td>
                                <td>=&nbsp {{$dt->opd}}</td>
                            </tr> -->
                            <!-- <dl class="dl" style="color:black;">
								<dt style="padding:5px;">{{$i->field3}} =</dt>
								<dd style="padding:5px;">{{$dt->opd}}</dd>
							</dl> -->
                        @endforeach
                        </table>
                    </div>
                </div>
            @endif
                <div class="row" style="padding:8px;">
                    <div class="col-md-12">
                        <table id="data-table" class="table table-bordered datatable" style="color:black;">
                            <thead>
                                <th width="20px">No</th>
                                <th>File Evidence</th>
                                <th width="200px">Opsi</th>
                            </thead>
                            <tbody>
                            <?php $no=1; ?>
                            @foreach($file as $f)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$f->label_file}}</td>
                                    <td>
                                        <a href="{{route('download',$f->file)}}"><button type="submit" class="btn btn-sm btn-success">Download</button></a>
                                        <a href="#modal-dialog" data-toggle="modal" data-target="#detail-{{$f->id_pendukung}}"><button type="submit" class="btn btn-sm btn-warning">Update</button></a>
                                        <a href="#"><button type="submit" class="btn btn-sm btn-white delete" data-id="{{$f->id_pendukung}}" data-nama="{{$f->file}}">Delete</button></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>  
                </div>
                @foreach($file as $dt)
                <!-- modal update -->
                <div class="modal" id="detail-{{ $dt->id_pendukung }}">
                    <div class="modal-dialog">
                        <div class="modal-content">	
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">Update Evidence</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-10 col-md-offset-1">
                                        <form action="/item/update_file/{{$dt->id_pendukung}}" method="POST" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                            <div class="form-group">
                                                <label for="form-field1">Nama File</label>
                                                <input type="text" name="label_file" class="form-control" id="form-label" placeholder="Enter" value="{{$dt->label_file}}" required>
                                            </div>
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
                <!-- end modal -->
                @endforeach
                @endif
            </div>
        @endforeach
        </div>
    <!-- end panel -->
    </div>
    <!-- end col-12 -->
</div>

@include('sweetalert::alert')

<!-- end row -->
<script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
     $('.delete').click(function(event) {
        var id = $(this).attr('data-id');
        var nama = $(this).attr('data-nama');
        event.preventDefault();

        swal({
            title: 'Apakah Anda Yakin?',
            text: 'Data ini akan terhapus secara permanen!',
            icon: 'warning',
            buttons: ["Kembali", "Ya!"],
        })
        .then((willDelete) => {
            if (willDelete) {
                window.location = "/hapus_file/"+id+"/"+nama+""
                swal("Data berhasil dihapus", {
                    icon: "success",
                });
            }
        })
    });    
</script>

@endsection