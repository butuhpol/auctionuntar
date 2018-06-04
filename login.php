<?php
session_start();
include 'config/koneksi.php';

$message = '';
$error = -1;
 
// check to see if login form has been submitted
if(isset($_POST['userLogin'])){
	// run information through authenticator	

		if (CekUserLocal($_POST['userLogin'],$_POST['userPassword']))
		{
			if ($USERSTATUS > 1)
			{				
				$error = $USERSTATUS;
			}
			else
			{
				$_SESSION['ACCESS'] = $ACCESS;
				$_SESSION['USERNAME'] = strtolower($_POST['userLogin']);
				$_SESSION['FULLNAME'] = $FULLNAME;			
				$error = 0;				
			}
		}
		else
		{
		//cek jika user di database local disable
			$error=1;					
		}

	
}

// output error to user

switch ($error) {
    case 1:
        $message = "Incorrect user name or password!";
        break;
	case 2:
        $message = "Username Inactive!";
        break;		
	case 0:	
		if ($_SESSION['ACCESS']=='USER')
		{
			header("Location: index.php");
			}
			else
			{
				header("Location: admin.php");
			}
		die();
	default:
	//	header("Location: login.html");	
}
  
?>

<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Login Form</title>
  <link rel="stylesheet" href="js/style.css">
  <link rel='shortcut icon' type='image/x-icon' href='favicon.png' />  
	<link rel="stylesheet" type="text/css" href="./easyui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="./easyui/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="./easyui/themes/color.css">
	<link rel="stylesheet" type="text/css" href="./easyui/demo/demo.css">
	<script type="text/javascript" src="./easyui/jquery.min.js"></script>
	<script type="text/javascript" src="./easyui/jquery.easyui.min.js"></script>
	  
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>
  <section class="container">
	<div class="login">
      	<h1>Login to Auction System</h1>
      <form method="post" action="login.php">
        <p><input type="text" name="userLogin" value="" placeholder="Username"></p>
        <p><input type="password" name="userPassword" value="" placeholder="Password"></p>       
		<div class="message" style="margin:2em;"><?php echo $message; ?> </div>
		<p class="submit"><input type="submit" name="commit" value="Login"></p>
		<a href="javascript:void(0)" class="easyui-linkbutton" onclick="registrasi()">Register</a>
		<!-- <p class="submit"><input type="submit" name="register" value="Register"> -->
        </p>
      </form>
    </div>
  </section>

<div id="dlg" class="easyui-dialog" style="width:500px;height:540px;padding:10px 20px"
			closed="true" buttons="#dlg-buttons">
		<h2><div class="ftitle">Data User</div></h2>
		
		<form id="fm1" method="post" novalidate>
		
			<div class="fitem">
				<label class="easyui-label" style="width:120px">User Name:</label>
				<input name="user_id" class="easyui-textbox" style="width:200px" required="true">
			</div>
			<div class="fitem">
				<label class="easyui-label" style="width:120px">Full Name:</label>
				<input name="nama" class="easyui-textbox" style="width:200px" required="true">
			</div>			
			<div class="fitem">
				<label class="easyui-label" style="width:120px">Password:</label>
				<input name="password" class="easyui-passwordbox" prompt="Password" required="true" iconWidth="28" style="width:200px">			
			</div>
			<div class="fitem">
				<label class="easyui-label" style="width:120px">Email:</label>
				<input id="email" name="email" class="easyui-validatebox" data-options="required:true,validType:'email'" iconWidth="28" style="width:200px">				
			</div>
			<div class="fitem">
				<label class="easyui-label" style="width:120px">Mobile No:</label>
				<input id="nohp" class="easyui-textbox" name="nohp" style="width:200px;" required="true">	
			</div>	
			<div class="fitem">
				<label class="easyui-label" style="width:120px">Address:</label>
				<input name="address" class="easyui-textbox" style="width:200px;height:150px" required="true">
			</div>				
		</form>		
	</div>  
	
	<div id="dlg-buttons">
		<a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="save2()" style="width:90px">Save</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancel</a>
	</div>
	
<script>
  	var url;
	function registrasi()
	{
		$('#dlg').dialog('open').dialog('setTitle','New Data');
		$('#fm1').form('clear');			
		url = 'query/action_reguser.php';
	}
    function save2()
	{	
			//alert(url);
			$('#fm1').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(result){					
					var result = eval('('+result+')');						
					if (result.errorMsg){
						$.messager.alert('Error',result.errorMsg,'warning');
					} else {
						$.messager.alert('Info','Data saved!','info');
						$('#dlg').dialog('close');		// close the dialog
						//$('#dg').datagrid('reload');	// reload the user data
					}
				}
			});
	}
  </script>	
  <style type="text/css">
		#fm1{
			margin:0;
			padding:10px 30px;
		}
		.ftitle{
			font-size:10px;
			font-weight:bold;
			padding:1px 0;
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
