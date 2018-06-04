<?php
include '../config/ceklogin.php';
include '../config/koneksi.php';

//CekAuthor();
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

<p><strong>REPORT AUCTION</strong></p>
<p>
<?php 
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
"select a.item_id,user_name,winner,format(bid_price,0) bid_price, nama, remark, format(bid_increment,0) bid_increment, format(open_sale,0) open_sale from tdd_auction_t a
left join t_auction_t b
on a.auction_id=b.auction_id and a.item_id=b.item_id and winner<>0
where a.auction_id=".$auction_id." and a.flag_Id=1
order by item_id,  bid_price desc, winner";
$auction = mysqli_query($conn,$qryauction)  or die ("Connection Error!".mysqli_error());

//$qry = "select * from t_registration_t where flag_id=1";
//$data = mysql_query($qry, $conn)  or die ("Connection Error!".mysql_error());
//$row = mysql_fetch_array($data);
/*
echo "<br>Full responses       : ".$token['complete']."</br>";
echo "<br>Incomplete responses : ".$token['incomplete']."</br>";
echo "<br>Total responses      : ".$token['total_responses']."</br>";
echo "<br>Total Participants   : ".$token['token']."</br>";
*/
?>
<table class="table-list" width="62%" border="1" cellspacing="1" cellpadding="2">
       <tr>
		<td width="30px" align="center" bgcolor="#FFCC66"><b>No</b></td>
        <td width="400px" align="center" bgcolor="#FFCC66"><b>Items</b></td>
		<td width="400px" align="center" bgcolor="#FFCC66"><b>Description</b></td>		 
        <td width="100px" align="center" bgcolor="#FFCC66"><strong>Open Sale</strong></td> 
		<td width="100px" align="center" bgcolor="#FFCC66"><strong>Bid Increment</strong></td> 		
		<td width="100px" align="center" bgcolor="#FFCC66"><strong>User Name</strong></td> 		
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
						echo "<td>".$Data['nama']."</td>";
						echo "<td>".$Data['remark']."</td>";						
						echo "<td align='right'>".$Data['open_sale']."</td>";
						echo "<td align='right'>".$Data['bid_increment']."</td>";
						echo "<td align='left'>".$Data['user_name']."</td>";
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
	echo "<td colspan='7' ><strong> Total Item</strong> </td>";
	echo "<td align='right'> <strong>".$jumlahitem['jumlahitem']."</strong></td>";	 
	echo "<tr>";			                 	
	echo "<td colspan='7' ><strong> Total Bid Price</strong> </td>";
	echo "<td align='right'> <strong>".$total['total']."</strong></td>";	 	
	echo "<tr>";
	echo "<tr>";			
?>
</table>

