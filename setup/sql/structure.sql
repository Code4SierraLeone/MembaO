-- ================================================================
--
-- @package Membao
-- @author Alan Kawamara
-- @copyright 2017
--
-- ================================================================
-- Database structure
-- ================================================================

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `description` text,
  `date_introduced` date NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `mover` int(6) NOT NULL DEFAULT '0',
  `bill_type` int(1) NOT NULL,
  `committee` int(6) NOT NULL,
  `created` datetime NOT NULL,
  `vote_up` int(6) DEFAULT '0',
  `vote_down` int(6) DEFAULT '0',
  `metakeys` text,
  `metadesc` text,
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--
-- Table structure for table `bills_recent`
--

CREATE TABLE `bills_recent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bid` int(11) NOT NULL DEFAULT '0',
  `user_id` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--
-- Table structure for table `bills_stats`
--

CREATE TABLE `bills_stats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `day` date NOT NULL DEFAULT '0000-00-00',
  `bid` int(11) NOT NULL DEFAULT '0',
  `hits` int(11) NOT NULL DEFAULT '0',
  `uhits` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table structure for table `bills_status`
--

CREATE TABLE `bills_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bill` int(11) NOT NULL,
  `status_date` date NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table structure for table `committees`
--

CREATE TABLE `committees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `description` text,
  `committees_type` int(6) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `metakeys` text,
  `metadesc` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table structure for table `committees_meetings`
--

CREATE TABLE `committees_meetings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `meeting_date` date NOT NULL,
  `meeting_type` int(2) NOT NULL,
  `description` text,
  `committee` int(11) NOT NULL,
  `attendance_status` int(1) NOT NULL DEFAULT '0',
  `file_id` int(5) NOT NULL,
  `created` datetime NOT NULL,
  `metakeys` text,
  `metadesc` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table structure for table `committees_meetings_attendance`
--

CREATE TABLE `committees_meetings_attendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `meeting_id` int(11) NOT NULL DEFAULT '0',
  `leader_id` int(11) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table structure for table `committees_members`
--

CREATE TABLE `committees_members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `committee` int(11) NOT NULL,
  `member` int(11) NOT NULL,
  `role` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table structure for table `committees_type`
--

CREATE TABLE `committees_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table structure for table `constituencies`
--

