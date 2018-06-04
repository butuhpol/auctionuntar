<?php
//  include 'config/ceklogin.php';
  include './config/koneksi.php';  
  // gets the user IP Address
  $user_ip=$_SERVER['REMOTE_ADDR'];

  $check_ip = mysqli_query($conn,"select userip from t_pageview_t where page='sfwebvm01.sampoernafoundation.org/auction' and userip='$user_ip' and 
  DATE_FORMAT(datevisit,'%Y-%m-%d') = DATE_FORMAT(current_date,'%Y-%m-%d')");
  if(mysqli_num_rows($check_ip)>=1)
  {
	
  }
  else
  {
    $insertview = mysqli_query($conn,"insert into t_pageview_t values('','sfwebvm01.sampoernafoundation.org/auction','$user_ip',now(),1)");
	//$updateview = mysql_query("update totalview set totalvisit = totalvisit+1 where page='yourpage' ");
  }
?>

<html>
<head>
</head>

<body>
  <?php
  
	function getcounter($value, $option) {
		global $conn;
		$count = "select coalesce(sum(totalvisit),0) total, DATE_FORMAT(datevisit,'%Y-%m-%d') tgl from t_pageview_t
				where DATE_FORMAT(datevisit,'%Y-%m-%d') between DATE_FORMAT(current_date-".$value.",'%Y-%m-%d')";
		if ($option==0)
		{
			$count = $count." and DATE_FORMAT(current_date,'%Y-%m-%d') ";
		}else
		{
			$count = $count." and DATE_FORMAT(current_date-$value,'%Y-%m-%d') ";
		}
				
		$count1 = mysqli_query($conn,$count);
		//echo $count;
		$row = mysqli_fetch_assoc($count1);
		$nilai = $row['total'];
		if ($row['total']==null)
		{
			$nilai=0;
		}

		return $nilai;
		
	}
	
  ?>
<div align="center">
	<table border="1" width="22%" cellspacing="0" cellpadding="0">
		<tr>
			<td align="left" colspan="2">
			<p align="center"><font face="Calibri">Summary Counter</font></td>
		</tr>
		<tr>
			<td width="186" align="left">
			<span style="color: rgb(0, 0, 0); font-family: Calibri; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-align: -webkit-center; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none">
			Hit Counter today</span></td>
			<td align="right"><?php echo getcounter(0,0);?> times.</td>
		</tr>
		<tr>
			<td width="186" align="left">
			<span style="color: rgb(0, 0, 0); font-family: Calibri; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-align: -webkit-center; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none">
			Hit Counter yesterday</span></td>
			<td align="right"> <?php echo getcounter(1,1);?> times.</td>
		</tr>
		<tr>
			<td width="186" align="left">
			<span style="color: rgb(0, 0, 0); font-family: Calibri; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-align: -webkit-center; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; display: inline !important; float: none">
			Hit Counter week</span></td>
			<td align="right"><?php echo getcounter(7,0);?> times.</td>
		</tr>
	</table>
</div>
  
</body>
</html>