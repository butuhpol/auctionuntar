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
    <script type="text/javascript" src="./easyui/datagrid-detailview.js"></script>	
</head>
<?php
	include 'config/ceklogin.php';
?>
<script>
  
  var AuctionType
</script>

<body class="easyui-layout" style="width:100%;height:100%">
	<div id="content" region="north" style="width:100%;height:210px">
	<table id="dg" title="List Auction" class="easyui-datagrid" style="width:100%;height:200px"
			url="query/view_auction.php"
			toolbar="#toolbar"
			pagination="true"
			nowrap="false"
			rownumbers="true" fitColumns="true" singleSelect="true">
		<thead>
			<tr>
				<th field="nama" width="100" sortable="true">Auction Name</th>
				<th field="category" width="100" sortable="true">Category</th>	
				<th field="type" width="100" sortable="true">Type</th>									
				<th field="remark" width="100" sortable="true">Remark</th>
				<th field="status" width="40" sortable="true">Status</th>
				<th field="action" width="40" sortable="true" formatter="action">Action</th>
			</tr>
		</thead>
	</table>
	<?php
		if (($ACCESS =='ADMIN') or ($ACCESS =='AUTHOR'))
		{
		echo '
	<div id="toolbar">
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newAuction()">New Auction</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editAuction()">Edit Auction</a>		
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="deleteAuction()">Delete Auction</a>				
	</div>
	';
		}
	?>
	
	<script type="text/javascript">		
	   function action(val,row){
			
			var url ='frm_bidding.php?auction_id='+row.auction_id+'&type='+row.type;
			//URL ='frm_bidding.html?auction_id='+row.auction_id+'&type='+row.type;
			
			var runbid;
			if (row.status_id==2)
			{
				runbid = '<button style="width:70px" onclick="run('+row.auction_id+')">Run</button>';
			}
			else
			{
				runbid = '';
			}
			return runbid; //'<form method="post" action="'+url+'"><button style="width:70px" onclick="cekbid()">Bid</button></form>';
		}
	</script>

	
	<div id="dlg" class="easyui-dialog" style="width:550px;height:400px;padding:10px 20px"
			closed="true" buttons="#dlg-buttons">
	<div class="ftitle">Data Auction</div>
		<form id="fm" method="post" novalidate>
		
			<div class="fitem">
				<label class="easyui-label" style="width:100px">Auction Name:</label>
				<input name="nama" class="easyui-textbox" style="width:300px" required="true">
			</div>
			<div class="fitem">
				<label class="easyui-label" style="width:100px">Category:</label>
				<select name="category_id" class="easyui-combogrid" style="width:250px" data-options="
					panelWidth: 500,
					idField: 'category_id',
					textField: 'name',
					url: 'query/view_category.php',
					method: 'get',
					columns: [[
						{field:'category_id',title:'Category ID',width:80},
						{field:'name',title:'Category Name',width:100},
						{field:'remark',title:'Remark',width:130,align:'right'}
					]],
					fitColumns: true
					">
				</select>
			</div>	
			<div class="fitem">
				<label class="easyui-label" style="width:100px">Remark:</label>
				<input name="remark" class="easyui-textbox" multiline="true" style="width:300px;height:120px" required="true">
			</div>	
			<div class="fitem">
				<label class="easyui-label" style="width:100px">Type Auction:</label>
				<select id="type" class="easyui-combobox" name="type" style="width:200px;" data-options="valueField: 'type',required:true,prompt:'-Select-',value:''">
					<option value="ByPrice">ByPrice</option>
					<option value="ByIncrement">ByIncrement</option>
					<option value="ByFirstBid">ByFirstBid</option>
				</select>		
			</div>				
			<div class="fitem">
				<label class="easyui-label" style="width:100px">Status:</label>
				<select id="status_id" class="easyui-combobox" name="status_id" style="width:200px;" data-options="valueField: 'status_id',required:true,prompt:'-Select-',value:''">
					<option value="1">Prepare</option>
					<option value="2">Open</option>
					<option value="3">Closed</option>
				</select>		
			</div>				
		</form>		
	</div>
	
	<div id="dlg-buttons">
		<a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveAuction()" style="width:90px">Save</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancel</a>
	</div>
	
	
	<style type="text/css">
		#fm{
			margin:0;
			padding:10px 30px;
		}
		.ftitle{
			font-size:14px;
			font-weight:bold;
			padding:5px 0;
			margin-bottom:10px;
			border-bottom:1px solid #ccc;
		}
		.fitem{
			margin-bottom:5px;
		}
		.fitem label{
			display:inline-block;
			width:80px;
		}
		.fitem input{
			width:160px;
		}
	</style>
	
	<script type="text/javascript">
		var url;
		function newAuction(){
		//	$('#dlg').dialog('open').dialog('setTitle','New Data');				 
			  $('#dlg').dialog('open').dialog('setTitle','New Data Auction');
			  $('#fm').form('clear');	
			  url = 'query/save_auction.php';			  		
		}
		function editAuction(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$('#dlg').dialog('open').dialog('setTitle','Edit Data Auction');
				$('#fm').form('load',row);
				//alert(row.status_id);
				url = 'query/update_auction.php?auction_id='+row.auction_id;//+'&status_id='+row.status_id;
			}
		}
		function saveAuction(){
			$('#fm').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.errorMsg){
						$.messager.show({
							title: 'Error',
							msg: result.errorMsg
						});
					} else {
						$('#dlg').dialog('close');		// close the dialog
						$('#dg').datagrid('reload');	// reload the user data
					}
				}
			});
		}
		function deleteAuction(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$.messager.confirm('Confirm','Are you sure you want to delete this auction?',function(r){
					if (r){
						$.post('query/delete_auction.php',{auction_id:row.auction_id},function(result){
							if (result.success){
								$('#dg').datagrid('reload');	// reload the user data
							} else {
								$.messager.show({	// show error message
									title: 'Error',
									msg: result.errorMsg
								});
							}
						},'json');
					}
				});
			}
		}
	</script>	
	
	</div>
	
	<div id="content" region="center">
	<div class="easyui-tabs" fit="true">
        <div title="Details" style="padding:10px">         
			 <table id="dg_detail" title="Detail Auction" class="easyui-datagrid" fit="true"					
				toolbar="#toolbar3" 
				pagination="true"
				nowrap="false"
				rownumbers="true" fitColumns="true" singleSelect="true">
				<thead>
				<tr>
					<th field="image" width="20" sortable="true" formatter="gambar">Images</th>
					<th field="nama" width="70" sortable="true">Title</th>
					<th field="remark" width="70">Remark</th>
					<th field="opensale" width="30" align="right">Open Sale</th>
					<th field="bidincrement" width="30" align="right">Bid Increment</th>	
					<?php
					if ($ACCESS =='ADMIN')
					{
						echo '<th field="bidder" width="45" formatter="bidder">Highest Bid</th>';
					}
					?>
				</tr>
				</thead>
			</table>

			<script type="text/javascript">
			var HeaderAuction_id;
			$('#dg').datagrid({
				onSelect: function(rowIndex, rowData)
				{				
					//alert('test');
					var opts = $('#dg_detail').datagrid('options');
					var auctiondate = $('#dg_date').datagrid('options');
					AuctionType = rowData.type;
					HeaderAuction_id = rowData.auction_id;
					//alert(HeaderAuction_id);
					opts.url = './query/view_bidding.php?auction_id=' + rowData.auction_id;
					auctiondate.url = 'query/view_detailauction.php?auction_id=' + rowData.auction_id;
				//	opts.style = 'width:100%;height:50%';
				//	alert(opts.url);
					//opts.saveUrl = 'insert_address.php?contractid=' + row.ID;
					$('#dg_detail').datagrid('reload');	
					$('#dg_date').datagrid('reload');					
			}
			});

			  function run(x)
			  {
				window.open('frm_bidding.php?auction_id='+x+'&type='+AuctionType);
			  }
	
			function gambar(val,row){				
				return '<img src="./images/' + row.image + '" style="width:100%;height:100%;">';
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
			</script>

		</div>
		
        <div title="Date Auction" style="padding:10px">
			 <table id="dg_date" title="Auction Date" class="easyui-datagrid" fit="true"			
				toolbar="#toolbar2" 
				pagination="true"
				rownumbers="true" fitColumns="true" singleSelect="true">
				<thead>
				<tr>
					<th field="fromdate" width="70" sortable="true">From Date</th>
					<th field="enddate" width="70" sortable="true">End Date</th>
				</tr>
				</thead>
			</table>

        </div>
    </div>	

		<?php
		if (($ACCESS =='ADMIN') or ($ACCESS =='AUTHOR'))
		{
		echo '
	<div id="toolbar2">
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newDateAuction1()">New Date Auction</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editDateAuction1()">Edit Date Auction</a>		
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="deleteDateAuction1()">Delete Date Auction</a>				
	</div>';
		}
		?>
	
	
	<div id="dlg_date" class="easyui-dialog" style="width:550px;height:200px;padding:10px 20px"
			closed="true" buttons="#dlg-buttons2">
		<div class="ftitle">Data Auction Date</div>
		<form id="fm2" method="post" novalidate>		
			<div class="fitem">
				<label class="easyui-label" style="width:100px">Date From:</label>
				<input name="fromdate" class="easyui-datetimebox" style="width:300px" data-options="required:true,showSeconds:false">
			</div>
			<div class="fitem">
				<label class="easyui-label" style="width:100px">Date To:</label>
				<input name="enddate" class="easyui-datetimebox" style="width:300px" data-options="required:true,showSeconds:false">
			</div>
			
		</form>		
	</div>		

	<div id="dlg-buttons2">
		<a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveDateAuction1()" style="width:90px">Save</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg_date').dialog('close')" style="width:90px">Cancel</a>
	</div>
	
	
	<div id="dlg_detailauction" class="easyui-dialog" style="width:600px;height:450px;padding:10px 20px"
			closed="true" buttons="#dlg-buttons3">
		<div class="ftitle">Data Detail Auction</div>
		<form id="fm3" method="post" enctype="multipart/form-data" novalidate >		
			<div class="fitem">
				<label class="easyui-label" style="width:100px">Item Name:</label>
				<input name="nama" class="easyui-textbox" style="width:300px" required="true">
			</div>
			<div class="fitem">
				<label class="easyui-label" style="width:100px">Remark:</label>
				<input name="remark" class="easyui-textbox" multiline="true" style="width:300px;height:120px" required="true">
			</div>	
			<div class="fitem">
				<label class="easyui-label" style="width:100px">Open Sale:</label>
				<input name="open_sale" class="easyui-numberbox" style="width:300px" required="true">
			</div>	
			<div class="fitem">
				<label class="easyui-label" style="width:100px">Bid Increment:</label>
				<input name="bid_increment" class="easyui-numberbox" style="width:300px" required="true">
			</div>			
			<div class="fitem">
				<label class="easyui-label" style="width:100px">Image:</label>
				<input name="image" class="easyui-filebox" data-options="prompt:'Choose a file...'" style="width:100%" required="true">			
			</div>					
		</form>		
	</div>
	
	<script type="text/javascript">
		var url5;
		
		function newDateAuction1(){	
			//alert('test');
			//alert(HeaderAuction_id);
			$('#dlg_date').dialog('open').dialog('setTitle','New Date Auction');			
			$('#fm2').form('clear');				
  			url5 = 'query/save_auction_date.php?auction_id='+ HeaderAuction_id;	
		}
		
		function editDateAuction1(){
			var formname = '#dg_date';
			//alert(formname);			
			var row2 = $(formname).datagrid('getSelected');
			//alert(row2.date_auction_from);
			//alert(row2.auction_d_id);
			if (row2){
				$('#dlg_date').dialog('open').dialog('setTitle','Edit Data Auction');
				$('#fm2').form('load',row2);
				//alert($('#date_auction_from').datebox('getValue'));
				//alert(row.status_id);
				url5 = 'query/update_auction_date.php?auction_id='+HeaderAuction_id+'&auction_d_id='+row2.auction_d_id;//+'&status_id='+row.status_id;
				//alert(url2);
			}
		}
		
		function saveDateAuction1(){
			var formname = '#dg_date';// '#ddv2'+HeaderAuction_id;
			$('#fm2').form('submit',{
				url: url5,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.errorMsg){
						$.messager.show({
							title: 'Error',
							msg: result.errorMsg
						});
					} else {
						$('#dlg_date').dialog('close');		// close the dialog
						$(formname).datagrid('reload');	// reload the user data
					}
				}
			});
		}
		
		function deleteDateAuction1(){
			var formname = '#dg_date';		
			var row2 = $(formname).datagrid('getSelected');
			if (row2){
				$.messager.confirm('Confirm','Are you sure you want to delete this auction?',function(r){
					if (r){
						$.post('query/delete_auction_date.php',{auction_d_id:row2.auction_d_id},function(result){
							if (result.success){
								$(formname).datagrid('reload');	// reload the user data
							} else {
								$.messager.show({	// show error message
									title: 'Error',
									msg: result.errorMsg
								});
							}
						},'json');
					}
				});
			}
		}

	</script> 	
	
		<?php
		if (($ACCESS =='ADMIN') or ($ACCESS =='AUTHOR'))
		{
		echo '
	<div id="toolbar3">
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newDetailAuction()">New Item</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editDetailAuction()">Edit Item</a>		
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="deleteDetailAuction()">Delete Item</a>				
	</div>';
		}
		?>
	
	<div id="dlg-buttons3">
		<a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveDetailAuction()" style="width:90px">Save</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg_detailauction').dialog('close')" style="width:90px">Cancel</a>
	</div>

	<script type="text/javascript">
		var url3;
		
		function newDetailAuction(){			
	//		alert(HeaderAuction_id);
			$('#dlg_detailauction').dialog('open').dialog('setTitle','New Detail Auction');			
			$('#fm3').form('clear');				
  			url3 = 'query/save_auction_detail.php?auction_id='+ HeaderAuction_id;
		//	alert(url3);			
		}
		
		function editDetailAuction(){
			var formname = '#dg_detail';						
			var row3 = $(formname).datagrid('getSelected');
			
			if (row3){
				url3 = 'query/update_auction_detail.php?auction_id='+row3.auction_id+'&item_id='+row3.item_id+'&oldimage='+row3.image;//+'&status_id='+row.status_id;
				alert(url3);
				$('#dlg_detailauction').dialog('open').dialog('setTitle','Edit Data Detail Auction');
				$('#fm3').form('load',row3);
				//alert(row3.auction_id);

				
			}
		}
		
		function saveDetailAuction(){
		   // UploadDetailAuction();
		   //alert(url3);
			var formname = '#dg_detail';
			$('#fm3').form('submit',{
				url: url3,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.errorMsg){
						$.messager.show({
							title: 'Error',
							msg: result.errorMsg
						});
					} else {
						alert('Data has been saved.');
						$('#dlg_detailauction').dialog('close');		// close the dialog
						$(formname).datagrid('reload');	// reload the user data
					}
				}
			});
		}		
		
		
		function deleteDetailAuction(){
			var formname = '#dg_detail';		
			var row3 = $(formname).datagrid('getSelected');
			if (row3){
				$.messager.confirm('Confirm','Are you sure you want to delete this auction?',function(r){
					if (r){
						$.post('query/delete_auction_detail.php',{auction_id:row3.auction_id, item_id:row3.item_id},function(result){
							if (result.success){
								$(formname).datagrid('reload');	// reload the user data
							} else {
								$.messager.show({	// show error message
									title: 'Error',
									msg: result.errorMsg
								});
							}
						},'json');
					}
				});
			}
		}
	</script> 
	</div>
</body>
</html>