<?php

	require_once('../include_db/session.php');
	if ($_SESSION['userinfo'] == false){
		if ($_SESSION['cominfo'] == false){
			header("Location:../login.php");
		}
	}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="../include/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../include/dataTable/datatables.min.css">
<link rel="stylesheet" type="text/css" href="../include/css/invoice-style1.css">
<link rel="stylesheet" type="text/css" href="../include/css/invoice-style-main-page.css">
<link rel="stylesheet" type="text/css" href="../include/fonts/font-awesome.min.css">
<title>تصميم واجهة فواتير</title>
<script src="../include/js/jquery-3.2.1.min.js"></script>
<script src="../include/js/bootstrap-3.3.7.min.js"></script>
<script src="../include/dataTable/jquery.dataTables.min.js"></script>
<script src="abdu.js"></script>

</head>

<style>
	@media (min-width: 768px){
			.hidden-lg.navbar-collapse.collapse {
							display: none!important;
			}
	}
	
@media (min-width: 768px){
			.hidden-lg{
							display: none!important;
			}
	}
	
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
		  font-size: large;
		color:#fff;
		margin-left:10px;
		margin-top:0.95em;
		
    text-align:center;
    vertical-align:middle;
    position: relative;
	}

}
@media (max-width: 767px){
	.fa-bell-s {
		  font-size: large;
    color: #fff;
    margin-left: 0.2em;
				margin-right: 0.2em;
    /*margin-top: 0.5em;*/
				
    text-align:center;
    vertical-align:middle;
    position: relative;
	}

}

/*  hide search box default of searchTable 24b9a4*/
.dataTables_filter {
     display: none;
}
.dataTables_length{
     display: none;
}

