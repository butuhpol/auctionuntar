<?php

include '../config/ceklogin.php';
include '../config/koneksi.php';

CekAuthor();

$item_id = htmlspecialchars($_REQUEST['item_id']);
$auction_id = htmlspecialchars($_REQUEST['auction_id']);
$user = htmlspecialchars($_REQUEST['user_name']);
$winner = htmlspecialchars($_REQUEST['winner']);
$bid_price = htmlspecialchars($_REQUEST['bid_price']);

// $sql = "update t_auction_t set winner=$winner,date_edit=now(),user_edit='$USERNAME' where item_id=$item_id and auction_id=$auction_id and user_name='$user'";
//clear nilai winner terlebih dahulu

$sql =
"update t_auction_t
set winner=0,
date_edit=now(),
user_edit='".$USERNAME.
"' where item_id=".$item_id." and auction_id=".$auction_id." and user_name='".$user." and bid_price=".$bid_price." and flag_id=1 and winner=".$winner;

$result = @mysqli_query($conn,$sql);

$sql =
"update t_auction_t
set winner=$winner,
date_edit=now(),
user_edit='$USERNAME' 
where item_id=$item_id and 
auction_id=".$auction_id." and 
user_name= '$user' and
bid_price= '$bid_price' and
flag_id=1";

$result = @mysqli_query($conn,$sql);

SaveLog($sql);

if ($result){	
	echo "<script>
		alert('Data has been proceed!');
		//window.location.href = '../frm_report.php?auction_id=$auction_id;
		window.history.back();
		</script>";
		die;
		
} else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}
?>
