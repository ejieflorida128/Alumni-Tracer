-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 21, 2024 at 07:35 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

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
  `time_to_job` varchar(255) DEFAULT NULL,
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
  `status` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `l_study_response`
--

INSERT INTO `l_study_response` (`id`, `name`, `sex`, `age`, `degree`, `year_awarded`, `current_study`, `if_no_jobs`, `if_yes_details`, `pursue_reasons`, `current_position`, `other_position`, `time_to_job`, `time_gap`, `employment_history`, `job_info_source`, `other_job_info`, `job_qualifications`, `gross_salary`, `job_benefits`, `work_location`, `num_employees`, `work_nature`, `other_work_nature_text`, `job_problem`, `problem_elaboration`, `self_employed_reason`, `knowledge_enhance`, `problem_solving`, `research_skills`, `learning_efficiency`, `communication_skills`, `more_inclined`, `team_spirit`, `job_relevance`, `applied_course`, `possible_reasons`, `other_reasons`, `present_job`, `other_job`, `range_module`, `optional_module`, `relevance`, `worlkload`, `solving`, `learning`, `placement`, `environment`, `quality`, `job_satisfaction`, `job_stay`, `stay_other_text`, `status`, `created_at`) VALUES
(8, 'Ejie Florida', 'Male', 21, 'Comlaude Programming', '2018', 'No', 'None', 'None', 'None', 'Others:', 'Secret', 'None', 'None', 'None', 'Others:', 'None', 'None', '100', 'None', 'None', 'Over 200', 'Other', 'None', 'Yes', 'None', 'None', 'Very much', 'Very much', 'Much', 'Much', 'Much', 'Not at all', 'A little', 'Very much', 'No', 'Other reasons please specify', 'None', 'Other reasons please specify', 'Ambot', 'Does not apply', 'Does not apply', 'Weakness', 'Does not apply', 'Weakness', 'Does not apply', 'Weakness', 'Weakness', 'Weakness', 'A little', 'Other', 'None', 'pending', '2024-10-19 07:57:25'),
(10, 'Ralph Miole', 'Male', 21, 'Comlaude Programming', '2018', 'No', 'None', 'None', 'None', 'Others:', 'Secret', 'None', 'None', 'None', 'Others:', 'None', 'None', '100', 'None', 'None', 'Over 200', 'Other', 'None', 'Yes', 'None', 'None', 'Very much', 'Very much', 'Much', 'Much', 'Much', 'Not at all', 'A little', 'Very much', 'No', 'Other reasons please specify', 'None', 'Other reasons please specify', 'Ambot', 'Does not apply', 'Does not apply', 'Weakness', 'Does not apply', 'Weakness', 'Does not apply', 'Weakness', 'Weakness', 'Weakness', 'A little', 'Other', 'None', 'approved', '2024-10-19 07:57:25');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
