<?php
session_start();
include_once('../../Models/DBConnect.php');
include_once('../../Models/Category.php');
include_once('../../Models/Cart.php');
include_once('../../Models/Product.php');
$category_parents = Category::getListParent();
$product = Product::getProductById($_REQUEST['idProduct']);
$user = null;
if (isset($_SESSION['user']))
    $user = unserialize($_SESSION['user']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- <meta name="viewport" content="width=device-width" /> -->
    <title> Product Detail </title>

    <!-- <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content=""> -->

    <!-- Bootstrap Core CSS -->
    <!-- <link href="Content/bootstrap.css" rel="stylesheet" /> -->

    <!-- Custom CSS -->
    <!-- <link href="Content/product_detail_page.css" rel="stylesheet" />
    <link href="Content/shop-homepage.css" rel="stylesheet" /> -->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>

    <!-- <%
		ArrayList<CategoryBean> categories = (ArrayList<CategoryBean>) request.getAttribute("categories");
		BookBean book = (BookBean) request.getAttribute("book");
		UserBean user = (UserBean) session.getAttribute("user_shop_book");
	%> -->

    <!-- Navigation -->

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Trang chủ<span class="sr-only">(current)</span></a>
                </li>
                <?php
                if ($user != null) {
                ?>
                    <li>
                        <a href="AuthController">

                            <?= $user->name ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="AuthController?logout=true">Đăng Xuất</a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item"><a class="nav-link"> Đăng Nhập</a></li>
                <?php } ?>
                <li class="nav-item">
                    <a class="nav-link" href="#"> Giỏ hàng (<?php echo cart::getList() == null ? 0 : count(cart::getList()) ?>) </a>
                </li>
            </ul>
        </div>
    </nav>



    <!-- Page Content -->
    <div class="container">
        <div class="row">

            <!-- DANH MỤC SÁCH -->
            <div class="col-md-3">
                <p class="lead"> DANH MỤC CATEGORY</p>
                <div class="list-group">
                    <?php foreach ($category_parents as $category) { ?>
                        <a href="http://localhost/BaseProject/Views/page/Home.php?categoryId=<?= $category->name ?>%>" class="list-group-item">
                            <?php echo $category->name ?>
                        </a>
                    <?php } ?>
                </div>
            </div>

            <!-- MAIN -->
            <div class="col-md-9">
                <!-- BANNER -->
                <div class="row carousel-holder">
                    <div class="col-md-12">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="item active">
                                    <img class="slide-image" src="http://localhost/BaseProject/images/ancient-place.jpg" alt="">
                                </div>
                                <div class="item">
                                    <img class="slide-image" src="images/riverside-city.jpg" alt="">
                                </div>
                                <div class="item">
                                    <img class="slide-image" src="images/kayaks.jpg" alt="">
                                </div>
                            </div>
                            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- CHI TIẾT SÁCH -->
                <div>
                    <h3> THÔNG TIN CHI TIẾT PRODUCT</h3>
                    <div>
                        <div class="image_product" >
                            <img style="height: 400px;width: 400px;" src="<?= $product->images[0] ?>">
                        </div>
                        <div class="info_product">
                            <h4> Tên product: <span class="name_book"> <?= $product->name ?> </span> </h4>
                            <h4> Mô tả: <span class="author_name"> <?= $product->descriptrion ?> </span> </h4>
                            <h4> Giá bán: <span class="number_price"> <?= $product->price ?> </span> </h4>
                        </div>
                        <div>
                            <div class="cart_btn">
                                <a href="http://localhost/BaseProject/Views/page/Cart.php?action=add&idbook=<?= $product->id ?>" class="list-group-item">
                                    Đặt mua
                                </a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <!-- /.container -->
    <div class="container">
        <hr>
        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Java Advanced - 2019</p>
                </div>
            </div>
        </footer>
    </div>
    <!-- /.container -->
    <!-- jQuery -->
    <!-- <script src="/Scripts/jquery.js"></script> -->

    <!-- Bootstrap Core JavaScript -->
    <!-- <script src="/Scripts/bootstrap.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>