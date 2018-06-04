<?php
include '../config/ceklogin.php';
include '../config/koneksi.php';

CekAuthor();
$auction_id = htmlspecialchars($_REQUEST['auction_id']);
$date_auction_from = htmlspecialchars($_REQUEST['fromdate']);
$date_auction_to = htmlspecialchars($_REQUEST['enddate']);
$flag = 1;
//$userid = 1;

$date_auction_from = date('Y-m-d H:i:s', strtotime($date_auction_from));
$date_auction_to = date('Y-m-d H:i:s', strtotime($date_auction_to));

$sql = "insert into td_auction_t(auction_id,date_auction_from,date_auction_to,flag_id,date_add,user_add)
 values($auction_id,'$date_auction_from','$date_auction_to',$flag,now(),'$USERNAME')";
// echo $sql;
$result = @mysqli_query($conn,$sql);
if ($result){
	echo json_encode(array(
	//	'reg_id' => mysql_insert_id(),
		'auction_id' => $auction_id,
		'date_auction_from' => $date_auction_from,
		'date_auction_to' => $date_auction_to,
		'flag_id' => $flag				
	));
} else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}
?>