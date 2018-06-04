<?php
include '../config/ceklogin.php';
include '../config/koneksi.php';

CekAuthor();

$nama = htmlspecialchars($_REQUEST['nama']);
$remark = htmlspecialchars($_REQUEST['remark']);
$status = htmlspecialchars($_REQUEST['status_id']);
$category_id = htmlspecialchars($_REQUEST['category_id']);
$type		 = htmlspecialchars($_REQUEST['type']);
$flag = 1;

$sql = "insert into th_auction_t(nama,remark,category_id,type,status_id,flag_id,date_add,user_add,posting)
 values('$nama','$remark',$category_id,'$type',$status,'$flag',now(),'$USERNAME',0)";
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