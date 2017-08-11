<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>控制台</title>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/layout.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}" />
    <link rel="stylesheet" href="{{asset('node_modules/hdjs/css/bootstrap.min.css')}}">

    <script type="text/javascript" src="{{asset('js/jquery-1.7.2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/haidao.offcial.general.js')}}"></script>
    <script>
        hdjs = {
            'base': '/node_modules/hdjs',
        }
    </script>
    <script src="{{asset('node_modules/hdjs/app/util.js')}}"></script>
    <script src="{{asset('node_modules/hdjs/require.js')}}"></script>
    <script src="{{asset('node_modules/hdjs/config.js')}}"></script>
    <script>
        require(['jquery'], function ($,util) {
            //为异步请求设置CSRF令牌
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        })
    </script>
</head>

<body>
{{--顶部--}}
<div class="view-topbar">
    {{--顶部管理控制台--}}
    <div class="topbar-console">
        <div class="tobar-head fl">
            <a href="#" class="topbar-logo fl">
                <span><img src="{{asset('images/logo.png')}}" width="20" height="20"/></span>
            </a>
            <a href="#" class="topbar-home-link topbar-btn text-center fl"><span>管理控制台</span></a>
        </div>
    </div>
    <div class="topbar-info">
        <ul class="fr">
            <li class="fl dropdown topbar-notice topbar-btn">
                <a href="#" class="dropdown-toggle">
                    <span class="icon-notice"></span>
                    {{--<span class="topbar-num have">0</span>--}}
                </a>
            </li>
            <li class="fl topbar-info-item">
                <div class="dropdown">
                    <a href="#" class="topbar-btn">
                        <span class="fl text-normal">帮助与文档</span>
                        <span class="icon-arrow-down"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#">使用文档</a></li>
                        <li><a href="#">联系我们</a></li>
                    </ul>
                </div>
            </li>
            <li class="fl topbar-info-item">
                <div class="dropdown">
                    <a href="#" class="topbar-btn">
                        <span class="fl text-normal">{{Auth::guard('admin')->user()->name}}</span>
                        <span class="icon-arrow-down"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="/admin/changepassword">修改密码</a></li>
                        <li><a href="/admin/logout">退出</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>
{{--顶部一下部分--}}
<div class="view-body">
    {{--侧边栏--}}
    <div class="view-sidebar">
        <div class="sidebar-content">
            <div class="sidebar-nav">
                <div class="sidebar-title">
                    <a href="#">
                        <span class="icon"><b class="fl icon-arrow-down"></b></span>
                        <span class="text-normal">便签管理</span>
                    </a>
                </div>
                <ul class="sidebar-trans">
                    <li>
                        <a href="/admin/tag">
                            <b class="sidebar-icon"><img src="{{asset('images/icon_author.png')}}" width="16" height="16" /></b>
                            <span class="text-normal">标签列表</span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/tag/create">
                            <b class="sidebar-icon"><img src="{{asset('images/icon_message.png')}}" width="16" height="16" /></b>
                            <span class="text-normal">添加标签</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="sidebar-nav">
                <div class="sidebar-title">
                    <a href="#">
                        <span class="icon"><b class="fl icon-arrow-down"></b></span>
                        <span class="text-normal">视频管理</span>
                    </a>
                </div>
                <ul class="sidebar-trans">
                    <li>
                        <a href="/admin/video">
                            <b class="sidebar-icon"><img src="{{asset('images/icon_cost.png')}}" width="16" height="16" /></b>
                            <span class="text-normal">视频列表</span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/video/create">
                            <b class="sidebar-icon"><img src="{{asset('images/icon_authentication.png')}}" width="16" height="16" /></b>
                            <span class="text-normal">视频添加</span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
    {{--内容区--}}
    <div class="view-product background-color">
        @yield('content')
    </div>
</div>

<script>
    $(".sidebar-title").live('click', function() {
        if ($(this).parent(".sidebar-nav").hasClass("sidebar-nav-fold")) {
            $(this).next().slideDown(200);
            $(this).parent(".sidebar-nav").removeClass("sidebar-nav-fold");
        } else {
            $(this).next().slideUp(200);
            $(this).parent(".sidebar-nav").addClass("sidebar-nav-fold");
        }
    });
</script>


</body>

</html>