<?php

	include '../config/ceklogin.php';
	include '../config/koneksi.php';
	
	//CekAuthor();
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'date_add';
	$order = isset($_POST['order']) ? strval($_POST['order']) : 'desc';	
	$offset = ($page-1)*$rows;
	
	$result = array();
	
	$sql = 
	"select a.*,
	case status_id when 1 then 'Prepared'
	when 2 then 'Open' else 'Closed' end status, b.name category
	from th_auction_t a
	join m_category_t b on a.category_id=b.category_id
	where a.flag_id=1";
	
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