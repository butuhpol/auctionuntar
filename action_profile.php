<?php	
include '../config/ceklogin.php';
include '../config/koneksi.php';

$user_name = htmlspecialchars($_REQUEST['user_id']);
$fullname = htmlspecialchars($_REQUEST['name']);

$sql = "update m_user_t set name='$fullname', date_edit=now(),user_edit='$USERNAME' where user_name='$user_name'";

SaveLog($sql);

$result = @mysqli_query($conn,$sql);
if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}
?>