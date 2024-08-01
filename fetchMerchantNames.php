<?php
include 'database.php';
// Assuming you have a database connection established in database.php

// Perform a query to fetch merchant names
$query = "SELECT Username FROM userdb WHERE Position = 'Marchant'";
$result = mysqli_query($conn, $query);

if ($result) {
    $merchantNames = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $merchantNames[] = $row['Username'];
    }

    echo json_encode($merchantNames);
} else {
    echo json_encode(array('error' => 'Failed to fetch merchant names'));
}

// Close the database connection
mysqli_close($conn);
?>

