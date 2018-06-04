<?php
	include '../config/ceklogin.php';
	include '../config/koneksi.php';
	
	$auction_id = htmlspecialchars($_REQUEST['auction_id']);
	$itemid = htmlspecialchars($_REQUEST['itemid']);
	$action = htmlspecialchars($_REQUEST['action']);
	//$userid = 1;
	
	if ($action=='HIGHEST')
	{
		$sql = 
		"select a.auction_id, a.item_id
		,case when COALESCE(max(bid_price),a.open_sale)+a.bid_increment < a.open_sale+a.bid_increment  then a.open_sale + a.bid_increment
		 else COALESCE(max(bid_price),a.open_sale)+a.bid_increment end  highest  
		from tdd_auction_t a 
		left join t_auction_t b on a.auction_id=b.auction_id and a.item_id=b.item_id and b.flag_id=1 
		where a.flag_id=1 and a.auction_id=$auction_id and a.item_id=$itemid 
		group by a.auction_id,b.item_id";
		}
	else
	{
		$username = htmlspecialchars($_REQUEST['username']);
		$sql = "select * from t_auction_t where user_name='$username' and item_id=$itemid order by date_add desc limit 1";
		//echo $sql;		
	}
	
	$rs = mysqli_query($conn,$sql) or die(mysqli_error());	

	$row = mysqli_fetch_assoc($rs);
	if ($action=='HIGHEST')
	{	
		echo '<font size="1" color="red">'.number_format($row['highest']).'</font>';	
	}
	else
	{
		echo '<font size="1" color="green">'.number_format($row['bid_price']).'</font>';			
	}
?>