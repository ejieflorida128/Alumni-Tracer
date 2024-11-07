<?php
    include("../../connection/conn.php");

    $id = $_GET['id'];

    $sql = "UPDATE r_accounts SET status = 'Approved' WHERE id = $id";
    mysqli_query($conn,$sql);


    header("Location: ../approveAdmins.php");
    
?>