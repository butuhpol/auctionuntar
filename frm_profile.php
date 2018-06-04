<!DOCTYPE html>
<html>

<?php
	include 'config/ceklogin.php';
	include 'config/koneksi.php';
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
	<div id="content" region="center">
	<?php
	
	$sql = "select user_name, name from m_user_t where user_name='".$_SESSION['USERNAME']."'";
	//echo $sql;	
	$rs = mysqli_query($conn,$sql );	
	$row = mysqli_fetch_assoc($rs);
	//$rows = array();
//	while($row = mysql_fetch_object($rs)){
//		$rows["user_name"] = $row->user_name;
//		$rows["name"] = $row->name;
//	}	
	?>
	
	<script>			
	//  $('#user_id').textbox('setValue','<?php echo $rows["user_id"]; ?>');
	//  $('#name').textbox('setValue','<?php echo $rows["name"]; ?>');
	//  $('#email').textbox('setValue','<?php echo $rows["email"]; ?>');
	//  $('#nohp').textbox('setValue','<?php echo $rows["nohp"]; ?>');
	</script>
    
	<div id="p" class="easyui-panel" title="Profile" style="width:100%;height:100%;padding:10px;">
    	
			
			<div class="fitem">
				<label class="easyui-label" style="width:100px">User Name:</label>
				<input id="user_id" name="user_id" class="easyui-textbox" style="width:200px" disabled="true" value="<?php echo $row["user_name"]; ?>" >
			</div>
			<div class="fitem">
				<label class="easyui-label" style="width:100px">Full Name:</label>
				<input id="name" name="name" class="easyui-textbox" style="width:200px" value="<?php echo $row["name"]; ?>">
			</div>
						
		<a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="save()" style="width:90px">Save</a>				
	</div>	
	<script>
		function save(){						
			user_id1 = $('#user_id').val();
			name1 = $('#name').val();
			url = 'query/action_profile.php?user_id='+user_id1+'&name='+name1;
			//alert(url);
			
				$.messager.confirm('Confirm','Save data?',function(r){
					if (r){						
						$.post(url,function(result){							
							if (result.success){
								$.messager.alert('Info','Data saved!','info');
							} else {
								$.messager.alert('Error','Save Failed!','info');;
							}
						},'json');
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

	</div>
</body>
</html>