<?php
include '../connection/conn.php'; // Database connection
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
                    <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>DASHMIN</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="../template/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">Jhon Doe</h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="index.html" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Elements</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="button.html" class="dropdown-item">Buttons</a>
                            <a href="typography.html" class="dropdown-item">Typography</a>
                            <a href="element.html" class="dropdown-item">Other Elements</a>
                        </div>
                    </div>
                    <a href="widget.html" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Widgets</a>
                    <a href="form.html" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Forms</a>
                    <a href="table.html" class="nav-item nav-link active"><i class="fa fa-table me-2"></i>Tables</a>
                    <a href="chart.html" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Charts</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Pages</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="signin.html" class="dropdown-item">Sign In</a>
                            <a href="signup.html" class="dropdown-item">Sign Up</a>
                            <a href="404.html" class="dropdown-item">404 Error</a>
                            <a href="blank.html" class="dropdown-item">Blank Page</a>
                        </div>
                    </div>
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
                            <span class="d-none d-lg-inline-flex">Notificatin</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Profile updated</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">New user added</h6>
                                <small>15 minutes ago</small>
                            </a>
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
                            <a href="#" class="dropdown-item">My Profile</a>
                            <a href="#" class="dropdown-item">Settings</a>
                            <a href="#" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->


            <!-- Table Start -->
            <div class="container-fluid pt-4 px-4">
                    <div class="col-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Approved Response Table</h6>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Gender</th>
                                            <th scope="col">Age</th>
                                            <th scope="col">Degree</th>
                                            <th scope="col">Year Awarded</th>
                                            <th scope="col">Current Study</th>
                                            <th scope="col">No Job</th>
                                            <th scope="col">Job Details</th>
                                            <th scope="col">Pursue Reason</th>
                                            <th scope="col">Current Position</th>
                                            <th scope="col">Other Position</th>
                                            <th scope="col">Time of Work</th>
                                            <th scope="col">Time Gap</th>
                                            <th scope="col">Employment History</th>
                                            <th scope="col">Job Source Info.</th>
                                            <th scope="col">Other Job Info.</th>
                                            <th scope="col">Job Qualification</th>
                                            <th scope="col">Gross Salary</th>
                                            <th scope="col">Job Benefits</th>
                                            <th scope="col">Work Location</th>
                                            <th scope="col">Nuber of Employees</th>
                                            <th scope="col">Work Nature</th>
                                            <th scope="col">Other Work Nature</th>
                                            <th scope="col">Job Problem</th>
                                            <th scope="col">Problem Elaboration</th>
                                            <th scope="col">Self Employment Reason</th>
                                            <th scope="col">Knowledge Enhance</th>
                                            <th scope="col">Problem Solving</th>
                                            <th scope="col">Research Skills</th>
                                            <th scope="col">Learning Efficiency</th>
                                            <th scope="col">Communication Skills</th>
                                            <th scope="col">More Inclined</th>
                                            <th scope="col">Team Spirit</th>
                                            <th scope="col">Job Relevance</th>
                                            <th scope="col">Applied Course</th>
                                            <th scope="col">Possible Reasons</th>
                                            <th scope="col">Other Reasons</th>
                                            <th scope="col">Present Job</th>
                                            <th scope="col">Other Job</th>
                                            <th scope="col">Range Module</th>
                                            <th scope="col">Optional Module</th>
                                            <th scope="col">Relevance</th>
                                            <th scope="col">Workload</th>
                                            <th scope="col">Solving</th>
                                            <th scope="col">Learning</th>
                                            <th scope="col">Placement</th>
                                            <th scope="col">Environment</th>
                                            <th scope="col">Quality</th>
                                            <th scope="col">Job Satisfaction</th>
                                            <th scope="col">Job Stay</th>
                                            <th scope="col">Stay Other</th>
                                            <th scope="col">Date Submitted</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <?php
                                            $sql = "SELECT * FROM l_study_response WHERE status = 'approved' ORDER BY id DESC"; // Assuming you have an 'id' field for each user
                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {

                                                $count = 1;

                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<tr>";
                                                        echo "<td>" . $count . "</td>";
                                                        echo "<td>" . $row['name'] . "</td>";
                                                        echo "<td>" . $row['sex'] . "</td>";
                                                        echo "<td>" . $row['age'] . "</td>";
                                                        echo "<td>" . $row['degree'] . "</td>";
                                                        echo "<td>" . $row['year_awarded'] . "</td>";
                                                        echo "<td>" . $row['current_study'] . "</td>";
                                                        echo "<td>" . $row['if_no_jobs'] . "</td>";
                                                        echo "<td>" . $row['if_yes_details'] . "</td>";
                                                        echo "<td>" . $row['pursue_reasons'] . "</td>";
                                                        echo "<td>" . $row['current_position'] . "</td>";
                                                        echo "<td>" . $row['other_position'] . "</td>";
                                                        echo "<td>" . $row['time_to_job'] . "</td>";
                                                        echo "<td>" . $row['time_gap'] . "</td>";
                                                        echo "<td>" . $row['employment_history'] . "</td>";
                                                        echo "<td>" . $row['job_info_source'] . "</td>";
                                                        echo "<td>" . $row['other_job_info'] . "</td>";
                                                        echo "<td>" . $row['job_qualifications'] . "</td>";
                                                        echo "<td>" . $row['gross_salary'] . "</td>";
                                                        echo "<td>" . $row['job_benefits'] . "</td>";
                                                        echo "<td>" . $row['work_location'] . "</td>";
                                                        echo "<td>" . $row['num_employees'] . "</td>";
                                                        echo "<td>" . $row['work_nature'] . "</td>";
                                                        echo "<td>" . $row['other_work_nature_text'] . "</td>";
                                                        echo "<td>" . $row['job_problem'] . "</td>";
                                                        echo "<td>" . $row['problem_elaboration'] . "</td>";
                                                        echo "<td>" . $row['self_employed_reason'] . "</td>";
                                                        echo "<td>" . $row['knowledge_enhance'] . "</td>";
                                                        echo "<td>" . $row['problem_solving'] . "</td>";
                                                        echo "<td>" . $row['research_skills'] . "</td>";
                                                        echo "<td>" . $row['learning_efficiency'] . "</td>";
                                                        echo "<td>" . $row['communication_skills'] . "</td>";
                                                        echo "<td>" . $row['more_inclined'] . "</td>";
                                                        echo "<td>" . $row['team_spirit'] . "</td>";
                                                        echo "<td>" . $row['job_relevance'] . "</td>";
                                                        echo "<td>" . $row['applied_course'] . "</td>";
                                                        echo "<td>" . $row['possible_reasons'] . "</td>";
                                                        echo "<td>" . $row['other_reasons'] . "</td>";
                                                        echo "<td>" . $row['present_job'] . "</td>";
                                                        echo "<td>" . $row['other_job'] . "</td>";
                                                        echo "<td>" . $row['range_module'] . "</td>";
                                                        echo "<td>" . $row['optional_module'] . "</td>";
                                                        echo "<td>" . $row['relevance'] . "</td>";
                                                        echo "<td>" . $row['worlkload'] . "</td>";
                                                        echo "<td>" . $row['solving'] . "</td>";
                                                        echo "<td>" . $row['learning'] . "</td>";
                                                        echo "<td>" . $row['placement'] . "</td>";
                                                        echo "<td>" . $row['environment'] . "</td>";
                                                        echo "<td>" . $row['quality'] . "</td>";
                                                        echo "<td>" . $row['job_satisfaction'] . "</td>";
                                                        echo "<td>" . $row['job_stay'] . "</td>";
                                                        echo "<td>" . $row['stay_other_text'] . "</td>";
                                                        echo "<td>" . $row['created_at'] . "</td>";
                                                    echo "</tr>";

                                                    $count++;
                                                }
                                            } else {
                                                echo "<tr><td colspan='53' class='text-center text-danger'>No results found</td></tr>";
                                            }
                                            $conn->close();

                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                
            </div>
            <!-- Table End -->


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
</body>

</html>