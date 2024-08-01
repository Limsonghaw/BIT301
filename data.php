<?php

    $connect = new PDO("mysql:host=localhost;dbname=bit301","root","");

    if(isset($_POST["action"])){
        if($_POST["action"]=='fetch'){
            $currentUser = $_POST["currentUser"];
            $query = "
            SELECT new_product.product_name,purchasedb.TotalPrice, SUM(purchasedb.Quantity) AS Total 
            FROM purchasedb
            INNER JOIN new_product ON purchasedb.id = new_product.id
            WHERE new_product.username = :currentUser
            GROUP BY new_product.product_name
            ";

            $stmt = $connect->prepare($query);
            $stmt->bindParam(':currentUser',$currentUser);
            $stmt->execute();

            //$result = $connect->query($query);

            $data = array();

            foreach($stmt as $row){
                $data[] = array(
                    'product_name'=>$row["product_name"],
                    'total'=>$row["Total"],
                    'price'=>$row["TotalPrice"],
                    'color'=>'#'.rand(100000,999999).''
                );
            }

            echo json_encode($data);
        }
    }
?>