CREATE TABLE `constituencies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `district` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `constituencies`
--

INSERT INTO `constituencies` (`id`, `name`, `district`) VALUES
(1, 'Constituency 1', 'Kailahun'),
(2, 'Constituency 2', 'Kailahun'),
(3, 'Constituency 3', 'Kailahun'),
(4, 'Constituency 4', 'Kailahun'),
(5, 'Constituency 5', 'Kailahun'),
(6, 'Constituency 6', 'Kailahun'),
(7, 'Constituency 7', 'Kailahun'),
(8, 'Constituency 8', 'Kailahun'),
(9, 'Constituency 9', 'Kenema'),
(10, 'Constituency 10', 'Kenema'),
(11, 'Constituency 11', 'Kenema'),
(12, 'Constituency 12', 'Kenema'),
(13, 'Constituency 13', 'Kenema'),
(14, 'Constituency 14', 'Kenema'),
(15, 'Constituency 15', 'Kenema'),
(16, 'Constituency 16', 'Kenema'),
(17, 'Constituency 17', 'Kenema'),
(18, 'Constituency 18', 'Kenema'),
(19, 'Constituency 19', 'Kenema'),
(20, 'Constituency 20', 'Kono'),
(21, 'Constituency 21', 'Kono'),
(22, 'Constituency 22', 'Kono'),
(23, 'Constituency 23', 'Kono'),
(24, 'Constituency 24', 'Kono'),
(25, 'Constituency 25', 'Kono'),
(26, 'Constituency 26', 'Kono'),
(27, 'Constituency 27', 'Kono'),
(28, 'Constituency 28', 'Bombali'),
(29, 'Constituency 29', 'Bombali'),
(30, 'Constituency 30', 'Bombali'),
(31, 'Constituency 31', 'Bombali'),
(32, 'Constituency 32', 'Bombali'),
(33, 'Constituency 33', 'Bombali'),
(34, 'Constituency 34', 'Bombali'),
(35, 'Constituency 35', 'Bombali'),
(36, 'Constituency 36', 'Bombali'),
(37, 'Constituency 37', 'Kambia'),
(38, 'Constituency 38', 'Kambia'),
(39, 'Constituency 39', 'Kambia'),
(40, 'Constituency 40', 'Kambia'),
(41, 'Constituency 41', 'Kambia'),
(42, 'Constituency 42', 'Kambia'),
(43, 'Constituency 43', 'Koinadugu'),
(44, 'Constituency 44', 'Koinadugu'),
(45, 'Constituency 45', 'Koinadugu'),
(46, 'Constituency 46', 'Koinadugu'),
(47, 'Constituency 47', 'Koinadugu'),
(48, 'Constituency 48', 'Koinadugu'),
(49, 'Constituency 49', 'Port Loko'),
(50, 'Constituency 50', 'Port Loko'),
(51, 'Constituency 51', 'Port Loko'),
(52, 'Constituency 52', 'Port Loko'),
(53, 'Constituency 53', 'Port Loko'),
(54, 'Constituency 54', 'Port Loko'),
(55, 'Constituency 55', 'Port Loko'),
(56, 'Constituency 56', 'Port Loko'),
(57, 'Constituency 57', 'Port Loko'),
(58, 'Constituency 58', 'Port Loko'),
(59, 'Constituency 59', 'Tonkolili'),
(60, 'Constituency 60', 'Tonkolili'),
(61, 'Constituency 61', 'Tonkolili'),
(62, 'Constituency 62', 'Tonkolili'),
(63, 'Constituency 63', 'Tonkolili'),
(64, 'Constituency 64', 'Tonkolili'),
(65, 'Constituency 65', 'Tonkolili'),
(66, 'Constituency 66', 'Tonkolili'),
(67, 'Constituency 67', 'Bo'),
(68, 'Constituency 68', 'Bo'),
(69, 'Constituency 69', 'Bo'),
(70, 'Constituency 70', 'Bo'),
(71, 'Constituency 71', 'Bo'),
(72, 'Constituency 72', 'Bo'),
(73, 'Constituency 73', 'Bo'),
(74, 'Constituency 74', 'Bo'),
(75, 'Constituency 75', 'Bo'),
(76, 'Constituency 76', 'Bo'),
(77, 'Constituency 77', 'Bo'),
(78, 'Constituency 78', 'Bonthe'),
(79, 'Constituency 79', 'Bonthe'),
(80, 'Constituency 80', 'Bonthe'),
(81, 'Constituency 81', 'Moyamba'),
(82, 'Constituency 82', 'Moyamba'),
(83, 'Constituency 83', 'Moyamba'),
(84, 'Constituency 84', 'Moyamba'),
(85, 'Constituency 85', 'Moyamba'),
(86, 'Constituency 86', 'Moyamba'),
(87, 'Constituency 87', 'Pujehun'),
(88, 'Constituency 88', 'Pujehun'),
(89, 'Constituency 89', 'Pujehun'),
(90, 'Constituency 90', 'Pujehun'),
(91, 'Constituency 91', 'Pujehun'),
(92, 'Constituency 92', 'Western Rural'),
(93, 'Constituency 93', 'Western Rural'),
(94, 'Constituency 94', 'Western Rural'),
(95, 'Constituency 95', 'Western Rural'),
(96, 'Constituency 96', 'Western Urban'),
(97, 'Constituency 97', 'Western Urban'),
(98, 'Constituency 98', 'Western Urban'),
(99, 'Constituency 99', 'Western Urban'),
(100, 'Constituency 100', 'Western Urban'),
(101, 'Constituency 101', 'Western Urban'),
(102, 'Constituency 102', 'Western Urban'),
(103, 'Constituency 103', 'Western Urban'),
(104, 'Constituency 104', 'Western Urban'),
(105, 'Constituency 105', 'Western Urban'),
(106, 'Constituency 106', 'Western Urban'),
(107, 'Constituency 107', 'Western Urban'),
(108, 'Constituency 108', 'Western Urban'),
(109, 'Constituency 109', 'Western Urban'),
(110, 'Constituency 110', 'Western Urban'),
(111, 'Constituency 111', 'Western Urban'),
(112, 'Constituency 112', 'Western Urban'),
(113, 'Bo District', 'Bo District'),
(114, 'Kailhun District', 'Kailhun District'),
(115, 'Pujehun District', 'Pujehun District'),
(116, 'Tonkolili District', 'Tonkolili District'),
(117, 'Bonthe District', 'Bonthe District'),
(118, 'Koinadugu District', 'Koinadugu District'),
(119, 'Moyamba District', 'Moyamba District'),
(120, 'Kono District', 'Kono District'),
(121, 'Bombali District', 'Bombali District'),
(122, 'Kenema District', 'Kenema District'),
(123, 'Kambia District', 'Kambia District'),
(124, 'Port Loko District', 'Port Loko District');

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `id` smallint(6) DEFAULT NULL,
  `abbr` varchar(6) DEFAULT NULL,
  `name` varchar(210) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `home` tinyint(1) DEFAULT NULL,
  `vat` decimal(7,0) DEFAULT NULL,
  `sorting` smallint(6) DEFAULT NULL,
  KEY `idx` (`abbr`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `abbr`, `name`, `active`, `home`, `vat`, `sorting`) VALUES
(1, 'AF', 'Afghanistan', 1, NULL, '0', 0),
(2, 'AL', 'Albania', 1, NULL, '0', 0),
(3, 'DZ', 'Algeria', 1, NULL, '0', 0),
(4, 'AS', 'American Samoa', 1, NULL, '0', 0),
(5, 'AD', 'Andorra', 1, NULL, '0', 0),
(6, 'AO', 'Angola', 1, NULL, '0', 0),
(7, 'AI', 'Anguilla', 1, NULL, '0', 0),
(8, 'AQ', 'Antarctica', 1, NULL, '0', 0),
(9, 'AG', 'Antigua and Barbuda', 1, NULL, '0', 0),
(10, 'AR', 'Argentina', 1, NULL, '0', 0),
(11, 'AM', 'Armenia', 1, NULL, '0', 0),
(12, 'AW', 'Aruba', 1, NULL, '0', 0),
(13, 'AU', 'Australia', 1, NULL, '0', 0),
(14, 'AT', 'Austria', 1, NULL, '0', 0),
(15, 'AZ', 'Azerbaijan', 1, NULL, '0', 0),
(16, 'BS', 'Bahamas', 1, NULL, '0', 0),
(17, 'BH', 'Bahrain', 1, NULL, '0', 0),
(18, 'BD', 'Bangladesh', 1, NULL, '0', 0),
(19, 'BB', 'Barbados', 1, NULL, '0', 0),
(20, 'BY', 'Belarus', 1, NULL, '0', 0),
(21, 'BE', 'Belgium', 1, NULL, '0', 0),
(22, 'BZ', 'Belize', 1, NULL, '0', 0),
(23, 'BJ', 'Benin', 1, NULL, '0', 0),
(24, 'BM', 'Bermuda', 1, NULL, '0', 0),
(25, 'BT', 'Bhutan', 1, NULL, '0', 0),
(26, 'BO', 'Bolivia', 1, NULL, '0', 0),
(27, 'BA', 'Bosnia and Herzegowina', 1, NULL, '0', 0),
(28, 'BW', 'Botswana', 1, NULL, '0', 0),
(29, 'BV', 'Bouvet Island', 1, NULL, '0', 0),
(30, 'BR', 'Brazil', 1, NULL, '0', 0),
(31, 'IO', 'British Indian Ocean Territory', 1, NULL, '0', 0),
(32, 'VG', 'British Virgin Islands', 1, NULL, '0', 0),
(33, 'BN', 'Brunei Darussalam', 1, NULL, '0', 0),
(34, 'BG', 'Bulgaria', 1, NULL, '0', 0),
(35, 'BF', 'Burkina Faso', 1, NULL, '0', 0),
(36, 'BI', 'Burundi', 1, NULL, '0', 0),
(37, 'KH', 'Cambodia', 1, NULL, '0', 0),
(38, 'CM', 'Cameroon', 1, NULL, '0', 0),
(39, 'CA', 'Canada', 1, 1, '13', 1000),
(40, 'CV', 'Cape Verde', 1, NULL, '0', 0),
(41, 'KY', 'Cayman Islands', 1, NULL, '0', 0),
(42, 'CF', 'Central African Republic', 1, NULL, '0', 0),
(43, 'TD', 'Chad', 1, NULL, '0', 0),
(44, 'CL', 'Chile', 1, NULL, '0', 0),
(45, 'CN', 'China', 1, NULL, '0', 0),
(46, 'CX', 'Christmas Island', 1, NULL, '0', 0),
(47, 'CC', 'Cocos (Keeling) Islands', 1, NULL, '0', 0),
(48, 'CO', 'Colombia', 1, NULL, '0', 0),
(49, 'KM', 'Comoros', 1, NULL, '0', 0),
(50, 'CG', 'Congo', 1, NULL, '0', 0),
(51, 'CK', 'Cook Islands', 1, NULL, '0', 0),
(52, 'CR', 'Costa Rica', 1, NULL, '0', 0),
(53, 'CI', 'Cote D&#39;ivoire', 1, NULL, '0', 0),
(54, 'HR', 'Croatia', 1, NULL, '0', 0),
(55, 'CU', 'Cuba', 1, NULL, '0', 0),
(56, 'CY', 'Cyprus', 1, NULL, '0', 0),
(57, 'CZ', 'Czech Republic', 1, NULL, '0', 0),
(58, 'DK', 'Denmark', 1, NULL, '0', 0),
(59, 'DJ', 'Djibouti', 1, NULL, '0', 0),
(60, 'DM', 'Dominica', 1, NULL, '0', 0),
(61, 'DO', 'Dominican Republic', 1, NULL, '0', 0),
(62, 'TP', 'East Timor', 1, NULL, '0', 0),
(63, 'EC', 'Ecuador', 1, NULL, '0', 0),
(64, 'EG', 'Egypt', 1, NULL, '0', 0),
(65, 'SV', 'El Salvador', 1, NULL, '0', 0),
(66, 'GQ', 'Equatorial Guinea', 1, NULL, '0', 0),
(67, 'ER', 'Eritrea', 1, NULL, '0', 0),
(68, 'EE', 'Estonia', 1, NULL, '0', 0),
(69, 'ET', 'Ethiopia', 1, NULL, '0', 0),
(70, 'FK', 'Falkland Islands (Malvinas)', 1, NULL, '0', 0),
(71, 'FO', 'Faroe Islands', 1, NULL, '0', 0),
(72, 'FJ', 'Fiji', 1, NULL, '0', 0),
(73, 'FI', 'Finland', 1, NULL, '0', 0),
(74, 'FR', 'France', 1, NULL, '0', 0),
(75, 'GF', 'French Guiana', 1, NULL, '0', 0),
(76, 'PF', 'French Polynesia', 1, NULL, '0', 0),
(77, 'TF', 'French Southern Territories', 1, NULL, '0', 0),
(78, 'GA', 'Gabon', 1, NULL, '0', 0),
(79, 'GM', 'Gambia', 1, NULL, '0', 0),
(80, 'GE', 'Georgia', 1, NULL, '0', 0),
(81, 'DE', 'Germany', 1, NULL, '0', 0),
(82, 'GH', 'Ghana', 1, NULL, '0', 0),
(83, 'GI', 'Gibraltar', 1, NULL, '0', 0),
(84, 'GR', 'Greece', 1, NULL, '0', 0),
(85, 'GL', 'Greenland', 1, NULL, '0', 0),
(86, 'GD', 'Grenada', 1, NULL, '0', 0),
(87, 'GP', 'Guadeloupe', 1, NULL, '0', 0),
(88, 'GU', 'Guam', 1, NULL, '0', 0),
(89, 'GT', 'Guatemala', 1, NULL, '0', 0),
(90, 'GN', 'Guinea', 1, NULL, '0', 0),
(91, 'GW', 'Guinea-Bissau', 1, NULL, '0', 0),
(92, 'GY', 'Guyana', 1, NULL, '0', 0),
(93, 'HT', 'Haiti', 1, NULL, '0', 0),
(94, 'HM', 'Heard and McDonald Islands', 1, NULL, '0', 0),
(95, 'HN', 'Honduras', 1, NULL, '0', 0),
(96, 'HK', 'Hong Kong', 1, NULL, '0', 0),
(97, 'HU', 'Hungary', 1, NULL, '0', 0),
(98, 'IS', 'Iceland', 1, NULL, '0', 0),
(99, 'IN', 'India', 1, NULL, '0', 0),
(100, 'ID', 'Indonesia', 1, NULL, '0', 0),
(101, 'IQ', 'Iraq', 1, NULL, '0', 0),
(102, 'IE', 'Ireland', 1, NULL, '0', 0),
(103, 'IR', 'Islamic Republic of Iran', 1, NULL, '0', 0),
(104, 'IL', 'Israel', 1, NULL, '0', 0),
(105, 'IT', 'Italy', 1, NULL, '0', 0),
(106, 'JM', 'Jamaica', 1, NULL, '0', 0),
(107, 'JP', 'Japan', 1, NULL, '0', 0),
(108, 'JO', 'Jordan', 1, NULL, '0', 0),
(109, 'KZ', 'Kazakhstan', 1, NULL, '0', 0),
(110, 'KE', 'Kenya', 1, NULL, '0', 0),
(111, 'KI', 'Kiribati', 1, NULL, '0', 0),
(112, 'KP', 'Korea, Dem. Peoples Rep of', 1, NULL, '0', 0),
(113, 'KR', 'Korea, Republic of', 1, NULL, '0', 0),
(114, 'KW', 'Kuwait', 1, NULL, '0', 0),
(115, 'KG', 'Kyrgyzstan', 1, NULL, '0', 0),
(116, 'LA', 'Laos', 1, NULL, '0', 0),
(117, 'LV', 'Latvia', 1, NULL, '0', 0),
(118, 'LB', 'Lebanon', 1, NULL, '0', 0),
(119, 'LS', 'Lesotho', 1, NULL, '0', 0),
(120, 'LR', 'Liberia', 1, NULL, '0', 0),
(121, 'LY', 'Libyan Arab Jamahiriya', 1, NULL, '0', 0),
(122, 'LI', 'Liechtenstein', 1, NULL, '0', 0),
(123, 'LT', 'Lithuania', 1, NULL, '0', 0),
(124, 'LU', 'Luxembourg', 1, NULL, '0', 0),
(125, 'MO', 'Macau', 1, NULL, '0', 0),
(126, 'MK', 'Macedonia', 1, NULL, '0', 0),
(127, 'MG', 'Madagascar', 1, NULL, '0', 0),
(128, 'MW', 'Malawi', 1, NULL, '0', 0),
(129, 'MY', 'Malaysia', 1, NULL, '0', 0),
(130, 'MV', 'Maldives', 1, NULL, '0', 0),
(131, 'ML', 'Mali', 1, NULL, '0', 0),
(132, 'MT', 'Malta', 1, NULL, '0', 0),
(133, 'MH', 'Marshall Islands', 1, NULL, '0', 0),
(134, 'MQ', 'Martinique', 1, NULL, '0', 0),
(135, 'MR', 'Mauritania', 1, NULL, '0', 0),
(136, 'MU', 'Mauritius', 1, NULL, '0', 0),
(137, 'YT', 'Mayotte', 1, NULL, '0', 0),
(138, 'MX', 'Mexico', 1, NULL, '0', 0),
(139, 'FM', 'Micronesia', 1, NULL, '0', 0),
(140, 'MD', 'Moldova, Republic of', 1, NULL, '0', 0),
(141, 'MC', 'Monaco', 1, NULL, '0', 0),
(142, 'MN', 'Mongolia', 1, NULL, '0', 0),
(143, 'MS', 'Montserrat', 1, NULL, '0', 0),
(144, 'MA', 'Morocco', 1, NULL, '0', 0),
(145, 'MZ', 'Mozambique', 1, NULL, '0', 0),
(146, 'MM', 'Myanmar', 1, NULL, '0', 0),
(147, 'NA', 'Namibia', 1, NULL, '0', 0),
(148, 'NR', 'Nauru', 1, NULL, '0', 0),
(149, 'NP', 'Nepal', 1, NULL, '0', 0),
(150, 'NL', 'Netherlands', 1, NULL, '0', 0),
(151, 'AN', 'Netherlands Antilles', 1, NULL, '0', 0),
(152, 'NC', 'New Caledonia', 1, NULL, '0', 0),
(153, 'NZ', 'New Zealand', 1, NULL, '0', 0),
(154, 'NI', 'Nicaragua', 1, NULL, '0', 0),
(155, 'NE', 'Niger', 1, NULL, '0', 0),
(156, 'NG', 'Nigeria', 1, NULL, '0', 0),
(157, 'NU', 'Niue', 1, NULL, '0', 0),
(158, 'NF', 'Norfolk Island', 1, NULL, '0', 0),
(159, 'MP', 'Northern Mariana Islands', 1, NULL, '0', 0),
(160, 'NO', 'Norway', 1, NULL, '0', 0),
(161, 'OM', 'Oman', 1, NULL, '0', 0),
(162, 'PK', 'Pakistan', 1, NULL, '0', 0),
(163, 'PW', 'Palau', 1, NULL, '0', 0),
(164, 'PA', 'Panama', 1, NULL, '0', 0),
(165, 'PG', 'Papua New Guinea', 1, NULL, '0', 0),
(166, 'PY', 'Paraguay', 1, NULL, '0', 0),
(167, 'PE', 'Peru', 1, NULL, '0', 0),
(168, 'PH', 'Philippines', 1, NULL, '0', 0),
(169, 'PN', 'Pitcairn', 1, NULL, '0', 0),
(170, 'PL', 'Poland', 1, NULL, '0', 0),
(171, 'PT', 'Portugal', 1, NULL, '0', 0),
(172, 'PR', 'Puerto Rico', 1, NULL, '0', 0),
(173, 'QA', 'Qatar', 1, NULL, '0', 0),
(174, 'RE', 'Reunion', 1, NULL, '0', 0),
(175, 'RO', 'Romania', 1, NULL, '0', 0),
(176, 'RU', 'Russian Federation', 1, NULL, '0', 0),
(177, 'RW', 'Rwanda', 1, NULL, '0', 0),
(178, 'LC', 'Saint Lucia', 1, NULL, '0', 0),
(179, 'WS', 'Samoa', 1, NULL, '0', 0),
(180, 'SM', 'San Marino', 1, NULL, '0', 0),
(181, 'ST', 'Sao Tome and Principe', 1, NULL, '0', 0),
(182, 'SA', 'Saudi Arabia', 1, NULL, '0', 0),
(183, 'SN', 'Senegal', 1, NULL, '0', 0),
(184, 'RS', 'Serbia', 1, NULL, '0', 0),
(185, 'SC', 'Seychelles', 1, NULL, '0', 0),
(186, 'SL', 'Sierra Leone', 1, NULL, '0', 0),
(187, 'SG', 'Singapore', 1, NULL, '0', 0),
(188, 'SK', 'Slovakia', 1, NULL, '0', 0),
(189, 'SI', 'Slovenia', 1, NULL, '0', 0),
(190, 'SB', 'Solomon Islands', 1, NULL, '0', 0),
(191, 'SO', 'Somalia', 1, NULL, '0', 0),
(192, 'ZA', 'South Africa', 1, NULL, '0', 0),
(193, 'ES', 'Spain', 1, NULL, '0', 0),
(194, 'LK', 'Sri Lanka', 1, NULL, '0', 0),
(195, 'SH', 'St. Helena', 1, NULL, '0', 0),
(196, 'KN', 'St. Kitts and Nevis', 1, NULL, '0', 0),
(197, 'PM', 'St. Pierre and Miquelon', 1, NULL, '0', 0),
(198, 'VC', 'St. Vincent and the Grenadines', 1, NULL, '0', 0),
(199, 'SD', 'Sudan', 1, NULL, '0', 0),
(200, 'SR', 'Suriname', 1, NULL, '0', 0),
(201, 'SJ', 'Svalbard and Jan Mayen Islands', 1, NULL, '0', 0),
(202, 'SZ', 'Swaziland', 1, NULL, '0', 0),
(203, 'SE', 'Sweden', 1, NULL, '0', 0),
(204, 'CH', 'Switzerland', 1, NULL, '0', 0),
(205, 'SY', 'Syrian Arab Republic', 1, NULL, '0', 0),
(206, 'TW', 'Taiwan', 1, NULL, '0', 0),
(207, 'TJ', 'Tajikistan', 1, NULL, '0', 0),
(208, 'TZ', 'Tanzania, United Republic of', 1, NULL, '0', 0),
(209, 'TH', 'Thailand', 1, NULL, '0', 0),
(210, 'TG', 'Togo', 1, NULL, '0', 0),
(211, 'TK', 'Tokelau', 1, NULL, '0', 0),
(212, 'TO', 'Tonga', 1, NULL, '0', 0),
(213, 'TT', 'Trinidad and Tobago', 1, NULL, '0', 0),
(214, 'TN', 'Tunisia', 1, NULL, '0', 0),
(215, 'TR', 'Turkey', 1, NULL, '0', 0),
(216, 'TM', 'Turkmenistan', 1, NULL, '0', 0),
(217, 'TC', 'Turks and Caicos Islands', 1, NULL, '0', 0),
(218, 'TV', 'Tuvalu', 1, NULL, '0', 0),
(219, 'UG', 'Uganda', 1, NULL, '0', 0),
(220, 'UA', 'Ukraine', 1, NULL, '0', 0),
(221, 'AE', 'United Arab Emirates', 1, NULL, '0', 0),
(222, 'GB', 'United Kingdom (GB)', 1, NULL, '23', 999),
(224, 'US', 'United States', 1, NULL, '8', 998),
(225, 'VI', 'United States Virgin Islands', 1, NULL, '0', 0),
(226, 'UY', 'Uruguay', 1, NULL, '0', 0),
(227, 'UZ', 'Uzbekistan', 1, NULL, '0', 0),
(228, 'VU', 'Vanuatu', 1, NULL, '0', 0),
(229, 'VA', 'Vatican City State', 1, NULL, '0', 0),
(230, 'VE', 'Venezuela', 1, NULL, '0', 0),
(231, 'VN', 'Vietnam', 1, NULL, '0', 0),
(232, 'WF', 'Wallis And Futuna Islands', 1, NULL, '0', 0),
(233, 'EH', 'Western Sahara', 1, NULL, '0', 0),
(234, 'YE', 'Yemen', 1, NULL, '0', 0),
(235, 'ZR', 'Zaire', 1, NULL, '0', 0),
(236, 'ZM', 'Zambia', 1, NULL, '0', 0),
(237, 'ZW', 'Zimbabwe', 1, NULL, '0', 0);


--
-- Table structure for table `email_templates`
--

CREATE TABLE IF NOT EXISTS `email_templates` (
  `id` tinyint(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `help` text,
  `body` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `name`, `subject`, `help`, `body`) VALUES
(1, 'Registration Email', 'Please verify your email', 'This template is used to send Registration Verification Email, when Configuration-&gt;Registration Verification is set to YES', '&lt;div style=&quot;color:#000;margin-top:20px;margin-left:auto;margin-right:auto;max-width:800px;background-color:#F4F4F4&quot;&gt;\n  &lt;table style=&quot;font-family: Helvetica Neue,Helvetica,Arial, sans-serif; font-size:13px;background: #F4F4F4; width: 100%; border: 4px solid #bbbbbb;&quot; cellpadding=&quot;10&quot; cellspacing=&quot;5&quot;&gt;\n&lt;tbody&gt;\n&lt;tr&gt;\n&lt;th style=&quot;background-color: rgb(204, 204, 204); font-size:16px;padding:5px;border-bottom-width:2px; border-bottom-color:#fff; border-bottom-style:solid&quot;&gt;\nWelcome [NAME]\n&lt;/th&gt;\n&lt;/tr&gt;\n&lt;tr&gt;\n&lt;td style=&quot;text-align: left;&quot; valign=&quot;top&quot;&gt;\nHello, &lt;br&gt;\n&lt;br&gt;\nYou&#039;re now a member of [SITE_NAME]. \n&lt;br&gt;\nHere are your login details. Please keep them in a safe place:\n&lt;/td&gt;\n&lt;/tr&gt;\n&lt;tr&gt;\n&lt;td style=&quot;text-align: left;&quot; valign=&quot;top&quot;&gt;\n&lt;table style=&quot;font-family: Helvetica Neue,Helvetica,Arial, sans-serif; font-size:13px;&quot; border=&quot;0&quot; width=&quot;100%&quot; cellpadding=&quot;5&quot; cellspacing=&quot;2&quot;&gt;\n&lt;tbody&gt;\n&lt;tr&gt;\n&lt;td style=&quot;border-bottom-width:1px; border-bottom-color:#bbb; border-bottom-style:dashed&quot; align=&quot;right&quot; width=&quot;130&quot;&gt;\n&lt;b&gt;Username:&lt;/b&gt;\n&lt;/td&gt;\n&lt;td style=&quot;border-bottom-width:1px; border-bottom-color:#bbb; border-bottom-style:dashed&quot;&gt;\n[USERNAME]\n&lt;/td&gt;\n&lt;/tr&gt;\n&lt;tr&gt;\n&lt;td style=&quot;border-bottom-width:1px; border-bottom-color:#bbb; border-bottom-style:dashed&quot; align=&quot;right&quot;&gt;\n&lt;b&gt;Password:&lt;/b&gt;\n&lt;/td&gt;\n&lt;td style=&quot;border-bottom-width:1px; border-bottom-color:#bbb; border-bottom-style:dashed&quot;&gt;\n[PASSWORD]\n&lt;/td&gt;\n&lt;/tr&gt;\n&lt;/tbody&gt;\n&lt;/table&gt;\n&lt;/td&gt;\n&lt;/tr&gt;\n&lt;tr&gt;\n&lt;td style=&quot;text-align: left;&quot; valign=&quot;top&quot;&gt;\nThe administrator of this site has requested all new accounts\nto be activated by the users who created them thus your account\nis currently inactive. \n&lt;br&gt;\nTo activate your account,\nplease visit the link below and enter the following:\n&lt;/td&gt;\n&lt;/tr&gt;\n&lt;tr&gt;\n&lt;td style=&quot;text-align: left;&quot; valign=&quot;top&quot;&gt;\n&lt;table border=&quot;0&quot; cellpadding=&quot;4&quot; cellspacing=&quot;2&quot;&gt;\n&lt;tbody&gt;\n&lt;tr&gt;\n&lt;td style=&quot;border-bottom-width:1px; border-bottom-color:#bbb; border-bottom-style:dashed&quot; align=&quot;right&quot; width=&quot;130&quot;&gt;\n&lt;b&gt;Token:&lt;/b&gt;\n&lt;/td&gt;\n&lt;td style=&quot;border-bottom-width:1px; border-bottom-color:#bbb; border-bottom-style:dashed&quot;&gt;\n[TOKEN]\n&lt;/td&gt;\n&lt;/tr&gt;\n&lt;tr&gt;\n&lt;td style=&quot;border-bottom-width:1px; border-bottom-color:#bbb; border-bottom-style:dashed&quot; align=&quot;right&quot;&gt;\n&lt;b&gt;Email:&lt;/b&gt;\n&lt;/td&gt;\n&lt;td style=&quot;border-bottom-width:1px; border-bottom-color:#bbb; border-bottom-style:dashed&quot;&gt;\n[EMAIL]\n&lt;/td&gt;\n&lt;/tr&gt;\n&lt;/tbody&gt;\n&lt;/table&gt;\n&lt;/td&gt;\n&lt;/tr&gt;\n&lt;tr&gt;\n&lt;td style=&quot;text-align: left;&quot; valign=&quot;top&quot;&gt;\n&lt;a href=&quot;[LINK]&quot;&gt;&lt;b&gt;Click here to activate your account&lt;/b&gt;&lt;/a&gt;\n&lt;/td&gt;\n&lt;/tr&gt;\n&lt;tr&gt;\n&lt;td style=&quot;text-align: left; background-color:#fff;border-top-width:2px; border-top-color:#ccc; border-top-style:solid&quot; valign=&quot;top&quot;&gt;\n&lt;i&gt;Thanks,&lt;br&gt;\n[SITE_NAME] Team\n&lt;br&gt;\n&lt;a href=&quot;[URL]&quot;&gt;[URL]&lt;/a&gt;&lt;/i&gt;\n&lt;/td&gt;\n&lt;/tr&gt;\n&lt;/tbody&gt;\n&lt;/table&gt;\n&lt;/div&gt;');


--
-- Table structure for table `faq`
--

CREATE TABLE IF NOT EXISTS `faq` (
  `id` tinyint(3) NOT NULL AUTO_INCREMENT,
  `question` varchar(150) DEFAULT NULL,
  `answer` text,
  `position` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Table structure for table `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `filesize` varchar(80) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


