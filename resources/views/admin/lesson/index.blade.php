@extends('layout.common')
@section('content')
    <div class="padding-big background-color ">
        <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">课程管理</h3>

        </div>
        <div class="panel-body">
            <!-- TAB NAVIGATION -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="/admin/lesson">列表</a></li>
                <li><a href="/admin/lesson/create">新增</a></li>
            </ul>
            <!-- TAB CONTENT -->
            <hr>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th width="50">ID</th>
                    <th>名称</th>
                    <th>视频数量</th>
                    <th width="150">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $v)
                    <tr>
                        <td>{{$v['id']}}</td>
                        <td>{{$v['title']}}</td>
                        <td>{{$v->videos()->count()}}</td>
                        <td>
                            <div class="btn-group">
                                <a href="/admin/lesson/{{$v['id']}}/edit" class="btn btn-primary btn-sm">编辑</a>
                                <a href="javascript:del({{$v['id']}});" class="btn btn-danger btn-sm">删除</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <script>
                function del(id) {
                    require(['util'], function (util) {
                        util.confirm('确定要删除吗?',function(){
                            $.ajax({
                                url:'/admin/lesson/' + id,
                                method:'DELETE',
                                success:function(response){
                                    util.message(response.msg,'refresh');
                                }
                            })
                        })
                    })
                }
            </script>

        </div>
    </div>
    </div>
@endsection