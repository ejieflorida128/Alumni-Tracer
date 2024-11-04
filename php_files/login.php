<?php
session_start();
include '../connection/conn.php'; // Database connection

// Initialize variables for error handling
$invalidPassword = false;
$noAccountFound = false;
$fillOutInputs = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Fetch input values from the login form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the form fields are not empty
    if (!empty($email) && !empty($password)) {
                if($email == "superadmin@gmail.com" && $password == "superadmin"){

                    header("Location: ../SuperAdmin/superAdmin.php");
                    exit();

                }else{
                     // Sanitize inputs to prevent SQL injection
                            $email = mysqli_real_escape_string($conn, $email);

                            // SQL query to fetch user by email
                            $query = "SELECT * FROM r_accounts WHERE email = '$email'";
                            $result = mysqli_query($conn, $query);

                            if (mysqli_num_rows($result) > 0) {
                                $user = mysqli_fetch_assoc($result);
                                
                                // Verify the password using password_verify (hashed password stored in the database)
                                if (password_verify($password, $user['password'])) {
                                    // Successful login
                                    $_SESSION['user_id'] = $user['id'];
                                    $_SESSION['email'] = $user['email'];
                                    header('Location: dashboard.php'); // Redirect to a dashboard page
                                    exit();
                                } else {
                                $invalidPassword  = true;
                                }
                            } else {
                                $noAccountFound = true;
                            }
                }
    } else {
       $fillOutInputs = true;
    }
}   
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>ALumni Tracer - Login</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Stylesheets -->
    <link href="../template/css/bootstrap.min.css" rel="stylesheet">
    <link href="../template/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Login Form -->
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                         
                            <h3 style="color: #2aaaeb; font-weight: bolder;">Sign In</h3>
                        </div>
                        <form method="POST" action="">
                            <div class="form-floating mb-3">
                                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com" required>
                                <label for="floatingInput">Email address</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                                <label for="floatingPassword">Password</label>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="togglePassword" onclick="togglePasswordVisibility()">
                                    <label class="form-check-label" for="togglePassword">Show Password</label>
                                </div>
                                <a href="">Forgot Password</a>
                            </div>
                            <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Sign In</button>
                        </form>
                        <p class="text-center mb-0">Don't have an Account? <a href="../php_files/register.php">Sign Up</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

   <!-- Invalid Password Modal -->
<?php if ($invalidPassword): ?>
<div class="modal fade" id="invalidPasswordModal" tabindex="-1" aria-labelledby="invalidPasswordLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered"> <!-- Center the modal -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="invalidPasswordLabel">Error</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Invalid password!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- No Account Found Modal -->
<?php if ($noAccountFound): ?>
<div class="modal fade" id="noAccountFoundModal" tabindex="-1" aria-labelledby="noAccountFoundLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered"> <!-- Center the modal -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="noAccountFoundLabel">Error</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                No account found with that email!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Fill Out Inputs Modal -->
<?php if ($fillOutInputs): ?>
<div class="modal fade" id="fillOutInputsModal" tabindex="-1" aria-labelledby="fillOutInputsLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered"> <!-- Center the modal -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fillOutInputsLabel">Error</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Please fill out both fields!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>


    <!-- JavaScript to trigger modals if error occurs -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("floatingPassword");
            var toggleButton = document.getElementById("togglePassword");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleButton.innerHTML = "Hide Password";
            } else {
                passwordInput.type = "password";
                toggleButton.innerHTML = "Show Password";
            }
        }

        <?php if ($invalidPassword): ?>
            var invalidPasswordModal = new bootstrap.Modal(document.getElementById('invalidPasswordModal'));
            invalidPasswordModal.show();
        <?php endif; ?>

        <?php if ($noAccountFound): ?>
            var noAccountFoundModal = new bootstrap.Modal(document.getElementById('noAccountFoundModal'));
            noAccountFoundModal.show();
        <?php endif; ?>

        <?php if ($fillOutInputs): ?>
            var fillOutInputsModal = new bootstrap.Modal(document.getElementById('fillOutInputsModal'));
            fillOutInputsModal.show();
        <?php endif; ?>
    </script>
</body>
</html>
