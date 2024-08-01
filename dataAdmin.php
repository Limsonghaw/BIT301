<?php
    $connect = new PDO("mysql:host=localhost;dbname=bit301","root","");

    if(isset($_POST["action"])){
        if($_POST["action"]=='fetch'){
            $selectedMerchant = isset($_POST['selectedMerchant']) ? $_POST['selectedMerchant'] : '';
            $condition = '';

            if(!empty($selectedMerchant)){
                $condition = "WHERE new_product.username = :selectedMerchant";
            }

            $query = "
            SELECT new_product.product_name,SUM(purchasedb.TotalPrice) AS TotalPrice, SUM(purchasedb.Quantity) AS Total 
            FROM purchasedb
            INNER JOIN new_product ON purchasedb.id = new_product.id
            $condition
            GROUP BY new_product.product_name
            ";

            $stmt = $connect->prepare($query);
            if(!empty($selectedMerchant)){
                $stmt->bindParam(':selectedMerchant', $selectedMerchant, PDO::PARAM_STR);
            }
            
            
            if ($stmt->execute()) {
                $data = array();
    
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $data[] = array(
                        'product_name' => $row["product_name"],
                        'total' => $row["Total"],
                        'price' => $row["TotalPrice"],
                        'color' => '#' . rand(100000, 999999) . ''
                    );
                }
    
                echo json_encode($data);
            } else {
                // Handle the error here
                echo json_encode(array('error' => 'Unable to execute the query'));
            }
        }
    }
?>