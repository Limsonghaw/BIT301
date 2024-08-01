<?php
session_start();
include "database.php";

$username = $_SESSION['username'];
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

    <div class="row align-items-center" style="padding-top: 10%;">
        <div class="col-3"></div>
        <div class="col-6 bg-white rounded" style="padding: 30px 30px 30px 30px;">
            <form method="POST" id="changePass" action="changePass.php">
                <div class="form-group">
                    <label for="oldPass">Old Password:</label>
                    <input type="password" class="form-control sizing" id="oldPass" name="oldPass"
                        placeholder="Enter Old Password" required>
                </div>
                <div class="form-group">
                    <label for="newPass">New Password:</label>
                    <input type="password" class="form-control sizing" id="newPass" name="newPass"
                        placeholder="Enter New Password" required>
                </div>
                <button type="submit" class="btn btn-primary" name="submit"
                    style="margin-left: 25%; width: 50%;border-radius: 4px;">Submit</button>
            </form>
        </div>
    </div>
</body>


<?php
if (isset($_POST['submit'])) {
    $newPass = $_POST['newPass'];
    $oldPass = $_POST['oldPass'];

    $sql = "SELECT * FROM userdb WHERE username = '$username'";

    if($newPass != $oldPass){

            $insertSql = "UPDATE userdb SET Password='$newPass' WHERE Password = '$oldPass' and Username = '$username'";
            $result = mysqli_query($conn, $insertSql);

            if($result){
                echo '<script>alert("Updated Successfully");window.location = "manageproduct.php";</script>';
            }else
            {
                echo '<script>alert("Fail to Update' . mysqli_error($con) . '");window.location = "changePass.php";</script>';
            }
    }else{
        echo '<script>alert("Your new password is the same with old password!");</script>';
    }
    mysqli_close($con);
}
?>