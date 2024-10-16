<?php 
// To display errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
include("../connection/conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user input
    $name = htmlspecialchars(trim($_POST["full-name"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $role = htmlspecialchars(trim($_POST["role"]));
    $school = htmlspecialchars(trim($_POST["school"]));
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm-password"];

    // Check if the email already exists using prepared statements
    $checkEmail = "SELECT * FROM `R_accounts` WHERE `email` = ?";
    $stmt = mysqli_prepare($connection, $checkEmail);
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        // Email already exists
        echo "<script>alert('Email already exists. Please use a different email.');</script>";
    } else {
        if ($password === $confirmPassword) {
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            $register = "INSERT INTO `R_accounts`(`name`, `email`, `school_role`, `school`, `password`, `date_registered`) 
                         VALUES (?, ?, ?, ?, ?, NOW())";
            $stmt = mysqli_prepare($connection, $register);

            mysqli_stmt_bind_param($stmt, 'sssss', $name, $email, $role, $school, $hashedPassword);
            
            if (mysqli_stmt_execute($stmt)) {
                header("Location: register.php");
                exit();
            } else {
                echo "Error: " . mysqli_error($connection);
            }
        } else {
            echo "<script>alert('Passwords do not match');</script>";
        }
    }

    // Close prepared statement
    mysqli_stmt_close($stmt);
}

// Close database connection
mysqli_close($connection);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DASHMIN - Bootstrap Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../template/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../template/css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sign Up Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="index.html" class="">
                                <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>DASHMIN</h3>
                            </a>
                            <h3>Sign Up</h3>
                        </div>
                        <form action="" method="post">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="full-name" name="full-name" placeholder="Jhon Doe">
                            <label for="full-name">Full Name</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
                            <label for="eamil">Email address</label>
                        </div>

                        <div class="form-floating mb-3">
                            <select class="form-select" id="role" name="role" aria-label="User Role">
                                <option selected>Select Role</option>
                                <option value="Principal">Principal</option>
                                <option value="Teacher">Teacher</option>
                                <option value="Department Head">Department Head</option>
                            </select>
                            <label for="role">School Role</label>
                        </div>

                        <div class="form-floating mb-3">
                            <select class="form-select" id="school" name="school" aria-label="User Role">
                                <option selected>Select Role</option>
                                <option value="Sogod National Highschool">Sogod National Highschool</option>
                                <option value="Sogod Elementary School">Sogod Elementary School</option>
                                <option value="Southern Leyte State University - TO Campus">Southern Leyte State University - TO Campus</option>
                            </select>
                            <label for="school">School</label>
                        </div>

                        <div class="form-floating mb-4">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            <label for="password">Password</label>
                        </div>

                        <div class="form-floating mb-4">
                            <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Password">
                            <label for="confirm-password">Confirm Password</label>
                        </div>

                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Check me out</label>
                            </div>
                            <a href="">Forgot Password</a>
                        </div>
                        <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Sign Up</button>
                        <p class="text-center mb-0">Already have an Account? <a href="">Sign In</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign Up End -->
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../template/lib/chart/chart.min.js"></script>
    <script src="../template/lib/easing/easing.min.js"></script>
    <script src="../template/lib/waypoints/waypoints.min.js"></script>
    <script src="../template/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../template/lib/tempusdominus/js/moment.min.js"></script>
    <script src="../template/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="../template/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="../template/js/main.js"></script>
</body>

</html>
