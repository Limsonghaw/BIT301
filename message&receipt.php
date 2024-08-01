<?php
session_start();
include 'database.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {
		
    $payment_method = $_POST["payment"];


} else {
    echo "Data has not been submitted";
}
$id = $_SESSION['id'];
$user_name = $_SESSION['user_name'];
$contact_num = $_SESSION['contact_num'];
$email = $_SESSION['email'];
$date = $_SESSION['date'];
$Quantity = $_SESSION['Quantity'];
$total_price = $_SESSION['total_price'];
$quantity = $_SESSION['quantity'];

$stock_quantity_deducted = $quantity-$Quantity;

$quantity = $stock_quantity_deducted;

    //unique ID auto increment
$query = "INSERT INTO purchasedb (CustomerName, ContactNum, Email, id, Quantity, TotalPrice, Date, PaymentMethod, Rating) VALUES ('$user_name', '$contact_num', '$email', '$id', '$Quantity', '$total_price', '$date', '$payment_method', NULL)";

$result = mysqli_query($conn, $query);

if ($result) {
    echo "Data inserted successfully";
    $lastPurchaseID = mysqli_insert_id($conn);
} else {
    echo "Error inserting data: " . mysqli_error($conn);
}

$query1 = "SELECT product_name, price From new_product WHERE id = $id";

$result1 = mysqli_query($conn, $query1);

if ($result1) {
    echo "Data selected successfully";
} else {
    echo "Error selecting data: " . mysqli_error($conn);
}

$query2 = "UPDATE new_product SET quantity = $stock_quantity_deducted WHERE id = $id;";

$result2 = mysqli_query($conn, $query2);

if ($result2) {
    echo "Data inserted successfully";
} else {
    echo "Error inserting data: " . mysqli_error($conn);
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Product Menu</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">


    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <!-- DataTable -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    
    <!-- Jave to download image -->
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

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
                        <!--<a href="service.html" class="nav-item nav-link">Services</a>-->
                        <!--<a href="package.html" class="nav-item nav-link">Tour Packages</a>-->
                        <a href="viewAnalyticsAdmin.php" class="nav-item nav-link">Analytics</a>
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
                <h3 class="display-4 text-white text-uppercase">Tourism Product</h3>
                <div class="d-inline-flex text-white">
                    <p class="m-0 text-uppercase"><a class="text-white" href="">Home</a></p>
                    <i class="fa fa-angle-double-right pt-1 px-3"></i>
                    <p class="m-0 text-uppercase">Product Menu</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->



    <!-- Packages Start -->
    <div class="container-fluid py-5">
    <div class="container pb-3">
        <div class="text-center mb-3 pb-3">
            <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Product Menu</h6>
            <h1>Booked Successfully!</h1>
        </div>

        <table class="table table-hover" id='myTable'>
            <thead>
                <tr>
                    <th colspan="4"><h5 class="m-0 text-primary"><span class="text-dark">Promo</span>Tourism</h5></th>
                    <th>Purchase ID: <?php echo $lastPurchaseID ?></th>
                </tr>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Date</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 0;
                while ($rows = mysqli_fetch_assoc($result1)) {
                    $count++;
                    ?>
                    <tr>
                        <td><?php echo $rows['product_name']; ?></td>
                        <td><?php echo $Quantity; ?></td>
                        <td><?php echo "RM", $rows['price']; ?></td>
                        <td><?php echo $date; ?></td>
                        <td><?php echo "RM", $total_price; ?></td>
                    </tr>
                    <tr>
                      <td>*Non-Refund</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td style="text-align: left;">Payment Amount: <?php echo "RM", $total_price ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <!-- Button to trigger the download -->
        <div class="text-right">
            <button style="color: blue;" onclick="downloadTableImage()">Download Receipt</button>

    </div>
    <div class="text-center">

    <br>

    <a class="delete btn btn-primary" href="index.php">Go Back to Home</a>
    <a class="delete btn btn-success" href="productmenu.php">Go Back to Product Menu</a>
</div>
</div>

</div>



<script>
    function downloadTableImage() {
        // Use html2canvas to capture the table as an image
        html2canvas(document.getElementById('myTable')).then(function(canvas) {
            // Create an "a" element to trigger the download
            var link = document.createElement('a');
            link.href = canvas.toDataURL();
            link.download = 'receipt_image.png';
            link.click();
        });
    }
</script>

    <!-- Packages End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white-50 py-5 px-sm-3 px-lg-5" style="margin-top: 90px;">
        <div class="row pt-5">
            <div class="col-lg-3 col-md-6 mb-5">
                <a href="" class="navbar-brand">
                    <h1 class="text-primary"><span class="text-white">Promo</span>Tourism</h1>
                </a>
                <p>Sed ipsum clita tempor ipsum ipsum amet sit ipsum lorem amet labore rebum lorem ipsum dolor. No sed vero lorem dolor dolor</p>
                <h6 class="text-white text-uppercase mt-4 mb-3" style="letter-spacing: 5px;">Follow Us</h6>
                <div class="d-flex justify-content-start">
                    <a class="btn btn-outline-primary btn-square mr-2" href="#"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-outline-primary btn-square mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-outline-primary btn-square mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-outline-primary btn-square" href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h5 class="text-white text-uppercase mb-4" style="letter-spacing: 5px;">Our Services</h5>
                <div class="d-flex flex-column justify-content-start">
                    <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>About</a>
                    <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Destination</a>
                    <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Services</a>
                    <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Packages</a>
                    <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Guides</a>
                    <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Testimonial</a>
                    <a class="text-white-50" href="#"><i class="fa fa-angle-right mr-2"></i>Blog</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h5 class="text-white text-uppercase mb-4" style="letter-spacing: 5px;">Usefull Links</h5>
                <div class="d-flex flex-column justify-content-start">
                    <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>About</a>
                    <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Destination</a>
                    <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Services</a>
                    <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Packages</a>
                    <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Guides</a>
                    <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Testimonial</a>
                    <a class="text-white-50" href="#"><i class="fa fa-angle-right mr-2"></i>Blog</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h5 class="text-white text-uppercase mb-4" style="letter-spacing: 5px;">Contact Us</h5>
                <p><i class="fa fa-map-marker-alt mr-2"></i>123 Street, New York, USA</p>
                <p><i class="fa fa-phone-alt mr-2"></i>+012 345 67890</p>
                <p><i class="fa fa-envelope mr-2"></i>info@example.com</p>
                <h6 class="text-white text-uppercase mt-4 mb-3" style="letter-spacing: 5px;">Newsletter</h6>
                <div class="w-100">
                    <div class="input-group">
                        <input type="text" class="form-control border-light" style="padding: 25px;" placeholder="Your Email">
                        <div class="input-group-append">
                            <button class="btn btn-primary px-3">Sign Up</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark text-white border-top py-4 px-sm-3 px-md-5" style="border-color: rgba(256, 256, 256, .1) !important;">
        <div class="row">
            <div class="col-lg-6 text-center text-md-left mb-3 mb-md-0">
                <p class="m-0 text-white-50">Copyright &copy; <a href="#">Domain</a>. All Rights Reserved.</a>
                </p>
            </div>
            <div class="col-lg-6 text-center text-md-right">
                <p class="m-0 text-white-50">Designed by <a href="https://htmlcodex.com">HTML Codex</a>
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

    <!-- DataTable -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="js/datatable.js"></script>

</body>

</html>