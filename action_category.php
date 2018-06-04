<?php
$action = htmlspecialchars($_REQUEST['action']);

if (($action == 'delete') || ($action == 'update'))
{
	$category_id = htmlspecialchars($_REQUEST['category_id']);
}

include '../config/ceklogin.php';
include '../config/koneksi.php';
CekAdmin();

if (($action == 'insert') || ($action == 'update'))
{
	$name = htmlspecialchars($_REQUEST['name']);
	$remark = htmlspecialchars($_REQUEST['remark']);
	$flag_id = htmlspecialchars($_REQUEST['flag_id']);
}

switch ($action) {
    case 'insert':
					$sql = "insert into m_category_t(name,remark,flag_id,date_add,user_add)
					values('$name','$remark',$flag_id,now(),'$USERNAME')";
					break;
    case 'update':
					$sql = "update m_category_t set name='$name',remark='$remark',flag_id=$flag_id,date_edit=now(),user_edit='$USERNAME' where category_id=".$category_id;
					break;
	
	case 'delete':
					$sql = "update m_category_t set flag_id=9,date_edit=now(),user_edit='$USERNAME' where category_id=".$category_id;	
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