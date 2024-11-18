<?php
session_start();
include("../connection/conn.php");

// Assuming $conn is your database connection and $user_id is defined
$user_id = $_GET['id'];  // Or use a different way to get the user_id

// Query to fetch user data by ID
$userQuery = "SELECT * FROM l_study_response WHERE id = '$user_id' AND status = 'pending'";
$userResult = mysqli_query($conn, $userQuery);

if ($userResult && mysqli_num_rows($userResult) > 0) {
    $userData = mysqli_fetch_assoc($userResult);
} else {
    echo "User not found.";
    exit;
}
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
                    <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>DASHMIN</h3>
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
                    <a href="admin_alumni_directory.php" class="nav-item nav-link active"><i class="fa fa-address-book me-2"></i>Alumni Directory</a>
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
                <div class="bg-light rounded p-4" style="width:fit-content">
                    <h3 class="mb-4">A Tracer Study of the BSIT Graduates-Southern Leyte State University from School Years 2015-2018</h3>
                    <form method="POST" enctype="multipart/form-data">


                        <!-- 0. Choose School -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <label for="choose_school" class="form-label">Choose School: </label>
                                <select name="choose_school" id="choose_school" class="form-control" required>
                                    <option selected disabled hidden>Choose a School for Submission</option>
                                    <?php
                                    $schoolsQuery = "SELECT * FROM e_schools WHERE confirm_status = 'Approved'";
                                    $schoolsResult = mysqli_query($conn, $schoolsQuery);

                                    if ($schoolsResult) {
                                        while ($schoolRow = mysqli_fetch_assoc($schoolsResult)) {
                                            $selected = ($schoolRow['school_name'] == $userData['choose_school']) ? 'selected' : '';
                                            echo '<option value="' . htmlspecialchars($schoolRow['school_name']) . '" ' . $selected . '>' . htmlspecialchars($schoolRow['school_name']) . '</option>';
                                        }
                                    } else {
                                        echo '<option disabled>No schools available</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <!-- 1. Name -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <label for="name" class="form-label">1. Name:</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($userData['name']); ?>" required>
                            </div>
                        </div>

                        <!-- 2. Sex -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <label class="form-label">2. Sex:</label><br>
                                <input type="checkbox" id="male" name="sex[]" value="Male" <?php if ($userData['sex'] == 'Male') echo 'checked'; ?>>
                                <label for="male">Male</label><br>
                                <input type="checkbox" id="female" name="sex[]" value="Female" <?php if ($userData['sex'] == 'Female') echo 'checked'; ?>>
                                <label for="female">Female</label>
                            </div>
                        </div>

                        <!-- 3. Age -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <label for="age" class="form-label">3. Age:</label>
                                <input type="number" class="form-control" id="age" name="age" value="<?php echo htmlspecialchars($userData['age']); ?>" required>
                            </div>
                        </div>

                        <!-- 4. Degree Title -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <label for="degree" class="form-label">4. Title (with major) of degree received at SLSU-TO:</label>
                                <input type="text" class="form-control" id="degree" name="degree" value="<?php echo htmlspecialchars($userData['degree']); ?>" required>
                            </div>
                        </div>

                        <!-- 5. Year Awarded Degree -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <label for="year_awarded" class="form-label">5. Year awarded degree:</label>
                                <input type="text" class="form-control" id="year_awarded" name="year_awarded" value="<?php echo htmlspecialchars($userData['year_awarded']); ?>" required>
                            </div>
                        </div>

                        <!-- 6. Are you currently taking studies? -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <label class="form-label">6. Are you currently taking studies? (e.g. Masters of Science in Information Technology)</label><br>
                                <input type="checkbox" id="yes_study" name="current_study[]" value="Yes" <?php if ($userData['current_study'] == 'Yes') echo 'checked'; ?>>
                                <label for="yes_study">Yes</label><br>
                                <input type="checkbox" id="no_study" name="current_study[]" value="No" <?php if ($userData['current_study'] == 'No') echo 'checked'; ?>>
                                <label for="no_study">No</label>
                            </div>
                        </div>
                        <!-- 7. If No, Job Contemplation -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <label for="if_no_jobs" class="form-label">7. If No, What type of jobs were you contemplating by choosing your degree from SLSU-TO?</label>
                                <input type="text" class="form-control" id="if_no_jobs" name="if_no_jobs" value="<?php echo htmlspecialchars($userData['if_no_jobs']); ?>">
                            </div>
                        </div>

                       <!-- 8. If YES, Details -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <label for="if_yes_details" class="form-label">8. If YES, please give details as follows: Title of Programme (in full), Institution(s), Period Enrolled (from-to), Attendance Full Time/Part Time/Correspondence and Distance Education, Source of Funding</label>
                                <textarea class="form-control" id="if_yes_details" name="if_yes_details"><?php echo htmlspecialchars($userData['if_yes_details'] ?? 'None'); ?></textarea>
                            </div>
                        </div>


                        <!-- 9. Reasons for Pursuing Further Studies -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <label for="pursue_reasons" class="form-label">9. Main reasons for pursuing further studies:</label>
                                <textarea class="form-control" id="pursue_reasons" name="pursue_reasons"><?php echo htmlspecialchars($userData['pursue_reasons']); ?></textarea>
                            </div>
                        </div>

                        <!-- 10. Current Paid Work Position -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <label class="form-label">10. Which one of the following best describes your current position with regard to paid work?</label><br>
                                <?php
                                $current_positions = explode(',', $userData['current_position']);
                                ?>
                                <input type="checkbox" name="current_position[]" value="Working full-time" <?php if (in_array('Working full-time', $current_positions)) echo 'checked'; ?>>
                                <label>Working full-time</label><br>
                                <input type="checkbox" name="current_position[]" value="Working part-time but seeking full-time work" <?php if (in_array('Working part-time but seeking full-time work', $current_positions)) echo 'checked'; ?>>
                                <label>Working part-time but seeking full-time work</label><br>
                                <input type="checkbox" name="current_position[]" value="Self-employed" <?php if (in_array('Self-employed', $current_positions)) echo 'checked'; ?>>
                                <label>Self-employed</label><br>
                                <input type="checkbox" name="current_position[]" value="Not working and looking for a job" <?php if (in_array('Not working and looking for a job', $current_positions)) echo 'checked'; ?>>
                                <label>Not working and looking for a job</label><br>
                                <input type="checkbox" name="current_position[]" value="Not working and unavailable for paid work" <?php if (in_array('Not working and unavailable for paid work', $current_positions)) echo 'checked'; ?>>
                                <label>Not working and unavailable for paid work</label><br>
                                <input type="checkbox" name="current_position[]" value="Others:" <?php if (in_array('Others:', $current_positions)) echo 'checked'; ?>>
                                <label>Others:</label>
                                <input type="text" class="form-control" name="other_position[]" value="<?php echo htmlspecialchars($userData['other_position']); ?>">
                            </div>
                        </div>

                        <!-- 11. Time to Find a Job -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <label for="time_to_job" class="form-label">11. How long did you work in your first job after obtaining your degree?</label><br>
                                <?php
                                $time_to_job = explode(',', $userData['time_to_job']);
                                ?>
                                <input type="checkbox" name="time_to_job[]" value="0 to 6 months" <?php if (in_array('0 to 6 months', $time_to_job)) echo 'checked'; ?>>
                                <label>0 to 6 months</label><br>
                                <input type="checkbox" name="time_to_job[]" value="7 months to 1 year" <?php if (in_array('7 months to 1 year', $time_to_job)) echo 'checked'; ?>>
                                <label>7 months to 1 year</label><br>
                                <input type="checkbox" name="time_to_job[]" value="1 to 3 years" <?php if (in_array('1 to 3 years', $time_to_job)) echo 'checked'; ?>>
                                <label>1 to 3 years</label><br>
                                <input type="checkbox" name="time_to_job[]" value="3 to 5 years" <?php if (in_array('3 to 5 years', $time_to_job)) echo 'checked'; ?>>
                                <label>3 to 5 years</label><br>
                                <input type="checkbox" name="time_to_job[]" value="Over 5 years" <?php if (in_array('Over 5 years', $time_to_job)) echo 'checked'; ?>>
                                <label>Over 5 years</label><br>
                            </div>
                        </div>

                        <!-- 12. Time Gap Between Degree and Employment -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <label for="time_gap" class="form-label">12. Please give reasons for any time gap between obtaining your degree and your first employment:</label>
                                <textarea class="form-control" id="time_gap" name="time_gap"><?php echo htmlspecialchars($userData['time_gap']); ?></textarea>
                            </div>
                        </div>

                        <!-- 13. Employment History -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <label for="employment_history" class="form-label">13. Employment history (since obtaining first degree up to present employment): (Name of Employer, If self-employed, please state area of activity, Period employed (From-To), Post held, Reasons for leaving job (where applicable)</label>
                                <textarea class="form-control" id="employment_history" name="employment_history"><?php echo htmlspecialchars($userData['employment_history']); ?></textarea>
                            </div>
                        </div>

                        <!-- 14. How did you come to know about your current job? -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <label class="form-label">14. How did you come to know about your current job?</label><br>
                                <?php
                                $job_info_source = explode(',', $userData['job_info_source']);
                                ?>
                                <input type="checkbox" name="job_info_source[]" value="Through friends" <?php if (in_array('Through friends', $job_info_source)) echo 'checked'; ?>>
                                <label>Through friends</label><br>
                                <input type="checkbox" name="job_info_source[]" value="Through relatives" <?php if (in_array('Through relatives', $job_info_source)) echo 'checked'; ?>>
                                <label>Through relatives</label><br>
                                <input type="checkbox" name="job_info_source[]" value="Through written enquiries" <?php if (in_array('Through written enquiries', $job_info_source)) echo 'checked'; ?>>
                                <label>Through written enquiries</label><br>
                                <input type="checkbox" name="job_info_source[]" value="Press advertisement" <?php if (in_array('Press advertisement', $job_info_source)) echo 'checked'; ?>>
                                <label>Press advertisement</label><br>
                                <input type="checkbox" name="job_info_source[]" value="Others:" <?php if (in_array('Others:', $job_info_source)) echo 'checked'; ?>>
                                <label>Others:</label>
                                <input type="text" class="form-control" name="other_job_info[]" value="<?php echo htmlspecialchars($userData['other_job_info']); ?>">
                            </div>
                        </div>

                        <!-- 15. Qualifications and other attributes required for the job -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <label for="job_qualifications" class="form-label">15. Qualifications and other attributes required for the job:</label>
                                <textarea class="form-control" id="job_qualifications" name="job_qualifications"><?php echo htmlspecialchars($userData['job_qualifications']); ?></textarea>
                            </div>
                        </div>

                        <!-- 16. Gross monthly salary -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <label for="gross_salary" class="form-label">16. Gross monthly salary:</label>
                                <input type="text" class="form-control" id="gross_salary" name="gross_salary" value="<?php echo htmlspecialchars($userData['gross_salary']); ?>">
                            </div>
                        </div>

                        <!-- 17. Other benefits attached to the job -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <label for="job_benefits" class="form-label">17. Please list any other benefits attached to the job:</label>
                                <textarea class="form-control" id="job_benefits" name="job_benefits"><?php echo htmlspecialchars($userData['job_benefits']); ?></textarea>
                            </div>
                        </div>

                        <!-- 18. Location of place of work -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <label for="work_location" class="form-label">18. Location of place of work:</label>
                                <input type="text" class="form-control" id="work_location" name="work_location" value="<?php echo htmlspecialchars($userData['work_location']); ?>">
                            </div>
                        </div>

                        <!-- 19. Number of employees -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <label class="form-label">19. Number of employees (approximately):</label><br>
                                <?php
                                $num_employees = explode(',', $userData['num_employees']);
                                ?>
                                <input type="checkbox" name="num_employees[]" value="Less than 10" <?php if (in_array('Less than 10', $num_employees)) echo 'checked'; ?>>
                                <label>Less than 10</label><br>
                                <input type="checkbox" name="num_employees[]" value="11 to 50" <?php if (in_array('11 to 50', $num_employees)) echo 'checked'; ?>>
                                <label>11 to 50</label><br>
                                <input type="checkbox" name="num_employees[]" value="51 to 200" <?php if (in_array('51 to 200', $num_employees)) echo 'checked'; ?>>
                                <label>51 to 200</label><br>
                                <input type="checkbox" name="num_employees[]" value="Over 200" <?php if (in_array('Over 200', $num_employees)) echo 'checked'; ?>>
                                <label>Over 200</label>
                            </div>
                        </div>

                        <!-- 20. Nature of work performed -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <label for="work_nature" class="form-label">20. Nature of work performed:</label><br>
                                <?php
                                $work_nature = explode(',', $userData['work_nature']);
                                ?>
                                <input type="checkbox" id="managerial" name="work_nature[]" value="Managerial" <?php if (in_array('Managerial', $work_nature)) echo 'checked'; ?>>
                                <label for="managerial">Managerial</label><br>
                                <input type="checkbox" id="clerical" name="work_nature[]" value="Clerical" <?php if (in_array('Clerical', $work_nature)) echo 'checked'; ?>>
                                <label for="clerical">Clerical</label><br>
                                <input type="checkbox" id="supervisory" name="work_nature[]" value="Supervisory" <?php if (in_array('Supervisory', $work_nature)) echo 'checked'; ?>>
                                <label for="supervisory">Supervisory</label><br>
                                <input type="checkbox" id="support" name="work_nature[]" value="Support Service" <?php if (in_array('Support Service', $work_nature)) echo 'checked'; ?>>
                                <label for="support">Support Service</label><br>
                                <input type="checkbox" id="other_work_nature" name="work_nature[]" value="Other:" <?php if (in_array('Other:', $work_nature)) echo 'checked'; ?>>
                                <label for="other_work_nature">Other:</label>
                                <input type="text" class="form-control" id="other_work_nature_text" name="other_work_nature_text[]" value="<?php echo htmlspecialchars($userData['other_work_nature_text']); ?>">
                            </div>
                        </div>

                        <!-- 21. Proof of Work Duration -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <label for="proof_image" class="form-label">21. Upload proof of work (Ex. Company ID):</label>
                                <input type="file" class="form-control" id="proof_image" name="proof_image" accept="image/*">
                                <small class="form-text text-muted">Accepted formats: JPG, JPEG, PNG, GIF. Max size: 5MB.</small>
                            </div>
                        </div>

                        <!-- 22. Do you face any major problem in your job assignments? -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <label class="form-label">22. Do you face any major problem in your job assignments?</label><br>
                                <?php
                                $job_problems = explode(',', $userData['job_problem']);
                                ?>
                                <input type="checkbox" id="job_problem_yes" name="job_problem[]" value="Yes" <?php if (in_array('Yes', $job_problems)) echo 'checked'; ?>>
                                <label for="job_problem_yes">Yes</label><br>
                                <input type="checkbox" id="job_problem_no" name="job_problem[]" value="No" <?php if (in_array('No', $job_problems)) echo 'checked'; ?>>
                                <label for="job_problem_no">No</label>
                            </div>
                        </div>

                        <!-- 23. If yes, please elaborate -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <label for="problem_elaboration" class="form-label">23. If yes, please elaborate:</label>
                                <textarea class="form-control" id="problem_elaboration" name="problem_elaboration"><?php echo htmlspecialchars($userData['problem_elaboration']); ?></textarea>
                            </div>
                        </div>

                        <!-- 24. If you are self-employed, what made you decide to become self-employed? -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <label for="self_employed_reason" class="form-label">24. If you are self-employed, what made you decide to become self-employed?</label>
                                <textarea class="form-control" id="self_employed_reason" name="self_employed_reason"><?php echo htmlspecialchars($userData['self_employed_reason']); ?></textarea>
                            </div>
                        </div>

                        <!-- 25. Contribution of SLSU program to personal knowledge, skills, and attitudes -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <label class="form-label">25. How would you rate the contribution of your programme of study at SLSU-TO to your personal knowledge, skills and attitudes? (Tick as appropriate)</label>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Attribute</th>
                                            <th>Very much</th>
                                            <th>Much</th>
                                            <th>A little</th>
                                            <th>Not at all</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $attributes = [
                                            'knowledge_enhance',
                                            'problem_solving',
                                            'research_skills',
                                            'learning_efficiency',
                                            'communication_skills',
                                            'more_inclined',
                                            'team_spirit'
                                        ];

                                        foreach ($attributes as $attribute) {
                                            $rating = explode(',', $userData[strtolower(str_replace(' ', '_', $attribute))]);
                                            echo "<tr>
                        <td>$attribute</td>
                        <td><input type='checkbox' name='" . strtolower(str_replace(' ', '_', $attribute)) . "' value='Very much' " . (in_array('Very much', $rating) ? 'checked' : '') . "></td>
                        <td><input type='checkbox' name='" . strtolower(str_replace(' ', '_', $attribute)) . "' value='Much' " . (in_array('Much', $rating) ? 'checked' : '') . "></td>
                        <td><input type='checkbox' name='" . strtolower(str_replace(' ', '_', $attribute)) . "' value='A little' " . (in_array('A little', $rating) ? 'checked' : '') . "></td>
                        <td><input type='checkbox' name='" . strtolower(str_replace(' ', '_', $attribute)) . "' value='Not at all' " . (in_array('Not at all', $rating) ? 'checked' : '') . "></td>
                    </tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- 26. Relevance of program to current job -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <label class="form-label">26. Was your program of study at SLSU relevant to your present job?</label><br>
                                <?php
                                $job_relevance = explode(',', $userData['job_relevance']);
                                ?>
                                <input type="checkbox" id="relevance_very_much" name="job_relevance[]" value="Very much" <?php if (in_array('Very much', $job_relevance)) echo 'checked'; ?>>
                                <label for="relevance_very_much">Very much</label><br>
                                <input type="checkbox" id="relevance_much" name="job_relevance[]" value="Much" <?php if (in_array('Much', $job_relevance)) echo 'checked'; ?>>
                                <label for="relevance_much">Much</label><br>
                                <input type="checkbox" id="relevance_little" name="job_relevance[]" value="A little" <?php if (in_array('A little', $job_relevance)) echo 'checked'; ?>>
                                <label for="relevance_little">A little</label><br>
                                <input type="checkbox" id="relevance_not" name="job_relevance[]" value="Not at all" <?php if (in_array('Not at all', $job_relevance)) echo 'checked'; ?>>
                                <label for="relevance_not">Not at all</label>
                            </div>
                        </div>

                        <!-- 27. Have you tried applying for a position relevant to your course? -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <label class="form-label">27. Have you tried applying for a position relevant to your course?</label><br>
                                <?php
                                $applied_course = explode(',', $userData['applied_course']);
                                ?>
                                <input type="checkbox" id="applied_yes" name="applied_course[]" value="Yes" <?php if (in_array('Yes', $applied_course)) echo 'checked'; ?>>
                                <label for="applied_yes">Yes</label><br>
                                <input type="checkbox" id="applied_no" name="applied_course[]" value="No" <?php if (in_array('No', $applied_course)) echo 'checked'; ?>>
                                <label for="applied_no">No</label>
                            </div>
                        </div>

                        <!-- 28. If yes, reasons for not being hired -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <label class="form-label">28. If yes, what are the possible reasons why you're not hired?</label><br>
                                <?php
                                $possible_reasons = explode(',', $userData['possible_reasons']);
                                ?>
                                <input type="checkbox" name="possible_reasons[]" value="I am not qualified for the job" <?php if (in_array('I am not qualified for the job', $possible_reasons)) echo 'checked'; ?>>
                                <label>I am not qualified for the job.</label><br>
                                <input type="checkbox" name="possible_reasons[]" value="I did not pass the employment exams" <?php if (in_array('I did not pass the employment exams', $possible_reasons)) echo 'checked'; ?>>
                                <label>I did not pass the employment exams.</label><br>
                                <input type="checkbox" name="possible_reasons[]" value="I did not pass the interview" <?php if (in_array('I did not pass the interview', $possible_reasons)) echo 'checked'; ?>>
                                <label>I did not pass the interview.</label><br>
                                <input type="checkbox" name="possible_reasons[]" value="I lack the necessary competencies for the job" <?php if (in_array('I lack the necessary competencies for the job', $possible_reasons)) echo 'checked'; ?>>
                                <label>I lack the necessary competencies for the job.</label><br>
                                <input type="checkbox" name="possible_reasons[]" value="I did not pass the medical exams" <?php if (in_array('I did not pass the medical exams', $possible_reasons)) echo 'checked'; ?>>
                                <label>I did not pass the medical exams.</label><br>
                                <input type="checkbox" name="possible_reasons[]" value="There are skills necessary for the job" <?php if (in_array('There are skills necessary for the job', $possible_reasons)) echo 'checked'; ?>>
                                <label>There are skills necessary for the job.</label><br>
                                <input type="checkbox" name="possible_reasons[]" value="Other reasons please specify:" <?php if (in_array('Other reasons please specify:', $possible_reasons)) echo 'checked'; ?>>
                                <label>Other reasons please specify:</label><br>
                                <input type="text" class="form-control" name="other_reasons[]" value="<?php echo htmlspecialchars($userData['other_reasons']); ?>">
                            </div>
                        </div>

                        <!-- 29. If no, reasons for not applying -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <label class="form-label">29. If no, why?</label><br>
                                <?php
                                $not_applying_reasons = explode(',', $userData['present_job']);
                                ?>
                                <input type="checkbox" name="present_job[]" value="I do not think I have the necessary skills for jobs related to my course" <?php if (in_array('I do not think I have the necessary skills for jobs related to my course', $not_applying_reasons)) echo 'checked'; ?>>
                                <label>I do not think I have the necessary skills for jobs related to my course.</label><br>
                                <input type="checkbox" name="present_job[]" value="The jobs available are low-paying" <?php if (in_array('The jobs available are low-paying', $not_applying_reasons)) echo 'checked'; ?>>
                                <label>The jobs available are low-paying.</label><br>
                                <input type="checkbox" name="present_job[]" value="There are no jobs available in my field of specialization" <?php if (in_array('There are no jobs available in my field of specialization', $not_applying_reasons)) echo 'checked'; ?>>
                                <label>There are no jobs available in my field of specialization.</label><br>
                                <input type="checkbox" name="present_job[]" value="There are no job openings within the vicinity of my residence in my field of specialization" <?php if (in_array('There are no job openings within the vicinity of my residence in my field of specialization', $not_applying_reasons)) echo 'checked'; ?>>
                                <label>There are no job openings within the vicinity of my residence in my field of specialization.</label><br>
                                <input type="checkbox" name="present_job[]" value="I have no interest in getting a job related to my field of specialization" <?php if (in_array('I have no interest in getting a job related to my field of specialization', $not_applying_reasons)) echo 'checked'; ?>>
                                <label>I have no interest in getting a job related to my field of specialization.</label><br>
                                <input type="checkbox" name="present_job[]" value="Other reasons please specify:" <?php if (in_array('Other reasons please specify:', $not_applying_reasons)) echo 'checked'; ?>>
                                <label>Other reasons please specify:</label><br>
                                <input type="text" class="form-control" name="other_job" value="<?php echo htmlspecialchars($userData['other_job']); ?>">
                            </div>
                        </div>

                        <!-- 30. Major strengths and weaknesses of the SLSU program -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <label for="program_strengths_weaknesses" class="form-label">30. Which of the following best represent major strengths and weaknesses of the SLSU-TO programme that you attended? (Check as appropriate)</label>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Attribute</th>
                                            <th>Strength</th>
                                            <th>Weakness</th>
                                            <th>Does not apply</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $attributes = [
                                            'range_module',
                                            'optional_module',
                                            'relevance',
                                            'worlkload',
                                            'solving',
                                            'learning',
                                            'placement',
                                            'environment',
                                            'quality'
                                        ];

                                        foreach ($attributes as $attribute) {
                                            $attribute_key = strtolower(str_replace(' ', '_', $attribute));
                                            $strengths_weaknesses = explode(',', $userData[$attribute_key]);
                                            echo "<tr>
                        <td>$attribute</td>
                        <td><input type='checkbox' name='{$attribute_key}[]' value='Strength' " . (in_array('Strength', $strengths_weaknesses) ? 'checked' : '') . "></td>
                        <td><input type='checkbox' name='{$attribute_key}[]' value='Weakness' " . (in_array('Weakness', $strengths_weaknesses) ? 'checked' : '') . "></td>
                        <td><input type='checkbox' name='{$attribute_key}[]' value='Does not apply' " . (in_array('Does not apply', $strengths_weaknesses) ? 'checked' : '') . "></td>
                    </tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- 31. Satisfaction with current job -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <label class="form-label">31. How satisfied are you with your current job?</label><br>
                                <?php
                                $job_satisfaction = explode(',', $userData['job_satisfaction']);
                                ?>
                                <input type="checkbox" id="satisfaction_very_much" name="job_satisfaction[]" value="Very much" <?php if (in_array('Very much', $job_satisfaction)) echo 'checked'; ?>>
                                <label for="satisfaction_very_much">Very much</label><br>
                                <input type="checkbox" id="satisfaction_much" name="job_satisfaction[]" value="Much" <?php if (in_array('Much', $job_satisfaction)) echo 'checked'; ?>>
                                <label for="satisfaction_much">Much</label><br>
                                <input type="checkbox" id="satisfaction_little" name="job_satisfaction[]" value="A little" <?php if (in_array('A little', $job_satisfaction)) echo 'checked'; ?>>
                                <label for="satisfaction_little">A little</label><br>
                                <input type="checkbox" id="satisfaction_not" name="job_satisfaction[]" value="Not at all" <?php if (in_array('Not at all', $job_satisfaction)) echo 'checked'; ?>>
                                <label for="satisfaction_not">Not at all</label>
                            </div>
                        </div>

                        <!-- 32. Do you intend to stay in the same job/profession? -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <label class="form-label">32. Do you intend to stay in the same job/profession?</label><br>
                                <?php
                                $job_stay = explode(',', $userData['job_stay']);
                                ?>
                                <input type="checkbox" id="stay_yes" name="job_stay[]" value="Yes" <?php if (in_array('Yes', $job_stay)) echo 'checked'; ?>>
                                <label for="stay_yes">Yes</label><br>
                                <input type="checkbox" id="stay_no" name="job_stay[]" value="No" <?php if (in_array('No', $job_stay)) echo 'checked'; ?>>
                                <label for="stay_no">No</label><br>
                                <input type="checkbox" id="stay_other" name="job_stay[]" value="Other:" <?php if (in_array('Other:', $job_stay)) echo 'checked'; ?>>
                                <label for="stay_other">Others:</label>
                                <input type="text" class="form-control" id="stay_other_text" name="stay_other_text" value="<?php echo htmlspecialchars($userData['stay_other_text']); ?>">
                            </div>
                        </div>


                        <!-- status -->
                        <input type="hidden" id="status" name="status" value="pending">

                       <!-- Back Button -->
                        <a href="admin_alumni_directory.php" class="btn btn-primary">Back</a>


                    </form>
                </div>
            </div>




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