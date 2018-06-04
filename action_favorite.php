<?php	
//$user_name = htmlspecialchars($_REQUEST['user_name']);
$action = htmlspecialchars($_REQUEST['action']);
$auction_id = htmlspecialchars($_REQUEST['auction_id']);
$type = htmlspecialchars($_REQUEST['type']);

$flag_id=1;

include '../config/ceklogin.php';
include '../config/koneksi.php';
//CekAdmin();

if (($action != 'view'))
{
	$item_id = htmlspecialchars($_REQUEST['itemid']);
}

switch ($action) {
    case 'insert':
					$sql = "insert into t_favorite_t(auction_id, item_id, user_name,rate,date_add)
					values($auction_id,$item_id,'$USERNAME',1,now())";
					break;
    case 'view':
					$sql = "select a.item_id, a.auction_id, nama, remark, 
							format(open_sale,0) opensale, open_sale, 
							format(bid_increment,0) bidincrement, bid_increment, 
							format(COALESCE(open_sale,0)+COALESCE(bid_increment,0),0) pricesale,
							image, COALESCE(firstbid,false) firstbid 
							from 
							tdd_auction_t a
							join t_favorite_t b on a.auction_id=b.auction_id and a.item_id=b.item_id
							where flag_id=1 and a.auction_id=$auction_id and b.user_name='$USERNAME'";						
					break;	
	case 'delete':
					$sql = "delete from t_favorite_t where auction_id=$auction_id and item_id=$item_id and user_name='$USERNAME'";	
					break;
	case 'data':
					$sql = 
					"select user_name from t_favorite_t where item_id=$item_id and auction_id=$auction_id and user_name='$USERNAME'";		
					$rs = mysqli_query($conn,$sql ) or die(mysqli_error());						
					$row = mysqli_fetch_array($rs);					
					if ($row['user_name'] != '')
					{
						$url = './query/action_favorite.php?auction_id='.$auction_id.'&itemid='.$item_id.'&action=delete&type='.$type;						
					echo 						
						'<form method="post" action="'.$url.'"> <img src="./images/star_enable.png" align="center" style="width:30;height:30;"><button align="center">Del</button> </form>';					
					}
					else
					{
						$url = './query/action_favorite.php?auction_id='.$auction_id.'&itemid='.$item_id.'&action=insert&type='.$type;
						echo
						'<form method="post" action="'.$url.'"> <img src="./images/star_disable.png" align="center" style="width:30;height:30;"><button align="center">Add</button> </form>';		
					}	
					die;					
					break;
					
} 

SaveLog($sql);

$result1 = @mysqli_query($conn,$sql);
if ($result1){
	if ($action=='view')
	{
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'item_id';
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';	
		$offset = ($page-1)*$rows;			
		$result = array();	
		$res = mysqli_query($conn,"select count(*) as jumlah from (".$sql.") a ") or die(mysqli_error()) or die(mysqli_error());
		$row = mysqli_fetch_assoc($res);	
		$result["total"] = $row['jumlah'];		
		$rs = mysqli_query($conn,"select * from (".$sql. ") a order by $sort $order limit $offset,$rows" );	
		$rows = array();
		while($row = mysqli_fetch_object($rs)){
			array_push($rows, $row);
		}
		$result["rows"] = $rows;	
		echo json_encode($result);
	}
	else
	{
	 //	echo json_encode(array('success'=>true));
	 	echo "<script>
		alert('Favorite has been updated!');
		window.location.href = '../frm_bidding.php?auction_id=$auction_id&type=$type';
		</script>";		
	}
} else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}
?>