--
-- Table structure for table `leaders`
--

CREATE TABLE `leaders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(150) NOT NULL,
  `other_name` varchar(150) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `gender` int(1) NOT NULL DEFAULT '0',
  `dob` date NOT NULL,
  `party` int(6) NOT NULL DEFAULT '0',
  `office` int(1) NOT NULL DEFAULT '0',
  `constituency` int(6) NOT NULL DEFAULT '0',
  `description` text,
  `file_id` int(5) NOT NULL,
  `thumb` varchar(50) DEFAULT NULL,
  `created` datetime NOT NULL,
  `sittings` int(11) NOT NULL DEFAULT '0',
  `vote_up` int(6) DEFAULT '0',
  `vote_down` int(6) DEFAULT '0',
  `rating` int(11) NOT NULL DEFAULT '0',
  `ratingc` int(6) NOT NULL DEFAULT '0',
  `metakeys` text,
  `metadesc` text,
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `leaders`
--

INSERT INTO `leaders` (`id`, `first_name`, `other_name`, `last_name`, `slug`, `gender`, `dob`, `party`, `office`, `constituency`, `description`, `file_id`, `thumb`, `created`, `sittings`, `vote_up`, `vote_down`, `rating`, `ratingc`, `metakeys`, `metadesc`, `featured`, `active`) VALUES
(1, 'Bu-Buakei', '', 'Jabbi', 'bu-buakeijabbi', 1, '1945-05-07', 1, 1, 8, NULL, 0, 'IMG_6B2648-F01639-D983D4-8C6C2E-5AC485-E42730.jpg', '2017-01-08 12:42:20', 3, 0, 0, 0, 0, 'buakei,jabbi,sierra,leone,people,party,slpp,member,parliament,constituency,kailahun,district,dispute', 'Bu-Buakei Jabbi is a Sierra Leonean lawyer and politician from the Sierra Leone People&#39;s Party (SLPP).&#8230;', 1, 1),
(2, 'Andrew', '', 'Lungay', 'andrewlungay', 1, '1942-05-16', 1, 1, 12, NULL, 0, 'IMG_738DD3-A1F146-0C6FA2-F4E25E-E9B0EA-BB9BB9.jpg', '2017-01-09 06:30:21', 2, 1, 0, 5, 1, 'andrew,lungay,sierra,leone,party,member,election,social,finishers', 'Andrew Victor Lungay is a Sierra Leonean politician from the Sierra Leone People&#39;s Party (SLPP).&#8230;', 0, 1),
(3, 'Bernadette', '', 'Lahai', 'bernadettelahai', 2, '1960-12-30', 1, 1, 13, NULL, 0, 'IMG_731CD3-9A84CB-5575D3-F6E4E4-B6B6DB-D191B7.jpg', '2017-01-09 06:34:48', 2, 1, 0, 0, 0, '', 'Bernadette Lahai', 1, 1),
(4, 'Frank', '', 'Kposowa', 'frankkposowa', 1, '1945-11-25', 1, 1, 71, NULL, 0, 'IMG_BFEEF1-433BEB-D488A1-86E188-8295E1-F447E5.jpg', '2017-01-09 06:41:13', 3, 1, 0, 0, 0, 'sierra,leone', 'Frank Kposowa is a Sierra Leonean politician. He is a member of the Sierra Leone People&#39;s Party&#8230;', 0, 1),
(5, 'Ansumana', 'Jaia', 'Kaikai', 'ansumanajaiakaikai', 1, '0000-00-00', 1, 1, 87, NULL, 0, 'IMG_1A559A-EAC588-EA2035-786825-454F0F-6595EF.jpg', '2017-01-09 06:49:24', 2, 0, 0, 0, 0, '', 'Ansumana Kaikai', 0, 1),
(9, 'Chernor', '', 'Bah', 'chernorbah', 1, '0000-00-00', 2, 1, 110, NULL, 0, 'IMG_1031F0-8EA5B8-B1EF52-67A7EC-E3BE94-BBD98D.jpg', '2017-03-12 12:34:28', 2, 0, 0, 0, 0, '', 'Chernor Bah', 0, 1),
(6, 'Ibrahim', '', 'Kamara', 'ibrahimkamara', 1, '0000-00-00', 2, 1, 105, NULL, 0, 'IMG_8D4A84-4924FF-73063C-4197E1-89DC4B-108538.jpg', '2017-02-17 06:37:16', 3, 0, 0, 0, 0, '', 'Ibrahim Kamara', 0, 1),
(7, 'Ajibola', '', 'Manly Spaine', 'ajibolamanly-spaine', 1, '0000-00-00', 2, 1, 106, NULL, 0, 'IMG_9CF9E4-7E4E98-1698FC-DBC091-34A715-B3EDFE.jpg', '2017-03-12 12:11:17', 2, 0, 0, 0, 0, '', 'Ajibola Manly Spaine', 0, 1),
(8, 'Daniel', '', 'Koroma', 'danielkoroma', 1, '0000-00-00', 2, 1, 46, NULL, 0, 'IMG_AE5FA5-499C2E-7C86C7-1D0F3D-F67A64-FB4067.jpg', '2017-03-12 12:31:56', 2, 0, 0, 0, 0, '', 'Daniel Koroma', 0, 1),
(10, 'Benneh', '', 'Bangura', 'bennehbangura', 1, '0000-00-00', 2, 1, 55, NULL, 0, 'IMG_A8CD00-9367A0-7270B2-7A1AE8-7FCF76-B47733.jpg', '2017-03-12 12:47:16', 2, 0, 0, 0, 0, '', 'Benneh Bangura', 0, 1),
(11, 'Abdu', '', 'Salaam Kanu', 'abdusalaam-kanu', 1, '0000-00-00', 2, 1, 101, NULL, 0, 'IMG_21101F-9D443C-D60994-80D6FD-B23EAE-F74466.jpg', '2017-03-12 12:49:21', 2, 1, 0, 0, 0, '', 'Abdu Salaam Kanu', 1, 1),
(12, 'Alhaji', '', 'Serray Dumbuya', 'alhajiserray-dumbuya', 1, '0000-00-00', 2, 1, 49, NULL, 0, 'IMG_04E8D6-BA0747-A224F7-5A8115-0813F1-B30D82.jpg', '2017-03-12 12:52:00', 2, 0, 0, 0, 0, '', 'Alhaji Serray Dumbuya', 0, 1),
(13, 'Alhassan', '', 'Kamara', 'alhassankamara', 1, '0000-00-00', 2, 1, 96, NULL, 0, 'IMG_E6363F-06B04F-97CCB5-B6DDDB-A1D52B-B24AA7.jpg', '2017-03-12 12:53:59', 2, 0, 0, 0, 0, '', 'Alhassan Kamara', 0, 1),
(14, 'Sallieu', '', 'Osman Sesay', 'sallieu-osman-sesay', 1, '0000-00-00', 2, 1, 29, NULL, 0, 'IMG_6E6EAC-7D18AE-C069C8-708452-00AFE2-BE3D6D.jpg', '2017-03-12 12:56:29', 2, 0, 0, 0, 0, '', 'Sallieu  Osman Sesay', 0, 1),
(15, 'Mustapha', '', 'Brima', 'mustaphabrima', 1, '0000-00-00', 1, 1, 2, NULL, 0, 'IMG_D7D5BA-B724E7-AE8B27-F1897A-E4CE9E-C6F681.jpg', '2017-03-12 12:59:40', 2, 0, 0, 0, 0, '', 'Mustapha Brima', 0, 1),
(16, 'Segepoh', '', 'Solomon Thomas', 'segepoh-solomon-thomas', 1, '0000-00-00', 1, 1, 78, NULL, 0, 'IMG_DA1F62-3B9E79-66A18B-9F8577-A894E0-8B32D3.jpg', '2017-03-12 13:02:20', 2, 0, 0, 0, 0, '', 'Segepoh  Solomon Thomas', 0, 1),
(17, 'Dickson', '', 'Rogers', 'dicksonrogers', 1, '0000-00-00', 1, 1, 89, NULL, 0, 'IMG_FB94E4-2FDACB-A356DD-7B3DCA-F7CB08-3A1EA3.jpg', '2017-03-12 13:04:32', 2, 0, 0, 0, 0, '', 'Dickson Rogers', 0, 1),
(18, 'Emma', '', 'Kowa', 'emmakowa', 2, '0000-00-00', 1, 1, 76, NULL, 0, 'IMG_58B112-7651B2-D324B6-8F1D80-B9AEF0-0349BF.jpg', '2017-03-12 13:06:16', 2, 0, 0, 3, 1, '', 'Emma Kowa', 1, 1),
(19, 'Samuel', '', 'Brima', 'samuelbrima', 1, '0000-00-00', 1, 1, 16, NULL, 0, 'IMG_F731ED-1F7DF4-D80A69-5818CC-21CBE6-54F18B.jpg', '2017-03-12 13:08:12', 3, 0, 0, 0, 0, '', 'Samuel Brima', 0, 1),
(20, 'Prince Lappia', '', 'Boima IV', 'prince-lappiaboima-iv', 1, '0000-00-00', 0, 2, 113, NULL, 0, 'IMG_3BDBF0-A91F51-84AF75-239853-FBD0F9-F6374E.jpg', '2017-03-12 13:23:31', 2, 0, 0, 0, 0, '', 'Prince Lappia Boima IV', 0, 1),
(21, 'James', '', 'N. Alie', 'jamesn-alie', 1, '0000-00-00', 1, 1, 81, NULL, 0, 'IMG_750409-D2087A-7522F8-F8B804-85DAA4-8A63BF.jpg', '2017-03-19 07:44:04', 0, 0, 0, 0, 0, '', 'James N. Alie', 0, 1),
(22, 'Mima', '', 'Sobba-Stephens', 'mimasobba-stephens', 2, '0000-00-00', 1, 1, 84, NULL, 0, 'IMG_5AAD0D-5DC532-6BF31C-B484D9-55D3CD-633A86.jpg', '2017-03-19 07:48:30', 0, 0, 0, 0, 0, '', 'Mima Sobba-Stephens', 0, 1),
(23, 'Moiwa', '', 'Momoh', 'moiwamomoh', 1, '0000-00-00', 1, 1, 6, NULL, 0, 'IMG_85419F-908148-3BDA72-0B77F6-E9B9AA-0E1212.jpg', '2017-03-19 07:50:39', 0, 0, 0, 0, 0, '', 'Moiwa Momoh', 0, 1),
(24, 'Patrick', '', 'Lahai Kargbo', 'patricklahai-kargbo', 1, '0000-00-00', 2, 1, 39, NULL, 0, 'IMG_B29B59-08E5F7-43325E-F253CF-80604A-F9A8D7.jpg', '2017-03-19 07:53:12', 0, 0, 0, 0, 0, '', 'Patrick Lahai Kargbo', 0, 1),
(25, 'Ibrahim', '', 'Nox Sankoh', 'ibrahimnox-sankoh', 1, '0000-00-00', 2, 1, 97, NULL, 0, 'IMG_E938D2-E36348-2FCFD9-68C1F2-33BD37-39676B.jpg', '2017-03-19 07:55:04', 0, 0, 0, 0, 0, '', 'Ibrahim Nox Sankoh', 0, 1),
(26, 'Leonard', '', 'Fofanah', 'leonardfofanah', 1, '0000-00-00', 2, 1, 15, NULL, 0, 'IMG_817201-38485B-981BE4-4C912D-DFEB9B-C8EE8E.jpg', '2017-03-19 07:56:44', 0, 0, 0, 0, 0, '', 'Leonard Fofanah', 0, 1),
(27, 'Songowa', '', 'Bundu', 'songowabundu', 2, '0000-00-00', 2, 1, 61, NULL, 0, 'IMG_48557E-C3E373-85D4DC-2402D1-1C5F65-03A679.jpg', '2017-03-19 07:58:27', 0, 0, 0, 0, 0, '', 'Songowa Bundu', 1, 1),
(28, 'Albert', '', 'Deen Kamara', 'albertdeen-kamara', 1, '0000-00-00', 2, 1, 34, NULL, 0, 'IMG_8B3AF6-157D9A-9C760C-A57EEB-9FCE11-2E295A.jpg', '2017-03-19 07:59:47', 0, 0, 0, 0, 0, '', 'Albert Deen Kamara', 0, 1),
(29, 'Aiah', '', 'Dabundeh', 'aiahdabundeh', 1, '0000-00-00', 2, 1, 20, NULL, 0, 'IMG_7ACFB0-109C32-51A71A-FD3DD4-261F14-C8635F.jpg', '2017-03-19 08:02:41', 0, 0, 0, 0, 0, '', 'Aiah Dabundeh', 0, 1),
(30, 'Ibrahim', '', 'Ben Kargbo', 'ibrahimben-kargbo', 1, '0000-00-00', 2, 1, 30, NULL, 0, 'IMG_0D2A92-262314-CA34EE-6684EB-4545FA-5A957B.jpg', '2017-03-19 08:10:25', 0, 0, 0, 0, 0, '', 'Ibrahim Ben Kargbo', 0, 1),
(31, 'Suliaman', '', 'Muluku', 'suliamanmuluku', 1, '0000-00-00', 2, 1, 33, NULL, 0, 'IMG_0B89D2-53992E-88FAC6-0E7BD8-E30A68-911AFE.jpg', '2017-03-19 08:13:17', 0, 0, 0, 0, 0, '', 'Suliaman Muluku', 0, 1),
(32, 'Alex', '', 'M. J. Kainpumu', 'alexm-j-kainpumu', 1, '0000-00-00', 0, 2, 117, NULL, 0, 'IMG_BF6A40-CF8D86-D076D5-F68262-B32B83-12FE53.jpg', '2017-03-19 08:15:20', 0, 0, 0, 0, 0, '', 'Alex M. J. Kainpumu', 0, 1);



--
-- Table structure for table `menus`
--

CREATE TABLE IF NOT EXISTS `menus` (
  `id` tinyint(2) NOT NULL AUTO_INCREMENT,
  `page_id` tinyint(2) NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL,
  `content_type` varchar(20) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `target` enum('_self','_blank') NOT NULL DEFAULT '_blank',
  `position` tinyint(2) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `content_id` (`active`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` tinyint(2) NOT NULL AUTO_INCREMENT,
  `title` varchar(55) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `body` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `author` varchar(55) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `created` date NOT NULL DEFAULT '0000-00-00',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `body` longtext,
  `created` datetime NOT NULL,
  `contact` tinyint(1) NOT NULL DEFAULT '0',
  `faq` tinyint(1) NOT NULL DEFAULT '0',
  `home_page` tinyint(1) NOT NULL DEFAULT '0',
  `active` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Table structure for table `parties`
