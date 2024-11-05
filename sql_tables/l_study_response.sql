-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2024 at 04:23 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alumni_tracer`
--

-- --------------------------------------------------------

--
-- Table structure for table `l_study_response`
--

CREATE TABLE `l_study_response` (
  `id` int(11) NOT NULL,
  `choose_school` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `age` int(3) DEFAULT NULL,
  `degree` varchar(255) DEFAULT NULL,
  `year_awarded` year(4) DEFAULT NULL,
  `current_study` text DEFAULT NULL,
  `if_no_jobs` text DEFAULT NULL,
  `if_yes_details` text DEFAULT NULL,
  `pursue_reasons` text DEFAULT NULL,
  `current_position` text DEFAULT NULL,
  `other_position` text DEFAULT NULL,
  `time_to_job` text DEFAULT NULL,
  `time_gap` text DEFAULT NULL,
  `employment_history` text DEFAULT NULL,
  `job_info_source` text DEFAULT NULL,
  `other_job_info` varchar(255) DEFAULT NULL,
  `job_qualifications` text DEFAULT NULL,
  `gross_salary` varchar(50) DEFAULT NULL,
  `job_benefits` text DEFAULT NULL,
  `work_location` varchar(255) DEFAULT NULL,
  `num_employees` varchar(50) DEFAULT NULL,
  `work_nature` varchar(255) DEFAULT NULL,
  `other_work_nature_text` text DEFAULT NULL,
  `proof_image` varchar(255) DEFAULT NULL,
  `job_problem` varchar(255) DEFAULT NULL,
  `problem_elaboration` text DEFAULT NULL,
  `self_employed_reason` text DEFAULT NULL,
  `knowledge_enhance` text DEFAULT NULL,
  `problem_solving` text DEFAULT NULL,
  `research_skills` text DEFAULT NULL,
  `learning_efficiency` text DEFAULT NULL,
  `communication_skills` text DEFAULT NULL,
  `more_inclined` text DEFAULT NULL,
  `team_spirit` text DEFAULT NULL,
  `job_relevance` varchar(255) DEFAULT NULL,
  `applied_course` varchar(255) DEFAULT NULL,
  `possible_reasons` varchar(255) DEFAULT NULL,
  `other_reasons` text DEFAULT NULL,
  `present_job` varchar(255) DEFAULT NULL,
  `other_job` text DEFAULT NULL,
  `range_module` text DEFAULT NULL,
  `optional_module` text DEFAULT NULL,
  `relevance` text DEFAULT NULL,
  `worlkload` text DEFAULT NULL,
  `solving` text DEFAULT NULL,
  `learning` text DEFAULT NULL,
  `placement` text DEFAULT NULL,
  `environment` text DEFAULT NULL,
  `quality` text DEFAULT NULL,
  `job_satisfaction` varchar(255) DEFAULT NULL,
  `job_stay` varchar(255) DEFAULT NULL,
  `stay_other_text` text DEFAULT NULL,
  `status` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `l_study_response`
--

INSERT INTO `l_study_response` (`id`, `choose_school`, `name`, `sex`, `age`, `degree`, `year_awarded`, `current_study`, `if_no_jobs`, `if_yes_details`, `pursue_reasons`, `current_position`, `other_position`, `time_to_job`, `time_gap`, `employment_history`, `job_info_source`, `other_job_info`, `job_qualifications`, `gross_salary`, `job_benefits`, `work_location`, `num_employees`, `work_nature`, `other_work_nature_text`, `proof_image`, `job_problem`, `problem_elaboration`, `self_employed_reason`, `knowledge_enhance`, `problem_solving`, `research_skills`, `learning_efficiency`, `communication_skills`, `more_inclined`, `team_spirit`, `job_relevance`, `applied_course`, `possible_reasons`, `other_reasons`, `present_job`, `other_job`, `range_module`, `optional_module`, `relevance`, `worlkload`, `solving`, `learning`, `placement`, `environment`, `quality`, `job_satisfaction`, `job_stay`, `stay_other_text`, `status`, `created_at`) VALUES
(14, 'Cebu Eastern College', 'Ejie C. Florida', 'Male', 20, 'Cum Laude', '2023', 'No', 'Programmer in Cebu City', '', 'To level up my current knowledge about technologies', 'Working full-time', '', '7 months to 1 year', 'refreshing my knowledge', 'Steve Newton , I work at England', 'Through written enquiries', '', 'Advance Programming Knowledge', '100000', '13th month pay and bonus', 'England', 'Over 200', 'Managerial', '', '../alumni_pictures/2024-11-04 22_04_47-Landing Page - Brave.png', 'No', '', '', 'Very much', 'Very much', 'Very much', 'Very much', 'Very much', 'Very much', 'Very much', 'Very much', 'Yes', 'I lack the necessary competencies for the job', '', 'The jobs available are low-paying', '', 'Strength', 'Strength', 'Strength', 'Strength', 'Strength', 'Strength', 'Strength', 'Strength', 'Strength', 'Very much', 'Yes', '', 'pending', '2024-11-05 10:21:58'),
(15, 'Southern Leyte State University', 'Lovely A. Guzmana', 'Male', 25, 'Comlaude Programming', '2022', 'No', 'Visiting Instructor', '', 'To enhance my skills', 'Self-employed', '', '7 months to 1 year', 'lack of money', 'NBI', 'Through friends', '', 'BSIT graduate', '15,000.00', 'Bonus and sick leave', 'Metro Manila', '11 to 50', 'Supervisory', '', '../alumni_pictures/fd65e864-f10f-4b4e-9918-f630c87184a1.jpeg', 'Yes', 'Time management', '', 'Much', 'Much', 'Much', 'Much', 'Much', 'Much', 'Much', 'Much', 'Yes', 'I did not pass the interview', '', 'I do not think I have the necessary skills for jobs related to my course', '', 'Strength', 'Strength', 'Strength', 'Strength', 'Strength', 'Strength', 'Strength', 'Strength', 'Strength', 'Much', 'Yes', '', 'pending', '2024-11-05 14:51:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `l_study_response`
--
ALTER TABLE `l_study_response`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `l_study_response`
--
ALTER TABLE `l_study_response`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;