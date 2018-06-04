<?php
/*
echo 
	"<script>
	alert('coba');
	window.location.href = '../test.html';
	</script>";
	die;
*/
//echo json_encode(array('success'=>false));
include '../config/ceklogin.php';
include '../config/koneksi.php';

$auction_id = htmlspecialchars($_REQUEST['auction_id']);
$itemid = htmlspecialchars($_REQUEST['itemid']);
$type = htmlspecialchars($_REQUEST['type']);
$error= '';

	$sql = 
	"select a.auction_id, a.item_id
	,case when COALESCE(max(bid_price),a.open_sale)+a.bid_increment < a.open_sale+a.bid_increment  then a.open_sale + a.bid_increment
	 else COALESCE(max(bid_price),a.open_sale)+a.bid_increment end  highest  
	from tdd_auction_t a 
	left join t_auction_t b on a.auction_id=b.auction_id and a.item_id=b.item_id and b.flag_id=1 
	where a.flag_id=1 and a.auction_id=$auction_id and a.item_id=$itemid 
	group by a.auction_id,b.item_id";

	$rs = mysqli_query($conn,$sql ) or die(mysqli_error());	
	$row = mysqli_fetch_array($rs);
	$highest = $row['highest'];
	
if ($type=='ByPrice')
{
  $bid_price = htmlspecialchars($_REQUEST['bid_price']);
}
else
{	
  $bid_price = $highest; 
}

$timebid = htmlspecialchars($_REQUEST['timebid']);

$flag = 1;

	$sql1 = 
	"select count(*) jumlah from td_auction_t a where flag_id=1 and (now() BETWEEN date_auction_from and  date_auction_to) and auction_id=$auction_id";		
	$res1 = mysqli_query($conn,$sql1) or die(mysqli_error()) or die(mysqli_error());
	$row1 = mysqli_fetch_assoc($res1);	
	$cek = $row1['jumlah'];	

if (($timebid==0) or ($cek==0))
{
	$error = 'Time has expired!';
	/*
	echo 
	"<script>
	alert('Time has expired!');
	window.location.href = '../frm_bidding.html?auction_id=$auction_id&type=$type';	
	</script>";
	die;
	*/
}

//$USERNAME = $_SESSION['USERNAME'];

if ($type=='ByPrice')
{
	if ($bid_price<=$highest)
	{
		$error ='Bid Price must grater than Highest Price!';
		/*
		echo "<script>
		alert('Bid Price must grater than Highest Price!');
		window.location.href = '../frm_bidding.html?auction_id=$auction_id&type=$type';
		</script>";
		die;
		*/
	}
}

if ($type=='ByFirstBid')
{
	$sql = 
	'select coalesce(firstbid,false) firstbid  from tdd_auction_t where flag_id=1 and auction_id='.$auction_id.' and item_id='.$itemid;
//	echo $sql;
	$rs = mysqli_query($conn,$sql) or die(mysqli_error());	
	$row = mysqli_fetch_assoc($rs);
	$firstbid = $row['firstbid'];
	if ($firstbid != 0)
	{
		$error ='This item already bid!';
		/*
		echo "<script>
		alert('This item already bid!');
		window.location.href = '../frm_bidding.html?auction_id=$auction_id&type=$type';
		</script>";
		die;
		*/
	}
	else
	{
		$firstbid = true;
	}
}


if ($error != '')
{
 // echo $error;	
/*
		echo "<script>
		alert('$error');
		window.location.href = '../frm_bidding.html?auction_id=$auction_id&type=$type';
		</script>";
		die;	
*/	
//	echo json_encode(array('success'=>false));
	echo json_encode(array('errorMsg'=>$error));
	//die;
}
else
{
$sql = "insert into t_auction_t(auction_id,item_id,bid_price,user_name,winner,flag_id,date_add,user_add)
values('$auction_id','$itemid','$bid_price','$USERNAME',0,'$flag',now(),'$USERNAME')";
$result = @mysqli_query($conn,$sql);
//echo '<script> alert("test");</script>';

SaveLog($sql);

	if ($result)
	{
		$sql = 'update tdd_auction_t set firstbid=1 where auction_id='.$auction_id.' and item_id='.$itemid;	
		$result = @mysqli_query($conn,$sql);
		echo json_encode(array('success'=>true));
		//header("Location: ../frm_bidding.html?auction_id=$auction_id");
		
		/*
		echo "<script>
		alert('Data has been saved!');
		window.location.href = '../frm_bidding.html?auction_id=$auction_id&type=$type';
		</script>";
		die;
		*/
	} 
	else 
	{
		echo json_encode(array('errorMsg'=>'Some errors occured.'));
	}
}


?>