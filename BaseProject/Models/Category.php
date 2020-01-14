<?php


class Category extends DBConnect{

    var $id;
    var $name; // ảnh banner
    var $icon; // đường dẫn url cua banner khi click vao
    var $parent_id; // id cha của category
    
    public function __construct($id,$name,$icon,$parent_id)
    {
        $this->id = $id;
        $this->name = $name;
        $this->icon = $icon;
        $this->parent_id = $parent_id;
    }

    static function getList(){
        $conn = DBConnect::connect();
        $sql = "SELECT * From categories ";
        $result = $conn->query($sql);
        $ls = [];
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $cate = new Category($row['id'],$row['name'],$row['icon'],$row['parent_id']);
                $ls[] = $cate;
            }
        }    
        //Buoc 3: Dong ket noi
        $conn->close();
        return $ls;
    }

    static function getListParent(){
        $ls = Category::getList();
        $res = [];
        foreach($ls as $category){
            if($category->parent_id == null)
                $res[] = $category;
        }
        return $res;
    }
    static function getListChild($parent_id){
        $ls = Category::getList();
        $res = [];
        foreach($ls as $category){
            if($category->parent_id == $parent_id)
                $res[] = $category;
        }
        return $res;
    }

    static function getCategoryById($id){
        $ls = Category::getList();
        foreach($ls as $category){
            if($category->id == $id)
                return $category;
        }
        return null;
    }

    static function add($category){
        $conn = DBConnect::connect();
        
        $sql = "INSERT INTO `categories` (`name`, `icon`,`parent_id`) 
                VALUES ('".$category->name."',
                        '".$category->icon."',
                        ".$category->parent_id.")";
        echo $sql;
        
        $result = $conn->query($sql);
        echo $conn->error;
        $conn->close();
    }

    static function delete($id){
        $conn = DBConnect::connect();
        $sql = "DELETE FROM `categories` WHERE `id` = ".$id;
        $result = $conn->query($sql);
        echo $result;
        echo $conn->error;
        $conn->close();
    }


    static function update($category){
        $conn = DBConnect::connect();
        $sql = "UPDATE `categories` SET 
                                    `name`='".$category->name."',
                                    `icon`='".$category->icon."',
                                    `parent_id`=".$category->parent_id."
                                    WHERE id = ".$category->id;
        $result = $conn->query($sql);
        echo $conn->error;
        $conn->close();
    }
}