-- ================================================================
--
-- @version $Id: structure.sql 2017-06-01 12:12:05 gewa $
-- @package CMS Pro
-- @copyright 2019. wojoscripts.com
--
-- ================================================================
-- Database Content
-- ================================================================
--
-- Table structure for table `activity`
--

DROP TABLE IF EXISTS `activity`;
CREATE TABLE IF NOT EXISTS `activity` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0',
  `username` varchar(80) DEFAULT NULL,
  `ip` varbinary(16) DEFAULT NULL,
  `failed` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `failed_last` int(11) unsigned NOT NULL DEFAULT '0',
  `type` varchar(20) DEFAULT NULL,
  `message` varchar(150) DEFAULT NULL,
  `importance` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 yes, 0 =no',
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table structure for table `banlist`
--

DROP TABLE IF EXISTS `banlist`;
CREATE TABLE IF NOT EXISTS `banlist` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `item` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('IP','Email') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'IP',
  `comment` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ban_ip` (`item`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `uid` int(11) unsigned NOT NULL DEFAULT '0',
  `mid` int(11) unsigned NOT NULL DEFAULT '0',
  `cid` int(11) unsigned NOT NULL DEFAULT '0',
  `tax` decimal(13,2) unsigned NOT NULL DEFAULT '0.00',
  `totaltax` decimal(13,2) unsigned NOT NULL DEFAULT '0.00',
  `coupon` decimal(13,2) unsigned NOT NULL DEFAULT '0.00',
  `total` decimal(13,2) unsigned NOT NULL DEFAULT '0.00',
  `originalprice` decimal(13,2) unsigned NOT NULL DEFAULT '0.00',
  `totalprice` decimal(13,2) unsigned NOT NULL DEFAULT '0.00',
  `cart_id` varchar(100) DEFAULT NULL,
  `order_id` varchar(100) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`uid`),
  KEY `idx_user` (`uid`),
  KEY `idx_membership` (`mid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