.btn-success{color:#fff;background-color:#cdcd00;border-color:#7e7e00}
 .btn-success:hover,.btn-success:focus,.btn-success.focus,.btn-success:active,.btn-success.active,.open>.dropdown-toggle.btn-success{color:#fff;background-color:#9a9d44;border-color:#828614}.btn-success:active,.btn-success.active,.open>.dropdown-toggle.btn-success{background-image:none}
 .btn-success.disabled,.btn-success[disabled],fieldset[disabled] .btn-success,.btn-success.disabled:hover,.btn-success[disabled]:hover,fieldset[disabled] .btn-success:hover,.btn-success.disabled:focus,.btn-success[disabled]:focus,fieldset[disabled] .btn-success:focus,.btn-success.disabled.focus,.btn-success[disabled].focus,fieldset[disabled] .btn-success.focus,.btn-success.disabled:active,.btn-success[disabled]:active,fieldset[disabled] .btn-success:active,.btn-success.disabled.active,.btn-success[disabled].active,fieldset[disabled] .btn-success.active{background-color:#cdcd00;border-color:#828614}
 .btn-success .badge{color:#cdcd00;background-color:#fff}

@media (min-width:768px){
	hr {
		display: block;
		margin-top: 4.2em;
		margin-bottom:0px;
		margin-left: auto;
		margin-right: auto;
		border-style:solid;
		border-width: 1px;
		color: #000;
	}
}



@media (max-width:1200px){
	.col-lg-10-inv{
			margin-top: 0px;
			margin-right: 0px;
	}
}

@media (min-width:768px){
	.col-lg-10-inv{
			border-right: 1px solid #000;
			margin-top: 20px;
			margin-right: 0px;
	}
}
@media (max-width:767px){
	hr {
    margin-top: 7.3em;
    margin-bottom: 20px;
    border: 0;
    border-top: 1px solid #eee;
	}
	.col-lg-10-inv{
			margin-top: 9em;
		margin-right: -2em;
		border-bottom: 1px solid #000;
	}
}
@media (max-width:767px){
.col-lg-10-invoi{
			margin-top: -3em;
		margin-right: -2em;
	}
	.asi-nav{
		background-color: #f9f9f9;
		margin-top:8.8em ;
		margin-right: -2em;
	}
}



.nav-inv > ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #f9f9f9;
}

.nav-inv > li {
    float: right;
}

.nav-inv > li a {
    display: block;
    color: black;
    text-align: center;
    padding: 8px ;
    text-decoration: none;
}

.nav-inv > li a:hover {
    background-color: #555555;
				color: #fff;
}
.nav-inv  >.active>a {
    background-color: #e7e7e7;
				color: #333;
}

</style>
<!--   style="font-size:large;" -->
<body style="background-color:#fff;">
<?php 

require('header.php');

?>
     <div class="col-lg-12 collapse hidden-lg" id="asideNav">
										<ul class="nav navbar-nav nav-in nav-inv">
												<button type="button" class="btn btn-success btn-block btn-block-in btn-success-in coll" id="new_invo">إنشاء فاتورة يدوية</button>
												<li class="active"><a data-toggle="tab" href="#inbox_href" class="collba" id="inbox">الفواتير الواردة <i class="fa fa-send-o fa-rotate-180"></i></a></li>
												<li><a data-toggle="tab" href="#str_href" class="coll" id="str">الفواتير المميزة بنجمة <i class="fa fa-star-o"></i></a></li>
												<li><a data-toggle="tab" href="#fav_href" class="coll" id="fav">الفواتير المفضلة <i class="fa fa-heart-o"></i></a></li>
												<li><a data-toggle="tab" href="#manual" class="coll" id="manual">الفواتير اليدوية <i class="fa fa-pencil"></i></a></li>
												<li><a data-toggle="tab" href="#trash" class="coll" id="tra">الفواتير المهملة <i class="fa fa-trash-o"></i></a></li>
										</ul>	
					</div>    
<div class="col-lg-10-inv col-lg-10 col-md-10 col-sm-9" id="asid-down" style="background:#fff;">
	<?php //echo $order_id; ?>
	<div class="tab-content">   
  		<div id="inbox_href" class="tab-pane fade in active"> 
    </div>
				
				<div id="trash" class="tab-pane fade">
				   	
				</div>
				<div id="fav_href" class="tab-pane fade">
				</div>
				<div id="str_href" class="tab-pane fade">
				</div>
				<div id="ord" class="tab-pane fade">
				</div>
	</div>

</div>



</body>
</html>
<script type="text/javascript">
	
	$(document).ready(function() {
		var dataTable = $('#example').dataTable({
					"pageLength":12
		});

		$("#searchBox").keyup(function() {
			dataTable.fnFilter(this.value);
		}); 		
	});
</script>
<script type="text/javascript">
	
$(document).ready(function() {

var x = $('.id_hidden').attr('id');
var y = 0 ;
				function isalert(){ // this function to show number of alert in bell
					//alert(x);
					$.ajax({
								url:'isAle.php',
								type:'POST',
								data:{x:x },
								success:function(data){
											if(data > 0){
														if(data != y){
																	y = data;
																	$('.fa-be').append('<style>.fa-be:after{ content:"'+data+'"; position: absolute; background: red; height:1.5rem; top:1rem; left:1.5rem;width:1.5rem;text-align: center; line-height: 1.25rem; font-size: 1rem; border-radius: 100%; color:white; border:1px solid red;}</style>');
														}
											}
								}// end success
						});// end ajax
					return false;
				}
		setInterval(function(){ isalert(); }, 1000);
		
		function menualert(){ // this function to show drop menu of alert in bell
					//alert(x);
					
					$.ajax({
								url:'bel_menu.php',
								type:'POST',
								data:{x:x },
								success:function(data){
											 //id="ale_men"
												//alert(data);
												$('#ale_men').html(data);
								}// end success
						});// end ajax
		} // end function menualert 
		$('.fa-be').click(function(){
					if (y != 0){
								$('#ale_men').removeClass('hidden');
								$('#ale_men').addClass('dropdown-menu');
								menualert();
					}
		});
		
		$(window).bind("resize", function () {
        if ($(this).width() > 767) {
												$('#asideNav').removeClass("col-lg-10-invoi");
            $('#asideNav').addClass("col-lg-10-inv");
        } 
    }).resize();
		//.trigger('resize');
		
				
	
	
});

</script>