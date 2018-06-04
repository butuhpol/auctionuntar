<?php
$host="localhost";  
$database="id3969742_db_auction"; 
$user="id3969742_auction"; 
$password="Auction2018";

// KONEKSI SQL SERVER
$conn= mysqli_connect($host,$user,$password) or die("Cannot connect to database!");
// PILIH DATABASE
     mysqli_select_db($conn,$database) or die("database doest not exists!");

function SaveLog($teks)
{
	$myfile = fopen("../log.txt", "w") or die("Unable to open file!");
	$text = "Time : " . date("Y/m/d H:i:s") . " ".$teks;
	fwrite($myfile, $text);
	fclose($myfile);
}

function ShowMessage($teks)
{
	echo '<script>
	alert($teks);
	</script>';
}


function CekUserLocal($user,$password)
{
	global $conn;
	global $ACCESS;
	global $FULLNAME;
	global $USERSTATUS;
	
	$sql = "SELECT a.*,b.name namagroup FROM m_user_t a
	join m_group_t b on a.group_id=b.group_id
	where a.flag_id=1 and b.flag_id=1
	and user_name='".$user."' and password=md5('$password')";
//	echo $sql;	
	$result = mysqli_query($conn,"select count(*) as jumlah from (".$sql.") a") or die(mysqli_error()) or die(mysqli_error());
	$row = mysqli_fetch_assoc($result);	
	$result = mysqli_query($conn,$sql) or die(mysqli_error()) or die(mysqli_error());
	$row1 = mysqli_fetch_assoc($result);
	$ACCESS = $row1['namagroup'];
	$FULLNAME = $row1['name'];	
	
	if ($row['jumlah'] > 0) 
	{
    // output data of each row
		$USERSTATUS = $row1['status_id'];
		return true;
	}	
	else 
	{
		$USERSTATUS = null;
		return false;
	}
}

?>
