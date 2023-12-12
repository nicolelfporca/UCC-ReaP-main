-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2023 at 01:22 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reap`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_name`, `status`) VALUES
(1, 'BSCS', '1'),
(2, 'BSIT', ''),
(3, 'BSIS', ''),
(4, 'BSEMC', '');

-- --------------------------------------------------------

--
-- Table structure for table `cover_title`
--

CREATE TABLE `cover_title` (
  `id` int(11) NOT NULL,
  `cover_title` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cover_title`
--

INSERT INTO `cover_title` (`id`, `cover_title`, `status`) VALUES
(1, 'Itechtibity', 1),
(2, 'ITIK', 1);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `log_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`log_id`, `username`, `password`, `role`) VALUES
(10, '20200080-M', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1),
(11, '2313', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1),
(12, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 2),
(13, '20200107-m', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1),
(14, '20200107-m', 'f3341dbcdda605b1601524b0d01655750cc60e0d', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `abstract` longtext NOT NULL,
  `uploaded_by` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `type` int(11) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp(),
  `cover_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `title`, `author`, `date`, `keywords`, `abstract`, `uploaded_by`, `status`, `type`, `timestamp`, `cover_id`) VALUES
(14, 'Science', 'ced,gelo,porca', '2023-08-23', 'science,tech,math', '64e6286ea5f27.jpg', NULL, 0, 2, '2023-08-23 23:40:30', 1),
(15, 'MATHEMATICS', 'jiro,daneris', '2023-08-26', 'science,tech,math', 'This thesis investigates the potential impact of virtual reality (VR) technology on learning outcomes in Science, Technology, Engineering, and Mathematics (STEM) education. In recent years, VR has gained significant attention as a promising tool for enhancing educational experiences. This study seeks to contribute to the existing body of knowledge by examining how the immersive and interactive nature of VR can influence students\' engagement, comprehension, and retention of complex STEM concepts.\n\nThe research employs a mixed-methods approach, combining quantitative measures of academic performance with qualitative insights into students\' perceptions and experiences. A cohort of secondary school students enrolled in a physics course was selected as the sample for this study. The experimental group participated in VR-enhanced learning activities, while the control group followed traditional instructional methods.\n\nQuantitative analysis of pre- and post-assessment scores reveals noteworthy differences between the two groups. The VR group exhibited a statistically significant increase in test scores compared to the control group, suggesting that VR interventions have a positive effect on knowledge acquisition and retention in STEM subjects. Moreover, qualitative data obtained through focus group discussions and surveys shed light on the students\' attitudes towards VR-based learning, highlighting aspects of engagement, motivation, and spatial understanding.\n\nIn addition, challenges and limitations associated with the integration of VR in the classroom are discussed, including technical barriers, content design considerations, and potential cognitive overload. These findings contribute to the ongoing dialogue surrounding the effective incorporation of innovative technologies into educational settings.\n\nOverall, this thesis provides valuable insights into the potential of virtual reality to reshape STEM education. By examining both the quantitative learning outcomes and qualitative student experiences, it offers a comprehensive perspective on the benefits and challenges of integrating VR into traditional pedagogical approaches. As technology continues to evolve, educators, curriculum designers, and policymakers can leverage these findings to make informed decisions about the role of VR in fostering enhanced learning environments.', NULL, 1, 1, '2023-08-25 14:54:57', 1),
(17, 'research', 'ced,gelo,porca', '2023-08-23', 'science,tech,english', 'This thesis investigates the potential impact of virtual reality (VR) technology on learning outcomes in Science, Technology, Engineering, and Mathematics (STEM) education. In recent years, VR has gained significant attention as a promising tool for enhancing educational experiences. This study seeks to contribute to the existing body of knowledge by examining how the immersive and interactive nature of VR can influence students\' engagement, comprehension, and retention of complex STEM concepts.\n\nThe research employs a mixed-methods approach, combining quantitative measures of academic performance with qualitative insights into students\' perceptions and experiences. A cohort of secondary school students enrolled in a physics course was selected as the sample for this study. The experimental group participated in VR-enhanced learning activities, while the control group followed traditional instructional methods.\n\nQuantitative analysis of pre- and post-assessment scores reveals noteworthy differences between the two groups. The VR group exhibited a statistically significant increase in test scores compared to the control group, suggesting that VR interventions have a positive effect on knowledge acquisition and retention in STEM subjects. Moreover, qualitative data obtained through focus group discussions and surveys shed light on the students\' attitudes towards VR-based learning, highlighting aspects of engagement, motivation, and spatial understanding.\n\nIn addition, challenges and limitations associated with the integration of VR in the classroom are discussed, including technical barriers, content design considerations, and potential cognitive overload. These findings contribute to the ongoing dialogue surrounding the effective incorporation of innovative technologies into educational settings.\n\nOverall, this thesis provides valuable insights into the potential of virtual reality to reshape STEM education. By examining both the quantitative learning outcomes and qualitative student experiences, it offers a comprehensive perspective on the benefits and challenges of integrating VR into traditional pedagogical approaches. As technology continues to evolve, educators, curriculum designers, and policymakers can leverage these findings to make informed decisions about the role of VR in fostering enhanced learning environments.', NULL, 1, 1, '2023-08-25 15:10:38', 1),
(23, 'Art Of War', 'Cruz Cedric Vincent,  Ramil Princess Angelica', '2023-08-28', 'Science,Math,English', 'jahfjhdjashfkjdasdfhabsdfjbwq irwqr gagifnduahfdonhadgfgqehqwhirg efkjasnhfgahsgdfhasdfhiasfgnwgerjhnqwnrgafdkjafjadsf', NULL, 1, 1, '2023-08-28 02:45:45', 1),
(26, 'MEMA', 'Cruz Cedric Vincent,  Perlota Angelo', '2023-08-28', 'science,math', 'This study explored the pattern of video game usage and video game addiction among male college students and examined how video game addiction was related to expectations of college engagement, college grade point average (GPA), and on-campus drug and alcohol violations. Participants were 477 male, first year students at a liberal arts college. In the week before the start of classes, participants were given two surveys: one of expected college engagement, and the second of video game usage, including a measure of video game addiction. Results suggested that video game addiction is (a) negatively correlated with expected college engagement, (b) negatively correlated with college GPA, even when controlling for high school GPA, and (c) negatively correlated with drug and alcohol violations that occurred during the first year in college. Results are discussed in terms of implications for male students’ engagement and success in college, and in terms of the construct validity of video game addiction', 9, 0, 1, '2023-08-28 22:40:27', 1),
(27, 'Blockchain', 'Perlota, Angelo Charles D.', '2023-08-30', 'science', 'BlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchainBlockchain', 12, 1, 1, '2023-08-30 09:55:08', 1),
(28, '213', '123', '2023-12-12', '123', 'asdasdadasda', 0, 0, 1, '2023-12-12 19:10:50', 1),
(29, 'CEDRIC JOJAC', 'asdasd', '2024-01-04', 'asdasd', 'dasdasdasdasda', 0, 0, 1, '2023-12-12 19:12:03', 1),
(33, 'CED', 'ced,  gelo', '2023-12-13', 'science,math', 'asdfadsf', 0, 1, 1, '2023-12-12 19:57:55', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `prof_id` int(11) NOT NULL,
  `campus` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `course_id` int(11) NOT NULL,
  `ac_year` int(11) NOT NULL,
  `student_no` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`prof_id`, `campus`, `first_name`, `middle_name`, `last_name`, `course_id`, `ac_year`, `student_no`, `email`, `photo`) VALUES
(10, 1, 'Cedric', 'b', 'Cruz', 1, 2023, '20200080-M', 'cruzcedric66@gmail.com', '64ed80fde0024.jpg'),
(12, 1, 'Angelo', 'Dellosa', 'Perlota', 1, 2023, '20200107-m', 'angeloperlota38@gmail.com', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `cover_title`
--
ALTER TABLE `cover_title`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`prof_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cover_title`
--
ALTER TABLE `cover_title`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `prof_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
