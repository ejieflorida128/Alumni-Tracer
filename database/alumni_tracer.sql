-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2024 at 04:25 AM
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
-- Table structure for table `e_notifications`
--

CREATE TABLE `e_notifications` (
  `id` int(11) NOT NULL,
  `school_name` varchar(255) NOT NULL,
  `alumni_gmail` varchar(255) NOT NULL,
  `notification` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `e_notifications`
--

INSERT INTO `e_notifications` (`id`, `school_name`, `alumni_gmail`, `notification`, `date`) VALUES
(2, 'National High School', 'ejieflorida128@gmail.com', 'ejieflorida128@gmail.com has submitted the alumni information directory for the school NpLwGrR4YEr8oObcgD6hQis0MmtiUG10WWMrNFE2UUNYNzVhWk5LNDJ6NmEvRkwwUUZhTHFsd0N2d0U9', '2024-12-13 03:23:19'),
(3, 'National High School', 'ejieflorida128@gmail.com', 'ejieflorida128@gmail.com has updated the alumni information directory for the school YSdVp+Ogr7d/gj/lEjFfaEtrR3pDSFpFbDVUbjhBeWVoRTVBaGc1dG9wY0lqMUR6Ym01aE9OcGtRMG89', '2024-12-13 03:23:41'),
(4, 'National High School', 'ejieflorida128@gmail.com', 'ejieflorida128@gmail.com has updated the alumni information directory for the school M0GmmkBdQB2EQ/TMGj5iBm9HSzIzaHpndm15M0Z6UkdSUlI4TUVoakdOOE9LMkJQUXdyT1FQbGdhUHM9', '2024-12-13 03:23:55');

-- --------------------------------------------------------

--
-- Table structure for table `e_schools`
--

CREATE TABLE `e_schools` (
  `id` int(11) NOT NULL,
  `school_name` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `confirm_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `e_schools`
--

INSERT INTO `e_schools` (`id`, `school_name`, `logo`, `confirm_status`) VALUES
(15, 'QjvpQ4V7aEksBxTPp8A7hElzU2l0QjY2ams5SEhGMk4xenlUd2JwbndWTkozUWZiT1JVYXo4SlVFQmc9', '../SuperAdmin/logo/673e9aee7f70c.avif', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `l_study_response`
--

CREATE TABLE `l_study_response` (
  `id` int(11) NOT NULL,
  `gmail` varchar(255) NOT NULL,
  `choose_school` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sex` varchar(255) DEFAULT NULL,
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
  `num_employees` varchar(255) DEFAULT NULL,
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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `check_mode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `l_study_response`
--

INSERT INTO `l_study_response` (`id`, `gmail`, `choose_school`, `name`, `sex`, `age`, `degree`, `year_awarded`, `current_study`, `if_no_jobs`, `if_yes_details`, `pursue_reasons`, `current_position`, `other_position`, `time_to_job`, `time_gap`, `employment_history`, `job_info_source`, `other_job_info`, `job_qualifications`, `gross_salary`, `job_benefits`, `work_location`, `num_employees`, `work_nature`, `other_work_nature_text`, `proof_image`, `job_problem`, `problem_elaboration`, `self_employed_reason`, `knowledge_enhance`, `problem_solving`, `research_skills`, `learning_efficiency`, `communication_skills`, `more_inclined`, `team_spirit`, `job_relevance`, `applied_course`, `possible_reasons`, `other_reasons`, `present_job`, `other_job`, `range_module`, `optional_module`, `relevance`, `worlkload`, `solving`, `learning`, `placement`, `environment`, `quality`, `job_satisfaction`, `job_stay`, `stay_other_text`, `status`, `created_at`, `check_mode`) VALUES
(19, 'ejieflorida128@gmail.com', 'M0GmmkBdQB2EQ/TMGj5iBm9HSzIzaHpndm15M0Z6UkdSUlI4TUVoakdOOE9LMkJQUXdyT1FQbGdhUHM9', '3hxXXnVFdcNXbzWpSa7P90RvOUNxT0l3U0lSeEhwS25DR2EzcWc9PQ==', 'XAwd34FPt45Yi+o/Mk77PnBENmZpWEozM09YQXBmQkltelhhZFE9PQ==', 20, 'YvMZJ6g3y+n1vYfsu/fdJy9qRHovZlpRMjROZnllR2FBRWJNTXNmN1RPOEtQSnpXRVVQNncyWDZpa3M9', '2024', 'GSKF9XryAvtNXU6g+xFs21Z4c3cyeGFkYnJFUU9VUC82dG1xelE9PQ==', 'IEkHQTXQWdTBpSCevP6zsWw0dXhFdElqUDEyY3pYampaRHFBZ1E9PQ==', 'Ii32SO+IQY2Hz5IdwFu99VlDaHV5M0MyYjJQZnkvZ2N5Q1RyT3c9PQ==', 'LyC6CjqP806pCBL+Vq5i9DZBVllOMXdVdVJ3WW1tSmc4Rm9Nemc9PQ==', '5R91HFGoDl5EO6jgBARtT0ZtVUkzR0NwNlVYL042bnQxTTVmNnJGZlhhVFQzN3lJTkMrZWNKVytCZm89', 'i7/qaLZYWefMK56A4Pbxn3dzM2xFaUsyd2NBZnh4cWFOZzJBRkE9PQ==', 'MIKDAuprQegQK+qA5M0XDWhqZ2xMYitIRzcxeFBoOTl6VHJaeFE9PQ==', 'h7Z0Wkj04TiEUoZrSdCt+jh2QUVRZ3h2amY3ZnVoYWZ0Z1l1UlE9PQ==', 'c0RFEaN4TmtweoJTywPN229JT2srTHNFSW55L1Q4dzZqSUYxRlE9PQ==', '/duf9veJHnU8EueKkxBHT29ZOHJOWFBPMTRhbmR0NG5UQS9MZWc9PQ==', '0/+rkvKP4mi+uT49s02WMzBseTU4Z1VxNmVBUStaVHJ6MlZURkE9PQ==', '2Id7x10iaNrRxvAcxBevVnJLRGpBK0ZSQm56SWFWdmMrUndJYmc9PQ==', '1000', '2eVz94cMSTUk++fEqGEgC25Xc1E5SDZ1dEZHbjYxU0ppYmFXMHc9PQ==', 'OB45L6lpD9N2onfr/aXQWW5yN0x0bWU2TVd3cmxXMU53TUczOHc9PQ==', 'OppEirXh1G5zuVQ8/GBWSlFlVW4wSE1Tc0x4aGVUd3NUTzVRMGc9PQ==', 'AH6K+YEPS5f88UViKIW2h3FRSlhQV2RQZGNEV25CblQvTWNudHc9PQ==', 'f8tiYz4tbid3BXYqUTm8xFVWQ3dDSmdYOWRZMmJKRzBadFMzVUE9PQ==', '', '+1togA4WCs2xrLUbpIQIxnhrb1VYTUh4TE1FdG5TNjRiRHl0aXc9PQ==', '7xuFXa6R42adxkVBU81QCFNadW16a0ZtelNwbDNwUWpDVy9OVHc9PQ==', '6+uLJzsv515rvb3w6fsCakJhNDdBeW9qbUx4N3VSTXQ1SW5xQUE9PQ==', '8nVEyl/WvyZ3BT1qL317QW5wdGloc0VoQ0hKNVVCcVU3b1NhU1E9PQ==', 'NcrTKYuSq826owZc/HEEQ3lka09sT0NkUkNPVjgzRzF4MmtsNGc9PQ==', 'cB3FPiqdgqj/wgOdHAs0QmRlanltZDNuZVlDTnhDTloyRDZNOVE9PQ==', 'FrAM35fijPlt5dv3z0wUYTdZTTlUdWsxdTkrSVZaVm9DRXV0akE9PQ==', 'tl6MuBjIXSOHF8XpbYoNGzY4dUo3cjk2NXQ4UHdWcnJKWXlhbWc9PQ==', '8vZPwTQ/LDoqdYJpsxpODmpvZmZFa2JlbUVXcHlWaFRMRE1mb3c9PQ==', 'GAlu6trywvTdgbTj5xkExmowbk1GZWRSbVZlWXdMWGN2M3p4VUE9PQ==', '7tN+CqUumcK7k0P+5epMfGdxbWFsUU00djRGblNhVzJ5RjNsVVE9PQ==', 'chg6dfq4AZse0L7KgH6q/05VcE9rVUJXS3kza2sydll3dFYrbGc9PQ==', 'g6HqftOxIfoQ0EeF8zQVIGE4ZHlvTVBZeWVKeE15cUlvaGJsWERkRGFuR1dFQ1FQYVhnT0wweVhRVkU9', 'sZBggT/GGkauhgmEQdoU+2JIL1Q4c2hrVmxrSUx3R0ZwTWxMUmc9PQ==', '3w6GJptpRKBPcg61mXCuzDRseUZDRWsvalFLVzJXSGdGQ1A5aHE0TmVWTHFPQWNjU0pORjcvdHd2MFRaeitVV1IyVzJIS1pocDRVOUxOWWZWWUhpbUdFN1JqQk1nNVhnUmVYOW9BPT0=', 'AWeAsnHmxADCS2cWDZwGNWdnOEFtR04xMjhRL3p1NGN3TEhqemc9PQ==', 'W7kkHTwdvHUP0FlMw6ZLKG9IMmZ2VkdrZGhOTEROZ0VuZWxwb2c9PQ==', 'BZhk15sRXq1Dj/O+tsmO3UZiVHNCdnIyQU82TWoyaloyUE1JdGc9PQ==', 'UkBWtrB+uU3X76xv0J0xmWNHWmxVaEt3UTJwOVlLUDE0OVAwTGc9PQ==', 'FX+ieYszTC6nRBrMs1Twd2NVYU9RcUtuMXZlWkxtR3Z1Skdqc3c9PQ==', 'pOKrT0rWElRVAwTSdHxXs1NCRlVuV2xuTFRXMzZ3YjhuT05yYmc9PQ==', 'NVeNAVpJCWGGYF4fYKDMt09MbnZVTVlMM25Pa1p1SzQxc2h5Qnc9PQ==', 'H3JNp6rSvVjonIgTjfpw+WJoZXJSbDFtaHhsWEQ0REZ2dHpXdVE9PQ==', '9C/qWpj8JWSmqWRWGMQ+rlN4NnlsZHd5QUFhcVk2Y1ZKanllMlE9PQ==', 'nOVH7Q31HDIzTmzve9XXrDlRdEw5OVgrYUpuUTZSUkNMTVRXUVE9PQ==', 'W1cDawp6/aKFS8RXWH2QCSsyUzFKT2lDczdyYXFHR0k1cEpSREE9PQ==', 'CmRgWFX7RZy1H0y6TAaa9lNwOHNsVGROQzZ4NzJHZEZuNTNMS3c9PQ==', 'cnFPKfMuOp/wQm+vghxFrldHZGc4K0JKQjJwYXExeHhYeXNFdWc9PQ==', 'pending', '2024-12-12 05:35:22', 1);

-- --------------------------------------------------------

--
-- Table structure for table `r_accounts`
--

CREATE TABLE `r_accounts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `school_role` varchar(100) NOT NULL,
  `school` varchar(255) NOT NULL,
  `password` varchar(200) NOT NULL,
  `date_registered` datetime NOT NULL DEFAULT current_timestamp(),
  `profile_img` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `bio` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `face_data` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `r_accounts`
--

INSERT INTO `r_accounts` (`id`, `name`, `email`, `school_role`, `school`, `password`, `date_registered`, `profile_img`, `contact`, `bio`, `status`, `face_data`) VALUES
(38, 'BdVmTxTFiFxcObY2yx4lCjRFSVB1UkxidStPM3pIV2xPU1ZHZHc9PQ==', 'ejieflorida123@gmail.com', '2njgmhs9aXBZTUcdeQkruytOLzZoSk44YjRPVXM4cGUyekQ2aUE9PQ==', 'fGfjBnOetxpKv81vYADINkJxLyt3bVZFNjRJSlRsV1dCVWg5N1RNandmK3FwTVNvQnkrbEJWTWNzZWM9', '$2y$10$gMchPIGCYE5IKYIRoEaHzeebc.H9C93WtWJSkKCTOh9/0Wq1IIA9O', '2024-12-12 17:25:46', 'pictures/Default.png', '', '', 'Approved', '../uploads/faces/face_675aac1a83c217.42143673.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `e_notifications`
--
ALTER TABLE `e_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `e_schools`
--
ALTER TABLE `e_schools`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `l_study_response`
--
ALTER TABLE `l_study_response`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `r_accounts`
--
ALTER TABLE `r_accounts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `e_notifications`
--
ALTER TABLE `e_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `e_schools`
--
ALTER TABLE `e_schools`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `l_study_response`
--
ALTER TABLE `l_study_response`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `r_accounts`
--
ALTER TABLE `r_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
