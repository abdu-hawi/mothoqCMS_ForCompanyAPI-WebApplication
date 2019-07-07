<?php

require_once('include_db/session.php');
$_SESSION['fail'] = false;

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="include/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="include/fonts/font-awesome.min.css">
<title>موثوق</title>
<script src="include/js/jquery-3.2.1.min.js"></script>
<script src="include/js/bootstrap-3.3.7.min.js"></script>

</head>

<style>

.navbar-header{
	float:right !important
}

.navbar-login {
    background-color: #24b9a5;
    border-bottom: 1px solid #000;
    padding-bottom: 10px;
    padding-top: 10px;
}
</style>
<!--   style="font-size:large;" -->
<body style="background-color:#fafafa;">

<div id="menubar" class="main-menu">
<nav class="navbar">
  <div class="container-fluid navbar-fixed-top navbar-login">
    <div class="container">
    	<div class="navbar-header">
          <a class="navbar-brand" href="#"><img src="img/logo.png" height="50" /></a>
          
        </div>
		
		 <div class="navbar-left">
			<span align="center" class="navbar-left">
			  <a href="#" style="font-size:large;"><i class="fa fa-circle fa-3x"></i></a>
			</span>
			<span align="center">
				اللغة
			</span>
        </div>
        
        
    </div><!--  End container 1 -->
 </div> <!-- End container-fluid 1 -->
<!--   style="font-size:x-large;"  -->
</nav> 
</div><!---- End Header (main-menu) ----->

<style>
.con-mar-top{
	margin-top:3em;
	float:right;
	text-align:right;
}
.form-control{
	text-align: right;
	margin-bottom:10px;	
}
</style>

<div>
<div class="col-lg-2 col-md-1 hidden-xs con-mar-top"></div>
	<div class="col-lg-4  col-md-5 col-sm-12 col-xs-12 con-mar-top">
    	<form method="post" action="include_db/checkLoginUser.php">
    	<div class="panel panel-info">
        	<div class="panel-heading">
            	تسجيل الدخول للأفراد
            </div>
            <div class="panel-body">
            	<input class="form-control" type="text" placeholder="إسم المستخدم أو الجوال أو الايميل" name="userName" />
                <input class="form-control" type="password" placeholder="ادخل كلمة المرور" name="password" />
                <a href="rest_password.php">نسيت كلمة المرور</a> <a href="register.php" class="pull-left">تسجيل جديد</a>
                <br/><br/>
                <button class="btn btn-info btn-block" type="submit" name="submit">تسجيل الدخول</button>
            </div><!-- End panel bode -->
        </div><!-- End panel -->
        </form>
    </div>
    
    <div class="col-lg-4  col-md-5 col-sm-12 col-xs-12 con-mar-top">
    	<form method="post" action="include_db/checkLoginCom.php">
    	<div class="panel panel-success">
        	<div class="panel-heading">
            	تسجيل دخول لقطاع الأعمال
            </div>
            <div class="panel-body">
            	<input class="form-control" type="text" placeholder="إسم المستخدم أو الجوال أو الايميل" name="userName" />
                <input class="form-control" type="password" placeholder="ادخل كلمة المرور" name="password" />
                
                <a href="register_com.php" class="pull-left">تسجيل جديد</a>
                <br/><br/>
                <button class="btn btn-success btn-block" type="submit" name="submit">تسجيل الدخول لقطاع الأعمال</button>
            </div><!-- End panel bode -->
        </div><!-- End panel -->
        </form>
    </div>
    
</div>




</body>
</html>
