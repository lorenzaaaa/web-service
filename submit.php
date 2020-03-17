<?php
include("Api.php");
$products = new Api();

$data = json_decode(file_get_contents('php://input'),true);

try {
	$sql1= "INSERT INTO orders (OrderID,CustomerID,EmployeeID,OrderDate,RequiredDate)
			VALUES ('".$data["OrderID"]."','".$data['CustomerID']."','".$data['EmployeeID']."','".$data['OrderDate']."','".$data['RequiredDate']."')";
	
	$products->conn->query($sql1);
	
	$sql2="INSERT INTO order_details (OrderID,productID,Quantity)
			VALUES ('".$data['OrderID']."','".$data['products']['productID']."','".$data['products']['Quantity']."') ";
	
	$products->conn->query($sql2);
	
	echo "Successfully";
	
}catch(PDOException $e){
	echo "Failed saving to database : ".$e->getMessage() ;			
}
