<?php

require ('../include_db/session.php');

    $_SESSION['fail'] = false;
 
    $_SESSION['cominfo'] = false;
    
    $_SESSION['userinfo'] = false;
    
    $_SESSION['brainfo'] = false;
    
    header('location:../login.php');

?>