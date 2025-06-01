-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2025 at 07:14 PM
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
-- Database: `botoph`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `candidate_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `party` varchar(100) NOT NULL DEFAULT 'Independent',
  `platform` varchar(120) NOT NULL DEFAULT 'No platform.',
  `status` varchar(100) NOT NULL DEFAULT 'running',
  `photo_url` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`candidate_id`, `first_name`, `last_name`, `position`, `party`, `platform`, `status`, `photo_url`) VALUES
(18, 'Rodrigo', 'Duterte', 'Davao City Mayor', 'PDP-Laban', 'Anti-Drug Campaign. Law and Order. Infrastructure Development.', 'running', 'rodrigoduterte.jpg'),
(21, 'Cynthia', 'Villar', 'Las Piñas City Representative', 'Nacionalista Party', 'Agriculture and Food Security. Environmental Protection.', 'running', 'cynthiavillar.jpg'),
(26, 'Bam', 'Aquino', 'Senator', 'Liberal Party', 'Educational reform. Youth empowerment. Affordable internet access. MSME support. Anti-corruption.', 'running', 'bamaquino.jpg'),
(27, 'Kiko', 'Pangilinan', 'Senator', 'Liberal Party', 'Agricultural development. Food security. Farmer and fisherfolk welfare. Anti-corruption. Good governance.', 'running', 'kikopangilinan.jpg'),
(29, 'Erwin', 'Tulfo', 'Senator', 'Lakas–Christian Muslim Democrats (Lakas–CMD)', 'PhilHealth reforms. Anti-political dynasty. West Philippine Sea defense. Middle class support.', 'running', 'erwintulfo.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `candidate_profiles`
--

CREATE TABLE `candidate_profiles` (
  `profile_id` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `running_for` varchar(255) NOT NULL,
  `party_list` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `candidate_profiles`
--

INSERT INTO `candidate_profiles` (`profile_id`, `candidate_id`, `full_name`, `running_for`, `party_list`, `content`, `created_at`, `updated_at`) VALUES
(1, 18, 'Rodrigo Roa Duterte', 'Davao City Mayor', 'Partido Demokratiko Pilipino (PDP-Laban)', '<h2>📜 Background</h2><h2><p style=\"font-size: 16px; font-weight: 400;\">Rodrigo Roa Duterte, born on March 28, 1945, in Maasin, Southern Leyte, served as the 16th President of the Philippines from 2016 to 2022. Before his presidency, he was the long-time mayor of Davao City, holding office for over two decades. Known for his tough stance on crime and drugs, Duterte rose to national prominence through his unfiltered rhetoric and “strongman” leadership style.</p><p style=\"font-size: 16px; font-weight: 400;\"><br></p></h2><h2>🎯 Platform</h2><h2><ul style=\"font-size: 16px; font-weight: 400;\"><li><strong data-start=\"564\" data-end=\"578\">Education:</strong>&nbsp;Advocated for free tuition in state universities and colleges, which was signed into law in 2017 (RA 10931).</li><li><strong data-start=\"690\" data-end=\"705\">Healthcare:</strong>&nbsp;Pushed for universal health care; signed the Universal Health Care Act (RA 11223) into law in 2019, expanding access to medical services for all Filipinos.</li></ul><div><span style=\"font-size: 16px; font-weight: 400;\"><br></span></div></h2><h2>📊 Track Record</h2><h2><strong data-start=\"887\" data-end=\"898\" style=\"font-size: 16px;\"><span style=\"font-weight: 400;\">✅</span>Signed into law:</strong><span style=\"font-size: 16px; font-weight: 400;\">&nbsp;</span></h2><h2><ul><li><span style=\"font-size: 16px; font-weight: normal;\">Unive</span><span style=\"font-size: 16px; font-weight: normal;\">rsal Health Care Act (RA 11223)</span></li><li><span style=\"font-weight: normal;\"><span style=\"font-size: 16px;\">Universal Access to Quality Tertiary Education Act&nbsp;</span><span style=\"font-size: 16px;\">(RA 10931)</span></span></li><li><span style=\"font-size: 16px; font-weight: normal;\">Anti-Terrorism Act (R</span><span style=\"font-size: 16px; font-weight: normal;\">A 11479)</span></li></ul></h2><h2><strong data-start=\"1008\" data-end=\"1027\" style=\"font-size: 16px;\"><span style=\"font-weight: 400;\">❌</span>Criticized for:</strong><span style=\"font-weight: 400; font-size: 16px;\">&nbsp;</span></h2><h2><ul><li><span style=\"font-weight: 400; font-size: 16px;\">Controversial war on drugs</span></li><li><span style=\"font-weight: 400; font-size: 16px;\">Human rights concerns</span></li><li><span style=\"font-weight: 400; font-size: 16px;\">Response to the COVID-19 pandemic.</span></li></ul></h2><div><br></div><h2>📚 References</h2><h2><ul style=\"font-size: 16px; font-weight: 400;\"><li><a href=\"https://\">COMELEC Profile</a></li><li><a href=\"https://\">Interview with Rodrigo Duterte – Rappler</a></li><li><a href=\"https://\">Presidency Records – Official Gazette</a></li></ul></h2><ul>\n      </ul>', '2025-05-26 11:34:18', '2025-05-26 16:44:59'),
(2, 21, 'Cynthia Aguilar Villar', 'Las Piñas City Representative', 'Nacionalista Party', '<h2>📜 Background</h2>\n                    <p>Cynthia Aguilar Villar, born July 29, 1950, is a prominent Filipino businesswoman and politician. She is the wife of former Senate President Manuel Villar and has served as a senator since 2013. Cynthia Villar is known for her work in agriculture, rural development, and environmental conservation. Before her Senate career, she was a congresswoman representing Las Piñas City.</p>\n\n                    <h2>🎯 Platform</h2>\n                    <ul>\n                        <li><strong data-start=\"498\" data-end=\"512\">Education:</strong> Supports enhanced education funding and scholarships for underprivileged students.</li><li><strong data-start=\"598\" data-end=\"614\">Agriculture:</strong> Advocates for modernization of Philippine agriculture, support for farmers, and food security initiatives.</li><li><strong data-start=\"724\" data-end=\"740\">Environment:</strong> Promotes sustainable environmental policies and disaster risk reduction programs.</li>\n                    </ul>\n\n                    <h2>📊 Track Record</h2>\n                    <ul>\n                        <li>✅ Passed: Agriculture and Fisheries Modernization Act (support and amendments), Expanded Senior Citizens Act</li><li>❌ Criticized for: Allegations related to family business interests and environmental concerns</li>\n                    </ul>\n\n                    <h2>📚 References</h2>\n                    <ul>\n                        <li><a>COMELEC Profile</a></li>\n                        <li><a>Interview with Cynthia Villar</a> – Rappler</li>\n                        <li><a>Senate Biography</a></li>\n                    </ul>', '2025-05-26 14:12:01', '2025-05-26 20:43:35'),
(3, 26, 'Paolo Benigno \"Bam\" Aguirre Aquino IV', 'Senator', 'Katipunan ng Nagkakaisang Pilipino (KANP)', '<h2>📜 Background</h2>\n                    <p>Bam Aquino is a Filipino politician and businessman. He served as a senator of the Philippines from 2013 to 2019. He is a member of the prominent Aquino family, known for their political legacy in the Philippines.</p>\n\n                    <h2>🎯 Platform</h2>\n                    <ul>\n                        <li data-start=\"388\" data-end=\"435\"><p data-start=\"390\" data-end=\"435\"><b>Education</b>: Quality public education for all</p>\n</li>\n<li data-start=\"436\" data-end=\"490\">\n<p data-start=\"438\" data-end=\"490\"><b>Healthcare</b>: Improved universal healthcare services</p>\n</li>\n<li data-start=\"491\" data-end=\"551\">\n<p data-start=\"493\" data-end=\"551\"><b>Economy</b>: Support for small and medium enterprises (SMEs)</p>\n</li>\n<li data-start=\"552\" data-end=\"607\">\n<p data-start=\"554\" data-end=\"607\"><b>Environment</b>: Stronger environmental protection laws</p></li>\n                    </ul>\n\n                    <h2>📊 Track Record</h2>\n                    <ul>\n                        <li>✅ Passed: Universal Access to Quality Tertiary Education Act</li><li>✅ Passed: Mental Health Law</li><li>✅ Advocated for: Youth empowerment and innovation</li><li>❌ Voted against: Some tax reform measures</li>\n                    </ul>\n\n                    <h2>📚 References</h2>\n                    <ul>\n                        <li><a>COMELEC Profile</a></li>\n                        <li><a>Interview with Bam Aquino</a>&nbsp;– Rappler</li>\n                        <li><a>Senate Biography</a></li>\n                    </ul>', '2025-05-26 14:24:06', '2025-05-26 14:24:06'),
(4, 27, 'Francis \"Kiko\" Pangilinan', 'Senator', 'Liberal Party of the Philippines', '<h2>📜 Background</h2>\n                    <p>Francis Pangilinan is a lawyer, farmer, and seasoned legislator. He has served multiple terms in the Senate and is known for his advocacy on agriculture and youth empowerment. He is also the current chairperson of the Liberal Party.</p>\n\n                    <h2>🎯 Platform</h2><ul>\n<li data-start=\"494\" data-end=\"570\"><p data-start=\"496\" data-end=\"570\"><strong data-start=\"496\" data-end=\"514\">Food Security:</strong>&nbsp;Push for increased support for farmers and fisherfolk</p></li><li data-start=\"571\" data-end=\"655\">\n<p data-start=\"573\" data-end=\"655\"><strong data-start=\"573\" data-end=\"587\">Education:</strong> Strengthen access to quality education, especially in rural areas</p>\n</li>\n<li data-start=\"656\" data-end=\"748\">\n<p data-start=\"658\" data-end=\"748\"><strong data-start=\"658\" data-end=\"673\">Governance:</strong> Promote transparency, anti-corruption measures, and people participation</p></li>\n                    </ul>\n\n                    <h2>📊 Track Record</h2>\n                    <ul>\n                        <li>✅ Passed: Sagip Saka Act (Farmers and Fisherfolk Enterprise Development Act)</li><li>✅ Championed: Juvenile Justice and Welfare Act</li><li>❌ Opposed: Anti-Terror Law</li>\n                    </ul>\n\n                    <h2>📚 References</h2>\n                    <ul>\n                        <li><a href=\"https://www.google.com\">COMELEC Profile</a></li>\n                        <li><a>Interview with Kiko Pangilinan</a>&nbsp;– Rappler</li>\n                        <li><a>Senate Biography</a></li>\n                    </ul>', '2025-05-26 14:29:40', '2025-05-26 15:09:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `role` varchar(10) NOT NULL DEFAULT 'voter',
  `status` varchar(10) NOT NULL DEFAULT 'active',
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(200) NOT NULL,
  `birthdate` date NOT NULL,
  `sex` varchar(10) NOT NULL DEFAULT 'n/a',
  `region` varchar(100) NOT NULL,
  `province` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `last_login` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `role`, `status`, `first_name`, `last_name`, `middle_name`, `email`, `password_hash`, `birthdate`, `sex`, `region`, `province`, `created_at`, `last_login`) VALUES
(1, 'admin', 'active', 'Rodjones', 'Rosalinda', 'Opiña', 'rodjonesrosalinda@gmail.com', '$2y$10$aLlUDp0w4ngMKnNLfUrBJOcXpIeKlI7sPEwnH2fBikfKAmW5E98d2', '2005-01-17', 'Male', 'MIMAROPA', 'Occidental Mindoro', '2025-05-18 22:43:18', '2025-05-30 22:59:04'),
(2, 'voter', 'active', 'Allan', 'Esteves', '', 'allan@gmail.com', '$2y$10$IFkJoXs8MPoA28ZdfgYH0OO1byD.8uJjczUVJf4t0rqWKdFBFdrde', '2005-03-21', 'Male', 'MIMAROPA', 'Occidental Mindoro', '2025-05-19 22:43:18', '2025-05-27 01:13:59'),
(3, 'voter', 'active', 'Cindy', 'Salazar', '', 'cindy@gmail.com', '$2y$10$A30qweersbUsl7LcFH70GuG94wQjP49yYGRDHLjRnNkyNjxtqK5Wa', '2004-10-13', 'Female', 'MIMAROPA', 'Occidental Mindoro', '2025-05-19 22:43:18', '2025-05-27 01:13:07'),
(4, 'voter', 'active', 'Edrich', 'Valera', 'Magdongon', 'edrich@gmail.com', '$2y$10$qtiSvkZtfJ6RFXnDoA8K8eOq7VeejNndRJBTCIUnsM8.w3uqULKaq', '2006-07-27', 'Male', 'MIMAROPA', 'Occidental Mindoro', '2025-05-20 22:45:12', '2025-05-21 03:16:08'),
(5, 'voter', 'active', 'Ramon', 'Ramirez', '', 'ramon@gmail.com', '$2y$10$9bJFpaNWfcWdbPR8azrwRe7Ran/v5qDfke5aZ2BcI.SUJhXRRJj/i', '2003-07-15', 'Male', 'MIMAROPA', 'Occidental Mindoro', '2025-05-20 22:47:28', '2025-05-27 00:17:26'),
(6, 'voter', 'active', 'James', 'Felicitas', '', 'james@gmail.com', '$2y$10$tYMISm5JV9JN8fHaIa6Fee1I6Vrs3gQAceyO1tISoMfDG.9Ar1FAm', '2005-02-06', 'Male', 'MIMAROPA', 'Occidental Mindoro', '2025-05-20 22:49:12', '2025-05-27 00:15:59'),
(7, 'voter', 'active', 'Nicole', 'Belarmino', '', 'nicole@gmail.com', '$2y$10$kP1xwFbLLUz/jUj/8tS6texy7L.KHRjt/vJyEUEzcbdmkoiiSsbA2', '2005-02-22', 'Female', 'MIMAROPA', 'Occidental Mindoro', '2025-05-21 22:50:24', '2025-05-21 03:24:04'),
(8, 'voter', 'active', 'Chevy', 'Hernandez', '', 'chevy@gmail.com', '$2y$10$cHBVAm8ZDYfTNx2yas1.LOzTxnklzMDPw8dpd/irBhE8SeR2pyWha', '2005-04-27', 'Female', 'MIMAROPA', 'Occidental Mindoro', '2025-05-21 22:53:04', '2025-05-26 16:53:27'),
(9, 'voter', 'active', 'Vonkenneth', 'Rogero', '', 'vonkenneth@gmail.com', '$2y$10$CgJY7MQf7q3zrijQX1WHJe7GL6XdLxsIQwD5OZHLejruSgdIRvR66', '2005-10-01', 'Male', 'MIMAROPA', 'Occidental Mindoro', '2025-05-21 06:07:31', '2025-05-21 06:11:03'),
(10, 'voter', 'active', 'Jillian ', 'Esteban', '', 'jillian@gmail.com', '$2y$10$aXfboftsLR0lF5.cOyEsD.vCIGgdqzYZW0RfydmYIplOvnX8DAPNu', '2006-04-24', 'Female', 'MIMAROPA', 'Occidental Mindoro', '2025-05-22 07:20:24', '2025-05-26 02:33:28'),
(11, 'voter', 'active', 'Chamie', 'Francisco', '', 'chamie@gmail.com', '$2y$10$NP1jzv0veU8LCvmBq78pwuJozVU.HfXNjj/mxA41U6FasY8MV5av2', '2005-04-30', 'Female', 'MIMAROPA', 'Occidental Mindoro', '2025-05-23 01:58:16', '2025-05-23 01:58:43'),
(12, 'voter', 'active', 'Denver', 'Lalo', '', 'denver@gmail.com', '$2y$10$af4WzXz4veHq6i2s1uRv/e2EeSmf7Id/UK4VqnlKseNKdgQI9uwJy', '2005-12-23', 'Male', 'MIMAROPA', 'Occidental Mindoro', '2025-05-23 02:00:20', '2025-05-23 02:00:20'),
(13, 'voter', 'active', 'Zyrene', 'De Leon', '', 'zyrene@gmail.com', '$2y$10$ZOYDFSr8TBAflL8nmZ8CueqFttJEbuJ2OnJjuJMiT7MGAXmzWnE5q', '2005-05-09', 'Female', 'MIMAROPA', 'Occidental Mindoro', '2025-05-27 04:27:56', '2025-05-27 04:30:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`candidate_id`);

--
-- Indexes for table `candidate_profiles`
--
ALTER TABLE `candidate_profiles`
  ADD PRIMARY KEY (`profile_id`),
  ADD KEY `fk_candidate` (`candidate_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `candidate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `candidate_profiles`
--
ALTER TABLE `candidate_profiles`
  MODIFY `profile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `candidate_profiles`
--
ALTER TABLE `candidate_profiles`
  ADD CONSTRAINT `fk_candidate` FOREIGN KEY (`candidate_id`) REFERENCES `candidates` (`candidate_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
