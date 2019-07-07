<?php

	function invoice_comp_get($extra = '')
	{
		
		global $tf_handle;
		$query = " SELECT * FROM `company` '.$extra.' " ;
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
	
	function invoice_comp_get_by_id($uid)
	{
		// used for cryptography
		$id = (int)$uid;
		if($id == 0 )
			return NULL;
			
		$result = invoice_comp_get('WHERE `com_id` =' .$id);
		if($result == NULL)
			return NULL;
			
		$user = $result[0];
		return $user;
		
	}// END invoice_users_get_by_id function
	
	function invoice_comp_get_id_by_name($name)
	{
		global $tf_handle;
		$n_name    = @mysqli_real_escape_string($tf_handle,strip_tags($name));
		
		$result = mysqli_query($tf_handle,"SELECT `com_id` FROM `company` WHERE `com_name` = '$n_name'");
		$rows = $result->fetch_row();
		if($rows != NULL)
			$qry = $rows;
		else
			$qry = NULL;
			
		return $qry;
	}
	
	function invoice_comp_get_by_name($name)
	{
		global $tf_handle;
		$n_name    = @mysqli_real_escape_string($tf_handle,strip_tags($name));
		
		$result = mysqli_query($tf_handle , "SELECT * FROM `company` WHERE `com_name` = '$n_name'");
		//$rows = mysqli_fetch_row($result);
		$rows = $result->fetch_object();
		if($rows != NULL)
			$qry = $rows;
		else
			$qry = NULL;
			
		return $qry;
	}
	
	function invoice_comp_get_by_email($email)
	{
		global $tf_handle;
		$n_email    = @mysqli_real_escape_string($tf_handle,strip_tags($name));
		
		$result = invoice_comp_get("WHERE `com_email` = '$n_email'");
		
		if($result != NULL)
			$user = $result[0];
		else
			$user = NULL;
			
		return $user;
	}
	
	function invoice_comp_add($name,$desc,$password,$email,$img)
	{
		
		global $tf_handle;
		
		if ( empty($name) || empty($password) || empty($email) || empty($desc) || empty($img) )
			return false;
		
		
		$n_email   = @mysqli_real_escape_string($tf_handle,strip_tags($email));
				
		if(!filter_var($n_email,FILTER_VALIDATE_EMAIL))
			return false;
		
		
		$n_name    = @mysqli_real_escape_string($tf_handle , strip_tags($name));
		$n_pass    = @md5(mysql_real_escape_string($tf_handle ,strip_tags($password)));
		$n_desc    = @mysqli_real_escape_string($tf_handle , strip_tags($desc));
		$n_img    = @mysqli_real_escape_string($tf_handle , strip_tags($img));
		
		$query = sprintf("INSERT INTO `company` VALUES (NULL,'%s','%s','%s','%s','%s')" , $n_name ,$n_desc , $n_pass , $n_email ,$n_img);
		$qresult = @mysqli_query($tf_handle,$query);

		
		if(!$qresult)
			return false;
			
		return true;
	} // END tinyf_users_add function
	
	require_once('db.php');
	
	

?>