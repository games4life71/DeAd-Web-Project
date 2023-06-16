-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:9999
-- Generation Time: Jun 14, 2023 at 08:47 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dead`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
                                `appointment_id` int(11) NOT NULL,
                                `person_id` int(11) NOT NULL,
                                `firstname` varchar(45) NOT NULL,
                                `lastname` varchar(45) NOT NULL,
                                `relationship` varchar(45) NOT NULL,
                                `visit_nature` varchar(45) NOT NULL,
                                `photo` mediumblob NOT NULL,
                                `source_of_income` varchar(45) DEFAULT NULL,
                                `date` date NOT NULL,
                                `visit_start` time NOT NULL,
                                `visit_end` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `person_id`, `firstname`, `lastname`, `relationship`, `visit_nature`, `photo`, `source_of_income`, `date`, `visit_start`, `visit_end`) VALUES
                                                                                                                                                                                         (24, 9, 'gigel', 'frone', 'relative', 'friendship', 0x433a5c78616d70705c746d705c706870363830382e746d70, 'self-employed', '2023-05-11', '17:03:00', '17:17:00'),
                                                                                                                                                                                         (25, 9, 'gigel', 'frone', 'relative', 'lawyership', 0x433a5c78616d70705c746d705c706870343945302e746d70, 'self-employed', '2023-05-16', '17:05:00', '18:17:00'),
                                                                                                                                                                                         (26, 9, 'gigel', 'frone', 'legal_gurdian', 'friendship', 0x433a5c78616d70705c746d705c706870464333312e746d70, 'employed', '2023-05-17', '11:03:00', '12:17:00'),
                                                                                                                                                                                         (27, 9, 'gigel', 'frone', 'relative', 'lawyership', 0x433a5c78616d70705c746d705c706870313239452e746d70, 'employed', '2023-05-18', '15:03:00', '16:17:00'),
                                                                                                                                                                                         (28, 14, 'gigel', 'frone', 'relative', 'parental', 0x433a5c78616d70705c746d705c706870444338372e746d70, 'self-employed', '2023-06-22', '15:03:00', '17:17:00');

-- --------------------------------------------------------

--
-- Table structure for table `inmates`
--

CREATE TABLE `inmates` (
                           `fname` varchar(50) NOT NULL,
                           `lname` varchar(50) NOT NULL,
                           `inmate_id` int(11) NOT NULL,
                           `person_id` int(11) NOT NULL,
                           `sentence_start_date` date NOT NULL,
                           `sentence_duration` int(11) NOT NULL,
                           `sentence_category` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inmates`
--

INSERT INTO `inmates` (`fname`, `lname`, `inmate_id`, `person_id`, `sentence_start_date`, `sentence_duration`, `sentence_category`) VALUES
                                                                                                                                        ('gigel', 'frone', 1, 4, '2022-01-01', 365, 'Minor Offense'),
                                                                                                                                        ('mihai', 'rait', 2, 5, '2022-05-01', 365, 'Drug-related offense'),
                                                                                                                                        ('giga ', 'hagi', 3, 6, '2022-03-01', 730, 'Violent crime'),
                                                                                                                                        ('', '', 4, 7, '2022-04-01', 365, 'White-collar crime'),
                                                                                                                                        ('', '', 5, 8, '2022-01-01', 1095, 'Sexual assault');

-- --------------------------------------------------------

--
-- Table structure for table `reset_pwd_requests`
--

