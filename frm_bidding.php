<html>


<head>
	<meta charset="UTF-8">
	<title>::Auction System::</title>
	<link rel="stylesheet" type="text/css" href="./easyui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="./easyui/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="./easyui/themes/color.css">
	<link rel="stylesheet" type="text/css" href="./easyui/demo/demo.css">
	<link rel="stylesheet" href="js/flipclock.css">
	<script type="text/javascript" src="./easyui/jquery.min.js"></script>
	<script type="text/javascript" src="./easyui/jquery.easyui.min.js"></script>
<!--	<script src="js/jquery.min.js"></script> -->
	<script src="js/flipclock.js"></script>		

	<script>		  
		var id;
		var typeauction;
		var diff;
		var ITEMID;
		var URL;
		
		function isNumber(evt) {
			evt = (evt) ? evt : window.event;
			var charCode = (evt.which) ? evt.which : evt.keyCode;
			if (charCode > 31 && (charCode < 48 || charCode > 57)) {
				return false;
			}
				return true;
		}

		var	reason ='';
		
		function delete_mybid(){
		reason = prompt("Please enter reason!", "wrong price");

		if (reason == '') {
				$.post('./query/delete_mybid.php', {del_reason: reason});
				alert('Please input the reason!');				
				return false;
			}
		else
		{
			alert(reason);
			$.post('./query/delete_mybid.php', {del_reason: reason});
		}
			//alert('ok');
		}
			
	</script>
	
<?php 	
	include 'config/ceklogin.php';
	include 'config/koneksi.php'; 
	$auction_id = htmlspecialchars($_REQUEST['auction_id']);
	$type = htmlspecialchars($_REQUEST['type']);	
	$item_id = isset($_REQUEST['item_id']) ? $_REQUEST['item_id'] : 0;
//	echo $auction_id.'</br>';
//	$dtz = new DateTimeZone("Asia/Jakarta"); //Your timezone
//	$now = new DateTime(date("Y-m-d"), $dtz);
//	date_default_timezone_set("Asia/Jakarta"); 
//	$today = $now->format("Y-m-d H:i");
//	echo $today;
//	echo $now->format("Y-m-d H:i:s");
//	$today = date("Y-m-d H:i:s");
//	echo $today;
	
	$sql = 
	"select TIME_TO_SEC(timediff(date_auction_to,now())) tgl, date_auction_to 
	from td_auction_t a where flag_id=1 and (now() BETWEEN date_auction_from and  date_auction_to) and auction_id=$auction_id";		
	$res = mysqli_query($conn,$sql) or die(mysqli_error()) or die(mysqli_error());
	$row = mysqli_fetch_assoc($res);	
	//$date_auction_to = $row['date_auction_to'];	
	$tgl = $row['tgl'];
	if 	($tgl=='')
	{
	  $tgl =0;
	}
	
	
	
//	echo $tgl; 
?>
<script>
	var id = <?php echo $auction_id; ?>;
	var search = $('#txtsearch').val();
	function doSearch(){
	
	//alert(id);	 
	 //alert($('#txtsearch').val());
	 
	 
	 //alert(search);	 
	 /*
	$('#dg').datagrid({
			url: './query/view_bidding.php?auction_id='+id+'&txtsearch='+search;
		});
	$('#dg').datagrid('reload');
	*/
	
        $('#dg').datagrid('load',{
            txtsearch: search,
			auction_id:id 
        });
    }
	//panel-noscroll
</script>

