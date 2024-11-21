<?php
session_start();
include '../connection/conn.php'; // Database connection

// Initialize the data structure for each label (Existing Data)
$data = [
    'Pending' => 0,
    'Male' => 0,
    'Female' => 0,
    'Working' => 0,
    'Studying' => 0,
    'Principal' => 0,   // For roles
    'DeptHead' => 0,    // For roles
    'Teacher' => 0,     // For roles
    'TotalAdmins' => 0, // Total admins
    'SurveysCreated' => 0, // Total number of surveys created
    'surveyResponsesByMonth' => [], // Monthly survey data with date and time
    'schoolNames' => [], // For school chart
    'schoolPending' => [], // For school chart
    'schoolApproved' => [] // For school chart
];

// Fetch alumni data
// For Pending
$query = "SELECT COUNT(*) as count FROM l_study_response WHERE status = 'Pending'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$data['Pending'] = (int)$row['count'];

// For Male and Female
$query = "SELECT sex, COUNT(*) as count FROM l_study_response GROUP BY sex";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $data[$row['sex']] = (int)$row['count'];
}

// For Working
$query = "SELECT COUNT(*) as count FROM l_study_response WHERE current_position IS NOT NULL AND current_position != ''";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$data['Working'] = (int)$row['count'];

// For Not Studying (assumed as "No" in `current_study`)
$query_no = "SELECT COUNT(*) as count FROM l_study_response WHERE current_study = 'Yes'";
$result_no = mysqli_query($conn, $query_no);
$row_no = mysqli_fetch_assoc($result_no);
$data['Studying'] = (int)$row_no['count'];

// For Surveys Created (count based on `created_at`)
$query_surveys = "SELECT COUNT(*) as count FROM l_study_response WHERE created_at IS NOT NULL";
$result_surveys = mysqli_query($conn, $query_surveys);
$row_surveys = mysqli_fetch_assoc($result_surveys);
$data['SurveysCreated'] = (int)$row_surveys['count'];

// Fetch admin role counts (Principal, Dept. Head, Teacher)
$query_roles = "
    SELECT 
        school_role, COUNT(*) as count
    FROM r_accounts
    WHERE school_role IN ('Principal', 'Dept. Head', 'Teacher')
    GROUP BY school_role
";
$result_roles = mysqli_query($conn, $query_roles);
$totalAdmins = 0;
while ($row = mysqli_fetch_assoc($result_roles)) {
    $role = $row['school_role'];
    $count = (int)$row['count'];
    $data[$role] = $count;
    $totalAdmins += $count;
}
$data['TotalAdmins'] = $totalAdmins;

// Fetch data for each school’s pending and approved status
$query_schools = "
    SELECT 
        school_name, 
        SUM(CASE WHEN confirm_status = 'Pending' THEN 1 ELSE 0 END) AS pending_count,
        SUM(CASE WHEN confirm_status = 'Approved' THEN 1 ELSE 0 END) AS approved_count
    FROM e_schools
    GROUP BY school_name
";
$result_schools = mysqli_query($conn, $query_schools);

$totalSchools = 0;
while ($row = mysqli_fetch_assoc($result_schools)) {
    // Store school data
    $data['schoolNames'][] = $row['school_name'];
    $data['schoolPending'][] = (int)$row['pending_count'];
    $data['schoolApproved'][] = (int)$row['approved_count'];

    // Accumulate the total number of schools (if needed)
    $totalSchools++;
}

// Store the total number of schools in the data array
$data['totalSchools'] = $totalSchools;


// Fetch survey responses by full date and time
$query_monthly_surveys = "
    SELECT 
        DATE_FORMAT(created_at, '%Y-%m-%d %H:%i:%s') AS date_time, 
        COUNT(*) AS count 
    FROM l_study_response
    WHERE created_at IS NOT NULL
    GROUP BY date_time
    ORDER BY date_time
";
$result_monthly_surveys = mysqli_query($conn, $query_monthly_surveys);

while ($row = mysqli_fetch_assoc($result_monthly_surveys)) {
    $data['surveyResponsesByMonth'][] = [
        'date' => $row['date_time'], // Full date with time
        'count' => (int)$row['count']
    ];
}

