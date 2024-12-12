<?php

session_start();
include('../connection/conn.php');


$gmail = $_GET['gmail'];
$insertGmail = "INSERT INTO l_study_response (gmail) VALUES ('$gmail')";
mysqli_query($conn,$insertGmail);

header("Location: ../index.php");


?>