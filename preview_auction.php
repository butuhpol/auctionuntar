<?php
include '../config/ceklogin.php';
include '../config/koneksi.php';

CekAuthor();
$auction_id = htmlspecialchars($_REQUEST['auction_id']);
?>
<style type="text/css">
body,td,th {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 16px;
}
.total {
	font-size: 14px;
}
.total strong {
	color: #F00;
}
</style>

<script>


function refreshdata()
{
  window.location = "preview_auction.php?auction_id="+auction_id;
}

function go_home()
{
  window.location.replace = "../index.php";
}

function export2excel()
{
  var auction_id = '<?php echo $auction_id; ?>';
  window.location = "export.php?auction_id="+auction_id;
}
</script>

<p><strong> <img src="../images/logo.png" width="60" height="60" alt="logo" /> <strong>Report Auction</strong></p>
<p>
  <?php 
//$qry = "select * from t_registration_t where flag_id=1";
//$data = mysql_query($qry, $conn)  or die ("Connection Error!".mysql_error());
//$row = mysql_fetch_array($data);
/*
echo "<br>Full responses       : ".$token['complete']."</br>";
echo "<br>Incomplete responses : ".$token['incomplete']."</br>";
echo "<br>Total responses      : ".$token['total_responses']."</br>";
echo "<br>Total Participants   : ".$token['token']."</br>";
*/
$qrytotal = "select format(sum(bid_price),0) total from (
select user_name,winner,bid_price, a.* from tdd_auction_t a 
left join t_auction_t b
on a.auction_id=b.auction_id and a.item_id=b.item_id and winner<>0
where a.auction_id=".$auction_id." and a.flag_Id=1) a ";
			
$datatotal = mysqli_query($conn,$qrytotal)  or die ("Connection Error!".mysqli_error());
$total = mysqli_fetch_assoc($datatotal);

$qryjumlah = "select count(*) jumlahitem from tdd_auction_t 
where auction_id=".$auction_id." and flag_Id=1";
			
$datajumlah = mysqli_query($conn,$qryjumlah)  or die ("Connection Error!".mysqli_error());
$jumlahitem = mysqli_fetch_assoc($datajumlah);

$qryauction = 
"select a.item_id,b.user_name,c.no_hp,c.email,c.address, winner,format(bid_price,0) bid_price, nama, remark, format(bid_increment,0) bid_increment, format(open_sale,0) open_sale 
from tdd_auction_t a
left join t_auction_t b
on a.auction_id=b.auction_id and a.item_id=b.item_id and winner<>0
left join m_user_t c on c.user_name=b.user_name
where a.auction_id=".$auction_id." and a.flag_Id=1
order by item_id,  bid_price desc, winner";
$auction = mysqli_query($conn,$qryauction)  or die ("Connection Error!".mysqli_error());
//$dataauction = mysql_fetch_array($auction);

//$total = mysql_fetch_array($datatotal);
//echo "<br><strong>Total Incomplete & Not Yet respons: ".$total['total']."</strong>";
?>


<!-- <input type="submit" name="btn_refresh" id="btn_refresh" value="Refresh" onclick="refreshdata()" />
<input type="submit" name="btn_refresh2" id="btn_refresh2" value="Home" onclick="go_home()" />
-->
<input type="submit" name="export"  value="Export 2 Excel" onclick="export2excel()" />
</p>
<p>
<form id="form1" name="form1" method="post" action="">
</form>
<p>

<p><strong> Details: </strong>
<p>
<table class="table-list" width="80%" border="1" cellspacing="1" cellpadding="2">
       <tr>
		<td width="30px" align="center" bgcolor="#FFCC66"><b>No</b></td>
		<td width="30px" align="center" bgcolor="#FFCC66"><b>Item ID</b></td>		
        <td width="700px" align="center" bgcolor="#FFCC66"><b>Items</b></td>
		<td width="700px" align="center" bgcolor="#FFCC66"><b>Description</b></td>		 
        <td width="200px" align="center" bgcolor="#FFCC66"><strong>Open Sale</strong></td> 
		<td width="300px" align="center" bgcolor="#FFCC66"><strong>Bid Increment</strong></td> 		
		<td width="300px" align="center" bgcolor="#FFCC66"><strong>User Name</strong></td> 	
		<td width="300px" align="center" bgcolor="#FFCC66"><strong>Email</strong></td> 	
		<td width="300px" align="center" bgcolor="#FFCC66"><strong>Mobile No</strong></td> 	
		<td width="300px" align="center" bgcolor="#FFCC66"><strong>Address</strong></td> 			
		<td width="100px" align="center" bgcolor="#FFCC66"><strong>Winner</strong></td> 
		<td width="100px" align="center" bgcolor="#FFCC66"><strong>Bid Price</strong></td> 
      </tr>

