<?php
include("Api.php");
$products	= new Api();
$data	= ['OrderID' => $_GET["OrderID"],
		 'ProductID'=> $_GET["ProductID"] ];
echo $products->post ("http://localhost/northwind/api/savecancel.php",$data);
?>