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
    $faceImageData = $_POST["faceImageData"]; // Base64 encoded image data

    // Decode the base64 string and save the image in the uploads folder
    if (isset($faceImageData) && !empty($faceImageData)) {
        // Remove the base64 image metadata part (e.g., "data:image/png;base64,")
        $faceImageData = str_replace('data:image/png;base64,', '', $faceImageData);
        $faceImageData = str_replace(' ', '+', $faceImageData); // Replace spaces with plus signs

        // Decode the base64 string into image data
        $imageData = base64_decode($faceImageData);

        // Generate a unique name for the image
        $imageName = uniqid('face_', true) . '.png'; // You can change this to any other image format you need

        // Set the path where the image will be saved
        $imagePath = '../uploads/faces/' . $imageName;

        // Save the image to the designated folder
        file_put_contents($imagePath, $imageData);
    }

    // Check if the passwords match
    if ($password === $confirmPassword) {
        // Check if email already exists
        $checkEmail = "SELECT * FROM `r_accounts` WHERE `email` = ?";
        $stmt = mysqli_prepare($conn, $checkEmail);
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $emailExisted = true;
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $defaultProfileImg = 'pictures/default.jpg'; // Default profile image
            $pending = "Pending";

            // Insert data into the database, including the path to the face image
            $register = "INSERT INTO `r_accounts`(`profile_img`, `name`, `email`, `school_role`, `school`, `password`, `date_registered`, `status`, `face_data`) 
                         VALUES (?, ?, ?, ?, ?, ?, NOW(), ?, ?)";
            $stmt = mysqli_prepare($conn, $register);
            mysqli_stmt_bind_param($stmt, 'ssssssss', $defaultProfileImg, $name, $email, $role, $school, $hashedPassword, $pending, $imagePath);
            mysqli_stmt_execute($stmt);
            $success = true;
        }
        mysqli_stmt_close($stmt);
    } else {
        $passwordNotMatchModal = true;
    }
}

// Query for schools
$schoolsQuery = "SELECT * FROM e_schools WHERE confirm_status = 'Approved'";
$schoolsResult = mysqli_query($conn, $schoolsQuery);
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Alumni Tracer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">


    <link href="../template/css/style.css" rel="stylesheet">
    <style>
        *{
            font-family: 'Roboto', sans-serif;
        }
        body {
            background-color: #f8f9fa;
            font-family: 'Roboto', sans-serif;
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
        #face-image {
            display: none; /* Hide the file input field */
        }
        #camera-stream {
            width: 100%;
            height: 500px;
            object-fit: cover;
            transform: scaleX(-1); /* Apply the mirror effect to the camera feed */
        }
        #captured-image {
            width: 100%;
            height: 500px;
            object-fit: cover;
            display: none; /* Initially hide the captured image */
            transform: scaleX(-1); /* Apply the mirror effect to the captured image */
        }
        .camera-container {
            position: relative;
            margin-bottom: 20px;
        }
        .camera-container .btn {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 10;
        }
        .row.full-height {
            min-height: 100vh; /* Ensures full viewport height */
        }
        .col-md-6 {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .camera-container img,
        .camera-container video {
            display: block;
        }
        /* Form container styles */
        .form-container {
            padding: 3rem;
            border-radius: 10px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
        }
        /* Flexbox for two-column layout */
        .form-row {
            display: flex;
            justify-content: space-between;
            gap: 2rem;
        }
        .form-column {
            flex: 1;
        }
    </style>
</head>

<body>
<div class="container-fluid">
    <div class="row justify-content-center align-items-center full-height">
        <div class="col-md-10">
            <div class="row form-row">
                <!-- Camera and Image Section (Left) -->
                <div class="col-md-6 form-column">
                    <div class="camera-container" style="position: relative; background-color: white; border-radius: 10px; padding: 10px;">
                        <video id="camera-stream" autoplay playsinline class="w-100" style="height: 500px; border-radius: 10px;"></video>
                        <img id="captured-image" src="" alt="Captured Image" style="display: none; border-radius: 10px;" />
                        
                        <!-- Button with Camera Icon -->
                        <button class="btn btn-primary" id="capture-btn" style="position: absolute; bottom: 40px; left: 50%; transform: translateX(-50%); z-index: 10;">
                            <i class="fas fa-camera fa-3x"></i> <!-- Font Awesome Camera Icon with size modifier -->
                        </button>
                    </div>
                    <canvas id="canvas" style="display: none;"></canvas> <!-- Hidden canvas -->
                </div>

                <!-- Registration Form Section (Right) -->
                <div class="col-md-6 form-column d-flex flex-column">
                    <div class="form-container" style="height: 500px; margin-top: 7px;">
                        <h3 class="form-header">Admin Register Form</h3>
                        <form action="register.php" method="post" id="registration-form" enctype="multipart/form-data">
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
                                                    while ($school = mysqli_fetch_assoc($schoolsResult)) {
                                                        echo "<option value='" . $school['school_name'] . "'>" . $school['school_name'] . "</option>";
                                                    }
                                                }
                                            ?>
                                        </select>
                                        <label for="school">School Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="********" required>
                                        <label for="password">Password</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="********" required>
                                        <label for="confirm-password">Confirm Password</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Hidden input to store the base64 encoded image data -->
                            <input type="hidden" name="faceImageData" id="face-image">

                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" class="btn btn-primary" id="submit-btn">Register</button>
                                <p class="text-center mb-0"  style = "margin-top: 10px;">Back to Home? <a href="../index.php">Click Here!</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Errors -->
