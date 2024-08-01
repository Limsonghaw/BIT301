<?php
    session_start();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        include("database.php");
        if(isset($_POST['product_name']) && isset($_POST['quantity'])){

            $username = $_SESSION['username'];
            $product_name = $_POST['product_name'];
            $description = $_POST['description'];
            $quantity = $_POST['quantity'];
            $img_name = $_FILES['product_pic']['name'];
            $img_size = $_FILES['product_pic']['size'];
            $tmp_name = $_FILES['product_pic']['tmp_name'];
            $error = $_FILES['product_pic']['error'];
    

            if ($error === 0) {
                if ($img_size > 125000) {
                    $em = "Sorry, your file is too large.";
                    header("Location: addnewproduct.php?error=$em");
                } else {
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_lc = strtolower($img_ex);
    
                    $allowed_exs = array("jpg", "jpeg", "png");
 
                    if (in_array($img_ex_lc, $allowed_exs)) {
                        $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                        $img_upload_path = 'uploads_img/' . $new_img_name;
                        move_uploaded_file($tmp_name, $img_upload_path);
    
                        $sql = "INSERT INTO new_product (product_name, description, quantity, product_pic,username) VALUES ('$product_name', '$description', $quantity, '$new_img_name','$username')";
                        mysqli_query($conn, $sql);

                        header("Location: manageproduct.php");
                    } else {
                        $em = "You can't upload files of this type";
                        header("Location: addnewproduct.php?error=$em");
                    }
                }
            } else {
                $em = "unknown error occurred!";
                header("Location: addnewproduct.php?error=$em");
            }
    
        } else {
            header("Location: addnewproduct.php");
        }
    }else{
    
    }

    ?>