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
                <h4 class="panel-title">{{$opd->nama_opd}}</h4>
            </div>
        <div class="panel-body">
            <div class="row" style="padding:8px;">
                <div class="col-md-12">
                    <?php $no=1; ?>
                    @if($data == null)
                    <form action="/program/{{$opd->id}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                        <table class="table no-bordered" style="color:black;">
                            <thead>
                                <th>No</th>
                                <th width="750px">Nama Program</th>
                                <th>Ada</th>
                                <th>Tidak Ada</th>
                            </thead>
                            <tbody>
                            @foreach($program as $dt)
                                <tr>
                                    <td>{{$no++}}
                                        <input type="hidden" name="id_opd[]" value="{{$dt->idopd}}">
                                        <input type="hidden" name="id_item[]" value="{{$item->id_item}}">
                                    </td>
                                    <td>{{$dt->nm_nomenklatur}}
                                        <input type="hidden" name="kode_rekening[]" class="form-control" value="{{$dt->kode_rekening}}">
                                    </td>
                                    <td style="text-align:center">
                                        <input class="form-check-input" type="checkbox" id="status1" name="status[]" value="Ada">
                                    </td>
                                    <td style="text-align:center">
                                        <input class="form-check-input" type="checkbox" id="status2" name="status[]" value="Tidak">
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <button type="submit" style="margin:5px" class="btn btn-sm pull-right btn-success">Submit</button>
                    </form>
                    <a href="javascript:history.back()" style="margin:5px" class="btn btn-sm pull-right btn-warning">Back</a>
                    @endif
                    @if($data != null)
                    <form action="/program_update/{{$opd->id}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                        <table class="table no-bordered" style="color:black;">
                            <thead>
                                <th>No</th>
                                <th width="750px">Nama Program</th>
                                <th>Ada</th>
                                <th>Tidak Ada</th>
                            </thead>
                            <tbody>
                            @foreach($d_prog as $dt)
                                <tr>
                                    <td>{{$no++}}
                                        <input type="hidden" name="id_selaras[]" value="{{$dt->id_selaras}}">
                                        <input type="hidden" name="id_opd[]" value="{{$dt->id_opd}}">
                                        <input type="hidden" name="id_item[]" value="{{$item->id_item}}">
                                    </td>
                                    <td>{{$dt->nm_nomenklatur}}
                                        <input type="hidden" name="kode_rekening[]" class="form-control" value="{{$dt->kode_rekening}}">
                                    </td>
                                    <td style="text-align:center">
                                        <input class="form-check-input" type="checkbox" id="status1" name="status[]" onclick="onlyOne(this)" value="Ada" @if($dt->status == 'Ada') checked="checked" @endif >
                                    </td>
                                    <td style="text-align:center">
                                        <input class="form-check-input" type="checkbox" id="status2" name="status[]" onclick="onlyOne(this)" value="Tidak" @if($dt->status == 'Tidak') checked="checked" @endif >
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <button type="submit" style="margin:5px" class="btn btn-sm pull-right btn-success">Submit</button>
                    </form>
                    <a href="javascript:history.back()" style="margin:5px" class="btn btn-sm pull-right btn-warning">Back</a>
                    @endif
                </div>
            </div>
        </div>
    <!-- end panel -->
    </div>
    <!-- end col-12 -->
</div>
<!-- end row -->

<!-- <script>
    function onlyOne(checkbox) {
        var checkboxes = document.getElementsByName('status')
        checkboxes.forEach((item) => {
            if (item !== checkbox) item.checked = false
        })
    }
</script> -->

@include('sweetalert::alert')
@endsection