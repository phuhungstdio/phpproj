<?php

session_start();
include('../../Models/DBConnect.php');
include('../../Models/Category.php');
include('../../config.php');
$target_dir = "../../upload/category/";
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
  $action = $_REQUEST['action'];
  if($action == 'add'){
    // upload icon
    $extension = pathinfo($_FILES["icon"]["name"], PATHINFO_EXTENSION);
    $file_name_icon = time().".".$extension;
    $target_file_icon = $target_dir . $file_name_icon;
    move_uploaded_file($_FILES["icon"]["tmp_name"], $target_file_icon);
  

    $url_target = Config::$urlbase.'upload/category/';
    $category = new Category(null,$_REQUEST['name'],$url_target.$file_name_icon,$_REQUEST['parent_id']);
    Category::add($category);
    header('Location: '.$_SERVER['HTTP_REFERER']);
  }else if($action == "delete"){
    Category::delete($_REQUEST['id']);
  }else if($action == "edit"){
    $category = Category::getCategoryById($_REQUEST['id']);
    // upload icon
    $url_target = Config::$urlbase.'upload/category/';
    if(getimagesize($_FILES["icon"]["tmp_name"])){
        $extension = pathinfo($_FILES["icon"]["name"], PATHINFO_EXTENSION);
        $file_name_icon = time()."-edit.".$extension;
        $target_file_icon = $target_dir . $file_name_icon;
        move_uploaded_file($_FILES["icon"]["tmp_name"], $target_file_icon);
        $category->icon = $url_target.$file_name_icon;
        // unlink(__DIR__."upload")
    }
   
    $category->name = $_REQUEST['name'];
    $category->parent_id = $_REQUEST['parent_id'];
    Category::update($category);
    header('Location: '.$_SERVER['HTTP_REFERER']);
  }else if($action == "view-edit"){ 
    $category = Category::getCategoryById($_REQUEST['id']);
    $category_parent = Category::getListParent();
    $select_parent_id = "" ;
    
    foreach($category_parent as $key => $value){ 
        $selected = $value->id == $category->parent_id?"selected":"";
        $select_parent_id .= '<option '.$selected.' value="'.$value->id.'">'.$value->name.' </option> ' ;
    }
    echo '<form method="POST" action="'.Config::$urlbase.'Controllers/CMS/Category.php" enctype="multipart/form-data"> 
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editCategoryModal">Edit Category '.$category->id.'</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <input type="hidden" name="action" value="edit">
          <input type="hidden" name="id" value="'.$category->id.'">
          <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" id="name" name="name" value="'.$category->name.'" placeholder="Enter name">
            </div>
            <div class="form-group">
              <label for="icon">Icon</label>
              <input type="file" class="form-control" id="icon" name="icon" placeholder="Enter icon">
              <img src="'.$category->image.'" height="100px">
            </div>
            <div class="form-group">
              <label for="parent_id">Parent id</label>
              <select class="form-control" id="parent_id" name="parent_id" placeholder="Enter name">
                <option value="null">None</option>
                '.$select_parent_id.'
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </form>';
  }


}
?>