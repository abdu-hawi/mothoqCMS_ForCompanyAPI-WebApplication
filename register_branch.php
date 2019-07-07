<?php

			require_once('include_db/session.php');
			$res = '';
			if($_SESSION['cominfo'] != false)
				$com_id = $_SESSION['cominfo']->com_id;
			else
				$com_id = $_SESSION['com_id'];
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
.radio-inline+.radio-inline, .checkbox-inline+.checkbox-inline {
    margin-top: 0;
    margin-right: 10px;
}
.radio-inline, .checkbox-inline {
    display: inline-block;
    padding-right: 20px;
    margin-bottom: 0;
    font-weight: 900;
    float: right;
}
</style>

<div>
<div class="col-lg-4 col-md-6 hidden-xs con-mar-top"></div>
	<div class="col-lg-4  col-md-6 col-sm-12 col-xs-12 con-mar-top">
					
					
					<?php echo $res ; ?>
					
					
    	<form method="post" action="include_db/saveBranch.php">
    	<div class="panel panel-info">
        	<div class="panel-heading">
            	تسجيل فرع الشركة
            </div>
            <div class="panel-body">
													<input class="hidden" value="<?php echo $com_id ?>" name="com_id" />
            	<input class="form-control" type="text" placeholder="إسم الفرع" name="name" />
                <input class="form-control" type="password" placeholder="ادخل كلمة المرور" name="password" />
																
																<label class="radio-inline">
																		<input type="radio" name="bra_stat" value="9">موزع
																</label>
																<label class="radio-inline">
																		<input type="radio" name="bra_stat" value="8">فرع
																</label>
																				<br/>
																				
                <a href="#">يبرممج لاحقا للحذف</a>
                <br/><br/>
                <button class="btn btn-info btn-block" type="submit" name="submit">تسجيل فرع جديد</button>
            </div><!-- End panel bode -->
        </div><!-- End panel -->
        </form>
    </div>
</div>



</body>
</html>
