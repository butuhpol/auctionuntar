<?php
 session_start();
 session_unset();
 $_SESSION = array();
 unset($_SESSION["USERNAME"]);  // where $_SESSION["nome"] is your own variable. if you do not have one use only this as follow **session_unset();**
 unset($_SESSION["ACCESS"]);  
 unset($_SESSION["FULLNAME"]); 
 header("Location: index.php");
 session_destroy();
?>