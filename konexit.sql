-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2022 at 12:50 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `konexit`
--

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE `forms` (
  `id` int(11) NOT NULL,
  `formid` varchar(50) NOT NULL,
  `form_data` longtext DEFAULT NULL,
  `form_title` varchar(500) NOT NULL,
  `form_sub_title` varchar(500) DEFAULT NULL,
  `form_version` int(100) DEFAULT NULL,
  `status` enum('0','1','2') NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forms`
--

INSERT INTO `forms` (`id`, `formid`, `form_data`, `form_title`, `form_sub_title`, `form_version`, `status`, `created_at`, `updated_at`) VALUES
(1, 'KON1', '{\"components\":[{\"label\":\"Drop down\",\"tableView\":true,\"type\":\"select\",\"widget\":\"choicesjs\",\"key\":\"select\",\"input\":true},{\"type\":\"textfield\",\"key\":\"firstName\",\"label\":\"First Name\",\"input\":true,\"tableView\":true},{\"type\":\"textfield\",\"key\":\"lastName\",\"label\":\"Last Name\",\"input\":true,\"tableView\":true},{\"label\":\"Text Field\",\"type\":\"textfield\",\"key\":\"textField2\",\"input\":true,\"tableView\":true},{\"html\":\"<p>Hello this is demo text.<\\/p>\",\"label\":\"Static Text\",\"refreshOnChange\":false,\"type\":\"content\",\"key\":\"content\",\"input\":false,\"tableView\":false},{\"label\":\"Static Text\",\"refreshOnChange\":false,\"type\":\"content\",\"key\":\"content1\",\"input\":false,\"tableView\":false},{\"label\":\"Date\",\"format\":\"yyyy-MM-dd\",\"tableView\":false,\"datePicker\":{\"disableWeekends\":false,\"disableWeekdays\":false},\"enableTime\":false,\"timePicker\":{\"showMeridian\":false},\"enableMinDateInput\":false,\"enableMaxDateInput\":false,\"key\":\"dateTime\",\"type\":\"datetime\",\"input\":true,\"widget\":{\"type\":\"calendar\",\"displayInTimezone\":\"viewer\",\"locale\":\"en\",\"useLocaleSettings\":false,\"allowInput\":true,\"mode\":\"single\",\"enableTime\":false,\"noCalendar\":false,\"format\":\"yyyy-MM-dd\",\"hourIncrement\":1,\"minuteIncrement\":1,\"time_24hr\":true,\"minDate\":null,\"disableWeekends\":false,\"disableWeekdays\":false,\"maxDate\":null}},{\"label\":\"Submit\",\"showValidations\":false,\"block\":true,\"tableView\":false,\"type\":\"button\",\"key\":\"submit1\",\"input\":true}]}', 'test27', NULL, 6, '0', '2022-12-01 10:01:56', '2022-12-01 11:59:29'),
(2, 'KON2', '{\"components\":[{\"type\":\"textfield\",\"key\":\"lastName\",\"label\":\"Last Name\",\"input\":true,\"tableView\":true},{\"label\":\"Static Text\",\"refreshOnChange\":false,\"type\":\"content\",\"key\":\"content\",\"input\":false,\"tableView\":false},{\"label\":\"Time Capture\",\"tableView\":true,\"type\":\"time\",\"key\":\"time\",\"input\":true,\"inputMask\":\"99:99\"},{\"label\":\"Static Text\",\"refreshOnChange\":false,\"type\":\"content\",\"key\":\"content1\",\"input\":false,\"tableView\":false},{\"label\":\"Address\",\"tableView\":true,\"type\":\"address\",\"input\":true,\"key\":\"address\",\"map\":{\"region\":\"\",\"key\":\"AIzaSyCk_zrE74VOviFJ-kx_tSwbRmrZH-JxAJI\"},\"$$hashKey\":\"object:583\",\"components\":[{\"label\":\"Address 1\",\"tableView\":false,\"key\":\"address1\",\"type\":\"textfield\",\"input\":true,\"customConditional\":\"show = _.get(instance, \'parent.manualMode\', false);\"},{\"label\":\"Address 2\",\"tableView\":false,\"key\":\"address2\",\"type\":\"textfield\",\"input\":true,\"customConditional\":\"show = _.get(instance, \'parent.manualMode\', false);\"},{\"label\":\"City\",\"tableView\":false,\"key\":\"city\",\"type\":\"textfield\",\"input\":true,\"customConditional\":\"show = _.get(instance, \'parent.manualMode\', false);\"},{\"label\":\"State\",\"tableView\":false,\"key\":\"state\",\"type\":\"textfield\",\"input\":true,\"customConditional\":\"show = _.get(instance, \'parent.manualMode\', false);\"},{\"label\":\"Country\",\"tableView\":false,\"key\":\"country\",\"type\":\"textfield\",\"input\":true,\"customConditional\":\"show = _.get(instance, \'parent.manualMode\', false);\"},{\"label\":\"Zip Code\",\"tableView\":false,\"key\":\"zip\",\"type\":\"textfield\",\"input\":true,\"customConditional\":\"show = _.get(instance, \'parent.manualMode\', false);\"}],\"provider\":\"google\",\"providerOptions\":{\"params\":{\"key\":\"AIzaSyCk_zrE74VOviFJ-kx_tSwbRmrZH-JxAJI\"}}},{\"label\":\"Date\",\"format\":\"yyyy-MM-dd\",\"tableView\":false,\"datePicker\":{\"disableWeekends\":false,\"disableWeekdays\":false},\"enableTime\":false,\"timePicker\":{\"showMeridian\":false},\"enableMinDateInput\":false,\"enableMaxDateInput\":false,\"key\":\"dateTime\",\"type\":\"datetime\",\"input\":true,\"widget\":{\"type\":\"calendar\",\"displayInTimezone\":\"viewer\",\"locale\":\"en\",\"useLocaleSettings\":false,\"allowInput\":true,\"mode\":\"single\",\"enableTime\":false,\"noCalendar\":false,\"format\":\"yyyy-MM-dd\",\"hourIncrement\":1,\"minuteIncrement\":1,\"time_24hr\":true,\"minDate\":null,\"disableWeekends\":false,\"disableWeekdays\":false,\"maxDate\":null}},{\"label\":\"Date \\/ Time\",\"tableView\":false,\"datePicker\":{\"disableWeekends\":false,\"disableWeekdays\":false},\"type\":\"datetime\",\"enableMinDateInput\":false,\"enableMaxDateInput\":false,\"key\":\"dateTime1\",\"input\":true,\"widget\":{\"type\":\"calendar\",\"displayInTimezone\":\"viewer\",\"locale\":\"en\",\"useLocaleSettings\":false,\"allowInput\":true,\"mode\":\"single\",\"enableTime\":true,\"noCalendar\":false,\"format\":\"yyyy-MM-dd hh:mm a\",\"hourIncrement\":1,\"minuteIncrement\":1,\"time_24hr\":false,\"minDate\":null,\"disableWeekends\":false,\"disableWeekdays\":false,\"maxDate\":null}}]}', 'asdas', NULL, 7, '2', '2022-12-01 10:03:48', '2022-12-01 14:50:09');

--
-- Triggers `forms`
--
DELIMITER $$
CREATE TRIGGER `mytrigger` BEFORE INSERT ON `forms` FOR EACH ROW SET NEW.formid = 
  CONCAT("KON",COALESCE((SELECT MAX(id)+1 from forms),1))
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `formversions`
--

CREATE TABLE `formversions` (
  `id` int(11) NOT NULL,
  `formid` int(100) DEFAULT NULL,
  `form_data` longtext DEFAULT NULL,
  `form_title` varchar(500) DEFAULT NULL,
  `formversion` int(100) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `formversions`
--

INSERT INTO `formversions` (`id`, `formid`, `form_data`, `form_title`, `formversion`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'test', 1, '2022-12-01 10:01:56', '2022-12-01 10:01:56'),
(2, 2, '{\"components\":[{\"type\":\"textfield\",\"key\":\"lastName\",\"label\":\"Last Name\",\"input\":true,\"tableView\":true},{\"label\":\"Static Text\",\"refreshOnChange\":false,\"type\":\"content\",\"key\":\"content\",\"input\":false,\"tableView\":false},{\"label\":\"Time Capture\",\"tableView\":true,\"type\":\"time\",\"key\":\"time\",\"input\":true,\"inputMask\":\"99:99\"},{\"label\":\"Date\",\"format\":\"yyyy-MM-dd\",\"tableView\":false,\"datePicker\":{\"disableWeekends\":false,\"disableWeekdays\":false},\"enableTime\":false,\"timePicker\":{\"showMeridian\":false},\"enableMinDateInput\":false,\"enableMaxDateInput\":false,\"key\":\"dateTime\",\"type\":\"datetime\",\"input\":true,\"widget\":{\"type\":\"calendar\",\"displayInTimezone\":\"viewer\",\"locale\":\"en\",\"useLocaleSettings\":false,\"allowInput\":true,\"mode\":\"single\",\"enableTime\":false,\"noCalendar\":false,\"format\":\"yyyy-MM-dd\",\"hourIncrement\":1,\"minuteIncrement\":1,\"time_24hr\":true,\"minDate\":null,\"disableWeekends\":false,\"disableWeekdays\":false,\"maxDate\":null}},{\"label\":\"Date \\/ Time\",\"tableView\":false,\"datePicker\":{\"disableWeekends\":false,\"disableWeekdays\":false},\"type\":\"datetime\",\"enableMinDateInput\":false,\"enableMaxDateInput\":false,\"key\":\"dateTime1\",\"input\":true,\"widget\":{\"type\":\"calendar\",\"displayInTimezone\":\"viewer\",\"locale\":\"en\",\"useLocaleSettings\":false,\"allowInput\":true,\"mode\":\"single\",\"enableTime\":true,\"noCalendar\":false,\"format\":\"yyyy-MM-dd hh:mm a\",\"hourIncrement\":1,\"minuteIncrement\":1,\"time_24hr\":false,\"minDate\":null,\"disableWeekends\":false,\"disableWeekdays\":false,\"maxDate\":null}}]}', 'asdas', 1, '2022-12-01 10:03:48', '2022-12-01 10:04:27'),
(3, 1, '{\"components\":[{\"type\":\"textfield\",\"key\":\"firstName\",\"label\":\"First Name\",\"input\":true,\"tableView\":true},{\"type\":\"textfield\",\"key\":\"lastName\",\"label\":\"Last Name\",\"input\":true,\"tableView\":true},{\"label\":\"Text Field\",\"type\":\"textfield\",\"key\":\"textField2\",\"input\":true,\"tableView\":true},{\"html\":\"<p>Hello this is demo text.<\\/p>\",\"label\":\"Static Text\",\"refreshOnChange\":false,\"type\":\"content\",\"key\":\"content\",\"input\":false,\"tableView\":false},{\"label\":\"Date\",\"format\":\"yyyy-MM-dd\",\"tableView\":false,\"datePicker\":{\"disableWeekends\":false,\"disableWeekdays\":false},\"enableTime\":false,\"timePicker\":{\"showMeridian\":false},\"enableMinDateInput\":false,\"enableMaxDateInput\":false,\"key\":\"dateTime\",\"type\":\"datetime\",\"input\":true,\"widget\":{\"type\":\"calendar\",\"displayInTimezone\":\"viewer\",\"locale\":\"en\",\"useLocaleSettings\":false,\"allowInput\":true,\"mode\":\"single\",\"enableTime\":false,\"noCalendar\":false,\"format\":\"yyyy-MM-dd\",\"hourIncrement\":1,\"minuteIncrement\":1,\"time_24hr\":true,\"minDate\":null,\"disableWeekends\":false,\"disableWeekdays\":false,\"maxDate\":null}},{\"label\":\"Submit\",\"showValidations\":false,\"block\":true,\"tableView\":false,\"type\":\"button\",\"key\":\"submit1\",\"input\":true}]}', NULL, 2, '2022-12-01 10:49:25', '2022-12-01 10:51:50'),
(4, 1, '{\"components\":[{\"type\":\"textfield\",\"key\":\"firstName\",\"label\":\"First Name\",\"input\":true,\"tableView\":true},{\"type\":\"textfield\",\"key\":\"lastName\",\"label\":\"Last Name\",\"input\":true,\"tableView\":true},{\"label\":\"Text Field\",\"type\":\"textfield\",\"key\":\"textField2\",\"input\":true,\"tableView\":true},{\"html\":\"<p>Hello this is demo text.<\\/p>\",\"label\":\"Static Text\",\"refreshOnChange\":false,\"type\":\"content\",\"key\":\"content\",\"input\":false,\"tableView\":false},{\"label\":\"Static Text\",\"refreshOnChange\":false,\"type\":\"content\",\"key\":\"content1\",\"input\":false,\"tableView\":false},{\"label\":\"Date\",\"format\":\"yyyy-MM-dd\",\"tableView\":false,\"datePicker\":{\"disableWeekends\":false,\"disableWeekdays\":false},\"enableTime\":false,\"timePicker\":{\"showMeridian\":false},\"enableMinDateInput\":false,\"enableMaxDateInput\":false,\"key\":\"dateTime\",\"type\":\"datetime\",\"input\":true,\"widget\":{\"type\":\"calendar\",\"displayInTimezone\":\"viewer\",\"locale\":\"en\",\"useLocaleSettings\":false,\"allowInput\":true,\"mode\":\"single\",\"enableTime\":false,\"noCalendar\":false,\"format\":\"yyyy-MM-dd\",\"hourIncrement\":1,\"minuteIncrement\":1,\"time_24hr\":true,\"minDate\":null,\"disableWeekends\":false,\"disableWeekdays\":false,\"maxDate\":null}},{\"label\":\"Submit\",\"showValidations\":false,\"block\":true,\"tableView\":false,\"type\":\"button\",\"key\":\"submit1\",\"input\":true}]}', 'test', 3, '2022-12-01 10:52:09', '2022-12-01 10:52:24'),
(5, 1, '{\"components\":[{\"label\":\"Drop down\",\"tableView\":true,\"type\":\"select\",\"widget\":\"choicesjs\",\"key\":\"select\",\"input\":true},{\"type\":\"textfield\",\"key\":\"firstName\",\"label\":\"First Name\",\"input\":true,\"tableView\":true},{\"type\":\"textfield\",\"key\":\"lastName\",\"label\":\"Last Name\",\"input\":true,\"tableView\":true},{\"label\":\"Text Field\",\"type\":\"textfield\",\"key\":\"textField2\",\"input\":true,\"tableView\":true},{\"html\":\"<p>Hello this is demo text.<\\/p>\",\"label\":\"Static Text\",\"refreshOnChange\":false,\"type\":\"content\",\"key\":\"content\",\"input\":false,\"tableView\":false},{\"label\":\"Static Text\",\"refreshOnChange\":false,\"type\":\"content\",\"key\":\"content1\",\"input\":false,\"tableView\":false},{\"label\":\"Date\",\"format\":\"yyyy-MM-dd\",\"tableView\":false,\"datePicker\":{\"disableWeekends\":false,\"disableWeekdays\":false},\"enableTime\":false,\"timePicker\":{\"showMeridian\":false},\"enableMinDateInput\":false,\"enableMaxDateInput\":false,\"key\":\"dateTime\",\"type\":\"datetime\",\"input\":true,\"widget\":{\"type\":\"calendar\",\"displayInTimezone\":\"viewer\",\"locale\":\"en\",\"useLocaleSettings\":false,\"allowInput\":true,\"mode\":\"single\",\"enableTime\":false,\"noCalendar\":false,\"format\":\"yyyy-MM-dd\",\"hourIncrement\":1,\"minuteIncrement\":1,\"time_24hr\":true,\"minDate\":null,\"disableWeekends\":false,\"disableWeekdays\":false,\"maxDate\":null}},{\"label\":\"Submit\",\"showValidations\":false,\"block\":true,\"tableView\":false,\"type\":\"button\",\"key\":\"submit1\",\"input\":true}]}', 'test', 4, '2022-12-01 10:53:40', '2022-12-01 10:53:44'),
(6, 2, '{\"components\":[{\"type\":\"textfield\",\"key\":\"lastName\",\"label\":\"Last Name\",\"input\":true,\"tableView\":true},{\"label\":\"Static Text\",\"refreshOnChange\":false,\"type\":\"content\",\"key\":\"content\",\"input\":false,\"tableView\":false},{\"label\":\"Time Capture\",\"tableView\":true,\"type\":\"time\",\"key\":\"time\",\"input\":true,\"inputMask\":\"99:99\"},{\"label\":\"Date\",\"format\":\"yyyy-MM-dd\",\"tableView\":false,\"datePicker\":{\"disableWeekends\":false,\"disableWeekdays\":false},\"enableTime\":false,\"timePicker\":{\"showMeridian\":false},\"enableMinDateInput\":false,\"enableMaxDateInput\":false,\"key\":\"dateTime\",\"type\":\"datetime\",\"input\":true,\"widget\":{\"type\":\"calendar\",\"displayInTimezone\":\"viewer\",\"locale\":\"en\",\"useLocaleSettings\":false,\"allowInput\":true,\"mode\":\"single\",\"enableTime\":false,\"noCalendar\":false,\"format\":\"yyyy-MM-dd\",\"hourIncrement\":1,\"minuteIncrement\":1,\"time_24hr\":true,\"minDate\":null,\"disableWeekends\":false,\"disableWeekdays\":false,\"maxDate\":null}},{\"label\":\"Date \\/ Time\",\"tableView\":false,\"datePicker\":{\"disableWeekends\":false,\"disableWeekdays\":false},\"type\":\"datetime\",\"enableMinDateInput\":false,\"enableMaxDateInput\":false,\"key\":\"dateTime1\",\"input\":true,\"widget\":{\"type\":\"calendar\",\"displayInTimezone\":\"viewer\",\"locale\":\"en\",\"useLocaleSettings\":false,\"allowInput\":true,\"mode\":\"single\",\"enableTime\":true,\"noCalendar\":false,\"format\":\"yyyy-MM-dd hh:mm a\",\"hourIncrement\":1,\"minuteIncrement\":1,\"time_24hr\":false,\"minDate\":null,\"disableWeekends\":false,\"disableWeekdays\":false,\"maxDate\":null}}]}', 'asdas', 2, '2022-12-01 10:55:49', '2022-12-01 10:55:49'),
(7, 2, '{\"components\":[{\"type\":\"textfield\",\"key\":\"lastName\",\"label\":\"Last Name\",\"input\":true,\"tableView\":true},{\"label\":\"Static Text\",\"refreshOnChange\":false,\"type\":\"content\",\"key\":\"content\",\"input\":false,\"tableView\":false},{\"label\":\"Time Capture\",\"tableView\":true,\"type\":\"time\",\"key\":\"time\",\"input\":true,\"inputMask\":\"99:99\"},{\"label\":\"Date\",\"format\":\"yyyy-MM-dd\",\"tableView\":false,\"datePicker\":{\"disableWeekends\":false,\"disableWeekdays\":false},\"enableTime\":false,\"timePicker\":{\"showMeridian\":false},\"enableMinDateInput\":false,\"enableMaxDateInput\":false,\"key\":\"dateTime\",\"type\":\"datetime\",\"input\":true,\"widget\":{\"type\":\"calendar\",\"displayInTimezone\":\"viewer\",\"locale\":\"en\",\"useLocaleSettings\":false,\"allowInput\":true,\"mode\":\"single\",\"enableTime\":false,\"noCalendar\":false,\"format\":\"yyyy-MM-dd\",\"hourIncrement\":1,\"minuteIncrement\":1,\"time_24hr\":true,\"minDate\":null,\"disableWeekends\":false,\"disableWeekdays\":false,\"maxDate\":null}},{\"label\":\"Date \\/ Time\",\"tableView\":false,\"datePicker\":{\"disableWeekends\":false,\"disableWeekdays\":false},\"type\":\"datetime\",\"enableMinDateInput\":false,\"enableMaxDateInput\":false,\"key\":\"dateTime1\",\"input\":true,\"widget\":{\"type\":\"calendar\",\"displayInTimezone\":\"viewer\",\"locale\":\"en\",\"useLocaleSettings\":false,\"allowInput\":true,\"mode\":\"single\",\"enableTime\":true,\"noCalendar\":false,\"format\":\"yyyy-MM-dd hh:mm a\",\"hourIncrement\":1,\"minuteIncrement\":1,\"time_24hr\":false,\"minDate\":null,\"disableWeekends\":false,\"disableWeekdays\":false,\"maxDate\":null}}]}', 'asdas', 3, '2022-12-01 11:43:58', '2022-12-01 11:43:58'),
(8, 1, '{\"components\":[{\"label\":\"Drop down\",\"tableView\":true,\"type\":\"select\",\"widget\":\"choicesjs\",\"key\":\"select\",\"input\":true},{\"type\":\"textfield\",\"key\":\"firstName\",\"label\":\"First Name\",\"input\":true,\"tableView\":true},{\"type\":\"textfield\",\"key\":\"lastName\",\"label\":\"Last Name\",\"input\":true,\"tableView\":true},{\"label\":\"Text Field\",\"type\":\"textfield\",\"key\":\"textField2\",\"input\":true,\"tableView\":true},{\"html\":\"<p>Hello this is demo text.<\\/p>\",\"label\":\"Static Text\",\"refreshOnChange\":false,\"type\":\"content\",\"key\":\"content\",\"input\":false,\"tableView\":false},{\"label\":\"Static Text\",\"refreshOnChange\":false,\"type\":\"content\",\"key\":\"content1\",\"input\":false,\"tableView\":false},{\"label\":\"Date\",\"format\":\"yyyy-MM-dd\",\"tableView\":false,\"datePicker\":{\"disableWeekends\":false,\"disableWeekdays\":false},\"enableTime\":false,\"timePicker\":{\"showMeridian\":false},\"enableMinDateInput\":false,\"enableMaxDateInput\":false,\"key\":\"dateTime\",\"type\":\"datetime\",\"input\":true,\"widget\":{\"type\":\"calendar\",\"displayInTimezone\":\"viewer\",\"locale\":\"en\",\"useLocaleSettings\":false,\"allowInput\":true,\"mode\":\"single\",\"enableTime\":false,\"noCalendar\":false,\"format\":\"yyyy-MM-dd\",\"hourIncrement\":1,\"minuteIncrement\":1,\"time_24hr\":true,\"minDate\":null,\"disableWeekends\":false,\"disableWeekdays\":false,\"maxDate\":null}},{\"label\":\"Submit\",\"showValidations\":false,\"block\":true,\"tableView\":false,\"type\":\"button\",\"key\":\"submit1\",\"input\":true}]}', 'test2', 5, '2022-12-01 11:57:46', '2022-12-01 11:57:46'),
(9, 1, '{\"components\":[{\"label\":\"Drop down\",\"tableView\":true,\"type\":\"select\",\"widget\":\"choicesjs\",\"key\":\"select\",\"input\":true},{\"type\":\"textfield\",\"key\":\"firstName\",\"label\":\"First Name\",\"input\":true,\"tableView\":true},{\"type\":\"textfield\",\"key\":\"lastName\",\"label\":\"Last Name\",\"input\":true,\"tableView\":true},{\"label\":\"Text Field\",\"type\":\"textfield\",\"key\":\"textField2\",\"input\":true,\"tableView\":true},{\"html\":\"<p>Hello this is demo text.<\\/p>\",\"label\":\"Static Text\",\"refreshOnChange\":false,\"type\":\"content\",\"key\":\"content\",\"input\":false,\"tableView\":false},{\"label\":\"Static Text\",\"refreshOnChange\":false,\"type\":\"content\",\"key\":\"content1\",\"input\":false,\"tableView\":false},{\"label\":\"Date\",\"format\":\"yyyy-MM-dd\",\"tableView\":false,\"datePicker\":{\"disableWeekends\":false,\"disableWeekdays\":false},\"enableTime\":false,\"timePicker\":{\"showMeridian\":false},\"enableMinDateInput\":false,\"enableMaxDateInput\":false,\"key\":\"dateTime\",\"type\":\"datetime\",\"input\":true,\"widget\":{\"type\":\"calendar\",\"displayInTimezone\":\"viewer\",\"locale\":\"en\",\"useLocaleSettings\":false,\"allowInput\":true,\"mode\":\"single\",\"enableTime\":false,\"noCalendar\":false,\"format\":\"yyyy-MM-dd\",\"hourIncrement\":1,\"minuteIncrement\":1,\"time_24hr\":true,\"minDate\":null,\"disableWeekends\":false,\"disableWeekdays\":false,\"maxDate\":null}},{\"label\":\"Submit\",\"showValidations\":false,\"block\":true,\"tableView\":false,\"type\":\"button\",\"key\":\"submit1\",\"input\":true}]}', 'test27', 6, '2022-12-01 11:59:29', '2022-12-01 11:59:29'),
(10, 2, '{\"components\":[{\"type\":\"textfield\",\"key\":\"lastName\",\"label\":\"Last Name\",\"input\":true,\"tableView\":true},{\"label\":\"Static Text\",\"refreshOnChange\":false,\"type\":\"content\",\"key\":\"content\",\"input\":false,\"tableView\":false},{\"label\":\"Time Capture\",\"tableView\":true,\"type\":\"time\",\"key\":\"time\",\"input\":true,\"inputMask\":\"99:99\"},{\"label\":\"Static Text\",\"refreshOnChange\":false,\"type\":\"content\",\"key\":\"content1\",\"input\":false,\"tableView\":false},{\"label\":\"Address\",\"tableView\":true,\"type\":\"address\",\"input\":true,\"key\":\"address\",\"map\":{\"region\":\"\",\"key\":\"AIzaSyCk_zrE74VOviFJ-kx_tSwbRmrZH-JxAJI\"},\"$$hashKey\":\"object:583\",\"components\":[{\"label\":\"Address 1\",\"tableView\":false,\"key\":\"address1\",\"type\":\"textfield\",\"input\":true,\"customConditional\":\"show = _.get(instance, \'parent.manualMode\', false);\"},{\"label\":\"Address 2\",\"tableView\":false,\"key\":\"address2\",\"type\":\"textfield\",\"input\":true,\"customConditional\":\"show = _.get(instance, \'parent.manualMode\', false);\"},{\"label\":\"City\",\"tableView\":false,\"key\":\"city\",\"type\":\"textfield\",\"input\":true,\"customConditional\":\"show = _.get(instance, \'parent.manualMode\', false);\"},{\"label\":\"State\",\"tableView\":false,\"key\":\"state\",\"type\":\"textfield\",\"input\":true,\"customConditional\":\"show = _.get(instance, \'parent.manualMode\', false);\"},{\"label\":\"Country\",\"tableView\":false,\"key\":\"country\",\"type\":\"textfield\",\"input\":true,\"customConditional\":\"show = _.get(instance, \'parent.manualMode\', false);\"},{\"label\":\"Zip Code\",\"tableView\":false,\"key\":\"zip\",\"type\":\"textfield\",\"input\":true,\"customConditional\":\"show = _.get(instance, \'parent.manualMode\', false);\"}],\"provider\":\"google\",\"providerOptions\":{\"params\":{\"key\":\"AIzaSyCk_zrE74VOviFJ-kx_tSwbRmrZH-JxAJI\"}}},{\"label\":\"Date\",\"format\":\"yyyy-MM-dd\",\"tableView\":false,\"datePicker\":{\"disableWeekends\":false,\"disableWeekdays\":false},\"enableTime\":false,\"timePicker\":{\"showMeridian\":false},\"enableMinDateInput\":false,\"enableMaxDateInput\":false,\"key\":\"dateTime\",\"type\":\"datetime\",\"input\":true,\"widget\":{\"type\":\"calendar\",\"displayInTimezone\":\"viewer\",\"locale\":\"en\",\"useLocaleSettings\":false,\"allowInput\":true,\"mode\":\"single\",\"enableTime\":false,\"noCalendar\":false,\"format\":\"yyyy-MM-dd\",\"hourIncrement\":1,\"minuteIncrement\":1,\"time_24hr\":true,\"minDate\":null,\"disableWeekends\":false,\"disableWeekdays\":false,\"maxDate\":null}},{\"label\":\"Date \\/ Time\",\"tableView\":false,\"datePicker\":{\"disableWeekends\":false,\"disableWeekdays\":false},\"type\":\"datetime\",\"enableMinDateInput\":false,\"enableMaxDateInput\":false,\"key\":\"dateTime1\",\"input\":true,\"widget\":{\"type\":\"calendar\",\"displayInTimezone\":\"viewer\",\"locale\":\"en\",\"useLocaleSettings\":false,\"allowInput\":true,\"mode\":\"single\",\"enableTime\":true,\"noCalendar\":false,\"format\":\"yyyy-MM-dd hh:mm a\",\"hourIncrement\":1,\"minuteIncrement\":1,\"time_24hr\":false,\"minDate\":null,\"disableWeekends\":false,\"disableWeekdays\":false,\"maxDate\":null}}]}', 'asdas', 4, '2022-12-01 12:05:52', '2022-12-01 12:06:07'),
(11, 2, '{\"components\":[{\"type\":\"textfield\",\"key\":\"lastName\",\"label\":\"Last Name\",\"input\":true,\"tableView\":true},{\"label\":\"Static Text\",\"refreshOnChange\":false,\"type\":\"content\",\"key\":\"content\",\"input\":false,\"tableView\":false},{\"label\":\"Time Capture\",\"tableView\":true,\"type\":\"time\",\"key\":\"time\",\"input\":true,\"inputMask\":\"99:99\"},{\"label\":\"Static Text\",\"refreshOnChange\":false,\"type\":\"content\",\"key\":\"content1\",\"input\":false,\"tableView\":false},{\"label\":\"Address\",\"tableView\":true,\"type\":\"address\",\"input\":true,\"key\":\"address\",\"map\":{\"region\":\"\",\"key\":\"AIzaSyCk_zrE74VOviFJ-kx_tSwbRmrZH-JxAJI\"},\"$$hashKey\":\"object:583\",\"components\":[{\"label\":\"Address 1\",\"tableView\":false,\"key\":\"address1\",\"type\":\"textfield\",\"input\":true,\"customConditional\":\"show = _.get(instance, \'parent.manualMode\', false);\"},{\"label\":\"Address 2\",\"tableView\":false,\"key\":\"address2\",\"type\":\"textfield\",\"input\":true,\"customConditional\":\"show = _.get(instance, \'parent.manualMode\', false);\"},{\"label\":\"City\",\"tableView\":false,\"key\":\"city\",\"type\":\"textfield\",\"input\":true,\"customConditional\":\"show = _.get(instance, \'parent.manualMode\', false);\"},{\"label\":\"State\",\"tableView\":false,\"key\":\"state\",\"type\":\"textfield\",\"input\":true,\"customConditional\":\"show = _.get(instance, \'parent.manualMode\', false);\"},{\"label\":\"Country\",\"tableView\":false,\"key\":\"country\",\"type\":\"textfield\",\"input\":true,\"customConditional\":\"show = _.get(instance, \'parent.manualMode\', false);\"},{\"label\":\"Zip Code\",\"tableView\":false,\"key\":\"zip\",\"type\":\"textfield\",\"input\":true,\"customConditional\":\"show = _.get(instance, \'parent.manualMode\', false);\"}],\"provider\":\"google\",\"providerOptions\":{\"params\":{\"key\":\"AIzaSyCk_zrE74VOviFJ-kx_tSwbRmrZH-JxAJI\"}}},{\"label\":\"Date\",\"format\":\"yyyy-MM-dd\",\"tableView\":false,\"datePicker\":{\"disableWeekends\":false,\"disableWeekdays\":false},\"enableTime\":false,\"timePicker\":{\"showMeridian\":false},\"enableMinDateInput\":false,\"enableMaxDateInput\":false,\"key\":\"dateTime\",\"type\":\"datetime\",\"input\":true,\"widget\":{\"type\":\"calendar\",\"displayInTimezone\":\"viewer\",\"locale\":\"en\",\"useLocaleSettings\":false,\"allowInput\":true,\"mode\":\"single\",\"enableTime\":false,\"noCalendar\":false,\"format\":\"yyyy-MM-dd\",\"hourIncrement\":1,\"minuteIncrement\":1,\"time_24hr\":true,\"minDate\":null,\"disableWeekends\":false,\"disableWeekdays\":false,\"maxDate\":null}},{\"label\":\"Date \\/ Time\",\"tableView\":false,\"datePicker\":{\"disableWeekends\":false,\"disableWeekdays\":false},\"type\":\"datetime\",\"enableMinDateInput\":false,\"enableMaxDateInput\":false,\"key\":\"dateTime1\",\"input\":true,\"widget\":{\"type\":\"calendar\",\"displayInTimezone\":\"viewer\",\"locale\":\"en\",\"useLocaleSettings\":false,\"allowInput\":true,\"mode\":\"single\",\"enableTime\":true,\"noCalendar\":false,\"format\":\"yyyy-MM-dd hh:mm a\",\"hourIncrement\":1,\"minuteIncrement\":1,\"time_24hr\":false,\"minDate\":null,\"disableWeekends\":false,\"disableWeekdays\":false,\"maxDate\":null}}]}', 'asdas', 5, '2022-12-01 12:34:37', '2022-12-01 12:34:37'),
(12, 2, '{\"components\":[{\"type\":\"textfield\",\"key\":\"lastName\",\"label\":\"Last Name\",\"input\":true,\"tableView\":true},{\"label\":\"Static Text\",\"refreshOnChange\":false,\"type\":\"content\",\"key\":\"content\",\"input\":false,\"tableView\":false},{\"label\":\"Time Capture\",\"tableView\":true,\"type\":\"time\",\"key\":\"time\",\"input\":true,\"inputMask\":\"99:99\"},{\"label\":\"Static Text\",\"refreshOnChange\":false,\"type\":\"content\",\"key\":\"content1\",\"input\":false,\"tableView\":false},{\"label\":\"Address\",\"tableView\":true,\"type\":\"address\",\"input\":true,\"key\":\"address\",\"map\":{\"region\":\"\",\"key\":\"AIzaSyCk_zrE74VOviFJ-kx_tSwbRmrZH-JxAJI\"},\"$$hashKey\":\"object:583\",\"components\":[{\"label\":\"Address 1\",\"tableView\":false,\"key\":\"address1\",\"type\":\"textfield\",\"input\":true,\"customConditional\":\"show = _.get(instance, \'parent.manualMode\', false);\"},{\"label\":\"Address 2\",\"tableView\":false,\"key\":\"address2\",\"type\":\"textfield\",\"input\":true,\"customConditional\":\"show = _.get(instance, \'parent.manualMode\', false);\"},{\"label\":\"City\",\"tableView\":false,\"key\":\"city\",\"type\":\"textfield\",\"input\":true,\"customConditional\":\"show = _.get(instance, \'parent.manualMode\', false);\"},{\"label\":\"State\",\"tableView\":false,\"key\":\"state\",\"type\":\"textfield\",\"input\":true,\"customConditional\":\"show = _.get(instance, \'parent.manualMode\', false);\"},{\"label\":\"Country\",\"tableView\":false,\"key\":\"country\",\"type\":\"textfield\",\"input\":true,\"customConditional\":\"show = _.get(instance, \'parent.manualMode\', false);\"},{\"label\":\"Zip Code\",\"tableView\":false,\"key\":\"zip\",\"type\":\"textfield\",\"input\":true,\"customConditional\":\"show = _.get(instance, \'parent.manualMode\', false);\"}],\"provider\":\"google\",\"providerOptions\":{\"params\":{\"key\":\"AIzaSyCk_zrE74VOviFJ-kx_tSwbRmrZH-JxAJI\"}}},{\"label\":\"Date\",\"format\":\"yyyy-MM-dd\",\"tableView\":false,\"datePicker\":{\"disableWeekends\":false,\"disableWeekdays\":false},\"enableTime\":false,\"timePicker\":{\"showMeridian\":false},\"enableMinDateInput\":false,\"enableMaxDateInput\":false,\"key\":\"dateTime\",\"type\":\"datetime\",\"input\":true,\"widget\":{\"type\":\"calendar\",\"displayInTimezone\":\"viewer\",\"locale\":\"en\",\"useLocaleSettings\":false,\"allowInput\":true,\"mode\":\"single\",\"enableTime\":false,\"noCalendar\":false,\"format\":\"yyyy-MM-dd\",\"hourIncrement\":1,\"minuteIncrement\":1,\"time_24hr\":true,\"minDate\":null,\"disableWeekends\":false,\"disableWeekdays\":false,\"maxDate\":null}},{\"label\":\"Date \\/ Time\",\"tableView\":false,\"datePicker\":{\"disableWeekends\":false,\"disableWeekdays\":false},\"type\":\"datetime\",\"enableMinDateInput\":false,\"enableMaxDateInput\":false,\"key\":\"dateTime1\",\"input\":true,\"widget\":{\"type\":\"calendar\",\"displayInTimezone\":\"viewer\",\"locale\":\"en\",\"useLocaleSettings\":false,\"allowInput\":true,\"mode\":\"single\",\"enableTime\":true,\"noCalendar\":false,\"format\":\"yyyy-MM-dd hh:mm a\",\"hourIncrement\":1,\"minuteIncrement\":1,\"time_24hr\":false,\"minDate\":null,\"disableWeekends\":false,\"disableWeekdays\":false,\"maxDate\":null}}]}', 'asdas', 6, '2022-12-01 12:38:13', '2022-12-01 12:38:13'),
(13, 2, '{\"components\":[{\"type\":\"textfield\",\"key\":\"lastName\",\"label\":\"Last Name\",\"input\":true,\"tableView\":true},{\"label\":\"Static Text\",\"refreshOnChange\":false,\"type\":\"content\",\"key\":\"content\",\"input\":false,\"tableView\":false},{\"label\":\"Time Capture\",\"tableView\":true,\"type\":\"time\",\"key\":\"time\",\"input\":true,\"inputMask\":\"99:99\"},{\"label\":\"Static Text\",\"refreshOnChange\":false,\"type\":\"content\",\"key\":\"content1\",\"input\":false,\"tableView\":false},{\"label\":\"Address\",\"tableView\":true,\"type\":\"address\",\"input\":true,\"key\":\"address\",\"map\":{\"region\":\"\",\"key\":\"AIzaSyCk_zrE74VOviFJ-kx_tSwbRmrZH-JxAJI\"},\"$$hashKey\":\"object:583\",\"components\":[{\"label\":\"Address 1\",\"tableView\":false,\"key\":\"address1\",\"type\":\"textfield\",\"input\":true,\"customConditional\":\"show = _.get(instance, \'parent.manualMode\', false);\"},{\"label\":\"Address 2\",\"tableView\":false,\"key\":\"address2\",\"type\":\"textfield\",\"input\":true,\"customConditional\":\"show = _.get(instance, \'parent.manualMode\', false);\"},{\"label\":\"City\",\"tableView\":false,\"key\":\"city\",\"type\":\"textfield\",\"input\":true,\"customConditional\":\"show = _.get(instance, \'parent.manualMode\', false);\"},{\"label\":\"State\",\"tableView\":false,\"key\":\"state\",\"type\":\"textfield\",\"input\":true,\"customConditional\":\"show = _.get(instance, \'parent.manualMode\', false);\"},{\"label\":\"Country\",\"tableView\":false,\"key\":\"country\",\"type\":\"textfield\",\"input\":true,\"customConditional\":\"show = _.get(instance, \'parent.manualMode\', false);\"},{\"label\":\"Zip Code\",\"tableView\":false,\"key\":\"zip\",\"type\":\"textfield\",\"input\":true,\"customConditional\":\"show = _.get(instance, \'parent.manualMode\', false);\"}],\"provider\":\"google\",\"providerOptions\":{\"params\":{\"key\":\"AIzaSyCk_zrE74VOviFJ-kx_tSwbRmrZH-JxAJI\"}}},{\"label\":\"Date\",\"format\":\"yyyy-MM-dd\",\"tableView\":false,\"datePicker\":{\"disableWeekends\":false,\"disableWeekdays\":false},\"enableTime\":false,\"timePicker\":{\"showMeridian\":false},\"enableMinDateInput\":false,\"enableMaxDateInput\":false,\"key\":\"dateTime\",\"type\":\"datetime\",\"input\":true,\"widget\":{\"type\":\"calendar\",\"displayInTimezone\":\"viewer\",\"locale\":\"en\",\"useLocaleSettings\":false,\"allowInput\":true,\"mode\":\"single\",\"enableTime\":false,\"noCalendar\":false,\"format\":\"yyyy-MM-dd\",\"hourIncrement\":1,\"minuteIncrement\":1,\"time_24hr\":true,\"minDate\":null,\"disableWeekends\":false,\"disableWeekdays\":false,\"maxDate\":null}},{\"label\":\"Date \\/ Time\",\"tableView\":false,\"datePicker\":{\"disableWeekends\":false,\"disableWeekdays\":false},\"type\":\"datetime\",\"enableMinDateInput\":false,\"enableMaxDateInput\":false,\"key\":\"dateTime1\",\"input\":true,\"widget\":{\"type\":\"calendar\",\"displayInTimezone\":\"viewer\",\"locale\":\"en\",\"useLocaleSettings\":false,\"allowInput\":true,\"mode\":\"single\",\"enableTime\":true,\"noCalendar\":false,\"format\":\"yyyy-MM-dd hh:mm a\",\"hourIncrement\":1,\"minuteIncrement\":1,\"time_24hr\":false,\"minDate\":null,\"disableWeekends\":false,\"disableWeekdays\":false,\"maxDate\":null}}]}', 'asdas', 7, '2022-12-01 13:02:28', '2022-12-01 13:02:28');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `type`) VALUES
(1, 'admin', 0),
(2, 'organization', 1),
(3, 'user', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `parent_id` int(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `role` int(10) NOT NULL DEFAULT 2,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `profile` varchar(500) DEFAULT NULL,
  `phone` varchar(59) DEFAULT NULL,
  `user_quota` int(100) NOT NULL DEFAULT 0,
  `total_users` int(100) NOT NULL DEFAULT 0,
  `status` enum('0','1','2','3') NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `forget_pass` varchar(50) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `email_verified_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `parent_id`, `name`, `lname`, `role`, `email`, `password`, `profile`, `phone`, `user_quota`, `total_users`, `status`, `created_at`, `updated_at`, `forget_pass`, `remember_token`, `email_verified_at`) VALUES
