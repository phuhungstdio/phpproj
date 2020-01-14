<?php
include_once('./Layouts/CMSHeader.php');
include_once('./Layouts/CMSSidebar.php');
include_once('./Layouts/CMSTopbar.php');
include_once('../../Models/TaiLieu.php');
$list = TaiLieu::getList();
// $category_parent = Category::getListParent();
?>
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800 d-sm-flex align-items-center justify-content-between mb-4">
    Bảng tài liệu
    <button data-toggle="modal" data-target="#addCategory" class="btn btn-primary btn-icon-split">
      <span class="text">Thêm mới</span>
    </button>
    <!-- Modal -->
    <div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="addCategoryModal" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <form method="POST" action="<?= Config::$urlbase ?>Controllers/CMS/TaiLieu.php" enctype="multipart/form-data">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addCategoryModal">Thêm tài liệu</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="action" value="add">
              <div class="form-group">
                <label for="name">Tên</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
              </div>
              <div class="form-group">
                <label for="tacGia">Tác giả</label>
                <input type="text" class="form-control" id="tacGia" name="tacGia" placeholder="Enter tacGia">
              </div>
              <div class="form-group">
                <label for="namXuatBan">Năm xuất bản</label>
                <input type="text" class="form-control" id="namXuatBan" name="namXuatBan" placeholder="Enter namXuatBan">
              </div>
              <div class="form-group">
                <label for="ngonNgu">Ngôn ngữ</label>
                <input type="text" class="form-control" id="ngonNgu" name="ngonNgu" placeholder="Enter ngonNgu">
              </div>
              <!-- <div class="form-group">
                <label for="parent_id">Parent id</label>
                <select class="form-control" id="parent_id" name="parent_id" placeholder="Enter name">
                  <option value="null">None</option>
                  </?php foreach($category_parent as $key => $value){ ?>
                  <option value="</?=$value->id?>"></?=$value->name;?></option>  
                  </?php } ?>
                </select>
              </div> -->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
              <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
          </div>
        </form>

      </div>
    </div>
  </h1>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">DataTables Tài liệu</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Mã tài liệu</th>
              <th>Tên tài liệu</th>
              <th>Tác giả</th>
              <th>Năm xuất bản</th>
              <th>Ngôn ngữ</th>
              <th width="120px">Action</th>

            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Mã tài liệu</th>
              <th>Tên tài liệu</th>
              <th>Tác giả</th>
              <th>Năm xuất bản</th>
              <th>Ngôn ngữ</th>
              <th width="120px">Action</th>
            </tr>
          </tfoot>
          <tbody>
            <?php foreach ($list as $value) { ?>
              <tr>
                <td><?= $value->id ?></td>
                <td><?= $value->name ?></td>
                <td><?= $value->tacGia ?></td>
                <td><?= $value->namXuatBan ?></td>
                <td><?= $value->ngonNgu ?></td>
                <!-- <td><img height="50px" src="<?= $value->icon ?>" alt=""></td>
                <td></?= $value->parent_id ?></td> -->
                <td>
                  <button class="btn btn-danger" onclick="confirm('aaa')?deleteCategory(<?= $value->id ?>):alert('xxx')" data-id="<?= $value->id ?>"><i class="fa fa-trash"></i></button>
                  <button class="btn btn-warning" onclick="editCategory(<?= $value->id ?>)" data-id="<?= $value->id ?>"><i class="fa fa-pencil-alt"></i></button>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="modal fade" id="editCategory" tabindex="-1" role="dialog" aria-labelledby="editCategoryModal" aria-hidden="true">
    <div class="modal-dialog" role="document">

    </div>
  </div>
</div>
<!-- /.container-fluid -->

<?php
include_once('./Layouts/CMSFooter.php');
?>
<script>
  function deleteCategory(id) {
    $.post("<?= Config::$urlbase ?>Controllers/CMS/TaiLieu.php", {
      id: id,
      action: "delete"
    }, function(data) {
      // console.log(data);
      alert("delete success");
      location.reload();
    });
  }

  function editCategory(id) {
    $.post("<?= Config::$urlbase ?>Controllers/CMS/TaiLieu.php", {
      id: id,
      action: "view-edit"
    }, function(data) {

      $("#editCategory .modal-dialog").html(data);
      $("#editCategory").modal('show');
    });
  }
  $(document).ready(function() {

  });
</script>
</body>

</html>