<?php

$user_id =  $_POST['x'];

require_once("../../include_db/db.php");
$stmt_men = mysqli_query( $tf_handle ,"SELECT * FROM `isalert` WHERE `user_id` = $user_id AND `is_alert` = 1 Orders LIMIT 5");
while($row = mysqli_fetch_assoc($stmt_men)){
?>

    <li><a href="#" style="direction: rtl;">
        <img class="img-circle img-inv" src="../img/<?php echo $row["com_img"]; ?>.png" alt="<?php echo $row["com_name"]; ?>" />
        <span class="col-lg-6"><?php echo $row["total_amount"]; ?> رس</span>
        <span class="col-lg-4"><?php echo $row["date_invoice"]; ?></span>
    </a></li>

<?php
}
?>