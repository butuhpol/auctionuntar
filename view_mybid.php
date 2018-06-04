<?php
	include '../config/ceklogin.php';
	include '../config/koneksi.php';

	$auction_id = htmlspecialchars($_REQUEST['auction_id']);
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
//	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$rows = 10;
	$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'transactiondate';
	$order = isset($_POST['order']) ? strval($_POST['order']) : 'desc';	
	$offset = ($page-1)*$rows;		
	$result = array();
	$kondisi = '';	
	
	
//	echo $ACCESS.'</br>';

		
	if (($ACCESS != 'ADMIN') and ($ACCESS != 'VIEWER'))
	{
		$kondisi = " and a.user_name='".$USERNAME."'";
	}

	
	$sql = 
	"select a.auction_id, a.item_id, a.user_name, b.image,b.nama,b.remark,
	format(b.open_sale,0) open_sale, format(b.bid_increment,0) bid_increment, 
	format(a.bid_price,0) bidprice, bid_price,
	DATE_FORMAT(a.date_add,'%Y-%m-%d %H:%i') transactiondate 
	from t_auction_t a 
	join tdd_auction_t b on a.auction_id=b.auction_id
	and a.item_id=b.item_id
	where a.flag_id=1 and a.auction_id=$auction_id".$kondisi;
	
//	SaveLog($sql);

	$res = mysqli_query($conn,"select count(*) as jumlah from (".$sql.") a") or die(mysqli_error()) or die(mysqli_error());
	$row = mysqli_fetch_assoc($res);	
	$result["total"] = $row['jumlah'];
	
	$rs = mysqli_query($conn,$sql." order by $sort $order limit $offset,$rows");
	
	$rows = array();
	while($row = mysqli_fetch_object($rs)){
		array_push($rows, $row);
	}
	$result["rows"] = $rows;
	
	echo json_encode($result);
?>