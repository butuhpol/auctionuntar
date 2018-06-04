<?php
session_start();

if (isset($_SESSION['USERNAME'])=='')
{
  header("Location: login.php");
  die();
}
else
{
	$USERNAME = $_SESSION['USERNAME'];
	$ACCESS = $_SESSION['ACCESS'];
}

function CekAdmin()
{
	if ($_SESSION['ACCESS'] !='ADMIN')
	{
		echo "<script> 
				alert('You do not have access!');
			  </script>";
		die;
	}

}

function CekAuthor()
{
	if (($_SESSION['ACCESS'] !='ADMIN') and ($_SESSION['ACCESS'] !='AUTHOR'))
	{
		echo "<script> 
				alert('$acc You do not have access!');				
			  </script>";			  
		die;
	}

}
?>