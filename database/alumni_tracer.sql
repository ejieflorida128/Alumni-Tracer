-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2024 at 04:53 AM
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
(5, 'National High School', 'ejieflorida128@gmail.com', 'ejieflorida128@gmail.com has submitted the alumni information directory for the school National High School', '2024-12-13 03:44:48'),
(6, 'National High School', 'ejieflorida128@gmail.com', 'ejieflorida128@gmail.com has updated the alumni information directory for the school National High School', '2024-12-13 03:44:54'),
(7, 'National High School', 'ejieflorida128@gmail.com', 'ejieflorida128@gmail.com has updated the alumni information directory for the school National High School', '2024-12-13 03:44:56');

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
(19, 'ejieflorida128@gmail.com', 'DUPZFFnfTKee6wPLCXAs801HRFhFcTl5MW1YNTFuQkNiZnNNeEJ2R1pLNXNod2c3Y2doQnMxY1IxTGc9', 'drDCcqnem4ez9IQyfhocVEdlUTY1SXl1c1RLU3pkMHEzNytDMHc9PQ==', 'O+fN3jh3djiZrGkFjC3LFWVqYmxVT0ZNdVkxelNrRUJHT0RHTXc9PQ==', 20, '5IkwUCe7H9N6IDnLU8j2n1EyVkwwalFrbGpXT3FpKzN3QTBiRksvME0zM2h0aW5oS09aWldpTnJXalU9', '2024', 'sRPGEqF7psCoSYdlvGeFTWdPVVIrYWNlZFlJd216NTIxd084OFE9PQ==', 'y5b5ey6TEL40swHW5giMsHdEWHRpZ1kyR01JVlV6ejlZNDVBSlE9PQ==', '31Csf8AW0SMnc/tSbmZHZ0pySFpHRDV3N0RlSXh6eWU5ajh4U0E9PQ==', '5KE2nyM5O7Ct/OMYsTEghStjMkc1R2hvc1gramttOEJZd1dNSmc9PQ==', 'bSoPkrEiABmWVWwiiO7PwTNNdGtFV05MekswZkQxYS9wa2hQcCt6Tnp6QjZzY0hXaitQdUpMdyszZjA9', 'rX6rnxr7UoRiQ4XvD3URdVRsMXE0ZWM3NUdZb2I3ZmMvZ3ZUbmc9PQ==', '7N85E6h0ECgo+ADrG/TI22E4Tk43RGNrSndDYUZjWFUxTmZuOVE9PQ==', 'DLY37cBf9koeBJfba2IYw25lZUlNZzJ6ckZQOHdTSnpKeS84amc9PQ==', 'rWRlCdiP9UmQFFKM4lUNrUJTSEd1NjRCTzhzekpxc1JPdTZ2elE9PQ==', 'W74YnVr/3WEs7pWhSSCxeG5aR2VNM2orYUJTUWlQMk94c0NzZGc9PQ==', 'g4rm4UGhmKabEjPx62V4jE9CL09zS1crdnc0dUVpa3V2b3oxeXc9PQ==', '+3QPSl7oNAxh7fyrtwgsGWl1NnE5c3VOSVJ6S2xlMk9SaGZIY3c9PQ==', '1000', 'ecwouV80wn1bO4quPLTb11hsNmhVc2N3VkxJckhmNjcxSVc4UVE9PQ==', 'VLTNI/20J8vO1yTcggIWAzlhOWowWHkwNzJZSVcwLzhxSVBDR0E9PQ==', '71U/BadbUi7YTGBONoKEi05GOXhVNGRsTUFPZ29LLzc2VnV3ekE9PQ==', 'Tum3JgB5Tgslxm/JqD8LqGVPYk9WZjdxMGRJYURUa3hBb3d4Ync9PQ==', 'dGjW71NCnt9EvnEFBrHHb3phNElRTXU1aXJ5S2lOOU9pVnBDWnc9PQ==', '', 'UgeKSsMR8KSZLSGwzLMWYTFJNDkxUHZILzA2VlY3aEU1M0twVWc9PQ==', 'BXNobZlLvLo+YKVF7hR7pnNQWVZVZVI5ODhGMkVLamY3RWxsWUE9PQ==', 'Vd75MdP91UgDRI9wgk71TnRhNkhqYkMzS2dWZEJZZ0Y4aFREUFE9PQ==', 'LkIvARtKIdA1wdnn6tZYgWIvOFBMbkJvK2NZYTl0NFJkb1VrSGc9PQ==', 'ShDMgBpfTvd/LIyymjv6v2V6c3RIOHN3NkJZeG1HNndaWUtGVWc9PQ==', '+8ZV8pPY5h92cK+9g8NOsmlSWEdoZHVZK3BHaElua1VEZ012a1E9PQ==', '5W29XvU2Xklr9eshm6bCLkR4aU9NZTVtaHVyM3l2SVVFOHRMRFE9PQ==', 'fKjSYPKJmcNPBB2reWeLUjVPcWxxOGR5dmdIbVZESzFjdU1MdVE9PQ==', 'KvbO9+qaADo5mmbxApbTYjJYTytCQzU3ZWxaeXFEMUN5T20wRVE9PQ==', 'ucTsIqt1r3fNe5jiLiPqxzQ0ZWVKN1ROdG5GOEVVVVo2dDJKeGc9PQ==', 'X6U16TZ8avhCRFYXv/J4h2lnUUlIQkNWQllpenIrempicUQ1Umc9PQ==', 'LKK86NKQyi0WP5uZhTtSfW4xdng1UUp6Si9XcDdUNGdRbHVUYVE9PQ==', 'HLRXgfXv5hFUW6iRSw9rLXU4eWZtQ1JEUVFuSnhLVnI5STlONFJqejRQaXRNdWdzWGdxRWlVVHY4b0E9', '5yjkewH/jkjIRRCHUDZxb0JxYlVYdU1GeXVNM09pUk5aV3FhVFE9PQ==', 'tGEUv4HWhPlm54OS6WeJwGtscnY4bkFkNHlLclVWbjByaUlENExRbjlDVFc4UGp3ZzJicnBReFU4and5a3FYOElPV2JudTBqT05MM3JHdVp3YWVObjBMb051d0dUQzhuWVVBaDBnPT0=', '6AjyKMBYdzn+xSnEM5IXl2RpZkpKSVAxMWRBOUtPdHVYNmxLb3c9PQ==', 'odCW8C7dNzQYuezzn4NX63oyOUVCeHlkMGpyL3R2U0tkU0xhWHc9PQ==', 'LgZUTbizyt/MoH2ZIIAph2lFSDVnd0pPTVlVY1hFOEJESXg2VFE9PQ==', 'sBzJGKntPFehOW7aNFRBD1ZYbnNGZGY2bi9VNjVRNlozMWw3TWc9PQ==', 'BYXaDf+ZtCEVkXqUAlcfH2VBNE5pbEl6NzRudzB5bXcrbmI3Snc9PQ==', 'tS/epGOozQ4wn8aD0kiZ11dJTmtoanhETWFoYTlVN25QSkZpOHc9PQ==', 'WuGwymaRWwpYFP6Bq7lNeU4vOXhLZzhZdERUbW5OaTZ0Y2xKMEE9PQ==', 'I0Hp7fTD8VPpKeNhyjAteHFZTHBEU1I4cUtUL3NEWGg0TUZ4c1E9PQ==', 'eBIIAXLdh7VFDeAFc7xWl2Y1QktIVmNGUUloYllzRHYyYU9EelE9PQ==', '/MuACEZg77+ZCTI4qkYc6jNsOWVuemg0aWs5UnZRQ0VERytIWEE9PQ==', 'QMjMmjWAUQaUjY/m/YBj61RJZWkzU0lwSW9nNUlEMkh6YVJjeEE9PQ==', 'LGXij+ktolXt2i/l+brMUDJoMDMwdm9ZMWxkZDlCUkx5YTZ6aEE9PQ==', 'YrEmZbsQslWB79yPVe4uPDRjMlBEV1YybVZkV1A1akZZUC91RVE9PQ==', 'pending', '2024-12-12 05:35:22', 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
