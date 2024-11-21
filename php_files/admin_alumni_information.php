<?php
session_start();
include("../connection/conn.php");

// Handle the deletion logic
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_query = "DELETE FROM l_study_response WHERE id = $delete_id";
    if (mysqli_query($conn, $delete_query)) {
        echo "<script>alert('Record deleted successfully'); window.location.href='admin_alumni_information.php';</script>";
    } else {
        echo "<script>alert('Error deleting record'); window.location.href='admin_alumni_information.php';</script>";
    }
}

// Handle the update logic
if (isset($_POST['update_id'])) {
    $update_id = $_POST['update_id'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $choose_school = mysqli_real_escape_string($conn, $_POST['choose_school']);

    $update_query = "UPDATE l_study_response SET name = '$name', choose_school = '$choose_school' WHERE id = $update_id";
    if (mysqli_query($conn, $update_query)) {
        echo "<script>alert('Record updated successfully'); window.location.href='admin_alumni_information.php';</script>";
    } else {
        echo "<script>alert('Error updating record'); window.location.href='admin_alumni_information.php';</script>";
    }
}

// Fetch all records to display
$select_info = mysqli_query($conn, "SELECT * FROM l_study_response");

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
                    <a href="admin_alumni_directory.php" class="nav-item nav-link "><i class="fa fa-address-book me-2"></i>Alumni Directory</a>
                    <a href="admin_alumni_information.php" class="nav-item nav-link active"><i class="fa fa-info-circle me-2"></i>Alumni Info</a>
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
                <!-- start aria ug code -->

                <?php
                if (mysqli_num_rows($select_info) > 0) {
                    echo '<div class="row">';
                    while ($fetch_info = mysqli_fetch_assoc($select_info)) {
                ?>
                        <div class="col-sm-3 mb-4">
                            <div class="card">
                                <img class="card-img-top" src="..." alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title text-center"><?php echo $fetch_info['name']; ?></h5>
                                    <p class="card-text"><?php echo $fetch_info['choose_school']; ?></p>
                                    <!-- Update and Delete buttons -->
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateModal" 
                                        data-id="<?php echo $fetch_info['id']; ?>" 
                                        data-name="<?php echo $fetch_info['name']; ?>" 
                                        data-school="<?php echo $fetch_info['choose_school']; ?>" 
                                        data-sex="<?php echo $fetch_info['sex']; ?>"
                                        data-age="<?php echo $fetch_info['age']; ?>"
                                        data-degree="<?php echo $fetch_info['degree']; ?>"

                                        data-year_awarded="<?php echo $fetch_info['year_awarded']; ?>"
                                        data-current_study="<?php echo $fetch_info['current_study']; ?>"
                                        data-if_no_jobs="<?php echo $fetch_info['if_no_jobs']; ?>"
                                        data-if_yes_details="<?php echo $fetch_info['if_yes_details']; ?>"
                                        data-pursue_reasons="<?php echo $fetch_info['pursue_reasons']; ?>"
                                        data-current_position="<?php echo $fetch_info['current_position']; ?>"
                                        data-other_position="<?php echo $fetch_info['other_position']; ?>"
                                        data-time_to_job="<?php echo $fetch_info['time_to_job']; ?>"
                                        data-time_gap="<?php echo $fetch_info['time_gap']; ?>"
                                        data-employment_history="<?php echo $fetch_info['employment_history']; ?>"
                                        data-job_info_source="<?php echo $fetch_info['job_info_source']; ?>"
                                        data-other_job_info="<?php echo $fetch_info['other_job_info']; ?>"
                                        data-job_qualifications="<?php echo $fetch_info['job_qualifications']; ?>"
                                        data-gross_salary="<?php echo $fetch_info['gross_salary']; ?>"
                                        data-job_benefits="<?php echo $fetch_info['job_benefits']; ?>"
                                        data-work_location="<?php echo $fetch_info['work_location']; ?>"
                                        data-num_employees="<?php echo $fetch_info['num_employees']; ?>"
                                        data-work_nature="<?php echo $fetch_info['work_nature']; ?>"
                                        data-other_work_nature_text="<?php echo $fetch_info['other_work_nature_text']; ?>"
                                        data-proof_image="<?php echo $fetch_info['proof_image']; ?>"
                                        data-job_problem="<?php echo $fetch_info['job_problem']; ?>"
                                        data-problem_elaboration="<?php echo $fetch_info['problem_elaboration']; ?>"
                                        data-self_employed_reason="<?php echo $fetch_info['self_employed_reason']; ?>"
                                        data-knowledge_enhance="<?php echo $fetch_info['knowledge_enhance']; ?>"
                                        data-problem_solving="<?php echo $fetch_info['problem_solving']; ?>"
                                        data-research_skills="<?php echo $fetch_info['research_skills']; ?>"
                                        data-learning_efficiency="<?php echo $fetch_info['learning_efficiency']; ?>"
                                        data-communication_skills="<?php echo $fetch_info['communication_skills']; ?>"
                                        data-more_inclined="<?php echo $fetch_info['more_inclined']; ?>"
                                        data-team_spirit="<?php echo $fetch_info['team_spirit']; ?>"
                                        data-job_relevance="<?php echo $fetch_info['job_relevance']; ?>"
                                        data-applied_course="<?php echo $fetch_info['applied_course']; ?>"
                                        data-possible_reasons="<?php echo $fetch_info['possible_reasons']; ?>"
                                        data-other_reasons="<?php echo $fetch_info['other_reasons']; ?>"
                                        data-present_job="<?php echo $fetch_info['present_job']; ?>"
                                        data-other_job="<?php echo $fetch_info['other_job']; ?>"
                                        data-range_module="<?php echo $fetch_info['range_module']; ?>"
                                        data-optional_module="<?php echo $fetch_info['optional_module']; ?>"
                                        data-relevance="<?php echo $fetch_info['relevance']; ?>"
                                        data-worlkload="<?php echo $fetch_info['worlkload']; ?>"
                                        data-solving="<?php echo $fetch_info['solving']; ?>"
                                        data-learning="<?php echo $fetch_info['learning']; ?>"
                                        data-placement="<?php echo $fetch_info['placement']; ?>"
                                        data-environment="<?php echo $fetch_info['environment']; ?>"
                                        data-quality="<?php echo $fetch_info['quality']; ?>"
                                        data-job_satisfaction="<?php echo $fetch_info['job_satisfaction']; ?>"
                                        data-job_stay="<?php echo $fetch_info['job_stay']; ?>"
                                        data-stay_other_text="<?php echo $fetch_info['stay_other_text']; ?>"
                                        
                                        >Update</button>
                                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?php echo $fetch_info['id']; ?>">Delete</button>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                    echo '</div>';
                }
                ?>

                <!-- Modal for Update -->
                <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="updateModalLabel">Update Information</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST">
                                    <input type="hidden" name="update_id" id="updateId">

                                    <div class="mb-3">
                                        <label for="updateName" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="updateName" name="name" >
                                    </div>

                                    <div class="mb-3">
                                        <label for="updateSchool" class="form-label">School</label>
                                        <textarea class="form-control" id="updateSchool" name="choose_school" ></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="updateSex" class="form-label">Gender</label>
                                        <textarea class="form-control" id="updateSex" name="sex" ></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="updateAge" class="form-label">Age</label>
                                        <textarea class="form-control" id="updateAge" name="age" ></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="updateDegree" class="form-label">Degree</label>
                                        <textarea class="form-control" id="updateDegree" name="degree" ></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="updateYearAwarded" class="form-label">Year Awarded</label>
                                        <textarea class="form-control" id="updateYearAwarded" name="yearAwarded" ></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="updateCurrentStudy" class="form-label">Current Study</label>
                                        <textarea class="form-control" id="updateCurrentStudy" name="currentStudy" ></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="updateIfNoJobs" class="form-label">If No Jobs</label>
                                        <textarea class="form-control" id="updateIfNoJobs" name="ifNoJobs" ></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="updateIfYesDetails" class="form-label">If Yes Details</label>
                                        <textarea class="form-control" id="updateIfYesDetails" name="ifYesDetails" ></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="updatePursueReasons" class="form-label">Pursue Reasons</label>
                                        <textarea class="form-control" id="updatePursueReasons" name="pursueReasons" ></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="updateCurrentPosition" class="form-label">Current Position</label>
                                        <textarea class="form-control" id="updateCurrentPosition" name="currentPosition" ></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="updateOtherPosition" class="form-label">Other Position</label>
                                        <textarea class="form-control" id="updateOtherPosition" name="otherPosition" ></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="updateTimeToJob" class="form-label">Time To Job</label>
                                        <textarea class="form-control" id="updateTimeToJob" name="timeToJob" ></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="updateTimeGap" class="form-label">Time Gap</label>
                                        <textarea class="form-control" id="updateTimeGap" name="timeGap" ></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="updateEmploymentHistory" class="form-label">Employment History</label>
                                        <textarea class="form-control" id="updateEmploymentHistory" name="employmentHistory" ></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="updateJobInformationSource" class="form-label">Job Information Source</label>
                                        <textarea class="form-control" id="updateJobInformationSource" name="jobInfoSource" ></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="updateOtherJobInformation" class="form-label">Other Job Information</label>
                                        <textarea class="form-control" id="updateOtherJobInformation" name="otherJobInfo" ></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="updateJobQualifications" class="form-label">Job Qualifications</label>
                                        <textarea class="form-control" id="updateJobQualifications" name="jobQualifications" ></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="updateGrossSalary" class="form-label">Gross Salary</label>
                                        <textarea class="form-control" id="updateGrossSalary" name="grossSalary" ></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="updateJobBenefits" class="form-label">Job Benefits</label>
                                        <textarea class="form-control" id="updateJobBenefits" name="jobBenefits" ></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="updateWorkLocation" class="form-label">Work Location</label>
                                        <textarea class="form-control" id="updateWorkLocation" name="workLocation" ></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="updateNumberOfEmployees" class="form-label">Number Of Employees</label>
                                        <textarea class="form-control" id="updateNumberOfEmployees" name="numEmployees" ></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="updateWorkNature" class="form-label">Work Nature</label>
                                        <textarea class="form-control" id="updateWorkNature" name="workNature" ></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="updateOtherWorkNatureText" class="form-label">Other Work Nature Text</label>
                                        <textarea class="form-control" id="updateOtherWorkNatureText" name="otherWorkNatureText" ></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="updateProofImage" class="form-label">Proof Image</label>
                                        <textarea class="form-control" id="updateProofImage" name="proofImage" ></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="updateJobProblem" class="form-label">Job Problem</label>
                                        <textarea class="form-control" id="updateJobProblem" name="jobProblem" ></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="updateProblemElaboration" class="form-label">Problem Elaboration</label>
                                        <textarea class="form-control" id="updateProblemElaboration" name="problemElaboration" ></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="updateSelfEmployedReason" class="form-label">Self Employed Reason</label>
                                        <textarea class="form-control" id="updateSelfEmployedReason" name="selfEmployedReason" ></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="updateKnowledgeEnhance" class="form-label">Knowledge Enhance</label>
                                        <textarea class="form-control" id="updateKnowledgeEnhance" name="knowledgeEnhance" ></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="updateProblemSolving" class="form-label">Problem Solving</label>
                                        <textarea class="form-control" id="updateProblemSolving" name="problemSolving" ></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="updateResearchSkills" class="form-label">Research Skills</label>
                                        <textarea class="form-control" id="updateResearchSkills" name="researchSkills" ></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="updateLearningEfficiency" class="form-label">Learning Efficiency</label>
                                        <textarea class="form-control" id="updateLearningEfficiency" name="learningEfficiency" ></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="updateCommunicationSkills" class="form-label">Communication Skills</label>
                                        <textarea class="form-control" id="updateCommunicationSkills" name="communicationSkills" ></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="updateMoreInclined" class="form-label">More Inclined</label>
                                        <textarea class="form-control" id="updateMoreInclined" name="moreInclined" ></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="updateTeamSpirit" class="form-label">Team Spirit</label>
                                        <textarea class="form-control" id="updateTeamSpirit" name="teamSpirit" ></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="updateJobRelevance" class="form-label">Job Relevance</label>
                                        <textarea class="form-control" id="updateJobRelevance" name="jobRelevance" ></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="updateAppliedCourse" class="form-label">Applied Course</label>
                                        <textarea class="form-control" id="updateAppliedCourse" name="appliedCourse" ></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="updatePossibleReasons" class="form-label">Possible Reasons</label>
                                        <textarea class="form-control" id="updatePossibleReasons" name="possibleReasons" ></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="updateOtherReasons" class="form-label">Other Reasons</label>
                                        <textarea class="form-control" id="updateOtherReasons" name="otherReasons" ></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="updatePresentJob" class="form-label">Present Job</label>
                                        <textarea class="form-control" id="updatePresentJob" name="presentJob" ></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="updateOtherJob" class="form-label">Other Job</label>
                                        <textarea class="form-control" id="updateOtherJob" name="otherJob" ></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="updateRangeModule" class="form-label">Range Module</label>
                                        <textarea class="form-control" id="updateRangeModule" name="rangeModule" ></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="updateOptionalModule" class="form-label">Optional Module</label>
                                        <textarea class="form-control" id="updateOptionalModule" name="optionalModule" ></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="updateRelevance" class="form-label">Relevance</label>
                                        <textarea class="form-control" id="updateRelevance" name="relevance" ></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="updateWorlkload" class="form-label">Worlkload</label>
                                        <textarea class="form-control" id="updateWorlkload" name="worlkload" ></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="updateSolving" class="form-label">Solving</label>
                                        <textarea class="form-control" id="updateSolving" name="solving" ></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="updateLearning" class="form-label">Learning</label>
                                        <textarea class="form-control" id="updateLearning" name="learning" ></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="updatePlacement" class="form-label">Placement</label>
                                        <textarea class="form-control" id="updatePlacement" name="placement" ></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="updateEnvironment" class="form-label">Environment</label>
                                        <textarea class="form-control" id="updateEnvironment" name="environment" ></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="updateQuality" class="form-label">Quality</label>
                                        <textarea class="form-control" id="updateQuality" name="quality" ></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="updateJobSatisfaction" class="form-label">Job Satisfaction</label>
                                        <textarea class="form-control" id="updateJobSatisfaction" name="jobSatisfaction" ></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="updateJobStay" class="form-label">Job Stay</label>
                                        <textarea class="form-control" id="updateJobStay" name="jobStay" ></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="updateStayOtherText" class="form-label">Stay Other Text</label>
                                        <textarea class="form-control" id="updateStayOtherText" name="stayOtherText" ></textarea>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal for Delete Confirmation -->
                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Delete Confirmation</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this item?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <a id="deleteButton" href="#" class="btn btn-danger">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- end aria ug code -->
            </div>

            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">Your Site Name</a>, All Right Reserved.
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
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
        // Update modal: Fill in the fields with the clicked record's data
        $('#updateModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var name = button.data('name');
            var school = button.data('school');
            var sex = button.data('sex');
            var age = button.data('age');
            var degree = button.data('degree');

            var yearAwarded = button.data('year_awarded');
            var currentStudy = button.data('current_study');
            var ifNoJobs = button.data('if_no_jobs');
            var ifYesDetails = button.data('if_yes_details');
            var pursueReasons = button.data('pursue_reasons');
            var currentPosition = button.data('current_position');
            var otherPosition = button.data('other_position');
            var timeToJob = button.data('time_to_job');
            var timeGap = button.data('time_gap');
            var employmentHistory = button.data('employment_history');
            var jobInfoSource = button.data('job_info_source');
            var otherJobInfo = button.data('other_job_info');
            var jobQualifications = button.data('job_qualifications');
            var grossSalary = button.data('gross_salary');
            var jobBenefits = button.data('job_benefits');
            var workLocation = button.data('work_location');
            var numEmployees = button.data('num_employees');
            var workNature = button.data('work_nature');
            var otherWorkNatureText = button.data('other_work_nature_text');
            var proofTmage = button.data('proof_image');
            var jobProblem = button.data('job_problem');
            var problemElaboration = button.data('problem_elaboration');
            var selfEmployedReason = button.data('self_employed_reason');
            var knowledgeEnhance = button.data('knowledge_enhance');
            var problemSolving = button.data('problem_solving');
            var researchSkills = button.data('research_skills');
            var learningEfficiency = button.data('learning_efficiency');
            var communicationSkills = button.data('communication_skills');
            var moreInclined = button.data('more_inclined');
            var teamSpirit = button.data('team_spirit');
            var jobRelevance = button.data('job_relevance');
            var appliedCourse = button.data('applied_course');
            var possibleReasons = button.data('possible_reasons');
            var otherReasons = button.data('other_reasons');
            var presentJob = button.data('present_job');
            var otherJob = button.data('other_job');
            var rangeModule = button.data('range_module');
            var optionalModule = button.data('optional_module');
            var relevance = button.data('relevance');
            var worlkload = button.data('worlkload');
            var solving = button.data('solving');
            var learning = button.data('learning');
            var placement = button.data('placement');
            var environment = button.data('environment');
            var quality = button.data('quality');
            var jobSatisfaction = button.data('job_satisfaction');
            var jobStay = button.data('job_stay');
            var stayOtherText = button.data('stay_other_text');

            var modal = $(this);
            modal.find('#updateId').val(id);
            modal.find('#updateName').val(name);
            modal.find('#updateSchool').val(school);
            modal.find('#updateSex').val(sex);
            modal.find('#updateAge').val(age);
            modal.find('#updateDegree').val(degree);
            
            modal.find('#updateYearAwarded').val(yearAwarded);
            modal.find('#updateCurrentStudy').val(currentStudy);
            modal.find('#updateIfNoJobs').val(ifNoJobs);
            modal.find('#updateIfYesDetails').val(ifYesDetails);
            modal.find('#updatePursueReasons').val(pursueReasons);
            modal.find('#updateCurrentPosition').val(currentPosition);
            modal.find('#updateOtherPosition').val(otherPosition);
            modal.find('#updateTimeToJob').val(timeToJob);
            modal.find('#updateTimeGap').val(timeGap);
            modal.find('#updateEmploymentHistory').val(employmentHistory);
            modal.find('#updateJobInformationSource').val(jobInfoSource);
            modal.find('#updateOtherJobInformation').val(otherJobInfo);
            modal.find('#updateJobQualifications').val(jobQualifications);
            modal.find('#updateGrossSalary').val(grossSalary);
            modal.find('#updateJobBenefits').val(jobBenefits);
            modal.find('#updateWorkLocation').val(workLocation);
            modal.find('#updateNumberOfEmployees').val(numEmployees);
            modal.find('#updateWorkNature').val(workNature);
            modal.find('#updateOtherWorkNatureText').val(otherWorkNatureText);
            modal.find('#updateProofImage').val(proofTmage);
            modal.find('#updateJobProblem').val(jobProblem);
            modal.find('#updateProblemElaboration').val(problemElaboration);
            modal.find('#updateSelfEmployedReason').val(selfEmployedReason);
            modal.find('#updateKnowledgeEnhance').val(knowledgeEnhance);
            modal.find('#updateProblemSolving').val(problemSolving);
            modal.find('#updateResearchSkills').val(researchSkills);
            modal.find('#updateLearningEfficiency').val(learningEfficiency);
            modal.find('#updateCommunicationSkills').val(communicationSkills);
            modal.find('#updateMoreInclined').val(moreInclined);
            modal.find('#updateTeamSpirit').val(teamSpirit);
            modal.find('#updateJobRelevance').val(jobRelevance);
            modal.find('#updateAppliedCourse').val(appliedCourse);
            modal.find('#updatePossibleReasons').val(possibleReasons);
            modal.find('#updateOtherReasons').val(otherReasons);
            modal.find('#updatePresentJob').val(presentJob);
            modal.find('#updateOtherJob').val(otherJob);
            modal.find('#updateRangeModule').val(rangeModule);
            modal.find('#updateOptionalModule').val(optionalModule);
            modal.find('#updateRelevance').val(relevance);
            modal.find('#updateWorlkload').val(worlkload);
            modal.find('#updateSolving').val(solving);
            modal.find('#updateLearning').val(learning);
            
            modal.find('#updatePlacement').val(placement);
            modal.find('#updateEnvironment').val(environment);
            modal.find('#updateQuality').val(quality);
            modal.find('#updateJobSatisfaction').val(jobSatisfaction);
            modal.find('#updateJobStay').val(jobStay);
            modal.find('#updateStayOtherText').val(stayOtherText);
        });

        // Delete modal: Set the delete URL based on the clicked record's ID
        $('#deleteModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var deleteUrl = "admin_alumni_information.php?delete_id=" + id;
            $(this).find('#deleteButton').attr('href', deleteUrl);
        });
    </script>

</body>

</html>