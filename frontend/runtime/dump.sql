SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

-- --------------------------------------------------------

--
-- Structure table `tbl__authassignment`
--

CREATE TABLE IF NOT EXISTS `tbl__authassignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump of the table `tbl__authassignment`
--

INSERT INTO `tbl__authassignment` (`itemname`, `userid`, `bizrule`, `data`) VALUES
('SuperAdmin', '1', NULL, 'N;');

-- --------------------------------------------------------

--
-- Structure table `tbl__authitem`
--

CREATE TABLE IF NOT EXISTS `tbl__authitem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump of the table `tbl__authitem`
--

INSERT INTO `tbl__authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES
('Administrator', 2, 'Site administrator', NULL, NULL),
('AuthAssignmentsManager', 2, 'Manages the assignment of roles.', NULL, 'N;'),
('Authenticated', 2, 'Default role for registered users', 'return !Yii::app()->getUser()->getIsGuest();', 'N;'),
('AuthItemsManager', 2, 'Manages objects access.', NULL, 'N;'),
('DatasetManager', 2, 'Dataset Managment', NULL, 'N;'),
('Guest', 2, 'Default role for unregistered users', 'return Yii::app()->getUser()->getIsGuest();', 'N;'),
('MediaManager', 2, 'Media Management.', NULL, 'N;'),
('StructureManager', 2, 'Structure Management.', NULL, 'N;'),
('SuperAdmin', 2, 'Super administrator', '', 's:0:"";'),
('UserManager', 2, 'User Management', NULL, 'N;');

-- --------------------------------------------------------

--
-- Structure table `tbl__authitemchild`
--

CREATE TABLE IF NOT EXISTS `tbl__authitemchild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump of the table `tbl__authitemchild`
--

INSERT INTO `tbl__authitemchild` (`parent`, `child`) VALUES
('SuperAdmin', 'Administrator'),
('SuperAdmin', 'AuthAssignmentsManager'),
('SuperAdmin', 'AuthItemsManager'),
('SuperAdmin', 'DatasetManager'),
('SuperAdmin', 'MediaManager'),
('SuperAdmin', 'StructureManager'),
('SuperAdmin', 'UserManager');

-- --------------------------------------------------------

--
-- Structure table `tbl__cache`
--

