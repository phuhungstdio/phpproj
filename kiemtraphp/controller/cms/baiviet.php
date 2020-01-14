<?php

session_start();
include_once('../../model/db.php');
include_once('../../model/baiviet.php');
//$target_dir = "../../upload/category/";

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
  $action = $_REQUEST['action'];
  
  $_SESSION["test"] = $action;
  if ($action == 'add') {
    // upload icon

    // $extension = pathinfo($_FILES["icon"]["name"], PATHINFO_EXTENSION);
    // $file_name_icon = time().".".$extension;
    // $target_file_icon = $target_dir . $file_name_icon;
    // move_uploaded_file($_FILES["icon"]["tmp_name"], $target_file_icon);
    // // upload banner;
    // $extension = pathinfo($_FILES["banner"]["name"], PATHINFO_EXTENSION);
    // $file_name_banner = time().".".$extension;
    // $target_file_banner = $target_dir . $file_name_banner;
    // move_uploaded_file($_FILES["banner"]["tmp_name"], $target_file_banner);

    //$url_target = 'http://localhost/kiemtraphp/upload/category/';
    $baiviet = new BaiViet(null, $_REQUEST['title'], $_REQUEST['description']);
    BaiViet::add($baiviet);

    header('Location: ' . $_SERVER['HTTP_REFERER']);
  } else if ($action == "delete") {
    BaiViet::delete($_REQUEST['id']);
    echo "<script>console.log('Debug Objects: asdasds' );</script>";
  } else if ($action == "edit") {
    echo "<script>console.log('edit: " . $_REQUEST['id'] . "' );</script>";
    $baiviet = BaiViet::getListById($_REQUEST['id']);

    // upload icon
    // $url_target = 'http://localhost/kiemtraphp/upload/category/';

    // if(getimagesize($_FILES["icon"]["tmp_name"])){
    //     $extension = pathinfo($_FILES["icon"]["name"], PATHINFO_EXTENSION);
    //     $file_name_icon = time()."-edit.".$extension;
    //     $target_file_icon = $target_dir . $file_name_icon;
    //     move_uploaded_file($_FILES["icon"]["tmp_name"], $target_file_icon);
    //     $category->image = $url_target.$file_name_icon;
    //     // unlink(__DIR__."upload")
    // }

    // // upload banner;
    // if(getimagesize($_FILES["banner"]["tmp_name"])){
    //     $extension = pathinfo($_FILES["banner"]["name"], PATHINFO_EXTENSION);
    //     $file_name_banner = time()."-edit.".$extension;
    //     $target_file_banner = $target_dir . $file_name_banner;
    //     move_uploaded_file($_FILES["banner"]["tmp_name"], $target_file_banner);
    //     $category->banner = $url_target.$file_name_banner;
    // }
    $baiviet->title = $_REQUEST['title'];
    $baiviet->description = $_REQUEST['description'];
    $_SESSION["test1"] = $baiviet->id;
    $_SESSION["test2"] = $baiviet->description;
    // $baiviet = new baiviet(null,$url_target.$file_name_banner,$_REQUEST['url_banner'],$_REQUEST['name'],$url_target.$file_name_icon,$_REQUEST['parent_id']);
    BaiViet::edit($baiviet);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
  } else if ($action == "view-edit") {
    $baiviet = BaiViet::getListById($_REQUEST['id']);
    //echo "<script>console.log('" . $baiviet->description . "Debug Objects: " . $baiviet->id . "' );</script>";
    
    echo "Debug Objects: " . $_REQUEST['action'] . "";
    echo '<form method="POST" action="http://localhost/kiemtraphp/controller/cms/baiviet.php" enctype="multipart/form-data"> 
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editCategoryModal">Edit Baiviet ' . $_REQUEST['id'] . '</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <input type="hidden" name="action" value="edit">
          <input type="hidden" name="id" value="' . $_REQUEST['id'] . '">
          <div class="form-group">
              <label for="title">Title</label>
              <input type="text" class="form-control" id="title" name="title" value="' . $baiviet->title . '" placeholder="Enter title">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" class="form-control"  name="description" cols="80" rows="10">
                ' . $baiviet->description . '
                </textarea>
                <script>
                CKEDITOR.replace( "description" );
                </script>
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
