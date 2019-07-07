<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="../include/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../include/dataTable/datatables.min.css">
<link rel="stylesheet" type="text/css" href="../include/css/invoice-style.css">
<link rel="stylesheet" type="text/css" href="../include/css/invoice-style-main-page.css">
<link rel="stylesheet" type="text/css" href="../include/fonts/font-awesome.min.css">
<title>تصميم واجهة فواتير</title>
<script src="../include/js/jquery-3.2.1.min.js"></script>
<script src="../include/js/bootstrap-3.3.7.min.js"></script>
<script src="../include/dataTable/jquery.dataTables.min.js"></script>
<script src="../include/dataTable/datatables.min.js"></script>

</head>

<style>
.fa-twitter-s{
	font-size: 40px;
	color:#50abf3;
}

.fa-youtube-s {
	font-size: 40px;
	color:#ef1c1b;
}

@media (min-width: 768px){
	.fa-bell-s {
		color:#fff;
		margin-left:10px;
		margin-top:20px;
	}
}
@media (max-width: 767px){
	.fa-bell-s {
		color:#fff;
		margin-left:5px;
	}
}

/*  hide search box default of searchTable */
.dataTables_filter {
     display: none;
}
.dataTables_length{
     display: none;
}

</style>
<!--   style="font-size:large;" -->
<body style="background-color:#fafafa;">

<div id="menubar" class="main-menu">
<nav class="navbar">
  <div class="container-fluid navbar-my-default  navbar-fixed-top">
    <div class="container">
    	<div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#asideNav">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>                        
          </button>
          <a class="navbar-brand" href="#"><img src="../img/logo.png" height="50" /></a>
          
          <!-- if not work collapse use this -->
          <!--
            <div class="collapse navbar-collapse" id="myNavbar">
              <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#">Page 1</a></li>
                <li><a href="#">Page 2</a></li> 
                <li><a href="#">Page 3</a></li> 
              </ul>
            </div>
         -->
		 <div class="navbar-toggle navbar-toggle-inv">
			<span align="center" class="navbar-left">
			  <a href="#" style="font-size:large;"><i class="fa fa-circle fa-3x"></i></a>
			</span>
			<span align="center" class="navbar-left">
			  <i><a href="#"><i class="fa fa-bell-o fa-bell-s"></i></a></i>
			</span>
			<span align="center" class="navbar-left">
			  <i><a href="#"><i class="fa fa-twitter fa-bell-s"></i></a></i>
			</span>
        </div>
        </div>
		
		 <div class="navbar-left hidden-xs">
			<span align="center" class="navbar-left">
			  <a href="#" style="font-size:large;"><i class="fa fa-circle fa-3x"></i></a>
			</span>
			<span align="center" class="navbar-left">
			  <i><a href="#"><i class="fa fa-bell-o fa-bell-s"></i></a></i>
			</span>
			<span align="center" class="navbar-left">
			  <i><a href="#"><i class="fa fa-twitter fa-bell-s"></i></a></i>
			</span>
        </div>
        
        
        
        
    </div><!--  End container 1 -->
 </div> <!-- End container-fluid 1 -->