CREATE TABLE IF NOT EXISTS `countries` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `abbr` varchar(2) NOT NULL,
  `name` varchar(70) NOT NULL,
  `active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `home` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `vat` decimal(13,2) unsigned NOT NULL DEFAULT '0.00',
  `sorting` smallint(6) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `abbrv` (`abbr`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` VALUES(1, 'AF', 'Afghanistan', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(2, 'AL', 'Albania', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(3, 'DZ', 'Algeria', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(4, 'AS', 'American Samoa', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(5, 'AD', 'Andorra', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(6, 'AO', 'Angola', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(7, 'AI', 'Anguilla', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(8, 'AQ', 'Antarctica', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(9, 'AG', 'Antigua and Barbuda', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(10, 'AR', 'Argentina', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(11, 'AM', 'Armenia', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(12, 'AW', 'Aruba', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(13, 'AU', 'Australia', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(14, 'AT', 'Austria', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(15, 'AZ', 'Azerbaijan', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(16, 'BS', 'Bahamas', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(17, 'BH', 'Bahrain', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(18, 'BD', 'Bangladesh', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(19, 'BB', 'Barbados', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(20, 'BY', 'Belarus', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(21, 'BE', 'Belgium', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(22, 'BZ', 'Belize', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(23, 'BJ', 'Benin', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(24, 'BM', 'Bermuda', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(25, 'BT', 'Bhutan', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(26, 'BO', 'Bolivia', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(27, 'BA', 'Bosnia and Herzegowina', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(28, 'BW', 'Botswana', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(29, 'BV', 'Bouvet Island', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(30, 'BR', 'Brazil', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(31, 'IO', 'British Indian Ocean Territory', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(32, 'VG', 'British Virgin Islands', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(33, 'BN', 'Brunei Darussalam', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(34, 'BG', 'Bulgaria', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(35, 'BF', 'Burkina Faso', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(36, 'BI', 'Burundi', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(37, 'KH', 'Cambodia', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(38, 'CM', 'Cameroon', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(39, 'CA', 'Canada', 1, 1, '13.00', 1000);
INSERT INTO `countries` VALUES(40, 'CV', 'Cape Verde', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(41, 'KY', 'Cayman Islands', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(42, 'CF', 'Central African Republic', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(43, 'TD', 'Chad', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(44, 'CL', 'Chile', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(45, 'CN', 'China', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(46, 'CX', 'Christmas Island', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(47, 'CC', 'Cocos (Keeling) Islands', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(48, 'CO', 'Colombia', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(49, 'KM', 'Comoros', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(50, 'CG', 'Congo', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(51, 'CK', 'Cook Islands', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(52, 'CR', 'Costa Rica', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(53, 'CI', 'Cote D''ivoire', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(54, 'HR', 'Croatia', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(55, 'CU', 'Cuba', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(56, 'CY', 'Cyprus', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(57, 'CZ', 'Czech Republic', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(58, 'DK', 'Denmark', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(59, 'DJ', 'Djibouti', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(60, 'DM', 'Dominica', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(61, 'DO', 'Dominican Republic', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(62, 'TP', 'East Timor', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(63, 'EC', 'Ecuador', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(64, 'EG', 'Egypt', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(65, 'SV', 'El Salvador', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(66, 'GQ', 'Equatorial Guinea', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(67, 'ER', 'Eritrea', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(68, 'EE', 'Estonia', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(69, 'ET', 'Ethiopia', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(70, 'FK', 'Falkland Islands (Malvinas)', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(71, 'FO', 'Faroe Islands', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(72, 'FJ', 'Fiji', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(73, 'FI', 'Finland', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(74, 'FR', 'France', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(75, 'GF', 'French Guiana', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(76, 'PF', 'French Polynesia', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(77, 'TF', 'French Southern Territories', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(78, 'GA', 'Gabon', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(79, 'GM', 'Gambia', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(80, 'GE', 'Georgia', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(81, 'DE', 'Germany', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(82, 'GH', 'Ghana', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(83, 'GI', 'Gibraltar', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(84, 'GR', 'Greece', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(85, 'GL', 'Greenland', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(86, 'GD', 'Grenada', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(87, 'GP', 'Guadeloupe', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(88, 'GU', 'Guam', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(89, 'GT', 'Guatemala', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(90, 'GN', 'Guinea', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(91, 'GW', 'Guinea-Bissau', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(92, 'GY', 'Guyana', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(93, 'HT', 'Haiti', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(94, 'HM', 'Heard and McDonald Islands', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(95, 'HN', 'Honduras', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(96, 'HK', 'Hong Kong', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(97, 'HU', 'Hungary', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(98, 'IS', 'Iceland', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(99, 'IN', 'India', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(100, 'ID', 'Indonesia', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(101, 'IQ', 'Iraq', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(102, 'IE', 'Ireland', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(103, 'IR', 'Islamic Republic of Iran', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(104, 'IL', 'Israel', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(105, 'IT', 'Italy', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(106, 'JM', 'Jamaica', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(107, 'JP', 'Japan', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(108, 'JO', 'Jordan', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(109, 'KZ', 'Kazakhstan', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(110, 'KE', 'Kenya', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(111, 'KI', 'Kiribati', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(112, 'KP', 'Korea, Dem. Peoples Rep of', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(113, 'KR', 'Korea, Republic of', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(114, 'KW', 'Kuwait', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(115, 'KG', 'Kyrgyzstan', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(116, 'LA', 'Laos', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(117, 'LV', 'Latvia', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(118, 'LB', 'Lebanon', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(119, 'LS', 'Lesotho', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(120, 'LR', 'Liberia', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(121, 'LY', 'Libyan Arab Jamahiriya', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(122, 'LI', 'Liechtenstein', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(123, 'LT', 'Lithuania', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(124, 'LU', 'Luxembourg', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(125, 'MO', 'Macau', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(126, 'MK', 'Macedonia', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(127, 'MG', 'Madagascar', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(128, 'MW', 'Malawi', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(129, 'MY', 'Malaysia', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(130, 'MV', 'Maldives', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(131, 'ML', 'Mali', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(132, 'MT', 'Malta', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(133, 'MH', 'Marshall Islands', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(134, 'MQ', 'Martinique', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(135, 'MR', 'Mauritania', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(136, 'MU', 'Mauritius', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(137, 'YT', 'Mayotte', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(138, 'MX', 'Mexico', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(139, 'FM', 'Micronesia', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(140, 'MD', 'Moldova, Republic of', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(141, 'MC', 'Monaco', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(142, 'MN', 'Mongolia', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(143, 'MS', 'Montserrat', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(144, 'MA', 'Morocco', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(145, 'MZ', 'Mozambique', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(146, 'MM', 'Myanmar', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(147, 'NA', 'Namibia', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(148, 'NR', 'Nauru', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(149, 'NP', 'Nepal', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(150, 'NL', 'Netherlands', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(151, 'AN', 'Netherlands Antilles', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(152, 'NC', 'New Caledonia', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(153, 'NZ', 'New Zealand', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(154, 'NI', 'Nicaragua', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(155, 'NE', 'Niger', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(156, 'NG', 'Nigeria', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(157, 'NU', 'Niue', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(158, 'NF', 'Norfolk Island', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(159, 'MP', 'Northern Mariana Islands', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(160, 'NO', 'Norway', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(161, 'OM', 'Oman', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(162, 'PK', 'Pakistan', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(163, 'PW', 'Palau', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(164, 'PA', 'Panama', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(165, 'PG', 'Papua New Guinea', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(166, 'PY', 'Paraguay', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(167, 'PE', 'Peru', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(168, 'PH', 'Philippines', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(169, 'PN', 'Pitcairn', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(170, 'PL', 'Poland', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(171, 'PT', 'Portugal', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(172, 'PR', 'Puerto Rico', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(173, 'QA', 'Qatar', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(174, 'RE', 'Reunion', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(175, 'RO', 'Romania', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(176, 'RU', 'Russian Federation', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(177, 'RW', 'Rwanda', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(178, 'LC', 'Saint Lucia', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(179, 'WS', 'Samoa', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(180, 'SM', 'San Marino', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(181, 'ST', 'Sao Tome and Principe', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(182, 'SA', 'Saudi Arabia', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(183, 'SN', 'Senegal', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(184, 'RS', 'Serbia', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(185, 'SC', 'Seychelles', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(186, 'SL', 'Sierra Leone', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(187, 'SG', 'Singapore', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(188, 'SK', 'Slovakia', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(189, 'SI', 'Slovenia', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(190, 'SB', 'Solomon Islands', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(191, 'SO', 'Somalia', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(192, 'ZA', 'South Africa', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(193, 'ES', 'Spain', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(194, 'LK', 'Sri Lanka', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(195, 'SH', 'St. Helena', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(196, 'KN', 'St. Kitts and Nevis', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(197, 'PM', 'St. Pierre and Miquelon', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(198, 'VC', 'St. Vincent and the Grenadines', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(199, 'SD', 'Sudan', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(200, 'SR', 'Suriname', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(201, 'SJ', 'Svalbard and Jan Mayen Islands', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(202, 'SZ', 'Swaziland', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(203, 'SE', 'Sweden', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(204, 'CH', 'Switzerland', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(205, 'SY', 'Syrian Arab Republic', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(206, 'TW', 'Taiwan', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(207, 'TJ', 'Tajikistan', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(208, 'TZ', 'Tanzania, United Republic of', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(209, 'TH', 'Thailand', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(210, 'TG', 'Togo', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(211, 'TK', 'Tokelau', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(212, 'TO', 'Tonga', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(213, 'TT', 'Trinidad and Tobago', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(214, 'TN', 'Tunisia', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(215, 'TR', 'Turkey', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(216, 'TM', 'Turkmenistan', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(217, 'TC', 'Turks and Caicos Islands', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(218, 'TV', 'Tuvalu', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(219, 'UG', 'Uganda', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(220, 'UA', 'Ukraine', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(221, 'AE', 'United Arab Emirates', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(222, 'GB', 'United Kingdom (GB)', 1, 0, '23.00', 999);
INSERT INTO `countries` VALUES(224, 'US', 'United States', 1, 0, '7.50', 998);
INSERT INTO `countries` VALUES(225, 'VI', 'United States Virgin Islands', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(226, 'UY', 'Uruguay', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(227, 'UZ', 'Uzbekistan', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(228, 'VU', 'Vanuatu', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(229, 'VA', 'Vatican City State', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(230, 'VE', 'Venezuela', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(231, 'VN', 'Vietnam', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(232, 'WF', 'Wallis And Futuna Islands', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(233, 'EH', 'Western Sahara', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(234, 'YE', 'Yemen', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(235, 'ZR', 'Zaire', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(236, 'ZM', 'Zambia', 1, 0, '0.00', 0);
INSERT INTO `countries` VALUES(237, 'ZW', 'Zimbabwe', 1, 0, '0.00', 0);

--
-- Table structure for table `cronjobs`
--

CREATE TABLE `cronjobs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0',
  `membership_id` int(11) unsigned NOT NULL DEFAULT '0',
  `stripe_customer` varchar(60) NOT NULL,
  `stripe_pm` varchar(80) NOT NULL,
  `amount` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `renewal` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_user_id` (`user_id`),
  KEY `idx_membership_id` (`membership_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table structure for table `coupons`
--
DROP TABLE IF EXISTS `coupons`;
CREATE TABLE IF NOT EXISTS `coupons` (
  `id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `code` varchar(30) NOT NULL,
  `discount` smallint(2) unsigned NOT NULL DEFAULT '0',
  `type` enum('p','a') NOT NULL DEFAULT 'p',
  `membership_id` varchar(50) NOT NULL DEFAULT '0',
  `ctype` varchar(30) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table structure for table `custom_fields`
--

DROP TABLE IF EXISTS `custom_fields`;
CREATE TABLE IF NOT EXISTS `custom_fields` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `title_en` varchar(60) NOT NULL,
  `tooltip_en` varchar(100) DEFAULT NULL,
  `name` varchar(20) NOT NULL,
  `required` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `section` varchar(30) DEFAULT NULL,
  `sorting` int(4) unsigned NOT NULL DEFAULT '0',
  `active` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table structure for table `custom_fields_data`
--

DROP TABLE IF EXISTS `custom_fields_data`;
CREATE TABLE IF NOT EXISTS `custom_fields_data` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0',
  `field_id` int(11) unsigned NOT NULL DEFAULT '0',
  `digishop_id` int(11) unsigned NOT NULL DEFAULT '0',
  `portfolio_id` int(11) unsigned NOT NULL DEFAULT '0',
  `shop_id` int(11) unsigned NOT NULL DEFAULT '0',
  `field_name` varchar(40) DEFAULT NULL,
  `field_value` varchar(100) DEFAULT NULL,
  `section` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_user` (`user_id`),
  KEY `idx_field` (`field_id`),
  KEY `idx_digishop` (`digishop_id`),
  KEY `idx_portfolio` (`portfolio_id`),
  KEY `idx_shop` (`shop_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table structure for table `email_templates`
--

DROP TABLE IF EXISTS `email_templates`;
CREATE TABLE IF NOT EXISTS `email_templates` (
  `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name_en` varchar(100) NOT NULL,
  `subject_en` varchar(150) NOT NULL,
  `help_en` tinytext,
  `body_en` text NOT NULL,
  `type` enum('news','mailer') DEFAULT 'mailer',
  `typeid` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `name_en`, `subject_en`, `help_en`, `body_en`, `type`, `typeid`) VALUES(1, 'Registration Email', 'Please verify your email', 'This template is used to send Registration Verification Email, when Configuration->Registration Verification is set to YES', '<div style=\"background-color:#F2F2F2;margin:0 auto;padding:60px;font-family: Helvetica, Arial, sans-serif; font-size: 16px; color: #404040\"> [LOGO]\r\n  <div style=\"border-radius: 6px 6px 6px 6px;box-shadow: 0 1px 2px 0 #DFDFDF;\">\r\n    <div style=\"background-color:#35B8E8;text-align:center;margin-top:32px;border-radius: 6px 6px 0 0;\"><img src=\"[SITEURL]/assets/images/header.png\" alt=\"header\"></div>\r\n    <div style=\"background-color:#ffffff;padding:48px;text-align:center;border-radius: 0 0 6px 6px;\">\r\n<h1 style=\"font-weight:100;margin-bottom:32px\">Welcome to [COMPANY]</h1>\r\n<h4 style=\"font-weight:600;margin-bottom:16px\">Congratulations</h4>\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\"> You are now registered member.</p>\r\n<p style=\"padding:30px 0px 0px 0px;color:#7B7B7B\"> The administrator of this site has requested all new accounts to be activated by the users who created them thus your account is currently inactive. To activate your account, please visit the link below. </p>\r\n<p style=\"margin:0;padding:5px;color:#7B7B7B\"> Here are your login details. Please keep them in a safe place: </p>\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>Username:</strong> [USERNAME] <br>\r\n<strong>Password:</strong> [PASSWORD]</p>\r\n<div style=\"padding:30px 0px 0px 0px\">\r\n<a target=\"_blank\" href=\"[LINK]\" style=\"text-decoration: none;border-radius: 6px 6px 6px 6px;display:inline-block;background-color:#4CAF50;padding:14px 30px 14px 30px;color:#ffffff;font-weight:500;font-size:18px\">Activate your account</a>\r\n</div>\r\n    </div>\r\n  </div>\r\n  <div style=\"padding:48px;text-align:center\">\r\n    <p style=\"margin-bottom:32px;font-size:20px;color:##272822\"><em>Stay in touch</em></p>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[FB]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/twitter.png\" alt=\"\"></a>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[TW]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/facebook.png\" alt=\"\"></a>\r\n    <a href=\"mailto:[CEMAIL]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/email.png\" alt=\"\"></a>\r\n    <div style=\"font-size:12px;color:#6E6E6E;margin-top:24px\">\r\n<p style=\"margin:0;padding:4px\"> This email is sent to you directly from [COMPANY]</p>\r\n<p style=\"margin:0\"> The information above is gathered from the user input. ©[DATE] <a href=\"[SITEURL]\">[COMPANY]</a>\r\n. All rights reserved.</p>\r\n    </div>\r\n  </div>\r\n</div>', 'mailer', 'regMail');
INSERT INTO `email_templates` (`id`, `name_en`, `subject_en`, `help_en`, `body_en`, `type`, `typeid`) VALUES(2, 'Forgot Password Email', 'Password Reset', 'This template is used for retrieving lost user password', '<div style=\"background-color:#F2F2F2;margin-top:20px;margin-left:auto;margin-right:auto;max-width:800px;padding:10px;font-family: Helvetica, Arial, sans-serif; font-size: 16px; color: #404040\">\r\n  <div style=\"border-radius: 6px 6px 6px 6px;box-shadow: 0 16px 24px 0 #DFDFDF;\">\r\n    <div style=\"background-color:#35B8E8;text-align:center;margin-top:32px;border-radius: 6px 6px 0 0;\"><img src=\"[SITEURL]/assets/images/header.png\" alt=\"header\" data-image=\"kmbm1za7efwc\"></div>\r\n    <div style=\"background-color:#ffffff;padding:48px;text-align:center;border-radius: 0 0 6px 6px;\">\r\n<h1 style=\"font-weight:100;margin-bottom:32px\">New Password Request!</h1>\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\"> Hey [NAME], it seems that you or someone requested a new password for you.</p>\r\n<p style=\"margin:0;padding:5px;color:#7B7B7B\"> We have generated a new password, as requested.</p>\r\n<div style=\"padding:30px 0px 0px 0px\">\r\n  <a target=\"_blank\" href=\"[LINK]\" style=\"text-decoration: none;border-radius: 6px 6px 6px 6px;display:inline-block;background-color:#4CAF50;padding:14px 30px 14px 30px;color:#ffffff;font-weight:500;font-size:18px\">Go to password reset page </a>\r\n</div>\r\n    </div>\r\n  </div>\r\n  <div style=\"padding:48px;text-align:center\">\r\n    <p style=\"margin-bottom:32px;font-size:20px;color:##272822\"><em>Stay in touch</em></p>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[FB]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/twitter.png\" data-image=\"wiuvuko2oe7j\"></a>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[TW]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/facebook.png\" data-image=\"m7oek6betzkw\"></a>\r\n    <a href=\"mailto:[CEMAIL]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/email.png\" data-image=\"ruu0t8hc3al7\"></a>\r\n    <div style=\"font-size:12px;color:#6E6E6E;margin-top:24px\">\r\n<p style=\"margin:0;padding:4px\"> This email is sent to you directly from [COMPANY]</p>\r\n<p style=\"margin:0\"> The information above is gathered from the user input. ©[DATE] <a href=\"[SITEURL]\">[COMPANY]</a>\r\n. All rights reserved.</p>\r\n</div>\r\n    [LOGO] </div>\r\n</div>', 'mailer', 'userPassReset');
INSERT INTO `email_templates` (`id`, `name_en`, `subject_en`, `help_en`, `body_en`, `type`, `typeid`) VALUES(3, 'Welcome Mail From Admin', 'You have been registered', 'This template is used to send welcome email, when user is added by administrator', '<div style=\"background-color:#F2F2F2;margin:0 auto;padding:60px;font-family: Helvetica, Arial, sans-serif; font-size: 16px; color: #404040\"> [LOGO]\r\n  <div style=\"border-radius: 6px 6px 6px 6px;box-shadow: 0 1px 2px 0 #DFDFDF;\">\r\n    <div style=\"background-color:#35B8E8;text-align:center;margin-top:32px;border-radius: 6px 6px 0 0;\"><img src=\"[SITEURL]/assets/images/header.png\" alt=\"header\" data-image=\"pvy0mjj5q3qg\"></div>\r\n    <div style=\"background-color:#ffffff;padding:48px;text-align:center;border-radius: 0 0 6px 6px;\">\r\n<h1 style=\"font-weight:100;margin-bottom:32px\">Welcome to [COMPANY]</h1>\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\"> Hey [NAME], You\'re now a member of [SITE_NAME].</p>\r\n<p style=\"margin:0;padding:5px;color:#7B7B7B\"> Here are your login details. Please keep them in a safe place: </p>\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>Username:</strong> [USERNAME] <br><strong>Password:</strong> [PASSWORD]</p>\r\n<div style=\"padding:30px 0px 0px 0px\">\r\n<a target=\"_blank\" href=\"[LINK]\" style=\"text-decoration: none;border-radius: 6px 6px 6px 6px;display:inline-block;background-color:#4CAF50;padding:14px 30px 14px 30px;color:#ffffff;font-weight:500;font-size:18px\">Go to login </a>\r\n</div>\r\n    </div>\r\n  </div>\r\n  <div style=\"padding:48px;text-align:center\">\r\n    <p style=\"margin-bottom:32px;font-size:20px;color:##272822\"><em>Stay in touch</em></p>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[FB]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/twitter.png\" data-image=\"83l2r3utfiat\"></a>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[TW]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/facebook.png\" data-image=\"52x4to0expai\"></a>\r\n    <a href=\"mailto:[CEMAIL]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/email.png\" data-image=\"ctjwcqya9l2p\"></a>\r\n    <div style=\"font-size:12px;color:#6E6E6E;margin-top:24px\">\r\n<p style=\"margin:0;padding:4px\"> This email is sent to you directly from [COMPANY]</p>\r\n<p style=\"margin:0\"> The information above is gathered from the user input. ©[DATE] <a href=\"[SITEURL]\">[COMPANY]</a>\r\n. All rights reserved.</p>\r\n    </div>\r\n  </div>\r\n</div>', 'mailer', 'regMailAdmin');
INSERT INTO `email_templates` (`id`, `name_en`, `subject_en`, `help_en`, `body_en`, `type`, `typeid`) VALUES(4, 'Default Newsletter', 'Newsletter', 'This is a default newsletter template', '<div style=\"background-color:#F2F2F2;margin:0 auto;padding:60px;font-family: Helvetica, Arial, sans-serif; font-size: 16px; color: #404040\"> [LOGO]\r\n  <div style=\"border-radius: 6px 6px 6px 6px;box-shadow: 0 1px 2px 0 #DFDFDF;\">\r\n    <div style=\"background-color:#35B8E8;text-align:center;margin-top:32px;border-radius: 6px 6px 0 0;\"><img src=\"[SITEURL]/assets/images/header.png\" alt=\"header\"></div>\r\n    <div style=\"background-color:#ffffff;padding:48px;text-align:center;border-radius: 0 0 6px 6px;\">\r\n<h1 style=\"font-weight:100;margin-bottom:32px\">[COMPANY] Newsletter</h1>\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\"> Hey, [NAME]</p>\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\">[ATTACHMENT]</p>\r\n<div style=\"padding:30px 0px 0px 0px;text-align:left\">\r\nNewsletter content goes here...\r\n</div>\r\n    </div>\r\n  </div>\r\n  <div style=\"padding:48px;text-align:center\">\r\n    <p style=\"margin-bottom:32px;font-size:20px;color:##272822\"><em>Stay in touch</em></p>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[FB]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/twitter.png\" alt=\"\"></a>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[TW]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/facebook.png\" alt=\"\"></a>\r\n    <a href=\"mailto:[CEMAIL]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/email.png\" alt=\"\"></a>\r\n    <div style=\"font-size:12px;color:#6E6E6E;margin-top:24px\">\r\n<p style=\"margin:0;padding:4px\"> This email is sent to you directly from [COMPANY]</p>\r\n<p style=\"margin:0\"> The information above is gathered from the user input. ©[DATE] <a href=\"[SITEURL]\">[COMPANY]</a>\r\n. All rights reserved.</p>\r\n    </div>\r\n  </div>\r\n</div>', 'news', 'newsletter');
INSERT INTO `email_templates` (`id`, `name_en`, `subject_en`, `help_en`, `body_en`, `type`, `typeid`) VALUES(5, 'Transaction Completed', 'Payment Completed', 'This template is used to notify administrator on successful payment transaction', '<div style=\"background-color:#F2F2F2;margin:0 auto;padding:60px;font-family: Helvetica, Arial, sans-serif; font-size: 16px; color: #404040\"> [LOGO]\r\n  <div style=\"border-radius: 6px 6px 6px 6px;box-shadow: 0 1px 2px 0 #DFDFDF;\">\r\n    <div style=\"background-color:#35B8E8;text-align:center;margin-top:32px;border-radius: 6px 6px 0 0;\"><img src=\"[SITEURL]/assets/images/header.png\" alt=\"header\"></div>\r\n    <div style=\"background-color:#ffffff;padding:48px;text-align:center;border-radius: 0 0 6px 6px;\">\r\n<h1 style=\"font-weight:100;margin-bottom:32px\">Hello Admin</h1>\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\">You have received new payment following: </p>\r\n<div style=\"padding:30px 0px 0px 0px;text-align:left\">\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>Username:</strong> [NAME]</p>\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>Membership:</strong> [ITEMNAME]</p>\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>Price:</strong> [PRICE]</p>\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>Status:</strong> [STATUS]</p>\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>Processor:</strong> [PP]</p>\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>IP:</strong> [IP]</p>\r\n</div>\r\n    </div>\r\n  </div>\r\n  <div style=\"padding:48px;text-align:center\">\r\n    <p style=\"margin-bottom:32px;font-size:20px;color:##272822\"><em>Stay in touch</em></p>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[FB]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/twitter.png\" alt=\"\"></a>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[TW]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/facebook.png\" alt=\"\"></a>\r\n    <a href=\"mailto:[CEMAIL]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/email.png\" alt=\"\"></a>\r\n    <div style=\"font-size:12px;color:#6E6E6E;margin-top:24px\">\r\n<p style=\"margin:0;padding:4px\"> This email is sent to you directly from [COMPANY]</p>\r\n<p style=\"margin:0\"> The information above is gathered from the user input. ©[DATE] <a href=\"[SITEURL]\">[COMPANY]</a>\r\n. All rights reserved.</p>\r\n    </div>\r\n  </div>\r\n</div>', 'mailer', 'payComplete');
INSERT INTO `email_templates` (`id`, `name_en`, `subject_en`, `help_en`, `body_en`, `type`, `typeid`) VALUES(6, 'Transaction Suspicious', 'Suspicious Transaction', 'This template is used to notify administrator on failed/suspicious payment transaction', '<div style=\"background-color:#F2F2F2;margin:0 auto;padding:60px;font-family: Helvetica, Arial, sans-serif; font-size: 16px; color: #404040\"> [LOGO]\r\n  <div style=\"border-radius: 6px 6px 6px 6px;box-shadow: 0 1px 2px 0 #DFDFDF;\">\r\n    <div style=\"background-color:#35B8E8;text-align:center;margin-top:32px;border-radius: 6px 6px 0 0;\"><img src=\"[SITEURL]/assets/images/header.png\" alt=\"header\"></div>\r\n    <div style=\"background-color:#ffffff;padding:48px;text-align:center;border-radius: 0 0 6px 6px;\">\r\n<h1 style=\"font-weight:100;margin-bottom:32px\">Hello Admin</h1>\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\">The following transaction has been disabled due to suspicious activity:</p>\r\n<div style=\"padding:30px 0px 0px 0px;text-align:left\">\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>Username:</strong> [NAME]</p>\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>Membership:</strong> [ITEMNAME]</p>\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>Price:</strong> [PRICE]</p>\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>Status:</strong> [STATUS]</p>\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>Processor:</strong> [PP]</p>\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>IP:</strong> [IP]</p>\r\n</div>\r\n<p style=\"margin:10px;padding:3px;color:#7B7B7B\"><em>Please verify this transaction is correct. If it is, please activate it in the transaction section of your site\'s administration control panel. If not, it appears that someone tried to fraudulently obtain products from your site.</em></p>\r\n    </div>\r\n  </div>\r\n  <div style=\"padding:48px;text-align:center\">\r\n    <p style=\"margin-bottom:32px;font-size:20px;color:##272822\"><em>Stay in touch</em></p>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[FB]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/twitter.png\" alt=\"\"></a>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[TW]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/facebook.png\" alt=\"\"></a>\r\n    <a href=\"mailto:[CEMAIL]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/email.png\" alt=\"\"></a>\r\n    <div style=\"font-size:12px;color:#6E6E6E;margin-top:24px\">\r\n<p style=\"margin:0;padding:4px\"> This email is sent to you directly from [COMPANY]</p>\r\n<p style=\"margin:0\"> The information above is gathered from the user input. ©[DATE] <a href=\"[SITEURL]\">[COMPANY]</a>\r\n. All rights reserved.</p>\r\n    </div>\r\n  </div>\r\n</div>', 'mailer', 'payBad');
INSERT INTO `email_templates` (`id`, `name_en`, `subject_en`, `help_en`, `body_en`, `type`, `typeid`) VALUES(7, 'Welcome Email', 'Welcome', 'This template is used to welcome newly registered user when Configuration->Registration Verification and Configuration->Auto Registration are both set to YES', '<div style=\"background-color:#F2F2F2;margin:0 auto;padding:60px;font-family: Helvetica, Arial, sans-serif; font-size: 16px; color: #404040\"> [LOGO]\r\n  <div style=\"border-radius: 6px 6px 6px 6px;box-shadow: 0 1px 2px 0 #DFDFDF;\">\r\n    <div style=\"background-color:#35B8E8;text-align:center;margin-top:32px;border-radius: 6px 6px 0 0;\"><img src=\"[SITEURL]/assets/images/header.png\" alt=\"header\"></div>\r\n    <div style=\"background-color:#ffffff;padding:48px;text-align:center;border-radius: 0 0 6px 6px;\">\r\n<h1 style=\"font-weight:100;margin-bottom:32px\">Welcome to [COMPANY]</h1>\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\"> Hey [NAME], You\'re now a member of [SITE_NAME].</p>\r\n<p style=\"margin:0;padding:5px;color:#7B7B7B\"> Here are your login details. Please keep them in a safe place: </p>\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>Username:</strong> [USERNAME] <br><strong>Password:</strong> [PASSWORD]</p>\r\n<div style=\"padding:30px 0px 0px 0px\">\r\n<a target=\"_blank\" href=\"[LINK]\" style=\"text-decoration: none;border-radius: 6px 6px 6px 6px;display:inline-block;background-color:#4CAF50;padding:14px 30px 14px 30px;color:#ffffff;font-weight:500;font-size:18px\">Go to login </a>\r\n</div>\r\n    </div>\r\n  </div>\r\n  <div style=\"padding:48px;text-align:center\">\r\n    <p style=\"margin-bottom:32px;font-size:20px;color:##272822\"><em>Stay in touch</em></p>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[FB]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/twitter.png\" alt=\"\"></a>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[TW]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/facebook.png\" alt=\"\"></a>\r\n    <a href=\"mailto:[CEMAIL]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/email.png\" alt=\"\"></a>\r\n    <div style=\"font-size:12px;color:#6E6E6E;margin-top:24px\">\r\n<p style=\"margin:0;padding:4px\"> This email is sent to you directly from [COMPANY]</p>\r\n<p style=\"margin:0\"> The information above is gathered from the user input. ©[DATE] <a href=\"[SITEURL]\">[COMPANY]</a>\r\n. All rights reserved.</p>\r\n    </div>\r\n  </div>\r\n</div>', 'mailer', 'welcomeEmail');
INSERT INTO `email_templates` (`id`, `name_en`, `subject_en`, `help_en`, `body_en`, `type`, `typeid`) VALUES(8, 'Membership Expire 7 days', 'Your membership will expire in 7 days', 'This template is used to remind user that membership will expire in 7 days', '<div style=\"background-color:#F2F2F2;margin:0 auto;padding:60px;font-family: Helvetica, Arial, sans-serif; font-size: 16px; color: #404040\"> [LOGO]\r\n  <div style=\"border-radius: 6px 6px 6px 6px;box-shadow: 0 1px 2px 0 #DFDFDF;\">\r\n    <div style=\"background-color:#35B8E8;text-align:center;margin-top:32px;border-radius: 6px 6px 0 0;\"><img src=\"[SITEURL]/assets/images/header.png\" alt=\"header\"></div>\r\n    <div style=\"background-color:#ffffff;padding:48px;text-align:center;border-radius: 0 0 6px 6px;\">\r\n<h1 style=\"font-weight:100;margin-bottom:32px\">Membership Notification From [COMPANY]</h1>\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\">Hey, [NAME]</p>\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\">Your current membership will expire in 7 days. Please login to your user panel to extend or upgrade your membership.</p>\r\n<div style=\"padding:30px 0px 0px 0px\">\r\n<a target=\"_blank\" href=\"[LINK]\" style=\"text-decoration: none;border-radius: 6px 6px 6px 6px;display:inline-block;background-color:#4CAF50;padding:14px 30px 14px 30px;color:#ffffff;font-weight:500;font-size:18px\">Login</a>\r\n</div>\r\n    </div>\r\n  </div>\r\n  <div style=\"padding:48px;text-align:center\">\r\n    <p style=\"margin-bottom:32px;font-size:20px;color:##272822\"><em>Stay in touch</em></p>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[FB]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/twitter.png\" alt=\"\"></a>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[TW]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/facebook.png\" alt=\"\"></a>\r\n    <a href=\"mailto:[CEMAIL]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/email.png\" alt=\"\"></a>\r\n    <div style=\"font-size:12px;color:#6E6E6E;margin-top:24px\">\r\n<p style=\"margin:0;padding:4px\"> This email is sent to you directly from [COMPANY]</p>\r\n<p style=\"margin:0\"> The information above is gathered from the user input. ©[DATE] <a href=\"[SITEURL]\">[COMPANY]</a>\r\n. All rights reserved.</p>\r\n    </div>\r\n  </div>\r\n</div>', 'mailer', 'memExp7');
INSERT INTO `email_templates` (`id`, `name_en`, `subject_en`, `help_en`, `body_en`, `type`, `typeid`) VALUES(9, 'Membership expired today', 'Your membership has expired', 'This template is used to remind user that membership had expired', '<div style=\"background-color:#F2F2F2;margin:0 auto;padding:60px;font-family: Helvetica, Arial, sans-serif; font-size: 16px; color: #404040\"> [LOGO]\r\n  <div style=\"border-radius: 6px 6px 6px 6px;box-shadow: 0 1px 2px 0 #DFDFDF;\">\r\n    <div style=\"background-color:#35B8E8;text-align:center;margin-top:32px;border-radius: 6px 6px 0 0;\"><img src=\"[SITEURL]/assets/images/header.png\" alt=\"header\"></div>\r\n    <div style=\"background-color:#ffffff;padding:48px;text-align:center;border-radius: 0 0 6px 6px;\">\r\n<h1 style=\"font-weight:100;margin-bottom:32px\">Membership Notification From [COMPANY]</h1>\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\">Hey, [NAME]</p>\r\n<p style=\"margin:0;padding:3px;color:red;font-size:18px\">Your current membership has expired!</p>\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\">Please login to your user panel to extend or upgrade your membership.</p>\r\n<div style=\"padding:30px 0px 0px 0px\">\r\n<a target=\"_blank\" href=\"[LINK]\" style=\"text-decoration: none;border-radius: 6px 6px 6px 6px;display:inline-block;background-color:#4CAF50;padding:14px 30px 14px 30px;color:#ffffff;font-weight:500;font-size:18px\">Login</a>\r\n</div>\r\n    </div>\r\n  </div>\r\n  <div style=\"padding:48px;text-align:center\">\r\n    <p style=\"margin-bottom:32px;font-size:20px;color:##272822\"><em>Stay in touch</em></p>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[FB]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/twitter.png\" alt=\"\"></a>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[TW]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/facebook.png\" alt=\"\"></a>\r\n    <a href=\"mailto:[CEMAIL]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/email.png\" alt=\"\"></a>\r\n    <div style=\"font-size:12px;color:#6E6E6E;margin-top:24px\">\r\n<p style=\"margin:0;padding:4px\"> This email is sent to you directly from [COMPANY]</p>\r\n<p style=\"margin:0\"> The information above is gathered from the user input. ©[DATE] <a href=\"[SITEURL]\">[COMPANY]</a>\r\n. All rights reserved.</p>\r\n    </div>\r\n  </div>\r\n</div>', 'mailer', 'memExp');
INSERT INTO `email_templates` (`id`, `name_en`, `subject_en`, `help_en`, `body_en`, `type`, `typeid`) VALUES(10, 'Contact Request', 'Contact Inquiry', 'This template is used to send default Contact Request Form', '<div style=\"background-color:#F2F2F2;margin:0 auto;padding:60px;font-family: Helvetica, Arial, sans-serif; font-size: 16px; color: #404040\"> [LOGO]\r\n  <div style=\"border-radius: 6px 6px 6px 6px;box-shadow: 0 1px 2px 0 #DFDFDF;\">\r\n    <div style=\"background-color:#35B8E8;text-align:center;margin-top:32px;border-radius: 6px 6px 0 0;\"><img src=\"[SITEURL]/assets/images/header.png\" alt=\"header\"></div>\r\n    <div style=\"background-color:#ffffff;padding:48px;text-align:center;border-radius: 0 0 6px 6px;\">\r\n<h1 style=\"font-weight:100;margin-bottom:32px\">Hello Admin</h1>\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\">You have a new contact request: </p>\r\n<div style=\"padding:30px 0px 0px 0px;text-align:left\">\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>From:</strong> [NAME]</p>\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>Email:</strong> [EMAIL]</p>\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>Telephone:</strong> [PHONE]</p>\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>Subject:</strong> [MAILSUBJECT]</p>\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>IP:</strong> [IP]</p>\r\n</div>\r\n<div style=\"padding:30px 0px 0px 0px;text-align:left\"> [MESSAGE] </div>\r\n    </div>\r\n  </div>\r\n  <div style=\"padding:48px;text-align:center\">\r\n    <p style=\"margin-bottom:32px;font-size:20px;color:##272822\"><em>Stay in touch</em></p>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[FB]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/twitter.png\" alt=\"\"></a>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[TW]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/facebook.png\" alt=\"\"></a>\r\n    <a href=\"mailto:[CEMAIL]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/email.png\" alt=\"\"></a>\r\n    <div style=\"font-size:12px;color:#6E6E6E;margin-top:24px\">\r\n<p style=\"margin:0;padding:4px\"> This email is sent to you directly from [COMPANY]</p>\r\n<p style=\"margin:0\"> The information above is gathered from the user input. ©[DATE] <a href=\"[SITEURL]\">[COMPANY]</a>\r\n. All rights reserved.</p>\r\n    </div>\r\n  </div>\r\n</div>', 'mailer', 'contact');
INSERT INTO `email_templates` (`id`, `name_en`, `subject_en`, `help_en`, `body_en`, `type`, `typeid`) VALUES(11, 'New Comment', 'New Comment Added', 'This template is used to notify admin when new comment has been added', '<div style=\"background-color:#F2F2F2;margin:0 auto;padding:60px;font-family: Helvetica, Arial, sans-serif; font-size: 16px; color: #404040\"> [LOGO]\r\n  <div style=\"border-radius: 6px 6px 6px 6px;box-shadow: 0 1px 2px 0 #DFDFDF;\">\r\n    <div style=\"background-color:#35B8E8;text-align:center;margin-top:32px;border-radius: 6px 6px 0 0;\"><img src=\"[SITEURL]/assets/images/header.png\" alt=\"header\"></div>\r\n    <div style=\"background-color:#ffffff;padding:48px;text-align:center;border-radius: 0 0 6px 6px;\">\r\n<h1 style=\"font-weight:100;margin-bottom:32px\">Hello Admin</h1>\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\">You have a new comment post. If comments are not auto approved, you will need to manually approve from admin panel. Here are the details: </p>\r\n<div style=\"padding:30px 0px 0px 0px;text-align:left\">\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>From:</strong> [NAME]</p>\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>Page:</strong> <a href=\"[PAGEURL]\">[PAGEURL]</a></p>\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>IP:</strong> [IP]</p>\r\n</div>\r\n<div style=\"padding:30px 0px 0px 0px;text-align:left\"> [MESSAGE] </div>\r\n    </div>\r\n  </div>\r\n  <div style=\"padding:48px;text-align:center\">\r\n    <p style=\"margin-bottom:32px;font-size:20px;color:##272822\"><em>Stay in touch</em></p>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[FB]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/twitter.png\" alt=\"\"></a>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[TW]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/facebook.png\" alt=\"\"></a>\r\n    <a href=\"mailto:[CEMAIL]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/email.png\" alt=\"\"></a>\r\n    <div style=\"font-size:12px;color:#6E6E6E;margin-top:24px\">\r\n<p style=\"margin:0;padding:4px\"> This email is sent to you directly from [COMPANY]</p>\r\n<p style=\"margin:0\"> The information above is gathered from the user input. ©[DATE] <a href=\"[SITEURL]\">[COMPANY]</a>\r\n. All rights reserved.</p>\r\n    </div>\r\n  </div>\r\n</div>', 'mailer', 'newComment');
INSERT INTO `email_templates` (`id`, `name_en`, `subject_en`, `help_en`, `body_en`, `type`, `typeid`) VALUES(12, 'Single Email', 'Single User Email', 'This template is used to email single user', '<div style=\"background-color:#F2F2F2;margin:0 auto;padding:60px;font-family: Helvetica, Arial, sans-serif; font-size: 16px; color: #404040\"> [LOGO]\r\n  <div style=\"border-radius: 6px 6px 6px 6px;box-shadow: 0 1px 2px 0 #DFDFDF;\">\r\n    <div style=\"background-color:#35B8E8;text-align:center;margin-top:32px;border-radius: 6px 6px 0 0;\"><img src=\"[SITEURL]/assets/images/header.png\" alt=\"header\"></div>\r\n    <div style=\"background-color:#ffffff;padding:48px;text-align:center;border-radius: 0 0 6px 6px;\">\r\n<h1 style=\"font-weight:100;margin-bottom:32px\">Hello [NAME]</h1>\r\n<div style=\"padding:30px 0px 0px 0px;text-align:left\">Your message goes here...  </div>\r\n    </div>\r\n  </div>\r\n  <div style=\"padding:48px;text-align:center\">\r\n    <p style=\"margin-bottom:32px;font-size:20px;color:##272822\"><em>Stay in touch</em></p>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[FB]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/twitter.png\" alt=\"\"></a>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[TW]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/facebook.png\" alt=\"\"></a>\r\n    <a href=\"mailto:[CEMAIL]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/email.png\" alt=\"\"></a>\r\n    <div style=\"font-size:12px;color:#6E6E6E;margin-top:24px\">\r\n<p style=\"margin:0;padding:4px\"> This email is sent to you directly from [COMPANY]</p>\r\n<p style=\"margin:0\"> The information above is gathered from the user input. ©[DATE] <a href=\"[SITEURL]\">[COMPANY]</a>\r\n. All rights reserved.</p>\r\n    </div>\r\n  </div>\r\n</div>', 'mailer', 'singleMail');
INSERT INTO `email_templates` (`id`, `name_en`, `subject_en`, `help_en`, `body_en`, `type`, `typeid`) VALUES(13, 'Notify Admin', 'New User Registration', 'This template is used to notify admin of new registration when Configuration->Registration Notification is set to YES', '<div style=\"background-color:#F2F2F2;margin:0 auto;padding:60px;font-family: Helvetica, Arial, sans-serif; font-size: 16px; color: #404040\"> [LOGO]\r\n  <div style=\"border-radius: 6px 6px 6px 6px;box-shadow: 0 1px 2px 0 #DFDFDF;\">\r\n    <div style=\"background-color:#35B8E8;text-align:center;margin-top:32px;border-radius: 6px 6px 0 0;\"><img src=\"[SITEURL]/assets/images/header.png\" alt=\"header\"></div>\r\n    <div style=\"background-color:#ffffff;padding:48px;text-align:center;border-radius: 0 0 6px 6px;\">\r\n<h1 style=\"font-weight:100;margin-bottom:32px\">Hello Admin</h1>\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\">You have a new user registration. You can login into your admin panel to view details: </p>\r\n<div style=\"padding:30px 0px 0px 0px;text-align:left\">\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>Email:</strong> [EMAIL]</p>\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>Name:</strong> [NAME]</p>\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>IP:</strong> [IP]</p>\r\n</div>\r\n    </div>\r\n  </div>\r\n  <div style=\"padding:48px;text-align:center\">\r\n    <p style=\"margin-bottom:32px;font-size:20px;color:##272822\"><em>Stay in touch</em></p>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[FB]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/twitter.png\" alt=\"\"></a>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[TW]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/facebook.png\" alt=\"\"></a>\r\n    <a href=\"mailto:[CEMAIL]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/email.png\" alt=\"\"></a>\r\n    <div style=\"font-size:12px;color:#6E6E6E;margin-top:24px\">\r\n<p style=\"margin:0;padding:4px\"> This email is sent to you directly from [COMPANY]</p>\r\n<p style=\"margin:0\"> The information above is gathered from the user input. ©[DATE] <a href=\"[SITEURL]\">[COMPANY]</a>\r\n. All rights reserved.</p>\r\n    </div>\r\n  </div>\r\n</div>', 'mailer', 'notifyAdmin');
INSERT INTO `email_templates` (`id`, `name_en`, `subject_en`, `help_en`, `body_en`, `type`, `typeid`) VALUES(14, 'Registration Pending', 'Registration Verification Pending', 'This template is used to send Registration Verification Email, when Configuration->Auto Registration is set to NO', '<div style=\"background-color:#F2F2F2;margin:0 auto;padding:60px;font-family: Helvetica, Arial, sans-serif; font-size: 16px; color: #404040\"> [LOGO]\r\n  <div style=\"border-radius: 6px 6px 6px 6px;box-shadow: 0 1px 2px 0 #DFDFDF;\">\r\n    <div style=\"background-color:#35B8E8;text-align:center;margin-top:32px;border-radius: 6px 6px 0 0;\"><img src=\"[SITEURL]/assets/images/header.png\" alt=\"header\"></div>\r\n    <div style=\"background-color:#ffffff;padding:48px;text-align:center;border-radius: 0 0 6px 6px;\">\r\n<h1 style=\"font-weight:100;margin-bottom:32px\">Welcome to [COMPANY]</h1>\r\n<h4 style=\"font-weight:600;margin-bottom:16px\">Congratulations</h4>\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\"> You are now registered member.</p>\r\n<p style=\"padding:30px 0px 0px 0px;color:#7B7B7B\"> The administrator of this site has requested all new accounts to be activated by the users who created them thus your account is currently pending verification process. </p>\r\n<p style=\"margin:0;padding:5px;color:#7B7B7B\"> Here are your login details. Please keep them in a safe place: </p>\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>Username:</strong> [USERNAME] <br>\r\n<strong>Password:</strong> [PASSWORD]</p>\r\n    </div>\r\n  </div>\r\n  <div style=\"padding:48px;text-align:center\">\r\n    <p style=\"margin-bottom:32px;font-size:20px;color:##272822\"><em>Stay in touch</em></p>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[FB]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/twitter.png\" alt=\"\"></a>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[TW]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/facebook.png\" alt=\"\"></a>\r\n    <a href=\"mailto:[CEMAIL]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/email.png\" alt=\"\"></a>\r\n    <div style=\"font-size:12px;color:#6E6E6E;margin-top:24px\">\r\n<p style=\"margin:0;padding:4px\"> This email is sent to you directly from [COMPANY]</p>\r\n<p style=\"margin:0\"> The information above is gathered from the user input. ©[DATE] <a href=\"[SITEURL]\">[COMPANY]</a>\r\n. All rights reserved.</p>\r\n    </div>\r\n  </div>\r\n</div>', 'mailer', 'regMailPending');
INSERT INTO `email_templates` (`id`, `name_en`, `subject_en`, `help_en`, `body_en`, `type`, `typeid`) VALUES(15, 'Offline Payment', 'Offline Notification', 'This template is used to send notification to a user when offline payment method is being used', '<div style=\"background-color:#F2F2F2;margin:0 auto;padding:60px;font-family: Helvetica, Arial, sans-serif; font-size: 16px; color: #404040\"> [LOGO]\r\n  <div style=\"border-radius: 6px 6px 6px 6px;box-shadow: 0 1px 2px 0 #DFDFDF;\">\r\n    <div style=\"background-color:#35B8E8;text-align:center;margin-top:32px;border-radius: 6px 6px 0 0;\"><img src=\"[SITEURL]/assets/images/header.png\" alt=\"header\"></div>\r\n    <div style=\"background-color:#ffffff;padding:48px;text-align:center;border-radius: 0 0 6px 6px;\">\r\n<h1 style=\"font-weight:100;margin-bottom:32px\">Purchase From [COMPANY]</h1>\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\"> Hey [NAME]!</p>\r\n<p style=\"margin:0;padding:5px;color:#7B7B7B\"> You have purchased the following: </p>\r\n<div style=\"padding:30px 0px 0px 0px;text-align:left\">\r\n[ITEMS]\r\n</div>\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\">Please send your payment to: </p>\r\n<div style=\"padding:30px 0px 0px 0px;text-align:left\">\r\n[INFO]\r\n</div>\r\n    </div>\r\n  </div>\r\n  <div style=\"padding:48px;text-align:center\">\r\n    <p style=\"margin-bottom:32px;font-size:20px;color:##272822\"><em>Stay in touch</em></p>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[FB]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/twitter.png\" alt=\"\"></a>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[TW]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/facebook.png\" alt=\"\"></a>\r\n    <a href=\"mailto:[CEMAIL]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/email.png\" alt=\"\"></a>\r\n    <div style=\"font-size:12px;color:#6E6E6E;margin-top:24px\">\r\n<p style=\"margin:0;padding:4px\"> This email is sent to you directly from [COMPANY]</p>\r\n<p style=\"margin:0\"> The information above is gathered from the user input. ©[DATE] <a href=\"[SITEURL]\">[COMPANY]</a>\r\n. All rights reserved.</p>\r\n    </div>\r\n  </div>\r\n</div>', 'mailer', 'offlinePay');
INSERT INTO `email_templates` (`id`, `name_en`, `subject_en`, `help_en`, `body_en`, `type`, `typeid`) VALUES(16, 'Event Payment', 'Event Payment Completed', 'This template is used to notify user on successful booking event payment transaction.', '<div style=\"background-color:#F2F2F2;margin:0 auto;padding:60px;font-family: Helvetica, Arial, sans-serif; font-size: 16px; color: #404040\"> [LOGO]\r\n  <div style=\"border-radius: 6px 6px 6px 6px;box-shadow: 0 1px 2px 0 #DFDFDF;\">\r\n    <div style=\"background-color:#35B8E8;text-align:center;margin-top:32px;border-radius: 6px 6px 0 0;\"><img src=\"[SITEURL]/assets/images/header.png\" alt=\"header\"></div>\r\n    <div style=\"background-color:#ffffff;padding:48px;text-align:center;border-radius: 0 0 6px 6px;\">\r\n<h1 style=\"font-weight:100;margin-bottom:32px\">Purchase From [COMPANY]</h1>\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\"> Hey [NAME]!</p>\r\n<p style=\"margin:0;padding:5px;color:#7B7B7B\"> You have successfully purchased and booked: </p>\r\n<div style=\"padding:30px 0px 0px 0px;text-align:left\">\r\n[ITEM]\r\n</div>\r\n<div style=\"padding:30px 0px 0px 0px\">\r\n<a target=\"_blank\" href=\"[EVENTURL]\" style=\"text-decoration: none;border-radius: 6px 6px 6px 6px;display:inline-block;background-color:#4CAF50;padding:14px 30px 14px 30px;color:#ffffff;font-weight:500;font-size:18px\">View Event Details</a>\r\n</div>\r\n    </div>\r\n  </div>\r\n  <div style=\"padding:48px;text-align:center\">\r\n    <p style=\"margin-bottom:32px;font-size:20px;color:##272822\"><em>Stay in touch</em></p>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[FB]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/twitter.png\" alt=\"\"></a>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[TW]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/facebook.png\" alt=\"\"></a>\r\n    <a href=\"mailto:[CEMAIL]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/email.png\" alt=\"\"></a>\r\n    <div style=\"font-size:12px;color:#6E6E6E;margin-top:24px\">\r\n<p style=\"margin:0;padding:4px\"> This email is sent to you directly from [COMPANY]</p>\r\n<p style=\"margin:0\"> The information above is gathered from the user input. ©[DATE] <a href=\"[SITEURL]\">[COMPANY]</a>\r\n. All rights reserved.</p>\r\n    </div>\r\n  </div>\r\n</div>', 'mailer', 'eventPay');
INSERT INTO `email_templates` (`id`, `name_en`, `subject_en`, `help_en`, `body_en`, `type`, `typeid`) VALUES(17, 'New Invoice', 'You have new invoice', 'This template is used to notify user of a invoice being sent (Invoice Manager)', '<div style=\"background-color:#F2F2F2;margin:0 auto;padding:60px;font-family: Helvetica, Arial, sans-serif; font-size: 16px; color: #404040\"> [LOGO]\r\n  <div style=\"border-radius: 6px 6px 6px 6px;box-shadow: 0 1px 2px 0 #DFDFDF;\">\r\n    <div style=\"background-color:#35B8E8;text-align:center;margin-top:32px;border-radius: 6px 6px 0 0;\"><img src=\"[SITEURL]/assets/images/header.png\" alt=\"header\"></div>\r\n    <div style=\"background-color:#ffffff;padding:48px;text-align:center;border-radius: 0 0 6px 6px;\">\r\n<h1 style=\"font-weight:100;margin-bottom:32px\">Invoice From [COMPANY]</h1>\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\"> Hey [NAME]!</p>\r\n<p style=\"margin:0;padding:5px;color:#7B7B7B\"> We have attached an invoice in the amount of [AMOUNT]: </p>\r\n<p style=\"margin:0;padding:5px;color:#7B7B7B\">You may pay, view and print the invoice online by visiting link bellow.</p>\r\n<div style=\"padding:30px 0px 0px 0px\">\r\n<a target=\"_blank\" href=\"[LINK]\" style=\"text-decoration: none;border-radius: 6px 6px 6px 6px;display:inline-block;background-color:#4CAF50;padding:14px 30px 14px 30px;color:#ffffff;font-weight:500;font-size:18px\">View Invoice</a>\r\n</div>\r\n    </div>\r\n  </div>\r\n  <div style=\"padding:48px;text-align:center\">\r\n    <p style=\"margin-bottom:32px;font-size:20px;color:##272822\"><em>Stay in touch</em></p>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[FB]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/twitter.png\" alt=\"\"></a>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[TW]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/facebook.png\" alt=\"\"></a>\r\n    <a href=\"mailto:[CEMAIL]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/email.png\" alt=\"\"></a>\r\n    <div style=\"font-size:12px;color:#6E6E6E;margin-top:24px\">\r\n<p style=\"margin:0;padding:4px\"> This email is sent to you directly from [COMPANY]</p>\r\n<p style=\"margin:0\"> The information above is gathered from the user input. ©[DATE] <a href=\"[SITEURL]\">[COMPANY]</a>\r\n. All rights reserved.</p>\r\n    </div>\r\n  </div>\r\n</div>', 'mailer', 'newInvoice');
INSERT INTO `email_templates` (`id`, `name_en`, `subject_en`, `help_en`, `body_en`, `type`, `typeid`) VALUES(18, 'Transaction Completed IM', 'Payment Completed IM', 'This template is used to notify administrator on successful payment transaction from Invoice Manager', '<div style=\"background-color:#F2F2F2;margin:0 auto;padding:60px;font-family: Helvetica, Arial, sans-serif; font-size: 16px; color: #404040\"> [LOGO]\r\n  <div style=\"border-radius: 6px 6px 6px 6px;box-shadow: 0 1px 2px 0 #DFDFDF;\">\r\n    <div style=\"background-color:#35B8E8;text-align:center;margin-top:32px;border-radius: 6px 6px 0 0;\"><img src=\"[SITEURL]/assets/images/header.png\" alt=\"header\"></div>\r\n    <div style=\"background-color:#ffffff;padding:48px;text-align:center;border-radius: 0 0 6px 6px;\">\r\n<h1 style=\"font-weight:100;margin-bottom:32px\">Hello Admin</h1>\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\">You have received new payment following: </p>\r\n<div style=\"padding:30px 0px 0px 0px;text-align:left\">\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>Client Name:</strong> [NAME]</p>\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>Invoice #:</strong> [INVID]</p>\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>Amount:</strong> [AMOUNT]</p>\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>Status:</strong> [STATUS]</p>\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>Processor:</strong> [PP]</p>\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>IP:</strong> [IP]</p>\r\n</div>\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\">You can view this transaction from your admin panel</p>\r\n<div style=\"padding:30px 0px 0px 0px\">\r\n<a target=\"_blank\" href=\"[LINK]\" style=\"text-decoration: none;border-radius: 6px 6px 6px 6px;display:inline-block;background-color:#4CAF50;padding:14px 30px 14px 30px;color:#ffffff;font-weight:500;font-size:18px\">Admin Panel</a>\r\n</div>\r\n    </div>\r\n  </div>\r\n  <div style=\"padding:48px;text-align:center\">\r\n    <p style=\"margin-bottom:32px;font-size:20px;color:##272822\"><em>Stay in touch</em></p>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[FB]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/twitter.png\" alt=\"\"></a>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[TW]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/facebook.png\" alt=\"\"></a>\r\n    <a href=\"mailto:[CEMAIL]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/email.png\" alt=\"\"></a>\r\n    <div style=\"font-size:12px;color:#6E6E6E;margin-top:24px\">\r\n<p style=\"margin:0;padding:4px\"> This email is sent to you directly from [COMPANY]</p>\r\n<p style=\"margin:0\"> The information above is gathered from the user input. ©[DATE] <a href=\"[SITEURL]\">[COMPANY]</a>\r\n. All rights reserved.</p>\r\n    </div>\r\n  </div>\r\n</div>', 'mailer', 'payCompleteIM');
INSERT INTO `email_templates` (`id`, `name_en`, `subject_en`, `help_en`, `body_en`, `type`, `typeid`) VALUES(19, 'PsDrive Submission', 'New PsDrive user submission', 'This template is used to notify administrator on successful PsDrive user submission', '<div style=\"background-color:#F2F2F2;margin:0 auto;padding:60px;font-family: Helvetica, Arial, sans-serif; font-size: 16px; color: #404040\"> [LOGO]\r\n  <div style=\"border-radius: 6px 6px 6px 6px;box-shadow: 0 1px 2px 0 #DFDFDF;\">\r\n    <div style=\"background-color:#35B8E8;text-align:center;margin-top:32px;border-radius: 6px 6px 0 0;\"><img src=\"[SITEURL]/assets/images/header.png\" alt=\"header\"></div>\r\n    <div style=\"background-color:#ffffff;padding:48px;text-align:center;border-radius: 0 0 6px 6px;\">\r\n<h1 style=\"font-weight:100;margin-bottom:32px\">Hello Admin</h1>\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\">You have received a new PsDrive file submission: </p>\r\n<div style=\"padding:30px 0px 0px 0px;text-align:left\">\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>Username:</strong> [EMAIL]</p>\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>Filename:</strong> [FILENAME]</p>\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>Url:</strong> [FILEURL]</p>\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\"><strong>IP:</strong> [IP]</p>\r\n</div>\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\">You can view this submission from your admin panel</p>\r\n<div style=\"padding:30px 0px 0px 0px\">\r\n<a target=\"_blank\" href=\"[LINK]\" style=\"text-decoration: none;border-radius: 6px 6px 6px 6px;display:inline-block;background-color:#4CAF50;padding:14px 30px 14px 30px;color:#ffffff;font-weight:500;font-size:18px\">Admin Panel</a>\r\n</div>\r\n    </div>\r\n  </div>\r\n  <div style=\"padding:48px;text-align:center\">\r\n    <p style=\"margin-bottom:32px;font-size:20px;color:##272822\"><em>Stay in touch</em></p>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[FB]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/twitter.png\" alt=\"\"></a>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[TW]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/facebook.png\" alt=\"\"></a>\r\n    <a href=\"mailto:[CEMAIL]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/email.png\" alt=\"\"></a>\r\n    <div style=\"font-size:12px;color:#6E6E6E;margin-top:24px\">\r\n<p style=\"margin:0;padding:4px\"> This email is sent to you directly from [COMPANY]</p>\r\n<p style=\"margin:0\"> The information above is gathered from the user input. ©[DATE] <a href=\"[SITEURL]\">[COMPANY]</a>\r\n. All rights reserved.</p>\r\n    </div>\r\n  </div>\r\n</div>', 'mailer', 'psdNotifyAdmin');
INSERT INTO `email_templates` (`id`, `name_en`, `subject_en`, `help_en`, `body_en`, `type`, `typeid`) VALUES(24, 'Forgot Password Admin', 'Password Reset', 'This template is used for retrieving lost admin password', '<div style=\"background-color:#F2F2F2;margin-top:20px;margin-left:auto;margin-right:auto;max-width:800px;padding:10px;font-family: Helvetica, Arial, sans-serif; font-size: 16px; color: #404040\">\r\n  <div style=\"border-radius: 6px 6px 6px 6px;box-shadow: 0 16px 24px 0 #DFDFDF;\">\r\n    <div style=\"background-color:#35B8E8;text-align:center;margin-top:32px;border-radius: 6px 6px 0 0;\"><img src=\"[SITEURL]/assets/images/header.png\" alt=\"header\" data-image=\"om9xanoquio1\"></div>\r\n    <div style=\"background-color:#ffffff;padding:48px;text-align:center;border-radius: 0 0 6px 6px;\">\r\n<h1 style=\"font-weight:100;margin-bottom:32px\">New Password Request!</h1>\r\n<p style=\"margin:0;padding:3px;color:#7B7B7B\"> Hey [NAME], it seems that you or someone requested a new password for you.</p>\r\n<p style=\"margin:0;padding:5px;color:#7B7B7B\"> We have generated a new password, as requested.</p>\r\n<div style=\"padding:30px 0px 0px 0px\">\r\n  <a target=\"_blank\" href=\"[LINK]\" style=\"text-decoration: none;border-radius: 6px 6px 6px 6px;display:inline-block;background-color:#4CAF50;padding:14px 30px 14px 30px;color:#ffffff;font-weight:500;font-size:18px\">Go to password reset page </a>\r\n</div>\r\n    </div>\r\n  </div>\r\n  <div style=\"padding:48px;text-align:center\">\r\n    <p style=\"margin-bottom:32px;font-size:20px;color:##272822\"><em>Stay in touch</em></p>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[FB]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/twitter.png\" data-image=\"t4gg80t1zf75\"></a>\r\n    <a target=\"_blank\" href=\"http://facebook.com/[TW]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/facebook.png\" data-image=\"nusbg4c56shy\"></a>\r\n    <a href=\"mailto:[CEMAIL]\" style=\"display:inline-block;margin: 0px 5px 0px 5px;\"><img src=\"[SITEURL]/assets/images/email.png\" data-image=\"xam1qyzrhhe8\"></a>\r\n    <div style=\"font-size:12px;color:#6E6E6E;margin-top:24px\">\r\n<p style=\"margin:0;padding:4px\"> This email is sent to you directly from [COMPANY]</p>\r\n<p style=\"margin:0\"> The information above is gathered from the user input. ©[DATE] <a href=\"[SITEURL]\">[COMPANY]</a>\r\n. All rights reserved.</p>\r\n</div>\r\n[LOGO]\r\n  </div>\r\n</div>', 'mailer', 'adminPassReset');
COMMIT;

--
-- Table structure for table `gateways`
--

DROP TABLE IF EXISTS `gateways`;
CREATE TABLE IF NOT EXISTS `gateways` (
  `id` tinyint(1) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `displayname` varchar(50) NOT NULL,
  `dir` varchar(25) NOT NULL,
  `live` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `extra_txt` varchar(100) DEFAULT NULL,
  `extra_txt2` varchar(100) DEFAULT NULL,
  `extra_txt3` varchar(100) DEFAULT NULL,
  `extra` varchar(100) DEFAULT NULL,
  `extra2` varchar(100) DEFAULT NULL,
  `extra3` text,
  `is_recurring` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `active` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gateways`
--

INSERT INTO `gateways` VALUES(1, 'paypal', 'PayPal', 'paypal', 1, 'Email Address', 'Currency Code', 'Not in Use', 'paypal@address.com', 'CAD', '', 1, 1);
INSERT INTO `gateways` VALUES(2, 'skrill', 'Skrill', 'skrill', 1, 'Email Address', 'Currency Code', 'Secret Passphrase', 'moneybookers@address.com', 'EUR', 'mypassphrase', 1, 1);
INSERT INTO `gateways` VALUES(3, 'offline', 'Offline Payment', 'offline', 0, 'Not in Use', 'Not in Use', 'Instructions', '', '', 'Please submit all payments to:\nBank Name:\nBank Account:\netc...', 0, 1);
INSERT INTO `gateways` VALUES(4, 'stripe', 'Stripe', 'stripe', 0, 'Secret Key', 'Currency Code', 'Publishable Key', 'ooo', 'CAD', 'ooo', 1, 1);
INSERT INTO `gateways` VALUES(5, 'payfast', 'PayFast', 'payfast', 0, 'Merchant ID', 'Merchant Key', 'PassPhrase', '', '', '', 0, 1);
INSERT INTO `gateways` VALUES(6, 'ideal', 'iDeal', 'ideal', 0, 'API Key', 'Currency Code', 'Not in Use', 'ooo', 'EUR', NULL, 0, 1);

--
-- Table structure for table `language`
--

DROP TABLE IF EXISTS `language`;
CREATE TABLE IF NOT EXISTS `language` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `abbr` varchar(2) DEFAULT NULL,
  `langdir` enum('ltr','rtl') DEFAULT 'ltr',
  `color` varchar(7) DEFAULT NULL,
  `author` varchar(200) DEFAULT NULL,
  `home` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `language`
--

INSERT INTO `language` VALUES(1, 'English', 'en', 'ltr', '#7ACB95', 'http://www.wojoscripts.com', 1);

--
-- Table structure for table `layout`
--

DROP TABLE IF EXISTS `layout`;
CREATE TABLE IF NOT EXISTS `layout` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plug_id` int(11) unsigned NOT NULL DEFAULT '0',
  `page_id` int(11) unsigned NOT NULL DEFAULT '0',
  `mod_id` int(11) unsigned NOT NULL DEFAULT '0',
  `modalias` varchar(30) DEFAULT NULL,
  `page_slug_en` varchar(150) DEFAULT NULL,
  `is_content` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `plug_name` varchar(60) DEFAULT NULL,
  `place` varchar(20) DEFAULT NULL,
  `space` tinyint(1) unsigned NOT NULL DEFAULT '10',
  `type` varchar(8) DEFAULT NULL,
  `sorting` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_page_id` (`page_id`),
  KEY `idx_plug_id` (`plug_id`),
  KEY `idx_mod_id` (`mod_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table structure for table `memberships`
--

DROP TABLE IF EXISTS `memberships`;
CREATE TABLE IF NOT EXISTS `memberships` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title_en` varchar(80) NOT NULL DEFAULT '',
  `description_en` varchar(150) DEFAULT NULL,
  `thumb` varchar(40) DEFAULT NULL,
  `price` float(10,2) unsigned NOT NULL DEFAULT '0.00',
  `days` smallint(3) unsigned NOT NULL DEFAULT '1',
  `period` varchar(1) NOT NULL DEFAULT 'D',
  `trial` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `recurring` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `private` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `memberships`
--

INSERT INTO `memberships` VALUES(1, 'Trial 7', 'This is 7 days trial membership...', 'bronze.svg', 0.00, 7, 'D', 1, 0, 0, 1);
INSERT INTO `memberships` VALUES(2, 'Basic 30', 'This is 30 days basic membership', 'silver.svg', 29.99, 1, 'M', 0, 0, 0, 1);
INSERT INTO `memberships` VALUES(3, 'Platinum', 'Platinum Monthly Subscription.', 'gold.svg', 49.99, 1, 'Y', 0, 1, 0, 1);
INSERT INTO `memberships` VALUES(4, 'Weekly Access', 'This is 7 days basic membership', 'platinum.svg', 5.99, 1, 'W', 0, 0, 0, 1);

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) unsigned NOT NULL DEFAULT '0',
  `page_id` int(11) unsigned NOT NULL DEFAULT '0',
  `page_slug_en` varchar(100) DEFAULT NULL,
  `name_en` varchar(100) NOT NULL,
  `mod_id` int(6) unsigned NOT NULL DEFAULT '0',
  `mod_slug` varchar(100) DEFAULT NULL,
  `caption_en` varchar(100) DEFAULT NULL,
  `content_type` varchar(20) NOT NULL DEFAULT 'page',
  `link` varchar(200) DEFAULT NULL,
  `target` varchar(15) NOT NULL DEFAULT '_blank',
  `icon` varchar(50) DEFAULT NULL,
  `cols` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `position` int(11) unsigned NOT NULL DEFAULT '0',
  `home_page` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `active` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_parent_id` (`parent_id`),
  KEY `idx_page_id` (`page_id`),
  KEY `idx_mod_id` (`mod_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` VALUES(1, 0, 3, 'our-contact-info', 'Contact Us', 0, NULL, 'Get in touch', 'page', '', '', '', 1, 24, 0, 1);
INSERT INTO `menus` VALUES(2, 0, 1, 'home', 'Home Page', 0, NULL, 'Let&#39;s Start here', 'page', '', '', '', 1, 1, 1, 1);
INSERT INTO `menus` VALUES(3, 52, 7, 'svg-header', 'SVG Header', 0, NULL, '', 'page', '', '', NULL, 1, 10, 0, 1);
INSERT INTO `menus` VALUES(5, 51, 5, 'demo-gallery-page', 'Gallery', 1, 'gallery', 'Gallery page', 'module', '#', '', NULL, 1, 12, 0, 1);
INSERT INTO `menus` VALUES(7, 0, 0, NULL, 'More Pages', 0, 'more-pages', 'Demo Pages', 'web', '#', '_self', NULL, 2, 2, 0, 1);
INSERT INTO `menus` VALUES(11, 52, 2, 'what-is-cms-pro', 'About Us', 0, 'about-us', 'Who are we', 'page', '', '', NULL, 1, 4, 0, 1);
INSERT INTO `menus` VALUES(17, 52, 9, 'members-only', 'Members Only', 0, 'members-only', NULL, 'page', '', '', NULL, 1, 8, 0, 1);
INSERT INTO `menus` VALUES(18, 52, 10, 'membership-only', 'Membership Only', 0, 'membership-only', NULL, 'page', '', '', NULL, 1, 9, 0, 1);
INSERT INTO `menus` VALUES(19, 51, 11, 'event-calendar-demo', 'Event Manager Demo', 0, NULL, '', 'page', '', '', NULL, 1, 13, 0, 1);
INSERT INTO `menus` VALUES(20, 52, 12, 'page-with-comments', 'Comment Page', 0, NULL, '', 'page', '', '', NULL, 1, 7, 0, 1);
INSERT INTO `menus` VALUES(21, 52, 8, 'slider-page', 'Slider Page', 0, NULL, '', 'page', '', '', NULL, 1, 6, 0, 1);
INSERT INTO `menus` VALUES(23, 87, 0, NULL, 'Helpdesk', 0, NULL, '', 'web', 'http://ckb.wojoscripts.com', '_blank', NULL, 1, 22, 0, 1);
INSERT INTO `menus` VALUES(34, 38, 0, 'portfolio', 'Portfolio', 0, NULL, '', 'web', '#', '_self', '', 1, 17, 0, 1);
INSERT INTO `menus` VALUES(35, 57, 8, 'slider-page', 'Timeline Custom', 0, NULL, '', 'page', '', '', NULL, 1, 16, 0, 1);
INSERT INTO `menus` VALUES(36, 38, 0, 'digishop', 'Digishop', 0, NULL, '', 'web', '#', '_self', '', 1, 18, 0, 1);
INSERT INTO `menus` VALUES(37, 38, 0, 'visual-forms', 'Visual Forms', 0, NULL, '', 'web', '#', '_self', '', 1, 20, 0, 1);
INSERT INTO `menus` VALUES(38, 0, 0, '', 'Premium Modules', 0, 'premium-modules', 'Premium Modules', 'web', '#', '', NULL, 1, 15, 0, 1);
INSERT INTO `menus` VALUES(39, 38, 0, 'blog', 'Blog Manager', 0, NULL, '', 'web', '#', '_self', '', 1, 16, 0, 1);
INSERT INTO `menus` VALUES(42, 52, 13, 'services', 'Services', 0, NULL, '', 'page', '', '', NULL, 0, 5, 0, 1);
INSERT INTO `menus` VALUES(43, 51, 22, 'demo-faq', 'FAQ Manager', 0, 'faq-manager', '', 'page', '', '', NULL, 0, 14, 0, 1);
INSERT INTO `menus` VALUES(51, 7, 0, NULL, 'Modules', 0, NULL, 'Modules', 'web', '#', '_self', NULL, 1, 11, 0, 1);
INSERT INTO `menus` VALUES(52, 7, 0, NULL, 'Demo Pages', 0, NULL, 'Demo Pages', 'web', '#', '_self', NULL, 1, 3, 0, 1);
INSERT INTO `menus` VALUES(53, 57, 0, 'timeline-event-demo', 'Timeline Events', 0, NULL, '', 'page', '', '', NULL, 1, 14, 0, 1);
INSERT INTO `menus` VALUES(54, 57, 0, 'timeline-portfolio-demo', 'Timeline Portfolio', 0, NULL, '', 'page', '', '', NULL, 1, 13, 0, 1);
INSERT INTO `menus` VALUES(85, 38, 0, 'shop', 'Shop', 0, NULL, '', 'web', '#', '_self', '', 1, 19, 0, 1);
INSERT INTO `menus` VALUES(86, 87, 0, NULL, 'Marketplace', 0, NULL, 'Marketplace', 'web', 'https://cmspro.club', '_blank', NULL, 1, 23, 0, 1);
INSERT INTO `menus` VALUES(87, 0, 0, NULL, 'CMS PRO Sites', 0, NULL, '', 'web', '#', '_self', NULL, 1, 21, 0, 1);

--
-- Table structure for table `modules`
--

DROP TABLE IF EXISTS `modules`;
CREATE TABLE IF NOT EXISTS `modules` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title_en` varchar(120) NOT NULL,
  `info_en` varchar(200) DEFAULT NULL,
  `modalias` varchar(60) NOT NULL,
  `hasconfig` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `hascoupon` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `hasfields` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `system` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `content` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `parent_id` smallint(3) unsigned NOT NULL DEFAULT '0',
  `is_menu` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_builder` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `keywords_en` varchar(200) DEFAULT NULL,
  `description_en` text,
  `icon` varchar(50) DEFAULT NULL,
  `ver` decimal(4,2) unsigned NOT NULL DEFAULT '1.00',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` VALUES
(1, 'Gallery', 'Fully featured gallery module', 'gallery', 1, 0, 0, 1, 1, 0, 1, 0, '', '', 'gallery/thumb.svg', '5.00', '2014-04-29 02:19:32', 1),
(3, 'Comments', 'Encourage your readers to join in the discussion and leave comments and respond promptly to the comments left by your readers to make them feel valued', 'comments', 1, 0, 0, 0, 1, 0, 0, 0, NULL, NULL, 'comments/thumb.svg', '5.00', '2016-10-15 18:05:56', 1),
(4, 'Event Manager', 'Easily publish and manage your company events.', 'events', 1, 0, 0, 0, 1, 0, 0, 1, NULL, NULL, 'events/thumb.svg', '5.00', '2016-10-15 20:03:54', 1),
(6, 'Universal Timeline', 'Create unlimited timline pugins.', 'timeline', 1, 0, 0, 1, 1, 0, 0, 0, NULL, NULL, 'timeline/thumb.svg', '5.00', '2016-10-28 16:59:59', 1),
(9, 'AdBlock', 'Manage Ad Campaigns', 'adblock', 1, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 'adblock/thumb.svg', '5.00', '2016-11-14 23:20:18', 1),
(11, 'Location Maps', 'Add Google Maps with multiple markers', 'gmaps', 1, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 'gmaps/thumb.svg', '5.00', '2016-11-19 23:08:30', 1),
(12, 'Album One', NULL, 'gallery', 0, 0, 0, 0, 0, 1, 0, 1, NULL, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod', 'gallery/thumb.svg', '1.00', '2017-01-04 15:18:56', 1),
(13, 'Album Two', NULL, 'gallery', 0, 0, 0, 0, 0, 2, 0, 1, NULL, NULL, 'gallery/thumb.svg', '1.00', '2017-01-04 15:27:41', 1),
(14, 'Album Three', NULL, 'gallery', 0, 0, 0, 0, 0, 3, 0, 1, NULL, NULL, 'gallery/thumb.svg', '1.00', '2017-01-04 15:28:17', 1),
(15, 'Album Four', NULL, 'gallery', 0, 0, 0, 0, 0, 4, 0, 1, NULL, NULL, 'gallery/thumb.svg', '1.00', '2017-01-04 15:28:48', 1),
(19, 'Event Timeline', NULL, 'timeline', 0, 0, 0, 0, 0, 2, 0, 1, NULL, NULL, 'timeline/thumb.svg', '1.00', '2017-01-04 15:49:05', 1),
(20, 'Rss Timeline', NULL, 'timeline', 0, 0, 0, 0, 0, 3, 0, 1, NULL, NULL, 'timeline/thumb.svg', '1.00', '2017-01-04 15:49:34', 1),
(23, 'Custom Timeline', NULL, 'timeline/custom_timeline', 0, 0, 0, 0, 0, 6, 0, 1, NULL, NULL, 'timeline/thumb.svg', '1.00', '2017-01-04 15:51:06', 1),
(24, 'F.A.Q. Manager', 'Complete Frequently Asked Question Management Module', 'faq', 1, 0, 0, 0, 1, 0, 0, 1, NULL, NULL, 'faq/thumb.svg', '1.00', '2017-05-25 11:54:17', 1);

--
-- Table structure for table `mod_adblock`
--

DROP TABLE IF EXISTS `mod_adblock`;
CREATE TABLE IF NOT EXISTS `mod_adblock` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title_en` varchar(100) NOT NULL,
  `plugin_id` varchar(30) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `total_views_allowed` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `total_clicks_allowed` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `minimum_ctr` decimal(10,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `image` varchar(50) DEFAULT NULL,
  `image_link` varchar(100) DEFAULT NULL,
  `image_alt` varchar(100) DEFAULT NULL,
  `html` text,
  `total_views` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `total_clicks` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mod_adblock`
--

INSERT INTO `mod_adblock` (`id`, `title_en`, `plugin_id`, `start_date`, `end_date`, `total_views_allowed`, `total_clicks_allowed`, `minimum_ctr`, `image`, `image_link`, `image_alt`, `html`, `total_views`, `total_clicks`, `created`) VALUES
(1, 'Default Campaign', 'adblock/wojo-advert', '2014-04-24', '2025-10-01', 0, 0, '0.00', 'BANNER_sg2GlexD6Fnz.png', 'http://wojoscripts.com/', 'Wojo Advert', NULL, 4213, 1282, '2019-03-08 19:56:24');

--
-- Table structure for table `mod_comments`
--

DROP TABLE IF EXISTS `mod_comments`;
CREATE TABLE IF NOT EXISTS `mod_comments` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `comment_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `parent_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `username` varchar(50) DEFAULT NULL,
  `section` varchar(20) NOT NULL,
  `vote_up` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `vote_down` int(11) NOT NULL DEFAULT '0',
  `body` text,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_parent` (`parent_id`),
  KEY `idx_user_id` (`user_id`),
  KEY `idx_comment_id` (`comment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table structure for table `mod_events`
--

DROP TABLE IF EXISTS `mod_events`;
CREATE TABLE IF NOT EXISTS `mod_events` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `title_en` varchar(100) NOT NULL,
  `venue_en` varchar(100) DEFAULT NULL,
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `time_start` time DEFAULT NULL,
  `time_end` time DEFAULT NULL,
  `body_en` text,
  `contact_person` varchar(100) DEFAULT NULL,
  `contact_email` varchar(80) DEFAULT NULL,
  `contact_phone` varchar(24) DEFAULT NULL,
  `color` varchar(7) DEFAULT NULL,
  `active` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table structure for table `mod_faq`
--

DROP TABLE IF EXISTS `mod_faq`;
CREATE TABLE IF NOT EXISTS `mod_faq` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(4) unsigned NOT NULL DEFAULT '0',
  `question_en` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `answer_en` text COLLATE utf8_unicode_ci,
  `sorting` int(6) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `ixd_category` (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='contains f.a.q. data';

--
-- Table structure for table `mod_faq_categories`
--

CREATE TABLE `mod_faq_categories` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `name_en` varchar(50) NOT NULL,
  `sorting` int(6) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table structure for table `mod_faq_categories`
--

DROP TABLE IF EXISTS `mod_faq_categories`;
CREATE TABLE IF NOT EXISTS `mod_faq_categories` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `name_en` varchar(50) CHARACTER SET utf16 NOT NULL,
  `sorting` int(6) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf16;

--
-- Dumping data for table `mod_faq_categories`
--

INSERT INTO `mod_faq_categories` (`id`, `name_en`, `sorting`) VALUES
(1, 'Basics', 1),
(2, 'Syncing', 2),
(3, 'Account', 3),
(4, 'Privacy', 4);

--
-- Table structure for table `mod_gallery`
--

DROP TABLE IF EXISTS `mod_gallery`;
CREATE TABLE IF NOT EXISTS `mod_gallery` (
  `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title_en` varchar(60) NOT NULL,
  `slug_en` varchar(100) DEFAULT NULL,
  `description_en` varchar(100) DEFAULT NULL,
  `thumb_w` smallint(1) UNSIGNED DEFAULT '500',
  `thumb_h` smallint(1) UNSIGNED NOT NULL DEFAULT '500',
  `poster` varchar(60) DEFAULT NULL,
  `cols` smallint(1) UNSIGNED NOT NULL DEFAULT '300',
  `dir` varchar(40) NOT NULL,
  `resize` varchar(30) DEFAULT NULL,
  `watermark` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'ebable watermark',
  `likes` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'enable like',
  `sorting` int(4) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mod_gallery`
--

INSERT INTO `mod_gallery` VALUES(1, 'Album One', 'album-one', '- New gallery module (albums), responsive images different layouts -', 500, 500, 'image_1.jpg', 400, 'album_one', 'thumbnail', 1, 1, 1);
INSERT INTO `mod_gallery` VALUES(2, 'Album Two', 'album-two', NULL, 500, 500, 'image_2.jpg', 300, 'album_two', 'bestFit', 0, 0, 2);
INSERT INTO `mod_gallery` VALUES(3, 'Album Three', 'album-three', NULL, 500, 500, 'image_3.jpg', 400, 'album_three', 'bestFit', 0, 0, 3);
INSERT INTO `mod_gallery` VALUES(4, 'Album Four', 'album-four', NULL, 500, 500, 'image_4.jpg', 400, 'album_four', 'bestFit', 0, 0, 4);

--
-- Table structure for table `mod_gallery_data`
--

DROP TABLE IF EXISTS `mod_gallery_data`;
CREATE TABLE IF NOT EXISTS `mod_gallery_data` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `title_en` varchar(80) NOT NULL,
  `description_en` varchar(200) DEFAULT NULL,
  `thumb` varchar(80) DEFAULT NULL,
  `likes` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `sorting` int(11) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_parent_id` (`parent_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mod_gallery_data`
--

INSERT INTO `mod_gallery_data` VALUES(1, 1, 'Design in a Box', 'Hop duon tioma lumigi nv, if tiela poezio sezononomo fri, semi pleje lingvonomo ac unt.', 'image_1.jpg', 150, 1);
INSERT INTO `mod_gallery_data` VALUES(2, 1, 'Social Vision', 'Hop duon tioma lumigi nv, if tiela poezio sezononomo fri, semi pleje lingvonomo ac unt.', 'image_2.jpg', 226, 2);
INSERT INTO `mod_gallery_data` VALUES(3, 1, 'Planning and Planning', 'Hop duon tioma lumigi nv, if tiela poezio sezononomo fri, semi pleje lingvonomo ac unt.', 'image_3.jpg', 328, 3);
INSERT INTO `mod_gallery_data` VALUES(4, 1, 'Up, up and away', 'Hop duon tioma lumigi nv, if tiela poezio sezononomo fri, semi pleje lingvonomo ac unt.', 'image_4.jpg', 489, 4);
INSERT INTO `mod_gallery_data` VALUES(5, 1, 'Flying Ideas', 'Hop duon tioma lumigi nv, if tiela poezio sezononomo fri, semi pleje lingvonomo ac unt.', 'image_5.jpg', 292, 5);
INSERT INTO `mod_gallery_data` VALUES(6, 1, 'Shopping Touch', 'Hop duon tioma lumigi nv, if tiela poezio sezononomo fri, semi pleje lingvonomo ac unt.', 'image_6.jpg', 544, 6);
INSERT INTO `mod_gallery_data` VALUES(7, 1, 'True Colors', 'Hop duon tioma lumigi nv, if tiela poezio sezononomo fri, semi pleje lingvonomo ac unt.', 'image_7.jpg', 754, 7);
INSERT INTO `mod_gallery_data` VALUES(8, 1, 'Touch the Future', 'Hop duon tioma lumigi nv, if tiela poezio sezononomo fri, semi pleje lingvonomo ac unt.', 'image_8.jpg', 659, 8);
INSERT INTO `mod_gallery_data` VALUES(10, 2, 'Design in a Box', 'Hop duon tioma lumigi nv, if tiela poezio sezononomo fri, semi pleje lingvonomo ac unt.', 'image_1.jpg', 156, 1);
INSERT INTO `mod_gallery_data` VALUES(11, 2, 'Social Vision', 'Hop duon tioma lumigi nv, if tiela poezio sezononomo fri, semi pleje lingvonomo ac unt.', 'image_2.jpg', 225, 2);
INSERT INTO `mod_gallery_data` VALUES(12, 2, 'Planning and Planning', 'Hop duon tioma lumigi nv, if tiela poezio sezononomo fri, semi pleje lingvonomo ac unt.', 'image_3.jpg', 358, 3);
INSERT INTO `mod_gallery_data` VALUES(13, 2, 'Up, up and away', 'Hop duon tioma lumigi nv, if tiela poezio sezononomo fri, semi pleje lingvonomo ac unt.', 'image_4.jpg', 487, 4);
INSERT INTO `mod_gallery_data` VALUES(14, 2, 'Flying Ideas', 'Hop duon tioma lumigi nv, if tiela poezio sezononomo fri, semi pleje lingvonomo ac unt.', 'image_5.jpg', 289, 5);
INSERT INTO `mod_gallery_data` VALUES(15, 2, 'Shopping Touch', 'Hop duon tioma lumigi nv, if tiela poezio sezononomo fri, semi pleje lingvonomo ac unt.', 'image_6.jpg', 541, 6);
INSERT INTO `mod_gallery_data` VALUES(16, 2, 'True Colors', 'Hop duon tioma lumigi nv, if tiela poezio sezononomo fri, semi pleje lingvonomo ac unt.', 'image_7.jpg', 752, 7);
INSERT INTO `mod_gallery_data` VALUES(17, 2, 'Touch the Future', 'Hop duon tioma lumigi nv, if tiela poezio sezononomo fri, semi pleje lingvonomo ac unt.', 'image_8.jpg', 657, 8);
INSERT INTO `mod_gallery_data` VALUES(19, 3, 'Design in a Box', 'Hop duon tioma lumigi nv, if tiela poezio sezononomo fri, semi pleje lingvonomo ac unt.', 'image_1.jpg', 150, 1);
INSERT INTO `mod_gallery_data` VALUES(20, 3, 'Social Vision', 'Hop duon tioma lumigi nv, if tiela poezio sezononomo fri, semi pleje lingvonomo ac unt.', 'image_2.jpg', 647, 2);
INSERT INTO `mod_gallery_data` VALUES(21, 3, 'Planning and Planning', 'Hop duon tioma lumigi nv, if tiela poezio sezononomo fri, semi pleje lingvonomo ac unt.', 'image_3.jpg', 325, 3);
INSERT INTO `mod_gallery_data` VALUES(22, 3, 'Up, up and away', 'Hop duon tioma lumigi nv, if tiela poezio sezononomo fri, semi pleje lingvonomo ac unt.', 'image_4.jpg', 487, 4);
INSERT INTO `mod_gallery_data` VALUES(23, 3, 'Flying Ideas', 'Hop duon tioma lumigi nv, if tiela poezio sezononomo fri, semi pleje lingvonomo ac unt.', 'image_5.jpg', 658, 5);
INSERT INTO `mod_gallery_data` VALUES(24, 3, 'Shopping Touch', 'Hop duon tioma lumigi nv, if tiela poezio sezononomo fri, semi pleje lingvonomo ac unt.', 'image_6.jpg', 541, 6);
INSERT INTO `mod_gallery_data` VALUES(25, 3, 'True Colors', 'Hop duon tioma lumigi nv, if tiela poezio sezononomo fri, semi pleje lingvonomo ac unt.', 'image_7.jpg', 752, 7);
INSERT INTO `mod_gallery_data` VALUES(26, 3, 'Touch the Future', 'Hop duon tioma lumigi nv, if tiela poezio sezononomo fri, semi pleje lingvonomo ac unt.', 'image_8.jpg', 657, 8);
INSERT INTO `mod_gallery_data` VALUES(28, 4, 'Design in a Box', 'Hop duon tioma lumigi nv, if tiela poezio sezononomo fri, semi pleje lingvonomo ac unt.', 'image_1.jpg', 150, 1);
INSERT INTO `mod_gallery_data` VALUES(29, 4, 'Social Vision', 'Hop duon tioma lumigi nv, if tiela poezio sezononomo fri, semi pleje lingvonomo ac unt.', 'image_2.jpg', 225, 2);
INSERT INTO `mod_gallery_data` VALUES(30, 4, 'Planning and Planning', 'Hop duon tioma lumigi nv, if tiela poezio sezononomo fri, semi pleje lingvonomo ac unt.', 'image_3.jpg', 325, 3);
INSERT INTO `mod_gallery_data` VALUES(31, 4, 'Up, up and away', 'Hop duon tioma lumigi nv, if tiela poezio sezononomo fri, semi pleje lingvonomo ac unt.', 'image_4.jpg', 487, 4);
INSERT INTO `mod_gallery_data` VALUES(32, 4, 'Flying Ideas', 'Hop duon tioma lumigi nv, if tiela poezio sezononomo fri, semi pleje lingvonomo ac unt.', 'image_5.jpg', 289, 5);
INSERT INTO `mod_gallery_data` VALUES(33, 4, 'Shopping Touch', 'Hop duon tioma lumigi nv, if tiela poezio sezononomo fri, semi pleje lingvonomo ac unt.', 'image_6.jpg', 541, 6);
INSERT INTO `mod_gallery_data` VALUES(34, 4, 'True Colors', 'Hop duon tioma lumigi nv, if tiela poezio sezononomo fri, semi pleje lingvonomo ac unt.', 'image_7.jpg', 752, 7);
INSERT INTO `mod_gallery_data` VALUES(35, 4, 'Touch the Future', 'Hop duon tioma lumigi nv, if tiela poezio sezononomo fri, semi pleje lingvonomo ac unt.', 'image_8.jpg', 897, 8);

--
-- Table structure for table `mod_gmaps`
--

DROP TABLE IF EXISTS `mod_gmaps`;
CREATE TABLE IF NOT EXISTS `mod_gmaps` (
  `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `plugin_id` varchar(40) DEFAULT NULL,
  `lat` decimal(10,6) NOT NULL DEFAULT '0.000000',
  `lng` decimal(10,6) NOT NULL DEFAULT '0.000000',
  `body` tinytext,
  `zoom` tinyint(1) UNSIGNED NOT NULL DEFAULT '12',
  `minmaxzoom` varchar(5) DEFAULT NULL,
  `layout` varchar(50) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  `type_control` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `streetview` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `style` blob,
  `pin` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mod_gmaps`
--

INSERT INTO `mod_gmaps` VALUES(1, 'Head Office', 'gmaps/head-office', '43.650319', '-79.378860', '1 Adelaide St W, Toronto, ON M5H 1L6, Canada', 14, '1,20', 'muted-blue', 'roadmap', 0, 0, 0x5b0d0a202020207b0d0a2020202020202020226665617475726554797065223a2022616c6c222c0d0a2020202020202020227374796c657273223a205b0d0a2020202020202020202020207b0d0a202020202020202020202020202020202273617475726174696f6e223a20300d0a2020202020202020202020207d2c0d0a2020202020202020202020207b0d0a2020202020202020202020202020202022687565223a202223653765636630220d0a2020202020202020202020207d0d0a20202020202020205d0d0a202020207d2c0d0a202020207b0d0a2020202020202020226665617475726554797065223a2022726f6164222c0d0a2020202020202020227374796c657273223a205b0d0a2020202020202020202020207b0d0a202020202020202020202020202020202273617475726174696f6e223a202d37300d0a2020202020202020202020207d0d0a20202020202020205d0d0a202020207d2c0d0a202020207b0d0a2020202020202020226665617475726554797065223a20227472616e736974222c0d0a2020202020202020227374796c657273223a205b0d0a2020202020202020202020207b0d0a20202020202020202020202020202020227669736962696c697479223a20226f6666220d0a2020202020202020202020207d0d0a20202020202020205d0d0a202020207d2c0d0a202020207b0d0a2020202020202020226665617475726554797065223a2022706f69222c0d0a2020202020202020227374796c657273223a205b0d0a2020202020202020202020207b0d0a20202020202020202020202020202020227669736962696c697479223a20226f6666220d0a2020202020202020202020207d0d0a20202020202020205d0d0a202020207d2c0d0a202020207b0d0a2020202020202020226665617475726554797065223a20227761746572222c0d0a2020202020202020227374796c657273223a205b0d0a2020202020202020202020207b0d0a20202020202020202020202020202020227669736962696c697479223a202273696d706c6966696564220d0a2020202020202020202020207d2c0d0a2020202020202020202020207b0d0a202020202020202020202020202020202273617475726174696f6e223a202d36300d0a2020202020202020202020207d0d0a20202020202020205d0d0a202020207d0d0a5d, 'pin2.png');

--
-- Table structure for table `mod_timeline`
--

DROP TABLE IF EXISTS `mod_timeline`;
CREATE TABLE IF NOT EXISTS `mod_timeline` (
  `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `plugin_id` varchar(25) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `limiter` tinyint(1) UNSIGNED NOT NULL DEFAULT '10',
  `showmore` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `maxitems` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `colmode` varchar(20) DEFAULT 'dual',
  `readmore` varchar(150) DEFAULT NULL,
  `rssurl` varchar(200) DEFAULT NULL,
  `fbid` varchar(150) DEFAULT NULL,
  `fbpage` varchar(150) DEFAULT NULL,
  `fbtoken` varchar(150) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mod_timeline`
--

INSERT INTO `mod_timeline` VALUES(1, 'Blog Timeline', 'timeline/blog', 'blog', 10, 0, 0, 'dual', NULL, '0', NULL, NULL, NULL, '2016-10-28 18:46:39');
INSERT INTO `mod_timeline` VALUES(2, 'Event Timeline', 'timeline/event', 'event', 16, 10, 5, 'dual', NULL, NULL, NULL, NULL, NULL, '2016-10-28 18:46:39');
INSERT INTO `mod_timeline` VALUES(3, 'Rss Timeline', 'timeline/rss', 'rss', 20, 0, 0, 'dual', NULL, 'http://www.thestar.com/feeds.topstories.rss', NULL, NULL, NULL, '2016-10-28 18:46:39');
INSERT INTO `mod_timeline` VALUES(4, 'Portfolio Timeline', 'timeline/portfolio', 'portfolio', 12, 0, 0, 'dual', NULL, NULL, NULL, NULL, NULL, '2016-10-28 18:46:39');
INSERT INTO `mod_timeline` VALUES(6, 'Custom Timeline', 'timeline/custom_timeline', 'custom', 30, 10, 10, 'dual', NULL, NULL, NULL, NULL, NULL, '2016-10-28 18:46:39');

--
-- Table structure for table `mod_timeline_data`
--

DROP TABLE IF EXISTS `mod_timeline_data`;
CREATE TABLE IF NOT EXISTS `mod_timeline_data` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tid` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'timeline id',
  `type` varchar(30) DEFAULT NULL,
  `title_en` varchar(100) DEFAULT NULL,
  `body_en` text,
  `images` blob,
  `dataurl` varchar(250) DEFAULT NULL,
  `height` smallint(3) UNSIGNED NOT NULL DEFAULT '300',
  `readmore` varchar(200) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `tid` (`tid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mod_timeline_data`
--

INSERT INTO `mod_timeline_data` VALUES(5, 6, 'blog_post', 'HTML Support', '<div class="content-center"> <a><i class="twitter big circular inverted success icon link"></i></a> <a><i class="facebook big circular inverted info icon link"></i></a> <a><i class="google plus big circular inverted danger icon link"></i></a> <a><i class="pinterest big circular inverted warning icon link"></i></a> <a><i class="dribbble big circular inverted purple icon link"></i></a> </div>', NULL, NULL, 0, NULL, '2016-01-20 03:28:02');
INSERT INTO `mod_timeline_data` VALUES(6, 6, 'iframe', 'Google Maps', '', NULL, 'https://google.com/maps/embed?pb=!1m14!1m8!1m3!1d5774.551951139716!2d-79.38573735330591!3d43.64242624743821!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x882b34d68bf33a9b%3A0x15edd8c4de1c7581!2sCN+Tower!5e0!3m2!1sen!2sca!4v1422155824800', 300, '', '2016-01-18 16:30:00');
INSERT INTO `mod_timeline_data` VALUES(7, 6, 'iframe', 'Youtube Videos', NULL, NULL, '//youtube.com/embed/YvR8LGOUpNA', 300, NULL, '2016-01-18 04:26:23');
INSERT INTO `mod_timeline_data` VALUES(8, 6, 'blog_post', 'Image Slider', NULL, 0x5b2274696d656c696e655c2f67616c6c6572795f31312e6a7067222c2274696d656c696e655c2f67616c6c6572795f31322e6a7067222c2274696d656c696e655c2f67616c6c6572795f31332e6a7067222c2274696d656c696e655c2f67616c6c6572795f31342e6a7067222c2274696d656c696e655c2f67616c6c6572795f31352e6a7067222c2274696d656c696e655c2f67616c6c6572795f31362e6a7067225d, NULL, 300, NULL, '2016-01-25 04:29:15');
INSERT INTO `mod_timeline_data` VALUES(9, 6, 'gallery', 'Gallery Slider', '', 0x5b2274696d656c696e655c2f67616c6c6572795f31312e6a7067222c2274696d656c696e655c2f67616c6c6572795f31322e6a7067222c2274696d656c696e655c2f67616c6c6572795f31332e6a7067222c2274696d656c696e655c2f67616c6c6572795f31342e6a7067222c2274696d656c696e655c2f67616c6c6572795f31352e6a7067222c2274696d656c696e655c2f67616c6c6572795f31362e6a7067225d, NULL, 300, '', '2016-01-22 05:08:26');
INSERT INTO `mod_timeline_data` VALUES(10, 6, 'blog_post', 'Single Image Only', NULL, 0x5b2274696d656c696e652f64656d6f5f696d6167655f342e6a7067225d, NULL, 0, NULL, '2015-01-24 00:45:21');
INSERT INTO `mod_timeline_data` VALUES(11, 6, 'blog_post', 'Single Image With Text', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sodales dapibus dui, sed iaculis metus facilisis sed. Curae; Pellentesque ullamcorper nisl id justo ultrices hendrerit', 0x5b2274696d656c696e652f64656d6f5f696d6167655f322e6a7067225d, NULL, 0, NULL, '2015-01-23 03:20:29');
INSERT INTO `mod_timeline_data` VALUES(12, 6, 'blog_post', 'Single Image With Read More', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sodales dapibus dui, sed iaculis metus facilisis sed. Curae; Pellentesque ullamcorper nisl id justo ultrices hendrerit</p>', 0x5b2274696d656c696e652f64656d6f5f696d6167655f332e6a7067225d, NULL, 300, '//wojoscripts.com', '2015-01-20 16:30:00');
INSERT INTO `mod_timeline_data` VALUES(13, 6, 'blog_post', 'Text Only', 'Duis dapibus aliquam mi, eget euismod sem scelerisque ut. Vivamus at elit quis urna adipiscing iaculis. Curabitur vitae velit in neque dictum blandit. Proin in iaculis neque. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Curabitur vitae velit in neque dictum blandit. Proin in iaculis neque. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas<br><br>Duis dapibus aliquam mi, eget euismod sem scelerisque ut. Vivamus at elit quis urna adipiscing iaculis. Curabitur vitae velit in neque dictum blandit. Proin in iaculis neque. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Curabitur vitae velit in neque dictum blandit. Proin in iaculis neque. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas', NULL, NULL, 0, NULL, '2015-01-22 03:24:25');
INSERT INTO `mod_timeline_data` VALUES(14, 6, 'blog_post', 'HTML Support', '<div class="content-center"> <a><i class="twitter big circular inverted green icon link"></i></a> <a><i class="facebook big circular inverted blue icon link"></i></a> <a><i class="google plus big circular inverted red icon link"></i></a> <a><i class="pinterest big circular inverted orange icon link"></i></a> <a><i class="dribbble big circular inverted purple icon url alt link"></i></a> </div>', NULL, NULL, 0, NULL, '2015-01-20 03:28:02');
INSERT INTO `mod_timeline_data` VALUES(15, 6, 'iframe', 'Google Maps', NULL, NULL, 'https://google.com/maps/embed?pb=!1m14!1m8!1m3!1d5774.551951139716!2d-79.38573735330591!3d43.64242624743821!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x882b34d68bf33a9b%3A0x15edd8c4de1c7581!2sCN+Tower!5e0!3m2!1sen!2sca!4v1422155824800', 300, NULL, '2015-01-19 03:44:22');
INSERT INTO `mod_timeline_data` VALUES(16, 6, 'iframe', 'Youtube Videos', NULL, NULL, '//youtube.com/embed/YvR8LGOUpNA', 300, NULL, '2015-01-18 04:26:23');
INSERT INTO `mod_timeline_data` VALUES(17, 6, 'blog_post', 'Image Slider', '', 0x5b2274696d656c696e655c2f67616c6c6572795f31312e6a7067222c2274696d656c696e655c2f67616c6c6572795f31322e6a7067222c2274696d656c696e655c2f67616c6c6572795f31332e6a7067222c2274696d656c696e655c2f67616c6c6572795f31342e6a7067222c2274696d656c696e655c2f67616c6c6572795f31352e6a7067222c2274696d656c696e655c2f67616c6c6572795f31362e6a7067225d, NULL, 300, '', '2015-01-24 16:30:00');
INSERT INTO `mod_timeline_data` VALUES(18, 6, 'gallery', 'Gallery Slider', NULL, 0x5b2274696d656c696e655c2f67616c6c6572795f31312e6a7067222c2274696d656c696e655c2f67616c6c6572795f31322e6a7067222c2274696d656c696e655c2f67616c6c6572795f31332e6a7067222c2274696d656c696e655c2f67616c6c6572795f31342e6a7067222c2274696d656c696e655c2f67616c6c6572795f31352e6a7067222c2274696d656c696e655c2f67616c6c6572795f31362e6a7067225d, NULL, 300, NULL, '2015-01-22 05:08:26');
INSERT INTO `mod_timeline_data` VALUES(19, 6, 'blog_post', 'Single Image Only', NULL, 0x5b2274696d656c696e652f64656d6f5f696d6167655f342e6a7067225d, NULL, 0, NULL, '2014-01-24 00:45:21');
INSERT INTO `mod_timeline_data` VALUES(20, 6, 'blog_post', 'Single Image With Text', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sodales dapibus dui, sed iaculis metus facilisis sed. Curae; Pellentesque ullamcorper nisl id justo ultrices hendrerit', 0x5b2274696d656c696e652f64656d6f5f696d6167655f322e6a7067225d, NULL, 0, NULL, '2014-01-23 03:20:29');
INSERT INTO `mod_timeline_data` VALUES(21, 6, 'blog_post', 'Single Image With Read More', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sodales dapibus dui, sed iaculis metus facilisis sed. Curae; Pellentesque ullamcorper nisl id justo ultrices hendrerit', 0x5b2274696d656c696e652f64656d6f5f696d6167655f332e6a7067225d, NULL, 0, '//wojoscripts.com', '2014-01-21 03:25:30');
INSERT INTO `mod_timeline_data` VALUES(22, 6, 'blog_post', 'Text Only', 'Duis dapibus aliquam mi, eget euismod sem scelerisque ut. Vivamus at elit quis urna adipiscing iaculis. Curabitur vitae velit in neque dictum blandit. Proin in iaculis neque. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Curabitur vitae velit in neque dictum blandit. Proin in iaculis neque. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas<br><br>Duis dapibus aliquam mi, eget euismod sem scelerisque ut. Vivamus at elit quis urna adipiscing iaculis. Curabitur vitae velit in neque dictum blandit. Proin in iaculis neque. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Curabitur vitae velit in neque dictum blandit. Proin in iaculis neque. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas', NULL, NULL, 0, NULL, '2014-01-22 03:24:25');
INSERT INTO `mod_timeline_data` VALUES(23, 6, 'blog_post', 'HTML Support', '<div class="content-center"> <a><i class="twitter big circular inverted green icon link"></i></a> <a><i class="facebook big circular inverted blue icon link"></i></a> <a><i class="google plus big circular inverted red icon link"></i></a> <a><i class="pinterest big circular inverted orange icon link"></i></a> <a><i class="dribbble big circular inverted purple icon url alt link"></i></a> </div>', NULL, NULL, 0, NULL, '2014-01-20 03:28:02');
INSERT INTO `mod_timeline_data` VALUES(24, 6, 'iframe', 'Google Maps', NULL, NULL, 'https://google.com/maps/embed?pb=!1m14!1m8!1m3!1d5774.551951139716!2d-79.38573735330591!3d43.64242624743821!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x882b34d68bf33a9b%3A0x15edd8c4de1c7581!2sCN+Tower!5e0!3m2!1sen!2sca!4v1422155824800', 300, NULL, '2014-01-19 03:44:22');
INSERT INTO `mod_timeline_data` VALUES(25, 6, 'iframe', 'Youtube Videos', NULL, NULL, '//youtube.com/embed/YvR8LGOUpNA', 300, NULL, '2014-01-18 04:26:23');
INSERT INTO `mod_timeline_data` VALUES(26, 6, 'blog_post', 'Image Slider', NULL, 0x5b2274696d656c696e655c2f67616c6c6572795f31312e6a7067222c2274696d656c696e655c2f67616c6c6572795f31322e6a7067222c2274696d656c696e655c2f67616c6c6572795f31332e6a7067222c2274696d656c696e655c2f67616c6c6572795f31342e6a7067222c2274696d656c696e655c2f67616c6c6572795f31352e6a7067222c2274696d656c696e655c2f67616c6c6572795f31362e6a7067225d, NULL, 300, NULL, '2014-01-25 04:29:15');
INSERT INTO `mod_timeline_data` VALUES(27, 6, 'gallery', 'Gallery Slider', NULL, 0x5b2274696d656c696e655c2f67616c6c6572795f31312e6a7067222c2274696d656c696e655c2f67616c6c6572795f31322e6a7067222c2274696d656c696e655c2f67616c6c6572795f31332e6a7067222c2274696d656c696e655c2f67616c6c6572795f31342e6a7067222c2274696d656c696e655c2f67616c6c6572795f31352e6a7067222c2274696d656c696e655c2f67616c6c6572795f31362e6a7067225d, NULL, 300, NULL, '2014-01-22 05:08:26');

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title_en` varchar(200) NOT NULL,
  `slug_en` varchar(150) DEFAULT NULL,
  `caption_en` varchar(150) DEFAULT NULL,
  `is_admin` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `page_type` enum('normal','home','contact','login','activate','account','register','search','sitemap','profile','policy') NOT NULL DEFAULT 'normal',
  `membership_id` varchar(20) NOT NULL DEFAULT '0',
  `is_comments` tinyint(1) NOT NULL DEFAULT '0',
  `custom_bg_en` varchar(100) DEFAULT NULL,
  `show_header` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `theme` varchar(60) DEFAULT NULL,
  `access` enum('Public','Registered','Membership') NOT NULL DEFAULT 'Public',
  `body_en` text,
  `jscode` text,
  `keywords_en` varchar(200) DEFAULT NULL,
  `description_en` text,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `created_by_name` varchar(80) DEFAULT NULL,
  `is_system` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `active` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title_en`, `slug_en`, `caption_en`, `is_admin`, `page_type`, `membership_id`, `is_comments`, `custom_bg_en`, `show_header`, `theme`, `access`, `body_en`, `jscode`, `keywords_en`, `description_en`, `created`, `created_by`, `created_by_name`, `is_system`, `active`) VALUES(1, 'Welcome To Cms pro', 'home', '', 1, 'home', '0', 0, '', 0, NULL, 'Public', '<div class=\"section overlay secondary fvh\" style=\"background-image: url([SITEURL]/uploads/images/laguna/laguna_slider-img-1.jpg);background-repeat: no-repeat;background-size:cover;background-position: top center;\">\r\n  <div class=\"wojo-grid\">\r\n    <div class=\"row gutters align middle fvh\">\r\n<div class=\"columns screen-50 tablet-60 mobile-100 phone-100\">\r\n  <div data-weditable=\"true\">\r\n<span class=\"wojo transparent label\">Who Are We</span>\r\n<h1 class=\"wojo white text margin top\">We Do Your Web Designs Carefully. </h1>\r\n<p class=\"wojo white dimmed text\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. </p>\r\n<div class=\"padding top\">\r\n  <a href=\"#!\" data-type=\"button\" class=\"wojo primary big right button\">Get Started<i class=\"icon long arrow right\"></i></a>\r\n</div>\r\n  </div>\r\n</div>\r\n    </div>\r\n  </div>\r\n</div>\r\n<div class=\"section overlay white\" style=\"background-image: url([SITEURL]/uploads/images/laguna/laguna_about-bg-img.jpg);background-repeat: no-repeat;background-size:cover;background-position: top center;padding:96px 0 64px 0\">\r\n  <div class=\"wojo-grid\">\r\n    <div class=\"row gutters align middle\">\r\n<div class=\"columns mobile-100 phone-100\">\r\n  <div data-weditable=\"true\">\r\n<span class=\"wojo primary inverted label\">WHO WE ARE</span>\r\n<h4 class=\"margin top\">We Are Professional Designer & Developer </h4>\r\n<p>Want to create your dream website? Then meet our professional team. Business, Health, Medicine, Agency, E commerce, Portfolio, One Page, Business Cards, Panels, Statistical Panels, Billboards and invitations with you at your service. </p>\r\n<blockquote>\r\n  <p>\r\n    \"We have been devoted to design for many years, our goal is to advance design and visuality and produce new styles.\"\r\n  </p>\r\n  <strong>Ceo founder - By Adrian Salves</strong>\r\n</blockquote>\r\n<a href=\"#!\" data-type=\"button\" class=\"wojo primary big right button\">Read More<i class=\"icon long arrow right\"></i></a>\r\n  </div>\r\n</div>\r\n<div class=\"columns mobile-100 phone-100\">\r\n  <figure class=\"wojo image\" data-weditable=\"true\">\r\n<div class=\"wojo primary badge\">\r\n  <span class=\"year\">15yr</span>\r\n  <span class=\"text\">EXPERIENCE</span>\r\n</div>\r\n<a href=\"http://vimeo.com/75976293\" data-wbox=\"video\" class=\"wojo huge circular primary player icon button middle attached lightbox\" data-type=\"button\"><i class=\"icon play\"></i></a>\r\n<img src=\"[SITEURL]/uploads/images/laguna/laguna_about-img.jpg\" alt=\"Image Description\"></figure>\r\n</div>\r\n    </div>\r\n  </div>\r\n</div>\r\n<div class=\"section\" style=\"padding:96px 0 64px 0\">\r\n  <div class=\"wojo-grid\">\r\n    <div class=\"row gutters align center\">\r\n<div class=\"columns screen-50 tablet-70 mobile-100 phone-100\">\r\n  <div data-weditable=\"true\" class=\"center aligned\">\r\n<span class=\"wojo primary inverted label\">What We Do</span>\r\n<h3 class=\"divided margin top\">Our <span class=\"wojo primary text\">Services</span></h3>\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>\r\n  </div>\r\n</div>\r\n    </div>\r\n    <div class=\"row gutters\">\r\n<div class=\"columns\">\r\n  <div class=\"wojo link full basic cards screen-3 tablet-3 mobile-2 phone-1\">\r\n<div class=\"card\" data-weditable=\"true\">\r\n  <div class=\"content\">\r\n  <figure class=\"wojo notification image margin bottom\"><img src=\"[SITEURL]/uploads/images/laguna/icon_01.svg\" alt=\"image Description\"></figure>\r\n    <h5>UI Design</h5>\r\n    <p class=\"big bottom margin\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum</p>\r\n    <a href=\"#!\" data-type=\"button\" class=\"wojo primary big right button\">Get Started<i class=\"icon long arrow right\"></i></a>\r\n  </div>\r\n</div>\r\n<div class=\"card\" data-weditable=\"true\">\r\n  <div class=\"content\">\r\n  <figure class=\"wojo notification image margin bottom\"><img src=\"[SITEURL]/uploads/images/laguna/icon_02.svg\" alt=\"image Description\"></figure>\r\n    <h5>Seo Optimization</h5>\r\n    <p class=\"big bottom margin\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum</p>\r\n    <a href=\"#!\" data-type=\"button\" class=\"wojo primary big right button\">Get Started<i class=\"icon long arrow right\"></i></a>\r\n  </div>\r\n</div>\r\n<div class=\"card\" data-weditable=\"true\">\r\n  <div class=\"content\">\r\n  <figure class=\"wojo notification image margin bottom\"><img src=\"[SITEURL]/uploads/images/laguna/icon_03.svg\" alt=\"image Description\"></figure>\r\n    <h5>Wireframe Design</h5>\r\n    <p class=\"big bottom margin\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum</p>\r\n    <a href=\"#!\" data-type=\"button\" class=\"wojo primary big right button\">Get Started<i class=\"icon long arrow right\"></i></a>\r\n  </div>\r\n</div>\r\n<div class=\"card\" data-weditable=\"true\">\r\n  <div class=\"content\">\r\n  <figure class=\"wojo notification image margin bottom\"><img src=\"[SITEURL]/uploads/images/laguna/icon_04.svg\" alt=\"image Description\"></figure>\r\n    <h5>Graphic Design</h5>\r\n    <p class=\"big bottom margin\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum</p>\r\n    <a href=\"#!\" data-type=\"button\" class=\"wojo primary big right button\">Get Started<i class=\"icon long arrow right\"></i></a>\r\n  </div>\r\n</div>\r\n<div class=\"card\" data-weditable=\"true\">\r\n  <div class=\"content\">\r\n  <figure class=\"wojo notification image margin bottom\"><img src=\"[SITEURL]/uploads/images/laguna/icon_05.svg\" alt=\"image Description\"></figure>\r\n    <h5>App Design</h5>\r\n    <p class=\"big bottom margin\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum</p>\r\n    <a href=\"#!\" data-type=\"button\" class=\"wojo primary big right button\">Get Started<i class=\"icon long arrow right\"></i></a>\r\n  </div>\r\n</div>\r\n<div class=\"card\" data-weditable=\"true\">\r\n  <div class=\"content\">\r\n  <figure class=\"wojo notification image margin bottom\"><img src=\"[SITEURL]/uploads/images/laguna/icon_06.svg\" alt=\"image Description\"></figure>\r\n    <h5>Web Design</h5>\r\n    <p class=\"big bottom margin\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum</p>\r\n    <a href=\"#!\" data-type=\"button\" class=\"wojo primary big right button\">Get Started<i class=\"icon long arrow right\"></i></a>\r\n  </div>\r\n</div>\r\n  </div>\r\n</div>\r\n    </div>\r\n  </div>\r\n</div>\r\n<div class=\"section\" style=\"padding:96px 0 64px 0\">\r\n  <div class=\"wojo-grid\">\r\n    <div class=\"row gutters align center\">\r\n<div class=\"columns screen-50 tablet-70 mobile-100 phone-100\">\r\n  <div data-weditable=\"true\" class=\"center aligned\">\r\n<span class=\"wojo primary inverted label\">How We Work</span>\r\n<h3 class=\"divided margin top\">Work <span class=\"wojo primary text\">Process</span></h3>\r\n<p>This is where we really begin to visualize your napkin sketches and make them into beautiful pixels.</p>\r\n  </div>\r\n</div>\r\n    </div>\r\n    <div class=\"row gutters\">\r\n<div class=\"columns mobile-100 phone-100\">\r\n  <div class=\"wojo full simple basic attached card\" data-weditable=\"true\">\r\n<div class=\"content center aligned\">\r\n  <figure class=\"wojo notification image margin bottom\"><img src=\"[SITEURL]/uploads/images/laguna/icon_07.svg\" alt=\"image Description\"></figure>\r\n  <div class=\"wojo huge primary bold text\">01</div>\r\n  <h6 class=\"margin top\">Thinking</h6>\r\n  <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form. </p>\r\n</div>\r\n  </div>\r\n</div>\r\n<div class=\"columns mobile-100 phone-100\">\r\n  <div class=\"wojo full basic attached card\" data-weditable=\"true\">\r\n<div class=\"content center aligned\">\r\n  <figure class=\"wojo notification image margin bottom\"><img src=\"[SITEURL]/uploads/images/laguna/icon_08.svg\" alt=\"image Description\"></figure>\r\n  <div class=\"wojo huge primary bold text\">02</div>\r\n  <h6 class=\"margin top\">Research</h6>\r\n  <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form. </p>\r\n</div>\r\n  </div>\r\n</div>\r\n<div class=\"columns mobile-100 phone-100\">\r\n  <div class=\"wojo full simple basic attached card\" data-weditable=\"true\">\r\n<div class=\"content center aligned\">\r\n  <figure class=\"wojo notification image margin bottom\"><img src=\"[SITEURL]/uploads/images/laguna/icon_09.svg\" alt=\"image Description\"></figure>\r\n  <div class=\"wojo huge primary bold text\">03</div>\r\n  <h6 class=\"margin top\">Design</h6>\r\n  <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form. </p>\r\n</div>\r\n  </div>\r\n</div>\r\n    </div>\r\n  </div>\r\n</div>\r\n<div class=\"section\" style=\"padding:96px 0 64px 0\">\r\n  <div class=\"wojo-grid\">\r\n    <div class=\"row gutters align center\">\r\n<div class=\"columns screen-50 tablet-70 mobile-100 phone-100\">\r\n  <div data-weditable=\"true\" class=\"center aligned\">\r\n<span class=\"wojo primary inverted label\">Portfolio</span>\r\n<h3 class=\"divided margin top\">Our <span class=\"wojo primary text\">Works</span></h3>\r\n<p>Now that we\'ve aligned the details, it\'s time to get things mapped out and organized.</p>\r\n  </div>\r\n</div>\r\n    </div>\r\n    <div class=\"row gutters\">\r\n<div class=\"columns\"> %%portfolio/simple|plugin|0|38%% </div>\r\n    </div>\r\n  </div>\r\n</div>\r\n<div class=\"section overlay secondary\" style=\"background-image: url([SITEURL]/uploads/images/laguna/laguna_counter-bg.jpg);background-repeat: no-repeat;background-size:cover;background-position: top center;padding:96px 0 64px 0\">\r\n  <div class=\"wojo-grid\">\r\n    <div class=\"row gutters align middle spaced\">\r\n<div class=\"columns screen-50 tablet-60 mobile-100 phone-100\">\r\n  <div data-weditable=\"true\">\r\n<h4 class=\"wojo white text\">Take advantage of our experience</h4>\r\n  </div>\r\n</div>\r\n<div class=\"columns auto mobile-100 phone-100\">\r\n  <div data-weditable=\"true\">\r\n<a href=\"#!\" data-type=\"button\" class=\"wojo primary big right button\">Read More<i class=\"icon long arrow right\"></i></a>\r\n  </div>\r\n</div>\r\n    </div>\r\n    <div class=\"row grid gutters screen-4 tablet-4 mobile-2 phone-1\">\r\n<div class=\"columns\">\r\n  <div class=\"wojo basic card\" data-weditable=\"true\">\r\n<div class=\"content center aligned\">\r\n  <figure class=\"wojo notification image margin bottom\">\r\n    <img src=\"[SITEURL]/uploads/images/laguna/icon_10.svg\" alt=\"image Description\"></figure>\r\n  <h6>Projects</h6>\r\n  <span class=\"wojo huge demi primary text\">2500</span></div>\r\n  </div>\r\n</div>\r\n<div class=\"columns\">\r\n  <div class=\"wojo basic card\" data-weditable=\"true\">\r\n<div class=\"content center aligned\">\r\n  <figure class=\"wojo notification image margin bottom\">\r\n    <img src=\"[SITEURL]/uploads/images/laguna/icon_11.svg\" alt=\"image Description\"></figure>\r\n  <h6>Happy Clients</h6>\r\n  <span class=\"wojo huge demi primary text\"> 750 </span></div>\r\n  </div>\r\n</div>\r\n<div class=\"columns\">\r\n  <div class=\"wojo basic card\" data-weditable=\"true\">\r\n<div class=\"content center aligned\">\r\n  <figure class=\"wojo notification image margin bottom\">\r\n    <img src=\"[SITEURL]/uploads/images/laguna/icon_12.svg\" alt=\"image Description\"></figure>\r\n  <h6>Visitors</h6>\r\n  <span class=\"wojo huge demi primary text\">20500</span></div>\r\n  </div>\r\n</div>\r\n<div class=\"columns\">\r\n  <div class=\"wojo basic card\" data-weditable=\"true\">\r\n<div class=\"content center aligned\">\r\n  <figure class=\"wojo notification image margin bottom\">\r\n    <img src=\"[SITEURL]/uploads/images/laguna/icon_13.svg\" alt=\"image Description\"></figure>\r\n  <h6>Awards Won</h6>\r\n  <span class=\"wojo huge demi primary text\">3000</span></div>\r\n  </div>\r\n</div>\r\n    </div>\r\n  </div>\r\n</div>\r\n<div class=\"section\" style=\"padding:96px 0 64px 0\">\r\n  <div class=\"wojo-grid\">\r\n    <div class=\"row gutters align center\">\r\n<div class=\"columns screen-50 tablet-70 mobile-100 phone-100\">\r\n  <div data-weditable=\"true\" class=\"center aligned\">\r\n<span class=\"wojo primary inverted label\">Team</span>\r\n<h3 class=\"divided margin top\">Our <span class=\"wojo primary text\">Team</span></h3>\r\n<p>We strive to embrace and drive change in our industry which allows us to keep our clients relevant.</p>\r\n  </div>\r\n</div>\r\n    </div>\r\n    <div class=\"row grid gutters screen-4 tablet-4 mobile-2 phone-1\">\r\n<div class=\"columns\">\r\n  <div class=\"wojo basic full attached card\" data-weditable=\"true\">\r\n<figure class=\"wojo fluid rounded masked image\">\r\n  <img src=\"[SITEURL]/uploads/images/laguna/laguna_team_01.jpg\" alt=\"image Description\"></figure>\r\n<div class=\"horizontal padding center aligned\">\r\n  <h5>Dana Thomas</h5>\r\n  <div class=\"wojo primary demi text\">Web Designer</div>\r\n</div>\r\n<div class=\"footer center aligned\">\r\n  <a href=\"#!\" data-type=\"button\" class=\"wojo white icon button\"><i class=\"icon facebook\"></i></a>\r\n  <a href=\"#!\" data-type=\"button\" class=\"wojo white icon button\"><i class=\"icon twitter\"></i></a>\r\n  <a href=\"#!\" data-type=\"button\" class=\"wojo white icon button\"><i class=\"icon instagram\"></i></a>\r\n</div>\r\n  </div>\r\n</div>\r\n<div class=\"columns\">\r\n  <div class=\"wojo basic full attached card\" data-weditable=\"true\">\r\n<figure class=\"wojo fluid rounded masked image\">\r\n  <img src=\"[SITEURL]/uploads/images/laguna/laguna_team_02.jpg\" alt=\"image Description\"></figure>\r\n<div class=\"horizontal padding center aligned\">\r\n  <h5>Lorenzo Cinque</h5>\r\n  <div class=\"wojo primary demi text\">Customer Support</div>\r\n</div>\r\n<div class=\"footer center aligned\">\r\n  <a href=\"#!\" data-type=\"button\" class=\"wojo white icon button\"><i class=\"icon facebook\"></i></a>\r\n  <a href=\"#!\" data-type=\"button\" class=\"wojo white icon button\"><i class=\"icon twitter\"></i></a>\r\n  <a href=\"#!\" data-type=\"button\" class=\"wojo white icon button\"><i class=\"icon instagram\"></i></a>\r\n</div>\r\n  </div>\r\n</div>\r\n<div class=\"columns\">\r\n  <div class=\"wojo basic full attached card\" data-weditable=\"true\">\r\n<figure class=\"wojo fluid rounded masked image\">\r\n  <img src=\"[SITEURL]/uploads/images/laguna/laguna_team_03.jpg\" alt=\"image Description\"></figure>\r\n<div class=\"horizontal padding center aligned\">\r\n  <h5>Tina Brown</h5>\r\n  <div class=\"wojo primary demi text\">Sales consultant</div>\r\n</div>\r\n<div class=\"footer center aligned\">\r\n  <a href=\"#!\" data-type=\"button\" class=\"wojo white icon button\"><i class=\"icon facebook\"></i></a>\r\n  <a href=\"#!\" data-type=\"button\" class=\"wojo white icon button\"><i class=\"icon twitter\"></i></a>\r\n  <a href=\"#!\" data-type=\"button\" class=\"wojo white icon button\"><i class=\"icon instagram\"></i></a>\r\n</div>\r\n  </div>\r\n</div>\r\n<div class=\"columns\">\r\n  <div class=\"wojo basic full attached card\" data-weditable=\"true\">\r\n<figure class=\"wojo fluid rounded masked image\">\r\n  <img src=\"[SITEURL]/uploads/images/laguna/laguna_team_04.jpg\" alt=\"image Description\"></figure>\r\n<div class=\"horizontal padding center aligned\">\r\n  <h5>Adrian Jones</h5>\r\n  <div class=\"wojo primary demi text\">Web Developer</div>\r\n</div>\r\n<div class=\"footer center aligned\">\r\n  <a href=\"#!\" data-type=\"button\" class=\"wojo white icon button\"><i class=\"icon facebook\"></i></a>\r\n  <a href=\"#!\" data-type=\"button\" class=\"wojo white icon button\"><i class=\"icon twitter\"></i></a>\r\n  <a href=\"#!\" data-type=\"button\" class=\"wojo white icon button\"><i class=\"icon instagram\"></i></a>\r\n</div>\r\n  </div>\r\n</div>\r\n    </div>\r\n  </div>\r\n</div>\r\n<div class=\"section\" style=\"background-color:#f2f2fe;padding:96px 0 64px 0\">\r\n  <div class=\"wojo-grid\">\r\n    <div class=\"row big gutters align center\">\r\n<div class=\"columns screen-60 tablet-80 mobile-100 phone-100\">\r\n  <div data-weditable=\"true\" class=\"center aligned\">\r\n<span class=\"wojo primary inverted label\">Testimonials</span>\r\n<h3 class=\"divided margin top\">What Our <span class=\"wojo primary text\">Clients Say?</span></h3>\r\n<p>Staying focused allows us to turn every project we complete into something we love.</p>\r\n  </div>\r\n</div>\r\n    </div>\r\n    <div class=\"row gutters\">\r\n<div class=\"columns\">%%carousel/testimonials|plugin|1|23%%</div>\r\n    </div>\r\n  </div>\r\n</div>\r\n<div class=\"section\" style=\"padding:96px 0 64px 0\">\r\n  <div class=\"wojo-grid\">\r\n    <div class=\"row big gutters align center\">\r\n<div class=\"columns screen-50 tablet-70 mobile-100 phone-100\">\r\n  <div data-weditable=\"true\" class=\"center aligned\">\r\n<span class=\"wojo primary inverted label\">Pricing</span>\r\n<h3 class=\"divided margin top\">Our <span class=\"wojo primary text\">Pricing</span></h3>\r\n<p>Staying focused allows us to turn every project we complete into something we love.</p>\r\n  </div>\r\n</div>\r\n    </div>\r\n    <div class=\"row gutters\">\r\n<div class=\"columns mobile-100 phone-100\">\r\n  <div class=\"wojo simple basic attached card\" data-weditable=\"true\">\r\n<div class=\"content center aligned\">\r\n  <h5>Basic</h5>\r\n  <figure class=\"wojo medium image\">\r\n    <img src=\"[SITEURL]/uploads/images/laguna/laguna_hosting.svg\" alt=\"image Description\"></figure>\r\n  <div class=\"vertical margin\">\r\n    <span class=\"wojo bold huge text\">$39</span>\r\n    <span class=\"wojo dimmed text\">monthly</span>\r\n  </div>\r\n  <div class=\"wojo fluid relaxed list big margin bottom\">\r\n    <div class=\"item align center\">1 Gb Diskspace</div>\r\n    <div class=\"item align center\">10 Gb Bandwith</div>\r\n    <div class=\"item align center\">2 Email Adress</div>\r\n    <div class=\"item align center\">Cms Pro Installs</div>\r\n    <div class=\"item align center\">Private Support</div>\r\n  </div>\r\n  <a href=\"#!\" data-type=\"button\" class=\"wojo primary right button fluid\">Read More<i class=\"icon long arrow right\"></i></a>\r\n</div>\r\n  </div>\r\n</div>\r\n<div class=\"columns mobile-100 phone-100\">\r\n  <div class=\"wojo basic attached card\" data-weditable=\"true\">\r\n<div class=\"wojo bookmark\">Popular</div>\r\n<div class=\"content center aligned\">\r\n  <h5>Premium</h5>\r\n  <figure class=\"wojo medium image\">\r\n    <img src=\"[SITEURL]/uploads/images/laguna/laguna_hosting.svg\" alt=\"image Description\"></figure>\r\n  <div class=\"vertical margin\">\r\n    <span class=\"wojo bold huge text\">$49</span>\r\n    <span class=\"wojo dimmed text\">monthly</span>\r\n  </div>\r\n  <div class=\"wojo fluid relaxed list big margin bottom\">\r\n    <div class=\"item align center\">4 Gb Diskspace</div>\r\n    <div class=\"item align center\">50 Gb Bandwith</div>\r\n    <div class=\"item align center\">4 Email Adress</div>\r\n    <div class=\"item align center\">Cms Pro Installs</div>\r\n    <div class=\"item align center\">Private Support</div>\r\n  </div>\r\n  <a href=\"#!\" data-type=\"button\" class=\"wojo primary right button fluid\">Read More<i class=\"icon long arrow right\"></i></a>\r\n</div>\r\n  </div>\r\n</div>\r\n<div class=\"columns mobile-100 phone-100\">\r\n  <div class=\"wojo simple basic attached card\" data-weditable=\"true\">\r\n<div class=\"content center aligned\">\r\n  <h5>Business</h5>\r\n  <figure class=\"wojo medium image\">\r\n    <img src=\"[SITEURL]/uploads/images/laguna/laguna_hosting.svg\" alt=\"image Description\"></figure>\r\n  <div class=\"vertical margin\">\r\n    <span class=\"wojo bold huge text\">$54</span>\r\n    <span class=\"wojo dimmed text\">monthly</span>\r\n  </div>\r\n  <div class=\"wojo fluid relaxed list big margin bottom\">\r\n    <div class=\"item align center\">20 Gb Diskspace</div>\r\n    <div class=\"item align center\">100 Gb Bandwith</div>\r\n    <div class=\"item align center\">10 Email Adress</div>\r\n    <div class=\"item align center\">Cms Pro Installs</div>\r\n    <div class=\"item align center\">Private Support</div>\r\n  </div>\r\n  <a href=\"#!\" data-type=\"button\" class=\"wojo primary right button fluid\">Read More<i class=\"icon long arrow right\"></i></a>\r\n</div>\r\n  </div>\r\n</div>\r\n    </div>\r\n  </div>\r\n</div>\r\n<div class=\"section\" style=\"background-color:#ecf0f8;padding:96px 0 64px 0\">\r\n  <div class=\"wojo-grid\">\r\n    <div class=\"row big gutters align center\">\r\n<div class=\"columns screen-60 tablet-80 mobile-100 phone-100\">\r\n  <div data-weditable=\"true\" class=\"center aligned\">\r\n<span class=\"wojo secondary label\">Blog</span>\r\n<h3 class=\"divided margin top\">Latest  <span class=\"wojo primary text\">News</span></h3>\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>\r\n  </div>\r\n</div>\r\n    </div>\r\n    <div class=\"row gutters\">\r\n<div class=\"columns\">%%blog/carousel|plugin|0|42%%</div>\r\n    </div>\r\n  </div>\r\n</div>', '\"\"', 'builder,mistaken,idea,denouncing,pleasure,praising,pain,give,complete,account,system,expound,actual,teachings,explorer,truth,master,human,happiness', 'Cms pro is a web content management system made for the peoples who don&#39;t have much technical knowledge of HTML or PHP but know how to use a simple notepad with computer keyboard', '2014-01-28 04:11:36', 1, 'Web Master', 1, 1);
INSERT INTO `pages` (`id`, `title_en`, `slug_en`, `caption_en`, `is_admin`, `page_type`, `membership_id`, `is_comments`, `custom_bg_en`, `show_header`, `theme`, `access`, `body_en`, `jscode`, `keywords_en`, `description_en`, `created`, `created_by`, `created_by_name`, `is_system`, `active`) VALUES(2, 'A few words about us', 'what-is-cms-pro', 'About Us', 0, 'normal', '0', 0, '', 1, NULL, 'Public', '<div class=\"section overlay white\" style=\"background-image: url([SITEURL]/uploads/images/laguna/laguna_about-bg-img.jpg);background-repeat: no-repeat;background-size:cover;background-position: top center;padding:96px 0 64px 0\">\r\n  <div class=\"wojo-grid\">\r\n    <div class=\"row gutters align middle\">\r\n<div class=\"columns mobile-100 phone-100\">\r\n  <div data-weditable=\"true\">\r\n<span class=\"wojo primary inverted label\">WHO WE ARE</span>\r\n<h4 class=\"margin top\">We Are Professional Designer & Developer </h4>\r\n<p>Want to create your dream website? Then meet our professional team. Business, Health, Medicine, Agency, E commerce, Portfolio, One Page, Business Cards, Panels, Statistical Panels, Billboards and invitations with you at your service. </p>\r\n<blockquote>\r\n  <p>\r\n    \"We have been devoted to design for many years, our goal is to advance design and visuality and produce new styles.\"\r\n  </p>\r\n  <strong>Ceo founder - By Adrian Salves</strong>\r\n</blockquote>\r\n<a href=\"#!\" data-type=\"button\" class=\"wojo primary big right button\">Read More<i class=\"icon long arrow right\"></i></a>\r\n  </div>\r\n</div>\r\n<div class=\"columns mobile-100 phone-100\">\r\n  <figure class=\"wojo image\" data-weditable=\"true\">\r\n<div class=\"wojo primary badge\">\r\n  <span class=\"year\">15yr</span>\r\n  <span class=\"text\">EXPERIENCE</span>\r\n</div>\r\n<a href=\"http://vimeo.com/75976293\" data-wbox=\"video\" class=\"wojo huge circular primary player icon button middle attached lightbox\" data-type=\"button\"><i class=\"icon play\"></i></a>\r\n<img src=\"[SITEURL]/uploads/images/laguna/laguna_about-img.jpg\" alt=\"Image Description\"></figure>\r\n</div>\r\n    </div>\r\n  </div>\r\n</div>\r\n<div class=\"section\" style=\"background-color:#f2f2fe; padding: 96px 0 64px 0;\">\r\n  <div class=\"wojo-grid\">\r\n    <div class=\"row gutters\">\r\n<div class=\"columns screen-50 tablet-50 mobile-100 phone-100\">\r\n  <figure class=\"wojo image\" data-weditable=\"true\"><img src=\"[SITEURL]/uploads/images/laguna/laguna_skills-img-1.jpg\" alt=\"image Description\"></figure>\r\n</div>\r\n<div class=\"columns screen-50 tablet-50 mobile-100 phone-100\">\r\n  <div data-weditable=\"true\">\r\n<span class=\"wojo primary inverted label\" data-type=\"label\">Our Skills</span>\r\n<h4 class=\"margin top\">We compete with our experience</h4>\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal</p>\r\n<div class=\"wojo primary mini progress relaxed\" data-wprogress=\'{\"tooltip\": false,\"label\": true, \"text\":\"% Funded\"}\'>\r\n  <span class=\"bar\" data-percent=\"35\"><span class=\"tip\"></span></span>\r\n  <div class=\"label\">35</div>\r\n</div>\r\n<div class=\"wojo secondary mini progress relaxed\" data-wprogress=\'{\"tooltip\": false,\"label\": true, \"text\":\"% Uploading\"}\'>\r\n  <span class=\"bar\" data-percent=\"32\"><span class=\"tip\"></span></span>\r\n  <div class=\"label\">32</div>\r\n</div>\r\n<div class=\"wojo positive mini progress relaxed\" data-wprogress=\'{\"tooltip\": false,\"label\": true, \"text\":\"% Earned\"}\'>\r\n  <span class=\"bar\" data-percent=\"60\"><span class=\"tip\"></span></span>\r\n  <div class=\"label\">60</div>\r\n</div>\r\n<div class=\"wojo negative mini progress relaxed\" data-wprogress=\'{\"tooltip\": false,\"label\": true, \"text\":\"% To Go\"}\'>\r\n  <span class=\"bar\" data-percent=\"81\"><span class=\"tip\"></span></span>\r\n  <div class=\"label\">81</div>\r\n</div>\r\n<div class=\"wojo mini progress relaxed\" data-wprogress=\'{\"tooltip\": false,\"label\": true, \"text\":\"% Completed\"}\'>\r\n  <span class=\"bar\" data-percent=\"100\"><span class=\"tip\"></span></span>\r\n  <div class=\"label\">100</div>\r\n</div>\r\n  </div>\r\n</div>\r\n    </div>\r\n  </div>\r\n</div>\r\n<div class=\"section\" style=\"padding:96px 0 64px 0\">\r\n  <div class=\"wojo-grid\">\r\n    <div class=\"row gutters align center\">\r\n<div class=\"columns screen-50 tablet-70 mobile-100 phone-100\">\r\n  <div data-weditable=\"true\" class=\"center aligned\">\r\n<span class=\"wojo primary inverted label\">How We Work</span>\r\n<h3 class=\"divided margin top\">Work <span class=\"wojo primary text\">Process</span></h3>\r\n<p>This is where we really begin to visualize your napkin sketches and make them into beautiful pixels.</p>\r\n  </div>\r\n</div>\r\n    </div>\r\n    <div class=\"row gutters\">\r\n<div class=\"columns mobile-100 phone-100\">\r\n  <div class=\"wojo full simple basic attached card\" data-weditable=\"true\">\r\n<div class=\"content center aligned\">\r\n  <figure class=\"wojo notification image margin bottom\"><img src=\"[SITEURL]/uploads/images/laguna/icon_07.svg\" alt=\"image Description\"></figure>\r\n  <div class=\"wojo huge primary bold text\">01</div>\r\n  <h6 class=\"margin top\">Thinking</h6>\r\n  <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form. </p>\r\n</div>\r\n  </div>\r\n</div>\r\n<div class=\"columns mobile-100 phone-100\">\r\n  <div class=\"wojo full basic attached card\" data-weditable=\"true\">\r\n<div class=\"content center aligned\">\r\n  <figure class=\"wojo notification image margin bottom\"><img src=\"[SITEURL]/uploads/images/laguna/icon_08.svg\" alt=\"image Description\"></figure>\r\n  <div class=\"wojo huge primary bold text\">02</div>\r\n  <h6 class=\"margin top\">Research</h6>\r\n  <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form. </p>\r\n</div>\r\n  </div>\r\n</div>\r\n<div class=\"columns mobile-100 phone-100\">\r\n  <div class=\"wojo full simple basic attached card\" data-weditable=\"true\">\r\n<div class=\"content center aligned\">\r\n  <figure class=\"wojo notification image margin bottom\"><img src=\"[SITEURL]/uploads/images/laguna/icon_09.svg\" alt=\"image Description\"></figure>\r\n  <div class=\"wojo huge primary bold text\">03</div>\r\n  <h6 class=\"margin top\">Design</h6>\r\n  <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form. </p>\r\n</div>\r\n  </div>\r\n</div>\r\n    </div>\r\n  </div>\r\n</div>\r\n<div class=\"section\" style=\"padding:96px 0 64px 0\">\r\n  <div class=\"wojo-grid\">\r\n    <div class=\"row gutters align center\">\r\n<div class=\"columns screen-50 tablet-70 mobile-100 phone-100\">\r\n  <div data-weditable=\"true\" class=\"center aligned\">\r\n<span class=\"wojo primary inverted label\">Team</span>\r\n<h3 class=\"divided margin top\">Our <span class=\"wojo primary text\">Team</span></h3>\r\n<p>We strive to embrace and drive change in our industry which allows us to keep our clients relevant.</p>\r\n  </div>\r\n</div>\r\n    </div>\r\n    <div class=\"row grid gutters screen-4 tablet-4 mobile-2 phone-1\">\r\n<div class=\"columns\">\r\n  <div class=\"wojo basic full attached card\" data-weditable=\"true\">\r\n<figure class=\"wojo fluid rounded image\">\r\n  <img src=\"[SITEURL]/uploads/images/laguna/laguna_team_01.jpg\" alt=\"image Description\"></figure>\r\n<div class=\"content center aligned\">\r\n  <h5>Dana Thomas</h5>\r\n  <div class=\"wojo primary demi text\">Web Designer</div>\r\n</div>\r\n<div class=\"footer center aligned\">\r\n  <a href=\"#!\" data-type=\"button\" class=\"wojo white icon button\"><i class=\"icon facebook\"></i></a>\r\n  <a href=\"#!\" data-type=\"button\" class=\"wojo white icon button\"><i class=\"icon twitter\"></i></a>\r\n  <a href=\"#!\" data-type=\"button\" class=\"wojo white icon button\"><i class=\"icon instagram\"></i></a>\r\n</div>\r\n  </div>\r\n</div>\r\n<div class=\"columns\">\r\n  <div class=\"wojo basic full attached card\" data-weditable=\"true\">\r\n<figure class=\"wojo fluid rounded image\">\r\n  <img src=\"[SITEURL]/uploads/images/laguna/laguna_team_02.jpg\" alt=\"image Description\"></figure>\r\n<div class=\"content center aligned\">\r\n  <h5>Lorenzo Cinque</h5>\r\n  <div class=\"wojo primary demi text\">Customer Support</div>\r\n</div>\r\n<div class=\"footer center aligned\">\r\n  <a href=\"#!\" data-type=\"button\" class=\"wojo white icon button\"><i class=\"icon facebook\"></i></a>\r\n  <a href=\"#!\" data-type=\"button\" class=\"wojo white icon button\"><i class=\"icon twitter\"></i></a>\r\n  <a href=\"#!\" data-type=\"button\" class=\"wojo white icon button\"><i class=\"icon instagram\"></i></a>\r\n</div>\r\n  </div>\r\n</div>\r\n<div class=\"columns\">\r\n  <div class=\"wojo basic full attached card\" data-weditable=\"true\">\r\n<figure class=\"wojo fluid rounded image\">\r\n  <img src=\"[SITEURL]/uploads/images/laguna/laguna_team_03.jpg\" alt=\"image Description\">\r\n  </figure>\r\n<div class=\"content center aligned\">\r\n  <h5>Tina Brown</h5>\r\n  <div class=\"wojo primary demi text\">Sales consultant</div>\r\n</div>\r\n<div class=\"footer center aligned\">\r\n  <a href=\"#!\" data-type=\"button\" class=\"wojo white icon button\"><i class=\"icon facebook\"></i></a>\r\n  <a href=\"#!\" data-type=\"button\" class=\"wojo white icon button\"><i class=\"icon twitter\"></i></a>\r\n  <a href=\"#!\" data-type=\"button\" class=\"wojo white icon button\"><i class=\"icon instagram\"></i></a>\r\n</div>\r\n  </div>\r\n</div>\r\n<div class=\"columns\">\r\n  <div class=\"wojo basic full attached card\" data-weditable=\"true\">\r\n<figure class=\"wojo fluid rounded image\">\r\n  <img src=\"[SITEURL]/uploads/images/laguna/laguna_team_04.jpg\" alt=\"image Description\"></figure>\r\n<div class=\"content center aligned\">\r\n  <h5>Adrian Jones</h5>\r\n  <div class=\"wojo primary demi text\">Web Developer</div>\r\n</div>\r\n<div class=\"footer center aligned\">\r\n  <a href=\"#!\" data-type=\"button\" class=\"wojo white icon button\"><i class=\"icon facebook\"></i></a>\r\n  <a href=\"#!\" data-type=\"button\" class=\"wojo white icon button\"><i class=\"icon twitter\"></i></a>\r\n  <a href=\"#!\" data-type=\"button\" class=\"wojo white icon button\"><i class=\"icon instagram\"></i></a>\r\n</div>\r\n  </div>\r\n</div>\r\n    </div>\r\n  </div>\r\n</div>', '\"\"', '', '', '2014-01-29 04:11:36', 1, 'Web Master', 0, 1);
INSERT INTO `pages` (`id`, `title_en`, `slug_en`, `caption_en`, `is_admin`, `page_type`, `membership_id`, `is_comments`, `custom_bg_en`, `show_header`, `theme`, `access`, `body_en`, `jscode`, `keywords_en`, `description_en`, `created`, `created_by`, `created_by_name`, `is_system`, `active`) VALUES(3, 'Our Contact Info', 'our-contact-info', 'Got a question?', 1, 'normal', '0', 0, NULL, 1, NULL, 'Public', '<div class=\"section\" style=\"padding:96px 0 64px 0\">\r\n  <div class=\"wojo-grid\">\r\n    <div class=\"row gutters\">\r\n<div class=\"columns mobile-50 phone-100\">\r\n  <div class=\"wojo attached basic card\" data-weditable=\"true\">\r\n<div class=\"content center aligned\">\r\n  <figure class=\"wojo small image\">\r\n    <img src=\"[SITEURL]/uploads/images/laguna/icon_14.svg\" alt=\"Address\">\r\n  </figure>\r\n  <h6 class=\"margin top\">Address</h6>\r\n  <p class=\"wojo small text\">153 Toronto Plaza, 09514</p>\r\n</div>\r\n  </div>\r\n</div>\r\n<div class=\"columns mobile-50 phone-100\">\r\n  <div class=\"wojo attached basic card\" data-weditable=\"true\">\r\n<div class=\"content center aligned\">\r\n  <figure class=\"wojo small image\">\r\n    <img src=\"[SITEURL]/uploads/images/laguna/icon_15.svg\" alt=\"Email\">\r\n  </figure>\r\n  <h6 class=\"margin top\">Email</h6>\r\n  <p class=\"wojo small text\">support@wojoscripts.com</p>\r\n</div>\r\n  </div>\r\n</div>\r\n<div class=\"columns mobile-50 phone-100\">\r\n  <div class=\"wojo attached basic card\" data-weditable=\"true\">\r\n<div class=\"content center aligned\">\r\n  <figure class=\"wojo small image\">\r\n    <img src=\"[SITEURL]/uploads/images/laguna/icon_16.svg\" alt=\"Phone Number\">\r\n  </figure>\r\n  <h6 class=\"margin top\">Phone Number</h6>\r\n  <p class=\"wojo small text\">+1 (416) 109-9222</p>\r\n</div>\r\n  </div>\r\n</div>\r\n<div class=\"columns mobile-50 phone-100\">\r\n  <div class=\"wojo attached basic card\" data-weditable=\"true\">\r\n<div class=\"content center aligned\">\r\n  <figure class=\"wojo small image\">\r\n    <img src=\"[SITEURL]/uploads/images/laguna/icon_17.svg\" alt=\"Fax\">\r\n  </figure>\r\n  <h6 class=\"margin top\">Fax</h6>\r\n  <p class=\"wojo small text\">+1 (416) 109-9223</p>\r\n</div>\r\n  </div>\r\n</div>\r\n    </div>\r\n  </div>\r\n</div>\r\n<div class=\"section\" style=\"padding:96px 0 64px 0\">\r\n  <div class=\"wojo-grid\">\r\n    <div class=\"row gutters align center\">\r\n<div class=\"columns screen-50 tablet-70 mobile-100 phone-100\">\r\n  <div data-weditable=\"true\" class=\"center aligned\">\r\n<span class=\"wojo primary inverted label\" data-type=\"label\">Contact Us</span>\r\n<h3 class=\"divided margin top\">Get In <span class=\"wojo primary text\">Touch</span></h3>\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>\r\n  </div>\r\n</div>\r\n    </div>\r\n    <div class=\"row gutters\">\r\n<div class=\"columns screen-40 tablet-40 mobile-100 phone-100\"> %%gmaps/head-office|plugin|1|20%% </div>\r\n<div class=\"columns screen-60 tablet-60 mobile-100 phone-100\"> %%contact|plugin|1|5%% </div>\r\n    </div>\r\n  </div>\r\n</div>', '', '', '', '2010-07-23 20:11:55', 1, 'Web Master', 0, 1);
INSERT INTO `pages` (`id`, `title_en`, `slug_en`, `caption_en`, `is_admin`, `page_type`, `membership_id`, `is_comments`, `custom_bg_en`, `show_header`, `theme`, `access`, `body_en`, `jscode`, `keywords_en`, `description_en`, `created`, `created_by`, `created_by_name`, `is_system`, `active`) VALUES(5, 'Demo Gallery Page', 'demo-gallery-page', 'Responsive fluid gallery...', 0, 'normal', '0', 0, NULL, 1, NULL, 'Public', NULL, NULL, '', '', '2010-07-23 20:11:55', 1, 'Web Master', 0, 1);
INSERT INTO `pages` (`id`, `title_en`, `slug_en`, `caption_en`, `is_admin`, `page_type`, `membership_id`, `is_comments`, `custom_bg_en`, `show_header`, `theme`, `access`, `body_en`, `jscode`, `keywords_en`, `description_en`, `created`, `created_by`, `created_by_name`, `is_system`, `active`) VALUES(7, 'SVG Header', 'svg-header', 'Featuring middle column only layout', 0, 'normal', '0', 0, '', 0, NULL, 'Public', '<div class=\"section overlay secondary fvh\" style=\"background-image: url([SITEURL]/uploads/images/laguna/laguna_slider-img-1.jpg);background-repeat: no-repeat;background-size:cover;background-position: top center;\">\r\n  <div class=\"wojo-grid\">\r\n    <div class=\"row gutters align middle fvh\">\r\n<div class=\"columns screen-50 tablet-60 mobile-100 phone-100\">\r\n  <div data-weditable=\"true\">\r\n<span class=\"wojo transparent label\">Who Are We</span>\r\n<h1 class=\"wojo white text margin top\">We Do Your Web Designs Carefully. </h1>\r\n<p class=\"wojo white dimmed text\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. </p>\r\n<div class=\"padding top\">\r\n  <a href=\"#!\" data-type=\"button\" class=\"wojo primary big right button\">Get Started<i class=\"icon long arrow right\"></i></a>\r\n</div>\r\n  </div>\r\n</div>\r\n    </div>\r\n  </div>\r\n  <figure class=\"absolute\" style=\"bottom:0;width:100%\">\r\n    <svg preserveAspectRatio=\"none\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"-107 238.2 283.5 27.2\">\r\n<g fill=\"#fff\">\r\n  <path d=\"M176.5 265.4H-107v-10.8s6.5 1.6 16.8.5c4.8-.6 10.1-2.5 15.8-3.7 5.7-1.2 10.5-1.5 12-1.6 5.9-.2 11 .5 14.2.9 7.6.9 13.2 3.5 17 4.7 3.9 1.2 9.1 1.9 10.5 2 13.2.8 45.3-15.5 63-15.8 16.6-.3 30 6.1 36.6 9.3 5.9 2.8 6.4 3 18 7.4s33.4-3.7 44.7-5.7c8.3-1.5 14.1-1.8 20.9-1.5 6.7.3 14 4.6 14 4.6v9.7zm-26.8-11.7c-2.9.4-5.7 1.8-6 1.9-.3.1 3.5-1.1 5.8-1.1s3.6.6 4.3-.4c.6-1-1.1-.9-4.1-.4zm-20.1 3.6c-3.1.5-9.1 2-12.4 2.7-8 1.7-16.8 1-17.6 1.1-.7.1 6.9 1.2 15.1.1 4.8-.7 11.9-2.7 15.1-3.5 3.2-.7 5.6-.9 5.6-.9s-2.5-.1-5.8.5zm-69.9-7.4c-2.4-.5-2.2-.8-7.6-1.6-5.4-.8-11.2-.2-11.2 0-.1.1 4.9.1 8.8.5 3.8.4 7.9 1.4 10 2 5.2 1.4 20.2 6.8 18.5 6.1-1.7-.7-14.7-6.2-18.5-7zm27.3 6.8c-3.1-1.2-6.8-3.1-6.6-3 .2.2 2.9 2.2 6.9 3.7s5 1.1 4.8 1.1c-.1 0-2.1-.6-5.1-1.8zm84.9 0c-3.9-1.9-7.2-2.5-7.4-2.5-.2-.1 3.8 1.3 6.7 2.7 2.9 1.4 4.7 2.4 4.8 2.5.1.1-.2-.8-4.1-2.7zm-253-2.2c-3.3 1.1-3.5 1.1-5.7 1.6-4.3 1-12.2.6-12.5.7-.4.1 7.3 1 11.3.2 2.4-.4 5.2-1 7.8-2 2.6-1 4.6-1 4.5-1.2-.1-.3-2.1-.4-5.4.7zm58.2 5.4c5.2.6 6.2 0 6.2-.3s-4 .3-8.9-.8c-4.9-1-8-2.5-8.4-2.6s5.9 3.1 11.1 3.7zm-7.6.9c1.6.4 2.7.3 2.7.2 0-.1.4-.3-1.9-.6-2.3-.4-5.5-1.8-5.7-1.7-.2.1 3.2 1.6 4.9 2.1zm22.2-.8c1.6-.5 2.5-1.2 2.4-1.3s.2-.5-1.9.5-5.5 1.6-5.6 1.8c-.1.2 3.5-.4 5.1-1zm-31.7-5.1c1.6.4 2.1.7 2.5.8s-.6-.5-2.2-1.2-2-.5-1.9-.2c.1.3-.1.2 1.6.6zm-28.8-2.2c1.5.1 1.6-.1 1.6-.4 0-.3-.8-.3-2-.2-1.2.1-3.5.9-3.3.9s2.1-.4 3.7-.3zM37 244c-6.5.2-20.1 5.2-16.5 4.1 3.6-1.1 12.2-3.5 17.2-3.5 5.1 0 7.4-.4 7.5-.3.1.1-1.7-.5-8.2-.3z\"/>\r\n  <path d=\"M155.8 247c-3.3.2-16.6 3-17 3.3-.4.3 9.3-2.2 16.6-2.9 2.6-.3 7.1.1 7.2 0 .1 0-1.9-.8-6.8-.4zM111.9 257.5c-7.4.6-13-1.1-13.3-1.2-.4-.1 7.3.7 12.3.5 5-.2 9.3-1.1 9.5-1.2.2-.1-1.1 1.3-8.5 1.9zM101.1 252.4c1.5-.1 1.6.1 1.6.4 0 .3-.8.4-2 .3-1.2-.1-3.3-1-3.2-1.1.1-.1 1.9.5 3.6.4zM87.9 252.1c-2.1-1-6.2-2.7-6.3-2.6-.1 0 4.2 2.2 6.1 3.1 1.9 1 6.3 2.3 6.3 2.2 0-.1-4-1.7-6.1-2.7zM40.7 238.3c-3.3.2-16.6 3-17 3.3-.4.3 9.3-2.2 16.6-2.9 2.6-.3 7.1.1 7.2 0s-1.9-.8-6.8-.4zM-62.3 246.6c1.6.1 4.9-.3 6.7-.4 4.3-.3 8.2 1.9 8.6 1.9.4.1-2.8-2.2-7-2.6-2.4-.2-6.5.5-8.2.7s-2.9-.1-2.9-.1 1.2.4 2.8.5zM-28.5 254.4c1.6.4 3.4.1 3.4 0 0-.2.2-.3-2.1-.5-2.3-.3-4.1-1.2-4.3-1.1-.2.1 1.4 1.1 3 1.6zM-84.8 251.1c2.4-.6 5.1-1.5 5.1-1.4s-2.6 1.5-5 2-6.7.6-6.7.5c.1-.1 4.3-.5 6.6-1.1z\"/>\r\n</g>\r\n    </svg>\r\n  </figure>\r\n</div>\r\n<div class=\"section\" style=\"padding:96px 0 64px 0\">\r\n  <div class=\"wojo-grid\">\r\n    <div class=\"row gutters align center\">\r\n<div class=\"columns screen-50 tablet-70 mobile-100 phone-100\">\r\n  <div data-weditable=\"true\" class=\"center aligned\">\r\n<span class=\"wojo primary inverted label\">What We Do</span>\r\n<h3 class=\"divided margin top\">Our <span class=\"wojo primary text\">Services</span></h3>\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>\r\n  </div>\r\n</div>\r\n    </div>\r\n    <div class=\"row gutters\">\r\n<div class=\"columns\">\r\n  <div class=\"wojo link full basic cards screen-3 tablet-3 mobile-2 phone-1\">\r\n<div class=\"card\" data-weditable=\"true\">\r\n  <div class=\"content\">\r\n  <figure class=\"wojo notification image margin bottom\"><img src=\"[SITEURL]/uploads/images/laguna/icon_01.svg\" alt=\"image Description\"></figure>\r\n    <h5>UI Design</h5>\r\n    <p class=\"big bottom margin\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum</p>\r\n    <a href=\"#!\" data-type=\"button\" class=\"wojo primary big right button\">Get Started<i class=\"icon long arrow right\"></i></a>\r\n  </div>\r\n</div>\r\n<div class=\"card\" data-weditable=\"true\">\r\n  <div class=\"content\">\r\n  <figure class=\"wojo notification image margin bottom\"><img src=\"[SITEURL]/uploads/images/laguna/icon_02.svg\" alt=\"image Description\"></figure>\r\n    <h5>Seo Optimization</h5>\r\n    <p class=\"big bottom margin\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum</p>\r\n    <a href=\"#!\" data-type=\"button\" class=\"wojo primary big right button\">Get Started<i class=\"icon long arrow right\"></i></a>\r\n  </div>\r\n</div>\r\n<div class=\"card\" data-weditable=\"true\">\r\n  <div class=\"content\">\r\n  <figure class=\"wojo notification image margin bottom\"><img src=\"[SITEURL]/uploads/images/laguna/icon_03.svg\" alt=\"image Description\"></figure>\r\n    <h5>Wiframe Design</h5>\r\n    <p class=\"big bottom margin\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum</p>\r\n    <a href=\"#!\" data-type=\"button\" class=\"wojo primary big right button\">Get Started<i class=\"icon long arrow right\"></i></a>\r\n  </div>\r\n</div>\r\n<div class=\"card\" data-weditable=\"true\">\r\n  <div class=\"content\">\r\n  <figure class=\"wojo notification image margin bottom\"><img src=\"[SITEURL]/uploads/images/laguna/icon_04.svg\" alt=\"image Description\"></figure>\r\n    <h5>Graphic Design</h5>\r\n    <p class=\"big bottom margin\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum</p>\r\n    <a href=\"#!\" data-type=\"button\" class=\"wojo primary big right button\">Get Started<i class=\"icon long arrow right\"></i></a>\r\n  </div>\r\n</div>\r\n<div class=\"card\" data-weditable=\"true\">\r\n  <div class=\"content\">\r\n  <figure class=\"wojo notification image margin bottom\"><img src=\"[SITEURL]/uploads/images/laguna/icon_05.svg\" alt=\"image Description\"></figure>\r\n    <h5>App Desig</h5>\r\n    <p class=\"big bottom margin\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum</p>\r\n    <a href=\"#!\" data-type=\"button\" class=\"wojo primary big right button\">Get Started<i class=\"icon long arrow right\"></i></a>\r\n  </div>\r\n</div>\r\n<div class=\"card\" data-weditable=\"true\">\r\n  <div class=\"content\">\r\n  <figure class=\"wojo notification image margin bottom\"><img src=\"[SITEURL]/uploads/images/laguna/icon_06.svg\" alt=\"image Description\"></figure>\r\n    <h5>Web Design</h5>\r\n    <p class=\"big bottom margin\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum</p>\r\n    <a href=\"#!\" data-type=\"button\" class=\"wojo primary big right button\">Get Started<i class=\"icon long arrow right\"></i></a>\r\n  </div>\r\n</div>\r\n  </div>\r\n</div>\r\n    </div>\r\n  </div>\r\n</div>\r\n<div class=\"section overlay white\" style=\"background-image: url([SITEURL]/uploads/images/laguna/laguna_about-bg-img.jpg);background-repeat: no-repeat;background-size:cover;background-position: top center;padding:96px 0 64px 0\">\r\n  <div class=\"wojo-grid\">\r\n    <div class=\"row gutters align middle\">\r\n<div class=\"columns mobile-100 phone-100\">\r\n  <div data-weditable=\"true\">\r\n<span class=\"wojo primary inverted label\">WHO WE ARE</span>\r\n<h4 class=\"margin top\">We Are Professional Designer & Developer </h4>\r\n<p>Want to create your dream website? Then meet our professional team. Business, Health, Medicine, Agency, E commerce, Portfolio, One Page, Business Cards, Panels, Statistical Panels, Billboards and invitations with you at your service. </p>\r\n<blockquote>\r\n  <p>\r\n    \"We have been devoted to design for many years, our goal is to advance design and visuality and produce new styles.\"\r\n  </p>\r\n  <strong>Ceo founder - By Adrian Salves</strong>\r\n</blockquote>\r\n<a href=\"#!\" data-type=\"button\" class=\"wojo primary big right button\">Read More<i class=\"icon long arrow right\"></i></a>\r\n  </div>\r\n</div>\r\n<div class=\"columns mobile-100 phone-100\">\r\n  <figure class=\"wojo image\" data-weditable=\"true\">\r\n<div class=\"wojo primary badge\">\r\n  <span class=\"year\">15yr</span>\r\n  <span class=\"text\">EXPERIENCE</span>\r\n</div>\r\n<a href=\"http://vimeo.com/75976293\" data-wbox=\"video\" class=\"wojo huge circular primary player icon button middle attached lightbox\" data-type=\"button\"><i class=\"icon play\"></i></a>\r\n<img src=\"[SITEURL]/uploads/images/laguna/laguna_about-img.jpg\" alt=\"Image Description\"></figure>\r\n</div>\r\n    </div>\r\n  </div>\r\n</div>', '\"\"', '', 'Aliquam vitae metus non elit laoreet varius. Pellentesque et enim lorem. Suspendisse potenti. Nam ut iaculis lectus. Ut et leo odio. In euismod lobortis nisi, eu placerat nisi laoreet a.\r\nCras lobortis lobortis elit, at pellentesque erat vulputate ac. Phasellus in sapien non elit semper pellentesque ut a turpis. Quisque mollis auctor feugiat. Fusce a nisi diam, eu dapibus nibh.Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Etiam a justo libero, aliquam auctor felis. Nulla a odio ut magna ultrices vestibulum.\r\nInteger urna magna, euismod sed pharetra eget, ornare in dolor. Etiam bibendum mi ut nisi facilisis lobortis. Phasellus turpis orci, interdum adipiscing aliquam ut, convallis volutpat tellus. Nunc massa nunc, dapibus eget scelerisque ac, eleifend eget ligula. Maecenas accumsan tortor in quam adipiscing hendrerit. Donec ac risus nec est molestie malesuada ac id risus. In hac habitasse platea dictumst. In quam dui, blandit id interdum id, facilisis a leo.\r\nNullam fringilla quam pharetra enim interdum accumsan. Phasellus nec euismod quam. Donec tempor accumsan posuere. Phasellus ac metus orci, ac venenatis magna. Suspendisse sit amet odio at enim ultricies pellentesque eget ac risus. Vestibulum eleifend odio ut tellus faucibus malesuada feugiat nisi rhoncus. Proin nec sem ut augue placerat blandit ut ut orci. Cras aliquet venenatis enim, quis rutrum urna sollicitudin vel.', '2010-07-23 20:40:19', 1, 'Web Master', 0, 1);
INSERT INTO `pages` (`id`, `title_en`, `slug_en`, `caption_en`, `is_admin`, `page_type`, `membership_id`, `is_comments`, `custom_bg_en`, `show_header`, `theme`, `access`, `body_en`, `jscode`, `keywords_en`, `description_en`, `created`, `created_by`, `created_by_name`, `is_system`, `active`) VALUES(8, 'Slider Page', 'slider-page', 'Slider Page', 0, 'normal', '0', 0, '', 0, NULL, 'Public', '<div class=\"section\">\r\n  <div class=\"row\">\r\n    <div class=\"columns\"> %%slider/demo|plugin|1|5%% </div>\r\n  </div>\r\n</div>\r\n<div class=\"section\" style=\"padding:96px 0\">\r\n  <div class=\"wojo-grid\">\r\n    <div class=\"row gutters align center\">\r\n<div class=\"columns screen-50 tablet-70 mobile-100 phone-100\">\r\n  <div data-weditable=\"true\" class=\"center aligned\">\r\n<span class=\"wojo primary inverted label\">Right Sidebar</span>\r\n<h3 class=\"divided margin top\">Built with <span class=\"wojo primary text\">Pagebuilder</span></h3>\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>\r\n  </div>\r\n</div>\r\n    </div>\r\n    <div class=\"row big gutters\">\r\n<div class=\"columns screen-70 tablet-60 mobile-100 phone-100\">\r\n  <p>Perhaps you are a new entrepreneur about to launch a business or innovation you have been dreaming about for years. Or maybe you have an established business and things are going well, or maybe even too well. In both instances you are going to need capital - the \'oxygen\' that every business needs to grow and prosper. </p>\r\n  <figure class=\"wojo big image rounded vertical margin center aligned\" data-weditable=\"true\">\r\n<img alt=\"\" src=\"[SITEURL]/uploads/images/laguna/laguna_analysis.jpg\">\r\n  </figure>\r\n  <div class=\"center aligned bottom margin\"><small>We know how to help you</small></div>\r\n  <p>So now you are writing your first business plan or touching up the old one in anticipation of raising capital. Capital can only come into a business in one of two ways. Capital that is generated internally through positive cash flow from business operations (e.g., selling stuff), or from external funding sources. The new entrepreneur is limited to only one option - external funding sources. </p>\r\n  <div class=\"wojo divider\"></div>\r\n  <h4>Contact Us</h4>\r\n  <p>- Place contact plugin on any page -</p>\r\n  <div class=\"row gutters\">\r\n<div class=\"columns\">%%contact|plugin|1|0%% </div>\r\n  </div>\r\n</div>\r\n<div class=\"columns screen-30 tablet-40 mobile-100 phone-100\">\r\n  <div class=\"wojo plugin attached segment\" data-weditabe=\"true\">\r\n<a href=\"[SITEURL]/uploads/images/laguna/laguna_in-the-office.jpg\" class=\"wojo rounded image lightbox\"><img alt=\"\" src=\"[SITEURL]/uploads/images/laguna//laguna_in-the-office.jpg\"></a>\r\n<div class=\"center aligned vertical margin\">\r\n  <p>Our business solutions are designed around the real needs of businesses, our information resources, tools and... </p>\r\n  <p><a class=\"wojo secondary button\" href=\"[SITEURL]/page/what-is-cms-pro/\">learn more</a>\r\n  </p>\r\n</div>\r\n  </div>\r\n  %%adblock/wojo-advert|plugin|1|21%%\r\n  %%blog/latest|plugin|0|43%% </div>\r\n    </div>\r\n  </div>\r\n</div>', '\"\"', '', '', '2010-08-10 22:06:58', 1, 'Web Master', 0, 1);
INSERT INTO `pages` (`id`, `title_en`, `slug_en`, `caption_en`, `is_admin`, `page_type`, `membership_id`, `is_comments`, `custom_bg_en`, `show_header`, `theme`, `access`, `body_en`, `jscode`, `keywords_en`, `description_en`, `created`, `created_by`, `created_by_name`, `is_system`, `active`) VALUES(9, 'Members Only', 'members-only', '', 0, 'normal', '0', 0, '', 1, NULL, 'Registered', '<div class=\"section\" style=\"padding:64px\">\r\n  <div class=\"wojo-grid\">\r\n    <div class=\"row align-center\">\r\n<div class=\"columns screen-70 tablet-100 mobile-100 phone-100\">\r\n<h2>Members Only Page</h2>\r\n<p>- Limited  Access-</p>\r\n<div class=\"wojo divider\"></div>\r\n<p>Perhaps you are a new entrepreneur about to launch a business or innovation you have been dreaming about for years. Or maybe you have an established business and things are going well, or maybe even too well. In both instances you are going to need capital - the \'oxygen\' that every business needs to grow and prosper.</p>\r\n</div>\r\n    </div>\r\n  </div>\r\n</div>', '', '', '', '2011-05-20 15:28:29', 1, 'Web Master', 0, 1);
INSERT INTO `pages` (`id`, `title_en`, `slug_en`, `caption_en`, `is_admin`, `page_type`, `membership_id`, `is_comments`, `custom_bg_en`, `show_header`, `theme`, `access`, `body_en`, `jscode`, `keywords_en`, `description_en`, `created`, `created_by`, `created_by_name`, `is_system`, `active`) VALUES(10, 'Membership Only', 'membership-only', '', 0, 'normal', '2,4', 0, '', 1, NULL, 'Membership', '<div class=\"section\" style=\"padding:64px\">\r\n  <div class=\"wojo-grid\">\r\n    <div class=\"row align-center\">\r\n<div class=\"columns screen-70 tablet-100 mobile-100 phone-100\">\r\n<h2>Members Only Page</h2>\r\n<p>- Limited  Access-</p>\r\n<div class=\"wojo divider\"></div>\r\n<p>Perhaps you are a new entrepreneur about to launch a business or innovation you have been dreaming about for years. Or maybe you have an established business and things are going well, or maybe even too well. In both instances you are going to need capital - the \'oxygen\' that every business needs to grow and prosper.</p>\r\n</div>\r\n    </div>\r\n  </div>\r\n</div>', '', '', '', '2011-05-20 15:28:48', 1, 'Web Master', 0, 1);
INSERT INTO `pages` (`id`, `title_en`, `slug_en`, `caption_en`, `is_admin`, `page_type`, `membership_id`, `is_comments`, `custom_bg_en`, `show_header`, `theme`, `access`, `body_en`, `jscode`, `keywords_en`, `description_en`, `created`, `created_by`, `created_by_name`, `is_system`, `active`) VALUES(11, 'Event Manager Demo', 'event-calendar-demo', '', 0, 'normal', '0', 0, NULL, 1, NULL, 'Public', '<div class=\"section\" style=\"padding:64px 0\"> \r\n<div class=\"wojo-grid\">\r\n  <div class=\"row gutters\">\r\n    <div class=\"columns\">\r\n %%events|module|0|4%% \r\n    </div>\r\n  </div>\r\n</div>\r\n</div>\r\n', NULL, 'Event calendar', 'Event Manager', '2012-01-03 04:05:43', 1, 'Web Master', 0, 1);
INSERT INTO `pages` (`id`, `title_en`, `slug_en`, `caption_en`, `is_admin`, `page_type`, `membership_id`, `is_comments`, `custom_bg_en`, `show_header`, `theme`, `access`, `body_en`, `jscode`, `keywords_en`, `description_en`, `created`, `created_by`, `created_by_name`, `is_system`, `active`) VALUES(12, 'Page With Comments', 'page-with-comments', 'Comments Demo', 0, 'normal', '0', 1, '', 1, NULL, 'Public', '<div class=\"section\" style=\"padding:96px 0 64px 0\">\r\n  <div class=\"wojo-grid\">\r\n    <div class=\"row gutters align center\">\r\n<div class=\"columns\">\r\n  <div data-weditable=\"true\" class=\"center aligned\">\r\n<span class=\"wojo primary inverted label\">Comments</span>\r\n<h3 class=\"divided margin top\">Page With <span class=\"wojo primary text\">Comments</span></h3>\r\n  </div>\r\n  <div data-weditable=\"true\">\r\n<p>Perhaps you are a new entrepreneur about to launch a business or innovation you have been dreaming about for years. Or maybe you have an established business and things are going well, or maybe even too well. In both instances you are going to need capital - the \'oxygen\' that every business needs to grow and prosper.</p>\r\n<p>So now you are writing your first business plan or touching up the old one in anticipation of raising capital. Capital can only come into a business in one of two ways. Capital that is generated internally through positive cash flow from business operations (e.g., selling stuff), or from external funding sources. The new entrepreneur is limited to only one option - external funding sources. </p>\r\n  </div>\r\n</div>\r\n    </div>\r\n    <div class=\"row gutters align center\">\r\n<div class=\"columns screen-50 tablet-60 mobile-100 phone-100\">\r\n  <div class=\"wojo basic card\" data-weditable=\"true\">\r\n<figure class=\"wojo top rounded image\">\r\n  <img alt=\"\" src=\"[SITEURL]/uploads/images/laguna/laguna_img2.jpg\" alt=\"Image Description\">\r\n</figure>\r\n<div class=\"content\">\r\n  <h6>Should Product Owners think like entrepreneurs?</h6>\r\n  <p>Laguna is a financial technology company. We build products. We do it fast and we do it well.</p>\r\n</div>\r\n<div class=\"footer\">\r\n  <div class=\"row align middle\">\r\n    <div class=\"columns\">\r\n<figure class=\"wojo tiny circular image\">\r\n  <img alt=\"\" src=\"[SITEURL]/uploads/images/laguna/laguna_team_01.jpg\" alt=\"Image Description\">\r\n</figure>\r\n    </div>\r\n    <div class=\"columns auto\">July 15</div>\r\n  </div>\r\n</div>\r\n  </div>\r\n</div>\r\n    </div>\r\n  </div>\r\n</div>', '', '', '', '2012-01-03 04:08:46', 1, 'Web Master', 0, 1);
INSERT INTO `pages` (`id`, `title_en`, `slug_en`, `caption_en`, `is_admin`, `page_type`, `membership_id`, `is_comments`, `custom_bg_en`, `show_header`, `theme`, `access`, `body_en`, `jscode`, `keywords_en`, `description_en`, `created`, `created_by`, `created_by_name`, `is_system`, `active`) VALUES(13, 'Services', 'services', 'Services', 0, 'normal', '0', 0, '', 1, NULL, 'Public', '<div class=\"section\" style=\"padding:96px 0 64px 0\">\r\n  <div class=\"wojo-grid\">\r\n    <div class=\"row gutters align center\">\r\n<div class=\"columns screen-50 tablet-70 mobile-100 phone-100\">\r\n  <div data-weditable=\"true\" class=\"center aligned\">\r\n<span class=\"wojo primary inverted label\">What We Do</span>\r\n<h3 class=\"divided margin top\">Our <span class=\"wojo primary text\">Services</span></h3>\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>\r\n  </div>\r\n</div>\r\n    </div>\r\n    <div class=\"row gutters\">\r\n<div class=\"columns\">\r\n  <div class=\"wojo link full basic cards screen-3 tablet-3 mobile-2 phone-1\">\r\n<div class=\"card\" data-weditable=\"true\">\r\n  <div class=\"content\">\r\n  <figure class=\"wojo notification image margin bottom\"><img src=\"[SITEURL]/uploads/images/laguna/icon_01.svg\" alt=\"image Description\"></figure>\r\n    <h5>UI Design</h5>\r\n    <p class=\"big bottom margin\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum</p>\r\n    <a href=\"#!\" data-type=\"button\" class=\"wojo primary big right button\">Get Started<i class=\"icon long arrow right\"></i></a>\r\n  </div>\r\n</div>\r\n<div class=\"card\" data-weditable=\"true\">\r\n  <div class=\"content\">\r\n  <figure class=\"wojo notification image margin bottom\"><img src=\"[SITEURL]/uploads/images/laguna/icon_02.svg\" alt=\"image Description\"></figure>\r\n    <h5>Seo Optimization</h5>\r\n    <p class=\"big bottom margin\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum</p>\r\n    <a href=\"#!\" data-type=\"button\" class=\"wojo primary big right button\">Get Started<i class=\"icon long arrow right\"></i></a>\r\n  </div>\r\n</div>\r\n<div class=\"card\" data-weditable=\"true\">\r\n  <div class=\"content\">\r\n  <figure class=\"wojo notification image margin bottom\"><img src=\"[SITEURL]/uploads/images/laguna/icon_03.svg\" alt=\"image Description\"></figure>\r\n    <h5>Wiframe Design</h5>\r\n    <p class=\"big bottom margin\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum</p>\r\n    <a href=\"#!\" data-type=\"button\" class=\"wojo primary big right button\">Get Started<i class=\"icon long arrow right\"></i></a>\r\n  </div>\r\n</div>\r\n<div class=\"card\" data-weditable=\"true\">\r\n  <div class=\"content\">\r\n  <figure class=\"wojo notification image margin bottom\"><img src=\"[SITEURL]/uploads/images/laguna/icon_04.svg\" alt=\"image Description\"></figure>\r\n    <h5>Graphic Design</h5>\r\n    <p class=\"big bottom margin\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum</p>\r\n    <a href=\"#!\" data-type=\"button\" class=\"wojo primary big right button\">Get Started<i class=\"icon long arrow right\"></i></a>\r\n  </div>\r\n</div>\r\n<div class=\"card\" data-weditable=\"true\">\r\n  <div class=\"content\">\r\n  <figure class=\"wojo notification image margin bottom\"><img src=\"[SITEURL]/uploads/images/laguna/icon_05.svg\" alt=\"image Description\"></figure>\r\n    <h5>App Desig</h5>\r\n    <p class=\"big bottom margin\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum</p>\r\n    <a href=\"#!\" data-type=\"button\" class=\"wojo primary big right button\">Get Started<i class=\"icon long arrow right\"></i></a>\r\n  </div>\r\n</div>\r\n<div class=\"card\" data-weditable=\"true\">\r\n  <div class=\"content\">\r\n  <figure class=\"wojo notification image margin bottom\"><img src=\"[SITEURL]/uploads/images/laguna/icon_06.svg\" alt=\"image Description\"></figure>\r\n    <h5>Web Design</h5>\r\n    <p class=\"big bottom margin\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum</p>\r\n    <a href=\"#!\" data-type=\"button\" class=\"wojo primary big right button\">Get Started<i class=\"icon long arrow right\"></i></a>\r\n  </div>\r\n</div>\r\n  </div>\r\n</div>\r\n    </div>\r\n  </div>\r\n</div>\r\n<div class=\"section overlay secondary\" style=\"background-image: url([SITEURL]/uploads/images/laguna/laguna_counter-bg.jpg);background-repeat: no-repeat;background-size:cover;background-position: top center;padding:96px 0 64px 0\">\r\n  <div class=\"wojo-grid\">\r\n    <div class=\"row gutters align middle spaced\">\r\n<div class=\"columns screen-50 tablet-60 mobile-100 phone-100\">\r\n  <div data-weditable=\"true\">\r\n<h4 class=\"wojo white text\">Take advantage of your experience</h4>\r\n  </div>\r\n</div>\r\n<div class=\"columns auto mobile-100 phone-100\">\r\n  <div data-weditable=\"true\">\r\n<a href=\"#!\" data-type=\"button\" class=\"wojo primary big right button\">Read More<i class=\"icon long arrow right\"></i></a>\r\n  </div>\r\n</div>\r\n    </div>\r\n    <div class=\"row grid gutters screen-4 tablet-4 mobile-2 phone-1\">\r\n<div class=\"columns\">\r\n  <div class=\"wojo basic card\" data-weditable=\"true\">\r\n<div class=\"content center aligned\">\r\n  <figure class=\"wojo notification image margin bottom\">\r\n    <img src=\"[SITEURL]/uploads/images/laguna/icon_10.svg\" alt=\"image Description\"></figure>\r\n  <h6>Projects</h6>\r\n  <span class=\"wojo huge demi primary text\">2500</span></div>\r\n  </div>\r\n</div>\r\n<div class=\"columns\">\r\n  <div class=\"wojo basic card\" data-weditable=\"true\">\r\n<div class=\"content center aligned\">\r\n  <figure class=\"wojo notification image margin bottom\">\r\n    <img src=\"[SITEURL]/uploads/images/laguna/icon_11.svg\" alt=\"image Description\"></figure>\r\n  <h6>Happy Clients</h6>\r\n  <span class=\"wojo huge demi primary text\"> 750 </span></div>\r\n  </div>\r\n</div>\r\n<div class=\"columns\">\r\n  <div class=\"wojo basic card\" data-weditable=\"true\">\r\n<div class=\"content center aligned\">\r\n  <figure class=\"wojo notification image margin bottom\">\r\n    <img src=\"[SITEURL]/uploads/images/laguna/icon_12.svg\" alt=\"image Description\"></figure>\r\n  <h6>Visitors</h6>\r\n  <span class=\"wojo huge demi primary text\">20500</span></div>\r\n  </div>\r\n</div>\r\n<div class=\"columns\">\r\n  <div class=\"wojo basic card\" data-weditable=\"true\">\r\n<div class=\"content center aligned\">\r\n  <figure class=\"wojo notification image margin bottom\">\r\n    <img src=\"[SITEURL]/uploads/images/laguna/icon_13.svg\" alt=\"image Description\"></figure>\r\n  <h6>Awards Won</h6>\r\n  <span class=\"wojo huge demi primary text\">3000</span></div>\r\n  </div>\r\n</div>\r\n    </div>\r\n  </div>\r\n</div>\r\n<div class=\"section\" style=\"padding:96px 0 64px 0\">\r\n  <div class=\"wojo-grid\">\r\n    <div class=\"row big gutters align center\">\r\n<div class=\"columns screen-50 tablet-70 mobile-100 phone-100\">\r\n  <div data-weditable=\"true\" class=\"center aligned\">\r\n<span class=\"wojo primary inverted label\">Pricing</span>\r\n<h3 class=\"divided margin top\">Our <span class=\"wojo primary text\">Pricing</span></h3>\r\n<p>Staying focused allows us to turn every project we complete into something we love.</p>\r\n  </div>\r\n</div>\r\n    </div>\r\n    <div class=\"row gutters\">\r\n<div class=\"columns mobile-100 phone-100\">\r\n  <div class=\"wojo simple basic attached card\" data-weditable=\"true\">\r\n<div class=\"content center aligned\">\r\n  <h5>Basic</h5>\r\n  <figure class=\"wojo medium image\">\r\n    <img src=\"[SITEURL]/uploads/images/laguna/laguna_hosting.svg\" alt=\"image Description\"></figure>\r\n  <div class=\"vertical margin\">\r\n    <span class=\"wojo bold huge text\">$39</span>\r\n    <span class=\"wojo dimmed text\">monthly</span>\r\n  </div>\r\n  <div class=\"wojo fluid relaxed list big margin bottom\">\r\n    <div class=\"item align center\">1 Gb Diskspace</div>\r\n    <div class=\"item align center\">10 Gb Bandwith</div>\r\n    <div class=\"item align center\">2 Email Adress</div>\r\n    <div class=\"item align center\">Cms Pro Installs</div>\r\n    <div class=\"item align center\">Private Support</div>\r\n  </div>\r\n  <a href=\"#!\" data-type=\"button\" class=\"wojo primary right button fluid\">Read More<i class=\"icon long arrow right\"></i></a>\r\n</div>\r\n  </div>\r\n</div>\r\n<div class=\"columns mobile-100 phone-100\">\r\n  <div class=\"wojo basic attached card\" data-weditable=\"true\">\r\n<div class=\"wojo bookmark\">Popular</div>\r\n<div class=\"content center aligned\">\r\n  <h5>Premium</h5>\r\n  <figure class=\"wojo medium image\">\r\n    <img src=\"[SITEURL]/uploads/images/laguna/laguna_hosting.svg\" alt=\"image Description\"></figure>\r\n  <div class=\"vertical margin\">\r\n    <span class=\"wojo bold huge text\">$49</span>\r\n    <span class=\"wojo dimmed text\">monthly</span>\r\n  </div>\r\n  <div class=\"wojo fluid relaxed list big margin bottom\">\r\n    <div class=\"item align center\">4 Gb Diskspace</div>\r\n    <div class=\"item align center\">50 Gb Bandwith</div>\r\n    <div class=\"item align center\">4 Email Adress</div>\r\n    <div class=\"item align center\">Cms Pro Installs</div>\r\n    <div class=\"item align center\">Private Support</div>\r\n  </div>\r\n  <a href=\"#!\" data-type=\"button\" class=\"wojo primary right button fluid\">Read More<i class=\"icon long arrow right\"></i></a>\r\n</div>\r\n  </div>\r\n</div>\r\n<div class=\"columns mobile-100 phone-100\">\r\n  <div class=\"wojo simple basic attached card\" data-weditable=\"true\">\r\n<div class=\"content center aligned\">\r\n  <h5>Business</h5>\r\n  <figure class=\"wojo medium image\">\r\n    <img src=\"[SITEURL]/uploads/images/laguna/laguna_hosting.svg\" alt=\"image Description\"></figure>\r\n  <div class=\"vertical margin\">\r\n    <span class=\"wojo bold huge text\">$54</span>\r\n    <span class=\"wojo dimmed text\">monthly</span>\r\n  </div>\r\n  <div class=\"wojo fluid relaxed list big margin bottom\">\r\n    <div class=\"item align center\">20 Gb Diskspace</div>\r\n    <div class=\"item align center\">100 Gb Bandwith</div>\r\n    <div class=\"item align center\">10 Email Adress</div>\r\n    <div class=\"item align center\">Cms Pro Installs</div>\r\n    <div class=\"item align center\">Private Support</div>\r\n  </div>\r\n  <a href=\"#!\" data-type=\"button\" class=\"wojo primary right button fluid\">Read More<i class=\"icon long arrow right\"></i></a>\r\n</div>\r\n  </div>\r\n</div>\r\n    </div>\r\n  </div>\r\n</div>\r\n<div class=\"section\" style=\"background-color: #f2f2fe;padding:96px 0 64px 0\">\r\n  <div class=\"wojo-grid\">\r\n    <div class=\"row big gutters align center\">\r\n<div class=\"columns screen-50 tablet-70 mobile-100 phone-100\">\r\n  <div data-weditable=\"true\" class=\"center aligned\">\r\n<span class=\"wojo primary inverted label\">Plugins</span>\r\n<h3 class=\"divided margin top\">Our <span class=\"wojo primary text\">Plugins</span></h3>\r\n<p>Both of these plugins are included in cms pro base package.</p>\r\n  </div>\r\n</div>\r\n    </div>\r\n    <div class=\"row gutters\">\r\n<div class=\"columns tablet-100 mobile-100 phone-100\"> %%donation/paypal|plugin|1|13%% </div>\r\n<div class=\"columns tablet-100 mobile-100 phone-100\"> %%poll/install|plugin|1|3%% </div>\r\n    </div>\r\n  </div>\r\n</div>', '\"\"', 'testimonials,carousel,plugin', 'CLIENTS & TESTIMONIALS\r\n- Create unlimited carousels, with built in carousel plugin -\r\n\r\n%%carousel/testimonials|plugin|1|23%%', '2012-01-03 04:08:53', 1, 'Web Master', 0, 1);
INSERT INTO `pages` (`id`, `title_en`, `slug_en`, `caption_en`, `is_admin`, `page_type`, `membership_id`, `is_comments`, `custom_bg_en`, `show_header`, `theme`, `access`, `body_en`, `jscode`, `keywords_en`, `description_en`, `created`, `created_by`, `created_by_name`, `is_system`, `active`) VALUES(14, 'Login Page', 'login', NULL, 1, 'login', '0', 0, NULL, 1, NULL, 'Public', NULL, NULL, '', '', '2014-04-27 22:11:36', 1, 'Web Master', 1, 1);
INSERT INTO `pages` (`id`, `title_en`, `slug_en`, `caption_en`, `is_admin`, `page_type`, `membership_id`, `is_comments`, `custom_bg_en`, `show_header`, `theme`, `access`, `body_en`, `jscode`, `keywords_en`, `description_en`, `created`, `created_by`, `created_by_name`, `is_system`, `active`) VALUES(15, 'User Registration', 'registration', NULL, 1, 'register', '0', 0, NULL, 1, NULL, 'Public', NULL, NULL, '', '', '2014-04-28 01:22:53', 1, 'Web Master', 1, 1);
INSERT INTO `pages` (`id`, `title_en`, `slug_en`, `caption_en`, `is_admin`, `page_type`, `membership_id`, `is_comments`, `custom_bg_en`, `show_header`, `theme`, `access`, `body_en`, `jscode`, `keywords_en`, `description_en`, `created`, `created_by`, `created_by_name`, `is_system`, `active`) VALUES(16, 'Account Acctivation', 'activate', '', 1, 'activate', '0', 0, '', 1, NULL, 'Public', NULL, '\"\"', '', '', '2014-04-28 13:08:29', 1, 'Web Master', 1, 1);
INSERT INTO `pages` (`id`, `title_en`, `slug_en`, `caption_en`, `is_admin`, `page_type`, `membership_id`, `is_comments`, `custom_bg_en`, `show_header`, `theme`, `access`, `body_en`, `jscode`, `keywords_en`, `description_en`, `created`, `created_by`, `created_by_name`, `is_system`, `active`) VALUES(17, 'User Dashboard', 'dashboard', NULL, 1, 'account', '0', 0, NULL, 1, NULL, 'Public', NULL, NULL, '', '', '2014-04-28 14:06:43', 1, 'Web Master', 1, 1);
INSERT INTO `pages` (`id`, `title_en`, `slug_en`, `caption_en`, `is_admin`, `page_type`, `membership_id`, `is_comments`, `custom_bg_en`, `show_header`, `theme`, `access`, `body_en`, `jscode`, `keywords_en`, `description_en`, `created`, `created_by`, `created_by_name`, `is_system`, `active`) VALUES(18, 'How can we help?', 'search', 'Search our site', 1, 'search', '0', 0, '', 1, NULL, 'Public', NULL, '', '', '', '2014-04-29 23:32:44', 1, 'Web Master', 1, 1);
INSERT INTO `pages` (`id`, `title_en`, `slug_en`, `caption_en`, `is_admin`, `page_type`, `membership_id`, `is_comments`, `custom_bg_en`, `show_header`, `theme`, `access`, `body_en`, `jscode`, `keywords_en`, `description_en`, `created`, `created_by`, `created_by_name`, `is_system`, `active`) VALUES(19, 'Sitemap', 'sitemap', NULL, 1, 'sitemap', '0', 0, NULL, 1, NULL, 'Public', NULL, NULL, '', '', '2014-05-08 17:00:53', 1, 'Web Master', 1, 1);
INSERT INTO `pages` (`id`, `title_en`, `slug_en`, `caption_en`, `is_admin`, `page_type`, `membership_id`, `is_comments`, `custom_bg_en`, `show_header`, `theme`, `access`, `body_en`, `jscode`, `keywords_en`, `description_en`, `created`, `created_by`, `created_by_name`, `is_system`, `active`) VALUES(20, 'Demo F.A.Q', 'demo-faq', 'Browse our help section', 0, 'normal', '0', 1, '', 1, NULL, 'Public', '<div class=\"section\" style=\"padding:96px 0 64px 0;\">\r\n  <div class=\"wojo-grid\">\r\n    <div class=\"row big gutters\">\r\n<div class=\"columns screen-50 tablet-50 mobile-100 phone-100\">\r\n  <div class=\"big full padding center aligned\" data-weditable=\"true\">\r\n<figure class=\"margin bottom\">\r\n  <img src=\"[SITEURL]/uploads/images/laguna/laguna_office.svg\" alt=\"Pushing Boundaries\">\r\n</figure>\r\n<h5>Using CMS Pro</h5>\r\n<p>Find the answer to any question, from the basics all the way to advanced tips and tricks!</p>\r\n<a class=\"wojo primary button\" data-type=\"button\" href=\"http://ckb.wojoscripts.com\" target=\"_blank\">Browse all article</a>\r\n  </div>\r\n</div>\r\n<div class=\"columns screen-50 tablet-50 mobile-100 phone-100 relative divider\">\r\n  <div class=\"big full padding center aligned\" data-weditable=\"true\">\r\n<figure class=\"margin bottom\">\r\n  <img src=\"[SITEURL]/uploads/images/laguna/laguna_work.svg\" alt=\"Building Site\">\r\n</figure>\r\n<h5>Workspace administration</h5>\r\n<p>Want to learn more about setting up and managing your team? Look no further!</p>\r\n<a class=\"wojo primary button\" data-type=\"button\" href=\"[SITEURL]/admin/\">Browse all article</a>\r\n  </div>\r\n</div>\r\n    </div>\r\n  </div>\r\n</div>\r\n<section style=\"padding:96px 0 64px 0\">\r\n  <div class=\"wojo-grid\">\r\n    <div class=\"row gutters\">\r\n<div class=\"columns\"> %%faq|module|24|0%% </div>\r\n    </div>\r\n  </div>\r\n</section>\r\n<div class=\"section\" style=\"padding:96px 0 64px 0\">\r\n  <div class=\"wojo-grid\">\r\n    <div class=\"row big gutters\">\r\n<div class=\"columns screen-50 tablet-50 mobile-100 phone-100\">\r\n  <div class=\"wojo icon message\" data-weditable=\"true\">\r\n<figure class=\"wojo small image\">\r\n  <img src=\"[SITEURL]/uploads/images/laguna/icon_15.svg\" alt=\"Email us\" class=\"wojo small image\">\r\n</figure>\r\n<div class=\"content left padding\">\r\n  <h5>Can\'t find your answer?</h5>\r\n  <p>We want to answer all of your queries. Get in touch and we\'ll get back to you as soon as we can.</p>\r\n  <a href=\"#\">Email us <i class=\"icon middle chevron right\"></i></a>\r\n</div>\r\n  </div>\r\n</div>\r\n<div class=\"columns screen-50 tablet-50 mobile-100 phone-100 relative divider\">\r\n  <div class=\"wojo icon message\" data-weditable=\"true\">\r\n<figure class=\"wojo small image margin right\">\r\n  <img src=\"[SITEURL]/uploads/images/laguna/icon_18.svg\" alt=\"Have a question\" class=\"wojo small image\">\r\n</figure>\r\n<div class=\"content left padding\">\r\n  <h5>Technical questions</h5>\r\n  <p>Have some technical questions? Hit us on community page or just say hello..</p>\r\n  <a href=\"#\">Open ticket <i class=\"icon middle chevron right\"></i></a>\r\n</div>\r\n  </div>\r\n</div>\r\n    </div>\r\n  </div>\r\n</div>\r\n', '', '', '', '2014-06-02 21:06:27', 1, 'Web Master', 0, 1);
INSERT INTO `pages` (`id`, `title_en`, `slug_en`, `caption_en`, `is_admin`, `page_type`, `membership_id`, `is_comments`, `custom_bg_en`, `show_header`, `theme`, `access`, `body_en`, `jscode`, `keywords_en`, `description_en`, `created`, `created_by`, `created_by_name`, `is_system`, `active`) VALUES(21, 'Profile', 'profile', 'Public User Profile', 0, 'profile', '0', 0, NULL, 1, NULL, 'Public', NULL, NULL, '', '', '2014-11-14 23:27:25', 1, 'Web Master', 1, 1);
INSERT INTO `pages` (`id`, `title_en`, `slug_en`, `caption_en`, `is_admin`, `page_type`, `membership_id`, `is_comments`, `custom_bg_en`, `show_header`, `theme`, `access`, `body_en`, `jscode`, `keywords_en`, `description_en`, `created`, `created_by`, `created_by_name`, `is_system`, `active`) VALUES(22, 'Privacy Policy', 'privacy-policy', 'Privacy Policy', 1, 'policy', '0', 0, '', 1, NULL, 'Public', '<div class=\"section\" style=\"padding:64px 0\">\r\n    <div class=\"wojo-grid\">\r\n<div class=\"row align center\">\r\n<div class=\"columns screen-70 tablet-100 mobile-100 phone-100\">\r\n<div class=\"wojo fitted card\">\r\n  <div class=\"header relative wojo primary gradient\">\r\n<div class=\"big full padding\">\r\n<h1 class=\"wojo white semi text\">Privacy &amp; Policy</h1>\r\n<p class=\"wojo white dimmed text padding bottom\">Last modified: March 27, 2018</p>\r\n</div>\r\n<figure class=\"absolute\" style=\"bottom:0;left:0;width:100%;\">\r\n<svg preserveAspectRatio=\"none\" xmlns=\"http://www.w3.org/2000/svg\" width=\"100%\" height=\"140px\" style=\"margin-bottom:-32px\" viewBox=\"20 -20 300 100\"  xml:space=\"preserve\">\r\n  <path d=\"M30.913 43.944s42.911-34.464 87.51-14.191c77.31 35.14 113.304-1.952 146.638-4.729 48.654-4.056 69.94 16.218 69.94 16.218v54.396H30.913V43.944z\" class=\"wojo white fill\" opacity=\".4\"/>\r\n  <path d=\"M-35.667 44.628s42.91-34.463 87.51-14.191c77.31 35.141 113.304-1.952 146.639-4.729 48.653-4.055 69.939 16.218 69.939 16.218v54.396H-35.667V44.628z\" class=\"wojo white fill\" opacity=\".4\"/>\r\n  <path d=\"M-34.667 62.998s56-45.667 120.316-27.839C167.484 57.842 197 41.332 232.286 30.428c53.07-16.399 104.047 36.903 104.047 36.903l1.333 36.667-372-2.954-.333-38.046z\" class=\"wojo white fill\"/>\r\n</svg>\r\n</figure>\r\n  </div>\r\n  <div class=\"content\">\r\n<p>My Company (\"us\", \"we\", or \"our\") operates http://www.mysite.com  (the\r\n\"Site\"). This page informs you of our policies regarding the\r\ncollection, use and disclosure of Personal Information we receive from users of\r\nthe Site.</p>\r\n<p>We use your Personal Information only for providing and\r\nimproving the Site. By using the Site, you agree to the collection and use of\r\ninformation in accordance with this policy.<br>\r\n<br>\r\n</p>\r\n<p><b>Information\r\nCollection And Use</b></p>\r\n<p>While using our Site, we may ask you to provide us with\r\ncertain personally identifiable information that can be used to contact or\r\nidentify you. Personally identifiable information may include, but is not\r\nlimited to your name (\"Personal Information\").<br>\r\n<br>\r\n<br>\r\n</p>\r\n<p><b>Log Data</b></p>\r\n<p>Like many site operators, we collect information that your\r\nbrowser sends whenever you visit our Site (\"Log Data\").</p>\r\n<p>This Log Data may include information such as your\r\ncomputer\'s Internet Protocol (\"IP\") address, browser type, browser\r\nversion, the pages of our Site that you visit, the time and date of your visit,\r\nthe time spent on those pages and other statistics.</p>\r\n<p>In addition, we may use third party services such as Google\r\nAnalytics that collect, monitor and analyze this …<br>\r\n<br>\r\n<br>\r\n</p>\r\n<p><b>Communications</b></p>\r\n<p>We may use your Personal Information to contact you with\r\nnewsletters, marketing or promotional materials and other information that ...<br>\r\n<br>\r\n<br>\r\n</p>\r\n<p><b>Cookies</b></p>\r\n<p>Cookies are files with small amount of data, which may\r\ninclude an anonymous unique identifier. Cookies are sent to your browser from a\r\nweb site and stored on your computer\'s hard drive.</p>\r\n<p>Like many sites, we use \"cookies\" to collect\r\ninformation. You can instruct your browser to refuse all cookies or to indicate\r\nwhen a cookie is being sent. However, if you do not accept cookies, you may not\r\nbe able to use some portions of our Site.<br>\r\n<br>\r\n<br>\r\n</p>\r\n<p><b>Security</b></p>\r\n<p>The security of your Personal Information is important to\r\nus, but remember that no method of transmission over the Internet, or method of\r\nelectronic storage, is 100% secure. While we strive to use commercially\r\nacceptable means to protect your Personal Information, we cannot guarantee its\r\nabsolute security.<br>\r\n<br>\r\n<br>\r\n</p>\r\n<p><b>Changes To This\r\nPrivacy Policy</b></p>\r\n<p>This Privacy Policy is effective as of (October 20. 2017) and will remain in effect except\r\nwith respect to any changes in its provisions in the future, which will be in\r\neffect immediately after being posted on this page.</p>\r\n<p>We reserve the right to update or change our Privacy Policy\r\nat any time and you should check this Privacy Policy periodically. Your\r\ncontinued use of the Service after we post any modifications to the Privacy\r\nPolicy on this page will constitute your acknowledgment of the modifications\r\nand your consent to abide and be bound by the modified Privacy Policy.</p>\r\n<p>If we make any material changes to this Privacy Policy, we\r\nwill notify you either through the email address you have provided us, or by\r\nplacing a prominent notice on our website.<br>\r\n<br>\r\n<br>\r\n</p>\r\n<p><b>Contact Us</b></p>\r\n<p>If you have any questions about this Privacy Policy, please <a href=\"[SITEURL]/page/our-contact-info\">contact us.</a>\r\n</p>\r\n  </div>\r\n</div>\r\n</div>\r\n</div>\r\n    </div>\r\n  </div>', '\"\"', '', '', '2018-06-20 05:27:26', 1, 'Web Master', 1, 1);
INSERT INTO `pages` (`id`, `title_en`, `slug_en`, `caption_en`, `is_admin`, `page_type`, `membership_id`, `is_comments`, `custom_bg_en`, `show_header`, `theme`, `access`, `body_en`, `jscode`, `keywords_en`, `description_en`, `created`, `created_by`, `created_by_name`, `is_system`, `active`) VALUES(23, 'Visual Forms', 'visual-forms', '', 0, 'normal', '0', 0, '', 1, NULL, 'Public', '<div class=\"section\" style=\"background-color:#f2f2fe;padding:128px 0 96px 0\">\r\n  <div class=\"wojo-grid\">\r\n    <div class=\"row gutters align center\">\r\n<div class=\"columns screen-60 tablet-70 mobile-100 phone-100\">\r\n  <div class=\"center aligned\" data-weditable=\"true\">\r\n<h4 class=\"divided\">Get Laguna <span class=\"wojo primary text\">App</span></h4>\r\n<p>Laguna works across desktops and mobile devices, for native apps or web sites and prototypes.</p>\r\n<figure class=\"wojo fluid image top margin\">\r\n  <img src=\"[SITEURL]/uploads/images/laguna/laguna_about-img.jpg\" alt=\"Image Desfription\">\r\n</figure>\r\n  </div>\r\n</div>\r\n    </div>\r\n  </div>\r\n</div>\r\n<div class=\"section\" style=\"padding:64px 0\">\r\n  <div class=\"wojo-grid\">\r\n    <div class=\"row gutters align center\">\r\n<div class=\"columns screen-80 tablet-90 mobile-100 phone-100\">%%forms|module|30|1%%</div>\r\n    </div>\r\n  </div>\r\n</div>\r\n<div class=\"section\" style=\"background-color: #f2f2fe;padding: 64px 0 32px 0;\">\r\n  <div class=\"wojo-grid\">\r\n    <div class=\"row gutters\">\r\n<div class=\"columns screen-25 tablet-25 mobile-50 phone-100\">\r\n  <div class=\"wojo basic segment center aligned\" data-weditable=\"true\">\r\n<div class=\"wojo huge bold text\">18298</div>\r\n<p class=\"wojo demi caps text\">Web Developers</p>\r\n  </div>\r\n</div>\r\n<div class=\"columns screen-25 tablet-25 mobile-50 phone-100\">\r\n  <div class=\"wojo basic segment center aligned\" data-weditable=\"true\">\r\n<div class=\"wojo huge bold text\">24583</div>\r\n<p class=\"wojo demi caps text\">Designers</p>\r\n  </div>\r\n</div>\r\n<div class=\"columns screen-25 tablet-25 mobile-50 phone-100\">\r\n  <div class=\"wojo basic segment center aligned\" data-weditable=\"true\">\r\n<div class=\"wojo huge bold text\">37904</div>\r\n<p class=\"wojo demi caps text\">Open Contests</p>\r\n  </div>\r\n</div>\r\n<div class=\"columns screen-25 tablet-25 mobile-50 phone-100\">\r\n  <div class=\"wojo basic segment center aligned\" data-weditable=\"true\">\r\n<div class=\"wojo huge bold text\">50892</div>\r\n<p class=\"wojo demi caps text\">Happy Customers</p>\r\n  </div>\r\n</div>\r\n    </div>\r\n  </div>\r\n</div>', '\"\"', '', '', '2021-03-22 17:33:24', 1, 'Web Master', 0, 1);
INSERT INTO `pages` (`id`, `title_en`, `slug_en`, `caption_en`, `is_admin`, `page_type`, `membership_id`, `is_comments`, `custom_bg_en`, `show_header`, `theme`, `access`, `body_en`, `jscode`, `keywords_en`, `description_en`, `created`, `created_by`, `created_by_name`, `is_system`, `active`) VALUES(24, 'Demo Page', 'demo', NULL, 1, 'normal', '0', 0, NULL, 1, NULL, 'Public', '<div class=\"section\" style=\"padding:96px 0 64px 0\">\n  <div class=\"wojo-grid\">\n    <div class=\"row\">\n<div class=\"columns\">\n  \n  \n  <div class=\"wojo attached basic card\" data-weditable=\"true\">  \n    <div class=\"row\">  \n<div class=\"columns\">  \n  <figure class=\"wojo full left zoom rounded image\">  \n<img src=\"[SITEURL]/uploads/images/laguna/laguna_busy-street.jpg\" alt=\"Image Description\">\n  </figure>\n</div>\n<div class=\"columns screen-60 tablet-60 mobile-50 phone-100\">  \n  <div class=\"full large padding\">  \n<span class=\"wojo primary inverted label\" data-weditable=\"true\" data-type=\"label\">\n  Newsletters\n</span>\n<h4 class=\"margin top\">\n  Sign up to get exclusives discounts and any other deals everyday\n</h4>\n<p class=\"mb3\">\n  Stay tuned with news and best deals. No spam, only truly and helpful contents guarantee.\n</p>\n<form id=\"wojo_form_newsletter\" name=\"wojo_form_newsletter\" method=\"post\" class=\"wojo form\">  \n  <div class=\"wojo action inline input\">  \n    <input type=\"email\" name=\"email\" placeholder=\"Email\">\n    <button type=\"button\" data-weditable=\"true\" data-type=\"button\" data-url=\"plugins_/newsletter\" data-hide=\"true\" data-action=\"processNewsletter\" name=\"dosubmit\" class=\"wojo primary right button\">  Subscribe\n<i class=\"icon paper plane\">\n  \n</i>\n    </button>\n  </div>\n</form>\n  </div>\n</div>\n    </div>\n  </div>\n</div>\n    </div>\n  </div>\n</div>', NULL, NULL, NULL, '2021-03-22 18:11:51', 0, NULL, 0, 1);


--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `txn_id` varchar(50) DEFAULT NULL,
  `membership_id` int(11) unsigned NOT NULL DEFAULT '0',
  `user_id` int(11) unsigned NOT NULL DEFAULT '0',
  `rate_amount` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `tax` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `coupon` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `total` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `currency` varchar(4) DEFAULT NULL,
  `pp` varchar(20) NOT NULL DEFAULT 'Stripe',
  `ip` varbinary(16) DEFAULT '000.000.000.000',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_membership` (`membership_id`),
  KEY `idx_user` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table structure for table `plugins`
--

DROP TABLE IF EXISTS `plugins`;
CREATE TABLE IF NOT EXISTS `plugins` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title_en` varchar(120) NOT NULL,
  `body_en` text,
  `jscode` text,
  `show_title` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `alt_class` varchar(30) DEFAULT NULL,
  `system` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `cplugin` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `info_en` varchar(150) DEFAULT NULL,
  `plugalias` varchar(50) DEFAULT NULL,
  `hasconfig` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `multi` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `parent_id` int(11) unsigned NOT NULL DEFAULT '0',
  `plugin_id` int(11) unsigned NOT NULL DEFAULT '0',
  `groups` varchar(20) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `icon` varchar(60) DEFAULT NULL,
  `ver` decimal(4,2) NOT NULL DEFAULT '1.00',
  `active` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_plugin_id` (`plugin_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `plugins`
--

INSERT INTO `plugins` VALUES(1, 'Universal Slider', NULL, NULL, 0, NULL, 1, 0, NULL, 'slider', 1, 1, 0, 0, 'slider', '2016-06-18 06:28:53', 'slider/thumb.svg', '1.00', 1);
INSERT INTO `plugins` VALUES(2, 'Ajax Poll', NULL, NULL, 0, NULL, 1, 1, NULL, 'poll', 1, 1, 0, 0, 'poll', '2016-06-18 06:30:15', 'poll/thumb.svg', '1.00', 1);
INSERT INTO `plugins` VALUES(3, 'How do you find CMS pro! Installation?', NULL, NULL, 0, 'primary', 1, 1, NULL, 'poll/install', 0, 0, 2, 1, 'poll', '2016-06-18 06:31:45', 'poll/thumb.svg', '1.00', 1);
INSERT INTO `plugins` VALUES(4, 'What is the best CMS?', NULL, NULL, 0, NULL, 1, 0, NULL, 'poll/cms', 0, 0, 2, 2, 'poll', '2016-06-18 06:36:05', 'poll/thumb.svg', '1.00', 1);
INSERT INTO `plugins` VALUES(7, 'Content Slider', NULL, NULL, 0, NULL, 1, 1, NULL, 'slider/demo', 0, 0, 1, 1, 'slider', '2016-06-18 06:37:15', 'slider/thumb.svg', '1.00', 1);
INSERT INTO `plugins` VALUES(9, 'Rss Feed', NULL, NULL, 0, NULL, 1, 1, NULL, 'rss', 1, 1, 0, 0, 'rss', '2016-09-30 16:58:22', 'rss/thumb.svg', '1.00', 1);
INSERT INTO `plugins` VALUES(10, 'CTV Top Stories', NULL, NULL, 0, NULL, 1, 0, NULL, 'rss/ctv', 0, 0, 9, 1, 'rss', '2016-10-01 07:44:52', 'rss/thumb.svg', '1.00', 1);
INSERT INTO `plugins` VALUES(11, 'Yahoo Feed', NULL, NULL, 0, NULL, 1, 0, NULL, 'rss/yahoo', 0, 0, 9, 2, 'rss', '2016-10-01 07:46:22', 'rss/thumb.svg', '1.00', 1);
INSERT INTO `plugins` VALUES(12, 'Donate', NULL, NULL, 0, NULL, 1, 1, NULL, 'donation', 1, 1, 0, 0, 'donation', '2016-10-02 09:14:27', 'donation/thumb.svg', '1.00', 1);
INSERT INTO `plugins` VALUES(13, 'Paypal Donations', 'Help us raise $150 with a matching gift opportunity.', NULL, 1, NULL, 1, 0, NULL, 'donation/paypal', 0, 0, 12, 1, 'donation', '2016-10-02 11:20:02', 'donation/thumb.svg', '1.00', 1);
INSERT INTO `plugins` VALUES(14, 'Paypal Donations II', NULL, NULL, 0, NULL, 1, 0, NULL, 'donation/paypal_alt', 0, 0, 12, 2, 'donation', '2016-10-02 11:20:46', 'donation/thumb.svg', '1.00', 1);
INSERT INTO `plugins` VALUES(15, 'Latest Twitts', NULL, NULL, 0, NULL, 1, 1, NULL, 'twitts', 1, 0, 0, 0, 'twitts', '2016-10-02 18:31:04', 'twitts/thumb.svg', '1.00', 1);
INSERT INTO `plugins` VALUES(16, 'Upcoming Events', NULL, NULL, 1, NULL, 1, 1, NULL, 'upevent', 1, 0, 0, 0, 'upevent', '2016-10-18 15:30:27', 'upevent/thumb.svg', '1.00', 1);
INSERT INTO `plugins` VALUES(20, 'Head Office', NULL, NULL, 0, NULL, 1, 1, NULL, 'gmaps/head-office', 0, 0, 0, 1, 'gmaps', '2016-11-22 16:22:56', 'gmaps/thumb.svg', '1.00', 1);
INSERT INTO `plugins` VALUES(21, 'Default Campaign', NULL, '', 0, '', 1, 1, '', 'adblock/wojo-advert', 0, 0, 0, 1, 'adblock', '2016-12-30 19:02:28', 'adblock/thumb.svg', '1.00', 1);
INSERT INTO `plugins` VALUES(22, 'Universal Carousel', NULL, NULL, 0, NULL, 1, 0, NULL, 'carousel', 1, 1, 0, 0, 'carousel', '2017-01-11 16:19:47', 'carousel/thumb.svg', '1.00', 1);
INSERT INTO `plugins` VALUES(23, 'Testimonials', NULL, NULL, 0, NULL, 1, 1, NULL, 'carousel/testimonials', 0, 0, 22, 1, 'carousel', '2017-01-11 17:55:40', 'carousel/thumb.svg', '1.00', 1);
INSERT INTO `plugins` VALUES(24, 'Testimonial', '<div class=\"relative\" style=\"background-image: linear-gradient(150deg, #2d1582 0%, #19a0ff 100%);background-repeat: repeat-x; padding:8rem 0\">\r\n  <div class=\"wojo-grid\">\r\n    <div class=\"row align-center\">\r\n<div class=\"columns content-center screen-60\">\r\n<figure class=\"wojo small circular image\">\r\n<img src=\"[SITEURL]/uploads/avatars/avatar_0015.jpg\" alt=\"Image Description\" data-image=\"y2kcy0km1rla\">\r\n</figure>\r\n<div class=\"wojo white thin tall large text margin-bottom\"> The template is really nice and offers quite a large set of options. It\'s beautiful and the coding is done quickly and seamlessly. Thank you! </div>\r\n<h4 class=\"wojo warning text\">Maria Muszynska</h4>\r\n</div>\r\n    </div>\r\n  </div>\r\n  <figure class=\"absolute\" style=\"bottom:-3rem;left:0;width:25%\"><svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"-19 21 8 8\">\r\n<path fill=\"#FFF\" d=\"M-15.3 26.5c0 .9-.7 1.6-1.6 1.6-.7 0-1.3-.4-1.5-1.1-.2-.5-.3-1.1-.3-1.4 0-1.6.8-2.9 2.5-3.7l.2.5c-1 .4-1.8 1.4-1.8 2.3v.4c.3-.2.6-.3.9-.3.9 0 1.6.8 1.6 1.7zm2.4-1.7c-.3 0-.6.1-.9.3v-.4c0-.9.8-1.9 1.8-2.3l-.2-.5c-1.7.8-2.5 2.1-2.5 3.7 0 .4.1.9.3 1.4.2.6.8 1.1 1.5 1.1.9 0 1.6-.7 1.6-1.6s-.7-1.7-1.6-1.7z\" opacity=\".1\"></path>\r\n    </svg></figure>\r\n  <figure class=\"absolute\" style=\"left:0;bottom:0;width:100%\"><svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" width=\"100%\" height=\"140px\" data-parent=\"#SVGwave1BottomSMShape\" preserveAspectRatio=\"none\" style=\"margin-bottom:-8px\" viewBox=\"0 0 300 100\">\r\n  \r\n<defs>\r\n<path id=\"waveBottom1SMID1\" d=\"M0 0h300v100H0z\"></path>\r\n</defs>\r\n<clipPath id=\"waveBottom1SMID2\">\r\n<use overflow=\"visible\" xlink:href=\"#waveBottom1SMID1\"></use>\r\n</clipPath>\r\n<path fill=\"#fff\" d=\"M10.9 63.9s42.9-34.5 87.5-14.2c77.3 35.1 113.3-2 146.6-4.7 48.7-4 70 16.2 70 16.2v54.4H10.9V63.9z\" clip-path=\"url(#waveBottom1SMID2)\" opacity=\".4\"></path>\r\n<path fill=\"#fff\" d=\"M-55.7 64.6s42.9-34.5 87.5-14.2c77.3 35.1 113.3-2 146.6-4.7 48.7-4.1 69.9 16.2 69.9 16.2v54.4h-304V64.6z\" clip-path=\"url(#waveBottom1SMID2)\" opacity=\".4\"></path>\r\n<path fill=\"#fff\" fill-opacity=\"0\" d=\"M23.4 118.3s48.3-68.9 109.1-68.9c65.9 0 98 67.9 98 67.9v3.7H22.4l1-2.7z\" clip-path=\"url(#waveBottom1SMID2)\" opacity=\".4\"></path>\r\n<path fill=\"#fff\" d=\"M-54.7 83s56-45.7 120.3-27.8c81.8 22.7 111.4 6.2 146.6-4.7 53.1-16.4 104 36.9 104 36.9l1.3 36.7-372-3-.2-38.1z\" clip-path=\"url(#waveBottom1SMID2)\"></path>\r\n    </svg></figure>\r\n</div>', NULL, 0, '', 0, 0, 'Testimonial used on blog page', NULL, 0, 0, 0, 0, NULL, '2017-01-13 18:33:21', NULL, '1.00', 1);
INSERT INTO `plugins` VALUES(25, 'About Us', '<div class=\"sidebar-module\">\r\n  <h4>about us</h4>\r\n  <div class=\"thumbnail-3 thumbnail-mod-2\"><img alt=\"\" src=\"[SITEURL]/uploads/images/services1.jpg\">\r\n    <div class=\"caption\">\r\n<p>Our business solutions are designed around the real needs of businesses, our information resources, tools and... </p>\r\n<a class=\"wojo red button\" href=\"about.html\">learn more</a> </div>\r\n  </div>\r\n</div>', NULL, 0, NULL, 0, 0, NULL, NULL, 0, 0, 0, 0, NULL, '2017-01-17 02:23:52', NULL, '1.00', 1);
INSERT INTO `plugins` VALUES(35, 'Newsletter', NULL, NULL, 0, NULL, 1, 1, NULL, 'newsletter', 1, 0, 0, 0, 'newsletter', '2017-05-27 10:00:20', 'newsletter/thumb.svg', '1.00', 1);

--
-- Table structure for table `plug_carousel`
--

DROP TABLE IF EXISTS `plug_carousel`;
CREATE TABLE IF NOT EXISTS `plug_carousel` (
  `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title_en` varchar(100) NOT NULL,
  `body_en` text,
  `dots` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `nav` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `autoplay` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `margin` smallint(4) UNSIGNED NOT NULL DEFAULT '0',
  `loop` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `settings` blob,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `plug_carousel`
--

INSERT INTO `plug_carousel` VALUES
(1, 'Testimonials', '<div class=\"full big margin\">\r\n  <div class=\"row horizontal gutters\">\r\n    <div class=\"columns screen-30 tablet-30 mobile-100 phone-100\">\r\n<figure class=\"wojo testimonial image\">\r\n  <img src=\"[SITEURL]/uploads/images/laguna/laguna_team-1.jpg\" alt=\"image Description\" class=\"client\">\r\n  <img src=\"[SITEURL]/uploads/images/laguna/laguna_client-shape.png\" alt=\"image Description\" class=\"shape\">\r\n</figure>\r\n</figure>\r\n    </div>\r\n    <div class=\"columns screen-70 tablet-70 mobile-100 phone-100\">\r\n<div class=\"wojo top attached basic card\">\r\n  <div class=\"content\">\r\n<div class=\"wojo icons margin bottom\">\r\n  <i class=\"icon full warning star\"></i>\r\n  <i class=\"icon full warning star\"></i>\r\n  <i class=\"icon full warning star\"></i>\r\n  <i class=\"icon full warning star\"></i>\r\n  <i class=\"icon warning star\"></i>\r\n</div>\r\n<p class=\"wojo large italic text\"> There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form,&nbsp; by injected humour, or randomised words which don\'t look even slightly believable. </p>\r\n<h6 class=\"basic\">James Tilton</h6>\r\n<span class=\"wojo semi primary text\">Theme Customer</span>\r\n  </div>\r\n</div>\r\n    </div>\r\n  </div>\r\n</div>\r\n<div class=\"full big margin\">\r\n  <div class=\"row horizontal gutters\">\r\n    <div class=\"columns screen-30 tablet-30 mobile-100 phone-100\">\r\n<figure class=\"wojo testimonial image\">\r\n  <img src=\"[SITEURL]/uploads/images/laguna/laguna_team-2.jpg\" alt=\"image Description\" class=\"client\">\r\n  <img src=\"[SITEURL]/uploads/images/laguna/laguna_client-shape.png\" alt=\"image Description\" class=\"shape\">\r\n</figure>\r\n</figure>\r\n    </div>\r\n    <div class=\"columns screen-70 tablet-70 mobile-100 phone-100\">\r\n<div class=\"wojo top attached basic card\">\r\n  <div class=\"content\">\r\n<div class=\"wojo icons margin bottom\">\r\n  <i class=\"icon full warning star\"></i>\r\n  <i class=\"icon full warning star\"></i>\r\n  <i class=\"icon full warning star\"></i>\r\n  <i class=\"icon full warning star\"></i>\r\n  <i class=\"icon warning half star\"></i>\r\n</div>\r\n<p class=\"wojo large italic text\"> There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form,&nbsp; by injected humour, or randomised words which don\'t look even slightly believable. </p>\r\n<h6 class=\"basic\">George Terry</h6>\r\n<span class=\"wojo semi primary text\">Theme Customer</span>\r\n  </div>\r\n</div>\r\n    </div>\r\n  </div>\r\n</div>\r\n<div class=\"full big margin\">\r\n  <div class=\"row horizontal gutters\">\r\n    <div class=\"columns screen-30 tablet-30 mobile-100 phone-100\">\r\n<figure class=\"wojo testimonial image\">\r\n  <img src=\"[SITEURL]/uploads/images/laguna/laguna_team-3.jpg\" alt=\"image Description\" class=\"client\">\r\n  <img src=\"[SITEURL]/uploads/images/laguna/laguna_client-shape.png\" alt=\"image Description\" class=\"shape\">\r\n</figure>\r\n</figure>\r\n    </div>\r\n    <div class=\"columns screen-70 tablet-70 mobile-100 phone-100\">\r\n<div class=\"wojo top attached basic card\">\r\n  <div class=\"content\">\r\n<div class=\"wojo icons margin bottom\">\r\n  <i class=\"icon full warning star\"></i>\r\n  <i class=\"icon full warning star\"></i>\r\n  <i class=\"icon full warning star\"></i>\r\n  <i class=\"icon full warning star\"></i>\r\n  <i class=\"icon full warning star\"></i>\r\n</div>\r\n<p class=\"wojo large italic text\"> There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form,&nbsp; by injected humour, or randomised words which don\'t look even slightly believable. </p>\r\n<h6 class=\"basic\">Alex Johnson</h6>\r\n<span class=\"wojo semi primary text\">Theme Customer</span>\r\n  </div>\r\n</div>\r\n    </div>\r\n  </div>\r\n</div>', 0, 1, 0, 0, 0, 0x7b22646f7473223a66616c73652c226e6176223a747275652c226175746f706c6179223a66616c73652c226d617267696e223a302c226c6f6f70223a66616c73652c22726573706f6e73697665223a7b2230223a7b226974656d73223a317d2c22373639223a7b226974656d73223a317d2c2231303234223a7b226974656d73223a317d7d7d);

--
-- Table structure for table `plug_donation`
--

DROP TABLE IF EXISTS `plug_donation`;
CREATE TABLE IF NOT EXISTS `plug_donation` (
  `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(80) DEFAULT NULL,
  `target_amount` decimal(12,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `pp_email` varchar(80) NOT NULL,
  `redirect_page` int(1) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `plug_donation`
--

INSERT INTO `plug_donation` VALUES(1, 'Paypa Donations', '150.00', 'webmaster@paypal.com', 1);
INSERT INTO `plug_donation` VALUES(2, 'Paypa Donations II', '2500.00', 'webmaster@paypal.com', 1);

--
-- Table structure for table `plug_donation_data`
--

DROP TABLE IF EXISTS `plug_donation_data`;
CREATE TABLE IF NOT EXISTS `plug_donation_data` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `amount` decimal(12,2) UNSIGNED NOT NULL DEFAULT '0.00',
  `name` varchar(80) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `pp` varchar(50) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_parent_id` (`parent_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `plug_donation_data`
--

INSERT INTO `plug_donation_data` VALUES(1, 1, '12.00', 'Timothy Fields', 'jrussell1@ameblo.jp', 'PayPal', '2016-10-02 11:23:40');
INSERT INTO `plug_donation_data` VALUES(2, 1, '15.00', 'Keith Butler', 'kmontgomery8@jigsy.com', 'PayPal', '2016-10-02 11:23:47');

--
-- Table structure for table `plug_newsletter`
--

DROP TABLE IF EXISTS `plug_newsletter`;
CREATE TABLE IF NOT EXISTS `plug_newsletter` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(100) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table structure for table `plug_poll_options`
--

DROP TABLE IF EXISTS `plug_poll_options`;
CREATE TABLE IF NOT EXISTS `plug_poll_options` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `question_id` int(11) UNSIGNED NOT NULL,
  `value` varchar(150) NOT NULL,
  `position` tinyint(2) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_question` (`question_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `plug_poll_options`
--

INSERT INTO `plug_poll_options` VALUES(4, 1, 'Hard', 4);
INSERT INTO `plug_poll_options` VALUES(3, 1, 'Easy', 3);
INSERT INTO `plug_poll_options` VALUES(2, 1, 'Very Easy', 2);
INSERT INTO `plug_poll_options` VALUES(1, 1, 'Piece of cake', 1);
INSERT INTO `plug_poll_options` VALUES(5, 2, 'CMS PRO', 1);
INSERT INTO `plug_poll_options` VALUES(6, 2, 'Wordpress', 2);
INSERT INTO `plug_poll_options` VALUES(7, 2, 'Joomla', 3);
INSERT INTO `plug_poll_options` VALUES(8, 2, 'Drupal', 4);

--
-- Table structure for table `plug_poll_questions`
--

DROP TABLE IF EXISTS `plug_poll_questions`;
CREATE TABLE IF NOT EXISTS `plug_poll_questions` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `question` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `plug_poll_questions`
--

INSERT INTO `plug_poll_questions` VALUES(1, 'How do you find CMS pro! Installation?', '2010-10-14 03:42:18', 1);
INSERT INTO `plug_poll_questions` VALUES(2, 'What is the best CMS?', '2016-06-16 13:07:11', 1);

--
-- Table structure for table `plug_poll_votes`
--

DROP TABLE IF EXISTS `plug_poll_votes`;
CREATE TABLE IF NOT EXISTS `plug_poll_votes` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `option_id` int(11) UNSIGNED NOT NULL,
  `voted_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ip` varbinary(16) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_option` (`option_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `plug_poll_votes`
--

INSERT INTO `plug_poll_votes` VALUES(1, 2, '2010-10-15 10:00:55', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(2, 1, '2010-10-15 10:01:27', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(3, 1, '2010-10-15 10:02:04', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(4, 1, '2010-10-15 10:02:13', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(5, 3, '2010-10-15 10:02:16', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(6, 4, '2010-10-15 10:02:21', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(7, 3, '2010-10-15 10:02:24', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(8, 1, '2010-10-15 10:02:27', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(9, 2, '2010-10-15 10:02:31', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(11, 1, '2010-10-15 10:02:38', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(12, 2, '2010-10-15 10:02:43', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(13, 1, '2010-10-15 10:02:46', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(14, 1, '2010-10-15 10:02:50', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(15, 1, '2010-10-15 10:05:26', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(16, 1, '2010-10-15 10:05:29', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(17, 4, '2010-10-15 10:05:33', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(18, 2, '2010-10-15 10:05:36', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(19, 1, '2010-10-15 10:05:40', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(20, 3, '2010-10-15 10:05:46', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(21, 2, '2010-10-15 10:05:49', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(22, 2, '2010-10-15 10:21:37', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(23, 1, '2010-10-15 10:21:53', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(25, 1, '2010-10-15 10:35:27', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(26, 1, '2010-10-15 20:42:05', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(27, 3, '2010-10-15 20:49:42', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(28, 2, '2010-10-15 21:22:00', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(29, 2, '2010-10-15 21:24:51', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(30, 1, '2010-10-15 21:37:21', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(31, 1, '2010-10-15 21:38:48', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(32, 1, '2010-10-15 21:41:30', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(33, 1, '2010-10-15 21:42:21', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(34, 1, '2010-10-16 00:53:42', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(35, 3, '2010-10-16 01:09:14', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(36, 3, '2010-11-25 22:00:27', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(37, 3, '2010-11-29 01:56:07', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(38, 3, '2012-12-23 22:57:05', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(39, 1, '2012-12-23 23:46:26', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(41, 1, '2012-12-27 21:20:01', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(42, 1, '2014-04-21 08:45:03', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(43, 3, '2014-04-21 08:46:53', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(44, 1, '2014-04-21 08:47:38', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(46, 3, '2014-04-24 13:07:37', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(47, 3, '2014-04-24 13:11:36', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(48, 3, '2014-05-20 13:09:13', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(49, 1, '2014-05-20 13:13:01', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(50, 5, '2016-06-17 14:43:10', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(51, 5, '2016-06-17 14:43:10', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(52, 5, '2016-06-17 14:43:11', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(53, 5, '2016-06-17 14:43:11', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(54, 5, '2016-06-17 14:43:11', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(55, 5, '2016-06-17 14:43:11', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(56, 5, '2016-06-17 14:43:12', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(57, 5, '2016-06-17 14:43:12', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(58, 6, '2016-06-17 14:43:36', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(59, 7, '2016-06-17 14:43:37', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(60, 8, '2016-06-17 14:43:38', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(61, 6, '2016-06-17 14:43:54', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(62, 7, '2016-06-17 14:43:55', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(63, 1, '2017-01-18 16:33:31', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(64, 1, '2017-01-18 16:34:07', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(65, 1, '2017-01-18 17:21:46', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(66, 1, '2017-01-18 18:00:36', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(67, 1, '2017-01-18 18:23:35', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(68, 1, '2017-01-18 18:30:55', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(69, 5, '2017-01-18 18:43:26', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(70, 5, '2017-01-18 18:47:00', 0x3132372e302e302e31);
INSERT INTO `plug_poll_votes` VALUES(71, 5, '2017-01-18 18:48:23', 0x3132372e302e302e31);



--
-- Table structure for table `plug_rss`
--

DROP TABLE IF EXISTS `plug_rss`;
CREATE TABLE IF NOT EXISTS `plug_rss` (
  `id` int(2) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `url` varchar(120) NOT NULL,
  `items` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `show_date` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `show_desc` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `max_words` smallint(4) UNSIGNED NOT NULL DEFAULT '100',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `plug_rss`
--

INSERT INTO `plug_rss` VALUES(1, 'CTV Top Stories', 'http://ctvnews.ca/rss/TopStories', 5, 1, 1, 20);
INSERT INTO `plug_rss` VALUES(2, 'Yahoo Feed', 'https://ca.sports.yahoo.com/nhl/rss.xml', 10, 1, 1, 100);



--
-- Table structure for table `plug_slider`
--

DROP TABLE IF EXISTS `plug_slider`;
CREATE TABLE IF NOT EXISTS `plug_slider` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(80) NOT NULL,
  `type` varchar(15) DEFAULT NULL,
  `layout` varchar(25) DEFAULT NULL,
  `autoplay` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `autoplaySpeed` smallint(1) unsigned NOT NULL DEFAULT '1000',
  `autoplayHoverPause` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `autoloop` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `height` smallint(3) unsigned NOT NULL DEFAULT '100',
  `fullscreen` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `settings` blob,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `plug_slider`
--

INSERT INTO `plug_slider` VALUES
(1, 'Content Slider', 'image', 'standard', 0, 1000, 1, 1, 100, 1, 0x7b226175746f6c6f6f70223a747275652c2266756c6c73637265656e223a302c226175746f706c6179223a66616c73652c226175746f706c61795370656564223a2231303030222c226175746f706c6179486f7665725061757365223a747275652c226c61796f7574223a227374616e64617264222c227468756d6273223a66616c73652c226172726f7773223a747275652c22627574746f6e73223a66616c73657d);

--
-- Table structure for table `plug_slider_data`
--

DROP TABLE IF EXISTS `plug_slider_data`;
CREATE TABLE IF NOT EXISTS `plug_slider_data` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) unsigned NOT NULL DEFAULT '0',
  `title` varchar(50) NOT NULL,
  `html_raw` text,
  `html` text,
  `image` varchar(60) DEFAULT NULL,
  `color` varchar(30) DEFAULT NULL,
  `attrib` varchar(60) DEFAULT NULL,
  `mode` varchar(2) NOT NULL DEFAULT 'bg',
  `sorting` int(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_parent` (`parent_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `plug_slider_data`
--

INSERT INTO `plug_slider_data` VALUES(1, 1, 'slide 1', '<div class=\"uitem\" id=\"item_1\" data-type=\"bg\">\r\n  <div class=\"uimage\" style=\"background-size: cover; background-position: center center; background-repeat: no-repeat; background-image: url([SITEURL]/uploads/images/slider/laguna_slider-1.jpg); min-height: 100vh;\">\r\n    <div class=\"ucontent align center\" style=\"min-height: 100vh;\">\r\n<div class=\"row gutters\" data-id=\"iGsvF2E\">\r\n  <div class=\"columns\">\r\n<div class=\"ws-layer\" data-delay=\"50\" data-duration=\"400\" data-animation=\"fadeInBottom\">\r\n  <span class=\"wojo inverted transparent label\">CMS Pro</span>\r\n</div>\r\n  </div>\r\n</div>\r\n<div class=\"row\" data-id=\"eQSySCB\">\r\n  <div class=\"columns\">\r\n<div class=\"ws-layer\" data-delay=\"200\" data-duration=\"1000\" data-animation=\"fadeInBottom\">\r\n  <h1 class=\"wojo white text\" data-text=\"true\">We Do Your Web <br>\r\n    Designs Carefully.</h1>\r\n  <p class=\"wojo white text\" data-text=\"true\"> It is a long established fact that a reader will be distracted by <br>\r\n    the readable content of a page when looking at its layout. </p>\r\n</div>\r\n  </div>\r\n</div>\r\n    </div>\r\n  </div>\r\n</div>', '<div class=\"row gutters\">\r\n  <div class=\"columns\">\r\n    <div class=\"ws-layer\" data-delay=\"50\" data-duration=\"400\" data-animation=\"fadeInBottom\">\r\n<span class=\"wojo inverted transparent label\">CMS Pro</span>\r\n    </div>\r\n  </div>\r\n</div>\r\n<div class=\"row\">\r\n  <div class=\"columns\">\r\n    <div class=\"ws-layer\" data-delay=\"200\" data-duration=\"1000\" data-animation=\"fadeInBottom\">\r\n<h1 class=\"wojo white text\" data-text=\"true\">We Do Your Web <br>Designs Carefully.</h1>\r\n<p class=\"wojo white text\" data-text=\"true\"> It is a long established fact that a reader will be distracted by <br>the readable content of a page when looking at its layout. </p>\r\n    </div>\r\n  </div>\r\n</div>', 'images/slider/laguna_slider-1.jpg', 'rgba(0, 0, 0, 0)', 'align center', 'bg', 1);
INSERT INTO `plug_slider_data` VALUES(2, 1, 'slide 2', '<div class=\"uitem\" id=\"item_2\" data-type=\"bg\">\r\n  <div class=\"uimage\" style=\"background-size: cover; background-position: center center; background-repeat: no-repeat; background-image: url([SITEURL]/uploads/images/slider/laguna_slider-2.jpg); min-height: 100vh;\">\r\n    <div class=\"ucontent align center\" style=\"min-height: 100vh;\">\r\n<div class=\"row gutters\" data-id=\"FQ27Ayl\">\r\n  <div class=\"column\">\r\n<div class=\"ws-layer\" data-delay=\"50\" data-duration=\"400\" data-animation=\"fadeInBottom\">\r\n  <span class=\"wojo inverted transparent label\">CMS Pro</span>\r\n</div>\r\n  </div>\r\n</div>\r\n<div class=\"row\" data-id=\"dv1hZka\">\r\n  <div class=\"column\">\r\n<div class=\"ws-layer\" data-delay=\"200\" data-duration=\"1000\" data-animation=\"fadeInBottom\">\r\n  <h1 class=\"wojo white text\" data-text=\"true\">Easy Business <br>\r\n    with CMS pro</h1>\r\n  <p class=\"wojo white text\" data-text=\"true\"> It is a long established fact that a reader will be distracted <br>\r\n    by the readable content of a page when looking at its layout. </p>\r\n</div>\r\n  </div>\r\n</div>\r\n    </div>\r\n  </div>\r\n</div>', '<div class=\"row gutters\">\r\n  <div class=\"columns\">\r\n    <div class=\"ws-layer\" data-delay=\"50\" data-duration=\"400\" data-animation=\"fadeInBottom\">\r\n<span class=\"wojo inverted transparent label\">it is on</span>\r\n    </div>\r\n  </div>\r\n</div>\r\n<div class=\"row\">\r\n  <div class=\"columns\">\r\n    <div class=\"ws-layer\" data-delay=\"200\" data-duration=\"1000\" data-animation=\"fadeInBottom\">\r\n<h1 class=\"wojo white text\" data-text=\"true\">Easy Business <br>with CMS pro</h1>\r\n<p class=\"wojo white text\" data-text=\"true\"> It is a long established fact that a reader will be distracted <br>by the readable content of a page when looking at its layout. </p>\r\n    </div>\r\n  </div>\r\n</div>', 'images/slider/laguna_slider-2.jpg', 'rgba(0, 0, 0, 0)', 'align center', 'bg', 2);


--
-- Table structure for table `plug_yplayer`
--

DROP TABLE IF EXISTS `plug_yplayer`;
CREATE TABLE IF NOT EXISTS `plug_yplayer` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `layout` varchar(10) DEFAULT NULL,
  `config` blob,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `plug_yplayer`
--

INSERT INTO `plug_yplayer` VALUES(1, 'Horizontal Player', 'horizontal', 0x7b22706c61796c697374223a66616c73652c226368616e6e656c223a66616c73652c2275736572223a66616c73652c22766964656f73223a2246325546413862745a2d342c49503370487768386b71342c6e3944776f5137485776492c762d3472596630782d46342c326f6e78676d4b543166772c3656704e6b776b53505a6f222c226170695f6b6579223a2259544b4559222c226d61785f726573756c7473223a223530222c22706167696e6174696f6e223a2231222c22636f6e74696e756f7573223a2231222c2273686f775f706c61796c697374223a66616c73652c22706c61796c6973745f74797065223a22686f72697a6f6e74616c222c2273686f775f6368616e6e656c5f696e5f706c61796c697374223a2231222c2273686f775f6368616e6e656c5f696e5f7469746c65223a2231222c226e6f775f706c6179696e675f74657874223a224e6f7720506c6179696e67222c226c6f61645f6d6f72655f74657874223a224c6f6164204d6f7265222c226175746f706c6179223a66616c73652c22666f7263655f6864223a2230222c2273686172655f636f6e74726f6c223a2230222c22636f6c6f7273223a7b22636f6e74726f6c735f6267223a227267626128302c302c302c2e373529222c22627574746f6e73223a2272676261283235352c3235352c3235352c2e3529222c22627574746f6e735f686f766572223a2272676261283235352c3235352c3235352c3129222c22627574746f6e735f616374697665223a2272676261283235352c3235352c3235352c3129222c2274696d655f74657874223a2223464646464646222c226261725f6267223a2272676261283235352c3235352c3235352c2e3529222c22627566666572223a2272676261283235352c3235352c3235352c2e323529222c2266696c6c223a2223464646464646222c22766964656f5f7469746c65223a2223464646464646222c22766964656f5f6368616e6e656c223a2272676261283235352c20302c20302c20302e333529222c22706c61796c6973745f6f7665726c6179223a227267626128302c302c302c2e373529222c22706c61796c6973745f7469746c65223a2223464646464646222c22706c61796c6973745f6368616e6e656c223a2272676261283235352c20302c20302c20302e333529222c227363726f6c6c626172223a2223464646464646222c227363726f6c6c6261725f6267223a2272676261283235352c3235352c3235352c2e323529227d7d);
INSERT INTO `plug_yplayer` VALUES(2, 'Vertical Player', 'vertical', 0x7b22706c61796c697374223a66616c73652c226368616e6e656c223a66616c73652c2275736572223a66616c73652c22766964656f73223a2246325546413862745a2d342c49503370487768386b71342c6e3944776f5137485776492c762d3472596630782d46342c326f6e78676d4b543166772c3656704e6b776b53505a6f222c226170695f6b6579223a2259544b4559222c226d61785f726573756c7473223a223530222c22706167696e6174696f6e223a2231222c22636f6e74696e756f7573223a2231222c2273686f775f706c61796c697374223a66616c73652c22706c61796c6973745f74797065223a22766572746963616c222c2273686f775f6368616e6e656c5f696e5f706c61796c697374223a2231222c2273686f775f6368616e6e656c5f696e5f7469746c65223a2231222c226e6f775f706c6179696e675f74657874223a224e6f7720506c6179696e67222c226c6f61645f6d6f72655f74657874223a224c6f6164204d6f7265222c226175746f706c6179223a66616c73652c22666f7263655f6864223a2230222c2273686172655f636f6e74726f6c223a2230222c22636f6c6f7273223a7b22636f6e74726f6c735f6267223a227267626128302c302c302c2e373529222c22627574746f6e73223a2272676261283235352c3235352c3235352c2e3529222c22627574746f6e735f686f766572223a2272676261283235352c3235352c3235352c3129222c22627574746f6e735f616374697665223a2272676261283235352c3235352c3235352c3129222c2274696d655f74657874223a2223464646464646222c226261725f6267223a2272676261283235352c3235352c3235352c2e3529222c22627566666572223a2272676261283235352c3235352c3235352c2e323529222c2266696c6c223a2223464646464646222c22766964656f5f7469746c65223a2223464646464646222c22766964656f5f6368616e6e656c223a2272676261283235352c20302c20302c20302e333529222c22706c61796c6973745f6f7665726c6179223a227267626128302c302c302c2e373529222c22706c61796c6973745f7469746c65223a2223464646464646222c22706c61796c6973745f6368616e6e656c223a2272676261283235352c20302c20302c20302e333529222c227363726f6c6c626172223a2223464646464646222c227363726f6c6c6261725f6267223a2272676261283235352c3235352c3235352c2e323529227d7d);

--
-- Table structure for table `privileges`
--

DROP TABLE IF EXISTS `privileges`;
CREATE TABLE IF NOT EXISTS `privileges` (
  `id` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` varchar(60) DEFAULT NULL,
  `mode` varchar(8) NOT NULL,
  `type` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `privileges`
--

INSERT INTO `privileges` VALUES(1, 'manage_users', 'Manage Users', 'Permission to add/edit/delete users', 'manage', 'Users');
INSERT INTO `privileges` VALUES(2, 'manage_files', 'Manage Files', 'Permission to access File Manager', 'manage', 'Files');
INSERT INTO `privileges` VALUES(3, 'manage_pages', 'Manage Pages', 'Permission to Add/edit/delete pages', 'manage', 'Pages');
INSERT INTO `privileges` VALUES(4, 'manage_menus', 'Manage Menus', 'Permission to Add/edit and delete menus', 'manage', 'Menus');
INSERT INTO `privileges` VALUES(5, 'manage_email', 'Manage Email Templates', 'Permission to modify email templates', 'manage', 'Emails');
INSERT INTO `privileges` VALUES(6, 'manage_languages', 'Manage Language Phrases', 'Permission to modify language phrases', 'manage', 'Languages');
INSERT INTO `privileges` VALUES(7, 'manage_backup', 'Manage Database Backups', 'Permission to create backups and restore', 'manage', 'Backups');
INSERT INTO `privileges` VALUES(8, 'manage_memberships', 'Manage Memberships', 'Permission to manage memberships', 'manage', 'Memberships');
INSERT INTO `privileges` VALUES(9, 'edit_user', 'Edit Users', 'Permission to edit user', 'edit', 'Users');
INSERT INTO `privileges` VALUES(10, 'add_user', 'Add User', 'Permission to add users', 'add', 'Users');
INSERT INTO `privileges` VALUES(11, 'delete_user', 'Delete Users', 'Permission to delete users', 'delete', 'Users');
INSERT INTO `privileges` VALUES(12, 'manage_plugins', 'Manage Plugins', 'Permission to Add/Edit and delete user plugins', 'manage', 'Plugins');
INSERT INTO `privileges` VALUES(13, 'manage_fields', 'Manage Custom Fields', 'Permission to Add/Edit and delete custom fields', 'manage', 'Fields');
INSERT INTO `privileges` VALUES(14, 'manage_newsletter', 'Manage Newsletter', 'Permission to send newsletter', 'manage', 'Newsletter');
INSERT INTO `privileges` VALUES(15, 'manage_countries', 'Manage Countries', 'Permission to manage countries', 'manage', 'Countries');
INSERT INTO `privileges` VALUES(16, 'manage_coupons', 'Manage Coupons', 'Permission to Add/Edit and delete coupons', 'manage', 'Coupons');
INSERT INTO `privileges` VALUES(17, 'manage_modules', 'Manage Modules', 'Permission to manage all modules', 'manage', 'Modules');
INSERT INTO `privileges` VALUES(18, 'manage_layout', 'Manage Layouts', 'Permission to access layout manager', 'manage', 'Layout');

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` smallint(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(10) NOT NULL,
  `icon` varchar(20) DEFAULT NULL,
  `name` varchar(30) NOT NULL,
  `description` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` VALUES(1, 'owner', 'badge', 'Site Owner', 'Site Owner is the owner of the site, has all privileges and could not be removed.');
INSERT INTO `roles` VALUES(2, 'staff', 'trophy', 'Staff Member', 'The &#34;Staff&#34; members  is required to assist the Owner, has different privileges and may be created by Site Owner.');
INSERT INTO `roles` VALUES(3, 'editor', 'note', 'Editor', 'The "Editor" is required to assist the Staff Members, has different privileges and may be created by Site Owner.');

--
-- Table structure for table `role_privileges`
--

DROP TABLE IF EXISTS `role_privileges`;
CREATE TABLE IF NOT EXISTS `role_privileges` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `rid` int(6) UNSIGNED NOT NULL DEFAULT '0',
  `pid` int(6) UNSIGNED NOT NULL DEFAULT '0',
  `active` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `idx` (`rid`,`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role_privileges`
--

INSERT INTO `role_privileges` VALUES(1, 1, 1, 1);
INSERT INTO `role_privileges` VALUES(2, 2, 1, 1);
INSERT INTO `role_privileges` VALUES(3, 3, 1, 0);
INSERT INTO `role_privileges` VALUES(4, 1, 2, 1);
INSERT INTO `role_privileges` VALUES(5, 2, 2, 1);
INSERT INTO `role_privileges` VALUES(6, 3, 2, 1);
INSERT INTO `role_privileges` VALUES(7, 1, 3, 1);
INSERT INTO `role_privileges` VALUES(8, 2, 3, 1);
INSERT INTO `role_privileges` VALUES(9, 3, 3, 1);
INSERT INTO `role_privileges` VALUES(10, 1, 4, 1);
INSERT INTO `role_privileges` VALUES(11, 2, 4, 1);
INSERT INTO `role_privileges` VALUES(12, 3, 4, 1);
INSERT INTO `role_privileges` VALUES(13, 1, 5, 1);
INSERT INTO `role_privileges` VALUES(14, 2, 5, 1);
INSERT INTO `role_privileges` VALUES(15, 3, 5, 0);
INSERT INTO `role_privileges` VALUES(16, 1, 6, 1);
INSERT INTO `role_privileges` VALUES(17, 2, 6, 1);
INSERT INTO `role_privileges` VALUES(18, 3, 6, 1);
INSERT INTO `role_privileges` VALUES(19, 1, 7, 1);
INSERT INTO `role_privileges` VALUES(20, 2, 7, 1);
INSERT INTO `role_privileges` VALUES(21, 3, 7, 0);
INSERT INTO `role_privileges` VALUES(22, 1, 8, 1);
INSERT INTO `role_privileges` VALUES(23, 2, 8, 1);
INSERT INTO `role_privileges` VALUES(24, 3, 8, 0);
INSERT INTO `role_privileges` VALUES(25, 1, 9, 1);
INSERT INTO `role_privileges` VALUES(26, 2, 9, 1);
INSERT INTO `role_privileges` VALUES(27, 3, 9, 0);
INSERT INTO `role_privileges` VALUES(28, 1, 10, 1);
INSERT INTO `role_privileges` VALUES(29, 2, 10, 1);
INSERT INTO `role_privileges` VALUES(30, 3, 10, 0);
INSERT INTO `role_privileges` VALUES(31, 1, 11, 1);
INSERT INTO `role_privileges` VALUES(32, 2, 11, 1);
INSERT INTO `role_privileges` VALUES(33, 3, 11, 0);
INSERT INTO `role_privileges` VALUES(34, 1, 12, 1);
INSERT INTO `role_privileges` VALUES(35, 2, 12, 1);
INSERT INTO `role_privileges` VALUES(36, 3, 12, 1);
INSERT INTO `role_privileges` VALUES(37, 1, 13, 1);
INSERT INTO `role_privileges` VALUES(38, 2, 13, 1);
INSERT INTO `role_privileges` VALUES(39, 3, 13, 0);
INSERT INTO `role_privileges` VALUES(40, 1, 14, 1);
INSERT INTO `role_privileges` VALUES(41, 2, 14, 1);
INSERT INTO `role_privileges` VALUES(42, 3, 14, 0);
INSERT INTO `role_privileges` VALUES(43, 1, 15, 1);
INSERT INTO `role_privileges` VALUES(44, 2, 15, 1);
INSERT INTO `role_privileges` VALUES(45, 3, 15, 1);
INSERT INTO `role_privileges` VALUES(46, 1, 16, 1);
INSERT INTO `role_privileges` VALUES(47, 2, 16, 1);
INSERT INTO `role_privileges` VALUES(48, 3, 16, 0);
INSERT INTO `role_privileges` VALUES(49, 1, 17, 1);
INSERT INTO `role_privileges` VALUES(50, 2, 17, 1);
INSERT INTO `role_privileges` VALUES(51, 3, 17, 0);
INSERT INTO `role_privileges` VALUES(52, 1, 18, 1);
INSERT INTO `role_privileges` VALUES(53, 2, 18, 1);
INSERT INTO `role_privileges` VALUES(54, 3, 18, 0);

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` tinyint(1) unsigned NOT NULL AUTO_INCREMENT,
  `site_name` varchar(100) NOT NULL,
  `company` varchar(100) NOT NULL,
  `site_dir` varchar(50) DEFAULT NULL,
  `site_email` varchar(50) NOT NULL,
  `theme` varchar(32) NOT NULL,
  `perpage` tinyint(2) unsigned NOT NULL,
  `backup` varchar(64) NOT NULL,
  `thumb_w` tinyint(3) unsigned NOT NULL,
  `thumb_h` tinyint(3) unsigned NOT NULL,
  `img_w` smallint(3) unsigned NOT NULL,
  `img_h` smallint(3) unsigned NOT NULL,
  `avatar_w` tinyint(2) unsigned NOT NULL,
  `avatar_h` tinyint(2) unsigned NOT NULL,
  `short_date` varchar(20) NOT NULL,
  `long_date` varchar(30) NOT NULL,
  `time_format` varchar(10) DEFAULT NULL,
  `calendar_date` varchar(30) DEFAULT NULL,
  `dtz` varchar(120) DEFAULT NULL,
  `locale` varchar(200) DEFAULT NULL,
  `weekstart` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `lang` varchar(2) NOT NULL DEFAULT 'en',
  `lang_list` blob NOT NULL,
  `ploader` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `eucookie` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `offline` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `offline_msg` text,
  `offline_d` date DEFAULT NULL,
  `offline_t` time DEFAULT NULL,
  `offline_info` text,
  `logo` varchar(50) DEFAULT NULL,
  `plogo` varchar(50) DEFAULT NULL,
  `showlang` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `showlogin` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `showsearch` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `showcrumbs` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `currency` varchar(4) DEFAULT NULL,
  `enable_tax` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `file_size` int(4) unsigned NOT NULL DEFAULT '20971520',
  `file_ext` varchar(150) NOT NULL DEFAULT 'png,jpg,jpeg,bmp',
  `reg_verify` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `auto_verify` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `notify_admin` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `flood` int(3) unsigned NOT NULL DEFAULT '3600',
  `attempt` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `logging` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `analytics` varchar(100) DEFAULT NULL,
  `mailer` varchar(8) NOT NULL DEFAULT 'SMTP',
  `sendmail` varchar(60) DEFAULT NULL,
  `smtp_host` varchar(150) DEFAULT NULL,
  `smtp_user` varchar(50) DEFAULT NULL,
  `smtp_pass` varchar(50) DEFAULT NULL,
  `smtp_port` varchar(3) DEFAULT NULL,
  `is_ssl` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `inv_info` text,
  `inv_note` text,
  `system_slugs` blob,
  `url_slugs` blob,
  `social_media` blob,
  `ytapi` varchar(120) DEFAULT NULL,
  `mapapi` varchar(120) DEFAULT NULL,
  `wojon` decimal(4,2) unsigned NOT NULL DEFAULT '0.00',
  `wojov` decimal(4,2) unsigned NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `site_name`, `company`, `site_dir`, `site_email`, `theme`, `perpage`, `backup`, `thumb_w`, `thumb_h`, `img_w`, `img_h`, `avatar_w`, `avatar_h`, `short_date`, `long_date`, `time_format`, `calendar_date`, `dtz`, `locale`, `weekstart`, `lang`, `lang_list`, `ploader`, `eucookie`, `offline`, `offline_msg`, `offline_d`, `offline_t`, `offline_info`, `logo`, `plogo`, `showlang`, `showlogin`, `showsearch`, `showcrumbs`, `currency`, `enable_tax`, `file_size`, `file_ext`, `reg_verify`, `auto_verify`, `notify_admin`, `flood`, `attempt`, `logging`, `analytics`, `mailer`, `sendmail`, `smtp_host`, `smtp_user`, `smtp_pass`, `smtp_port`, `is_ssl`, `inv_info`, `inv_note`, `system_slugs`, `url_slugs`, `social_media`, `ytapi`, `mapapi`, `wojon`, `wojov`) VALUES
(1, 'CMS Pro', '', '', '', 'laguna', 12, '26-Apr-2021_13-36-49.sql', 200, 200, 1440, 800, 250, 250, 'dd MMM yyyy', 'MMMM dd, yyyy hh:mm a', 'HH:mm', 'dd/mm/yyyy', 'America/Toronto', 'en_CA', 1, 'en', 0x5b7b226964223a312c226e616d65223a22456e676c697368222c2261626272223a22656e222c226c616e67646972223a226c7472222c22636f6c6f72223a2223323761653630222c22617574686f72223a22687474703a5c2f5c2f7777772e776f6a6f736372697074732e636f6d222c22686f6d65223a317d5d, 0, 0, 0, '<p>Our website is under construction, we are working very hard to give you the best experience on our new web site.</p>', '2021-06-25', '18:00:00', '<p>Instructions for offline payments...</p>\r\n<p>Your bank name etc...</p>', 'logo.svg', 'print_logo.png', 1, 1, 1, 1, 'CAD', 0, 20971520, 'png,jpg,jpeg,bmp,zip,pdf,doc,docx,txt,mp4', 1, 1, 1, 1800, 3, 1, '', 'SMTP', '/usr/sbin/sendmail -t -i', 'smtp-relay.sendinblue.com', '', '4gnJ7HODKkzr93Fw', '465', 1, '<p><strong>ABC Company Pty Ltd</strong><br>123 Burke Street, Toronto ON, CANADA<br>Tel : (416) 1234-5678, Fax : (416) 1234-5679, Email : sales@abc-company.com<br>Web Site : www.abc-company.com</p>', '<p>TERMS & CONDITIONS<br>1. Interest may be levied on overdue accounts. <br>2. Goods sold are not returnable or refundable</p>', 0x7b22686f6d65223a5b7b22706167655f74797065223a22686f6d65222c22736c75675f656e223a22686f6d65227d5d2c226c6f67696e223a5b7b22706167655f74797065223a226c6f67696e222c22736c75675f656e223a226c6f67696e227d5d2c227265676973746572223a5b7b22706167655f74797065223a227265676973746572222c22736c75675f656e223a22726567697374726174696f6e227d5d2c226163746976617465223a5b7b22706167655f74797065223a226163746976617465222c22736c75675f656e223a226163746976617465227d5d2c226163636f756e74223a5b7b22706167655f74797065223a226163636f756e74222c22736c75675f656e223a2264617368626f617264227d5d2c22736561726368223a5b7b22706167655f74797065223a22736561726368222c22736c75675f656e223a22736561726368227d5d2c22736974656d6170223a5b7b22706167655f74797065223a22736974656d6170222c22736c75675f656e223a22736974656d6170227d5d2c2270726f66696c65223a5b7b22706167655f74797065223a2270726f66696c65222c22736c75675f656e223a2270726f66696c65227d5d2c22706f6c696379223a5b7b22706167655f74797065223a22706f6c696379222c22736c75675f656e223a22707269766163792d706f6c696379227d5d7d, 0x7b226d6f64646972223a7b226469676973686f70223a226469676973686f70222c22626c6f67223a22626c6f67222c22706f7274666f6c696f223a22706f7274666f6c696f222c2267616c6c657279223a2267616c6c657279222c2273686f70223a2273686f70227d2c227061676564617461223a7b2270616765223a2270616765227d2c226d6f64756c65223a7b226469676973686f70223a226469676973686f70222c226469676973686f702d636174223a2263617465676f7279222c226469676973686f702d636865636b6f7574223a22636865636b6f7574222c22626c6f67223a22626c6f67222c22626c6f672d636174223a2263617465676f7279222c22626c6f672d736561726368223a22736561726368222c22626c6f672d61726368697665223a2261726368697665222c22626c6f672d617574686f72223a22617574686f72222c22626c6f672d746167223a22746167222c22706f7274666f6c696f223a22706f7274666f6c696f222c22706f7274666f6c696f2d636174223a2263617465676f7279222c2267616c6c657279223a2267616c6c657279222c2267616c6c6572792d616c62756d223a22616c62756d222c2273686f70223a2273686f70222c2273686f702d636174223a2263617465676f7279222c2273686f702d63617274223a2263617274222c2273686f702d636865636b6f7574223a22636865636b6f7574227d7d, 0x7b2266616365626f6f6b223a2266616365626f6f6b5f70616765222c2274776974746572223a22747769747465725f70616765227d, '', '', '1.25', '5.80');

--
-- Table structure for table `stats`
--

DROP TABLE IF EXISTS `stats`;
CREATE TABLE IF NOT EXISTS `stats` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `day` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `pageviews` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `uniquevisitors` int(11) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table structure for table `trash`
--

DROP TABLE IF EXISTS `trash`;
CREATE TABLE IF NOT EXISTS `trash` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent` varchar(15) DEFAULT NULL,
  `parent_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `type` varchar(15) DEFAULT NULL,
  `dataset` blob,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `fname` varchar(32) NOT NULL,
  `lname` varchar(32) NOT NULL,
  `email` varchar(60) NOT NULL,
  `membership_id` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `mem_expire` datetime DEFAULT NULL,
  `trial_used` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `memused` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `salt` varchar(25) NOT NULL,
  `hash` varchar(70) NOT NULL,
  `token` varchar(40) NOT NULL DEFAULT '0',
  `userlevel` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `type` varchar(10) NOT NULL DEFAULT 'member',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastlogin` datetime DEFAULT NULL,
  `lastip` varbinary(16) DEFAULT '000.000.000.000',
  `avatar` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `zip` varchar(10) DEFAULT NULL,
  `country` varchar(4) DEFAULT NULL,
  `notify` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `access` text,
  `notes` tinytext,
  `info` tinytext,
  `fb_link` varchar(100) DEFAULT NULL,
  `tw_link` varchar(100) DEFAULT NULL,
  `gp_link` varchar(100) DEFAULT NULL,
  `newsletter` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `stripe_cus` varchar(100) DEFAULT NULL,
  `modaccess` varchar(150) DEFAULT NULL,
  `plugaccess` varchar(150) DEFAULT NULL,
  `active` enum('y','n','t','b') NOT NULL DEFAULT 'n',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Table structure for table `user_memberships`
--

DROP TABLE IF EXISTS `user_memberships`;
CREATE TABLE IF NOT EXISTS `user_memberships` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tid` int(11) unsigned NOT NULL DEFAULT '0',
  `uid` int(11) unsigned NOT NULL DEFAULT '0',
  `mid` int(11) unsigned NOT NULL DEFAULT '0',
  `activated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `expire` timestamp NULL DEFAULT NULL,
  `recurring` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `active` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0 = expired, 1 = active',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE `pages` ADD FULLTEXT KEY `idx_search` (`title_en`,`body_en`);