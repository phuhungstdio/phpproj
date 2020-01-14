<?php
include_once('../layout/cms-header.php');
include_once('../layout/cms-sidebar.php');
include_once('../layout/cms-topbar.php');
include_once('../../../model/baiviet.php');
$list = BaiViet::getList();
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <?php echo $_SESSION["test"] ?>
    <?php echo $_SESSION["test1"] ?>
    <?php echo $_SESSION["test2"] ?>
    <h1 class="h3 mb-2 text-gray-800 d-sm-flex align-items-center justify-content-between mb-4">
        Tables Baiviet
        <button data-toggle="modal" data-target="#addBaiviet" class="btn btn-primary btn-icon-split">
            <span class="text">Add New</span>
        </button>
        <!-- Modal -->
        <div class="modal fade" id="addBaiviet" tabindex="-1" role="dialog" aria-labelledby="addBaivietModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form method="POST" action="http://localhost/kiemtraphp/controller/cms/baiviet.php" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addBaivietModal">Add BaiViet</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="action" value="add">
                            <div class="form-group">
                                <label for="name">Title</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter name">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="editor1" class="form-control" name="description" cols="80" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </h1>
    <!-- Page Heading -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Baiviet</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th width="120px">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th width="120px">Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($list as $value) { ?>
                            <tr>
                                <td><?= $value->id ?></td>
                                <td><?= $value->title ?></td>
                                <td><?= $value->description ?></td>
                                <td>
                                    <button class="btn btn-danger" onclick="confirm('aaa')?deleteBaiviet(<?= $value->id ?>):alert('xxx')" data-id="<?= $value->id ?>"><i class="fa fa-trash"></i></button>
                                    <button class="btn btn-warning" onclick="editBaiViet(<?= $value->id ?>)" data-id="<?= $value->id ?>"><i class="fa fa-pencil-alt"></i></button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editBaiViet" tabindex="-1" role="dialog" aria-labelledby="editBaiVietModal" aria-hidden="true">
        <div class="modal-dialog" role="document">

        </div>
    </div>
</div>
<!-- /.container-fluid -->

<?php
include_once('../layout/cms-footer.php');
?>
<script>
    function deleteBaiviet(id) {
        $.post("http://localhost/kiemtraphp/controller/cms/baiviet.php", {
            id: id,
            action: "delete"
        }, function(data) {
            // console.log(data);
            alert("delete success");
            location.reload();
        });
    }

    function editBaiViet(id) {
        $.post("http://localhost/kiemtraphp/controller/cms/baiviet.php", {
            id: id,
            action: "view-edit"
        }, function(data) {

            $("#editBaiViet .modal-dialog").html(data);
            $("#editBaiViet").modal('show');
        });
    }
    $(document).ready(function() {
        console.log("asdasdasd");
    });
    CKEDITOR.replace('editor1');
</script>

</body>

</html>