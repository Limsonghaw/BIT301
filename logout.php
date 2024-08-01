<?php
session_start();
include "database.php";

$_SESSION['username']='';

echo "<script>setTimeout(\"location.href = 'index.php';\",50);</script>";

?>