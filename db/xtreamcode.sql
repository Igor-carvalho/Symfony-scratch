-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 01-10-2018 a las 15:44:39
-- Versión del servidor: 10.1.26-MariaDB-0+deb9u1
-- Versión de PHP: 7.0.30-0+deb9u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `xtreamcode`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `billing_configuration`
--

CREATE TABLE `billing_configuration` (
  `id` int(11) NOT NULL,
  `currency` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `salesEmail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `salesPhone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `salesAddress` longtext COLLATE utf8_unicode_ci NOT NULL,
  `ordersTtl` int(11) NOT NULL,
  `ordersTtlInterval` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updatedAt` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `billing_configuration`
--

INSERT INTO `billing_configuration` (`id`, `currency`, `salesEmail`, `salesPhone`, `salesAddress`, `ordersTtl`, `ordersTtlInterval`, `updatedAt`, `user_id`) VALUES
(1, 'EUR', 'sales@domain.com', NULL, 'address', 30, 'days', NULL, 605);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `country`
--

CREATE TABLE `country` (
  `code` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `country`
--

INSERT INTO `country` (`code`, `name`) VALUES
('AD', 'Andorra'),
('AE', 'United Arab Emirates'),
('AF', 'Afghanistan'),
('AG', 'Antigua and Barbuda'),
('AI', 'Anguilla'),
('AL', 'Albania'),
('AM', 'Armenia'),
('AN', 'Netherlands Antilles'),
('AO', 'Angola'),
('AQ', 'Antarctica'),
('AR', 'Argentina'),
('AT', 'Austria'),
('AU', 'Australia'),
('AW', 'Aruba'),
('AZ', 'Azerbaijan'),
('BA', 'Bosnia and Herzegovina'),
('BB', 'Barbados'),
('BD', 'Bangladesh'),
('BE', 'Belgium'),
('BF', 'Burkina Faso'),
('BG', 'Bulgaria'),
('BH', 'Bahrain'),
('BI', 'Burundi'),
('BJ', 'Benin'),
('BM', 'Bermuda'),
('BN', 'Brunei Darussalam'),
('BO', 'Bolivia'),
('BR', 'Brazil'),
('BS', 'Bahamas'),
('BT', 'Bhutan'),
('BV', 'Bouvet Island'),
('BW', 'Botswana'),
('BY', 'Belarus'),
('BZ', 'Belize'),
('CA', 'Canada'),
('CC', 'Cocos (Keeling) Islands'),
('CF', 'Central African Republic'),
('CG', 'Congo'),
('CH', 'Switzerland'),
('CI', 'Ivory Coast'),
('CK', 'Cook Islands'),
('CL', 'Chile'),
('CM', 'Cameroon'),
('CN', 'China'),
('CO', 'Colombia'),
('CR', 'Costa Rica'),
('CU', 'Cuba'),
('CV', 'Cape Verde'),
('CX', 'Christmas Island'),
('CY', 'Cyprus'),
('CZ', 'Czech Republic'),
('DE', 'Germany'),
('DJ', 'Djibouti'),
('DK', 'Denmark'),
('DM', 'Dominica'),
('DO', 'Dominican Republic'),
('DS', 'American Samoa'),
('DZ', 'Algeria'),
('EC', 'Ecuador'),
('EE', 'Estonia'),
('EG', 'Egypt'),
('EH', 'Western Sahara'),
('ER', 'Eritrea'),
('ES', 'Spain'),
('ET', 'Ethiopia'),
('FI', 'Finland'),
('FJ', 'Fiji'),
('FK', 'Falkland Islands (Malvinas)'),
('FM', 'Micronesia, Federated States of'),
('FO', 'Faroe Islands'),
('FR', 'France'),
('FX', 'France, Metropolitan'),
('GA', 'Gabon'),
('GB', 'United Kingdom'),
('GD', 'Grenada'),
('GE', 'Georgia'),
('GF', 'French Guiana'),
('GH', 'Ghana'),
('GI', 'Gibraltar'),
('GK', 'Guernsey'),
('GL', 'Greenland'),
('GM', 'Gambia'),
('GN', 'Guinea'),
('GP', 'Guadeloupe'),
('GQ', 'Equatorial Guinea'),
('GR', 'Greece'),
('GS', 'South Georgia South Sandwich Islands'),
('GT', 'Guatemala'),
('GU', 'Guam'),
('GW', 'Guinea-Bissau'),
('GY', 'Guyana'),
('HK', 'Hong Kong'),
('HM', 'Heard and Mc Donald Islands'),
('HN', 'Honduras'),
('HR', 'Croatia (Hrvatska)'),
('HT', 'Haiti'),
('HU', 'Hungary'),
('ID', 'Indonesia'),
('IE', 'Ireland'),
('IL', 'Israel'),
('IM', 'Isle of Man'),
('IN', 'India'),
('IO', 'British Indian Ocean Territory'),
('IQ', 'Iraq'),
('IR', 'Iran (Islamic Republic of)'),
('IS', 'Iceland'),
('IT', 'Italy'),
('JE', 'Jersey'),
('JM', 'Jamaica'),
('JO', 'Jordan'),
('JP', 'Japan'),
('KE', 'Kenya'),
('KG', 'Kyrgyzstan'),
('KH', 'Cambodia'),
('KI', 'Kiribati'),
('KM', 'Comoros'),
('KN', 'Saint Kitts and Nevis'),
('KP', 'Korea, Democratic People\'s Republic of'),
('KR', 'Korea, Republic of'),
('KW', 'Kuwait'),
('KY', 'Cayman Islands'),
('KZ', 'Kazakhstan'),
('LA', 'Lao People\'s Democratic Republic'),
('LB', 'Lebanon'),
('LC', 'Saint Lucia'),
('LI', 'Liechtenstein'),
('LK', 'Sri Lanka'),
('LR', 'Liberia'),
('LS', 'Lesotho'),
('LT', 'Lithuania'),
('LU', 'Luxembourg'),
('LV', 'Latvia'),
('LY', 'Libyan Arab Jamahiriya'),
('MA', 'Morocco'),
('MC', 'Monaco'),
('MD', 'Moldova, Republic of'),
('ME', 'Montenegro'),
('MG', 'Madagascar'),
('MH', 'Marshall Islands'),
('MK', 'Macedonia'),
('ML', 'Mali'),
('MM', 'Myanmar'),
('MN', 'Mongolia'),
('MO', 'Macau'),
('MP', 'Northern Mariana Islands'),
('MQ', 'Martinique'),
('MR', 'Mauritania'),
('MS', 'Montserrat'),
('MT', 'Malta'),
('MU', 'Mauritius'),
('MV', 'Maldives'),
('MW', 'Malawi'),
('MX', 'Mexico'),
('MY', 'Malaysia'),
('MZ', 'Mozambique'),
('NA', 'Namibia'),
('NC', 'New Caledonia'),
('NE', 'Niger'),
('NF', 'Norfolk Island'),
('NG', 'Nigeria'),
('NI', 'Nicaragua'),
('NL', 'Netherlands'),
('NO', 'Norway'),
('NP', 'Nepal'),
('NR', 'Nauru'),
('NU', 'Niue'),
('NZ', 'New Zealand'),
('OM', 'Oman'),
('PA', 'Panama'),
('PE', 'Peru'),
('PF', 'French Polynesia'),
('PG', 'Papua New Guinea'),
('PH', 'Philippines'),
('PK', 'Pakistan'),
('PL', 'Poland'),
('PM', 'St. Pierre and Miquelon'),
('PN', 'Pitcairn'),
('PR', 'Puerto Rico'),
('PS', 'Palestine'),
('PT', 'Portugal'),
('PW', 'Palau'),
('PY', 'Paraguay'),
('QA', 'Qatar'),
('RE', 'Reunion'),
('RO', 'Romania'),
('RS', 'Serbia'),
('RU', 'Russian Federation'),
('RW', 'Rwanda'),
('SA', 'Saudi Arabia'),
('SB', 'Solomon Islands'),
('SC', 'Seychelles'),
('SD', 'Sudan'),
('SE', 'Sweden'),
('SG', 'Singapore'),
('SH', 'St. Helena'),
('SI', 'Slovenia'),
('SJ', 'Svalbard and Jan Mayen Islands'),
('SK', 'Slovakia'),
('SL', 'Sierra Leone'),
('SM', 'San Marino'),
('SN', 'Senegal'),
('SO', 'Somalia'),
('SR', 'Suriname'),
('ST', 'Sao Tome and Principe'),
('SV', 'El Salvador'),
('SY', 'Syrian Arab Republic'),
('SZ', 'Swaziland'),
('TC', 'Turks and Caicos Islands'),
('TD', 'Chad'),
('TF', 'French Southern Territories'),
('TG', 'Togo'),
('TH', 'Thailand'),
('TJ', 'Tajikistan'),
('TK', 'Tokelau'),
('TM', 'Turkmenistan'),
('TN', 'Tunisia'),
('TO', 'Tonga'),
('TP', 'East Timor'),
('TR', 'Turkey'),
('TT', 'Trinidad and Tobago'),
('TV', 'Tuvalu'),
('TW', 'Taiwan'),
('TY', 'Mayotte'),
('TZ', 'Tanzania, United Republic of'),
('UA', 'Ukraine'),
('UG', 'Uganda'),
('UM', 'United States minor outlying islands'),
('US', 'United States'),
('UY', 'Uruguay'),
('UZ', 'Uzbekistan'),
('VA', 'Vatican City State'),
('VC', 'Saint Vincent and the Grenadines'),
('VE', 'Venezuela'),
('VG', 'Virgin Islands (British)'),
('VI', 'Virgin Islands (U.S.)'),
('VN', 'Vietnam'),
('VU', 'Vanuatu'),
('WF', 'Wallis and Futuna Islands'),
('WS', 'Samoa'),
('XK', 'Kosovo'),
('YE', 'Yemen'),
('YU', 'Yugoslavia'),
('ZA', 'South Africa'),
('ZM', 'Zambia'),
('ZR', 'Zaire'),
('ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gateways`
--

CREATE TABLE `gateways` (
  `id` int(11) NOT NULL,
  `uniqueName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `displayName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `shopIdPublicKey` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `secretKey` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` tinyint(1) DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `gateways`
--

INSERT INTO `gateways` (`id`, `uniqueName`, `displayName`, `shopIdPublicKey`, `secretKey`, `enabled`, `updatedAt`) VALUES
(1, 'paypal', 'PayPal', 'asdasdasd', '12123123', 1, NULL),
(2, 'onpay', 'On Pay', '57567567ht', 'asdasdasd', 1, NULL),
(3, 'webmoney', 'Web Money', 'asdasd', '56756', 1, NULL),
(4, 'interkassa', 'Interkassa', '3534qasd', 'asdadfgr6456', 1, NULL),
(5, 'moneybookers', 'Money Bookers', '3453dfgdfg', 'dfg345', 1, NULL),
(6, 'creditcard', 'Credit Card', '345', '1', 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `issues`
--

CREATE TABLE `issues` (
  `id` int(11) NOT NULL,
  `issue` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `issues`
--

INSERT INTO `issues` (`id`, `issue`) VALUES
(1, 'Payments'),
(2, 'Emails Notifications');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `gateway_id` int(11) DEFAULT NULL,
  `customerName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customerEmail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `transactionId` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `currency` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `amountReal` double NOT NULL,
  `verified` tinyint(1) DEFAULT NULL,
  `expireAt` datetime NOT NULL,
  `expired` tinyint(1) DEFAULT NULL,
  `verifiedAt` datetime DEFAULT NULL,
  `products` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:json_array)',
  `discount` double NOT NULL,
  `createdAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `gateway_id`, `customerName`, `customerEmail`, `transactionId`, `currency`, `amount`, `amountReal`, `verified`, `expireAt`, `expired`, `verifiedAt`, `products`, `discount`, `createdAt`) VALUES
(6, 604, 2, 'reseller', 'reseller@gamil.com', '15378012355ba8fc139f720', 'EUR', 5, 5, 0, '2018-10-24 11:00:35', NULL, NULL, '[{\"id\":9,\"displayName\":\"Reseller\",\"credits\":8,\"superReseller\":\"No\",\"count\":1,\"unitPrice\":5,\"discount\":0}]', 0, '2018-09-24 11:00:35'),
(7, 604, 1, 'reseller', 'reseller@gamil.com', '15378034855ba904ddcb631', 'EUR', 50, 50, 0, '2018-10-24 11:38:05', NULL, NULL, '[{\"id\":11,\"displayName\":\"Super Reseller1\",\"credits\":50,\"superReseller\":\"Yes\",\"count\":1,\"unitPrice\":50,\"discount\":0}]', 0, '2018-09-24 11:38:05'),
(8, 604, 1, 'reseller', 'reseller@gamil.com', '15378084495ba9184154cfb', 'EUR', 50, 50, 0, '2018-10-24 13:00:49', NULL, NULL, '[{\"id\":11,\"displayName\":\"Super Reseller1\",\"credits\":50,\"superReseller\":\"Yes\",\"count\":1,\"unitPrice\":50,\"discount\":0}]', 0, '2018-09-24 13:00:49'),
(9, 604, 3, 'reseller', 'reseller@gamil.com', '15378084665ba9185256c8f', 'EUR', 50, 50, 0, '2018-10-24 13:01:06', NULL, NULL, '[{\"id\":11,\"displayName\":\"Super Reseller1\",\"credits\":50,\"superReseller\":\"Yes\",\"count\":1,\"unitPrice\":50,\"discount\":0}]', 0, '2018-09-24 13:01:06'),
(10, 604, 4, 'reseller', 'reseller@gamil.com', '15378084985ba91872205a8', 'EUR', 50, 50, 0, '2018-10-24 13:01:38', NULL, NULL, '[{\"id\":11,\"displayName\":\"Super Reseller1\",\"credits\":50,\"superReseller\":\"Yes\",\"count\":1,\"unitPrice\":50,\"discount\":0}]', 0, '2018-09-24 13:01:38'),
(11, 604, 6, 'reseller', 'reseller@gamil.com', '15378085245ba9188c24629', 'EUR', 50, 50, 0, '2018-10-24 13:02:04', NULL, NULL, '[{\"id\":11,\"displayName\":\"Super Reseller1\",\"credits\":50,\"superReseller\":\"Yes\",\"count\":1,\"unitPrice\":50,\"discount\":0}]', 0, '2018-09-24 13:02:04'),
(12, 604, 5, 'reseller', 'reseller@gamil.com', '15378085515ba918a7052c4', 'EUR', 50, 50, 0, '2018-10-24 13:02:31', NULL, NULL, '[{\"id\":11,\"displayName\":\"Super Reseller1\",\"credits\":50,\"superReseller\":\"Yes\",\"count\":1,\"unitPrice\":50,\"discount\":0}]', 0, '2018-09-24 13:02:31'),
(13, 604, 5, 'reseller', 'reseller@gamil.com', '15378086275ba918f37f8f4', 'EUR', 50, 50, 0, '2018-10-24 13:03:47', NULL, NULL, '[{\"id\":11,\"displayName\":\"Super Reseller1\",\"credits\":50,\"superReseller\":\"Yes\",\"count\":1,\"unitPrice\":50,\"discount\":0}]', 0, '2018-09-24 13:03:47'),
(14, 604, 2, 'reseller', 'reseller@gamil.com', '15378086655ba91919922cc', 'EUR', 50, 50, 0, '2018-10-24 13:04:25', NULL, NULL, '[{\"id\":11,\"displayName\":\"Super Reseller1\",\"credits\":50,\"superReseller\":\"Yes\",\"count\":1,\"unitPrice\":50,\"discount\":0}]', 0, '2018-09-24 13:04:25'),
(15, 604, 1, 'reseller', 'reseller@gamil.com', '15378090485ba91a98bd332', 'EUR', 20, 20, 0, '2018-10-24 13:10:48', NULL, NULL, '[{\"id\":10,\"displayName\":\"Super reseller\",\"credits\":20,\"superReseller\":\"Yes\",\"count\":1,\"unitPrice\":20,\"discount\":0}]', 0, '2018-09-24 13:10:48'),
(16, 604, 1, 'reseller', 'reseller@gamil.com', '15378096835ba91d13a45bf', 'EUR', 50, 50, 0, '2018-10-24 13:21:23', NULL, NULL, '[{\"id\":11,\"displayName\":\"Super Reseller1\",\"credits\":50,\"superReseller\":\"Yes\",\"count\":1,\"unitPrice\":50,\"discount\":0}]', 0, '2018-09-24 13:21:23'),
(17, 604, 2, 'reseller', 'reseller@gamil.com', '15378097125ba91d3084a30', 'EUR', 50, 50, 0, '2018-10-24 13:21:52', NULL, NULL, '[{\"id\":11,\"displayName\":\"Super Reseller1\",\"credits\":50,\"superReseller\":\"Yes\",\"count\":1,\"unitPrice\":50,\"discount\":0}]', 0, '2018-09-24 13:21:52'),
(18, 604, 3, 'reseller', 'reseller@gamil.com', '15378097215ba91d394775b', 'EUR', 50, 50, 0, '2018-10-24 13:22:01', NULL, NULL, '[{\"id\":11,\"displayName\":\"Super Reseller1\",\"credits\":50,\"superReseller\":\"Yes\",\"count\":1,\"unitPrice\":50,\"discount\":0}]', 0, '2018-09-24 13:22:01'),
(19, 604, 4, 'reseller', 'reseller@gamil.com', '15378097295ba91d41efed6', 'EUR', 50, 50, 0, '2018-10-24 13:22:09', NULL, NULL, '[{\"id\":11,\"displayName\":\"Super Reseller1\",\"credits\":50,\"superReseller\":\"Yes\",\"count\":1,\"unitPrice\":50,\"discount\":0}]', 0, '2018-09-24 13:22:09'),
(20, 604, 5, 'reseller', 'reseller@gamil.com', '15378097375ba91d491794d', 'EUR', 50, 50, 0, '2018-10-24 13:22:17', NULL, NULL, '[{\"id\":11,\"displayName\":\"Super Reseller1\",\"credits\":50,\"superReseller\":\"Yes\",\"count\":1,\"unitPrice\":50,\"discount\":0}]', 0, '2018-09-24 13:22:17'),
(21, 604, 6, 'reseller', 'reseller@gamil.com', '15378097435ba91d4f0ecdc', 'EUR', 50, 50, 0, '2018-10-24 13:22:23', NULL, NULL, '[{\"id\":11,\"displayName\":\"Super Reseller1\",\"credits\":50,\"superReseller\":\"Yes\",\"count\":1,\"unitPrice\":50,\"discount\":0}]', 0, '2018-09-24 13:22:23'),
(22, 604, 2, 'reseller', 'reseller@gamil.com', '15378109345ba921f6942ac', 'EUR', 50, 50, 0, '2018-10-24 13:42:14', NULL, NULL, '[{\"id\":11,\"displayName\":\"Super Reseller1\",\"credits\":50,\"superReseller\":\"Yes\",\"count\":1,\"unitPrice\":50,\"discount\":0}]', 0, '2018-09-24 13:42:14'),
(23, 604, 2, 'reseller', 'reseller@gamil.com', '15378111065ba922a2dd18c', 'EUR', 50, 50, 0, '2018-10-24 13:45:06', NULL, NULL, '[{\"id\":11,\"displayName\":\"Super Reseller1\",\"credits\":50,\"superReseller\":\"Yes\",\"count\":1,\"unitPrice\":50,\"discount\":0}]', 0, '2018-09-24 13:45:06'),
(24, 604, 3, 'reseller', 'reseller@gamil.com', '15378113775ba923b1c9d30', 'EUR', 20, 20, 0, '2018-10-24 13:49:37', NULL, NULL, '[{\"id\":10,\"displayName\":\"Super reseller\",\"credits\":20,\"superReseller\":\"Yes\",\"count\":1,\"unitPrice\":20,\"discount\":0}]', 0, '2018-09-24 13:49:37'),
(25, 604, 4, 'reseller', 'reseller@gamil.com', '15378116185ba924a252b94', 'EUR', 20, 20, 0, '2018-10-24 13:53:38', NULL, NULL, '[{\"id\":10,\"displayName\":\"Super reseller\",\"credits\":20,\"superReseller\":\"Yes\",\"count\":1,\"unitPrice\":20,\"discount\":0}]', 0, '2018-09-24 13:53:38'),
(26, 604, 5, 'reseller', 'reseller@gamil.com', '15378116915ba924eb1731f', 'EUR', 20, 20, 0, '2018-10-24 13:54:51', NULL, NULL, '[{\"id\":10,\"displayName\":\"Super reseller\",\"credits\":20,\"superReseller\":\"Yes\",\"count\":1,\"unitPrice\":20,\"discount\":0}]', 0, '2018-09-24 13:54:51'),
(27, 604, 6, 'reseller', 'reseller@gamil.com', '15378117895ba9254d595bd', 'EUR', 20, 20, 0, '2018-10-24 13:56:29', NULL, NULL, '[{\"id\":10,\"displayName\":\"Super reseller\",\"credits\":20,\"superReseller\":\"Yes\",\"count\":1,\"unitPrice\":20,\"discount\":0}]', 0, '2018-09-24 13:56:29'),
(28, 604, 6, 'reseller', 'reseller@gamil.com', '15378119685ba926008999b', 'EUR', 20, 20, 0, '2018-10-24 13:59:28', NULL, NULL, '[{\"id\":10,\"displayName\":\"Super reseller\",\"credits\":20,\"superReseller\":\"Yes\",\"count\":1,\"unitPrice\":20,\"discount\":0}]', 0, '2018-09-24 13:59:28'),
(29, 604, 6, 'reseller', 'reseller@gamil.com', '15378120185ba92632af2c9', 'EUR', 20, 20, 0, '2018-10-24 14:00:18', NULL, NULL, '[{\"id\":10,\"displayName\":\"Super reseller\",\"credits\":20,\"superReseller\":\"Yes\",\"count\":1,\"unitPrice\":20,\"discount\":0}]', 0, '2018-09-24 14:00:18'),
(30, 604, 6, 'reseller', 'reseller@gamil.com', '15378120275ba9263b798d6', 'EUR', 20, 20, 0, '2018-10-24 14:00:27', NULL, NULL, '[{\"id\":10,\"displayName\":\"Super reseller\",\"credits\":20,\"superReseller\":\"Yes\",\"count\":1,\"unitPrice\":20,\"discount\":0}]', 0, '2018-09-24 14:00:27'),
(31, 604, 6, 'reseller', 'reseller@gamil.com', '15378131675ba92aaf75f7a', 'EUR', 20, 20, 0, '2018-10-24 14:19:27', NULL, NULL, '[{\"id\":10,\"displayName\":\"Super reseller\",\"credits\":20,\"superReseller\":\"Yes\",\"count\":1,\"unitPrice\":20,\"discount\":0}]', 0, '2018-09-24 14:19:27'),
(32, 604, 6, 'reseller', 'reseller@gamil.com', '15378132305ba92aee08b3d', 'EUR', 20, 20, 0, '2018-10-24 14:20:30', NULL, NULL, '[{\"id\":10,\"displayName\":\"Super reseller\",\"credits\":20,\"superReseller\":\"Yes\",\"count\":1,\"unitPrice\":20,\"discount\":0}]', 0, '2018-09-24 14:20:30'),
(33, 604, 6, 'reseller', 'reseller@gamil.com', '15378141125ba92e6002920', 'EUR', 20, 20, 0, '2018-10-24 14:35:12', NULL, NULL, '[{\"id\":10,\"displayName\":\"Super reseller\",\"credits\":20,\"superReseller\":\"Yes\",\"count\":1,\"unitPrice\":20,\"discount\":0}]', 0, '2018-09-24 14:35:12'),
(34, 604, 6, 'reseller', 'reseller@gamil.com', '15378143555ba92f53771ae', 'EUR', 20, 20, 0, '2018-10-24 14:39:15', NULL, NULL, '[{\"id\":10,\"displayName\":\"Super reseller\",\"credits\":20,\"superReseller\":\"Yes\",\"count\":1,\"unitPrice\":20,\"discount\":0}]', 0, '2018-09-24 14:39:15'),
(35, 604, 6, 'reseller', 'reseller@gamil.com', '15378144705ba92fc63deb6', 'EUR', 20, 20, 0, '2018-10-24 14:41:10', NULL, NULL, '[{\"id\":10,\"displayName\":\"Super reseller\",\"credits\":20,\"superReseller\":\"Yes\",\"count\":1,\"unitPrice\":20,\"discount\":0}]', 0, '2018-09-24 14:41:10'),
(36, 604, 6, 'reseller', 'reseller@gamil.com', '15378162165ba936981d473', 'EUR', 20, 20, 0, '2018-10-24 15:10:16', NULL, NULL, '[{\"id\":10,\"displayName\":\"Super reseller\",\"credits\":20,\"superReseller\":\"Yes\",\"count\":1,\"unitPrice\":20,\"discount\":0}]', 0, '2018-09-24 15:10:16'),
(37, 604, 6, 'reseller', 'reseller@gamil.com', '15378163335ba9370d958a2', 'EUR', 20, 20, 0, '2018-10-24 15:12:13', NULL, NULL, '[{\"id\":10,\"displayName\":\"Super reseller\",\"credits\":20,\"superReseller\":\"Yes\",\"count\":1,\"unitPrice\":20,\"discount\":0}]', 0, '2018-09-24 15:12:13'),
(38, 604, 6, 'reseller', 'reseller@gamil.com', '15378163565ba93724139b1', 'EUR', 20, 20, 0, '2018-10-24 15:12:36', NULL, NULL, '[{\"id\":10,\"displayName\":\"Super reseller\",\"credits\":20,\"superReseller\":\"Yes\",\"count\":1,\"unitPrice\":20,\"discount\":0}]', 0, '2018-09-24 15:12:36'),
(39, 604, 6, 'reseller', 'reseller@gamil.com', '15378163755ba937370a669', 'EUR', 20, 20, 0, '2018-10-24 15:12:55', NULL, NULL, '[{\"id\":10,\"displayName\":\"Super reseller\",\"credits\":20,\"superReseller\":\"Yes\",\"count\":1,\"unitPrice\":20,\"discount\":0}]', 0, '2018-09-24 15:12:55'),
(40, 604, 6, 'reseller', 'reseller@gamil.com', '15378164035ba9375387da3', 'EUR', 20, 20, 0, '2018-10-24 15:13:23', NULL, NULL, '[{\"id\":10,\"displayName\":\"Super reseller\",\"credits\":20,\"superReseller\":\"Yes\",\"count\":1,\"unitPrice\":20,\"discount\":0}]', 0, '2018-09-24 15:13:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `packages`
--

CREATE TABLE `packages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_trial` tinyint(4) NOT NULL,
  `credits` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `duration_in` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bouquets` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `can_gen_mag` tinyint(4) NOT NULL DEFAULT '0',
  `output_formats` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `max_connections` int(11) NOT NULL DEFAULT '1',
  `can_gen_e2` tinyint(4) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `packages`
--

INSERT INTO `packages` (`id`, `name`, `is_trial`, `credits`, `duration`, `duration_in`, `bouquets`, `can_gen_mag`, `output_formats`, `max_connections`, `can_gen_e2`, `status`) VALUES
(45, 'Trial All', 1, 0, 24, 'hours', '[8,7,6,5,1,234,129,192,191,189,187,185,184,180,179,176,162,161,160,159,158,157,156,154,153,150,148,133,132,128,127,126,125,124,123,122,121,120,119,118,117,116,115,114,113,112,111,110,109,108,107,106,105,104,103,102,101,100,99,98,97,96,93,83,76,75,65,60,59,56,53,52,51,50,49,48,47,46,41,4,3,2,201,205,227,207,206,256,255,254,253,252,251,250,249,248,247,246,245,244,236]', 1, '[1,2,3]', 2, 1, 1),
(46, 'Trial UK US Canada Sports Adult No Vod', 1, 0, 24, 'hours', '[8,7,6,5,1,129,191,162,161,160,159,158,157,156,154,133,93,83,76,75,65,60,59,56,53,52,51,50,49,48,47,46,41,4,3,2,201,150,148]', 1, '[1,2,3]', 2, 1, 1),
(47, 'Trial UK US Canada Sports Adult Half VOD', 1, 0, 24, 'hours', '[8,7,6,5,1,129,192,191,187,184,180,179,162,161,160,159,158,157,156,154,93,83,76,75,65,60,59,56,53,52,51,50,49,48,47,46,41,4,3,2,245,244,248,250,256]', 1, '[1,2,3]', 2, 1, 1),
(48, 'Trial UK US Canada Sports Adult Full VOD', 1, 0, 24, 'hours', '[8,7,6,5,1,129,192,191,189,187,185,184,180,179,162,161,160,159,158,157,156,154,150,93,83,76,75,65,60,59,56,53,52,51,50,49,48,47,46,41,4,3,2,256,255,254,253,252,251,250,249,248,247,246,245,244,207,206,201]', 1, '[1,2,3]', 2, 1, 1),
(49, 'Trial UK US Canada Sports (CLEAN) NO VOD', 1, 0, 24, 'hours', '[8,7,6,5,1,191,162,161,160,159,158,157,156,154,133,93,83,76,65,60,59,56,53,52,51,50,49,48,47,46,41,4,3,2,96,234,124]', 1, '[1,2,3]', 2, 1, 1),
(50, 'Trial UK US Canada Sports(CLEAN) Half VOD', 1, 0, 24, 'hours', '[8,7,6,5,1,235,234,4245,129,6724,202,203,204,194,193,192,191,188,187,184,183,182,180,179,178,177,176,162,161,160,159,158,157,156,154,153,152,150,93,83,76,65,60,59,57,56,53,52,51,50,49,48,47,46,43,41,34,5,4,3,2]', 1, '[1,2,3]', 2, 1, 1),
(51, 'Trial UK US Canada Sports(CLEAN) Full VOD', 1, 0, 24, 'hours', '[8,7,6,5,1,129,192,191,189,187,185,184,180,179,162,161,160,159,158,157,156,154,150,148,133,93,83,76,65,60,59,56,53,52,51,50,49,48,47,46,41,4,3,2,256,255,254,253,252,251,250,249,248,247,246,245,244,207,206,205,201]', 1, '[1,2,3]', 2, 1, 1),
(52, 'Trial Adult', 1, 0, 24, 'hours', '[8,7,6,5,1,129,75]', 1, '[1,2,3]', 2, 1, 1),
(54, 'Trial Adult FULL VOD', 1, 0, 24, 'hours', '[8,7,6,5,1,235,155,75,194,193,192,189,188,187,185,184,183,182,180,179,178,177,262,261,256,255,254,253,252,251,250,249,248,247,246,245,244,208,207,206]', 1, '[1,2,3]', 2, 1, 1),
(55, 'Trial Sports', 1, 0, 24, 'hours', '[8,7,6,5,1,235,234,4245,129,6724,202,203,204,191,154,152,59,43,2,160,158,157,133,60,56,53,52,57,51,41]', 1, '[1,2,3]', 2, 1, 1),
(56, 'Trial Sports Half VOD', 1, 0, 24, 'hours', '[8,7,6,5,1,235,234,4245,129,6724,202,203,204,194,193,192,188,187,184,183,182,180,179,178,177,191,154,152,59,43,2,160,158,157,133,60,56,53,52,57,51,41,256,245]', 1, '[1,2,3]', 2, 1, 1),
(57, 'Trial Sports FULL VOD', 1, 0, 24, 'hours', '[8,7,6,5,1,235,234,4245,129,6724,202,203,204,194,193,192,189,188,187,185,184,183,182,180,179,178,177,191,154,152,59,43,2,160,158,157,133,60,56,53,52,57,51,41,262,261,256,255,254,253,252,251,250,249,248,247,246,245,244,243,208,207,206]', 1, '[1,2,3]', 2, 1, 1),
(58, 'Trial International NO VOD NO ADULT', 1, 0, 24, 'hours', '[8,7,6,5,1,235,234,4245,129,6724,202,203,204,149,148,133,132,128,127,126,125,124,123,122,121,120,119,118,117,116,115,114,113,112,111,110,109,108,107,106,105,104,103,102,101,100,99,98,97,96,43]', 1, '[1,2,3]', 2, 1, 1),
(59, 'Trial International Half VOD NO ADULT', 1, 0, 24, 'hours', '[8,7,6,5,1,235,234,4245,129,6724,202,203,204,149,148,133,132,128,127,126,125,124,123,122,121,120,119,118,117,116,115,114,113,112,111,110,109,108,107,106,105,104,103,102,101,100,99,98,97,96,153,43,194,193,192,188,187,184,183,182,180,179,178,177]', 1, '[1,2,3]', 2, 1, 1),
(60, 'Trial International Full VOD & ADULT', 1, 0, 24, 'hours', '[8,7,6,5,1,235,234,4245,129,6724,202,203,204,176,153,132,128,127,126,125,124,123,122,121,120,119,118,117,116,115,114,113,112,111,110,109,108,107,106,105,103,102,101,100,99,98,97,96,43,194,193,192,189,188,187,185,184,183,182,180,179,178,177,262,261,256,255,254,253,252,251,250,249,248,247,246,245,244,243,75]', 1, '[1,2,3]', 2, 1, 1),
(62, 'Trial VOD Full', 1, 0, 24, 'hours', '[8,7,6,5,1,235,194,193,192,189,188,187,185,184,183,182,180,179,178,177,262,261,256,255,254,253,252,251,250,249,248,247,246,245,244,243,208,207,206]', 1, '[1,2,3]', 2, 1, 1),
(145, '1 Month All ADULT & VOD', 0, 1, 24, 'hours', '[8,7,6,5,1,235,234,4245,129,6724,202,203,204,194,193,192,244,245,191,190,189,188,187,185,184,183,182,180,179,178,177,176,162,161,160,159,158,157,156,155,154,153,152,150,149,148,133,132,128,127,126,125,124,123,122,121,120,119,118,117,116,115,114,113,112,111,110,109,108,107,106,105,104,103,102,101,100,99,98,97,96,93,83,76,75,65,60,59,57,56,53,52,51,50,49,48,47,46,43,41,34,5,4,3,2,262,261,256,255,254,253,252,251,250,249,248,247,246,243,236,227,208,207,206,201,205]', 1, '[1,2,3]', 2, 1, 1),
(146, '1 Month UK US Canada Sports (ADULT) NO VOD', 0, 1, 24, 'hours', '[8,7,6,5,1,129,191,162,161,160,159,158,157,156,154,133,93,83,76,75,65,60,59,56,53,52,51,50,49,48,47,46,41,4,3,2]', 1, '[1,2,3]', 2, 1, 1),
(148, '1 Month UK US Canada Sports (CLEAN) Full VOD', 0, 1, 24, 'hours', '[8,7,6,5,1,129,192,191,189,187,185,184,180,179,162,161,160,159,158,157,156,154,150,93,83,76,65,60,59,56,53,52,51,50,49,48,47,46,41,4,3,2,256,255,254,253,252,251,250,249,248,247,246,245,244,207,206,234,124,96]', 1, '[1,2,3]', 2, 1, 1),
(149, '1 Month UK US Canada Sports Clean NO VOD', 0, 1, 24, 'hours', '[8,7,6,5,1,191,162,161,160,159,158,157,156,154,150,148,133,93,83,76,65,60,59,56,53,52,51,50,49,48,47,46,41,4,3,2]', 1, '[1,2,3]', 2, 1, 1),
(151, '1 Month UK US Canada Sports (ADULT) Full VOD', 0, 1, 24, 'hours', '[8,7,6,5,1,129,192,191,189,187,185,184,180,179,162,161,160,159,158,157,156,154,133,93,83,76,75,65,60,59,56,53,52,51,50,49,48,47,46,41,4,3,2,256,255,254,253,252,251,250,249,248,247,246,245,244,207,206]', 1, '[1,2,3]', 2, 1, 1),
(152, '1 Month Adult', 0, 1, 24, 'hours', '[8,7,6,5,1,235,234,4245,6724,162,159,83,110,98,97,155,148,75,76,201,161,112,202,113,65,51,115,176,107,34,99,114,100,101,102,103,104,105,106,96,108,109,203,60,56,53,52,50,116,117,118,119,120,121,129,123,124,125,126,127,128,132,133,49,150,153,204,48,157,158,47,160,46,43,41,3,227,205,191,111,156,154,93,59,4,2,122]', 1, '[1,2,3]', 2, 1, 1),
(154, '1 Month Adult FULL VOD', 0, 1, 24, 'hours', '[8,7,6,5,1,75,192,189,187,185,184,180,179,256,255,254,253,252,251,250,249,248,247,246,245,244,207,206,237,236,205,201,191,176,162,161,160,159,158,157,156,154,153,150,148,133,132,129,128,127,126,125,124,123,122,121,120,119,118,117,116,115,114,113,112,111,110,109,108,107,106,105,104,103,102,101,100,99,98,97,96,93,83,76,65,60,59,56,53,52,51,50,49,48,47,46,41,4,3,2]', 1, '[1,2,3]', 2, 1, 1),
(155, '1 Month Sports', 0, 1, 24, 'hours', '[8,7,6,5,1,129,191,154,59,2,160,158,157,133,60,56,53,52,51,41]', 1, '[1,2,3]', 2, 1, 1),
(157, '1 Month Sports FULL VOD CLEAN', 0, 1, 24, 'hours', '[8,7,6,5,1,235,234,4245,129,6724,202,203,204,194,193,192,189,188,187,185,184,183,182,180,179,178,177,191,154,152,59,43,2,160,158,157,133,60,56,53,52,57,51,41,262,261,256,255,254,253,252,251,250,249,248,247,246,245,244,243,208,207,206]', 1, '[1,2,3]', 2, 1, 1),
(158, '1 Month International CLEAN NO VOD', 0, 0, 24, 'hours', '[8,7,6,5,1,235,234,4245,129,6724,202,203,204,149,148,133,132,128,127,126,125,124,123,122,121,120,119,118,117,116,115,114,113,112,111,110,109,108,107,106,105,104,103,102,101,100,99,98,97,96,43]', 1, '[1,2,3]', 2, 1, 1),
(160, '1 Month International Full VOD clean', 0, 0, 24, 'hours', '[8,7,6,5,1,235,234,4245,129,6724,202,203,204,176,153,132,128,127,126,125,124,123,122,121,120,119,118,117,116,115,114,113,112,111,110,109,108,107,106,105,103,102,101,100,99,98,97,96,43,194,193,192,189,188,187,185,184,183,182,180,179,178,177,262,261,256,255,254,253,252,251,250,249,248,247,246,245,244,243,208,207,206]', 1, '[1,2,3]', 2, 1, 1),
(345, '3 Month FULL VOD & ADULT', 0, 0, 24, 'hours', '[8,7,6,5,1,235,234,4245,129,6724,202,203,204,194,193,192,245,244,191,190,189,188,187,185,184,183,182,180,179,178,177,176,162,161,160,159,158,157,156,155,154,153,152,150,149,148,133,132,128,127,126,125,124,123,122,121,120,119,118,117,116,115,114,113,112,111,110,109,108,107,106,105,104,103,102,101,100,99,98,97,96,93,83,76,75,65,60,59,57,56,53,52,51,50,49,48,47,46,43,41,34,5,4,3,2,262,261,256,255,254,253,252,251,250,249,248,247,246,243,236,227,208,207,206,205,201]', 1, '[1,2,3]', 2, 1, 1),
(346, '3 Month UK US Canada Sports Adult no vod', 0, 0, 24, 'hours', '[7,6,5,1,129,191,162,161,160,159,158,157,156,154,133,93,83,76,75,65,60,59,56,53,52,51,50,49,48,47,46,41,4,3,2,234,176]', 1, '[1,2,3]', 2, 1, 1),
(348, '3 Month UK US Canada Sports Adult Full VOD', 0, 0, 24, 'hours', '[8,7,6,5,1,235,234,4245,129,6724,202,203,204,194,193,192,191,190,189,188,187,185,184,183,182,180,179,178,177,176,162,161,160,159,158,157,156,155,154,152,150,93,83,76,75,65,60,59,57,56,53,52,51,50,49,48,47,46,43,41,34,5,4,3,2,262,261,256,255,254,253,252,251,250,249,248,247,246,245,244,243,208,207,206]', 1, '[1,2,3]', 2, 1, 1),
(349, '3 Month UK US Canada Sports', 0, 0, 24, 'hours', '[8,7,6,5,1,235,234,4245,129,6724,202,203,204,191,190,176,162,161,160,159,158,157,156,155,154,153,152,150,149,148,133,93,83,76,75,65,60,59,57,56,53,52,51,50,49,48,47,46,43,41,5,4,3,2]', 1, '[1,2,3]', 2, 1, 1),
(351, '3 Month UK US Canada Sports Full VOD CLEAN', 0, 0, 24, 'hours', '[8,7,6,5,1,235,234,4245,129,6724,202,203,204,194,193,192,191,190,189,188,187,185,184,183,182,180,179,178,177,176,162,161,160,159,158,157,156,155,154,152,150,149,148,133,93,83,76,65,60,59,57,56,53,52,51,50,49,48,47,46,43,41,5,4,3,2]', 1, '[1,2,3]', 2, 1, 1),
(352, '3 Month Adult Only', 0, 0, 24, 'hours', '[8,7,6,5,1,235,155,75]', 1, '[1,2,3]', 2, 1, 1),
(354, '3 Month Adult & FULL VOD', 0, 0, 24, 'hours', '[8,7,6,5,1,155,75,194,193,192,189,188,187,185,184,183,182,180,179,178,177,262,261,256,255,254,253,252,251,250,249,248,247,246,245,244,243,208,207,206]', 1, '[1,2,3]', 2, 1, 1),
(355, '3 Month Sports NO VOD & NO ADULT', 0, 0, 24, 'hours', '[8,7,6,5,1,129,191,154,59,2,160,158,157,133,60,56,53,52,51,41]', 1, '[1,2,3]', 2, 1, 1),
(357, '3 Month Sports FULL VOD', 0, 0, 24, 'hours', '[8,7,6,5,1,129,192,189,187,185,184,180,179,191,154,59,2,160,158,157,133,60,56,53,52,51,41,256,255,254,253,252,251,250,249,248,247,246,245,244]', 1, '[1,2,3]', 2, 1, 1),
(358, '3 Month International NO VOD OR ADULT', 0, 0, 24, 'hours', '[8,7,6,5,1,235,234,4245,129,6724,202,203,204,149,148,133,132,128,127,126,125,124,123,122,121,120,119,118,117,116,115,114,113,112,111,110,109,108,107,106,105,104,103,102,101,100,99,98,97,96,43]', 1, '[1,2,3]', 2, 1, 1),
(360, '3 Month International Full VOD CLEAN', 0, 0, 24, 'hours', '[8,7,6,5,1,235,234,4245,129,6724,202,203,204,176,153,132,128,127,126,125,124,123,122,121,120,119,118,117,116,115,114,113,112,111,110,109,108,107,106,105,103,102,101,100,99,98,97,96,43,194,193,192,189,188,187,185,184,183,182,180,179,178,177,262,261,256,255,254,253,252,251,250,249,248,247,246,245,244,243,208,207,206]', 1, '[1,2,3]', 2, 1, 1),
(645, '6 Month All FULL VOD & ADULT', 0, 0, 24, 'hours', '[8,7,6,5,1,235,234,4245,129,6724,202,203,204,194,193,192,245,244,191,190,189,188,187,185,184,183,182,180,179,178,177,176,162,161,160,159,158,157,156,155,154,153,152,150,149,148,133,132,128,127,126,125,124,123,122,121,120,119,118,117,116,115,114,113,112,111,110,109,108,107,106,105,104,103,102,101,100,99,98,97,96,93,83,76,75,65,60,59,57,56,53,52,51,50,49,48,47,46,43,41,34,5,4,3,2,262,261,256,255,254,253,252,251,250,249,248,247,246,243,208,207,206,201,227,205,236]', 1, '[1,2,3]', 2, 1, 1),
(646, '6 Month UK US Canada Sports Adult NO VOD', 0, 0, 24, 'hours', '[8,7,6,5,1,129,191,162,161,160,159,158,157,156,154,133,93,83,76,75,65,60,59,56,53,52,51,50,49,48,47,46,41,4,3,2]', 1, '[1,2,3]', 2, 1, 1),
(648, '6 Month UK US Canada Sports Adult Full VOD', 0, 0, 24, 'hours', '[8,7,6,5,1,129,192,191,189,187,185,184,180,179,162,161,160,159,158,157,156,154,150,93,83,76,75,65,60,59,56,53,52,51,50,49,48,47,46,41,4,3,2,256,255,254,253,252,251,250,249,248,247,246,245,244]', 1, '[1,2,3]', 2, 1, 1),
(649, '6 Month UK US Canada Sports clean no vod', 0, 0, 24, 'hours', '[8,7,6,5,1,129,191,162,161,160,159,158,157,156,154,150,148,133,93,83,76,65,60,59,56,53,52,51,50,49,48,47,46,41,4,3,2]', 1, '[1,2,3]', 2, 1, 1),
(651, '6 Month UK US Canada Sports Full VOD', 0, 0, 24, 'hours', '[8,7,6,5,1,129,192,191,189,187,185,184,180,179,162,161,160,159,158,157,156,154,150,148,133,93,83,76,75,65,60,59,56,53,52,51,50,49,48,47,46,41,4,3,2,256,255,254,253,252,251,250,249,248,247,246,245,244,207,206]', 1, '[1,2,3]', 2, 1, 1),
(652, '6 Month Adult Only', 0, 0, 24, 'hours', '[8,7,6,5,1,235,75]', 1, '[1,2,3]', 2, 1, 1),
(654, '6 Month Adult ONLY FULL VOD', 0, 0, 24, 'hours', '[8,7,6,5,1,235,155,75,194,193,192,189,188,187,185,184,183,182,180,179,178,177,262,261,256,255,254,253,252,251,250,249,248,247,246,245,244,243,208,207,206]', 1, '[1,2,3]', 2, 1, 1),
(655, '6 Month Sports', 0, 0, 24, 'hours', '[8,7,6,5,1,129,191,154,59,2,160,158,157,133,60,56,53,52,51,41]', 1, '[1,2,3]', 2, 1, 1),
(657, '6 Month Sports FULL VOD', 0, 0, 24, 'hours', '[8,7,6,5,1,129,192,189,187,185,184,180,179,191,154,59,2,160,158,157,133,60,56,53,52,51,41,256,255,254,253,252,251,250,249,248,247,246,245,244,207,206]', 1, '[1,2,3]', 2, 1, 1),
(658, '6 Month International clean no vod', 0, 0, 24, 'hours', '[8,7,6,5,1,235,234,4245,129,6724,202,203,204,149,148,133,132,128,127,126,125,124,123,122,121,120,119,118,117,116,115,114,113,112,111,110,109,108,107,106,105,104,103,102,101,100,99,98,97,96,43]', 1, '[1,2,3]', 2, 1, 1),
(660, '6 Month International Full VOD clean', 0, 0, 24, 'hours', '[8,7,6,5,1,235,234,4245,129,6724,202,203,204,176,153,132,128,127,126,125,124,123,122,121,120,119,118,117,116,115,114,113,112,111,110,109,108,107,106,105,103,102,101,100,99,98,97,96,43,194,193,192,189,188,187,185,184,183,182,180,179,178,177,262,261,256,255,254,253,252,251,250,249,248,247,246,245,244,243,208,207,206]', 1, '[1,2,3]', 2, 1, 1),
(1245, '12 Month All FULL ADULT & VOD', 0, 0, 24, 'hours', '[8,7,6,5,1,235,234,4245,129,6724,202,203,204,194,193,192,245,244,191,190,189,188,187,185,184,183,182,180,179,178,177,176,162,161,160,159,158,157,156,155,154,153,152,150,149,148,133,132,128,127,126,125,124,123,122,121,120,119,118,117,116,115,114,113,112,111,110,109,108,107,106,105,104,103,102,101,100,99,98,97,96,93,83,76,75,65,60,59,57,56,53,52,51,50,49,48,47,46,43,41,34,5,4,3,2,262,261,256,255,254,253,252,251,250,249,248,247,246,243,236,227,208,207,206,205,201]', 1, '[1,2,3]', 2, 1, 1),
(1246, '12 Month UK US Canada Sports Adult NO VOD', 0, 0, 24, 'hours', '[8,7,6,5,1,129,191,162,161,160,159,158,157,156,154,133,93,83,76,75,65,60,59,56,53,52,51,50,49,48,47,46,41,4,3,2]', 1, '[1,2,3]', 2, 1, 1),
(1248, '12 Month UK US Canada Sports Adult Full VOD', 0, 0, 24, 'hours', '[8,7,6,5,1,129,192,191,189,187,185,184,180,179,162,161,160,159,158,157,156,154,150,93,83,76,75,65,60,59,56,53,52,51,50,49,48,47,46,41,4,3,2,256,255,254,253,252,251,250,249,248,247,246,245,244,207,206]', 1, '[1,2,3]', 2, 1, 1),
(1249, '12 Month UK US Canada Sports', 0, 0, 24, 'hours', '[8,7,6,5,1,129,191,162,161,160,159,158,157,156,154,150,148,133,93,83,76,75,65,60,59,56,53,52,51,50,49,48,47,46,41,4,3,2]', 1, '[1,2,3]', 2, 1, 1),
(1251, '12 Month UK US Canada Sports Full VOD & ADULT', 0, 0, 24, 'hours', '[8,7,6,5,1,129,192,191,189,187,185,184,180,179,176,162,161,160,159,158,157,156,154,150,148,133,93,83,76,75,65,60,59,56,53,52,51,50,49,48,47,46,41,4,3,2,256,255,254,253,252,251,250,249,248,247,246,245,244,207,206]', 1, '[1,2,3]', 2, 1, 1),
(1252, '12 Month Adult', 0, 0, 24, 'hours', '[8,7,6,5,1,235,155,75]', 1, '[1,2,3]', 2, 1, 1),
(1254, '12 Month Adult FULL VOD', 0, 0, 24, 'hours', '[8,7,6,5,1,235,234,4245,129,6724,202,203,204,155,75,194,193,192,189,188,187,185,184,183,182,180,179,178,177,262,261,256,255,254,253,252,251,250,249,248,247,246,245,244,243,208,207,206]', 1, '[1,2,3]', 2, 1, 1),
(1255, '12 Month Sports', 0, 0, 24, 'hours', '[8,7,6,5,1,129,191,154,59,2,160,158,157,133,60,56,53,52,51,41]', 1, '[1,2,3]', 2, 1, 1),
(1257, '12 Month Sports FULL VOD', 0, 0, 24, 'hours', '[8,7,6,5,1,192,189,187,185,184,180,179,191,154,59,2,160,158,157,133,60,56,53,52,51,41]', 1, '[1,2,3]', 2, 1, 1),
(1258, '12 Month International clean no vod', 0, 0, 24, 'hours', '[8,7,6,5,1,235,234,4245,129,6724,202,203,204,149,148,133,132,128,127,126,125,124,123,122,121,120,119,118,117,116,115,114,113,112,111,110,109,108,107,106,105,104,103,102,101,100,99,98,97,96,43]', 1, '[1,2,3]', 2, 1, 1),
(1260, '12 Month International Full VOD clean', 0, 0, 24, 'hours', '[8,7,6,5,1,235,234,4245,129,6724,202,203,204,176,153,132,128,127,126,125,124,123,122,121,120,119,118,117,116,115,114,113,112,111,110,109,108,107,106,105,103,102,101,100,99,98,97,96,43,194,193,192,189,188,187,185,184,183,182,180,179,178,177,262,261,256,255,254,253,252,251,250,249,248,247,246,245,244,243,208,207,206]', 1, '[1,2,3]', 2, 1, 1),
(1263, '3 Day Pass adult full vod', 0, 0, 0, 'hours', '[8,7,6,5,1,235,234,4245,129,6724,202,203,204,193,192,191,190,185,183,182,180,179,178,176,162,161,160,159,158,157,156,155,154,153,149,148,133,132,128,127,126,125,124,123,122,121,120,119,118,117,116,115,114,113,112,111,110,109,108,107,106,105,104,103,102,101,100,99,98,97,96,93,83,76,75,65,60,59,57,56,53,52,51,50,49,48,47,46,43,41,34,5,4,3,2,152,150,262,261,256,255,254,253,252,251,250,249,248,247,246,245,244,243,208,207,206,227,205,236,189,187,184,201]', 1, '[1,2,3]', 2, 1, 1),
(1264, '1 Month ALL Clean full vod', 0, 0, 0, 'hours', '[8,7,6,5,1,235,234,4245,129,6724,202,203,204,194,193,192,191,190,188,187,185,184,183,182,180,179,178,177,176,162,161,160,159,158,157,156,154,153,133,132,128,127,126,125,124,123,122,121,120,119,118,117,116,115,114,113,112,111,110,109,108,107,106,105,104,103,102,101,100,99,98,97,96,93,83,76,65,60,59,57,56,53,52,51,50,49,48,47,46,43,41,5,4,3,2,189,262,261,256,255,254,253,252,251,250,249,248,247,246,245,244,243,148,227,208,207,206,205,201,236]', 1, '[1,2,3]', 2, 1, 1),
(1265, 'Trial All W/O V.O.D', 0, 0, 0, 'hours', '[8,7,6,5,1,235,234,4245,129,6724,202,203,204,191,190,176,162,161,160,159,158,157,156,155,154,153,152,150,149,148,133,132,129,128,127,126,125,124,123,122,121,120,119,118,117,116,115,114,113,112,111,110,109,108,107,106,105,104,103,102,101,100,99,98,97,96,93,83,76,75,65,60,59,57,56,53,52,51,50,49,48,47,46,43,41,34,5,4,3,2]', 1, '[1,2,3]', 2, 1, 1),
(1266, '3 Month ALL Clean full vod', 0, 0, 0, 'hours', '[8,7,6,5,1,235,234,4245,129,6724,202,203,204,194,193,192,191,190,189,188,187,185,184,183,182,180,179,178,177,176,162,161,160,159,158,157,156,154,153,152,150,149,148,133,132,128,127,126,125,124,123,122,121,120,119,118,117,116,115,114,113,112,111,110,109,108,107,106,105,104,103,102,101,100,99,98,97,96,93,83,76,65,60,59,57,56,53,52,51,50,49,48,47,46,43,41,34,5,4,3,2,262,261,256,255,254,253,252,251,250,249,248,247,246,245,244,243,227,208,207,206,205,201,236]', 1, '[1,2,3]', 2, 1, 1),
(1267, '12 Month ALL Clean full vod', 0, 0, 0, 'hours', '[8,7,6,5,1,235,234,4245,129,6724,202,203,204,194,193,192,191,190,189,188,187,185,184,183,182,180,179,178,177,176,162,161,160,159,158,157,156,154,153,152,150,149,148,133,132,128,127,126,125,124,123,122,121,120,119,118,117,116,115,114,113,112,111,110,109,108,107,106,105,104,103,102,101,100,99,98,97,96,93,83,76,65,60,59,57,56,53,52,51,50,49,48,47,46,43,41,34,5,4,3,2,262,261,256,255,254,253,252,251,250,249,248,247,246,245,244,243,236,227,208,207,206,205,201]', 1, '[1,2,3]', 2, 1, 1),
(1270, 'UK USA and Canada Clean No Vod', 0, 0, 0, 'hours', '[8,7,6,5,1,235,4245,129,6724,202,203,204,50,49,48,47,46,5,3,2,154,93,83,59,4,191,43,162,161,76,65,60,57,56,53,52,51,41]', 1, '[1,2,3]', 2, 1, 1),
(1271, 'UK USA and Canada with Adults No Vod', 0, 0, 0, 'hours', '[8,7,6,5,1,235,129,6724,202,203,204,50,49,48,47,46,5,3,2,154,93,83,59,4,201,65,155,75,191,60,56,53,52,41]', 1, '[1,2,3]', 2, 1, 1),
(1276, 'All UK All Sports and Polish', 0, 0, 0, 'hours', '[8,7,6,5,1,235,234,4245,129,6724,202,203,204,158,157,154,132,59,56,53,52,51,50,49,48,47,46,43,41,4,3,2,194,193,192,188,187,185,184,183,182,180,179,178,177,191,60,160]', 1, '[1,2,3]', 2, 1, 1),
(1277, '1 Month UK US Sports Pak IND Polish FULL VOD (NO ADULT)', 0, 0, 0, 'hours', '[8,7,6,5,1,235,4245,129,204,203,202,193,192,191,189,188,187,185,184,183,182,180,179,178,177,160,158,157,154,132,108,102,93,65,60,59,56,53,52,51,50,49,48,47,46,43,41,4,3,2,262,261,256,255,254,253,252,251,250,249,248,247,246,245,244,243,208,207,206]', 0, '[1,2,3]', 2, 0, 1),
(1278, '3Months UK US CA VOD with Adults', 0, 0, 0, 'hours', '[8,7,6,5,1,235,4245,129,204,203,202,201,193,192,191,189,188,187,185,184,183,182,180,179,178,177,162,161,160,159,158,157,156,155,154,93,83,76,75,65,60,59,56,53,52,51,50,49,48,47,46,43,41,4,3,2,262,261,256,255,254,253,252,251,250,249,248,247,246,245,244,243,208,207,206,205]', 1, '[1,2,3]', 2, 1, 1),
(1279, '3Months UK US CA VOD without Adults', 0, 0, 0, 'hours', '[8,7,6,5,1,235,4245,129,204,203,202,201,193,192,191,188,187,185,184,183,182,180,179,178,177,162,161,160,159,158,157,155,154,93,83,76,75,65,60,59,56,53,52,51,50,49,48,47,46,43,41,4,3,2,262,261,256,255,254,253,252,251,250,249,248,247,246,245,244,243,208,207,206]', 1, '[1,2,3]', 2, 1, 1),
(1280, '6Months UK US CA vod with Adults', 0, 0, 0, 'hours', '[8,7,6,5,1,235,4245,129,204,203,202,201,193,192,191,188,187,185,184,183,182,180,179,178,177,162,161,160,159,158,157,156,155,154,93,83,76,75,65,60,59,56,53,52,51,50,49,48,47,46,43,41,4,3,2,262,261,256,255,254,253,252,251,250,249,248,247,246,245,244,243,208,207,206]', 1, '[1,2,3]', 2, 1, 1),
(1281, '6Months UK US CA vod without Adults', 0, 0, 0, 'hours', '[8,7,6,5,1,235,4245,129,204,203,202,201,193,192,191,188,187,185,184,183,182,180,179,178,177,162,161,160,159,158,157,156,154,93,83,76,65,60,59,56,53,52,51,50,49,48,47,46,43,41,4,3,2,262,261,256,255,254,253,252,251,250,249,248,247,246,245,244,243,208,207,206]', 1, '[1,2,3]', 2, 1, 1),
(1282, '3Months UK US CA adults without vod', 0, 0, 0, 'hours', '[8,7,6,5,1,235,129,204,203,202,201,162,161,160,159,158,157,156,155,154,93,83,76,75,65,60,59,56,53,52,51,50,49,48,47,46,43,41,4,3,2]', 1, '[1,2,3]', 2, 1, 1),
(1283, '6Months UK US CA Adults Without Vod', 0, 0, 0, 'hours', '[8,7,6,5,1,235,4245,129,204,203,202,201,162,161,160,159,158,157,156,155,154,93,83,76,75,65,60,59,56,53,52,51,50,49,48,47,46,43,41,4,3,2]', 1, '[1,2,3]', 2, 1, 1),
(1284, '1 Month Clean and No VOD', 0, 0, 0, 'hours', '[8,7,6,5,1,235,234,205,204,203,202,201,176,162,161,160,159,158,157,156,154,153,148,133,132,129,128,127,126,125,124,123,122,121,120,119,118,117,116,115,114,113,112,111,110,109,108,107,106,105,104,103,102,101,100,99,98,97,96,93,83,76,65,60,59,56,53,52,51,50,49,48,47,46,43,41,34,4,3,2]', 0, '[1,2,3]', 2, 0, 1),
(1285, 'CA AR MX UK US and Sports Clean NO VOD', 0, 0, 0, 'hours', '[8,7,6,5,1,235,234,204,203,202,201,191,161,162,160,159,154,93,83,76,65,60,59,56,53,52,51,50,49,48,47,46,43,41,4,3,2,110,96]', 0, '[1,2,3]', 2, 0, 1),
(1286, 'CA US UK MX Clean no vod', 1, 0, 24, 'hours', '[8,7,6,5,1,96,124,234,204,203,202,191,160,158,157,154,133,93,83,76,65,60,59,56,53,52,51,50,49,48,47,46,43,41,4,3,2]', 0, '[1,2,3]', 2, 0, 1),
(1287, 'USA,Arabic,Uk,Canada and sports FULL VOD', 1, 0, 24, 'hours', '[8,7,6,5,1,235,234,208,207,206,204,203,202,201,193,192,191,188,187,185,184,183,182,180,179,178,162,161,160,159,154,93,65,83,76,60,59,56,53,52,51,50,49,47,4,3,2,110,262,261,256,255,254,253,252,251,250,249,248,247,246,245,244,243]', 0, '[1,2,3]', 2, 0, 1),
(1288, 'All Clean Channels Trial NO VOD', 1, 0, 24, 'hours', '[8,7,6,5,1,235,234,227,204,203,202,201,191,176,162,161,160,159,158,157,156,154,148,133,132,129,128,127,126,125,124,123,122,121,120,119,118,117,116,115,114,113,112,111,110,109,108,107,106,105,104,103,102,101,100,99,98,97,96,93,83,76,65,60,59,56,53,52,51,50,49,48,47,46,43,41,4,3,2]', 1, '[1,2,3]', 2, 1, 1),
(1289, 'rocay50 FULL VOD', 1, 0, 1, 'days', '[8,7,6,5,1,237,262,261,256,255,254,253,252,251,250,249,248,247,246,245,244,243,208,207,206,192]', 1, '[1,2,3]', 2, 1, 1),
(1290, 'US, UK, CA, MX, and Sports vod and adults', 1, 0, 24, 'hours', '[8,7,6,5,1,65,60,59,56,53,52,51,50,49,48,47,46,41,4,3,2,96,83,76,75,93,154,208,207,206,204,203,202,201,193,192,191,189,188,187,185,184,183,182,180,179,178,177,176,162,161,160,159,243,262,261,256,255,254,253,252,251,250,249,248,247,246,245,244]', 1, '[1,2,3]', 1, 1, 1),
(1291, 'US, UK, CA, MX, and Sports Without Vod and Adults', 1, 0, 24, 'hours', '[8,7,6,5,1,65,60,59,56,53,52,51,50,49,48,47,46,41,34,4,3,2,96,93,162,161,160,159,154,204,203,202,208,207,206,243,201,83,76]', 1, '[1,2,3]', 1, 1, 1),
(1292, 'UK USA India Pakistan 6Months NO VOD CLEAN', 1, 0, 24, 'hours', '[8,7,6,5,1,50,49,48,47,46,3,2,154,93,83,4,243,201,162,161,159,76,102,203,59,51,108,60,56,53,52,204,202]', 1, '[1,2,3]', 1, 1, 1),
(1293, '6 Month All FULL VOD & CLEAN', 0, 0, 0, 'hours', '[8,7,6,5,1,256,255,254,253,252,251,250,249,248,247,246,245,244,236,234,227,207,206,205,204,203,202,201,192,191,189,187,185,184,180,179,176,162,161,160,159,158,157,156,154,153,150,148,133,132,129,128,127,126,125,124,123,122,121,120,119,118,117,116,115,114,113,112,111,110,109,108,107,106,105,104,103,102,101,100,99,98,97,96,93,83,76,65,60,59,56,53,52,51,50,49,48,47,46,41,34,4,3,2]', 1, '[1,2,3]', 2, 1, 1),
(1294, '1Month Full No Adults', 1, 0, 24, 'hours', '[8,7,6,5,1,96,93,65,60,59,56,53,52,51,41,2,102,108,162,161,159,154,192,256,255,254,253,252,251,250,249,248,247,246,245,244,201,191,189,187,185,184,180,179,234,124,237,236,233,232,231,230,229,228,227,207,206,205,176,160,158,157,156,153,150,148,133,132,129,128,127,126,125,123,122,121,120,119,118,117,116,115,114,113,112,111,110,109,107,106,105,104,103,101,100,99,98,97,83,76,50,49,48,47,46,4,3]', 0, '[1,2,3]', 2, 0, 1),
(1295, 'CA, MX, UK, US, Sports & Adult NO VOD 3-6 Months', 1, 3, 3, 'months', '[162,161,160,159,154,93,83,76,75,65,60,59,56,53,52,51,50,49,48,47,46,41,8,7,6,5,4,3,2,1]', 0, '[1,2,3]', 1, 0, 1),
(1298, 'EGA', 0, 1, 1, 'hours', '[\"254\",\"255\",\"256\"]', 0, '[\"1\",\"2\",\"3\"]', 1, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `packages_local`
--

CREATE TABLE `packages_local` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `super_reseller` tinyint(1) NOT NULL,
  `credits` int(5) NOT NULL,
  `price` int(5) NOT NULL,
  `period` int(2) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `packages_local`
--

INSERT INTO `packages_local` (`id`, `user_id`, `name`, `super_reseller`, `credits`, `price`, `period`, `logo`, `updated_at`, `status`) VALUES
(9, 605, 'Reseller', 0, 8, 5, 1, NULL, NULL, 1),
(10, 605, 'Super reseller', 1, 20, 20, 3, '5ba59b9a6c714.png', '2018-09-24 15:13:23', 1),
(11, 605, 'Super Reseller1', 1, 50, 50, 6, '5ba59b7a16491.jpg', '2018-10-01 09:37:10', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `phpbb_user`
--

CREATE TABLE `phpbb_user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `serverName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timeZone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `playerLogo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `allowRegistration` tinyint(1) DEFAULT NULL,
  `siteEnabled` tinyint(1) DEFAULT NULL,
  `companyPhone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `companyAddress` longtext COLLATE utf8_unicode_ci,
  `companyEmailSupport` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `serverAddress` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `aboutUs` longtext COLLATE utf8_unicode_ci,
  `updatedAt` datetime DEFAULT NULL,
  `emailServiceType` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `emailHost` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `emailPort` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emailUsername` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emailPassword` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emailAuthenticationMode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emailEncryptionMode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emailSender` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `news` longtext COLLATE utf8_unicode_ci,
  `servicesDescription` text COLLATE utf8_unicode_ci NOT NULL,
  `styleLayout` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `styleColor` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `settings`
--

INSERT INTO `settings` (`id`, `user_id`, `serverName`, `timeZone`, `logo`, `playerLogo`, `allowRegistration`, `siteEnabled`, `companyPhone`, `companyAddress`, `companyEmailSupport`, `serverAddress`, `aboutUs`, `updatedAt`, `emailServiceType`, `emailHost`, `emailPort`, `emailUsername`, `emailPassword`, `emailAuthenticationMode`, `emailEncryptionMode`, `emailSender`, `news`, `servicesDescription`, `styleLayout`, `styleColor`) VALUES
(1, 605, 'Xtream Code', 'Europe/London', '1bbd81f170cbfdd0f6c40b8fa8d6fdd208198a26.png', 'favico.ico', 1, 1, '(555) 555-5555', 'Address', 'support@liveengine.com', '127.0.0.1', '<p></p><p>Lorem<b> ipsum dolor sit amet, consectetur adipisicing elit, sed do \r\neiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad \r\nminim veniam, quis nostrud exercitation.Ullamco laboris nisi ut aliquip \r\nex ea commodo consequat. </b></p><b>\r\n                        </b><p><b>Duis aute irure dolor in reprehenderit</b> in \r\nvoluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur \r\nsint occaecat cupidatat non proident, sunt in culpa qui officia deserunt\r\n mollit anim id est laborum. Sed ut perspiciatis unde omnis iste. Lorem \r\nipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod \r\ntempor incididunt ut labore et dolore magna aliqua.</p><br><p></p>', '2018-09-26 13:26:34', 'local', 'smtp.google.com', '25', 'friman78@gmail.com', NULL, 'login', 'tls', 'noreply@livengine.com', NULL, '<p><b>Duis aute irure dolor in reprehenderit</b> in \r\nvoluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur \r\nsint occaecat cupidatat non proident, sunt in culpa qui officia deserunt\r\n mollit anim id est laborum. Sed ut perspiciatis unde omnis iste. Lorem \r\nipsum dolor sit amet, consectetur adipisicing elit<br></p>', 'sidebar-full-height sidebar-sm', 'style'),
(2, 604, 'Xtream Code', 'Europe/London', '1bbd81f170cbfdd0f6c40b8fa8d6fdd208198a26.png', 'favico.ico', 1, 1, '(555) 555-5555', 'Address', 'support@liveengine.com', '127.0.0.1', '<p></p><p>Lorem<b> ipsum dolor sit amet, consectetur adipisicing elit, sed do \r\neiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad \r\nminim veniam, quis nostrud exercitation.Ullamco laboris nisi ut aliquip \r\nex ea commodo consequat. </b></p><b>\r\n                        </b><p><b>Duis aute irure dolor in reprehenderit</b> in \r\nvoluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur \r\nsint occaecat cupidatat non proident, sunt in culpa qui officia deserunt\r\n mollit anim id est laborum. Sed ut perspiciatis unde omnis iste. Lorem \r\nipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod \r\ntempor incididunt ut labore et dolore magna aliqua.</p><br><p></p>', '2018-09-20 20:58:42', 'local', 'smtp.google.com', '25', 'friman78@gmail.com', NULL, 'login', 'tls', 'noreply@livengine.com', NULL, '<p><b>Duis aute irure dolor in reprehenderit</b> in \r\nvoluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur \r\nsint occaecat cupidatat non proident, sunt in culpa qui officia deserunt\r\n mollit anim id est laborum. Sed ut perspiciatis unde omnis iste. Lorem \r\nipsum dolor sit amet, consectetur adipisicing elit<br></p>', 'sidebar-full-height sidebar-sm', 'style');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stream_reports`
--

CREATE TABLE `stream_reports` (
  `id` int(11) NOT NULL,
  `stream_name` text NOT NULL,
  `stream_id` int(11) NOT NULL,
  `issues` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `createdAt` datetime NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `stream_reports`
--

INSERT INTO `stream_reports` (`id`, `stream_name`, `stream_id`, `issues`, `status`, `createdAt`, `user_id`) VALUES
(1, 'FR: Cine Famiz HD', 4, '[\"Channel is down\",\"Wrong Channel\"]', 0, '2018-09-14 08:35:41', 605),
(2, 'FR: Cine Famiz HD', 4, '[\"Channel is down\",\"Wrong Channel\"]', 0, '2018-09-19 20:30:40', 605);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickets_replies_resellers`
--

CREATE TABLE `tickets_replies_resellers` (
  `id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `admin_reply` tinyint(4) NOT NULL,
  `message` mediumtext NOT NULL,
  `createdAt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tickets_replies_resellers`
--

INSERT INTO `tickets_replies_resellers` (`id`, `ticket_id`, `admin_reply`, `message`, `createdAt`) VALUES
(28, 28, 1, 'Hellow. I buy a package named Reseller.', 1537801235),
(29, 28, 0, 'Ok. I`ll see and go to proced', 1537803166),
(30, 29, 1, 'Hellow. I bought a package named \'Super Reseller1\'. The transactionId to the order is: 15378034855ba904ddcb631', 1537803486),
(31, 30, 1, 'Hellow. I bought a package named \'Super Reseller1\'. The transactionId to the order is: 15378084495ba9184154cfb', 1537808449),
(32, 31, 1, 'Hellow. I bought a package named \'Super Reseller1\'. The transactionId to the order is: 15378084665ba9185256c8f', 1537808466),
(33, 32, 1, 'Hellow. I bought a package named \'Super Reseller1\'. The transactionId to the order is: 15378084985ba91872205a8', 1537808498),
(34, 33, 1, 'Hellow. I bought a package named \'Super Reseller1\'. The transactionId to the order is: 15378085245ba9188c24629', 1537808524),
(35, 34, 1, 'Hellow. I bought a package named \'Super Reseller1\'. The transactionId to the order is: 15378085515ba918a7052c4', 1537808551),
(36, 35, 1, 'Hellow. I bought a package named \'Super Reseller1\'. The transactionId to the order is: 15378086275ba918f37f8f4', 1537808627),
(37, 36, 1, 'Hellow. I bought a package named \'Super Reseller1\'. The transactionId to the order is: 15378086655ba91919922cc', 1537808665),
(38, 37, 1, 'Hellow. I bought a package named \'Super reseller\'. The transactionId to the order is: 15378090485ba91a98bd332', 1537809049),
(39, 38, 1, 'Hellow. I bought a package named \'Super Reseller1\'. The transactionId to the order is: 15378096835ba91d13a45bf', 1537809683),
(40, 39, 1, 'Hellow. I bought a package named \'Super Reseller1\'. The transactionId to the order is: 15378097125ba91d3084a30', 1537809712),
(41, 40, 1, 'Hellow. I bought a package named \'Super Reseller1\'. The transactionId to the order is: 15378097215ba91d394775b', 1537809721),
(42, 41, 1, 'Hellow. I bought a package named \'Super Reseller1\'. The transactionId to the order is: 15378097295ba91d41efed6', 1537809730),
(43, 42, 1, 'Hellow. I bought a package named \'Super Reseller1\'. The transactionId to the order is: 15378097375ba91d491794d', 1537809737),
(44, 43, 1, 'Hellow. I bought a package named \'Super Reseller1\'. The transactionId to the order is: 15378097435ba91d4f0ecdc', 1537809743),
(45, 44, 1, 'Hellow. I bought a package named \'Super Reseller1\'. The transactionId to the order is: 15378109345ba921f6942ac', 1537810934),
(46, 45, 1, 'Hellow. I bought a package named \'Super Reseller1\'. The transactionId to the order is: 15378111065ba922a2dd18c', 1537811106),
(47, 46, 1, 'Hellow. I bought a package named \'Super reseller\'. The transactionId to the order is: 15378113775ba923b1c9d30', 1537811378),
(48, 47, 1, 'Hellow. I bought a package named \'Super reseller\'. The transactionId to the order is: 15378116185ba924a252b94', 1537811618),
(49, 48, 1, 'Hellow. I bought a package named \'Super reseller\'. The transactionId to the order is: 15378116915ba924eb1731f', 1537811691),
(50, 49, 1, 'Hellow. I bought a package named \'Super reseller\'. The transactionId to the order is: 15378117895ba9254d595bd', 1537811789),
(51, 50, 1, 'Hellow. I bought a package named \'Super reseller\'. The transactionId to the order is: 15378119685ba926008999b', 1537811968),
(52, 51, 1, 'Hellow. I bought a package named \'Super reseller\'. The transactionId to the order is: 15378120185ba92632af2c9', 1537812018),
(53, 52, 1, 'Hellow. I bought a package named \'Super reseller\'. The transactionId to the order is: 15378120275ba9263b798d6', 1537812027),
(54, 53, 1, 'Hellow. I bought a package named \'Super reseller\'. The transactionId to the order is: 15378131675ba92aaf75f7a', 1537813167),
(55, 54, 1, 'Hellow. I bought a package named \'Super reseller\'. The transactionId to the order is: 15378132305ba92aee08b3d', 1537813230),
(56, 55, 1, 'Hellow. I bought a package named \'Super reseller\'. The transactionId to the order is: 15378141125ba92e6002920', 1537814112),
(57, 56, 1, 'Hellow. I bought a package named \'Super reseller\'. The transactionId to the order is: 15378143555ba92f53771ae', 1537814355),
(58, 57, 1, 'Hellow. I bought a package named \'Super reseller\'. The transactionId to the order is: 15378144705ba92fc63deb6', 1537814470),
(59, 58, 1, 'Hellow. I bought a package named \'Super reseller\'. The transactionId to the order is: 15378162165ba936981d473', 1537816216),
(60, 59, 1, 'Hellow. I bought a package named \'Super reseller\'. The transactionId to the order is: 15378163335ba9370d958a2', 1537816333),
(61, 60, 1, 'Hellow. I bought a package named \'Super reseller\'. The transactionId to the order is: 15378163565ba93724139b1', 1537816356),
(62, 61, 1, 'Hellow. I bought a package named \'Super reseller\'. The transactionId to the order is: 15378163755ba937370a669', 1537816375),
(63, 62, 1, 'Hellow. I bought a package named \'Super reseller\'. The transactionId to the order is: 15378164035ba9375387da3', 1537816403);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickets_resellers`
--

CREATE TABLE `tickets_resellers` (
  `id` int(11) NOT NULL,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `issue` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `to_read` tinyint(4) NOT NULL,
  `from_read` tinyint(4) NOT NULL,
  `createdAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tickets_resellers`
--

INSERT INTO `tickets_resellers` (`id`, `from_id`, `to_id`, `issue`, `status`, `to_read`, `from_read`, `createdAt`) VALUES
(28, 604, 605, 'Payments', 1, 1, 1, '2018-09-24 11:00:35'),
(29, 604, 605, 'Payments', 1, 1, 1, '2018-09-24 11:38:06'),
(30, 604, 605, 'Payments', 1, 1, 1, '2018-09-24 13:00:49'),
(31, 604, 605, 'Payments', 1, 1, 1, '2018-09-24 13:01:06'),
(32, 604, 605, 'Payments', 1, 1, 1, '2018-09-24 13:01:38'),
(33, 604, 605, 'Payments', 1, 1, 1, '2018-09-24 13:02:04'),
(34, 604, 605, 'Payments', 1, 1, 1, '2018-09-24 13:02:31'),
(35, 604, 605, 'Payments', 1, 1, 1, '2018-09-24 13:03:47'),
(36, 604, 605, 'Payments', 1, 1, 1, '2018-09-24 13:04:25'),
(37, 604, 605, 'Payments', 1, 1, 1, '2018-09-24 13:10:48'),
(38, 604, 605, 'Payments', 1, 1, 1, '2018-09-24 13:21:23'),
(39, 604, 605, 'Payments', 1, 1, 1, '2018-09-24 13:21:52'),
(40, 604, 605, 'Payments', 1, 1, 1, '2018-09-24 13:22:01'),
(41, 604, 605, 'Payments', 1, 1, 1, '2018-09-24 13:22:10'),
(42, 604, 605, 'Payments', 1, 1, 1, '2018-09-24 13:22:17'),
(43, 604, 605, 'Payments', 1, 1, 1, '2018-09-24 13:22:23'),
(44, 604, 605, 'Payments', 1, 1, 1, '2018-09-24 13:42:14'),
(45, 604, 605, 'Payments', 1, 1, 1, '2018-09-24 13:45:06'),
(46, 604, 605, 'Payments', 1, 1, 1, '2018-09-24 13:49:38'),
(47, 604, 605, 'Payments', 1, 1, 1, '2018-09-24 13:53:38'),
(48, 604, 605, 'Payments', 1, 1, 1, '2018-09-24 13:54:51'),
(49, 604, 605, 'Payments', 1, 1, 1, '2018-09-24 13:56:29'),
(50, 604, 605, 'Payments', 1, 1, 1, '2018-09-24 13:59:28'),
(51, 604, 605, 'Payments', 1, 1, 1, '2018-09-24 14:00:18'),
(52, 604, 605, 'Payments', 1, 1, 1, '2018-09-24 14:00:27'),
(53, 604, 605, 'Payments', 1, 1, 1, '2018-09-24 14:19:27'),
(54, 604, 605, 'Payments', 1, 1, 1, '2018-09-24 14:20:30'),
(55, 604, 605, 'Payments', 1, 1, 1, '2018-09-24 14:35:12'),
(56, 604, 605, 'Payments', 1, 1, 1, '2018-09-24 14:39:15'),
(57, 604, 605, 'Payments', 1, 1, 1, '2018-09-24 14:41:10'),
(58, 604, 605, 'Payments', 1, 1, 1, '2018-09-24 15:10:16'),
(59, 604, 605, 'Payments', 1, 1, 1, '2018-09-24 15:12:13'),
(60, 604, 605, 'Payments', 1, 1, 1, '2018-09-24 15:12:36'),
(61, 604, 605, 'Payments', 1, 1, 1, '2018-09-24 15:12:55'),
(62, 604, 605, 'Payments', 1, 1, 1, '2018-09-24 15:13:23');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `billing_configuration`
--
ALTER TABLE `billing_configuration`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`code`);

--
-- Indices de la tabla `gateways`
--
ALTER TABLE `gateways`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `issues`
--
ALTER TABLE `issues`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E52FFDEE9395C3F3` (`customer_id`),
  ADD KEY `IDX_E52FFDEE577F8E00` (`gateway_id`);

--
-- Indices de la tabla `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `is_trial` (`is_trial`),
  ADD KEY `can_gen_mag` (`can_gen_mag`),
  ADD KEY `can_gen_e2` (`can_gen_e2`);

--
-- Indices de la tabla `packages_local`
--
ALTER TABLE `packages_local`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `phpbb_user`
--
ALTER TABLE `phpbb_user`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_E545A0C5A76ED395` (`user_id`);

--
-- Indices de la tabla `stream_reports`
--
ALTER TABLE `stream_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tickets_replies_resellers`
--
ALTER TABLE `tickets_replies_resellers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_id` (`ticket_id`);

--
-- Indices de la tabla `tickets_resellers`
--
ALTER TABLE `tickets_resellers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `to_id` (`to_id`),
  ADD KEY `from_id` (`from_id`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `billing_configuration`
--
ALTER TABLE `billing_configuration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `gateways`
--
ALTER TABLE `gateways`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `issues`
--
ALTER TABLE `issues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT de la tabla `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1299;
--
-- AUTO_INCREMENT de la tabla `packages_local`
--
ALTER TABLE `packages_local`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `phpbb_user`
--
ALTER TABLE `phpbb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `stream_reports`
--
ALTER TABLE `stream_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tickets_replies_resellers`
--
ALTER TABLE `tickets_replies_resellers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT de la tabla `tickets_resellers`
--
ALTER TABLE `tickets_resellers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tickets_replies_resellers`
--
ALTER TABLE `tickets_replies_resellers`
  ADD CONSTRAINT `tickets_replies_resellers_ibfk_1` FOREIGN KEY (`ticket_id`) REFERENCES `tickets_resellers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
