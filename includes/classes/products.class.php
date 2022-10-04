<?php
include 'database.class.php';

class Products extends Database{
    public function fetch_all_products()  
    {  
        $conn = $this -> connect();
        $query = $conn -> query("SELECT * from products");
        $products = [];
        while($row = $query->fetch_assoc()) {
            array_push($products, $row);
        }
        return $products;
    }

    public function add_new_product($sku, $name, $price, $type, $size = 0, $height = 0, $width = 0, $length = 0, $weight = 0)
    {
        if(empty($sku) OR empty($name) OR empty($price) OR empty($type)){return;}
        if($type === "DVD"){
            if(empty($size)){return;}
            $height = 0;
            $width = 0;
            $length = 0;
            $weight = 0;
        }
        if($type === "Furniture"){
            if(empty($height) OR empty($width) OR empty($length)){return;}
            $size = 0;
            $weight = 0;
        }
        if($type === "Book"){
            if(empty($weight)){return;}
            $size = 0;
            $height = 0;
            $width = 0;
            $length = 0;
        }

        $conn = $this -> connect();
        $conn -> query("INSERT INTO products (SKU, Name, Price, Type, Size, Height, Width, Length, Weight) VALUES(" . "'{$sku}'," . "'{$name}'," . "{$price}," . "'{$type}'," . "{$size}," . "{$height}," . "{$width}," . "{$length}," . "{$weight}" . ")");
    }

    public function mass_delete($id_list){
        $conn = $this -> connect();
        foreach(explode(',', $id_list) as $id){
            $conn -> query("DELETE FROM products WHERE ID = '".$id."'");
        }
    }
}

?>