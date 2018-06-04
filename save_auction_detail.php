<?php
include '../config/ceklogin.php';
include '../config/koneksi.php';

CekAuthor();

$auction_id = htmlspecialchars($_REQUEST['auction_id']);
$nama = htmlspecialchars($_REQUEST['nama']);
$remark = htmlspecialchars($_REQUEST['remark']);
$open_sale = htmlspecialchars($_REQUEST['open_sale']);
$bid_increment = htmlspecialchars($_REQUEST['bid_increment']);
$flag = 1;

include 'upload.php';

$sql = "insert into tdd_auction_t(auction_id,nama,remark,open_sale,bid_increment,image,user_add,date_add,flag_id)
 values($auction_id,'$nama','$remark',$open_sale,$bid_increment,'$image1','$USERNAME',now(),$flag)";

SaveLog($sql);
 
$result = @mysqli_query($conn,$sql);
if ($result){
	echo json_encode(array(
	//	'reg_id' => mysql_insert_id(),
		'auction_id' => $auction_id,
		'nama' => $nama,
		'remark' => $remark,
		'open_sale' => $open_sale,
		'bid_increment' => $bid_increment,
		'image' => $image1,
		'user_add' => $USERNAME,	
		'flag_id' => $flag				
	));
} else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}
?>