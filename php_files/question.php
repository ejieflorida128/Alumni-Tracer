<?php
ob_start(); // Start buffering the output
session_start();
include '../connection/conn.php'; // Database connection


define('ENCRYPTION_KEY', getenv('MY_SECRET_KEY'));
$alumni_gmail = $_SESSION['email'];



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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        


        // Sanitize input values to avoid SQL injection
        $choose_school = encryptData(isset($_POST['choose_school']) ? mysqli_real_escape_string($conn, $_POST['choose_school']) : '');
        $name = encryptData(isset($_POST['name']) ? mysqli_real_escape_string($conn, $_POST['name']) : '');
        $sex = encryptData(isset($_POST['sex']) ? mysqli_real_escape_string($conn, $_POST['sex']) : '');
        $age = isset($_POST['age']) ? mysqli_real_escape_string($conn, $_POST['age']) : '';
        $degree = encryptData(isset($_POST['degree']) ? mysqli_real_escape_string($conn, $_POST['degree']) : '');
        $year_awarded = isset($_POST['year_awarded']) ? mysqli_real_escape_string($conn, $_POST['year_awarded']) : '';
        $current_study = '';
        if (isset($_POST['current_study'])) {
            // Check if current_study is an array
            if (is_array($_POST['current_study'])) {
                $current_study = mysqli_real_escape_string($conn, implode(", ", $_POST['current_study']));
            } else {
                $current_study = mysqli_real_escape_string($conn, $_POST['current_study']);
            }
        }
        
        // Encrypt the data
        $current_study = encryptData($current_study);
        
        $if_no_jobs = encryptData(isset($_POST['if_no_jobs']) ? mysqli_real_escape_string($conn, $_POST['if_no_jobs']) : '');
        $if_yes_details = encryptData(isset($_POST['if_yes_details']) ? mysqli_real_escape_string($conn, $_POST['if_yes_details']) : '');
        $pursue_reasons = encryptData(isset($_POST['pursue_reasons']) ? mysqli_real_escape_string($conn, $_POST['pursue_reasons']) : '');
        $current_position = encryptData(isset($_POST['current_position']) ? mysqli_real_escape_string($conn, implode(", ", $_POST['current_position'])) : '');
        $other_position = encryptData(isset($_POST['other_position']) ? mysqli_real_escape_string($conn, implode(", ", $_POST['other_position'])) : '');

        // New fields
        $time_to_job = encryptData(isset($_POST['time_to_job']) ? mysqli_real_escape_string($conn, implode(", ", $_POST['time_to_job'])) : '');
        $time_gap = encryptData(isset($_POST['time_gap']) ? mysqli_real_escape_string($conn, $_POST['time_gap']) : '');
        $employment_history = encryptData(isset($_POST['employment_history']) ? mysqli_real_escape_string($conn, $_POST['employment_history']) : '');
        $job_info_source = encryptData(isset($_POST['job_info_source']) ? mysqli_real_escape_string($conn, implode(", ", $_POST['job_info_source'])) : '');
        $other_job_info = encryptData(isset($_POST['other_job_info']) ? mysqli_real_escape_string($conn, implode(", ", $_POST['other_job_info'])) : '');
        $job_qualifications = encryptData(isset($_POST['job_qualifications']) ? mysqli_real_escape_string($conn, $_POST['job_qualifications']) : '');
        $gross_salary = isset($_POST['gross_salary']) ? mysqli_real_escape_string($conn, $_POST['gross_salary']) : '';
        $job_benefits = encryptData(isset($_POST['job_benefits']) ? mysqli_real_escape_string($conn, $_POST['job_benefits']) : '');
        $work_location = encryptData(isset($_POST['work_location']) ? mysqli_real_escape_string($conn, $_POST['work_location']) : '');
        $num_employees = encryptData(isset($_POST['num_employees']) ? mysqli_real_escape_string($conn, implode(", ", $_POST['num_employees'])) : '');

        // Additional new fields
        $work_nature = encryptData(isset($_POST['work_nature']) ? mysqli_real_escape_string($conn, implode(", ", $_POST['work_nature'])) : '');
        $other_work_nature_text = encryptData(isset($_POST['other_work_nature_text']) ? mysqli_real_escape_string($conn, implode(", ", $_POST['other_work_nature_text'])) : '');
        $proof_image_path = '';
        $job_problem = encryptData(isset($_POST['job_problem']) ? mysqli_real_escape_string($conn, implode(", ", $_POST['job_problem'])) : '');
        $problem_elaboration = encryptData(isset($_POST['problem_elaboration']) ? mysqli_real_escape_string($conn, $_POST['problem_elaboration']) : '');
        $self_employed_reason = encryptData(isset($_POST['self_employed_reason']) ? mysqli_real_escape_string($conn, $_POST['self_employed_reason']) : '');
        $knowledge_enhance = encryptData(isset($_POST['knowledge_enhance']) ? mysqli_real_escape_string($conn, $_POST['knowledge_enhance']) : '');
        $problem_solving = encryptData(isset($_POST['problem_solving']) ? mysqli_real_escape_string($conn, $_POST['problem_solving']) : '');
        $research_skills = encryptData(isset($_POST['research_skills']) ? mysqli_real_escape_string($conn, $_POST['research_skills']) : '');
        $learning_efficiency = encryptData(isset($_POST['learning_efficiency']) ? mysqli_real_escape_string($conn, $_POST['learning_efficiency']) : '');
        $communication_skills = encryptData(isset($_POST['communication_skills']) ? mysqli_real_escape_string($conn, $_POST['communication_skills']) : '');
        $more_inclined = encryptData(isset($_POST['more_inclined']) ? mysqli_real_escape_string($conn, $_POST['more_inclined']) : '');
        $team_spirit = encryptData(isset($_POST['team_spirit']) ? mysqli_real_escape_string($conn, $_POST['team_spirit']) : '');
        $job_relevance = encryptData(isset($_POST['job_relevance']) ? mysqli_real_escape_string($conn, implode(", ", $_POST['job_relevance'])) : '');
        $applied_course = encryptData(isset($_POST['applied_course']) ? mysqli_real_escape_string($conn, implode(", ", $_POST['applied_course'])) : '');
        $possible_reasons = encryptData(isset($_POST['possible_reasons']) ? mysqli_real_escape_string($conn, implode(", ", $_POST['possible_reasons'])) : '');
        $other_reasons = encryptData(isset($_POST['other_reasons']) ? mysqli_real_escape_string($conn, implode(", ", $_POST['other_reasons'])) : '');
        $present_job = encryptData(isset($_POST['present_job']) ? mysqli_real_escape_string($conn, implode(", ", $_POST['present_job'])) : '');
        $other_job = encryptData(isset($_POST['other_job']) ? mysqli_real_escape_string($conn, implode(", ", $_POST['other_job'])) : '');

        $range_module = encryptData(isset($_POST['range_module']) ? mysqli_real_escape_string($conn, $_POST['range_module']) : '');
        $optional_module = encryptData(isset($_POST['optional_module']) ? mysqli_real_escape_string($conn, $_POST['optional_module']) : '');
        $relevance = encryptData(isset($_POST['relevance']) ? mysqli_real_escape_string($conn, $_POST['relevance']) : '');
        $worlkload = encryptData(isset($_POST['worlkload']) ? mysqli_real_escape_string($conn, $_POST['worlkload']) : '');
        $solving = encryptData(isset($_POST['solving']) ? mysqli_real_escape_string($conn, $_POST['solving']) : '');
        $learning = encryptData(isset($_POST['learning']) ? mysqli_real_escape_string($conn, $_POST['learning']) : '');
        $placement = encryptData(isset($_POST['placement']) ? mysqli_real_escape_string($conn, $_POST['placement']) : '');
        $environment = encryptData(isset($_POST['environment']) ? mysqli_real_escape_string($conn, $_POST['environment']) : '');
        $quality = encryptData(isset($_POST['quality']) ? mysqli_real_escape_string($conn, $_POST['quality']) : '');


        $job_satisfaction = '';
        if (isset($_POST['job_satisfaction'])) {
            // Check if job_satisfaction is an array (for multiple selected values like checkboxes)
            if (is_array($_POST['job_satisfaction'])) {
                $job_satisfaction = mysqli_real_escape_string($conn, implode(", ", $_POST['job_satisfaction']));
            } else {
                // It's a single value (radio button), just sanitize the string
                $job_satisfaction = mysqli_real_escape_string($conn, $_POST['job_satisfaction']);
            }
        }
        
        // Encrypt the data
        $job_satisfaction = encryptData($job_satisfaction);
        
        $job_stay = '';
        if (isset($_POST['job_stay'])) {
            // Check if job_stay is an array (for multiple selected values like checkboxes)
            if (is_array($_POST['job_stay'])) {
                $job_stay = mysqli_real_escape_string($conn, implode(", ", $_POST['job_stay']));
            } else {
                // It's a single value (radio button), just sanitize the string
                $job_stay = mysqli_real_escape_string($conn, $_POST['job_stay']);
            }
        }
        
        // Encrypt the data
        $job_stay = encryptData($job_stay);
        
        $stay_other_text = encryptData(isset($_POST['stay_other_text']) ? mysqli_real_escape_string($conn, implode(", ", $_POST['stay_other_text'])) : '');

        $status = isset($_POST['status']) ? mysqli_real_escape_string($conn, $_POST['status']) : '';

        // File upload handling
        $proof_image_path = ''; // Initialize with empty path in case no file is uploaded
        if (isset($_FILES['proof_image']) && $_FILES['proof_image']['error'] === UPLOAD_ERR_OK) {
            // Define target directory and validate file
            $target_dir = "../alumni_pictures/";
            $file_name = basename($_FILES["proof_image"]["name"]); 
            $target_file = $target_dir . $file_name;
            $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Validate file type and size (limit to 5MB)
            $valid_extensions = array("jpg", "jpeg", "png", "gif");
            if (in_array($file_type, $valid_extensions) && $_FILES["proof_image"]["size"] <= 5242880) { // 5MB = 5242880 bytes
                // Move the file to the uploads directory
                if (move_uploaded_file($_FILES["proof_image"]["tmp_name"], $target_file)) {
                    $proof_image_path = $target_file; // Save path for database entry
                } else {
                    echo "Error: Failed to upload the file.";
                }
            } else {
                echo "Error: Invalid file type or file size exceeded 5MB.";
            }
        }

        $check_mode = 1;

        $selectResponse = "SELECT * FROM l_study_response WHERE gmail = '$alumni_gmail'";
        $queryCheck = mysqli_query($conn,$selectResponse);

        $resultCheck = mysqli_fetch_assoc($queryCheck);

        if($resultCheck['check_mode'] == 1){

            $notification = $alumni_gmail . " has updated the alumni information directory for the school " . $choose_school;


        }else{
            $notification = $alumni_gmail . " has submitted the alumni information directory for the school " . $choose_school;
            
            
        }

        $decryptSchool = decryptData($choose_school);

        $notifGo = "INSERT INTO e_notifications (school_name,alumni_gmail,notification) VALUES ('$decryptSchool','$alumni_gmail','$notification')";
        mysqli_query($conn,$notifGo);






    $query = "UPDATE l_study_response 
    SET 
        choose_school = '$choose_school',
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
        proof_image = '$proof_image_path',
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
        job_stay = '$job_stay',
        stay_other_text = '$stay_other_text',
        status = '$status',
        check_mode = '$check_mode'
    WHERE gmail = '$alumni_gmail'";


        


        // Execute the query
        if (mysqli_query($conn, $query)) {
            // Redirect to the same page to avoid resubmission
            header("Location: " . $_SERVER['PHP_SELF']);  // Refresh the page
            exit();  // Stop further script execution
        } else {
            echo "Error: " . mysqli_error($conn);
        }

      

    }
    ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Tracer Study</title>
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
                        <img class="rounded-circle" src="../L-images/df.jpg" alt="no location" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">User Portal</h6>
                        <span>Survey</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="index.html" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Survey Questions</a>
                   
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0" style = "width: 100%;">
                
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
               
                <div class="navbar-nav align-items-center ms-auto">

                  
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="../L-images/df.jpg" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex" style = "font-weight: bold;">SETTINGS</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                           
                            <a href="../index.php" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->


            <?php

            $getData = "SELECT * FROM l_study_response WHERE gmail = '$alumni_gmail'";
            $queryData = mysqli_query($conn,$getData);

            $resultData = mysqli_fetch_assoc($queryData);

            ?>

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
                        // Query to fetch approved schools
                        $schoolsQuery = "SELECT * FROM e_schools WHERE confirm_status = 'Approved'";
                        $schoolsResult = mysqli_query($conn, $schoolsQuery);

                        if ($schoolsResult && mysqli_num_rows($schoolsResult) > 0) {
                            while ($schoolRow = mysqli_fetch_assoc($schoolsResult)) {
                                $schoolName = decryptData(htmlspecialchars($schoolRow['school_name']));
                                $isSelected = ($schoolName === decryptData($resultData['choose_school'])) ? 'selected' : '';
                                echo '<option value="' . $schoolName . '" ' . $isSelected . '>' . $schoolName . '</option>';
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
                            <input type="text" class="form-control" id="name" name="name" value = "<?php echo decryptData($resultData['name']) ?>" required>
                        </div>
                    </div>

                   <!-- 2. Sex -->
                   <div class="card mb-3">
                        <div class="card-body">
                            <label class="form-label">2. Sex:</label><br>
                            <?php 
                                // Decrypt the stored sex value from the database
                                $selectedSex = decryptData($resultData['sex']); 
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
                            <input type="number" class="form-control" id="age" name="age" value = "<?php echo $resultData['age'] ?>" required>
                        </div>
                    </div>

                    <!-- 4. Degree Title -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label for="degree" class="form-label">4. Title (with major) of degree received at SLSU-TO:</label>
                            <input type="text" class="form-control" id="degree" name="degree" value = "<?php echo decryptData($resultData['degree']) ?>" required>
                        </div>
                    </div>

                    <!-- 5. Year Awarded Degree -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label for="year_awarded" class="form-label">5. Year awarded degree:</label>
                            <input type="text" class="form-control" id="year_awarded" name="year_awarded" value = "<?php echo $resultData['year_awarded'] ?>" required>
                        </div>
                    </div>

                    <!-- 6. Are you currently taking studies? -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label class="form-label">6. Are you currently taking studies? (e.g. Masters of Science in Information Technology)</label><br>
                            <?php 
                                $selectedStudy = decryptData($resultData['current_study']); // Assuming the value is stored in $resultData['current_study']
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
                                value="<?php echo isset($resultData['if_no_jobs']) ? htmlspecialchars(decryptData($resultData['if_no_jobs'])) : ''; ?>"
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
                            ><?php echo isset($resultData['if_yes_details']) ? htmlspecialchars(decryptData($resultData['if_yes_details'])) : ''; ?></textarea>
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
                            ><?php echo isset($resultData['pursue_reasons']) ? htmlspecialchars(decryptData($resultData['pursue_reasons'])) : ''; ?></textarea>
                        </div>
                    </div>


                    <!-- 10. Current Paid Work Position -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label class="form-label">10. Which one of the following best describes your current position with regard to paid work?</label><br>
                            
                            <input type="radio" name="current_position[]" value="Working full-time" 
                                <?php echo (isset($resultData['current_position']) && decryptData($resultData['current_position']) == 'Working full-time') ? 'checked' : ''; ?>>
                            <label>Working full-time</label><br>

                            <input type="radio" name="current_position[]" value="Working part-time but seeking full-time work" 
                                <?php echo (isset($resultData['current_position']) && decryptData($resultData['current_position']) == 'Working part-time but seeking full-time work') ? 'checked' : ''; ?>>
                            <label>Working part-time but seeking full-time work</label><br>

                            <input type="radio" name="current_position[]" value="Self-employed" 
                                <?php echo (isset($resultData['current_position']) && decryptData($resultData['current_position']) == 'Self-employed') ? 'checked' : ''; ?>>
                            <label>Self-employed</label><br>

                            <input type="radio" name="current_position[]" value="Not working and looking for a job" 
                                <?php echo (isset($resultData['current_position']) && decryptData($resultData['current_position']) == 'Not working and looking for a job') ? 'checked' : ''; ?>>
                            <label>Not working and looking for a job</label><br>

                            <input type="radio" name="current_position[]" value="Not working and unavailable for paid work" 
                                <?php echo (isset($resultData['current_position']) && decryptData($resultData['current_position']) == 'Not working and unavailable for paid work') ? 'checked' : ''; ?>>
                            <label>Not working and unavailable for paid work</label><br>

                            <input type="radio" name="current_position[]" value="Others:" 
                                <?php echo (isset($resultData['current_position']) && decryptData($resultData['current_position']) == 'Others:') ? 'checked' : ''; ?>>
                            <label>Others:</label>
                            <input type="text" class="form-control" name="other_position[]" 
                                value="<?php echo isset($resultData['other_position']) ? htmlspecialchars(decryptData($resultData['other_position'])) : ''; ?>">
                        </div>
                    </div>



                    <!-- 11. Time to Find a Job -->
                    <div class="card mb-3">
                            <div class="card-body">
                                <label for="time_to_job" class="form-label">11. How long did you work in your first job after obtaining your degree?</label><br>
                                
                                <input type="radio" name="time_to_job[]" value="0 to 6 months" 
                                    <?php echo (isset($resultData['time_to_job']) && decryptData($resultData['time_to_job']) == '0 to 6 months') ? 'checked' : ''; ?>>
                                <label>0 to 6 months</label><br>
                                
                                <input type="radio" name="time_to_job[]" value="7 months to 1 year" 
                                    <?php echo (isset($resultData['time_to_job']) && decryptData($resultData['time_to_job']) == '7 months to 1 year') ? 'checked' : ''; ?>>
                                <label>7 months to 1 year</label><br>
                                
                                <input type="radio" name="time_to_job[]" value="1 to 3 years" 
                                    <?php echo (isset($resultData['time_to_job']) && decryptData($resultData['time_to_job']) == '1 to 3 years') ? 'checked' : ''; ?>>
                                <label>1 to 3 years</label><br>
                                
                                <input type="radio" name="time_to_job[]" value="3 to 5 years" 
                                    <?php echo (isset($resultData['time_to_job']) && decryptData($resultData['time_to_job']) == '3 to 5 years') ? 'checked' : ''; ?>>
                                <label>3 to 5 years</label><br>
                                
                                <input type="radio" name="time_to_job[]" value="Over 5 years" 
                                    <?php echo (isset($resultData['time_to_job']) && decryptData($resultData['time_to_job']) == 'Over 5 years') ? 'checked' : ''; ?>>
                                <label>Over 5 years</label><br>
                            </div>
                        </div>


                    <!-- 12. Time Gap Between Degree and Employment -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label for="time_gap" class="form-label">12. Please give reasons for any time gap between obtaining your degree and your first employment:</label>
                            <textarea class="form-control" id="time_gap" name="time_gap"><?php echo isset($resultData['time_gap']) ? htmlspecialchars(decryptData($resultData['time_gap'])) : ''; ?></textarea>
                        </div>
                    </div>


                    <!-- 13. Employment History -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label for="employment_history" class="form-label">13. Employment history (since obtaining first degree up to present employment): (Name of Employer, If self-employed, please state area of activity, Period employed (From-To), Post held, Reasons for leaving job (where applicable)</label>
                            <textarea class="form-control" id="employment_history" name="employment_history"><?php echo isset($resultData['employment_history']) ? htmlspecialchars(decryptData($resultData['employment_history'])) : ''; ?></textarea>
                        </div>
                    </div>


                    <!-- 14. How did you come to know about your current job? -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label class="form-label">14. How did you come to know about your current job?</label><br>

                            <!-- Through friends -->
                            <input type="radio" name="job_info_source[]" value="Through friends" 
                                <?php echo (isset($resultData['job_info_source']) && decryptData($resultData['job_info_source']) == 'Through friends') ? 'checked' : ''; ?>>
                            <label>Through friends</label><br>

                            <!-- Through relatives -->
                            <input type="radio" name="job_info_source[]" value="Through relatives" 
                                <?php echo (isset($resultData['job_info_source']) && decryptData($resultData['job_info_source']) == 'Through relatives') ? 'checked' : ''; ?>>
                            <label>Through relatives</label><br>

                            <!-- Through written enquiries -->
                            <input type="radio" name="job_info_source[]" value="Through written enquiries" 
                                <?php echo (isset($resultData['job_info_source']) && decryptData($resultData['job_info_source']) == 'Through written enquiries') ? 'checked' : ''; ?>>
                            <label>Through written enquiries</label><br>

                            <!-- Press advertisement -->
                            <input type="radio" name="job_info_source[]" value="Press advertisement" 
                                <?php echo (isset($resultData['job_info_source']) && decryptData($resultData['job_info_source']) == 'Press advertisement') ? 'checked' : ''; ?>>
                            <label>Press advertisement</label><br>

                            <!-- Others -->
                            <input type="radio" name="job_info_source[]" value="Others:" 
                                <?php echo (isset($resultData['job_info_source']) && decryptData($resultData['job_info_source']) == 'Others:') ? 'checked' : ''; ?>>
                            <label>Others:</label>
                            <input type="text" class="form-control" name="other_job_info[]" value="<?php echo (isset($resultData['other_job_info']) ? decryptData($resultData['other_job_info']) : ''); ?>">
                        </div>
                    </div>


                    <!-- 15. Qualifications and other attributes required for the job -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label for="job_qualifications" class="form-label">15. Qualifications and other attributes required for the job:</label>
                            <textarea class="form-control" id="job_qualifications" name="job_qualifications"><?php echo (isset($resultData['job_qualifications']) ? decryptData($resultData['job_qualifications']) : ''); ?></textarea>
                        </div>
                    </div>


                    <!-- 16. Gross monthly salary -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label for="gross_salary" class="form-label">16. Gross monthly salary:</label>
                            <input type="text" class="form-control" id="gross_salary" name="gross_salary" 
                            value="<?php echo isset($resultData['gross_salary']) ? $resultData['gross_salary'] : ''; ?>">
                        </div>
                    </div>


                    <!-- 17. Other benefits attached to the job -->
                  <div class="card mb-3">
                    <div class="card-body">
                        <label for="job_benefits" class="form-label">17. Please list any other benefits attached to the job:</label>
                        <textarea class="form-control" id="job_benefits" name="job_benefits"><?php echo (isset($resultData['job_benefits']) ? decryptData($resultData['job_benefits']) : ''); ?></textarea>
                    </div>
                </div>


                    <!-- 18. Location of place of work -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label for="work_location" class="form-label">18. Location of place of work:</label>
                            <input type="text" class="form-control" id="work_location" name="work_location" 
                                value="<?php echo (isset($resultData['work_location']) ? decryptData($resultData['work_location']) : ''); ?>">
                        </div>
                    </div>


                    <!-- 19. Number of employees -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label for="num_employees" class="form-label">19. Number of employees (approximately):</label><br>
                            <input type="radio" id="less_10" name="num_employees[]" value="Less than 10" 
                                <?php echo (isset($resultData['num_employees']) && decryptData($resultData['num_employees']) == 'Less than 10') ? 'checked' : ''; ?>>
                            <label for="less_10">Less than 10</label><br>

                            <input type="radio" id="11_50" name="num_employees[]" value="11 to 50" 
                                <?php echo (isset($resultData['num_employees']) && decryptData($resultData['num_employees']) == '11 to 50') ? 'checked' : ''; ?>>
                            <label for="11_50">11 to 50</label><br>

                            <input type="radio" id="51_200" name="num_employees[]" value="51 to 200" 
                                <?php echo (isset($resultData['num_employees']) && decryptData($resultData['num_employees']) == '51 to 200') ? 'checked' : ''; ?>>
                            <label for="51_200">51 to 200</label><br>

                            <input type="radio" id="over_200" name="num_employees[]" value="Over 200" 
                                <?php echo (isset($resultData['num_employees']) && decryptData($resultData['num_employees']) == 'Over 200') ? 'checked' : ''; ?>>
                            <label for="over_200">Over 200</label>
                        </div>
                    </div>


                    <!-- 20. Nature of work performed -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label for="work_nature" class="form-label">20. Nature of work performed:</label><br>

                            <input type="radio" id="managerial" name="work_nature[]" value="Managerial" 
                                <?php echo (isset($resultData['work_nature']) && decryptData($resultData['work_nature']) == 'Managerial') ? 'checked' : ''; ?>>
                            <label for="managerial">Managerial</label><br>

                            <input type="radio" id="clerical" name="work_nature[]" value="Clerical" 
                                <?php echo (isset($resultData['work_nature']) && decryptData($resultData['work_nature']) == 'Clerical') ? 'checked' : ''; ?>>
                            <label for="clerical">Clerical</label><br>

                            <input type="radio" id="supervisory" name="work_nature[]" value="Supervisory" 
                                <?php echo (isset($resultData['work_nature']) && decryptData($resultData['work_nature']) == 'Supervisory') ? 'checked' : ''; ?>>
                            <label for="supervisory">Supervisory</label><br>

                            <input type="radio" id="support" name="work_nature[]" value="Support Service" 
                                <?php echo (isset($resultData['work_nature']) && decryptData($resultData['work_nature']) == 'Support Service') ? 'checked' : ''; ?>>
                            <label for="support">Support Service</label><br>

                            <input type="radio" id="other_work_nature" name="work_nature[]" value="Other:" 
                                <?php echo (isset($resultData['work_nature']) && decryptData($resultData['work_nature']) == 'Other:') ? 'checked' : ''; ?>>
                            <label for="other_work_nature">Other:</label>
                            <input type="text" class="form-control" id="other_work_nature_text" name="other_work_nature_text[]"
                                <?php echo (isset($resultData['other_work_nature_text'])) ? 'value="' . decryptData($resultData['other_work_nature_text']) . '"' : ''; ?>>
                        </div>
                    </div>


                    <!-- 21. Proof of Work Duration -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label for="proof_image" class="form-label">21. Upload proof of work (Ex. Company ID):</label>
                            <input type="file" class="form-control" id="proof_image" name="proof_image" accept="image/*">
                            <small class="form-text text-muted">Accepted formats: JPG, JPEG, PNG, GIF. Max size: 5MB.</small>
                            
                            <!-- Display the uploaded image if available -->
                            <?php if (isset($resultData['proof_image']) && !empty($resultData['proof_image'])): ?>
                                <div class="mt-3">
                                    <label>Uploaded Proof Image:</label><br>
                                    <img src="<?php echo $resultData['proof_image']; ?>" alt="Proof Image" style="max-width: 200px; height: auto;">
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>




                    <!-- 22. Do you face any major problem in your job assignments? -->
                    <div class="card mb-3">
                            <div class="card-body">
                                <label class="form-label">22. Do you face any major problem in your job assignments?</label><br>
                                
                                <input type="radio" id="job_problem_yes" name="job_problem[]" value="Yes" 
                                    <?php echo (isset($resultData['job_problem']) && decryptData($resultData['job_problem']) == 'Yes') ? 'checked' : ''; ?>>
                                <label for="job_problem_yes">Yes</label><br>

                                <input type="radio" id="job_problem_no" name="job_problem[]" value="No" 
                                    <?php echo (isset($resultData['job_problem']) && decryptData($resultData['job_problem']) == 'No') ? 'checked' : ''; ?>>
                                <label for="job_problem_no">No</label>
                            </div>
                        </div>


                    <!-- 23. If yes, please elaborate -->
                    <div class="card mb-3">
                            <div class="card-body">
                                <label for="problem_elaboration" class="form-label">23. If yes, please elaborate:</label>
                                <textarea class="form-control" id="problem_elaboration" name="problem_elaboration"><?php echo isset($resultData['problem_elaboration']) ? htmlspecialchars(decryptData($resultData['problem_elaboration'])) : ''; ?></textarea>
                            </div>
                        </div>


                    <!-- 24. If you are self-employed, what made you decide to become self-employed? -->
                    <div class="card mb-3">
                            <div class="card-body">
                                <label for="self_employed_reason" class="form-label">24. If you are self-employed, what made you decide to become self-employed?</label>
                                <textarea class="form-control" id="self_employed_reason" name="self_employed_reason"><?php echo isset($resultData['self_employed_reason']) ? htmlspecialchars(decryptData($resultData['self_employed_reason'])) : ''; ?></textarea>
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
                                            <td><input type="radio" name="knowledge_enhance" value="Very much" <?php echo (decryptData($resultData['knowledge_enhance']) == 'Very much') ? 'checked' : ''; ?>></td>
                                            <td><input type="radio" name="knowledge_enhance" value="Much" <?php echo (decryptData($resultData['knowledge_enhance']) == 'Much') ? 'checked' : ''; ?>></td>
                                            <td><input type="radio" name="knowledge_enhance" value="A little" <?php echo (decryptData($resultData['knowledge_enhance']) == 'A little') ? 'checked' : ''; ?>></td>
                                            <td><input type="radio" name="knowledge_enhance" value="Not at all" <?php echo (decryptData($resultData['knowledge_enhance']) == 'Not at all') ? 'checked' : ''; ?>></td>
                                        </tr>
                                        <tr>
                                            <td>Improved problem-solving skills</td>
                                            <td><input type="radio" name="problem_solving" value="Very much" <?php echo (decryptData($resultData['problem_solving']) == 'Very much') ? 'checked' : ''; ?>></td>
                                            <td><input type="radio" name="problem_solving" value="Much" <?php echo (decryptData($resultData['problem_solving']) == 'Much') ? 'checked' : ''; ?>></td>
                                            <td><input type="radio" name="problem_solving" value="A little" <?php echo (decryptData($resultData['problem_solving']) == 'A little') ? 'checked' : ''; ?>></td>
                                            <td><input type="radio" name="problem_solving" value="Not at all" <?php echo (decryptData($resultData['problem_solving']) == 'Not at all') ? 'checked' : ''; ?>></td>
                                        </tr>
                                        <tr>
                                            <td>Improved research skills</td>
                                            <td><input type="radio" name="research_skills" value="Very much" <?php echo (decryptData($resultData['research_skills']) == 'Very much') ? 'checked' : ''; ?>></td>
                                            <td><input type="radio" name="research_skills" value="Much" <?php echo (decryptData($resultData['research_skills']) == 'Much') ? 'checked' : ''; ?>></td>
                                            <td><input type="radio" name="research_skills" value="A little" <?php echo (decryptData($resultData['research_skills']) == 'A little') ? 'checked' : ''; ?>></td>
                                            <td><input type="radio" name="research_skills" value="Not at all" <?php echo (decryptData($resultData['research_skills']) == 'Not at all') ? 'checked' : ''; ?>></td>
                                        </tr>
                                        <tr>
                                            <td>Improved learning efficiency</td>
                                            <td><input type="radio" name="learning_efficiency" value="Very much" <?php echo (decryptData($resultData['learning_efficiency']) == 'Very much') ? 'checked' : ''; ?>></td>
                                            <td><input type="radio" name="learning_efficiency" value="Much" <?php echo (decryptData($resultData['learning_efficiency']) == 'Much') ? 'checked' : ''; ?>></td>
                                            <td><input type="radio" name="learning_efficiency" value="A little" <?php echo (decryptData($resultData['learning_efficiency']) == 'A little') ? 'checked' : ''; ?>></td>
                                            <td><input type="radio" name="learning_efficiency" value="Not at all" <?php echo (decryptData($resultData['learning_efficiency']) == 'Not at all') ? 'checked' : ''; ?>></td>
                                        </tr>
                                        <tr>
                                            <td>Improved communication skills</td>
                                            <td><input type="radio" name="communication_skills" value="Very much" <?php echo (decryptData($resultData['communication_skills']) == 'Very much') ? 'checked' : ''; ?>></td>
                                            <td><input type="radio" name="communication_skills" value="Much" <?php echo (decryptData($resultData['communication_skills']) == 'Much') ? 'checked' : ''; ?>></td>
                                            <td><input type="radio" name="communication_skills" value="A little" <?php echo (decryptData($resultData['communication_skills']) == 'A little') ? 'checked' : ''; ?>></td>
                                            <td><input type="radio" name="communication_skills" value="Not at all" <?php echo (decryptData($resultData['communication_skills']) == 'Not at all') ? 'checked' : ''; ?>></td>
                                        </tr>
                                        <tr>
                                            <td>More inclined to put up own business</td>
                                            <td><input type="radio" name="more_inclined" value="Very much" <?php echo (decryptData($resultData['more_inclined']) == 'Very much') ? 'checked' : ''; ?>></td>
                                            <td><input type="radio" name="more_inclined" value="Much" <?php echo (decryptData($resultData['more_inclined']) == 'Much') ? 'checked' : ''; ?>></td>
                                            <td><input type="radio" name="more_inclined" value="A little" <?php echo (decryptData($resultData['more_inclined']) == 'A little') ? 'checked' : ''; ?>></td>
                                            <td><input type="radio" name="more_inclined" value="Not at all" <?php echo (decryptData($resultData['more_inclined']) == 'Not at all') ? 'checked' : ''; ?>></td>
                                        </tr>
                                        <tr>
                                            <td>Enhanced team spirit</td>
                                            <td><input type="radio" name="team_spirit" value="Very much" <?php echo (decryptData($resultData['team_spirit']) == 'Very much') ? 'checked' : ''; ?>></td>
                                            <td><input type="radio" name="team_spirit" value="Much" <?php echo (decryptData($resultData['team_spirit']) == 'Much') ? 'checked' : ''; ?>></td>
                                            <td><input type="radio" name="team_spirit" value="A little" <?php echo (decryptData($resultData['team_spirit']) == 'A little') ? 'checked' : ''; ?>></td>
                                            <td><input type="radio" name="team_spirit" value="Not at all" <?php echo (decryptData($resultData['team_spirit']) == 'Not at all') ? 'checked' : ''; ?>></td>
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
                            <?php echo (decryptData($resultData['job_relevance']) == 'Very much') ? 'checked' : ''; ?>>
                            <label for="relevance_very_much">Very much</label><br>

                            <input type="radio" id="relevance_much" name="job_relevance[]" value="Much" 
                            <?php echo (decryptData($resultData['job_relevance']) == 'Much') ? 'checked' : ''; ?>>
                            <label for="relevance_much">Much</label><br>

                            <input type="radio" id="relevance_little" name="job_relevance[]" value="A little" 
                            <?php echo (decryptData($resultData['job_relevance']) == 'A little') ? 'checked' : ''; ?>>
                            <label for="relevance_little">A little</label><br>

                            <input type="radio" id="relevance_not" name="job_relevance[]" value="Not at all" 
                            <?php echo (decryptData($resultData['job_relevance']) == 'Not at all') ? 'checked' : ''; ?>>
                            <label for="relevance_not">Not at all</label>
                        </div>
                    </div>

                    <!-- 27. Have you tried applying for a position relevant to your course? -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label class="form-label">27. Have you tried applying for a position relevant to your course?</label><br>

                            <input type="radio" id="applied_yes" name="applied_course[]" value="Yes" 
                            <?php echo (decryptData($resultData['applied_course']) == 'Yes') ? 'checked' : ''; ?>>
                            <label for="applied_yes">Yes</label><br>

                            <input type="radio" id="applied_no" name="applied_course[]" value="No" 
                            <?php echo (decryptData($resultData['applied_course']) == 'No') ? 'checked' : ''; ?>>
                            <label for="applied_no">No</label>
                        </div>
                    </div>


                    <!-- 28. If yes, reasons for not being hired -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label class="form-label">28. If yes, what are the possible reasons why you're not hired?</label><br>
                            
                            <input type="radio" name="possible_reasons[]" value="I am not qualified for the job"
                            <?php echo (decryptData($resultData['possible_reasons']) == 'I am not qualified for the job') ? 'checked' : ''; ?>>
                            <label for="relevance_very_much">I am not qualified for the job.</label><br>

                            <input type="radio" name="possible_reasons[]" value="I did not pass the employment exams"
                            <?php echo (decryptData($resultData['possible_reasons']) == 'I did not pass the employment exams') ? 'checked' : ''; ?>>
                            <label for="relevance_much">I did not pass the employment exams.</label><br>

                            <input type="radio" name="possible_reasons[]" value="I did not pass the interview"
                            <?php echo (decryptData($resultData['possible_reasons']) == 'I did not pass the interview') ? 'checked' : ''; ?>>
                            <label for="relevance_little">I did not pass the interview.</label><br>

                            <input type="radio" name="possible_reasons[]" value="I lack the necessary competencies for the job"
                            <?php echo (decryptData($resultData['possible_reasons']) == 'I lack the necessary competencies for the job') ? 'checked' : ''; ?>>
                            <label for="relevance_not">I lack the necessary competencies for the job.</label><br>

                            <input type="radio" name="possible_reasons[]" value="I did not pass the medical exams"
                            <?php echo (decryptData($resultData['possible_reasons']) == 'I did not pass the medical exams') ? 'checked' : ''; ?>>
                            <label for="relevance_very_much">I did not pass the medical exams.</label><br>

                            <input type="radio" name="possible_reasons[]" value="There are skills necessary for the job"
                            <?php echo (decryptData($resultData['possible_reasons']) == 'There are skills necessary for the job') ? 'checked' : ''; ?>>
                            <label for="relevance_very_much">There are skills necessary for the job.</label><br>

                            <input type="radio" name="possible_reasons[]" value="Other reasons please specify:"
                            <?php echo (decryptData($resultData['possible_reasons']) == 'Other reasons please specify:') ? 'checked' : ''; ?>>
                            <label for="relevance_much">Other reasons please specify:</label><br>
                            
                            <input type="text" class="form-control" name="other_reasons[]" 
                            value="<?php echo (isset($resultData['other_reasons']) ? decryptData($resultData['other_reasons']) : ''); ?>">
                        </div>
                    </div>


                    <!-- 29. If no, reasons for not applying -->
                    <div class="card mb-3">
                            <div class="card-body">
                                <label class="form-label">29. If no, why?</label><br>
                                
                                <input type="radio" name="present_job[]" value="I do not think I have the necessary skills for jobs related to my course"
                                <?php echo (decryptData($resultData['present_job']) == 'I do not think I have the necessary skills for jobs related to my course') ? 'checked' : ''; ?>>
                                <label for="relevance_very_much">I do not think I have the necessary skills for jobs related to my course.</label><br>
                                
                                <input type="radio" name="present_job[]" value="The jobs available are low-paying"
                                <?php echo (decryptData($resultData['present_job']) == 'The jobs available are low-paying') ? 'checked' : ''; ?>>
                                <label for="relevance_much">The jobs available are low-paying.</label><br>
                                
                                <input type="radio" name="present_job[]" value="There are no jobs available in my field of specialization"
                                <?php echo (decryptData($resultData['present_job']) == 'There are no jobs available in my field of specialization') ? 'checked' : ''; ?>>
                                <label for="relevance_little">There are no jobs available in my field of specialization.</label><br>
                                
                                <input type="radio" name="present_job[]" value="There are no job openings within the vicinity of my residence in my field of specialization"
                                <?php echo (decryptData($resultData['present_job']) == 'There are no job openings within the vicinity of my residence in my field of specialization') ? 'checked' : ''; ?>>
                                <label for="relevance_not">There are no job openings within the vicinity of my residence in my field of specialization.</label><br>
                                
                                <input type="radio" name="present_job[]" value="I have no interest in getting a job related to my field of specialization"
                                <?php echo (decryptData($resultData['present_job']) == 'I have no interest in getting a job related to my field of specialization') ? 'checked' : ''; ?>>
                                <label for="relevance_very_much">I have no interest in getting a job related to my field of specialization.</label><br>
                                
                                <input type="radio" name="present_job[]" value="Other reasons please specify:"
                                <?php echo (decryptData($resultData['present_job']) == 'Other reasons please specify:') ? 'checked' : ''; ?>>
                                <label for="relevance_much">Other reasons please specify:</label><br>
                                
                                <input type="text" class="form-control" name="other_job[]" 
                                value="<?php echo (isset($resultData['other_job']) ? decryptData($resultData['other_job']) : ''); ?>">
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
                                                <td><input type="radio" name="range_module" value="Strength" <?php echo (decryptData($resultData['range_module']) == 'Strength') ? 'checked' : ''; ?>></td>
                                                <td><input type="radio" name="range_module" value="Weakness" <?php echo (decryptData($resultData['range_module']) == 'Weakness') ? 'checked' : ''; ?>></td>
                                                <td><input type="radio" name="range_module" value="Does not apply" <?php echo (decryptData($resultData['range_module']) == 'Does not apply') ? 'checked' : ''; ?>></td>
                                            </tr>
                                            <tr>
                                                <td>Number of optional modules in relation to the number of compulsory (core) modules</td>
                                                <td><input type="radio" name="optional_module" value="Strength" <?php echo (decryptData($resultData['optional_module']) == 'Strength') ? 'checked' : ''; ?>></td>
                                                <td><input type="radio" name="optional_module" value="Weakness" <?php echo (decryptData($resultData['optional_module']) == 'Weakness') ? 'checked' : ''; ?>></td>
                                                <td><input type="radio" name="optional_module" value="Does not apply" <?php echo (decryptData($resultData['optional_module']) == 'Does not apply') ? 'checked' : ''; ?>></td>
                                            </tr>
                                            <tr>
                                                <td>Relevance of the programme to your professional requirements</td>
                                                <td><input type="radio" name="relevance" value="Strength" <?php echo (decryptData($resultData['relevance']) == 'Strength') ? 'checked' : ''; ?>></td>
                                                <td><input type="radio" name="relevance" value="Weakness" <?php echo (decryptData($resultData['relevance']) == 'Weakness') ? 'checked' : ''; ?>></td>
                                                <td><input type="radio" name="relevance" value="Does not apply" <?php echo (decryptData($resultData['relevance']) == 'Does not apply') ? 'checked' : ''; ?>></td>
                                            </tr>
                                            <tr>
                                                <td>Student workload</td>
                                                <td><input type="radio" name="worlkload" value="Strength" <?php echo (decryptData($resultData['worlkload']) == 'Strength') ? 'checked' : ''; ?>></td>
                                                <td><input type="radio" name="worlkload" value="Weakness" <?php echo (decryptData($resultData['worlkload']) == 'Weakness') ? 'checked' : ''; ?>></td>
                                                <td><input type="radio" name="worlkload" value="Does not apply" <?php echo (decryptData($resultData['worlkload']) == 'Does not apply') ? 'checked' : ''; ?>></td>
                                            </tr>
                                            <tr>
                                                <td>Problem solving</td>
                                                <td><input type="radio" name="solving" value="Strength" <?php echo (decryptData($resultData['solving']) == 'Strength') ? 'checked' : ''; ?>></td>
                                                <td><input type="radio" name="solving" value="Weakness" <?php echo (decryptData($resultData['solving']) == 'Weakness') ? 'checked' : ''; ?>></td>
                                                <td><input type="radio" name="solving" value="Does not apply" <?php echo (decryptData($resultData['solving']) == 'Does not apply') ? 'checked' : ''; ?>></td>
                                            </tr>
                                            <tr>
                                                <td>Inter-disciplinary learning</td>
                                                <td><input type="radio" name="learning" value="Strength" <?php echo (decryptData($resultData['learning']) == 'Strength') ? 'checked' : ''; ?>></td>
                                                <td><input type="radio" name="learning" value="Weakness" <?php echo (decryptData($resultData['learning']) == 'Weakness') ? 'checked' : ''; ?>></td>
                                                <td><input type="radio" name="learning" value="Does not apply" <?php echo (decryptData($resultData['learning']) == 'Does not apply') ? 'checked' : ''; ?>></td>
                                            </tr>
                                            <tr>
                                                <td>Work placement/attachment</td>
                                                <td><input type="radio" name="placement" value="Strength" <?php echo (decryptData($resultData['placement']) == 'Strength') ? 'checked' : ''; ?>></td>
                                                <td><input type="radio" name="placement" value="Weakness" <?php echo (decryptData($resultData['placement']) == 'Weakness') ? 'checked' : ''; ?>></td>
                                                <td><input type="radio" name="placement" value="Does not apply" <?php echo (decryptData($resultData['placement']) == 'Does not apply') ? 'checked' : ''; ?>></td>
                                            </tr>
                                            <tr>
                                                <td>Teaching/Learning environment</td>
                                                <td><input type="radio" name="environment" value="Strength" <?php echo (decryptData($resultData['environment']) == 'Strength') ? 'checked' : ''; ?>></td>
                                                <td><input type="radio" name="environment" value="Weakness" <?php echo (decryptData($resultData['environment']) == 'Weakness') ? 'checked' : ''; ?>></td>
                                                <td><input type="radio" name="environment" value="Does not apply" <?php echo (decryptData($resultData['environment']) == 'Does not apply') ? 'checked' : ''; ?>></td>
                                            </tr>
                                            <tr>
                                                <td>Quality of delivery</td>
                                                <td><input type="radio" name="quality" value="Strength" <?php echo (decryptData($resultData['quality']) == 'Strength') ? 'checked' : ''; ?>></td>
                                                <td><input type="radio" name="quality" value="Weakness" <?php echo (decryptData($resultData['quality']) == 'Weakness') ? 'checked' : ''; ?>></td>
                                                <td><input type="radio" name="quality" value="Does not apply" <?php echo (decryptData($resultData['quality']) == 'Does not apply') ? 'checked' : ''; ?>></td>
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
                            <?php echo (decryptData($resultData['job_satisfaction']) == 'Very much') ? 'checked' : ''; ?>>
                            <label for="satisfaction_very_much">Very much</label><br>

                            <input type="radio" id="satisfaction_much" name="job_satisfaction" value="Much"
                            <?php echo (decryptData($resultData['job_satisfaction']) == 'Much') ? 'checked' : ''; ?>>
                            <label for="satisfaction_much">Much</label><br>

                            <input type="radio" id="satisfaction_little" name="job_satisfaction" value="A little"
                            <?php echo (decryptData($resultData['job_satisfaction']) == 'A little') ? 'checked' : ''; ?>>
                            <label for="satisfaction_little">A little</label><br>

                            <input type="radio" id="satisfaction_not" name="job_satisfaction" value="Not at all"
                            <?php echo (decryptData($resultData['job_satisfaction']) == 'Not at all') ? 'checked' : ''; ?>>
                            <label for="satisfaction_not">Not at all</label>
                        </div>
                    </div>


                    <!-- 32. Do you intend to stay in the same job/profession? -->
                    <div class="card mb-3">
                            <div class="card-body">
                                <label class="form-label">32. Do you intend to stay in the same job/profession?</label><br>

                                <input type="radio" id="stay_yes" name="job_stay" value="Yes"
                                <?php echo (decryptData($resultData['job_stay']) == 'Yes') ? 'checked' : ''; ?>>
                                <label for="stay_yes">Yes</label><br>

                                <input type="radio" id="stay_no" name="job_stay" value="No"
                                <?php echo (decryptData($resultData['job_stay']) == 'No') ? 'checked' : ''; ?>>
                                <label for="stay_no">No</label><br>

                                <input type="radio" id="stay_other" name="job_stay" value="Other"
                                <?php echo (decryptData($resultData['job_stay']) == 'Other') ? 'checked' : ''; ?>>
                                <label for="stay_other">Others:</label>
                                <input type="text" class="form-control mt-2" id="stay_other_text" name="stay_other_text"
                                value="<?php echo (decryptData($resultData['job_stay']) == 'Other') ? decryptData($resultData['stay_other_text']) : ''; ?>"
                                <?php echo (decryptData($resultData['job_stay']) == 'Other') ? '' : 'disabled'; ?>>
                            </div>
                        </div>


                    <!-- status -->
                    <input type="hidden" id="status" name="status" value="pending">

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Submit</button>

                </form>
            </div>
        </div>

     


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