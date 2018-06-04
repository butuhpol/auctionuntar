<!DOCTYPE html>
<?php
  session_start();
	if (isset($_SESSION['USERNAME'])!='')
	{
		$username = $_SESSION['USERNAME'];
	} 
		else
		{
			$username = '';
		}
  //echo 'username='.$username;
  //die;
?>
<html lang="en">
<head>
<title>Auction System</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel='shortcut icon' type='image/x-icon' href='favicon.png' />  
	<link rel="stylesheet" type="text/css" href="./easyui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="./easyui/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="./easyui/themes/color.css">
	<link rel="stylesheet" type="text/css" href="./easyui/demo/demo.css">
	<script type="text/javascript" src="./easyui/jquery.min.js"></script>
	<script type="text/javascript" src="./easyui/jquery.easyui.min.js"></script>

<style>
* {
    box-sizing: border-box;
}

/* Create four equal columns that floats next to each other */
.column {
    float: left;
    width: 25%;
    padding: 10px;
}

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}

/* Responsive layout - makes a two column-layout instead of four columns */
@media screen and (max-width: 900px) {
    .column  {
        width: 50%;
    }
}

/* Responsive layout - makes the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
    .column  {
        width: 100%;
    }
}
</style>

<style>
* {
    box-sizing: border-box;
}

/* Style the body */
body {
    font-family: Arial;
    margin: 0;
}

/* Header/logo Title */
.header {
    padding: 10px;
    text-align: center;
    background: #1abc9c;
    color: white;
}

/* Increase the font size of the heading */
.header h1 {
    font-size: 40px;
}

/* Style the top navigation bar */
.navbar {
    overflow: hidden;
    background-color: #333;
}

/* Style the navigation bar links */
.navbar a {
    float: left;
    display: block;
    color: white;
    text-align: center;
    padding: 14px 20px;
    text-decoration: none;
}

/* Right-aligned link */
.navbar a.right {
    float: right;
}

/* Change color on hover */
.navbar a:hover {
    background-color: #ddd;
    color: black;
}

/* Column container */
.row {  
    display: -ms-flexbox; /* IE10 */
    display: flex;
    -ms-flex-wrap: wrap; /* IE10 */
    flex-wrap: wrap;
}

/* Create two unequal columns that sits next to each other */
/* Sidebar/left column */
.side {
    -ms-flex: 30%; /* IE10 */
    flex: 30%;
    background-color: #f1f1f1;
    padding: 20px;
}

/* Main column */
.main {   
    -ms-flex: 70%; /* IE10 */
    flex: 70%;
    background-color: white;
    padding: 20px;
}

/* Fake image, just for this example */
.fakeimg {
    background-color: #aaa;
    width: 100%;
    padding: 20px;
}

/* Footer */
.footer {
    padding: 5px;
    text-align: center;
    background: #ddd;
}

/* Responsive layout - when the screen is less than 700px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 700px) {
    .row {   
        flex-direction: column;
    }
}

/* Responsive layout - when the screen is less than 400px wide, make the navigation links stack on top of each other instead of next to each other */
@media screen and (max-width: 400px) {
    .navbar a {
        float: none;
        width: 100%;
    }
}
</style>

<style>
* {
    box-sizing: border-box;
}

body {
    background-color: #f1f1f1;
    padding: 20px;
    font-family: Arial;
}

/* Center website */
.main {
    max-width: 1000px;
    margin: auto;
}

h1 {
    font-size: 50px;
    word-break: break-all;
}

.row {
    margin: 10px -16px;
}

/* Add padding BETWEEN each column */
.row,
.row > .column {
    padding: 8px;
}

/* Create three equal columns that floats next to each other */
.column {
    float: left;
    width: 33.33%;
    display: none; /* Hide all elements by default */
}

/* Clear floats after rows */ 
.row:after {
    content: "";
    display: table;
    clear: both;
}

/* Content */
.content {
    background-color: white;
    padding: 10px;
}

/* The "show" class is added to the filtered elements */
.show {
  display: block;
}

/* Style the buttons */
.btn {
  border: none;
  outline: none;
  padding: 12px 16px;
  background-color: white;
  cursor: pointer;
}

.btn:hover {
  background-color: #ddd;
}

.btn.active {
  background-color: #666;
  color: white;
}
</style>

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

</head>
<body>

