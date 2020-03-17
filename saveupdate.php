<?php
include("Api.php");
$products = new Api ();
$data = json_decode(file_get_contents('php://input'), true);
try {
	// simpan ke tabel order_detail
	$sql = "UPDATE order_details SET
			ProductID = '".$data["ProductID"]."',
			Quantity	= '".$data["Quantity"]."'
			WHERE OrderID='".$data["OrderID"]."' ";
		$products->conn->query($sql);
		echo "successfully.";
}catch (PDOException $e){
	echo "Failed saving to database : ".$e->getmessage();
}
?>