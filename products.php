<?php
include("Api.php");

$limit = isset($_GET['limit'])?(int)$_GET['limit']:0;
$keyword = isset($_GET['name'])?(int)$_GET['name']:'';

$products = new Api();
echo $products->get($keyword,$limit);			