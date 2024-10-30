-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2024 at 08:29 AM
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
-- Database: `open_mic_hub`
--

-- --------------------------------------------------------

--
-- Table structure for table `artistsocialmedia`
--

CREATE TABLE IF NOT EXISTS  `artistsocialmedia` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `artist_id` int(11) DEFAULT NULL,
  `platform_id` int(11) DEFAULT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artistsocialmedia`
--

INSERT INTO `artistsocialmedia` (`id`, `artist_id`, `platform_id`, `url`) VALUES
     (1, 42, 1, 'test'),
     (2, 42, 2, 'instatest'),
     (3, 44, 1, 'https://www.facebook.com/hari'),
     (4, 44, 2, 'https://www.instagram.com/hari'),
     (5, 44, 3, 'https://www.youtube.com/hari'),
     (6, 44, 4, 'https://www.twitter.com/hari'),
     (7, 46, 1, 'www.facebook.com/dhiraj'),
     (8, 46, 2, 'www.instagram.com/dhiraj'),
     (9, 47, 1, 'www.facebook.com/bishal'),
     (10, 47, 4, 'www.twitter.com/bishal'),
     (11, 48, 1, 'www.facebook.com/pasang'),
     (12, 48, 3, 'www.youtube.com/pasang'),
     (13, 45, 2, 'www.instagram.com/apson'),
     (14, 45, 3, 'www.youtube.com/apson')
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `artist_id` = VALUES(`artist_id`), `platform_id` = VALUES(`platform_id`), `url` = VALUES(`url`);
-- --------------------------------------------------------

--
-- Table structure for table `artist_details`
--

CREATE TABLE IF NOT EXISTS  `artist_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `full_name` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `stage_name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artist_details`
--

INSERT INTO `artist_details` (`id`, `full_name`, `user_id`, `stage_name`, `phone`, `address`, `category_id`, `bio`, `description`, `profile_picture`, `created_at`, `updated_at`) VALUES
(50, 'Utsab Dahal', 43, 'comedian_utsab', '9862506862', 'Kuntadevi', 2, 'my bio', 'Are you comedy me?', 'uploads/profile_pictures/43_1718964182_66754fd627a58.jpg', '2024-06-19 06:07:49', '2024-06-29 13:21:33'),
(51, 'Hari Tamang', 44, 'hari', '9812345678', 'Kapan, Kathmandu', 1, 'Be yourself', 'Its me hari. A wonderful singer', 'uploads/profile_pictures/default-profile.png', '2024-06-23 11:10:30', '2024-06-23 11:13:03'),
(52, 'Dhiraj Jirel', 46, 'dhiraj', '9824512425', 'Jiri, Dolakha', 4, 'Its me Dhiraj Jirel.', 'Its me a talented poet from Jiri.', 'uploads/profile_pictures/46_1719184438_6678ac365d8fb.jpg', '2024-06-23 23:13:30', '2024-06-23 23:17:48'),
(53, 'Bishal Acharya', 47, 'Bishal', '9862506862', 'Laure Tole, Bouddha', 1, 'Sing With me', 'None can sing better than me.', 'uploads/profile_pictures/47_1719185264_6678af707dc3e.jpg', '2024-06-23 23:27:18', '2024-06-23 23:27:44'),
(56, 'Pasang Gelbu Sherpa', 48, 'pasang', '9862506862', 'Narayantaar, KTM', 3, 'A storyteller with a passion for weaving tales that captivate and inspire. I believe every story has the power to touch hearts.', ' My captivating storytelling skills and rich imagination bring his stories to life, leaving audiences enthralled.', 'uploads/profile_pictures/48_1719186188_6678b30c4cd05.jpg', '2024-06-23 23:41:36', '2024-06-23 23:43:08'),
(57, 'Apson Jirel', 45, 'Apson', '9862506864', 'Nayabasti, Bouddha', 1, 'A singer who finds joy in every note I sing. Music is my language, and I use it to connect with people on a deeper level.', 'My  powerful vocals and emotional delivery make her a standout performer in both live concerts and studio recordings.', 'uploads/profile_pictures/45_1719189041_6678be31ec4fb.jpg', '2024-06-24 00:28:25', '2024-06-24 00:30:41'),
(58, 'Bibek Shrestha', 49, 'bibek', '9862506892', 'Kavre', 3, 'A storyteller who enjoys sharing tales of love, loss, and everything in between. Stories are my way of connecting with people.', 'My suspenseful stories and dramatic delivery keep  listeners on the edge of their seats, eagerly awaiting the next twist.', 'uploads/profile_pictures/49_1719190032_6678c210b5e9b.jpg', '2024-06-24 00:44:07', '2024-06-24 00:47:12'),
(59, 'Suresh Moktan', 50, 'suresh', '9862503892', 'Sankhu, Kathmandu', 2, 'A standup comedian who loves to joke about everything under the sun. Comedy is my way of lightening the mood.', 'My diverse range of jokes and infectious laughter make his performances a hit with audiences of all ages.', 'uploads/profile_pictures/50_1719367107_667b75c304a56.jpg', '2024-06-24 00:54:24', '2024-06-26 01:58:27'),
(60, 'Bikash Khanal', 51, 'bikash', '', '', 3, 'Smooth like butter.', '', 'uploads/profile_pictures/51_1719193943_6678d15748965.jpg', '2024-06-24 01:47:57', '2024-06-24 01:52:23'),
(61, 'Naresh Shahi', 52, 'naresh', '9822334455', 'Kapan, Ktm', 3, 'Its me Naresh.', 'A storyteller who enjoys creating suspense and mystery in my tales. Stories are my way of thrilling my audience.', 'uploads/profile_pictures/default-profile.png', '2024-06-24 02:00:30', '2024-06-24 02:00:30'),
(62, 'Utsab Dahal', 53, 'nigam', '9861225637', 'Kuntadevi', 4, 'I slam the poetry.', 'I am the best', 'uploads/profile_pictures/default-profile.png', '2024-06-26 02:01:44', '2024-06-26 02:53:45'),
(63, 'Raj Shrestha', 54, 'raj', '', 'Gokarna, Kathmandu', 1, 'A lover of music, telling stories through song.', 'A lover of music, telling stories through song.', 'uploads/profile_pictures/54_1719367982_667b792ee01f9.jpg', '2024-06-26 02:11:17', '2024-06-26 02:13:02'),
(64, 'Tshiring Sherpa', 55, 'Tshiring', '9862506873', 'Kapan, Kathmandu', 1, '', 'Sharing my voice, one song at a time.', 'uploads/profile_pictures/55_1719368179_667b79f39e0d8.jpg', '2024-06-26 02:16:13', '2024-06-26 02:16:19'),
(65, 'Nirmal Deuja', 56, 'Nirmal', '9862506972', 'Kathmandu', 2, 'Sharing funny anecdotes and witty observations about life.', 'Catch me on stage or here for your daily dose of humor! 🌟 #ComedyLife #LaughsForDays 🎭\"', 'uploads/profile_pictures/56_1719369015_667b7d37ed06d.jpg', '2024-06-26 02:29:23', '2024-06-26 02:30:15')
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `full_name` = VALUES(`full_name`), `user_id` = VALUES(`user_id`), `stage_name` = VALUES(`stage_name`), `phone` = VALUES(`phone`), `address` = VALUES(`address`), `category_id` = VALUES(`category_id`), `bio` = VALUES(`bio`), `description` = VALUES(`description`), `profile_picture` = VALUES(`profile_picture`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`);

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE IF NOT EXISTS  `bookings` (`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `artist_id` int(11) NOT NULL,
  `province_id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL,
  `municipality_id` int(11) NOT NULL,
  `local_area` varchar(255) DEFAULT NULL,
  `event_date` date NOT NULL,
  `event_start_time` time NOT NULL,
  `event_end_time` time NOT NULL,
  `total_cost` decimal(10,2) NOT NULL,
  `advance_amount` decimal(10,2) NOT NULL,
  `remaining_amount` decimal(10,2) NOT NULL,
  `performance_type_id` int(11) NOT NULL,
  `status` enum('approved','pending','declined','cancelled') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `user_id`, `artist_id`, `province_id`, `district_id`, `municipality_id`, `local_area`, `event_date`, `event_start_time`, `event_end_time`, `total_cost`, `advance_amount`, `remaining_amount`, `performance_type_id`, `status`, `created_at`) VALUES
(31, 42, 43, 3, 24, 489, 'Likhu', '2024-06-29', '13:11:00', '15:11:00', 3600.00, 900.00, 2700.00, 9, 'approved', '2024-06-21 14:17:22'),
(32, 42, 43, 2, 16, 136, 'TEST BODY', '2024-06-29', '11:11:00', '22:22:00', 20130.00, 5032.50, 15097.50, 9, 'approved', '2024-06-21 14:23:05'),
(33, 42, 43, 3, 24, 236, 'FINAL HTML BODY TEST', '2024-07-04', '13:13:00', '14:14:00', 1830.00, 457.50, 1372.50, 9, 'declined', '2024-06-21 14:25:53'),
(34, 42, 43, 6, 62, 662, 'HadiGaon', '2024-06-27', '11:15:00', '13:01:00', 3180.00, 795.00, 2385.00, 9, 'cancelled', '2024-06-22 01:12:35'),
(35, 43, 45, 3, 26, 64, 'near school', '2024-06-26', '17:41:00', '20:41:00', 8400.00, 2100.00, 6300.00, 19, 'approved', '2024-06-24 10:56:39'),
(36, 42, 43, 4, 36, 95, 'adsfgh', '2024-07-04', '10:19:00', '01:16:00', 26611.00, 6652.75, 19958.25, 23, 'declined', '2024-06-30 04:31:27')
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `booking_id` = VALUES(`booking_id`), `user_id` = VALUES(`user_id`), `artist_id` = VALUES(`artist_id`), `province_id` = VALUES(`province_id`), `district_id` = VALUES(`district_id`), `municipality_id` = VALUES(`municipality_id`), `local_area` = VALUES(`local_area`), `event_date` = VALUES(`event_date`), `event_start_time` = VALUES(`event_start_time`), `event_end_time` = VALUES(`event_end_time`), `total_cost` = VALUES(`total_cost`), `advance_amount` = VALUES(`advance_amount`), `remaining_amount` = VALUES(`remaining_amount`), `performance_type_id` = VALUES(`performance_type_id`), `status` = VALUES(`status`), `created_at` = VALUES(`created_at`);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS  `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(1, 'Singers', 'Category for singers and vocalists.'),
(2, 'Standup Comedians', 'Category for standup comedians.'),
(3, 'Storytellers', 'Category for storytellers.'),
(4, 'Poetry Slammers', 'Category for poetry slammers.')
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `name` = VALUES(`name`), `description` = VALUES(`description`);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS  `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `user_id` int(11) NOT NULL,
  `artist_id` int(11) NOT NULL,
  `rating` int(11) DEFAULT NULL,
  `text` text NOT NULL,
  `upvotes` int(11) DEFAULT 0,
  `parent_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `artist_id`, `rating`, `text`, `upvotes`, `parent_id`, `created_at`) VALUES