</nav>
</div>
<!--   style="font-size:x-large;"  -->
 <div class="navbar-default  navbar-fixed-top" style="margin-top:105px;">
    <div class="collapse navbar-collapse" id="asideNav">
      <div class="aside-in col-lg-2">
          <ul class="nav navbar-nav nav-in">
          <li><div class="hr-inv"></div>
            <button type="button" class="btn btn-success btn-block btn-block-in btn-success-in">إنشاء فاتورة جديدة</button>
            <li class="active"><a data-toggle="tab" href="#inbox">الفواتير الواردة <i class="fa fa-send-o fa-rotate-180"></i></a></li>
            <li><a data-toggle="tab" href="#sent">الفواتير المرسلة <i class="fa fa-send-o"></i></a></li>
			<li><a data-toggle="tab" href="#stars">الفواتير المميزة بنجمة <i class="fa fa-star-o"></i></a></li>
            <li><a data-toggle="tab" href="#trash">الفواتير المهملة <i class="fa fa-trash-o"></i></a></li>
          </ul>
        </div>
    </div>
 </div>
 
 
 <div class="container-fluid navbar-default  navbar-fixed-top container-fluid-inv" style="margin-top:70px;">
    <div class="col-lg-2" style="float: right;margin-right: -10px;">
        <button type="button" class="btn btn-success btn-block btn-block-in-branch btn-success-in">إضافة فرع</button>
    </div>
 	<div class="container con-inv">
    	<ul class="nav navbar-nav navbar-right" style="margin-right:0%;">
          
            <li class="dropdown li-inv-h">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class=" i-invo"><span class="caret"></span></i></a>
                <ul class="dropdown-menu">
                  <li><a href="#">الكل</a></li>
                  <li><a href="#">لاشيء</a></li>
                  <li><a href="#">مقروءة</a></li>
                  <li><a href="#">غير مقروءة</a></li>
                  <li><a href="#">المميزة بنجمة</a></li>
                  <li><a href="#">بدون نجمة</a></li>
                  <li><a href="#">المهمة</a></li>
                  <li><a href="#"></a></li>
                  <li><a href="#"></a></li>
                </ul>
                <a href="#"><i class="fa fa-square-o" ></i></a>
          	</li>
            <li id="nnn"></li>
            <li class="li-inv-h">
            	<span>
                    <a href="#"><i class="fa fa-undo" ></i></a>
                </span>
            </li>
            <li class="dropdown li-inv-h">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class=" i-invo"><span class="caret"></span></i></a>
                <ul class="dropdown-menu">
                  <li><a href="#">وضع علامة مقروءة على الجميع</a></li>
                  <li><hr class="hr-inv"></li>
                  <li style="text-align: right;padding-right: 20px; color:#999;">حدد رسائل للاطلاع على مزيد من الاجراءات</li>
                </ul>
                <a href="#">المزيد</a>
          	</li>
            
          </ul>
          
          <!--
          <div class="show_page" id="dd"></div>
          -->
          
    	<form class="navbar-form navbar-left">
          <div class="input-group">
            
            <div class="input-group-btn">
              <button class="btn btn-primary" type="submit">
                <i class="glyphicon glyphicon-search"></i>
              </button>
            </div>
            <input type="text" class="form-control" id="searchBox">
          </div>
        </form>
        
        
    </div>
    
    
 </div>
</nav>
</div><!---- End Header (main-menu) ----->

<hr>

             
<div class="col-lg-10-inv col-lg-10" style="background:#fff; margin-top:17px;">
	<div class="tab-content">   
  		<div id="inbox" class="tab-pane fade in active"> 
	      	<?php require('inv_inbox_cust.php'); ?>
    	</div>
        <div id="sent" class="tab-pane fade">
        	<?php require('inv_send_cust.php'); ?>
        </div>
        <div id="stars" class="tab-pane fade">
        	<?php require('inv_stars_cust.php'); ?>
        </div>
        <div id="trash" class="tab-pane fade">
        	<?php require('inv_trash_cust.php'); ?> 
        </div>
	</div>

</div>



</body>
</html>
<script type="text/javascript">
	
	$(document).ready(function() {
		var dataTable = $('#example').dataTable();

		$("#searchBox").keyup(function() {
			dataTable.fnFilter(this.value);
		}); 		
	});
</script>
<script type="text/javascript">
	
	$(document).ready(function() {
        var table = $('#data-table').dataTable({
			"pageLength":13
		});
		$('#searchBox').keyup(function() {
		   table.fnFilter(this.value);
		});
		
		$(document).on('click','.delete',function(){
			var id = $(this).attr("id");
			if(confirm("Are you sure you want to remove this?")){
				window.location.href == "invoice.php?delete=1&id="+id;
			}else{
				return false;
			}
		});
		
    });

</script>