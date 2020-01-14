<?php

session_start();
include('../../Models/DBConnect.php');
include('../../Models/Category.php');
include('../../Models/Product.php');
include('../../Models/Muon.php');
include('../../Models/Image.php');
include('../../config.php');
$target_dir = "../../upload/image_product/";
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $action = $_REQUEST['action'];
    if ($action == 'add') {
        $extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
        $file_name_image = time() . "." . $extension;
        $target_file_image = $target_dir . $file_name_image;
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file_image);

        $url_target = Config::$urlbase . 'upload/image_product/';
        $product = new Product(null, $_REQUEST['name'], $_REQUEST['price'], $_REQUEST['description'],  null, $_REQUEST['category_id']);
        $product = Product::add($product);
        Image::add(new Image(null, $product->id, $url_target . $file_name_image));
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else if ($action == "delete") {
        Muon::traTaiLieu($_REQUEST['idTaiLieu'],$_REQUEST['idSinhVien']);
    } else if ($action == "edit") {
        $product = Product::getproductById($_REQUEST['id']);
        // upload icon
        $url_target = Config::$urlbase . 'upload/image_product/';

        // if(getimagesize($_FILES["icon"]["tmp_name"])){
        //     $extension = pathinfo($_FILES["icon"]["name"], PATHINFO_EXTENSION);
        //     $file_name_icon = time()."-edit.".$extension;
        //     $target_file_icon = $target_dir . $file_name_icon;
        //     move_uploaded_file($_FILES["icon"]["tmp_name"], $target_file_icon);
        //     $product->image = $url_target.$file_name_icon;
        //     // unlink(__DIR__."upload")
        // }

        // // upload banner;
        if (getimagesize($_FILES["image"]["tmp_name"])) {
            $extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
            $file_name_image = time() . "." . $extension;
            $target_file_image = $target_dir . $file_name_image;
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file_image);
            Image::add(new Image(null, $product->id, $url_target . $file_name_image));
        }
        $product->name = $_REQUEST['name'];
        $product->price = $_REQUEST['price'];
        $product->description = $_REQUEST['description'];
        $product->category_id = $_REQUEST['category_id'];
        Product::update($product);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else if ($action == "view-edit") {
        $product = Product::getProductById($_REQUEST['id']);
        $category = Category::getList();
        $select_category_id = "";

        foreach ($category as $key => $value) {
            $selected = $value->id == $product->id ? "selected" : "";
            $select_category_id .= '<option ' . $selected . ' value="' . $value->id . '">' . $value->name . ' </option> ';
        }
        echo '<form method="POST" action="' . Config::$urlbase . 'Controllers/CMS/Product.php" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addProductModal">Add Product</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <input type="hidden" name="action" value="edit">
        <input type="hidden" name="id" value="' . $_REQUEST['id'] . '">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" value="' . $product->name . '" id="name" name="name" placeholder="Enter name">
          </div>
          <div class="form-group">
            <label for="price">price</label>
            <input type="number" class="form-control" value="' . $product->price . '" id="price" name="price" placeholder="Enter price">
          </div>
          <div class="form-group">
            <label for="image">images</label>
            <input type="file" class="form-control"  accept="image/*" id="image" name="image" placeholder="Enter image">
            <img src="' . $product->images[0] . '" height="100px>
          </div>
          <div class="form-group">
            <label for="category">category</label>
            <select class="form-control" id="category" name="category_id" placeholder="Enter name">
            ' . $select_category_id . '
            </select>
          </div>
          <div class="form-group">
            <label for="deal">deal</label>
            <input type="number" value="' . $product->price . '" class="form-control" id="deal" name="deal" placeholder="Enter deal">
          </div>
          <div class="form-group">
            <label for="description">Description</label>
            <textarea id="editor2" class="form-control"  name="description" cols="80" rows="10">
              ' . $product->description . '
            </textarea>
            <script>
            CKEDITOR.replace( "editor2" );
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
