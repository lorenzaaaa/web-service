<?php
include("Api.php");
$products	= new Api();
$data	= ['OrderID' => $_GET["OrderID"],
		 'ProductID'=> $_GET["ProductID"],
		 'Quantity'=> $_GET["Quantity"]];
echo $products->put ("http://localhost/northwind/api/saveupdate.php",$data);
?>i