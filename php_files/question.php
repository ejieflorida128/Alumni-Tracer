<?php
ob_start(); // Start buffering the output
session_start();
include '../connection/conn.php'; // Database connection
include('../include/sidebar.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input values to avoid SQL injection
    $name = isset($_POST['name']) ? mysqli_real_escape_string($conn, $_POST['name']) : '';
    $sex = isset($_POST['sex']) ? mysqli_real_escape_string($conn, implode(", ", $_POST['sex'])) : '';
    $age = isset($_POST['age']) ? mysqli_real_escape_string($conn, $_POST['age']) : '';
    $degree = isset($_POST['degree']) ? mysqli_real_escape_string($conn, $_POST['degree']) : '';
    $year_awarded = isset($_POST['year_awarded']) ? mysqli_real_escape_string($conn, $_POST['year_awarded']) : '';
    $current_study = isset($_POST['current_study']) ? mysqli_real_escape_string($conn, implode(", ", $_POST['current_study'])) : '';
    $if_no_jobs = isset($_POST['if_no_jobs']) ? mysqli_real_escape_string($conn, $_POST['if_no_jobs']) : '';
    $if_yes_details = isset($_POST['if_yes_details']) ? mysqli_real_escape_string($conn, $_POST['if_yes_details']) : '';
    $pursue_reasons = isset($_POST['pursue_reasons']) ? mysqli_real_escape_string($conn, $_POST['pursue_reasons']) : '';
    $current_position = isset($_POST['current_position']) ? mysqli_real_escape_string($conn, implode(", ", $_POST['current_position'])) : '';
    $other_position = isset($_POST['other_position']) ? mysqli_real_escape_string($conn, implode(", ", $_POST['other_position'])) : '';

    // New fields
    $time_to_job = isset($_POST['time_to_job']) ? mysqli_real_escape_string($conn, $_POST['time_to_job']) : '';
    $time_gap = isset($_POST['time_gap']) ? mysqli_real_escape_string($conn, $_POST['time_gap']) : '';
    $employment_history = isset($_POST['employment_history']) ? mysqli_real_escape_string($conn, $_POST['employment_history']) : '';
    $job_info_source = isset($_POST['job_info_source']) ? mysqli_real_escape_string($conn, implode(", ", $_POST['job_info_source'])) : '';
    $other_job_info = isset($_POST['other_job_info']) ? mysqli_real_escape_string($conn, implode(", ", $_POST['other_job_info'])) : '';
    $job_qualifications = isset($_POST['job_qualifications']) ? mysqli_real_escape_string($conn, $_POST['job_qualifications']) : '';
    $gross_salary = isset($_POST['gross_salary']) ? mysqli_real_escape_string($conn, $_POST['gross_salary']) : '';
    $job_benefits = isset($_POST['job_benefits']) ? mysqli_real_escape_string($conn, $_POST['job_benefits']) : '';
    $work_location = isset($_POST['work_location']) ? mysqli_real_escape_string($conn, $_POST['work_location']) : '';
    $num_employees = isset($_POST['num_employees']) ? mysqli_real_escape_string($conn, implode(", ", $_POST['num_employees'])) : '';

    // Additional new fields
    $work_nature = isset($_POST['work_nature']) ? mysqli_real_escape_string($conn, implode(", ", $_POST['work_nature'])) : '';
    $other_work_nature_text = isset($_POST['other_work_nature_text']) ? mysqli_real_escape_string($conn, implode(", ", $_POST['other_work_nature_text'])) : '';
    $job_problem = isset($_POST['job_problem']) ? mysqli_real_escape_string($conn, implode(", ", $_POST['job_problem'])) : '';
    $problem_elaboration = isset($_POST['problem_elaboration']) ? mysqli_real_escape_string($conn, $_POST['problem_elaboration']) : '';
    $self_employed_reason = isset($_POST['self_employed_reason']) ? mysqli_real_escape_string($conn, $_POST['self_employed_reason']) : '';
    $knowledge_enhance = isset($_POST['knowledge_enhance']) ? mysqli_real_escape_string($conn, $_POST['knowledge_enhance']) : '';
    $problem_solving = isset($_POST['problem_solving']) ? mysqli_real_escape_string($conn, $_POST['problem_solving']) : '';
    $research_skills = isset($_POST['research_skills']) ? mysqli_real_escape_string($conn, $_POST['research_skills']) : '';
    $learning_efficiency = isset($_POST['learning_efficiency']) ? mysqli_real_escape_string($conn, $_POST['learning_efficiency']) : '';
    $communication_skills = isset($_POST['communication_skills']) ? mysqli_real_escape_string($conn, $_POST['communication_skills']) : '';
    $more_inclined = isset($_POST['more_inclined']) ? mysqli_real_escape_string($conn, $_POST['more_inclined']) : '';
    $team_spirit = isset($_POST['team_spirit']) ? mysqli_real_escape_string($conn, $_POST['team_spirit']) : '';
    $job_relevance = isset($_POST['job_relevance']) ? mysqli_real_escape_string($conn, implode(", ", $_POST['job_relevance'])) : '';
    $applied_course = isset($_POST['applied_course']) ? mysqli_real_escape_string($conn, implode(", ", $_POST['applied_course'])) : '';
    $possible_reasons = isset($_POST['possible_reasons']) ? mysqli_real_escape_string($conn, implode(", ", $_POST['possible_reasons'])) : '';
    $other_reasons = isset($_POST['other_reasons']) ? mysqli_real_escape_string($conn, implode(", ", $_POST['other_reasons'])) : '';
    $present_job = isset($_POST['present_job']) ? mysqli_real_escape_string($conn, implode(", ", $_POST['present_job'])) : '';
    $other_job = isset($_POST['other_job']) ? mysqli_real_escape_string($conn, implode(", ", $_POST['other_job'])) : '';

    $range_module = isset($_POST['range_module']) ? mysqli_real_escape_string($conn, $_POST['range_module']) : '';
    $optional_module = isset($_POST['optional_module']) ? mysqli_real_escape_string($conn, $_POST['optional_module']) : '';
    $relevance = isset($_POST['relevance']) ? mysqli_real_escape_string($conn, $_POST['relevance']) : '';
    $worlkload = isset($_POST['worlkload']) ? mysqli_real_escape_string($conn, $_POST['worlkload']) : '';
    $solving = isset($_POST['solving']) ? mysqli_real_escape_string($conn, $_POST['solving']) : '';
    $learning = isset($_POST['learning']) ? mysqli_real_escape_string($conn, $_POST['learning']) : '';
    $placement = isset($_POST['placement']) ? mysqli_real_escape_string($conn, $_POST['placement']) : '';
    $environment = isset($_POST['environment']) ? mysqli_real_escape_string($conn, $_POST['environment']) : '';
    $quality = isset($_POST['quality']) ? mysqli_real_escape_string($conn, $_POST['quality']) : '';


    $job_satisfaction = isset($_POST['job_satisfaction']) ? mysqli_real_escape_string($conn, implode(", ", $_POST['job_satisfaction'])) : '';
    $job_stay = isset($_POST['job_stay']) ? mysqli_real_escape_string($conn, implode(", ", $_POST['job_stay'])) : '';
    $stay_other_text = isset($_POST['stay_other_text']) ? mysqli_real_escape_string($conn, implode(", ", $_POST['stay_other_text'])) : '';

    // SQL query to insert the data
    $query = "INSERT INTO l_study_response (name, sex, age, degree, year_awarded, current_study, if_no_jobs, if_yes_details, pursue_reasons, current_position, other_position, time_to_job, time_gap, 
                    employment_history, job_info_source, other_job_info, job_qualifications, gross_salary, job_benefits, work_location, num_employees, work_nature, other_work_nature_text, job_problem, 
                    problem_elaboration, self_employed_reason, knowledge_enhance, problem_solving, research_skills, learning_efficiency, communication_skills, more_inclined, team_spirit, job_relevance, 
                    applied_course, possible_reasons, other_reasons, present_job, other_job, range_module, optional_module, relevance, worlkload, solving, learning, placement, environment, quality, job_satisfaction, job_stay, stay_other_text) 
              VALUES ('$name', '$sex', '$age', '$degree', '$year_awarded', '$current_study', '$if_no_jobs', '$if_yes_details', '$pursue_reasons', '$current_position', '$other_position', '$time_to_job', 
              '$time_gap', '$employment_history', '$job_info_source', '$other_job_info', '$job_qualifications', '$gross_salary', '$job_benefits', '$work_location', '$num_employees', '$work_nature', 
              '$other_work_nature_text', '$job_problem', '$problem_elaboration', '$self_employed_reason', '$knowledge_enhance', '$problem_solving', '$research_skills', '$learning_efficiency', 
              '$communication_skills', '$more_inclined', '$team_spirit', '$job_relevance', '$applied_course', '$possible_reasons', '$other_reasons', '$present_job', '$other_job', '$range_module', 
              '$optional_module', '$relevance', '$worlkload', '$solving', '$learning', '$placement', '$environment', '$quality', '$job_satisfaction', '$job_stay', '$stay_other_text')";

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

        <div class="container-fluid pt-4 px-4">
            <div class="bg-light rounded p-4" style="width:fit-content">
                <h3 class="mb-4">A Tracer Study of the BSIT Graduates-Southern Leyte State University from School Years 2015-2018</h3>
                <form action="" method="POST">

                    <!-- 1. Name -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label for="name" class="form-label">1. Name:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                    </div>

                    <!-- 2. Sex -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label class="form-label">2. Sex:</label><br>
                            <input type="checkbox" id="male" name="sex[]" value="Male">
                            <label for="male">Male</label><br>
                            <input type="checkbox" id="female" name="sex[]" value="Female">
                            <label for="female">Female</label>
                        </div>
                    </div>

                    <!-- 3. Age -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label for="age" class="form-label">3. Age:</label>
                            <input type="number" class="form-control" id="age" name="age" required>
                        </div>
                    </div>

                    <!-- 4. Degree Title -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label for="degree" class="form-label">4. Title (with major) of degree received at SLSU-TO:</label>
                            <input type="text" class="form-control" id="degree" name="degree" required>
                        </div>
                    </div>

                    <!-- 5. Year Awarded Degree -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label for="year_awarded" class="form-label">5. Year awarded degree:</label>
                            <input type="text" class="form-control" id="year_awarded" name="year_awarded" required>
                        </div>
                    </div>

                    <!-- 6. Are you currently taking studies? -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label class="form-label">6. Are you currently taking studies? (e.g. Masters of Science in Information Technology)</label><br>
                            <input type="checkbox" id="yes_study" name="current_study[]" value="Yes">
                            <label for="yes_study">Yes</label><br>
                            <input type="checkbox" id="no_study" name="current_study[]" value="No">
                            <label for="no_study">No</label>
                        </div>
                    </div>

                    <!-- 7. If No, Job Contemplation -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label for="if_no_jobs" class="form-label">7. If No, What type of jobs were you contemplating by choosing your degree from SLSU-TO?</label>
                            <input type="text" class="form-control" id="if_no_jobs" name="if_no_jobs">
                        </div>
                    </div>

                    <!-- 8. If YES, Details -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label for="if_yes_details" class="form-label">8. If YES, please give details as follows: Title of Programme (in full), Institution(s), Period Enrolled (from-to), Attendance Full Time/Part Time/Correspondence and Distance Education, Source of Funding</label>
                            <textarea class="form-control" id="if_yes_details" name="if_yes_details"></textarea>
                        </div>
                    </div>

                    <!-- 9. Reasons for Pursuing Further Studies -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label for="pursue_reasons" class="form-label">9. Main reasons for pursuing further studies:</label>
                            <textarea class="form-control" id="pursue_reasons" name="pursue_reasons"></textarea>
                        </div>
                    </div>

                    <!-- 10. Current Paid Work Position -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label class="form-label">10. Which one of the following best describes your current position with regard to paid work?</label><br>
                            <input type="checkbox" name="current_position[]" value="Working full-time">
                            <label>Working full-time</label><br>
                            <input type="checkbox" name="current_position[]" value="Working part-time but seeking full-time work">
                            <label>Working part-time but seeking full-time work</label><br>
                            <input type="checkbox" name="current_position[]" value="Self-employed">
                            <label>Self-employed</label><br>
                            <input type="checkbox" name="current_position[]" value="Not working and looking for a job">
                            <label>Not working and looking for a job</label><br>
                            <input type="checkbox" name="current_position[]" value="Not working and unavailable for paid work">
                            <label>Not working and unavailable for paid work</label><br>
                            <input type="checkbox" name="current_position[]" value="Others:">
                            <label>Others:</label>
                            <input type="text" class="form-control" name="other_position[]">
                        </div>
                    </div>

                    <!-- 11. Time to Find a Job -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label for="time_to_job" class="form-label">11. How long did it take you to find a job since obtaining your degree and your first employment?</label>
                            <input type="text" class="form-control" id="time_to_job" name="time_to_job">
                        </div>
                    </div>

                    <!-- 12. Time Gap Between Degree and Employment -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label for="time_gap" class="form-label">12. Please give reasons for any time gap between obtaining your degree and your first employment:</label>
                            <textarea class="form-control" id="time_gap" name="time_gap"></textarea>
                        </div>
                    </div>

                    <!-- 13. Employment History -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label for="employment_history" class="form-label">13. Employment history (since obtaining first degree up to present employment): (Name of Employer, If self-employed, please state area of activity, Period employed (From-To), Post held, Reasons for leaving job (where applicable)</label>
                            <textarea class="form-control" id="employment_history" name="employment_history"></textarea>
                        </div>
                    </div>

                    <!-- 14. How did you come to know about your current job? -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label class="form-label">14. How did you come to know about your current job?</label><br>
                            <input type="checkbox" name="job_info_source[]" value="Through friends">
                            <label>Through friends</label><br>
                            <input type="checkbox" name="job_info_source[]" value="Through relatives">
                            <label>Through relatives</label><br>
                            <input type="checkbox" name="job_info_source[]" value="Through written enquiries">
                            <label>Through written enquiries</label><br>
                            <input type="checkbox" name="job_info_source[]" value="Press advertisement">
                            <label>Press advertisement</label><br>
                            <input type="checkbox" name="job_info_source[]" value="Others:">
                            <label>Others:</label>
                            <input type="text" class="form-control" name="other_job_info[]">
                        </div>
                    </div>

                    <!-- 15. Qualifications and other attributes required for the job -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label for="job_qualifications" class="form-label">15. Qualifications and other attributes required for the job:</label>
                            <textarea class="form-control" id="job_qualifications" name="job_qualifications"></textarea>
                        </div>
                    </div>

                    <!-- 16. Gross monthly salary -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label for="gross_salary" class="form-label">16. Gross monthly salary:</label>
                            <input type="text" class="form-control" id="gross_salary" name="gross_salary">
                        </div>
                    </div>

                    <!-- 17. Other benefits attached to the job -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label for="job_benefits" class="form-label">17. Please list any other benefits attached to the job:</label>
                            <textarea class="form-control" id="job_benefits" name="job_benefits"></textarea>
                        </div>
                    </div>

                    <!-- 18. Location of place of work -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label for="work_location" class="form-label">18. Location of place of work:</label>
                            <input type="text" class="form-control" id="work_location" name="work_location">
                        </div>
                    </div>

                    <!-- 19. Number of employees -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label for="num_employees" class="form-label">19. Number of employees (approximately):</label><br>
                            <input type="checkbox" id="less_10" name="num_employees[]" value="Less than 10">
                            <label for="less_10">Less than 10</label><br>
                            <input type="checkbox" id="11_50" name="num_employees[]" value="11 to 50">
                            <label for="11_50">11 to 50</label><br>
                            <input type="checkbox" id="51_200" name="num_employees[]" value="51 to 200">
                            <label for="51_200">51 to 200</label><br>
                            <input type="checkbox" id="over_200" name="num_employees[]" value="Over 200">
                            <label for="over_200">Over 200</label>
                        </div>
                    </div>

                    <!-- 20. Nature of work performed -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label for="work_nature" class="form-label">20. Nature of work performed:</label><br>
                            <input type="checkbox" id="managerial" name="work_nature[]" value="Managerial">
                            <label for="managerial">Managerial</label><br>
                            <input type="checkbox" id="clerical" name="work_nature[]" value="Clerical">
                            <label for="clerical">Clerical</label><br>
                            <input type="checkbox" id="supervisory" name="work_nature[]" value="Supervisory">
                            <label for="supervisory">Supervisory</label><br>
                            <input type="checkbox" id="support" name="work_nature[]" value="Support Service">
                            <label for="support">Support Service</label><br>
                            <input type="checkbox" id="other_work_nature" name="work_nature[]" value="Other:">
                            <label for="other_work_nature">Other:</label>
                            <input type="text" class="form-control" id="other_work_nature_text" name="other_work_nature_text[]">
                        </div>
                    </div>

                    <!-- 21. Do you face any major problem in your job assignments? -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label class="form-label">21. Do you face any major problem in your job assignments?</label><br>
                            <input type="checkbox" id="job_problem_yes" name="job_problem[]" value="Yes">
                            <label for="job_problem_yes">Yes</label><br>
                            <input type="checkbox" id="job_problem_no" name="job_problem[]" value="No">
                            <label for="job_problem_no">No</label>
                        </div>
                    </div>

                    <!-- 22. If yes, please elaborate -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label for="problem_elaboration" class="form-label">22. If yes, please elaborate:</label>
                            <textarea class="form-control" id="problem_elaboration" name="problem_elaboration"></textarea>
                        </div>
                    </div>

                    <!-- 23. If you are self-employed, what made you decide to become self-employed? -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label for="self_employed_reason" class="form-label">23. If you are self-employed, what made you decide to become self-employed?</label>
                            <textarea class="form-control" id="self_employed_reason" name="self_employed_reason"></textarea>
                        </div>
                    </div>

                    <!-- 24. Contribution of SLSU program to personal knowledge, skills, and attitudes -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label class="form-label">24. How would you rate the contribution of you programme of study at SLSU-TO to your personal knowledge, skills and atitudes? (Tick as appropriate)</label>
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
                                        <td><input type="checkbox" name="knowledge_enhance" value="Very much"></td>
                                        <td><input type="checkbox" name="knowledge_enhance" value="Much"></td>
                                        <td><input type="checkbox" name="knowledge_enhance" value="A little"></td>
                                        <td><input type="checkbox" name="knowledge_enhance" value="Not at all"></td>
                                    </tr>
                                    <tr>
                                        <td>Improved problem-solving skills</td>
                                        <td><input type="checkbox" name="problem_solving" value="Very much"></td>
                                        <td><input type="checkbox" name="problem_solving" value="Much"></td>
                                        <td><input type="checkbox" name="problem_solving" value="A little"></td>
                                        <td><input type="checkbox" name="problem_solving" value="Not at all"></td>
                                    </tr>
                                    <tr>
                                        <td>Improved research skills</td>
                                        <td><input type="checkbox" name="research_skills" value="Very much"></td>
                                        <td><input type="checkbox" name="research_skills" value="Much"></td>
                                        <td><input type="checkbox" name="research_skills" value="A little"></td>
                                        <td><input type="checkbox" name="research_skills" value="Not at all"></td>
                                    </tr>
                                    <tr>
                                        <td>Improved learning efficiency</td>
                                        <td><input type="checkbox" name="learning_efficiency" value="Very much"></td>
                                        <td><input type="checkbox" name="learning_efficiency" value="Much"></td>
                                        <td><input type="checkbox" name="learning_efficiency" value="A little"></td>
                                        <td><input type="checkbox" name="learning_efficiency" value="Not at all"></td>
                                    </tr>
                                    <tr>
                                        <td>Improved communication skills</td>
                                        <td><input type="checkbox" name="communication_skills" value="Very much"></td>
                                        <td><input type="checkbox" name="communication_skills" value="Much"></td>
                                        <td><input type="checkbox" name="communication_skills" value="A little"></td>
                                        <td><input type="checkbox" name="communication_skills" value="Not at all"></td>
                                    </tr>
                                    <tr>
                                        <td>More inclined to put up own business</td>
                                        <td><input type="checkbox" name="more_inclined" value="Very much"></td>
                                        <td><input type="checkbox" name="more_inclined" value="Much"></td>
                                        <td><input type="checkbox" name="more_inclined" value="A little"></td>
                                        <td><input type="checkbox" name="more_inclined" value="Not at all"></td>
                                    </tr>
                                    <tr>
                                        <td>Enhanced team spirit</td>
                                        <td><input type="checkbox" name="team_spirit" value="Very much"></td>
                                        <td><input type="checkbox" name="team_spirit" value="Much"></td>
                                        <td><input type="checkbox" name="team_spirit" value="A little"></td>
                                        <td><input type="checkbox" name="team_spirit" value="Not at all"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- 25. Relevance of program to current job -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label class="form-label">25. Was your program of study at SLSU relevant to your present job?</label><br>
                            <input type="checkbox" id="relevance_very_much" name="job_relevance[]" value="Very much">
                            <label for="relevance_very_much">Very much</label><br>
                            <input type="checkbox" id="relevance_much" name="job_relevance[]" value="Much">
                            <label for="relevance_much">Much</label><br>
                            <input type="checkbox" id="relevance_little" name="job_relevance[]" value="A little">
                            <label for="relevance_little">A little</label><br>
                            <input type="checkbox" id="relevance_not" name="job_relevance[]" value="Not at all">
                            <label for="relevance_not">Not at all</label>
                        </div>
                    </div>

                    <!-- 26. Have you tried applying for a position relevant to your course? -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label class="form-label">26. Have you tried applying for a position relevant to your course?</label><br>
                            <input type="checkbox" id="applied_yes" name="applied_course[]" value="Yes">
                            <label for="applied_yes">Yes</label><br>
                            <input type="checkbox" id="applied_no" name="applied_course[]" value="No">
                            <label for="applied_no">No</label>
                        </div>
                    </div>

                    <!-- 27. If yes, reasons for not being hired -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label class="form-label">27. If yes, what are the possible reasons why you're not hired?</label><br>
                            <input type="checkbox" name="possible_reasons[]" value="I am not qualified for the job">
                            <label for="relevance_very_much">I am not qualified for the job.</label><br>
                            <input type="checkbox" name="possible_reasons[]" value="I did not pass the employment exams">
                            <label for="relevance_much">I did not pass the employment exams.</label><br>
                            <input type="checkbox"  name="possible_reasons[]" value="I did not pass the interview">
                            <label for="relevance_little">I did not pass the interview.</label><br>
                            <input type="checkbox"  name="possible_reasons[]" value="I lack the necessary competencies for the job">
                            <label for="relevance_not">I lack the necessary competencies for the job.</label><br>
                            <input type="checkbox"  name="possible_reasons[]" value="I did not pass the medical exams">
                            <label for="relevance_very_much">I did not pass the medical exams.</label><br>
                            <input type="checkbox"  name="possible_reasons[]" value="There are skills necessary for the job">
                            <label for="relevance_very_much">There are skills necessary for the job.</label><br>
                            <input type="checkbox"  name="possible_reasons[]" value="Other reasons please specify:">
                            <label for="relevance_much">Other reasons please specify:</label><br>
                            <input type="text" class="form-control" name="other_reasons[]">
                        </div>
                    </div>

                    <!-- 28. If no, reasons for not applying -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label class="form-label">28. If no, why?</label><br>
                            <input type="checkbox" name="present_job[]" value="I do not think I have the necessary skills for jobs related to my course">
                            <label for="relevance_very_much">I do not think I have the necessary skills for jobs related to my course.</label><br>
                            <input type="checkbox" name="present_job[]" value="The jobs available are low-paying">
                            <label for="relevance_much">The jobs available are low-paying.</label><br>
                            <input type="checkbox"  name="present_job[]" value="There are no jobs available in my field of specialization">
                            <label for="relevance_little">There are no jobs available in my field of specialization.</label><br>
                            <input type="checkbox"  name="present_job[]" value="There are no job openings within the vicinity of my residence in my field of specialization">
                            <label for="relevance_not">There are no job openings within the vicinity of my residence in my field of specialization.</label><br>
                            <input type="checkbox"  name="present_job[]" value="I have no interest in getting a job related to my field of specialization">
                            <label for="relevance_very_much">I have no interest in getting a job related to my field of specialization.</label><br>
                            <input type="checkbox"  name="present_job[]" value="Other reasons please specify:">
                            <label for="relevance_much">Other reasons please specify:</label><br>
                            <input type="text" class="form-control" name="other_job[]">
                        </div>
                    </div>

                    <!-- 29. Major strengths and weaknesses of the SLSU program -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label for="program_strengths_weaknesses" class="form-label">29. Which of the following best represent major strengths and weaknesses of the SLSU-TO programme that you attended? (Check as appropriate)</label>
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
                                        <td><input type="checkbox" name="range_module" value="Strength"></td>
                                        <td><input type="checkbox" name="range_module" value="Weakness"></td>
                                        <td><input type="checkbox" name="range_module" value="Does not apply"></td>
                                    </tr>
                                    <tr>
                                        <td>Number of optional modules in relation to the number of compulsory (core) modules</td>
                                        <td><input type="checkbox" name="optional_module" value="Strength"></td>
                                        <td><input type="checkbox" name="optional_module" value="Weakness"></td>
                                        <td><input type="checkbox" name="optional_module" value="Does not apply"></td>
                                    </tr>
                                    <tr>
                                        <td>Relevance of the programme to your professional requirements</td>
                                        <td><input type="checkbox" name="relevance" value="Strength"></td>
                                        <td><input type="checkbox" name="relevance" value="Weakness"></td>
                                        <td><input type="checkbox" name="relevance" value="Does not apply"></td>
                                    </tr>
                                    <tr>
                                        <td>Student workload</td>
                                        <td><input type="checkbox" name="worlkload" value="Strength"></td>
                                        <td><input type="checkbox" name="worlkload" value="Weakness"></td>
                                        <td><input type="checkbox" name="worlkload" value="Does not apply"></td>
                                    </tr>
                                    <tr>
                                        <td>Problem solving</td>
                                        <td><input type="checkbox" name="solving" value="Strength"></td>
                                        <td><input type="checkbox" name="solving" value="Weakness"></td>
                                        <td><input type="checkbox" name="solving" value="Does not apply"></td>
                                    </tr>
                                    <tr>
                                        <td>Inter-disciplinary learning</td>
                                        <td><input type="checkbox" name="learning" value="Strength"></td>
                                        <td><input type="checkbox" name="learning" value="Weakness"></td>
                                        <td><input type="checkbox" name="learning" value="Does not apply"></td>
                                    </tr>
                                    <tr>
                                        <td>Work placement/attachment</td>
                                        <td><input type="checkbox" name="placement" value="Strength"></td>
                                        <td><input type="checkbox" name="placement" value="Weakness"></td>
                                        <td><input type="checkbox" name="placement" value="Does not apply"></td>
                                    </tr>
                                    <tr>
                                        <td>Teaching/Learning environment</td>
                                        <td><input type="checkbox" name="environment" value="Strength"></td>
                                        <td><input type="checkbox" name="environment" value="Weakness"></td>
                                        <td><input type="checkbox" name="environment" value="Does not apply"></td>
                                    </tr>
                                    <tr>
                                        <td>Quality of delivery</td>
                                        <td><input type="checkbox" name="quality" value="Strength"></td>
                                        <td><input type="checkbox" name="quality" value="Weakness"></td>
                                        <td><input type="checkbox" name="quality" value="Does not apply"></td>
                                    </tr>
                                    <!-- Continue for other strengths and weaknesses... -->
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- 30. Satisfaction with current job -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label class="form-label">30. How satisfied are you with your current job?</label><br>
                            <input type="checkbox" id="satisfaction_very_much" name="job_satisfaction[]" value="Very much">
                            <label for="satisfaction_very_much">Very much</label><br>
                            <input type="checkbox" id="satisfaction_much" name="job_satisfaction[]" value="Much">
                            <label for="satisfaction_much">Much</label><br>
                            <input type="checkbox" id="satisfaction_little" name="job_satisfaction[]" value="A little">
                            <label for="satisfaction_little">A little</label><br>
                            <input type="checkbox" id="satisfaction_not" name="job_satisfaction[]" value="Not at all">
                            <label for="satisfaction_not">Not at all</label>
                        </div>
                    </div>

                    <!-- 31. Do you intend to stay in the same job/profession? -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <label class="form-label">31. Do you intend to stay in the same job/profession?</label><br>
                            <input type="checkbox" id="stay_yes" name="job_stay[]" value="Yes">
                            <label for="stay_yes">Yes</label><br>
                            <input type="checkbox" id="stay_no" name="job_stay[]" value="No">
                            <label for="stay_no">No</label><br>
                            <input type="checkbox" id="stay_other" name="job_stay[]" value="Other:">
                            <label for="stay_other">Others:</label>
                            <input type="text" class="form-control" id="stay_other_text" name="stay_other_text[]">
                        </div>
                    </div>
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