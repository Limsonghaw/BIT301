<?php
session_start();
include 'database.php';

$username = $_SESSION['username'];
$id = $_GET['id'];
$_SESSION['id']=$id;

$query1 = "SELECT * FROM new_product WHERE id='$id'";
$result1 = mysqli_query($conn, $query1)

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Manage Product</title>
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
                        <a href="index.php" class="nav-item nav-link ">Home</a>
                        <!--<a href="about.html" class="nav-item nav-link">About</a>-->
                        <!-- <a href="service.html" class="nav-item nav-link">Services</a> -->
                        <a href="ratinglist.php" class="nav-item nav-link active" >Review</a>
                        <a href="productmenu.php" class="nav-item nav-link">Product</a>
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
            <h3 class="display-4 text-white text-uppercase">Review</h3>
                <div class="d-inline-flex text-white">
                    <p class="m-0 text-uppercase"><a class="text-white" href="">Home</a></p>
                    <i class="fa fa-angle-double-right pt-1 px-3"></i>
                    <p class="m-0 text-uppercase">Rating</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <div class="jumbotron text-center">
    <?php 
                $rows = mysqli_fetch_assoc($result1);
    ?>
                <td><img class="w-25" src="uploads_img/<?=$rows['product_pic']?>"></td>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-4 text-center m-auto">
                <h1><span id="avg_rating">0.0</span>/5.0</h1>
                <div>
                    <i class="fa fa-star star-light main_star mr-1"></i>
                    <i class="fa fa-star star-light main_star mr-1"></i>
                    <i class="fa fa-star star-light main_star mr-1"></i>
                    <i class="fa fa-star star-light main_star mr-1"></i>
                    <i class="fa fa-star star-light main_star mr-1"></i>
                </div>
                <span id="total_review">0</span> Reviews
            </div>
            <div class="col-sm-4 progressSection">
               <div class='holder'>
                   <div>
                    <div class="progress-label-left">
                        <b>5</b> <i class="fa fa-star mr-1 text-warning"></i>
                    </div>
                    <div class="progress-label-right">
                        <span id="total_five_star_review"> 0 </span> Reviews
                    </div>

                   </div>
                
                    <div class="progress">
                        <div class="progress-bar bg-warning" id='five_star_progress'>

                        </div>
                    </div>
               </div>
               <div class='holder'>
                   <div>
                <div class="progress-label-left">
                    <b>4</b> <i class="fa fa-star mr-1 text-warning"></i>
                </div>
                <div class="progress-label-right">
                    <span id="total_four_star_review"> 0 </span> Reviews
                </div>
            </div>
                <div class="progress">
                    <div class="progress-bar bg-warning" id='four_star_progress'>

                    </div>
                </div>
               </div>
               <div class='holder'>
                   <div> 
                <div class="progress-label-left">
                    <b>3</b> <i class="fa fa-star mr-1 text-warning"></i>
                </div>
                <div class="progress-label-right">
                    <span id="total_three_star_review"> 0 </span> Reviews
                </div>
            </div>
                <div class="progress">
                    <div class="progress-bar bg-warning" id='three_star_progress'>

                    </div>
                </div>
               </div>
               <div class='holder'>
                   <div>
                <div class="progress-label-left">
                    <b>2</b> <i class="fa fa-star mr-1 text-warning"></i>
                </div>
                <div class="progress-label-right">
                    <span id="total_two_star_review"> 0 </span> Reviews
                </div>
            </div>
                <div class="progress">
                    <div class="progress-bar bg-warning" id='two_star_progress'>

                    </div>
                </div>
               </div>
               <div class='holder'>
                   <div>
                <div class="progress-label-left">
                    <b>1</b> <i class="fa fa-star mr-1 text-warning"></i>
                </div>
                <div class="progress-label-right">
                    <span id="total_one_star_review"> 0 </span> Reviews
                </div>
            </div>
                <div class="progress">
                    <div class="progress-bar bg-warning" id='one_star_progress'>

                    </div>
                </div>
               </div>
            </div>
            <div class="col-sm-4 text-center m-auto">
                <button class="btn-primary" id='add_review' > Add Review </button>
            </div>
        </div>

        <div id="display_review">

        </div>
    </div>



    
  <!-- The Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Write your Review</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body text-center">
        <h4>
            <i class="fa fa-star star-light submit_star  mr-1 " id='submit_star_1'  data-rating='1'></i>
            <i class="fa fa-star star-light submit_star  mr-1 " id='submit_star_2' data-rating='2'></i>
            <i class="fa fa-star star-light submit_star   mr-1 " id='submit_star_3' data-rating='3'></i>
            <i class="fa fa-star star-light submit_star  mr-1 " id='submit_star_4' data-rating='4'></i>
            <i class="fa fa-star star-light submit_star  mr-1 " id='submit_star_5' data-rating='5'></i>
        </h4>
        <div class="form-group">
            <input type="hidden" class="form-control" id='userName' name='userName' value='<?php echo $username?>' placeholder="Enter Name">
        </div>
        <div class="form-group">
        <textarea name="userMessage" id="userMessage" class="form-control" placeholder="Enter message"></textarea>
        </div>
        <div class="form-group">
            <button class="btn-primary" id='sendReview'>Submit</button>
        </div>
        </div>
         
      </div>
    </div>
  </div>


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white border-top py-4 px-sm-3 px-md-5" style="border-color: rgba(256, 256, 256, .1) !important;">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
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
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="js/datatable.js"></script>
    <script src="js/rating.js"></script>


</body>

</html>