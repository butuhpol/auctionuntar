<?php

//include '../config/ceklogin.php';
include '../config/koneksi.php';
//CekAdmin();
$user_id = htmlspecialchars($_REQUEST['user_id']);
$nama = htmlspecialchars($_REQUEST['nama']);
$password = htmlspecialchars($_REQUEST['password']);
$no_hp = htmlspecialchars($_REQUEST['nohp']);
$email = htmlspecialchars($_REQUEST['email']);
$address = htmlspecialchars($_REQUEST['address']);

	$sql = "select count(*) jumlah from m_user_t where user_name='".$user_id."'";
	$res = mysqli_query($conn,$sql) or die(mysqli_error()) or die(mysqli_error());
	$row = mysqli_fetch_assoc($res);	
	$total = $row['jumlah'];
	if ($total>0)
	{
		echo json_encode(array('errorMsg'=>'User already exists!'));
		die;
	}

$sql = "insert into m_user_t(user_name,name,password,group_id,email,no_hp,address,status_id,flag_id,date_add,user_add)
					values('".$user_id."','".$nama."',md5('".$password."'),4,'".$email."','".$no_hp."','".$address."',1,1,now(),'".$user_id."')";

SaveLog($sql);

$result = @mysqli_query($conn,$sql);
if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}
?>