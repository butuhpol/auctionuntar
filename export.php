<?php
// Fungsi header dengan mengirimkan raw data excel
$auction_id = htmlspecialchars($_REQUEST['auction_id']); 
header("Content-type: application/vnd-ms-excel");
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=data_auction.xls");
// Tambahkan table
include 'export2excel.php';
?>