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
                    <div class="panel panel-inverse" >
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Indeks Kualitas Perencanaan</h4>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-8">
                            <form action="{{route('_ikp')}}" method="POST" class="form-horizontal">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Pilih Tahun</label>
                                    <div class="col-md-3">
                                        <select class="form-control" name="tahun">
                                            @foreach($tahun as $thn)
                                            <option value="{{$thn->tahun}}">{{$thn->tahun}}</option>
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
                    </div>
                    <!-- end panel -->
                </div>
                <!-- end col-12 -->
            </div>
            <!-- end row -->
@include('sweetalert::alert')
@endsection