CREATE TABLE `reset_pwd_requests` (
                                      `id` int(11) NOT NULL,
                                      `username` varchar(100) NOT NULL,
                                      `email` varchar(100) NOT NULL,
                                      `token` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reset_pwd_requests`
--

INSERT INTO `reset_pwd_requests` (`id`, `username`, `email`, `token`) VALUES
    (11, 'stefan2', '7stefanadrian@gmail.com', 'ebcf11bdbee868e12daf1878d6902620ddd15f8f890347ea42263c6ae582dd141b91f1da4242325e8fbd5df309818cbbbd67');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
                         `user_id` int(11) NOT NULL,
                         `username` varchar(45) NOT NULL,
                         `password` varchar(100) NOT NULL,
                         `fname` varchar(45) NOT NULL,
                         `lname` varchar(45) NOT NULL,
                         `email` varchar(100) NOT NULL,
                         `photo` mediumblob DEFAULT NULL,
                         `secondary_email` varchar(45) DEFAULT NULL,
                         `function` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `fname`, `lname`, `email`, `photo`, `secondary_email`, `function`) VALUES
                                                                                                                               (1, 'john.doe', '$2y$10$ZYRJ.DJMZ4UcC...', 'John', 'Doe', 'john.doe@example.com', NULL, NULL, ''),
                                                                                                                               (2, 'jane.doe', '$2y$10$uJwq3V7vj...', 'Jane', 'Doe', 'jane.doe@example.com', NULL, NULL, ''),
                                                                                                                               (3, 'alice', '$2y$10$wJyq7V6lK...', 'Alice', 'Smith', 'alice@example.com', NULL, NULL, ''),
                                                                                                                               (4, 'bob', '$2y$10$pKwz1V5mB...', 'Bob', 'Johnson', 'bob@example.com', NULL, NULL, ''),
                                                                                                                               (5, 'ana.maria', '$2y$10$tKwz2V5mB...', 'Ana Maria', 'Popescu', 'ana.maria@example.com', NULL, NULL, ''),
                                                                                                                               (6, 'daniel.b', '$2y$10$rFZK.DJMZ4UcC...', 'Daniel', 'Balan', 'daniel.b@example.com', NULL, NULL, ''),
                                                                                                                               (7, 'cristina.p', '$2y$10$gFZK.DJMZ4UcC...', 'Cristina', 'Popa', 'cristina.p@example.com', NULL, NULL, ''),
                                                                                                                               (8, 'alex.m', '$2y$10$hFZK.DJMZ4UcC...', 'Alex', 'Mihai', 'alex.m@example.com', NULL, NULL, 'user'),
                                                                                                                               (9, 'stefan123', '$2y$10$Q/Eyg0VgTOS0NfQ6kReYk.DXp8IQEIIofdpTnvVHxIPP.ibX/bBMa', 'stefan', 'adrian', '8sad@gmail.com', NULL, '7stefansdsadrian@gmail.com', 'admin'),
                                                                                                                               (10, 'stefan1231', '$2y$10$BfRFUmMh9O2ySTjNHfwIcu4D90V953Qw5czn15.yKDXP8ThMI/vFm', 'asdasd', 'asdasd', 'razvan_dogaru@yahoo.co.uk', NULL, NULL, ''),
                                                                                                                               (11, 'sefu', '$2y$10$OboNCvZWP.rfgn.idYZdgOrxLmSFovf6zVsHKuPywbkMPXBBcnI3.', 'sefu', 'labani', 'sefu@gov.com', NULL, NULL, 'admin'),
                                                                                                                               (12, 'sefu2', '$2y$10$nvOZUfKKGwn64uV7gIFsdOwoC4RHmtVI1eczY8rNAMfoEQXWV31i6', 'sefu', 'sefu', 'sefu@mai.com', NULL, NULL, 'admin'),
                                                                                                                               (13, 'asdasd', '$2y$10$M6ZQrVSgrrgxTCNubcDLoOhD2w0doPH9ix06/qJ6MWsLaWj5iAS42', 'asdasd', 'addasd', 'sef@am.com', NULL, NULL, 'user'),
                                                                                                                               (14, 'stefan12', '$2y$10$fwz1kduayiJFhqJNBTZ45uEZ.yFcSFD9qRhOSVtNC4mf/kW3u6EPm', 'stefan', 'adrian', '7stefanadrian@gmail.com712', NULL, NULL, 'user'),
                                                                                                                               (15, 'stefan2', '$2y$10$sJmyqnG4HoCEPofQenQhX.9aFtUIibMEuUGk6TIzekpfUdkyE8Gmq', 'Dogaru', 'Stefan Adrian', '7stefanadrian@gmail.com', NULL, NULL, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
                            `person_id` int(11) NOT NULL,
                            `relationship` varchar(50) NOT NULL,
                            `inmate_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`person_id`, `relationship`, `inmate_id`) VALUES
                                                                      (1, 'Friend', 1),
                                                                      (2, 'Family', 2),
                                                                      (3, 'Lawyer', 3),
                                                                      (3, 'Lawyer', 4),
                                                                      (2, 'Step sister', 5),
                                                                      (3, 'Lawyer', 5);

-- --------------------------------------------------------

--
-- Table structure for table `visits_summary`
--

