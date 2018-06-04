<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="./easyui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="./easyui/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="./easyui/themes/color.css">
	<link rel="stylesheet" type="text/css" href="./easyui/demo/demo.css">
	<script type="text/javascript" src="./easyui/jquery.min.js"></script>
	<script type="text/javascript" src="./easyui/jquery.easyui.min.js"></script>
</head>
<?php
  include 'config/ceklogin.php';

?>
<script>
	var link;
	var auction_id;
	var item_id;
	link ="";
	auction_id="";
	//$('#auction_id').combogrid('setValue', 1);
</script>

<body>
	<h2>Data Report Auction</h2>		
			<label class="easyui-label" style="width:100px">Auction Title :</label>
			<div style="width:400px">
				<select name="auction_id" class="easyui-combogrid" style="width:250px" data-options="
					panelWidth: 500,
					idField: 'auction_id',
					textField: 'nama',
					url: 'query/view_auction.php',
					method: 'get',					
					columns: [[
						{field:'auction_id',title:'Auction ID',width:80},
						{field:'nama',title:'Auction Name',width:100},
						{field:'remark',title:'Remark',width:130,align:'right'}
					]],	
					onSelect: function(index,row){							
						var opts = $('#dg').datagrid('options');
						opts.url = 'query/view_bidding.php?auction_id=' + row.auction_id;		
						link = 'query/update_auction_winner.php?auction_id='+ row.auction_id;	
						auction_id = row.auction_id;
						item_id = row.item_id;
						$('#dg').datagrid('reload');	
						if (row.posting==1)
						{							
							$('#processbtn').linkbutton('disable');
						}
						else
						{							
							$('#processbtn').linkbutton('enable');
						}
					},
					fitColumns: true
					">
				</select>   
			
        <a href="#" id="processbtn" class="easyui-linkbutton" data-options="iconCls:'icon-reload'" style="width:150px" onclick="process()"	>Process Winner</a>
        <a href="#" id="previewbtn" class="easyui-linkbutton" data-options="iconCls:'icon-search'" style="width:100px" onclick="preview()"	>Preview</a>

	</div>
	<script>
	function process()
	{
		if (link=="")
		{
		  alert('Please choose auction!');
		  return false;
		}
		window.location=link;
	}
	function preview()
	{
		if (auction_id=="")
		{
		  alert('Please choose auction!');
		  return false;
		}
		window.open('query/preview_auction.php?auction_id='+auction_id);
	}

	</script>
 			
				

		<div title="Auction Items" style="padding:10px"> 		
			<table id="dg" title="Item Details"  style="width:100%;height:350px"					
					class="easyui-datagrid"	
					pagination="true"
					rownumbers="true"
					fitColumns="true" 
					singleSelect="true"
					toolbar="#tb">
				<thead>
					<tr>
						<th field="image" width="100" sortable="true" formatter="gambar">Images</th>
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
					</tr>
				</thead>
			</table>
		</div>		
		
		<script type="text/javascript">					
					
					function gambar(val,row){				
						return '<img src="./images/' + row.image + '" style="width:100px;height:100px;">';
					}			

					function bidder(val,row){				
						var url = './query/process_winner.php?auction_id='+row.auction_id+'&itemid='+row.item_id;	
						//auction_id = row.auction_id;
						//item_id = row.item_id;
						$.post(url).done(               
							function(data)
							{
								$('#winner'+row.item_id).html(data);  //Update here with the response
							}
						);			
					return '<span id="winner'+row.item_id+'"></span>';

					}
					
					function update_winner_manual(get)
					{
						//untuk mendapatkan nilai option yang aktif
						var value = get.options[get.selectedIndex].value;	
						//untuk mendapatkan nilai option yang dipilih
						var option = get.selectedIndex;	
						var auction_id = value.substring(4, value.indexOf("item"));						
						i = parseInt(value.indexOf("item")) + 4;
						j = parseInt(value.indexOf("user"));
						var item_id = value.substring(i, j);												
						i = parseInt(value.indexOf("user")) + 4;
						j = parseInt(value.indexOf("price"));						
						var username = value.substring(i, j);						
						i = parseInt(value.indexOf("price")) + 5;
						var price = value.substring(i, value.length);						
						//alert('auction_id='+auction_id+' , item_id='+item_id+' , '+'username='+username + ' , price=' + price);
						window.location='query/update_auction_winner_manual.php?auction_id='+auction_id+'&item_id='+item_id+'&user_name='+username+'&bid_price='+price+'&winner='+option;
					}
		</script>

	
</body>
</html>