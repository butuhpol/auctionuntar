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
  
      <h2>About Us</h2>
		<div class="side" >
			<div class="row">
				<div class="fakeimg" style="height:320px;width:200"><img src="images/januar.jpeg" style="height:170px;width:130px">
				<p>januar mansur</p>
				<p>NIM : 535150040</p>
				<p>Jurusan : Teknik Informatika</p>		
				</div>
			</div>
		</div>
		<div class="side" >
			<div class="row">
				<div class="fakeimg" style="height:320px;width:200"><img src="images/gevin.jpeg" style="height:170px;width:130px">
				<p>Gevin Valerian</p>
				<p>NIM : 535150056</p>
				<p>Jurusan : Teknik Informatika</p>
				</div>
			</div>
		</div>
		<div class="side" >
			<div class="row">		
				<div class="fakeimg" style="height:320px;width:200"><img src="images/deven.jpeg" style="height:170px;width:130px">
				<p>Deven Austin</p>
				<p>NIM : 535150050</p>
				<p>Jurusan : Teknik Informatika</p>
				</div>
			</div>
		</div>
  </div>
 
<div class="footer">
  <h2>Auction System (c)2018</h2>
</div>

</body>
</html>
