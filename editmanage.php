<?php

    session_start();
    if(!isset($_GET['id'])){
        //redirect to show page
        die('id not provied');
    }
    include('database.php');
    $id = $_GET['id'];
    $sql = "SELECT * FROM new_product WHERE id=$id";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result) >0){

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="utf-8">
        <title>Add New Product</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="Free HTML Templates" name="keywords">
        <meta content="Free HTML Templates" name="description">

        <!-- Favicon -->
        <link href="img/favicon.ico" rel="icon">


        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
            rel="stylesheet">

        <!-- Font Awesome -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
        <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

        <!-- Customized Bootstrap Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
        <style>
        .btn-secondary {
            color: #fff !important;
            background-color: #6c757d !important;
            border-color: #6c757d !important;
        }
        </style>
    </head>

<body>
    <!-- Navbar Start -->
    <div class="container-fluid position-relative nav-bar" style="padding-top: 1pc;padding-bottom: 15px;">
        <div class="container-lg position-relative p-0 px-lg-3" style="z-index: 9;">
            <nav class="navbar navbar-expand-lg bg-light navbar-light shadow-lg py-3 py-lg-0 pl-3 pl-lg-5">
                <a href="" class="navbar-brand">
                    <h1 class="m-0 text-primary"><span class="text-dark">Promo</span>Tourism</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between px-3" id="navbarCollapse">
                    <div class="navbar-nav ml-auto py-0">
                        <a href="index.php" class="nav-item nav-link active">Home</a>
                        <!--<a href="about.html" class="nav-item nav-link">About</a>-->
                        <a href="service.html" class="nav-item nav-link">Services</a>
                        <a href="package.html" class="nav-item nav-link">Tour Packages</a>
                        <!--
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu border-0 rounded-0 m-0">
                                <a href="blog.html" class="dropdown-item">Blog Grid</a>
                                <a href="single.html" class="dropdown-item">Blog Detail</a>
                                <a href="destination.html" class="dropdown-item">Destination</a>
                                <a href="guide.html" class="dropdown-item">Travel Guides</a>
                                <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                            </div>
                        </div>
                    -->
                        <?php
                            $Username = $_SESSION['username'];

                            if($Username == null){
                                echo ("<a href='login.php' class='nav-item nav-link'>Login/Sign Up</a>"); 
                            }
                            else{
                                echo ("<a href='logout.php' class='nav-item nav-link'><i class='fa-solid fa-user'></i>".$_SESSION['username']."</a>");
                            }
                        ?>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->

    <!-- Header Start -->
    <div class="container-fluid page-header">
        <div class="container">
            <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 400px">
                <h3 class="display-4 text-white text-uppercase">Manage Product</h3>
                <div class="d-inline-flex text-white">
                    <p class="m-0 text-uppercase"><a class="text-white" href="">Home</a></p>
                    <i class="fa fa-angle-double-right pt-1 px-3"></i>
                    <p class="m-0 text-uppercase">Product</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- form -->
    <div class="container">
        <?php

    while($row=mysqli_fetch_assoc($result)){
        $id=$row['id'];
        $product_name=$row['product_name'];
        $description=$row['description'];
        $quantity=$row['quantity'];
        $product_pic=$row['product_pic'];
        ?>
        <form action="editproduct.php" method="post" enctype="multipart/form-data">
            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label for="product_name" class="col-form-label">Product Name:</label>
                <input type="text" class="form-control" id="update_product_name" name="update_product_name"
                    value="<?php echo $product_name; ?>" required>
            </div>
            <div class="form-group">
                <label for="description" class="col-form-label">Description:</label>
                <textarea class="form-control" id="update_description"
                    name="update_description"><?php echo $description; ?></textarea>
            </div>
            <div class="form-group">
                <label for="quantity" class="col-form-label">Quantity:</label>
                <input class="form-control" type="number" id="update_quantity" name="update_quantity"
                    value="<?php echo $quantity; ?>" required>
            </div>
            <div class="form-group">
<<<<<<< Updated upstream
                <label for="quantity" class="col-form-label">Price:</label>
                <input class="form-control" type="number" id="update_price" name="update_price"
                    value="<?php echo $price; ?>" required>
            </div>
            <div class="form-group">
=======
>>>>>>> Stashed changes
                <label for="product_pic" class="col-form-label">Product Image:</label>
                <input type="file" class="form-control" id="update_product_pic" name="update_product_pic">
                <input type="hidden" class="form-control" id="old_product_pic" name="old_product_pic"
                    value="<?php echo $product_pic; ?>">
            </div>
            <img src="<?php echo "uploads_img/".$product_pic;?> " class="img-thumbnail w-25" alt="">
            <div class="offset-10">
                <button type="button" class="btn btn-secondary mb-3" onclick="history.go(-1);">Back</button>
                <input class="btn btn-success mb-3" type="submit" value="Update">
            </div>
        </form>
    </div>

    <?php
            }
        }

            ?>
    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white border-top py-4 px-sm-3 px-md-5"
        style="border-color: rgba(256, 256, 256, .1) !important;">
        <div class="row">
            <div class="col-lg-12 text-center text-md-left mb-3 mb-md-0">
                <p class="m-0 text-white-50">Copyright &copy; <a href="#">PromoTourism</a>. All Rights Reserved.</a>
                </p>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>


    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>