<body class="easyui-layout">
<!-- <div class="easyui-layout" fit="true">
-->
	<div id="content" region="north" style="width:100%;height:21%">
		<h4>Bidding Time</h4>
		<div class="clock"></div>
		<div id="message" align="center"></div>	
	</div>

	<div id="content" region="center" style="width:100%;height:100%">
	<!--	<div class="easyui-tabs" style="width:100%;height:75%">  -->
		<div class="easyui-tabs" fit="true">
		<div title="Auction Items" style="padding:10px"> 	

			<table id="dg" title="Auction Type : <?php echo $type; ?>" fit="true" 								
					class="easyui-datagrid"	
					pagination="true"
					rownumbers="true"
					fitColumns="true" 
					singleSelect="true"
					toolbar="#tb"
					nowrap="false"
					data-options="onSelect: function(index,row){							
						id = row.auction_id;
						ITEMID = row.item_id;
					}"					
					url="./query/view_bidding.php?auction_id=<?php echo $auction_id; ?>&item_id=">
				<thead>
					<tr>
						<th field="favorite" width="80" formatter="favoritedata" align="center">Favorite</th>
						<th field="image" sortable="true" formatter="gambar">Images</th>
						<th field="nama" width="350" sortable="true">Title</th>
						<th field="remark" width="350">Remark</th>
						<th field="opensale" width="100" align="right">Open Sale</th>
						<th field="bidincrement" width="100" align="right">Bid Increment</th>
					<?php
					if ($ACCESS =='ADMIN')
					{
						echo '<th field="bidder" width="200" formatter="bidder">Highest Bid</th>';
					}
					?>						

						<th field="action" formatter="bidding" width="300" >Action</th>
					</tr>
				</thead>
			</table>
		</div>
			
		
		<div title="Favorite Items" style="padding:10px"> 		
			<table id="dg_myfavorite" title="Auction Type : <?php echo $type; ?>"  fit="true"					
					class="easyui-datagrid"	
					pagination="true"
					rownumbers="true"
					fitColumns="true" 
					singleSelect="true"
					toolbar="#tb"
					nowrap="false"
					pageSize="20"
					data-options="onSelect: function(index,row){							
						id = row.auction_id;
						ITEMID = row.item_id;
					}"						
					url="./query/action_favorite.php?auction_id=<?php echo $auction_id; ?>&action=view&type=<?php echo $type; ?>">
				<thead>
					<tr>	
						<th field="favorite" width="80" formatter="favoritedata2" align="center">Favorite</th>					
						<th field="image" sortable="true" formatter="gambar">Images</th>
						<th field="nama" width="350" sortable="true">Title</th>
						<th field="remark" width="350">Remark</th>
						<th field="opensale" width="100" align="right">Open Sale</th>
						<th field="bidincrement" width="100" align="right">Bid Increment</th>
					<?php
					if ($ACCESS =='ADMIN')
					{
						echo '<th field="bidder" width="200" formatter="bidder_favorite">Highest Bid</th>';
					}
					?>			
						<th field="action" formatter="bidding_favorite" width="300" >Action</th>
					</tr>
				</thead>
			</table>
		</div>	
		
			<div title="My Bids" style="padding:10px"> 	
					<table id="dg_mybid" 
									fit="true"
									class="easyui-datagrid"	
									toolbar="#toolbar" 
									pagination="true"
									rownumbers="true" 
									fitColumns="true" 
									singleSelect="true"	
									pageSize="10"									
									url="./query/view_mybid.php?auction_id=<?php echo $auction_id; ?>"
									>
								<thead>
									<tr>
										<th field="item_id" width="100" sortable="true">Item No</th>
										<th field="image" sortable="true" formatter="gambar1">Images</th>
										<th field="user_name" width="350" sortable="true">User</th>
										<th field="nama" width="350" sortable="true">Title</th>
										<th field="remark" width="350" sortable="true">Remark</th>
										<th field="open_sale" width="100" align="right">Open Sale</th>
										<th field="bid_increment" width="100" align="right">Bid Increment</th>				
										<th field="bidprice" width="200" sortable="true"  align="right">Bid Price</th>								
										<th field="transactiondate" width="200"  sortable="true">Date Bid</th>
										<?php if ($ACCESS=='ADMIN')
										{
											echo	'<th field="action2" formatter="action2">Action</th>';										
										}
										?>
										
									</tr>
								</thead>
					</table>
					
			</div>
	</div>
	<!--
    <div id="tb" style="padding:3px">
        <span>Item Name:</span>
        <input id="txtsearch" style="line-height:26px;border:1px solid #ccc" onkeyup="doSearch()">
        <a href="#" class="easyui-linkbutton" plain="true" onclick="doSearch()">Search</a>
    </div>	
