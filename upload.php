<?php
//include '../config/ceklogin.php';
//include '../config/koneksi.php';

//CekAuthor();

$target_dir = "../images/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$image1 = basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
//echo $target_file;
// Check if image file is a actual image or fake image
//if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
//        echo  "<script> alert('File is an image - ".$check["mime"]."');			history.go(-1);					</script>";
        $uploadOk = 1;		
    } else {
        echo '<script> 
		   alert("File is not an image."); 
	//	history.go(-1);
		</script>';
        $uploadOk = 0;
		exit();
		
    }
//}

/*
// Check if file already exists
if (file_exists($target_file)) {
//	$abc = false;
	echo "<script>var confirm = confirm('Are you sure?');
          if(confirm){ 
            r = 'benar';
           }
		   else
		   {
			 r =  'salah';
		   }
          </script>";
	$nilai= trim("<script>document.write(r);</script>");
	if ($x==true)
	{
		echo '<script> 
		alert("benar"); 
		</script>';
		$uploadOk = 0; 
		exit();
	}
	else
	{
		echo '<script> 
		alert("salah"); 
		</script>';
		 $uploadOk = 1; 
	}
}
*/

// Check file size >2MB
if ($_FILES["image"]["size"] > 2100000) {
    echo "<script> alert('Sorry, your file is too large. Max 2MB');
	//	history.go(-1);
	</script>";
    $uploadOk = 0;
	exit();
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "JPG" && $imageFileType != "png" && $imageFileType != "PNG" && $imageFileType != "jpeg" && $imageFileType != "JPEG"
&& $imageFileType != "gif" && $imageFileType != "GIF" ) {
    echo "<script> alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');
	//	history.go(-1);
	</script>";
    $uploadOk = 0;
	exit();
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "<script> alert('Sorry, your file was not uploaded.');
	//	history.go(-1);
	</script>";
	exit();
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
		$berhasil =  basename( $_FILES["image"]["name"]);
     //   echo 
	//	"<script> alert('File ".$berhasil." has been uploaded.'); 
	//	window.location = 'upload.html';
	//	</script>";
		//"<script> alert('The file '".$berhasil. "' has been uploaded.'); </script>";
//		"<script> alert('The file '".$berhasil."' has been uploaded.'); </script>";
    } else {
        echo "<script> alert('Sorry, there was an error uploading your file.');
	//		history.go(-1);
		</script>";
		exit();
    }
}
?>