CREATE TABLE IF NOT EXISTS `tbl__cache` (
  `id` char(128) NOT NULL,
  `expire` int(11) DEFAULT NULL,
  `value` longblob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump of the table `tbl__cache`
--

INSERT INTO `tbl__cache` (`id`, `expire`, `value`) VALUES
('76133e34f7ff71854eb2fec4c717c79b', 0, 0x613a323a7b693a303b613a323a7b693a303b733a31323a22636c656172696d616765737c223b693a313b733a33323a226135336461613565366136666564386264616334633766653332376436386238223b7d693a313b4e3b7d);

-- --------------------------------------------------------

--
-- Structure table `tbl__storage_media`
--

CREATE TABLE IF NOT EXISTS `tbl__storage_media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `main` tinyint(4) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `kind` varchar(50) NOT NULL,
  `file` text,
  PRIMARY KEY (`id`),
  KEY `group_id_type_id` (`group_id`,`type_id`),
  KEY `sort_main` (`sort`,`main`),
  KEY `title` (`title`),
  KEY `kind` (`kind`),
  KEY `Fk__media_type` (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure table `tbl__storage_media_set`
--

CREATE TABLE IF NOT EXISTS `tbl__storage_media_set` (
  `media_id` int(11) NOT NULL,
  `set_id` int(11) NOT NULL,
  PRIMARY KEY (`media_id`,`set_id`),
  KEY `Fk__media_set_set` (`set_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure table `tbl__storage_menu`
--

CREATE TABLE IF NOT EXISTS `tbl__storage_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `root_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `root_id` (`root_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure table `tbl__storage_menu_section`
--

CREATE TABLE IF NOT EXISTS `tbl__storage_menu_section` (
  `menu_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  PRIMARY KEY (`menu_id`,`section_id`),
  KEY `tbl__storage_menu_section_ibfk2` (`section_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure table `tbl__storage_object`
--

CREATE TABLE IF NOT EXISTS `tbl__storage_object` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `set_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `publish` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `in_sitemap` tinyint(1) unsigned DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(10000) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `set_id_parent_id` (`set_id`,`parent_id`),
  KEY `sort` (`sort`),
  KEY `publish` (`publish`),
  KEY `title_name` (`title`,`name`),
  KEY `url` (`url`(255)),
  KEY `Fk__object_section` (`parent_id`),
  KEY `in_sitemap` (`in_sitemap`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure table `tbl__storage_object_elements`
--

CREATE TABLE IF NOT EXISTS `tbl__storage_object_elements` (
  `object_id` int(11) NOT NULL,
  `set_id` int(11) NOT NULL,
  PRIMARY KEY (`object_id`,`set_id`),
  KEY `tbl__storage_object_elements_ibfk2` (`set_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure table `tbl__storage_object_set`
--

CREATE TABLE IF NOT EXISTS `tbl__storage_object_set` (
  `object_id` int(11) NOT NULL,
  `set_id` int(11) NOT NULL,
  PRIMARY KEY (`object_id`,`set_id`),
  KEY `Fk__object_set_set` (`set_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure table `tbl__storage_section`
--

CREATE TABLE IF NOT EXISTS `tbl__storage_section` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `set_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `root_id` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `left_key` int(11) DEFAULT NULL,
  `right_key` int(11) DEFAULT NULL,
  `publish` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `in_sitemap` tinyint(1) unsigned DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(10000) NOT NULL,
  `r_url` varchar(10000) DEFAULT NULL,
  `handler` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  KEY `root_id` (`root_id`),
  KEY `level_left_key_right_key` (`level`,`left_key`,`right_key`),
  KEY `parent_id_left_key` (`parent_id`,`left_key`),
  KEY `publish` (`publish`),
  KEY `title_name` (`title`,`name`),
  KEY `url` (`url`(255)),
  KEY `set_id` (`set_id`),
  KEY `in_sitemap` (`in_sitemap`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dump of the table `tbl__storage_section`
--

INSERT INTO `tbl__storage_section` (`id`, `set_id`, `parent_id`, `root_id`, `level`, `left_key`, `right_key`, `publish`, `in_sitemap`, `title`, `name`, `url`, `r_url`, `handler`) VALUES
(1, NULL, 0, 1, 1, 1, 2, 1, 0, 'Главная страница', 'ru', '/ru/', NULL, 'site');

-- --------------------------------------------------------

--
-- Structure table `tbl__storage_section_set`
--

CREATE TABLE IF NOT EXISTS `tbl__storage_section_set` (
  `section_id` int(11) NOT NULL,
  `set_id` int(11) NOT NULL,
  PRIMARY KEY (`section_id`,`set_id`),
  KEY `Fk__section_set_set` (`set_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure table `tbl__storage_set`
--

CREATE TABLE IF NOT EXISTS `tbl__storage_set` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sort` int(11) DEFAULT '0',
  `status` mediumint(8) DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `integration` varchar(50) DEFAULT NULL,
  `type` varchar(50) NOT NULL,
  `aliasname` varchar(255) DEFAULT NULL,
  `classname` varchar(512) DEFAULT NULL,
  `tablename` varchar(512) DEFAULT NULL,
  `primarykey` varchar(128) DEFAULT NULL,
  `entityid` varchar(128) DEFAULT NULL,
  `relations` text,
  `options` text,
  PRIMARY KEY (`id`),
  KEY `sort_status` (`sort`,`status`),
  KEY `title_name` (`title`,`name`),
  KEY `classname_tablename` (`classname`(255),`tablename`(255)),
  KEY `primarykey` (`primarykey`),
  KEY `integration` (`integration`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dump of the table `tbl__storage_set`
--

INSERT INTO `tbl__storage_set` (`id`, `sort`, `status`, `title`, `name`, `integration`, `type`, `aliasname`, `classname`, `tablename`, `primarykey`, `entityid`, `relations`, `options`) VALUES
(1, 0, 0, 'Object', 'object', '0', 'storage', 'object', 'common\\storage\\Object', '{{storage_object}}', 'id', '', '', 'null'),
(2, 0, 0, 'Section', 'section', '0', 'storage', 'section', 'common\\storage\\Section', '{{storage_section}}', 'id', '', '', 'null'),
(3, 0, 0, 'User', 'user', '0', 'storage', 'user', 'common\\storage\\User', '{{storage_user}}', 'id', '', '', 'null'),
(4, 0, 0, 'Media', 'media', '0', 'storage', 'media', 'common\\storage\\Media', '{{storage_media}}', 'id', '', '', 'null');

-- --------------------------------------------------------

--
-- Structure table `tbl__storage_type`
--

CREATE TABLE IF NOT EXISTS `tbl__storage_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `set_id` int(11) DEFAULT NULL,
  `sort` int(11) DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `prevname` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `prevtype` varchar(255) DEFAULT NULL,
  `options` text,
  `is_hidden` tinyint(1) unsigned DEFAULT '0',
  `is_required` tinyint(1) unsigned DEFAULT '0',
  `is_gridview` tinyint(1) unsigned DEFAULT '0',
  `is_filtered` tinyint(1) unsigned DEFAULT '0',
  `is_sortable` tinyint(1) unsigned DEFAULT '0',
  `is_index` tinyint(1) unsigned DEFAULT '0',
  `is_unique` tinyint(1) unsigned DEFAULT '0',
  `is_exists` tinyint(1) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `set_id` (`set_id`),
  KEY `title` (`title`),
  KEY `name_prevname` (`name`,`prevname`),
  KEY `sort` (`sort`),
  KEY `type_prevtype` (`type`,`prevtype`),
  KEY `flags` (`is_hidden`,`is_required`,`is_gridview`,`is_filtered`,`is_sortable`,`is_index`,`is_unique`,`is_exists`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure table `tbl__storage_user`
--

CREATE TABLE IF NOT EXISTS `tbl__storage_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `useractive` tinyint(1) unsigned DEFAULT '0',
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `usermail` varchar(255) DEFAULT NULL,
  `userhash` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usermail` (`usermail`),
  KEY `useractive` (`useractive`),
  KEY `username_password` (`username`,`password`),
  KEY `userhash` (`userhash`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dump of the table `tbl__storage_user`
--

INSERT INTO `tbl__storage_user` (`id`, `useractive`, `username`, `password`, `usermail`, `userhash`) VALUES
(1, 1, 'admin', '$2a$10$RPfcT9hZi/ZGyUTb/llFF.gj/dJdM2cLRjKs7d39p3Riuw3JsCoZW', '', '');

-- --------------------------------------------------------

--
-- Structure table `tbl__storage_user_set`
--

CREATE TABLE IF NOT EXISTS `tbl__storage_user_set` (
  `user_id` int(11) NOT NULL,
  `set_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`set_id`),
  KEY `Fk__user_set_set` (`set_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Foreign keys
--

--
-- Foreign key for table `tbl__authassignment`
--
ALTER TABLE `tbl__authassignment`
  ADD CONSTRAINT `tbl__authassignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `tbl__authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Foreign key for table `tbl__authitemchild`
--
ALTER TABLE `tbl__authitemchild`
  ADD CONSTRAINT `tbl__authitemchild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `tbl__authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl__authitemchild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `tbl__authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Foreign key for table `tbl__storage_media`
--
ALTER TABLE `tbl__storage_media`
  ADD CONSTRAINT `Fk__media_type` FOREIGN KEY (`type_id`) REFERENCES `tbl__storage_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Foreign key for table `tbl__storage_media_set`
--
ALTER TABLE `tbl__storage_media_set`
  ADD CONSTRAINT `Fk__media_set_media` FOREIGN KEY (`media_id`) REFERENCES `tbl__storage_media` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Fk__media_set_set` FOREIGN KEY (`set_id`) REFERENCES `tbl__storage_set` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Foreign key for table `tbl__storage_menu`
--
ALTER TABLE `tbl__storage_menu`
  ADD CONSTRAINT `tbl__storage_menu_ibfk1` FOREIGN KEY (`root_id`) REFERENCES `tbl__storage_section` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Foreign key for table `tbl__storage_menu_section`
--
ALTER TABLE `tbl__storage_menu_section`
  ADD CONSTRAINT `tbl__storage_menu_section_ibfk1` FOREIGN KEY (`menu_id`) REFERENCES `tbl__storage_menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl__storage_menu_section_ibfk2` FOREIGN KEY (`section_id`) REFERENCES `tbl__storage_section` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Foreign key for table `tbl__storage_object`
--
ALTER TABLE `tbl__storage_object`
  ADD CONSTRAINT `Fk__object_section` FOREIGN KEY (`parent_id`) REFERENCES `tbl__storage_section` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Fk__set_object` FOREIGN KEY (`set_id`) REFERENCES `tbl__storage_set` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Foreign key for table `tbl__storage_object_elements`
--
ALTER TABLE `tbl__storage_object_elements`
  ADD CONSTRAINT `tbl__storage_object_elements_ibfk1` FOREIGN KEY (`object_id`) REFERENCES `tbl__storage_object` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl__storage_object_elements_ibfk2` FOREIGN KEY (`set_id`) REFERENCES `tbl__storage_set` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Foreign key for table `tbl__storage_object_set`
--
ALTER TABLE `tbl__storage_object_set`
  ADD CONSTRAINT `Fk__object_set_object` FOREIGN KEY (`object_id`) REFERENCES `tbl__storage_object` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Fk__object_set_set` FOREIGN KEY (`set_id`) REFERENCES `tbl__storage_set` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Foreign key for table `tbl__storage_section`
--
ALTER TABLE `tbl__storage_section`
  ADD CONSTRAINT `Fk__set_section` FOREIGN KEY (`set_id`) REFERENCES `tbl__storage_set` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Foreign key for table `tbl__storage_section_set`
--
ALTER TABLE `tbl__storage_section_set`
  ADD CONSTRAINT `Fk__section_set_section` FOREIGN KEY (`section_id`) REFERENCES `tbl__storage_section` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Fk__section_set_set` FOREIGN KEY (`set_id`) REFERENCES `tbl__storage_set` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Foreign key for table `tbl__storage_type`
--
ALTER TABLE `tbl__storage_type`
  ADD CONSTRAINT `fk__set_type` FOREIGN KEY (`set_id`) REFERENCES `tbl__storage_set` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Foreign key for table `tbl__storage_user_set`
--
ALTER TABLE `tbl__storage_user_set`
  ADD CONSTRAINT `Fk__user_set_set` FOREIGN KEY (`set_id`) REFERENCES `tbl__storage_set` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Fk__user_set_user` FOREIGN KEY (`user_id`) REFERENCES `tbl__storage_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
