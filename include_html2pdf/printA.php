<?php
while($row = mysqli_fetch_assoc($stmt)){
?>

<page backtop="7mm" backbottom="7mm" backleft="10mm" backright="10mm">
	<style>
		*{
			font-family: aealarabiya;
			direction: rtl;
		}
	</style>
    <table style="width: 100%;">
	<tr>             
        <td style="width: 100%; text-align: center;">
            <h2 style="margin-top: 0px;" >
                <img src="../img/<?php echo $row["com_img"]; ?>.png" width="300" alt="<?php echo $row["com_name"]; ?>"/>
            </h2>
            <h2 style="margin-top: 5px;">
                <?php echo $row["bra_name"]; ?>
            </h2>
            <h3 style="margin-top: 5px;">
                <?php echo $row["date_invoice"]; ?>
            </h3>
			
            <h4 style="margin-top: 5px;">
                <span><?php echo $row["user_id"]; ?></span><b>رقم الشركة/العميل: </b>
             </h4>
			<?php
				$user_cus = $row["user_id"];
				$stmt_cus = $tf_handle->query("SELECT `user_name` FROM `users` WHERE `user_id` = '$user_cus'");
				$user = mysqli_fetch_assoc($stmt_cus);
			?>
			
            <h4 style="margin-top: 5px;">
                <span><?php echo $user["user_name"];?></span><b>اسم الشركة/العميل: </b>
                
            </h4>
        </td>
    </tr>
	<!-- START TR 
    
    <tr>
        <td style="width: 100%; text-align: center;">
			
        </td>
    </tr>-->
	</table>
	
	<table style="width: 100%; direction: rtl;">
		<tr>
			<th style="width: 17%; text-align: center;">الاجمالي</th>
			<th style="width: 17%; text-align: center;">السعر</th>
			<th style="width: 8%; text-align: center;">الكمية</th>
			<th style="width: 53%; text-align: right;">إسم المنتج</th>
			<th style="text-align: center; width: 8%;">تسلسل</th>
		</tr>
	</table>
	
	<?php
		$stmt_ord = $tf_handle->query("SELECT * FROM `tbl_order_system_item` WHERE `order_id` = '$order_no'");
		$sr_no = 0;
		if(!$stmt_ord) die('done');
		while($row_item = mysqli_fetch_assoc($stmt_ord) ){
			$sr_no = $sr_no +1 ;
	?>
	
	<table style="width: 100%; border-top: 1px solid #cccccc; margin-top: 5px;">
		<tr>
			<td  style="width: 17%; text-align: center;">
				<?php
					$qty = $row_item["prod_qty"];
					$price = $row_item["prod_price"];
					echo $price * $qty;
				?>
			</td>
			<td style="width: 17%; text-align: center;">
				<?php echo $price; ?>
			</td>
			<td style="width: 8%; text-align: center;">
				<?php echo $qty; ?>
			</td>
			<td style="width: 53%; text-align: right;">
				<?php echo $row_item["prod_name"]; ?>
			</td>
			<td style="text-align: right; width: 5%;"><?php echo $sr_no; ?></td>
		</tr>
	</table>
	<?php
	}
	?>
	<table cellspacing="0" style="width: 100%; margin-top: 10px; border-top: 1px solid #999999; border-bottom: 1px solid #999999; padding-top: 5px; padding-bottom: 5px;">
        <tr>
            <th style="width: 20%; text-align: left;"><?php echo $row["total_amount"];?> رس</th>
            <th style="width: 80%; text-align: left;">المجموع الكلي: </th>
        </tr>
    </table>
	
	<table style="width: 100%;">
	<tr>             
        <td style="width: 100%; text-align: center;">
            
			<br />
			<b>الشروط والأحكام: </b><br /><span style="width: 50%;" >lblblblblblblblblblblblblblblblblb</span>
			<br /><br />
			<qrcode value="<?php echo $order_no; ?>" style="width: 25mm; border: none;"></qrcode>
			
		</td>
	</tr>
	</table>


</page>

<?php
}
?>