// Encode data for JavaScript
$data_json = json_encode($data);
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Alumni Tracer</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">   
    <meta content="" name="description">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

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
    <style>
        .container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            padding: 20px;
        }

        .chart-card {
            width: 100%;
            max-width: 450px;
            min-width: 300px;
            margin: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header,
        .card-footer {
            background-color: #f8f9fa;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .card-body {
            padding: 20px;
            display: flex;
            justify-content: center;
        }

        .text-center {
            text-align: center;
        }
    </style>

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
                        <h6 class="mb-0"><?php echo $call["name"] ?? 'N/A'; ?></h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="admin_dashboard.php" class="nav-item nav-link "><i class="fa fa-home me-2"></i>Dashboard</a>
                    <a href="admin_profile.php" class="nav-item nav-link"><i class="fa fa-user me-2"></i>Profile</a>
                    <a href="admin_alumni_directory.php" class="nav-item nav-link "><i class="fa fa-address-book me-2"></i>Alumni Directory</a>
                    <a href="admin_alumni_information.php" class="nav-item nav-link"><i class="fa fa-info-circle me-2"></i>Alumni Info</a>
                    <a href="admin_alumni_analysis.php" class="nav-item nav-link active"><i class="fa fa-chart-line me-2"></i>Alumni Analysis</a>




                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <form class="d-none d-md-flex ms-4">
                    <input class="form-control border-0" type="search" placeholder="Search">
                </form>
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
                            <span class="d-none d-lg-inline-flex">John Doe</span>
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
                <!-- School Registration and Approval Chart Card -->
                <div class="container">

                    <!-- Survey Responses Line Chart Card -->
                    <div class="card chart-card">
                        <div class="card-header text-center" style="background-color: #009CFF;">
                            <h4>Survey Responses Date and Time</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="surveyLineChart" width="400" height="200"></canvas>
                        </div>
                    </div>

                    <!-- Alumni Status Distribution Chart Card -->
                    <div class="card chart-card">
                        <div class="card-header text-center" style="background-color: #009CFF;">
                            <h4>Alumni Status Distribution</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="alumniChart" width="400" height="300"></canvas>
                        </div>
                    </div>

                    <!-- Admin Role Distribution Chart Card -->
                    <div class="card chart-card">
                        <div class="card-header text-center" style="background-color: #009CFF;">
                            <h4>Admin Role Distribution</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="adminPieChart" width="400" height="200"></canvas>
                        </div>
                        <div class="card-footer text-center" style="background-color: #009CFF;">
                            <h5>Total Number of Admins: <span id="totalAdmins"></span></h5>
                        </div>
                    </div>

                    <!-- New School Registration and Approval Chart Card -->
                    <div class="card chart-card">
                        <div class="card-header text-center" style="background-color: #009CFF;">
                            <h4>School Registration and Approval Status</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="schoolChart" width="400" height="300"></canvas>
                        </div>
                        <div class="card-footer text-center" style="background-color: #009CFF;">
                            <h5>Total Number of Schools: <span id="totalSchools"></span></h5>
                        </div>
                    </div>

                    <script>
                        // Parse JSON data from PHP
                        const data = JSON.parse('<?php echo $data_json; ?>');

                        // Display the total number of admins
                        document.getElementById('totalAdmins').textContent = data.TotalAdmins;

                        // Display the total number of admins
                        document.getElementById('totalSchools').textContent = data.totalSchools;

                        // Bar Chart Data (Alumni Status with Centered Colors)
                        const barData = {
                            labels: ['Pending', 'Male', 'Female', 'Working', 'Studying', 'Surveys Created'],
                            datasets: [{
                                    label: 'Pending',
                                    data: [data.Pending, null, null, null, null, null],
                                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                                    barThickness: 20
                                },
                                {
                                    label: 'Male',
                                    data: [null, data.Male, null, null, null, null],
                                    backgroundColor: 'rgba(255, 99, 132, 0.6)',
                                    barThickness: 20
                                },
                                {
                                    label: 'Female',
                                    data: [null, null, data.Female, null, null, null],
                                    backgroundColor: 'rgba(255, 205, 86, 0.6)',
                                    barThickness: 20
                                },
                                {
                                    label: 'Working',
                                    data: [null, null, null, data.Working, null, null],
                                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                                    barThickness: 20
                                },
                                {
                                    label: 'NotStudying',
                                    data: [null, null, null, null, data.Studying, null],
                                    backgroundColor: 'rgba(153, 102, 255, 0.6)',
                                    barThickness: 20
                                },
                                {
                                    label: 'Surveys Created',
                                    data: [null, null, null, null, null, data.SurveysCreated],
                                    backgroundColor: 'rgba(255, 159, 64, 0.6)', // Distinct color for this category
                                    barThickness: 20
                                }
                            ]
                        };

                        // Pie Chart Data (Admin Roles)
                        const pieData = {
                            labels: ['Principal', 'Dept. Head', 'Teacher'],
                            datasets: [{
                                label: 'Admin Role Distribution',
                                data: [data.Principal, data.DeptHead, data.Teacher],
                                backgroundColor: [
                                    'rgba(54, 162, 235, 0.6)', // Blue for Principal
                                    'rgba(255, 99, 132, 0.6)', // Red for Dept. Head
                                    'rgba(75, 192, 192, 0.6)' // Green for Teacher
                                ]
                            }]
                        };

                        // New School Registration and Approval Bar Chart Data
                        const schoolBarData = {
                            labels: data.schoolNames, // Array of school names
                            datasets: [{
                                    label: 'Pending',
                                    data: data.schoolPending, // Array of pending counts per school
                                    backgroundColor: 'rgba(255, 99, 132, 0.6)',
                                    barThickness: 20
                                },
                                {
                                    label: 'Approved',
                                    data: data.schoolApproved, // Array of approved counts per school
                                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                                    barThickness: 20
                                }
                            ]
                        };

                        // Render the School Registration and Approval Bar Chart
                        new Chart(document.getElementById('schoolChart'), {
                            type: 'bar',
                            data: schoolBarData,
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        display: true,
                                        position: 'top'
                                    }
                                },
                                scales: {
                                    x: {
                                        title: {
                                            display: true,
                                            text: 'Schools'
                                        }
                                    },
                                    y: {
                                        title: {
                                            display: true,
                                            text: 'Count'
                                        },
                                        beginAtZero: true
                                    }
                                }
                            }
                        });

                        // Render the Bar Chart with Centered Colors
                        new Chart(document.getElementById('alumniChart'), {
                            type: 'bar',
                            data: barData,
                            options: {
                                responsive: true,
                                indexAxis: 'x', // Switch to horizontal if needed
                                plugins: {
                                    legend: {
                                        display: false // Optionally hide legend if not needed
                                    }
                                },
                                scales: {
                                    x: {
                                        title: {
                                            display: true,
                                            text: 'Category'
                                        },
                                        stacked: true
                                    },
                                    y: {
                                        title: {
                                            display: true,
                                            text: 'Count'
                                        },
                                        stacked: true // Stack bars to make them centered in each category
                                    }
                                }
                            }
                        });

                        // Render the Pie Chart for Admin Roles
                        new Chart(document.getElementById('adminPieChart'), {
                            type: 'pie',
                            data: pieData,
                            options: {
                                responsive: true,
                                plugins: {
                                    tooltip: {
                                        callbacks: {
                                            label: function(tooltipItem) {
                                                let label = tooltipItem.label || '';
                                                if (label) {
                                                    label += ': ';
                                                }
                                                label += tooltipItem.raw;
                                                return label;
                                            }
                                        }
                                    }
                                }
                            }
                        });

                        // Line Chart Data for Survey Responses by Date and Time
                        const surveyData = {
                            labels: data.surveyResponsesByMonth.map(item => item.date), // Get full date and time
                            datasets: [{
                                label: 'Surveys Created',
                                data: data.surveyResponsesByMonth.map(item => item.count), // Get survey count per date and time
                                borderColor: 'rgba(255, 159, 64, 1)', // Line color
                                backgroundColor: 'rgba(255, 159, 64, 0.2)', // Fill color under the line
                                fill: true,
                                tension: 0.4,
                                pointBackgroundColor: 'rgba(255, 159, 64, 1)',
                                pointBorderColor: '#fff',
                                pointBorderWidth: 2,
                                pointRadius: 5,
                            }]
                        };

                        // Render the Line Chart for Survey Responses by Date and Time
                        new Chart(document.getElementById('surveyLineChart'), {
                            type: 'line',
                            data: surveyData,
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        display: true,
                                        position: 'top'
                                    },
                                    tooltip: {
                                        callbacks: {
                                            label: function(tooltipItem) {
                                                return tooltipItem.label + ': ' + tooltipItem.raw + ' surveys';
                                            }
                                        }
                                    }
                                },
                                scales: {
                                    x: {
                                        title: {
                                            display: true,
                                            text: 'Date and Time'
                                        },
                                        ticks: {
                                            maxRotation: 90, // Rotate the labels if needed
                                            autoSkip: true
                                        }
                                    },
                                    y: {
                                        title: {
                                            display: true,
                                            text: 'Number of Surveys'
                                        },
                                        beginAtZero: true
                                    }
                                }
                            }
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