<?php

session_start();
include('../../Models/DBConnect.php');
include('../../Models/TaiLieu.php');
include('../../config.php');
// $target_dir = "../../upload/category/";
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
  $action = $_REQUEST['action'];
  if($action == 'add'){
    $taiLieu = new TaiLieu(null,$_REQUEST['name'],$_REQUEST['tacGia'],$_REQUEST['namXuatBan'],$_REQUEST['ngonNgu']);
    TaiLieu::add($taiLieu);
    header('Location: '.$_SERVER['HTTP_REFERER']);
  }else if($action == "delete"){
    TaiLieu::delete($_REQUEST['id']);
  }else if($action == "edit"){
    echo "<script>console.log('Debug Objects: ' );</script>";
    $taiLieu = TaiLieu::getTaiLieuById($_REQUEST['id']);
    $taiLieu->name = $_REQUEST['name'];
    $taiLieu->tacGia = $_REQUEST['tacGia'];
    $taiLieu->namXuatBan = $_REQUEST['namXuatBan'];
    $taiLieu->ngonNgu = $_REQUEST['ngonNgu'];
    TaiLieu::update($taiLieu);
    header('Location: '.$_SERVER['HTTP_REFERER']);
  }else if($action == "view-edit"){ 
    $taiLieu = TaiLieu::getTaiLieuById($_REQUEST['id']);
    // $category_parent = TaiLieu::getListParent();
    // $select_parent_id = "" ;
    
    // foreach($category_parent as $key => $value){ 
    //     $selected = $value->id == $category->parent_id?"selected":"";
    //     $select_parent_id .= '<option '.$selected.' value="'.$value->id.'">'.$value->name.' </option> ' ;
    // }
    echo '<form method="POST" action="'.Config::$urlbase.'Controllers/CMS/TaiLieu.php" enctype="multipart/form-data"> 
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editCategoryModal">Edit Tài liệu '.$taiLieu->id.'</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <input type="hidden" name="action" value="edit">
          <input type="hidden" name="id" value="'.$taiLieu->id.'">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" id="name" name="name" value="'.$taiLieu->name.'" placeholder="Enter name">
            </div>
            <div class="form-group">
              <label for="tacGia">Name</label>
              <input type="text" class="form-control" id="tacGia" name="tacGia" value="'.$taiLieu->tacGia.'" placeholder="Enter tacGia">
            </div>
            <div class="form-group">
              <label for="namXuatBan">Name</label>
              <input type="text" class="form-control" id="namXuatBan" name="namXuatBan" value="'.$taiLieu->namXuatBan.'" placeholder="Enter namXuatBan">
            </div>
            <div class="form-group">
              <label for="ngonNgu">Name</label>
              <input type="text" class="form-control" id="ngonNgu" name="ngonNgu" value="'.$taiLieu->ngonNgu.'" placeholder="Enter ngonNgu">
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
