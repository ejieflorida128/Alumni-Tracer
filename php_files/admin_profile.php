<?php
session_start();
include("../connection/conn.php");

define('ENCRYPTION_KEY', getenv('MY_SECRET_KEY'));


function decryptData($encryptedData)
{
    $key = ENCRYPTION_KEY;
    $data = base64_decode($encryptedData);
    $ivLength = openssl_cipher_iv_length('aes-256-cbc');
    $iv = substr($data, 0, $ivLength); // Extract the IV
    $encrypted = substr($data, $ivLength); // Extract the encrypted data
    return openssl_decrypt($encrypted, 'aes-256-cbc', $key, 0, $iv);
}


function encryptData($data)
{
    $key = ENCRYPTION_KEY;
    $iv = random_bytes(openssl_cipher_iv_length('aes-256-cbc')); // Generate a random IV
    $encrypted = openssl_encrypt($data, 'aes-256-cbc', $key, 0, $iv);
    return base64_encode($iv . $encrypted); // Store IV and encrypted data together
}

// Check if form is submitted for information update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $Name = $_POST["name"];
    $email = $_POST["email"];
    $contact = $_POST["contact"];
    $school = $_POST["school"];
    $schoolrole = $_POST["school_role"];
    $bio = $_POST["bio"];
    $id = $_SESSION['user_id'];

    // Escape user inputs for security
    $firstName = mysqli_real_escape_string($conn, $Name);
    $email = mysqli_real_escape_string($conn, $email);
    $contact = mysqli_real_escape_string($conn, $contact);
    $school = mysqli_real_escape_string($conn, $school);
    $schoolrole = mysqli_real_escape_string($conn, $schoolrole);
    $bio = mysqli_real_escape_string($conn, $bio);

    // Handle profile picture upload
    $profilePicturePath = "";
    if (isset($_FILES['profilePicture']) && $_FILES['profilePicture']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['profilePicture'];
        $uploadDir = "profilePicture/";
        $uploadFile = $uploadDir . basename($file['name']);
        if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
            $profilePicturePath = mysqli_real_escape_string($conn, $uploadFile);
        }
    }

    // Check if the user already has a profile record
    $check_sql = "SELECT id FROM r_accounts WHERE id = '$id'";
    $check_result = mysqli_query($conn, $check_sql);
    
    if (mysqli_num_rows($check_result) > 0) {
        // Update existing profile record
        $sql = "UPDATE r_accounts SET 
                    name = '$Name', 
                    email = '$email', 
                    contact = '$contact', 
                    school = '$school', 
                    school_role = '$schoolrole', 
                    bio = '$bio'";

        // Update profile picture if a new one was uploaded
        if (!empty($profilePicturePath)) {
            $sql .= ", profile_img = '$profilePicturePath'";
        }

        $sql .= " WHERE id = '$id'";
    } else {
        // Insert a new profile record
        $sql = "INSERT INTO r_accounts (id, name, email, contact, school_role,school, bio, profile_img) 
                VALUES ('$id', '$Name', '$email', '$contact', '$schoolrole', '$school', '$bio', '$profilePicturePath')";
    }

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        echo "";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Fetch user's profile information
$id = $_SESSION['user_id'];
$sql = "SELECT * FROM r_accounts WHERE id = '$id'";
$query = mysqli_query($conn, $sql);
$call = mysqli_fetch_assoc($query);
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
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary">Alumni Tracer</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="../template/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0"><?php echo decryptData($call["name"] ) ?? 'N/A'; ?></h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                <a href="admin_dashboard.php" class="nav-item nav-link "><i class="fa fa-home me-2"></i>Dashboard</a>
                <a href="admin_profile.php" class="nav-item nav-link active"><i class="fa fa-user me-2"></i>Profile</a>
                <a href="admin_alumni_directory.php" class="nav-item nav-link"><i class="fa fa-address-book me-2"></i>Alumni Directory</a>
                <a href="admin_alumni_information.php" class="nav-item nav-link"><i class="fa fa-info-circle me-2"></i>Alumni Info</a>
                <a href="admin_alumni_analysis.php" class="nav-item nav-link"><i class="fa fa-chart-line me-2"></i>Alumni Analysis</a>



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
                            <i class="fa fa-envelope me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Message</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="../template/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>

                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all message</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-bell me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Notification</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">

                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Password changed</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all notifications</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="../template/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex"><?php echo decryptData($call["name"] ) ?? 'N/A'; ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">My Profile</a>
                            <a href="#" class="dropdown-item">Settings</a>
                            <a href="#" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->


            <div class="container-fluid pt-4 px-4">
                
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-4 text-center">
        <div class="card p-3" style="display: flex; justify-content: center; align-items: center; height: 300px;"> <!-- Added styles -->
        <img src="<?php echo $call['profile_img']; ?>" alt="Profile Picture" id="profile_pic"  style=" height: 250px; width: 250px; border-radius: 50%;">
        <img id="propPIc" class="rounded-circle img-fluid mt-2" style="max-height: 200px; max-width: 200px; display:none;">
    </div>
            <!-- <div class="mt-3">
                <input type="file" class="form-control" id="profilePicture" name="profilePicture" accept="image/*" hidden>
                <label class="btn btn-success mt-2" for="profilePicture">Change Profile Pic</label>
            </div> -->
            <!-- Update Profile Button -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateProfileModal" style=" margin-top: 10px;">Update Profile!</button>