(14, 42, 43, 3, 'test', 0, NULL, '2024-06-21 01:15:30'),
(15, 42, 43, NULL, 'test success', 0, 14, '2024-06-21 01:16:40'),
(16, 42, 43, NULL, '', 0, 14, '2024-06-21 01:17:10'),
(17, 42, 43, NULL, 'hello test', 0, 14, '2024-06-21 01:19:06'),
(18, 42, 43, NULL, 'final test', 0, 14, '2024-06-21 01:21:28'),
(19, 42, 43, NULL, 'test', 0, 14, '2024-06-21 01:22:09'),
(20, 42, 43, NULL, 'test 1', 0, 14, '2024-06-21 01:24:28'),
(21, 42, 43, NULL, 'it may be final', 0, 14, '2024-06-21 01:25:59'),
(22, 42, 43, NULL, 'test 2', 0, 14, '2024-06-21 01:27:39'),
(23, 42, 43, NULL, 'test toastr', 0, 14, '2024-06-21 01:31:03'),
(24, 42, 43, 2, 'test', 0, NULL, '2024-06-21 01:33:13'),
(25, 42, 43, NULL, 'test 2', 0, 14, '2024-06-21 01:33:46'),
(26, 43, 43, NULL, 'replied', 0, 24, '2024-06-21 02:16:42'),
(27, 43, 43, NULL, 'test 3', 0, 24, '2024-06-21 02:22:38'),
(28, 43, 43, 4, 'test for code push', 0, NULL, '2024-06-21 02:41:23'),
(29, 43, 43, NULL, 'success or wott?', 0, 28, '2024-06-21 02:46:55'),
(30, 43, 45, 4, 'Very Good performance', 0, NULL, '2024-06-24 10:53:01'),
(31, 46, 45, NULL, 'yes indeed', 0, 30, '2024-06-24 10:54:01')
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `user_id` = VALUES(`user_id`), `artist_id` = VALUES(`artist_id`), `rating` = VALUES(`rating`), `text` = VALUES(`text`), `upvotes` = VALUES(`upvotes`), `parent_id` = VALUES(`parent_id`), `created_at` = VALUES(`created_at`);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE IF NOT EXISTS  `contact_us` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `subject`, `message`, `submitted_at`) VALUES
(1, 'Utsab Dahal', 'utsab.dahal78@aadimcollege.edu.np', 'Test', 'Test using Ajax', '2024-06-18 11:18:14'),
(2, 'Utsab Dahal', 'utsab.dahal78@aadimcollege.edu.np', 'test 2', 'second test using jquery and ajax', '2024-06-18 11:19:13')
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `name` = VALUES(`name`), `email` = VALUES(`email`), `subject` = VALUES(`subject`), `message` = VALUES(`message`), `submitted_at` = VALUES(`submitted_at`);

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE IF NOT EXISTS  `districts` (`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
  `district_id` int(2) NOT NULL,
  `district_name` varchar(15) NOT NULL,
  `province_id` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`district_id`, `district_name`, `province_id`) VALUES
(1, 'Bhojpur', 1),
(2, 'Dhankuta', 1),
(3, 'Ilam', 1),
(4, 'Jhapa', 1),
(5, 'Khotang', 1),
(6, 'Morang', 1),
(7, 'Okhaldhunga', 1),
(8, 'Panchthar', 1),
(9, 'Sankhuwasabha', 1),
(10, 'Solukhumbu', 1),
(11, 'Sunsari', 1),
(12, 'Taplejung', 1),
(13, 'Terhathum', 1),
(14, 'Udayapur', 1),
(15, 'Saptari', 2),
(16, 'Siraha', 2),
(17, 'Dhanusha', 2),
(18, 'Mahottari', 2),
(19, 'Sarlahi', 2),
(20, 'Bara', 2),
(21, 'Parsa', 2),
(22, 'Rautahat', 2),
(23, 'Sindhuli', 3),
(24, 'Ramechhap', 3),
(25, 'Dolakha', 3),
(26, 'Bhaktapur', 3),
(27, 'Dhading', 3),
(28, 'Kathmandu', 3),
(29, 'Kavrepalanchowk', 3),
(30, 'Lalitpur', 3),
(31, 'Nuwakot', 3),
(32, 'Rasuwa', 3),
(33, 'Sindhupalchok', 3),
(34, 'Chitwan', 3),
(35, 'Makwanpur', 3),
(36, 'Baglung', 4),
(37, 'Gorkha', 4),
(38, 'Kaski', 4),
(39, 'Lamjung', 4),
(40, 'Manang', 4),
(41, 'Mustang', 4),
(42, 'Myagdi', 4),
(43, 'Nawalpur', 4),
(44, 'Parbat', 4),
(45, 'Syangja', 4),
(46, 'Tanahun', 4),
(47, 'Kapilvastu', 5),
(48, 'Parasi', 5),
(49, 'Rupandehi', 5),
(50, 'Arghakhanchi', 5),
(51, 'Gulmi', 5),
(52, 'Palpa', 5),
(53, 'Dang', 5),
(54, 'Pyuthan', 5),
(55, 'Rolpa', 5),
(56, 'Eastern Rukum', 5),
(57, 'Banke', 5),
(58, 'Bardiya', 5),
(59, 'Western Rukum', 6),
(60, 'Salyan', 6),
(61, 'Dolpa', 6),
(62, 'Humla', 6),
(63, 'Jumla', 6),
(64, 'Kalikot', 6),
(65, 'Mugu', 6),
(66, 'Surkhet', 6),
(67, 'Dailekh', 6),
(68, 'Jajarkot', 6),
(69, 'Kailali', 7),
(70, 'Achham', 7),
(71, 'Doti', 7),
(72, 'Bajhang', 7),
(73, 'Bajura', 7),
(74, 'Kanchanpur', 7),
(75, 'Dadeldhura', 7),
(76, 'Baitadi', 7),
(77, 'Darchula', 7)
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `district_id` = VALUES(`district_id`), `district_name` = VALUES(`district_name`), `province_id` = VALUES(`province_id`);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE IF NOT EXISTS  `locations` (`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
  `location_id` int(11) NOT NULL,
  `municipality_id` int(11) DEFAULT NULL,
  `location_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE IF NOT EXISTS  `media` (`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
  `media_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `media_type` varchar(255) DEFAULT NULL,
  `media_url` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`media_id`, `user_id`, `media_type`, `media_url`, `title`, `description`, `created_at`) VALUES
(32, 46, 'video', 'uploads/video/0-02-03-481c08817caee709045dbdc764397a2da940aff568db1e6662ebd821f6431a7e_d3eb6bdb8a8e5071.mp4', 'Dhiraj Performance', 'Test', '2024-06-23 23:15:47'),
(33, 48, 'video', 'uploads/video/pasang_.mp4', 'College Story', 'its a story', '2024-06-23 23:53:06'),
(34, 48, 'video', 'uploads/video/63229-506616446_medium.mp4', 'Heal', 'Healing Sound', '2024-06-24 00:00:02'),
(35, 47, 'video', 'uploads/video/Warriyo - Mortals (feat. Laura Brehm) _ Future Trap _ NCS - Copyright Free Music.mp4', 'Bishal Performance', 'Performance by bishal', '2024-06-24 00:16:59'),
(36, 45, 'video', 'uploads/video/Jiunu nai hola (cover)Tribal rain_apson jirel.mp4', 'My Cover', 'Cover by me', '2024-06-24 00:34:29'),
(37, 45, 'video', 'uploads/video/__Timi uta ma Yeta__Short Cover__apson_jirel__.mp4', 'Timi Uta Ma Yeta Cover', 'Its a cover', '2024-06-24 00:37:37'),
(38, 50, 'video', 'uploads/video/Life Changing Story To Stop Mind\'s Chatter _ Nepali Story to Stop Mind\'s Chatter _ Gyankunda.mp4', 'Suresh ', 'my video', '2024-06-24 02:56:56')
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `media_id` = VALUES(`media_id`), `user_id` = VALUES(`user_id`), `media_type` = VALUES(`media_type`), `media_url` = VALUES(`media_url`), `title` = VALUES(`title`), `description` = VALUES(`description`), `created_at` = VALUES(`created_at`);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS  `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `type` enum('text','image','video','document') NOT NULL,
  `content` text NOT NULL,
  `status` enum('sent','delivered','read') DEFAULT 'sent',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `type`, `content`, `status`, `created_at`, `updated_at`) VALUES
