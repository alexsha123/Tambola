-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 10, 2025 at 07:08 PM
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
-- Database: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Table structure for table `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(11) NOT NULL,
  `dbase` varchar(255) NOT NULL DEFAULT '',
  `user` varchar(255) NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `query` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Table structure for table `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) NOT NULL,
  `col_name` varchar(64) NOT NULL,
  `col_type` varchar(64) NOT NULL,
  `col_length` text DEFAULT NULL,
  `col_collation` varchar(64) NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) DEFAULT '',
  `col_default` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Table structure for table `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `column_name` varchar(64) NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `transformation` varchar(255) NOT NULL DEFAULT '',
  `transformation_options` varchar(255) NOT NULL DEFAULT '',
  `input_transformation` varchar(255) NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) NOT NULL,
  `settings_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

-- --------------------------------------------------------

--
-- Table structure for table `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL,
  `export_type` varchar(10) NOT NULL,
  `template_name` varchar(64) NOT NULL,
  `template_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

--
-- Dumping data for table `pma__export_templates`
--

INSERT INTO `pma__export_templates` (`id`, `username`, `export_type`, `template_name`, `template_data`) VALUES
(1, 'root', 'database', 'database', '{\"quick_or_custom\":\"quick\",\"what\":\"sql\",\"structure_or_data_forced\":\"0\",\"table_select[]\":[\"admin\",\"called_numbers\",\"claims\",\"games\",\"ticket_pool\",\"ticket_requests\",\"winners\"],\"table_structure[]\":[\"admin\",\"called_numbers\",\"claims\",\"games\",\"ticket_pool\",\"ticket_requests\",\"winners\"],\"table_data[]\":[\"admin\",\"called_numbers\",\"claims\",\"games\",\"ticket_pool\",\"ticket_requests\",\"winners\"],\"aliases_new\":\"\",\"output_format\":\"sendit\",\"filename_template\":\"@DATABASE@\",\"remember_template\":\"on\",\"charset\":\"utf-8\",\"compression\":\"none\",\"maxsize\":\"\",\"codegen_structure_or_data\":\"data\",\"codegen_format\":\"0\",\"csv_separator\":\",\",\"csv_enclosed\":\"\\\"\",\"csv_escaped\":\"\\\"\",\"csv_terminated\":\"AUTO\",\"csv_null\":\"NULL\",\"csv_columns\":\"something\",\"csv_structure_or_data\":\"data\",\"excel_null\":\"NULL\",\"excel_columns\":\"something\",\"excel_edition\":\"win\",\"excel_structure_or_data\":\"data\",\"json_structure_or_data\":\"data\",\"json_unicode\":\"something\",\"latex_caption\":\"something\",\"latex_structure_or_data\":\"structure_and_data\",\"latex_structure_caption\":\"Structure of table @TABLE@\",\"latex_structure_continued_caption\":\"Structure of table @TABLE@ (continued)\",\"latex_structure_label\":\"tab:@TABLE@-structure\",\"latex_relation\":\"something\",\"latex_comments\":\"something\",\"latex_mime\":\"something\",\"latex_columns\":\"something\",\"latex_data_caption\":\"Content of table @TABLE@\",\"latex_data_continued_caption\":\"Content of table @TABLE@ (continued)\",\"latex_data_label\":\"tab:@TABLE@-data\",\"latex_null\":\"\\\\textit{NULL}\",\"mediawiki_structure_or_data\":\"structure_and_data\",\"mediawiki_caption\":\"something\",\"mediawiki_headers\":\"something\",\"htmlword_structure_or_data\":\"structure_and_data\",\"htmlword_null\":\"NULL\",\"ods_null\":\"NULL\",\"ods_structure_or_data\":\"data\",\"odt_structure_or_data\":\"structure_and_data\",\"odt_relation\":\"something\",\"odt_comments\":\"something\",\"odt_mime\":\"something\",\"odt_columns\":\"something\",\"odt_null\":\"NULL\",\"pdf_report_title\":\"\",\"pdf_structure_or_data\":\"structure_and_data\",\"phparray_structure_or_data\":\"data\",\"sql_include_comments\":\"something\",\"sql_header_comment\":\"\",\"sql_use_transaction\":\"something\",\"sql_compatibility\":\"NONE\",\"sql_structure_or_data\":\"structure_and_data\",\"sql_create_table\":\"something\",\"sql_auto_increment\":\"something\",\"sql_create_view\":\"something\",\"sql_procedure_function\":\"something\",\"sql_create_trigger\":\"something\",\"sql_backquotes\":\"something\",\"sql_type\":\"INSERT\",\"sql_insert_syntax\":\"both\",\"sql_max_query_size\":\"50000\",\"sql_hex_for_binary\":\"something\",\"sql_utc_time\":\"something\",\"texytext_structure_or_data\":\"structure_and_data\",\"texytext_null\":\"NULL\",\"xml_structure_or_data\":\"data\",\"xml_export_events\":\"something\",\"xml_export_functions\":\"something\",\"xml_export_procedures\":\"something\",\"xml_export_tables\":\"something\",\"xml_export_triggers\":\"something\",\"xml_export_views\":\"something\",\"xml_export_contents\":\"something\",\"yaml_structure_or_data\":\"data\",\"\":null,\"lock_tables\":null,\"as_separate_files\":null,\"csv_removeCRLF\":null,\"excel_removeCRLF\":null,\"json_pretty_print\":null,\"htmlword_columns\":null,\"ods_columns\":null,\"sql_dates\":null,\"sql_relation\":null,\"sql_mime\":null,\"sql_disable_fk\":null,\"sql_views_as_tables\":null,\"sql_metadata\":null,\"sql_create_database\":null,\"sql_drop_table\":null,\"sql_if_not_exists\":null,\"sql_simple_view_export\":null,\"sql_view_current_user\":null,\"sql_or_replace_view\":null,\"sql_truncate\":null,\"sql_delayed\":null,\"sql_ignore\":null,\"texytext_columns\":null}'),
(2, 'root', 'server', 'database', '{\"quick_or_custom\":\"quick\",\"what\":\"sql\",\"db_select[]\":[\"phpmyadmin\",\"tambola_game\",\"test\"],\"aliases_new\":\"\",\"output_format\":\"sendit\",\"filename_template\":\"@SERVER@\",\"remember_template\":\"on\",\"charset\":\"utf-8\",\"compression\":\"none\",\"maxsize\":\"\",\"codegen_structure_or_data\":\"data\",\"codegen_format\":\"0\",\"csv_separator\":\",\",\"csv_enclosed\":\"\\\"\",\"csv_escaped\":\"\\\"\",\"csv_terminated\":\"AUTO\",\"csv_null\":\"NULL\",\"csv_columns\":\"something\",\"csv_structure_or_data\":\"data\",\"excel_null\":\"NULL\",\"excel_columns\":\"something\",\"excel_edition\":\"win\",\"excel_structure_or_data\":\"data\",\"json_structure_or_data\":\"data\",\"json_unicode\":\"something\",\"latex_caption\":\"something\",\"latex_structure_or_data\":\"structure_and_data\",\"latex_structure_caption\":\"Structure of table @TABLE@\",\"latex_structure_continued_caption\":\"Structure of table @TABLE@ (continued)\",\"latex_structure_label\":\"tab:@TABLE@-structure\",\"latex_relation\":\"something\",\"latex_comments\":\"something\",\"latex_mime\":\"something\",\"latex_columns\":\"something\",\"latex_data_caption\":\"Content of table @TABLE@\",\"latex_data_continued_caption\":\"Content of table @TABLE@ (continued)\",\"latex_data_label\":\"tab:@TABLE@-data\",\"latex_null\":\"\\\\textit{NULL}\",\"mediawiki_structure_or_data\":\"data\",\"mediawiki_caption\":\"something\",\"mediawiki_headers\":\"something\",\"htmlword_structure_or_data\":\"structure_and_data\",\"htmlword_null\":\"NULL\",\"ods_null\":\"NULL\",\"ods_structure_or_data\":\"data\",\"odt_structure_or_data\":\"structure_and_data\",\"odt_relation\":\"something\",\"odt_comments\":\"something\",\"odt_mime\":\"something\",\"odt_columns\":\"something\",\"odt_null\":\"NULL\",\"pdf_report_title\":\"\",\"pdf_structure_or_data\":\"data\",\"phparray_structure_or_data\":\"data\",\"sql_include_comments\":\"something\",\"sql_header_comment\":\"\",\"sql_use_transaction\":\"something\",\"sql_compatibility\":\"NONE\",\"sql_structure_or_data\":\"structure_and_data\",\"sql_create_table\":\"something\",\"sql_auto_increment\":\"something\",\"sql_create_view\":\"something\",\"sql_create_trigger\":\"something\",\"sql_backquotes\":\"something\",\"sql_type\":\"INSERT\",\"sql_insert_syntax\":\"both\",\"sql_max_query_size\":\"50000\",\"sql_hex_for_binary\":\"something\",\"sql_utc_time\":\"something\",\"texytext_structure_or_data\":\"structure_and_data\",\"texytext_null\":\"NULL\",\"yaml_structure_or_data\":\"data\",\"\":null,\"as_separate_files\":null,\"csv_removeCRLF\":null,\"excel_removeCRLF\":null,\"json_pretty_print\":null,\"htmlword_columns\":null,\"ods_columns\":null,\"sql_dates\":null,\"sql_relation\":null,\"sql_mime\":null,\"sql_disable_fk\":null,\"sql_views_as_tables\":null,\"sql_metadata\":null,\"sql_drop_database\":null,\"sql_drop_table\":null,\"sql_if_not_exists\":null,\"sql_simple_view_export\":null,\"sql_view_current_user\":null,\"sql_or_replace_view\":null,\"sql_procedure_function\":null,\"sql_truncate\":null,\"sql_delayed\":null,\"sql_ignore\":null,\"texytext_columns\":null}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Table structure for table `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db` varchar(64) NOT NULL DEFAULT '',
  `table` varchar(64) NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) NOT NULL,
  `item_name` varchar(64) NOT NULL,
  `item_type` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Table structure for table `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Dumping data for table `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{\"db\":\"tambola_game\",\"table\":\"ticket_pool\"},{\"db\":\"tambola_game\",\"table\":\"games\"},{\"db\":\"tambola_game\",\"table\":\"claims\"},{\"db\":\"tambola_game\",\"table\":\"called_numbers\"},{\"db\":\"tambola_game\",\"table\":\"admin\"},{\"db\":\"tambola_game\",\"table\":\"winners\"},{\"db\":\"tambola_game\",\"table\":\"ticket_requests\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) NOT NULL DEFAULT '',
  `master_table` varchar(64) NOT NULL DEFAULT '',
  `master_field` varchar(64) NOT NULL DEFAULT '',
  `foreign_db` varchar(64) NOT NULL DEFAULT '',
  `foreign_table` varchar(64) NOT NULL DEFAULT '',
  `foreign_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Table structure for table `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `search_name` varchar(64) NOT NULL DEFAULT '',
  `search_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float UNSIGNED NOT NULL DEFAULT 0,
  `y` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `display_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `prefs` text NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

-- --------------------------------------------------------

--
-- Table structure for table `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text NOT NULL,
  `schema_sql` text DEFAULT NULL,
  `data_sql` longtext DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Dumping data for table `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2025-08-10 17:07:59', '{\"Console\\/Mode\":\"collapse\"}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) NOT NULL,
  `tab` varchar(64) NOT NULL,
  `allowed` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Table structure for table `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) NOT NULL,
  `usergroup` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indexes for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indexes for table `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Indexes for table `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indexes for table `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indexes for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indexes for table `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indexes for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indexes for table `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indexes for table `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indexes for table `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indexes for table `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indexes for table `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indexes for table `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Database: `tambola_game`
--
CREATE DATABASE IF NOT EXISTS `tambola_game` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `tambola_game`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` enum('admin','agent') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password_hash`, `role`) VALUES
(1, 'admin', '$2y$10$f149BLBnoTGOQEMlVANcTuln/F9Uc3Xn1B48FL2ufmXg7M7a6Pktu', 'admin'),
(4, 'agent', '$2y$10$DL9or2BYVIYOOWK4BNMLUehhEEvVPRGpQbZbzywN1IfuHJt8ERzlC', 'agent');

-- --------------------------------------------------------

--
-- Table structure for table `called_numbers`
--

CREATE TABLE `called_numbers` (
  `id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `number_called` int(11) NOT NULL,
  `called_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `claims`
--

CREATE TABLE `claims` (
  `claim_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `player_session` varchar(100) NOT NULL,
  `claim_type` varchar(50) NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `game_id` int(11) NOT NULL,
  `game_name` varchar(100) NOT NULL,
  `status` enum('waiting','selecting','running','finished') DEFAULT 'waiting',
  `start_time` datetime DEFAULT current_timestamp(),
  `prizes` text DEFAULT NULL,
  `called_numbers` text DEFAULT '[]'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`game_id`, `game_name`, `status`, `start_time`, `prizes`, `called_numbers`) VALUES
(20, 'test', 'finished', '2025-08-10 16:29:00', 'Early Five', '[]'),
(21, 'TEst', 'finished', '2025-08-10 18:26:00', 'Early Five', '[]'),
(22, 'test', 'finished', '2025-08-10 18:28:00', 'Bottom Line', '[]'),
(23, 'test', 'finished', '2025-08-10 18:45:00', 'Early Five', '[]'),
(24, 'Alex', 'finished', '2025-08-10 18:42:00', 'Full House', '[]'),
(25, 'gamw', 'finished', '2025-08-10 19:41:00', 'Bottom Line', '[]');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_pool`
--

CREATE TABLE `ticket_pool` (
  `id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `ticket_data` text NOT NULL,
  `assigned_to` varchar(100) DEFAULT NULL,
  `assigned_name` varchar(100) DEFAULT NULL,
  `ticket_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticket_pool`
--

INSERT INTO `ticket_pool` (`id`, `game_id`, `ticket_data`, `assigned_to`, `assigned_name`, `ticket_no`) VALUES
(233, 20, '[[null,17,24,35,null,null,null,76,85],[1,16,null,null,49,null,68,null,83],[null,11,null,39,null,53,61,79,null]]', NULL, NULL, 1),
(234, 20, '[[null,null,27,33,null,56,64,75,null],[10,11,null,37,47,57,null,null,null],[7,null,null,31,45,null,61,null,83]]', 'lgaj6g3bev96kcr5lvkvm6d4qo', 'admin', 2),
(235, 20, '[[null,19,null,39,43,58,66,null,null],[null,20,25,32,null,null,62,null,83],[7,11,null,38,null,null,null,75,90]]', NULL, NULL, 3),
(236, 20, '[[null,16,23,35,null,null,null,71,87],[6,null,27,39,null,58,66,null,null],[2,11,21,null,46,null,65,null,null]]', NULL, NULL, 4),
(237, 20, '[[null,12,22,null,46,null,66,71,null],[1,14,null,37,44,null,69,null,null],[null,11,null,39,null,60,null,74,83]]', NULL, NULL, 5),
(238, 20, '[[5,17,24,33,47,null,null,null,null],[null,null,null,null,44,52,66,76,84],[null,14,null,39,48,null,null,78,83]]', NULL, NULL, 6),
(239, 20, '[[null,null,null,31,45,55,null,79,87],[8,12,23,null,46,null,null,71,null],[6,18,25,33,null,null,68,null,null]]', NULL, NULL, 7),
(240, 20, '[[5,14,23,31,null,59,null,null,null],[null,20,null,38,47,null,null,76,88],[8,15,null,null,49,null,66,72,null]]', NULL, NULL, 8),
(241, 20, '[[10,15,null,null,50,53,67,null,null],[6,null,null,34,null,null,66,72,86],[5,null,27,null,48,null,null,74,87]]', NULL, NULL, 9),
(242, 20, '[[8,20,24,null,42,51,null,null,null],[4,null,null,null,50,null,66,78,85],[3,null,null,38,null,60,70,79,null]]', NULL, NULL, 10),
(243, 20, '[[3,12,null,34,48,54,null,null,null],[null,null,25,null,null,52,61,73,82],[null,17,null,null,42,null,64,74,84]]', NULL, NULL, 11),
(244, 20, '[[2,13,null,35,41,null,null,null,83],[null,18,22,null,43,51,null,77,null],[9,null,24,40,44,null,61,null,null]]', NULL, NULL, 12),
(245, 20, '[[9,null,21,null,49,null,null,80,84],[null,20,null,39,47,55,69,null,null],[null,15,null,34,41,null,68,71,null]]', NULL, NULL, 13),
(246, 20, '[[null,null,22,31,48,59,63,null,null],[9,17,null,null,43,null,69,77,null],[null,16,24,null,null,58,null,76,85]]', NULL, NULL, 14),
(247, 20, '[[4,18,22,35,null,null,69,null,null],[null,null,null,36,42,58,null,79,89],[10,19,null,null,41,null,67,71,null]]', NULL, NULL, 15),
(248, 20, '[[null,null,25,33,null,null,69,80,83],[4,16,24,32,null,null,62,null,null],[null,18,30,null,41,58,68,null,null]]', NULL, NULL, 16),
(249, 20, '[[8,null,25,null,45,null,64,77,null],[null,null,24,36,null,57,null,71,88],[1,15,null,39,42,55,null,null,null]]', NULL, NULL, 17),
(250, 20, '[[null,17,22,35,47,58,null,null,null],[9,null,null,null,null,59,67,79,86],[4,null,null,36,null,51,65,75,null]]', NULL, NULL, 18),
(251, 20, '[[5,null,null,32,null,57,67,null,87],[2,null,27,null,null,54,null,73,82],[8,12,null,null,42,52,64,null,null]]', NULL, NULL, 19),
(252, 20, '[[null,18,25,37,null,59,69,null,null],[9,null,null,31,42,60,null,78,null],[1,13,22,null,null,null,null,77,81]]', NULL, NULL, 20),
(253, 21, '[[8,17,null,34,49,null,63,null,null],[null,null,25,null,null,58,62,77,87],[6,12,29,null,null,null,70,71,null]]', NULL, NULL, 1),
(254, 21, '[[7,null,23,null,47,55,69,null,null],[null,null,null,37,50,null,70,75,85],[2,20,26,40,null,null,null,80,null]]', NULL, NULL, 2),
(255, 21, '[[null,null,null,40,null,54,68,72,88],[6,18,null,37,45,55,null,null,null],[null,null,30,36,null,null,69,73,82]]', NULL, NULL, 3),
(256, 21, '[[9,null,27,null,null,60,62,79,null],[3,16,22,38,43,null,null,null,null],[5,null,21,null,41,null,null,73,81]]', NULL, NULL, 4),
(257, 21, '[[9,null,null,null,null,60,66,80,83],[null,11,23,38,49,58,null,null,null],[null,null,null,31,44,55,70,74,null]]', NULL, NULL, 5),
(258, 22, '[[null,11,null,31,null,null,66,77,86],[5,14,null,32,43,52,null,null,null],[null,16,24,38,null,null,64,75,null]]', 'Alex', 'Alex', 1),
(259, 22, '[[null,16,null,null,null,59,64,75,85],[2,18,23,33,null,null,null,72,null],[null,11,25,null,41,null,null,74,81]]', 'Alex', 'Alex', 2),
(260, 22, '[[null,19,22,34,42,52,null,null,null],[1,null,null,31,44,null,null,78,87],[6,null,null,37,null,null,70,71,81]]', NULL, NULL, 3),
(261, 22, '[[3,15,30,39,43,null,null,null,null],[9,null,24,null,null,null,69,78,82],[8,null,21,33,42,52,null,null,null]]', NULL, NULL, 4),
(262, 22, '[[3,11,null,null,null,55,67,78,null],[null,15,null,33,49,null,63,null,81],[9,16,21,40,42,null,null,null,null]]', NULL, NULL, 5),
(263, 22, '[[3,null,27,35,49,55,null,null,null],[9,null,null,36,null,null,65,79,85],[null,15,null,33,45,56,61,null,null]]', NULL, NULL, 6),
(264, 22, '[[10,20,null,null,48,null,63,null,85],[8,null,22,null,null,56,70,78,null],[1,null,null,40,43,null,62,null,87]]', NULL, NULL, 7),
(265, 22, '[[3,18,26,34,41,null,null,null,null],[4,17,null,null,46,null,61,null,86],[9,null,null,35,45,58,null,74,null]]', NULL, NULL, 8),
(266, 22, '[[null,null,27,37,null,58,null,76,86],[null,20,25,null,42,51,null,78,null],[9,17,null,32,null,53,64,null,null]]', NULL, NULL, 9),
(267, 22, '[[null,null,23,31,null,57,66,null,82],[2,16,null,38,41,51,null,null,null],[null,null,29,35,null,60,null,80,83]]', NULL, NULL, 10),
(268, 22, '[[null,null,null,39,49,55,null,80,81],[null,null,30,31,null,56,63,71,null],[5,12,24,null,43,60,null,null,null]]', NULL, NULL, 11),
(269, 22, '[[2,null,26,40,null,52,70,null,null],[null,null,29,null,44,58,61,null,82],[null,18,null,null,null,57,64,74,87]]', NULL, NULL, 12),
(270, 22, '[[4,20,22,null,null,null,null,77,83],[2,null,null,32,46,51,null,79,null],[10,13,30,null,null,52,70,null,null]]', NULL, NULL, 13),
(271, 22, '[[7,null,25,39,null,null,63,79,null],[null,16,null,34,44,null,null,74,85],[null,null,27,35,47,55,65,null,null]]', NULL, NULL, 14),
(272, 22, '[[7,17,30,31,null,54,null,null,null],[10,null,null,null,41,null,67,71,88],[null,11,24,null,47,null,null,76,85]]', NULL, NULL, 15),
(273, 22, '[[7,16,27,null,41,51,null,null,null],[5,20,null,31,44,null,null,71,null],[3,null,null,null,47,null,61,80,83]]', NULL, NULL, 16),
(274, 22, '[[4,14,26,null,47,51,null,null,null],[10,null,25,36,null,null,62,73,null],[null,13,22,null,null,57,null,80,81]]', NULL, NULL, 17),
(275, 22, '[[10,15,24,null,46,null,65,null,null],[9,18,null,null,48,null,61,null,82],[5,null,null,39,null,51,70,72,null]]', NULL, NULL, 18),
(276, 22, '[[5,15,22,null,48,null,null,77,null],[null,null,27,31,null,58,61,null,82],[7,null,null,37,null,60,70,73,null]]', NULL, NULL, 19),
(277, 22, '[[null,20,null,36,null,null,62,79,86],[9,17,26,null,48,58,null,null,null],[null,13,29,33,null,60,null,75,null]]', NULL, NULL, 20),
(278, 22, '[[6,19,null,null,41,51,null,null,88],[5,null,22,39,null,57,69,null,null],[10,15,25,32,null,null,null,78,null]]', NULL, NULL, 21),
(279, 22, '[[10,null,30,null,42,59,null,77,null],[null,null,22,null,44,null,61,73,83],[8,20,28,31,46,null,null,null,null]]', NULL, NULL, 22),
(280, 22, '[[null,12,25,31,null,60,63,null,null],[8,16,null,null,null,null,65,77,85],[5,19,23,null,41,null,null,72,null]]', NULL, NULL, 23),
(281, 22, '[[9,null,21,32,49,59,null,null,null],[null,null,null,37,48,51,null,80,89],[8,16,null,null,null,55,64,71,null]]', NULL, NULL, 24),
(282, 22, '[[10,19,21,35,47,null,null,null,null],[null,12,null,null,null,55,61,78,82],[4,14,25,34,48,null,null,null,null]]', NULL, NULL, 25),
(283, 22, '[[null,null,null,34,42,59,61,77,null],[null,15,null,40,44,55,69,null,null],[5,null,30,36,null,null,67,null,86]]', NULL, NULL, 26),
(284, 22, '[[null,12,25,38,null,null,69,75,null],[3,null,24,null,49,null,62,null,85],[null,20,null,null,47,60,64,78,null]]', NULL, NULL, 27),
(285, 22, '[[null,null,21,null,null,56,69,71,88],[null,15,null,null,47,60,67,74,null],[4,null,22,37,41,null,null,73,null]]', NULL, NULL, 28),
(286, 22, '[[1,11,null,null,45,57,70,null,null],[null,18,25,null,null,null,62,79,89],[7,16,null,35,null,null,67,71,null]]', NULL, NULL, 29),
(287, 22, '[[9,18,null,36,null,60,null,80,null],[null,14,26,null,47,null,64,null,84],[null,13,21,null,null,null,70,76,83]]', NULL, NULL, 30),
(288, 22, '[[null,13,27,null,45,null,null,76,87],[null,null,29,31,41,null,68,77,null],[3,19,23,null,49,60,null,null,null]]', NULL, NULL, 31),
(289, 22, '[[null,16,21,null,43,53,null,77,null],[3,null,null,34,null,null,64,80,87],[8,null,22,35,49,null,69,null,null]]', NULL, NULL, 32),
(290, 22, '[[1,null,23,null,null,null,61,79,86],[2,18,21,40,null,null,70,null,null],[null,null,28,null,43,60,null,77,89]]', NULL, NULL, 33),
(291, 22, '[[null,20,23,null,41,55,67,null,null],[7,null,29,37,null,null,68,null,83],[5,null,null,36,47,59,null,77,null]]', NULL, NULL, 34),
(292, 22, '[[7,18,21,null,45,60,null,null,null],[6,12,null,34,44,null,null,72,null],[8,16,30,null,null,null,67,null,88]]', NULL, NULL, 35),
(293, 22, '[[4,11,null,36,41,52,null,null,null],[null,15,27,null,46,56,66,null,null],[null,12,null,34,48,null,null,78,84]]', NULL, NULL, 36),
(294, 22, '[[null,16,29,null,null,52,61,73,null],[9,17,28,37,45,null,null,null,null],[null,null,null,38,null,54,69,75,84]]', NULL, NULL, 37),
(295, 22, '[[10,19,null,37,null,null,68,74,null],[6,null,21,31,null,56,63,null,null],[null,17,null,34,42,null,null,79,88]]', NULL, NULL, 38),
(296, 22, '[[8,20,null,39,null,null,67,79,null],[10,null,24,null,null,56,66,null,88],[5,null,27,35,42,null,null,null,89]]', NULL, NULL, 39),
(297, 22, '[[2,null,24,35,44,null,66,null,null],[null,null,28,null,null,58,61,77,84],[1,15,22,33,null,null,null,null,88]]', NULL, NULL, 40),
(298, 22, '[[null,17,25,null,null,null,62,77,83],[3,14,null,null,null,60,null,76,87],[1,15,null,40,45,51,null,null,null]]', NULL, NULL, 41),
(299, 22, '[[8,null,24,null,null,56,69,null,81],[1,17,27,36,45,null,null,null,null],[null,null,null,34,null,60,67,72,90]]', NULL, NULL, 42),
(300, 22, '[[null,12,null,null,42,57,70,74,null],[9,19,21,34,47,null,null,null,null],[null,14,null,33,41,56,null,null,81]]', NULL, NULL, 43),
(301, 22, '[[7,19,21,null,null,51,null,73,null],[null,12,null,39,45,null,null,77,87],[4,15,null,null,null,null,61,78,83]]', NULL, NULL, 44),
(302, 22, '[[null,19,24,33,null,null,64,75,null],[9,null,26,null,null,57,null,74,81],[2,null,30,null,45,null,68,71,null]]', NULL, NULL, 45),
(303, 22, '[[4,17,null,34,48,59,null,null,null],[8,null,23,null,null,58,67,null,90],[5,13,null,null,43,null,62,73,null]]', NULL, NULL, 46),
(304, 22, '[[5,20,27,31,null,null,62,null,null],[null,null,null,34,41,null,69,73,81],[1,14,null,null,50,59,63,null,null]]', NULL, NULL, 47),
(305, 22, '[[null,null,22,null,49,51,69,null,88],[null,11,24,32,42,52,null,null,null],[5,null,null,null,44,null,63,72,86]]', NULL, NULL, 48),
(306, 22, '[[1,null,null,36,41,null,61,79,null],[9,null,null,null,49,56,68,null,88],[null,13,29,null,44,52,69,null,null]]', NULL, NULL, 49),
(307, 22, '[[5,null,21,null,49,null,68,74,null],[null,14,null,null,48,60,61,null,83],[10,null,25,35,46,null,67,null,null]]', NULL, NULL, 50),
(308, 22, '[[7,null,null,37,41,null,62,null,89],[null,null,null,36,50,55,null,79,86],[6,13,28,null,48,52,null,null,null]]', NULL, NULL, 51),
(309, 22, '[[null,null,null,null,49,52,62,76,89],[null,null,29,null,50,null,70,79,87],[6,14,24,33,47,null,null,null,null]]', NULL, NULL, 52),
(310, 22, '[[10,null,null,null,45,51,70,75,null],[null,18,21,40,null,55,65,null,null],[null,14,null,36,null,53,null,71,81]]', NULL, NULL, 53),
(311, 22, '[[10,null,null,null,null,53,61,74,82],[null,20,null,32,42,51,67,null,null],[null,17,23,null,null,57,null,71,87]]', NULL, NULL, 54),
(312, 22, '[[null,null,null,34,50,null,64,74,90],[5,20,null,35,47,null,69,null,null],[7,null,28,40,41,57,null,null,null]]', NULL, NULL, 55),
(313, 22, '[[10,15,null,36,44,null,63,null,null],[null,null,22,32,47,54,64,null,null],[6,null,null,38,null,59,null,80,89]]', NULL, NULL, 56),
(314, 22, '[[8,null,null,null,46,59,61,null,81],[10,null,21,34,44,null,null,73,null],[6,17,null,32,null,51,65,null,null]]', NULL, NULL, 57),
(315, 22, '[[1,15,29,null,null,null,null,80,85],[8,null,27,37,null,55,62,null,null],[2,13,30,null,47,null,null,null,84]]', NULL, NULL, 58),
(316, 22, '[[5,null,null,32,42,59,null,74,null],[null,20,null,33,43,51,67,null,null],[null,null,27,null,48,null,69,75,81]]', NULL, NULL, 59),
(317, 22, '[[4,null,26,39,null,53,61,null,null],[null,null,null,null,43,55,70,78,88],[null,20,21,null,48,59,66,null,null]]', NULL, NULL, 60),
(318, 22, '[[1,11,null,34,48,null,null,77,null],[null,null,null,32,null,60,69,78,81],[8,16,25,40,null,null,64,null,null]]', NULL, NULL, 61),
(319, 22, '[[null,14,24,39,41,59,null,null,null],[null,11,null,40,42,null,null,71,82],[3,19,null,31,43,null,65,null,null]]', NULL, NULL, 62),
(320, 22, '[[8,null,26,32,null,56,null,null,85],[null,null,null,40,50,52,63,78,null],[null,19,27,35,46,null,68,null,null]]', NULL, NULL, 63),
(321, 22, '[[null,null,null,null,49,51,61,77,81],[9,18,22,34,null,null,65,null,null],[null,null,26,37,41,60,63,null,null]]', NULL, NULL, 64),
(322, 22, '[[null,15,null,35,47,null,64,null,81],[null,17,28,33,null,null,null,74,85],[5,null,null,39,null,58,70,73,null]]', NULL, NULL, 65),
(323, 22, '[[null,16,28,38,48,null,null,71,null],[null,13,null,null,46,58,null,80,85],[9,null,26,31,null,52,67,null,null]]', NULL, NULL, 66),
(324, 22, '[[9,20,null,null,null,57,64,75,null],[null,16,21,null,46,null,null,71,83],[5,null,27,32,48,null,63,null,null]]', NULL, NULL, 67),
(325, 22, '[[3,14,null,null,45,53,65,null,null],[null,null,28,null,46,59,null,71,90],[null,null,24,40,50,51,null,76,null]]', NULL, NULL, 68),
(326, 22, '[[5,17,null,34,42,null,null,null,84],[null,null,26,null,null,53,62,76,85],[3,12,23,39,48,null,null,null,null]]', NULL, NULL, 69),
(327, 22, '[[1,11,26,null,null,55,null,71,null],[3,12,23,null,null,null,61,null,88],[null,17,30,39,45,54,null,null,null]]', NULL, NULL, 70),
(328, 22, '[[7,19,29,35,46,null,null,null,null],[8,13,21,40,null,54,null,null,null],[null,11,28,null,null,null,65,74,83]]', NULL, NULL, 71),
(329, 22, '[[4,15,29,null,null,null,70,72,null],[5,11,21,null,null,null,null,71,84],[null,16,28,32,41,57,null,null,null]]', NULL, NULL, 72),
(330, 22, '[[3,null,25,null,48,null,68,null,86],[10,13,21,null,49,null,null,74,null],[null,null,null,34,46,52,null,71,90]]', NULL, NULL, 73),
(331, 22, '[[null,15,null,38,null,null,70,71,86],[null,17,30,37,42,54,null,null,null],[9,19,null,null,47,null,null,78,85]]', NULL, NULL, 74),
(332, 22, '[[8,16,null,36,49,null,64,null,null],[2,15,null,37,42,55,null,null,null],[10,null,30,null,null,52,null,72,86]]', NULL, NULL, 75),
(333, 22, '[[9,20,null,null,44,55,null,null,84],[null,12,21,35,null,54,62,null,null],[10,16,null,37,null,59,null,77,null]]', NULL, NULL, 76),
(334, 22, '[[4,null,null,32,43,null,64,null,81],[null,16,25,40,41,null,null,null,87],[6,null,26,null,48,57,null,74,null]]', NULL, NULL, 77),
(335, 22, '[[9,null,null,null,null,57,64,74,87],[8,17,null,39,44,60,null,null,null],[null,null,21,null,null,52,61,75,85]]', NULL, NULL, 78),
(336, 22, '[[5,16,29,null,null,58,61,null,null],[4,null,22,null,48,60,64,null,null],[null,null,24,35,50,null,null,76,83]]', NULL, NULL, 79),
(337, 22, '[[null,13,25,36,46,53,null,null,null],[null,12,22,null,43,51,61,null,null],[3,null,24,null,49,null,null,80,87]]', NULL, NULL, 80),
(338, 22, '[[null,15,null,31,null,null,62,71,90],[5,12,25,37,null,null,64,null,null],[null,18,null,35,48,60,66,null,null]]', NULL, NULL, 81),
(339, 22, '[[null,19,27,39,null,51,65,null,null],[1,20,24,null,43,57,null,null,null],[null,null,null,37,50,null,63,73,81]]', NULL, NULL, 82),
(340, 22, '[[null,null,21,null,46,60,63,71,null],[1,null,null,33,49,54,null,null,83],[2,11,28,38,48,null,null,null,null]]', NULL, NULL, 83),
(341, 22, '[[5,18,26,40,45,null,null,null,null],[null,null,24,null,49,55,62,null,85],[null,14,null,32,44,51,null,72,null]]', NULL, NULL, 84),
(342, 22, '[[7,13,29,null,44,51,null,null,null],[null,16,22,32,null,53,null,75,null],[null,null,null,null,42,56,64,79,82]]', NULL, NULL, 85),
(343, 22, '[[null,null,27,32,null,57,67,null,87],[1,13,null,null,43,null,65,null,89],[null,15,null,38,50,null,63,75,null]]', NULL, NULL, 86),
(344, 22, '[[null,15,null,null,null,60,62,71,82],[null,18,28,35,46,52,null,null,null],[2,null,22,null,48,null,64,null,86]]', NULL, NULL, 87),
(345, 22, '[[3,16,21,35,null,null,64,null,null],[7,null,null,34,45,54,null,72,null],[1,null,26,null,null,51,69,null,87]]', NULL, NULL, 88),
(346, 22, '[[null,15,23,36,44,51,null,null,null],[3,null,28,null,null,null,61,73,88],[6,null,29,null,null,55,62,76,null]]', NULL, NULL, 89),
(347, 22, '[[null,17,null,34,48,53,68,null,null],[7,15,null,null,null,59,67,null,83],[2,null,22,37,null,58,null,72,null]]', NULL, NULL, 90),
(348, 22, '[[null,null,28,38,41,60,null,null,83],[null,18,null,34,null,58,64,71,null],[4,12,26,null,44,null,65,null,null]]', NULL, NULL, 91),
(349, 22, '[[null,15,27,36,null,null,null,73,83],[8,13,30,null,49,null,65,null,null],[5,12,null,null,47,56,66,null,null]]', NULL, NULL, 92),
(350, 22, '[[null,20,26,null,47,53,null,78,null],[3,19,null,31,null,59,null,null,87],[10,17,23,null,null,null,65,null,84]]', NULL, NULL, 93),
(351, 22, '[[4,17,null,null,null,54,null,72,84],[8,11,null,null,41,58,68,null,null],[null,null,25,36,45,55,63,null,null]]', NULL, NULL, 94),
(352, 22, '[[null,13,25,31,null,53,62,null,null],[null,null,null,39,null,59,61,80,83],[5,11,26,null,45,58,null,null,null]]', NULL, NULL, 95),
(353, 22, '[[3,17,25,36,null,null,69,null,null],[null,null,null,37,47,51,null,72,86],[8,null,29,35,null,59,null,71,null]]', NULL, NULL, 96),
(354, 22, '[[null,null,22,null,null,57,63,73,87],[null,null,24,33,null,null,70,74,89],[10,17,28,32,42,null,null,null,null]]', NULL, NULL, 97),
(355, 22, '[[null,11,null,32,null,54,70,null,89],[null,17,null,39,49,null,66,78,null],[3,16,21,null,46,null,63,null,null]]', NULL, NULL, 98),
(356, 22, '[[3,16,21,34,null,52,null,null,null],[5,null,null,null,41,59,65,null,87],[7,14,null,36,null,51,null,79,null]]', NULL, NULL, 99),
(357, 22, '[[7,12,null,null,45,52,68,null,null],[null,null,null,null,41,54,62,73,82],[null,11,22,34,null,56,null,71,null]]', NULL, NULL, 100),
(358, 22, '[[2,null,null,39,null,59,68,77,null],[null,null,30,null,null,53,69,76,87],[10,16,28,null,43,52,null,null,null]]', NULL, NULL, 101),
(359, 22, '[[8,14,null,32,41,null,70,null,null],[null,null,23,39,null,null,63,80,89],[2,17,null,null,48,53,null,73,null]]', NULL, NULL, 102),
(360, 22, '[[null,15,28,null,46,null,63,78,null],[null,null,30,null,49,57,68,76,null],[5,null,25,35,45,null,null,null,90]]', NULL, NULL, 103),
(361, 22, '[[null,15,22,37,45,57,null,null,null],[null,16,null,34,null,58,62,76,null],[4,null,null,36,null,54,69,null,88]]', NULL, NULL, 104),
(362, 22, '[[null,null,23,32,null,54,70,null,81],[null,14,null,null,null,53,63,77,89],[2,15,26,35,44,null,null,null,null]]', NULL, NULL, 105),
(363, 22, '[[null,12,23,31,null,null,63,null,84],[null,17,22,null,null,null,62,71,83],[7,null,21,null,45,52,70,null,null]]', NULL, NULL, 106),
(364, 22, '[[null,20,24,null,41,null,64,null,85],[null,19,null,null,43,60,62,null,88],[5,null,null,34,50,null,67,80,null]]', NULL, NULL, 107),
(365, 22, '[[9,19,21,34,42,null,null,null,null],[null,null,25,null,null,54,70,71,84],[null,null,23,null,49,57,null,75,87]]', NULL, NULL, 108),
(366, 22, '[[3,null,30,38,43,60,null,null,null],[null,null,null,39,null,56,62,80,81],[2,17,26,34,49,null,null,null,null]]', NULL, NULL, 109),
(367, 22, '[[null,19,24,31,null,null,null,75,85],[2,18,null,34,null,60,null,71,null],[null,15,23,40,41,null,69,null,null]]', NULL, NULL, 110),
(368, 22, '[[2,17,30,null,null,null,null,76,86],[3,null,27,35,41,null,null,null,81],[null,13,22,null,null,60,61,78,null]]', NULL, NULL, 111),
(369, 22, '[[null,11,22,null,48,59,68,null,null],[null,15,26,35,null,null,null,77,86],[9,17,28,33,41,null,null,null,null]]', NULL, NULL, 112),
(370, 22, '[[5,null,28,null,46,null,64,null,90],[null,13,27,33,43,51,null,null,null],[null,15,null,32,49,55,null,72,null]]', NULL, NULL, 113),
(371, 22, '[[null,18,23,null,46,60,66,null,null],[3,null,null,null,null,58,62,78,86],[8,null,null,39,42,59,63,null,null]]', NULL, NULL, 114),
(372, 22, '[[null,null,21,null,47,55,null,76,84],[8,null,28,40,42,52,null,null,null],[null,17,null,33,null,null,69,79,81]]', NULL, NULL, 115),
(373, 22, '[[5,null,30,31,48,null,68,null,null],[null,null,null,null,46,52,62,74,87],[9,14,null,34,null,59,67,null,null]]', NULL, NULL, 116),
(374, 22, '[[5,14,25,38,null,null,65,null,null],[null,16,29,null,41,58,61,null,null],[null,null,26,null,null,52,69,75,85]]', NULL, NULL, 117),
(375, 22, '[[4,12,null,36,null,57,null,null,85],[5,null,28,null,null,null,64,77,83],[1,null,null,null,43,null,62,78,87]]', NULL, NULL, 118),
(376, 22, '[[null,15,29,36,null,60,65,null,null],[3,11,null,null,44,58,62,null,null],[null,12,null,31,null,57,null,75,90]]', NULL, NULL, 119),
(377, 22, '[[null,11,21,34,null,null,68,79,null],[10,20,24,33,49,null,null,null,null],[4,null,null,40,null,51,62,null,82]]', NULL, NULL, 120),
(378, 22, '[[null,19,null,34,50,null,64,null,85],[3,null,28,null,null,52,63,null,86],[null,12,null,40,null,58,66,74,null]]', NULL, NULL, 121),
(379, 22, '[[null,null,28,32,50,59,null,80,null],[1,null,27,null,43,53,null,null,87],[null,17,21,36,47,null,63,null,null]]', NULL, NULL, 122),
(380, 22, '[[5,14,null,null,43,59,66,null,null],[null,13,24,null,49,null,67,72,null],[7,null,null,40,null,58,70,null,81]]', NULL, NULL, 123),
(381, 22, '[[5,null,30,null,null,null,66,78,84],[2,12,26,33,null,55,null,null,null],[null,null,null,40,45,null,65,71,81]]', NULL, NULL, 124),
(382, 22, '[[9,null,25,null,42,60,null,75,null],[3,null,27,31,47,null,null,null,90],[null,15,null,34,41,54,62,null,null]]', NULL, NULL, 125),
(383, 22, '[[null,null,29,37,null,55,70,null,83],[null,20,28,null,44,51,null,72,null],[3,13,null,32,null,56,63,null,null]]', NULL, NULL, 126),
(384, 22, '[[4,null,null,null,48,null,61,80,82],[9,18,25,33,45,null,null,null,null],[7,null,null,null,42,59,null,71,81]]', NULL, NULL, 127),
(385, 22, '[[null,null,29,null,42,52,68,null,84],[1,15,null,36,null,null,66,74,null],[null,19,28,32,45,56,null,null,null]]', NULL, NULL, 128),
(386, 22, '[[8,null,null,32,47,null,null,79,85],[3,null,27,34,48,56,null,null,null],[null,16,null,40,42,null,69,73,null]]', NULL, NULL, 129),
(387, 22, '[[null,15,27,null,null,56,65,null,84],[null,12,null,34,46,null,67,null,81],[8,14,null,null,null,55,63,71,null]]', NULL, NULL, 130),
(388, 22, '[[5,14,null,null,null,52,null,77,90],[9,19,null,31,41,null,70,null,null],[null,17,24,null,47,57,62,null,null]]', NULL, NULL, 131),
(389, 22, '[[5,null,27,38,43,58,null,null,null],[3,null,null,37,45,null,65,null,84],[null,15,null,35,null,null,63,75,87]]', NULL, NULL, 132),
(390, 22, '[[8,14,null,null,45,null,null,80,88],[10,11,null,35,null,null,70,null,83],[6,null,23,36,null,58,66,null,null]]', NULL, NULL, 133),
(391, 22, '[[1,null,null,31,43,60,null,74,null],[5,12,null,null,null,59,63,null,85],[null,20,29,null,44,58,null,null,81]]', NULL, NULL, 134),
(392, 22, '[[9,11,null,36,null,null,null,72,84],[null,15,21,null,null,57,null,80,88],[5,null,null,35,48,null,68,74,null]]', NULL, NULL, 135),
(393, 22, '[[null,null,26,38,null,59,61,74,null],[4,null,null,32,47,null,64,null,81],[null,15,28,37,null,58,null,73,null]]', NULL, NULL, 136),
(394, 22, '[[null,13,null,null,null,54,66,78,87],[3,18,24,null,null,57,62,null,null],[null,19,22,31,41,59,null,null,null]]', NULL, NULL, 137),
(395, 22, '[[5,19,30,null,49,54,null,null,null],[6,20,null,35,null,55,61,null,null],[null,11,null,null,null,56,65,74,90]]', NULL, NULL, 138),
(396, 22, '[[9,null,null,39,50,55,68,null,null],[4,20,22,null,null,59,69,null,null],[null,15,30,null,null,51,null,71,85]]', NULL, NULL, 139),
(397, 22, '[[1,11,null,null,45,53,67,null,null],[6,19,21,null,43,null,null,71,null],[2,null,null,34,null,59,null,73,90]]', NULL, NULL, 140),
(398, 22, '[[null,16,null,null,45,null,66,80,84],[null,18,30,null,48,53,65,null,null],[8,null,29,31,46,55,null,null,null]]', NULL, NULL, 141),
(399, 22, '[[3,null,null,32,44,null,63,72,null],[1,13,25,null,null,52,null,77,null],[null,16,null,39,45,null,68,null,86]]', NULL, NULL, 142),
(400, 22, '[[null,11,24,null,46,null,null,76,89],[4,16,null,36,44,null,69,null,null],[null,null,null,39,43,58,64,74,null]]', NULL, NULL, 143),
(401, 22, '[[1,null,null,35,46,null,67,null,82],[6,null,null,31,null,60,null,71,87],[null,17,27,33,null,54,null,76,null]]', NULL, NULL, 144),
(402, 22, '[[3,20,24,39,42,null,null,null,null],[null,null,null,38,null,54,69,72,89],[null,18,28,31,null,null,null,75,90]]', NULL, NULL, 145),
(403, 22, '[[1,null,null,35,null,53,66,null,88],[null,20,22,null,null,58,61,null,82],[null,null,null,36,42,null,70,74,85]]', NULL, NULL, 146),
(404, 22, '[[5,null,null,33,null,59,69,76,null],[null,18,24,37,46,null,null,73,null],[null,null,25,38,null,51,66,null,86]]', NULL, NULL, 147),
(405, 22, '[[1,12,null,null,null,null,68,77,88],[null,16,30,null,45,51,null,75,null],[null,17,24,37,null,null,61,null,90]]', NULL, NULL, 148),
(406, 22, '[[7,12,23,null,50,null,61,null,null],[1,null,28,null,43,null,null,76,83],[4,null,null,37,null,55,null,72,86]]', NULL, NULL, 149),
(407, 22, '[[5,19,null,31,null,54,null,null,81],[null,null,23,38,47,59,null,74,null],[null,17,null,null,null,51,64,72,85]]', NULL, NULL, 150),
(408, 22, '[[null,20,25,null,42,59,63,null,null],[4,null,27,null,45,null,67,74,null],[8,null,null,37,41,null,null,72,90]]', NULL, NULL, 151),
(409, 22, '[[8,13,null,35,46,null,68,null,null],[3,11,27,null,44,52,null,null,null],[4,null,21,null,null,null,62,79,81]]', NULL, NULL, 152),
(410, 22, '[[null,11,23,null,null,53,68,76,null],[10,18,27,null,47,null,null,null,81],[null,12,30,40,null,null,61,79,null]]', NULL, NULL, 153),
(411, 22, '[[4,14,null,33,null,53,null,71,null],[null,19,21,null,null,57,null,78,81],[6,null,28,32,45,null,63,null,null]]', NULL, NULL, 154),
(412, 22, '[[null,null,29,null,41,51,63,null,83],[8,null,null,null,46,56,65,79,null],[6,15,27,34,48,null,null,null,null]]', NULL, NULL, 155),
(413, 23, '[[null,15,23,34,41,54,null,null,null],[5,null,28,null,null,null,64,76,88],[10,null,null,null,null,52,67,74,83]]', NULL, NULL, 1),
(414, 23, '[[null,null,null,38,42,58,62,null,90],[5,null,28,null,47,null,63,77,null],[2,16,25,33,43,null,null,null,null]]', NULL, NULL, 2),
(415, 23, '[[null,11,27,null,null,null,67,74,86],[null,19,30,34,45,51,null,null,null],[6,15,null,36,null,55,66,null,null]]', NULL, NULL, 3),
(416, 23, '[[2,20,30,35,41,null,null,null,null],[null,null,21,null,44,58,null,76,83],[null,19,null,null,null,59,61,72,81]]', NULL, NULL, 4),
(417, 23, '[[null,13,21,35,null,59,61,null,null],[3,null,25,null,49,57,null,77,null],[null,null,23,null,null,52,68,71,87]]', NULL, NULL, 5),
(418, 23, '[[5,null,null,36,null,null,66,79,85],[1,null,29,37,41,59,null,null,null],[3,12,27,null,null,null,63,null,87]]', NULL, NULL, 6),
(419, 23, '[[7,null,28,null,41,null,63,80,null],[6,17,29,null,null,59,null,null,81],[9,null,22,32,44,53,null,null,null]]', NULL, NULL, 7),
(420, 23, '[[null,11,null,null,42,55,64,null,81],[null,17,23,32,49,null,68,null,null],[9,20,null,34,44,null,null,76,null]]', NULL, NULL, 8),
(421, 23, '[[2,16,28,37,null,59,null,null,null],[5,null,29,38,null,56,null,75,null],[7,null,23,null,44,null,64,null,83]]', NULL, NULL, 9),
(422, 23, '[[null,17,29,32,49,51,null,null,null],[null,20,25,null,null,null,69,76,83],[7,15,30,null,null,60,null,78,null]]', NULL, NULL, 10),
(423, 23, '[[null,11,null,36,45,null,null,76,84],[4,13,23,null,null,null,70,null,90],[6,17,null,40,49,59,null,null,null]]', NULL, NULL, 11),
(424, 23, '[[2,13,21,36,null,59,null,null,null],[9,18,28,null,null,null,69,null,83],[null,20,23,null,48,null,67,78,null]]', NULL, NULL, 12),
(425, 23, '[[6,null,null,null,45,56,null,75,85],[4,12,21,null,47,null,67,null,null],[null,16,null,35,43,53,null,79,null]]', NULL, NULL, 13),
(426, 23, '[[10,null,29,34,null,null,63,null,85],[7,null,null,38,48,null,66,79,null],[null,18,21,36,43,53,null,null,null]]', NULL, NULL, 14),
(427, 23, '[[null,17,null,37,41,54,64,null,null],[1,14,21,38,null,58,null,null,null],[null,null,23,32,null,59,null,76,84]]', NULL, NULL, 15),
(428, 23, '[[null,18,null,32,48,null,64,null,88],[1,12,null,35,null,56,null,79,null],[9,20,28,31,null,null,null,null,83]]', NULL, NULL, 16),
(429, 23, '[[null,null,null,33,46,null,70,77,86],[5,19,null,null,null,null,68,80,88],[2,null,27,null,42,60,62,null,null]]', NULL, NULL, 17),
(430, 23, '[[3,null,23,null,47,null,67,74,null],[2,14,28,39,null,null,null,null,81],[8,16,24,null,41,54,null,null,null]]', NULL, NULL, 18),
(431, 23, '[[null,null,27,null,48,55,61,80,null],[3,14,22,37,46,null,null,null,null],[null,null,24,null,null,52,66,79,86]]', NULL, NULL, 19),
(432, 23, '[[null,null,27,null,null,54,68,77,90],[null,17,23,33,45,58,null,null,null],[7,15,null,null,41,null,69,79,null]]', NULL, NULL, 20),
(433, 24, '[[2,null,29,null,null,null,61,72,82],[9,18,null,null,null,59,68,null,85],[1,17,null,37,44,57,null,null,null]]', 'Alex', 'Alex', 1),
(434, 24, '[[3,null,null,36,null,59,69,null,83],[null,15,null,null,44,null,64,71,88],[4,14,26,null,null,55,null,77,null]]', 'Alex', 'Alex', 2),
(435, 24, '[[2,18,21,null,47,null,69,null,null],[null,20,null,null,45,58,67,72,null],[null,13,null,34,46,null,66,null,83]]', NULL, NULL, 3),
(436, 24, '[[3,null,21,37,null,56,70,null,null],[null,18,22,null,49,null,null,71,85],[2,null,null,38,47,null,64,null,88]]', NULL, NULL, 4),
(437, 24, '[[9,null,22,null,null,null,67,78,82],[null,13,null,35,43,null,62,76,null],[null,null,null,37,42,53,65,null,85]]', NULL, NULL, 5),
(438, 24, '[[1,16,30,null,null,null,null,78,81],[10,null,29,null,42,59,69,null,null],[8,15,null,36,49,null,null,null,87]]', NULL, NULL, 6),
(439, 24, '[[null,null,27,32,null,null,63,71,82],[2,20,29,null,44,52,null,null,null],[5,13,30,33,null,56,null,null,null]]', NULL, NULL, 7),
(440, 24, '[[null,null,24,33,null,57,68,null,86],[null,17,27,32,null,60,null,72,null],[1,19,22,31,48,null,null,null,null]]', NULL, NULL, 8),
(441, 24, '[[8,null,28,31,null,null,65,80,null],[10,null,null,33,null,57,null,71,83],[null,19,29,null,42,54,62,null,null]]', NULL, NULL, 9),
(442, 24, '[[null,null,28,40,null,null,62,75,84],[5,null,24,38,50,52,null,null,null],[null,19,21,null,null,null,68,71,83]]', NULL, NULL, 10),
(443, 24, '[[null,13,null,null,47,54,null,78,88],[1,20,null,40,42,null,null,76,null],[3,null,30,null,null,56,62,73,null]]', NULL, NULL, 11),
(444, 24, '[[9,null,null,39,44,51,69,null,null],[null,18,24,null,42,null,65,null,87],[null,null,23,37,45,null,null,72,85]]', NULL, NULL, 12),
(445, 24, '[[5,null,26,null,50,59,null,null,83],[null,14,null,33,null,58,65,73,null],[3,null,28,null,null,null,61,80,87]]', NULL, NULL, 13),
(446, 24, '[[4,14,30,null,46,54,null,null,null],[7,null,null,35,41,null,null,72,87],[null,15,null,36,45,58,65,null,null]]', NULL, NULL, 14),
(447, 24, '[[4,null,23,35,null,57,68,null,null],[null,null,29,37,null,null,61,77,82],[null,12,24,31,49,51,null,null,null]]', NULL, NULL, 15),
(448, 25, '[[null,null,29,31,null,59,63,null,88],[5,13,24,33,47,null,null,null,null],[null,18,30,null,null,55,65,73,null]]', 'Alex', 'Alex', 1),
(449, 25, '[[1,19,24,32,41,null,null,null,null],[null,null,null,39,43,51,null,73,89],[null,16,null,33,47,55,66,null,null]]', 'Alex', 'Alex', 2),
(450, 25, '[[null,null,21,32,null,59,68,72,null],[9,13,28,null,48,54,null,null,null],[4,null,null,40,41,null,66,null,82]]', 'Alex', 'Alex', 3),
(451, 25, '[[3,null,29,36,null,55,null,null,82],[8,null,23,37,47,59,null,null,null],[null,16,null,null,50,51,68,79,null]]', NULL, NULL, 4),
(452, 25, '[[9,null,26,32,null,56,null,73,null],[1,17,null,36,null,null,null,71,88],[null,18,null,39,45,51,67,null,null]]', NULL, NULL, 5),
(453, 25, '[[7,null,null,36,null,58,null,77,84],[null,14,null,35,45,null,63,null,82],[null,18,27,39,48,51,null,null,null]]', NULL, NULL, 6),
(454, 25, '[[5,19,null,37,43,null,61,null,null],[null,15,24,31,null,54,null,77,null],[null,11,null,null,48,55,66,null,84]]', NULL, NULL, 7),
(455, 25, '[[7,null,21,null,44,57,null,80,null],[null,18,null,31,null,null,69,72,83],[6,14,22,37,48,null,null,null,null]]', NULL, NULL, 8),
(456, 25, '[[3,null,null,null,49,53,66,76,null],[2,20,21,39,45,null,null,null,null],[null,null,null,38,42,54,69,null,90]]', NULL, NULL, 9),
(457, 25, '[[5,null,null,null,48,56,null,77,81],[1,null,29,null,null,51,70,71,null],[6,16,null,32,46,60,null,null,null]]', NULL, NULL, 10),
(458, 25, '[[null,12,null,null,null,54,61,73,85],[3,11,26,31,41,null,null,null,null],[2,null,27,null,null,59,67,74,null]]', NULL, NULL, 11),
(459, 25, '[[3,18,null,null,44,55,null,73,null],[null,null,24,36,41,null,67,null,88],[null,13,28,null,48,59,64,null,null]]', NULL, NULL, 12),
(460, 25, '[[null,13,24,null,null,null,70,72,83],[5,null,29,33,47,null,null,78,null],[9,18,23,null,50,55,null,null,null]]', NULL, NULL, 13),
(461, 25, '[[null,16,null,33,42,53,64,null,null],[2,null,null,null,null,59,61,71,85],[null,null,24,null,null,51,63,72,86]]', NULL, NULL, 14),
(462, 25, '[[3,null,null,40,null,58,64,79,null],[10,20,24,35,46,null,null,null,null],[4,null,null,null,null,52,68,74,87]]', NULL, NULL, 15);

-- --------------------------------------------------------

--
-- Table structure for table `ticket_requests`
--

CREATE TABLE `ticket_requests` (
  `id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `player_session` varchar(100) NOT NULL,
  `player_name` varchar(100) NOT NULL,
  `requested_ticket_ids` text NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticket_requests`
--

INSERT INTO `ticket_requests` (`id`, `game_id`, `player_session`, `player_name`, `requested_ticket_ids`, `status`) VALUES
(9, 20, 'lgaj6g3bev96kcr5lvkvm6d4qo', 'admin', '234', 'approved'),
(10, 22, 'hjmbsog2n1qqf2ta2kmjlcaqah', 'Alex', '258,259', 'approved'),
(11, 24, '4be21img51l75nq8j3f36lqpbl', 'Alex', '433,434', 'approved'),
(12, 25, '9l7vj2fpu8fnbujouca8u2md1a', 'Alex', '448,449,450', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `winners`
--

CREATE TABLE `winners` (
  `id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `prize_name` varchar(255) NOT NULL,
  `winner_name` varchar(255) DEFAULT NULL,
  `winner_ticket_no` int(11) DEFAULT NULL,
  `claimed_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `called_numbers`
--
ALTER TABLE `called_numbers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `game_id` (`game_id`);

--
-- Indexes for table `claims`
--
ALTER TABLE `claims`
  ADD PRIMARY KEY (`claim_id`),
  ADD KEY `game_id` (`game_id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`game_id`);

--
-- Indexes for table `ticket_pool`
--
ALTER TABLE `ticket_pool`
  ADD PRIMARY KEY (`id`),
  ADD KEY `game_id` (`game_id`),
  ADD KEY `assigned_to` (`assigned_to`);

--
-- Indexes for table `ticket_requests`
--
ALTER TABLE `ticket_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `game_id` (`game_id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `winners`
--
ALTER TABLE `winners`
  ADD PRIMARY KEY (`id`),
  ADD KEY `game_id` (`game_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `called_numbers`
--
ALTER TABLE `called_numbers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `claims`
--
ALTER TABLE `claims`
  MODIFY `claim_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `game_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `ticket_pool`
--
ALTER TABLE `ticket_pool`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=463;

--
-- AUTO_INCREMENT for table `ticket_requests`
--
ALTER TABLE `ticket_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `winners`
--
ALTER TABLE `winners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `called_numbers`
--
ALTER TABLE `called_numbers`
  ADD CONSTRAINT `called_numbers_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `games` (`game_id`) ON DELETE CASCADE;

--
-- Constraints for table `claims`
--
ALTER TABLE `claims`
  ADD CONSTRAINT `claims_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `games` (`game_id`) ON DELETE CASCADE;

--
-- Constraints for table `ticket_pool`
--
ALTER TABLE `ticket_pool`
  ADD CONSTRAINT `ticket_pool_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `games` (`game_id`) ON DELETE CASCADE;

--
-- Constraints for table `ticket_requests`
--
ALTER TABLE `ticket_requests`
  ADD CONSTRAINT `ticket_requests_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `games` (`game_id`) ON DELETE CASCADE;

--
-- Constraints for table `winners`
--
ALTER TABLE `winners`
  ADD CONSTRAINT `winners_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `games` (`game_id`) ON DELETE CASCADE;
--
-- Database: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `test`;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
