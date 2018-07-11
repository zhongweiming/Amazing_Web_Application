<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>登陆</title>
<link type="text/css" rel="stylesheet" href="styles/reset.css">
<link type="text/css" rel="stylesheet" href="styles/main.css">
<!--[if IE 6]>
<script type="text/javascript" src="js/DD_belatedPNG_0.0.8a-min.js"></script>
<script type="text/javascript" src="js/ie6Fixpng.js"></script>
<![endif]-->
</head>

<body>
<div class="headerBar">
	<div class="logoBar login_logo">
		<div class="comWidth">
			<div class="logo fl">
				<a href="#"><img src="images/logo.png" alt="乐易"></a>
			</div>
			<h3 class="welcome_title">欢迎登陆</h3>
		</div>
	</div>
</div>

<div class="loginBox">
	<div class="login_cont">
	<form method="post" action="doAction.php?act=login" >
		<ul class="login">
			<li class="l_tit">邮箱/用户名/手机号</li>
			<li class="mb_10"><input type="text"  name="username" placeholder="请输入用户名" class="login_input user_icon"></li>
			<li class="l_tit">密码</li>
			<li class="mb_10"><input type="password" name="password" class="login_input user_icon"></li>
			<li class="autoLogin"><input type="checkbox" id="a1" class="checked"><label for="a1">自动登陆</label></li>
			<li><input type="submit" value="" class="login_btn"></li>
		</ul>
		</form>

	<a class="reg_link" href="reg.php"></a>
</div>
</html>
