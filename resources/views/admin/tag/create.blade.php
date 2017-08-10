@extends('layout.common')
@section('content')
    <div class="padding-big background-color ">
        <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">标签管理</h3>
        </div>
        <div class="panel-body">
            <!-- TAB NAVIGATION -->
            <ul class="nav nav-tabs" role="tablist">
                <li class=""><a href="/admin/tag">列表</a></li>
                <li class="active"><a href="/admin/tag/create">新增</a></li>
            </ul>
            <!-- TAB CONTENT -->
            <hr>
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="/admin/tag" method="post" class="form-horizontal" role="form">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="inputID" class="col-sm-2 control-label">标签:</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" id="inputID" class="form-control"  required="required">
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <button type="submit" class="btn btn-primary">保存</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
    @include('flash::message')
    <script>
        require(['bootstrap'],function($){
            // 设置字体
            $('#flash-overlay-modal').modal();
            setTimeout(function(){
                $('#flash-overlay-modal').modal('hide');

            },2000)
        });
    </script>
@endsection