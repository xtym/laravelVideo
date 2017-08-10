@extends('admin.layouts.common')

@section('content')
    <div class="padding-big background-color">
        <div class="alert alert-info" >
            <h1 class="text-center">修改密码</h1>

        </div>

        <div class="container" style="width: 80%">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="/admin/password" method="post" class="form-horizontal" role="form">
                {{csrf_field()}}
                {{--原密码--}}
                <div class="form-group">
                    <label for="inputID" class="col-sm-2 control-label">原密码:</label>
                    <div class="col-sm-10">
                        <input type="text" name="old_password" id="inputID" class="form-control" value="" required="required">
                    </div>
                </div>

                {{--新密码--}}
                <div class="form-group">
                    <label for="inputID1" class="col-sm-2 control-label">新密码:</label>
                    <div class="col-sm-10">
                        <input type="password" name="password" id="inputID1" class="form-control" value="" required="required">
                    </div>
                </div>

                {{--确认密码--}}
                <div class="form-group">
                    <label for="inputID2" class="col-sm-2 control-label">确认密码:</label>
                    <div class="col-sm-10">
                        <input type="password" name="password_confirmation" id="inputID2" class="form-control" value="" required="required">
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <button type="submit" class="btn btn-primary">提交</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @include('flash::message')
    <script>
        require(['bootstrap'],function($){
            $('#flash-overlay-modal').modal();
            setTimeout(function(){
                $('#flash-overlay-modal').modal('hide');

            },2000)
        });
    </script>
@endsection