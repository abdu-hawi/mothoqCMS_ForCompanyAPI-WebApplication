<?php
require_once ('../include_db/db.php');

function create_user($name,$pass,$email){
    Global $tf_handle;
    if(get_user_by_name($name,$email)){
        return 1;
    }else{
        $password = md5($pass);
        //$stmt = mysqli_query($con,"INSERT INTO `users` (`id`, `name`, `password`, `email`)
                             //VALUES (NULL,'$name','$password','$email');");
        $stmt= $tf_handle->prepare("INSERT INTO `users` (`user_id`, `user_name`, `user_password`, `user_email`)
                             VALUES (NULL, ?, ?, ?);");
        $stmt->bind_param("sss",$name,$password,$email);
        $stmt->execute();
        if($stmt){
            return 2;
        }else{
            return 3;
        }
    }
    close_db();
}

function get_user_by_name($name,$email){
    Global $tf_handle;
    $stmt = mysqli_query($tf_handle,"SELECT * FROM `users` WHERE `user_name` = '$name' OR `user_email` = '$email'");
    $result = mysqli_fetch_row($stmt);
    /*
    $stmt = $con->prepare("SELECT * FROM `users` WHERE `name` = ? OR `email` = ?");
    $stmt->bind_param("ss",$name,$email);
    $stmt->execute();
    $result = mysqli_fetch_row($stmt);
    */
    if($result) return 1;
}

function userLogin($name,$pass){
    Global $tf_handle;
    $password = md5($pass);
    $stmt = mysqli_query($tf_handle,"SELECT user_id FROM `users` WHERE `user_name` = '$name' AND `user_password` = '$password'");
    return mysqli_fetch_row($stmt) > 0 ;
}
function get_email_by_name($name){
    Global $tf_handle;
    $stmt = mysqli_query($tf_handle,"SELECT * FROM `users` WHERE `user_name` = '$name'");
    return $result = mysqli_fetch_assoc($stmt);
}
?>