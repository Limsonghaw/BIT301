<?php
session_start();
include 'database.php';

$username = $_SESSION['username'];
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

    <!--Chart-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script	src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
		
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
                        <a href="manageproduct.php" class="nav-item nav-link ">Product</a>
                        <a href="viewAnalytics.php" class="nav-item nav-link active">Analytics</a>

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
            <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
                <h3 class="display-4 text-white text-uppercase">View Analytics</h3>
                <div class="d-inline-flex text-white">
                    <p class="m-0 text-uppercase"><a class="text-white" href="">Home</a></p>
                    <i class="fa fa-angle-double-right pt-1 px-3"></i>
                    <p class="m-0 text-uppercase">View Analytics</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <div class="container">
        <div class="row" style="padding-top:20px">
            <div class="col-md-4" style="max-width:160px">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="merchantSelectButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Select Merchant
                    </button>
                    <div class="dropdown-menu" aria-labelledby="merchantSelectButton">
                    <!-- Dynamic merchant names will be populated here -->
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <button id="fetchDataButton" class="btn btn-primary">Fetch Data</button>
            </div>
        </div>
    </div>

    
    <div class="contaianer">
        <div class="container-fluid">
            <div class="row" style="padding-left:3%; ">
                <div class="col-md-4">
					<div class="card mt-4 mb-4" style="min-width:600px">
						<div class="card-header">Product Sold</div>
						<div class="card-body">
							<div class="chart-container pie-chart">
								<canvas id="product_sold"></canvas>
							</div>
						</div>
					</div>
				</div>
                <div class="col-md-4" style="padding-left:20%">
					<div class="card mt-4 mb-4" style="min-width:600px">
						<div class="card-header">Customer Purchase Power</div>
						<div class="card-body">
							<div class="chart-container pie-chart">
								<canvas id="cus_pur_pow"></canvas>
							</div>
						</div>
					</div>
				</div>
                <div id="message">
            </div>
        </div>
    </div>

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

        <!-- DataTable -->
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
        <script src="js/datatable.js"></script>

</body>

</html>

<script>
    $(document).ready(function(){
        var selectedMerchant='';
        var graph1,graph2;
        populateMerchantDropdown();
        
        function populateMerchantDropdown() {
            $.ajax({
                url: "fetchMerchantNames.php",
                dataType: "json",
                success: function (data) {
                    var dropdownMenu = $('#merchantSelectButton').next('.dropdown-menu');
                    dropdownMenu.empty();

                    data.forEach(function (merchant) {
                        dropdownMenu.append('<a class="dropdown-item merchant-item" href="#" data-merchant="' + merchant + '">' + merchant + '</a>');
                    });

                // Update the selectedMerchant when a merchant is clicked
                    $('.merchant-item').on('click', function () {
                        selectedMerchant = $(this).data('merchant');
                        $('#merchantSelectButton').text( selectedMerchant);
                    });
                },
                error: function (error) {
                    console.log("Error fetching merchant names:");
                    console.log(error);
                }
            });
            }

            $('#fetchDataButton').click(function () {
                // Clear the previous chart data
                
            if (graph1) {
                graph1.destroy();
            }
            if (graph2) {
                graph2.destroy();
            }
                makechart(selectedMerchant); 
            });
            

        function makechart(selectedMerchant){
            $.ajax({
                url:"dataAdmin.php",
                method:"POST",
                data:{
                action:'fetch',
                selectedMerchant: selectedMerchant
                },
                dataType:"JSON",
                success:function(data)
                {
                    var product_name = [];
                    var total = [];
                    var price =[];
                    var color = [];

                    for(var count = 0;count<data.length;count++){
                        product_name.push(data[count].product_name);
                        total.push(data[count].total);
                        price.push(data[count].price);
                        color.push(data[count].color);
                    };

                    var chart_data = {
                        labels: product_name,
                        datasets:[
                            {
                                label:'Number Sold',
                                backgroundColor:color,
                                color:'#fff',
                                data:total
                            }
                        ]
                    };

                    var chart_data1={
                        labels: product_name,
                        datasets:[
                            {
                                label:'Total Income',
                                backgroundColor:color,
                                color:'#fff',
                                data:price
                            }
                        ]
                    };

                    var options = {
                        responsive:true,
                        scales:{
                            yAxes:[{
                                ticks:{
                                    min:0
                                }
                            }]
                        }
                    };

                    
                    var group_chart1 = $('#product_sold');
                    var group_chart2 = $('#cus_pur_pow');

                    graph1 = new Chart(group_chart1, {
                        type: "bar",
                        data: chart_data,
                        options: options,
                     });

                    graph2 = new Chart(group_chart2, {
                        type: "bar",
                        data: chart_data1,
                        options: options,
                    });
                },
                error: function(error){
                    var errorMessage = "Error retrieving data: "+error.responseText;
                    $("#message").html(errorMessage);
                }
            })
        }
    }
    );
</script>
