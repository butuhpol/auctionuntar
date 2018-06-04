<?php
include '../config/ceklogin.php';
include '../config/koneksi.php';

CekAuthor();

$auction_id = htmlspecialchars($_REQUEST['auction_id']);
$nama =		  htmlspecialchars($_REQUEST['nama']);
$remark =     htmlspecialchars($_REQUEST['remark']);
$category_id = htmlspecialchars($_REQUEST['category_id']);
$type		 = htmlspecialchars($_REQUEST['type']);
$status =     htmlspecialchars($_REQUEST['status_id']);

$flag = 1;

$sql = "update th_auction_t set nama='$nama',remark='$remark',category_id=$category_id,type='$type',status_id='$status',flag_id='$flag',user_edit='$USERNAME',date_edit=now() where auction_id=$auction_id";
$result = @mysqli_query($conn,$sql);
if ($result){
	echo json_encode(array(
	//	'reg_id' => mysql_insert_id(),
		'nama' => $nama,
		'remark' => $remark,
		'type' => $type,
		'status_id' => $status,
		'flag_id' => $flag				
	));
} else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}
?>