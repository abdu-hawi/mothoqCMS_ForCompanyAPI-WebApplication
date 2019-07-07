<?php

require_once('../include_db/session.php');
require_once('../include_db/db.php');
if(!isset($_POST['id']) && ($_SESSION['userinfo'] == false || $_SESSION['cominfo'] == false ) ) return false;
$order_no = intval($_POST['id']);
$tf_handle->query("UPDATE `tbl_order_system` SET `isRead` = 0 WHERE `order_id` = '$order_no'");
$stmt = $tf_handle->query("SELECT * FROM `invoice` WHERE `order_id` = '$order_no'");
if(!$stmt){
	header('Location: '.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
	die;
}
while($row = mysqli_fetch_assoc($stmt)){
	
?>
<br/>
<div style="margin: 0 50px;">
	<div class="pull-right">
		<?php
			if ($row["isFav"] == 0){
				echo '<span class="fa-m-inv">
				<i class="fa fa-heart-o hrt fa-2x" id='.$order_no.' style="margin: 0 10px;">
				</i></span>';
			}else{
				echo '<span class="fa-m-inv">
				 <i style="color:#da0000;margin: 0 10px;" class="fa fa-heart hrt fa-2x" id='.$order_no.'>
				 </i></span>';
			}
			if ($row["isStr"] == 0){
				echo '<span class="fa-m-inv">
				<i class="fa fa-star-o fa-2x str" id='.$order_no.'>
				</i></span>';
			}else{
				echo '<span class="fa-m-inv">
				<i style="color:#dacd00;" class="fa fa-star fa-2x str" id='.$order_no.'>
				</i></span>';
			}
		?>
	</div>
	<div>
		<a style="text-decoration: none;" href="../include_html2pdf/print.php?pdf=1&id=<?php echo $order_no ?>" target="_blank">
			<span><i style="color:#267FBA;" class="fa fa-print fa-2x"></i></span>
		</a>
		<a style="text-decoration: none;" href="#" id="<?php echo $order_no ?>" class="inTrash">
			<span><i style="color:#f00; margin: 0 10px;" class="fa fa-trash-o fa-2x"></i></span>
		</a>
	</div>
</div><br/>
<table class="table table-bordered">
	<tr>             
        <td colspan="2" align="center">
            <h2 style="margin-top:5.5px">
                <img src="../img/<?php echo $row["com_img"]; ?>.png" width="300" />
            </h2>
            <h2 style="margin-top:30.5px">
                <?php echo $row["bra_name"]; ?>
            </h2>
            <h3 style="margin-top:10.5px">
                <?php echo $row["date_invoice"]; ?>
            </h3>
        </td>
    </tr>
    <!-- START TR -->
    
    <tr>
        <td colspan="2" align="center">
        
            <div>
                <b>رقم الشركة/العميل: </b><span><?php echo $row["user_id"]; ?></span>
             </div>
			<?php
				$user_cus = $row["user_id"];
				$stmt_cus = $tf_handle->query("SELECT `user_name` FROM `users` WHERE `user_id` = '$user_cus'");
				$user = mysqli_fetch_assoc($stmt_cus);
			?>
			
            <div>
                <b>إسم الشركة/العميل: </b><span><?php echo $user["user_name"];?></span>
                
            </div>
                
            
        <table id="invoice-item-table" class="table table-bordered" style="margin-top:5px;">
            <tr>
                <th class="text-center">تسلسل</th>
                <th class="col-lg-7 text-right">إسم المنتج</th>
                <th class="col-lg-1 text-center">الكمية</th>
                <th class="col-lg-2 text-center">السعر</th>
                <th class="col-lg-2 text-center">الاجمالي</th>
            </tr>
            <tr>
				<?php
				$stmt_ord = $tf_handle->query("SELECT * FROM `tbl_order_system_item` WHERE `order_id` = '$order_no'");
				$sr_no = 0;
				if(!$stmt_ord) die('done');
				while($row_item = mysqli_fetch_assoc($stmt_ord) ){
					$sr_no = $sr_no +1 ;
				?>
                <td id="sr_no" class="text-center"><?php echo $sr_no; ?></td>
                <td>
                	<?php echo $row_item["prod_name"]; ?>
                </td>
                <td class="text-center">
                	<?php
						$qty = $row_item["prod_qty"];
						echo $qty;
					?>
                </td>
                <td class="text-center">
                	<?php
						$price = $row_item["prod_price"];
						echo $price;
					?>
                </td>
                <td class="text-center">
                	<?php echo $price * $qty; ?>
                </td>
            </tr>
				<?php
				}// End while of item	
				?>
        </table>
        </td>
    </tr>
    
    <!-- END TR -->
    
    <tr>
		
        <td align="right" class="col-lg-10"><b class="pull-left">الإجمالي الصافي</b></td>
        <td align="center" class="col-lg-2" style="background:#f5f5f5;">
        	<b><?php echo $row["total_amount"];?></b>
        </td>
    </tr>
    
    <tr>
        <td colspan="2" align="center">
            <b>رقم الفاتورة: </b><br /><span><?php echo $row["invoice_no"]; ?></span>
            <br />
            <b>الشروط والأحكام: </b><br /><span>lblblblblblblblblblblblblblblblblb</span>
        </td>
    </tr>
</table>

<?php
} /// end loop for all invoice
?>
<script>
	
	// start star
	$('.str').click(function(){
		var str_id = $(this).attr('id');
		var str_stat = 0 ;
		function change_str_stat(){
			$.ajax({
				url:'isStar.php',
				type:'POST',
				data:{str_id:str_id , str_stat:str_stat},
				success:function(data_str){
					if(data_str != ''){
					}
				}
			});
		}
		if ($(this).hasClass("fa-star-o")) {
			$(this).removeClass("fa-star-o");
			$(this).addClass("fa-star");
			$(this).css({'color':'#dacd00'});
			str_stat = 1;
			change_str_stat();
		}else{
			$(this).removeClass("fa-star");
			$(this).addClass("fa-star-o");
			$(this).css({'color':'black'});
			str_stat = 0 ;
			change_str_stat();
		}
	});
	// end star
	
	// start fav
	$('.hrt').click(function(){
		var fav_id = $(this).attr('id');
		var fav_stat = 0 ;
		function change_fav_stat(){
			$.ajax({
				url:'isFavor.php',
				type:'POST',
				data:{fav_id:fav_id , fav_stat:fav_stat},
				success:function(data_fav){
					if(data_fav != ''){
					}
				}
			});
		}
		if ($(this).hasClass("fa-heart-o")) {
			$(this).removeClass("fa-heart-o");
			$(this).addClass("fa-heart");
			$(this).css({'color':'#da0000'});
			fav_stat = 1;
			change_fav_stat();
		}else{
			$(this).removeClass("fa-heart");
			$(this).addClass("fa-heart-o");
			$(this).css({'color':'black'});
			fav_stat = 0;
			change_fav_stat();
		}
	});
	
	


 
</script>