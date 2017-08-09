<!doctype html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
		<title>某某科技</title>
		<meta name="keywords" content="" />
		<meta name="description" content="" />
		<link href="{{asset('css/layout.css')}}" rel="stylesheet" type="text/css">
		<link href="{{asset('css/login.css')}}" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="{{asset('js/jquery-1.7.2.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/js.js')}}"></script>
	</head>
	<style>
		.ibar {display: none;}
	</style>
	<body class="login-bg">
		<div class="main ">
			<!--登录-->
			<div class="login-dom login-max">
				<div class="logo text-center">
					<a href="#">
					<img src="{{asset('images/logo.png')}}" width="180px" height="180px">
					</a>
				</div>
				<div class="login container " id="login">

					<form class="login-form" action="" method="post" autocomplete="off">

						<div class="login-box border text-small" id="box">
							<div class="name border-bottom">
								{{csrf_field()}}
								<input type="text" placeholder="手机 / 邮箱 / 账号" id="username" name="name" datatype="*" nullmsg="请填写帐号信息">
							</div>
							<div class="pwd">
								<input type="password" placeholder="密码" datatype="*" id="password" name="password" nullmsg="请填写帐号密码">
							</div>
							@if(session('error'))
								<div class="text-red" style="margin-top: 10px;font-size: 18px">
									{{session('error')}}
								</div>
							@endif
						</div>

						<input type="submit" class="btn text-center login-btn" value="立即登录">
					</form>
					<div class="forget">
						<a href="#" class="forget-pwd text-small fl">忘记登录密码？</a><a href="register.html" class="forget-new text-small fr" id="forget-new">创建一个新账号</a>
					</div>
				</div>
			</div>

			<div class="footer text-center text-small ie">
				Copyright 2013-2016 紫云 版权所有 <a href="#" target="_blank"></a>
				<span class="margin-left margin-right">|</span>
				<script src="#" language="JavaScript"></script>
			</div>
			<div class="popupDom">
				<div class="popup text-default">
				</div>
			</div>
		</div>
	</body>
	<script type="text/javascript" src="{{asset('js/Validform_v5.3.2_min.js')}}"></script>
	<script type="text/javascript">
		function popup_msg(msg) {
			$(".popup").html("" + msg + "");
			$(".popupDom").animate({
				"top": "0px"
			}, 400);
			setTimeout(function() {
				$(".popupDom").animate({
					"top": "-40px"
				}, 400);
			}, 2000);
		}

		/*动画（注册）*/
		$(document).ready(function(e) {
			// $("input[name=username]").focus();
			// $('.login-form').Validform({
			// 	ajaxPost: true,
			// 	tiptype: function(msg) {
			// 		if (msg) popup_msg('' + msg + '');
			// 	},
			// 	callback: function(ret) {
			// 		popup_msg('' + ret.info + '');
			// 		if (ret.status == 1) {
			// 			if (ret.uc_user_synlogin) {
			// 				$("body").append(ret.uc_user_synlogin);
			// 			}
			// 			setTimeout("window.location='" + ret.url + "'", 2000);
			// 		}
			// 	}
			// })

		});
	</script>

</html>