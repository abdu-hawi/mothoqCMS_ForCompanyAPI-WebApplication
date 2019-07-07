<?php

include "../include_db/programDB.php";
include "../include_db/db.php";

$com_id = strip_tags(trim($_POST['com_id']));
$bra_id = strip_tags(trim($_POST['bra_id']));
$com_name = strip_tags(trim($_POST['com_name']));
$bra_name = strip_tags(trim($_POST['bra_name']));
$customer_no = strip_tags(trim($_POST['customer_no']));
$order_date = strip_tags(trim($_POST['order_date']));
$rx_name = strip_tags(trim($_POST['order_recive_name']));
//$order_sup = strip_tags(trim($_POST['order_subject']));
$total_amount = strip_tags(trim($_POST['final_total_amt']));

$date = date("Y-m-d H:i:s" ) ;

try{
    
    $db -> query("Begain Transaction");
    $qry_order = $db->query("INSERT INTO `tbl_oder`
            (`order_id`, `com_name`, `bra_name`, `order_date`, `order_datetime`, `order_total_amount`)
            VALUES (NULL, '$com_name', '$bra_name', '$order_date', '$date', '$total_amount');");
    
    if($qry_order){
        
        $last_id = $db->insert_id; // $last_id -> use to save item array with forgin key in item_table
        
        $qry_item_res = 1; // use to check if the query_item is success or no and send to check if
        $qry_item = true;
        for($count=0 ; $count<$_POST["total_item"] ; $count++){
            
            if($qry_item == false) return;

            $item_name = trim($_POST['item_name'][$count]);
            $item_qty = trim($_POST['order_item_quantity'][$count]);
            $item_price = trim($_POST['order_item_price'][$count]);
            $item_total = trim($_POST['order_item_final_amount'][$count]);
            
            
            
            $qry_item = $db->query("INSERT INTO `tbl_oder_item` 
                (`order_item_id`, `order_id`, `item_name`, `item_quantity`, `item_price`, `item_total`) 
                VALUES (NULL, '$last_id', '$item_name', '$item_qty', '$item_price', '$item_total')");
            
            if(!$qry_item){
                $qry_item_res = 0;
                $qry_item = false;
                return;
            }
        } // end of for loop   
            if($qry_item){
                ////// start db system
                
                $tf_handle -> query("Begain Transaction"); 
                
                $qry_order_system = $tf_handle->query("INSERT INTO `tbl_order_system`
        (`order_id`, `com_id`, `bra_id`, `user_id`, `invoice_no`, `date_invoice`, `total_amount`, `date`, `invoice_status`, `isStr`,`isFav` )
        VALUES (NULL, '$com_id', '$bra_id', '$customer_no', '$last_id', '$order_date', '$total_amount', '$date', 1 , 0 , 0 )");
                if($qry_order_system){
                    
                    $last_id_system = $tf_handle->insert_id; // $last_id -> use to save item array with forgin key in item_table
                    
                    //$qry_item_res = 1; // use to check if the query_item is success or no and send to check if
                    for($count=0 ; $count<$_POST["total_item"] ; $count++){
        
                        $item_name = trim($_POST['item_name'][$count]);
                        $item_qty = trim($_POST['order_item_quantity'][$count]);
                        $item_price = trim($_POST['order_item_price'][$count]);
                        
                        $qry_item = $tf_handle->query("INSERT INTO `tbl_order_system_item`
                            (`ord_prod_id`, `order_id`, `prod_name`, `prod_qty`, `prod_price`)
                            VALUES (NULL, '$last_id_system', '$item_name', '$item_qty', '$item_price')");
                        
                        $tf_handle_qry_res = 0;    
                        if($qry_item){
                            $qry_item_alert = $tf_handle->query("INSERT INTO `isalert`
                                (`user_id`, `order_id`, `is_alert`) VALUES ('$customer_no', '$last_id_system', 1)");
                            if($qry_item_alert){
                                $qry_item_res = 1;
                                $tf_handle_qry_res = 1;
                            }else{
                                $qry_item_res = $qry_item_res * 0;
                                $tf_handle_qry_res = 0;
                            }
                            
                        }else{
                            $qry_item_res = $qry_item_res * 0;
                            $tf_handle_qry_res = 0;
                        }
                        
                    }
                            
                    if($tf_handle_qry_res == 1){ // here get number of all item is insert to db or no
                        $tf_handle->query("Commit"); 
                    }else{
                        /// بكرة تتعالج هذه الاوامر
                        /// اذا رجع لهنا يحذف مباشرة اخر رقم تم ادخاله في جدول الاوامر
                        $db->query("DELETE FROM `tbl_order_system` WHERE `tbl_oder`.`order_id` = ".$last_id_system);
                        $db->query("Rollback Transaction");
                        //$db->query("Rollback Transaction");  
                    }
                    
                }// end of qry_order
                else{ // else of db sysetm
                    $qry_item_res = 0;
                    $db->query("Rollback Transaction");
                } // end else of qry_order
                
                
                
            //////////////
            }else{ // else of db programm
                $qry_item_res = $qry_item_res * 0;
            }
            
        //} // end of for loop
                
        if($qry_item_res == 1){ // here get number of all item is insert to db or no
            $db->query("Commit"); 
            echo "okInsert"; 
        }else{
            /// بكرة تتعالج هذه الاوامر
            /// اذا رجع لهنا يحذف مباشرة اخر رقم تم ادخاله في جدول الاوامر
            $db->query("DELETE FROM `tbl_oder` WHERE `tbl_oder`.`order_id` = ".$last_id);
            $db->query("Rollback Transaction");
            echo "end roll R2 <br/>"; 
            //$db->query("Rollback Transaction");  
        }
    }// end of qry_order
    else{ // else of qry_order
        echo "end roll R1 <br/>"; 
        $db->query("Rollback Transaction");
    } // end else of qry_order
    
}catch(Exception $e){
    echo "end roll TRY <br/>"; 
    $db->query("Rollback Transaction"); 
}


    



    
    ?>