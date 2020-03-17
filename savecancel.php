<?php
include("Api.php");
$products = new Api ();
$data = json_decode((file_get_contents('php://input'), true);
try {
	// simpan ke tabel order_detail
	$sql = "DELETE FROM order_detail WHERE
			ProductsID = '".$data["ProductsID"]."',
			AND OrderID='".$data["OrderID"]."' ";
		$products->conn->query($sql);
		echo "successfully. Query : ".$sql;
}catch (PDOException $e){
	echo "Failed saving to database : ".$e->getmessage();
}
?>