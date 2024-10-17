<?php 
// Database connection
include("../connection/conn.php");

// Initialize variables
$emailExisted = false;
$passwordNotMatchModal = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user input 
    $name = htmlspecialchars(trim($_POST["full-name"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $role = htmlspecialchars(trim($_POST["role"]));
    $school = htmlspecialchars(trim($_POST["school"]));
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm-password"];

    // Check if the email already exists using prepared statements
    $checkEmail = "SELECT * FROM `r_accounts` WHERE `email` = ?";
    $stmt = mysqli_prepare($conn, $checkEmail);
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        // Email already exists
        $emailExisted = true;
    } else {
        if ($password === $confirmPassword) {
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            $register = "INSERT INTO `r_accounts`(`name`, `email`, `school_role`, `school`, `password`, `date_registered`) 
                         VALUES (?, ?, ?, ?, ?, NOW())";
            $stmt = mysqli_prepare($conn, $register);
            mysqli_stmt_bind_param($stmt, 'sssss', $name, $email, $role, $school, $hashedPassword);
            
            if (mysqli_stmt_execute($stmt)) {
                // Optionally show a success modal
                // header("Location: success.php"); // Redirect to a success page or display a modal
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            $passwordNotMatchModal = true;
        }
    }

    // Close prepared statement
    mysqli_stmt_close($stmt);
}

// Fetch schools from the database
$schoolsQuery = "SELECT * FROM e_schools WHERE confirm_status = 'Approved'";
$schoolsResult = mysqli_query($conn, $schoolsQuery);

// Close database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>DASHMIN - Bootstrap Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="img/favicon.ico" rel="icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <link href="../template/css/bootstrap.min.css" rel="stylesheet">
    <link href="../template/css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>    
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3" style="display: flex; justify-content: center;">
                            <h3 style="color: #2aaaeb; font-weight: bolder;">Sign Up</h3>
                        </div>
                        <form action="" method="post">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="full-name" name="full-name" placeholder="John Doe" required>
                                <label for="full-name">Full Name</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
                                <label for="email">Email address</label>
                            </div>

                            <div class="form-floating mb-3">
                                <select class="form-select" id="role" name="role" aria-label="User Role" required>
                                    <option selected disabled>Select Role</option>
                                    <option value="Principal">Principal</option>
                                    <option value="Teacher">Teacher</option>
                                    <option value="Department Head">Department Head</option>
                                </select>
                                <label for="role">School Role</label>
                            </div>

                            <div class="form-floating mb-3">
                                <select class="form-select" id="school" name="school" aria-label="School" required>
                                    <option selected disabled hidden>Select School</option>
                                    <?php 
                                    if ($schoolsResult) {
                                        while ($schoolRow = mysqli_fetch_assoc($schoolsResult)) {
                                            echo '<option value="' . htmlspecialchars($schoolRow['school_name']) . '">' . htmlspecialchars($schoolRow['school_name']) . '</option>';
                                        }
                                    } else {
                                        echo '<option disabled>No schools available</option>';
                                    }
                                    ?>
                                </select>
                                <label for="school">School</label>
                            </div>

                            <div class="form-floating mb-4">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                <label for="password">Password</label>
                            </div>

                            <div class="form-floating mb-4">
                                <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Confirm Password" required>
                                <label for="confirm-password">Confirm Password</label>
                            </div>

                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" onclick="togglePasswordVisibility()">
                                    <label class="form-check-label" for="exampleCheck1" style="font-size: 15px;">Show Password</label>
                                </div>
                                <a href="" style="font-size: 15px;">Forgot Password</a>
                            </div>

                            <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Sign Up</button>
                            <p class="text-center mb-0">Already have an Account? <a href="../php_files/login.php">Sign In</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php if ($emailExisted): ?>
        <!-- Email Exists Modal -->
        <div class="modal fade" id="emailExistsModal" tabindex="-1" role="dialog" aria-labelledby="emailExistsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="emailExistsModalLabel">Email Already Exists</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Email already exists. Please use a different email.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php if ($passwordNotMatchModal): ?>
        <!-- Password not match Modal -->
        <div class="modal fade" id="passwordNotMatch" tabindex="-1" role="dialog" aria-labelledby="passwordNotMatchModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="passwordNotMatchModalLabel">Password Mismatch</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Passwords do not match. Please try again.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <script>
        // Toggle password visibility
        function togglePasswordVisibility() {
            const password = document.getElementById("password");
            const confirmPassword = document.getElementById("confirm-password");
            if (password.type === "password") {
                password.type = "text";
                confirmPassword.type = "text";
            } else {
                password.type = "password";
                confirmPassword.type = "password";
            }
        }

        // Show modals if applicable
        window.onload = function() {
            <?php if ($emailExisted): ?>
                var emailModal = new bootstrap.Modal(document.getElementById('emailExistsModal'));
                emailModal.show();
            <?php endif; ?>

            <?php if ($passwordNotMatchModal): ?>
                var passwordModal = new bootstrap.Modal(document.getElementById('passwordNotMatch'));
                passwordModal.show();
            <?php endif; ?>
        }
    </script>
</body>
</html>
