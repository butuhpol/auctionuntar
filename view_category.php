<?php
	include '../config/ceklogin.php';
	include '../config/koneksi.php';

	CekAdmin();
//	$auction_id = htmlspecialchars($_REQUEST['auction_id']);
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'name';
	$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';	
	$offset = ($page-1)*$rows;	
	
	$result = array();
	
	
	$sql = "select *,case flag_id when 1 then 'Active' else 'InActive' end status from m_category_t";

	
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

