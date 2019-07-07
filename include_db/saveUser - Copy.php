<?php

if( (!isset($_POST['userName'])) || (!isset($_POST['password'])) || (!isset($_POST['email'])) )
{
	die('BAD ACCESS');
}

require_once('usersAPI.php');

$user = invoice_users_get_by_name($_POST['userName']);
if($user != NULL)
{
	invoice_db_close();
	die('USER EXIST');
}

$user = invoice_users_get_by_email($_POST['email']);
if($user != NULL)
{
	invoice_db_close();
	die('EMAIL EXIST');
}

$n_name = trim($_POST['userName']);
$n_pass = trim($_POST['password']);
$n_email = trim($_POST['email']);
//$query = sprintf("INSERT INTO `users` VALUE (NULL,'%s','%s','%s')" , $n_name , $n_pass , $n_email);
//$qresult = @mysqli_query($tf_handle,$query);

$result = invoice_users_add($n_name,$n_pass,$n_email);

invoice_db_close();

if($result)
	die('success');
else
	die('failure');

?>