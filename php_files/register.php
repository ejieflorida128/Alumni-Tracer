<?php 
include("../connection/conn.php");

$emailExisted = false;
$passwordNotMatchModal = false;
$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST["full-name"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $role = htmlspecialchars(trim($_POST["role"]));
    $school = htmlspecialchars(trim($_POST["school"]));
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm-password"];

    $checkEmail = "SELECT * FROM `r_accounts` WHERE `email` = ?";
    $stmt = mysqli_prepare($conn, $checkEmail);
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $emailExisted = true;
    } else {
        if ($password === $confirmPassword) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $register = "INSERT INTO `r_accounts`(`profile_img`,`name`, `email`, `school_role`, `school`, `password`, `date_registered`,`status`) 
                         VALUES (?, ?, ?, ?, ?, ?, NOW(),?)";
            $stmt = mysqli_prepare($conn, $register);
            $defaultProfileImg = 'pictures/default.jpg';
            $pending = "Pending";
            mysqli_stmt_bind_param($stmt, 'sssssss', $defaultProfileImg, $name, $email, $role, $school, $hashedPassword,$pending);
            mysqli_stmt_execute($stmt);

            $success = true;
        } else {
            $passwordNotMatchModal = true;
        }
    }
    mysqli_stmt_close($stmt);
}

$schoolsQuery = "SELECT * FROM e_schools WHERE confirm_status = 'Approved'";
$schoolsResult = mysqli_query($conn, $schoolsQuery);
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Sign Up - Alumni Tracer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../template/css/style.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-container {
            max-width: 900px;
            margin: auto;
            padding: 2rem;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-header {
            text-align: center;
            color: #2aaaeb;
            font-weight: bold;
            margin-bottom: 1.5rem;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-10">
                <div class="form-container">
                    <h3 class="form-header">Admin Register Form</h3>
                    <form action="register.php" method="post">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="full-name" name="full-name" placeholder="John Doe" required>
                                    <label for="full-name">Full Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
                                    <label for="email">Email address</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="role" name="role" required>
                                        <option selected disabled>Select Role</option>
                                        <option value="Principal">Principal</option>
                                        <option value="Teacher">Teacher</option>
                                        <option value="Department Head">Department Head</option>
                                    </select>
                                    <label for="role">School Role</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="school" name="school" required>
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
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-4">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                    <label for="password">Password</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-4">
                                    <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Confirm Password" required>
                                    <label for="confirm-password">Confirm Password</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-check mb-4">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" onclick="togglePasswordVisibility()">
                            <label class="form-check-label" for="exampleCheck1">Show Password</label>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Sign Up</button>
                        <p class="text-center mt-3">Return to Home? <a href="../index.php">Click Here!</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php if ($emailExisted): ?>
    <div class="modal fade" id="emailExistsModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border border-danger">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Email Already Exists</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <div class="alert alert-danger mb-0" role="alert">
                Email already exists. Please use a different email.
                </div>
                  
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if ($success): ?>
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border border-success">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Registration Complete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <div class="alert alert-success mb-0" role="alert">
                Your account registration is complete. Please wait for the super admin to confirm your account. You will receive a notification once your account is activated.
                </div>
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if ($passwordNotMatchModal): ?>
    <div class="modal fade" id="passwordNotMatch" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border border-danger">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Password Mismatch</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <div class="alert alert-danger mb-0" role="alert">
                Passwords do not match. Please try again.
                </div>
                  
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePasswordVisibility() {
            const password = document.getElementById("password");
            const confirmPassword = document.getElementById("confirm-password");
            password.type = password.type === "password" ? "text" : "password";
            confirmPassword.type = confirmPassword.type === "password" ? "text" : "password";
        }

        window.onload = function() {
            <?php if ($emailExisted): ?>
                new bootstrap.Modal(document.getElementById('emailExistsModal')).show();
            <?php endif; ?>
            <?php if ($passwordNotMatchModal): ?>
                new bootstrap.Modal(document.getElementById('passwordNotMatch')).show();
            <?php endif; ?>
            <?php if ($success): ?>
                new bootstrap.Modal(document.getElementById('successModal')).show();
            <?php endif; ?>
        }
    </script>
</body>
</html>
