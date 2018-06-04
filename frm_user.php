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
	
	<table id="dg" title="Data User" class="easyui-datagrid" fit="true"
			url="query/view_user.php"
			toolbar="#toolbar" pagination="true"
			rownumbers="true" fitColumns="true" singleSelect="true">
		<thead>
			<tr>
				<th field="user_name" width="100" sortable="true">User Name</th>
				<th field="name" width="100" sortable="true">Full Name</th>
				<th field="groupuser" width="100" sortable="true">Group User</th>				
				<th field="email" width="100" sortable="true">Email</th>				
				<th field="no_hp" width="100" sortable="true">Mobile No</th>				
				<th field="address" width="100" sortable="true">Address</th>				
				<th field="status" width="40">Status</th>
			</tr>
		</thead>
	</table>
	<div id="toolbar">
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">New User</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Edit User</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="deleteUser()">Delete User</a>	
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-lock" plain="true" onclick="changepassword()">Change Password</a>			
	</div>
	
	<div id="dlg" class="easyui-dialog" style="width:500px;height:400px;padding:10px 20px"
			closed="true" buttons="#dlg-buttons">
		<div class="ftitle">Data User</div>
		<form id="fm" method="post" novalidate>
			<div class="fitem">
				<label class="easyui-label" style="width:100px">User Name:</label>
				<input name="user_name" id="user_name" class="easyui-textbox" style="width:200px" required="true">
			</div>
			
			<div class="fitem">
				<label class="easyui-label" style="width:100px">Full Name:</label>
				<input name="name" class="easyui-textbox" style="width:200px" required="true">
			</div>
			<div class="fitem">
				<label class="easyui-label" style="width:100px">Password:</label>
				<input name="password" id="password" class="easyui-passwordbox" prompt="Password" required="true" iconWidth="28" style="width:200px">			
			</div>
			<div class="fitem">
				<label class="easyui-label" style="width:100px">Group:</label>
				<select id="group_id" class="easyui-combobox" name="group_id" style="width:200px;" data-options="valueField: 'group_id',required:true,prompt:'-Select-',value:''">
					<option value="1">ADMIN</option>
					<option value="2">AUTHOR</option>
					<option value="3">VIEWER</option>
					<option value="4">USER</option>
				</select>		
			</div>	
			<div class="fitem">
				<label class="easyui-label" style="width:100px">Email:</label>
				<input id="email" name="email" class="easyui-validatebox" data-options="required:true,validType:'email'" iconWidth="28" style="width:200px">				
			</div>
			<div class="fitem">
				<label class="easyui-label" style="width:100px">Mobile No:</label>
				<input id="no_hp" class="easyui-textbox" name="no_hp" style="width:200px;" required="true">	
			</div>	
			<div class="fitem">
				<label class="easyui-label" style="width:100px">Addres:</label>
				<input name="address" class="easyui-textbox" style="width:200px;height:150px" required="true">	
			</div>				
			<div class="fitem">
				<label class="easyui-label" style="width:100px">Status:</label>
				<select id="status_id" class="easyui-combobox" name="status_id" style="width:200px;" data-options="valueField: 'status_id',required:true,prompt:'-Select-',value:''">
					<option value="1">Active</option>
					<option value="0">InActive</option>
				</select>		
			</div>				
		</form>		
	</div>
	
	<div id="dlg-buttons">
		<a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">Save</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancel</a>
	</div>
	
	<div id="dlg2" class="easyui-dialog" style="width:450px;height:200px;padding:10px 20px"
			closed="true" buttons="#dlg-buttons2">
		<div class="ftitle">Change Password</div>
		<form id="fm_changepassword" method="post" novalidate>		
			<div class="fitem">
				<label class="easyui-label" style="width:100px">New Password:</label>
				<input id="newpassword" name="newpassword" class="easyui-passwordbox" prompt="Password" iconWidth="28" style="width:200px">				
			</div>			
		</form>		
	</div>
	
	<div id="dlg-buttons2">
		<a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="savePassword()" style="width:90px">Save</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg2').dialog('close')" style="width:90px">Cancel</a>
	</div>
	
	<script type="text/javascript">
		var url;
		function newUser(){
			$('#user_name').textbox('enable');			
			$('#password').textbox('enable');
			$('#dlg').dialog('open').dialog('setTitle','New Data');
		//	alert('query/action_user.php?action=insert');			
			$('#fm').form('clear');
			//alert('query/action_user.php?user_name='+row.user_name+'&action=insert');
			url = 'query/action_user.php?action=insert';
		}
		function editUser(){
			var row = $('#dg').datagrid('getSelected');
			$('#user_name').textbox({disabled: true});					
			$('#password').textbox({disabled: true});
			if (row){
				$('#dlg').dialog('open').dialog('setTitle','Edit User');
				$('#fm').form('load',row);
				//url = 'query/action_user.php?action=update';
				url = 'query/action_user.php?user_name='+row.user_name+'&action=update';
			}
			//alert(url);
		}
		function saveUser(){
			$('#fm').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.errorMsg){
						$.messager.alert('Error',result.errorMsg,'error');					
					} else {
						$.messager.alert('Info','Data saved!','info');
						$('#dlg').dialog('close');		// close the dialog
						$('#dg').datagrid('reload');	// reload the user data
					}
				}
			});
		}
		function deleteUser(){
		
			var formname = '#dg';		
			var row3 = $(formname).datagrid('getSelected');
			if (row3){
				$.messager.confirm('Confirm','Are you sure you want to delete this data?',function(r){
					if (r){
						$.post('query/action_user.php',{user_name:row3.user_name, action:'delete'},function(result){							
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
		
		function changepassword(){
			$('#newpassword').textbox('setValue','');
			var row = $('#dg').datagrid('getSelected');			
			if (row){
				$('#dlg2').dialog('open').dialog('setTitle','Change Password');
				
				$('#fm_changepassword').form('load',row);				
				url = 'query/action_user.php?user_name='+row.user_name+'&action=changepassword';
			}
		}
		
		function savePassword(){
			$('#fm_changepassword').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){
					var result = eval('('+result+')');
					if (result.errorMsg){
						$.messager.alert('Error',result.errorMsg,'error');					
					} else {
						$.messager.alert('Info','Data saved!','info');
						$('#dlg2').dialog('close');		// close the dialog
						$('#dg').datagrid('reload');	// reload the user data
					}
				}
			});
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
	
</body>
</html>