-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2024 at 10:21 AM
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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `l_study_response`
--

INSERT INTO `l_study_response` (`id`, `gmail`, `choose_school`, `name`, `sex`, `age`, `degree`, `year_awarded`, `current_study`, `if_no_jobs`, `if_yes_details`, `pursue_reasons`, `current_position`, `other_position`, `time_to_job`, `time_gap`, `employment_history`, `job_info_source`, `other_job_info`, `job_qualifications`, `gross_salary`, `job_benefits`, `work_location`, `num_employees`, `work_nature`, `other_work_nature_text`, `proof_image`, `job_problem`, `problem_elaboration`, `self_employed_reason`, `knowledge_enhance`, `problem_solving`, `research_skills`, `learning_efficiency`, `communication_skills`, `more_inclined`, `team_spirit`, `job_relevance`, `applied_course`, `possible_reasons`, `other_reasons`, `present_job`, `other_job`, `range_module`, `optional_module`, `relevance`, `worlkload`, `solving`, `learning`, `placement`, `environment`, `quality`, `job_satisfaction`, `job_stay`, `stay_other_text`, `status`, `created_at`) VALUES
(19, 'ejieflorida128@gmail.com', '8KY6zCUsPDc/JMjm9CVANVRkYlVIcDBYQUlWdWUvcFZ4MzRBSlR2akVtYTFTb2M0Vnl3R3BhUGdRUm89', 'OdF6vR8M8Tzriq9Ocih33URQRlBUWFVBK09KN1hzRlVpUnBCbUE9PQ==', 'fC0c6LGH4mkJSmMXMVThZGpLWkRkR3pVYlFtMnIrcXVnY1I1Zmc9PQ==', 20, 'CUVrro5HwpSb1JqER55K8lMwNS9HZGdUOTc3VUlSYW9zOU5maEdrL1Awa2NudEZNaS81WnNjWTFQbFU9', '2024', 'DFE15IQqbzv0FfZH1LqCyjlLd0RJNmdoNmU3SVk0L0VtSmRHZlE9PQ==', 'vsoyBpHC0TBvXuiqQ+9eM3ptMnk3dUFjN2dxdStvbDc5ZnhWcFE9PQ==', '7merqTOZTcrv1CQrPukW8U9Hd0x5ZzJ6bWQwR28xcjE4Z1d6Q3c9PQ==', 'ilWd88NCuGpXXZmMQm+quklCdU5nMk1VS01ZT1pMcW9JSEUyb1E9PQ==', 'RzG12Fx7POIUgBQUQ5XZkFd5T1RzSGVYVXpkcm1MQ1dpemhmTW5jVnppWDJ3U0s0T2REaHhpUHFTWkE9', 'PROBvDkapcbtU/GHn8AwjURUZWJteDFWeXZBMnBUL3NmUnJQZFE9PQ==', 'a0LNw4KIXNzoqIofRdfbvk5uMjgzN280aU00QjgwWWpEcTVtVEE9PQ==', '8ci5KTlzGZeFV8jFStATg1RCNUNaSzRiSXQ1MlFsU0pKd2d2SWc9PQ==', 'eoyzvWFvJ1cBeCNxBpUImlhwcXJMcloyZStJdmNMWktwZTR5K2c9PQ==', 'vrDzxtHqIvK+kczmgUZ7H2VvMGJwQStBR2NmRTJQb2s1Nk5IZ2c9PQ==', 'sKbCE88YcrWUi9jYPrIHg2EzdmE3eVNQVUt6UVVRbmpJMDNzcmc9PQ==', '2RLemcP2PUQfbUc5hCoYC0tBNGxaaEZqZ1lxeG1vcWMvVithc1E9PQ==', '1000', '2t/A8GuH92GSpdSWYHZe2zRUYXpRenozRktGd0VwWU5NR1FZTUE9PQ==', 'IJPcHu3givyC4XvORtS9rEN1Z0N1VC9nR293UlpPeXhZRWJ0bFE9PQ==', 'JlKjEWO7KcrW5ka2DxzEglA4UTA3cXNQQnV3NzE0alFWQkJmV3c9PQ==', 'T9QHKRminiEH6nYcPmlFHC9QdVZCVFV6cW5jclNXMjExMVNMRkE9PQ==', 'PqEiAk3e33GIPCMyckpgkWp6UjVHaURrVzJuVG9YTERWTFR3bmc9PQ==', '', 'w5cqIxvXzYqaVp1RdEd3PTN1WGZ6TTFaVGxtSHkyb1luSmJ6S3c9PQ==', 'DBhBDzhBlmH8vaBvqQELkEZIUXRoN0hpTEFPNHR3UFowZEhQUnc9PQ==', 'p/e5O/tqQA0yaqvZwYyUP2FZb3NTRjJjVzJPdjJaL2U4M1ZiU0E9PQ==', 'yPq53RE/ceygWXR4AQ2JD01uMDF3ZFBMY3d4VnJtUzlqZkl1K1E9PQ==', 'aGCY06x+NLZFFulfAPX6xG55SWlQQ2xWdHJ4b3NGM0Z1WmVWU2c9PQ==', 'v7fCcOZHXx9tDYu0oPBDqkU4bVRpQUZYaitPK1hZc0gwVDJ1L3c9PQ==', 'zlEutGPL6sm0BLyNF2HTz0pTbFcyRTJ1OG5SdVh5S3hEOVhPaWc9PQ==', 'is2UjB1crSoAT0ALUP1sF0gxWGwwKzFjVThQL2VNVDBYd2pMMmc9PQ==', 'f5XUGR8JQ/HyMLoz/cLpWCthWjl1eVhwYzlNK082SlVRblFCSFE9PQ==', 'g68fSWiFiLi6ujyOTXq2hlNlQ0NpQkJpbG9FZ2JxazhBWVpVbGc9PQ==', 'T+matikdZVgFxt7A21DczkVLbXUzaVZOd1p1NWJLNmFBQVJrWWc9PQ==', 'ZPXPHJf/DySWru1JlwIaClE4RlJjYUJVVmN4YjAyZXFTSGFqV0E9PQ==', 'jp2onuipjfIQLJdc/GaEaG80RzA3czRpWlM0azM5dlZVRlFRZjdPWFFaSUdxS3NqdUpOT29taG9Ld0k9', '26+vzLk7NfP4lrnnqLdL2TgvQWl5bStwQjZvVW45Vk9Fd1ppQ0E9PQ==', '7lfOuzUfoH4clVFnRjJIe2k5SXVwL2w5dVFHb1dnZWZmb2V4VGdENm14bTFWOTRTZHI4allmYkVYc2pOWEt2aGFRaytFTk10ZHNNMlRFbFhUMnlqQmFQTTg5V1g4SVNJQTFOTkJnPT0=', 'Fpr1Lqi9VAjFJm5AhtxTYzNhNllFM2Mvb2xlSUR6bHNKZi9OVEE9PQ==', 'T9L/aWK706A7lizhDzaKhkNENVdqd1NNRW5VMitQaTdwcnc2dkE9PQ==', 'NR57yl+oe58VKhBm3GoHMG5nRmwwTTVpYlp6U0c4NUl6SWwrY1E9PQ==', 'yL7jz6IM7gQq4u4BJ/34uEhvZWhkOE5tVHJEMTZtUFBwTnRvT2c9PQ==', 'EwVaSLkK5i2yxs54UxV3hCs1eXhWYmtCVmdFT2xNZ2UvRzNRQ3c9PQ==', 'FD1hm+3LGxi/mxuKbLT3MHBHR1hqNmVTTStCQldFR0ZYdE1kT0E9PQ==', 'uGEcNIfSUSIc2Qc2LrIEgFQ1TjBOOEU3SzNnZXFaaUJITit6Qmc9PQ==', 'tXclrejz+PGmgnGD540SWlN4K2tIQUpKaVBIWHZmdWFYb3RoWXc9PQ==', '/bLEt5Wx3aBhcDS7DQdcHi9YSDR4RGNKOFJsa1hkZ0dzYXArTVE9PQ==', 'IGLAiRUGr63LkX10mfKX2HpEWDlFbDdNTkt3QWtvd2d0RVQvS2c9PQ==', 'RXadzzB2O8eF2XwmQnS2PlVsK01xcis2bFdaMTc4MUhPZXYrZEE9PQ==', 'U3YPPEkoRC33HLVjh4lihTZQQzJkSDE5MExadFp0Z3VHaW04M2c9PQ==', 'fZFKWIlgdBmyLJ+WYWBTPUVYWHZyZHlPSnlXK0JaQ3FmRndPbUE9PQ==', 'pending', '2024-12-12 05:35:22');

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
(37, '9KnNHleYQs5oSBpHs7/jklkxNEtxWk5WdUt1dVoxYVVzaThUa1E9PQ==', 'ejieflorida123@gmail.com', '7Sobzp+a/aXA0BqRfjh6yG4wK1RIUjBWbTdFVWE3MHJrUStKOFE9PQ==', 'fo4evhjUNtI1QZ79fWXj4ERKenNKTTNrb1lsUmtncEU5YVY3UjFTS0F1eHE4WktpRHZ5UG5KWHRxL009', '$2y$10$BQcTurhNzAdRetwfZJ7TL.4v9XwXe.WdSE1T3uTr7Nkg4KVhxlfOS', '2024-11-21 11:18:08', 'pictures/default.jpg', '', '', 'Approved', '../uploads/faces/face_673ea6700f3580.53003875.png');

--
-- Indexes for dumped tables
--

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
