<?php
include '../config/ceklogin.php';
include '../config/koneksi.php';

CekAdmin();
$auction_id = htmlspecialchars($_REQUEST['auction_id']);
$itemid = htmlspecialchars($_REQUEST['itemid']);
$type = htmlspecialchars($_REQUEST['type']);
//$reason = htmlspecialchars($_REQUEST['del_reason']);
//$reason = htmlspecialchars($_REQUEST['reason']);
$bid_price = htmlspecialchars($_REQUEST['bid_price']);
/*
echo 
'<script>
	reason = prompt("Please enter delete reason!", "wrong price");
	$.post("delete_mybid.php", {del_reason: reason});
</script>';


if ($reason=='')
{	
	echo "<script>
		window.location.href = '../frm_bidding.html?auction_id=$auction_id';
	</script>";
	
	die;
}
*/

//$sql = "update t_auction_t set flag_id=9, user_edit='$USERNAME', reason_delete='$reason', date_edit=now() 
$sql = "update t_auction_t set flag_id=9, user_edit='$USERNAME', date_edit=now() 
		where item_id=$itemid and auction_id=$auction_id and bid_price=$bid_price";

SaveLog($sql);

$result = @mysqli_query($conn,$sql);

if ($type=='ByFirstBid')
{
$sql = "update tdd_auction_t set firstbid=null, user_edit='".$USERNAME."', date_edit=now() 
		where item_id=".$itemid." and auction_id=".$auction_id;
$result = @mysqli_query($conn,$sql);	
}

if ($result){	
	//echo json_encode(array('success'=>true));
	echo "<script>
	alert('Data has been saved!');
	window.location.href = '../frm_bidding.php?auction_id=$auction_id&type=$type';
	</script>";
	die;
} else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}
?>