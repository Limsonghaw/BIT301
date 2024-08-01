<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        include("database.php");
        if(isset($_FILES['update_product_pic']) && isset($_POST['update_product_name']) && isset($_POST['update_quantity']))
        {
            $id=$_POST['id'];
            $update_product_name = $_POST['update_product_name'];
            $update_description = $_POST['update_description'];
            $update_quantity = $_POST['update_quantity'];
            $new_image = $_FILES['update_product_pic'];
            $old_image = $_POST['old_product_pic'];

            if( $_FILES['update_product_pic']['error'] == '0' )
            {
                $update_filename = $_FILES['update_product_pic']['name'];
            }
            else
            {
                $update_filename = $old_image;
            }
    
            if(file_exists("upload_img/". $_FILES['update_product_pic']['name']))
            {
                $filename = $_FILES['update_product_pic']['name'];
                echo "Image already Exists ".$filename;
            }
            else
            {
                $sql = "UPDATE new_product 
                SET product_name = '$update_product_name', description = '$update_description', quantity = $update_quantity, product_pic = '$update_filename' 
                WHERE id = '$id'";
                $query_run= mysqli_query($conn, $sql);
                if($query_run)
                {
                    if( $_FILES['update_product_pic']['name'] != '')
                    {
                        move_uploaded_file($_FILES['update_product_pic']['tmp_name'], 'uploads_img/' . $_FILES['update_product_pic']['name']);
                        unlink("upload/".$old_image);
                    }
                    header("Location: manageproduct.php");
                }
                else
                {
                    header("Location: editmanage.php");
                }
            }
        }
        else{
            echo "Wrong";
        }
    }
?>