<?php if ($emailExisted): ?>
    <div class="modal fade" id="emailExistedModal" tabindex="-1" aria-labelledby="emailExistedModalLabel" aria-hidden="true" style = "margin-top: 10%;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="emailExistedModalLabel">Email Already Exists</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    The email address is already registered.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if ($passwordNotMatchModal): ?>
    <div class="modal fade" id="passwordNotMatchModal" tabindex="-1" aria-labelledby="passwordNotMatchModalLabel" aria-hidden="true" style = "margin-top: 10%;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="passwordNotMatchModalLabel">Password Mismatch</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    The passwords do not match. Please try again.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if ($success): ?>
    <div class="modal fade" id="registrationSuccessModal" tabindex="-1" aria-labelledby="registrationSuccessModalLabel" aria-hidden="true" style = "margin-top: 10%;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registrationSuccessModalLabel">Registration Successful</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    You have been successfully registered. Please check your email for further instructions.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Start Camera Function
    function startCamera() {
        const video = document.getElementById('camera-stream');
        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            navigator.mediaDevices.getUserMedia({ video: true })
                .then(stream => {
                    video.srcObject = stream;
                })
                .catch(error => {
                    console.error("Error accessing camera: ", error);
                });
        } else {
            alert("Camera not supported by this browser.");
        }
    }

// Capture Image Function
function captureImage() {
    const video = document.getElementById('camera-stream');
    const canvas = document.getElementById('canvas');
    const context = canvas.getContext('2d');
    const capturedImage = document.getElementById('captured-image');

    // Set canvas size to match video size
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;

    // Remove the scale(-1, 1) to prevent the horizontal flip (no mirroring)
    // No mirroring applied here

    // Draw the video frame on the canvas
    context.drawImage(video, 0, 0, canvas.width, canvas.height); // Draw the image as is (without flip)

    // Convert canvas to Base64 image data
    const imageData = canvas.toDataURL('image/png');
    
    // Show the captured image and hide the video stream
    capturedImage.src = imageData;
    capturedImage.style.display = 'block';  // Show the captured image
    video.style.display = 'none'; // Hide the camera feed
    
    // Store the Base64 image data in the hidden form input field
    document.getElementById('face-image').value = imageData;
}




    // Event Listener for Capture Button
    document.getElementById('capture-btn').addEventListener('click', captureImage);

    // Start the camera when the page loads
    window.onload = startCamera;
</script>

<?php if ($emailExisted): ?>
    <script>
        // Trigger modal to show if email exists
        var myModal = new bootstrap.Modal(document.getElementById('emailExistedModal'), {
            keyboard: false
        });
        myModal.show();
    </script>
<?php endif; ?>

<?php if ($passwordNotMatchModal): ?>
    <script>
        // Trigger modal to show if password mismatch occurs
        var myModal = new bootstrap.Modal(document.getElementById('passwordNotMatchModal'), {
            keyboard: false
        });
        myModal.show();
    </script>
<?php endif; ?>

<?php if ($success): ?>
    <script>
        // Trigger modal to show on successful registration
        var myModal = new bootstrap.Modal(document.getElementById('registrationSuccessModal'), {
            keyboard: false
        });
        myModal.show();
    </script>
<?php endif; ?>

</body>
</html>
