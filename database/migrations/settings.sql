-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 06, 2022 at 02:57 PM
-- Server version: 8.0.29-0ubuntu0.20.04.3
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `OneNess_localtales_pre_launch_v2`
--

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `pretty_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `logo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image2` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `content1` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `content2` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` int NOT NULL COMMENT '1:Active 2:Inactive',
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `content`, `pretty_name`, `banner_image`, `logo`, `image`, `image2`, `content1`, `content2`, `status`, `value`, `created_at`, `updated_at`) VALUES
(1, 'social_facebook', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'fb_link', '2022-01-01 13:25:18', '2022-01-01 13:25:18'),
(2, 'social_twitter', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'twitter_link', '2022-01-01 13:25:18', '2022-04-19 02:05:35'),
(3, 'social_instagram', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'insta_link', '2022-01-01 13:25:18', '2022-04-19 03:44:20'),
(4, 'social_linkedin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'linkedin_link', '2022-01-01 13:25:18', '2022-04-19 03:44:19'),
(5, 'site_name', '<p><strong>Local Tales</strong></p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'Local Tales', '2022-01-01 13:25:44', '2022-05-04 01:24:23'),
(6, 'site_title', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'Local Tales', '2022-01-01 13:25:44', '2022-04-19 03:44:15'),
(7, 'default_email_address', '<p>info@localtales.net</p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'info@localtales.com', '2022-01-01 13:25:44', '2022-05-04 01:24:00'),
(8, 'Privacy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '2022-01-01 13:26:12', '2022-04-19 03:43:13'),
(9, 'terms', '<p>test</p>', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '<p>content</p>', '2022-01-01 13:26:12', '2022-04-19 03:43:10'),
(10, 'about_us', '<h4>Our Story</h4>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p>\r\n<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>', 'About Local Tales', 'about-banner.png', NULL, '1650610959.about-img.png', NULL, '<h4>Mission &amp; Vision</h4>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.</p>', '<h4>Our Goal</h4>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 0, '', '2022-04-21 10:39:12', '2022-04-22 01:32:39'),
(11, 'contact_us', '<p>content</p>', 'Contact Us', 'contact-banner-lg.png', NULL, 'contact.png', NULL, NULL, NULL, 1, '', '2022-04-21 11:16:14', '2022-04-21 05:52:24'),
(12, 'Splash Screen', '<h1><span>Launching </span>Soon...</h1>\r\n                    <h3>\r\n                        Propel your Local Business to Your Community\r\n                    </h3>\r\n                    <h5>\r\n                        We\'re currently in alpha launch\r\n                    </h5>', 'local tales', '1650609444.banner.png', '1650609444.main-logo.png', '1650609444.play-img.png', '1650609444.mobileApp.png', '<h2>\r\n                        Proin gravida vel <span class=\"text-main\">velit Aenean</span> sollicitudin\r\n                    </h2>\r\n                    <p>\r\n                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam nobis id voluptatem\r\n                        reprehenderit, minima sit, nulla maxime a fuga, ut perferendis et.\r\n                    </p>', '<h2>\r\n                        <span class=\"text-main\">Available</span>\r\n                        on desktop and via mobile\r\n                    </h2>\r\n                    <ul>\r\n                        <li>\r\n                            \r\n                            <p>\r\n                                Available on all platforms\r\n                            </p>\r\n                        </li>\r\n                        <li>\r\n                            \r\n                            <p>\r\n                                Propel your Local Business to Your Community\r\n                            </p>\r\n                        </li>\r\n                        <li>\r\n                            \r\n                            <p>\r\n                                Target your local community with a better online pressence.\r\n                                Communucate directly with locals with updates, events, deals and much more.\r\n                            </p>\r\n                        </li>\r\n                        <li>\r\n                            \r\n                            <p>\r\n                                Subscribe for early access to the product\r\n                            </p>\r\n                        </li>\r\n                    </ul>', 1, '', '2022-04-21 11:51:33', '2022-04-22 01:07:24'),
(13, 'faq', '<h3 class=\"text-underline\">How We Work</h3>\r\n<p>Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non mauris vitae erat consequat auctor eu .</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<h3>Who We Are!</h3>\r\n<p>Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora.</p>', 'Frequently Asked Questions', 'faq-banner.png', NULL, '1650611153.phone-sc.png', NULL, 'Who We Are!\r\nMorbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora.', NULL, 1, '', '2022-04-21 13:26:15', '2022-04-22 01:35:53'),
(14, 'website', '<p>info@localtales.net</p>', 'website_link', NULL, NULL, NULL, NULL, NULL, NULL, 1, '', NULL, '2022-04-22 02:06:37'),
(15, 'contact', '<ul class=\"contact-info mt-5\">\r\n<li>\r\n<p>1-25663-59644-569</p>\r\n</li>\r\n<li>\r\n<p>1-59647-5697-3695</p>\r\n</li>\r\n</ul>', 'website_contact', NULL, NULL, NULL, NULL, NULL, NULL, 1, '', NULL, '2022-04-22 02:07:57'),
(16, 'address', '<p>Dummy Location, South lead garb road, 3695AD, Australia</p>', 'site_address', NULL, NULL, NULL, NULL, NULL, NULL, 1, '', '2022-04-22 07:38:15', '2022-04-22 02:08:55'),
(17, 'Collection', '<h3>Top Cafes In Your Locality</h3>\r\n<p>This is Photoshop\'s version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum.</p>', '<h6>Top 10 cafes in Eltham</h6>\r\n\r\n                     <p>   Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis\r\n                        bibendum auctor, nisi elit consequat ipsum,</p>\r\n', '1651056431.collection__banner.png', NULL, NULL, NULL, '<h3>Summary</h3>\r\n<p>This is Photoshop\'s version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris in erat justo. Nullam ac urna eu felis dapibus condimentum sit amet a augue. Sed non neque elit. Sed ut imperdiet nisi. Proin condimentum fermentum nunc. Etiam pharetra, erat sed fermentum feugiat, velit mauris egestas quam, ut aliquam massa nisl quis neque. Suspendisse in orci enim.</p>\r\n<p>Sed non mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris in erat justo. Nullam ac urna eu felis dapibus condimentum sit .</p>\r\n<div class=\"col-12 mb-4\">\r\n<h3>Enjoy your experience</h3>\r\n<p>Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris in erat justo. Nullam ac urna eu felis dapibus condimentum sit amet a augue. Sed non neque elit. Sed ut imperdiet nisi. Proin condimentum fermentum nunc. Etiam pharetra, erat sed fermentum feugiat, velit mauris egestas quam, ut aliquam massa nisl quis neque. Suspendisse in orci enim.</p>\r\n</div>', NULL, 1, '', '2022-04-27 07:22:57', '2022-04-27 05:17:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