CREATE TABLE `visits_summary` (
                                  `visit_id` int(11) NOT NULL,
                                  `visitor_id` int(11) NOT NULL,
                                  `inmate_id` int(11) NOT NULL,
                                  `visit_date` date NOT NULL,
                                  `witnesses` varchar(45) NOT NULL,
                                  `visit_nature` varchar(45) NOT NULL,
                                  `items_provided_to_convict` varchar(255) DEFAULT NULL,
                                  `items_offered_by_convict` varchar(255) DEFAULT NULL,
                                  `health_status` varchar(45) DEFAULT NULL,
                                  `visit_hours` varchar(45) NOT NULL,
                                  `summary` varchar(255) NOT NULL,
                                  `appointment_refID` int(99) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visits_summary`
--

INSERT INTO `visits_summary` (`visit_id`, `visitor_id`, `inmate_id`, `visit_date`, `witnesses`, `visit_nature`, `items_provided_to_convict`, `items_offered_by_convict`, `health_status`, `visit_hours`, `summary`, `appointment_refID`) VALUES
                                                                                                                                                                                                                                             (14, 9, 1, '2023-05-01', 'nurse', 'Friendship', 'asdasd', 'asd', 'good', '1', 'asdasd', 24),
                                                                                                                                                                                                                                             (15, 9, 1, '2023-05-01', 'doctor', 'Friendship', 'adasd', 'zdd', 'ok', '2', 'asdasd', 25),
                                                                                                                                                                                                                                             (16, 9, 1, '2023-05-17', 'nurse', 'friendship', NULL, NULL, NULL, '3', '', 26),
                                                                                                                                                                                                                                             (17, 9, 1, '2023-05-16', 'doctor', 'Friendship', 'dasdas', 'dsdas', 'good', '3', 'dasdadas', 27),
                                                                                                                                                                                                                                             (18, 14, 1, '2023-06-22', 'nurse', 'parental', NULL, NULL, NULL, '4', '', 28);

-- --------------------------------------------------------

--
-- Table structure for table `witnesses`
--

CREATE TABLE `witnesses` (
                             `witness_id` int(11) NOT NULL,
                             `person_id` int(11) NOT NULL,
                             `visit_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
    ADD PRIMARY KEY (`appointment_id`),
  ADD UNIQUE KEY `appointment_id_UNIQUE` (`appointment_id`),
  ADD KEY `person_id_from_appointments_idx` (`person_id`);

--
-- Indexes for table `inmates`
--
ALTER TABLE `inmates`
    ADD PRIMARY KEY (`inmate_id`),
  ADD UNIQUE KEY `inmate_id_UNIQUE` (`inmate_id`),
  ADD UNIQUE KEY `person_id_UNIQUE` (`person_id`);

--
-- Indexes for table `reset_pwd_requests`
--
ALTER TABLE `reset_pwd_requests`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
    ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_id_UNIQUE` (`user_id`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
    ADD PRIMARY KEY (`inmate_id`,`person_id`),
  ADD KEY `person_id_idx` (`person_id`);

--
-- Indexes for table `visits_summary`
--
ALTER TABLE `visits_summary`
    ADD PRIMARY KEY (`visit_id`),
  ADD UNIQUE KEY `visit_id_UNIQUE` (`visit_id`),
  ADD KEY `inmate_id_idx` (`inmate_id`),
  ADD KEY `appointment` (`appointment_refID`);

--
-- Indexes for table `witnesses`
--
ALTER TABLE `witnesses`
    ADD PRIMARY KEY (`witness_id`),
  ADD UNIQUE KEY `witness_id_UNIQUE` (`witness_id`),
  ADD KEY `person_id_from_witnesses_idx` (`person_id`),
  ADD KEY `visit_id_idx` (`visit_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
    MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `inmates`
--
ALTER TABLE `inmates`
    MODIFY `inmate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reset_pwd_requests`
--
ALTER TABLE `reset_pwd_requests`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
    MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `visits_summary`
--
ALTER TABLE `visits_summary`
    MODIFY `visit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `witnesses`
--
ALTER TABLE `witnesses`
    MODIFY `witness_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
    ADD CONSTRAINT `person_id_from_appointments` FOREIGN KEY (`person_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inmates`
--
ALTER TABLE `inmates`
    ADD CONSTRAINT `person_id_from_inmates` FOREIGN KEY (`person_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `visitors`
--
ALTER TABLE `visitors`
    ADD CONSTRAINT `inmate_id_from_visitors` FOREIGN KEY (`inmate_id`) REFERENCES `inmates` (`inmate_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `person_id` FOREIGN KEY (`person_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `visits_summary`
--
ALTER TABLE `visits_summary`
    ADD CONSTRAINT `appointment` FOREIGN KEY (`appointment_refID`) REFERENCES `appointments` (`appointment_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inmate_id` FOREIGN KEY (`inmate_id`) REFERENCES `inmates` (`inmate_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `witnesses`
--
ALTER TABLE `witnesses`
    ADD CONSTRAINT `person_id_from_witnesses` FOREIGN KEY (`person_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `visit_id` FOREIGN KEY (`visit_id`) REFERENCES `visits_summary` (`visit_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
