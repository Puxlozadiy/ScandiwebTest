<?php 
include '../classes/products.class.php';
print_r($_POST);
$products = new Products();
$products -> add_new_product($_POST['sku'], $_POST['name'], $_POST['price'], $_POST['type'], $_POST['size'], $_POST['height'], $_POST['width'], $_POST['length'], $_POST['weight']);
header("Location: http://scandiweb2/");
?>