<!-- Modal -->
<div class="modal fade" id="updateProfileModal" tabindex="-1" aria-labelledby="updateProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Optional: Use modal-lg for larger width -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateProfileModalLabel">Update Profile Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="admin_profile.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" required placeholder="Enter your name" value="<?php echo decryptData($call['name']) ?? ''; ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" required placeholder="Enter your email" value="<?php echo $call['email'] ?? ''; ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="contact" class="form-label">Contact</label>
                        <input type="text" class="form-control" name="contact" placeholder="Enter your contact number" value="<?php echo decryptData($call['contact']) ?? ''; ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="schoolRole" class="form-label">School Role</label>
                        <input type="text" class="form-control" name="school_role" placeholder="Enter your school role" value="<?php echo decryptData($call['school_role']) ?? ''; ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="school" class="form-label">School</label>
                        <input type="text" class="form-control" name="school" placeholder="Enter your school" value="<?php echo decryptData($call['school']) ?? ''; ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="bio" class="form-label">Bio</label>
                        <textarea class="form-control" name="bio" rows="3" placeholder="Tell something about yourself"><?php echo decryptData($call['bio']) ?? ''; ?></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="profilePicture" class="form-label">Profile Picture</label>
                        <input type="file" class="form-control" id="profilePicture" name="profilePicture" accept="image/*">
                    </div>
                    
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Update Information</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

        </div>
        <div class="col-lg-8">
            <div class="card p-4">
                <!-- <h4></h4>
                <form action="adminprofile.php" method="post" enctype="multipart/form-data"> -->

                <div class="col-lg-8">
                    <p class="h6 text-secondary"><strong>Name:</strong> <?php echo decryptData($call['name']) ?? 'N/A'; ?></p>
                    <p class="h6 text-secondary"><strong>Email:</strong> <?php echo $call['email'] ?? 'N/A'; ?></p>
                    <p class="h6 text-secondary"><strong>Contact:</strong> <?php echo decryptData($call['contact']) ?? '000-0000-000'; ?></p>
                    <p class="h6 text-secondary"><strong>School Role:</strong> <?php echo decryptData($call['school_role']) ?? 'N/A'; ?></p>
                    <p class="h6 text-secondary"><strong>School:</strong> <?php echo decryptData($call['school']) ?? 'N/A'; ?></p>
                    <p class="h6 text-secondary"><strong>Bio:</strong> <?php echo decryptData($call['bio']) ?? 'N/A'; ?></p>
                </div>

                   
                
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('profilePicture').addEventListener('change', function(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const preview = document.getElementById('propPIc');
            preview.src = reader.result;
            preview.style.display = 'block';
            document.getElementById('profile_pic').style.display = 'none';
        }
        reader.readAsDataURL(event.target.files[0]);
    });
</script>
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