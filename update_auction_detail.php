<?php

include '../config/ceklogin.php';
include '../config/koneksi.php';

CekAuthor();

$item_id = htmlspecialchars($_REQUEST['item_id']);
$auction_id = htmlspecialchars($_REQUEST['auction_id']);
$nama = htmlspecialchars($_REQUEST['nama']);
$remark = htmlspecialchars($_REQUEST['remark']);
$open_sale = htmlspecialchars($_REQUEST['open_sale']);
$bid_increment = htmlspecialchars($_REQUEST['bid_increment']);
$oldimage = htmlspecialchars($_REQUEST['oldimage']);
$newimage = basename($_FILES["image"]["name"]);

/*
echo "<script>
alert('$newimage');
alert('$oldimage');
</script>";
die;
*/

if ($newimage !='')
{
	include 'upload.php';
}
else
{
	$image1 = $oldimage;
}

$sql = "update tdd_auction_t set nama='$nama',remark='$remark',open_sale=$open_sale,bid_increment=$bid_increment,image='$image1',date_edit=now(),user_edit='$USERNAME' 
where item_id=$item_id and auction_id=$auction_id";

SaveLog($sql);

/*
$myfile = fopen("../log.txt", "w") or die("Unable to open file!");
fwrite($myfile, $sql);
fclose($myfile);

/*
echo "<script>
var sql = <?php echo $sql; ?>;
alert(sql);
</script>";
*/
$result = @mysqli_query($conn,$sql);


if ($result){
	echo json_encode(array(
	//	'reg_id' => mysql_insert_id(),
		'item_id' => $item_id,
		'auction_id' => $auction_id,
		'nama' => $nama,
		'remark' => $remark,
		'open_sale' => $open_sale,
		'bid_increment' => $bid_increment,
		'image' => $image1		
	));
} else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}
?>