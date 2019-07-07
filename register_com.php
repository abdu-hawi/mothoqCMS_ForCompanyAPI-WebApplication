<?php

			require_once('include_db/session.php');
			$res = '';
			if( $_SESSION['fail'] == true){
							 $res = '<div class="alert alert-danger">
																		<strong>خطأ!</strong> يوجد خطأ أثناء التسجيل نرجوا إعادة المحاولة.
																</div>';
			}

							
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="include/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="include/fonts/font-awesome.min.css">
<title>تسجيل قطاع الأعمال</title>
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
<div class="col-lg-4 col-md-6 hidden-xs con-mar-top"></div>
	<div class="col-lg-4  col-md-6 col-sm-12 col-xs-12 con-mar-top">
					
					
					<?php echo $res ; ?>
					
					
    	<form method="post" action="include_db/saveComp.php">
    	<div class="panel panel-warning">
        	<div class="panel-heading">
            	تسجيل شركة جديدة
            </div>
            <div class="panel-body">
            	<input class="form-control" type="text" placeholder="إسم الشركة" name="name" />
                <input class="form-control" type="password" placeholder="ادخل كلمة المرور" name="password" />
                <input class="form-control" type="email" placeholder="ادخل الايميل" name="email" />
																<input class="form-control" type="text" name="img" placeholder="ادخل اسم الصورة بدون امتداد" />
																<textarea class="form-control" rows="5" name="desc" id="comment" placeholder="أكتب وصف مختصر عن الشركة"></textarea>
                <a href="login.php">تسجيل الدخول</a>
                <br/><br/>
                <button class="btn btn-warning btn-block" type="submit" name="submit">تسجيل أعمال جديد</button>
            </div><!-- End panel bode -->
        </div><!-- End panel -->
        </form>
    </div>
</div>



</body>
</html>
