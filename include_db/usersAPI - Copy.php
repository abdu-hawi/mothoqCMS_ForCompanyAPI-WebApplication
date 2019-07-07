<?php

	function invoice_users_get($extra = '')
	{
		
		global $tf_handle;
		$query = " SELECT * FROM `users` '.$extra.' " ;
		$qresult = @mysqli_query($tf_handle,$query);
		if(!$qresult)
			return NULL;
		
		$rcount = @mysqli_num_rows($qresult);
		if($rcount == 0)
			return NULL;
			
		$users = array();
		for( $i = 0 ; $i < $rcount ; $i++ )
		{
			$users[@count($users)] = @mysqli_fetch_object($qresult);
		}
		
		@mysqli_free_result($qresult);
		
		return $users;
		
	} // END invoice_users_get function
	
	function invoice_users_get_by_id($uid)
	{
		// used for cryptography
		$id = (int)$uid;
		if($id == 0 )
			return NULL;
			
		$result = invoice_users_get('WHERE `id` =' .$id);
		if($result == NULL)
			return NULL;
			
		$user = $result[0];
		return $user;
		
	}// END invoice_users_get_by_id function
	
	function invoice_users_get_by_name($name)
	{
		global $tf_handle;
		$n_name    = @mysqli_real_escape_string($tf_handle,strip_tags($name));
		
		$result = mysqli_query($tf_handle , "SELECT * FROM `users` WHERE `user_name` = '$n_name'");
		//$rows = mysqli_fetch_row($result);
		$rows = $result->fetch_object();
		if($rows != NULL)
			$qry = $rows;
		else
			$qry = NULL;
			
		return $qry;
	}
	
	function invoice_users_get_by_email($email)
	{
		global $tf_handle;
		$n_email    = @mysqli_real_escape_string($tf_handle,strip_tags($name));
		
		$result = invoice_users_get("WHERE `user_email` = '$n_email'");
		
		if($n_email != NULL)
			$user = $result[0];
		else
			$user = NULL;
			
		return $user;
	}
	
	function invoice_users_add($name,$password,$email)
	{
		
		global $tf_handle;
		
		if ( empty($name) || empty($password) || empty($email) )
			return false;
		
		$n_email   = @mysqli_real_escape_string($tf_handle,strip_tags($email));
		
		if(!filter_var($n_email,FILTER_VALIDATE_EMAIL))
			return false;
		$n_name    = @mysqli_real_escape_string($tf_handle , strip_tags($name));
		$n_pass    = @md5(mysql_real_escape_string($tf_handle ,strip_tags($password)));
		
		$query = sprintf("INSERT INTO `users` VALUE (NULL,'%s','%s','%s')" , $n_name , $n_pass , $n_email);
		$qresult = @mysqli_query($tf_handle,$query);
		
		if(!$qresult)
			return false;
			
		return true;
	} // END tinyf_users_add function
	
	require_once('db.php');
	
	

	////////////////////////////////////////////
	// TO ADD USER
	/*//////////////////////////////////////////
	$result = tinyf_users_add('salem','1fsdf23','abs@basa.com',0);
	if($result)
	{
		tinyf_db_close();
		echo('DONE');
	}   
	*/
	/////////////////////////////////////////////////
	// TO GET ALL users
	/*/////////////////////////////////////////////////
	$users = tinyf_users_get();
	tinyf_db_close();
	echo '<pre>'; // TO MAKE ARRAY IN SCHEDUAL
    print_r($users); // TO print ARRAY
	echo '</pre>';
	*/
	//////////////////////////////////////////////////
	// TO GET USER INFO BY ID
	/*////////////////////////////////////////////
	$user= tinyf_users_get_by_id(1);
	tinyf_db_close();
	if($user != NULL)
	{
		echo'<pre>';
		print_r($user);
		echo'</pre>';
	}
	else{
		echo'USER ID IS NOT CORRECT';
	}
	*/
	///////////////////////////////////////////////
	// TO DELETE USER
	/*/////////////////////////////////////////////
	$result = tinyf_users_delete(8);
	tinyf_db_close();
	if($result)
		echo 'DELETE';
	*/
	//////////////////////////////////////////////////
	// TO UPDATE USER INFO
	/*////////////////////////////////////////////////	
	$result = tinyf_users_update(1,'Abdu','123456','abdu@hawi.com',1);
	if($result)
		echo'success or';
	*//////////////////////////////////////////////////	
	
?>