(1, 1, 'Admin', 'Panel', 0, 'admin@gmail.com', 'eyJpdiI6IlR3elRGYVBXL29LN2t3c1AyT1Rjanc9PSIsInZhbHVlIjoiWmEzSmY2bXBjU2ZVQXV5Z2gvUXhNdz09IiwibWFjIjoiNWQ5ZWM1MTNkYzUzYzQzODBhNDZhZWYwZWRkZmQ1NDdlZWQ0OWM0MjBhOTQwMTZmZmU2MGZlODJkYTkyZDVjOCIsInRhZyI6IiJ9', 'https://konexit.s3.us-east-2.amazonaws.com/admin/1669112759.jpg', NULL, 0, 0, '1', '2022-11-09 11:31:22', '2022-12-02 09:30:48', '5479', NULL, NULL),
(2, 1, 'Wonka Industries', NULL, 1, 'Johndelahay22@gmail.com', 'eyJpdiI6Im5kMUtlb2ZHN0JTaFBpeXR0SlRUSEE9PSIsInZhbHVlIjoiZGlFMnFYYXhxRndYbFIxemRlZ2FGZz09IiwibWFjIjoiZmE2NGRhOWI4MDIxNGQ2MjY0YzM3NjI1Zjg0MWJjYWVjMjhjZTg0MDhjODMzYjExZTZlZDQ2NTFjNDlmZTUwMiIsInRhZyI6IiJ9', 'https://konexit.s3.us-east-2.amazonaws.com/organization/1669707954.png', NULL, 50, 0, '0', '2022-11-29 07:45:55', '2022-12-02 13:08:28', NULL, NULL, NULL),
(3, 1, 'Acme Corp\n', NULL, 1, '	\nAidabugg347@gmail.com', 'eyJpdiI6InNESitkRjNsNm51eitzY3Z5NGpLQWc9PSIsInZhbHVlIjoibDZkNFROVDRQODVpRC9NTW03eUE0Zz09IiwibWFjIjoiMWFkMmZiZGM3MDI2YmEzNDA0OTc2ZWJmZWMyYTljMjRmMmFjOTg3ZjZkNzMyZDY2OTU3OTNmNTk1ZTc2YzAzMSIsInRhZyI6IiJ9', 'https://konexit.s3.us-east-2.amazonaws.com/organization/1669708028.png', NULL, 60, 0, '0', '2022-11-29 07:47:10', '2022-11-29 17:16:07', NULL, NULL, NULL),
(4, 1, 'Wayne Enterprises', NULL, 1, 'Eleendover22@gmail.com', 'eyJpdiI6Ikt2eWU2a0Q4Qm1TWS9XL014b2QzV3c9PSIsInZhbHVlIjoiNGNzRGtQWHc2QXBoT2FsMDliN1FGdz09IiwibWFjIjoiOTg5NTA5YzVlOTVlYmE4YWM3ZDJjMzNiMjc3ZjIyMThkMDgxZjNkMTQxYzk5OWE3ZjJiYmI5ZDgxZjRmZDkwOCIsInRhZyI6IiJ9', 'https://konexit.s3.us-east-2.amazonaws.com/organization/1669710161.png', NULL, 60, 0, '0', '2022-11-29 08:22:45', '2022-11-29 17:16:07', NULL, NULL, NULL),
(5, 1, 'Genco Pura Olive', NULL, 1, 'greentheresa@gmail.com', 'eyJpdiI6InRuM2lOK3NRL1JTUXQyZklkY3pCMnc9PSIsInZhbHVlIjoiUmNYNnNMUXFKd2xTbTZuYlVlTnhlUT09IiwibWFjIjoiZmM3ZTlmOTY3ZTRhZGNmODE3MzA1ZmQ1OWY1OWMwNmU1NjEzMDJiY2EyNDE0ZmMzODNiZWQ5MGY2ZDM3ZjgyZiIsInRhZyI6IiJ9', 'https://konexit.s3.us-east-2.amazonaws.com/organization/1669710239.png', NULL, 60, 0, '1', '2022-11-29 08:24:00', '2022-11-29 17:16:07', NULL, NULL, NULL),
(10, 1, 'Om Enterprises2', NULL, 1, 'omni@gmail.com', 'eyJpdiI6IlJPd1ViMWUrT2g5TTNMa0UyM1JSVnc9PSIsInZhbHVlIjoiSHI5YmpHVVZvb29XMjQ5WmF1T2tEdz09IiwibWFjIjoiZWMwMDgwZjJlNDZlYTZjNGU1YTRiOWJmYTUwYzJjMWFjODRlOGYwZGYxMWU3OTM1MWM2MDYwYmY5NDc3NzRkZCIsInRhZyI6IiJ9', 'https://konexit.s3.us-east-2.amazonaws.com/organization/1669903912.png', NULL, 32, 6, '2', '2022-11-29 11:49:17', '2022-12-02 10:18:03', NULL, NULL, NULL),
(11, 10, 'test', 'test', 2, 'test@gmail.com', 'eyJpdiI6IjNOekVzS01FVGJLRlhQWE5EZTJtY1E9PSIsInZhbHVlIjoiM1VFbkg1S1RQUy9XRzZXbVdYNG5tZz09IiwibWFjIjoiYzQ5ODk5NmU3ZGQzODM1NmM4ZDQyMzQ5NTI1ZmQzZTcyM2YwOTllY2RmZmYwMmJkYmI1NDFmZGIzMGFlMzVmMiIsInRhZyI6IiJ9', 'https://konexit.s3.us-east-2.amazonaws.com/users/1669975154.jpg', NULL, 0, 0, '1', '2022-12-02 09:59:21', '2022-12-02 09:59:21', NULL, NULL, NULL),
(12, 10, 'test2', 'test2', 2, 'test23@gmail.com', 'eyJpdiI6Im1way9VeDczVE9mWVg1YWxvVTFZNVE9PSIsInZhbHVlIjoiVDAzLzFQL00yMEozTlo2VE5xcWMyZz09IiwibWFjIjoiOGU5NmI3MDQ5NmQzNDY0NWI5MTg1YzZhZjczMzg5MzkzM2Y2OWJjMThkYzY4MzU5NTM1YzgzNTY0MDZhMjc5ZCIsInRhZyI6IiJ9', NULL, NULL, 0, 0, '0', '2022-12-02 10:12:21', '2022-12-02 10:12:21', NULL, NULL, NULL),
(13, 10, 'test23', 'test23', 2, 'test233@gmail.com', 'eyJpdiI6InliNy8reS9aZGhoMitIMTR5RHlUdGc9PSIsInZhbHVlIjoiei8rQ1dVbU5tSGp2RjdRN21IR01Udz09IiwibWFjIjoiMGM5OGRhY2YyN2Q5NWU5ZTcwOGQ1NDVhOTBjNTA4NmNiMzQzMWRhYjQxNjFhYmVhYjI4NjJjZjZkNzgzMjM4NCIsInRhZyI6IiJ9', NULL, NULL, 0, 0, '0', '2022-12-02 10:13:15', '2022-12-02 10:13:15', NULL, NULL, NULL),
(14, 10, 'dmk', 'demk', 2, 'demk@gmail.com', 'eyJpdiI6InhiQ3hXQlRsSDdUZFVSc0w3dGd4VkE9PSIsInZhbHVlIjoiN2VyeTkxSE44RTJwTm04UTJJOXExQT09IiwibWFjIjoiOGVmN2VkYzkwNjI3ZTg5ZDFhMDIwNjNjZjI4OWQzMDRiODQ5NGJkMDhjNDEzMzU2NDc0OWZmMDIzNjdlNzViYiIsInRhZyI6IiJ9', NULL, NULL, 0, 0, '0', '2022-12-02 10:15:07', '2022-12-02 10:15:07', NULL, NULL, NULL),
(15, 10, 'dmk', 'demk', 2, 'demk2@gmail.com', 'eyJpdiI6IklMNlBnZWJwWFgwQ0VnM284b3ppcmc9PSIsInZhbHVlIjoicGVSUzVlTEh6YjhDYll6TmZPcmJmZz09IiwibWFjIjoiZTRmMTMyODkxMDk3YWNjMGVmOWVkMDg0YzEyNGYxYWI5YWMyZTBlOWY4MTAzYWU0M2EwMjhmZDIwOGJmYjBlNSIsInRhZyI6IiJ9', NULL, NULL, 0, 0, '0', '2022-12-02 10:17:11', '2022-12-02 10:17:11', NULL, NULL, NULL),
(16, 10, 'dmk4', 'demk4', 2, 'demk24@gmail.com', 'eyJpdiI6IitkZGRMeGsrL2p1T21PTmdsOUlRbmc9PSIsInZhbHVlIjoiWTFZQ2YwakF1d29vZ0wvWFVMZDZodz09IiwibWFjIjoiMGQxZmQyYmY2MjBlMzBmMDkyZjM5MWY1MzIwNWFhMTgzZDJmM2FkMGM2NGE5MDIxM2U5YWYzOTc4NjRlMGY5ZCIsInRhZyI6IiJ9', NULL, NULL, 0, 0, '0', '2022-12-02 10:18:03', '2022-12-02 10:18:03', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `forms`
--
ALTER TABLE `forms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `formversions`
--
ALTER TABLE `formversions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `formid` (`formid`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `forms`
--
ALTER TABLE `forms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `formversions`
--
ALTER TABLE `formversions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `formversions`
--
ALTER TABLE `formversions`
  ADD CONSTRAINT `formversions_ibfk_1` FOREIGN KEY (`formid`) REFERENCES `forms` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
