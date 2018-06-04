<?php
	include '../config/ceklogin.php';
	include '../config/koneksi.php';
	
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'auction_id';
	$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';	
	$offset = ($page-1)*$rows;	

	$auction_id = htmlspecialchars($_REQUEST['auction_id']);
	$result = array();	
	$sql = 
	"select auction_d_id, auction_id, date_auction_from, date_auction_to, DATE_FORMAT(date_auction_from,'%m/%d/%Y %H:%i') fromdate,
	DATE_FORMAT(date_auction_to,'%m/%d/%Y %H:%i') enddate
	from td_auction_t where flag_id=1 and auction_id=$auction_id";
	//echo $sql;
	
	$res = mysqli_query($conn,"select count(*) as jumlah from (".$sql.") a") or die(mysqli_error()) or die(mysqli_error());
	$row = mysqli_fetch_assoc($res);	
	$result["total"] = $row['jumlah'];
	
	$rs = mysqli_query($conn,$sql." order by $sort $order limit $offset,$rows");
//	$rs = mysql_query($sql,$conn );	
	
	$rows = array();
	while($row = mysqli_fetch_object($rs)){
		array_push($rows, $row);
	}
	$result["rows"] = $rows;
	
	echo json_encode($result);
?>