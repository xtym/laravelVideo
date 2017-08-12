@extends('layout.common')
@section('content')
    <form action="/admin/lesson/{{$model['id']}}" method="post" class="form-horizontal" role="form">

        <div class="panel panel-default" style="width: 90%">
            <div class="panel-heading">
                <h3 class="panel-title">课程管理</h3>
            </div>

            <div class="panel-body">
                <!-- TAB NAVIGATION -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class=""><a href="/admin/lesson">列表</a></li>
                    <li class="active"><a href="/admin/lesson/create">新增</a></li>
                </ul>
                <!-- TAB CONTENT -->
                {{ method_field('PUT') }}
                {{csrf_field()}}
                <hr>
                <div class="form-group">
                    <label for="inputID" class="col-sm-2 control-label">标题:</label>
                    <div class="col-sm-10">
                        <input type="text" name="title" id="inputID" class="form-control" value="{{$model['title']}}" title=""
                               required="required">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputID" class="col-sm-2 control-label">标签:</label>
                    <div class="col-sm-10">
                        <div class="checkbox">
                            @foreach($tagData as $v)
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="{{$v['id']}}" name="tid[]"  {{in_array($v['id'],$tids->toArray()) ? 'checked' : ''}} >
                                    {{$v['name']}}
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputID" class="col-sm-2 control-label">介绍:</label>
                    <div class="col-sm-10">
                        <input type="text" name="introduce" id="inputID" class="form-control" value="{{$model['introduce']}}" title=""
                               required="required">
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputID" class="col-sm-2 control-label">预览图:</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <input type="text" class="form-control" name="preview" readonly="" value="{{$model['preview']}}">
                            <div class="input-group-btn">
                                <button onclick="upImage(this)" class="btn btn-default" type="button">选择图片</button>
                            </div>
                        </div>
                        <div class="input-group" style="margin-top:5px;">
                            <img src="{{$model['preview'] ?: asset('/node_modules/hdjs/images/nopic.jpg')}}" class="img-responsive img-thumbnail" width="150">
                            <em class="close" style="position:absolute; top: 0px; right: -14px;" title="删除这张图片" onclick="removeImg(this)">×</em>
                        </div>
                    </div>
                    <script>
                        //上传图片
                        function upImage(obj) {
                            require(['util'], function (util) {
                                options = {
                                    multiple: false,//是否允许多图上传
                                };
                                util.image(function (images) {          //上传成功的图片，数组类型

                                    $("[name='preview']").val(images[0]);
                                    $(".img-thumbnail").attr('src', images[0]);
                                }, options)
                            });
                        }

                        //移除图片
                        function removeImg(obj) {
                            $(obj).prev('img').attr('src', '/node_modules/hdjs/images/nopic.jpg');
                            $(obj).parent().prev().find('input').val('');
                        }
                    </script>
                </div>
                <div class="form-group">
                    <label for="inputID" class="col-sm-2 control-label">推荐:</label>
                    <div class="col-sm-10">
                        <div class="radio">
                            <label class="radio-inline">
                                <input type="radio" name="iscommend" id="inputID" value="1" {{$model['iscommend'] ? 'checked' : ''}}>
                                是
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="iscommend" id="inputID" value="0" {{$model['iscommend'] ? '' : 'checked'}}>
                                否
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputID" class="col-sm-2 control-label">热门:</label>
                    <div class="col-sm-10">
                        <div class="radio">
                            <label class="radio-inline">
                                <input type="radio" name="ishot" id="inputID" value="1" {{$model['ishot'] ? 'checked' : ''}}>
                                是
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="ishot" id="inputID" value="0" {{$model['ishot'] ? '' : 'checked'}}>
                                否
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputID" class="col-sm-2 control-label">查看次数:</label>
                    <div class="col-sm-10">
                        <input type="text" name="click" id="inputID" class="form-control" value="{{$model['click']}}" title=""
                               required="required">
                    </div>
                </div>


            </div>

        </div>
        <div class="panel panel-default container" id="app" style="width: 90%">
            <div class="panel-heading">
                <h3 class="panel-title">视频</h3>
            </div>
            <div class="panel-body">
                <div class="panel panel-default" v-for="(v,k) in videos">
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="inputID" class="col-sm-2 control-label">标题:</label>
                            <div class="col-sm-10">
                                <input type="text" id="inputID" class="form-control" v-model="v.title" title=""
                                       required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputID" class="col-sm-2 control-label">视频地址:</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="text" class="form-control" v-model="v.path">
                                    <span class="input-group-btn">
                <button class="btn btn-default" type="button" :id="v.id">上传视频</button>
            </span>
                                </div>
                                <b style="margin-top: 3px;color: red" hidden :id="'process'+v.id">0%</b>
                            </div>

                        </div>


                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <button type="submit" class="btn btn-danger" @click.prevent="del(k)">删除</button>
                            </div>
                        </div>
                    </div>

                </div>


            </div>
            <textarea name="videos" id="" cols="30" rows="10" hidden>@{{videos}}</textarea>

            <div class="panel-footer">
                <button type="submit" @click.prevent="add" class="btn btn-info">增加</button>

            </div>

        </div>
        <div class="container" style="width: 90%" >
            <div class="col-sm-9">
                <button type="submit" class="btn btn-primary">保存</button>
            </div>
        </div>
    </form>

    <script>
        require(['vue'], function (Vue) {
            new Vue({
                el: '#app',
                data: {
                    videos:JSON.parse('{!! $videos !!}')
                },
                mounted(){
                    this.videos.forEach(function(v){
                        upload(v);
                    })
                },
                methods: {
                    add() {

                        var field = {title: '', path: '', id: 'hd' + Date.parse(new Date())};
                        this.videos.push(field);
                        setTimeout(function(){
                            upload(field);
                        },200);
                    },
                    del(k) {
                        this.videos.splice(k, 1);
                    }
                }
            })
        })

        function upload(field) {
            require(['oss'], function (oss) {
                var id = '#' + field.id;
                var uploader = oss.upload({
                    //获取签名
                    serverUrl: '/component/oss?',
                    //上传目录
                    dir: 'houdunwang/',
                    //按钮元素
                    pick: id,
                    accept: {
                        title: 'Images',
//                        extensions: 'mp4',
//                        mimeTypes: 'video/mp4'
                    }
                });
                //上传开始
                uploader.on('startUpload', function () {
                    console.log('开始上传');
                });
                //上传成功
                uploader.on('uploadSuccess', function (file, response) {
                    field.path = oss.oss.host + '/' + oss.oss.object_name;
                    console.log('上传完成,文件名:' + oss.oss.host + '/' + oss.oss.object_name);
                });
                //上传中
                uploader.on('uploadProgress', function (file, percentage) {
                    $('#process' + field.id).show().html(parseInt(percentage * 100) + '%');
                    console.log('上传中,进度:' + parseInt(percentage * 100));
                })
                //上传结束
                uploader.on('uploadComplete', function () {
                    $('#process' + field.id).hide()
                    console.log('上传结束');
                })
            });
        }


    </script>
@endsection