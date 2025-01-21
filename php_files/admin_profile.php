<?php
session_start();
include("../connection/conn.php");
date_default_timezone_set('Asia/Manila');

// Define the encryption key
define('ENCRYPTION_KEY', getenv('MY_SECRET_KEY'));

// Function to decrypt data
function decryptData($encryptedData)
{
    $key = ENCRYPTION_KEY;
    $data = base64_decode($encryptedData);

    // Get the IV length
    $ivLength = openssl_cipher_iv_length('aes-256-cbc');

    // Extract the IV and the encrypted data
    $iv = substr($data, 0, $ivLength);
    $encrypted = substr($data, $ivLength);

    // Ensure the IV is exactly 16 bytes by padding or truncating if necessary
    if (strlen($iv) < $ivLength) {
        $iv = str_pad($iv, $ivLength, "\0"); // Pad with null bytes if shorter
    }

    return openssl_decrypt($encrypted, 'aes-256-cbc', $key, 0, $iv);
}

// Function to encrypt data
function encryptData($data)
{
    $key = ENCRYPTION_KEY;
    $ivLength = openssl_cipher_iv_length('aes-256-cbc');
    $iv = openssl_random_pseudo_bytes($ivLength);

    $encryptedData = openssl_encrypt($data, 'aes-256-cbc', $key, 0, $iv);
    return base64_encode($iv . $encryptedData);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_SESSION['user_id'];

    // Retrieve and sanitize input data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $school_role = mysqli_real_escape_string($conn, $_POST['school_role']);
    $school = mysqli_real_escape_string($conn, $_POST['school']);
    $profileImg = $_FILES['profile_img'];

    // Encrypt sensitive data
    $encryptedName = encryptData($name);
    $encryptedSchoolRole = encryptData($school_role);
    $encryptedSchool = encryptData($school);

    // Handle profile image upload
    $profileImgPath = "";
    if ($profileImg['name']) {
        $targetDir = "../uploads/";
        $targetFile = $targetDir . basename($profileImg['name']);
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Validate file type
        if (in_array($fileType, ['jpg', 'jpeg', 'png', 'gif'])) {
            if (move_uploaded_file($profileImg['tmp_name'], $targetFile)) {
                $profileImgPath = $targetFile;
            } else {
                $_SESSION['error'] = "Error uploading profile image.";
                header("Location: admin_profile.php");
                exit;
            }
        } else {
            $_SESSION['error'] = "Invalid image format. Allowed formats: JPG, JPEG, PNG, GIF.";
            header("Location: admin_profile.php");
            exit;
        }
    }

    // Update profile data
    $updateSql = "UPDATE r_accounts SET 
                    name = '$encryptedName',
                    email = '$email'";

    // Include profile image if uploaded
    if (!empty($profileImgPath)) {
        $updateSql .= ", profile_img = '$profileImgPath'";
    }

    $updateSql .= " WHERE id = '$id'";

    if (mysqli_query($conn, $updateSql)) {
        $_SESSION['success'] = "Profile updated successfully.";
    } else {
        $_SESSION['error'] = "Failed to update profile.";
    }

    header("Location: admin_profile.php");
    exit;
}
// Fetch user's profile information
$id = $_SESSION['user_id'];
$sql = "SELECT * FROM r_accounts WHERE id = '$id'";
$query = mysqli_query($conn, $sql);
$call = mysqli_fetch_assoc($query);