<div class="header">
  <h1>Auction System</h1>
  <p>Online Auction</p>
</div>

<div class="navbar">
  <a href="index.php">Home</a>
  <a href="#" onclick="registrasi()">Register</a>
  <a href="about.php" >About Us</a>
  <a href="admin.php">Admin Mode</a>
  <?php if ($username=='')
  {
	  echo '<a href="login.php" class="right">Login</a>';
  }
	 else 
	 {
		 echo '<a href="logout.php" class="right">Logout</a>';
	 }
	 ?>
</div>

<div class="row">
  <div class="main">
      <h2>Auction System</h2>      
      <div class="fakeimg" style="height:200px;"><img src="images/auction_image.jpg" style="height:150px;weight:500px"></div>      
      <p>Selamat datang di Aplikasi Auction System Online. Aplikasi berbasis web untuk lelang secara langsung.</p>            
  </div>
</div>

<h2>Auction Categories</h2>

<?php include 'config/koneksi.php'; 
	$sql = "select * from m_category_t where flag_id=1";
	$result = mysqli_query($conn,$sql );									
?>

<div id="myBtnContainer">
  <button class="btn active" onclick="filterSelection('all')"> Show all</button>
  <?php 
  	while ($r = mysqli_fetch_assoc($result)) {															
  ?>
  <button class="btn" onclick="filterSelection('<?php echo $r['name']; ?>')"> <?php echo $r['name']; ?></button>
	<?php } ?>
</div>

<!-- Portfolio Gallery Grid -->
<div class="row">
	<?php 
	

	
  	$sql = "select a.*,b.status_id, b.type,  c.name category, case when b.status_id=2 then 'Open' 
			when b.status_id=3 then 'Closed' end status,format(open_sale,0) sale, format(bid_increment,0) increment
			from tdd_auction_t a
			join th_auction_t b on a.auction_id=b.auction_id
			join m_category_t c on c.category_id=b.category_id
			where a.flag_Id=1 and b.flag_id=1";
	$result = mysqli_query($conn,$sql );  
	while ($r = mysqli_fetch_assoc($result)) {
	?>
  <div class="column <?php echo $r['category']; ?>">
    <div class="content">
      <img src="images/<?php echo $r['image']; ?>" alt="<?php echo $r['nama']; ?>" style="width:100%">
      <h4><?php echo $r['nama']; ?></h4>
      <p><?php echo $r['remark']; ?></p>
	  <p><?php echo 'Status : '. $r['status']; ?></p>
	  <p><?php echo 'Open Sale : '. $r['sale']; ?></p>
	  <p><?php echo 'Increment : '. $r['increment']; ?></p>
	  <p><?php if ($r['status_id']==2)
		  {						  
			echo '<button onclick="bid('.$r['auction_id'].','.$r['item_id'].')"> Bid </button>';  
		  }
		  ?></p>
    </div>
  </div>
	<?php } ?>	
  
<!-- END GRID -->
</div>

<!-- END MAIN -->
</div>

<script>
filterSelection("all")
function filterSelection(c) {
  var x, i;
  x = document.getElementsByClassName("column");
  if (c == "all") c = "";
  for (i = 0; i < x.length; i++) {
    w3RemoveClass(x[i], "show");
    if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
  }
}

function w3AddClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    if (arr1.indexOf(arr2[i]) == -1) {element.className += " " + arr2[i];}
  }
}

function w3RemoveClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    while (arr1.indexOf(arr2[i]) > -1) {
      arr1.splice(arr1.indexOf(arr2[i]), 1);     
    }
  }
  element.className = arr1.join(" ");
}


// Add active class to the current button (highlight it)
var btnContainer = document.getElementById("myBtnContainer");
var btns = btnContainer.getElementsByClassName("btn");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function(){
    var current = document.getElementsByClassName("active");
    current[0].className = current[0].className.replace(" active", "");
    this.className += " active";
  });
}
</script>


</div>

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
	
	function bid(x,item)
			  {
				//  alert('ok');
				var user = '<?php echo $username; ?>'
				if (user=='')
				{
				  alert('Login terlebih dahulu!');	
				}
				else
				{
				window.open('frm_bidding.php?auction_id='+x+'&type=ByPrice&item_id='+item);
				}
			  }
	 
  
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


 
<div class="footer">
  <h2>Auction System (c)2018</h2>
</div>

</body>
</html>
