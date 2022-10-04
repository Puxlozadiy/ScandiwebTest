<?php 
include '../classes/products.class.php';
$products = new Products();
$products -> mass_delete($_GET['ids']);
header("Location: http://scandiweb2/");
?>