<?php
	include '../config/ceklogin.php';
	include '../config/koneksi.php';

	$auction_id = htmlspecialchars($_REQUEST['auction_id']);
	$item_id = isset($_REQUEST['item_id']) ? $_REQUEST['item_id'] : 0;
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'item_id';
	$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';	
	$itemid = isset($_POST['txtsearch']) ? mysqli_real_escape_string($_POST['txtsearch']) : '';
	$offset = ($page-1)*$rows;	
	
	$result = array();	
	$where = " nama like '%".$itemid."%' ";
	
	$sql = 
	"select item_id, auction_id, nama, remark, 
	format(open_sale,0) opensale, open_sale, 
	format(bid_increment,0) bidincrement, bid_increment, 
	format(COALESCE(open_sale,0)+COALESCE(bid_increment,0),0) pricesale,
	image, COALESCE(firstbid,false) firstbid from tdd_auction_t where flag_id=1 and auction_id= $auction_id";
	
	if ($item_id!=0)
	{
		$sql = $sql.' and item_id=$item_id';
	}
	
	//SaveLog($sql." item=".$itemid);
	
	$res = mysqli_query($conn,"select count(*) as jumlah from (".$sql.") a where ".$where) or die(mysqli_error()) or die(mysqli_error());
	$row = mysqli_fetch_assoc($res);	
	$result["total"] = $row['jumlah'];
	
	$rs = mysqli_query($conn,"select * from (".$sql. ") a where ".$where." order by $sort $order limit $offset,$rows");
	
	$rows = array();
	while($row = mysqli_fetch_object($rs)){
		array_push($rows, $row);
	}
	$result["rows"] = $rows;
	
	echo json_encode($result);
?>