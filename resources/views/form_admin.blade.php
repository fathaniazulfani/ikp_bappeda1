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
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                @foreach($item as $i)
                <h4 class="panel-title">{{$i->nama_item}}</h4>
            </div>
            <div class="panel-body">
                @if($i->tipe == 1)
                <form action="/item/input-var/{{$i->id_item}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row" style="padding:4px;">
                    <div class="col-md-12">
                        <table id="data-table" class="table table-bordered table-responsive" style="color:black;">
                        <thead>
                                <th>No</th>
                                <th>OPD</th>
                                <th width="150px">Tanggal Pelaksanaan</th>
                                <th width="150px">Hari Pelaksanaan</th>
                            </thead>
                            <tbody>
                            <?php $no=1; ?>
                                @foreach($daftar_opd as $opd)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$opd->nama_opd}}</td>
                                    <td>
                                        <input type="date" name="tgl" class="form-control input-sm" id="tgl_pel" placeholder="" value="{{ old('field1') }}">&nbsp
                                    </td>
                                    <td>
                                        <input type="number" name="hari" class="form-control input-sm" id="hari_pel" style='width:10em' placeholder="" value="">&nbsp
                                        Hari
                                    </td>
                                </tr> 
                                @endforeach
                            </tbody>
                        </table>
                    </div>  
                </div>
                <button type="submit" class="btn btn-sm pull-right btn-success">Submit</button>
                </form>
                <a href="javascript:history.back()" style="margin:5px" class="btn btn-sm pull-right btn-warning">Back</a>
                @elseif($i->tipe != 1)
                <div class="row" style="padding:8px;">
                    <div class="col-md-6">
                        <form action="/item/input-var/{{$i->id_item}}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="Input1">{{$i->field2}}</label>
                                    <input type="number" name="var_adm" class="form-control" id="Input1" placeholder="Enter" required>
                            </div>
                            <button type="submit" class="btn btn-sm pull-right btn-success">Submit</button>
                            <a href="javascript:history.back()" style="margin:5px" class="btn btn-sm pull-right btn-warning">Back</a>
                        </form>
                    </div>  
                </div>
                @endif
            </div>
        @endforeach
        </div>
    <!-- end panel -->
    </div>
    <!-- end col-12 -->
</div>
<!-- end row -->

@include('sweetalert::alert')
@endsection