(33, 43, 41, 'text', 'hey', 'sent', '2024-06-19 12:57:02', '2024-06-19 12:57:02'),
(34, 43, 41, 'text', 'hello', 'sent', '2024-06-19 12:57:23', '2024-06-19 12:57:23'),
(35, 43, 42, 'text', 'hey', 'sent', '2024-06-19 12:57:35', '2024-06-19 12:57:35'),
(36, 42, 43, 'text', 'hello', '', '2024-06-19 13:55:47', '2024-06-19 13:55:47'),
(37, 42, 43, 'text', 'hey are you free?', '', '2024-06-21 05:23:21', '2024-06-21 05:23:21'),
(38, 46, 43, 'text', 'hey', 'sent', '2024-06-24 10:50:14', '2024-06-24 10:50:14'),
(39, 43, 46, 'text', 'hello', '', '2024-06-24 10:50:27', '2024-06-24 10:50:27'),
(40, 43, 46, 'text', 'how you doing?', '', '2024-06-24 10:51:09', '2024-06-24 10:51:09'),
(41, 46, 45, 'text', 'hey', '', '2024-06-24 10:54:24', '2024-06-24 10:54:24')
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `sender_id` = VALUES(`sender_id`), `receiver_id` = VALUES(`receiver_id`), `type` = VALUES(`type`), `content` = VALUES(`content`), `status` = VALUES(`status`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`);

-- --------------------------------------------------------

--
-- Table structure for table `municipalities`
--

CREATE TABLE IF NOT EXISTS  `municipalities` (`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
  `municipality_id` int(3) NOT NULL,
  `municipality_name` varchar(30) NOT NULL,
  `district_id` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `municipalities`
--

INSERT INTO `municipalities` (`municipality_id`, `municipality_name`, `district_id`) VALUES
(1, 'Aamargadhi', 75),
(2, 'Aathabis', 67),
(3, 'Aathabiskot', 59),
(4, 'Arjundhara', 4),
(5, 'Aurahi', 18),
(6, 'Badimalika', 73),
(7, 'Bagchaur', 60),
(8, 'Baglung', 36),
(9, 'Bagmati', 19),
(10, 'Bahudarmai', 21),
(11, 'Balara', 19),
(12, 'Balawa', 18),
(13, 'Banepa', 29),
(14, 'Bangad Kupinde', 60),
(15, 'Banganga', 47),
(16, 'Bansgadhi', 58),
(17, 'Barahachhetra', 11),
(18, 'Barahathawa', 19),
(19, 'Barbardiya', 58),
(20, 'Bardghat', 48),
(21, 'Bardibas', 18),
(22, 'Barhabise', 33),
(23, 'Baudhimai', 22),
(24, 'Bedkot', 74),
(25, 'Belaka', 14),
(26, 'Belauri', 74),
(27, 'Belbaari', 6),
(28, 'Belkotgadhi', 31),
(29, 'Beni', 42),
(30, 'Besishahar', 39),
(31, 'Bhadrapur', 4),
(32, 'Bhajani', 69),
(33, 'Bhaktapur', 26),
(34, 'Bhangaha', 18),
(35, 'Bhanu', 46),
(36, 'Bharatpur', 34),
(37, 'Bheemdatta', 74),
(38, 'Bheerkot', 45),
(39, 'Bheri', 68),
(40, 'Bheriganga', 66),
(41, 'Bhimad', 46),
(42, 'Bhimeshwar', 25),
(43, 'Bhojpur', 1),
(44, 'Bhumikasthan', 50),
(45, 'Bideha', 17),
(46, 'Bidur', 31),
(47, 'Biratnagar', 6),
(48, 'Birendranagar', 66),
(49, 'Birgunj', 21),
(50, 'Birtamod', 4),
(51, 'Bode Barsain', 15),
(52, 'Brindaban', 22),
(53, 'Buddhabhumi', 47),
(54, 'Budhanilkantha', 28),
(55, 'Budhiganga', 73),
(56, 'Budhinanda', 73),
(57, 'Bungal', 72),
(58, 'Butwal', 49),
(59, 'Chainpur', 9),
(60, 'Chamunda Bindrasaini', 67),
(61, 'Chandannath', 63),
(62, 'Chandragiri', 28),
(63, 'Chandrapur', 22),
(64, 'Changunarayan', 26),
(65, 'Chapakot', 45),
(66, 'Chaudandigadhi', 14),
(67, 'Chaurjahari', 59),
(68, 'Chautara Sangachowkgadhi', 33),
(69, 'Chhayanath Rara', 65),
(70, 'Chhedagad', 68),
(71, 'Dakneshwari', 15),
(72, 'Damak', 4),
(73, 'Dasharath Chand', 76),
(74, 'Daxinkaali', 28),
(75, 'Deumai', 3),
(76, 'Devchuli', 43),
(77, 'Devdaha', 49),
(78, 'Dewahi Gonahi', 22),
(79, 'Dhangadhi', 69),
(80, 'Dhangadimai', 16),
(81, 'Dhankuta', 2),
(82, 'Dhanushadham', 17),
(83, 'Dharan', 11),
(84, 'Dharmadevi', 9),
(85, 'Dhorpatan', 36),
(86, 'Dhulikhel', 29),
(87, 'Dhunibeshi', 27),
(88, 'Diktel Rupakot Majuwagadhi', 5),
(89, 'Dipayal Silgadhi', 71),
(90, 'Dudhauli', 23),
(91, 'Duhabi', 11),
(92, 'Dullu', 67),
(93, 'Gadhimai', 22),
(94, 'Gaindakot', 43),
(95, 'Galkot', 36),
(96, 'Galyang', 45),
(97, 'Ganeshman Charnath', 17),
(98, 'Garuda', 22),
(99, 'Gaur', 22),
(100, 'Gauradaha', 4),
(101, 'Gauriganga', 69),
(102, 'Gaushala', 18),
(103, 'Ghodaghodi', 69),
(104, 'Ghorahi', 53),
(105, 'Godaita', 19),
(106, 'Godawari', 30),
(107, 'Godawari, Seti', 69),
(108, 'Gokarneshwor', 28),
(109, 'Golbazar', 16),
(110, 'Gorkha', 37),
(111, 'Gujara', 22),
(112, 'Gulariya', 58),
(113, 'Gurbhakot', 66),
(114, 'Halesi Tuwachung', 5),
(115, 'Hansapur', 17),
(116, 'Hanumannagar Kankalini', 15),
(117, 'Haripur', 19),
(118, 'Haripurwa', 19),
(119, 'Hariwan', 19),
(120, 'Hetauda', 35),
(121, 'Ilam', 3),
(122, 'Inaruwa', 11),
(123, 'Ishnath', 22),
(124, 'Ishworpur', 19),
(125, 'Itahari', 11),
(126, 'Jaimini', 36),
(127, 'Jaleshwar', 18),
(128, 'Janakpur', 17),
(129, 'Jaya Prithvi', 72),
(130, 'Jiri', 25),
(131, 'Jitpur Simara', 20),
(132, 'Kabilasi', 19),
(133, 'Kageshwori Manohara', 28),
(134, 'Kalaiya', 20),
(135, 'Kalika', 34),
(136, 'Kalyanpur', 16),
(137, 'Kamala', 17),
(138, 'Kamalamai', 23),
(139, 'Kamalbazar', 70),
(140, 'Kanchanrup', 15),
(141, 'Kankai', 4),
(142, 'Kapilvastu', 47),
(143, 'Karjanha', 16),
(144, 'Katahariya', 22),
(145, 'Katari', 14),
(146, 'Kathmandu', 28),
(147, 'Kawasoti', 43),
(148, 'Khadak', 15),
(149, 'Khairhani', 34),
(150, 'Khandachakra', 64),
(151, 'Khandbari', 9),
(152, 'Kirtipur', 28),
(153, 'Kohalpur', 57),
(154, 'Kolhabi', 20),
(155, 'Krishnanagar', 47),
(156, 'Krishnapur', 74),
(157, 'Kshireshwor Nath', 17),
(158, 'Kushma', 44),
(159, 'Lahan', 16),
(160, 'Lalbandi', 19),
(161, 'Laligurans', 13),
(162, 'Lalitpur', 30),
(163, 'Lamahi', 53),
(164, 'Lamki Chuha', 69),
(165, 'Lekbeshi', 66),
(166, 'Letang', 6),
(167, 'Loharpatti', 18),
(168, 'Lumbini Sanskritik', 49),
(169, 'Madhav Narayan', 22),
(170, 'Madhuwan', 58),
(171, 'Madhya Nepal', 39),
(172, 'Madhyabindu', 43),
(173, 'Madhyapur Thimi', 26),
(174, 'Madi', 34),
(175, 'Madi', 9),
(176, 'Mahagadhimai', 20),
(177, 'Mahakali', 77),
(178, 'Mahakali', 74),
(179, 'Mahalaxmi', 2),
(180, 'Mahalaxmi', 30),
(181, 'Maharajgunj', 47),
(182, 'Mai', 3),
(183, 'Malangwa', 19),
(184, 'Manara Shisawa', 18),
(185, 'Mandandeupur', 29),
(186, 'Mangalsen', 70),
(187, 'Manthali', 24),
(188, 'Matihani', 18),
(189, 'Maulapur', 22),
(190, 'Mechinagar', 4),
(191, 'Melamchi', 33),
(192, 'Melauli', 76),
(193, 'Mirchaiya', 16),
(194, 'Mithila', 17),
(195, 'Mithila Bihari', 17),
(196, 'Musikot', 51),
(197, 'Musikot', 59),
(198, 'Myanglung', 13),
(199, 'Nagarain', 17),
(200, 'Nagarjun', 28),
(201, 'Nalgad', 68),
(202, 'Namobuddha', 29),
(203, 'Narayan', 67),
(204, 'Nepalgunj', 57),
(205, 'Nijgadh', 20),
(206, 'Nilkantha', 27),
(207, 'Pachrauta', 20),
(208, 'Pakhribas', 2),
(209, 'Palungtar', 37),
(210, 'Panchadewal Binayak', 70),
(211, 'Panchapuri', 66),
(212, 'Panchkhal', 29),
(213, 'Panchkhapan', 9),
(214, 'Parashuram', 75),
(215, 'Paroha', 22),
(216, 'Parsagadhi', 21),
(217, 'Patan', 76),
(218, 'Pathari Shanischare', 6),
(219, 'Paunauti', 29),
(220, 'Phalewas', 44),
(221, 'Phatuwa Bijayapur', 22),
(222, 'Phidim', 8),
(223, 'Phungling', 12),
(224, 'Pokhara', 38),
(225, 'Pokhariya', 21),
(226, 'Punarbas', 74),
(227, 'Purchaundi', 76),
(228, 'Putalibaazar', 45),
(229, 'Pyuthan', 54),
(230, 'Rainas', 39),
(231, 'Rajapur', 58),
(232, 'Rajbiraj', 15),
(233, 'Rajdevi', 22),
(234, 'Rajpur', 22),
(235, 'Ramdhuni', 11),
(236, 'Ramechhap', 24),
(237, 'Ramgopalpur', 18),
(238, 'Ramgram', 48),
(239, 'Rampur', 52),
(240, 'Rangeli', 6),
(241, 'Rapti', 34),
(242, 'Raskot', 64),
(243, 'Ratnanagar', 34),
(244, 'Ratuwamai', 6),
(245, 'Resunga', 51),
(246, 'Ropla', 55),
(247, 'Sabaila', 17),
(248, 'Sainamaina', 49),
(249, 'Sandhikharka', 50),
(250, 'Saphebagar', 70),
(251, 'Saptakoshi', 15),
(252, 'Shaarda', 60),
(253, 'Shadanand', 1),
(254, 'Shahidnagar', 17),
(255, 'Shailyashikhar', 77),
(256, 'Shambhunath', 15),
(257, 'Shankharapur', 28),
(258, 'Shikhar', 71),
(259, 'Shiva Sataxi', 4),
(260, 'Shivaraj', 47),
(261, 'Shuklagandaki', 46),
(262, 'Shuklaphanta', 74),
(263, 'Siddharthanagar', 49),
(264, 'Siddhicharan', 7),
(265, 'Simraungadh', 20),
(266, 'Siraha', 16),
(267, 'Sitganga', 50),
(268, 'Solu Dudhkunda', 10),
(269, 'Sukhipur', 16),
(270, 'Sunawarshi', 6),
(271, 'Sundar Haraincha', 6),
(272, 'Sundarbazar', 39),
(273, 'Sunwal', 48),
(274, 'Surunga', 15),
(275, 'Suryabinayak', 26),
(276, 'Suryodaya', 3),
(277, 'Swargadwari', 54),
(278, 'Tansen', 52),
(279, 'Tarakeshor', 28),
(280, 'Thaha', 35),
(281, 'Thakurbaba', 58),
(282, 'Thuli Bheri', 61),
(283, 'Tikapur', 69),
(284, 'Tilagufa', 64),
(285, 'Tilottama', 49),
(286, 'Tokha', 28),
(287, 'Tribeni', 73),
(288, 'Tripura Sundari', 61),
(289, 'Triyuga', 14),
(290, 'Tulsipur', 53),
(291, 'Urlabari', 6),
(292, 'Vyas', 46),
(293, 'Waling', 45),
(294, 'Hatuwagadhi', 1),
(295, 'Ramprasad Rai', 1),
(296, 'Aamchok', 1),
(297, 'Tyamke Maiyunm', 1),
(298, 'Arun', 1),
(299, 'Pauwadungma', 1),
(300, 'Salpasilichho', 1),
(301, 'Sangurigadhi', 2),
(302, 'Chaubise', 2),
(303, 'Khalsa Chhintang Sahidbhumi', 2),
(304, 'Chhathar Jorpati', 2),
(305, 'Phakphokthum', 3),
(306, 'Mai Jogmai', 3),
(307, 'Chulachuli', 3),
(308, 'Rong', 3),
(309, 'Mangsebung', 3),
(310, 'Sandakpur', 3),
(311, 'Kamal', 4),
(312, 'Buddha Shanti', 4),
(313, 'Kachankawal', 4),
(314, 'Jhapa', 4),
(315, 'Barhadashi', 4),
(316, 'Gaurigunj', 4),
(317, 'Haldibari', 4),
(318, 'Khotehang', 5),
(319, 'Diprung', 5),
(320, 'Aiselukharka', 5),
(321, 'Jantedhunga', 5),
(322, 'Kepilasgadhi', 5),
(323, 'Barahpokhari', 5),
(324, 'Lamidanda', 5),
(325, 'Sakela', 5),
(326, 'Jahada', 6),
(327, 'Budi Ganga', 6),
(328, 'Katahari', 6),
(329, 'Dhanpalthan', 6),
(330, 'Kanepokhari', 6),
(331, 'Gramthan', 6),
(332, 'Kerabari', 6),
(333, 'Miklajung', 6),
(334, 'Manebhanjyang', 7),
(335, 'Champadevi', 7),
(336, 'Sunkoshi', 7),
(337, 'Molung', 7),
(338, 'Chisankhugadhi', 7),
(339, 'Khiji Demba', 7),
(340, 'Likhu', 7),
(341, 'Miklajung', 8),
(342, 'Phalgunanda', 8),
(343, 'Hilihang', 8),
(344, 'Phalelung', 8),
(345, 'Yangwarak', 8),
(346, 'Kummayak', 8),
(347, 'Tumbewa', 8),
(348, 'Makalu', 9),
(349, 'Silichong', 9),
(350, 'Sabhapokhari', 9),
(351, 'Chichila', 9),
(352, 'Bhot Khola', 9),
(353, 'Dudhakaushika', 10),
(354, 'Necha Salyan', 10),
(355, 'Dudhkoshi', 10),
(356, 'Maha Kulung', 10),
(357, 'Sotang', 10),
(358, 'Khumbu Pasang Lhamu', 10),
(359, 'Likhu Pike', 10),
(360, 'Koshi', 11),
(361, 'Harinagara', 11),
(362, 'Bhokraha', 11),
(363, 'Dewangunj', 11),
(364, 'Gadhi', 11),
(365, 'Barju', 11),
(366, 'Sirijangha', 12),
(367, 'Aathrai Triveni', 12),
(368, 'Pathibhara Yangwarak', 12),
(369, 'Meringden', 12),
(370, 'Sidingwa', 12),
(371, 'Phaktanglung', 12),
(372, 'Maiwa Khola', 12),
(373, 'Mikwa Khola', 12),
(374, 'Aathrai', 13),
(375, 'Phedap', 13),
(376, 'Chhathar', 13),
(377, 'Menchayayem', 13),
(378, 'Udayapurgadhi', 14),
(379, 'Rautamai', 14),
(380, 'Tapli', 14),
(381, 'Limchungbung', 14),
(382, 'Subarna', 20),
(383, 'Adarsha Kotwal', 20),
(384, 'Baragadhi', 20),
(385, 'Pheta', 20),
(386, 'Karaiyamai', 20),
(387, 'Prasauni', 20),
(388, 'Bishrampur', 20),
(389, 'Devtal', 20),
(390, 'Parawanipur', 20),
(391, 'Laksminiya', 17),
(392, 'Mukhiyapatti Musaharmiya', 17),
(393, 'Janak Nandini', 17),
(394, 'Aaurahi', 17),
(395, 'Bateshwar', 17),
(396, 'Dhanauji', 17),
(397, 'Sonama', 18),
(398, 'Pipara', 18),
(399, 'Samsi', 18),
(400, 'Ekdara', 18),
(401, 'Mahottari Rural Municipality', 18),
(402, 'Sakhuwa Prasauni', 21),
(403, 'Jagarnathpur', 21),
(404, 'Chhipaharmai', 21),
(405, 'Bindabasini', 21),
(406, 'Paterwa Sugauli', 21),
(407, 'Jeera Bhavani', 21),
(408, 'Kalikamai', 21),
(409, 'Pakaha Mainpur', 21),
(410, 'Thori', 21),
(411, 'Dhobini', 21),
(412, 'Durga Bhagawati', 22),
(413, 'Yamunamai', 22),
(414, 'Tilathi Koiladi', 15),
(415, 'Belhi Chapena', 15),
(416, 'Chhinnamasta', 15),
(417, 'Mahadeva', 15),
(418, 'Aagnisaira Krishnasawaran', 15),
(419, 'Rupani', 15),
(420, 'Balan-Bihul', 15),
(421, 'Bishnupur', 15),
(422, 'Tirhut', 15),
(423, 'Chandranagar', 19),
(424, 'Bramhapuri', 19),
(425, 'Ramnagar', 19),
(426, 'Chakraghatta', 19),
(427, 'Kaudena', 19),
(428, 'Dhankaul', 19),
(429, 'Bishnu', 19),
(430, 'Basbariya', 19),
(431, 'Parsa', 19),
(432, 'Laksmipur Patari', 16),
(433, 'Bariyarpatti', 16),
(434, 'Aaurahi', 16),
(435, 'Arnama', 16),
(436, 'Bhagawanpur', 16),
(437, 'Naraha', 16),
(438, 'Nawarajpur', 16),
(439, 'Sakhuwanankarkatti', 16),
(440, 'Bishnupur', 16),
(441, 'Ichchhakamana', 34),
(442, 'Thakre', 27),
(443, 'Benighat Rorang', 27),
(444, 'Galchhi', 27),
(445, 'Gajuri', 27),
(446, 'Jwalamukhi', 27),
(447, 'Siddhalekh', 27),
(448, 'Tripura Sundari', 27),
(449, 'Gangajamuna', 27),
(450, 'Netrawati Dabjong', 27),
(451, 'Khaniyabas', 27),
(452, 'Ruby Valley', 27),
(453, 'Kalinchok', 25),
(454, 'Melung', 25),
(455, 'Shailung', 25),
(456, 'Baiteshwar', 25),
(457, 'Tamakoshi', 25),
(458, 'Bigu', 25),
(459, 'Gaurishankar', 25),
(460, 'Roshi', 29),
(461, 'Temal', 29),
(462, 'Chaunri Deurali', 29),
(463, 'Bhumlu', 29),
(464, 'Mahabharat', 29),
(465, 'Bethanchok', 29),
(466, 'Khanikhola', 29),
(467, 'Bagmati', 30),
(468, 'Konjyosom', 30),
(469, 'Mahankal', 30),
(470, 'Bakaiya', 35),
(471, 'Manhari', 35),
(472, 'Bagmati', 35),
(473, 'Raksirang', 35),
(474, 'Makawanpurgadhi', 35),
(475, 'Kailash', 35),
(476, 'Bhimphedi', 35),
(477, 'Indrasarowar', 35),
(478, 'Kakani', 31),
(479, 'Dupcheshwar', 31),
(480, 'Shivapuri', 31),
(481, 'Tadi', 31),
(482, 'Likhu', 31),
(483, 'Suryagadhi', 31),
(484, 'Panchakanya', 31),
(485, 'Tarkeshwar', 31),
(486, 'Kispang', 31),
(487, 'Myagang', 31),
(488, 'Khandadevi', 24),
(489, 'Likhu Tamakoshi', 24),
(490, 'Doramba', 24),
(491, 'Gokulganga', 24),
(492, 'Sunapati', 24),
(493, 'Umakunda', 24),
(494, 'Naukunda', 32),
(495, 'Kalika', 32),
(496, 'Uttargaya', 32),
(497, 'Gosaikund', 32),
(498, 'Aamachodingmo', 32),
(499, 'Tinpatan', 23),
(500, 'Marin', 23),
(501, 'Hariharpurgadhi', 23),
(502, 'Sunkoshi', 23),
(503, 'Golanjor', 23),
(504, 'Phikkal', 23),
(505, 'Ghyanglekh', 23),
(506, 'Indrawati', 33),
(507, 'Panchpokhari Thangpal', 33),
(508, 'Jugal', 33),
(509, 'Balephi', 33),
(510, 'Helambu', 33),
(511, 'Bhotekoshi', 33),
(512, 'Sunkoshi', 33),
(513, 'Lisankhu Pakhar', 33),
(514, 'Tripura Sundari', 33),
(515, 'Badigad', 36),
(516, 'Kathekhola', 36),
(517, 'Nisikhola', 36),
(518, 'Bareng', 36),
(519, 'Tarakhola', 36),
(520, 'Tamankhola', 36),
(521, 'Shahid Lakhan', 37),
(522, 'Barpak Sulikot', 37),
(523, 'Aarughat', 37),
(524, 'Siranchok', 37),
(525, 'Gandaki', 37),
(526, 'Bhimsen Thapa', 37),
(527, 'Ajirkot', 37),
(528, 'Dharche', 37),
(529, 'Chum Nubri', 37),
(530, 'Annapurna', 38),
(531, 'Machhapuchhre', 38),
(532, 'Madi', 38),
(533, 'Rupa', 38),
(534, 'Marsyangdi', 39),
(535, 'Dordi', 39),
(536, 'Dudhpokhari', 39),
(537, 'Kwaholasothar', 39),
(538, 'Manang Disyang', 40),
(539, 'Nason', 40),
(540, 'Chame', 40),
(541, 'Narpa Bhumi', 40),
(542, 'Gharpajhong', 41),
(543, 'Thasang', 41),
(544, 'Baragung Muktichhetra', 41),
(545, 'Lomanthang', 41),
(546, 'Lo-Thekar Damodarkunda', 41),
(547, 'Malika', 42),
(548, 'Mangala', 42),
(549, 'Raghuganga', 42),
(550, 'Dhaulagiri', 42),
(551, 'Annapurna', 42),
(552, 'Hupsekot', 43),
(553, 'Binayi Triveni', 43),
(554, 'Bulingtar', 43),
(555, 'Baudikali', 43),
(556, 'Jaljala', 44),
(557, 'Modi', 44),
(558, 'Painyu', 44),
(559, 'Bihadi', 44),
(560, 'Mahashila', 44),
(561, 'Kaligandaki', 45),
(562, 'Biruwa', 45),
(563, 'Harinas', 45),
(564, 'Aandhikhola', 45),
(565, 'Arjun Chaupari', 45),
(566, 'Phedikhola', 45),
(567, 'Rishing', 46),
(568, 'Myagde', 46),
(569, 'Aanbu Khaireni', 46),
(570, 'Bandipur', 46),
(571, 'Ghiring', 46),
(572, 'Devghat', 46),
(573, 'Malarani', 50),
(574, 'Pandini', 50),
(575, 'Chhatradev', 50),
(576, 'Raptisonari', 57),
(577, 'Baijnath', 57),
(578, 'Khajura', 57),
(579, 'Janaki', 57),
(580, 'Duduwa', 57),
(581, 'Narainapur', 57),
(582, 'Badhaiyatal', 58),
(583, 'Geruwa', 58),
(584, 'Rapti', 53),
(585, 'Gadhawa', 53),
(586, 'Babai', 53),
(587, 'Shantinagar', 53),
(588, 'Rajpur', 53),
(589, 'Banglachuli', 53),
(590, 'Dangisharan', 53),
(591, 'Satyawati', 51),
(592, 'Dhurkot', 51),
(593, 'Gulmi Durbar', 51),
(594, 'Madane', 51),
(595, 'Chandrakot', 51),
(596, 'Malika', 51),
(597, 'Chhatrakot', 51),
(598, 'Isma', 51),
(599, 'Kaligandaki', 51),
(600, 'Ruru', 51),
(601, 'Mayadevi', 47),
(602, 'Shuddhodhan', 47),
(603, 'Yasodhara', 47),
(604, 'Bijaynagar', 47),
(605, 'Triveni Susta', 48),
(606, 'Pratappur', 48),
(607, 'Sarawal', 48),
(608, 'Palhi Nandan', 48),
(609, 'Rainadevi Chhahara', 52),
(610, 'Mathagadhi', 52),
(611, 'Nisdi', 52),
(612, 'Bagnaskali', 52),
(613, 'Rambha', 52),
(614, 'Purbakhola', 52),
(615, 'Tinau', 52),
(616, 'Ribdikot', 52),
(617, 'Naubahini', 54),
(618, 'Jhimaruk', 54),
(619, 'Gaumukhi', 54),
(620, 'Airawati', 54),
(621, 'Sarumarani', 54),
(622, 'Mallarani', 54),
(623, 'Mandavi', 54),
(624, 'Sunil Smriti', 55),
(625, 'Runtigadhi', 55),
(626, 'Lungri', 55),
(627, 'Triveni', 55),
(628, 'Paribartan', 55),
(629, 'Gangadev', 55),
(630, 'Madi', 55),
(631, 'Sunchhahari', 55),
(632, 'Thawang', 55),
(633, 'Bhume', 56),
(634, 'Putha Uttarganga', 56),
(635, 'Sisne', 56),
(636, 'Gaidhawa', 49),
(637, 'Mayadevi', 49),
(638, 'Kotahimai', 49),
(639, 'Marchawarimai', 49),
(640, 'Siyari', 49),
(641, 'Sammarimai', 49),
(642, 'Rohini', 49),
(643, 'Shuddhodhan', 49),
(644, 'Om Satiya', 49),
(645, 'Kanchan', 49),
(646, 'Gurans', 67),
(647, 'Bhairabi', 67),
(648, 'Naumule', 67),
(649, 'Mahabu', 67),
(650, 'Thantikandh', 67),
(651, 'Bhagawatimai', 67),
(652, 'Dungeshwar', 67),
(653, 'Mudkechula', 61),
(654, 'Kaike', 61),
(655, 'She Phoksundo', 61),
(656, 'Jagadulla', 61),
(657, 'Dolpo Buddha', 61),
(658, 'Chharka Tangsong', 61),
(659, 'Simkot', 62),
(660, 'Sarkegad', 62),
(661, 'Adanchuli', 62),
(662, 'Kharpunath', 62),
(663, 'Tanjakot', 62),
(664, 'Chankheli', 62),
(665, 'Namkha', 62),
(666, 'Junichande', 68),
(667, 'Kuse', 68),
(668, 'Barekot', 68),
(669, 'Shivalaya', 68),
(670, 'Tatopani', 63),
(671, 'Patarasi', 63),
(672, 'Tila', 63),
(673, 'Kanaka Sundari', 63),
(674, 'Sinja', 63),
(675, 'Hima', 63),
(676, 'Guthichaur', 63),
(677, 'Narharinath', 64),
(678, 'Palata', 64),
(679, 'Shubha Kalika', 64),
(680, 'Sanni Triveni', 64),
(681, 'Pachaljharana', 64),
(682, 'Mahawai', 64),
(683, 'Khatyad', 65),
(684, 'Soru', 65),
(685, 'Mugum Karmarong', 65),
(686, 'Sani Bheri', 59),
(687, 'Triveni', 59),
(688, 'Banphikot', 59),
(689, 'Kumakh', 60),
(690, 'Kalimati', 60),
(691, 'Chhatreshwari', 60),
(692, 'Darma', 60),
(693, 'Kapurkot', 60),
(694, 'Triveni', 60),
(695, 'Siddha Kumakh', 60),
(696, 'Barahatal', 66),
(697, 'Simta', 66),
(698, 'Chaukune', 66),
(699, 'Chingad', 66),
(700, 'Ramaroshan', 70),
(701, 'Chaurpati', 70),
(702, 'Turmakhand', 70),
(703, 'Mellekh', 70),
(704, 'Dhankari', 70),
(705, 'Bannigadi Jayagad', 70),
(706, 'Dogdakedar', 76),
(707, 'Dilashaini', 76),
(708, 'Sigas', 76),
(709, 'Pancheshwar', 76),
(710, 'Surnaya', 76),
(711, 'Shivanath', 76),
(712, 'Kedarsyu', 72),
(713, 'Thalara', 72),
(714, 'Bitthadchir', 72),
(715, 'Chhabis Pathibhera', 72),
(716, 'Chhanna', 72),
(717, 'Masta', 72),
(718, 'Durgathali', 72),
(719, 'Talkot', 72),
(720, 'Surma', 72),
(721, 'Saipal', 72),
(722, 'Khaptad Chhededaha', 73),
(723, 'Swami Kartik Khapar', 73),
(724, 'Jagannath', 73),
(725, 'Himali', 73),
(726, 'Gaumul', 73),
(727, 'Navadurga', 75),
(728, 'Aalitaal', 75),
(729, 'Ganyapadhura', 75),
(730, 'Bhageshwar', 75),
(731, 'Ajaymeru', 75),
(732, 'Naugad', 77),
(733, 'Malikarjun', 77),
(734, 'Marma', 77),
(735, 'Lekam', 77),
(736, 'Duhu', 77),
(737, 'Vyans', 77),
(738, 'Api Himal', 77),
(739, 'Aadarsha', 71),
(740, 'Purbichauki', 71),
(741, 'K.I. Singh', 71),
(742, 'Jorayal', 71),
(743, 'Sayal', 71),
(744, 'Bogatan', 71),
(745, 'Badikedar', 71),
(746, 'Janaki', 69),
(747, 'Kailari', 69),
(748, 'Joshipur', 69),
(749, 'Bargagoriya', 69),
(750, 'Mohanyal', 69),
(751, 'Chure', 69),
(752, 'Laljhadi', 74),
(753, 'Beldandi', 74)
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `municipality_id` = VALUES(`municipality_id`), `municipality_name` = VALUES(`municipality_name`), `district_id` = VALUES(`district_id`);

-- --------------------------------------------------------

--
-- Table structure for table `otp`
--

CREATE TABLE IF NOT EXISTS  `otp` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `user_id` int(11) DEFAULT NULL,
  `otp` varchar(255) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `expires_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `otp`
--

INSERT INTO `otp` (`id`, `user_id`, `otp`, `created_at`, `expires_at`) VALUES
(54, 43, '175796', '2024-06-24 01:13:06', '2024-06-24 07:03:06')
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `user_id` = VALUES(`user_id`), `otp` = VALUES(`otp`), `created_at` = VALUES(`created_at`), `expires_at` = VALUES(`expires_at`);

-- --------------------------------------------------------

--
-- Table structure for table `performance_types`
--

CREATE TABLE IF NOT EXISTS  `performance_types` (`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
  `performance_type_id` int(11) NOT NULL,
  `performance_type` varchar(255) NOT NULL,
  `artist_id` int(11) DEFAULT NULL,
  `cost_per_hour` decimal(10,2) NOT NULL,
  `is_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `performance_types`
--

INSERT INTO `performance_types` (`performance_type_id`, `performance_type`, `artist_id`, `cost_per_hour`, `is_deleted`) VALUES
(8, 'Concert', 43, 1500.00, 1),
(9, 'solo', 43, 1800.00, 0),
(10, 'venue', 46, 800.00, 0),
(11, 'Home', 46, 700.00, 0),
(12, 'Talk Show', 47, 2000.00, 0),
(13, 'Wedding', 47, 3500.00, 0),
(14, 'Live Storytelling Events', 48, 1570.00, 0),
(15, 'Digital Storytelling', 48, 500.00, 0),
(16, 'Concert', 47, 2500.00, 0),
(17, 'Studio Recordings', 47, 2200.00, 0),
(18, 'Charity and Benefit Concerts', 45, 1200.00, 0),
(19, 'Covers and Tributes', 45, 2800.00, 0),
(20, 'School Performances', 45, 3200.00, 0),
(21, 'Digital Storytelling', 49, 1300.00, 0),
(22, 'Live Storytelling Event', 49, 2700.00, 0),
(23, 'Educational Program', 43, 1780.00, 0),
(24, 'Stage Performance', 50, 2500.00, 0)
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `performance_type_id` = VALUES(`performance_type_id`), `performance_type` = VALUES(`performance_type`), `artist_id` = VALUES(`artist_id`), `cost_per_hour` = VALUES(`cost_per_hour`), `is_deleted` = VALUES(`is_deleted`);

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

CREATE TABLE IF NOT EXISTS  `provinces` (`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
  `province_id` int(1) NOT NULL,
  `province_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `provinces`
--

INSERT INTO `provinces` (`province_id`, `province_name`) VALUES
(3, 'Bagmati Pradesh'),
(4, 'Gandaki Pradesh'),
(6, 'Karnali Pradesh'),
(1, 'Province no. 1'),
(2, 'Province no. 2'),
(5, 'Province no. 5'),
(7, 'Sudurpashchim Pradesh')
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `province_id` = VALUES(`province_id`), `province_name` = VALUES(`province_name`);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS  `roles` (`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
  `role_id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'ADMIN'),
(2, 'ARTIST'),
(3, 'USER');

-- --------------------------------------------------------

--
-- Table structure for table `socialmediaplatforms`
--

CREATE TABLE IF NOT EXISTS  `socialmediaplatforms` (`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
  `platform_id` int(11) NOT NULL,
  `platform_name` varchar(255) NOT NULL,
  `icon_class` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `socialmediaplatforms`
--

INSERT INTO `socialmediaplatforms` (`platform_id`, `platform_name`, `icon_class`) VALUES
(1, 'Facebook', 'fa-brands fa-facebook'),
(2, 'Instagram', 'fa-brands fa-instagram'),
(3, 'YouTube', 'fa-brands fa-youtube'),
(4, 'Twitter', 'fa-brands fa-twitter');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS  `transactions` (`id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
  `transaction_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `transaction_uuid` varchar(255) NOT NULL,
  `payment_service` varchar(50) NOT NULL,
  `status` enum('success','failure','pending','cancelled') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `booking_id`, `transaction_uuid`, `payment_service`, `status`, `created_at`) VALUES
(24, 31, 'openmichub7071JXCZS', 'ESEWA', 'success', '2024-06-22 01:28:38'),
(25, 32, '9goK8DRQNtgULDBN5NUQsQ', 'KHALTI', 'success', '2024-06-22 02:23:48'),
(26, 32, '9goK8DRQNtgULDBN5NUQsQ', 'KHALTI', 'success', '2024-06-22 02:23:52'),
(27, 33, 'ieRZzsVy35GQ5YzKWhYnDm', 'KHALTI', 'success', '2024-06-22 02:28:07'),
(28, 36, 'YQsUR2jJoxkL4vFjLbkKuJ', 'KHALTI', 'success', '2024-06-30 04:34:04');

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

CREATE TABLE IF NOT EXISTS  `userdetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `fullName` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `profilePicture` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userdetails`
--

INSERT INTO `userdetails` (`id`, `fullName`, `phone`, `address`, `profilePicture`, `bio`, `created_at`, `updated_at`, `user_id`) VALUES
(15, 'Utsab Dahal', '9862506862', 'kathmandu', 'uploads/profile_pictures/42_1718776741_667273a57d5f9.jpg', 'Its me Utsab(user).', '2024-06-18 23:54:05', '0000-00-00 00:00:00', 42)
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `fullName` = VALUES(`fullName`), `phone` = VALUES(`phone`), `address` = VALUES(`address`), `profilePicture` = VALUES(`profilePicture`), `bio` = VALUES(`bio`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`), `user_id` = VALUES(`user_id`);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS  `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_verified` tinyint(1) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `is_blocked` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role_id`, `created_at`, `updated_at`, `is_verified`, `is_active`, `is_blocked`) VALUES
(41, 'admin', 'admin@gmail.com', '$2y$10$IE755OS.aDbWkkcCojNb3.fzwHWpVcBF8clhmdo5twmba9i1mwqi6', 1, '0000-00-00 00:00:00', NULL, 1, 1, 0),
(42, 'utsab', 'dlutsab2120@gmail.com', '$2y$10$zXrZuCahtaO0WromTdRaIu2e3zFqtAEw8bHPmfxzY948qXLFX413a', 3, '2024-06-19 05:25:25', NULL, 1, 1, 0),
(43, 'artist_utsab', 'utsab.dahal78@aadimcollege.edu.np', '$2y$10$RxjAQmX6Vyb3TBlvqUdwNOr5L6au0UmstTHRdaxklZn4GbWkadr3u', 2, '2024-06-19 06:00:02', NULL, 1, 1, 0),
(44, 'hari', 'hari@yopmail.com', '$2y$10$GuBmzWqKJok3ZChCSGdXV.HOlkVtmShwsLnoFw6RcBuPl2XIHcqZm', 2, '2024-06-23 11:09:03', '2024-06-23 11:35:32', 1, 1, 0),
(45, 'apson', 'apsonjirel@yopmail.com', '$2y$10$pGGdZV8vzngaUODKdfpABe0rx0P38H501rKH0FIE15q/JsIRvokra', 2, '2024-06-24 00:38:14', '2024-06-24 00:30:57', 1, 1, 0),
(46, 'dhiraj', 'dhirajjirel@yopmail.com', '$2y$10$yndradGYLTgDHXFV9m3dn.zhFBnUjcz.iXJ5shGEhblJ.DoFKKifa', 2, '2024-06-23 23:10:19', NULL, 1, 1, 0),
(47, 'Bishal', 'chitraprasad@yopmail.com', '$2y$10$kbTCOwIsyqgyiaUXVVvCxuFuB0uY/LrvtTxDOH1x0vdelXWCDQFMy', 2, '2024-06-23 23:20:47', NULL, 1, 1, 0),
(48, 'pasang', 'pasangsherpa@yopmail.com', '$2y$10$2MtR0KnsS8zAfVBN/HrR9eifomr.hFW2X/4mCbwJCFZdHPRTR93Fe', 2, '2024-06-23 23:32:06', NULL, 1, 1, 0),
(49, 'bibek', 'bibekshrestha@yopmail.com', '$2y$10$nFc6Rrj8qmn4DeVtB3sEZusSJtTqdwecD06p4gTRWIjE64/ZvDOAW', 2, '2024-06-24 00:40:30', NULL, 1, 1, 0),
(50, 'suresh', 'sureshmoktan@yopmail.com', '$2y$10$E3NElU1FGwvWTlJWlKkLIuoMFeFPB0HKxrBjNU39x90ZAI1pzrqCy', 2, '2024-06-24 02:52:19', NULL, 1, 1, 0),
(51, 'bikash', 'bikashkhanal@yopmail.com', '$2y$10$00FUHSaWv4r.2VP38Tkmee5cNCB28rRPTlhHpRlT8vEwC7cBG6OoC', 2, '2024-06-24 03:46:45', NULL, 1, 1, 0),
(52, 'naresh', 'nareshshahi@yopmail.com', '$2y$10$A62jY8e3GWkaML/yHMOefuR6NTzQ8wMXlp0h0Q/OOkn6QDX8gQiqC', 2, '2024-06-24 03:57:44', NULL, 1, 1, 0),
(53, 'nigam', 'nigamrai@yopmail.com', '$2y$10$OJDh9L48Qpa89hnvPTa69uwr4OX7Fvmgp0wXKoMPJOjlKpQmDOx.a', 2, '2024-06-26 04:00:00', NULL, 1, 1, 0),
(54, 'rajkumar', 'rajshrestha@yopmail.com', '$2y$10$e18UpH3q6lPBRQ4.UW1af.LnsQVhvgGF/.qNSKrBVO0ZxsxLrCgaW', 2, '2024-06-26 04:08:41', NULL, 1, 1, 0),
(55, 'tshiring', 'tshiringsherpa@yopmail.com', '$2y$10$DSJln44RkpnQ9F8YC.ogC.fChI2t3pkmi9jCIhZdQoZI8xs1OykS2', 2, '2024-06-26 04:14:35', NULL, 1, 1, 0),
(56, 'nirmal', 'nirmaldeuja@yopmail.com', '$2y$10$eesXbEr5L4yt0tAtJRgCguSu62M6L04TWMKZZYZa/80F/b0TZ58pC', 2, '2024-06-26 04:25:24', NULL, 1, 1, 0)
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `username` = VALUES(`username`), `email` = VALUES(`email`), `password` = VALUES(`password`), `role_id` = VALUES(`role_id`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`), `is_verified` = VALUES(`is_verified`), `is_active` = VALUES(`is_active`), `is_blocked` = VALUES(`is_blocked`);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
