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
			
	<div id="p" class="easyui-panel" title="Change Password" style="width:100%;height:100%;padding:10px;">
    	
			
			<div class="fitem">
				<label class="easyui-label" style="width:150px">Password Lama :</label>
				<input id="oldpassword" name="oldpassword" class="easyui-passwordbox" style="width:200px" >
			</div>
			<div class="fitem">
				<label class="easyui-label" style="width:150px">Password Baru :</label>
				<input id="newpassword" name="newpassword" class="easyui-passwordbox" style="width:200px">
			</div>
			<div class="fitem">
				<label class="easyui-label" style="width:150px">Ulangi Password Baru :</label>
				<input id="newpassword1" name="newpassword1" class="easyui-passwordbox" style="width:200px">
			</div>		
		<a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="save1()" style="width:90px">Save</a>				
	</div>	
	<script>
	   
		function save1(){
			user_id1 = '<?php echo $_SESSION['USERNAME']; ?>';
			//alert(user_id1);
			newpassword2 = $('#newpassword').val();			
			newpassword3 = $('#newpassword1').val();
			oldpassword1 = $('#oldpassword').val();				
			url = 'query/view_password.php?user_id='+user_id1+'&oldpassword='+oldpassword1;
			//alert(url);			
			$.post(url,function(result){							
				if (result.success==false){
						$.messager.alert('Info','Password lama salah!','Info');
						//alert('Password lama salah!');
						exit;
					}
					else
					{
						if (newpassword2 != newpassword3)
						{
							$.messager.alert('Info','Kolom password baru tidak sama kolom ulangi password!','Info');
							exit;
						}
						else
						{
							url = 'query/action_user.php?user_name='+user_id1+'&newpassword='+newpassword2+'&action=changepassword';
							//alert(url);							
								$.messager.confirm('Confirm','Apakah password ingin diganti?',function(r){
									if (r){						
										$.post(url,function(result){							
											if (result.success){
												$.messager.alert('Info','Password berhasil diganti','info');
												$('#oldpassword').passwordbox('setValue','');
												$('#newpassword').passwordbox('setValue','');
												$('#newpassword1').passwordbox('setValue','');
											} else {
												$.messager.alert('Info','Password gagal diganti','warning');
											}
										},'json');
									}
							});												
						}
					
					}					
			},'json');							
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