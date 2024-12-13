<?php
session_start();
include("../connection/conn.php");
date_default_timezone_set('Asia/Manila');

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

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = mysqli_real_escape_string($conn, $_POST['id']);
    $name = encryptData($_POST['name']);
    $sex = isset($_POST['sex']) ? encryptData($_POST['sex']) : null;
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $degree = encryptData($_POST['degree']);
    $year_awarded = mysqli_real_escape_string($conn, $_POST['year_awarded']);
    $current_study = isset($_POST['current_study']) ? encryptData($_POST['current_study']) : null;
    $if_no_jobs = isset($_POST['if_no_jobs']) ? encryptData($_POST['if_no_jobs']) : null;
    $if_yes_details = isset($_POST['if_yes_details']) ? encryptData($_POST['if_yes_details']) : null;
    $pursue_reasons = isset($_POST['pursue_reasons']) ? encryptData($_POST['pursue_reasons']) : null;
    $current_position = isset($_POST['current_position']) ? encryptData($_POST['current_position'][0]) : null;
    $other_position = isset($_POST['other_position']) ? encryptData($_POST['other_position'][0]) : null;

    // New fields
    $time_to_job = isset($_POST['time_to_job']) ? encryptData($_POST['time_to_job'][0]) : null;
    $time_gap = isset($_POST['time_gap']) ? encryptData($_POST['time_gap']) : null;
    $employment_history = isset($_POST['employment_history']) ? encryptData($_POST['employment_history']) : null;
    $job_info_source = isset($_POST['job_info_source']) ? encryptData($_POST['job_info_source'][0]) : null;
    $other_job_info = isset($_POST['other_job_info']) ? encryptData($_POST['other_job_info'][0]) : null;
    $job_qualifications = isset($_POST['job_qualifications']) ? encryptData($_POST['job_qualifications']) : null;
    $gross_salary = mysqli_real_escape_string($conn, $_POST['gross_salary']);
    $job_benefits = isset($_POST['job_benefits']) ? encryptData($_POST['job_benefits']) : null;
    $work_location = isset($_POST['work_location']) ? encryptData($_POST['work_location']) : null;
    $num_employees = isset($_POST['num_employees']) ? encryptData($_POST['num_employees'][0]) : null;
    $work_nature = isset($_POST['work_nature']) ? encryptData($_POST['work_nature'][0]) : null;
    $other_work_nature_text = isset($_POST['other_work_nature_text']) ? encryptData($_POST['other_work_nature_text'][0]) : null;
    $proof_image = isset($_POST['proof_image']) ? $_POST['proof_image'] : null;

    // New fields from questions 22-27
    $job_problem = isset($_POST['job_problem']) ? encryptData($_POST['job_problem'][0]) : null;
    $problem_elaboration = isset($_POST['problem_elaboration']) ? encryptData($_POST['problem_elaboration']) : null;
    $self_employed_reason = isset($_POST['self_employed_reason']) ? encryptData($_POST['self_employed_reason']) : null;
    $knowledge_enhance = isset($_POST['knowledge_enhance']) ? encryptData($_POST['knowledge_enhance']) : null;
    $problem_solving = isset($_POST['problem_solving']) ? encryptData($_POST['problem_solving']) : null;
    $research_skills = isset($_POST['research_skills']) ? encryptData($_POST['research_skills']) : null;
    $learning_efficiency = isset($_POST['learning_efficiency']) ? encryptData($_POST['learning_efficiency']) : null;
    $communication_skills = isset($_POST['communication_skills']) ? encryptData($_POST['communication_skills']) : null;
    $more_inclined = isset($_POST['more_inclined']) ? encryptData($_POST['more_inclined']) : null;
    $team_spirit = isset($_POST['team_spirit']) ? encryptData($_POST['team_spirit']) : null;
    $job_relevance = isset($_POST['job_relevance']) ? encryptData($_POST['job_relevance'][0]) : null;

    // New fields 27-29
    $applied_course = isset($_POST['applied_course']) ? encryptData($_POST['applied_course'][0]) : null;
    $possible_reasons = isset($_POST['possible_reasons']) ? encryptData($_POST['possible_reasons'][0]) : null;
    $other_reasons = isset($_POST['other_reasons']) ? encryptData($_POST['other_reasons'][0]) : null;
    $present_job = isset($_POST['present_job']) ? encryptData($_POST['present_job'][0]) : null;
    $other_job = isset($_POST['other_job']) ? encryptData($_POST['other_job'][0]) : null;

    // New fields 30-31
    $range_module = isset($_POST['range_module']) ? encryptData($_POST['range_module']) : null;
    $optional_module = isset($_POST['optional_module']) ? encryptData($_POST['optional_module']) : null;
    $relevance = isset($_POST['relevance']) ? encryptData($_POST['relevance']) : null;
    $worlkload = isset($_POST['worlkload']) ? encryptData($_POST['worlkload']) : null;
    $solving = isset($_POST['solving']) ? encryptData($_POST['solving']) : null;
    $learning = isset($_POST['learning']) ? encryptData($_POST['learning']) : null;
    $placement = isset($_POST['placement']) ? encryptData($_POST['placement']) : null;
    $environment = isset($_POST['environment']) ? encryptData($_POST['environment']) : null;
    $quality = isset($_POST['quality']) ? encryptData($_POST['quality']) : null;
    $job_satisfaction = isset($_POST['job_satisfaction']) ? encryptData($_POST['job_satisfaction']) : null;

    // New fields for question 32
    $job_stay = isset($_POST['job_stay']) ? encryptData($_POST['job_stay']) : null;
    $stay_other_text = isset($_POST['stay_other_text']) ? encryptData($_POST['stay_other_text']) : null;

    // Update query with new fields
    $updateQuery = "
        UPDATE l_study_response SET 
            name = '$name',
            sex = '$sex',
            age = '$age',
            degree = '$degree',
            year_awarded = '$year_awarded',
            current_study = '$current_study',
            if_no_jobs = '$if_no_jobs',
            if_yes_details = '$if_yes_details',
            pursue_reasons = '$pursue_reasons',
            current_position = '$current_position',
            other_position = '$other_position',
            time_to_job = '$time_to_job',
            time_gap = '$time_gap',
            employment_history = '$employment_history',
            job_info_source = '$job_info_source',
            other_job_info = '$other_job_info',
            job_qualifications = '$job_qualifications',
            gross_salary = '$gross_salary',
            job_benefits = '$job_benefits',
            work_location = '$work_location',
            num_employees = '$num_employees',
            work_nature = '$work_nature',
            other_work_nature_text = '$other_work_nature_text',
            proof_image = '$proof_image',
            job_problem = '$job_problem',
            problem_elaboration = '$problem_elaboration',
            self_employed_reason = '$self_employed_reason',
            knowledge_enhance = '$knowledge_enhance',
            problem_solving = '$problem_solving',
            research_skills = '$research_skills',
            learning_efficiency = '$learning_efficiency',
            communication_skills = '$communication_skills',
            more_inclined = '$more_inclined',
            team_spirit = '$team_spirit',
            job_relevance = '$job_relevance',
            applied_course = '$applied_course',
            possible_reasons = '$possible_reasons',
            other_reasons = '$other_reasons',
            present_job = '$present_job',
            other_job = '$other_job',
            range_module = '$range_module',
            optional_module = '$optional_module',
            relevance = '$relevance',
            worlkload = '$worlkload',
            solving = '$solving',
            learning = '$learning',
            placement = '$placement',
            environment = '$environment',
            quality = '$quality',
            job_satisfaction = '$job_satisfaction',
            job_stay = '$job_stay'
        WHERE id = '$user_id'
    ";

    if (mysqli_query($conn, $updateQuery)) {
        echo "User data updated successfully.";
        // Optionally redirect to another page
        // header("Location: user_list.php");
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}


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
                    <a href="admin_alumni_information.php" class="nav-item nav-link active"><i class="fa fa-info-circle me-2"></i>Alumni Info</a>
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
                    <input type="hidden" name="id" value="<?php echo $user_id; ?>">

                          <!-- 1. Name -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label for="name" class="form-label">1. Name:</label>
                            <input type="text" class="form-control" id="name" name="name" value = "<?php echo decryptData($userData['name']) ?>" required>
                        </div>
                    </div>

                   <!-- 2. Sex -->
                   <div class="card mb-3">
                        <div class="card-body">
                            <label class="form-label">2. Sex:</label><br>
                            <?php 
                                // Decrypt the stored sex value from the database
                                $selectedSex = decryptData($userData['sex']); 
                            ?>
                            <input type="radio" id="male" name="sex" value="Male" <?php echo ($selectedSex === 'Male') ? 'checked' : ''; ?>>
                            <label for="male">Male</label><br>

                            <input type="radio" id="female" name="sex" value="Female" <?php echo ($selectedSex === 'Female') ? 'checked' : ''; ?>>
                            <label for="female">Female</label>
                        </div>
                    </div>




                    <!-- 3. Age -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label for="age" class="form-label">3. Age:</label>
                            <input type="number" class="form-control" id="age" name="age" value = "<?php echo $userData['age'] ?>" required>
                        </div>
                    </div>

                    <!-- 4. Degree Title -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label for="degree" class="form-label">4. Title (with major) of degree received at SLSU-TO:</label>
                            <input type="text" class="form-control" id="degree" name="degree" value = "<?php echo decryptData($userData['degree']) ?>" required>
                        </div>
                    </div>

                    <!-- 5. Year Awarded Degree -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label for="year_awarded" class="form-label">5. Year awarded degree:</label>
                            <input type="text" class="form-control" id="year_awarded" name="year_awarded" value = "<?php echo $userData['year_awarded'] ?>" required>
                        </div>
                    </div>

                    <!-- 6. Are you currently taking studies? -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label class="form-label">6. Are you currently taking studies? (e.g. Masters of Science in Information Technology)</label><br>
                            <?php 
                                $selectedStudy = decryptData($userData['current_study']); // Assuming the value is stored in $userData['current_study']
                            ?>
                            <input type="radio" id="yes_study" name="current_study" value="Yes" <?php echo ($selectedStudy === 'Yes') ? 'checked' : ''; ?>>
                            <label for="yes_study">Yes</label><br>
                            
                            <input type="radio" id="no_study" name="current_study" value="No" <?php echo ($selectedStudy === 'No') ? 'checked' : ''; ?>>
                            <label for="no_study">No</label>
                        </div>
                    </div>


                    <!-- 7. If No, Job Contemplation -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label for="if_no_jobs" class="form-label">7. If No, What type of jobs were you contemplating by choosing your degree from SLSU-TO?</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                id="if_no_jobs" 
                                name="if_no_jobs" 
                                value="<?php echo isset($userData['if_no_jobs']) ? htmlspecialchars(decryptData($userData['if_no_jobs'])) : ''; ?>"
                            >
                        </div>
                    </div>


                    <!-- 8. If YES, Details -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label for="if_yes_details" class="form-label">8. If YES, please give details as follows: Title of Programme (in full), Institution(s), Period Enrolled (from-to), Attendance Full Time/Part Time/Correspondence and Distance Education, Source of Funding</label>
                            <textarea 
                                class="form-control" 
                                id="if_yes_details" 
                                name="if_yes_details"
                            ><?php echo isset($userData['if_yes_details']) ? htmlspecialchars(decryptData($userData['if_yes_details'])) : ''; ?></textarea>
                        </div>
                    </div>

                    <!-- 9. Reasons for Pursuing Further Studies -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label for="pursue_reasons" class="form-label">9. Main reasons for pursuing further studies:</label>
                            <textarea 
                                class="form-control" 
                                id="pursue_reasons" 
                                name="pursue_reasons"
                            ><?php echo isset($userData['pursue_reasons']) ? htmlspecialchars(decryptData($userData['pursue_reasons'])) : ''; ?></textarea>
                        </div>
                    </div>


                    <!-- 10. Current Paid Work Position -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label class="form-label">10. Which one of the following best describes your current position with regard to paid work?</label><br>
                            
                            <input type="radio" name="current_position[]" value="Working full-time" 
                                <?php echo (isset($userData['current_position']) && decryptData($userData['current_position']) == 'Working full-time') ? 'checked' : ''; ?>>
                            <label>Working full-time</label><br>

                            <input type="radio" name="current_position[]" value="Working part-time but seeking full-time work" 
                                <?php echo (isset($userData['current_position']) && decryptData($userData['current_position']) == 'Working part-time but seeking full-time work') ? 'checked' : ''; ?>>
                            <label>Working part-time but seeking full-time work</label><br>

                            <input type="radio" name="current_position[]" value="Self-employed" 
                                <?php echo (isset($userData['current_position']) && decryptData($userData['current_position']) == 'Self-employed') ? 'checked' : ''; ?>>
                            <label>Self-employed</label><br>

                            <input type="radio" name="current_position[]" value="Not working and looking for a job" 
                                <?php echo (isset($userData['current_position']) && decryptData($userData['current_position']) == 'Not working and looking for a job') ? 'checked' : ''; ?>>
                            <label>Not working and looking for a job</label><br>

                            <input type="radio" name="current_position[]" value="Not working and unavailable for paid work" 
                                <?php echo (isset($userData['current_position']) && decryptData($userData['current_position']) == 'Not working and unavailable for paid work') ? 'checked' : ''; ?>>
                            <label>Not working and unavailable for paid work</label><br>

                            <input type="radio" name="current_position[]" value="Others:" 
                                <?php echo (isset($userData['current_position']) && decryptData($userData['current_position']) == 'Others:') ? 'checked' : ''; ?>>
                            <label>Others:</label>
                            <input type="text" class="form-control" name="other_position[]" 
                                value="<?php echo isset($userData['other_position']) ? htmlspecialchars(decryptData($userData['other_position'])) : ''; ?>">
                        </div>
                    </div>



                    <!-- 11. Time to Find a Job -->
                    <div class="card mb-3">
                            <div class="card-body">
                                <label for="time_to_job" class="form-label">11. How long did you work in your first job after obtaining your degree?</label><br>
                                
                                <input type="radio" name="time_to_job[]" value="0 to 6 months" 
                                    <?php echo (isset($userData['time_to_job']) && decryptData($userData['time_to_job']) == '0 to 6 months') ? 'checked' : ''; ?>>
                                <label>0 to 6 months</label><br>
                                
                                <input type="radio" name="time_to_job[]" value="7 months to 1 year" 
                                    <?php echo (isset($userData['time_to_job']) && decryptData($userData['time_to_job']) == '7 months to 1 year') ? 'checked' : ''; ?>>
                                <label>7 months to 1 year</label><br>
                                
                                <input type="radio" name="time_to_job[]" value="1 to 3 years" 
                                    <?php echo (isset($userData['time_to_job']) && decryptData($userData['time_to_job']) == '1 to 3 years') ? 'checked' : ''; ?>>
                                <label>1 to 3 years</label><br>
                                
                                <input type="radio" name="time_to_job[]" value="3 to 5 years" 
                                    <?php echo (isset($userData['time_to_job']) && decryptData($userData['time_to_job']) == '3 to 5 years') ? 'checked' : ''; ?>>
                                <label>3 to 5 years</label><br>
                                
                                <input type="radio" name="time_to_job[]" value="Over 5 years" 
                                    <?php echo (isset($userData['time_to_job']) && decryptData($userData['time_to_job']) == 'Over 5 years') ? 'checked' : ''; ?>>
                                <label>Over 5 years</label><br>
                            </div>
                        </div>


                    <!-- 12. Time Gap Between Degree and Employment -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label for="time_gap" class="form-label">12. Please give reasons for any time gap between obtaining your degree and your first employment:</label>
                            <textarea class="form-control" id="time_gap" name="time_gap"><?php echo isset($userData['time_gap']) ? htmlspecialchars(decryptData($userData['time_gap'])) : ''; ?></textarea>
                        </div>
                    </div>


                    <!-- 13. Employment History -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label for="employment_history" class="form-label">13. Employment history (since obtaining first degree up to present employment): (Name of Employer, If self-employed, please state area of activity, Period employed (From-To), Post held, Reasons for leaving job (where applicable)</label>
                            <textarea class="form-control" id="employment_history" name="employment_history"><?php echo isset($userData['employment_history']) ? htmlspecialchars(decryptData($userData['employment_history'])) : ''; ?></textarea>
                        </div>
                    </div>


                    <!-- 14. How did you come to know about your current job? -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label class="form-label">14. How did you come to know about your current job?</label><br>

                            <!-- Through friends -->
                            <input type="radio" name="job_info_source[]" value="Through friends" 
                                <?php echo (isset($userData['job_info_source']) && decryptData($userData['job_info_source']) == 'Through friends') ? 'checked' : ''; ?>>
                            <label>Through friends</label><br>

                            <!-- Through relatives -->
                            <input type="radio" name="job_info_source[]" value="Through relatives" 
                                <?php echo (isset($userData['job_info_source']) && decryptData($userData['job_info_source']) == 'Through relatives') ? 'checked' : ''; ?>>
                            <label>Through relatives</label><br>

                            <!-- Through written enquiries -->
                            <input type="radio" name="job_info_source[]" value="Through written enquiries" 
                                <?php echo (isset($userData['job_info_source']) && decryptData($userData['job_info_source']) == 'Through written enquiries') ? 'checked' : ''; ?>>
                            <label>Through written enquiries</label><br>

                            <!-- Press advertisement -->
                            <input type="radio" name="job_info_source[]" value="Press advertisement" 
                                <?php echo (isset($userData['job_info_source']) && decryptData($userData['job_info_source']) == 'Press advertisement') ? 'checked' : ''; ?>>
                            <label>Press advertisement</label><br>

                            <!-- Others -->
                            <input type="radio" name="job_info_source[]" value="Others:" 
                                <?php echo (isset($userData['job_info_source']) && decryptData($userData['job_info_source']) == 'Others:') ? 'checked' : ''; ?>>
                            <label>Others:</label>
                            <input type="text" class="form-control" name="other_job_info[]" value="<?php echo (isset($userData['other_job_info']) ? decryptData($userData['other_job_info']) : ''); ?>">
                        </div>
                    </div>


                    <!-- 15. Qualifications and other attributes required for the job -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label for="job_qualifications" class="form-label">15. Qualifications and other attributes required for the job:</label>
                            <textarea class="form-control" id="job_qualifications" name="job_qualifications"><?php echo (isset($userData['job_qualifications']) ? decryptData($userData['job_qualifications']) : ''); ?></textarea>
                        </div>
                    </div>


                    <!-- 16. Gross monthly salary -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label for="gross_salary" class="form-label">16. Gross monthly salary:</label>
                            <input type="text" class="form-control" id="gross_salary" name="gross_salary" 
                            value="<?php echo isset($userData['gross_salary']) ? $userData['gross_salary'] : ''; ?>">
                        </div>
                    </div>


                    <!-- 17. Other benefits attached to the job -->
                  <div class="card mb-3">
                    <div class="card-body">
                        <label for="job_benefits" class="form-label">17. Please list any other benefits attached to the job:</label>
                        <textarea class="form-control" id="job_benefits" name="job_benefits"><?php echo (isset($userData['job_benefits']) ? decryptData($userData['job_benefits']) : ''); ?></textarea>
                    </div>
                </div>


                    <!-- 18. Location of place of work -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label for="work_location" class="form-label">18. Location of place of work:</label>
                            <input type="text" class="form-control" id="work_location" name="work_location" 
                                value="<?php echo (isset($userData['work_location']) ? decryptData($userData['work_location']) : ''); ?>">
                        </div>
                    </div>


                    <!-- 19. Number of employees -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label for="num_employees" class="form-label">19. Number of employees (approximately):</label><br>
                            <input type="radio" id="less_10" name="num_employees[]" value="Less than 10" 
                                <?php echo (isset($userData['num_employees']) && decryptData($userData['num_employees']) == 'Less than 10') ? 'checked' : ''; ?>>
                            <label for="less_10">Less than 10</label><br>

                            <input type="radio" id="11_50" name="num_employees[]" value="11 to 50" 
                                <?php echo (isset($userData['num_employees']) && decryptData($userData['num_employees']) == '11 to 50') ? 'checked' : ''; ?>>
                            <label for="11_50">11 to 50</label><br>

                            <input type="radio" id="51_200" name="num_employees[]" value="51 to 200" 
                                <?php echo (isset($userData['num_employees']) && decryptData($userData['num_employees']) == '51 to 200') ? 'checked' : ''; ?>>
                            <label for="51_200">51 to 200</label><br>

                            <input type="radio" id="over_200" name="num_employees[]" value="Over 200" 
                                <?php echo (isset($userData['num_employees']) && decryptData($userData['num_employees']) == 'Over 200') ? 'checked' : ''; ?>>
                            <label for="over_200">Over 200</label>
                        </div>
                    </div>


                    <!-- 20. Nature of work performed -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label for="work_nature" class="form-label">20. Nature of work performed:</label><br>

                            <input type="radio" id="managerial" name="work_nature[]" value="Managerial" 
                                <?php echo (isset($userData['work_nature']) && decryptData($userData['work_nature']) == 'Managerial') ? 'checked' : ''; ?>>
                            <label for="managerial">Managerial</label><br>

                            <input type="radio" id="clerical" name="work_nature[]" value="Clerical" 
                                <?php echo (isset($userData['work_nature']) && decryptData($userData['work_nature']) == 'Clerical') ? 'checked' : ''; ?>>
                            <label for="clerical">Clerical</label><br>

                            <input type="radio" id="supervisory" name="work_nature[]" value="Supervisory" 
                                <?php echo (isset($userData['work_nature']) && decryptData($userData['work_nature']) == 'Supervisory') ? 'checked' : ''; ?>>
                            <label for="supervisory">Supervisory</label><br>

                            <input type="radio" id="support" name="work_nature[]" value="Support Service" 
                                <?php echo (isset($userData['work_nature']) && decryptData($userData['work_nature']) == 'Support Service') ? 'checked' : ''; ?>>
                            <label for="support">Support Service</label><br>

                            <input type="radio" id="other_work_nature" name="work_nature[]" value="Other:" 
                                <?php echo (isset($userData['work_nature']) && decryptData($userData['work_nature']) == 'Other:') ? 'checked' : ''; ?>>
                            <label for="other_work_nature">Other:</label>
                            <input type="text" class="form-control" id="other_work_nature_text" name="other_work_nature_text[]"
                                <?php echo (isset($userData['other_work_nature_text'])) ? 'value="' . decryptData($userData['other_work_nature_text']) . '"' : ''; ?>>
                        </div>
                    </div>


                    <!-- 21. Proof of Work Duration -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label for="proof_image" class="form-label">21. Upload proof of work (Ex. Company ID):</label>
                            <!-- <input type="file" class="form-control" id="proof_image" name="proof_image" accept="image/*">
                            <small class="form-text text-muted">Accepted formats: JPG, JPEG, PNG, GIF. Max size: 5MB.</small> -->
                            
                            <!-- Display the uploaded image if available -->
                            <?php if (isset($userData['proof_image']) && !empty($userData['proof_image'])): ?>
                                <div class="mt-3">
                                    <label>Uploaded Proof Image:</label><br>
                                    <img src="<?php echo $userData['proof_image']; ?>" alt="Proof Image" style="max-width: 200px; height: auto;">
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- 22. Do you face any major problem in your job assignments? -->
                    <div class="card mb-3">
                            <div class="card-body">
                                <label class="form-label">22. Do you face any major problem in your job assignments?</label><br>
                                
                                <input type="radio" id="job_problem_yes" name="job_problem[]" value="Yes" 
                                    <?php echo (isset($userData['job_problem']) && decryptData($userData['job_problem']) == 'Yes') ? 'checked' : ''; ?>>
                                <label for="job_problem_yes">Yes</label><br>

                                <input type="radio" id="job_problem_no" name="job_problem[]" value="No" 
                                    <?php echo (isset($userData['job_problem']) && decryptData($userData['job_problem']) == 'No') ? 'checked' : ''; ?>>
                                <label for="job_problem_no">No</label>
                            </div>
                        </div>


                    <!-- 23. If yes, please elaborate -->
                    <div class="card mb-3">
                            <div class="card-body">
                                <label for="problem_elaboration" class="form-label">23. If yes, please elaborate:</label>
                                <textarea class="form-control" id="problem_elaboration" name="problem_elaboration"><?php echo isset($userData['problem_elaboration']) ? htmlspecialchars(decryptData($userData['problem_elaboration'])) : ''; ?></textarea>
                            </div>
                        </div>


                    <!-- 24. If you are self-employed, what made you decide to become self-employed? -->
                    <div class="card mb-3">
                            <div class="card-body">
                                <label for="self_employed_reason" class="form-label">24. If you are self-employed, what made you decide to become self-employed?</label>
                                <textarea class="form-control" id="self_employed_reason" name="self_employed_reason"><?php echo isset($userData['self_employed_reason']) ? htmlspecialchars(decryptData($userData['self_employed_reason'])) : ''; ?></textarea>
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
                                        <tr>
                                            <td>Enhanced academic knowledge</td>
                                            <td><input type="radio" name="knowledge_enhance" value="Very much" <?php echo (decryptData($userData['knowledge_enhance']) == 'Very much') ? 'checked' : ''; ?>></td>
                                            <td><input type="radio" name="knowledge_enhance" value="Much" <?php echo (decryptData($userData['knowledge_enhance']) == 'Much') ? 'checked' : ''; ?>></td>
                                            <td><input type="radio" name="knowledge_enhance" value="A little" <?php echo (decryptData($userData['knowledge_enhance']) == 'A little') ? 'checked' : ''; ?>></td>
                                            <td><input type="radio" name="knowledge_enhance" value="Not at all" <?php echo (decryptData($userData['knowledge_enhance']) == 'Not at all') ? 'checked' : ''; ?>></td>
                                        </tr>
                                        <tr>
                                            <td>Improved problem-solving skills</td>
                                            <td><input type="radio" name="problem_solving" value="Very much" <?php echo (decryptData($userData['problem_solving']) == 'Very much') ? 'checked' : ''; ?>></td>
                                            <td><input type="radio" name="problem_solving" value="Much" <?php echo (decryptData($userData['problem_solving']) == 'Much') ? 'checked' : ''; ?>></td>
                                            <td><input type="radio" name="problem_solving" value="A little" <?php echo (decryptData($userData['problem_solving']) == 'A little') ? 'checked' : ''; ?>></td>
                                            <td><input type="radio" name="problem_solving" value="Not at all" <?php echo (decryptData($userData['problem_solving']) == 'Not at all') ? 'checked' : ''; ?>></td>
                                        </tr>
                                        <tr>
                                            <td>Improved research skills</td>
                                            <td><input type="radio" name="research_skills" value="Very much" <?php echo (decryptData($userData['research_skills']) == 'Very much') ? 'checked' : ''; ?>></td>
                                            <td><input type="radio" name="research_skills" value="Much" <?php echo (decryptData($userData['research_skills']) == 'Much') ? 'checked' : ''; ?>></td>
                                            <td><input type="radio" name="research_skills" value="A little" <?php echo (decryptData($userData['research_skills']) == 'A little') ? 'checked' : ''; ?>></td>
                                            <td><input type="radio" name="research_skills" value="Not at all" <?php echo (decryptData($userData['research_skills']) == 'Not at all') ? 'checked' : ''; ?>></td>
                                        </tr>
                                        <tr>
                                            <td>Improved learning efficiency</td>
                                            <td><input type="radio" name="learning_efficiency" value="Very much" <?php echo (decryptData($userData['learning_efficiency']) == 'Very much') ? 'checked' : ''; ?>></td>
                                            <td><input type="radio" name="learning_efficiency" value="Much" <?php echo (decryptData($userData['learning_efficiency']) == 'Much') ? 'checked' : ''; ?>></td>
                                            <td><input type="radio" name="learning_efficiency" value="A little" <?php echo (decryptData($userData['learning_efficiency']) == 'A little') ? 'checked' : ''; ?>></td>
                                            <td><input type="radio" name="learning_efficiency" value="Not at all" <?php echo (decryptData($userData['learning_efficiency']) == 'Not at all') ? 'checked' : ''; ?>></td>
                                        </tr>
                                        <tr>
                                            <td>Improved communication skills</td>
                                            <td><input type="radio" name="communication_skills" value="Very much" <?php echo (decryptData($userData['communication_skills']) == 'Very much') ? 'checked' : ''; ?>></td>
                                            <td><input type="radio" name="communication_skills" value="Much" <?php echo (decryptData($userData['communication_skills']) == 'Much') ? 'checked' : ''; ?>></td>
                                            <td><input type="radio" name="communication_skills" value="A little" <?php echo (decryptData($userData['communication_skills']) == 'A little') ? 'checked' : ''; ?>></td>
                                            <td><input type="radio" name="communication_skills" value="Not at all" <?php echo (decryptData($userData['communication_skills']) == 'Not at all') ? 'checked' : ''; ?>></td>
                                        </tr>
                                        <tr>
                                            <td>More inclined to put up own business</td>
                                            <td><input type="radio" name="more_inclined" value="Very much" <?php echo (decryptData($userData['more_inclined']) == 'Very much') ? 'checked' : ''; ?>></td>
                                            <td><input type="radio" name="more_inclined" value="Much" <?php echo (decryptData($userData['more_inclined']) == 'Much') ? 'checked' : ''; ?>></td>
                                            <td><input type="radio" name="more_inclined" value="A little" <?php echo (decryptData($userData['more_inclined']) == 'A little') ? 'checked' : ''; ?>></td>
                                            <td><input type="radio" name="more_inclined" value="Not at all" <?php echo (decryptData($userData['more_inclined']) == 'Not at all') ? 'checked' : ''; ?>></td>
                                        </tr>
                                        <tr>
                                            <td>Enhanced team spirit</td>
                                            <td><input type="radio" name="team_spirit" value="Very much" <?php echo (decryptData($userData['team_spirit']) == 'Very much') ? 'checked' : ''; ?>></td>
                                            <td><input type="radio" name="team_spirit" value="Much" <?php echo (decryptData($userData['team_spirit']) == 'Much') ? 'checked' : ''; ?>></td>
                                            <td><input type="radio" name="team_spirit" value="A little" <?php echo (decryptData($userData['team_spirit']) == 'A little') ? 'checked' : ''; ?>></td>
                                            <td><input type="radio" name="team_spirit" value="Not at all" <?php echo (decryptData($userData['team_spirit']) == 'Not at all') ? 'checked' : ''; ?>></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>


                    <!-- 26. Relevance of program to current job -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label class="form-label">26. Was your program of study at SLSU relevant to your present job?</label><br>
                            
                            <input type="radio" id="relevance_very_much" name="job_relevance[]" value="Very much" 
                            <?php echo (decryptData($userData['job_relevance']) == 'Very much') ? 'checked' : ''; ?>>
                            <label for="relevance_very_much">Very much</label><br>

                            <input type="radio" id="relevance_much" name="job_relevance[]" value="Much" 
                            <?php echo (decryptData($userData['job_relevance']) == 'Much') ? 'checked' : ''; ?>>
                            <label for="relevance_much">Much</label><br>

                            <input type="radio" id="relevance_little" name="job_relevance[]" value="A little" 
                            <?php echo (decryptData($userData['job_relevance']) == 'A little') ? 'checked' : ''; ?>>
                            <label for="relevance_little">A little</label><br>

                            <input type="radio" id="relevance_not" name="job_relevance[]" value="Not at all" 
                            <?php echo (decryptData($userData['job_relevance']) == 'Not at all') ? 'checked' : ''; ?>>
                            <label for="relevance_not">Not at all</label>
                        </div>
                    </div>

                    <!-- 27. Have you tried applying for a position relevant to your course? -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label class="form-label">27. Have you tried applying for a position relevant to your course?</label><br>

                            <input type="radio" id="applied_yes" name="applied_course[]" value="Yes" 
                            <?php echo (decryptData($userData['applied_course']) == 'Yes') ? 'checked' : ''; ?>>
                            <label for="applied_yes">Yes</label><br>

                            <input type="radio" id="applied_no" name="applied_course[]" value="No" 
                            <?php echo (decryptData($userData['applied_course']) == 'No') ? 'checked' : ''; ?>>
                            <label for="applied_no">No</label>
                        </div>
                    </div>


                    <!-- 28. If yes, reasons for not being hired -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label class="form-label">28. If yes, what are the possible reasons why you're not hired?</label><br>
                            
                            <input type="radio" name="possible_reasons[]" value="I am not qualified for the job"
                            <?php echo (decryptData($userData['possible_reasons']) == 'I am not qualified for the job') ? 'checked' : ''; ?>>
                            <label for="relevance_very_much">I am not qualified for the job.</label><br>

                            <input type="radio" name="possible_reasons[]" value="I did not pass the employment exams"
                            <?php echo (decryptData($userData['possible_reasons']) == 'I did not pass the employment exams') ? 'checked' : ''; ?>>
                            <label for="relevance_much">I did not pass the employment exams.</label><br>

                            <input type="radio" name="possible_reasons[]" value="I did not pass the interview"
                            <?php echo (decryptData($userData['possible_reasons']) == 'I did not pass the interview') ? 'checked' : ''; ?>>
                            <label for="relevance_little">I did not pass the interview.</label><br>

                            <input type="radio" name="possible_reasons[]" value="I lack the necessary competencies for the job"
                            <?php echo (decryptData($userData['possible_reasons']) == 'I lack the necessary competencies for the job') ? 'checked' : ''; ?>>
                            <label for="relevance_not">I lack the necessary competencies for the job.</label><br>

                            <input type="radio" name="possible_reasons[]" value="I did not pass the medical exams"
                            <?php echo (decryptData($userData['possible_reasons']) == 'I did not pass the medical exams') ? 'checked' : ''; ?>>
                            <label for="relevance_very_much">I did not pass the medical exams.</label><br>

                            <input type="radio" name="possible_reasons[]" value="There are skills necessary for the job"
                            <?php echo (decryptData($userData['possible_reasons']) == 'There are skills necessary for the job') ? 'checked' : ''; ?>>
                            <label for="relevance_very_much">There are skills necessary for the job.</label><br>

                            <input type="radio" name="possible_reasons[]" value="Other reasons please specify:"
                            <?php echo (decryptData($userData['possible_reasons']) == 'Other reasons please specify:') ? 'checked' : ''; ?>>
                            <label for="relevance_much">Other reasons please specify:</label><br>
                            
                            <input type="text" class="form-control" name="other_reasons[]" 
                            value="<?php echo (isset($userData['other_reasons']) ? decryptData($userData['other_reasons']) : ''); ?>">
                        </div>
                    </div>


                    <!-- 29. If no, reasons for not applying -->
                    <div class="card mb-3">
                            <div class="card-body">
                                <label class="form-label">29. If no, why?</label><br>
                                
                                <input type="radio" name="present_job[]" value="I do not think I have the necessary skills for jobs related to my course"
                                <?php echo (decryptData($userData['present_job']) == 'I do not think I have the necessary skills for jobs related to my course') ? 'checked' : ''; ?>>
                                <label for="relevance_very_much">I do not think I have the necessary skills for jobs related to my course.</label><br>
                                
                                <input type="radio" name="present_job[]" value="The jobs available are low-paying"
                                <?php echo (decryptData($userData['present_job']) == 'The jobs available are low-paying') ? 'checked' : ''; ?>>
                                <label for="relevance_much">The jobs available are low-paying.</label><br>
                                
                                <input type="radio" name="present_job[]" value="There are no jobs available in my field of specialization"
                                <?php echo (decryptData($userData['present_job']) == 'There are no jobs available in my field of specialization') ? 'checked' : ''; ?>>
                                <label for="relevance_little">There are no jobs available in my field of specialization.</label><br>
                                
                                <input type="radio" name="present_job[]" value="There are no job openings within the vicinity of my residence in my field of specialization"
                                <?php echo (decryptData($userData['present_job']) == 'There are no job openings within the vicinity of my residence in my field of specialization') ? 'checked' : ''; ?>>
                                <label for="relevance_not">There are no job openings within the vicinity of my residence in my field of specialization.</label><br>
                                
                                <input type="radio" name="present_job[]" value="I have no interest in getting a job related to my field of specialization"
                                <?php echo (decryptData($userData['present_job']) == 'I have no interest in getting a job related to my field of specialization') ? 'checked' : ''; ?>>
                                <label for="relevance_very_much">I have no interest in getting a job related to my field of specialization.</label><br>
                                
                                <input type="radio" name="present_job[]" value="Other reasons please specify:"
                                <?php echo (decryptData($userData['present_job']) == 'Other reasons please specify:') ? 'checked' : ''; ?>>
                                <label for="relevance_much">Other reasons please specify:</label><br>
                                
                                <input type="text" class="form-control" name="other_job[]" 
                                value="<?php echo (isset($userData['other_job']) ? decryptData($userData['other_job']) : ''); ?>">
                            </div>
                        </div>


                    <!-- 30. Major strengths and weaknesses of the SLSU program -->
                    <div class="card mb-3">
                                <div class="card-body">
                                    <label class="form-label">30. Which of the following best represent major strengths and weaknesses of the SLSU-TO programme that you attended? (Check as appropriate)</label>
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
                                            <tr>
                                                <td>Range of modules offered</td>
                                                <td><input type="radio" name="range_module" value="Strength" <?php echo (decryptData($userData['range_module']) == 'Strength') ? 'checked' : ''; ?>></td>
                                                <td><input type="radio" name="range_module" value="Weakness" <?php echo (decryptData($userData['range_module']) == 'Weakness') ? 'checked' : ''; ?>></td>
                                                <td><input type="radio" name="range_module" value="Does not apply" <?php echo (decryptData($userData['range_module']) == 'Does not apply') ? 'checked' : ''; ?>></td>
                                            </tr>
                                            <tr>
                                                <td>Number of optional modules in relation to the number of compulsory (core) modules</td>
                                                <td><input type="radio" name="optional_module" value="Strength" <?php echo (decryptData($userData['optional_module']) == 'Strength') ? 'checked' : ''; ?>></td>
                                                <td><input type="radio" name="optional_module" value="Weakness" <?php echo (decryptData($userData['optional_module']) == 'Weakness') ? 'checked' : ''; ?>></td>
                                                <td><input type="radio" name="optional_module" value="Does not apply" <?php echo (decryptData($userData['optional_module']) == 'Does not apply') ? 'checked' : ''; ?>></td>
                                            </tr>
                                            <tr>
                                                <td>Relevance of the programme to your professional requirements</td>
                                                <td><input type="radio" name="relevance" value="Strength" <?php echo (decryptData($userData['relevance']) == 'Strength') ? 'checked' : ''; ?>></td>
                                                <td><input type="radio" name="relevance" value="Weakness" <?php echo (decryptData($userData['relevance']) == 'Weakness') ? 'checked' : ''; ?>></td>
                                                <td><input type="radio" name="relevance" value="Does not apply" <?php echo (decryptData($userData['relevance']) == 'Does not apply') ? 'checked' : ''; ?>></td>
                                            </tr>
                                            <tr>
                                                <td>Student workload</td>
                                                <td><input type="radio" name="worlkload" value="Strength" <?php echo (decryptData($userData['worlkload']) == 'Strength') ? 'checked' : ''; ?>></td>
                                                <td><input type="radio" name="worlkload" value="Weakness" <?php echo (decryptData($userData['worlkload']) == 'Weakness') ? 'checked' : ''; ?>></td>
                                                <td><input type="radio" name="worlkload" value="Does not apply" <?php echo (decryptData($userData['worlkload']) == 'Does not apply') ? 'checked' : ''; ?>></td>
                                            </tr>
                                            <tr>
                                                <td>Problem solving</td>
                                                <td><input type="radio" name="solving" value="Strength" <?php echo (decryptData($userData['solving']) == 'Strength') ? 'checked' : ''; ?>></td>
                                                <td><input type="radio" name="solving" value="Weakness" <?php echo (decryptData($userData['solving']) == 'Weakness') ? 'checked' : ''; ?>></td>
                                                <td><input type="radio" name="solving" value="Does not apply" <?php echo (decryptData($userData['solving']) == 'Does not apply') ? 'checked' : ''; ?>></td>
                                            </tr>
                                            <tr>
                                                <td>Inter-disciplinary learning</td>
                                                <td><input type="radio" name="learning" value="Strength" <?php echo (decryptData($userData['learning']) == 'Strength') ? 'checked' : ''; ?>></td>
                                                <td><input type="radio" name="learning" value="Weakness" <?php echo (decryptData($userData['learning']) == 'Weakness') ? 'checked' : ''; ?>></td>
                                                <td><input type="radio" name="learning" value="Does not apply" <?php echo (decryptData($userData['learning']) == 'Does not apply') ? 'checked' : ''; ?>></td>
                                            </tr>
                                            <tr>
                                                <td>Work placement/attachment</td>
                                                <td><input type="radio" name="placement" value="Strength" <?php echo (decryptData($userData['placement']) == 'Strength') ? 'checked' : ''; ?>></td>
                                                <td><input type="radio" name="placement" value="Weakness" <?php echo (decryptData($userData['placement']) == 'Weakness') ? 'checked' : ''; ?>></td>
                                                <td><input type="radio" name="placement" value="Does not apply" <?php echo (decryptData($userData['placement']) == 'Does not apply') ? 'checked' : ''; ?>></td>
                                            </tr>
                                            <tr>
                                                <td>Teaching/Learning environment</td>
                                                <td><input type="radio" name="environment" value="Strength" <?php echo (decryptData($userData['environment']) == 'Strength') ? 'checked' : ''; ?>></td>
                                                <td><input type="radio" name="environment" value="Weakness" <?php echo (decryptData($userData['environment']) == 'Weakness') ? 'checked' : ''; ?>></td>
                                                <td><input type="radio" name="environment" value="Does not apply" <?php echo (decryptData($userData['environment']) == 'Does not apply') ? 'checked' : ''; ?>></td>
                                            </tr>
                                            <tr>
                                                <td>Quality of delivery</td>
                                                <td><input type="radio" name="quality" value="Strength" <?php echo (decryptData($userData['quality']) == 'Strength') ? 'checked' : ''; ?>></td>
                                                <td><input type="radio" name="quality" value="Weakness" <?php echo (decryptData($userData['quality']) == 'Weakness') ? 'checked' : ''; ?>></td>
                                                <td><input type="radio" name="quality" value="Does not apply" <?php echo (decryptData($userData['quality']) == 'Does not apply') ? 'checked' : ''; ?>></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                    <!-- 31. Satisfaction with current job -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label class="form-label">31. How satisfied are you with your current job?</label><br>

                            <input type="radio" id="satisfaction_very_much" name="job_satisfaction" value="Very much"
                            <?php echo (decryptData($userData['job_satisfaction']) == 'Very much') ? 'checked' : ''; ?>>
                            <label for="satisfaction_very_much">Very much</label><br>

                            <input type="radio" id="satisfaction_much" name="job_satisfaction" value="Much"
                            <?php echo (decryptData($userData['job_satisfaction']) == 'Much') ? 'checked' : ''; ?>>
                            <label for="satisfaction_much">Much</label><br>

                            <input type="radio" id="satisfaction_little" name="job_satisfaction" value="A little"
                            <?php echo (decryptData($userData['job_satisfaction']) == 'A little') ? 'checked' : ''; ?>>
                            <label for="satisfaction_little">A little</label><br>

                            <input type="radio" id="satisfaction_not" name="job_satisfaction" value="Not at all"
                            <?php echo (decryptData($userData['job_satisfaction']) == 'Not at all') ? 'checked' : ''; ?>>
                            <label for="satisfaction_not">Not at all</label>
                        </div>
                    </div>


                    <!-- 32. Do you intend to stay in the same job/profession? -->
                    <div class="card mb-3">
                            <div class="card-body">
                                <label class="form-label">32. Do you intend to stay in the same job/profession?</label><br>

                                <input type="radio" id="stay_yes" name="job_stay" value="Yes"
                                <?php echo (decryptData($userData['job_stay']) == 'Yes') ? 'checked' : ''; ?>>
                                <label for="stay_yes">Yes</label><br>

                                <input type="radio" id="stay_no" name="job_stay" value="No"
                                <?php echo (decryptData($userData['job_stay']) == 'No') ? 'checked' : ''; ?>>
                                <label for="stay_no">No</label><br>

                                <input type="radio" id="stay_other" name="job_stay" value="Other"
                                <?php echo (decryptData($userData['job_stay']) == 'Other') ? 'checked' : ''; ?>>
                                <label for="stay_other">Others:</label>
                                <input type="text" class="form-control mt-2" id="stay_other_text" name="stay_other_text"
                                value="<?php echo (decryptData($userData['job_stay']) == 'Other') ? decryptData($userData['stay_other_text']) : ''; ?>"
                                <?php echo (decryptData($userData['job_stay']) == 'Other') ? '' : 'disabled'; ?>>
                            </div>
                        </div>


                        <button type="submit" class="btn btn-primary">Save Changes</button>

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