-->
				
			
				<script type="text/javascript">				
					function favoritedata(val,row){				
						var url = './query/action_favorite.php?auction_id='+row.auction_id+'&itemid='+row.item_id+'&action=data&type=<?php echo $type; ?>';	
						$.post(url).done(               
							function(data)
							{
								$('#favoritedata'+row.item_id).html(data);  //Update here with the response
							}
						);			
					return '<span id="favoritedata'+row.item_id+'"></span>Item: '+row.item_id;

					}
					
					function favoritedata2(val,row){				
						var url = './query/action_favorite.php?auction_id='+row.auction_id+'&itemid='+row.item_id+'&action=data&type=<?php echo $type; ?>';	
						$.post(url).done(               
							function(data)
							{
								$('#favoritedata2'+row.item_id).html(data);  //Update here with the response
							}
						);			
					return '<span id="favoritedata2'+row.item_id+'"></span>Item No: '+row.item_id;

					}
	
					function action2(val,row){
						var type = '<?php echo $type; ?>';
						var url = './query/delete_mybid.php?auction_id='+row.auction_id+'&itemid='+row.item_id+'&bid_price='+row.bid_price+'&type='+type;						
						//return '<form method="post" action="'+url+'"> <button style="width:70px" onclick="delete_mybid()">Delete</button></form>';
						return '<form method="post" action="'+url+'"> <button style="width:70px">Delete</button></form>';
					}
	
					function gambar1(val,row){				
						return '<img src="./images/' + row.image + '" style="width:100;height:100;">';
					}
					
					function gambar(val,row){				
						return '<img src="./images/' + row.image + '" style="width:100;height:100;">';
					}				
					
					function bidding(val,row){	
						var username = '<?php echo $USERNAME; ?>';
						typeauction = '<?php echo $type; ?>';
						//alert(typeauction);						
						var url = './query/insert_bidding.php?auction_id='+row.auction_id+'&itemid='+row.item_id+'&timebid='+diff+'&type='+typeauction;						
						//URL = './query/insert_bidding.php?auction_id='+row.auction_id+'&itemid='+row.item_id+'&timebid='+diff+'&type='+typeauction;												
						var url2 = './query/view_highest.php?auction_id='+row.auction_id+'&itemid='+row.item_id;	
						//alert(url);
						
						$.post(url2+'&action=HIGHEST').done(               
							function(data)
							{
								$('#highest'+row.item_id).html(data);  //Update here with the response								
								
							}
						);	
						$.post(url2+'&action=HIGHESTMYBID&username='+username).done(               
							function(data)
							{
								$('#highestmybid'+row.item_id).html(data);  //Update here with the response								
								
							}
						);						
						
						if (typeauction=='ByPrice')
						{						  
						  action1 = 'My Bid =  <span id="highestmybid'+row.item_id+'"  ></span><br> Highest Bid > <span id="highest'+row.item_id+'"  ></span></br> <input id="bid'+row.item_id+'" name="bid_price" style="width:100px" onkeypress="return isNumber(event)"> <button type="button" style="width:70px" onclick="cekbid(1)">Bid</button>';						  
						  //action1 = 'Highest Bid > <span id="highest'+row.item_id+'"  ></span></br></br> <input id="bid_price" name="bid_price" style="width:100px" onkeypress="return isNumber(event)"> <button type="button" style="width:70px" onclick="cekbid(1)">Bid</button>';						  						  
						}
						
						if (typeauction=='ByIncrement') 
						{						 
						  action1 = 'My Bid =  <span id="highestmybid'+row.item_id+'"  ></span><br> Highest Bid = <span id="highest'+row.item_id+'"  ></span></br> <button style="width:70px" onclick="cekbid(1)">Bid</button>';
						}
						
						if (typeauction=='ByFirstBid')				
						{			
							//alert(row.firstbid);
						  if (row.firstbid==0)
							{
							 action1 = 'My Bid =  <span id="highestmybid'+row.item_id+'"  ></span><br> Highest Bid = <span id="highest'+row.item_id+'"  >  </span></br> <button style="width:70px" onclick="cekbid(1)">Bid</button>'
							}
						  else
						  {						    
						    action1 = 'Highest Bid = '+row.pricesale;
						  }
						}
						//alert(action1);
						return action1;						
					}			
					
					function bidder(val,row){				
						var url = './query/view_winner.php?auction_id='+row.auction_id+'&itemid='+row.item_id;	
						$.post(url).done(               
							function(data)
							{
								$('#winner'+row.item_id).html(data);  //Update here with the response
							}
						);			
					return '<span id="winner'+row.item_id+'"></span>';

					}
					
					function bidder_favorite(val,row){				
						var url = './query/view_winner.php?auction_id='+row.auction_id+'&itemid='+row.item_id;	
						$.post(url).done(               
							function(data)
							{
								$('#winner_favorite'+row.item_id).html(data);  //Update here with the response
							}
						);			
					return '<span id="winner_favorite'+row.item_id+'"></span>';

					}
					
					function bidding_favorite(val,row){	
						var username = '<?php echo $USERNAME; ?>';
					    typeauction = '<?php echo $type; ?>';
						//alert(typeauction);
						var url = './query/insert_bidding.php?auction_id='+row.auction_id+'&itemid='+row.item_id+'&timebid='+diff+'&type='+typeauction;																							
						var url2 = './query/view_highest.php?auction_id='+row.auction_id+'&itemid='+row.item_id;	
						//var url3 = './query/action_favorite.php?auction_id='+row.auction_id+'&itemid='+row.item_id+'&action=insert';						
						//alert(url);
						
						$.post(url2+'&action=HIGHEST').done(               
							function(data)
							{
								$('#highest_favorite'+row.item_id).html(data);  //Update here with the response								
								
							}
						);
						$.post(url2+'&action=HIGHESTMYBID&username='+username).done(               
							function(data)
							{
								$('#highest_favoritemybid'+row.item_id).html(data);  //Update here with the response								
								
							}
						);						
						
						if (typeauction=='ByPrice')
						{						  
						  action1 = 'My Bid =  <span id="highest_favoritemybid'+row.item_id+'"  ></span><br> Highest Bid > <span id="highest_favorite'+row.item_id+'"  ></span></br> <input id="fav'+row.item_id+'" name="bid_price" style="width:100px" onkeypress="return isNumber(event)"> <button style="width:70px" onclick="cekbid(2)">Bid</button>';						  
						  //action1 = 'Highest Bid > <span id="highest_favorite'+row.item_id+'"  ></span></br> <input id="bid_price" name="bid_price" style="width:100px" onkeypress="return isNumber(event)"> <button style="width:70px" onclick="cekbid(2)">Bid</button>';						  
						}
						
						if (typeauction=='ByIncrement') 
						{						 
						  //action1 = 'Highest Bid = <span id="highest_favorite'+row.item_id+'"  ></span></br> <form method="post" action="'+url+'"> <button style="width:70px" onclick="cekbid()">Bid</button></form>';
						  action1 = 'My Bid =  <span id="highest_favoritemybid'+row.item_id+'"  ></span><br> Highest Bid = <span id="highest_favorite'+row.item_id+'"  ></span></br> <button style="width:70px" onclick="cekbid(2)">Bid</button>';
						}
						
						if (typeauction=='ByFirstBid')				
						{			
							//alert(row.firstbid);
						  if (row.firstbid==0)
							{
							 //action1 = 'Highest Bid = <span id="highest_favorite'+row.item_id+'"  ></span></br> <form method="post" action="'+url+'"> <button style="width:70px" onclick="cekbid()">Bid</button></form>'
							 action1 = 'Highest Bid = <span id="highest_favorite'+row.item_id+'"  ></span></br> <button style="width:70px" onclick="cekbid(2)">Bid</button>';
							}
						  else
						  {						    
						    action1 = 'Highest Bid = '+row.pricesale;
						  }
						}
						//alert(action1);
						return action1;						
					}
				</script>

			
				
	<script>	
	  function cekbid(x)
	  {
		
	    if (diff==0)
		{
		  $.messager.alert('Info','Time has expired!');		  
		  return;
		 }
		
//			alert('auction_id: '+id+', itemid: '+ITEMID+', timebid: '+diff+', type: '+typeauction);
			if (x==1)
			{
				formname = '#dg';
				var bidprice = document.getElementById("bid"+ITEMID).value;				
				
			}
			else
			{
				formname = '#dg_myfavorite';
				var bidprice = document.getElementById("fav"+ITEMID).value;				
				//var bidprice = document.getElementById("bid_price").value;
			}
			 
			//$(formname).datagrid('reload');	
			//alert('auction_id: '+id+', itemid: '+ITEMID+', timebid: '+diff+', type: '+typeauction+', bid_price: '+bidprice);
			//$.post(URL,function(result){					
			//$.post('./query/insert_bidding.php',{auction_id: id, itemid: ITEMID, timebid: diff, type: 'ByPrice', bid_price: bidprice},function(result){								
			$.post('./query/insert_bidding.php',{auction_id: id, itemid: ITEMID, timebid: diff, type: typeauction, bid_price: bidprice},function(result){								
					if (result.success){
					$.messager.alert('Info','Data Saved!','info');
					$(formname).datagrid('reload');	// reload the user data
				} 
				else 
				{
					$.messager.alert('Error',result.errorMsg,'error');
					$(formname).datagrid('reload');	// reload the user data
				}
			},'json');

        }		
	</script>	
	
	
		

		<script type="text/javascript">
			var clock;
			

			$(document).ready(function() {
				// Grab the current date

				diff = <?php echo $tgl; ?>;

				if (diff<=0)
				{
				  diff = 0;
				}
				
				clock = $('.clock').FlipClock({
		        clockFace: 'HourlyCounter',
		        autoStart: false,
		        callbacks: {
								stop: function() {
								$('.message').html('The clock has stopped!')
								}
							}
				});

				
				if (diff>0)
				{
					clock.setTime(diff);								
					clock.setCountdown(true);
					clock.start();
				}

				});

			
		</script>	
		
		<style type="text/css">
		.clock {
			position: relative !important;
			padding-top: 0px;
			margin-left: -100px;
			height:1px;
			width: 600px;
			transform: scale(.60);
			.flip-clock-wrapper {
			position: relative;
			}
	</style>
	</div>	
<!-- </div> -->
</body>
</html>