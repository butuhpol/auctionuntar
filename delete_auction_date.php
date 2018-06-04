<?php
include '../config/ceklogin.php';
include '../config/koneksi.php';

CekAuthor();
$auction_d_id = htmlspecialchars($_REQUEST['auction_d_id']);

$sql = "update td_auction_t set flag_id=9,user_edit='$USERNAME',date_edit=now() where auction_d_id=$auction_d_id";
$result = @mysqli_query($conn,$sql);
if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}
?>