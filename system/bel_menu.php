<?php


if(!isset($_POST['x'])){
    if($_SESSION['userinfo'] != false)
        $user_id = $_SESSION['userinfo']->user_id;
    else $user_id = $_SESSION['cominfo']->com_id;
}else{
    $user_id =  $_POST['x'];
}
require_once("../include_db/db.php");
$stmt_men = mysqli_query( $tf_handle ,"SELECT * FROM `is_ale` WHERE `user_id` = $user_id AND `is_alert` = 1 AND `inTrash` = 0 ORDER BY `order_id` DESC LIMIT 5");
while($row = mysqli_fetch_assoc($stmt_men)){
?>

    <li><a href="#" style="direction: rtl;">
        <img class="img-circle img-inv" src="../img/<?php echo $row["com_img"]; ?>.png" alt="<?php echo $row["com_name"]; ?>" />
        <span class="col-sm-3"><?php echo $row["total_amount"]; ?> رس</span>
        <span class="col-sm-6"><?php echo $row["date_invoice"]; ?></span>
    </a></li>

<?php
}
?>