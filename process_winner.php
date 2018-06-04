<?php

	include '../config/ceklogin.php';
	include '../config/koneksi.php';
	
	CekAdmin();
	
	$auction_id = htmlspecialchars($_REQUEST['auction_id']);
	$itemid = htmlspecialchars($_REQUEST['itemid']);
	
	$sql = 
	"select user_name,bid_price,coalesce(winner,0) winner from t_auction_t where flag_id=1 and item_id=$itemid and auction_id=$auction_id order by bid_price desc limit 3";		
	
	//echo $sql;
	$rs = mysqli_query($conn,$sql) or die(mysqli_error());
//	$row = mysql_fetch_array($rs);
	//$user = $row['user_name'];
	
//	$url = "'query/update_auction_winner.php?auction_id=$auction_id&item_id=$itemid&user_name=$user',valueField:'winner'";

	echo '<table border="1" width="100%">
                <tr>
                                <td width="182"><font size="1" color="red">User</font></td>
                                <td width="182"><font size="1" color="red">Bid Price</font></td>
								<td width="200"><font size="1" color="red">Winner</font></td>						
                </tr>';
	
	while($row = mysqli_fetch_assoc($rs))
	{
		//echo $row['winner'].'</br>';
		echo 
		'<tr>
        <td width="182"><font size="1" color="blue">'.$row['user_name'].'</font></td>
        <td width="182"><font size="1" color="blue">'.number_format($row['bid_price']).'</font></td>
		<td width="300"><select id="winner'.$auction_id.$itemid.$row['user_name'].$row['bid_price'].'" style="width:80px;" onchange="update_winner_manual(this)" >';
			$i=0;
			while($i<4){
						$selected = ($row['winner']==$i?"selected":"");
						$win = ($i==0?"":"Winner ".$i);						
						echo '<option value="'.$row['winner'].'auc'.$auction_id.'item'.$itemid.'user'.$row['user_name'].'price'.$row['bid_price'].'" '.$selected.'>'.$win.' </option>';
				$i++;
			}						
			echo		'</select>					
			</td>		
        </tr>';	
	}

	echo '</table>';
	

?>