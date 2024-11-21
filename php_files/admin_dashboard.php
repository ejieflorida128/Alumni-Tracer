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

$id = $_SESSION['user_id'];

$sql = "SELECT * FROM r_accounts WHERE id = '$id'";
$query = mysqli_query($conn, $sql);
$call = mysqli_fetch_assoc($query);

$adminCountSql = "SELECT COUNT(*) as admin_count FROM r_accounts";
$adminCountQry = mysqli_query($conn, $adminCountSql);
$adminCount =  mysqli_fetch_assoc($adminCountQry);

$approvedAlumniSql = "SELECT COUNT(*) as approved_alumni_count FROM e_schools WHERE confirm_status = 'Approved'";
$approvedAlumniQry = mysqli_query($conn, $approvedAlumniSql);
$approvedAlumni =  mysqli_fetch_assoc($approvedAlumniQry);

$responseSql = "SELECT id, `name`, degree, year_awarded FROM l_study_response ORDER BY created_at DESC  LIMIT 5";
$responseQry = mysqli_query($conn, $responseSql);

$alumniSql = "SELECT degree, year_awarded, COUNT(*) as student_count 
        FROM l_study_response 
        GROUP BY  year_awarded 
        ORDER BY year_awarded";
$alumniQry = mysqli_query($conn, $alumniSql);
$years_degrees = [];
$student_counts = [];

while ($row = mysqli_fetch_assoc($alumniQry)) {
    // Combine year and degree for the x-axis labels
    $years_degrees[] = $row['year_awarded'];
    // Store the count of students for the y-axis
    $student_counts[] = $row['student_count'];
}
// Pass PHP arrays as JSON to JavaScript
$years_degrees_json = json_encode($years_degrees);
$student_counts_json = json_encode($student_counts);


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
                        <h6 class="mb-0"><?php echo decryptData($call["name"]); ?></h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                <a href="admin_dashboard.php" class="nav-item nav-link active"><i class="fa fa-home me-2"></i>Dashboard</a>
                <a href="admin_profile.php" class="nav-item nav-link"><i class="fa fa-user me-2"></i>Profile</a>
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
                            <span class="d-none d-lg-inline-flex"><?php echo decryptData($call["name"]); ?></span>
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


            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-line fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Admins</p>
                                <h6 class="mb-0"><?php echo $adminCount["admin_count"]; ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-bar fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Approved Alumni</p>
                                <h6 class="mb-0"><?php echo $approvedAlumni["approved_alumni_count"]; ?></h6>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- Sale & Revenue End -->
            <!-- Newest Response Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Newest Reponses</h6>
                        <a href="">Show All</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    <th scope="col"><input class="form-check-input" type="checkbox"></th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Degree</th>
                                    <th scope="col">Year Awarded</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($responseQry) {
                                    while ($response = mysqli_fetch_assoc($responseQry)) {
                                ?>
                                        <tr>
                                            <td><input class="form-check-input" type="checkbox"></td>
                                            <td> <?php echo $response["name"]; ?> </td>
                                            <td> <?php echo $response["degree"]; ?> </td>
                                            <td> <?php echo $response["year_awarded"]; ?> </td>
                                            <td><a class="btn btn-sm btn-primary" href="">Detail</a></td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "
                                        <tr>
                                            <td colspan='5'>No data found</td>
                                        </tr>
                                    ";
                                }
                                ?>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Newest Respnse End -->


            <!-- Sales Chart Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light text-center rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Newest Study reponse</h6>
                                <!-- Display year and the degree  then number of students -->
                                <a href="">Show All</a>
                            </div>
                            <canvas id="alumni-graph"></canvas>
                        </div>
                    </div>

                </div>
            </div>
            <!-- Sales Chart End -->





            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">Your Site Name</a>, All Right Reserved.
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            Designed By <a href="https://htmlcodex.com">HTML Codex</a>
                            </br>
                            Distributed By <a class="border-bottom" href="https://themewagon.com" target="_blank">ThemeWagon</a>
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