<?php
    include("../../connection/conn.php");

    $id = $_GET['id'];

    $sql = "DELETE FROM e_schools WHERE id = $id";
    mysqli_query($conn,$sql);


    header("Location: ../superAdmin.php");
    
?>