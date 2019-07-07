<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="../include/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../include/fonts/font-awesome.min.css">
<title>موثوق</title>

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
          <a class="navbar-brand" href="#"><img src="../img/logo.png" height="50" /></a>
          
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

.ok{
	background:#deffdf; 
	padding:12px; 
	width:90%; 
	border:1px solid #00b304; 
	margin-left:auto; 
	margin-right:auto; 
	color:#707d28;
	border-radius:7px;	
}
.no{
	background:#ffdede; 
	padding:12px; 
	width:90%; 
	border:1px solid #d30000; 
	margin-left:auto; 
	margin-right:auto; 
	color:#ff0000;
	border-radius:7px;
}
</style>

<div>
<div class="col-lg-4 col-md-6 hidden-xs con-mar-top"></div>
	
	<div class="col-lg-4  col-md-6 col-sm-12 col-xs-12 con-mar-top">
		
		<div class="alert alert-success">
				 تم تسجيل المستخدم بنجاح لتسجيل الدخول <strong><a href="../login.php">إضغط هنا</a></strong>
		</div>
    </div>
</div>



</body>
</html>
<!--
<script type="text/javascript">
	$(document).ready(function(){
					var da_form = $('#add_user').serialize();
					$.post('saveUser.php',da_form,function(data){
								//okInsert value is coming from post.add.php if is true insert to db
								if(data == 'okInsert'){
									$('#show').html('<div class=\'ok\'>تمت إضافة الخبر بنجاح</div>');
								}else{
									$('#show').html(data);
								}
					});
	});
</script>
-->