--

CREATE TABLE `parties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(120) DEFAULT NULL,
  `abbr` varchar(11) DEFAULT NULL,
  `slug` varchar(120) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `parties`
--

INSERT INTO `parties` (`id`, `name`, `abbr`, `slug`, `created`) VALUES
(1, 'Sierra Leone People&#039;s Party', 'SLPP', NULL, '2017-01-08 11:27:16'),
(2, 'All Peoples Congress', 'APC', NULL, '2017-01-08 11:35:32'),
(3, 'Grand Alliance Party', 'GAP', NULL, '2017-01-08 11:38:41'),
(4, 'Peace and Liberation Party', 'PLP', NULL, '2017-01-08 11:39:11'),
(5, 'People&#039;s Democratic Party', 'PDP', NULL, '2017-01-08 11:39:39'),
(6, 'People&#039;s Movement for Democratic Change', 'PMDC', NULL, '2017-01-08 11:40:04'),
(7, 'Revolutionary United Front', 'RUF', NULL, '2017-01-08 11:40:20'),
(8, 'United National People&#039;s Party', 'UNPP', NULL, '2017-01-08 11:40:36'),
(9, 'Young People&#039;s Party', 'YPP', NULL, '2017-01-08 11:40:53'),
(10, 'National Alliance Democratic Party', 'NADP', NULL, '2017-01-08 11:41:09'),
(11, 'Unity for National Development', 'UND', NULL, '2017-01-08 11:41:29');


--
-- Table structure for table `recent`
--

CREATE TABLE IF NOT EXISTS `recent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lid` int(11) NOT NULL DEFAULT '0',
  `user_id` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `site_name` varchar(100) NOT NULL,
  `company` varchar(100) NOT NULL,
  `site_url` varchar(150) NOT NULL,
  `site_dir` varchar(60) DEFAULT NULL,
  `site_email` varchar(50) NOT NULL,
  `seo` tinyint(1) NOT NULL DEFAULT '0',
  `perpage` tinyint(4) NOT NULL DEFAULT '10',
  `backup` varchar(25) NOT NULL,
  `thumb_w` varchar(3) NOT NULL,
  `thumb_h` varchar(3) NOT NULL,
  `img_w` varchar(5) NOT NULL,
  `img_h` varchar(5) NOT NULL,
  `show_home` tinyint(1) NOT NULL DEFAULT '1',
  `show_slider` tinyint(1) NOT NULL DEFAULT '1',
  `file_dir` varchar(200) DEFAULT NULL,
  `short_date` varchar(50) NOT NULL,
  `long_date` varchar(50) NOT NULL,
  `time_format` varchar(20) DEFAULT NULL,
  `dtz` varchar(120) DEFAULT NULL,
  `locale` varchar(120) DEFAULT NULL,
  `featured` tinyint(2) NOT NULL DEFAULT '10',
  `popular` tinyint(2) NOT NULL DEFAULT '6',
  `hlayout` tinyint(4) NOT NULL DEFAULT '0',
  `homelist` tinyint(1) NOT NULL DEFAULT '4',
  `free_allowed` tinyint(1) NOT NULL DEFAULT '0',
  `logo` varchar(100) DEFAULT NULL,
  `theme` varchar(30) DEFAULT NULL,
  `psize` varchar(10) DEFAULT NULL,
  `bills_description` text,
  `committees_description` text,
  `meetings_description` text,
  `lang` varchar(10) DEFAULT NULL,
  `currency` varchar(8) DEFAULT NULL,
  `cur_symbol` varchar(6) DEFAULT NULL,
  `reg_verify` tinyint(1) NOT NULL DEFAULT '1',
  `auto_verify` tinyint(1) NOT NULL DEFAULT '1',
  `reg_allowed` tinyint(1) NOT NULL DEFAULT '1',
  `user_limit` int(6) NOT NULL DEFAULT '0',
  `notify_admin` tinyint(1) NOT NULL DEFAULT '0',
  `offline` tinyint(1) NOT NULL DEFAULT '0',
  `offline_msg` text,
  `offline_d` date DEFAULT NULL,
  `offline_t` time DEFAULT NULL,
  `metakeys` text,
  `metadesc` text,
  `analytics` text,
  `mailer` enum('PHP','SMTP','SMAIL') DEFAULT NULL,
  `smtp_host` varchar(150) DEFAULT NULL,
  `smtp_user` varchar(50) DEFAULT NULL,
  `smtp_pass` varchar(50) DEFAULT NULL,
  `smtp_port` smallint(3) DEFAULT NULL,
  `is_ssl` tinyint(1) NOT NULL DEFAULT '0',
  `sendmail` varchar(100) DEFAULT NULL,
  `version` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`site_name`, `company`, `site_url`, `site_dir`, `site_email`, `seo`, `perpage`, `backup`, `thumb_w`, `thumb_h`, `img_w`, `img_h`, `show_home`, `show_slider`, `file_dir`, `short_date`, `long_date`, `time_format`, `dtz`, `locale`, `featured`, `popular`, `hlayout`, `homelist`, `free_allowed`, `logo`, `theme`, `psize`, `bills_description`, `committees_description`, `meetings_description`, `lang`, `currency`, `cur_symbol`, `reg_verify`, `auto_verify`, `reg_allowed`, `user_limit`, `notify_admin`, `offline`, `offline_msg`, `offline_d`, `offline_t`, `metakeys`, `metadesc`, `analytics`, `mailer`, `smtp_host`, `smtp_user`, `smtp_pass`, `smtp_port`, `is_ssl`, `sendmail`, `version`) VALUES
('Memba-O!', 'Memba-O!', '', '', '', 1, 12, '', '300', '350', '0', '0', 1, 1, 'uploads', '%d %b %Y', '%B %d, %Y %I:%M %p', '%I:%M %p', 'Africa/Freetown', 'en_us_utf8,English (US)', 12, 6, 1, 4, 0, 'logo.png', 'camembao', '', '&lt;p&gt;A Bill is a proposal for a new law, or a proposal to change an existing law that is presented for debate before Parliament.&lt;/p&gt;&lt;p&gt;Bills are introduced in Parliament as Public Bills by either sitting MPs (Private Member&#039;s Bill) or representatives of Government (Government Bill) for examination, discussion and amendment.&lt;/p&gt;', '&lt;p&gt;The Parliamentary Committees are empowered by Section 93 (3) of the 1991 Constitution of Sierra Leone to investigate or inquire into the activities or administration of such Government Ministries or Departments and Agencies (MDAs) as may be assigned to them, &quot;and such investigation or inquiry may extend to proposals for legislation.&quot;&amp;nbsp;&lt;/p&gt;&lt;p&gt;More specifically,&amp;nbsp;they can&amp;nbsp;review/scrutinize.&lt;/p&gt;&lt;ol&gt;&lt;li&gt;The laws governing the administration and general operations of the &amp;nbsp;MDAs assign to them.&lt;/li&gt;&lt;li&gt;The programmes, policy objectives of the MDAs, legislation, and the effectiveness of their implementation.&lt;/li&gt;&lt;li&gt;The immediate, medium and long term expenditure plans of the MDA and &amp;nbsp;the effectiveness of the budget execution thereof&lt;/li&gt;&lt;li&gt;Analyze the relative success of the MDAs in meeting their objectives.&lt;/li&gt;&lt;li&gt;Exercise general oversight of the executive activities etc.&lt;/li&gt;&lt;/ol&gt;', '&lt;p&gt;Parliament&amp;nbsp;Committees in their line of work usually&amp;nbsp;invite selected people or groups to appear before the committee to provide further evidence or answer questions from committee members in a bid to make informed recommendations to Parliament.&lt;/p&gt;&lt;p&gt;The media often attend and report on proceedings.&amp;nbsp;After&amp;nbsp;the public hearings are finished, the committee writes a report which is formally presented to the Parliament. Members of parliament often use evidence from a committee report to propose bills or amendments to existing laws. Sometimes these meetings are held in-camera, due to the sensitivity of the issues being discussed.&lt;/p&gt;', 'en', '', '', 1, 1, 1, 0, 1, 0, '&lt;p&gt;&lt;/p&gt;', '0000-00-00', '00:00:00', 'sierra-leone, parliament, membao, mps, code4africa', 'Memba-O! aims to act as a parliamentary watchdog, enabling citizens to track what is going on in Parliament.', '', 'PHP', 'mail.hostname.com', 'yourusername', 'yourpass', 127, 0, '', '3.10');

--
-- Table structure for table `sitting_attendance`
--

CREATE TABLE `sitting_attendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sitting_id` int(11) NOT NULL DEFAULT '0',
  `leader_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sitting_attendance`
--

INSERT INTO `sitting_attendance` (`id`, `sitting_id`, `leader_id`) VALUES
(13, 1, 1),
(50, 2, 1),
(32, 3, 1),
(19, 1, 19),
(20, 1, 4),
(21, 1, 6),
(22, 1, 15),
(23, 1, 20),
(24, 3, 11),
(25, 3, 7),
(26, 3, 12),
(27, 3, 13),
(28, 3, 2),
(29, 3, 5),
(30, 3, 10),
(31, 3, 3),
(33, 3, 9),
(34, 3, 8),
(35, 3, 17),
(36, 3, 18),
(37, 3, 4),
(38, 3, 6),
(39, 3, 14),
(40, 3, 19),
(41, 3, 16),
(42, 2, 11),
(43, 2, 7),
(44, 2, 12),
(45, 2, 13),
(46, 2, 2),
(47, 2, 5),
(48, 2, 10),
(49, 2, 3),
(51, 2, 9),
(52, 2, 8),
(53, 2, 17),
(54, 2, 18),
(55, 2, 4),
(56, 2, 6),
(57, 2, 15),
(58, 2, 20),
(59, 2, 14),
(60, 2, 19),
(61, 2, 16);

-- --------------------------------------------------------

--
-- Table structure for table `sitting_calendar`
--

CREATE TABLE `sitting_calendar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year` int(4) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL,
  `sitting_type` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sitting_calendar`
--

INSERT INTO `sitting_calendar` (`id`, `year`, `date`, `sitting_type`) VALUES
(1, 2017, '2017-01-04 00:00:00', 1),
(2, 2017, '2017-01-05 00:00:00', 1),
(3, 2017, '2017-01-06 00:00:00', 1);

--
-- Table structure for table `stats`
--

CREATE TABLE IF NOT EXISTS `stats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `day` date NOT NULL DEFAULT '0000-00-00',
  `lid` int(11) NOT NULL DEFAULT '0',
  `hits` int(11) NOT NULL DEFAULT '0',
  `uhits` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(80) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `newsletter` tinyint(1) NOT NULL DEFAULT '0',
  `cookie_id` varchar(50) NOT NULL DEFAULT '0',
  `token` varchar(50) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT '0000-00-00 00:00:00',
  `avatar` varchar(50) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `zip` varchar(20) DEFAULT NULL,
  `country` varchar(4) DEFAULT NULL,
  `notes` text,
  `info` text,
  `lastlogin` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lastip` varchar(16) DEFAULT NULL,
  `userlevel` tinyint(1) NOT NULL DEFAULT '1',
  `active` enum('y','n','t','b') NOT NULL DEFAULT 'n'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
