<?php

include "../../include_db/db.php";

$user_no = strip_tags(trim($_POST['user_id']));;
$shop_name = strip_tags(trim($_POST['shop_name']));
$shop_desc = strip_tags(trim($_POST['shop_desc']));
$order_date = strip_tags(trim($_POST['order_date']));
$total_amount = strip_tags(trim($_POST['final_total_amt']));

$date = date("Y-m-d H:i:s" ) ;
try{
    $tf_handle -> query("Begain Transaction"); 
                
    $qry = $tf_handle->query("INSERT INTO `tbl_order_system`
        (`order_id`, `com_id`, `bra_id`, `user_id`, `invoice_no`, `date_invoice`, `total_amount`, `date`, `invoice_status`, `shop_name`, `shop_desc` )
        VALUES (NULL, 12, 16, '$user_no', 1 , '$order_date', '$total_amount', '$date', 0 , '$shop_name' , '$shop_desc')");
    if($qry) {
        $last_id = $tf_handle->insert_id; // $last_id -> use to save item array with forgin key in item_table
        
        for($count=0 ; $count<$_POST["total_item"] ; $count++){
            
            $item_name = trim($_POST['item_name'][$count]);
            $item_qty = trim($_POST['order_item_quantity'][$count]);
            $item_price = trim($_POST['order_item_price'][$count]);
            
            $qry_item = $tf_handle->query("INSERT INTO `tbl_order_system_item`
                (`ord_prod_id`, `order_id`, `prod_name`, `prod_qty`, `prod_price`)
                VALUES (NULL, '$last_id', '$item_name', '$item_qty', '$item_price')");
            
            if($qry_item){
                $tf_handle->query("Commit");
                echo 'okInsert';
            }else{
                $tf_handle->query("DELETE FROM `tbl_order_system` WHERE `order_id` = ".$last_id);
                $tf_handle->query("Rollback Transaction");
            }
            
        } // end for loop count
    } // end if $qry
}catch(Exception $e){
    $tf_handle->query("Rollback Transaction");
}
?>