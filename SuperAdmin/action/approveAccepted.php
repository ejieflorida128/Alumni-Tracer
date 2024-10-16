<?php
    include("../../connection/conn.php");

    $id = $_GET['id'];

    $sql = "UPDATE e_schools SET confirm_status = 'Approved' WHERE id = $id";
    mysqli_query($conn,$sql);


    header("Location: ../pendingAdmin.php");
    
?>