<?php
session_start();
if(!isset($_SESSION['fail']))
    $_SESSION['fail'] = false;
 
 if(!isset($_SESSION['cominfo']))
    $_SESSION['cominfo'] = false;
    
 if(!isset($_SESSION['userinfo']))
    $_SESSION['userinfo'] = false;
    
  if(!isset($_SESSION['brainfo']))
    $_SESSION['brainfo'] = false;
?>