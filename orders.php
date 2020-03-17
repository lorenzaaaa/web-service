<?php
include("Api.php");
$products = new Api();

$data = [
			"OrderID"=>$_GET['OrderID'],
			"CustomerID"=>$_GET['CustomerID'],
			"EmployeeID"=>$_GET['EmployeeID'],
			"OrderDate"=>date("Y-m-d H:i:s"),
			"RequiredDate"=>date("Y-m-d H:i:s"),
			"products"=>[
				"productID"=>$_GET['productID'],
				"Quantity"=>$_GET['Quantity'],
			],
		];

echo $products->post('http://localhost/northwind/api/submit.php',$data);			