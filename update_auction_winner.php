<?php

include '../config/ceklogin.php';
include '../config/koneksi.php';

CekAuthor();

//$item_id = htmlspecialchars($_REQUEST['item_id']);
$auction_id = htmlspecialchars($_REQUEST['auction_id']);
//$winner = htmlspecialchars($_REQUEST['winner']);
//$user = htmlspecialchars($_REQUEST['user_name']);

// $sql = "update t_auction_t set winner=$winner,date_edit=now(),user_edit='$USERNAME' where item_id=$item_id and auction_id=$auction_id and user_name='$user'";
$sql =
"update t_auction_t,
(select a.item_id,a.auction_id,a.user_name, b.bid_price
from t_auction_t a
join 
(select item_id, auction_id, max(bid_price) bid_price from t_auction_t 
where auction_id=$auction_id and flag_id=1 group by item_id,auction_id) b
where a.auction_id=b.auction_id and a.item_id=b.item_id 
and a.bid_price=b.bid_price) a

set winner=1,
date_edit=now()
,user_edit='$USERNAME' 
where t_auction_t.item_id=a.item_id and 
t_auction_t.auction_id=a.auction_id and 
t_auction_t.user_name= a.user_name and 
t_auction_t.bid_price= a.bid_price and 
t_auction_t.auction_id=".$auction_id." and flag_id=1";

$result = @mysqli_query($conn,$sql);

$sql = 'update th_auction_t set posting=1 where auction_id='.$auction_id;
$result1 = @mysqli_query($conn,$sql);

SaveLog($sql);

if ($result){	
	echo "<script>
		alert('Data has been proceed!');
		window.location.href = '../frm_report.php';
		</script>";
		die;
		
} else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}
?>
