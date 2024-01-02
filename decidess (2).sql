-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2024 at 08:41 AM
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
-- Database: `decidess`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_logs`
--

CREATE TABLE `admin_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `action` enum('Create','Update','Recover','Delete') NOT NULL,
  `old_value` text DEFAULT NULL,
  `new_value` text DEFAULT NULL,
  `table_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_logs`
--

INSERT INTO `admin_logs` (`id`, `action`, `old_value`, `new_value`, `table_name`, `created_at`, `updated_at`) VALUES
(1, 'Update', 'school_year: 2023 - 2024 → 2023 - 2024, phase: Baseline → Baseline, status: Unset → Active', NULL, 'school_years', '2023-12-13 23:16:39', '2023-12-13 23:16:39'),
(2, 'Create', NULL, 'Section Name: Everlasting, School ID: 11, Grade Level: Kinder, Section Code: 11-Kinder-Everlasting', 'sections', '2023-12-13 23:18:28', '2023-12-13 23:18:28'),
(3, 'Create', NULL, 'Section Name: Mangga, School ID: 11, Grade Level: 1, Section Code: 11-1-Mangga', 'sections', '2023-12-13 23:18:42', '2023-12-13 23:18:42'),
(4, 'Create', NULL, 'Section Name: Starling, School ID: 11, Grade Level: 2, Section Code: 11-2-Starling', 'sections', '2023-12-13 23:19:14', '2023-12-13 23:19:14'),
(5, 'Create', NULL, 'Section: Everlasting, School ID: 11, Class Adviser ID: 49, Grade Level: Kinder', 'classrooms', '2023-12-14 02:33:19', '2023-12-14 02:33:19'),
(6, 'Create', NULL, 'Section: Mangga, School ID: 11, Class Adviser ID: 64, Grade Level: 1', 'classrooms', '2023-12-14 23:30:51', '2023-12-14 23:30:51'),
(7, 'Create', NULL, 'Section: Starling, School ID: 11, Class Adviser ID: 79, Grade Level: 2', 'classrooms', '2023-12-14 23:32:06', '2023-12-14 23:32:06'),
(8, 'Create', NULL, 'Section Name: Mustard, School ID: 11, Grade Level: 3, Section Code: 11-3-Mustard', 'sections', '2023-12-14 23:36:19', '2023-12-14 23:36:19'),
(9, 'Create', NULL, 'Section Name: Beryl, School ID: 11, Grade Level: 4, Section Code: 11-4-Beryl', 'sections', '2023-12-14 23:37:07', '2023-12-14 23:37:07'),
(10, 'Create', NULL, 'Section Name: Deligence, School ID: 11, Grade Level: 5, Section Code: 11-5-Deligence', 'sections', '2023-12-14 23:37:28', '2023-12-14 23:37:28'),
(11, 'Create', NULL, 'Section Name: Einstein, School ID: 11, Grade Level: 6, Section Code: 11-6-Einstein', 'sections', '2023-12-14 23:37:54', '2023-12-14 23:37:54'),
(12, 'Create', NULL, 'Section: Mustard, School ID: 11, Class Adviser ID: 94, Grade Level: 3', 'classrooms', '2023-12-14 23:41:02', '2023-12-14 23:41:02'),
(13, 'Create', NULL, 'Section: Beryl, School ID: 11, Class Adviser ID: 109, Grade Level: 4', 'classrooms', '2023-12-14 23:41:29', '2023-12-14 23:41:29'),
(14, 'Create', NULL, 'Section: Deligence, School ID: 11, Class Adviser ID: 124, Grade Level: 5', 'classrooms', '2023-12-14 23:42:04', '2023-12-14 23:42:04'),
(15, 'Create', NULL, 'Section: Einstein, School ID: 11, Class Adviser ID: 139, Grade Level: 6', 'classrooms', '2023-12-14 23:42:35', '2023-12-14 23:42:35'),
(16, 'Create', NULL, 'Section: Einstein, School ID: 11, Class Adviser ID: 139, Grade Level: 6', 'classrooms', '2023-12-14 23:42:58', '2023-12-14 23:42:58');

-- --------------------------------------------------------

--
-- Table structure for table `beneficiaries`
--

CREATE TABLE `beneficiaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pupil_id` bigint(20) UNSIGNED NOT NULL,
  `classadviser_id` bigint(20) UNSIGNED NOT NULL,
  `school_nurse_id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) UNSIGNED NOT NULL,
  `schoolyear_id` bigint(20) UNSIGNED NOT NULL,
  `height` decimal(5,2) NOT NULL,
  `weight` decimal(6,2) NOT NULL,
  `bmi_category` enum('Severely Wasted','Wasted','Normal','Overweight','Obese') NOT NULL,
  `hfa_category` enum('Severely Stunted','Stunted','Normal','Tall') NOT NULL,
  `is_feeding_program` enum('0','1') NOT NULL DEFAULT '0',
  `is_deworming_program` enum('0','1') NOT NULL DEFAULT '0',
  `is_immunization_vax_program` enum('0','1') NOT NULL DEFAULT '0',
  `is_mental_healthcare_program` enum('0','1') NOT NULL DEFAULT '0',
  `is_dental_care_program` enum('0','1') NOT NULL DEFAULT '0',
  `is_eye_care_program` enum('0','1') NOT NULL DEFAULT '0',
  `is_health_wellness_program` enum('0','1') NOT NULL DEFAULT '0',
  `is_medical_support_program` enum('0','1') NOT NULL DEFAULT '0',
  `is_nursing_services` enum('0','1') NOT NULL DEFAULT '0',
  `iron_supplementation` enum('0','1') DEFAULT NULL,
  `is_immunized` enum('0','1') DEFAULT NULL,
  `immunization_specify` varchar(255) DEFAULT NULL,
  `menarche` enum('0','1') DEFAULT NULL,
  `temperature` decimal(5,2) DEFAULT NULL,
  `blood_pressure` decimal(5,2) DEFAULT NULL,
  `heart_rate` decimal(5,2) DEFAULT NULL,
  `pulse_rate` decimal(5,2) DEFAULT NULL,
  `respiratory_rate` decimal(5,2) DEFAULT NULL,
  `vision_screening` enum('0','1') DEFAULT NULL,
  `auditory_screening` enum('0','1') DEFAULT NULL,
  `skin_scalp` varchar(255) DEFAULT NULL,
  `eyes` varchar(255) DEFAULT NULL,
  `ear` varchar(255) DEFAULT NULL,
  `nose` varchar(255) DEFAULT NULL,
  `mouth` varchar(255) DEFAULT NULL,
  `neck` varchar(255) DEFAULT NULL,
  `throat` varchar(255) DEFAULT NULL,
  `lungs` varchar(255) DEFAULT NULL,
  `heart` varchar(255) DEFAULT NULL,
  `abdomen` varchar(255) DEFAULT NULL,
  `deformities` enum('1','2') DEFAULT NULL,
  `deformity_specified` varchar(255) DEFAULT NULL,
  `date_of_examination` date DEFAULT NULL,
  `explanation` varchar(255) DEFAULT NULL,
  `is_deleted` enum('0','1') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `beneficiaries`
--

INSERT INTO `beneficiaries` (`id`, `pupil_id`, `classadviser_id`, `school_nurse_id`, `class_id`, `schoolyear_id`, `height`, `weight`, `bmi_category`, `hfa_category`, `is_feeding_program`, `is_deworming_program`, `is_immunization_vax_program`, `is_mental_healthcare_program`, `is_dental_care_program`, `is_eye_care_program`, `is_health_wellness_program`, `is_medical_support_program`, `is_nursing_services`, `iron_supplementation`, `is_immunized`, `immunization_specify`, `menarche`, `temperature`, `blood_pressure`, `heart_rate`, `pulse_rate`, `respiratory_rate`, `vision_screening`, `auditory_screening`, `skin_scalp`, `eyes`, `ear`, `nose`, `mouth`, `neck`, `throat`, `lungs`, `heart`, `abdomen`, `deformities`, `deformity_specified`, `date_of_examination`, `explanation`, `is_deleted`, `created_at`, `updated_at`) VALUES
(16, 1, 49, 37, 1, 1, 1.07, 11.00, 'Severely Wasted', 'Normal', '1', '0', '1', '0', '0', '0', '1', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-12-30', NULL, '0', '2023-12-29 07:29:03', '2023-12-30 14:28:20'),
(17, 2, 49, 37, 1, 1, 1.09, 16.00, 'Severely Wasted', 'Normal', '1', '0', '0', '0', '0', '0', '1', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2023-12-29 07:29:03', '2023-12-30 12:51:31'),
(18, 3, 49, 37, 1, 1, 0.99, 13.00, 'Severely Wasted', 'Normal', '1', '0', '0', '0', '0', '0', '1', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2023-12-29 07:29:03', '2023-12-30 12:51:31'),
(19, 4, 49, 37, 1, 1, 1.09, 14.00, 'Severely Wasted', 'Normal', '1', '0', '0', '0', '0', '0', '1', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2023-12-29 07:29:03', '2023-12-30 12:51:31'),
(20, 6, 49, 37, 1, 1, 1.16, 20.00, 'Severely Wasted', 'Normal', '1', '0', '0', '0', '0', '0', '1', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2023-12-29 07:29:03', '2023-12-30 12:51:31'),
(21, 7, 49, 37, 1, 1, 1.09, 16.00, 'Severely Wasted', 'Normal', '1', '0', '0', '0', '0', '0', '1', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2023-12-29 07:29:03', '2023-12-30 12:51:31'),
(22, 8, 49, 37, 1, 1, 1.10, 19.00, 'Severely Wasted', 'Normal', '1', '0', '0', '0', '0', '0', '1', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2023-12-29 07:29:03', '2023-12-30 12:51:31'),
(23, 9, 49, 37, 1, 1, 1.17, 24.00, 'Wasted', 'Normal', '1', '0', '0', '0', '0', '0', '1', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2023-12-29 07:29:03', '2023-12-30 12:51:31'),
(24, 10, 49, 37, 1, 1, 1.09, 16.00, 'Severely Wasted', 'Normal', '1', '0', '0', '0', '0', '0', '1', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2023-12-29 07:29:03', '2023-12-30 12:51:31'),
(25, 11, 49, 37, 1, 1, 1.09, 19.00, 'Severely Wasted', 'Normal', '1', '0', '0', '0', '0', '0', '1', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2023-12-29 07:29:03', '2023-12-30 12:51:31'),
(26, 12, 49, 37, 1, 1, 1.00, 13.00, 'Severely Wasted', 'Normal', '1', '0', '0', '0', '0', '0', '1', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2023-12-29 07:29:03', '2023-12-30 12:51:31'),
(27, 13, 49, 37, 1, 1, 1.08, 16.00, 'Severely Wasted', 'Normal', '1', '0', '0', '0', '0', '0', '1', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2023-12-29 07:29:03', '2023-12-30 12:51:31'),
(28, 14, 49, 37, 1, 1, 1.07, 16.00, 'Severely Wasted', 'Normal', '1', '1', '0', '0', '0', '0', '1', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2023-12-29 07:29:03', '2023-12-30 12:51:31'),
(29, 15, 49, 37, 1, 1, 1.19, 23.00, 'Severely Wasted', 'Normal', '1', '1', '0', '0', '0', '0', '1', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '2023-12-29 07:29:03', '2023-12-30 12:51:31'),
(30, 16, 49, 37, 1, 1, 1.03, 15.00, 'Severely Wasted', 'Normal', '1', '1', '0', '0', '0', '0', '1', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-12-30', NULL, '0', '2023-12-29 07:29:03', '2023-12-30 12:51:31');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `section` varchar(255) NOT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `classadviser_id` bigint(20) UNSIGNED NOT NULL,
  `grade_level` enum('Kinder','1','2','3','4','5','6','SPED') NOT NULL,
  `schoolyear_id` bigint(20) UNSIGNED NOT NULL,
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `section`, `school_id`, `classadviser_id`, `grade_level`, `schoolyear_id`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Everlasting', 11, 49, 'Kinder', 1, '0', '2023-12-14 02:33:19', '2023-12-14 02:33:19'),
(2, 'Mangga', 11, 64, '1', 1, '0', '2023-12-14 23:30:51', '2023-12-14 23:30:51'),
(3, 'Starling', 11, 79, '2', 1, '0', '2023-12-14 23:32:06', '2023-12-14 23:32:06'),
(4, 'Mustard', 11, 94, '3', 1, '0', '2023-12-14 23:41:02', '2023-12-14 23:41:02'),
(5, 'Beryl', 11, 109, '4', 1, '0', '2023-12-14 23:41:29', '2023-12-14 23:41:29'),
(6, 'Deligence', 11, 124, '5', 1, '0', '2023-12-14 23:42:04', '2023-12-14 23:42:04'),
(7, 'Einstein', 11, 139, '6', 1, '0', '2023-12-14 23:42:35', '2023-12-14 23:42:35');

-- --------------------------------------------------------

--
-- Table structure for table `cnsr_list`
--

CREATE TABLE `cnsr_list` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cnsr_code` varchar(255) DEFAULT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `school_nurse_id` bigint(20) UNSIGNED NOT NULL,
  `schoolyear_id` bigint(20) UNSIGNED NOT NULL,
  `no_of_pupils` int(11) DEFAULT NULL,
  `no_of_male_pupils` int(11) DEFAULT NULL,
  `no_of_female_pupils` int(11) DEFAULT NULL,
  `no_of_severely_stunted` int(11) DEFAULT NULL,
  `no_of_male_severely_stunted` int(11) DEFAULT NULL,
  `no_of_female_severely_stunted` int(11) DEFAULT NULL,
  `no_of_stunted` int(11) DEFAULT NULL,
  `no_of_male_stunted` int(11) DEFAULT NULL,
  `no_of_female_stunted` int(11) DEFAULT NULL,
  `no_of_height_normal` int(11) DEFAULT NULL,
  `no_of_male_height_normal` int(11) DEFAULT NULL,
  `no_of_female_height_normal` int(11) DEFAULT NULL,
  `no_of_tall` int(11) DEFAULT NULL,
  `no_of_male_tall` int(11) DEFAULT NULL,
  `no_of_female_tall` int(11) DEFAULT NULL,
  `no_of_stunted_pupils` int(11) DEFAULT NULL,
  `no_of_male_stunted_pupils` int(11) DEFAULT NULL,
  `no_of_female_stunted_pupils` int(11) DEFAULT NULL,
  `no_of_severely_wasted` int(11) DEFAULT NULL,
  `no_of_male_severely_wasted` int(11) DEFAULT NULL,
  `no_of_female_severely_wasted` int(11) DEFAULT NULL,
  `no_of_wasted` int(11) DEFAULT NULL,
  `no_of_male_wasted` int(11) DEFAULT NULL,
  `no_of_female_wasted` int(11) DEFAULT NULL,
  `no_of_weight_normal` int(11) DEFAULT NULL,
  `no_of_male_weight_normal` int(11) DEFAULT NULL,
  `no_of_female_weight_normal` int(11) DEFAULT NULL,
  `no_of_overweight` int(11) DEFAULT NULL,
  `no_of_male_overweight` int(11) DEFAULT NULL,
  `no_of_female_overweight` int(11) DEFAULT NULL,
  `no_of_obese` int(11) DEFAULT NULL,
  `no_of_male_obese` int(11) DEFAULT NULL,
  `no_of_female_obese` int(11) DEFAULT NULL,
  `no_of_malnourished_pupils` int(11) DEFAULT NULL,
  `no_of_male_malnourished_pupils` int(11) DEFAULT NULL,
  `no_of_female_malnourished_pupils` int(11) DEFAULT NULL,
  `is_approved` enum('0','1') NOT NULL,
  `approved_date` date DEFAULT NULL,
  `is_deleted` enum('0','1') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cnsr_list`
--

INSERT INTO `cnsr_list` (`id`, `cnsr_code`, `school_id`, `school_nurse_id`, `schoolyear_id`, `no_of_pupils`, `no_of_male_pupils`, `no_of_female_pupils`, `no_of_severely_stunted`, `no_of_male_severely_stunted`, `no_of_female_severely_stunted`, `no_of_stunted`, `no_of_male_stunted`, `no_of_female_stunted`, `no_of_height_normal`, `no_of_male_height_normal`, `no_of_female_height_normal`, `no_of_tall`, `no_of_male_tall`, `no_of_female_tall`, `no_of_stunted_pupils`, `no_of_male_stunted_pupils`, `no_of_female_stunted_pupils`, `no_of_severely_wasted`, `no_of_male_severely_wasted`, `no_of_female_severely_wasted`, `no_of_wasted`, `no_of_male_wasted`, `no_of_female_wasted`, `no_of_weight_normal`, `no_of_male_weight_normal`, `no_of_female_weight_normal`, `no_of_overweight`, `no_of_male_overweight`, `no_of_female_overweight`, `no_of_obese`, `no_of_male_obese`, `no_of_female_obese`, `no_of_malnourished_pupils`, `no_of_male_malnourished_pupils`, `no_of_female_malnourished_pupils`, `is_approved`, `approved_date`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, '37-1-11', 11, 37, 1, 16, 9, 7, 0, 0, 0, 0, 0, 0, 16, 9, 7, 0, 0, 0, 0, 0, 0, 14, 7, 7, 1, 1, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 15, 8, 7, '0', NULL, '0', '2023-12-15 03:53:31', '2023-12-26 15:17:10');

-- --------------------------------------------------------

--
-- Table structure for table `districts_table`
--

CREATE TABLE `districts_table` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `district` varchar(50) NOT NULL,
  `medical_officer_id` bigint(20) UNSIGNED NOT NULL,
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `districts_table`
--

INSERT INTO `districts_table` (`id`, `district`, `medical_officer_id`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Tiwi', 2, '0', '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(2, 'Malilipot', 3, '0', '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(3, 'Malinao', 4, '0', '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(4, 'Sto. Domingo', 5, '0', '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(5, 'Bacacay East', 6, '0', '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(6, 'Bacacay West', 7, '0', '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(7, 'Bacacay South', 8, '0', '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(8, 'Daraga North', 9, '0', '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(9, 'Daraga South', 10, '0', '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(10, 'Manito', 11, '0', '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(11, 'Camalig North', 12, '0', '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(12, 'Camalig South', 13, '0', '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(13, 'Rapu-Rapu East', 14, '0', '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(14, 'Rapu-Rapu West', 15, '0', '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(15, 'Jovellar', 16, '0', '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(16, 'Guinobatan West', 17, '0', '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(17, 'Guinobatan East', 18, '0', '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(18, 'Oas North', 19, '0', '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(19, 'Oas South', 20, '0', '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(20, 'Polangui North', 21, '0', '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(21, 'Polangui South', 22, '0', '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(22, 'Libon West', 23, '0', '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(23, 'Libon East', 24, '0', '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(24, 'Pioduran West', 25, '0', '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(25, 'Pioduran East', 26, '0', '2023-12-13 23:16:15', '2023-12-13 23:16:15');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hfa_standards`
--

CREATE TABLE `hfa_standards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `age` int(11) NOT NULL,
  `sex` enum('Male','Female') NOT NULL,
  `negative_thirdSD` decimal(5,2) NOT NULL,
  `negative_secondSD` decimal(5,2) NOT NULL,
  `negative_firstSD` decimal(5,2) NOT NULL,
  `median` decimal(5,2) NOT NULL,
  `firstSD` decimal(5,2) NOT NULL,
  `secondSD` decimal(5,2) NOT NULL,
  `thirdSD` decimal(5,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hfa_standards`
--

INSERT INTO `hfa_standards` (`id`, `age`, `sex`, `negative_thirdSD`, `negative_secondSD`, `negative_firstSD`, `median`, `firstSD`, `secondSD`, `thirdSD`, `created_at`, `updated_at`) VALUES
(1, 5, 'Female', 97.00, 101.90, 106.80, 111.70, 116.60, 121.50, 126.40, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(2, 6, 'Female', 101.70, 107.00, 112.20, 117.50, 122.80, 128.00, 133.30, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(3, 7, 'Female', 106.40, 112.00, 117.60, 123.20, 128.80, 134.40, 140.00, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(4, 8, 'Female', 111.20, 117.10, 123.10, 129.00, 134.90, 140.90, 146.80, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(5, 9, 'Female', 116.30, 122.60, 128.80, 135.00, 141.30, 147.50, 153.70, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(6, 10, 'Female', 121.70, 128.20, 134.80, 141.30, 147.80, 154.30, 160.80, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(7, 11, 'Female', 127.40, 134.20, 140.90, 147.70, 154.40, 161.10, 167.90, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(8, 12, 'Female', 132.90, 139.80, 146.70, 153.60, 160.50, 167.40, 174.30, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(9, 13, 'Female', 137.20, 144.10, 151.10, 158.00, 165.00, 171.90, 178.90, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(10, 14, 'Female', 140.00, 146.90, 153.80, 160.70, 167.70, 174.60, 181.50, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(11, 15, 'Female', 141.60, 148.40, 155.30, 162.10, 169.00, 175.80, 182.60, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(12, 16, 'Female', 142.40, 149.20, 155.90, 162.70, 169.40, 176.20, 182.90, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(13, 17, 'Female', 143.00, 149.60, 156.30, 162.90, 169.60, 176.30, 182.90, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(14, 18, 'Female', 143.40, 150.00, 156.50, 163.10, 169.70, 176.30, 182.90, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(15, 19, 'Female', 143.50, 150.10, 156.60, 163.20, 169.70, 176.20, 182.80, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(16, 5, 'Male', 98.20, 103.00, 107.70, 112.40, 117.10, 121.80, 126.50, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(17, 6, 'Male', 103.20, 108.20, 113.30, 118.40, 123.50, 128.50, 133.60, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(18, 7, 'Male', 107.80, 113.20, 118.60, 124.10, 129.50, 134.90, 140.40, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(19, 8, 'Male', 112.10, 117.90, 123.70, 129.50, 135.30, 141.10, 146.90, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(20, 9, 'Male', 116.30, 122.40, 128.60, 134.70, 140.90, 147.10, 153.20, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(21, 10, 'Male', 120.40, 126.90, 133.40, 140.00, 146.50, 153.00, 159.50, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(22, 11, 'Male', 124.90, 131.70, 138.60, 145.50, 152.40, 159.30, 166.10, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(23, 12, 'Male', 130.20, 137.40, 144.60, 151.90, 159.10, 166.30, 173.60, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(24, 13, 'Male', 136.40, 144.00, 151.50, 159.10, 166.60, 174.20, 181.80, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(25, 14, 'Male', 142.50, 150.30, 158.10, 165.80, 173.60, 181.30, 189.10, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(26, 15, 'Male', 147.40, 155.20, 163.00, 170.80, 178.60, 186.40, 194.20, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(27, 16, 'Male', 150.90, 158.60, 166.30, 174.00, 181.80, 189.50, 197.20, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(28, 17, 'Male', 153.00, 160.50, 168.10, 175.70, 183.30, 190.80, 198.40, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(29, 18, 'Male', 154.20, 161.60, 169.00, 176.40, 183.80, 191.10, 198.50, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(30, 19, 'Male', 154.60, 161.90, 169.20, 176.50, 183.80, 191.10, 198.40, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(31, 5, 'Female', 97.00, 101.90, 106.80, 111.70, 116.60, 121.50, 126.40, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(32, 6, 'Female', 101.70, 107.00, 112.20, 117.50, 122.80, 128.00, 133.30, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(33, 7, 'Female', 106.40, 112.00, 117.60, 123.20, 128.80, 134.40, 140.00, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(34, 8, 'Female', 111.20, 117.10, 123.10, 129.00, 134.90, 140.90, 146.80, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(35, 9, 'Female', 116.30, 122.60, 128.80, 135.00, 141.30, 147.50, 153.70, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(36, 10, 'Female', 121.70, 128.20, 134.80, 141.30, 147.80, 154.30, 160.80, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(37, 11, 'Female', 127.40, 134.20, 140.90, 147.70, 154.40, 161.10, 167.90, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(38, 12, 'Female', 132.90, 139.80, 146.70, 153.60, 160.50, 167.40, 174.30, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(39, 13, 'Female', 137.20, 144.10, 151.10, 158.00, 165.00, 171.90, 178.90, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(40, 14, 'Female', 140.00, 146.90, 153.80, 160.70, 167.70, 174.60, 181.50, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(41, 15, 'Female', 141.60, 148.40, 155.30, 162.10, 169.00, 175.80, 182.60, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(42, 16, 'Female', 142.40, 149.20, 155.90, 162.70, 169.40, 176.20, 182.90, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(43, 17, 'Female', 143.00, 149.60, 156.30, 162.90, 169.60, 176.30, 182.90, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(44, 18, 'Female', 143.40, 150.00, 156.50, 163.10, 169.70, 176.30, 182.90, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(45, 19, 'Female', 143.50, 150.10, 156.60, 163.20, 169.70, 176.20, 182.80, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(46, 5, 'Male', 98.20, 103.00, 107.70, 112.40, 117.10, 121.80, 126.50, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(47, 6, 'Male', 103.20, 108.20, 113.30, 118.40, 123.50, 128.50, 133.60, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(48, 7, 'Male', 107.80, 113.20, 118.60, 124.10, 129.50, 134.90, 140.40, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(49, 8, 'Male', 112.10, 117.90, 123.70, 129.50, 135.30, 141.10, 146.90, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(50, 9, 'Male', 116.30, 122.40, 128.60, 134.70, 140.90, 147.10, 153.20, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(51, 10, 'Male', 120.40, 126.90, 133.40, 140.00, 146.50, 153.00, 159.50, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(52, 11, 'Male', 124.90, 131.70, 138.60, 145.50, 152.40, 159.30, 166.10, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(53, 12, 'Male', 130.20, 137.40, 144.60, 151.90, 159.10, 166.30, 173.60, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(54, 13, 'Male', 136.40, 144.00, 151.50, 159.10, 166.60, 174.20, 181.80, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(55, 14, 'Male', 142.50, 150.30, 158.10, 165.80, 173.60, 181.30, 189.10, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(56, 15, 'Male', 147.40, 155.20, 163.00, 170.80, 178.60, 186.40, 194.20, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(57, 16, 'Male', 150.90, 158.60, 166.30, 174.00, 181.80, 189.50, 197.20, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(58, 17, 'Male', 153.00, 160.50, 168.10, 175.70, 183.30, 190.80, 198.40, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(59, 18, 'Male', 154.20, 161.60, 169.00, 176.40, 183.80, 191.10, 198.50, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(60, 19, 'Male', 154.60, 161.90, 169.20, 176.50, 183.80, 191.10, 198.40, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(61, 5, 'Female', 97.00, 101.90, 106.80, 111.70, 116.60, 121.50, 126.40, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(62, 6, 'Female', 101.70, 107.00, 112.20, 117.50, 122.80, 128.00, 133.30, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(63, 7, 'Female', 106.40, 112.00, 117.60, 123.20, 128.80, 134.40, 140.00, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(64, 8, 'Female', 111.20, 117.10, 123.10, 129.00, 134.90, 140.90, 146.80, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(65, 9, 'Female', 116.30, 122.60, 128.80, 135.00, 141.30, 147.50, 153.70, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(66, 10, 'Female', 121.70, 128.20, 134.80, 141.30, 147.80, 154.30, 160.80, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(67, 11, 'Female', 127.40, 134.20, 140.90, 147.70, 154.40, 161.10, 167.90, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(68, 12, 'Female', 132.90, 139.80, 146.70, 153.60, 160.50, 167.40, 174.30, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(69, 13, 'Female', 137.20, 144.10, 151.10, 158.00, 165.00, 171.90, 178.90, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(70, 14, 'Female', 140.00, 146.90, 153.80, 160.70, 167.70, 174.60, 181.50, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(71, 15, 'Female', 141.60, 148.40, 155.30, 162.10, 169.00, 175.80, 182.60, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(72, 16, 'Female', 142.40, 149.20, 155.90, 162.70, 169.40, 176.20, 182.90, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(73, 17, 'Female', 143.00, 149.60, 156.30, 162.90, 169.60, 176.30, 182.90, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(74, 18, 'Female', 143.40, 150.00, 156.50, 163.10, 169.70, 176.30, 182.90, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(75, 19, 'Female', 143.50, 150.10, 156.60, 163.20, 169.70, 176.20, 182.80, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(76, 5, 'Male', 98.20, 103.00, 107.70, 112.40, 117.10, 121.80, 126.50, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(77, 6, 'Male', 103.20, 108.20, 113.30, 118.40, 123.50, 128.50, 133.60, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(78, 7, 'Male', 107.80, 113.20, 118.60, 124.10, 129.50, 134.90, 140.40, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(79, 8, 'Male', 112.10, 117.90, 123.70, 129.50, 135.30, 141.10, 146.90, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(80, 9, 'Male', 116.30, 122.40, 128.60, 134.70, 140.90, 147.10, 153.20, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(81, 10, 'Male', 120.40, 126.90, 133.40, 140.00, 146.50, 153.00, 159.50, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(82, 11, 'Male', 124.90, 131.70, 138.60, 145.50, 152.40, 159.30, 166.10, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(83, 12, 'Male', 130.20, 137.40, 144.60, 151.90, 159.10, 166.30, 173.60, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(84, 13, 'Male', 136.40, 144.00, 151.50, 159.10, 166.60, 174.20, 181.80, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(85, 14, 'Male', 142.50, 150.30, 158.10, 165.80, 173.60, 181.30, 189.10, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(86, 15, 'Male', 147.40, 155.20, 163.00, 170.80, 178.60, 186.40, 194.20, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(87, 16, 'Male', 150.90, 158.60, 166.30, 174.00, 181.80, 189.50, 197.20, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(88, 17, 'Male', 153.00, 160.50, 168.10, 175.70, 183.30, 190.80, 198.40, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(89, 18, 'Male', 154.20, 161.60, 169.00, 176.40, 183.80, 191.10, 198.50, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(90, 19, 'Male', 154.60, 161.90, 169.20, 176.50, 183.80, 191.10, 198.40, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(91, 5, 'Female', 97.00, 101.90, 106.80, 111.70, 116.60, 121.50, 126.40, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(92, 6, 'Female', 101.70, 107.00, 112.20, 117.50, 122.80, 128.00, 133.30, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(93, 7, 'Female', 106.40, 112.00, 117.60, 123.20, 128.80, 134.40, 140.00, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(94, 8, 'Female', 111.20, 117.10, 123.10, 129.00, 134.90, 140.90, 146.80, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(95, 9, 'Female', 116.30, 122.60, 128.80, 135.00, 141.30, 147.50, 153.70, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(96, 10, 'Female', 121.70, 128.20, 134.80, 141.30, 147.80, 154.30, 160.80, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(97, 11, 'Female', 127.40, 134.20, 140.90, 147.70, 154.40, 161.10, 167.90, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(98, 12, 'Female', 132.90, 139.80, 146.70, 153.60, 160.50, 167.40, 174.30, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(99, 13, 'Female', 137.20, 144.10, 151.10, 158.00, 165.00, 171.90, 178.90, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(100, 14, 'Female', 140.00, 146.90, 153.80, 160.70, 167.70, 174.60, 181.50, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(101, 15, 'Female', 141.60, 148.40, 155.30, 162.10, 169.00, 175.80, 182.60, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(102, 16, 'Female', 142.40, 149.20, 155.90, 162.70, 169.40, 176.20, 182.90, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(103, 17, 'Female', 143.00, 149.60, 156.30, 162.90, 169.60, 176.30, 182.90, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(104, 18, 'Female', 143.40, 150.00, 156.50, 163.10, 169.70, 176.30, 182.90, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(105, 19, 'Female', 143.50, 150.10, 156.60, 163.20, 169.70, 176.20, 182.80, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(106, 5, 'Male', 98.20, 103.00, 107.70, 112.40, 117.10, 121.80, 126.50, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(107, 6, 'Male', 103.20, 108.20, 113.30, 118.40, 123.50, 128.50, 133.60, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(108, 7, 'Male', 107.80, 113.20, 118.60, 124.10, 129.50, 134.90, 140.40, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(109, 8, 'Male', 112.10, 117.90, 123.70, 129.50, 135.30, 141.10, 146.90, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(110, 9, 'Male', 116.30, 122.40, 128.60, 134.70, 140.90, 147.10, 153.20, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(111, 10, 'Male', 120.40, 126.90, 133.40, 140.00, 146.50, 153.00, 159.50, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(112, 11, 'Male', 124.90, 131.70, 138.60, 145.50, 152.40, 159.30, 166.10, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(113, 12, 'Male', 130.20, 137.40, 144.60, 151.90, 159.10, 166.30, 173.60, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(114, 13, 'Male', 136.40, 144.00, 151.50, 159.10, 166.60, 174.20, 181.80, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(115, 14, 'Male', 142.50, 150.30, 158.10, 165.80, 173.60, 181.30, 189.10, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(116, 15, 'Male', 147.40, 155.20, 163.00, 170.80, 178.60, 186.40, 194.20, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(117, 16, 'Male', 150.90, 158.60, 166.30, 174.00, 181.80, 189.50, 197.20, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(118, 17, 'Male', 153.00, 160.50, 168.10, 175.70, 183.30, 190.80, 198.40, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(119, 18, 'Male', 154.20, 161.60, 169.00, 176.40, 183.80, 191.10, 198.50, '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(120, 19, 'Male', 154.60, 161.90, 169.20, 176.50, 183.80, 191.10, 198.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(121, 5, 'Female', 97.00, 101.90, 106.80, 111.70, 116.60, 121.50, 126.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(122, 6, 'Female', 101.70, 107.00, 112.20, 117.50, 122.80, 128.00, 133.30, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(123, 7, 'Female', 106.40, 112.00, 117.60, 123.20, 128.80, 134.40, 140.00, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(124, 8, 'Female', 111.20, 117.10, 123.10, 129.00, 134.90, 140.90, 146.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(125, 9, 'Female', 116.30, 122.60, 128.80, 135.00, 141.30, 147.50, 153.70, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(126, 10, 'Female', 121.70, 128.20, 134.80, 141.30, 147.80, 154.30, 160.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(127, 11, 'Female', 127.40, 134.20, 140.90, 147.70, 154.40, 161.10, 167.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(128, 12, 'Female', 132.90, 139.80, 146.70, 153.60, 160.50, 167.40, 174.30, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(129, 13, 'Female', 137.20, 144.10, 151.10, 158.00, 165.00, 171.90, 178.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(130, 14, 'Female', 140.00, 146.90, 153.80, 160.70, 167.70, 174.60, 181.50, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(131, 15, 'Female', 141.60, 148.40, 155.30, 162.10, 169.00, 175.80, 182.60, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(132, 16, 'Female', 142.40, 149.20, 155.90, 162.70, 169.40, 176.20, 182.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(133, 17, 'Female', 143.00, 149.60, 156.30, 162.90, 169.60, 176.30, 182.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(134, 18, 'Female', 143.40, 150.00, 156.50, 163.10, 169.70, 176.30, 182.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(135, 19, 'Female', 143.50, 150.10, 156.60, 163.20, 169.70, 176.20, 182.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(136, 5, 'Male', 98.20, 103.00, 107.70, 112.40, 117.10, 121.80, 126.50, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(137, 6, 'Male', 103.20, 108.20, 113.30, 118.40, 123.50, 128.50, 133.60, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(138, 7, 'Male', 107.80, 113.20, 118.60, 124.10, 129.50, 134.90, 140.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(139, 8, 'Male', 112.10, 117.90, 123.70, 129.50, 135.30, 141.10, 146.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(140, 9, 'Male', 116.30, 122.40, 128.60, 134.70, 140.90, 147.10, 153.20, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(141, 10, 'Male', 120.40, 126.90, 133.40, 140.00, 146.50, 153.00, 159.50, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(142, 11, 'Male', 124.90, 131.70, 138.60, 145.50, 152.40, 159.30, 166.10, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(143, 12, 'Male', 130.20, 137.40, 144.60, 151.90, 159.10, 166.30, 173.60, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(144, 13, 'Male', 136.40, 144.00, 151.50, 159.10, 166.60, 174.20, 181.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(145, 14, 'Male', 142.50, 150.30, 158.10, 165.80, 173.60, 181.30, 189.10, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(146, 15, 'Male', 147.40, 155.20, 163.00, 170.80, 178.60, 186.40, 194.20, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(147, 16, 'Male', 150.90, 158.60, 166.30, 174.00, 181.80, 189.50, 197.20, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(148, 17, 'Male', 153.00, 160.50, 168.10, 175.70, 183.30, 190.80, 198.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(149, 18, 'Male', 154.20, 161.60, 169.00, 176.40, 183.80, 191.10, 198.50, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(150, 19, 'Male', 154.60, 161.90, 169.20, 176.50, 183.80, 191.10, 198.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(151, 5, 'Female', 97.00, 101.90, 106.80, 111.70, 116.60, 121.50, 126.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(152, 6, 'Female', 101.70, 107.00, 112.20, 117.50, 122.80, 128.00, 133.30, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(153, 7, 'Female', 106.40, 112.00, 117.60, 123.20, 128.80, 134.40, 140.00, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(154, 8, 'Female', 111.20, 117.10, 123.10, 129.00, 134.90, 140.90, 146.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(155, 9, 'Female', 116.30, 122.60, 128.80, 135.00, 141.30, 147.50, 153.70, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(156, 10, 'Female', 121.70, 128.20, 134.80, 141.30, 147.80, 154.30, 160.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(157, 11, 'Female', 127.40, 134.20, 140.90, 147.70, 154.40, 161.10, 167.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(158, 12, 'Female', 132.90, 139.80, 146.70, 153.60, 160.50, 167.40, 174.30, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(159, 13, 'Female', 137.20, 144.10, 151.10, 158.00, 165.00, 171.90, 178.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(160, 14, 'Female', 140.00, 146.90, 153.80, 160.70, 167.70, 174.60, 181.50, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(161, 15, 'Female', 141.60, 148.40, 155.30, 162.10, 169.00, 175.80, 182.60, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(162, 16, 'Female', 142.40, 149.20, 155.90, 162.70, 169.40, 176.20, 182.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(163, 17, 'Female', 143.00, 149.60, 156.30, 162.90, 169.60, 176.30, 182.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(164, 18, 'Female', 143.40, 150.00, 156.50, 163.10, 169.70, 176.30, 182.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(165, 19, 'Female', 143.50, 150.10, 156.60, 163.20, 169.70, 176.20, 182.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(166, 5, 'Male', 98.20, 103.00, 107.70, 112.40, 117.10, 121.80, 126.50, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(167, 6, 'Male', 103.20, 108.20, 113.30, 118.40, 123.50, 128.50, 133.60, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(168, 7, 'Male', 107.80, 113.20, 118.60, 124.10, 129.50, 134.90, 140.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(169, 8, 'Male', 112.10, 117.90, 123.70, 129.50, 135.30, 141.10, 146.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(170, 9, 'Male', 116.30, 122.40, 128.60, 134.70, 140.90, 147.10, 153.20, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(171, 10, 'Male', 120.40, 126.90, 133.40, 140.00, 146.50, 153.00, 159.50, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(172, 11, 'Male', 124.90, 131.70, 138.60, 145.50, 152.40, 159.30, 166.10, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(173, 12, 'Male', 130.20, 137.40, 144.60, 151.90, 159.10, 166.30, 173.60, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(174, 13, 'Male', 136.40, 144.00, 151.50, 159.10, 166.60, 174.20, 181.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(175, 14, 'Male', 142.50, 150.30, 158.10, 165.80, 173.60, 181.30, 189.10, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(176, 15, 'Male', 147.40, 155.20, 163.00, 170.80, 178.60, 186.40, 194.20, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(177, 16, 'Male', 150.90, 158.60, 166.30, 174.00, 181.80, 189.50, 197.20, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(178, 17, 'Male', 153.00, 160.50, 168.10, 175.70, 183.30, 190.80, 198.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(179, 18, 'Male', 154.20, 161.60, 169.00, 176.40, 183.80, 191.10, 198.50, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(180, 19, 'Male', 154.60, 161.90, 169.20, 176.50, 183.80, 191.10, 198.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(181, 5, 'Female', 97.00, 101.90, 106.80, 111.70, 116.60, 121.50, 126.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(182, 6, 'Female', 101.70, 107.00, 112.20, 117.50, 122.80, 128.00, 133.30, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(183, 7, 'Female', 106.40, 112.00, 117.60, 123.20, 128.80, 134.40, 140.00, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(184, 8, 'Female', 111.20, 117.10, 123.10, 129.00, 134.90, 140.90, 146.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(185, 9, 'Female', 116.30, 122.60, 128.80, 135.00, 141.30, 147.50, 153.70, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(186, 10, 'Female', 121.70, 128.20, 134.80, 141.30, 147.80, 154.30, 160.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(187, 11, 'Female', 127.40, 134.20, 140.90, 147.70, 154.40, 161.10, 167.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(188, 12, 'Female', 132.90, 139.80, 146.70, 153.60, 160.50, 167.40, 174.30, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(189, 13, 'Female', 137.20, 144.10, 151.10, 158.00, 165.00, 171.90, 178.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(190, 14, 'Female', 140.00, 146.90, 153.80, 160.70, 167.70, 174.60, 181.50, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(191, 15, 'Female', 141.60, 148.40, 155.30, 162.10, 169.00, 175.80, 182.60, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(192, 16, 'Female', 142.40, 149.20, 155.90, 162.70, 169.40, 176.20, 182.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(193, 17, 'Female', 143.00, 149.60, 156.30, 162.90, 169.60, 176.30, 182.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(194, 18, 'Female', 143.40, 150.00, 156.50, 163.10, 169.70, 176.30, 182.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(195, 19, 'Female', 143.50, 150.10, 156.60, 163.20, 169.70, 176.20, 182.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(196, 5, 'Male', 98.20, 103.00, 107.70, 112.40, 117.10, 121.80, 126.50, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(197, 6, 'Male', 103.20, 108.20, 113.30, 118.40, 123.50, 128.50, 133.60, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(198, 7, 'Male', 107.80, 113.20, 118.60, 124.10, 129.50, 134.90, 140.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(199, 8, 'Male', 112.10, 117.90, 123.70, 129.50, 135.30, 141.10, 146.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(200, 9, 'Male', 116.30, 122.40, 128.60, 134.70, 140.90, 147.10, 153.20, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(201, 10, 'Male', 120.40, 126.90, 133.40, 140.00, 146.50, 153.00, 159.50, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(202, 11, 'Male', 124.90, 131.70, 138.60, 145.50, 152.40, 159.30, 166.10, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(203, 12, 'Male', 130.20, 137.40, 144.60, 151.90, 159.10, 166.30, 173.60, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(204, 13, 'Male', 136.40, 144.00, 151.50, 159.10, 166.60, 174.20, 181.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(205, 14, 'Male', 142.50, 150.30, 158.10, 165.80, 173.60, 181.30, 189.10, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(206, 15, 'Male', 147.40, 155.20, 163.00, 170.80, 178.60, 186.40, 194.20, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(207, 16, 'Male', 150.90, 158.60, 166.30, 174.00, 181.80, 189.50, 197.20, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(208, 17, 'Male', 153.00, 160.50, 168.10, 175.70, 183.30, 190.80, 198.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(209, 18, 'Male', 154.20, 161.60, 169.00, 176.40, 183.80, 191.10, 198.50, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(210, 19, 'Male', 154.60, 161.90, 169.20, 176.50, 183.80, 191.10, 198.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(211, 5, 'Female', 97.00, 101.90, 106.80, 111.70, 116.60, 121.50, 126.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(212, 6, 'Female', 101.70, 107.00, 112.20, 117.50, 122.80, 128.00, 133.30, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(213, 7, 'Female', 106.40, 112.00, 117.60, 123.20, 128.80, 134.40, 140.00, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(214, 8, 'Female', 111.20, 117.10, 123.10, 129.00, 134.90, 140.90, 146.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(215, 9, 'Female', 116.30, 122.60, 128.80, 135.00, 141.30, 147.50, 153.70, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(216, 10, 'Female', 121.70, 128.20, 134.80, 141.30, 147.80, 154.30, 160.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(217, 11, 'Female', 127.40, 134.20, 140.90, 147.70, 154.40, 161.10, 167.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(218, 12, 'Female', 132.90, 139.80, 146.70, 153.60, 160.50, 167.40, 174.30, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(219, 13, 'Female', 137.20, 144.10, 151.10, 158.00, 165.00, 171.90, 178.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(220, 14, 'Female', 140.00, 146.90, 153.80, 160.70, 167.70, 174.60, 181.50, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(221, 15, 'Female', 141.60, 148.40, 155.30, 162.10, 169.00, 175.80, 182.60, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(222, 16, 'Female', 142.40, 149.20, 155.90, 162.70, 169.40, 176.20, 182.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(223, 17, 'Female', 143.00, 149.60, 156.30, 162.90, 169.60, 176.30, 182.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(224, 18, 'Female', 143.40, 150.00, 156.50, 163.10, 169.70, 176.30, 182.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(225, 19, 'Female', 143.50, 150.10, 156.60, 163.20, 169.70, 176.20, 182.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(226, 5, 'Male', 98.20, 103.00, 107.70, 112.40, 117.10, 121.80, 126.50, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(227, 6, 'Male', 103.20, 108.20, 113.30, 118.40, 123.50, 128.50, 133.60, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(228, 7, 'Male', 107.80, 113.20, 118.60, 124.10, 129.50, 134.90, 140.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(229, 8, 'Male', 112.10, 117.90, 123.70, 129.50, 135.30, 141.10, 146.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(230, 9, 'Male', 116.30, 122.40, 128.60, 134.70, 140.90, 147.10, 153.20, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(231, 10, 'Male', 120.40, 126.90, 133.40, 140.00, 146.50, 153.00, 159.50, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(232, 11, 'Male', 124.90, 131.70, 138.60, 145.50, 152.40, 159.30, 166.10, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(233, 12, 'Male', 130.20, 137.40, 144.60, 151.90, 159.10, 166.30, 173.60, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(234, 13, 'Male', 136.40, 144.00, 151.50, 159.10, 166.60, 174.20, 181.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(235, 14, 'Male', 142.50, 150.30, 158.10, 165.80, 173.60, 181.30, 189.10, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(236, 15, 'Male', 147.40, 155.20, 163.00, 170.80, 178.60, 186.40, 194.20, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(237, 16, 'Male', 150.90, 158.60, 166.30, 174.00, 181.80, 189.50, 197.20, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(238, 17, 'Male', 153.00, 160.50, 168.10, 175.70, 183.30, 190.80, 198.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(239, 18, 'Male', 154.20, 161.60, 169.00, 176.40, 183.80, 191.10, 198.50, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(240, 19, 'Male', 154.60, 161.90, 169.20, 176.50, 183.80, 191.10, 198.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(241, 5, 'Female', 97.00, 101.90, 106.80, 111.70, 116.60, 121.50, 126.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(242, 6, 'Female', 101.70, 107.00, 112.20, 117.50, 122.80, 128.00, 133.30, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(243, 7, 'Female', 106.40, 112.00, 117.60, 123.20, 128.80, 134.40, 140.00, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(244, 8, 'Female', 111.20, 117.10, 123.10, 129.00, 134.90, 140.90, 146.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(245, 9, 'Female', 116.30, 122.60, 128.80, 135.00, 141.30, 147.50, 153.70, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(246, 10, 'Female', 121.70, 128.20, 134.80, 141.30, 147.80, 154.30, 160.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(247, 11, 'Female', 127.40, 134.20, 140.90, 147.70, 154.40, 161.10, 167.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(248, 12, 'Female', 132.90, 139.80, 146.70, 153.60, 160.50, 167.40, 174.30, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(249, 13, 'Female', 137.20, 144.10, 151.10, 158.00, 165.00, 171.90, 178.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(250, 14, 'Female', 140.00, 146.90, 153.80, 160.70, 167.70, 174.60, 181.50, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(251, 15, 'Female', 141.60, 148.40, 155.30, 162.10, 169.00, 175.80, 182.60, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(252, 16, 'Female', 142.40, 149.20, 155.90, 162.70, 169.40, 176.20, 182.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(253, 17, 'Female', 143.00, 149.60, 156.30, 162.90, 169.60, 176.30, 182.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(254, 18, 'Female', 143.40, 150.00, 156.50, 163.10, 169.70, 176.30, 182.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(255, 19, 'Female', 143.50, 150.10, 156.60, 163.20, 169.70, 176.20, 182.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(256, 5, 'Male', 98.20, 103.00, 107.70, 112.40, 117.10, 121.80, 126.50, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(257, 6, 'Male', 103.20, 108.20, 113.30, 118.40, 123.50, 128.50, 133.60, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(258, 7, 'Male', 107.80, 113.20, 118.60, 124.10, 129.50, 134.90, 140.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(259, 8, 'Male', 112.10, 117.90, 123.70, 129.50, 135.30, 141.10, 146.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(260, 9, 'Male', 116.30, 122.40, 128.60, 134.70, 140.90, 147.10, 153.20, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(261, 10, 'Male', 120.40, 126.90, 133.40, 140.00, 146.50, 153.00, 159.50, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(262, 11, 'Male', 124.90, 131.70, 138.60, 145.50, 152.40, 159.30, 166.10, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(263, 12, 'Male', 130.20, 137.40, 144.60, 151.90, 159.10, 166.30, 173.60, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(264, 13, 'Male', 136.40, 144.00, 151.50, 159.10, 166.60, 174.20, 181.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(265, 14, 'Male', 142.50, 150.30, 158.10, 165.80, 173.60, 181.30, 189.10, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(266, 15, 'Male', 147.40, 155.20, 163.00, 170.80, 178.60, 186.40, 194.20, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(267, 16, 'Male', 150.90, 158.60, 166.30, 174.00, 181.80, 189.50, 197.20, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(268, 17, 'Male', 153.00, 160.50, 168.10, 175.70, 183.30, 190.80, 198.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(269, 18, 'Male', 154.20, 161.60, 169.00, 176.40, 183.80, 191.10, 198.50, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(270, 19, 'Male', 154.60, 161.90, 169.20, 176.50, 183.80, 191.10, 198.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(271, 5, 'Female', 97.00, 101.90, 106.80, 111.70, 116.60, 121.50, 126.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(272, 6, 'Female', 101.70, 107.00, 112.20, 117.50, 122.80, 128.00, 133.30, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(273, 7, 'Female', 106.40, 112.00, 117.60, 123.20, 128.80, 134.40, 140.00, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(274, 8, 'Female', 111.20, 117.10, 123.10, 129.00, 134.90, 140.90, 146.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(275, 9, 'Female', 116.30, 122.60, 128.80, 135.00, 141.30, 147.50, 153.70, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(276, 10, 'Female', 121.70, 128.20, 134.80, 141.30, 147.80, 154.30, 160.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(277, 11, 'Female', 127.40, 134.20, 140.90, 147.70, 154.40, 161.10, 167.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(278, 12, 'Female', 132.90, 139.80, 146.70, 153.60, 160.50, 167.40, 174.30, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(279, 13, 'Female', 137.20, 144.10, 151.10, 158.00, 165.00, 171.90, 178.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(280, 14, 'Female', 140.00, 146.90, 153.80, 160.70, 167.70, 174.60, 181.50, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(281, 15, 'Female', 141.60, 148.40, 155.30, 162.10, 169.00, 175.80, 182.60, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(282, 16, 'Female', 142.40, 149.20, 155.90, 162.70, 169.40, 176.20, 182.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(283, 17, 'Female', 143.00, 149.60, 156.30, 162.90, 169.60, 176.30, 182.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(284, 18, 'Female', 143.40, 150.00, 156.50, 163.10, 169.70, 176.30, 182.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(285, 19, 'Female', 143.50, 150.10, 156.60, 163.20, 169.70, 176.20, 182.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(286, 5, 'Male', 98.20, 103.00, 107.70, 112.40, 117.10, 121.80, 126.50, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(287, 6, 'Male', 103.20, 108.20, 113.30, 118.40, 123.50, 128.50, 133.60, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(288, 7, 'Male', 107.80, 113.20, 118.60, 124.10, 129.50, 134.90, 140.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(289, 8, 'Male', 112.10, 117.90, 123.70, 129.50, 135.30, 141.10, 146.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(290, 9, 'Male', 116.30, 122.40, 128.60, 134.70, 140.90, 147.10, 153.20, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(291, 10, 'Male', 120.40, 126.90, 133.40, 140.00, 146.50, 153.00, 159.50, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(292, 11, 'Male', 124.90, 131.70, 138.60, 145.50, 152.40, 159.30, 166.10, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(293, 12, 'Male', 130.20, 137.40, 144.60, 151.90, 159.10, 166.30, 173.60, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(294, 13, 'Male', 136.40, 144.00, 151.50, 159.10, 166.60, 174.20, 181.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(295, 14, 'Male', 142.50, 150.30, 158.10, 165.80, 173.60, 181.30, 189.10, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(296, 15, 'Male', 147.40, 155.20, 163.00, 170.80, 178.60, 186.40, 194.20, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(297, 16, 'Male', 150.90, 158.60, 166.30, 174.00, 181.80, 189.50, 197.20, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(298, 17, 'Male', 153.00, 160.50, 168.10, 175.70, 183.30, 190.80, 198.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(299, 18, 'Male', 154.20, 161.60, 169.00, 176.40, 183.80, 191.10, 198.50, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(300, 19, 'Male', 154.60, 161.90, 169.20, 176.50, 183.80, 191.10, 198.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(301, 5, 'Female', 97.00, 101.90, 106.80, 111.70, 116.60, 121.50, 126.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(302, 6, 'Female', 101.70, 107.00, 112.20, 117.50, 122.80, 128.00, 133.30, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(303, 7, 'Female', 106.40, 112.00, 117.60, 123.20, 128.80, 134.40, 140.00, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(304, 8, 'Female', 111.20, 117.10, 123.10, 129.00, 134.90, 140.90, 146.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(305, 9, 'Female', 116.30, 122.60, 128.80, 135.00, 141.30, 147.50, 153.70, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(306, 10, 'Female', 121.70, 128.20, 134.80, 141.30, 147.80, 154.30, 160.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(307, 11, 'Female', 127.40, 134.20, 140.90, 147.70, 154.40, 161.10, 167.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(308, 12, 'Female', 132.90, 139.80, 146.70, 153.60, 160.50, 167.40, 174.30, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(309, 13, 'Female', 137.20, 144.10, 151.10, 158.00, 165.00, 171.90, 178.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(310, 14, 'Female', 140.00, 146.90, 153.80, 160.70, 167.70, 174.60, 181.50, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(311, 15, 'Female', 141.60, 148.40, 155.30, 162.10, 169.00, 175.80, 182.60, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(312, 16, 'Female', 142.40, 149.20, 155.90, 162.70, 169.40, 176.20, 182.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(313, 17, 'Female', 143.00, 149.60, 156.30, 162.90, 169.60, 176.30, 182.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(314, 18, 'Female', 143.40, 150.00, 156.50, 163.10, 169.70, 176.30, 182.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(315, 19, 'Female', 143.50, 150.10, 156.60, 163.20, 169.70, 176.20, 182.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(316, 5, 'Male', 98.20, 103.00, 107.70, 112.40, 117.10, 121.80, 126.50, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(317, 6, 'Male', 103.20, 108.20, 113.30, 118.40, 123.50, 128.50, 133.60, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(318, 7, 'Male', 107.80, 113.20, 118.60, 124.10, 129.50, 134.90, 140.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(319, 8, 'Male', 112.10, 117.90, 123.70, 129.50, 135.30, 141.10, 146.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(320, 9, 'Male', 116.30, 122.40, 128.60, 134.70, 140.90, 147.10, 153.20, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(321, 10, 'Male', 120.40, 126.90, 133.40, 140.00, 146.50, 153.00, 159.50, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(322, 11, 'Male', 124.90, 131.70, 138.60, 145.50, 152.40, 159.30, 166.10, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(323, 12, 'Male', 130.20, 137.40, 144.60, 151.90, 159.10, 166.30, 173.60, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(324, 13, 'Male', 136.40, 144.00, 151.50, 159.10, 166.60, 174.20, 181.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(325, 14, 'Male', 142.50, 150.30, 158.10, 165.80, 173.60, 181.30, 189.10, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(326, 15, 'Male', 147.40, 155.20, 163.00, 170.80, 178.60, 186.40, 194.20, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(327, 16, 'Male', 150.90, 158.60, 166.30, 174.00, 181.80, 189.50, 197.20, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(328, 17, 'Male', 153.00, 160.50, 168.10, 175.70, 183.30, 190.80, 198.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(329, 18, 'Male', 154.20, 161.60, 169.00, 176.40, 183.80, 191.10, 198.50, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(330, 19, 'Male', 154.60, 161.90, 169.20, 176.50, 183.80, 191.10, 198.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(331, 5, 'Female', 97.00, 101.90, 106.80, 111.70, 116.60, 121.50, 126.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(332, 6, 'Female', 101.70, 107.00, 112.20, 117.50, 122.80, 128.00, 133.30, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(333, 7, 'Female', 106.40, 112.00, 117.60, 123.20, 128.80, 134.40, 140.00, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(334, 8, 'Female', 111.20, 117.10, 123.10, 129.00, 134.90, 140.90, 146.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(335, 9, 'Female', 116.30, 122.60, 128.80, 135.00, 141.30, 147.50, 153.70, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(336, 10, 'Female', 121.70, 128.20, 134.80, 141.30, 147.80, 154.30, 160.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(337, 11, 'Female', 127.40, 134.20, 140.90, 147.70, 154.40, 161.10, 167.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(338, 12, 'Female', 132.90, 139.80, 146.70, 153.60, 160.50, 167.40, 174.30, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(339, 13, 'Female', 137.20, 144.10, 151.10, 158.00, 165.00, 171.90, 178.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(340, 14, 'Female', 140.00, 146.90, 153.80, 160.70, 167.70, 174.60, 181.50, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(341, 15, 'Female', 141.60, 148.40, 155.30, 162.10, 169.00, 175.80, 182.60, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(342, 16, 'Female', 142.40, 149.20, 155.90, 162.70, 169.40, 176.20, 182.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(343, 17, 'Female', 143.00, 149.60, 156.30, 162.90, 169.60, 176.30, 182.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(344, 18, 'Female', 143.40, 150.00, 156.50, 163.10, 169.70, 176.30, 182.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(345, 19, 'Female', 143.50, 150.10, 156.60, 163.20, 169.70, 176.20, 182.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(346, 5, 'Male', 98.20, 103.00, 107.70, 112.40, 117.10, 121.80, 126.50, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(347, 6, 'Male', 103.20, 108.20, 113.30, 118.40, 123.50, 128.50, 133.60, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(348, 7, 'Male', 107.80, 113.20, 118.60, 124.10, 129.50, 134.90, 140.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(349, 8, 'Male', 112.10, 117.90, 123.70, 129.50, 135.30, 141.10, 146.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(350, 9, 'Male', 116.30, 122.40, 128.60, 134.70, 140.90, 147.10, 153.20, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(351, 10, 'Male', 120.40, 126.90, 133.40, 140.00, 146.50, 153.00, 159.50, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(352, 11, 'Male', 124.90, 131.70, 138.60, 145.50, 152.40, 159.30, 166.10, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(353, 12, 'Male', 130.20, 137.40, 144.60, 151.90, 159.10, 166.30, 173.60, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(354, 13, 'Male', 136.40, 144.00, 151.50, 159.10, 166.60, 174.20, 181.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(355, 14, 'Male', 142.50, 150.30, 158.10, 165.80, 173.60, 181.30, 189.10, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(356, 15, 'Male', 147.40, 155.20, 163.00, 170.80, 178.60, 186.40, 194.20, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(357, 16, 'Male', 150.90, 158.60, 166.30, 174.00, 181.80, 189.50, 197.20, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(358, 17, 'Male', 153.00, 160.50, 168.10, 175.70, 183.30, 190.80, 198.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(359, 18, 'Male', 154.20, 161.60, 169.00, 176.40, 183.80, 191.10, 198.50, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(360, 19, 'Male', 154.60, 161.90, 169.20, 176.50, 183.80, 191.10, 198.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(361, 5, 'Female', 97.00, 101.90, 106.80, 111.70, 116.60, 121.50, 126.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(362, 6, 'Female', 101.70, 107.00, 112.20, 117.50, 122.80, 128.00, 133.30, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(363, 7, 'Female', 106.40, 112.00, 117.60, 123.20, 128.80, 134.40, 140.00, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(364, 8, 'Female', 111.20, 117.10, 123.10, 129.00, 134.90, 140.90, 146.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(365, 9, 'Female', 116.30, 122.60, 128.80, 135.00, 141.30, 147.50, 153.70, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(366, 10, 'Female', 121.70, 128.20, 134.80, 141.30, 147.80, 154.30, 160.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(367, 11, 'Female', 127.40, 134.20, 140.90, 147.70, 154.40, 161.10, 167.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(368, 12, 'Female', 132.90, 139.80, 146.70, 153.60, 160.50, 167.40, 174.30, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(369, 13, 'Female', 137.20, 144.10, 151.10, 158.00, 165.00, 171.90, 178.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(370, 14, 'Female', 140.00, 146.90, 153.80, 160.70, 167.70, 174.60, 181.50, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(371, 15, 'Female', 141.60, 148.40, 155.30, 162.10, 169.00, 175.80, 182.60, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(372, 16, 'Female', 142.40, 149.20, 155.90, 162.70, 169.40, 176.20, 182.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(373, 17, 'Female', 143.00, 149.60, 156.30, 162.90, 169.60, 176.30, 182.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(374, 18, 'Female', 143.40, 150.00, 156.50, 163.10, 169.70, 176.30, 182.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(375, 19, 'Female', 143.50, 150.10, 156.60, 163.20, 169.70, 176.20, 182.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(376, 5, 'Male', 98.20, 103.00, 107.70, 112.40, 117.10, 121.80, 126.50, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(377, 6, 'Male', 103.20, 108.20, 113.30, 118.40, 123.50, 128.50, 133.60, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(378, 7, 'Male', 107.80, 113.20, 118.60, 124.10, 129.50, 134.90, 140.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(379, 8, 'Male', 112.10, 117.90, 123.70, 129.50, 135.30, 141.10, 146.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(380, 9, 'Male', 116.30, 122.40, 128.60, 134.70, 140.90, 147.10, 153.20, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(381, 10, 'Male', 120.40, 126.90, 133.40, 140.00, 146.50, 153.00, 159.50, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(382, 11, 'Male', 124.90, 131.70, 138.60, 145.50, 152.40, 159.30, 166.10, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(383, 12, 'Male', 130.20, 137.40, 144.60, 151.90, 159.10, 166.30, 173.60, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(384, 13, 'Male', 136.40, 144.00, 151.50, 159.10, 166.60, 174.20, 181.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(385, 14, 'Male', 142.50, 150.30, 158.10, 165.80, 173.60, 181.30, 189.10, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(386, 15, 'Male', 147.40, 155.20, 163.00, 170.80, 178.60, 186.40, 194.20, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(387, 16, 'Male', 150.90, 158.60, 166.30, 174.00, 181.80, 189.50, 197.20, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(388, 17, 'Male', 153.00, 160.50, 168.10, 175.70, 183.30, 190.80, 198.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(389, 18, 'Male', 154.20, 161.60, 169.00, 176.40, 183.80, 191.10, 198.50, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(390, 19, 'Male', 154.60, 161.90, 169.20, 176.50, 183.80, 191.10, 198.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(391, 5, 'Female', 97.00, 101.90, 106.80, 111.70, 116.60, 121.50, 126.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(392, 6, 'Female', 101.70, 107.00, 112.20, 117.50, 122.80, 128.00, 133.30, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(393, 7, 'Female', 106.40, 112.00, 117.60, 123.20, 128.80, 134.40, 140.00, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(394, 8, 'Female', 111.20, 117.10, 123.10, 129.00, 134.90, 140.90, 146.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(395, 9, 'Female', 116.30, 122.60, 128.80, 135.00, 141.30, 147.50, 153.70, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(396, 10, 'Female', 121.70, 128.20, 134.80, 141.30, 147.80, 154.30, 160.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(397, 11, 'Female', 127.40, 134.20, 140.90, 147.70, 154.40, 161.10, 167.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(398, 12, 'Female', 132.90, 139.80, 146.70, 153.60, 160.50, 167.40, 174.30, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(399, 13, 'Female', 137.20, 144.10, 151.10, 158.00, 165.00, 171.90, 178.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(400, 14, 'Female', 140.00, 146.90, 153.80, 160.70, 167.70, 174.60, 181.50, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(401, 15, 'Female', 141.60, 148.40, 155.30, 162.10, 169.00, 175.80, 182.60, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(402, 16, 'Female', 142.40, 149.20, 155.90, 162.70, 169.40, 176.20, 182.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(403, 17, 'Female', 143.00, 149.60, 156.30, 162.90, 169.60, 176.30, 182.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(404, 18, 'Female', 143.40, 150.00, 156.50, 163.10, 169.70, 176.30, 182.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(405, 19, 'Female', 143.50, 150.10, 156.60, 163.20, 169.70, 176.20, 182.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(406, 5, 'Male', 98.20, 103.00, 107.70, 112.40, 117.10, 121.80, 126.50, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(407, 6, 'Male', 103.20, 108.20, 113.30, 118.40, 123.50, 128.50, 133.60, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(408, 7, 'Male', 107.80, 113.20, 118.60, 124.10, 129.50, 134.90, 140.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(409, 8, 'Male', 112.10, 117.90, 123.70, 129.50, 135.30, 141.10, 146.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(410, 9, 'Male', 116.30, 122.40, 128.60, 134.70, 140.90, 147.10, 153.20, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(411, 10, 'Male', 120.40, 126.90, 133.40, 140.00, 146.50, 153.00, 159.50, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(412, 11, 'Male', 124.90, 131.70, 138.60, 145.50, 152.40, 159.30, 166.10, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(413, 12, 'Male', 130.20, 137.40, 144.60, 151.90, 159.10, 166.30, 173.60, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(414, 13, 'Male', 136.40, 144.00, 151.50, 159.10, 166.60, 174.20, 181.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(415, 14, 'Male', 142.50, 150.30, 158.10, 165.80, 173.60, 181.30, 189.10, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(416, 15, 'Male', 147.40, 155.20, 163.00, 170.80, 178.60, 186.40, 194.20, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(417, 16, 'Male', 150.90, 158.60, 166.30, 174.00, 181.80, 189.50, 197.20, '2023-12-13 23:16:16', '2023-12-13 23:16:16');
INSERT INTO `hfa_standards` (`id`, `age`, `sex`, `negative_thirdSD`, `negative_secondSD`, `negative_firstSD`, `median`, `firstSD`, `secondSD`, `thirdSD`, `created_at`, `updated_at`) VALUES
(418, 17, 'Male', 153.00, 160.50, 168.10, 175.70, 183.30, 190.80, 198.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(419, 18, 'Male', 154.20, 161.60, 169.00, 176.40, 183.80, 191.10, 198.50, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(420, 19, 'Male', 154.60, 161.90, 169.20, 176.50, 183.80, 191.10, 198.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(421, 5, 'Female', 97.00, 101.90, 106.80, 111.70, 116.60, 121.50, 126.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(422, 6, 'Female', 101.70, 107.00, 112.20, 117.50, 122.80, 128.00, 133.30, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(423, 7, 'Female', 106.40, 112.00, 117.60, 123.20, 128.80, 134.40, 140.00, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(424, 8, 'Female', 111.20, 117.10, 123.10, 129.00, 134.90, 140.90, 146.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(425, 9, 'Female', 116.30, 122.60, 128.80, 135.00, 141.30, 147.50, 153.70, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(426, 10, 'Female', 121.70, 128.20, 134.80, 141.30, 147.80, 154.30, 160.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(427, 11, 'Female', 127.40, 134.20, 140.90, 147.70, 154.40, 161.10, 167.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(428, 12, 'Female', 132.90, 139.80, 146.70, 153.60, 160.50, 167.40, 174.30, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(429, 13, 'Female', 137.20, 144.10, 151.10, 158.00, 165.00, 171.90, 178.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(430, 14, 'Female', 140.00, 146.90, 153.80, 160.70, 167.70, 174.60, 181.50, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(431, 15, 'Female', 141.60, 148.40, 155.30, 162.10, 169.00, 175.80, 182.60, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(432, 16, 'Female', 142.40, 149.20, 155.90, 162.70, 169.40, 176.20, 182.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(433, 17, 'Female', 143.00, 149.60, 156.30, 162.90, 169.60, 176.30, 182.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(434, 18, 'Female', 143.40, 150.00, 156.50, 163.10, 169.70, 176.30, 182.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(435, 19, 'Female', 143.50, 150.10, 156.60, 163.20, 169.70, 176.20, 182.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(436, 5, 'Male', 98.20, 103.00, 107.70, 112.40, 117.10, 121.80, 126.50, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(437, 6, 'Male', 103.20, 108.20, 113.30, 118.40, 123.50, 128.50, 133.60, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(438, 7, 'Male', 107.80, 113.20, 118.60, 124.10, 129.50, 134.90, 140.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(439, 8, 'Male', 112.10, 117.90, 123.70, 129.50, 135.30, 141.10, 146.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(440, 9, 'Male', 116.30, 122.40, 128.60, 134.70, 140.90, 147.10, 153.20, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(441, 10, 'Male', 120.40, 126.90, 133.40, 140.00, 146.50, 153.00, 159.50, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(442, 11, 'Male', 124.90, 131.70, 138.60, 145.50, 152.40, 159.30, 166.10, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(443, 12, 'Male', 130.20, 137.40, 144.60, 151.90, 159.10, 166.30, 173.60, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(444, 13, 'Male', 136.40, 144.00, 151.50, 159.10, 166.60, 174.20, 181.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(445, 14, 'Male', 142.50, 150.30, 158.10, 165.80, 173.60, 181.30, 189.10, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(446, 15, 'Male', 147.40, 155.20, 163.00, 170.80, 178.60, 186.40, 194.20, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(447, 16, 'Male', 150.90, 158.60, 166.30, 174.00, 181.80, 189.50, 197.20, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(448, 17, 'Male', 153.00, 160.50, 168.10, 175.70, 183.30, 190.80, 198.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(449, 18, 'Male', 154.20, 161.60, 169.00, 176.40, 183.80, 191.10, 198.50, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(450, 19, 'Male', 154.60, 161.90, 169.20, 176.50, 183.80, 191.10, 198.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(451, 5, 'Female', 97.00, 101.90, 106.80, 111.70, 116.60, 121.50, 126.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(452, 6, 'Female', 101.70, 107.00, 112.20, 117.50, 122.80, 128.00, 133.30, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(453, 7, 'Female', 106.40, 112.00, 117.60, 123.20, 128.80, 134.40, 140.00, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(454, 8, 'Female', 111.20, 117.10, 123.10, 129.00, 134.90, 140.90, 146.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(455, 9, 'Female', 116.30, 122.60, 128.80, 135.00, 141.30, 147.50, 153.70, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(456, 10, 'Female', 121.70, 128.20, 134.80, 141.30, 147.80, 154.30, 160.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(457, 11, 'Female', 127.40, 134.20, 140.90, 147.70, 154.40, 161.10, 167.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(458, 12, 'Female', 132.90, 139.80, 146.70, 153.60, 160.50, 167.40, 174.30, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(459, 13, 'Female', 137.20, 144.10, 151.10, 158.00, 165.00, 171.90, 178.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(460, 14, 'Female', 140.00, 146.90, 153.80, 160.70, 167.70, 174.60, 181.50, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(461, 15, 'Female', 141.60, 148.40, 155.30, 162.10, 169.00, 175.80, 182.60, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(462, 16, 'Female', 142.40, 149.20, 155.90, 162.70, 169.40, 176.20, 182.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(463, 17, 'Female', 143.00, 149.60, 156.30, 162.90, 169.60, 176.30, 182.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(464, 18, 'Female', 143.40, 150.00, 156.50, 163.10, 169.70, 176.30, 182.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(465, 19, 'Female', 143.50, 150.10, 156.60, 163.20, 169.70, 176.20, 182.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(466, 5, 'Male', 98.20, 103.00, 107.70, 112.40, 117.10, 121.80, 126.50, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(467, 6, 'Male', 103.20, 108.20, 113.30, 118.40, 123.50, 128.50, 133.60, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(468, 7, 'Male', 107.80, 113.20, 118.60, 124.10, 129.50, 134.90, 140.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(469, 8, 'Male', 112.10, 117.90, 123.70, 129.50, 135.30, 141.10, 146.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(470, 9, 'Male', 116.30, 122.40, 128.60, 134.70, 140.90, 147.10, 153.20, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(471, 10, 'Male', 120.40, 126.90, 133.40, 140.00, 146.50, 153.00, 159.50, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(472, 11, 'Male', 124.90, 131.70, 138.60, 145.50, 152.40, 159.30, 166.10, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(473, 12, 'Male', 130.20, 137.40, 144.60, 151.90, 159.10, 166.30, 173.60, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(474, 13, 'Male', 136.40, 144.00, 151.50, 159.10, 166.60, 174.20, 181.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(475, 14, 'Male', 142.50, 150.30, 158.10, 165.80, 173.60, 181.30, 189.10, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(476, 15, 'Male', 147.40, 155.20, 163.00, 170.80, 178.60, 186.40, 194.20, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(477, 16, 'Male', 150.90, 158.60, 166.30, 174.00, 181.80, 189.50, 197.20, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(478, 17, 'Male', 153.00, 160.50, 168.10, 175.70, 183.30, 190.80, 198.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(479, 18, 'Male', 154.20, 161.60, 169.00, 176.40, 183.80, 191.10, 198.50, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(480, 19, 'Male', 154.60, 161.90, 169.20, 176.50, 183.80, 191.10, 198.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(481, 5, 'Female', 97.00, 101.90, 106.80, 111.70, 116.60, 121.50, 126.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(482, 6, 'Female', 101.70, 107.00, 112.20, 117.50, 122.80, 128.00, 133.30, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(483, 7, 'Female', 106.40, 112.00, 117.60, 123.20, 128.80, 134.40, 140.00, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(484, 8, 'Female', 111.20, 117.10, 123.10, 129.00, 134.90, 140.90, 146.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(485, 9, 'Female', 116.30, 122.60, 128.80, 135.00, 141.30, 147.50, 153.70, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(486, 10, 'Female', 121.70, 128.20, 134.80, 141.30, 147.80, 154.30, 160.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(487, 11, 'Female', 127.40, 134.20, 140.90, 147.70, 154.40, 161.10, 167.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(488, 12, 'Female', 132.90, 139.80, 146.70, 153.60, 160.50, 167.40, 174.30, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(489, 13, 'Female', 137.20, 144.10, 151.10, 158.00, 165.00, 171.90, 178.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(490, 14, 'Female', 140.00, 146.90, 153.80, 160.70, 167.70, 174.60, 181.50, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(491, 15, 'Female', 141.60, 148.40, 155.30, 162.10, 169.00, 175.80, 182.60, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(492, 16, 'Female', 142.40, 149.20, 155.90, 162.70, 169.40, 176.20, 182.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(493, 17, 'Female', 143.00, 149.60, 156.30, 162.90, 169.60, 176.30, 182.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(494, 18, 'Female', 143.40, 150.00, 156.50, 163.10, 169.70, 176.30, 182.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(495, 19, 'Female', 143.50, 150.10, 156.60, 163.20, 169.70, 176.20, 182.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(496, 5, 'Male', 98.20, 103.00, 107.70, 112.40, 117.10, 121.80, 126.50, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(497, 6, 'Male', 103.20, 108.20, 113.30, 118.40, 123.50, 128.50, 133.60, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(498, 7, 'Male', 107.80, 113.20, 118.60, 124.10, 129.50, 134.90, 140.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(499, 8, 'Male', 112.10, 117.90, 123.70, 129.50, 135.30, 141.10, 146.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(500, 9, 'Male', 116.30, 122.40, 128.60, 134.70, 140.90, 147.10, 153.20, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(501, 10, 'Male', 120.40, 126.90, 133.40, 140.00, 146.50, 153.00, 159.50, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(502, 11, 'Male', 124.90, 131.70, 138.60, 145.50, 152.40, 159.30, 166.10, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(503, 12, 'Male', 130.20, 137.40, 144.60, 151.90, 159.10, 166.30, 173.60, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(504, 13, 'Male', 136.40, 144.00, 151.50, 159.10, 166.60, 174.20, 181.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(505, 14, 'Male', 142.50, 150.30, 158.10, 165.80, 173.60, 181.30, 189.10, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(506, 15, 'Male', 147.40, 155.20, 163.00, 170.80, 178.60, 186.40, 194.20, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(507, 16, 'Male', 150.90, 158.60, 166.30, 174.00, 181.80, 189.50, 197.20, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(508, 17, 'Male', 153.00, 160.50, 168.10, 175.70, 183.30, 190.80, 198.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(509, 18, 'Male', 154.20, 161.60, 169.00, 176.40, 183.80, 191.10, 198.50, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(510, 19, 'Male', 154.60, 161.90, 169.20, 176.50, 183.80, 191.10, 198.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(511, 5, 'Female', 97.00, 101.90, 106.80, 111.70, 116.60, 121.50, 126.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(512, 6, 'Female', 101.70, 107.00, 112.20, 117.50, 122.80, 128.00, 133.30, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(513, 7, 'Female', 106.40, 112.00, 117.60, 123.20, 128.80, 134.40, 140.00, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(514, 8, 'Female', 111.20, 117.10, 123.10, 129.00, 134.90, 140.90, 146.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(515, 9, 'Female', 116.30, 122.60, 128.80, 135.00, 141.30, 147.50, 153.70, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(516, 10, 'Female', 121.70, 128.20, 134.80, 141.30, 147.80, 154.30, 160.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(517, 11, 'Female', 127.40, 134.20, 140.90, 147.70, 154.40, 161.10, 167.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(518, 12, 'Female', 132.90, 139.80, 146.70, 153.60, 160.50, 167.40, 174.30, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(519, 13, 'Female', 137.20, 144.10, 151.10, 158.00, 165.00, 171.90, 178.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(520, 14, 'Female', 140.00, 146.90, 153.80, 160.70, 167.70, 174.60, 181.50, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(521, 15, 'Female', 141.60, 148.40, 155.30, 162.10, 169.00, 175.80, 182.60, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(522, 16, 'Female', 142.40, 149.20, 155.90, 162.70, 169.40, 176.20, 182.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(523, 17, 'Female', 143.00, 149.60, 156.30, 162.90, 169.60, 176.30, 182.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(524, 18, 'Female', 143.40, 150.00, 156.50, 163.10, 169.70, 176.30, 182.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(525, 19, 'Female', 143.50, 150.10, 156.60, 163.20, 169.70, 176.20, 182.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(526, 5, 'Male', 98.20, 103.00, 107.70, 112.40, 117.10, 121.80, 126.50, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(527, 6, 'Male', 103.20, 108.20, 113.30, 118.40, 123.50, 128.50, 133.60, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(528, 7, 'Male', 107.80, 113.20, 118.60, 124.10, 129.50, 134.90, 140.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(529, 8, 'Male', 112.10, 117.90, 123.70, 129.50, 135.30, 141.10, 146.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(530, 9, 'Male', 116.30, 122.40, 128.60, 134.70, 140.90, 147.10, 153.20, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(531, 10, 'Male', 120.40, 126.90, 133.40, 140.00, 146.50, 153.00, 159.50, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(532, 11, 'Male', 124.90, 131.70, 138.60, 145.50, 152.40, 159.30, 166.10, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(533, 12, 'Male', 130.20, 137.40, 144.60, 151.90, 159.10, 166.30, 173.60, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(534, 13, 'Male', 136.40, 144.00, 151.50, 159.10, 166.60, 174.20, 181.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(535, 14, 'Male', 142.50, 150.30, 158.10, 165.80, 173.60, 181.30, 189.10, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(536, 15, 'Male', 147.40, 155.20, 163.00, 170.80, 178.60, 186.40, 194.20, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(537, 16, 'Male', 150.90, 158.60, 166.30, 174.00, 181.80, 189.50, 197.20, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(538, 17, 'Male', 153.00, 160.50, 168.10, 175.70, 183.30, 190.80, 198.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(539, 18, 'Male', 154.20, 161.60, 169.00, 176.40, 183.80, 191.10, 198.50, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(540, 19, 'Male', 154.60, 161.90, 169.20, 176.50, 183.80, 191.10, 198.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(541, 5, 'Female', 97.00, 101.90, 106.80, 111.70, 116.60, 121.50, 126.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(542, 6, 'Female', 101.70, 107.00, 112.20, 117.50, 122.80, 128.00, 133.30, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(543, 7, 'Female', 106.40, 112.00, 117.60, 123.20, 128.80, 134.40, 140.00, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(544, 8, 'Female', 111.20, 117.10, 123.10, 129.00, 134.90, 140.90, 146.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(545, 9, 'Female', 116.30, 122.60, 128.80, 135.00, 141.30, 147.50, 153.70, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(546, 10, 'Female', 121.70, 128.20, 134.80, 141.30, 147.80, 154.30, 160.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(547, 11, 'Female', 127.40, 134.20, 140.90, 147.70, 154.40, 161.10, 167.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(548, 12, 'Female', 132.90, 139.80, 146.70, 153.60, 160.50, 167.40, 174.30, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(549, 13, 'Female', 137.20, 144.10, 151.10, 158.00, 165.00, 171.90, 178.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(550, 14, 'Female', 140.00, 146.90, 153.80, 160.70, 167.70, 174.60, 181.50, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(551, 15, 'Female', 141.60, 148.40, 155.30, 162.10, 169.00, 175.80, 182.60, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(552, 16, 'Female', 142.40, 149.20, 155.90, 162.70, 169.40, 176.20, 182.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(553, 17, 'Female', 143.00, 149.60, 156.30, 162.90, 169.60, 176.30, 182.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(554, 18, 'Female', 143.40, 150.00, 156.50, 163.10, 169.70, 176.30, 182.90, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(555, 19, 'Female', 143.50, 150.10, 156.60, 163.20, 169.70, 176.20, 182.80, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(556, 5, 'Male', 98.20, 103.00, 107.70, 112.40, 117.10, 121.80, 126.50, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(557, 6, 'Male', 103.20, 108.20, 113.30, 118.40, 123.50, 128.50, 133.60, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(558, 7, 'Male', 107.80, 113.20, 118.60, 124.10, 129.50, 134.90, 140.40, '2023-12-13 23:16:16', '2023-12-13 23:16:16'),
(559, 8, 'Male', 112.10, 117.90, 123.70, 129.50, 135.30, 141.10, 146.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(560, 9, 'Male', 116.30, 122.40, 128.60, 134.70, 140.90, 147.10, 153.20, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(561, 10, 'Male', 120.40, 126.90, 133.40, 140.00, 146.50, 153.00, 159.50, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(562, 11, 'Male', 124.90, 131.70, 138.60, 145.50, 152.40, 159.30, 166.10, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(563, 12, 'Male', 130.20, 137.40, 144.60, 151.90, 159.10, 166.30, 173.60, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(564, 13, 'Male', 136.40, 144.00, 151.50, 159.10, 166.60, 174.20, 181.80, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(565, 14, 'Male', 142.50, 150.30, 158.10, 165.80, 173.60, 181.30, 189.10, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(566, 15, 'Male', 147.40, 155.20, 163.00, 170.80, 178.60, 186.40, 194.20, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(567, 16, 'Male', 150.90, 158.60, 166.30, 174.00, 181.80, 189.50, 197.20, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(568, 17, 'Male', 153.00, 160.50, 168.10, 175.70, 183.30, 190.80, 198.40, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(569, 18, 'Male', 154.20, 161.60, 169.00, 176.40, 183.80, 191.10, 198.50, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(570, 19, 'Male', 154.60, 161.90, 169.20, 176.50, 183.80, 191.10, 198.40, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(571, 5, 'Female', 97.00, 101.90, 106.80, 111.70, 116.60, 121.50, 126.40, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(572, 6, 'Female', 101.70, 107.00, 112.20, 117.50, 122.80, 128.00, 133.30, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(573, 7, 'Female', 106.40, 112.00, 117.60, 123.20, 128.80, 134.40, 140.00, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(574, 8, 'Female', 111.20, 117.10, 123.10, 129.00, 134.90, 140.90, 146.80, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(575, 9, 'Female', 116.30, 122.60, 128.80, 135.00, 141.30, 147.50, 153.70, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(576, 10, 'Female', 121.70, 128.20, 134.80, 141.30, 147.80, 154.30, 160.80, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(577, 11, 'Female', 127.40, 134.20, 140.90, 147.70, 154.40, 161.10, 167.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(578, 12, 'Female', 132.90, 139.80, 146.70, 153.60, 160.50, 167.40, 174.30, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(579, 13, 'Female', 137.20, 144.10, 151.10, 158.00, 165.00, 171.90, 178.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(580, 14, 'Female', 140.00, 146.90, 153.80, 160.70, 167.70, 174.60, 181.50, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(581, 15, 'Female', 141.60, 148.40, 155.30, 162.10, 169.00, 175.80, 182.60, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(582, 16, 'Female', 142.40, 149.20, 155.90, 162.70, 169.40, 176.20, 182.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(583, 17, 'Female', 143.00, 149.60, 156.30, 162.90, 169.60, 176.30, 182.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(584, 18, 'Female', 143.40, 150.00, 156.50, 163.10, 169.70, 176.30, 182.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(585, 19, 'Female', 143.50, 150.10, 156.60, 163.20, 169.70, 176.20, 182.80, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(586, 5, 'Male', 98.20, 103.00, 107.70, 112.40, 117.10, 121.80, 126.50, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(587, 6, 'Male', 103.20, 108.20, 113.30, 118.40, 123.50, 128.50, 133.60, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(588, 7, 'Male', 107.80, 113.20, 118.60, 124.10, 129.50, 134.90, 140.40, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(589, 8, 'Male', 112.10, 117.90, 123.70, 129.50, 135.30, 141.10, 146.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(590, 9, 'Male', 116.30, 122.40, 128.60, 134.70, 140.90, 147.10, 153.20, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(591, 10, 'Male', 120.40, 126.90, 133.40, 140.00, 146.50, 153.00, 159.50, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(592, 11, 'Male', 124.90, 131.70, 138.60, 145.50, 152.40, 159.30, 166.10, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(593, 12, 'Male', 130.20, 137.40, 144.60, 151.90, 159.10, 166.30, 173.60, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(594, 13, 'Male', 136.40, 144.00, 151.50, 159.10, 166.60, 174.20, 181.80, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(595, 14, 'Male', 142.50, 150.30, 158.10, 165.80, 173.60, 181.30, 189.10, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(596, 15, 'Male', 147.40, 155.20, 163.00, 170.80, 178.60, 186.40, 194.20, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(597, 16, 'Male', 150.90, 158.60, 166.30, 174.00, 181.80, 189.50, 197.20, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(598, 17, 'Male', 153.00, 160.50, 168.10, 175.70, 183.30, 190.80, 198.40, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(599, 18, 'Male', 154.20, 161.60, 169.00, 176.40, 183.80, 191.10, 198.50, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(600, 19, 'Male', 154.60, 161.90, 169.20, 176.50, 183.80, 191.10, 198.40, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(601, 5, 'Female', 97.00, 101.90, 106.80, 111.70, 116.60, 121.50, 126.40, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(602, 6, 'Female', 101.70, 107.00, 112.20, 117.50, 122.80, 128.00, 133.30, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(603, 7, 'Female', 106.40, 112.00, 117.60, 123.20, 128.80, 134.40, 140.00, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(604, 8, 'Female', 111.20, 117.10, 123.10, 129.00, 134.90, 140.90, 146.80, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(605, 9, 'Female', 116.30, 122.60, 128.80, 135.00, 141.30, 147.50, 153.70, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(606, 10, 'Female', 121.70, 128.20, 134.80, 141.30, 147.80, 154.30, 160.80, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(607, 11, 'Female', 127.40, 134.20, 140.90, 147.70, 154.40, 161.10, 167.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(608, 12, 'Female', 132.90, 139.80, 146.70, 153.60, 160.50, 167.40, 174.30, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(609, 13, 'Female', 137.20, 144.10, 151.10, 158.00, 165.00, 171.90, 178.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(610, 14, 'Female', 140.00, 146.90, 153.80, 160.70, 167.70, 174.60, 181.50, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(611, 15, 'Female', 141.60, 148.40, 155.30, 162.10, 169.00, 175.80, 182.60, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(612, 16, 'Female', 142.40, 149.20, 155.90, 162.70, 169.40, 176.20, 182.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(613, 17, 'Female', 143.00, 149.60, 156.30, 162.90, 169.60, 176.30, 182.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(614, 18, 'Female', 143.40, 150.00, 156.50, 163.10, 169.70, 176.30, 182.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(615, 19, 'Female', 143.50, 150.10, 156.60, 163.20, 169.70, 176.20, 182.80, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(616, 5, 'Male', 98.20, 103.00, 107.70, 112.40, 117.10, 121.80, 126.50, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(617, 6, 'Male', 103.20, 108.20, 113.30, 118.40, 123.50, 128.50, 133.60, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(618, 7, 'Male', 107.80, 113.20, 118.60, 124.10, 129.50, 134.90, 140.40, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(619, 8, 'Male', 112.10, 117.90, 123.70, 129.50, 135.30, 141.10, 146.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(620, 9, 'Male', 116.30, 122.40, 128.60, 134.70, 140.90, 147.10, 153.20, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(621, 10, 'Male', 120.40, 126.90, 133.40, 140.00, 146.50, 153.00, 159.50, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(622, 11, 'Male', 124.90, 131.70, 138.60, 145.50, 152.40, 159.30, 166.10, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(623, 12, 'Male', 130.20, 137.40, 144.60, 151.90, 159.10, 166.30, 173.60, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(624, 13, 'Male', 136.40, 144.00, 151.50, 159.10, 166.60, 174.20, 181.80, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(625, 14, 'Male', 142.50, 150.30, 158.10, 165.80, 173.60, 181.30, 189.10, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(626, 15, 'Male', 147.40, 155.20, 163.00, 170.80, 178.60, 186.40, 194.20, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(627, 16, 'Male', 150.90, 158.60, 166.30, 174.00, 181.80, 189.50, 197.20, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(628, 17, 'Male', 153.00, 160.50, 168.10, 175.70, 183.30, 190.80, 198.40, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(629, 18, 'Male', 154.20, 161.60, 169.00, 176.40, 183.80, 191.10, 198.50, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(630, 19, 'Male', 154.60, 161.90, 169.20, 176.50, 183.80, 191.10, 198.40, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(631, 5, 'Female', 97.00, 101.90, 106.80, 111.70, 116.60, 121.50, 126.40, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(632, 6, 'Female', 101.70, 107.00, 112.20, 117.50, 122.80, 128.00, 133.30, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(633, 7, 'Female', 106.40, 112.00, 117.60, 123.20, 128.80, 134.40, 140.00, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(634, 8, 'Female', 111.20, 117.10, 123.10, 129.00, 134.90, 140.90, 146.80, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(635, 9, 'Female', 116.30, 122.60, 128.80, 135.00, 141.30, 147.50, 153.70, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(636, 10, 'Female', 121.70, 128.20, 134.80, 141.30, 147.80, 154.30, 160.80, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(637, 11, 'Female', 127.40, 134.20, 140.90, 147.70, 154.40, 161.10, 167.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(638, 12, 'Female', 132.90, 139.80, 146.70, 153.60, 160.50, 167.40, 174.30, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(639, 13, 'Female', 137.20, 144.10, 151.10, 158.00, 165.00, 171.90, 178.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(640, 14, 'Female', 140.00, 146.90, 153.80, 160.70, 167.70, 174.60, 181.50, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(641, 15, 'Female', 141.60, 148.40, 155.30, 162.10, 169.00, 175.80, 182.60, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(642, 16, 'Female', 142.40, 149.20, 155.90, 162.70, 169.40, 176.20, 182.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(643, 17, 'Female', 143.00, 149.60, 156.30, 162.90, 169.60, 176.30, 182.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(644, 18, 'Female', 143.40, 150.00, 156.50, 163.10, 169.70, 176.30, 182.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(645, 19, 'Female', 143.50, 150.10, 156.60, 163.20, 169.70, 176.20, 182.80, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(646, 5, 'Male', 98.20, 103.00, 107.70, 112.40, 117.10, 121.80, 126.50, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(647, 6, 'Male', 103.20, 108.20, 113.30, 118.40, 123.50, 128.50, 133.60, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(648, 7, 'Male', 107.80, 113.20, 118.60, 124.10, 129.50, 134.90, 140.40, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(649, 8, 'Male', 112.10, 117.90, 123.70, 129.50, 135.30, 141.10, 146.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(650, 9, 'Male', 116.30, 122.40, 128.60, 134.70, 140.90, 147.10, 153.20, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(651, 10, 'Male', 120.40, 126.90, 133.40, 140.00, 146.50, 153.00, 159.50, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(652, 11, 'Male', 124.90, 131.70, 138.60, 145.50, 152.40, 159.30, 166.10, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(653, 12, 'Male', 130.20, 137.40, 144.60, 151.90, 159.10, 166.30, 173.60, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(654, 13, 'Male', 136.40, 144.00, 151.50, 159.10, 166.60, 174.20, 181.80, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(655, 14, 'Male', 142.50, 150.30, 158.10, 165.80, 173.60, 181.30, 189.10, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(656, 15, 'Male', 147.40, 155.20, 163.00, 170.80, 178.60, 186.40, 194.20, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(657, 16, 'Male', 150.90, 158.60, 166.30, 174.00, 181.80, 189.50, 197.20, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(658, 17, 'Male', 153.00, 160.50, 168.10, 175.70, 183.30, 190.80, 198.40, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(659, 18, 'Male', 154.20, 161.60, 169.00, 176.40, 183.80, 191.10, 198.50, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(660, 19, 'Male', 154.60, 161.90, 169.20, 176.50, 183.80, 191.10, 198.40, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(661, 5, 'Female', 97.00, 101.90, 106.80, 111.70, 116.60, 121.50, 126.40, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(662, 6, 'Female', 101.70, 107.00, 112.20, 117.50, 122.80, 128.00, 133.30, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(663, 7, 'Female', 106.40, 112.00, 117.60, 123.20, 128.80, 134.40, 140.00, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(664, 8, 'Female', 111.20, 117.10, 123.10, 129.00, 134.90, 140.90, 146.80, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(665, 9, 'Female', 116.30, 122.60, 128.80, 135.00, 141.30, 147.50, 153.70, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(666, 10, 'Female', 121.70, 128.20, 134.80, 141.30, 147.80, 154.30, 160.80, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(667, 11, 'Female', 127.40, 134.20, 140.90, 147.70, 154.40, 161.10, 167.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(668, 12, 'Female', 132.90, 139.80, 146.70, 153.60, 160.50, 167.40, 174.30, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(669, 13, 'Female', 137.20, 144.10, 151.10, 158.00, 165.00, 171.90, 178.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(670, 14, 'Female', 140.00, 146.90, 153.80, 160.70, 167.70, 174.60, 181.50, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(671, 15, 'Female', 141.60, 148.40, 155.30, 162.10, 169.00, 175.80, 182.60, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(672, 16, 'Female', 142.40, 149.20, 155.90, 162.70, 169.40, 176.20, 182.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(673, 17, 'Female', 143.00, 149.60, 156.30, 162.90, 169.60, 176.30, 182.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(674, 18, 'Female', 143.40, 150.00, 156.50, 163.10, 169.70, 176.30, 182.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(675, 19, 'Female', 143.50, 150.10, 156.60, 163.20, 169.70, 176.20, 182.80, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(676, 5, 'Male', 98.20, 103.00, 107.70, 112.40, 117.10, 121.80, 126.50, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(677, 6, 'Male', 103.20, 108.20, 113.30, 118.40, 123.50, 128.50, 133.60, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(678, 7, 'Male', 107.80, 113.20, 118.60, 124.10, 129.50, 134.90, 140.40, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(679, 8, 'Male', 112.10, 117.90, 123.70, 129.50, 135.30, 141.10, 146.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(680, 9, 'Male', 116.30, 122.40, 128.60, 134.70, 140.90, 147.10, 153.20, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(681, 10, 'Male', 120.40, 126.90, 133.40, 140.00, 146.50, 153.00, 159.50, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(682, 11, 'Male', 124.90, 131.70, 138.60, 145.50, 152.40, 159.30, 166.10, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(683, 12, 'Male', 130.20, 137.40, 144.60, 151.90, 159.10, 166.30, 173.60, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(684, 13, 'Male', 136.40, 144.00, 151.50, 159.10, 166.60, 174.20, 181.80, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(685, 14, 'Male', 142.50, 150.30, 158.10, 165.80, 173.60, 181.30, 189.10, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(686, 15, 'Male', 147.40, 155.20, 163.00, 170.80, 178.60, 186.40, 194.20, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(687, 16, 'Male', 150.90, 158.60, 166.30, 174.00, 181.80, 189.50, 197.20, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(688, 17, 'Male', 153.00, 160.50, 168.10, 175.70, 183.30, 190.80, 198.40, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(689, 18, 'Male', 154.20, 161.60, 169.00, 176.40, 183.80, 191.10, 198.50, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(690, 19, 'Male', 154.60, 161.90, 169.20, 176.50, 183.80, 191.10, 198.40, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(691, 5, 'Female', 97.00, 101.90, 106.80, 111.70, 116.60, 121.50, 126.40, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(692, 6, 'Female', 101.70, 107.00, 112.20, 117.50, 122.80, 128.00, 133.30, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(693, 7, 'Female', 106.40, 112.00, 117.60, 123.20, 128.80, 134.40, 140.00, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(694, 8, 'Female', 111.20, 117.10, 123.10, 129.00, 134.90, 140.90, 146.80, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(695, 9, 'Female', 116.30, 122.60, 128.80, 135.00, 141.30, 147.50, 153.70, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(696, 10, 'Female', 121.70, 128.20, 134.80, 141.30, 147.80, 154.30, 160.80, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(697, 11, 'Female', 127.40, 134.20, 140.90, 147.70, 154.40, 161.10, 167.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(698, 12, 'Female', 132.90, 139.80, 146.70, 153.60, 160.50, 167.40, 174.30, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(699, 13, 'Female', 137.20, 144.10, 151.10, 158.00, 165.00, 171.90, 178.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(700, 14, 'Female', 140.00, 146.90, 153.80, 160.70, 167.70, 174.60, 181.50, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(701, 15, 'Female', 141.60, 148.40, 155.30, 162.10, 169.00, 175.80, 182.60, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(702, 16, 'Female', 142.40, 149.20, 155.90, 162.70, 169.40, 176.20, 182.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(703, 17, 'Female', 143.00, 149.60, 156.30, 162.90, 169.60, 176.30, 182.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(704, 18, 'Female', 143.40, 150.00, 156.50, 163.10, 169.70, 176.30, 182.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(705, 19, 'Female', 143.50, 150.10, 156.60, 163.20, 169.70, 176.20, 182.80, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(706, 5, 'Male', 98.20, 103.00, 107.70, 112.40, 117.10, 121.80, 126.50, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(707, 6, 'Male', 103.20, 108.20, 113.30, 118.40, 123.50, 128.50, 133.60, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(708, 7, 'Male', 107.80, 113.20, 118.60, 124.10, 129.50, 134.90, 140.40, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(709, 8, 'Male', 112.10, 117.90, 123.70, 129.50, 135.30, 141.10, 146.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(710, 9, 'Male', 116.30, 122.40, 128.60, 134.70, 140.90, 147.10, 153.20, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(711, 10, 'Male', 120.40, 126.90, 133.40, 140.00, 146.50, 153.00, 159.50, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(712, 11, 'Male', 124.90, 131.70, 138.60, 145.50, 152.40, 159.30, 166.10, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(713, 12, 'Male', 130.20, 137.40, 144.60, 151.90, 159.10, 166.30, 173.60, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(714, 13, 'Male', 136.40, 144.00, 151.50, 159.10, 166.60, 174.20, 181.80, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(715, 14, 'Male', 142.50, 150.30, 158.10, 165.80, 173.60, 181.30, 189.10, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(716, 15, 'Male', 147.40, 155.20, 163.00, 170.80, 178.60, 186.40, 194.20, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(717, 16, 'Male', 150.90, 158.60, 166.30, 174.00, 181.80, 189.50, 197.20, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(718, 17, 'Male', 153.00, 160.50, 168.10, 175.70, 183.30, 190.80, 198.40, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(719, 18, 'Male', 154.20, 161.60, 169.00, 176.40, 183.80, 191.10, 198.50, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(720, 19, 'Male', 154.60, 161.90, 169.20, 176.50, 183.80, 191.10, 198.40, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(721, 5, 'Female', 97.00, 101.90, 106.80, 111.70, 116.60, 121.50, 126.40, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(722, 6, 'Female', 101.70, 107.00, 112.20, 117.50, 122.80, 128.00, 133.30, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(723, 7, 'Female', 106.40, 112.00, 117.60, 123.20, 128.80, 134.40, 140.00, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(724, 8, 'Female', 111.20, 117.10, 123.10, 129.00, 134.90, 140.90, 146.80, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(725, 9, 'Female', 116.30, 122.60, 128.80, 135.00, 141.30, 147.50, 153.70, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(726, 10, 'Female', 121.70, 128.20, 134.80, 141.30, 147.80, 154.30, 160.80, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(727, 11, 'Female', 127.40, 134.20, 140.90, 147.70, 154.40, 161.10, 167.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(728, 12, 'Female', 132.90, 139.80, 146.70, 153.60, 160.50, 167.40, 174.30, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(729, 13, 'Female', 137.20, 144.10, 151.10, 158.00, 165.00, 171.90, 178.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(730, 14, 'Female', 140.00, 146.90, 153.80, 160.70, 167.70, 174.60, 181.50, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(731, 15, 'Female', 141.60, 148.40, 155.30, 162.10, 169.00, 175.80, 182.60, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(732, 16, 'Female', 142.40, 149.20, 155.90, 162.70, 169.40, 176.20, 182.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(733, 17, 'Female', 143.00, 149.60, 156.30, 162.90, 169.60, 176.30, 182.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(734, 18, 'Female', 143.40, 150.00, 156.50, 163.10, 169.70, 176.30, 182.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(735, 19, 'Female', 143.50, 150.10, 156.60, 163.20, 169.70, 176.20, 182.80, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(736, 5, 'Male', 98.20, 103.00, 107.70, 112.40, 117.10, 121.80, 126.50, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(737, 6, 'Male', 103.20, 108.20, 113.30, 118.40, 123.50, 128.50, 133.60, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(738, 7, 'Male', 107.80, 113.20, 118.60, 124.10, 129.50, 134.90, 140.40, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(739, 8, 'Male', 112.10, 117.90, 123.70, 129.50, 135.30, 141.10, 146.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(740, 9, 'Male', 116.30, 122.40, 128.60, 134.70, 140.90, 147.10, 153.20, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(741, 10, 'Male', 120.40, 126.90, 133.40, 140.00, 146.50, 153.00, 159.50, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(742, 11, 'Male', 124.90, 131.70, 138.60, 145.50, 152.40, 159.30, 166.10, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(743, 12, 'Male', 130.20, 137.40, 144.60, 151.90, 159.10, 166.30, 173.60, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(744, 13, 'Male', 136.40, 144.00, 151.50, 159.10, 166.60, 174.20, 181.80, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(745, 14, 'Male', 142.50, 150.30, 158.10, 165.80, 173.60, 181.30, 189.10, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(746, 15, 'Male', 147.40, 155.20, 163.00, 170.80, 178.60, 186.40, 194.20, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(747, 16, 'Male', 150.90, 158.60, 166.30, 174.00, 181.80, 189.50, 197.20, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(748, 17, 'Male', 153.00, 160.50, 168.10, 175.70, 183.30, 190.80, 198.40, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(749, 18, 'Male', 154.20, 161.60, 169.00, 176.40, 183.80, 191.10, 198.50, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(750, 19, 'Male', 154.60, 161.90, 169.20, 176.50, 183.80, 191.10, 198.40, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(751, 5, 'Female', 97.00, 101.90, 106.80, 111.70, 116.60, 121.50, 126.40, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(752, 6, 'Female', 101.70, 107.00, 112.20, 117.50, 122.80, 128.00, 133.30, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(753, 7, 'Female', 106.40, 112.00, 117.60, 123.20, 128.80, 134.40, 140.00, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(754, 8, 'Female', 111.20, 117.10, 123.10, 129.00, 134.90, 140.90, 146.80, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(755, 9, 'Female', 116.30, 122.60, 128.80, 135.00, 141.30, 147.50, 153.70, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(756, 10, 'Female', 121.70, 128.20, 134.80, 141.30, 147.80, 154.30, 160.80, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(757, 11, 'Female', 127.40, 134.20, 140.90, 147.70, 154.40, 161.10, 167.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(758, 12, 'Female', 132.90, 139.80, 146.70, 153.60, 160.50, 167.40, 174.30, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(759, 13, 'Female', 137.20, 144.10, 151.10, 158.00, 165.00, 171.90, 178.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(760, 14, 'Female', 140.00, 146.90, 153.80, 160.70, 167.70, 174.60, 181.50, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(761, 15, 'Female', 141.60, 148.40, 155.30, 162.10, 169.00, 175.80, 182.60, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(762, 16, 'Female', 142.40, 149.20, 155.90, 162.70, 169.40, 176.20, 182.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(763, 17, 'Female', 143.00, 149.60, 156.30, 162.90, 169.60, 176.30, 182.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(764, 18, 'Female', 143.40, 150.00, 156.50, 163.10, 169.70, 176.30, 182.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(765, 19, 'Female', 143.50, 150.10, 156.60, 163.20, 169.70, 176.20, 182.80, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(766, 5, 'Male', 98.20, 103.00, 107.70, 112.40, 117.10, 121.80, 126.50, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(767, 6, 'Male', 103.20, 108.20, 113.30, 118.40, 123.50, 128.50, 133.60, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(768, 7, 'Male', 107.80, 113.20, 118.60, 124.10, 129.50, 134.90, 140.40, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(769, 8, 'Male', 112.10, 117.90, 123.70, 129.50, 135.30, 141.10, 146.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(770, 9, 'Male', 116.30, 122.40, 128.60, 134.70, 140.90, 147.10, 153.20, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(771, 10, 'Male', 120.40, 126.90, 133.40, 140.00, 146.50, 153.00, 159.50, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(772, 11, 'Male', 124.90, 131.70, 138.60, 145.50, 152.40, 159.30, 166.10, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(773, 12, 'Male', 130.20, 137.40, 144.60, 151.90, 159.10, 166.30, 173.60, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(774, 13, 'Male', 136.40, 144.00, 151.50, 159.10, 166.60, 174.20, 181.80, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(775, 14, 'Male', 142.50, 150.30, 158.10, 165.80, 173.60, 181.30, 189.10, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(776, 15, 'Male', 147.40, 155.20, 163.00, 170.80, 178.60, 186.40, 194.20, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(777, 16, 'Male', 150.90, 158.60, 166.30, 174.00, 181.80, 189.50, 197.20, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(778, 17, 'Male', 153.00, 160.50, 168.10, 175.70, 183.30, 190.80, 198.40, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(779, 18, 'Male', 154.20, 161.60, 169.00, 176.40, 183.80, 191.10, 198.50, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(780, 19, 'Male', 154.60, 161.90, 169.20, 176.50, 183.80, 191.10, 198.40, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(781, 5, 'Female', 97.00, 101.90, 106.80, 111.70, 116.60, 121.50, 126.40, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(782, 6, 'Female', 101.70, 107.00, 112.20, 117.50, 122.80, 128.00, 133.30, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(783, 7, 'Female', 106.40, 112.00, 117.60, 123.20, 128.80, 134.40, 140.00, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(784, 8, 'Female', 111.20, 117.10, 123.10, 129.00, 134.90, 140.90, 146.80, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(785, 9, 'Female', 116.30, 122.60, 128.80, 135.00, 141.30, 147.50, 153.70, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(786, 10, 'Female', 121.70, 128.20, 134.80, 141.30, 147.80, 154.30, 160.80, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(787, 11, 'Female', 127.40, 134.20, 140.90, 147.70, 154.40, 161.10, 167.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(788, 12, 'Female', 132.90, 139.80, 146.70, 153.60, 160.50, 167.40, 174.30, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(789, 13, 'Female', 137.20, 144.10, 151.10, 158.00, 165.00, 171.90, 178.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(790, 14, 'Female', 140.00, 146.90, 153.80, 160.70, 167.70, 174.60, 181.50, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(791, 15, 'Female', 141.60, 148.40, 155.30, 162.10, 169.00, 175.80, 182.60, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(792, 16, 'Female', 142.40, 149.20, 155.90, 162.70, 169.40, 176.20, 182.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(793, 17, 'Female', 143.00, 149.60, 156.30, 162.90, 169.60, 176.30, 182.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(794, 18, 'Female', 143.40, 150.00, 156.50, 163.10, 169.70, 176.30, 182.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(795, 19, 'Female', 143.50, 150.10, 156.60, 163.20, 169.70, 176.20, 182.80, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(796, 5, 'Male', 98.20, 103.00, 107.70, 112.40, 117.10, 121.80, 126.50, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(797, 6, 'Male', 103.20, 108.20, 113.30, 118.40, 123.50, 128.50, 133.60, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(798, 7, 'Male', 107.80, 113.20, 118.60, 124.10, 129.50, 134.90, 140.40, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(799, 8, 'Male', 112.10, 117.90, 123.70, 129.50, 135.30, 141.10, 146.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(800, 9, 'Male', 116.30, 122.40, 128.60, 134.70, 140.90, 147.10, 153.20, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(801, 10, 'Male', 120.40, 126.90, 133.40, 140.00, 146.50, 153.00, 159.50, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(802, 11, 'Male', 124.90, 131.70, 138.60, 145.50, 152.40, 159.30, 166.10, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(803, 12, 'Male', 130.20, 137.40, 144.60, 151.90, 159.10, 166.30, 173.60, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(804, 13, 'Male', 136.40, 144.00, 151.50, 159.10, 166.60, 174.20, 181.80, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(805, 14, 'Male', 142.50, 150.30, 158.10, 165.80, 173.60, 181.30, 189.10, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(806, 15, 'Male', 147.40, 155.20, 163.00, 170.80, 178.60, 186.40, 194.20, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(807, 16, 'Male', 150.90, 158.60, 166.30, 174.00, 181.80, 189.50, 197.20, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(808, 17, 'Male', 153.00, 160.50, 168.10, 175.70, 183.30, 190.80, 198.40, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(809, 18, 'Male', 154.20, 161.60, 169.00, 176.40, 183.80, 191.10, 198.50, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(810, 19, 'Male', 154.60, 161.90, 169.20, 176.50, 183.80, 191.10, 198.40, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(811, 5, 'Female', 97.00, 101.90, 106.80, 111.70, 116.60, 121.50, 126.40, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(812, 6, 'Female', 101.70, 107.00, 112.20, 117.50, 122.80, 128.00, 133.30, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(813, 7, 'Female', 106.40, 112.00, 117.60, 123.20, 128.80, 134.40, 140.00, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(814, 8, 'Female', 111.20, 117.10, 123.10, 129.00, 134.90, 140.90, 146.80, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(815, 9, 'Female', 116.30, 122.60, 128.80, 135.00, 141.30, 147.50, 153.70, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(816, 10, 'Female', 121.70, 128.20, 134.80, 141.30, 147.80, 154.30, 160.80, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(817, 11, 'Female', 127.40, 134.20, 140.90, 147.70, 154.40, 161.10, 167.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(818, 12, 'Female', 132.90, 139.80, 146.70, 153.60, 160.50, 167.40, 174.30, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(819, 13, 'Female', 137.20, 144.10, 151.10, 158.00, 165.00, 171.90, 178.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(820, 14, 'Female', 140.00, 146.90, 153.80, 160.70, 167.70, 174.60, 181.50, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(821, 15, 'Female', 141.60, 148.40, 155.30, 162.10, 169.00, 175.80, 182.60, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(822, 16, 'Female', 142.40, 149.20, 155.90, 162.70, 169.40, 176.20, 182.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(823, 17, 'Female', 143.00, 149.60, 156.30, 162.90, 169.60, 176.30, 182.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(824, 18, 'Female', 143.40, 150.00, 156.50, 163.10, 169.70, 176.30, 182.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(825, 19, 'Female', 143.50, 150.10, 156.60, 163.20, 169.70, 176.20, 182.80, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(826, 5, 'Male', 98.20, 103.00, 107.70, 112.40, 117.10, 121.80, 126.50, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(827, 6, 'Male', 103.20, 108.20, 113.30, 118.40, 123.50, 128.50, 133.60, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(828, 7, 'Male', 107.80, 113.20, 118.60, 124.10, 129.50, 134.90, 140.40, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(829, 8, 'Male', 112.10, 117.90, 123.70, 129.50, 135.30, 141.10, 146.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(830, 9, 'Male', 116.30, 122.40, 128.60, 134.70, 140.90, 147.10, 153.20, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(831, 10, 'Male', 120.40, 126.90, 133.40, 140.00, 146.50, 153.00, 159.50, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(832, 11, 'Male', 124.90, 131.70, 138.60, 145.50, 152.40, 159.30, 166.10, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(833, 12, 'Male', 130.20, 137.40, 144.60, 151.90, 159.10, 166.30, 173.60, '2023-12-13 23:16:17', '2023-12-13 23:16:17');
INSERT INTO `hfa_standards` (`id`, `age`, `sex`, `negative_thirdSD`, `negative_secondSD`, `negative_firstSD`, `median`, `firstSD`, `secondSD`, `thirdSD`, `created_at`, `updated_at`) VALUES
(834, 13, 'Male', 136.40, 144.00, 151.50, 159.10, 166.60, 174.20, 181.80, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(835, 14, 'Male', 142.50, 150.30, 158.10, 165.80, 173.60, 181.30, 189.10, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(836, 15, 'Male', 147.40, 155.20, 163.00, 170.80, 178.60, 186.40, 194.20, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(837, 16, 'Male', 150.90, 158.60, 166.30, 174.00, 181.80, 189.50, 197.20, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(838, 17, 'Male', 153.00, 160.50, 168.10, 175.70, 183.30, 190.80, 198.40, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(839, 18, 'Male', 154.20, 161.60, 169.00, 176.40, 183.80, 191.10, 198.50, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(840, 19, 'Male', 154.60, 161.90, 169.20, 176.50, 183.80, 191.10, 198.40, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(841, 5, 'Female', 97.00, 101.90, 106.80, 111.70, 116.60, 121.50, 126.40, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(842, 6, 'Female', 101.70, 107.00, 112.20, 117.50, 122.80, 128.00, 133.30, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(843, 7, 'Female', 106.40, 112.00, 117.60, 123.20, 128.80, 134.40, 140.00, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(844, 8, 'Female', 111.20, 117.10, 123.10, 129.00, 134.90, 140.90, 146.80, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(845, 9, 'Female', 116.30, 122.60, 128.80, 135.00, 141.30, 147.50, 153.70, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(846, 10, 'Female', 121.70, 128.20, 134.80, 141.30, 147.80, 154.30, 160.80, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(847, 11, 'Female', 127.40, 134.20, 140.90, 147.70, 154.40, 161.10, 167.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(848, 12, 'Female', 132.90, 139.80, 146.70, 153.60, 160.50, 167.40, 174.30, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(849, 13, 'Female', 137.20, 144.10, 151.10, 158.00, 165.00, 171.90, 178.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(850, 14, 'Female', 140.00, 146.90, 153.80, 160.70, 167.70, 174.60, 181.50, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(851, 15, 'Female', 141.60, 148.40, 155.30, 162.10, 169.00, 175.80, 182.60, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(852, 16, 'Female', 142.40, 149.20, 155.90, 162.70, 169.40, 176.20, 182.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(853, 17, 'Female', 143.00, 149.60, 156.30, 162.90, 169.60, 176.30, 182.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(854, 18, 'Female', 143.40, 150.00, 156.50, 163.10, 169.70, 176.30, 182.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(855, 19, 'Female', 143.50, 150.10, 156.60, 163.20, 169.70, 176.20, 182.80, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(856, 5, 'Male', 98.20, 103.00, 107.70, 112.40, 117.10, 121.80, 126.50, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(857, 6, 'Male', 103.20, 108.20, 113.30, 118.40, 123.50, 128.50, 133.60, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(858, 7, 'Male', 107.80, 113.20, 118.60, 124.10, 129.50, 134.90, 140.40, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(859, 8, 'Male', 112.10, 117.90, 123.70, 129.50, 135.30, 141.10, 146.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(860, 9, 'Male', 116.30, 122.40, 128.60, 134.70, 140.90, 147.10, 153.20, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(861, 10, 'Male', 120.40, 126.90, 133.40, 140.00, 146.50, 153.00, 159.50, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(862, 11, 'Male', 124.90, 131.70, 138.60, 145.50, 152.40, 159.30, 166.10, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(863, 12, 'Male', 130.20, 137.40, 144.60, 151.90, 159.10, 166.30, 173.60, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(864, 13, 'Male', 136.40, 144.00, 151.50, 159.10, 166.60, 174.20, 181.80, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(865, 14, 'Male', 142.50, 150.30, 158.10, 165.80, 173.60, 181.30, 189.10, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(866, 15, 'Male', 147.40, 155.20, 163.00, 170.80, 178.60, 186.40, 194.20, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(867, 16, 'Male', 150.90, 158.60, 166.30, 174.00, 181.80, 189.50, 197.20, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(868, 17, 'Male', 153.00, 160.50, 168.10, 175.70, 183.30, 190.80, 198.40, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(869, 18, 'Male', 154.20, 161.60, 169.00, 176.40, 183.80, 191.10, 198.50, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(870, 19, 'Male', 154.60, 161.90, 169.20, 176.50, 183.80, 191.10, 198.40, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(871, 5, 'Female', 97.00, 101.90, 106.80, 111.70, 116.60, 121.50, 126.40, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(872, 6, 'Female', 101.70, 107.00, 112.20, 117.50, 122.80, 128.00, 133.30, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(873, 7, 'Female', 106.40, 112.00, 117.60, 123.20, 128.80, 134.40, 140.00, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(874, 8, 'Female', 111.20, 117.10, 123.10, 129.00, 134.90, 140.90, 146.80, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(875, 9, 'Female', 116.30, 122.60, 128.80, 135.00, 141.30, 147.50, 153.70, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(876, 10, 'Female', 121.70, 128.20, 134.80, 141.30, 147.80, 154.30, 160.80, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(877, 11, 'Female', 127.40, 134.20, 140.90, 147.70, 154.40, 161.10, 167.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(878, 12, 'Female', 132.90, 139.80, 146.70, 153.60, 160.50, 167.40, 174.30, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(879, 13, 'Female', 137.20, 144.10, 151.10, 158.00, 165.00, 171.90, 178.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(880, 14, 'Female', 140.00, 146.90, 153.80, 160.70, 167.70, 174.60, 181.50, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(881, 15, 'Female', 141.60, 148.40, 155.30, 162.10, 169.00, 175.80, 182.60, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(882, 16, 'Female', 142.40, 149.20, 155.90, 162.70, 169.40, 176.20, 182.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(883, 17, 'Female', 143.00, 149.60, 156.30, 162.90, 169.60, 176.30, 182.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(884, 18, 'Female', 143.40, 150.00, 156.50, 163.10, 169.70, 176.30, 182.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(885, 19, 'Female', 143.50, 150.10, 156.60, 163.20, 169.70, 176.20, 182.80, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(886, 5, 'Male', 98.20, 103.00, 107.70, 112.40, 117.10, 121.80, 126.50, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(887, 6, 'Male', 103.20, 108.20, 113.30, 118.40, 123.50, 128.50, 133.60, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(888, 7, 'Male', 107.80, 113.20, 118.60, 124.10, 129.50, 134.90, 140.40, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(889, 8, 'Male', 112.10, 117.90, 123.70, 129.50, 135.30, 141.10, 146.90, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(890, 9, 'Male', 116.30, 122.40, 128.60, 134.70, 140.90, 147.10, 153.20, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(891, 10, 'Male', 120.40, 126.90, 133.40, 140.00, 146.50, 153.00, 159.50, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(892, 11, 'Male', 124.90, 131.70, 138.60, 145.50, 152.40, 159.30, 166.10, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(893, 12, 'Male', 130.20, 137.40, 144.60, 151.90, 159.10, 166.30, 173.60, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(894, 13, 'Male', 136.40, 144.00, 151.50, 159.10, 166.60, 174.20, 181.80, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(895, 14, 'Male', 142.50, 150.30, 158.10, 165.80, 173.60, 181.30, 189.10, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(896, 15, 'Male', 147.40, 155.20, 163.00, 170.80, 178.60, 186.40, 194.20, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(897, 16, 'Male', 150.90, 158.60, 166.30, 174.00, 181.80, 189.50, 197.20, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(898, 17, 'Male', 153.00, 160.50, 168.10, 175.70, 183.30, 190.80, 198.40, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(899, 18, 'Male', 154.20, 161.60, 169.00, 176.40, 183.80, 191.10, 198.50, '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(900, 19, 'Male', 154.60, 161.90, 169.20, 176.50, 183.80, 191.10, 198.40, '2023-12-13 23:16:17', '2023-12-13 23:16:17');

-- --------------------------------------------------------

--
-- Table structure for table `list_of_beneficiaries`
--

CREATE TABLE `list_of_beneficiaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pupil_id` bigint(20) UNSIGNED NOT NULL,
  `classadviser_id` bigint(20) UNSIGNED NOT NULL,
  `school_nurse_id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) UNSIGNED NOT NULL,
  `schoolyear_id` bigint(20) UNSIGNED NOT NULL,
  `height` decimal(5,2) NOT NULL,
  `weight` decimal(6,2) NOT NULL,
  `bmi_category` enum('Severely Wasted','Wasted','Normal','Overweight','Obese') NOT NULL,
  `hfa_category` enum('Severely Stunted','Stunted','Normal','Tall') NOT NULL,
  `is_feeding_program` enum('0','1') NOT NULL DEFAULT '0',
  `is_deworming_program` enum('0','1') NOT NULL DEFAULT '0',
  `is_immunization_vax_program` enum('0','1') NOT NULL DEFAULT '0',
  `is_mental_healthcare_program` enum('0','1') NOT NULL DEFAULT '0',
  `is_dental_care_program` enum('0','1') NOT NULL DEFAULT '0',
  `is_eye_care_program` enum('0','1') NOT NULL DEFAULT '0',
  `is_health_wellness_program` enum('0','1') NOT NULL DEFAULT '0',
  `is_medical_support_program` enum('0','1') NOT NULL DEFAULT '0',
  `iron_supplementation` enum('0','1') DEFAULT NULL,
  `is_immunized` enum('0','1') DEFAULT NULL,
  `immunization_specify` varchar(255) DEFAULT NULL,
  `menarche` enum('0','1') DEFAULT NULL,
  `temperature` decimal(5,2) DEFAULT NULL,
  `blood_pressure` decimal(5,2) DEFAULT NULL,
  `heart_rate` decimal(5,2) DEFAULT NULL,
  `pulse_rate` decimal(5,2) DEFAULT NULL,
  `respiratory_rate` decimal(5,2) DEFAULT NULL,
  `vision_screening` enum('0','1') DEFAULT NULL,
  `auditory_screening` enum('0','1') DEFAULT NULL,
  `skin_scalp` varchar(255) DEFAULT NULL,
  `eyes` varchar(255) DEFAULT NULL,
  `ear` varchar(255) DEFAULT NULL,
  `nose` varchar(255) DEFAULT NULL,
  `mouth` varchar(255) DEFAULT NULL,
  `neck` varchar(255) DEFAULT NULL,
  `throat` varchar(255) DEFAULT NULL,
  `lungs` varchar(255) DEFAULT NULL,
  `heart` varchar(255) DEFAULT NULL,
  `abdomen` varchar(255) DEFAULT NULL,
  `deformities` enum('1','2') DEFAULT NULL,
  `deformity_specified` varchar(255) DEFAULT NULL,
  `date_of_examination` date DEFAULT NULL,
  `explanation` varchar(255) DEFAULT NULL,
  `is_deleted` enum('0','1') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `masterlists`
--

CREATE TABLE `masterlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pupil_id` bigint(20) UNSIGNED NOT NULL,
  `classadviser_id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) UNSIGNED NOT NULL,
  `schoolyear_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `masterlists`
--

INSERT INTO `masterlists` (`id`, `pupil_id`, `classadviser_id`, `class_id`, `schoolyear_id`, `created_at`, `updated_at`) VALUES
(1, 1, 49, 1, 1, '2023-12-15 01:34:39', '2023-12-15 01:34:39'),
(2, 2, 49, 1, 1, '2023-12-15 01:35:57', '2023-12-15 01:35:57'),
(3, 3, 49, 1, 1, '2023-12-15 01:36:09', '2023-12-15 01:36:09'),
(4, 4, 49, 1, 1, '2023-12-15 01:46:06', '2023-12-15 01:46:06'),
(5, 5, 49, 1, 1, '2023-12-15 01:46:12', '2023-12-15 01:46:12'),
(6, 6, 49, 1, 1, '2023-12-15 01:46:18', '2023-12-15 01:46:18'),
(7, 7, 49, 1, 1, '2023-12-15 01:46:25', '2023-12-15 01:46:25'),
(8, 8, 49, 1, 1, '2023-12-15 01:46:31', '2023-12-15 01:46:31'),
(9, 9, 49, 1, 1, '2023-12-15 01:46:36', '2023-12-15 01:46:36'),
(10, 10, 49, 1, 1, '2023-12-15 01:46:42', '2023-12-15 01:46:42'),
(11, 11, 49, 1, 1, '2023-12-15 01:46:48', '2023-12-15 01:46:48'),
(12, 12, 49, 1, 1, '2023-12-15 01:46:53', '2023-12-15 01:46:53'),
(13, 13, 49, 1, 1, '2023-12-15 01:46:58', '2023-12-15 01:46:58'),
(14, 14, 49, 1, 1, '2023-12-15 01:47:04', '2023-12-15 01:47:04'),
(15, 15, 49, 1, 1, '2023-12-15 01:47:09', '2023-12-15 01:47:09'),
(16, 16, 49, 1, 1, '2023-12-15 01:47:15', '2023-12-15 01:47:15');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(343, '2014_10_12_000000_create_users_table', 1),
(344, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(345, '2019_08_19_000000_create_failed_jobs_table', 1),
(346, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(347, '2023_10_22_184054_districts_table', 1),
(348, '2023_10_22_184112_schools_table', 1),
(349, '2023_10_29_234349_admin_logs', 1),
(350, '2023_10_30_214016_school_year', 1),
(351, '2023_11_01_121943_class', 1),
(352, '2023_11_03_121438_pupil', 1),
(353, '2023_11_23_030735_user_logs', 1),
(354, '2023_11_23_193254_masterlists', 1),
(355, '2023_12_01_003423_hfa_standards', 1),
(356, '2023_12_13_180323_sections', 1),
(357, '2023_12_13_180443_cnsr_list', 1),
(358, '2023_12_13_180517_nsr_list', 1),
(359, '2023_12_13_180626_pupil_nutritional_assessments', 1),
(360, '2023_12_13_180700_referrals', 1),
(362, '2023_12_28_214722_beneficiaries', 2);

-- --------------------------------------------------------

--
-- Table structure for table `nsr_list`
--

CREATE TABLE `nsr_list` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cnsr_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nsr_code` varchar(255) DEFAULT NULL,
  `section_id` bigint(20) UNSIGNED NOT NULL,
  `class_adviser_id` bigint(20) UNSIGNED NOT NULL,
  `schoolyear_id` bigint(20) UNSIGNED NOT NULL,
  `grade_level` varchar(255) DEFAULT NULL,
  `school_id` bigint(20) UNSIGNED DEFAULT NULL,
  `no_of_pupils` int(11) DEFAULT NULL,
  `no_of_male_pupils` int(11) DEFAULT NULL,
  `no_of_female_pupils` int(11) DEFAULT NULL,
  `no_of_severely_stunted` int(11) DEFAULT NULL,
  `no_of_male_severely_stunted` int(11) DEFAULT NULL,
  `no_of_female_severely_stunted` int(11) DEFAULT NULL,
  `no_of_stunted` int(11) DEFAULT NULL,
  `no_of_male_stunted` int(11) DEFAULT NULL,
  `no_of_female_stunted` int(11) DEFAULT NULL,
  `no_of_height_normal` int(11) DEFAULT NULL,
  `no_of_male_height_normal` int(11) DEFAULT NULL,
  `no_of_female_height_normal` int(11) DEFAULT NULL,
  `no_of_tall` int(11) DEFAULT NULL,
  `no_of_male_tall` int(11) DEFAULT NULL,
  `no_of_female_tall` int(11) DEFAULT NULL,
  `no_of_stunted_pupils` int(11) DEFAULT NULL,
  `no_of_male_stunted_pupils` int(11) DEFAULT NULL,
  `no_of_female_stunted_pupils` int(11) DEFAULT NULL,
  `no_of_severely_wasted` int(11) DEFAULT NULL,
  `no_of_male_severely_wasted` int(11) DEFAULT NULL,
  `no_of_female_severely_wasted` int(11) DEFAULT NULL,
  `no_of_wasted` int(11) DEFAULT NULL,
  `no_of_male_wasted` int(11) DEFAULT NULL,
  `no_of_female_wasted` int(11) DEFAULT NULL,
  `no_of_weight_normal` int(11) DEFAULT NULL,
  `no_of_male_weight_normal` int(11) DEFAULT NULL,
  `no_of_female_weight_normal` int(11) DEFAULT NULL,
  `no_of_overweight` int(11) DEFAULT NULL,
  `no_of_male_overweight` int(11) DEFAULT NULL,
  `no_of_female_overweight` int(11) DEFAULT NULL,
  `no_of_obese` int(11) DEFAULT NULL,
  `no_of_male_obese` int(11) DEFAULT NULL,
  `no_of_female_obese` int(11) DEFAULT NULL,
  `no_of_malnourished_pupils` int(11) DEFAULT NULL,
  `no_of_male_malnourished_pupils` int(11) DEFAULT NULL,
  `no_of_female_malnourished_pupils` int(11) DEFAULT NULL,
  `is_approved` enum('0','1') NOT NULL,
  `approved_date` date DEFAULT NULL,
  `is_deleted` enum('0','1') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nsr_list`
--

INSERT INTO `nsr_list` (`id`, `cnsr_id`, `nsr_code`, `section_id`, `class_adviser_id`, `schoolyear_id`, `grade_level`, `school_id`, `no_of_pupils`, `no_of_male_pupils`, `no_of_female_pupils`, `no_of_severely_stunted`, `no_of_male_severely_stunted`, `no_of_female_severely_stunted`, `no_of_stunted`, `no_of_male_stunted`, `no_of_female_stunted`, `no_of_height_normal`, `no_of_male_height_normal`, `no_of_female_height_normal`, `no_of_tall`, `no_of_male_tall`, `no_of_female_tall`, `no_of_stunted_pupils`, `no_of_male_stunted_pupils`, `no_of_female_stunted_pupils`, `no_of_severely_wasted`, `no_of_male_severely_wasted`, `no_of_female_severely_wasted`, `no_of_wasted`, `no_of_male_wasted`, `no_of_female_wasted`, `no_of_weight_normal`, `no_of_male_weight_normal`, `no_of_female_weight_normal`, `no_of_overweight`, `no_of_male_overweight`, `no_of_female_overweight`, `no_of_obese`, `no_of_male_obese`, `no_of_female_obese`, `no_of_malnourished_pupils`, `no_of_male_malnourished_pupils`, `no_of_female_malnourished_pupils`, `is_approved`, `approved_date`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 1, '49-1-1', 1, 49, 1, 'Kinder', 11, 16, 9, 7, 0, 0, 0, 0, 0, 0, 16, 9, 7, 0, 0, 0, 0, 0, 0, 14, 7, 7, 1, 1, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 15, 8, 7, '1', '2023-12-27', '0', '2023-12-15 02:37:08', '2023-12-27 13:51:01');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pupil`
--

CREATE TABLE `pupil` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lrn` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `suffix` varchar(255) DEFAULT NULL,
  `date_of_birth` date NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `barangay` varchar(255) DEFAULT NULL,
  `municipality` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `pupil_guardian_name` varchar(255) DEFAULT NULL,
  `pupil_guardian_contact_no` varchar(255) DEFAULT NULL,
  `added_by` bigint(20) UNSIGNED NOT NULL,
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pupil`
--

INSERT INTO `pupil` (`id`, `lrn`, `last_name`, `first_name`, `middle_name`, `suffix`, `date_of_birth`, `gender`, `barangay`, `municipality`, `province`, `pupil_guardian_name`, `pupil_guardian_contact_no`, `added_by`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, '111867070000', 'Abasando', 'Thenten', 'Lay', NULL, '2017-09-27', 'Male', NULL, NULL, NULL, NULL, NULL, 49, '0', '2023-12-14 23:49:47', '2023-12-14 23:49:47'),
(2, '111867070001', 'Amento', 'Shark', 'Mentis', NULL, '2017-02-08', 'Male', NULL, NULL, NULL, NULL, NULL, 49, '0', '2023-12-14 23:50:36', '2023-12-14 23:50:36'),
(3, '111867070003', 'Ferven', 'Nailan', 'Homon', NULL, '2017-03-09', 'Male', NULL, NULL, NULL, NULL, NULL, 49, '0', '2023-12-14 23:52:18', '2023-12-14 23:52:18'),
(4, '111867070004', 'Lamen', 'Sachen', NULL, NULL, '2017-07-13', 'Male', NULL, NULL, NULL, NULL, NULL, 49, '0', '2023-12-14 23:53:53', '2023-12-14 23:53:53'),
(5, '111867070005', 'Logian', 'Rafael', 'Arwen', NULL, '2017-05-24', 'Male', NULL, NULL, NULL, NULL, NULL, 49, '0', '2023-12-14 23:55:18', '2023-12-14 23:55:18'),
(6, '111867070006', 'Montenegro', 'Ricardo', 'Bustamante', NULL, '2015-02-10', 'Male', NULL, NULL, NULL, NULL, NULL, 49, '0', '2023-12-14 23:57:21', '2023-12-14 23:57:21'),
(7, '111867070007', 'Minanto', 'Hamoch', 'Solem', NULL, '2017-06-08', 'Male', NULL, NULL, NULL, NULL, NULL, 49, '0', '2023-12-14 23:59:04', '2023-12-14 23:59:04'),
(8, '111867070008', 'Vista', 'Ivan Miles', 'Mirandilla', NULL, '2017-06-06', 'Male', NULL, NULL, NULL, NULL, NULL, 49, '0', '2023-12-15 00:00:22', '2023-12-15 00:00:22'),
(9, '111867070009', 'Taberno', 'Nathiel', 'Montes', NULL, '2017-06-22', 'Male', NULL, NULL, NULL, NULL, NULL, 49, '0', '2023-12-15 00:01:18', '2023-12-15 00:01:18'),
(10, '111867070010', 'Jurissa', 'Laries', 'Menti', NULL, '2016-07-20', 'Female', NULL, NULL, NULL, NULL, NULL, 49, '0', '2023-12-15 00:02:17', '2023-12-15 00:02:17'),
(11, '111867070011', 'Leela', 'Janelle', 'Lilias', NULL, '2017-04-21', 'Female', NULL, NULL, NULL, NULL, NULL, 49, '0', '2023-12-15 00:03:56', '2023-12-15 00:03:56'),
(12, '111867070012', 'Madriano', 'Pamela', 'Lomon', NULL, '2017-04-27', 'Female', NULL, NULL, NULL, NULL, NULL, 49, '0', '2023-12-15 00:05:38', '2023-12-15 00:05:38'),
(13, '111867070013', 'Panan', 'Juana', 'Reyes', NULL, '2017-08-07', 'Female', NULL, NULL, NULL, NULL, NULL, 49, '0', '2023-12-15 00:06:47', '2023-12-15 00:06:47'),
(14, '111867070015', 'Regina', 'Reginne', 'Bonafente', NULL, '2016-06-04', 'Female', NULL, NULL, NULL, NULL, NULL, 49, '0', '2023-12-15 00:08:39', '2023-12-15 00:08:39'),
(15, '111867070016', 'Ronna', 'Mona', 'Lepistus', NULL, '2016-09-17', 'Female', NULL, NULL, NULL, NULL, NULL, 49, '0', '2023-12-15 00:09:27', '2023-12-15 00:09:27'),
(16, '111867070017', 'Zonta', 'Degree', 'Gonta', '', '2017-05-02', 'Female', '', '', '', '', '', 49, '0', '2023-12-15 00:11:24', '2023-12-16 18:59:13'),
(17, '12345678901', 'Doe', 'John', 'Michael', 'Jr', '2016-07-03', 'Male', 'Barangay A', 'Municipality A', 'Province A', 'Guardian A', '1234567890', 64, '', '2023-12-15 00:18:27', '2023-12-15 00:22:50'),
(18, '23456789012', 'Smith', 'Jane', 'Marie', 'Sr', '2016-01-01', 'Female', 'Barangay B', 'Municipality B', 'Province B', 'Guardian B', '9876543210', 64, '', '2023-12-15 00:18:27', '2023-12-15 00:23:25'),
(19, '34567890123', 'Johnson', 'Robert', 'Lee', 'III', '2015-04-07', 'Male', 'Barangay C', 'Municipality C', 'Province C', 'Guardian C', '4567890123', 64, '', '2023-12-15 00:18:27', '2023-12-15 00:24:05'),
(20, '45678901234', 'Williams', 'Emily', 'Grace', 'Jr', '2014-11-16', 'Female', 'Barangay D', 'Municipality D', 'Province D', 'Guardian D', '7890123456', 64, '', '2023-12-15 00:18:27', '2023-12-15 00:24:55'),
(21, '56789012345', 'Brown', 'Christopher', 'John', 'Sr', '2015-09-19', 'Male', 'Barangay E', 'Municipality E', 'Province E', 'Guardian E', '6543210987', 64, '', '2023-12-15 00:18:27', '2023-12-15 00:25:30'),
(22, '67890123456', 'Taylor', 'Olivia', 'Rose', 'Jr', '2016-02-10', 'Female', 'Barangay F', 'Municipality F', 'Province F', 'Guardian F', '7890123456', 64, '', '2023-12-15 00:18:27', '2023-12-15 00:26:22'),
(23, '78901234567', 'Miller', 'William', 'Alexander', 'III', '2016-02-25', 'Male', 'Barangay G', 'Municipality G', 'Province G', 'Guardian G', '1234567890', 64, '', '2023-12-15 00:18:27', '2023-12-15 00:29:12'),
(24, '89012345678', 'Davis', 'Sophia', 'Grace', 'Jr', '2015-11-26', 'Female', 'Barangay H', 'Municipality H', 'Province H', 'Guardian H', '9876543210', 64, '', '2023-12-15 00:18:27', '2023-12-15 00:29:46'),
(25, '90123456789', 'Anderson', 'Ethan', 'James', 'Sr', '2015-09-20', 'Male', 'Barangay I', 'Municipality I', 'Province I', 'Guardian I', '4567890123', 64, '', '2023-12-15 00:18:27', '2023-12-15 00:31:56'),
(26, '01234567890', 'Moore', 'Ava', 'Elizabeth', 'Jr', '2016-05-03', 'Female', 'Barangay J', 'Municipality J', 'Province J', 'Guardian J', '6543210987', 64, '', '2023-12-15 00:18:27', '2023-12-15 00:32:24'),
(47, '12345478901', 'Jackson', 'Liam', 'Alexander', 'Jr', '2014-12-17', 'Male', 'Barangay A', 'Municipality A', 'Province A', 'Guardian A', '1234567890', 64, '', '2023-12-15 00:35:35', '2023-12-15 00:37:24'),
(48, '23456789212', 'Johnson', 'Emma', 'Grace', 'Sr', '2017-04-22', 'Female', 'Barangay B', 'Municipality B', 'Province B', 'Guardian B', '9876543210', 64, '', '2023-12-15 00:35:35', '2023-12-15 00:35:35'),
(49, '34563890123', 'Williams', 'Noah', 'Michael', 'III', '2015-08-10', 'Male', 'Barangay C', 'Municipality C', 'Province C', 'Guardian C', '4567890123', 64, '', '2023-12-15 00:35:35', '2023-12-15 00:35:35'),
(50, '45674901234', 'Smith', 'Olivia', 'Rose', 'Jr', '2017-12-05', 'Female', 'Barangay D', 'Municipality D', 'Province D', 'Guardian D', '7890123456', 64, '', '2023-12-15 00:35:35', '2023-12-15 00:35:35'),
(51, '56781012345', 'Brown', 'Mason', 'Christopher', 'Sr', '2016-06-30', 'Male', 'Barangay E', 'Municipality E', 'Province E', 'Guardian E', '6543210987', 64, '', '2023-12-15 00:35:35', '2023-12-15 00:35:35'),
(52, '67850123456', 'Davis', 'Sophia', 'Grace', 'Jr', '2015-09-18', 'Female', 'Barangay F', 'Municipality F', 'Province F', 'Guardian F', '7890123456', 64, '', '2023-12-15 00:35:35', '2023-12-15 00:35:35'),
(53, '78901334567', 'Miller', 'Ethan', 'James', 'III', '2017-02-20', 'Male', 'Barangay G', 'Municipality G', 'Province G', 'Guardian G', '1234567890', 64, '', '2023-12-15 00:35:35', '2023-12-15 00:35:35'),
(54, '89017345678', 'Taylor', 'Ava', 'Elizabeth', 'Jr', '2016-11-12', 'Female', 'Barangay H', 'Municipality H', 'Province H', 'Guardian H', '9876543210', 64, '', '2023-12-15 00:35:35', '2023-12-15 00:35:35'),
(55, '90123426789', 'Anderson', 'Liam', 'Michael', 'Sr', '2015-04-08', 'Male', 'Barangay I', 'Municipality I', 'Province I', 'Guardian I', '4567890123', 64, '', '2023-12-15 00:35:35', '2023-12-15 00:35:35'),
(56, '01224567890', 'Moore', 'Isabella', 'Grace', 'Jr', '2017-07-25', 'Female', 'Barangay J', 'Municipality J', 'Province J', 'Guardian J', '6543210987', 64, '', '2023-12-15 00:35:35', '2023-12-15 00:35:35'),
(57, '12345218901', 'Garcia', 'Sebastian', 'Jose', 'Jr', '2015-06-12', 'Male', 'Barangay K', 'Municipality K', 'Province K', 'Guardian K', '1234567890', 64, '', '2023-12-15 00:41:12', '2023-12-15 00:41:12'),
(58, '23453289012', 'Martinez', 'Avery', 'Gabriel', 'Sr', '2017-03-28', 'Female', 'Barangay L', 'Municipality L', 'Province L', 'Guardian L', '9876543210', 64, '', '2023-12-15 00:41:12', '2023-12-15 00:41:12'),
(59, '34554890123', 'Rodriguez', 'Daniel', 'Isaac', 'III', '2016-09-05', 'Male', 'Barangay M', 'Municipality M', 'Province M', 'Guardian M', '4567890123', 64, '', '2023-12-15 00:41:12', '2023-12-15 00:41:12'),
(60, '45678942234', 'Lopez', 'Emily', 'Victoria', 'Jr', '2015-12-17', 'Female', 'Barangay N', 'Municipality N', 'Province N', 'Guardian N', '7890123456', 64, '', '2023-12-15 00:41:12', '2023-12-15 00:41:12'),
(61, '56789065345', 'Gonzalez', 'Elijah', 'Thomas', 'Sr', '2016-07-02', 'Male', 'Barangay O', 'Municipality O', 'Province O', 'Guardian O', '6543210987', 64, '', '2023-12-15 00:41:12', '2023-12-15 00:41:12'),
(62, '67890873456', 'Perez', 'Scarlett', 'Grace', 'Jr', '2015-10-21', 'Female', 'Barangay P', 'Municipality P', 'Province P', 'Guardian P', '7890123456', 64, '', '2023-12-15 00:41:12', '2023-12-15 00:41:12'),
(63, '78901324567', 'Turner', 'Landon', 'Michael', 'III', '2017-01-14', 'Male', 'Barangay Q', 'Municipality Q', 'Province Q', 'Guardian Q', '1234567890', 64, '', '2023-12-15 00:41:12', '2023-12-15 00:41:12'),
(64, '89012655678', 'Scott', 'Aria', 'Grace', 'Jr', '2016-08-08', 'Female', 'Barangay R', 'Municipality R', 'Province R', 'Guardian R', '9876543210', 64, '', '2023-12-15 00:41:12', '2023-12-15 00:41:12'),
(65, '90123256789', 'Baker', 'Carter', 'James', 'Sr', '2015-05-02', 'Male', 'Barangay S', 'Municipality S', 'Province S', 'Guardian S', '4567890123', 64, '', '2023-12-15 00:41:12', '2023-12-15 00:41:12'),
(66, '01238767890', 'Ward', 'Zoe', 'Isabella', 'Jr', '2017-07-25', 'Female', 'Barangay T', 'Municipality T', 'Province T', 'Guardian T', '6543210987', 64, '', '2023-12-15 00:41:12', '2023-12-15 00:41:12'),
(77, '12345621901', 'Hernandez', 'Mia', 'Sophia', 'Jr', '2016-04-05', 'Female', 'Barangay U', 'Municipality U', 'Province U', 'Guardian U', '1234567890', 64, '', '2023-12-15 00:43:35', '2023-12-15 00:43:35'),
(78, '23453284312', 'King', 'Owen', 'Alexander', 'Sr', '2017-01-20', 'Male', 'Barangay V', 'Municipality V', 'Province V', 'Guardian V', '9876543210', 64, '', '2023-12-15 00:43:35', '2023-12-15 00:43:35'),
(79, '34567896523', 'Ward', 'Emma', 'Grace', 'III', '2015-10-12', 'Female', 'Barangay W', 'Municipality W', 'Province W', 'Guardian W', '4567890123', 64, '', '2023-12-15 00:43:35', '2023-12-15 00:43:35'),
(80, '32678901234', 'Collins', 'Lucas', 'Benjamin', 'Jr', '2017-03-28', 'Male', 'Barangay X', 'Municipality X', 'Province X', 'Guardian X', '7890123456', 64, '', '2023-12-15 00:43:35', '2023-12-15 00:43:35'),
(81, '56785412345', 'Murray', 'Ava', 'Lily', 'Sr', '2016-08-15', 'Female', 'Barangay Y', 'Municipality Y', 'Province Y', 'Guardian Y', '6543210987', 64, '', '2023-12-15 00:43:35', '2023-12-15 00:43:35'),
(82, '67540123456', 'Lee', 'Caleb', 'Thomas', 'Jr', '2015-12-01', 'Male', 'Barangay Z', 'Municipality Z', 'Province Z', 'Guardian Z', '7895428756', 64, '', '2023-12-15 00:43:35', '2023-12-15 00:43:35'),
(83, '78981234567', 'Clark', 'Isabella', 'Grace', 'III', '2017-05-18', 'Female', 'Barangay AA', 'Municipality AA', 'Province AA', 'Guardian AA', '1234567890', 64, '', '2023-12-15 00:43:35', '2023-12-15 00:43:35'),
(84, '89014345678', 'Fisher', 'Elijah', 'David', 'Jr', '2016-10-10', 'Male', 'Barangay BB', 'Municipality BB', 'Province BB', 'Guardian BB', '9876543210', 64, '', '2023-12-15 00:43:35', '2023-12-15 00:43:35'),
(85, '90123454789', 'Perry', 'Sophia', 'Rose', 'Sr', '2015-07-02', 'Female', 'Barangay CC', 'Municipality CC', 'Province CC', 'Guardian CC', '4567890123', 64, '', '2023-12-15 00:43:35', '2023-12-15 00:43:35');

-- --------------------------------------------------------

--
-- Table structure for table `pupil_nutritional_assessments`
--

CREATE TABLE `pupil_nutritional_assessments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pna_code` varchar(50) NOT NULL,
  `nsr_id` bigint(20) UNSIGNED DEFAULT NULL,
  `pupil_id` bigint(20) UNSIGNED NOT NULL,
  `class_adviser_id` bigint(20) UNSIGNED NOT NULL,
  `schoolyear_id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) UNSIGNED NOT NULL,
  `height` decimal(5,2) NOT NULL,
  `weight` decimal(6,2) NOT NULL,
  `bmi` enum('Severely Wasted','Wasted','Normal','Overweight','Obese') DEFAULT NULL,
  `hfa` enum('Severely Stunted','Stunted','Normal','Tall') DEFAULT NULL,
  `is_dewormed` enum('0','1') NOT NULL,
  `dewormed_date` varchar(255) DEFAULT NULL,
  `is_permitted_deworming` enum('0','1') DEFAULT NULL,
  `explanation` varchar(255) DEFAULT NULL,
  `dietary_restriction` varchar(255) DEFAULT NULL,
  `is_deleted` enum('0','1') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pupil_nutritional_assessments`
--

INSERT INTO `pupil_nutritional_assessments` (`id`, `pna_code`, `nsr_id`, `pupil_id`, `class_adviser_id`, `schoolyear_id`, `class_id`, `height`, `weight`, `bmi`, `hfa`, `is_dewormed`, `dewormed_date`, `is_permitted_deworming`, `explanation`, `dietary_restriction`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, '49-11-K-111867070000', 1, 1, 49, 1, 1, 1.07, 11.00, 'Severely Wasted', 'Normal', '0', '', '0', '', '', '0', '2023-12-15 02:15:25', '2023-12-26 11:32:53'),
(2, '49-11-K-111867070001', 1, 2, 49, 1, 1, 1.09, 16.00, 'Severely Wasted', 'Normal', '0', '', '0', '', '', '0', '2023-12-15 02:16:00', '2023-12-26 11:32:53'),
(3, '49-11-K-111867070003', 1, 3, 49, 1, 1, 0.99, 13.00, 'Severely Wasted', 'Normal', '0', '', '0', '', '', '0', '2023-12-15 02:17:00', '2023-12-26 11:32:53'),
(4, '49-11-K-111867070004', 1, 4, 49, 1, 1, 1.09, 14.00, 'Severely Wasted', 'Normal', '0', '', '0', '', '', '0', '2023-12-15 02:19:48', '2023-12-26 11:32:53'),
(5, '49-11-K-111867070005', 1, 5, 49, 1, 1, 1.13, 24.00, 'Normal', 'Normal', '0', '', '0', '', '', '0', '2023-12-15 02:20:16', '2023-12-26 11:32:53'),
(6, '49-11-K-111867070006', 1, 6, 49, 1, 1, 1.16, 20.00, 'Severely Wasted', 'Normal', '0', '', '0', '', '', '0', '2023-12-15 02:21:18', '2023-12-26 11:32:53'),
(7, '49-11-K-111867070007', 1, 7, 49, 1, 1, 1.09, 16.00, 'Severely Wasted', 'Normal', '0', '', '0', '', '', '0', '2023-12-15 02:21:59', '2023-12-26 11:32:53'),
(8, '49-11-K-111867070008', 1, 8, 49, 1, 1, 1.10, 19.00, 'Severely Wasted', 'Normal', '0', '', '0', '', '', '0', '2023-12-15 02:23:25', '2023-12-26 11:32:53'),
(9, '49-11-K-111867070009', 1, 9, 49, 1, 1, 1.17, 24.00, 'Wasted', 'Normal', '0', '', '0', '', '', '0', '2023-12-15 02:23:50', '2023-12-26 11:32:53'),
(10, '49-11-K-111867070010', 1, 10, 49, 1, 1, 1.09, 16.00, 'Severely Wasted', 'Normal', '0', '', '0', '', '', '0', '2023-12-15 02:25:38', '2023-12-26 11:32:53'),
(11, '49-11-K-111867070011', 1, 11, 49, 1, 1, 1.09, 19.00, 'Severely Wasted', 'Normal', '0', '', '0', '', '', '0', '2023-12-15 02:26:09', '2023-12-26 11:32:53'),
(12, '49-11-K-111867070012', 1, 12, 49, 1, 1, 1.00, 13.00, 'Severely Wasted', 'Normal', '0', '', '0', '', '', '0', '2023-12-15 02:26:43', '2023-12-26 11:32:53'),
(13, '49-11-K-111867070013', 1, 13, 49, 1, 1, 1.08, 16.00, 'Severely Wasted', 'Normal', '0', '', '0', '', '', '0', '2023-12-15 02:29:23', '2023-12-26 11:32:53'),
(14, '49-11-K-111867070015', 1, 14, 49, 1, 1, 1.07, 16.00, 'Severely Wasted', 'Normal', '0', '', '1', '', 'Allergic To Eggs', '0', '2023-12-15 02:30:01', '2023-12-26 11:32:53'),
(15, '49-11-K-111867070016', 1, 15, 49, 1, 1, 1.19, 23.00, 'Severely Wasted', 'Normal', '0', '', '1', '', 'Allergic To Eggs', '0', '2023-12-15 02:31:08', '2023-12-26 11:32:53'),
(16, '49-11-K-111867070017', 1, 16, 49, 1, 1, 1.03, 15.00, 'Severely Wasted', 'Normal', '1', '', '1', '', 'Vegetarian', '0', '2023-12-15 02:31:42', '2023-12-26 11:32:53');

-- --------------------------------------------------------

--
-- Table structure for table `referrals`
--

CREATE TABLE `referrals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pupil_id` bigint(20) UNSIGNED NOT NULL,
  `classadviser_id` bigint(20) UNSIGNED NOT NULL,
  `class_id` bigint(20) UNSIGNED NOT NULL,
  `schoolyear_id` bigint(20) UNSIGNED NOT NULL,
  `school_nurse_id` bigint(20) UNSIGNED NOT NULL,
  `program` enum('Feeding Program','Deworming','Immunization Vax','Mental Healthcare','Dental Care') DEFAULT NULL,
  `explanation` varchar(255) DEFAULT NULL,
  `is_deleted` enum('0','1') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `referrals`
--

INSERT INTO `referrals` (`id`, `pupil_id`, `classadviser_id`, `class_id`, `schoolyear_id`, `school_nurse_id`, `program`, `explanation`, `is_deleted`, `created_at`, `updated_at`) VALUES
(4, 16, 49, 1, 1, 37, 'Feeding Program', 'He looks scrawny', '0', '2023-12-26 11:47:10', '2023-12-26 11:47:10');

-- --------------------------------------------------------

--
-- Table structure for table `schools_table`
--

CREATE TABLE `schools_table` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_id` int(11) NOT NULL,
  `school` varchar(50) NOT NULL,
  `school_nurse_id` bigint(20) UNSIGNED NOT NULL,
  `address_barangay` varchar(255) DEFAULT NULL,
  `district_id` bigint(20) UNSIGNED NOT NULL,
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schools_table`
--

INSERT INTO `schools_table` (`id`, `school_id`, `school`, `school_nurse_id`, `address_barangay`, `district_id`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 111657, 'Alcala Elementary School', 27, 'Alcala', 8, '0', '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(2, 111658, 'Bagtang Elementary School', 28, 'Bagtang', 8, '0', '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(3, 111659, 'Balinad Elementary School', 29, 'Sagpon', 8, '0', '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(4, 111660, 'Bañadero Elementary School', 30, 'Bañadero', 8, '0', '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(5, 111661, 'Bañag Elementary School', 31, 'Bañag', 8, '0', '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(6, 111662, 'Binitayan Elementary School', 32, 'Binitayan', 8, '0', '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(7, 111663, 'Bongalon Elementary School', 33, 'Bongalon', 8, '0', '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(8, 111664, 'Budiao Elementary School', 34, 'Anislag', 8, '0', '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(9, 111665, 'Busay Elementary School', 35, 'Busay', 8, '0', '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(10, 111666, 'Cullat Elementary School', 36, 'Cullat', 8, '0', '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(11, 111667, 'Daraga North Central School', 37, '30 Rosario', 8, '0', '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(12, 111668, 'Impact Learning Center', 38, 'Salvacion', 8, '0', '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(13, 111669, 'Kidaco Elementary School', 39, 'Kidaco', 8, '0', '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(14, 111670, 'Kilicao Elementary School', 40, 'Kilicao', 8, '0', '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(15, 111671, 'Kiwalo Elementary School', 41, 'Kiwalo', 8, '0', '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(16, 111672, 'Malobago Elementary School', 42, 'Malobago', 8, '0', '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(17, 111673, 'Maroroy Elementary School', 43, 'Maroroy', 8, '0', '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(18, 111674, 'Matnog Elementary School', 44, 'Matnog', 8, '0', '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(19, 111675, 'Mi-isi Elementary School', 45, 'Mi-isi', 8, '0', '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(20, 111676, 'Peñafrancia Elementary School', 46, 'Peñafrancia', 8, '0', '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(21, 111677, 'Tagas Elementary School', 47, 'Tagas', 8, '0', '2023-12-13 23:16:15', '2023-12-13 23:16:15');

-- --------------------------------------------------------

--
-- Table structure for table `school_year`
--

CREATE TABLE `school_year` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_year` varchar(255) NOT NULL,
  `phase` enum('Baseline','Endline') NOT NULL,
  `status` enum('Unset','Active','Complete') NOT NULL,
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `school_year`
--

INSERT INTO `school_year` (`id`, `school_year`, `phase`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, '2023 - 2024', 'Baseline', 'Active', '0', '2023-12-13 23:16:17', '2023-12-13 23:16:39'),
(2, '2023 - 2024', 'Endline', 'Unset', '0', '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(3, '2024 - 2025', 'Baseline', 'Unset', '0', '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(4, '2024 - 2025', 'Endline', 'Unset', '0', '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(5, '2025 - 2026', 'Baseline', 'Unset', '0', '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(6, '2025 - 2026', 'Endline', 'Unset', '0', '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(7, '2026 - 2027', 'Baseline', 'Unset', '0', '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(8, '2026 - 2027', 'Endline', 'Unset', '0', '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(9, '2027 - 2028', 'Baseline', 'Unset', '0', '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(10, '2027 - 2028', 'Endline', 'Unset', '0', '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(11, '2028 - 2029', 'Baseline', 'Unset', '0', '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(12, '2028 - 2029', 'Endline', 'Unset', '0', '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(13, '2029 - 2030', 'Baseline', 'Unset', '0', '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(14, '2029 - 2030', 'Endline', 'Unset', '0', '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(15, '2030 - 2031', 'Baseline', 'Unset', '0', '2023-12-13 23:16:17', '2023-12-13 23:16:17'),
(16, '2030 - 2031', 'Endline', 'Unset', '0', '2023-12-13 23:16:17', '2023-12-13 23:16:17');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `section_code` varchar(255) NOT NULL,
  `section_name` varchar(255) NOT NULL,
  `grade_level` enum('Kinder','1','2','3','4','5','6','SPED') NOT NULL,
  `school_id` bigint(20) UNSIGNED NOT NULL,
  `is_deleted` enum('0','1') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `section_code`, `section_name`, `grade_level`, `school_id`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, '11-Kinder-Everlasting', 'Everlasting', 'Kinder', 11, '0', '2023-12-13 23:18:28', '2023-12-13 23:18:28'),
(2, '11-1-Mangga', 'Mangga', '1', 11, '0', '2023-12-13 23:18:42', '2023-12-13 23:18:42'),
(3, '11-2-Starling', 'Starling', '2', 11, '0', '2023-12-13 23:19:14', '2023-12-13 23:19:14'),
(4, '11-3-Mustard', 'Mustard', '3', 11, '0', '2023-12-14 23:36:19', '2023-12-14 23:36:19'),
(5, '11-4-Beryl', 'Beryl', '4', 11, '0', '2023-12-14 23:37:07', '2023-12-14 23:37:07'),
(6, '11-5-Deligence', 'Deligence', '5', 11, '0', '2023-12-14 23:37:28', '2023-12-14 23:37:28'),
(7, '11-6-Einstein', 'Einstein', '6', 11, '0', '2023-12-14 23:37:54', '2023-12-14 23:37:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `unique_id` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `user_type` enum('1','2','3','4') NOT NULL DEFAULT '4',
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `unique_id`, `email`, `phone_number`, `email_verified_at`, `password`, `remember_token`, `user_type`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'A1-1110001', 'admin@gmail.com', NULL, NULL, '$2y$10$X0fZj3MaRxBnEv8TFFw9xuVIfZyZQpez7abwMgtbmKzgABuAzNyaG', 'vOmbKhcxUz98idk2GMsAYOdLJT3sCUeZiRwHyf70qFzYrIqPE2dr5rWxrnfp', '1', '0', '2023-12-13 23:15:52', '2023-12-13 23:15:52'),
(2, 'Tiwi Medical Officer', 'M2-1110002', 'tiwi-medicalofficer@gmail.com', NULL, NULL, '$2y$10$zU6UoK6o5734aXcpCby0PuC9h28fobly7Q0NmAw7S49bZMOqYDm.S', NULL, '2', '0', '2023-12-13 23:15:52', '2023-12-13 23:15:52'),
(3, 'Malilipot Medical Officer', 'M2-1110003', 'malilipot-medicalofficer@gmail.com', NULL, NULL, '$2y$10$TIhe1wSZJHgzQBYw1SQkjux9fYDcPiS56zq4Mg/9UFTyBrFchMEMK', NULL, '2', '0', '2023-12-13 23:15:52', '2023-12-13 23:15:52'),
(4, 'Malinao Medical Officer', 'M2-1110004', 'malinao-medicalofficer@gmail.com', NULL, NULL, '$2y$10$JIl96A6XYfqkRATYCdSZZOLMgYefdWH6OUIQiV3wNq3cAgOPr9mfq', NULL, '2', '0', '2023-12-13 23:15:52', '2023-12-13 23:15:52'),
(5, 'Sto. Domingo Medical Officer', 'M2-1110005', 'sto..domingo-medicalofficer@gmail.com', NULL, NULL, '$2y$10$CL/xlgtacR6ws6YfQIR1o.Q/z/H3i0y7DdyvmFF8bD/uiCBT1/FZG', NULL, '2', '0', '2023-12-13 23:15:52', '2023-12-13 23:15:52'),
(6, 'Bacacay East Medical Officer', 'M2-1110006', 'bacacay.east-medicalofficer@gmail.com', NULL, NULL, '$2y$10$QTROpmyd2lUF1bSS1mVPFOCVdLcJEkypCOFxBnh2/.Mvrx9U3OEq6', NULL, '2', '0', '2023-12-13 23:15:52', '2023-12-13 23:15:52'),
(7, 'Bacacay West Medical Officer', 'M2-1110007', 'bacacay.west-medicalofficer@gmail.com', NULL, NULL, '$2y$10$uE8ngUKtHC98SZuztlHGkeYlDCAWBslnPBK9Kzu0YdfYM8gWInmk2', NULL, '2', '0', '2023-12-13 23:15:52', '2023-12-13 23:15:52'),
(8, 'Bacacay South Medical Officer', 'M2-1110008', 'bacacay.south-medicalofficer@gmail.com', NULL, NULL, '$2y$10$6xnsBXXUhwyOrRS3xnVriOx1JHvOPeuN4DK9bkiV0Q5qzhzPYqSxa', NULL, '2', '0', '2023-12-13 23:15:52', '2023-12-13 23:15:52'),
(9, 'Daraga North Medical Officer', 'M2-1110009', 'daraga.north-medicalofficer@gmail.com', NULL, NULL, '$2y$10$YsVaA9MLFtG5QXbI1VfnFuB7cj1fNbaWyg1n6g.P7HDza/RR5LL72', 'EaQxtCTDRdrQUIq7BdtFEMOoBCIjcr6tfgt5oPXvprzRH23CDHMBvyaAdT7h', '2', '0', '2023-12-13 23:15:52', '2023-12-13 23:15:52'),
(10, 'Daraga South Medical Officer', 'M2-1110010', 'daraga.south-medicalofficer@gmail.com', NULL, NULL, '$2y$10$6wIEAZ4Ll2rfaBAEQycHgO9AL.VFCmCLqkJ4PT7OYXPJKThFw8g6K', NULL, '2', '0', '2023-12-13 23:15:52', '2023-12-13 23:15:52'),
(11, 'Manito Medical Officer', 'M2-1110011', 'manito-medicalofficer@gmail.com', NULL, NULL, '$2y$10$q8C8TvchU8IZAhoEV1Bqd.vwkTRStIwcX6A4x1mc0MeYRmFObXClG', NULL, '2', '0', '2023-12-13 23:15:53', '2023-12-13 23:15:53'),
(12, 'Camalig North Medical Officer', 'M2-1110012', 'camalig.north-medicalofficer@gmail.com', NULL, NULL, '$2y$10$AL68pVqBr7i/kKs..VBLvutVuwFAnAiEwEOPXb6VH4mgboZbgaljK', NULL, '2', '0', '2023-12-13 23:15:53', '2023-12-13 23:15:53'),
(13, 'Camalig South Medical Officer', 'M2-1110013', 'camalig.south-medicalofficer@gmail.com', NULL, NULL, '$2y$10$toH6RhicKkTe.rgQxlNOn.4PO0a9gjwEFsrOn7WER4MHDDPQtu5HK', NULL, '2', '0', '2023-12-13 23:15:53', '2023-12-13 23:15:53'),
(14, 'Rapu-Rapu East Medical Officer', 'M2-1110014', 'rapu-rapu.east-medicalofficer@gmail.com', NULL, NULL, '$2y$10$Wmk8KHmVaBoSZZCD8w5eKu9ne4hPdrUt7xiWxDNw4ydDhj8QC/4Cm', NULL, '2', '0', '2023-12-13 23:15:53', '2023-12-13 23:15:53'),
(15, 'Rapu-Rapu West Medical Officer', 'M2-1110015', 'rapu-rapu.west-medicalofficer@gmail.com', NULL, NULL, '$2y$10$ddItZKnj1BsxN7ERHlLdxeXl.XtWB35MrZ94YIHu8TiywgGBoOMNG', NULL, '2', '0', '2023-12-13 23:15:53', '2023-12-13 23:15:53'),
(16, 'Jovellar Medical Officer', 'M2-1110016', 'jovellar-medicalofficer@gmail.com', NULL, NULL, '$2y$10$fZIyOOc1sh0q0UDuV8HV1OlcfafPcBuUe4kFUsCSztO/KgntB0uzm', NULL, '2', '0', '2023-12-13 23:15:53', '2023-12-13 23:15:53'),
(17, 'Guinobatan West Medical Officer', 'M2-1110017', 'guinobatan.west-medicalofficer@gmail.com', NULL, NULL, '$2y$10$PkFMZ0o31vTSrvtgwBc/MOyrY1Y7B.RzStOhth04ybX9xcbFanrQm', NULL, '2', '0', '2023-12-13 23:15:53', '2023-12-13 23:15:53'),
(18, 'Guinobatan East Medical Officer', 'M2-1110018', 'guinobatan.east-medicalofficer@gmail.com', NULL, NULL, '$2y$10$imOZBAoxYJ8lJNLc0fh0v.Lo1QogimklYEot9QwPt2HajENYibQmm', NULL, '2', '0', '2023-12-13 23:15:53', '2023-12-13 23:15:53'),
(19, 'Oas North Medical Officer', 'M2-1110019', 'oas.north-medicalofficer@gmail.com', NULL, NULL, '$2y$10$OG8lx//GzH73F/ZUEfUM3.TUmvbrl3jCqGqvedfXca7vIDqHpdbWq', NULL, '2', '0', '2023-12-13 23:15:53', '2023-12-13 23:15:53'),
(20, 'Oas South Medical Officer', 'M2-1110020', 'oas.south-medicalofficer@gmail.com', NULL, NULL, '$2y$10$GYru88FDX7sxEdQPt8Vfx.Kn0Xz8jb7PLwQFKQSdmgo/yb5FN58wO', NULL, '2', '0', '2023-12-13 23:15:53', '2023-12-13 23:15:53'),
(21, 'Polangui North Medical Officer', 'M2-1110021', 'polangui.north-medicalofficer@gmail.com', NULL, NULL, '$2y$10$zYMP5og1udm9uBLZq21MKeoxhcw6YLVl4jHwE7oRcCaIkKLuzCJMi', NULL, '2', '0', '2023-12-13 23:15:54', '2023-12-13 23:15:54'),
(22, 'Polangui South Medical Officer', 'M2-1110022', 'polangui.south-medicalofficer@gmail.com', NULL, NULL, '$2y$10$kpyS8w6B/OzYesPjqgq8Se50XtbRu/frvvTF9G2mud43F9F/zv3p.', NULL, '2', '0', '2023-12-13 23:15:54', '2023-12-13 23:15:54'),
(23, 'Libon West Medical Officer', 'M2-1110023', 'libon.west-medicalofficer@gmail.com', NULL, NULL, '$2y$10$rYeUSHnr4AM13Z9RCMdUCuRi75WRl1sAkmseIs1BlSQZewKz.sCQK', NULL, '2', '0', '2023-12-13 23:15:54', '2023-12-13 23:15:54'),
(24, 'Libon East Medical Officer', 'M2-1110024', 'libon.east-medicalofficer@gmail.com', NULL, NULL, '$2y$10$yU/3NxowmqvgXFgrqOd5meou.iGfsHE2aJqUM9oA4V64rUqJF9vfC', NULL, '2', '0', '2023-12-13 23:15:54', '2023-12-13 23:15:54'),
(25, 'Pioduran West Medical Officer', 'M2-1110025', 'pioduran.west-medicalofficer@gmail.com', NULL, NULL, '$2y$10$GUX1sk3JRRBEVbgiv4gZ2eZ7THmMjNv5NdT6UI4CVBsg46W8VY9J.', NULL, '2', '0', '2023-12-13 23:15:54', '2023-12-13 23:15:54'),
(26, 'Pioduran East Medical Officer', 'M2-1110026', 'pioduran.east-medicalofficer@gmail.com', NULL, NULL, '$2y$10$nqKbGpUi12ZtgzWUcM5iF.U527Ad/iCUv0ZHBlx6NgCJMbl.y4h4G', NULL, '2', '0', '2023-12-13 23:15:54', '2023-12-13 23:15:54'),
(27, 'Alcala ES School Nurse', 'S3-1110027', 'alcala.es-schoolnurse@gmail.com', NULL, NULL, '$2y$10$jkxefz.iMZ7EjRIOKgqXRej8ajUB5zcZbtR7KLHcfsxWGtdu7ISbi', 'jk024mfP0OphlEIKBaOjYYmYXRZ6e93qfpnwyAG6LLYdtOh3ZVsq4j5tqRZT', '3', '0', '2023-12-13 23:15:54', '2023-12-13 23:15:54'),
(28, 'Bagtang ES School Nurse', 'S3-1110028', 'bagtang.es-schoolnurse@gmail.com', NULL, NULL, '$2y$10$.z71oF.29E8SvH7I4dmMTOCLA4K0JnSjmKVsCT4tsBWJM0mQqyp3a', NULL, '3', '0', '2023-12-13 23:15:54', '2023-12-13 23:15:54'),
(29, 'Balinad ES School Nurse', 'S3-1110029', 'balinad.es-schoolnurse@gmail.com', NULL, NULL, '$2y$10$wCXuHtn0bRa.rpyEjshUDeYLy/glwCcmNdrqbPe5sGCE9OiuLyAPC', NULL, '3', '0', '2023-12-13 23:15:54', '2023-12-13 23:15:54'),
(30, 'Bañadero ES School Nurse', 'S3-1110030', 'bañadero.es-schoolnurse@gmail.com', NULL, NULL, '$2y$10$Ott8oKuXG3FTwm6aQHRDCO1ZeAiCpHcrfBfJH3fMuBsf/A8pLdYjC', NULL, '3', '0', '2023-12-13 23:15:54', '2023-12-13 23:15:54'),
(31, 'Bañag ES School Nurse', 'S3-1110031', 'bañag.es-schoolnurse@gmail.com', NULL, NULL, '$2y$10$XSorDhIIy9utzuhR1fLLjet4n3QfNjxF5EVBrfZ7lHpyPfIBosYlK', NULL, '3', '0', '2023-12-13 23:15:54', '2023-12-13 23:15:54'),
(32, 'Binitayan ES School Nurse', 'S3-1110032', 'binitayan.es-schoolnurse@gmail.com', NULL, NULL, '$2y$10$tG6lWrFO7EM2vspc69wgae5YveMrjfAkSZrcMQkXQ4SyG2HrzwjZ6', NULL, '3', '0', '2023-12-13 23:15:54', '2023-12-13 23:15:54'),
(33, 'Bongalon ES School Nurse', 'S3-1110033', 'bongalon.es-schoolnurse@gmail.com', NULL, NULL, '$2y$10$zXk4LVE/hLaGsyRYvubL0ex6weIls8hPn.MfPRd4ZIS/pII.Dj292', NULL, '3', '0', '2023-12-13 23:15:55', '2023-12-13 23:15:55'),
(34, 'Budiao ES School Nurse', 'S3-1110034', 'budiao.es-schoolnurse@gmail.com', NULL, NULL, '$2y$10$BVWjgWkD1OepXuNt0UTf1ec8UbOFwlrKh8dQYra6ndMF6RAPX6C6y', NULL, '3', '0', '2023-12-13 23:15:55', '2023-12-13 23:15:55'),
(35, 'Busay ES School Nurse', 'S3-1110035', 'busay.es-schoolnurse@gmail.com', NULL, NULL, '$2y$10$PGPowIGpurDsvNOrDXumJ.M/rDnFiYsr820rXnE0n/ch8OiA0Jp8C', NULL, '3', '0', '2023-12-13 23:15:55', '2023-12-13 23:15:55'),
(36, 'Cullat ES School Nurse', 'S3-1110036', 'cullat.es-schoolnurse@gmail.com', NULL, NULL, '$2y$10$DQXHEmxIxLmuhOPzncVOyOT5pBjDXJ2.PRv.jdJzDdXOmfnGN/ufW', NULL, '3', '0', '2023-12-13 23:15:55', '2023-12-13 23:15:55'),
(37, 'Daraga North School Nurse', 'S3-1110037', 'daraga.north-schoolnurse@gmail.com', NULL, NULL, '$2y$10$qoNhNzEPyAnNrhaxRkHTWeiqPSaItf9vRcBl8uddYuBVGSM2wuSYW', '0NGN0MULT3IoiYtEoHXKyGa3PUzX3SQ9nnwolDmW2tandoNKDlImPllkkqLu', '3', '0', '2023-12-13 23:15:55', '2023-12-13 23:15:55'),
(38, 'Impact LC School Nurse', 'S3-1110038', 'impact.lc-schoolnurse@gmail.com', NULL, NULL, '$2y$10$zSZD6a8M3gcuktYLHdaJneliYCmYjozaqYzepDHoh0HN/544Fh8rW', NULL, '3', '0', '2023-12-13 23:15:55', '2023-12-13 23:15:55'),
(39, 'Kidaco ES School Nurse', 'S3-1110039', 'kidaco.es-schoolnurse@gmail.com', NULL, NULL, '$2y$10$CSskxD0Dbl/xfGK.RPgrRuEdk3m24Q6.Rm01NXwtRnkiQtv4KhTda', NULL, '3', '0', '2023-12-13 23:15:55', '2023-12-13 23:15:55'),
(40, 'Kilicao ES School Nurse', 'S3-1110040', 'kilicao.es-schoolnurse@gmail.com', NULL, NULL, '$2y$10$VZtyoqL8TJFQFBJaz8u2gOf1wdueNJ3xI2Ay4UU8vyc35YySKKNIG', NULL, '3', '0', '2023-12-13 23:15:55', '2023-12-13 23:15:55'),
(41, 'Kiwalo ES School Nurse', 'S3-1110041', 'kiwalo.es-schoolnurse@gmail.com', NULL, NULL, '$2y$10$yv1tXRC78hKewfSvu0k4g.qRdkTDx8IJdv36MyHLVQ9JqtbsutDXK', NULL, '3', '0', '2023-12-13 23:15:55', '2023-12-13 23:15:55'),
(42, 'Malobago ES School Nurse', 'S3-1110042', 'malobago.es-schoolnurse@gmail.com', NULL, NULL, '$2y$10$GE75cw3r8qtt.NF6bocPGubHrr/PuPIzGGIT2/5AoZKSSlx1ahLtG', NULL, '3', '0', '2023-12-13 23:15:55', '2023-12-13 23:15:55'),
(43, 'Maroroy ES School Nurse', 'S3-1110043', 'maroroy.es-schoolnurse@gmail.com', NULL, NULL, '$2y$10$PTq8v7prNOcPYWQbnD9kMeZwtKcaJ6dcEdaSDxoE5QbV3evYGXkVe', NULL, '3', '0', '2023-12-13 23:15:55', '2023-12-13 23:15:55'),
(44, 'Matnog ES School Nurse', 'S3-1110044', 'matnog.es-schoolnurse@gmail.com', NULL, NULL, '$2y$10$Ol.0xgpl8pW7KFA1mf4AieXBOqBZeOO9/4ECNs3U06.dW8saAJ2aa', NULL, '3', '0', '2023-12-13 23:15:55', '2023-12-13 23:15:55'),
(45, 'Mi-isi ES School Nurse', 'S3-1110045', 'mi-isi.es-schoolnurse@gmail.com', NULL, NULL, '$2y$10$4l7/u.TR252odw4f9MP78OjNhN5MGIuigTEgOBUL9FjvRio1L.TFy', NULL, '3', '0', '2023-12-13 23:15:56', '2023-12-13 23:15:56'),
(46, 'Peñafrancia ES School Nurse', 'S3-1110046', 'peñafrancia.es-schoolnurse@gmail.com', NULL, NULL, '$2y$10$CwfikYpvjBo4Pwu.TQbApuyv0itEwexJE7opReFFbRPpeSE944GhG', NULL, '3', '0', '2023-12-13 23:15:56', '2023-12-13 23:15:56'),
(47, 'Tagas ES School Nurse', 'S3-1110047', 'tagas.es-schoolnurse@gmail.com', NULL, NULL, '$2y$10$ytaehb0OARR0hnnAMCzj9egDA0F0NgaNC0b2C6H249kAZLnKzACau', NULL, '3', '0', '2023-12-13 23:15:56', '2023-12-13 23:15:56'),
(48, 'Class Adviser', 'C4-9999999', 'classadviser@gmail.com', NULL, NULL, '$2y$10$BpMgh3zC/t4hNEYQ/J5CBuOy52aVQD9wC8sQp77eh8XuD.9VAsqHy', 'DvKWzvvCDPpeRkCiSSXiuKqXoZ1O3n7UWjOkviOsCMypiKmZknnEqOwyzTGQ', '4', '0', '2023-12-13 23:15:56', '2023-12-13 23:15:56'),
(49, 'DaragaNorthCS CA K1', 'C4-1110000', 'daraganorthcscak1@gmail.com', NULL, NULL, '$2y$10$kP31nlUrdmJ7AbEkHhUoxOhyRepdz70Bjq.Dg5DXB/dJmjMcQgXua', 'gD1hizyMNdtuuN8OOWxBhDzBvOCKEW4gA2dmpiPeR1BtUl4iS6nWjYv7eHDg', '4', '0', '2023-12-13 23:15:56', '2023-12-13 23:15:56'),
(50, 'DaragaNorthCS CA K2', 'C4-1110001', 'daraganorthcscak2@gmail.com', NULL, NULL, '$2y$10$jE2tGvB0i1x5z/V7ZJAqbuZwTUSZ3ZchIN2xfQ861L77e455oOgBq', NULL, '4', '0', '2023-12-13 23:15:56', '2023-12-13 23:15:56'),
(51, 'DaragaNorthCS CA K3', 'C4-1110002', 'daraganorthcscak3@gmail.com', NULL, NULL, '$2y$10$eRG.ikY0Vr2s6seSMh.MEerk39QHMk7HWTg2/7d1PQuh5YbIRS.G.', NULL, '4', '0', '2023-12-13 23:15:56', '2023-12-13 23:15:56'),
(52, 'DaragaNorthCS CA K4', 'C4-1110003', 'daraganorthcscak4@gmail.com', NULL, NULL, '$2y$10$XlrLE/wkxH2WkkrRmiLNueS3e9Wb4ptetmPHyb.BC1E8DCzvSP1oS', NULL, '4', '0', '2023-12-13 23:15:56', '2023-12-13 23:15:56'),
(53, 'DaragaNorthCS CA K5', 'C4-1110004', 'daraganorthcscak5@gmail.com', NULL, NULL, '$2y$10$HMK5cXlYsl.wlxAhC47JHumb1FIDow1Tmj1FBl6WLUMEn.brahFPq', NULL, '4', '0', '2023-12-13 23:15:56', '2023-12-13 23:15:56'),
(54, 'DaragaNorthCS CA K6', 'C4-1110005', 'daraganorthcscak6@gmail.com', NULL, NULL, '$2y$10$sGjbx87DqHYFEMWmRiaO6uXgq53M1bTgqfRlT0PcVyaYh.hdpQFda', NULL, '4', '0', '2023-12-13 23:15:56', '2023-12-13 23:15:56'),
(55, 'DaragaNorthCS CA K7', 'C4-1110006', 'daraganorthcscak7@gmail.com', NULL, NULL, '$2y$10$aacBVvZ6YM3d35exlsfZp.jS7QvCo4ZmzL1SzbgPSImnGkxBoDZBe', NULL, '4', '0', '2023-12-13 23:15:56', '2023-12-13 23:15:56'),
(56, 'DaragaNorthCS CA K8', 'C4-1110007', 'daraganorthcscak8@gmail.com', NULL, NULL, '$2y$10$ILXFeOmkQO5jmv2WBeDKbOn.1lFBTaeIZP0stz1GzyagA9UM/HMJ6', NULL, '4', '0', '2023-12-13 23:15:56', '2023-12-13 23:15:56'),
(57, 'DaragaNorthCS CA K9', 'C4-1110008', 'daraganorthcscak9@gmail.com', NULL, NULL, '$2y$10$Sb2XTmiP9M8sCCNQQonyY.gV3h4jHg8axcCYw1TXcHtnDrCK1vR36', NULL, '4', '0', '2023-12-13 23:15:57', '2023-12-13 23:15:57'),
(58, 'DaragaNorthCS CA K10', 'C4-1110009', 'daraganorthcscak10@gmail.com', NULL, NULL, '$2y$10$mbI.YUxPLK56SkfH3.Qu7uKmSqBgdfI5gpO/dqezAyzsrPoZabWD2', NULL, '4', '0', '2023-12-13 23:15:57', '2023-12-13 23:15:57'),
(59, 'DaragaNorthCS CA K11', 'C4-11100010', 'daraganorthcscak11@gmail.com', NULL, NULL, '$2y$10$9TgoBSNHpKCK4XQpegk//.iS14i.w5CwSZa9/yo3eWmcrX5I4QZye', NULL, '4', '0', '2023-12-13 23:15:57', '2023-12-13 23:15:57'),
(60, 'DaragaNorthCS CA K12', 'C4-11100011', 'daraganorthcscak12@gmail.com', NULL, NULL, '$2y$10$ICxbK5ddWhPDdLoCD/.yuOL3FfYhpYXs2fxbVkYqQ8He.GeaAMTom', NULL, '4', '0', '2023-12-13 23:15:57', '2023-12-13 23:15:57'),
(61, 'DaragaNorthCS CA K13', 'C4-11100012', 'daraganorthcscak13@gmail.com', NULL, NULL, '$2y$10$WsWIYbPROKrjj.UZ6jqQDeHV1cmCiEoFPIPggE7ITMHhC0GC/vSYi', NULL, '4', '0', '2023-12-13 23:15:57', '2023-12-13 23:15:57'),
(62, 'DaragaNorthCS CA K14', 'C4-11100013', 'daraganorthcscak14@gmail.com', NULL, NULL, '$2y$10$jBch7q5xKqT/.7TOo7r2m.M05TPw4r17vi/hNnyep8dihKNdpm9Rq', NULL, '4', '0', '2023-12-13 23:15:57', '2023-12-13 23:15:57'),
(63, 'DaragaNorthCS CA K15', 'C4-11100014', 'daraganorthcscak15@gmail.com', NULL, NULL, '$2y$10$keUIBuoK5KDi/vPUDapMz.A0.VPIGjL8FJBFXQOJuhM9zP/7kBBa6', NULL, '4', '0', '2023-12-13 23:15:57', '2023-12-13 23:15:57'),
(64, 'DaragaNorthCS CA G11', 'C4-11100117', 'daraganorthcscag11@gmail.com', NULL, NULL, '$2y$10$No8204FWqDJ/8u0D5I2ORejR8tnWOn0MUgGKSCo.lGJlWSiT51rk2', 'df4qfea6gJ1zI583p0VDXIyhmFKgRdA6tL24MawEg0ZegaVMoBvnGEAnAXgl', '4', '0', '2023-12-13 23:15:57', '2023-12-13 23:15:57'),
(65, 'DaragaNorthCS CA G12', 'C4-11100118', 'daraganorthcscag12@gmail.com', NULL, NULL, '$2y$10$tslqdM6ZT0oO.YWjDZ7ct.vFTNWLI9uWwPbby.PocOapOl0mKYhWK', NULL, '4', '0', '2023-12-13 23:15:57', '2023-12-13 23:15:57'),
(66, 'DaragaNorthCS CA G13', 'C4-11100119', 'daraganorthcscag13@gmail.com', NULL, NULL, '$2y$10$/QNXGGqrF8Q/gVshWi71B.DyVZs3fsOnHepTxqRmKMtNSGEo2QxWG', NULL, '4', '0', '2023-12-13 23:15:57', '2023-12-13 23:15:57'),
(67, 'DaragaNorthCS CA G14', 'C4-11100120', 'daraganorthcscag14@gmail.com', NULL, NULL, '$2y$10$ONOkWPlLfM5pNK482rVoouDh91IbJXrc5pryns.TC21sIi1xuErOq', NULL, '4', '0', '2023-12-13 23:15:57', '2023-12-13 23:15:57'),
(68, 'DaragaNorthCS CA G15', 'C4-11100121', 'daraganorthcscag15@gmail.com', NULL, NULL, '$2y$10$fO/UXHdDCmM43TqioCe6ReNkNDE7KMZB5O3grt5P.DvxGljyi28pq', NULL, '4', '0', '2023-12-13 23:15:58', '2023-12-13 23:15:58'),
(69, 'DaragaNorthCS CA G16', 'C4-11100122', 'daraganorthcscag16@gmail.com', NULL, NULL, '$2y$10$AhuFe2Hs1yctgG7WCovCjOPYw1uggBrVMF0zmQSHQeGc.SpxAKa7S', NULL, '4', '0', '2023-12-13 23:15:58', '2023-12-13 23:15:58'),
(70, 'DaragaNorthCS CA G17', 'C4-11100123', 'daraganorthcscag17@gmail.com', NULL, NULL, '$2y$10$ByhlvUCfeI4aryiSQ5E8we0/x.vEbKow0oKo/ByOA4S6VZkSh0JkG', NULL, '4', '0', '2023-12-13 23:15:58', '2023-12-13 23:15:58'),
(71, 'DaragaNorthCS CA G18', 'C4-11100124', 'daraganorthcscag18@gmail.com', NULL, NULL, '$2y$10$VyxKwSGlK3S9RPzXwJAleOczUQ4y5Gw5vznTLuFWyhkKomu63I742', NULL, '4', '0', '2023-12-13 23:15:58', '2023-12-13 23:15:58'),
(72, 'DaragaNorthCS CA G19', 'C4-11100125', 'daraganorthcscag19@gmail.com', NULL, NULL, '$2y$10$fV/yPTXTQObR6.N7Sv380uFe2S0oDgK2G64YzusBGzgxIhHIViZhq', NULL, '4', '0', '2023-12-13 23:15:58', '2023-12-13 23:15:58'),
(73, 'DaragaNorthCS CA G110', 'C4-11100126', 'daraganorthcscag110@gmail.com', NULL, NULL, '$2y$10$wnG.tBgqv0lWXqSKARQwuOC2ixA0xYUIociPhjcaoxHhmjXKgtaNi', NULL, '4', '0', '2023-12-13 23:15:58', '2023-12-13 23:15:58'),
(74, 'DaragaNorthCS CA G111', 'C4-11100127', 'daraganorthcscag111@gmail.com', NULL, NULL, '$2y$10$SDhH9tYKBErnTQFWjeD49uXLu4THpdxNh3x47d1XiglgB84qynpsq', NULL, '4', '0', '2023-12-13 23:15:58', '2023-12-13 23:15:58'),
(75, 'DaragaNorthCS CA G112', 'C4-11100128', 'daraganorthcscag112@gmail.com', NULL, NULL, '$2y$10$kywML/IYb7JIMokG5sFbbeQG8/rzZHrserMN6cpOu6A4vorNdv.8K', NULL, '4', '0', '2023-12-13 23:15:58', '2023-12-13 23:15:58'),
(76, 'DaragaNorthCS CA G113', 'C4-11100129', 'daraganorthcscag113@gmail.com', NULL, NULL, '$2y$10$p6os0I2zns9xbRHKjrwjmOD9Tip/7vvF/LxumlKzBG/qfBkOEfgAi', NULL, '4', '0', '2023-12-13 23:15:58', '2023-12-13 23:15:58'),
(77, 'DaragaNorthCS CA G114', 'C4-11100130', 'daraganorthcscag114@gmail.com', NULL, NULL, '$2y$10$7SkbTvkpF7ANMkFw.FeDROEzJalu8L.baAL/9271SbwayyBL8DUWq', NULL, '4', '0', '2023-12-13 23:15:58', '2023-12-13 23:15:58'),
(78, 'DaragaNorthCS CA G115', 'C4-11100131', 'daraganorthcscag115@gmail.com', NULL, NULL, '$2y$10$6pihaHXYAPG2Qv0Wp.V3jOX.qrr.Q8ttwwcH3VaL2rHnRVoZJvj0m', NULL, '4', '0', '2023-12-13 23:15:58', '2023-12-13 23:15:58'),
(79, 'DaragaNorthCS CA G21', 'C4-11100147', 'daraganorthcscag21@gmail.com', NULL, NULL, '$2y$10$vy2FQv45copLIzOHmx0p7.bmG5gt3/BPDatxQkilxDQl.K.JwHPGG', NULL, '4', '0', '2023-12-13 23:15:59', '2023-12-13 23:15:59'),
(80, 'DaragaNorthCS CA G22', 'C4-11100148', 'daraganorthcscag22@gmail.com', NULL, NULL, '$2y$10$JOmOYzZUZ.Uv1Qc/xgMAIeQSy.uUZy8n0rbwgkY0lrxSIg5jz6jhu', NULL, '4', '0', '2023-12-13 23:15:59', '2023-12-13 23:15:59'),
(81, 'DaragaNorthCS CA G23', 'C4-11100149', 'daraganorthcscag23@gmail.com', NULL, NULL, '$2y$10$7wwDpNSD.T.YtyXDEVeAOe2dkWvr8WYuHSEjZdze9iHNuWkMHAIS.', NULL, '4', '0', '2023-12-13 23:15:59', '2023-12-13 23:15:59'),
(82, 'DaragaNorthCS CA G24', 'C4-11100150', 'daraganorthcscag24@gmail.com', NULL, NULL, '$2y$10$pk8Lsj4Sm2aEB/C69Ntvwe1L/W7Z/YEwd7gfQYOmPwuw1Gv0Ng0WO', NULL, '4', '0', '2023-12-13 23:15:59', '2023-12-13 23:15:59'),
(83, 'DaragaNorthCS CA G25', 'C4-11100151', 'daraganorthcscag25@gmail.com', NULL, NULL, '$2y$10$B8lpdxgauX5pVb1GI3KX.OIucn33.L923n6GwciSyKUYZl1O2tKu.', NULL, '4', '0', '2023-12-13 23:15:59', '2023-12-13 23:15:59'),
(84, 'DaragaNorthCS CA G26', 'C4-11100152', 'daraganorthcscag26@gmail.com', NULL, NULL, '$2y$10$zmCK9rIsCc2F9WpuALvkTOkbFUe6xTk7dVHnBfr8.iDjwgARa8vfi', NULL, '4', '0', '2023-12-13 23:15:59', '2023-12-13 23:15:59'),
(85, 'DaragaNorthCS CA G27', 'C4-11100153', 'daraganorthcscag27@gmail.com', NULL, NULL, '$2y$10$zQ2VVS.OPOsdHEu6aVrzkuguH5rMW9.63qaJcTE0Gbdrd3Ke89Xv2', NULL, '4', '0', '2023-12-13 23:15:59', '2023-12-13 23:15:59'),
(86, 'DaragaNorthCS CA G28', 'C4-11100154', 'daraganorthcscag28@gmail.com', NULL, NULL, '$2y$10$9p4SSnIq.zAPWd0p8YNHCevV1INgz6IU5nP9BZiirAELtnhK/9ohS', NULL, '4', '0', '2023-12-13 23:15:59', '2023-12-13 23:15:59'),
(87, 'DaragaNorthCS CA G29', 'C4-11100155', 'daraganorthcscag29@gmail.com', NULL, NULL, '$2y$10$5ezCXUSP0rrPLkuTHdhlLeLJB/vDC7.b5kUfH5DXRPSO0amS6OT7K', NULL, '4', '0', '2023-12-13 23:15:59', '2023-12-13 23:15:59'),
(88, 'DaragaNorthCS CA G210', 'C4-11100156', 'daraganorthcscag210@gmail.com', NULL, NULL, '$2y$10$FK74Zr5LVov6/vpmELaUMOnWJBSYuDYMIz2t5V6ciFrmeUKUbx7oy', NULL, '4', '0', '2023-12-13 23:15:59', '2023-12-13 23:15:59'),
(89, 'DaragaNorthCS CA G211', 'C4-11100157', 'daraganorthcscag211@gmail.com', NULL, NULL, '$2y$10$QCSBzO.qkdZe7iGAOUACHOb.E6qwhjjRhCwXP52WsWECy0Ohi8mDK', NULL, '4', '0', '2023-12-13 23:15:59', '2023-12-13 23:15:59'),
(90, 'DaragaNorthCS CA G212', 'C4-11100158', 'daraganorthcscag212@gmail.com', NULL, NULL, '$2y$10$NyR.4yHBzO3uN8Vz5qnGwuZlWyHwm8Jj2tdfyLRVhF2Hy6Ohp2kxe', NULL, '4', '0', '2023-12-13 23:15:59', '2023-12-13 23:15:59'),
(91, 'DaragaNorthCS CA G213', 'C4-11100159', 'daraganorthcscag213@gmail.com', NULL, NULL, '$2y$10$US70KK1S3NKf7gfrFwZI0eEWk/G5dnacggrNLa8foAAGXpfD.wV6W', NULL, '4', '0', '2023-12-13 23:15:59', '2023-12-13 23:15:59'),
(92, 'DaragaNorthCS CA G214', 'C4-11100160', 'daraganorthcscag214@gmail.com', NULL, NULL, '$2y$10$sApO8WiOQpBKRMg5gBBMWup1uGb49zej/Vh0iHsXaoKaF.glsztjm', NULL, '4', '0', '2023-12-13 23:16:00', '2023-12-13 23:16:00'),
(93, 'DaragaNorthCS CA G215', 'C4-11100161', 'daraganorthcscag215@gmail.com', NULL, NULL, '$2y$10$WAf38Hh1dk4NV4tLeFh0cOAtwekdBTAAT.A5JpAIMDx6mrY0LeS.e', NULL, '4', '0', '2023-12-13 23:16:00', '2023-12-13 23:16:00'),
(94, 'DaragaNorthCS CA G31', 'C4-11100177', 'daraganorthcscag31@gmail.com', NULL, NULL, '$2y$10$csuTRCDiAJMqC2Sow8Rcy.0MoYTosADVcd33FbxcB8mk51inVIP42', NULL, '4', '0', '2023-12-13 23:16:00', '2023-12-13 23:16:00'),
(95, 'DaragaNorthCS CA G32', 'C4-11100178', 'daraganorthcscag32@gmail.com', NULL, NULL, '$2y$10$.u1Q6Acn8ptU1lTKD66XV.MMy.JjX8DvW3s7/Y4H789yFs5FOeTKS', NULL, '4', '0', '2023-12-13 23:16:00', '2023-12-13 23:16:00'),
(96, 'DaragaNorthCS CA G33', 'C4-11100179', 'daraganorthcscag33@gmail.com', NULL, NULL, '$2y$10$BeyalN39EM7oT3gmLH8C2O7Ch3bZMhtupL41ymOiOEHTBHjjmIi4.', NULL, '4', '0', '2023-12-13 23:16:00', '2023-12-13 23:16:00'),
(97, 'DaragaNorthCS CA G34', 'C4-11100180', 'daraganorthcscag34@gmail.com', NULL, NULL, '$2y$10$iBJOrjQzO2f.76Bqy3F53.Hx/eTQvBUXxJaXU3GsGbKi/r9H8CLZC', NULL, '4', '0', '2023-12-13 23:16:00', '2023-12-13 23:16:00'),
(98, 'DaragaNorthCS CA G35', 'C4-11100181', 'daraganorthcscag35@gmail.com', NULL, NULL, '$2y$10$OHgMdpxPDsyCrwOzkn9XruKkLXEgNJQQ9C0crXzL2y8kQEvy1k7KG', NULL, '4', '0', '2023-12-13 23:16:00', '2023-12-13 23:16:00'),
(99, 'DaragaNorthCS CA G36', 'C4-11100182', 'daraganorthcscag36@gmail.com', NULL, NULL, '$2y$10$I.Zu/va/l2vq/vFtnALLZulhoiD4SoVilikyI1XlLH8GjKp86MOR2', NULL, '4', '0', '2023-12-13 23:16:00', '2023-12-13 23:16:00'),
(100, 'DaragaNorthCS CA G37', 'C4-11100183', 'daraganorthcscag37@gmail.com', NULL, NULL, '$2y$10$JswePews5NuX.4cNGM.StOI4Z8DmOxLE7zKRLVksgYUPypBoagsvy', NULL, '4', '0', '2023-12-13 23:16:00', '2023-12-13 23:16:00'),
(101, 'DaragaNorthCS CA G38', 'C4-11100184', 'daraganorthcscag38@gmail.com', NULL, NULL, '$2y$10$Ofv.e4LI1Jtfkt/7RVtPyuFAsOpnCFIhPEU4raqOaQZKez/x5E0Qe', NULL, '4', '0', '2023-12-13 23:16:00', '2023-12-13 23:16:00'),
(102, 'DaragaNorthCS CA G39', 'C4-11100185', 'daraganorthcscag39@gmail.com', NULL, NULL, '$2y$10$GAQOpFXM3uMND1xrdDSSY.aWuE7DfH.Lr4jVMa1uM16b4wz5oo1.q', NULL, '4', '0', '2023-12-13 23:16:00', '2023-12-13 23:16:00'),
(103, 'DaragaNorthCS CA G310', 'C4-11100186', 'daraganorthcscag310@gmail.com', NULL, NULL, '$2y$10$uFlH1w0eGUasKPLX4oddL.IAYfjhG6wFQhrB1ZPCRGR8QGT96/G82', NULL, '4', '0', '2023-12-13 23:16:01', '2023-12-13 23:16:01'),
(104, 'DaragaNorthCS CA G311', 'C4-11100187', 'daraganorthcscag311@gmail.com', NULL, NULL, '$2y$10$l.HBKxHq8dZi3soDWSYCP.HQq2n4NcUG/mq5ZjZ/33pTZWlGglbN6', NULL, '4', '0', '2023-12-13 23:16:01', '2023-12-13 23:16:01'),
(105, 'DaragaNorthCS CA G312', 'C4-11100188', 'daraganorthcscag312@gmail.com', NULL, NULL, '$2y$10$0C7onz1X5KqsycUBI2ShxuUXubCmBB7gCFuCc1TTWP39.mvToPquu', NULL, '4', '0', '2023-12-13 23:16:01', '2023-12-13 23:16:01'),
(106, 'DaragaNorthCS CA G313', 'C4-11100189', 'daraganorthcscag313@gmail.com', NULL, NULL, '$2y$10$WIlhMX1PiU0X6i0w4SsTI.sPxDgvLk8.ieQKfBxQYQo8kK8AC.sWm', NULL, '4', '0', '2023-12-13 23:16:01', '2023-12-13 23:16:01'),
(107, 'DaragaNorthCS CA G314', 'C4-11100190', 'daraganorthcscag314@gmail.com', NULL, NULL, '$2y$10$APPWkHb6Z98tEqY07l3UdukjXwjghJaBKG3GkduO.KFDDmHWLi/E6', NULL, '4', '0', '2023-12-13 23:16:01', '2023-12-13 23:16:01'),
(108, 'DaragaNorthCS CA G315', 'C4-11100191', 'daraganorthcscag315@gmail.com', NULL, NULL, '$2y$10$4ociG2yr2MWZ4J0eOuXvu.KOAlpnll9GmDLdmryzkTaG7Zz.WjgrC', NULL, '4', '0', '2023-12-13 23:16:01', '2023-12-13 23:16:01'),
(109, 'DaragaNorthCS CA G41', 'C4-111001107', 'daraganorthcscag41@gmail.com', NULL, NULL, '$2y$10$iMxBJjM5jBaV9zokYxltguhNCv5Eo5SNkXKlMVTgHXXhG4PwNdKju', NULL, '4', '0', '2023-12-13 23:16:01', '2023-12-13 23:16:01'),
(110, 'DaragaNorthCS CA G42', 'C4-111001108', 'daraganorthcscag42@gmail.com', NULL, NULL, '$2y$10$ZAbELd3pPe3WV/TmouoxvOkMhdraj4KypvDYTp4.bKtAAnj3o6.Xi', NULL, '4', '0', '2023-12-13 23:16:01', '2023-12-13 23:16:01'),
(111, 'DaragaNorthCS CA G43', 'C4-111001109', 'daraganorthcscag43@gmail.com', NULL, NULL, '$2y$10$jUQcTTXu74m8JvCCJuB4fOFohofbBlPFXZXp23uZoltC3DYlf0382', NULL, '4', '0', '2023-12-13 23:16:01', '2023-12-13 23:16:01'),
(112, 'DaragaNorthCS CA G44', 'C4-111001110', 'daraganorthcscag44@gmail.com', NULL, NULL, '$2y$10$CvQnx3WwnPCESzDa5p6hgevZHBdIkcXcYTmSM/d/OyiT3UcOrzCmi', NULL, '4', '0', '2023-12-13 23:16:01', '2023-12-13 23:16:01'),
(113, 'DaragaNorthCS CA G45', 'C4-111001111', 'daraganorthcscag45@gmail.com', NULL, NULL, '$2y$10$5ruZ/1YaibgR9ALeiO26EeKW8U1xfl5PUXuoBsZTTT.GzI2Hp/KZ2', NULL, '4', '0', '2023-12-13 23:16:01', '2023-12-13 23:16:01'),
(114, 'DaragaNorthCS CA G46', 'C4-111001112', 'daraganorthcscag46@gmail.com', NULL, NULL, '$2y$10$ihlv72hh0hjBKsdIeIC5dOandn0gnwxrHVYT.aNexJZw32xoKqcN2', NULL, '4', '0', '2023-12-13 23:16:01', '2023-12-13 23:16:01'),
(115, 'DaragaNorthCS CA G47', 'C4-111001113', 'daraganorthcscag47@gmail.com', NULL, NULL, '$2y$10$wsnwIhxmi.hdN8Jru8pFVOloTeZLm3pvCRMWTbix1xddJFamEUC9K', NULL, '4', '0', '2023-12-13 23:16:02', '2023-12-13 23:16:02'),
(116, 'DaragaNorthCS CA G48', 'C4-111001114', 'daraganorthcscag48@gmail.com', NULL, NULL, '$2y$10$CQYBpemyOfme5hOeeGEKFOlwyK5EBql7xvAigQ3aeBkvW.pTBrmuq', NULL, '4', '0', '2023-12-13 23:16:02', '2023-12-13 23:16:02'),
(117, 'DaragaNorthCS CA G49', 'C4-111001115', 'daraganorthcscag49@gmail.com', NULL, NULL, '$2y$10$5ezgh3o./WmMY0VWVWuPv.G1W8zqzEHSkdPdMmyMhoY1lwfHZMUBq', NULL, '4', '0', '2023-12-13 23:16:02', '2023-12-13 23:16:02'),
(118, 'DaragaNorthCS CA G410', 'C4-111001116', 'daraganorthcscag410@gmail.com', NULL, NULL, '$2y$10$p3gaLp6jcKwbPsNYXbOLZeyHdsjhB1y18WCRiKxNtBDJhUztLu9tu', NULL, '4', '0', '2023-12-13 23:16:02', '2023-12-13 23:16:02'),
(119, 'DaragaNorthCS CA G411', 'C4-111001117', 'daraganorthcscag411@gmail.com', NULL, NULL, '$2y$10$HvA1B0RXtOWcFvVjQf0otOVRT8qtTHLdwO7jeyOcrV7lFBTwvmO6G', NULL, '4', '0', '2023-12-13 23:16:02', '2023-12-13 23:16:02'),
(120, 'DaragaNorthCS CA G412', 'C4-111001118', 'daraganorthcscag412@gmail.com', NULL, NULL, '$2y$10$y673cTO32y8xCWoWOj6OZ.MZiQrMeupY2Dlz50W330C2kQP3sZqr2', NULL, '4', '0', '2023-12-13 23:16:02', '2023-12-13 23:16:02'),
(121, 'DaragaNorthCS CA G413', 'C4-111001119', 'daraganorthcscag413@gmail.com', NULL, NULL, '$2y$10$sVpsG1u7sNaKZLbF.aUkY.TYnAD452DtaScFfCveRboFX31IZ494K', NULL, '4', '0', '2023-12-13 23:16:02', '2023-12-13 23:16:02'),
(122, 'DaragaNorthCS CA G414', 'C4-111001120', 'daraganorthcscag414@gmail.com', NULL, NULL, '$2y$10$zj42cbV/v1nMU2Yfgq9bO.zqtj3IzSPiN2m52NMdRlRPzMJqecYOa', NULL, '4', '0', '2023-12-13 23:16:02', '2023-12-13 23:16:02'),
(123, 'DaragaNorthCS CA G415', 'C4-111001121', 'daraganorthcscag415@gmail.com', NULL, NULL, '$2y$10$ZFdveC3bF75zaiNwUbKbr.10eQpZZ5oevzCqu2UfOWcoLDu17lWeq', NULL, '4', '0', '2023-12-13 23:16:02', '2023-12-13 23:16:02'),
(124, 'DaragaNorthCS CA G51', 'C4-111001137', 'daraganorthcscag51@gmail.com', NULL, NULL, '$2y$10$93DG2PeVdx/iTzRMVP76Ie755KE5hN55IPqzMKeltOEsYMO/7tvxm', NULL, '4', '0', '2023-12-13 23:16:02', '2023-12-13 23:16:02'),
(125, 'DaragaNorthCS CA G52', 'C4-111001138', 'daraganorthcscag52@gmail.com', NULL, NULL, '$2y$10$y.IoUXrThUgodY5AFJVGFO3DoLDoDxA.YGLlOZTENx.dtJ3CGNQaK', NULL, '4', '0', '2023-12-13 23:16:02', '2023-12-13 23:16:02'),
(126, 'DaragaNorthCS CA G53', 'C4-111001139', 'daraganorthcscag53@gmail.com', NULL, NULL, '$2y$10$trn/ligdvl300BUTx5zm2evyGvHC5nOjlOwmun7yYWHDlCuX4bpnG', NULL, '4', '0', '2023-12-13 23:16:03', '2023-12-13 23:16:03'),
(127, 'DaragaNorthCS CA G54', 'C4-111001140', 'daraganorthcscag54@gmail.com', NULL, NULL, '$2y$10$Y2N6wA1CsBkIS/7/iPmVae2vd.nvNK3fvA2N6WkZ4GgZCZAN/VA/K', NULL, '4', '0', '2023-12-13 23:16:03', '2023-12-13 23:16:03'),
(128, 'DaragaNorthCS CA G55', 'C4-111001141', 'daraganorthcscag55@gmail.com', NULL, NULL, '$2y$10$ddwpmbnd//IQky8RvwlLd.z0Tz3M6.3rfzrLJIIDUSsg7hfGqzC/y', NULL, '4', '0', '2023-12-13 23:16:03', '2023-12-13 23:16:03'),
(129, 'DaragaNorthCS CA G56', 'C4-111001142', 'daraganorthcscag56@gmail.com', NULL, NULL, '$2y$10$FuG.hajMkJH/BcjGNDI4f.VHJ9j7lHg8iXhxxJKXols4Z08M3n9be', NULL, '4', '0', '2023-12-13 23:16:03', '2023-12-13 23:16:03'),
(130, 'DaragaNorthCS CA G57', 'C4-111001143', 'daraganorthcscag57@gmail.com', NULL, NULL, '$2y$10$hR5V2sGiqpCiSy9y2HnV9uV31ez.sKt9fLB0NWitujqwbzblLMgCW', NULL, '4', '0', '2023-12-13 23:16:03', '2023-12-13 23:16:03'),
(131, 'DaragaNorthCS CA G58', 'C4-111001144', 'daraganorthcscag58@gmail.com', NULL, NULL, '$2y$10$L/GjXWDFd5RTiHMzuIVAwOCVmrkZ2Jftz.FxZjWkK6u4Uv1MC5Hta', NULL, '4', '0', '2023-12-13 23:16:03', '2023-12-13 23:16:03'),
(132, 'DaragaNorthCS CA G59', 'C4-111001145', 'daraganorthcscag59@gmail.com', NULL, NULL, '$2y$10$Z1BOVe/4znEFOUlF1nThSe085Lis9piZxqj6BN5vpw9nGHQytmcru', NULL, '4', '0', '2023-12-13 23:16:03', '2023-12-13 23:16:03'),
(133, 'DaragaNorthCS CA G510', 'C4-111001146', 'daraganorthcscag510@gmail.com', NULL, NULL, '$2y$10$1sFjdXqGGZlNW8L3iKUmFOFilxnK8VfbU3LiyIJX.LHryCamh4kHG', NULL, '4', '0', '2023-12-13 23:16:03', '2023-12-13 23:16:03'),
(134, 'DaragaNorthCS CA G511', 'C4-111001147', 'daraganorthcscag511@gmail.com', NULL, NULL, '$2y$10$lU71R8zuM9AUfi.3CnJP3.5/umoOMZ2.YM7o/OiEBKM8NrzEUYGza', NULL, '4', '0', '2023-12-13 23:16:03', '2023-12-13 23:16:03'),
(135, 'DaragaNorthCS CA G512', 'C4-111001148', 'daraganorthcscag512@gmail.com', NULL, NULL, '$2y$10$jHw6XmXT/I5JqkKTWcp1h.zAOwv1yz4vAysk42vFoV08zYA2dInKq', NULL, '4', '0', '2023-12-13 23:16:03', '2023-12-13 23:16:03'),
(136, 'DaragaNorthCS CA G513', 'C4-111001149', 'daraganorthcscag513@gmail.com', NULL, NULL, '$2y$10$Igg7xi5UOPb0Y.LvyAfN2eVObGUu4vbKOkorM.JoTyIyBOVBC6cIC', NULL, '4', '0', '2023-12-13 23:16:03', '2023-12-13 23:16:03'),
(137, 'DaragaNorthCS CA G514', 'C4-111001150', 'daraganorthcscag514@gmail.com', NULL, NULL, '$2y$10$kbOKFaUHQiwE0eM/XLAdtucVwmojAb5os/bgG61OHLtctdiUR6Ejq', NULL, '4', '0', '2023-12-13 23:16:04', '2023-12-13 23:16:04'),
(138, 'DaragaNorthCS CA G515', 'C4-111001151', 'daraganorthcscag515@gmail.com', NULL, NULL, '$2y$10$SZAD68K704oq1YXYOZa6tepiklqVg/SIO2VN7bhMm.bixlcb6OGLK', NULL, '4', '0', '2023-12-13 23:16:04', '2023-12-13 23:16:04'),
(139, 'DaragaNorthCS CA G61', 'C4-111001167', 'daraganorthcscag61@gmail.com', NULL, NULL, '$2y$10$KPYdYus7ThfITk6C9S/JJ./dAdVViWZ68AhfjxEEi4rhJu5/jJ.NS', NULL, '4', '0', '2023-12-13 23:16:04', '2023-12-13 23:16:04'),
(140, 'DaragaNorthCS CA G62', 'C4-111001168', 'daraganorthcscag62@gmail.com', NULL, NULL, '$2y$10$PwCKEgVBffMMy/CtqAOyje0N17QVvsAGILmbVYuY07xmbs3m/NT8u', NULL, '4', '0', '2023-12-13 23:16:04', '2023-12-13 23:16:04'),
(141, 'DaragaNorthCS CA G63', 'C4-111001169', 'daraganorthcscag63@gmail.com', NULL, NULL, '$2y$10$IMxiy8UL9yCoDO5OQAueMujL1/J6LXU4eWw5BO.658KMDZ1NnhWla', NULL, '4', '0', '2023-12-13 23:16:04', '2023-12-13 23:16:04'),
(142, 'DaragaNorthCS CA G64', 'C4-111001170', 'daraganorthcscag64@gmail.com', NULL, NULL, '$2y$10$CZSaSqvNskjtI/FPhAzcx.2NsIaAwhQojA8b.2EF2byu7TrkuwxRG', NULL, '4', '0', '2023-12-13 23:16:04', '2023-12-13 23:16:04'),
(143, 'DaragaNorthCS CA G65', 'C4-111001171', 'daraganorthcscag65@gmail.com', NULL, NULL, '$2y$10$XZFCMPoblhcUdhkI1SIFIevHOqIoGg/QrOiiDNWb.3BVJocHOGtNi', NULL, '4', '0', '2023-12-13 23:16:04', '2023-12-13 23:16:04'),
(144, 'DaragaNorthCS CA G66', 'C4-111001172', 'daraganorthcscag66@gmail.com', NULL, NULL, '$2y$10$PUaZEN1S4eCv6Vs/UqgtzOc6CMPKBcamLkhf84Q.KKd8427uAyxa6', NULL, '4', '0', '2023-12-13 23:16:04', '2023-12-13 23:16:04'),
(145, 'DaragaNorthCS CA G67', 'C4-111001173', 'daraganorthcscag67@gmail.com', NULL, NULL, '$2y$10$wEP7MZMj.rhbL6EUwF8SIOZ1PbuXe0dT9XCAYJ08qp88zZq34mPYK', NULL, '4', '0', '2023-12-13 23:16:04', '2023-12-13 23:16:04'),
(146, 'DaragaNorthCS CA G68', 'C4-111001174', 'daraganorthcscag68@gmail.com', NULL, NULL, '$2y$10$myzG5ut0PAsBdjeGStAC6e7.od7EJjHMhj.r91KDHtQwzjjYHDGpa', NULL, '4', '0', '2023-12-13 23:16:04', '2023-12-13 23:16:04'),
(147, 'DaragaNorthCS CA G69', 'C4-111001175', 'daraganorthcscag69@gmail.com', NULL, NULL, '$2y$10$aDHPYapecHH3n5VpdDL.Le/uKnd4zfRUEcOgCa31dBsfj0ugIFMcC', NULL, '4', '0', '2023-12-13 23:16:04', '2023-12-13 23:16:04'),
(148, 'DaragaNorthCS CA G610', 'C4-111001176', 'daraganorthcscag610@gmail.com', NULL, NULL, '$2y$10$xSCyl3dN63x/kGGNFAqMReS.IxoGCjxM3SF8.nUzeAaxcMXDd..Tm', NULL, '4', '0', '2023-12-13 23:16:04', '2023-12-13 23:16:04'),
(149, 'DaragaNorthCS CA G611', 'C4-111001177', 'daraganorthcscag611@gmail.com', NULL, NULL, '$2y$10$nIgYwrgexcVJQZGEMVDowu.R0RQ5ws1wEd0bqYDjspAJiznxyzvWq', NULL, '4', '0', '2023-12-13 23:16:04', '2023-12-13 23:16:04'),
(150, 'DaragaNorthCS CA G612', 'C4-111001178', 'daraganorthcscag612@gmail.com', NULL, NULL, '$2y$10$9oWbFIqpXyHk7OmG7Uy9IupRLdMBAedc73FHLGsS1Ge1vwPLFLQC2', NULL, '4', '0', '2023-12-13 23:16:05', '2023-12-13 23:16:05'),
(151, 'DaragaNorthCS CA G613', 'C4-111001179', 'daraganorthcscag613@gmail.com', NULL, NULL, '$2y$10$HjaKR6nr3nS599nIpQGqve1PI59BMucHBK6fvGEqzBvKqBMnHhyz.', NULL, '4', '0', '2023-12-13 23:16:05', '2023-12-13 23:16:05'),
(152, 'DaragaNorthCS CA G614', 'C4-111001180', 'daraganorthcscag614@gmail.com', NULL, NULL, '$2y$10$6or6UndnHwWHceOiHnTT1uIzMwO0npO4mc.i7azgIfub.o22/ekEq', NULL, '4', '0', '2023-12-13 23:16:05', '2023-12-13 23:16:05'),
(153, 'DaragaNorthCS CA G615', 'C4-111001181', 'daraganorthcscag615@gmail.com', NULL, NULL, '$2y$10$q3R9aoYcTxmOKtvxr1QSU.0R9uOz0IxC/yWqMIfO0iHUgAC8Iki2y', NULL, '4', '0', '2023-12-13 23:16:05', '2023-12-13 23:16:05'),
(154, 'BinitayanES CA K1', 'C4-1110970', 'binitayanescak1@gmail.com', NULL, NULL, '$2y$10$HjQqd6TrTI6MkeJiDMbEj.DwfEYtMXGEXz5POc1n4E1gWYxFo/31S', NULL, '4', '0', '2023-12-13 23:16:05', '2023-12-13 23:16:05'),
(155, 'BinitayanES CA K2', 'C4-1110971', 'binitayanescak2@gmail.com', NULL, NULL, '$2y$10$FAAVw.RfRNpssKJdjHFRYOuBd5I0a75msyKdBQQJgmu5zWa9Z5FOa', NULL, '4', '0', '2023-12-13 23:16:05', '2023-12-13 23:16:05'),
(156, 'BinitayanES CA K3', 'C4-1110972', 'binitayanescak3@gmail.com', NULL, NULL, '$2y$10$hAgi4WHHGTnynJc1n5kREuEqW6ksLFdII7vRvy4pgzxIp0GO5sx1u', NULL, '4', '0', '2023-12-13 23:16:05', '2023-12-13 23:16:05'),
(157, 'BinitayanES CA K4', 'C4-1110973', 'binitayanescak4@gmail.com', NULL, NULL, '$2y$10$XxKCJ9vx/q8w3SOpF6yl/eKEQQIRvF0RJdgqaXAmIuz7r6/o4gn3e', NULL, '4', '0', '2023-12-13 23:16:05', '2023-12-13 23:16:05'),
(158, 'BinitayanES CA K5', 'C4-1110974', 'binitayanescak5@gmail.com', NULL, NULL, '$2y$10$GW6aIrEsdz2/O4DyAmItv.xA5AtnNabcGpSFnuhjqtFnzflavE6BW', NULL, '4', '0', '2023-12-13 23:16:05', '2023-12-13 23:16:05'),
(159, 'BinitayanES CA K6', 'C4-1110975', 'binitayanescak6@gmail.com', NULL, NULL, '$2y$10$abyWvlgs1.Lv6BpfwZxzx.iDZufWnAJ4z9/Vxrr0Fn5Ox3nMtMpJa', NULL, '4', '0', '2023-12-13 23:16:05', '2023-12-13 23:16:05'),
(160, 'BinitayanES CA K7', 'C4-1110976', 'binitayanescak7@gmail.com', NULL, NULL, '$2y$10$5FAXhSKU.9ysERaVvvp/W.ThwQyt1nk1ZemZpZ5nScXeeKw3sDj7O', NULL, '4', '0', '2023-12-13 23:16:05', '2023-12-13 23:16:05'),
(161, 'BinitayanES CA K8', 'C4-1110977', 'binitayanescak8@gmail.com', NULL, NULL, '$2y$10$lTtEiQndkXa3TFiqUvrzEOK7vdBjvCIN1I9kOROaMKkWFaTW.ikoW', NULL, '4', '0', '2023-12-13 23:16:06', '2023-12-13 23:16:06'),
(162, 'BinitayanES CA K9', 'C4-1110978', 'binitayanescak9@gmail.com', NULL, NULL, '$2y$10$.dmzyh9i7J83Pb/OVR7aOOTxsjv5TiA0DSCCAqFfbkJ5PWj5BfDTy', NULL, '4', '0', '2023-12-13 23:16:06', '2023-12-13 23:16:06'),
(163, 'BinitayanES CA K10', 'C4-1110979', 'binitayanescak10@gmail.com', NULL, NULL, '$2y$10$QYhS2x4Jd7xtDFIv.8BIuufdOU3pZSVU6MSJku1XCxY76VWn3UFXy', NULL, '4', '0', '2023-12-13 23:16:06', '2023-12-13 23:16:06'),
(164, 'BinitayanES CA K11', 'C4-11109710', 'binitayanescak11@gmail.com', NULL, NULL, '$2y$10$sT.73DCX/5OUuPp1/jB1Mu3ZaYXPjqWmz7OZREMx9ABenPXbhwuyu', NULL, '4', '0', '2023-12-13 23:16:06', '2023-12-13 23:16:06'),
(165, 'BinitayanES CA K12', 'C4-11109711', 'binitayanescak12@gmail.com', NULL, NULL, '$2y$10$2QIbiPs4XXDEZtk4WV1Z0OY2i2bSPX.N2Zy7YYPLb1AqoI6FLW54i', NULL, '4', '0', '2023-12-13 23:16:06', '2023-12-13 23:16:06'),
(166, 'BinitayanES CA K13', 'C4-11109712', 'binitayanescak13@gmail.com', NULL, NULL, '$2y$10$qF8OM/vAePiMVQHPUp83C.mTRvjCpJ8lwfCZ06gpx9LLwd5C.NY0G', NULL, '4', '0', '2023-12-13 23:16:06', '2023-12-13 23:16:06'),
(167, 'BinitayanES CA K14', 'C4-11109713', 'binitayanescak14@gmail.com', NULL, NULL, '$2y$10$H2EwQBlwyFyoLgFarDuKqOkGsb5FySVw5eofZ2mMLUo9cTNmMPo.S', NULL, '4', '0', '2023-12-13 23:16:06', '2023-12-13 23:16:06'),
(168, 'BinitayanES CA K15', 'C4-11109714', 'binitayanescak15@gmail.com', NULL, NULL, '$2y$10$k1KipHEKaun8woWwoOlkVOjYtj.l3DRNmCd1cLCeRv9kQtakalsJm', NULL, '4', '0', '2023-12-13 23:16:06', '2023-12-13 23:16:06'),
(169, 'DaragaNorthCS CA G11', 'C4-111127113', 'binitayanescag11@gmail.com', NULL, NULL, '$2y$10$aa6nxRkbQ/mP.87cDnIa2O3uhDxOYBsEwg/SulCqrmI.xKZ0sE74K', NULL, '4', '0', '2023-12-13 23:16:06', '2023-12-13 23:16:06'),
(170, 'DaragaNorthCS CA G12', 'C4-111127114', 'binitayanescag12@gmail.com', NULL, NULL, '$2y$10$tTEsgHLB6NTherMhwkqLNuPXqk.3Vom5H62ZgHSMuiLTHzN6HiIRe', NULL, '4', '0', '2023-12-13 23:16:06', '2023-12-13 23:16:06'),
(171, 'DaragaNorthCS CA G13', 'C4-111127115', 'binitayanescag13@gmail.com', NULL, NULL, '$2y$10$XbfhVTcHjp8i1SzegeC86OUyy8KaMFzD9bxy80NoOUIb65d/xn6h2', NULL, '4', '0', '2023-12-13 23:16:06', '2023-12-13 23:16:06'),
(172, 'DaragaNorthCS CA G14', 'C4-111127116', 'binitayanescag14@gmail.com', NULL, NULL, '$2y$10$Urc/pkGAWIIVCfO4.6m4QutWj0pOUU0DcD/duVkKpUX65WHkmLdBK', NULL, '4', '0', '2023-12-13 23:16:07', '2023-12-13 23:16:07'),
(173, 'DaragaNorthCS CA G15', 'C4-111127117', 'binitayanescag15@gmail.com', NULL, NULL, '$2y$10$40idBe/wANdBCz3Lv5xrzehL9hexABEStKf.mOJDqxrQLba0vuFYy', NULL, '4', '0', '2023-12-13 23:16:07', '2023-12-13 23:16:07'),
(174, 'DaragaNorthCS CA G16', 'C4-111127118', 'binitayanescag16@gmail.com', NULL, NULL, '$2y$10$K6kiXT/S0F0QT6dbbelpLO6wnCzSqoxtUsorlzq5UkC/np.pYwHmG', NULL, '4', '0', '2023-12-13 23:16:07', '2023-12-13 23:16:07'),
(175, 'DaragaNorthCS CA G17', 'C4-111127119', 'binitayanescag17@gmail.com', NULL, NULL, '$2y$10$MonXiYxSr7CxhTRTf1TwrOvXvYJxaAwRvvd/GbYhbGTrjEynvEAVG', NULL, '4', '0', '2023-12-13 23:16:07', '2023-12-13 23:16:07'),
(176, 'DaragaNorthCS CA G18', 'C4-111127120', 'binitayanescag18@gmail.com', NULL, NULL, '$2y$10$cLtw6kKdyIVL5b8lc8zU3e31z8D4CkuUxZ4U4G60rL3wNlUL9gg.K', NULL, '4', '0', '2023-12-13 23:16:07', '2023-12-13 23:16:07'),
(177, 'DaragaNorthCS CA G19', 'C4-111127121', 'binitayanescag19@gmail.com', NULL, NULL, '$2y$10$k7uIGXh8uGy1JqEy7Ynx5urnAenDpkP.6ev.lTP3bTzjVH8wwkB9y', NULL, '4', '0', '2023-12-13 23:16:07', '2023-12-13 23:16:07'),
(178, 'DaragaNorthCS CA G110', 'C4-111127122', 'binitayanescag110@gmail.com', NULL, NULL, '$2y$10$cIOVRkWo2xXWMuqsBOKcl.UuX8pVh51ownt0ltxaRcFifmXZzQklS', NULL, '4', '0', '2023-12-13 23:16:07', '2023-12-13 23:16:07'),
(179, 'DaragaNorthCS CA G111', 'C4-111127123', 'binitayanescag111@gmail.com', NULL, NULL, '$2y$10$LOvSSbBnsWQ02G5AZR73Jul2agB0LzkLIzUxgDUvM/mObTIiBreAG', NULL, '4', '0', '2023-12-13 23:16:07', '2023-12-13 23:16:07'),
(180, 'DaragaNorthCS CA G112', 'C4-111127124', 'binitayanescag112@gmail.com', NULL, NULL, '$2y$10$8qKLBz6SoUXCtBVHdPIaRekiP59xNbZi72piKkyG.QSPOUE8wCuoW', NULL, '4', '0', '2023-12-13 23:16:07', '2023-12-13 23:16:07'),
(181, 'DaragaNorthCS CA G113', 'C4-111127125', 'binitayanescag113@gmail.com', NULL, NULL, '$2y$10$0YJ1BLYAyJ36ao4jTQqS0eKY4zajFft.QcJUtBmFZVYlUF/bb1ZcS', NULL, '4', '0', '2023-12-13 23:16:07', '2023-12-13 23:16:07'),
(182, 'DaragaNorthCS CA G114', 'C4-111127126', 'binitayanescag114@gmail.com', NULL, NULL, '$2y$10$dr50XjAYJIqVR.uPUFBMnunjLNs6zLYQ9Q9lY6aToYb9o6JZbSY1S', NULL, '4', '0', '2023-12-13 23:16:07', '2023-12-13 23:16:07'),
(183, 'DaragaNorthCS CA G115', 'C4-111127127', 'binitayanescag115@gmail.com', NULL, NULL, '$2y$10$I3KJZscb.XEaypSQUk0sJuAcZgUTIll6VRyIZkqOGDPMrkdxKRu/O', NULL, '4', '0', '2023-12-13 23:16:07', '2023-12-13 23:16:07'),
(184, 'DaragaNorthCS CA G21', 'C4-111127143', 'binitayanescag21@gmail.com', NULL, NULL, '$2y$10$.avjp81dYbLq7V87d2g22uKxfK0NDKduC11njM.8gqFqT7M/L0JFK', NULL, '4', '0', '2023-12-13 23:16:08', '2023-12-13 23:16:08'),
(185, 'DaragaNorthCS CA G22', 'C4-111127144', 'binitayanescag22@gmail.com', NULL, NULL, '$2y$10$w8/2ic1RKRSBOFaOjEiWV.BGF.HzhNAPbdJf70dqy3zUMfWi.2Xz.', NULL, '4', '0', '2023-12-13 23:16:08', '2023-12-13 23:16:08'),
(186, 'DaragaNorthCS CA G23', 'C4-111127145', 'binitayanescag23@gmail.com', NULL, NULL, '$2y$10$TSXArQvn8l8C15ZehVOAwuoIyjr7xllQFth7CgwEdhUrnDbuugsm6', NULL, '4', '0', '2023-12-13 23:16:08', '2023-12-13 23:16:08'),
(187, 'DaragaNorthCS CA G24', 'C4-111127146', 'binitayanescag24@gmail.com', NULL, NULL, '$2y$10$i9SkuFVOcyGV6kRyT0IFau0bj3s2jxwL050zCu3g5xt.aQBn9BWr2', NULL, '4', '0', '2023-12-13 23:16:08', '2023-12-13 23:16:08'),
(188, 'DaragaNorthCS CA G25', 'C4-111127147', 'binitayanescag25@gmail.com', NULL, NULL, '$2y$10$MMqqqg0UmAdkweS/aZyXXu2kGK/0k9zdhFzaY6Dah1TMhtcoEDdMK', NULL, '4', '0', '2023-12-13 23:16:08', '2023-12-13 23:16:08'),
(189, 'DaragaNorthCS CA G26', 'C4-111127148', 'binitayanescag26@gmail.com', NULL, NULL, '$2y$10$oMGa3h4bMMUd1dyYwbHU.uOtx.yrIfn3PsxGePE0ZHvkpPkKwHsPG', NULL, '4', '0', '2023-12-13 23:16:08', '2023-12-13 23:16:08'),
(190, 'DaragaNorthCS CA G27', 'C4-111127149', 'binitayanescag27@gmail.com', NULL, NULL, '$2y$10$dTJoppQQIJJA4HRnxC3RMunGPfgIWU5YG8j5VVqiJyRibD2SXCv0e', NULL, '4', '0', '2023-12-13 23:16:08', '2023-12-13 23:16:08'),
(191, 'DaragaNorthCS CA G28', 'C4-111127150', 'binitayanescag28@gmail.com', NULL, NULL, '$2y$10$VHYmjKOG56Q1e1K43CZdjuX4Dt7DXxJlfkH.jStI3hnNG2Yuagf8u', NULL, '4', '0', '2023-12-13 23:16:08', '2023-12-13 23:16:08'),
(192, 'DaragaNorthCS CA G29', 'C4-111127151', 'binitayanescag29@gmail.com', NULL, NULL, '$2y$10$TMfGw11murWmNxneFaUmRuUNlXNw4S4/Vc5XRt8N2qWFExjBDtG3G', NULL, '4', '0', '2023-12-13 23:16:08', '2023-12-13 23:16:08'),
(193, 'DaragaNorthCS CA G210', 'C4-111127152', 'binitayanescag210@gmail.com', NULL, NULL, '$2y$10$HFt/JVgxLEITRwEKikCnC.qoK2Z9v7gbWLxpLoF7m67akWsoqQO3K', NULL, '4', '0', '2023-12-13 23:16:08', '2023-12-13 23:16:08'),
(194, 'DaragaNorthCS CA G211', 'C4-111127153', 'binitayanescag211@gmail.com', NULL, NULL, '$2y$10$xHO.qnvysn1Lyz0cpbw/quL0lyQZqc3VOBJn3rxrg1glbY9imhV5S', NULL, '4', '0', '2023-12-13 23:16:08', '2023-12-13 23:16:08'),
(195, 'DaragaNorthCS CA G212', 'C4-111127154', 'binitayanescag212@gmail.com', NULL, NULL, '$2y$10$5KXuP.GsRgzvRjvCYmifW.HnqQg.Dk.0PDvCluIvLVqutwaGpd5uW', NULL, '4', '0', '2023-12-13 23:16:09', '2023-12-13 23:16:09'),
(196, 'DaragaNorthCS CA G213', 'C4-111127155', 'binitayanescag213@gmail.com', NULL, NULL, '$2y$10$HazK/RuMcDKz/OlZ/t07Lu40AzzODCARoe7M6XcNY56BHPiQo13M2', NULL, '4', '0', '2023-12-13 23:16:09', '2023-12-13 23:16:09'),
(197, 'DaragaNorthCS CA G214', 'C4-111127156', 'binitayanescag214@gmail.com', NULL, NULL, '$2y$10$Rs8WWc1U1EsGhmP.oG7YTetiiSwwK3UnPVw.zK4pMIvWo2tV/wWgO', NULL, '4', '0', '2023-12-13 23:16:09', '2023-12-13 23:16:09'),
(198, 'DaragaNorthCS CA G215', 'C4-111127157', 'binitayanescag215@gmail.com', NULL, NULL, '$2y$10$UHsfM9r2GEDLsxmfOnGBpOSQjdSueLWq357bGED1TDnrA9fY3UWEe', NULL, '4', '0', '2023-12-13 23:16:09', '2023-12-13 23:16:09'),
(199, 'DaragaNorthCS CA G31', 'C4-111127173', 'binitayanescag31@gmail.com', NULL, NULL, '$2y$10$QX1Un0JTiEk68GdHij8gZudwDSs/s2tMTR9pDpuck81Ro3ywR2hcO', NULL, '4', '0', '2023-12-13 23:16:09', '2023-12-13 23:16:09'),
(200, 'DaragaNorthCS CA G32', 'C4-111127174', 'binitayanescag32@gmail.com', NULL, NULL, '$2y$10$OyJmZ/EOHup7EvTqqwbKOua2/nPuMoWNloSkRbmKwMu6hLc/mTHxq', NULL, '4', '0', '2023-12-13 23:16:09', '2023-12-13 23:16:09'),
(201, 'DaragaNorthCS CA G33', 'C4-111127175', 'binitayanescag33@gmail.com', NULL, NULL, '$2y$10$AkrtP5SBewgAcimx3wst5.L78lR6./6gjj8vf1bacodndeEbg8Szu', NULL, '4', '0', '2023-12-13 23:16:09', '2023-12-13 23:16:09'),
(202, 'DaragaNorthCS CA G34', 'C4-111127176', 'binitayanescag34@gmail.com', NULL, NULL, '$2y$10$qpmS1SA1LUzqIhvHGalDXukvjaD.qZ.ZHhonLg4ZdWIsgfI9rLdva', NULL, '4', '0', '2023-12-13 23:16:09', '2023-12-13 23:16:09'),
(203, 'DaragaNorthCS CA G35', 'C4-111127177', 'binitayanescag35@gmail.com', NULL, NULL, '$2y$10$CD4M3.JzoUG4BThMGW6at.4qjlvGyYjBZWkB27ESU7YXxt.AZMByq', NULL, '4', '0', '2023-12-13 23:16:09', '2023-12-13 23:16:09'),
(204, 'DaragaNorthCS CA G36', 'C4-111127178', 'binitayanescag36@gmail.com', NULL, NULL, '$2y$10$rIw4IZ4JbuJEHUcwD4rabeAOYQ0z35ckyPf4XJYx/laMGL8HFJh.6', NULL, '4', '0', '2023-12-13 23:16:09', '2023-12-13 23:16:09'),
(205, 'DaragaNorthCS CA G37', 'C4-111127179', 'binitayanescag37@gmail.com', NULL, NULL, '$2y$10$XNFO/Nx7oMP3ps6U1o3OZeAFdN3ua9bsFscQwuYB8zXhM.h.WF3t2', NULL, '4', '0', '2023-12-13 23:16:09', '2023-12-13 23:16:09'),
(206, 'DaragaNorthCS CA G38', 'C4-111127180', 'binitayanescag38@gmail.com', NULL, NULL, '$2y$10$/n6TvOOgjnEj02jnTI1IQOo6iMt2udbfjugtGrGy7R4p5svQ5/vL2', NULL, '4', '0', '2023-12-13 23:16:09', '2023-12-13 23:16:09'),
(207, 'DaragaNorthCS CA G39', 'C4-111127181', 'binitayanescag39@gmail.com', NULL, NULL, '$2y$10$MKOIJsbg/jqtZbwXjWT4GuC2CR/y/76BHOgPZK/SKYRDNaFzfyL/e', NULL, '4', '0', '2023-12-13 23:16:10', '2023-12-13 23:16:10'),
(208, 'DaragaNorthCS CA G310', 'C4-111127182', 'binitayanescag310@gmail.com', NULL, NULL, '$2y$10$QkoaZqJcdlPSuDZ8vr6VgOQP7FX2tY2fOums.dzJQk73ADuZeM2EG', NULL, '4', '0', '2023-12-13 23:16:10', '2023-12-13 23:16:10'),
(209, 'DaragaNorthCS CA G311', 'C4-111127183', 'binitayanescag311@gmail.com', NULL, NULL, '$2y$10$ktvG/VqQEfQvdOIvH8Pif.dywzBlqutm8wOVBavsCq17xg5M98go.', NULL, '4', '0', '2023-12-13 23:16:10', '2023-12-13 23:16:10'),
(210, 'DaragaNorthCS CA G312', 'C4-111127184', 'binitayanescag312@gmail.com', NULL, NULL, '$2y$10$PVDEUZ4Pc./g5LcXdcjVIeGgVuAyCzimPYzKGrVMc8KSE7vuTzXCC', NULL, '4', '0', '2023-12-13 23:16:10', '2023-12-13 23:16:10'),
(211, 'DaragaNorthCS CA G313', 'C4-111127185', 'binitayanescag313@gmail.com', NULL, NULL, '$2y$10$w9KFvWkFgTmn.f16gnxel.f7PikM0uzPNe0JHI2j9gVn0Yf6HmXJa', NULL, '4', '0', '2023-12-13 23:16:10', '2023-12-13 23:16:10'),
(212, 'DaragaNorthCS CA G314', 'C4-111127186', 'binitayanescag314@gmail.com', NULL, NULL, '$2y$10$9Ifb0u9nLFDLqrnF5thQcuDBYkET9pw0rvxkEqn15W0BHzK4IZOuC', NULL, '4', '0', '2023-12-13 23:16:10', '2023-12-13 23:16:10'),
(213, 'DaragaNorthCS CA G315', 'C4-111127187', 'binitayanescag315@gmail.com', NULL, NULL, '$2y$10$kaw/nXDBiQJeUub/JqdIGe91mr3dL5sWFRJ2QtcvOsKygj4oB8IkW', NULL, '4', '0', '2023-12-13 23:16:10', '2023-12-13 23:16:10'),
(214, 'DaragaNorthCS CA G41', 'C4-111127203', 'binitayanescag41@gmail.com', NULL, NULL, '$2y$10$piZdouSlJQEmeWFkKIRkeeFOFEVFxf.FxHS7uVOFgGIraF9ko/9.q', NULL, '4', '0', '2023-12-13 23:16:10', '2023-12-13 23:16:10'),
(215, 'DaragaNorthCS CA G42', 'C4-111127204', 'binitayanescag42@gmail.com', NULL, NULL, '$2y$10$ZWy4RUoBnJj4tZxdHPm1jO0qtpwsAPbUXp2LtYVSkyAz99fHABWWG', NULL, '4', '0', '2023-12-13 23:16:10', '2023-12-13 23:16:10'),
(216, 'DaragaNorthCS CA G43', 'C4-111127205', 'binitayanescag43@gmail.com', NULL, NULL, '$2y$10$s8avTQBPUHm6qwABn7bQtOZA33sKaU3pQEwy384vl9cn0nstHZpCa', NULL, '4', '0', '2023-12-13 23:16:10', '2023-12-13 23:16:10'),
(217, 'DaragaNorthCS CA G44', 'C4-111127206', 'binitayanescag44@gmail.com', NULL, NULL, '$2y$10$yg.MEHaFgkUNOsbIUL6lj.ouajxnR1UtrNpa90L6XkLwy6Kd8zQlS', NULL, '4', '0', '2023-12-13 23:16:10', '2023-12-13 23:16:10'),
(218, 'DaragaNorthCS CA G45', 'C4-111127207', 'binitayanescag45@gmail.com', NULL, NULL, '$2y$10$LvMPLctcgLJ76XH53rzKUOKOoTNnzSy.a6juA8oR5c55ajrH0Cd7u', NULL, '4', '0', '2023-12-13 23:16:10', '2023-12-13 23:16:10'),
(219, 'DaragaNorthCS CA G46', 'C4-111127208', 'binitayanescag46@gmail.com', NULL, NULL, '$2y$10$O7nqeRzHytqyVmqQO0FGHu6/7ciz6Ha9yP3rjJ41aK5oy7/GltGGi', NULL, '4', '0', '2023-12-13 23:16:11', '2023-12-13 23:16:11'),
(220, 'DaragaNorthCS CA G47', 'C4-111127209', 'binitayanescag47@gmail.com', NULL, NULL, '$2y$10$blJw3anyvAWVw1Xc3bUi1esHw5rohuqcpAmuPbSSU8E7tJnXpQHsC', NULL, '4', '0', '2023-12-13 23:16:11', '2023-12-13 23:16:11'),
(221, 'DaragaNorthCS CA G48', 'C4-111127210', 'binitayanescag48@gmail.com', NULL, NULL, '$2y$10$XL8to5gE4n/YG/PY1ssj0OAbP6CACsh5/MB5eYO.APbcNe6G65MG.', NULL, '4', '0', '2023-12-13 23:16:11', '2023-12-13 23:16:11'),
(222, 'DaragaNorthCS CA G49', 'C4-111127211', 'binitayanescag49@gmail.com', NULL, NULL, '$2y$10$9kp6KLVvE9/AeMVOf1SWCOvxvtGj4z/pte0YI2dm/4hSObmqqYIxy', NULL, '4', '0', '2023-12-13 23:16:11', '2023-12-13 23:16:11'),
(223, 'DaragaNorthCS CA G410', 'C4-111127212', 'binitayanescag410@gmail.com', NULL, NULL, '$2y$10$fc2Pm9w8QSTPEceB6O6OPu3w5tvlATjSxbPGeXw61Si1wvFqKiu1u', NULL, '4', '0', '2023-12-13 23:16:11', '2023-12-13 23:16:11'),
(224, 'DaragaNorthCS CA G411', 'C4-111127213', 'binitayanescag411@gmail.com', NULL, NULL, '$2y$10$s1.md65XOR7FyPpDOj9XFOQkvLN.1p53dLibzmEaW.owPaOa1we1q', NULL, '4', '0', '2023-12-13 23:16:11', '2023-12-13 23:16:11'),
(225, 'DaragaNorthCS CA G412', 'C4-111127214', 'binitayanescag412@gmail.com', NULL, NULL, '$2y$10$gJ4WGiYoBeeI3PvxxcgAjeO.HDQode03sjOLdjkfQ3h9IVpKYuzpa', NULL, '4', '0', '2023-12-13 23:16:11', '2023-12-13 23:16:11'),
(226, 'DaragaNorthCS CA G413', 'C4-111127215', 'binitayanescag413@gmail.com', NULL, NULL, '$2y$10$2ElQzRoYA341buGMWEiW5uWc.850fzyR4EOJpXkbF4Y9.QKO9Yvvy', NULL, '4', '0', '2023-12-13 23:16:11', '2023-12-13 23:16:11'),
(227, 'DaragaNorthCS CA G414', 'C4-111127216', 'binitayanescag414@gmail.com', NULL, NULL, '$2y$10$BKYzuLBtWtz3Dekex7rvFu5PE.WPkyRq45duu5lN4UtwDInxMfd0a', NULL, '4', '0', '2023-12-13 23:16:11', '2023-12-13 23:16:11'),
(228, 'DaragaNorthCS CA G415', 'C4-111127217', 'binitayanescag415@gmail.com', NULL, NULL, '$2y$10$3LacI.SLiZRsijIT9KaaL.0VvJoB5Kvx7TavCu2LulbuaGKpgKmAq', NULL, '4', '0', '2023-12-13 23:16:11', '2023-12-13 23:16:11'),
(229, 'DaragaNorthCS CA G51', 'C4-111127233', 'binitayanescag51@gmail.com', NULL, NULL, '$2y$10$.RzPJUVwb9JpXd4L/L/Dvuu9BUhdugo7p8G2N4YK7ww.vECLspim.', NULL, '4', '0', '2023-12-13 23:16:11', '2023-12-13 23:16:11');
INSERT INTO `users` (`id`, `name`, `unique_id`, `email`, `phone_number`, `email_verified_at`, `password`, `remember_token`, `user_type`, `is_deleted`, `created_at`, `updated_at`) VALUES
(230, 'DaragaNorthCS CA G52', 'C4-111127234', 'binitayanescag52@gmail.com', NULL, NULL, '$2y$10$dt9kP6Em5v6RpBvpsMQ1h.xXkpr6abu7uSsZWpbxwd7Up0AsFjyjW', NULL, '4', '0', '2023-12-13 23:16:11', '2023-12-13 23:16:11'),
(231, 'DaragaNorthCS CA G53', 'C4-111127235', 'binitayanescag53@gmail.com', NULL, NULL, '$2y$10$.mMzU0pBrbVgchJRNNVlyeYQAN3Mw0bK6SdcH2VwqCzz4L4YVh5wa', NULL, '4', '0', '2023-12-13 23:16:12', '2023-12-13 23:16:12'),
(232, 'DaragaNorthCS CA G54', 'C4-111127236', 'binitayanescag54@gmail.com', NULL, NULL, '$2y$10$ariOn6glFMxJ5WwC1vyBzOkQT9ZZdybhc6BeEAeTFvlrxWgXpRyGq', NULL, '4', '0', '2023-12-13 23:16:12', '2023-12-13 23:16:12'),
(233, 'DaragaNorthCS CA G55', 'C4-111127237', 'binitayanescag55@gmail.com', NULL, NULL, '$2y$10$ZF2h0nA2i0aqduLKEDUqPO/DMR4r25pFP62kBHLGSGi.qpy8InZqu', NULL, '4', '0', '2023-12-13 23:16:12', '2023-12-13 23:16:12'),
(234, 'DaragaNorthCS CA G56', 'C4-111127238', 'binitayanescag56@gmail.com', NULL, NULL, '$2y$10$RNr.uT2iOrE7r.eNdiPOLuzWojtCewM5DAlUGNkIA4owwjhjxCBi2', NULL, '4', '0', '2023-12-13 23:16:12', '2023-12-13 23:16:12'),
(235, 'DaragaNorthCS CA G57', 'C4-111127239', 'binitayanescag57@gmail.com', NULL, NULL, '$2y$10$j6Rtf6iNkyL.iOym3UfgC.gMoBPRlGld20wLC0ZkLQM/XgVBvPOh6', NULL, '4', '0', '2023-12-13 23:16:12', '2023-12-13 23:16:12'),
(236, 'DaragaNorthCS CA G58', 'C4-111127240', 'binitayanescag58@gmail.com', NULL, NULL, '$2y$10$V5s9fsFEYYGAD8M.hocVP.ZojcuBQBI/COvA5lrbU.CBj9e50GOHy', NULL, '4', '0', '2023-12-13 23:16:12', '2023-12-13 23:16:12'),
(237, 'DaragaNorthCS CA G59', 'C4-111127241', 'binitayanescag59@gmail.com', NULL, NULL, '$2y$10$pLsbCbFEOYWt9OOAwgyXNeFkUzmwlTSnIFayAzvKJZ9NwZrOIh5oq', NULL, '4', '0', '2023-12-13 23:16:12', '2023-12-13 23:16:12'),
(238, 'DaragaNorthCS CA G510', 'C4-111127242', 'binitayanescag510@gmail.com', NULL, NULL, '$2y$10$eQLGMLN9TGEop9NhP.Arruki/m/96EciZCqE47f1af5d48UwFWSLC', NULL, '4', '0', '2023-12-13 23:16:12', '2023-12-13 23:16:12'),
(239, 'DaragaNorthCS CA G511', 'C4-111127243', 'binitayanescag511@gmail.com', NULL, NULL, '$2y$10$bhF4dz5u3kWen5IwvG0o1.gf7hxpzZLp/05aC23a3iirEt5DzYNwK', NULL, '4', '0', '2023-12-13 23:16:12', '2023-12-13 23:16:12'),
(240, 'DaragaNorthCS CA G512', 'C4-111127244', 'binitayanescag512@gmail.com', NULL, NULL, '$2y$10$E/rEhM.4u.Iqq8DB1edB0OTolBKiVqdVg./76jghoUhR6eL6SXoqC', NULL, '4', '0', '2023-12-13 23:16:12', '2023-12-13 23:16:12'),
(241, 'DaragaNorthCS CA G513', 'C4-111127245', 'binitayanescag513@gmail.com', NULL, NULL, '$2y$10$tvNGOBtPOKCBN9WDvhQmTuQ90F2Y9DqRQMweynliLVYt2.bXJVJq6', NULL, '4', '0', '2023-12-13 23:16:12', '2023-12-13 23:16:12'),
(242, 'DaragaNorthCS CA G514', 'C4-111127246', 'binitayanescag514@gmail.com', NULL, NULL, '$2y$10$OtsOmh.LldmLsXlXTLsDtu/eabjWQd6MMhmqOJjPZEKWuufsQoow2', NULL, '4', '0', '2023-12-13 23:16:13', '2023-12-13 23:16:13'),
(243, 'DaragaNorthCS CA G515', 'C4-111127247', 'binitayanescag515@gmail.com', NULL, NULL, '$2y$10$fW5Yys1w3kREcwhW.X/G0eVBXlpd0yGGhgEyVoPjSQ2Ed4x4cDiX.', NULL, '4', '0', '2023-12-13 23:16:13', '2023-12-13 23:16:13'),
(244, 'DaragaNorthCS CA G61', 'C4-111127263', 'binitayanescag61@gmail.com', NULL, NULL, '$2y$10$RSYWcZqbvRF6woYh0prL5e2JzsJAEOsyPZdIOFCluR92VCUx9aSVS', NULL, '4', '0', '2023-12-13 23:16:13', '2023-12-13 23:16:13'),
(245, 'DaragaNorthCS CA G62', 'C4-111127264', 'binitayanescag62@gmail.com', NULL, NULL, '$2y$10$ovEYVA6UA0Mm96fNFfvkyeUXZVIKsTYTLfBEmNp8m4VQYXBTc/Eje', NULL, '4', '0', '2023-12-13 23:16:13', '2023-12-13 23:16:13'),
(246, 'DaragaNorthCS CA G63', 'C4-111127265', 'binitayanescag63@gmail.com', NULL, NULL, '$2y$10$XjlDS3hS/VvEpuHfVefhmuPguqUyp1Ys5g618YS.rbvApDE5TIVyG', NULL, '4', '0', '2023-12-13 23:16:13', '2023-12-13 23:16:13'),
(247, 'DaragaNorthCS CA G64', 'C4-111127266', 'binitayanescag64@gmail.com', NULL, NULL, '$2y$10$5ASpGPir3xihlfeHBAe2CO1M7q5QunWn2lkJ6DaU5a1hcOjqIyIaK', NULL, '4', '0', '2023-12-13 23:16:13', '2023-12-13 23:16:13'),
(248, 'DaragaNorthCS CA G65', 'C4-111127267', 'binitayanescag65@gmail.com', NULL, NULL, '$2y$10$glYZUl3rV/syRYYLoQh9k.U06FrnIOPkTDe4jvDc2AA5PZ9S4k/Ra', NULL, '4', '0', '2023-12-13 23:16:13', '2023-12-13 23:16:13'),
(249, 'DaragaNorthCS CA G66', 'C4-111127268', 'binitayanescag66@gmail.com', NULL, NULL, '$2y$10$VliJ.Tk4jOlDhap7Nb4y7eJokl2eR172.HGNy3R8bYL46WBcHssRG', NULL, '4', '0', '2023-12-13 23:16:13', '2023-12-13 23:16:13'),
(250, 'DaragaNorthCS CA G67', 'C4-111127269', 'binitayanescag67@gmail.com', NULL, NULL, '$2y$10$XFhaDae0JOeK7Ewb1N.I.eK1LRohn0hY8bacmjQRtpOH.U3o2dECe', NULL, '4', '0', '2023-12-13 23:16:13', '2023-12-13 23:16:13'),
(251, 'DaragaNorthCS CA G68', 'C4-111127270', 'binitayanescag68@gmail.com', NULL, NULL, '$2y$10$H.8kqZFVdCXXpI4fV2vt1OxTIE5fsTFinozDqrxLLXMRQYrwQg5U.', NULL, '4', '0', '2023-12-13 23:16:13', '2023-12-13 23:16:13'),
(252, 'DaragaNorthCS CA G69', 'C4-111127271', 'binitayanescag69@gmail.com', NULL, NULL, '$2y$10$GATMXip/gfKOogHD.nxdgud3gp7SsWVqJtsMI5X2XDUHq9kP2vk5e', NULL, '4', '0', '2023-12-13 23:16:13', '2023-12-13 23:16:13'),
(253, 'DaragaNorthCS CA G610', 'C4-111127272', 'binitayanescag610@gmail.com', NULL, NULL, '$2y$10$.fOi7DUdiOBRGoRZq3mkiuzo69OLwKTJioP7oT53sx5D4KJcosPnS', NULL, '4', '0', '2023-12-13 23:16:13', '2023-12-13 23:16:13'),
(254, 'DaragaNorthCS CA G611', 'C4-111127273', 'binitayanescag611@gmail.com', NULL, NULL, '$2y$10$oQ.yEzmN9tv0wX6.B26NMOczzaYjgO92Yyc.MzwqsBEPbos7k5jtK', NULL, '4', '0', '2023-12-13 23:16:13', '2023-12-13 23:16:13'),
(255, 'DaragaNorthCS CA G612', 'C4-111127274', 'binitayanescag612@gmail.com', NULL, NULL, '$2y$10$lzmEipHWW6QXm1pDemsTDuu9ownmeZf5hd.OLaL8/lC662Rd5YzF6', NULL, '4', '0', '2023-12-13 23:16:14', '2023-12-13 23:16:14'),
(256, 'DaragaNorthCS CA G613', 'C4-111127275', 'binitayanescag613@gmail.com', NULL, NULL, '$2y$10$7ADHTzJvU8p/JXeP2lwnMuHgsJBi5GsNZz35Xteyaea/wcw.84m.S', NULL, '4', '0', '2023-12-13 23:16:14', '2023-12-13 23:16:14'),
(257, 'DaragaNorthCS CA G614', 'C4-111127276', 'binitayanescag614@gmail.com', NULL, NULL, '$2y$10$D3slukYOa2OH15HN3uLksuOeRDJJ.Kw7WFkRxw0//QKjAJ0NH.9ee', NULL, '4', '0', '2023-12-13 23:16:14', '2023-12-13 23:16:14'),
(258, 'DaragaNorthCS CA G615', 'C4-111127277', 'binitayanescag615@gmail.com', NULL, NULL, '$2y$10$Rl537SkxOBRejFQFGvOeuOiAai/vm57HzEno1bCi/7P5n9eEJ9L7K', NULL, '4', '0', '2023-12-13 23:16:14', '2023-12-13 23:16:14'),
(259, 'KilicaoES CA K1', 'C4-1111420', 'kilicaoescak1@gmail.com', NULL, NULL, '$2y$10$Vkw1skjGrMbTQXQv4mekUepOeGSApybwFxO8uJQ1JBFybB.irVaBG', NULL, '4', '0', '2023-12-13 23:16:14', '2023-12-13 23:16:14'),
(260, 'KilicaoES CA K2', 'C4-1111421', 'kilicaoescak2@gmail.com', NULL, NULL, '$2y$10$nhUrWx.OmQS3Ev1BCJHKWutOy.2N3qLB/4fe8ZZgdA0v5u63PHyXm', NULL, '4', '0', '2023-12-13 23:16:14', '2023-12-13 23:16:14'),
(261, 'KilicaoES CA K3', 'C4-1111422', 'kilicaoescak3@gmail.com', NULL, NULL, '$2y$10$O5Wutb29GXI9TePHZNKsR.FgnEv0.kP2b/25dDwNTwom7lyUXlp.O', NULL, '4', '0', '2023-12-13 23:16:14', '2023-12-13 23:16:14'),
(262, 'KilicaoES CA K4', 'C4-1111423', 'kilicaoescak4@gmail.com', NULL, NULL, '$2y$10$M9MRLoXeJ/PKqW7U0qbh2umnkJZPNYZ4p058BX3ATfonLWXm0BQBG', NULL, '4', '0', '2023-12-13 23:16:14', '2023-12-13 23:16:14'),
(263, 'KilicaoES CA K5', 'C4-1111424', 'kilicaoescak5@gmail.com', NULL, NULL, '$2y$10$oZb2.jJXtfNAYvwDcb1OJOxsLLf7Rf5WqeYmyESaB/P4cI.WoDzu6', NULL, '4', '0', '2023-12-13 23:16:14', '2023-12-13 23:16:14'),
(264, 'KilicaoES CA K6', 'C4-1111425', 'kilicaoescak6@gmail.com', NULL, NULL, '$2y$10$ASHU84m0shsYqDZKRI39ZeN0qMpHwS.aOeL7mMd6E/SOGjX85PgZC', NULL, '4', '0', '2023-12-13 23:16:14', '2023-12-13 23:16:14'),
(265, 'KilicaoES CA K7', 'C4-1111426', 'kilicaoescak7@gmail.com', NULL, NULL, '$2y$10$wRVA2IgVbMJc3vAgsi0UVOul6M5/5LY6b7thLBQm9Vf//7hPjtdm.', NULL, '4', '0', '2023-12-13 23:16:14', '2023-12-13 23:16:14'),
(266, 'KilicaoES CA K8', 'C4-1111427', 'kilicaoescak8@gmail.com', NULL, NULL, '$2y$10$xYZIqVPyNKehZabmvkVNw.Os.rQD1HjA9NUhcTp5ftAbhiMWlOAeK', NULL, '4', '0', '2023-12-13 23:16:14', '2023-12-13 23:16:14'),
(267, 'KilicaoES CA K9', 'C4-1111428', 'kilicaoescak9@gmail.com', NULL, NULL, '$2y$10$7wKATheNEN8jEHLF6sOSwuBNhC7i81nNMEJAAWRBUDH4hbjNTn2k2', NULL, '4', '0', '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(268, 'KilicaoES CA K10', 'C4-1111429', 'kilicaoescak10@gmail.com', NULL, NULL, '$2y$10$2cdnRrw2hH.mIPhhBrmlteDajB1tBsV/7BkiJEzVj2vr2ExqEupa2', NULL, '4', '0', '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(269, 'KilicaoES CA K11', 'C4-11114210', 'kilicaoescak11@gmail.com', NULL, NULL, '$2y$10$qhe5rPmMs6yrLiajRjwVRuKfoy2khpd9ocqxU7KYAFTB0GEX8Xt.S', NULL, '4', '0', '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(270, 'KilicaoES CA K12', 'C4-11114211', 'kilicaoescak12@gmail.com', NULL, NULL, '$2y$10$sll30MgJghzjpgB2XoExSOQ1OK1kIrUPeiCZKzchpnw742d7RBqju', NULL, '4', '0', '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(271, 'KilicaoES CA K13', 'C4-11114212', 'kilicaoescak13@gmail.com', NULL, NULL, '$2y$10$FwOmQBzURBzx8Jg7DJJhw.CGQ4T4me70kbVW4/nJW7.HOG8G729ri', NULL, '4', '0', '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(272, 'KilicaoES CA K14', 'C4-11114213', 'kilicaoescak14@gmail.com', NULL, NULL, '$2y$10$Z1QzR5iHWJReF4rdFgXcS.QhRkeewehGA/myxBiJG7ME/tUUsHOiW', NULL, '4', '0', '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(273, 'KilicaoES CA K15', 'C4-11114214', 'kilicaoescak15@gmail.com', NULL, NULL, '$2y$10$k5xDKFUcthpXntiUOFmMBuuG60JMj41VAPBVc3jAxc6vj/I.EI01e', NULL, '4', '0', '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(274, 'Medical Officer', 'M2-9999999', 'medicalofficer@gmail.com', NULL, NULL, '$2y$10$wOXZxo4xs1xqDobjINf9weZfUKndlJwv0b5k3jaCdSJbsXAS5jhGG', NULL, '2', '0', '2023-12-13 23:16:15', '2023-12-13 23:16:15'),
(275, 'School Nurse', 'S3-9999999', 'schoolnurse@gmail.com', NULL, NULL, '$2y$10$fVb7MsvASXbZm6MnWay6JO3xLsa2M8ssNCVzRJP/uWF1Ndxsaqx0W', NULL, '3', '0', '2023-12-13 23:16:15', '2023-12-13 23:16:15');

-- --------------------------------------------------------

--
-- Table structure for table `user_logs`
--

CREATE TABLE `user_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `action` enum('Create','Update','Recover','Delete') NOT NULL,
  `old_value` text DEFAULT NULL,
  `new_value` text DEFAULT NULL,
  `table_name` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_logs`
--

INSERT INTO `user_logs` (`id`, `action`, `old_value`, `new_value`, `table_name`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Create', NULL, 'LRN: 111867070000, Name: Thenten Lay Abasando , B-day: 2017-09-27, Gender: Male, Area: , , , Guardian:  | ', 'pupil', 49, '2023-12-14 23:49:47', '2023-12-14 23:49:47'),
(2, 'Create', NULL, 'LRN: 111867070001, Name: Shark Mentis Amento , B-day: 2017-02-08, Gender: Male, Area: , , , Guardian:  | ', 'pupil', 49, '2023-12-14 23:50:36', '2023-12-14 23:50:36'),
(3, 'Create', NULL, 'LRN: 111867070003, Name: Nailan Homon Ferven , B-day: 2017-03-09, Gender: Male, Area: , , , Guardian:  | ', 'pupil', 49, '2023-12-14 23:52:18', '2023-12-14 23:52:18'),
(4, 'Create', NULL, 'LRN: 111867070004, Name: Sachen  Lamen , B-day: 2017-07-13, Gender: Male, Area: , , , Guardian:  | ', 'pupil', 49, '2023-12-14 23:53:53', '2023-12-14 23:53:53'),
(5, 'Create', NULL, 'LRN: 111867070005, Name: Rafael Arwen Logian , B-day: 2017-05-24, Gender: Male, Area: , , , Guardian:  | ', 'pupil', 49, '2023-12-14 23:55:18', '2023-12-14 23:55:18'),
(6, 'Create', NULL, 'LRN: 111867070006, Name: Ricardo Bustamante Montenegro , B-day: 2015-02-10, Gender: Male, Area: , , , Guardian:  | ', 'pupil', 49, '2023-12-14 23:57:21', '2023-12-14 23:57:21'),
(7, 'Create', NULL, 'LRN: 11186707007, Name: Hamoch Solem Minanto , B-day: 2017-06-08, Gender: Male, Area: , , , Guardian:  | ', 'pupil', 49, '2023-12-14 23:59:04', '2023-12-14 23:59:04'),
(8, 'Create', NULL, 'LRN: 111867070008, Name: Ivan Miles Mirandilla Vista , B-day: 2017-06-06, Gender: Male, Area: , , , Guardian:  | ', 'pupil', 49, '2023-12-15 00:00:22', '2023-12-15 00:00:22'),
(9, 'Create', NULL, 'LRN: 111867070009, Name: Nathiel Montes Taberno , B-day: 2017-06-22, Gender: Male, Area: , , , Guardian:  | ', 'pupil', 49, '2023-12-15 00:01:18', '2023-12-15 00:01:18'),
(10, 'Create', NULL, 'LRN: 111867070010, Name: Laries Menti Jurissa , B-day: 2016-07-20, Gender: Female, Area: , , , Guardian:  | ', 'pupil', 49, '2023-12-15 00:02:17', '2023-12-15 00:02:17'),
(11, 'Create', NULL, 'LRN: 111867070011, Name: Janelle Lilias Leela , B-day: 2017-04-21, Gender: Female, Area: , , , Guardian:  | ', 'pupil', 49, '2023-12-15 00:03:56', '2023-12-15 00:03:56'),
(12, 'Create', NULL, 'LRN: 111867070012, Name: Pamela Lomon Madriano , B-day: 2017-04-27, Gender: Female, Area: , , , Guardian:  | ', 'pupil', 49, '2023-12-15 00:05:38', '2023-12-15 00:05:38'),
(13, 'Create', NULL, 'LRN: 111867070013, Name: Juana Reyes Panan , B-day: 2017-08-07, Gender: Female, Area: , , , Guardian:  | ', 'pupil', 49, '2023-12-15 00:06:47', '2023-12-15 00:06:47'),
(14, 'Create', NULL, 'LRN: 111867070015, Name: Reginne Bonafente Regina , B-day: 2016-06-04, Gender: Female, Area: , , , Guardian:  | ', 'pupil', 49, '2023-12-15 00:08:39', '2023-12-15 00:08:39'),
(15, 'Create', NULL, 'LRN: 111867070016, Name: Mona Lepistus Ronna , B-day: 2016-09-17, Gender: Female, Area: , , , Guardian:  | ', 'pupil', 49, '2023-12-15 00:09:27', '2023-12-15 00:09:27'),
(16, 'Create', NULL, 'LRN: 111867070017, Name: Degree Gonta Zonta , B-day: 2017-05-02, Gender: Female, Area: , , , Guardian:  | ', 'pupil', 49, '2023-12-15 00:11:24', '2023-12-15 00:11:24'),
(17, 'Update', 'LRN: 12345678901, Name: John Michael \n                Doe Jr, B-day: 2018-01-15, Gender: Male, Area: Barangay A, Municipality A, Province A, Guardian: Guardian A | 1234567890', 'LRN: 12345678901, Name: John Michael Doe Jr, B-day: 2016-07-03, Gender: Male, Area: Barangay A, Municipality A, Province A, Guardian: Guardian A | 1234567890', 'pupil', 64, '2023-12-15 00:22:50', '2023-12-15 00:22:50'),
(18, 'Update', 'LRN: 23456789012, Name: Jane Marie \n                Smith Sr, B-day: 2017-05-22, Gender: Female, Area: Barangay B, Municipality B, Province B, Guardian: Guardian B | 9876543210', 'LRN: 23456789012, Name: Jane Marie Smith Sr, B-day: 2016-01-01, Gender: Female, Area: Barangay B, Municipality B, Province B, Guardian: Guardian B | 9876543210', 'pupil', 64, '2023-12-15 00:23:25', '2023-12-15 00:23:25'),
(19, 'Update', 'LRN: 34567890123, Name: Robert Lee \n                Johnson III, B-day: 2019-08-10, Gender: Male, Area: Barangay C, Municipality C, Province C, Guardian: Guardian C | 4567890123', 'LRN: 34567890123, Name: Robert Lee Johnson III, B-day: 2017-04-07, Gender: Male, Area: Barangay C, Municipality C, Province C, Guardian: Guardian C | 4567890123', 'pupil', 64, '2023-12-15 00:23:47', '2023-12-15 00:23:47'),
(20, 'Update', 'LRN: 34567890123, Name: Robert Lee \n                Johnson III, B-day: 2017-04-07, Gender: Male, Area: Barangay C, Municipality C, Province C, Guardian: Guardian C | 4567890123', 'LRN: 34567890123, Name: Robert Lee Johnson III, B-day: 2015-04-07, Gender: Male, Area: Barangay C, Municipality C, Province C, Guardian: Guardian C | 4567890123', 'pupil', 64, '2023-12-15 00:24:05', '2023-12-15 00:24:05'),
(21, 'Update', 'LRN: 45678901234, Name: Emily Grace \n                Williams Jr, B-day: 2017-12-05, Gender: Female, Area: Barangay D, Municipality D, Province D, Guardian: Guardian D | 7890123456', 'LRN: 45678901234, Name: Emily Grace Williams Jr, B-day: 2014-11-16, Gender: Female, Area: Barangay D, Municipality D, Province D, Guardian: Guardian D | 7890123456', 'pupil', 64, '2023-12-15 00:24:55', '2023-12-15 00:24:55'),
(22, 'Update', 'LRN: 56789012345, Name: Christopher John \n                Brown Sr, B-day: 2018-06-30, Gender: Male, Area: Barangay E, Municipality E, Province E, Guardian: Guardian E | 6543210987', 'LRN: 56789012345, Name: Christopher John Brown Sr, B-day: 2015-09-19, Gender: Male, Area: Barangay E, Municipality E, Province E, Guardian: Guardian E | 6543210987', 'pupil', 64, '2023-12-15 00:25:30', '2023-12-15 00:25:30'),
(23, 'Update', 'LRN: 67890123456, Name: Olivia Rose \n                Taylor Jr, B-day: 2017-09-18, Gender: Female, Area: Barangay F, Municipality F, Province F, Guardian: Guardian F | 7890123456', 'LRN: 67890123456, Name: Olivia Rose Taylor Jr, B-day: 2016-02-10, Gender: Female, Area: Barangay F, Municipality F, Province F, Guardian: Guardian F | 7890123456', 'pupil', 64, '2023-12-15 00:26:22', '2023-12-15 00:26:22'),
(24, 'Update', 'LRN: 78901234567, Name: William Alexander \n                Miller III, B-day: 2019-02-20, Gender: Male, Area: Barangay G, Municipality G, Province G, Guardian: Guardian G | 1234567890', 'LRN: 78901234567, Name: William Alexander Miller III, B-day: 2016-02-25, Gender: Male, Area: Barangay G, Municipality G, Province G, Guardian: Guardian G | 1234567890', 'pupil', 64, '2023-12-15 00:29:12', '2023-12-15 00:29:12'),
(25, 'Update', 'LRN: 89012345678, Name: Sophia Grace \n                Davis Jr, B-day: 2018-11-12, Gender: Female, Area: Barangay H, Municipality H, Province H, Guardian: Guardian H | 9876543210', 'LRN: 89012345678, Name: Sophia Grace Davis Jr, B-day: 2015-11-26, Gender: Female, Area: Barangay H, Municipality H, Province H, Guardian: Guardian H | 9876543210', 'pupil', 64, '2023-12-15 00:29:46', '2023-12-15 00:29:46'),
(26, 'Update', 'LRN: 90123456789, Name: Ethan James \n                Anderson Sr, B-day: 2017-04-08, Gender: Male, Area: Barangay I, Municipality I, Province I, Guardian: Guardian I | 4567890123', 'LRN: 90123456789, Name: Ethan James Anderson Sr, B-day: 2015-09-20, Gender: Male, Area: Barangay I, Municipality I, Province I, Guardian: Guardian I | 4567890123', 'pupil', 64, '2023-12-15 00:31:56', '2023-12-15 00:31:56'),
(27, 'Update', 'LRN: 01234567890, Name: Ava Elizabeth \n                Moore Jr, B-day: 2019-07-25, Gender: Female, Area: Barangay J, Municipality J, Province J, Guardian: Guardian J | 6543210987', 'LRN: 01234567890, Name: Ava Elizabeth Moore Jr, B-day: 2016-05-03, Gender: Female, Area: Barangay J, Municipality J, Province J, Guardian: Guardian J | 6543210987', 'pupil', 64, '2023-12-15 00:32:24', '2023-12-15 00:32:24'),
(28, 'Update', 'LRN: 12345478901, Name: Liam Alexander \n                Jackson Jr, B-day: 2016-02-10, Gender: Male, Area: Barangay A, Municipality A, Province A, Guardian: Guardian A | 1234567890', 'LRN: 12345478901, Name: Liam Alexander Jackson Jr, B-day: 2014-12-17, Gender: Male, Area: Barangay A, Municipality A, Province A, Guardian: Guardian A | 1234567890', 'pupil', 64, '2023-12-15 00:37:24', '2023-12-15 00:37:24'),
(29, 'Create', NULL, 'Pupil LRN: 111867070000, Class: 1, SchoolYear: 1', 'Pupil To Masterlist', 49, '2023-12-15 01:34:39', '2023-12-15 01:34:39'),
(30, 'Create', NULL, 'Pupil LRN: 111867070001, Class: 1, SchoolYear: 1', 'Pupil To Masterlist', 49, '2023-12-15 01:35:57', '2023-12-15 01:35:57'),
(31, 'Create', NULL, 'Pupil LRN: 111867070003, Class: 1, SchoolYear: 1', 'Pupil To Masterlist', 49, '2023-12-15 01:36:09', '2023-12-15 01:36:09'),
(32, 'Create', NULL, 'Pupil LRN: 111867070004, Class: 1, SchoolYear: 1', 'Pupil To Masterlist', 49, '2023-12-15 01:46:06', '2023-12-15 01:46:06'),
(33, 'Create', NULL, 'Pupil LRN: 111867070005, Class: 1, SchoolYear: 1', 'Pupil To Masterlist', 49, '2023-12-15 01:46:12', '2023-12-15 01:46:12'),
(34, 'Create', NULL, 'Pupil LRN: 111867070006, Class: 1, SchoolYear: 1', 'Pupil To Masterlist', 49, '2023-12-15 01:46:18', '2023-12-15 01:46:18'),
(35, 'Create', NULL, 'Pupil LRN: 111867070007, Class: 1, SchoolYear: 1', 'Pupil To Masterlist', 49, '2023-12-15 01:46:25', '2023-12-15 01:46:25'),
(36, 'Create', NULL, 'Pupil LRN: 111867070008, Class: 1, SchoolYear: 1', 'Pupil To Masterlist', 49, '2023-12-15 01:46:31', '2023-12-15 01:46:31'),
(37, 'Create', NULL, 'Pupil LRN: 111867070009, Class: 1, SchoolYear: 1', 'Pupil To Masterlist', 49, '2023-12-15 01:46:36', '2023-12-15 01:46:36'),
(38, 'Create', NULL, 'Pupil LRN: 111867070010, Class: 1, SchoolYear: 1', 'Pupil To Masterlist', 49, '2023-12-15 01:46:42', '2023-12-15 01:46:42'),
(39, 'Create', NULL, 'Pupil LRN: 111867070011, Class: 1, SchoolYear: 1', 'Pupil To Masterlist', 49, '2023-12-15 01:46:48', '2023-12-15 01:46:48'),
(40, 'Create', NULL, 'Pupil LRN: 111867070012, Class: 1, SchoolYear: 1', 'Pupil To Masterlist', 49, '2023-12-15 01:46:53', '2023-12-15 01:46:53'),
(41, 'Create', NULL, 'Pupil LRN: 111867070013, Class: 1, SchoolYear: 1', 'Pupil To Masterlist', 49, '2023-12-15 01:46:58', '2023-12-15 01:46:58'),
(42, 'Create', NULL, 'Pupil LRN: 111867070015, Class: 1, SchoolYear: 1', 'Pupil To Masterlist', 49, '2023-12-15 01:47:04', '2023-12-15 01:47:04'),
(43, 'Create', NULL, 'Pupil LRN: 111867070016, Class: 1, SchoolYear: 1', 'Pupil To Masterlist', 49, '2023-12-15 01:47:09', '2023-12-15 01:47:09'),
(44, 'Create', NULL, 'Pupil LRN: 111867070017, Class: 1, SchoolYear: 1', 'Pupil To Masterlist', 49, '2023-12-15 01:47:15', '2023-12-15 01:47:15'),
(45, 'Create', NULL, 'PNA Code: 49-11-K-111867070000, Pupil ID: 1, Class Adviser ID: , Class ID: 1, School Year ID: 1, Height: 1.07, Weight: 11.00, Allergies: , Dietary Restriction: , Explanation: , Is Dewormed: 0, Is Permitted Deworming: 0, Dewormed Date: ', 'Pupil nutritional assessment', 49, '2023-12-15 02:15:25', '2023-12-15 02:15:25'),
(46, 'Create', NULL, 'PNA Code: 49-11-K-111867070001, Pupil ID: 2, Class Adviser ID: , Class ID: 1, School Year ID: 1, Height: 1.09, Weight: 16.00, Allergies: , Dietary Restriction: , Explanation: , Is Dewormed: 0, Is Permitted Deworming: 0, Dewormed Date: ', 'Pupil nutritional assessment', 49, '2023-12-15 02:16:01', '2023-12-15 02:16:01'),
(47, 'Create', NULL, 'PNA Code: 49-11-K-111867070003, Pupil ID: 3, Class Adviser ID: , Class ID: 1, School Year ID: 1, Height: 0.99, Weight: 13.00, Allergies: , Dietary Restriction: , Explanation: , Is Dewormed: 0, Is Permitted Deworming: 0, Dewormed Date: ', 'Pupil nutritional assessment', 49, '2023-12-15 02:17:00', '2023-12-15 02:17:00'),
(48, 'Create', NULL, 'PNA Code: 49-11-K-111867070004, Pupil ID: 4, Class Adviser ID: , Class ID: 1, School Year ID: 1, Height: 1.09, Weight: 14.00, Allergies: , Dietary Restriction: , Explanation: , Is Dewormed: 0, Is Permitted Deworming: 0, Dewormed Date: ', 'Pupil nutritional assessment', 49, '2023-12-15 02:19:48', '2023-12-15 02:19:48'),
(49, 'Create', NULL, 'PNA Code: 49-11-K-111867070005, Pupil ID: 5, Class Adviser ID: , Class ID: 1, School Year ID: 1, Height: 1.13, Weight: 24.00, Allergies: , Dietary Restriction: , Explanation: , Is Dewormed: 0, Is Permitted Deworming: 0, Dewormed Date: ', 'Pupil nutritional assessment', 49, '2023-12-15 02:20:16', '2023-12-15 02:20:16'),
(50, 'Create', NULL, 'PNA Code: 49-11-K-111867070006, Pupil ID: 6, Class Adviser ID: , Class ID: 1, School Year ID: 1, Height: 1.16, Weight: 20.00, Allergies: , Dietary Restriction: , Explanation: , Is Dewormed: 0, Is Permitted Deworming: 0, Dewormed Date: ', 'Pupil nutritional assessment', 49, '2023-12-15 02:21:18', '2023-12-15 02:21:18'),
(51, 'Create', NULL, 'PNA Code: 49-11-K-111867070007, Pupil ID: 7, Class Adviser ID: , Class ID: 1, School Year ID: 1, Height: 1.09, Weight: 16.00, Allergies: , Dietary Restriction: , Explanation: , Is Dewormed: 0, Is Permitted Deworming: 0, Dewormed Date: ', 'Pupil nutritional assessment', 49, '2023-12-15 02:21:59', '2023-12-15 02:21:59'),
(52, 'Create', NULL, 'PNA Code: 49-11-K-111867070008, Pupil ID: 8, Class Adviser ID: , Class ID: 1, School Year ID: 1, Height: 1.10, Weight: 19.00, Allergies: , Dietary Restriction: , Explanation: , Is Dewormed: 0, Is Permitted Deworming: 0, Dewormed Date: ', 'Pupil nutritional assessment', 49, '2023-12-15 02:23:25', '2023-12-15 02:23:25'),
(53, 'Create', NULL, 'PNA Code: 49-11-K-111867070009, Pupil ID: 9, Class Adviser ID: , Class ID: 1, School Year ID: 1, Height: 1.17, Weight: 24.00, Allergies: , Dietary Restriction: , Explanation: , Is Dewormed: 0, Is Permitted Deworming: 0, Dewormed Date: ', 'Pupil nutritional assessment', 49, '2023-12-15 02:23:50', '2023-12-15 02:23:50'),
(54, 'Create', NULL, 'PNA Code: 49-11-K-111867070010, Pupil ID: 10, Class Adviser ID: , Class ID: 1, School Year ID: 1, Height: 1.09, Weight: 16.00, Allergies: , Dietary Restriction: , Explanation: , Is Dewormed: 0, Is Permitted Deworming: 0, Dewormed Date: ', 'Pupil nutritional assessment', 49, '2023-12-15 02:25:38', '2023-12-15 02:25:38'),
(55, 'Create', NULL, 'PNA Code: 49-11-K-111867070011, Pupil ID: 11, Class Adviser ID: , Class ID: 1, School Year ID: 1, Height: 1.09, Weight: 19.00, Allergies: , Dietary Restriction: , Explanation: , Is Dewormed: 0, Is Permitted Deworming: 0, Dewormed Date: ', 'Pupil nutritional assessment', 49, '2023-12-15 02:26:09', '2023-12-15 02:26:09'),
(56, 'Create', NULL, 'PNA Code: 49-11-K-111867070012, Pupil ID: 12, Class Adviser ID: , Class ID: 1, School Year ID: 1, Height: 1.00, Weight: 13.00, Allergies: , Dietary Restriction: , Explanation: , Is Dewormed: 0, Is Permitted Deworming: 0, Dewormed Date: ', 'Pupil nutritional assessment', 49, '2023-12-15 02:26:43', '2023-12-15 02:26:43'),
(57, 'Create', NULL, 'PNA Code: 49-11-K-111867070013, Pupil ID: 13, Class Adviser ID: , Class ID: 1, School Year ID: 1, Height: 1.08, Weight: 16.00, Allergies: , Dietary Restriction: , Explanation: , Is Dewormed: 0, Is Permitted Deworming: 0, Dewormed Date: ', 'Pupil nutritional assessment', 49, '2023-12-15 02:29:23', '2023-12-15 02:29:23'),
(58, 'Create', NULL, 'PNA Code: 49-11-K-111867070015, Pupil ID: 14, Class Adviser ID: , Class ID: 1, School Year ID: 1, Height: 1.07, Weight: 16.00, Allergies: , Dietary Restriction: , Explanation: , Is Dewormed: 0, Is Permitted Deworming: 0, Dewormed Date: ', 'Pupil nutritional assessment', 49, '2023-12-15 02:30:01', '2023-12-15 02:30:01'),
(59, 'Create', NULL, 'PNA Code: 49-11-K-111867070016, Pupil ID: 15, Class Adviser ID: , Class ID: 1, School Year ID: 1, Height: 1.19, Weight: 23.00, Allergies: , Dietary Restriction: , Explanation: , Is Dewormed: 0, Is Permitted Deworming: 0, Dewormed Date: ', 'Pupil nutritional assessment', 49, '2023-12-15 02:31:08', '2023-12-15 02:31:08'),
(60, 'Create', NULL, 'PNA Code: 49-11-K-111867070017, Pupil ID: 16, Class Adviser ID: , Class ID: 1, School Year ID: 1, Height: 1.03, Weight: 15.00, Allergies: , Dietary Restriction: , Explanation: , Is Dewormed: 0, Is Permitted Deworming: 0, Dewormed Date: ', 'Pupil nutritional assessment', 49, '2023-12-15 02:31:42', '2023-12-15 02:31:42'),
(61, 'Update', 'LRN: 111867070017, Name: Degree Gonta \n                Zonta , B-day: 2017-05-02, Gender: Female, Area: , , , Guardian:  | ', 'LRN: 111867070017, Name: Degree Gonta Zonta , B-day: 2017-05-02, Gender: Female, Area: , , , Guardian:  | ', 'pupil', 49, '2023-12-16 18:59:14', '2023-12-16 18:59:14'),
(62, 'Update', 'Height: 1.03, Weight: 15.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 0, Dietary Restriction: , Explanation: ', 'nutritionalAssessmentRecord: {\"id\":16,\"pna_code\":\"49-11-K-111867070017\",\"nsr_id\":1,\"pupil_id\":16,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.03\",\"weight\":\"15.00\",\"bmi\":null,\"hfa\":null,\"is_dewormed\":\"0\",\"dewormed_date\":null,\"is_permitted_deworming\":\"0\",\"explanation\":null,\"dietary_restriction\":null,\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:31:42.000000Z\",\"updated_at\":\"2023-12-16T01:07:54.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 19:25:33', '2023-12-16 19:25:33'),
(63, 'Update', 'Height: 1.19, Weight: 23.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 0, Dietary Restriction: , Explanation: ', 'nutritionalAssessmentRecord: {\"id\":15,\"pna_code\":\"49-11-K-111867070016\",\"nsr_id\":1,\"pupil_id\":15,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.19\",\"weight\":\"23.00\",\"bmi\":null,\"hfa\":null,\"is_dewormed\":\"0\",\"dewormed_date\":null,\"is_permitted_deworming\":\"0\",\"explanation\":null,\"dietary_restriction\":null,\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:31:08.000000Z\",\"updated_at\":\"2023-12-16T01:07:54.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 19:27:35', '2023-12-16 19:27:35'),
(64, 'Update', 'Height: 1.07, Weight: 16.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 0, Dietary Restriction: , Explanation: ', 'nutritionalAssessmentRecord: {\"id\":14,\"pna_code\":\"49-11-K-111867070015\",\"nsr_id\":1,\"pupil_id\":14,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.07\",\"weight\":\"16.00\",\"bmi\":null,\"hfa\":null,\"is_dewormed\":\"0\",\"dewormed_date\":null,\"is_permitted_deworming\":\"0\",\"explanation\":null,\"dietary_restriction\":null,\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:30:01.000000Z\",\"updated_at\":\"2023-12-16T01:07:54.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 19:30:07', '2023-12-16 19:30:07'),
(65, 'Update', 'Height: 1.07, Weight: 16.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 0, Dietary Restriction: , Explanation: ', 'nutritionalAssessmentRecord: {\"id\":14,\"pna_code\":\"49-11-K-111867070015\",\"nsr_id\":1,\"pupil_id\":14,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.07\",\"weight\":\"16.00\",\"bmi\":\"Severely Wasted\",\"hfa\":\"Normal\",\"is_dewormed\":\"0\",\"dewormed_date\":\"\",\"is_permitted_deworming\":\"0\",\"explanation\":\"\",\"dietary_restriction\":\"\",\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:30:01.000000Z\",\"updated_at\":\"2023-12-16T19:30:07.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 19:31:06', '2023-12-16 19:31:06'),
(66, 'Update', 'Height: 1.07, Weight: 16.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 1, Dietary Restriction: Allergic To Eggs, Explanation: ', 'nutritionalAssessmentRecord: {\"id\":14,\"pna_code\":\"49-11-K-111867070015\",\"nsr_id\":1,\"pupil_id\":14,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.07\",\"weight\":\"16.00\",\"bmi\":\"Severely Wasted\",\"hfa\":\"Normal\",\"is_dewormed\":\"0\",\"dewormed_date\":\"\",\"is_permitted_deworming\":\"1\",\"explanation\":\"\",\"dietary_restriction\":\"Allergic To Eggs\",\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:30:01.000000Z\",\"updated_at\":\"2023-12-16T19:31:06.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 19:31:58', '2023-12-16 19:31:58'),
(67, 'Update', 'Height: 1.08, Weight: 16.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 0, Dietary Restriction: , Explanation: ', 'nutritionalAssessmentRecord: {\"id\":13,\"pna_code\":\"49-11-K-111867070013\",\"nsr_id\":1,\"pupil_id\":13,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.08\",\"weight\":\"16.00\",\"bmi\":null,\"hfa\":null,\"is_dewormed\":\"0\",\"dewormed_date\":null,\"is_permitted_deworming\":\"0\",\"explanation\":null,\"dietary_restriction\":null,\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:29:23.000000Z\",\"updated_at\":\"2023-12-16T01:07:54.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 19:32:24', '2023-12-16 19:32:24'),
(68, 'Update', 'Height: 1.00, Weight: 13.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 0, Dietary Restriction: , Explanation: ', 'nutritionalAssessmentRecord: {\"id\":12,\"pna_code\":\"49-11-K-111867070012\",\"nsr_id\":1,\"pupil_id\":12,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.00\",\"weight\":\"13.00\",\"bmi\":null,\"hfa\":null,\"is_dewormed\":\"0\",\"dewormed_date\":null,\"is_permitted_deworming\":\"0\",\"explanation\":null,\"dietary_restriction\":null,\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:26:43.000000Z\",\"updated_at\":\"2023-12-16T01:07:54.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 19:32:34', '2023-12-16 19:32:34'),
(69, 'Update', 'Height: 1.09, Weight: 19.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 0, Dietary Restriction: , Explanation: ', 'nutritionalAssessmentRecord: {\"id\":11,\"pna_code\":\"49-11-K-111867070011\",\"nsr_id\":1,\"pupil_id\":11,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.09\",\"weight\":\"19.00\",\"bmi\":null,\"hfa\":null,\"is_dewormed\":\"0\",\"dewormed_date\":null,\"is_permitted_deworming\":\"0\",\"explanation\":null,\"dietary_restriction\":null,\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:26:09.000000Z\",\"updated_at\":\"2023-12-16T01:07:54.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 19:32:43', '2023-12-16 19:32:43'),
(70, 'Update', 'Height: 1.09, Weight: 16.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 0, Dietary Restriction: , Explanation: ', 'nutritionalAssessmentRecord: {\"id\":10,\"pna_code\":\"49-11-K-111867070010\",\"nsr_id\":1,\"pupil_id\":10,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.09\",\"weight\":\"16.00\",\"bmi\":null,\"hfa\":null,\"is_dewormed\":\"0\",\"dewormed_date\":null,\"is_permitted_deworming\":\"0\",\"explanation\":null,\"dietary_restriction\":null,\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:25:38.000000Z\",\"updated_at\":\"2023-12-16T01:07:54.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 19:32:52', '2023-12-16 19:32:52'),
(71, 'Update', 'Height: 1.17, Weight: 24.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 0, Dietary Restriction: , Explanation: ', 'nutritionalAssessmentRecord: {\"id\":9,\"pna_code\":\"49-11-K-111867070009\",\"nsr_id\":1,\"pupil_id\":9,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.17\",\"weight\":\"24.00\",\"bmi\":null,\"hfa\":null,\"is_dewormed\":\"0\",\"dewormed_date\":null,\"is_permitted_deworming\":\"0\",\"explanation\":null,\"dietary_restriction\":null,\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:23:50.000000Z\",\"updated_at\":\"2023-12-16T01:07:54.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 19:33:02', '2023-12-16 19:33:02'),
(72, 'Update', 'Height: 1.09, Weight: 19.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 0, Dietary Restriction: , Explanation: ', 'nutritionalAssessmentRecord: {\"id\":11,\"pna_code\":\"49-11-K-111867070011\",\"nsr_id\":1,\"pupil_id\":11,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.09\",\"weight\":\"19.00\",\"bmi\":\"Severely Wasted\",\"hfa\":\"Normal\",\"is_dewormed\":\"0\",\"dewormed_date\":\"\",\"is_permitted_deworming\":\"0\",\"explanation\":\"\",\"dietary_restriction\":\"\",\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:26:09.000000Z\",\"updated_at\":\"2023-12-16T19:32:43.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 19:33:12', '2023-12-16 19:33:12'),
(73, 'Update', 'Height: 1.09, Weight: 16.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 0, Dietary Restriction: , Explanation: ', 'nutritionalAssessmentRecord: {\"id\":10,\"pna_code\":\"49-11-K-111867070010\",\"nsr_id\":1,\"pupil_id\":10,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.09\",\"weight\":\"16.00\",\"bmi\":\"Severely Wasted\",\"hfa\":\"Normal\",\"is_dewormed\":\"0\",\"dewormed_date\":\"\",\"is_permitted_deworming\":\"0\",\"explanation\":\"\",\"dietary_restriction\":\"\",\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:25:38.000000Z\",\"updated_at\":\"2023-12-16T19:32:52.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 19:33:24', '2023-12-16 19:33:24'),
(74, 'Update', 'Height: 1.17, Weight: 24.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 0, Dietary Restriction: , Explanation: ', 'nutritionalAssessmentRecord: {\"id\":9,\"pna_code\":\"49-11-K-111867070009\",\"nsr_id\":1,\"pupil_id\":9,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.17\",\"weight\":\"24.00\",\"bmi\":\"Severely Wasted\",\"hfa\":\"Normal\",\"is_dewormed\":\"0\",\"dewormed_date\":\"\",\"is_permitted_deworming\":\"0\",\"explanation\":\"\",\"dietary_restriction\":\"\",\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:23:50.000000Z\",\"updated_at\":\"2023-12-16T19:33:02.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 19:33:33', '2023-12-16 19:33:33'),
(75, 'Update', 'Height: 1.10, Weight: 19.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 0, Dietary Restriction: , Explanation: ', 'nutritionalAssessmentRecord: {\"id\":8,\"pna_code\":\"49-11-K-111867070008\",\"nsr_id\":1,\"pupil_id\":8,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.10\",\"weight\":\"19.00\",\"bmi\":null,\"hfa\":null,\"is_dewormed\":\"0\",\"dewormed_date\":null,\"is_permitted_deworming\":\"0\",\"explanation\":null,\"dietary_restriction\":null,\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:23:25.000000Z\",\"updated_at\":\"2023-12-16T01:07:54.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 19:33:42', '2023-12-16 19:33:42'),
(76, 'Update', 'Height: 1.09, Weight: 16.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 0, Dietary Restriction: , Explanation: ', 'nutritionalAssessmentRecord: {\"id\":7,\"pna_code\":\"49-11-K-111867070007\",\"nsr_id\":1,\"pupil_id\":7,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.09\",\"weight\":\"16.00\",\"bmi\":null,\"hfa\":null,\"is_dewormed\":\"0\",\"dewormed_date\":null,\"is_permitted_deworming\":\"0\",\"explanation\":null,\"dietary_restriction\":null,\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:21:59.000000Z\",\"updated_at\":\"2023-12-16T01:07:54.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 19:33:52', '2023-12-16 19:33:52'),
(77, 'Update', 'Height: 1.16, Weight: 20.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 0, Dietary Restriction: , Explanation: ', 'nutritionalAssessmentRecord: {\"id\":6,\"pna_code\":\"49-11-K-111867070006\",\"nsr_id\":1,\"pupil_id\":6,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.16\",\"weight\":\"20.00\",\"bmi\":null,\"hfa\":null,\"is_dewormed\":\"0\",\"dewormed_date\":null,\"is_permitted_deworming\":\"0\",\"explanation\":null,\"dietary_restriction\":null,\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:21:18.000000Z\",\"updated_at\":\"2023-12-16T01:07:54.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 19:34:03', '2023-12-16 19:34:03'),
(78, 'Update', 'Height: 1.13, Weight: 24.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 0, Dietary Restriction: , Explanation: ', 'nutritionalAssessmentRecord: {\"id\":5,\"pna_code\":\"49-11-K-111867070005\",\"nsr_id\":1,\"pupil_id\":5,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.13\",\"weight\":\"24.00\",\"bmi\":null,\"hfa\":null,\"is_dewormed\":\"0\",\"dewormed_date\":null,\"is_permitted_deworming\":\"0\",\"explanation\":null,\"dietary_restriction\":null,\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:20:16.000000Z\",\"updated_at\":\"2023-12-16T01:07:54.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 19:34:12', '2023-12-16 19:34:12'),
(79, 'Update', 'Height: 1.09, Weight: 14.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 0, Dietary Restriction: , Explanation: ', 'nutritionalAssessmentRecord: {\"id\":4,\"pna_code\":\"49-11-K-111867070004\",\"nsr_id\":1,\"pupil_id\":4,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.09\",\"weight\":\"14.00\",\"bmi\":null,\"hfa\":null,\"is_dewormed\":\"0\",\"dewormed_date\":null,\"is_permitted_deworming\":\"0\",\"explanation\":null,\"dietary_restriction\":null,\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:19:48.000000Z\",\"updated_at\":\"2023-12-16T01:07:54.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 19:34:22', '2023-12-16 19:34:22'),
(80, 'Update', 'Height: 0.99, Weight: 13.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 0, Dietary Restriction: , Explanation: ', 'nutritionalAssessmentRecord: {\"id\":3,\"pna_code\":\"49-11-K-111867070003\",\"nsr_id\":1,\"pupil_id\":3,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"0.99\",\"weight\":\"13.00\",\"bmi\":null,\"hfa\":null,\"is_dewormed\":\"0\",\"dewormed_date\":null,\"is_permitted_deworming\":\"0\",\"explanation\":null,\"dietary_restriction\":null,\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:17:00.000000Z\",\"updated_at\":\"2023-12-16T01:07:54.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 19:34:30', '2023-12-16 19:34:30'),
(81, 'Update', 'Height: 1.09, Weight: 16.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 0, Dietary Restriction: , Explanation: ', 'nutritionalAssessmentRecord: {\"id\":2,\"pna_code\":\"49-11-K-111867070001\",\"nsr_id\":1,\"pupil_id\":2,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.09\",\"weight\":\"16.00\",\"bmi\":null,\"hfa\":null,\"is_dewormed\":\"0\",\"dewormed_date\":null,\"is_permitted_deworming\":\"0\",\"explanation\":null,\"dietary_restriction\":null,\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:16:00.000000Z\",\"updated_at\":\"2023-12-16T01:07:54.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 19:34:40', '2023-12-16 19:34:40'),
(82, 'Update', 'Height: 1.07, Weight: 11.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 0, Dietary Restriction: , Explanation: ', 'nutritionalAssessmentRecord: {\"id\":1,\"pna_code\":\"49-11-K-111867070000\",\"nsr_id\":1,\"pupil_id\":1,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.07\",\"weight\":\"11.00\",\"bmi\":null,\"hfa\":null,\"is_dewormed\":\"0\",\"dewormed_date\":null,\"is_permitted_deworming\":\"0\",\"explanation\":null,\"dietary_restriction\":null,\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:15:25.000000Z\",\"updated_at\":\"2023-12-16T01:07:54.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 19:34:48', '2023-12-16 19:34:48'),
(83, 'Update', 'Height: 1.03, Weight: 15.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 1, Dietary Restriction: Vegetarian, Explanation: ', 'nutritionalAssessmentRecord: {\"id\":16,\"pna_code\":\"49-11-K-111867070017\",\"nsr_id\":1,\"pupil_id\":16,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.03\",\"weight\":\"15.00\",\"bmi\":\"Severely Wasted\",\"hfa\":\"Normal\",\"is_dewormed\":\"0\",\"dewormed_date\":\"\",\"is_permitted_deworming\":\"1\",\"explanation\":\"\",\"dietary_restriction\":\"Vegetarian\",\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:31:42.000000Z\",\"updated_at\":\"2023-12-16T19:25:33.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 19:37:12', '2023-12-16 19:37:12'),
(84, 'Update', 'Height: 1.03, Weight: 15.00, Is Dewormed: 1, Dewormed Date: , Is Permitted Deworming: 1, Dietary Restriction: Vegetarian, Explanation: ', 'nutritionalAssessmentRecord: {\"id\":16,\"pna_code\":\"49-11-K-111867070017\",\"nsr_id\":1,\"pupil_id\":16,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.03\",\"weight\":\"15.00\",\"bmi\":\"Severely Wasted\",\"hfa\":\"Normal\",\"is_dewormed\":\"1\",\"dewormed_date\":\"\",\"is_permitted_deworming\":\"1\",\"explanation\":\"\",\"dietary_restriction\":\"Vegetarian\",\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:31:42.000000Z\",\"updated_at\":\"2023-12-16T19:40:16.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 19:46:38', '2023-12-16 19:46:38'),
(85, 'Update', 'Height: 1.19, Weight: 23.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 1, Dietary Restriction: Allergic To Eggs, Explanation: ', 'nutritionalAssessmentRecord: {\"id\":15,\"pna_code\":\"49-11-K-111867070016\",\"nsr_id\":1,\"pupil_id\":15,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.19\",\"weight\":\"23.00\",\"bmi\":\"Severely Wasted\",\"hfa\":\"Normal\",\"is_dewormed\":\"0\",\"dewormed_date\":\"\",\"is_permitted_deworming\":\"1\",\"explanation\":\"\",\"dietary_restriction\":\"Allergic To Eggs\",\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:31:08.000000Z\",\"updated_at\":\"2023-12-16T19:40:16.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 19:46:47', '2023-12-16 19:46:47'),
(86, 'Update', 'Height: 1.03, Weight: 15.00, Is Dewormed: 1, Dewormed Date: , Is Permitted Deworming: 1, Dietary Restriction: Vegetarian, Explanation: ', 'nutritionalAssessmentRecord: {\"id\":16,\"pna_code\":\"49-11-K-111867070017\",\"nsr_id\":1,\"pupil_id\":16,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.03\",\"weight\":\"15.00\",\"bmi\":\"Obese\",\"hfa\":\"Normal\",\"is_dewormed\":\"1\",\"dewormed_date\":\"\",\"is_permitted_deworming\":\"1\",\"explanation\":\"\",\"dietary_restriction\":\"Vegetarian\",\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:31:42.000000Z\",\"updated_at\":\"2023-12-16T19:46:38.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 19:48:48', '2023-12-16 19:48:48'),
(87, 'Update', 'Height: 1.19, Weight: 23.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 1, Dietary Restriction: Allergic To Eggs, Explanation: ', 'nutritionalAssessmentRecord: {\"id\":15,\"pna_code\":\"49-11-K-111867070016\",\"nsr_id\":1,\"pupil_id\":15,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.19\",\"weight\":\"23.00\",\"bmi\":\"Obese\",\"hfa\":\"Normal\",\"is_dewormed\":\"0\",\"dewormed_date\":\"\",\"is_permitted_deworming\":\"1\",\"explanation\":\"\",\"dietary_restriction\":\"Allergic To Eggs\",\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:31:08.000000Z\",\"updated_at\":\"2023-12-16T19:46:47.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 19:49:02', '2023-12-16 19:49:02'),
(88, 'Update', 'Height: 1.07, Weight: 16.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 1, Dietary Restriction: Allergic To Eggs, Explanation: ', 'nutritionalAssessmentRecord: {\"id\":14,\"pna_code\":\"49-11-K-111867070015\",\"nsr_id\":1,\"pupil_id\":14,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.07\",\"weight\":\"16.00\",\"bmi\":\"Severely Wasted\",\"hfa\":\"Normal\",\"is_dewormed\":\"0\",\"dewormed_date\":\"\",\"is_permitted_deworming\":\"1\",\"explanation\":\"\",\"dietary_restriction\":\"Allergic To Eggs\",\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:30:01.000000Z\",\"updated_at\":\"2023-12-16T19:40:16.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 19:51:01', '2023-12-16 19:51:01'),
(89, 'Update', 'Height: 1.08, Weight: 16.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 0, Dietary Restriction: , Explanation: ', 'nutritionalAssessmentRecord: {\"id\":13,\"pna_code\":\"49-11-K-111867070013\",\"nsr_id\":1,\"pupil_id\":13,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.08\",\"weight\":\"16.00\",\"bmi\":\"Severely Wasted\",\"hfa\":\"Normal\",\"is_dewormed\":\"0\",\"dewormed_date\":\"\",\"is_permitted_deworming\":\"0\",\"explanation\":\"\",\"dietary_restriction\":\"\",\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:29:23.000000Z\",\"updated_at\":\"2023-12-16T19:40:16.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 19:51:19', '2023-12-16 19:51:19'),
(90, 'Update', 'Height: 1.08, Weight: 16.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 0, Dietary Restriction: , Explanation: ', 'nutritionalAssessmentRecord: {\"id\":13,\"pna_code\":\"49-11-K-111867070013\",\"nsr_id\":1,\"pupil_id\":13,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.08\",\"weight\":\"16.00\",\"bmi\":\"Severely Wasted\",\"hfa\":\"Normal\",\"is_dewormed\":\"0\",\"dewormed_date\":\"\",\"is_permitted_deworming\":\"0\",\"explanation\":\"\",\"dietary_restriction\":\"\",\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:29:23.000000Z\",\"updated_at\":\"2023-12-16T19:40:16.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 19:51:29', '2023-12-16 19:51:29'),
(91, 'Update', 'Height: 1.00, Weight: 13.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 0, Dietary Restriction: , Explanation: ', 'nutritionalAssessmentRecord: {\"id\":12,\"pna_code\":\"49-11-K-111867070012\",\"nsr_id\":1,\"pupil_id\":12,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.00\",\"weight\":\"13.00\",\"bmi\":\"Severely Wasted\",\"hfa\":\"Normal\",\"is_dewormed\":\"0\",\"dewormed_date\":\"\",\"is_permitted_deworming\":\"0\",\"explanation\":\"\",\"dietary_restriction\":\"\",\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:26:43.000000Z\",\"updated_at\":\"2023-12-16T19:40:16.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 19:51:37', '2023-12-16 19:51:37'),
(92, 'Update', 'Height: 1.00, Weight: 13.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 0, Dietary Restriction: , Explanation: ', 'nutritionalAssessmentRecord: {\"id\":12,\"pna_code\":\"49-11-K-111867070012\",\"nsr_id\":1,\"pupil_id\":12,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.00\",\"weight\":\"13.00\",\"bmi\":\"Severely Wasted\",\"hfa\":\"Normal\",\"is_dewormed\":\"0\",\"dewormed_date\":\"\",\"is_permitted_deworming\":\"0\",\"explanation\":\"\",\"dietary_restriction\":\"\",\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:26:43.000000Z\",\"updated_at\":\"2023-12-16T19:40:16.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 19:51:47', '2023-12-16 19:51:47'),
(93, 'Update', 'Height: 1.09, Weight: 19.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 0, Dietary Restriction: , Explanation: ', 'nutritionalAssessmentRecord: {\"id\":11,\"pna_code\":\"49-11-K-111867070011\",\"nsr_id\":1,\"pupil_id\":11,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.09\",\"weight\":\"19.00\",\"bmi\":\"Severely Wasted\",\"hfa\":\"Normal\",\"is_dewormed\":\"0\",\"dewormed_date\":\"\",\"is_permitted_deworming\":\"0\",\"explanation\":\"\",\"dietary_restriction\":\"\",\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:26:09.000000Z\",\"updated_at\":\"2023-12-16T19:40:16.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 19:51:55', '2023-12-16 19:51:55'),
(94, 'Update', 'Height: 1.09, Weight: 19.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 0, Dietary Restriction: , Explanation: ', 'nutritionalAssessmentRecord: {\"id\":11,\"pna_code\":\"49-11-K-111867070011\",\"nsr_id\":1,\"pupil_id\":11,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.09\",\"weight\":\"19.00\",\"bmi\":\"Severely Wasted\",\"hfa\":\"Normal\",\"is_dewormed\":\"0\",\"dewormed_date\":\"\",\"is_permitted_deworming\":\"0\",\"explanation\":\"\",\"dietary_restriction\":\"\",\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:26:09.000000Z\",\"updated_at\":\"2023-12-16T19:40:16.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 19:56:23', '2023-12-16 19:56:23'),
(95, 'Update', 'Height: 1.09, Weight: 16.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 0, Dietary Restriction: , Explanation: ', 'nutritionalAssessmentRecord: {\"id\":10,\"pna_code\":\"49-11-K-111867070010\",\"nsr_id\":1,\"pupil_id\":10,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.09\",\"weight\":\"16.00\",\"bmi\":\"Severely Wasted\",\"hfa\":\"Normal\",\"is_dewormed\":\"0\",\"dewormed_date\":\"\",\"is_permitted_deworming\":\"0\",\"explanation\":\"\",\"dietary_restriction\":\"\",\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:25:38.000000Z\",\"updated_at\":\"2023-12-16T19:40:16.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 19:56:33', '2023-12-16 19:56:33'),
(96, 'Update', 'Height: 1.09, Weight: 16.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 0, Dietary Restriction: , Explanation: ', 'nutritionalAssessmentRecord: {\"id\":10,\"pna_code\":\"49-11-K-111867070010\",\"nsr_id\":1,\"pupil_id\":10,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.09\",\"weight\":\"16.00\",\"bmi\":\"Severely Wasted\",\"hfa\":\"Normal\",\"is_dewormed\":\"0\",\"dewormed_date\":\"\",\"is_permitted_deworming\":\"0\",\"explanation\":\"\",\"dietary_restriction\":\"\",\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:25:38.000000Z\",\"updated_at\":\"2023-12-16T19:40:16.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 19:56:45', '2023-12-16 19:56:45'),
(97, 'Update', 'Height: 1.17, Weight: 24.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 0, Dietary Restriction: , Explanation: ', 'nutritionalAssessmentRecord: {\"id\":9,\"pna_code\":\"49-11-K-111867070009\",\"nsr_id\":1,\"pupil_id\":9,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.17\",\"weight\":\"24.00\",\"bmi\":\"Severely Wasted\",\"hfa\":\"Normal\",\"is_dewormed\":\"0\",\"dewormed_date\":\"\",\"is_permitted_deworming\":\"0\",\"explanation\":\"\",\"dietary_restriction\":\"\",\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:23:50.000000Z\",\"updated_at\":\"2023-12-16T19:40:16.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 19:56:53', '2023-12-16 19:56:53'),
(98, 'Update', 'Height: 1.10, Weight: 19.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 0, Dietary Restriction: , Explanation: ', 'nutritionalAssessmentRecord: {\"id\":8,\"pna_code\":\"49-11-K-111867070008\",\"nsr_id\":1,\"pupil_id\":8,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.10\",\"weight\":\"19.00\",\"bmi\":\"Severely Wasted\",\"hfa\":\"Normal\",\"is_dewormed\":\"0\",\"dewormed_date\":\"\",\"is_permitted_deworming\":\"0\",\"explanation\":\"\",\"dietary_restriction\":\"\",\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:23:25.000000Z\",\"updated_at\":\"2023-12-16T19:40:16.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 19:57:04', '2023-12-16 19:57:04'),
(99, 'Update', 'Height: 1.10, Weight: 19.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 0, Dietary Restriction: , Explanation: ', 'nutritionalAssessmentRecord: {\"id\":8,\"pna_code\":\"49-11-K-111867070008\",\"nsr_id\":1,\"pupil_id\":8,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.10\",\"weight\":\"19.00\",\"bmi\":\"Severely Wasted\",\"hfa\":\"Normal\",\"is_dewormed\":\"0\",\"dewormed_date\":\"\",\"is_permitted_deworming\":\"0\",\"explanation\":\"\",\"dietary_restriction\":\"\",\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:23:25.000000Z\",\"updated_at\":\"2023-12-16T19:40:16.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 19:57:15', '2023-12-16 19:57:15'),
(100, 'Update', 'Height: 1.09, Weight: 16.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 0, Dietary Restriction: , Explanation: ', 'nutritionalAssessmentRecord: {\"id\":7,\"pna_code\":\"49-11-K-111867070007\",\"nsr_id\":1,\"pupil_id\":7,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.09\",\"weight\":\"16.00\",\"bmi\":\"Severely Wasted\",\"hfa\":\"Normal\",\"is_dewormed\":\"0\",\"dewormed_date\":\"\",\"is_permitted_deworming\":\"0\",\"explanation\":\"\",\"dietary_restriction\":\"\",\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:21:59.000000Z\",\"updated_at\":\"2023-12-16T19:40:16.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 19:57:24', '2023-12-16 19:57:24'),
(101, 'Update', 'Height: 1.16, Weight: 20.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 0, Dietary Restriction: , Explanation: ', 'nutritionalAssessmentRecord: {\"id\":6,\"pna_code\":\"49-11-K-111867070006\",\"nsr_id\":1,\"pupil_id\":6,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.16\",\"weight\":\"20.00\",\"bmi\":\"Severely Wasted\",\"hfa\":\"Normal\",\"is_dewormed\":\"0\",\"dewormed_date\":\"\",\"is_permitted_deworming\":\"0\",\"explanation\":\"\",\"dietary_restriction\":\"\",\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:21:18.000000Z\",\"updated_at\":\"2023-12-16T19:40:16.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 19:57:33', '2023-12-16 19:57:33'),
(102, 'Update', 'Height: 1.09, Weight: 14.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 0, Dietary Restriction: , Explanation: ', 'nutritionalAssessmentRecord: {\"id\":4,\"pna_code\":\"49-11-K-111867070004\",\"nsr_id\":1,\"pupil_id\":4,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.09\",\"weight\":\"14.00\",\"bmi\":\"Severely Wasted\",\"hfa\":\"Normal\",\"is_dewormed\":\"0\",\"dewormed_date\":\"\",\"is_permitted_deworming\":\"0\",\"explanation\":\"\",\"dietary_restriction\":\"\",\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:19:48.000000Z\",\"updated_at\":\"2023-12-16T19:40:16.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 19:57:42', '2023-12-16 19:57:42'),
(103, 'Update', 'Height: 0.99, Weight: 13.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 0, Dietary Restriction: , Explanation: ', 'nutritionalAssessmentRecord: {\"id\":3,\"pna_code\":\"49-11-K-111867070003\",\"nsr_id\":1,\"pupil_id\":3,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"0.99\",\"weight\":\"13.00\",\"bmi\":\"Severely Wasted\",\"hfa\":\"Normal\",\"is_dewormed\":\"0\",\"dewormed_date\":\"\",\"is_permitted_deworming\":\"0\",\"explanation\":\"\",\"dietary_restriction\":\"\",\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:17:00.000000Z\",\"updated_at\":\"2023-12-16T19:40:16.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 19:57:51', '2023-12-16 19:57:51'),
(104, 'Update', 'Height: 1.09, Weight: 16.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 0, Dietary Restriction: , Explanation: ', 'nutritionalAssessmentRecord: {\"id\":2,\"pna_code\":\"49-11-K-111867070001\",\"nsr_id\":1,\"pupil_id\":2,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.09\",\"weight\":\"16.00\",\"bmi\":\"Severely Wasted\",\"hfa\":\"Normal\",\"is_dewormed\":\"0\",\"dewormed_date\":\"\",\"is_permitted_deworming\":\"0\",\"explanation\":\"\",\"dietary_restriction\":\"\",\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:16:00.000000Z\",\"updated_at\":\"2023-12-16T19:40:16.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 19:58:01', '2023-12-16 19:58:01'),
(105, 'Update', 'Height: 1.07, Weight: 11.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 0, Dietary Restriction: , Explanation: ', 'nutritionalAssessmentRecord: {\"id\":1,\"pna_code\":\"49-11-K-111867070000\",\"nsr_id\":1,\"pupil_id\":1,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.07\",\"weight\":\"11.00\",\"bmi\":\"Severely Wasted\",\"hfa\":\"Normal\",\"is_dewormed\":\"0\",\"dewormed_date\":\"\",\"is_permitted_deworming\":\"0\",\"explanation\":\"\",\"dietary_restriction\":\"\",\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:15:25.000000Z\",\"updated_at\":\"2023-12-16T19:40:16.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 19:58:11', '2023-12-16 19:58:11'),
(106, 'Update', 'Height: 1.03, Weight: 15.00, Is Dewormed: 1, Dewormed Date: , Is Permitted Deworming: 1, Dietary Restriction: Vegetarian, Explanation: ', 'nutritionalAssessmentRecord: {\"id\":16,\"pna_code\":\"49-11-K-111867070017\",\"nsr_id\":1,\"pupil_id\":16,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.03\",\"weight\":\"15.00\",\"bmi\":\"Severely Wasted\",\"hfa\":\"Normal\",\"is_dewormed\":\"1\",\"dewormed_date\":\"\",\"is_permitted_deworming\":\"1\",\"explanation\":\"\",\"dietary_restriction\":\"Vegetarian\",\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:31:42.000000Z\",\"updated_at\":\"2023-12-16T19:48:48.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 20:23:19', '2023-12-16 20:23:19'),
(107, 'Update', 'Height: 1.19, Weight: 23.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 1, Dietary Restriction: Allergic To Eggs, Explanation: ', 'nutritionalAssessmentRecord: {\"id\":15,\"pna_code\":\"49-11-K-111867070016\",\"nsr_id\":1,\"pupil_id\":15,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.19\",\"weight\":\"23.00\",\"bmi\":\"Wasted\",\"hfa\":\"Normal\",\"is_dewormed\":\"0\",\"dewormed_date\":\"\",\"is_permitted_deworming\":\"1\",\"explanation\":\"\",\"dietary_restriction\":\"Allergic To Eggs\",\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:31:08.000000Z\",\"updated_at\":\"2023-12-16T19:49:02.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 20:23:30', '2023-12-16 20:23:30');
INSERT INTO `user_logs` (`id`, `action`, `old_value`, `new_value`, `table_name`, `user_id`, `created_at`, `updated_at`) VALUES
(108, 'Update', 'Height: 1.07, Weight: 16.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 1, Dietary Restriction: Allergic To Eggs, Explanation: ', 'nutritionalAssessmentRecord: {\"id\":14,\"pna_code\":\"49-11-K-111867070015\",\"nsr_id\":1,\"pupil_id\":14,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.07\",\"weight\":\"16.00\",\"bmi\":\"Severely Wasted\",\"hfa\":\"Normal\",\"is_dewormed\":\"0\",\"dewormed_date\":\"\",\"is_permitted_deworming\":\"1\",\"explanation\":\"\",\"dietary_restriction\":\"Allergic To Eggs\",\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:30:01.000000Z\",\"updated_at\":\"2023-12-16T19:40:16.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 20:23:39', '2023-12-16 20:23:39'),
(109, 'Update', 'Height: 1.08, Weight: 16.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 0, Dietary Restriction: , Explanation: ', 'nutritionalAssessmentRecord: {\"id\":13,\"pna_code\":\"49-11-K-111867070013\",\"nsr_id\":1,\"pupil_id\":13,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.08\",\"weight\":\"16.00\",\"bmi\":\"Severely Wasted\",\"hfa\":\"Normal\",\"is_dewormed\":\"0\",\"dewormed_date\":\"\",\"is_permitted_deworming\":\"0\",\"explanation\":\"\",\"dietary_restriction\":\"\",\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:29:23.000000Z\",\"updated_at\":\"2023-12-16T19:40:16.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 20:23:49', '2023-12-16 20:23:49'),
(110, 'Update', 'Height: 1.00, Weight: 13.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 0, Dietary Restriction: , Explanation: ', 'nutritionalAssessmentRecord: {\"id\":12,\"pna_code\":\"49-11-K-111867070012\",\"nsr_id\":1,\"pupil_id\":12,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.00\",\"weight\":\"13.00\",\"bmi\":\"Severely Wasted\",\"hfa\":\"Normal\",\"is_dewormed\":\"0\",\"dewormed_date\":\"\",\"is_permitted_deworming\":\"0\",\"explanation\":\"\",\"dietary_restriction\":\"\",\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:26:43.000000Z\",\"updated_at\":\"2023-12-16T19:40:16.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 20:23:58', '2023-12-16 20:23:58'),
(111, 'Update', 'Height: 1.00, Weight: 13.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 0, Dietary Restriction: , Explanation: ', 'nutritionalAssessmentRecord: {\"id\":12,\"pna_code\":\"49-11-K-111867070012\",\"nsr_id\":1,\"pupil_id\":12,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.00\",\"weight\":\"13.00\",\"bmi\":\"Severely Wasted\",\"hfa\":\"Normal\",\"is_dewormed\":\"0\",\"dewormed_date\":\"\",\"is_permitted_deworming\":\"0\",\"explanation\":\"\",\"dietary_restriction\":\"\",\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:26:43.000000Z\",\"updated_at\":\"2023-12-16T19:40:16.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 20:24:08', '2023-12-16 20:24:08'),
(112, 'Update', 'Height: 1.09, Weight: 19.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 0, Dietary Restriction: , Explanation: ', 'nutritionalAssessmentRecord: {\"id\":11,\"pna_code\":\"49-11-K-111867070011\",\"nsr_id\":1,\"pupil_id\":11,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.09\",\"weight\":\"19.00\",\"bmi\":\"Severely Wasted\",\"hfa\":\"Normal\",\"is_dewormed\":\"0\",\"dewormed_date\":\"\",\"is_permitted_deworming\":\"0\",\"explanation\":\"\",\"dietary_restriction\":\"\",\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:26:09.000000Z\",\"updated_at\":\"2023-12-16T19:40:16.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 20:24:22', '2023-12-16 20:24:22'),
(113, 'Update', 'Height: 1.09, Weight: 16.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 0, Dietary Restriction: , Explanation: ', 'nutritionalAssessmentRecord: {\"id\":10,\"pna_code\":\"49-11-K-111867070010\",\"nsr_id\":1,\"pupil_id\":10,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.09\",\"weight\":\"16.00\",\"bmi\":\"Severely Wasted\",\"hfa\":\"Normal\",\"is_dewormed\":\"0\",\"dewormed_date\":\"\",\"is_permitted_deworming\":\"0\",\"explanation\":\"\",\"dietary_restriction\":\"\",\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:25:38.000000Z\",\"updated_at\":\"2023-12-16T19:40:16.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 20:24:32', '2023-12-16 20:24:32'),
(114, 'Update', 'Height: 1.17, Weight: 24.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 0, Dietary Restriction: , Explanation: ', 'nutritionalAssessmentRecord: {\"id\":9,\"pna_code\":\"49-11-K-111867070009\",\"nsr_id\":1,\"pupil_id\":9,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.17\",\"weight\":\"24.00\",\"bmi\":\"Normal\",\"hfa\":\"Normal\",\"is_dewormed\":\"0\",\"dewormed_date\":\"\",\"is_permitted_deworming\":\"0\",\"explanation\":\"\",\"dietary_restriction\":\"\",\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:23:50.000000Z\",\"updated_at\":\"2023-12-16T19:56:53.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 20:24:42', '2023-12-16 20:24:42'),
(115, 'Update', 'Height: 1.17, Weight: 24.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 0, Dietary Restriction: , Explanation: ', 'nutritionalAssessmentRecord: {\"id\":9,\"pna_code\":\"49-11-K-111867070009\",\"nsr_id\":1,\"pupil_id\":9,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.17\",\"weight\":\"24.00\",\"bmi\":\"Wasted\",\"hfa\":\"Normal\",\"is_dewormed\":\"0\",\"dewormed_date\":\"\",\"is_permitted_deworming\":\"0\",\"explanation\":\"\",\"dietary_restriction\":\"\",\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:23:50.000000Z\",\"updated_at\":\"2023-12-16T20:24:42.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 20:24:53', '2023-12-16 20:24:53'),
(116, 'Update', 'Height: 1.10, Weight: 19.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 0, Dietary Restriction: , Explanation: ', 'nutritionalAssessmentRecord: {\"id\":8,\"pna_code\":\"49-11-K-111867070008\",\"nsr_id\":1,\"pupil_id\":8,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.10\",\"weight\":\"19.00\",\"bmi\":\"Severely Wasted\",\"hfa\":\"Normal\",\"is_dewormed\":\"0\",\"dewormed_date\":\"\",\"is_permitted_deworming\":\"0\",\"explanation\":\"\",\"dietary_restriction\":\"\",\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:23:25.000000Z\",\"updated_at\":\"2023-12-16T19:40:16.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 20:25:03', '2023-12-16 20:25:03'),
(117, 'Update', 'Height: 1.09, Weight: 16.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 0, Dietary Restriction: , Explanation: ', 'nutritionalAssessmentRecord: {\"id\":7,\"pna_code\":\"49-11-K-111867070007\",\"nsr_id\":1,\"pupil_id\":7,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.09\",\"weight\":\"16.00\",\"bmi\":\"Severely Wasted\",\"hfa\":\"Normal\",\"is_dewormed\":\"0\",\"dewormed_date\":\"\",\"is_permitted_deworming\":\"0\",\"explanation\":\"\",\"dietary_restriction\":\"\",\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:21:59.000000Z\",\"updated_at\":\"2023-12-16T19:40:16.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 20:25:14', '2023-12-16 20:25:14'),
(118, 'Update', 'Height: 1.16, Weight: 20.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 0, Dietary Restriction: , Explanation: ', 'nutritionalAssessmentRecord: {\"id\":6,\"pna_code\":\"49-11-K-111867070006\",\"nsr_id\":1,\"pupil_id\":6,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.16\",\"weight\":\"20.00\",\"bmi\":\"Severely Wasted\",\"hfa\":\"Normal\",\"is_dewormed\":\"0\",\"dewormed_date\":\"\",\"is_permitted_deworming\":\"0\",\"explanation\":\"\",\"dietary_restriction\":\"\",\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:21:18.000000Z\",\"updated_at\":\"2023-12-16T19:40:16.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 20:25:23', '2023-12-16 20:25:23'),
(119, 'Update', 'Height: 1.13, Weight: 24.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 0, Dietary Restriction: , Explanation: ', 'nutritionalAssessmentRecord: {\"id\":5,\"pna_code\":\"49-11-K-111867070005\",\"nsr_id\":1,\"pupil_id\":5,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.13\",\"weight\":\"24.00\",\"bmi\":\"Severely Wasted\",\"hfa\":\"Normal\",\"is_dewormed\":\"0\",\"dewormed_date\":\"\",\"is_permitted_deworming\":\"0\",\"explanation\":\"\",\"dietary_restriction\":\"\",\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:20:16.000000Z\",\"updated_at\":\"2023-12-16T19:40:16.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 20:25:33', '2023-12-16 20:25:33'),
(120, 'Update', 'Height: 1.09, Weight: 14.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 0, Dietary Restriction: , Explanation: ', 'nutritionalAssessmentRecord: {\"id\":4,\"pna_code\":\"49-11-K-111867070004\",\"nsr_id\":1,\"pupil_id\":4,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.09\",\"weight\":\"14.00\",\"bmi\":\"Severely Wasted\",\"hfa\":\"Normal\",\"is_dewormed\":\"0\",\"dewormed_date\":\"\",\"is_permitted_deworming\":\"0\",\"explanation\":\"\",\"dietary_restriction\":\"\",\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:19:48.000000Z\",\"updated_at\":\"2023-12-16T19:40:16.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 20:25:42', '2023-12-16 20:25:42'),
(121, 'Update', 'Height: 0.99, Weight: 13.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 0, Dietary Restriction: , Explanation: ', 'nutritionalAssessmentRecord: {\"id\":3,\"pna_code\":\"49-11-K-111867070003\",\"nsr_id\":1,\"pupil_id\":3,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"0.99\",\"weight\":\"13.00\",\"bmi\":\"Severely Wasted\",\"hfa\":\"Normal\",\"is_dewormed\":\"0\",\"dewormed_date\":\"\",\"is_permitted_deworming\":\"0\",\"explanation\":\"\",\"dietary_restriction\":\"\",\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:17:00.000000Z\",\"updated_at\":\"2023-12-16T19:40:16.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 20:25:51', '2023-12-16 20:25:51'),
(122, 'Update', 'Height: 1.09, Weight: 16.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 0, Dietary Restriction: , Explanation: ', 'nutritionalAssessmentRecord: {\"id\":2,\"pna_code\":\"49-11-K-111867070001\",\"nsr_id\":1,\"pupil_id\":2,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.09\",\"weight\":\"16.00\",\"bmi\":\"Severely Wasted\",\"hfa\":\"Normal\",\"is_dewormed\":\"0\",\"dewormed_date\":\"\",\"is_permitted_deworming\":\"0\",\"explanation\":\"\",\"dietary_restriction\":\"\",\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:16:00.000000Z\",\"updated_at\":\"2023-12-16T19:40:16.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 20:26:00', '2023-12-16 20:26:00'),
(123, 'Update', 'Height: 1.07, Weight: 11.00, Is Dewormed: 0, Dewormed Date: , Is Permitted Deworming: 0, Dietary Restriction: , Explanation: ', 'nutritionalAssessmentRecord: {\"id\":1,\"pna_code\":\"49-11-K-111867070000\",\"nsr_id\":1,\"pupil_id\":1,\"class_adviser_id\":49,\"schoolyear_id\":1,\"class_id\":1,\"height\":\"1.07\",\"weight\":\"11.00\",\"bmi\":\"Severely Wasted\",\"hfa\":\"Normal\",\"is_dewormed\":\"0\",\"dewormed_date\":\"\",\"is_permitted_deworming\":\"0\",\"explanation\":\"\",\"dietary_restriction\":\"\",\"is_deleted\":\"0\",\"created_at\":\"2023-12-15T02:15:25.000000Z\",\"updated_at\":\"2023-12-16T19:40:16.000000Z\"}', 'Nutritional Assessments', 49, '2023-12-16 20:26:10', '2023-12-16 20:26:10'),
(124, 'Create', NULL, 'Pupil LRN: 111867070017, Class: 1, SchoolYear: 1', 'Referrals', 49, '2023-12-18 01:03:06', '2023-12-18 01:03:06'),
(125, 'Create', NULL, 'Pupil LRN: 111867070017, Class: 1, SchoolYear: 1', 'Referrals', 49, '2023-12-26 11:40:20', '2023-12-26 11:40:20'),
(126, 'Create', NULL, 'Pupil LRN: 111867070017, Class: 1, SchoolYear: 1', 'Referrals', 49, '2023-12-26 11:44:42', '2023-12-26 11:44:42'),
(127, 'Create', NULL, 'Pupil LRN: 111867070017, Class: 1, SchoolYear: 1, Program: Feeding Program, Explanation: He looks scrawny', 'Referrals', 49, '2023-12-26 11:47:10', '2023-12-26 11:47:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_logs`
--
ALTER TABLE `admin_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beneficiaries`
--
ALTER TABLE `beneficiaries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `beneficiaries_pupil_id_foreign` (`pupil_id`),
  ADD KEY `beneficiaries_classadviser_id_foreign` (`classadviser_id`),
  ADD KEY `beneficiaries_school_nurse_id_foreign` (`school_nurse_id`),
  ADD KEY `beneficiaries_class_id_foreign` (`class_id`),
  ADD KEY `beneficiaries_schoolyear_id_foreign` (`schoolyear_id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_school_id_foreign` (`school_id`),
  ADD KEY `class_classadviser_id_foreign` (`classadviser_id`),
  ADD KEY `class_schoolyear_id_foreign` (`schoolyear_id`);

--
-- Indexes for table `cnsr_list`
--
ALTER TABLE `cnsr_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cnsr_list_school_id_foreign` (`school_id`),
  ADD KEY `cnsr_list_school_nurse_id_foreign` (`school_nurse_id`),
  ADD KEY `cnsr_list_schoolyear_id_foreign` (`schoolyear_id`);

--
-- Indexes for table `districts_table`
--
ALTER TABLE `districts_table`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `districts_table_district_unique` (`district`),
  ADD UNIQUE KEY `districts_table_medical_officer_id_unique` (`medical_officer_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `hfa_standards`
--
ALTER TABLE `hfa_standards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `list_of_beneficiaries`
--
ALTER TABLE `list_of_beneficiaries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `list_of_beneficiaries_pupil_id_foreign` (`pupil_id`),
  ADD KEY `list_of_beneficiaries_classadviser_id_foreign` (`classadviser_id`),
  ADD KEY `list_of_beneficiaries_school_nurse_id_foreign` (`school_nurse_id`),
  ADD KEY `list_of_beneficiaries_class_id_foreign` (`class_id`),
  ADD KEY `list_of_beneficiaries_schoolyear_id_foreign` (`schoolyear_id`);

--
-- Indexes for table `masterlists`
--
ALTER TABLE `masterlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `masterlists_pupil_id_foreign` (`pupil_id`),
  ADD KEY `masterlists_classadviser_id_foreign` (`classadviser_id`),
  ADD KEY `masterlists_class_id_foreign` (`class_id`),
  ADD KEY `masterlists_schoolyear_id_foreign` (`schoolyear_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nsr_list`
--
ALTER TABLE `nsr_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nsr_list_section_id_foreign` (`section_id`),
  ADD KEY `nsr_list_class_adviser_id_foreign` (`class_adviser_id`),
  ADD KEY `nsr_list_schoolyear_id_foreign` (`schoolyear_id`),
  ADD KEY `nsr_list_cnsr_id_foreign` (`cnsr_id`),
  ADD KEY `fk_nsr_list_school_id` (`school_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pupil`
--
ALTER TABLE `pupil`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pupil_lrn_unique` (`lrn`),
  ADD KEY `pupil_added_by_foreign` (`added_by`);

--
-- Indexes for table `pupil_nutritional_assessments`
--
ALTER TABLE `pupil_nutritional_assessments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pupil_nutritional_assessments_nsr_id_foreign` (`nsr_id`),
  ADD KEY `pupil_nutritional_assessments_pupil_id_foreign` (`pupil_id`),
  ADD KEY `pupil_nutritional_assessments_class_adviser_id_foreign` (`class_adviser_id`),
  ADD KEY `pupil_nutritional_assessments_schoolyear_id_foreign` (`schoolyear_id`),
  ADD KEY `pupil_nutritional_assessments_class_id_foreign` (`class_id`);

--
-- Indexes for table `referrals`
--
ALTER TABLE `referrals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `referrals_pupil_id_foreign` (`pupil_id`),
  ADD KEY `referrals_classadviser_id_foreign` (`classadviser_id`),
  ADD KEY `referrals_class_id_foreign` (`class_id`),
  ADD KEY `referrals_schoolyear_id_foreign` (`schoolyear_id`),
  ADD KEY `referrals_school_nurse_id_foreign` (`school_nurse_id`);

--
-- Indexes for table `schools_table`
--
ALTER TABLE `schools_table`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `schools_table_school_id_unique` (`school_id`),
  ADD UNIQUE KEY `schools_table_school_nurse_id_unique` (`school_nurse_id`),
  ADD KEY `schools_table_district_id_foreign` (`district_id`);

--
-- Indexes for table `school_year`
--
ALTER TABLE `school_year`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sections_school_id_foreign` (`school_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_unique_id_unique` (`unique_id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_logs_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_logs`
--
ALTER TABLE `admin_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `beneficiaries`
--
ALTER TABLE `beneficiaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cnsr_list`
--
ALTER TABLE `cnsr_list`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `districts_table`
--
ALTER TABLE `districts_table`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hfa_standards`
--
ALTER TABLE `hfa_standards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=901;

--
-- AUTO_INCREMENT for table `list_of_beneficiaries`
--
ALTER TABLE `list_of_beneficiaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `masterlists`
--
ALTER TABLE `masterlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=363;

--
-- AUTO_INCREMENT for table `nsr_list`
--
ALTER TABLE `nsr_list`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pupil`
--
ALTER TABLE `pupil`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `pupil_nutritional_assessments`
--
ALTER TABLE `pupil_nutritional_assessments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `referrals`
--
ALTER TABLE `referrals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `schools_table`
--
ALTER TABLE `schools_table`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `school_year`
--
ALTER TABLE `school_year`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=276;

--
-- AUTO_INCREMENT for table `user_logs`
--
ALTER TABLE `user_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `beneficiaries`
--
ALTER TABLE `beneficiaries`
  ADD CONSTRAINT `beneficiaries_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `beneficiaries_classadviser_id_foreign` FOREIGN KEY (`classadviser_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `beneficiaries_pupil_id_foreign` FOREIGN KEY (`pupil_id`) REFERENCES `pupil` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `beneficiaries_school_nurse_id_foreign` FOREIGN KEY (`school_nurse_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `beneficiaries_schoolyear_id_foreign` FOREIGN KEY (`schoolyear_id`) REFERENCES `school_year` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `class_classadviser_id_foreign` FOREIGN KEY (`classadviser_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `class_school_id_foreign` FOREIGN KEY (`school_id`) REFERENCES `schools_table` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `class_schoolyear_id_foreign` FOREIGN KEY (`schoolyear_id`) REFERENCES `school_year` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cnsr_list`
--
ALTER TABLE `cnsr_list`
  ADD CONSTRAINT `cnsr_list_school_id_foreign` FOREIGN KEY (`school_id`) REFERENCES `schools_table` (`id`),
  ADD CONSTRAINT `cnsr_list_school_nurse_id_foreign` FOREIGN KEY (`school_nurse_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `cnsr_list_schoolyear_id_foreign` FOREIGN KEY (`schoolyear_id`) REFERENCES `school_year` (`id`);

--
-- Constraints for table `districts_table`
--
ALTER TABLE `districts_table`
  ADD CONSTRAINT `districts_table_medical_officer_id_foreign` FOREIGN KEY (`medical_officer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `list_of_beneficiaries`
--
ALTER TABLE `list_of_beneficiaries`
  ADD CONSTRAINT `list_of_beneficiaries_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `list_of_beneficiaries_classadviser_id_foreign` FOREIGN KEY (`classadviser_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `list_of_beneficiaries_pupil_id_foreign` FOREIGN KEY (`pupil_id`) REFERENCES `pupil` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `list_of_beneficiaries_school_nurse_id_foreign` FOREIGN KEY (`school_nurse_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `list_of_beneficiaries_schoolyear_id_foreign` FOREIGN KEY (`schoolyear_id`) REFERENCES `school_year` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `masterlists`
--
ALTER TABLE `masterlists`
  ADD CONSTRAINT `masterlists_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `masterlists_classadviser_id_foreign` FOREIGN KEY (`classadviser_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `masterlists_pupil_id_foreign` FOREIGN KEY (`pupil_id`) REFERENCES `pupil` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `masterlists_schoolyear_id_foreign` FOREIGN KEY (`schoolyear_id`) REFERENCES `school_year` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `nsr_list`
--
ALTER TABLE `nsr_list`
  ADD CONSTRAINT `fk_nsr_list_school_id` FOREIGN KEY (`school_id`) REFERENCES `schools_table` (`id`),
  ADD CONSTRAINT `nsr_list_class_adviser_id_foreign` FOREIGN KEY (`class_adviser_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `nsr_list_cnsr_id_foreign` FOREIGN KEY (`cnsr_id`) REFERENCES `cnsr_list` (`id`),
  ADD CONSTRAINT `nsr_list_schoolyear_id_foreign` FOREIGN KEY (`schoolyear_id`) REFERENCES `school_year` (`id`),
  ADD CONSTRAINT `nsr_list_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `class` (`id`);

--
-- Constraints for table `pupil`
--
ALTER TABLE `pupil`
  ADD CONSTRAINT `pupil_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pupil_nutritional_assessments`
--
ALTER TABLE `pupil_nutritional_assessments`
  ADD CONSTRAINT `pupil_nutritional_assessments_class_adviser_id_foreign` FOREIGN KEY (`class_adviser_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `pupil_nutritional_assessments_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`),
  ADD CONSTRAINT `pupil_nutritional_assessments_nsr_id_foreign` FOREIGN KEY (`nsr_id`) REFERENCES `nsr_list` (`id`),
  ADD CONSTRAINT `pupil_nutritional_assessments_pupil_id_foreign` FOREIGN KEY (`pupil_id`) REFERENCES `pupil` (`id`),
  ADD CONSTRAINT `pupil_nutritional_assessments_schoolyear_id_foreign` FOREIGN KEY (`schoolyear_id`) REFERENCES `school_year` (`id`);

--
-- Constraints for table `referrals`
--
ALTER TABLE `referrals`
  ADD CONSTRAINT `referrals_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `referrals_classadviser_id_foreign` FOREIGN KEY (`classadviser_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `referrals_pupil_id_foreign` FOREIGN KEY (`pupil_id`) REFERENCES `pupil` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `referrals_school_nurse_id_foreign` FOREIGN KEY (`school_nurse_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `referrals_schoolyear_id_foreign` FOREIGN KEY (`schoolyear_id`) REFERENCES `school_year` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `schools_table`
--
ALTER TABLE `schools_table`
  ADD CONSTRAINT `schools_table_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `districts_table` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `schools_table_school_nurse_id_foreign` FOREIGN KEY (`school_nurse_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sections`
--
ALTER TABLE `sections`
  ADD CONSTRAINT `sections_school_id_foreign` FOREIGN KEY (`school_id`) REFERENCES `schools_table` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_logs`
--
ALTER TABLE `user_logs`
  ADD CONSTRAINT `user_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
