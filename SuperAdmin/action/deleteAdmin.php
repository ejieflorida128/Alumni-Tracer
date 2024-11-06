<?php
    include("../../connection/conn.php");

    $id = $_GET['id'];

    $sql = "DELETE FROM r_accounts WHERE id = $id";
    mysqli_query($conn,$sql);


    header("Location: ../approveAdmins.php");
    
?>