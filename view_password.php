<?php
	include '../config/ceklogin.php';
	include '../config/koneksi.php';
	$user_id = htmlspecialchars($_REQUEST['user_id']);	
	$oldpassword = htmlspecialchars($_REQUEST['oldpassword']);	
	$sql = "select count(*) jumlah from m_user_t where user_name='$user_id' and password=md5('$oldpassword')";
	$res = mysqli_query($conn,$sql) or die(mysqli_error()) or die(mysqli_error());
	$row = mysqli_fetch_assoc($res);	
	$result = $row['jumlah'];	
	if ($result>0){
		echo json_encode(array('success'=>true));
	} else {
		echo json_encode(array('success'=>false));
		
}
?>