// Extract user data
$name = decryptData($call['name']);
$email = $call['email'];
$school_role = decryptData($call['school_role']);
$school = decryptData($call['school']);
$profile_img = $call['profile_img'] ?: 'default-profile.png'; // Default profile image if not set
$date_registered = $call['date_registered'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Alumni Tracer</title>
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
    <link href="../template/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../template/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../template/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../template/css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <!-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div> -->
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary">Alumni Tracer</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="<?php echo $call['profile_img'];  ?>" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0"><?php echo decryptData($call["name"]) ?? 'N/A'; ?></h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="admin_dashboard.php" class="nav-item nav-link "><i class="fa fa-home me-2"></i>Dashboard</a>
                    <a href="admin_profile.php" class="nav-item nav-link active"><i class="fa fa-user me-2"></i>Profile</a>
                    <a href="admin_alumni_directory.php" class="nav-item nav-link"><i class="fa fa-address-book me-2"></i>Alumni Directory</a>
                    <a href="admin_alumni_information.php" class="nav-item nav-link"><i class="fa fa-info-circle me-2"></i>Alumni Info</a>
                    <a href="admin_alumni_analysis.php" class="nav-item nav-link"><i class="fa fa-chart-line me-2"></i>Alumni Analysis</a>
                    <a href="admin_notification.php" class="nav-item nav-link"><i class="fa fa-bell me-2"></i>Notification</a>


                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">

                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>

                <div class="navbar-nav align-items-center ms-auto">

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-bell me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Notification</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">

                            <?php
                            $school_name = $_SESSION['school'];
                            $decryptSchool = decryptData($school_name);
                            $sqlRecent = "SELECT * FROM e_notifications WHERE school_name = '$decryptSchool' ORDER BY id DESC LIMIT 2";
                            $query = mysqli_query($conn, $sqlRecent);

                            while ($resultData = mysqli_fetch_assoc($query)) {

                                $date_now = new DateTime();


                                $date_post = new DateTime($resultData['date']);




                                $interval = $date_now->diff($date_post);



                                if ($interval->y > 0) {
                                    $timeString = $interval->y . ' year' . ($interval->y > 1 ? 's' : '') . ' ago';
                                } elseif ($interval->m > 0) {
                                    $timeString = $interval->m . ' month' . ($interval->m > 1 ? 's' : '') . ' ago';
                                } elseif ($interval->d > 0) {
                                    $timeString = $interval->d . ' day' . ($interval->d > 1 ? 's' : '') . ' ago';
                                } elseif ($interval->h > 0) {
                                    $timeString = $interval->h . ' hour' . ($interval->h > 1 ? 's' : '') . ' ago';
                                } elseif ($interval->i > 0) {
                                    $timeString = $interval->i . ' minute' . ($interval->i > 1 ? 's' : '') . ' ago';
                                } else {
                                    $timeString = 'Just now';
                                }


                            ?>


                                <a href="#" class="dropdown-item">
                                    <h6 class="fw-normal mb-0">New Information</h6>
                                    <small><?php echo $timeString; ?></small>
                                </a>
                                <hr class="dropdown-divider">

                            <?php  } ?>



                            <a href="admin_notification.php" class="dropdown-item text-center">See all notifications</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="<?php echo $call['profile_img'];  ?>" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex"><?php echo decryptData($call["name"]) ?? 'N/A'; ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="admin_profile.php" class="dropdown-item">My Profile</a>
                            <!-- <a href="#" class="dropdown-item">Settings</a> -->
                            <a href="../index.php" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded p-4">
                    <h4 class="mb-4 text-center">Profile Information</h4>
                    <div class="d-flex flex-column align-items-center">
                        <!-- Profile Image -->
                        <img class="img-thumbnail rounded-circle mb-4" src="<?php echo $profile_img; ?>" alt="Profile Image" style="width: 150px; height: 150px;">

                        <!-- Profile Details -->
                        <div class="row w-100">
                            <div class="col-md-6 mb-3">
                                <p><strong>Name:</strong> <?php echo $name; ?></p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <p><strong>Email:</strong> <?php echo $email; ?></p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <p><strong>School Role:</strong> <?php echo $school_role; ?></p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <p><strong>School:</strong> <?php echo $school; ?></p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <p><strong>Date Registered:</strong> <?php echo $date_registered; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Add a button to trigger the modal -->
                <button type="button" class="btn btn-warning" style="margin-left: 40%;" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                    Edit Profile
                </button>
            </div>

            <!-- Edit Profile Modal -->
            <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Form to update profile details -->
                            <form action="admin_profile.php" method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
                                </div>                                
                                <div class="mb-3">
                                    <label for="profile_img" class="form-label">Profile Image</label>
                                    <input type="file" class="form-control" id="profile_img" name="profile_img">
                                </div>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>






            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">Alumni Tracer</a>, All Right Reserved.
                        </div>

                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
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
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Get the canvas element by ID
            var ctx = document.getElementById("alumni-graph").getContext('2d');

            // Fetch the data from PHP (passed as JSON)
            var labels = <?php echo $years_degrees_json; ?>; // Year and Degree labels
            var data = <?php echo $student_counts_json; ?>; // Student counts

            // Create a new bar chart
            var studentsChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels, // Dynamic labels (Year - Degree)
                    datasets: [{
                        label: 'Number of Students',
                        data: data, // Dynamic data (student counts)
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Year'
                            }
                        },
                        y: {
                            ticks: {
                                stepSize: 1, // Ensure step size is 1 to only show whole numbers
                                callback: function(value) {
                                    if (Number.isInteger(value)) {
                                        return value; // Only return whole numbers
                                    }
                                }
                            }
                        },
                        beginAtZero: true // Ensures the y-axis starts at 0
                    }
                }
            });
        });
    </script>

</body>

</html>