<?php
include 'database.class.php';

class Products extends Database{
    public function fetch_all_products()  
    {  
        $conn = $this->connect();
        $query = $conn->query("SELECT * from products");
        $products = [];
        while($row = $query->fetch_assoc()) {
            array_push($products, $row);
        }
        return $products;
    }

    public function add_new_product($sku, $name, $price, $type, $size, $height, $width, $length, $weight)
    {
        $validateParams = function ($param){
            if(empty($param)){
                $param = 0;
                return $param;
            }
            $param = "'$param'";
            return $param;
            
        };
        $params = array_map($validateParams, func_get_args());
        $conn = $this->connect();
        $sql = "INSERT INTO products (SKU, Name, Price, Type, Size, Height, Width, Length, Weight) VALUES(" . implode(", ", $params) . ")";
        $conn->query($sql);
        return;
    }

    public function mass_delete($id_list)
    {
        $conn = $this->connect();
        foreach(explode(',', $id_list) as $id){
            $conn->query("DELETE FROM products WHERE ID = '$id'");
        }
    }
}