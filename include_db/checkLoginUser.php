<?php

require_once('session.php');

if( (!isset($_POST['userName'])) || (!isset($_POST['password'])) )
{
	die('BAD ACCESS');
}

require_once('db.php');
require_once('usersAPI.php');

if( empty ($_POST['userName']) || empty ($_POST['password']) )
{
	invoice_db_close();
	die('FILL INFO');
}

$user = invoice_users_get_by_name($_POST['userName']);

if(!$user)
{
	invoice_db_close();
	die('BAD USER');
}
/*
//$pass = @md5(mysql_real_escape_string(strip_tags($_POST['password']),$tf_handle));*/
//md5(mysqli_real_escape_string($tf_handle,strip_tags($_POST['password'])));
$pass = md5(mysqli_real_escape_string($tf_handle,strip_tags($_POST['password'])));
invoice_db_close();

if( strcmp ($pass , $user->user_password) != 0 )
{
	die('BAD PASS');
}


$user->user_password = 0;
$_SESSION['userinfo'] = $user;

header ('Location:../system/main.php');

?>