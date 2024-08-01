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
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

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

    <div class="row align-items-center" style="padding-top: 2%;padding-bottom: 2%;">
        <div class="col-3"></div>
        <div class="col-6 bg-white rounded" style="padding: 30px 30px 30px 30px;">
            <form method="POST" id="registerForm" action="register.php" enctype="multipart/form-data">
                <H1>Register Account</H1>
                <div style="padding-top: 30px;"></div>
                <div class="form-group form-inline">
                    <label for="position" class="col-lg-2 text-right" style="justify-content: flex-end;">User
                        Type:</label>
                    <input type="Radio" id="S1" name="position" value="User" checked>
                    <label for="S1" class="pl-2" style="padding-right:20px">User</label>
                    <input type="Radio" id="S2" name="position" value="Marchant">
                    <label for="S2" class="pl-2">Marchant</label>
                </div>
                <div class="form-group form-inline">
                    <label for="username" class="col-lg-2 text-right"
                        style="justify-content: flex-end;">Username:</label>
                    <input type="text" class="form-control sizing col-lg-10" id="username" name="username"
                        placeholder="Enter username" required>
                </div>
                <div class="form-group form-inline">
                    <label for="password" class="col-lg-2 text-right"
                        style="justify-content: flex-end;">Password:</label>
                    <input type="text" class="form-control sizing col-lg-10" id="password" name="password"
                        placeholder="Enter password" required>
                </div>
                <div class="form-group form-inline">
                    <label for="contactNum" class="col-lg-2 text-right" style="justify-content: flex-end;">Contact
                        Number:</label>
                    <input type="text" class="form-control sizing col-lg-10" id="contactNum" name="contactNum"
                        placeholder="Enter contact number" required>
                </div>
                <div class="form-group form-inline">
                    <label for="email" class="col-lg-2 text-right" style="justify-content: flex-end;">Email:</label>
                    <input type="text" class="form-control sizing col-lg-10" id="email" name="email"
                        placeholder="Enter email" required>
                </div>
                <div class="form-group form-inline">
                    <label for="description" class="col-lg-2 text-right" style="justify-content: flex-end;">Company
                        Description:</label>
                    <textarea rows="5" cols="40" type="text" class="form-control sizing col-lg-10" id="description"
                        name="description" required></textarea>
                </div>
                <div class="form-group form-inline">
                    <label for="document" class="col-lg-2 text-right"
                        style="justify-content: flex-end;">Document:</label>
                    <input type="file" class="form-control sizing col-lg-10" id="document" name="document" required>
                </div>

                <container class="form-inline">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-10" style="padding-left: 0px;">
                        <button type="submit" class="btn btn-primary" name="register">Register Employee</button>
                    </div>
                </container>
            </form>
        </div>
    </div>
</body>

</html>


<?php
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST") {
  $Username= $_POST['username'];
  $Password = $_POST['password'];
  $ContactNum = $_POST['contactNum'];
  $Email = $_POST['email'];
  $CompDe = $_POST['description'];
  $Status = "Pending";
  $Position = $_POST['position'];

  
  $img_name = $_FILES['document']['name'];
  $img_size = $_FILES['document']['size'];
  $tmp_name = $_FILES['document']['tmp_name'];
  $error = $_FILES['document']['error'];


  $checkEmpIDSql = "SELECT * FROM userdb WHERE Username = '$Username'";
  $checkEmailSql = "SELECT * FROM userdb WHERE Email = '$Email'";

  if ($error === 0) {
    if ($img_size > 125000) {
        $em = "Sorry, your file is too large.";
    
    } else {
        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);
        $allowed_exs = array("jpg", "jpeg", "png");

        if (in_array($img_ex_lc, $allowed_exs)) {
          $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
          $img_upload_path = 'verification_form/' . $new_img_name;

          move_uploaded_file($tmp_name, $img_upload_path);
   
        } else {
          $em = "You can't upload files of this type";
  
        }
    }
  } else {
      $em = "unknown error occurred!";
      header("Location: register.php?error=$em");
  }

  if ($conn->query($checkEmpIDSql)->num_rows > 0) {
    echo "<script>alert('Employee already exists!')</script>";
    return;
  } else if ($conn->query($checkEmailSql)->num_rows > 0) {
    echo "<script>alert('Email already exists!')</script>";
    return;
  } else if ($_SESSION['position'] == "Marchant"){
    $Password = "123";
    $insertSql = "INSERT INTO userdb (`UserID`, `Username`, `Password`, `ContactNum`, `Email`, `CompDe`, `Document`,`Status`,`Position`)
        VALUES ('','$Username', '$Password','$ContactNum', '$Email', '$CompDe', '$new_img_name','$Status','$Position')";
    echo "<script>alert('Password set to 123!')</script>";
    }else {
      $insertSql = "INSERT INTO userdb (`UserID`, `Username`, `Password`, `ContactNum`, `Email`, `CompDe`, `Document`,`Status`,`Position`)
        VALUES ('','$Username', '$Password','$ContactNum', '$Email', '$CompDe', '$new_img_name','$Status','$Position')";
    }

    if ($conn->query($insertSql) == true) {
      echo "<script>alert('User successfully registered!')</script>";
      echo "<script>setTimeout(\"location.href = 'login.php';\",1000);</script>";
    } else {
      echo "<script>alert('Error registering user: " . $conn->error . "')</script>";
    }
}
?>