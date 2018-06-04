<?php

	include '../config/ceklogin.php';
	include '../config/koneksi.php';
	
	CekAdmin();
	
	$auction_id = htmlspecialchars($_REQUEST['auction_id']);
	$itemid = htmlspecialchars($_REQUEST['itemid']);
	
	$sql = 
//	"select * from t_auction_t where flag_id=1 and user_name='$USERNAME' and item_id=$itemid and auction_id=$auction_id order by bid_price desc limit 3";	
	"select * from t_auction_t where flag_id=1 and item_id=$itemid and auction_id=$auction_id order by bid_price desc limit 3";		
	
//	echo $sql;
	$rs = mysqli_query($conn,$sql) or die(mysqli_error());	

	echo '<table border="1" width="100%">
                <tr>
                                <td width="182"><font size="1" color="red">User</font></td>
                                <td width="182"><font size="1" color="red">Bid Price</font></td>
                </tr>';
	
	while($row = mysqli_fetch_assoc($rs))
	{

		echo 
		'<tr>
        <td width="182"><font size="1" color="blue">'.$row['user_name'].'</font></td>
        <td width="182"><font size="1" color="blue">'.number_format($row['bid_price']).'</font></td>
        </tr>';	
	}

	echo '</table>';


?>