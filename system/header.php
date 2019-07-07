
<div id="menubar" class="main-menu">
<nav class="navbar">
  <div class="container-fluid navbar-my-default  navbar-fixed-top">
    <div class="container">
    	<div class="navbar-header">
          <button type="button" class="navbar-toggle pull-left" data-toggle="collapse" id="btn-coll" data-target="#asideNav" style="margin-left: 15px;">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>                        
          </button>
          
          
          <span align="center" class="navbar-left dropdown hidden-lg">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-bell-o fa-bell-s fa-be" id="fa-be"></i></a>
            <ul class="hidden" id="ale_men" style=" width:25.3em;">
            </ul>
          </span>
          
          <span align="center" class="navbar-left hidden-lg">
             <a href="#" style="color:#fff; font-size:25px;text-decoration:none;"  data-toggle="collapse" data-target="#demo1">
                 <span class="fa-stack fa-stack-3x">
                   <i class="fa fa-circle fa-stack-2x"></i>
                   <strong class="fa-stack-1x text-primary">
                    <?php 
             
                    if($_SESSION["userinfo"] != false)
                     echo substr($_SESSION['userinfo']->user_name , 0 , 1); 
                    else if($_SESSION["cominfo"] != false) 
                     echo substr($_SESSION['cominfo']->com_name , 0 , 1);
                   ?>
                </strong>
              </span>
            </a>
        </span>
         
        <span class="hidden id_hidden" id="
   <?php 
					
						if($_SESSION["userinfo"] != false)
							echo $_SESSION['userinfo']->user_id ;
						else if($_SESSION["cominfo"] != false) 
							echo $_SESSION['cominfo']->com_id;
					?>
     "></span>
        
          
          
          <a class="navbar-brand hidden-xs" href="#"><img src="../img/logo.png" height="50" /></a>
          <a class="navbar-brand hidden-lg" href="#"><img src="../img/logo2.png" height="50" /></a>
          
		 
        </div> <!-- nav bar header -->
		
		 <div class="navbar-left hidden-xs">
			<span align="center" class="navbar-left">
			  <a href="#" style="color:#fff; font-size:25px;"  data-toggle="collapse" data-target="#demo">
                <span class="fa-stack fa-stack-3x">
                  <i class="fa fa-circle fa-stack-2x"></i>
                  <strong class="fa-stack-1x text-primary">
                  	<?php 
					
						if($_SESSION["userinfo"] != false)
							echo substr($_SESSION['userinfo']->user_name , 0 , 1); 
						else if($_SESSION["cominfo"] != false) 
							echo substr($_SESSION['cominfo']->com_name , 0 , 1);
					?>
                  </strong>
                </span>
              </a>
     
			</span>
   <span align="center" class="navbar-left">
    <button id="demo" class="collapse btn btn-primary btn-block" style="margin-top:0.625em;">
     <a href="../include_db/logout.php" style="text-decoration:none;color:#fff;">تسجيل الخروج</a>
    </button>
   </span>
   
			<span align="center" class="navbar-left dropdown">
     <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell-o fa-bell-s fa-be" id="fa-be"></i></a>
     <ul class="dropdown-menu" id="ale_men" style=" width:25.3em;">
      <?php require ('bel_menu.php'); ?>
     </ul>
   </span>
   
			
        </div>
        
        
    </div><!--  End container 1 --><!--
 </div>  End container-fluid 1 

</div>
</nav>
-->
 
 <style>
  .container-fluid {
    padding-right: 0px;
    padding-left: 0px;
    margin-right: auto;
    margin-left: auto;
}
 </style>
 

 <div class="container-fluid navbar-default ">
    <div class="col-lg-2" style="float: right;margin-right: -10px;">
    <?php
		if($_SESSION['cominfo']!= false){
   $com_id = $_SESSION['cominfo']->com_id ;
			echo '
     <form action="../register_branch.php">
       <input class="hidden" value="'.$com_id.'" name="com_id" />
       <button type="submit" class="btn btn-success btn-block btn-block-in-branch btn-success-in" >إضافة فرع</button>
     </form>
     ';
  }else{
			echo '<i style="color:#f9f9f9;">a</i>';
  }
	
	?>
        
    </div>
 	<div class="container">
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
                <a href="#"><i class="fa fa-square-o" id="sqrAll"></i></a>
          	</li>
            <li id="nnn"></li>
            <li class="li-inv-h">
            	<span>
                <a href="#"><i class="fa fa-refresh" id="refresh"></i></a>
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
            <li>
             
                 <button id="demo1" class="collapse btn btn-primary">
                  <a href="../include_db/logout.php" style="text-decoration:none;color:#fff;">تسجيل الخروج</a>
                 </button>
             
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


<script>
  $(document).on('click','#new_invo',function(){
   //window.open("new_cust_inv.php", "", "directories=no,toolbar=no,scrollbars=no,location=no,resizable=yes,top=100,left=0,width=500,height=600",true);
   $.ajax({
     url:'new_cust_inv.php',
     type:'POST',
     success:function(data){
         if(data != ''){
             $('.tab-content').children().remove();
             $('.tab-content').append( "<div id='aja_content'></div>" );
             $('#aja_content').html(data);
         }else{
             $('.tab-content').load('href');
         }
       }
     });
     return false;
  });
</script>
<!--   style="font-size:x-large;"  -->
 <div class="navbar-default hidden-xs" style="margin-top:50px;">
    
      <div class="aside-in col-lg-2 col-md-2 col-sm-3">
        <ul class="nav navbar-nav nav-in">
          <button type="button" class="btn btn-success btn-block btn-block-in btn-success-in" id="new_invo">إنشاء فاتورة يدوية</button>
          <li class="active"><a data-toggle="tab" href="#inbox_href" id="inbox">الفواتير الواردة <i class="fa fa-send-o fa-rotate-180"></i></a></li>
          <li><a data-toggle="tab" href="#str_href" id="str">الفواتير المميزة بنجمة <i class="fa fa-star-o"></i></a></li>
          <li><a data-toggle="tab" href="#fav_href" id="fav">الفواتير المفضلة <i class="fa fa-heart-o"></i></a></li>
          <li><a data-toggle="tab" href="#manual" id="manual">الفواتير اليدوية <i class="fa fa-pencil"></i></a></li>
          <li><a data-toggle="tab" href="#trash" id="tra">الفواتير المهملة <i class="fa fa-trash-o"></i></a></li>
        </ul>
      </div>
    
 </div>