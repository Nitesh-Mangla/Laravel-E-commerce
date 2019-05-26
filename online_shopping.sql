-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2019 at 01:50 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_shopping`
--

-- --------------------------------------------------------

--
-- Table structure for table `card details`
--

CREATE TABLE `card details` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `coupon no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `card details`
--

INSERT INTO `card details` (`id`, `email`, `product id`, `quantity`, `price`, `coupon no`, `created_at`, `updated_at`, `status`) VALUES
(1, 'niteshmangla1992@gmail.com', 1, 16, 16000, NULL, NULL, NULL, 0),
(2, 'niteshmangla1992@gmail.com', 2, 4, 8000, NULL, NULL, NULL, 1),
(3, 'niteshmangla1992@gmail.com', 3, 1, 10000, NULL, NULL, NULL, 0),
(4, 'kapilmangla1990@gmail.com', 1, 5, 5000, NULL, NULL, NULL, 0),
(5, 'kapilmangla1990@gmail.com', 5, 1, 20000, NULL, NULL, NULL, 0),
(17, 'sunilvmmc@gmail.com', 1, 9, 9000, NULL, NULL, NULL, 0),
(18, 'sunilvmmc@gmail.com', 2, 7, 14000, NULL, NULL, NULL, 0),
(19, 'sunilvmmc@gmail.com', 3, 2, 20000, NULL, NULL, NULL, 1),
(20, 'kapilmangla1990@gmail.com', 7, 3, 218970, NULL, NULL, NULL, 0),
(21, 'kapilmangla1990@gmail.com', 4, 1, 15000, NULL, NULL, NULL, 0),
(22, 'niteshmangla1992@gmail.com', 5, 8, 160000, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `name`, `code`) VALUES
(1, 'Åland Islands', 'AX'),
(2, 'Afghanistan', 'AF'),
(3, 'Albania', 'AL'),
(4, 'Algeria', 'DZ'),
(5, 'Andorra', 'AD'),
(6, 'Angola', 'AO'),
(7, 'Anguilla', 'AI'),
(8, 'Antarctica', 'AQ'),
(9, 'Argentina', 'AR'),
(10, 'Antigua and Barbuda', 'AG'),
(11, 'Armenia', 'AM'),
(12, 'Aruba', 'AW'),
(13, 'Australia', 'AU'),
(14, 'Austria', 'AT'),
(15, 'Azerbaijan', 'AZ'),
(16, 'Bahamas', 'BS'),
(17, 'Bahrain', 'BH'),
(18, 'Bangladesh', 'BD'),
(19, 'Barbados', 'BB'),
(20, 'Belarus', 'BY'),
(21, 'Belau', 'PW'),
(22, 'Belgium', 'BE'),
(23, 'Belize', 'bz'),
(24, 'Benin', 'bj'),
(25, 'Bermuda', 'BM'),
(26, 'Bhutan', 'BT'),
(27, 'Bolivia', 'BO'),
(28, 'Bonaire, Saint Eustatius and Saba', 'BQ'),
(29, 'Bosnia and Herzegovina', 'BA'),
(30, 'Botswana', 'BW'),
(31, 'Bouvet Island', 'BV'),
(32, 'Brazil', 'BR'),
(33, 'British Indian Ocean Territory', 'IO'),
(34, 'British Virgin Islands', 'VG'),
(35, 'Brunei', 'BN'),
(36, 'Bulgaria', 'BG'),
(37, 'Burkina Faso', 'BF'),
(38, 'Burundi', 'BI'),
(39, 'Cambodia', 'KH'),
(40, 'Cameroon', 'CM'),
(41, 'Canada', 'CA'),
(42, 'Cape Verde', 'CV'),
(43, 'Cayman Islands', 'KY'),
(44, 'Central African Republic', 'CF'),
(45, 'Chad', 'TD'),
(46, 'Chile', 'CL'),
(47, 'China', 'CN'),
(48, 'Christmas Island', 'CX'),
(49, 'Cocos (Keeling) Islands', 'CC'),
(50, 'Colombia', 'CO'),
(51, 'Comoros', 'KM'),
(52, 'Congo (Brazzaville)', 'CG'),
(53, 'Congo (Kinshasa)', 'CD'),
(54, 'Cook Islands', 'CK'),
(55, 'Costa Rica', 'CR'),
(56, 'Croatia', 'HR'),
(57, 'Cuba', 'CU'),
(58, 'CuraÇao', 'CW'),
(59, 'Cyprus', 'CY'),
(60, 'Czech Republic', 'CZ'),
(61, 'Denmark', 'DK'),
(62, 'Djibouti', 'DJ'),
(63, 'Dominica', 'DM'),
(64, 'Dominican Republic', 'DO'),
(65, 'Ecuador', 'EC'),
(66, 'Egypt', 'EG'),
(67, 'El Salvador', 'SV'),
(68, 'Equatorial Guinea', 'GQ'),
(69, 'Eritrea', 'ER'),
(70, 'Estonia', 'EE'),
(71, 'Ethiopia', 'ET'),
(72, 'Falkland Islands', 'FK'),
(73, 'Faroe Islands', 'FO'),
(74, 'Fiji', 'FJ'),
(75, 'Finland', 'FI'),
(76, 'France', 'FR'),
(77, 'French Guiana', 'GF'),
(78, 'French Polynesia', 'PF'),
(79, 'French Southern Territories', 'TF'),
(80, 'Gabon', 'GA'),
(81, 'Gambia', 'GM'),
(82, 'Georgia', 'GE'),
(83, 'Germany', 'DE'),
(84, 'Ghana', 'GH'),
(85, 'Gibraltar', 'GI'),
(86, 'Greece', 'GR'),
(87, 'Greenland', 'GL'),
(88, 'Grenada', 'GD'),
(89, 'Guadeloupe', 'GP'),
(90, 'Guernsey', 'GG'),
(91, 'Guatemala', 'GT'),
(92, 'Guinea', 'GN'),
(93, 'Guinea-Bissau', 'GW'),
(94, 'Guyana', 'GY'),
(95, 'Haiti', 'GT'),
(96, 'Heard Island and McDonald Islands', 'HM'),
(97, 'Honduras', 'HN'),
(98, 'Hong Kong', 'HK'),
(99, 'Hungary', 'HU');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 2),
(3, '2019_05_05_165451_product_details', 3),
(4, '2019_05_07_044737_card_details', 4),
(5, '2019_05_21_052146_user_profile', 5),
(6, '2019_05_26_022829_country', 6);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product details`
--

CREATE TABLE `product details` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` int(11) NOT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product details`
--

INSERT INTO `product details` (`id`, `product_name`, `description`, `quantity`, `price`, `image`, `discount`, `category`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Samsung galaxy 60', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 20, 1000, 'product-1.jpg', 10, 'phone', 'samsung', NULL, NULL),
(2, 'sony Xperia XZ2', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 10, 2000, 'product-2.jpg', 5, 'phone', 'sony', NULL, NULL),
(3, 'samsung s10+', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, 10000, 'product-3.jpg', 0, 'phone', 'samsung', NULL, NULL),
(4, 'LG V40 ThinQ', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.', 3, 15000, 'product-4.jpg', 2000, 'phone', 'LG', NULL, NULL),
(5, 'LG Q7 Alpha', 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 5, 20000, 'product-5.jpg', 0, 'phone', 'LG', NULL, NULL),
(6, 'Apple iPhone X (64GB) - Space Grey', '5.8-inch Super Retina display (OLED) with HDR\r\nIP67 water and dust resistant (maximum depth of 1 meter up to 30 minutes)\r\n12MP dual cameras with dual OIS and 7MP TrueDepth front camera—Portrait mode and Portrait Lighting\r\nFace ID for secure authentication\r\nA11 Bionic with Neural Engine\r\nWireless charging—works with Qi chargers\r\niOS 12 with Memoji, Screen Time, Siri Shortcuts, and Group FaceTime', 100, 100000, '411SxsDFpsL._SL1024_.jpg', 0, 'phone', 'iphone', NULL, NULL),
(7, 'HP ENVY x360 - 13-ag0035au', 'Power to turn heads\r\nTap into truly impressive notebook performance with AMD® Ryzen™, Radeon™ Vega graphics and up to 12.5 hours of battery life[1] for work and play.\r\n\r\nHighly intuitive interaction\r\nExperience intuitive interactions with Corning® Gorilla® Glass NBT™ touchscreen, quick logins with the IR camera, and Windows Ink.[2] Experience natural computing that\'s designed for your on-the-go-life.\r\n\r\nAMD Ryzen™ 5 2500U Quad-Core Processor (2 GHz base frequency, up to 3.6 GHz burst frequency, 6 MB cache)\r\nWindows 10 Home Single Language 64\r\n8 GB DDR4-2400 SDRAM (onboard)\r\n256 GB PCIe® NVMe™ M.2 SSD\r\nAMD Radeon™ Vega 8 Graphics\r\nStarting at 1.3 kg\r\n13.3\" diagonal FHD IPS BrightView WLED-backlit micro-edge multitouch-enabled edge-to-edge glass (1920 x 1080)\r\n1 year limited parts and labour', 5, 72990, 'laptop/HP ENVY x360 - 13-ag0035au.png', 83446, 'laptop', 'HP', NULL, NULL),
(8, 'HP Gaming Pavilion - 15-cx0140tx', 'A gaming and entertainment machine\r\nTake on the latest games and upgrade your entertainment with up to NVIDIA® GeForce® GTX 1060 or AMD RadeonTM RX 560 graphics. Add an optional 4k display[1], or a 1080p display[2] with 144Hz refresh rate[3], and play time is no joke.\r\n\r\nImmerse yourself‬\r\nSee more of the action on a stunning edge-to-edge display, and enjoy rich, authentic audio with front-firing speakers, HP Audio Boost, and tuning by B&O PLAY.\r\n\r\nThis is serious performance\r\nGet powerful multitasking and fast responsiveness with an Intel® Core™ processor and optional PCIe SSD or dual storage (HDD + PCIe SSD). Enjoy improved connectivity with fast throughput thanks to Wi-Fi supporting gigabit speeds on select models.\r\n\r\nIntel® Core™ i5-8300H Processor (2.3 GHz base frequency, up to 4 GHz with Intel® Turbo Boost Technology, 8 MB cache, 4 cores)\r\nWindows 10 Home Single Language 64\r\n8 GB DDR4-2666 SDRAM (1 x 8 GB)\r\n1 TB 7200 rpm SATA\r\nNVIDIA® GeForce® GTX 1050 (4 GB GDDR5 dedicated)\r\nStarting at 2.17 kg\r\n1 year limited parts and labour', 10, 700000, 'laptop/HP Gaming Pavilion - 15-cx0140tx.png', 82654, 'laptop', 'Hp', NULL, NULL),
(9, 'Apple MacBook Air', 'All new 2017 Apple MacBook Air\r\n1.8GHz Intel Core i5 processor\r\n8GB LPDDR3 RAM, 128GB Solid State hard drive\r\n13.3-inch screen, Intel HD Graphics 6000\r\nMacOS Sierra operating system\r\n1.35kg laptop\r\n1440x900 pixels per inch with support for millions of colors, 720p FaceTime HD camera\r\n1 year warranty from manufacturer from date of purchase', 5, 73461, 'laptop/Apple MacBook Air.jpg', 77200, 'lpatop', 'apple', NULL, NULL),
(10, 'HP Notebook - 15-da0327tu', '7th Generation Intel® Core™ i3 processor\r\nWindows 10 Home Single Language 64\r\n4 GB DDR4-2133 SDRAM (1 x 4 GB)\r\n1 TB 5400 rpm SATA\r\nIntel® HD Graphics 620\r\nIncluded:\r\nHP Original Laptop Bag (Worth ₹1,123)\r\nMicrosoft Office Home and Student', 2, 34830, 'laptop/HP Notebook - 15-da0327tu.png', 36457, 'laptop', 'HP', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `userprofile`
--

CREATE TABLE `userprofile` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'profile.jpg',
  `phone_no` bigint(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `userprofile`
--

INSERT INTO `userprofile` (`id`, `user_id`, `image`, `phone_no`, `status`) VALUES
(1, 8, '5ceb0b79c0312_1558907769.jpg', 8860315256, 1),
(3, 11, '5ce9afd6d8de4_1558818774.jpg', 9711239443, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider_user_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `google_id` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `provider_user_id`, `provider`, `remember_token`, `created_at`, `updated_at`, `google_id`) VALUES
(8, 'Nitesh Mangla', 'niteshmangla1992@gmail.com', NULL, 'e6e061838856bf47e1de730719fb2609', NULL, NULL, 'MPifAJjuCnitkCMUkZwsM6mEMfCScNnDjQYdj3pjn1Z3U3qBnGjUwUGD89lT', '2019-05-22 11:26:49', '2019-05-22 11:26:49', '100236917231398133665'),
(11, 'sunil mangla', 'sunilvmmc@gmail.com', NULL, '6d585df5e0370cd2e6992d5095fc8046', NULL, NULL, '1PFg3iQdLDUWAtAcS083GbGS6cgJSKzhOOv4dxtImzcdGKVIKIgSQhi5X1RJ', '2019-05-26 04:10:53', '2019-05-26 04:10:53', '117939676072705566158');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `card details`
--
ALTER TABLE `card details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `product details`
--
ALTER TABLE `product details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userprofile`
--
ALTER TABLE `userprofile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `card details`
--
ALTER TABLE `card details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product details`
--
ALTER TABLE `product details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `userprofile`
--
ALTER TABLE `userprofile`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
