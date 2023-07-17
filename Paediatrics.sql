-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 17, 2023 at 09:11 AM
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
-- Database: `Paediatrics`
--

-- --------------------------------------------------------

--
-- Table structure for table `Appointment`
--

CREATE TABLE `Appointment` (
  `AppointmentID` varchar(25) NOT NULL,
  `PatientID` varchar(25) NOT NULL,
  `DoctorID` varchar(25) NOT NULL,
  `ReceptionistID` varchar(25) NOT NULL,
  `AppointmentNo` varchar(25) NOT NULL,
  `AppointmentDate` date NOT NULL,
  `AppointmentReason` varchar(25) NOT NULL,
  `image` varchar(25) NOT NULL,
  `PatientProfile` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Doctor`
--

CREATE TABLE `Doctor` (
  `id` int(11) NOT NULL,
  `Name` varchar(25) NOT NULL,
  `Surname` varchar(25) NOT NULL,
  `Age` varchar(25) NOT NULL,
  `Gender` varchar(25) NOT NULL,
  `PhoneNumber` varchar(25) NOT NULL,
  `Specialisation` varchar(25) NOT NULL,
  `Image` varchar(25) NOT NULL,
  `Room` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Doctor`
--

INSERT INTO `Doctor` (`id`, `Name`, `Surname`, `Age`, `Gender`, `PhoneNumber`, `Specialisation`, `Image`, `Room`) VALUES
(1, 'Raash', 'Knight', '33', 'Female', '010234567', 'Paediatrician', 'uploads/receptionist.jpg', '7');

-- --------------------------------------------------------

--
-- Table structure for table `Patient`
--

CREATE TABLE `Patient` (
  `Name` varchar(25) NOT NULL,
  `Surname` varchar(25) NOT NULL,
  `Age` varchar(25) NOT NULL,
  `Gender` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `Image` varchar(25) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Patient`
--

INSERT INTO `Patient` (`Name`, `Surname`, `Age`, `Gender`, `email`, `Image`, `id`) VALUES
('Tebogo', 'Ramolobeng', '2000-10-18', 'Female', 'example@email.com', '', 8),
('slaap', 'tiger', '2022-01-14', 'Other', 'trying@icloud.com', '', 10),
('Woman', 'King', '2022-09-15', 'Female', 'womanking@africa.com', '', 12),
('tween', 'eight', '2', 'Female', 'example@email.com', 'Array', 16),
('New', 'person', '3', 'Other', 'newperson@yahoo.com', 'Array', 18),
('', '', '', '', '', '', 21),
('', '', '', '', '', '', 22),
('', '', '', '', '', '', 23),
('', '', '', '', '', '', 24),
('', '', '', '', '', '', 25),
('', '', '', '', '', '', 26),
('', '', '', '', '', '', 27),
('', '', '', '', '', '', 28),
('', '', '', '', '', '', 29),
('', '', '', '', '', '', 30),
('', '', '', '', '', '', 31),
('', '', '', '', '', '', 32);

-- --------------------------------------------------------

--
-- Table structure for table `PatientForm`
--

CREATE TABLE `PatientForm` (
  `id` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `gender` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Receptionist`
--

CREATE TABLE `Receptionist` (
  `ID` varchar(25) NOT NULL,
  `Name` varchar(25) NOT NULL,
  `Surname` varchar(25) NOT NULL,
  `Age` varchar(25) NOT NULL,
  `Gender` varchar(25) NOT NULL,
  `PhoneNumber` varchar(25) NOT NULL,
  `ProfileImage` varchar(25) NOT NULL,
  `Rank` varchar(25) NOT NULL,
  `Password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Appointment`
--
ALTER TABLE `Appointment`
  ADD PRIMARY KEY (`AppointmentID`),
  ADD KEY `PatientID` (`PatientID`),
  ADD KEY `DoctorID` (`DoctorID`),
  ADD KEY `ReceptionistID` (`ReceptionistID`);

--
-- Indexes for table `Doctor`
--
ALTER TABLE `Doctor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Patient`
--
ALTER TABLE `Patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `PatientForm`
--
ALTER TABLE `PatientForm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Receptionist`
--
ALTER TABLE `Receptionist`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Doctor`
--
ALTER TABLE `Doctor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Patient`
--
ALTER TABLE `Patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `PatientForm`
--
ALTER TABLE `PatientForm`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Appointment`
--
ALTER TABLE `Appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`ReceptionistID`) REFERENCES `Receptionist` (`ID`),
  ADD CONSTRAINT `appointment_ibfk_3` FOREIGN KEY (`PatientID`) REFERENCES `Patient` (`id`);

--
-- Constraints for table `Doctor`
--
ALTER TABLE `Doctor`
  ADD CONSTRAINT `doctor_ibfk_1` FOREIGN KEY (`id`) REFERENCES `Appointment` (`DoctorID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
