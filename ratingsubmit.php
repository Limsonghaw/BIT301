

<?php
session_start();
$server = "localhost";
$username = "root";
$password = "";
$dbname = "bit301";

$conn = mysqli_connect($server, $username, $password, $dbname);

if(isset($_POST['rating_value'])){

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

    $rating_value = $_POST['rating_value'];
    $userName = $_POST['userName'];
    $userMessage = $_POST['userMessage'];
    $product_id=$_SESSION['id'];
    $now = time();
    



$sql = "INSERT INTO rating (name, rating, message, datetime, id)
VALUES ('$userName', '$rating_value', '$userMessage', '$now','$product_id')";

mysqli_query($conn, $sql);


$sql1 = "UPDATE purchasedb SET Rating = '$rating_value' WHERE id = '$product_id' and Rating is NULL and CustomerName='$userName'";
mysqli_query($conn, $sql1);
// echo "<script>setTimeout(\"location.href = 'productmenu.php';\",1000);</script>";

mysqli_close($conn);

}



if(isset($_POST['action'])){
  $avgRatings = 0;
  $avgUserRatings = 0;
  $totalReviews = 0;
  $totalRatings5 = 0;
  $totalRatings4 = 0;
  $totalRatings3 = 0;
  $totalRatings2 = 0;
  $totalRatings1 = 0;
  $ratingsList = array();
  $totalRatings_avg = 0;

  date_default_timezone_set('Asia/Kuala_Lumpur');
  
  $sql = "SELECT * FROM rating ORDER BY review_id DESC";
  $result = mysqli_query($conn, $sql);
 
  while($row = mysqli_fetch_assoc($result)) {
    $ratingsList[] = array(
      'review_id' => $row['review_id'],
      'name' => $row['name'],
      'rating' => $row['rating'],
      'message' => $row['message'],
      'datetime' => date('l jS \of F Y h:i:s A',$row['datetime']) 
    );
    if($row['rating'] == '5'){
      $totalRatings5++;
    }
    if($row['rating'] == '4'){
      $totalRatings4++;
    }
    if($row['rating'] == '3'){
      $totalRatings3++;
    }
    if($row['rating'] == '2'){
      $totalRatings2++;
    }
    if($row['rating'] == '1'){
      $totalRatings1++;
    }
    $totalReviews++;
    $totalRatings_avg = $totalRatings_avg + intval($row['rating']);  
  }
  $avgUserRatings = $totalRatings_avg / $totalReviews;

  $output = array( 
    'avgUserRatings' => number_format($avgUserRatings, 1),
    'totalReviews' => $totalReviews,
    'totalRatings5' => $totalRatings5,
    'totalRatings4' => $totalRatings4,
    'totalRatings3' => $totalRatings3,
    'totalRatings2' => $totalRatings2,
    'totalRatings1' => $totalRatings1,
    'ratingsList' => $ratingsList
  );

  echo json_encode($output);
 





}



?>
