<!DOCTYPE html>
<html>

<?php
include 'config/ceklogin.php';
CekAdmin();
?>

<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="./easyui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="./easyui/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="./easyui/themes/color.css">
	<link rel="stylesheet" type="text/css" href="./easyui/demo/demo.css">
	<script type="text/javascript" src="./easyui/jquery.min.js"></script>
	<script type="text/javascript" src="./easyui/jquery.easyui.min.js"></script>
</head>
<body class="easyui-layout" style="width:100%;height:100%">
	
	<table id="dg" title="Data Group" class="easyui-datagrid" fit="true"
			url="query/view_group.php"
			pagination="true"
			rownumbers="true" fitColumns="true" singleSelect="true">
		<thead>
			<tr>
				<th field="name" width="100" sortable="true">Group Name</th>
				<th field="status" width="40">Status</th>
			</tr>
		</thead>
	</table>
	
	<!-- <div id="toolbar">
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newCategory()">New Category</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="editCategory()">Edit Category</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="deleteCategory()">Delete Category</a>		
	</div> 
	
	<div id="dlg" class="easyui-dialog" style="width:500px;height:500px;padding:10px 20px"
			closed="true" buttons="#dlg-buttons">
		<div class="ftitle">Data Category</div>
		<form id="fm" method="post" novalidate>
		
			<div class="fitem">
				<label class="easyui-label" style="width:200px">Category Name:</label>
				<input name="name" class="easyui-textbox" style="width:300px" required="true">
			</div>
			<div class="fitem">
				<label class="easyui-label" style="width:200px">Remark:</label>
				<input name="remark" class="easyui-textbox" style="width:300px" required="true">
			</div>
			<div class="fitem">
				<label class="easyui-label" style="width:100px">Status:</label>
				<select id="flag_id" class="easyui-combobox" name="flag_id" style="width:200px;" data-options="valueField: 'flag_id',required:true,prompt:'-Select-',value:''">
					<option value="1">Active</option>
					<option value="9">InActive</option>
				</select>		
			</div>			
		</form>
		
	</div>
	<div id="dlg-buttons">
		<a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveCategory()" style="width:90px">Save</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancel</a>
	</div>
	<script type="text/javascript">
		var url;
		function newCategory(){
			$('#dlg').dialog('open').dialog('setTitle','New Data');
			$('#fm').form('clear');
			url = 'query/action_category.php?category_id='+row.category_id+'&action=insert';
		}
		function editCategory(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$('#dlg').dialog('open').dialog('setTitle','Edit User');
				$('#fm').form('load',row);
				url = 'query/action_category.php?category_id='+row.category_id+'&action=update';
			}
		//	alert(url);
		}
		function saveCategory(){
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
		function deleteCategory(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$.messager.confirm('Confirm','Are you sure you want to delete this category?',function(r){
					if (r){
						$.post('query/action_category.php?action=delete',{category_id: row.category_id},function(result){
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
	-->
</body>
</html>