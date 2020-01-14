<?php

// require 'DBConnect.php';

class Product {

    var $id;
    var $name;
    var $price;
    var $description;
    var $images; // là 1 array .
    var $category_id;
    var $category;
    public function __construct($id,$name,$price,$description,$images,$category_id,$category = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
        $this->images = $images;
        $this->category_id = $category_id;
    }

    static function getList(){
        $conn = DBConnect::connect();
        // print_r($conn);
        //Buoc 2: Thao tac voi CSDL: CRUD
        $sql = "SELECT products.* , images.image, images.id as imageID From products left join images 
        on products.id = images.product_id ORDER BY products.id ASC, images.id DESC";
        $result = $conn->query($sql);
        $ls = [];
        if($result->num_rows>0){
            $id = -1;
            $image = [];
            while($row = $result->fetch_assoc()){
                $count = count($ls);
                // print_r($row);
                if($count > 0 && $ls[$count - 1]->id == $row['id']){
                    $ls[$count - 1]->images[] = $row['image'];
                }else{
                    $ls[] = new Product($row['id'],$row['name'],$row['price'],$row['description'],[$row['image']],$row['category_id']);
                }
            }

        }    
        //Buoc 3: Dong ket noi
        $conn->close();

        return $ls;
    }
    
    static function getListByCategoryId($category_id){
        $ls = Product::getList();
        $res = [];
        foreach($ls as $product){
            if($product->category_id == $category_id)
                $res[] = $product;
        }
        return $res;
    }

    static function getProductById($id){
        $ls = Product::getList();
        foreach($ls as $product){
            if($product->id == $id)
                return $product;
        }
        return null;
    }

    static function add($product){
        $conn = DBConnect::connect();
        
        $sql = "INSERT INTO `products` (`name`, `description`, `price`,`category_id`) 
                VALUES ('".$product->name."',
                        '".$product->description."',
                        ".$product->price.",
                        ".$product->category_id.")";
        echo $sql."<br>";
        $result = $conn->query($sql);
        echo $conn->error;
        $get_list = product::getList();
        
        $conn->close();
        return $get_list[count($get_list)-1];
    }

    static function delete($id){
        $conn = DBConnect::connect();
        $sql = "DELETE FROM `products` WHERE `id` = ".$id;
        $result = $conn->query($sql);
        echo $conn->error;
        $conn->close();
    }

    static function update($product){
        $conn = DBConnect::connect();
        
        $sql = "UPDATE `products` SET `name`= '".$product->name."', 
                                    `description` = '".$product->description."', 
                                    `price`='".$product->price."',
                                    `category_id`=".$product->category_id."
                                    WHERE id = ".$product->id;
        $result = $conn->query($sql);
        $conn->close();
    }
}