<?php
session_start();
include '../connection/conn.php'; // Database connection

$success = false;
$fail = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $school_name = htmlspecialchars(trim($_POST["school_name"]));

    if (isset($_FILES["school_logo"]) && $_FILES["school_logo"]["error"] == 0) {
       
        $file_name = $_FILES["school_logo"]["name"];
        $file_tmp = $_FILES["school_logo"]["tmp_name"];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        
            $upload_dir = "../SuperAdmin/logo/";
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true); 
            }

            $new_file_name = $upload_dir . uniqid() . "." . $file_ext;
            if (move_uploaded_file($file_tmp, $new_file_name)) {
                $sqlInsert = "INSERT INTO e_schools (school_name, logo, confirm_status) VALUES (?, ?, 'Pending')";
                $stmt = mysqli_prepare($conn, $sqlInsert);
                mysqli_stmt_bind_param($stmt, "ss", $school_name, $new_file_name);

                if (mysqli_stmt_execute($stmt)) {
                    $success = true;
                } else {
                    $fail = true;
                }
                mysqli_stmt_close($stmt);
           
        } else {
            $fail = true;
        }
    } else {
        $fail = true;
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
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h3 style="color: #2aaaeb; font-weight: bolder;">Request Portal</h3>
                        </div>
                        <form method="POST" action="school_register.php" enctype="multipart/form-data">
                             <div class="form-floating mb-3">
                                <input type="file" name="school_logo" class="form-control" id="floatingInput" placeholder="School Logo" required>
                                <label for="floatingInput">School Logo</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" name="school_name" class="form-control" id="floatingInput" placeholder="School Name" required>
                                <label for="floatingInput">School Name</label>
                            </div>
                            <input type="submit" value="Send Request Portal" class="btn btn-primary py-3 w-100 mb-4">
                        </form>
                        <p class="text-center mb-0">Back to Home? <a href="../index.php">Click Here!</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <?php if ($success): ?>
    <div class="modal fade" id="noAccountFoundModal" tabindex="-1" aria-labelledby="noAccountFoundLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="noAccountFoundLabel">Notification</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="alert alert-success" role="alert">
                    Your school registration request has been submitted successfully and is awaiting admin approval.
                </div>
                <div class="modal-footer">
                    <a href="../index.php" class="btn btn-danger">HOME</a>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Failure Modal -->
    <?php if ($fail): ?>
    <div class="modal fade" id="fillOutInputsModal" tabindex="-1" aria-labelledby="fillOutInputsLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="fillOutInputsLabel">Error</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="alert alert-danger" role="alert">
                    There was an issue submitting your school registration request. Please try again later.
                </div>
                <div class="modal-footer">
                    <a href="../index.php" class="btn btn-danger">HOME</a>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- JavaScript to trigger modals based on success/fail -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        <?php if ($success): ?>
            var noAccountFoundModal = new bootstrap.Modal(document.getElementById('noAccountFoundModal'));
            noAccountFoundModal.show();
        <?php elseif ($fail): ?>
            var fillOutInputsModal = new bootstrap.Modal(document.getElementById('fillOutInputsModal'));
            fillOutInputsModal.show();
        <?php endif; ?>
    </script>
</body>
</html>
