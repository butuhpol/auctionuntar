    <!DOCTYPE html>
    <html>

<head>
	<meta charset="UTF-8">
	<title>::Auction System::</title>
	<link rel="stylesheet" type="text/css" href="./easyui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="./easyui/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="./easyui/themes/color.css">
	<link rel="stylesheet" type="text/css" href="./easyui/demo/demo.css">
	<script type="text/javascript" src="./easyui/jquery.min.js"></script>
	<script type="text/javascript" src="./easyui/jquery.easyui.min.js"></script>
	<link rel='shortcut icon' type='image/x-icon' href='favicon.png' /> 

<style>
.dropbtn {
    background-color: #4CAF50;
    color: white;
    padding: 3px 5px 1px 10px;
    font-size: 11px;
    border: none;
    cursor: pointer;
	display: block;	
}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 120px;
	min-height: 50px;
    box-shadow: 0px 0px 0px 0px rgba(0,0,0,0.2);
    z-index: 1;
	font-size: 7px;
}

.dropdown-content a {
    color: black;
    padding: 1px;
    text-decoration: none;
    display: block;
	font-size: 5px;
	height: 18px;
}

.dropdown-content a:hover {background-color: #f1f1f1}

.dropdown:hover .dropdown-content {
    display: block;
}

.dropdown:hover .dropbtn {
    background-color: #3e8e41;
	
}
</style>
	
	<script>
	
		 $('#mm1').menubutton({
			iconCls: 'icon-edit',
			menu: '#mm1',
			disable: true
		});
		
		//$('#mm1').menubutton('disable');
	</script>
	
	
	<style type="text/css">
            body
            {
                margin:   0;
                overflow: hidden;
            }

            #iframe1
            {
                height:   100%;
                left:     0px;
                position: absolute;
                top:      0px;
                width:    100%;
            }
	</style>	

</head>

<?php 	

	include 'config/ceklogin.php';
	if ($_SESSION['ACCESS']=='USER')
	{
		 echo '<script> alert("Your not autorized!"); </script>';
		 die;
		 header("Location: index.php");
		 
	}
?>
    <body class="easyui-layout">
	
	<div id="content" region="north" style="width:100%;height:135px">	
        <h3>Auction System</h3>
	Welcome, 
	<div class="dropdown">
	<button class="dropbtn"><?php echo $_SESSION['FULLNAME']; ?> ▼</button>
	  <div id="myDropdown" class="dropdown-content">
		<a id="btn" href="#" class="easyui-linkbutton" onclick="window.frames['frame1'].location.replace('frm_profile.php')">Profile</a>
		<a id="btn" href="#" class="easyui-linkbutton" onclick="window.frames['frame1'].location.replace('frm_changepassword.php')">Change Password</a>
		<a id="btn" href="logout.php" class="easyui-linkbutton">Logout</a>    
	  </div>
	</div>
		
        <div style="margin:30px 0;"></div>
        <div class="easyui-panel" style="padding:5px;">
            <a href="" class="easyui-linkbutton" data-options="plain:true">Home</a>
			<?php
				if ($ACCESS != 'ADMIN')
				{
					echo "<!-- ";
				}
			?>
            <a href="#" class="easyui-menubutton" data-options="menu:'#mm1',iconCls:'icon-edit'">Master</a>
			<?php
				if ($ACCESS !='ADMIN')
				{
					echo " -->";
				}
			?>
			
            <a href="#" class="easyui-menubutton" data-options="menu:'#mm2',iconCls:'icon-mini-add'">Transaction</a>
			<?php
				if ($ACCESS != 'ADMIN')
				{
					echo "<!-- ";
				}
			?>
			<a href="#" class="easyui-menubutton" data-options="menu:'#mm3',iconCls:'icon-sum'">Report</a>
			<?php
				if ($ACCESS !='ADMIN')
				{
					echo " -->";
				}
			?>
            
			<a href="#" class="easyui-menubutton" data-options="menu:'#mm4'">About</a>
        </div>
		<?php
		if ($ACCESS != 'ADMIN')
		{
			echo " <!-- ";
		}
		?>
		
        <div id="mm1" style="width:150px;">
			<div data-options="iconCls:'icon-undo'" onclick="window.frames['frame1'].location.replace('frm_category.php')">Category Items</div>
            <div class="menu-sep"></div>
            <div data-options="iconCls:'icon-undo'" onclick="window.frames['frame1'].location.replace('frm_user.php')">User</div>
            <div data-options="iconCls:'icon-redo'" onclick="window.frames['frame1'].location.replace('frm_group.php')">Group</div>
        </div>
		<?php
		if ($ACCESS !='ADMIN')
		{
			echo " --> ";
		}
		?>
		
		
        <div id="mm2" style="width:100px;">
            <div  onclick="window.frames['frame1'].location.replace('frm_auction.php')">Auction</div>
        </div>
		<?php
		if ($ACCESS != 'ADMIN')
		{
			echo " <!-- ";
		}
		?>		
        <div id="mm3" style="width:130px;">
            <div  onclick="window.frames['frame1'].location.replace('frm_report.php')">Report Auction</div>
        </div>
		<?php
		if ($ACCESS !='ADMIN')
		{
			echo " --> ";
		}
		?>
    <div id="mm4" class="menu-content" style="background:#f0f0f0;padding:10px;text-align:left">
		<div data-options="iconCls:'icon-help'" onclick="window.frames['frame1'].location.replace('about.php')">About</div>		
    </div>
		

	</div>
	</div>
	<div id="content2" region="center" >
		<IFRAME src="blank.php" frameborder="0" name="frame1" width="100%" height="99%"></IFRAME>
	</div>
    </body>
    </html>