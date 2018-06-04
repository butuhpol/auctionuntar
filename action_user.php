<?php	
include '../config/ceklogin.php';
include '../config/koneksi.php';

$user_name = htmlspecialchars($_REQUEST['user_name']);
$action = htmlspecialchars($_REQUEST['action']);
$flag_id=1;


if (($action == 'insert') || ($action == 'update'))
{
	CekAdmin();
	$fullname = htmlspecialchars($_REQUEST['name']);	
	$group_id = htmlspecialchars($_REQUEST['group_id']);
	$status_id = htmlspecialchars($_REQUEST['status_id']);
	$no_hp = htmlspecialchars($_REQUEST['no_hp']);
	$email = htmlspecialchars($_REQUEST['email']);
	$address = htmlspecialchars($_REQUEST['address']);	
	
	if ($action == 'insert')
	{
		$password = htmlspecialchars($_REQUEST['password']);
		$sql = "select count(*) jumlah from m_user_t where  user_name='".$user_name."'";
		$res = mysqli_query($conn,$sql) or die(mysqli_error()) or die(mysqli_error());
		$row = mysqli_fetch_assoc($res);	
		$total = $row['jumlah'];
		if ($total>0)
		{
			echo json_encode(array('errorMsg'=>'User already exists!'));
			die;
		}
	}
}

if ($action == 'changepassword')
{
	$newpassword = htmlspecialchars($_REQUEST['newpassword']);
}

switch ($action) {
    case 'insert':
					$sql = "insert into m_user_t(user_name,name,password,group_id,no_hp,email,address,status_id,flag_id,date_add,user_add)
					values('$user_name','$fullname',md5('$password'),$group_id,'$no_hp','$email','$address',$status_id,$flag_id,now(),'$USERNAME')";
					break;
    case 'update':
					$sql = "update m_user_t set name='$fullname',group_id=$group_id,no_hp='$no_hp',email='$email',address='$address',status_id=$status_id,
							date_edit=now(),user_edit='$USERNAME' where user_name='$user_name'";
					break;	
	case 'delete':
					$sql = "update m_user_t set flag_id=9,date_edit=now(),user_edit='$USERNAME' where user_name='$user_name'";	
					break;
    case 'changepassword':
					$sql = "update m_user_t set password=md5('$newpassword') where user_name='".$user_name."'";					
					break;					
} 

SaveLog($sql);

$result = @mysqli_query($conn,$sql);
if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}
?>