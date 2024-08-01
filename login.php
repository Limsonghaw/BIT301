<?php
session_start();
include "database.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>PromoTourism</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

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

    <style>
    body {
      background-image: url('img/tourismBackground.jpg');
      background-repeat: no-repeat;
    }
    </style> 
</head>



<body>
    <div class="container-fluid position-relative nav-bar" style="padding-top: 1pc;padding-bottom: 15px;">
        <div class="container-lg position-relative p-0 px-lg-3" style="z-index: 9;">
            <nav class="navbar navbar-expand-lg bg-light navbar-light shadow-lg py-3 py-lg-0 pl-3 pl-lg-5">
                <a href="index.php" class="navbar-brand">
                    <h1 class="m-0 text-primary"><span class="text-dark">Promo</span>Tourism</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </nav>
        </div>
    </div>

    <div class="row align-items-center" style ="padding-top: 10%;">
        <div class="col-3"></div>
        <div class="col-6 bg-white rounded" style="padding: 30px 30px 30px 30px;">
            <form method="POST" id="loginForm" action="login.php">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control sizing" id="username" name="username" placeholder="Enter Username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control sizing" id="password" name="password" placeholder="Enter Password" required>
                </div>
                <div class="form-group" style="margin-left: 45%">
                    <a class="link" href="register.php">or Sign Up</a>
                </div>
                <button type="submit" class="btn btn-primary" name="login" style="margin-left: 25%; width: 50%;border-radius: 4px;">Login</button>
            </form>
    </div>


</body>


<?php
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST") {
    $Username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM userdb WHERE username = '$Username'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    if ($user != null) {
        if ($password == $user['Password']) {

            $_SESSION['username'] = $Username;
            $_SESSION['password'] = $user['Password'];
            $_SESSION['contactNum'] = $user['ContactNum'];
            $_SESSION['email'] = $user['Email'];
            $_SESSION['description'] = $user['CompDe'];
            $_SESSION['document'] = $user['Document'];
            $_SESSION['position'] = $user['Position'];
            $_SESSION['status'] = $user['Status'];

            if ($_SESSION['position'] == "Admin") {
                echo'<script>alert("Welcome back admin!")</script>';
                echo "<script>setTimeout(\"location.href = 'accountmanagement.php';\",1000);</script>";
                
            }  else if($_SESSION['position']=="Marchant"){
                
                if($_SESSION['status'] == "Pending"){
                    echo "<script>alert('Your Account have not been approved!')</script>";
                    echo "<script>setTimeout(\"location.href = 'login.php';\",500);</script>";
                }else if ($_SESSION['password'] == "123"){
                    echo"<script>alert('Welcome back $Username!')</script>";
                    echo"<script>alert('Please change your password!')</script>";
                    echo "<script>setTimeout(\"location.href = 'changePass.php';\",1000);</script>";
                }else{
                    echo"<script>alert('Welcome back $Username!')</script>";
                    echo "<script>setTimeout(\"location.href = 'manageproduct.php';\",1000);</script>";
                }
                

            } else {
                echo"<script>alert('Welcome back $Username!')</script>";
                echo "<script>setTimeout(\"location.href = 'productmenu.php';\",1000);</script>";
            }
        } else {
            echo "<script>alert('Wrong password for this Employee ID!')</script>";
            exit();
        }
    } else {
        echo "<script>alert('Username not found!')</script>";
    }
}
?>