<?php
//			$dataQry = mysql_query($dataSql, $koneksidb)  or die ("Connection Error!".mysql_error());
			# JIKA SUKSES
			if($jumlahitem)
			{
				if (mysqli_num_rows($datajumlah) >=1) 
				{	
//				$Data1 = mysql_fetch_array($dataQry);				
				$i=1;
//				echo "<tr>";
//				echo "<td colspan='3' >".$Data1['Grouping']."</td>";
//				echo "</tr>";
//				$baris_grouping ='';
				while ($Data = mysqli_fetch_assoc($auction)) 
					{		
						//$group = $Data['Grouping']; 		  
					//	if (($i==1) || ($baris_grouping != $Data['Department']))
					//	{
					//		echo "<td colspan='2' >".$Data['Department']." ( ".$Data['Total'] ." ) </td>";
					//	}
						echo "<tr>";
						echo "<td align='right'>".$i."</td>";
						echo "<td>".$Data['item_id']."</td>";						
						echo "<td>".$Data['nama']."</td>";
						echo "<td>".$Data['remark']."</td>";						
						echo "<td align='right'>".$Data['open_sale']."</td>";
						echo "<td align='right'>".$Data['bid_increment']."</td>";
						echo "<td align='left'>".$Data['user_name']."</td>";
						echo "<td align='left'>".$Data['email']."</td>";
						echo "<td align='left'>".$Data['no_hp']."</td>";
						echo "<td align='left'>".$Data['address']."</td>";
						echo "<td align='center'>".$Data['winner']."</td>";
						echo "<td align='right'>".$Data['bid_price']."</td>";
						
						//echo "<td align='right'>".$Data['Total']."</td>";
				  		echo "</tr>";
						$i++;
						//$baris_grouping = $Data['Department'];
					
					}
				}
			}  
	echo "<tr>";			                 
	echo "<td colspan='11' ><strong> Total Item</strong> </td>";
	echo "<td align='right'> <strong>".$jumlahitem['jumlahitem']."</strong></td>";	 
	echo "<tr>";			                 	
	echo "<td colspan='11' ><strong> Total Bid Price</strong> </td>";
	echo "<td align='right'> <strong>".$total['total']."</strong></td>";	 	
	echo "<tr>";
	echo "<tr>";			
?>
</table>

<?php
/*
<br />
<table width="378" border="1">
  <tr>
    <td width="296"><span class="total">Full responses</span></td>
    <td width="66"><div align="right"><span class="total"><?php echo $token['complete']; ?>&nbsp;</span></div></td>
  </tr>
  <tr>
    <td><span class="total">Incomplete responses</span></td>
    <td><div align="right"><span class="total"><?php echo $token['incomplete']; ?>&nbsp;</span></div></td>
  </tr>
  <tr>
    <td><span class="total">Total responses</span></td>
    <td><div align="right"><span class="total"><?php echo $token['total_responses']; ?>&nbsp;</span></div></td>
  </tr>
  <tr>
    <td><span class="total">Total Participants</span></td>
    <td><div align="right"><span class="total"><?php echo $token['token']; ?>&nbsp;</span></div></td>
  </tr>
  <tr>
    <td><span class="total"><strong>Total Incomplete &amp; Not yet responses</strong></span></td>
    <td><div align="right"><span class="total"><strong><?php echo $total['total']; ?>&nbsp;</strong></span></div></td>
  </tr>
</table>
*/
?>
<p><strong>(c)Auction System 2016-2018</strong></p>
