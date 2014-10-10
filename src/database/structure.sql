--	structure.sql
--	Mischa Lehmann
--	ducksource@duckpond.ch
--	Version:1.0
--
--	Database structure
--	Require:
--
--
--	Licence:
--	You're allowed to edit and publish my source in all of your free and open-source projects.
--	Please send me an e-mail if you'll implement this source in one of your commercial or proprietary projects.
-- 	Leave this Header untouched!
--
--	Warranty:
--       Warranty void if signet is broken
-- 	================== / /===================
-- 	[	Waranty	  / /	Signet 		]
--	=================/ /=====================	
--	!!Wo0t!!
--

-- phpMyAdmin SQL Dump
-- version 3.3.10
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 07, 2011 at 11:37 PM
-- Server version: 5.5.11
-- PHP Version: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `duckpond_canyouholdthis`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `allfiles`
--
CREATE TABLE IF NOT EXISTS `allfiles` (
`Id` int(11)
,`FK_StuffToHold_Id` int(11)
,`Filename` varchar(100)
,`Filesize` int(11)
,`MIME` varchar(200)
,`Icon` varchar(100)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `desktohold`
--
CREATE TABLE IF NOT EXISTS `desktohold` (
`Desk_Id` int(11)
,`Id` int(11)
,`Access_id` varchar(4)
,`Type` enum('Desk','File','Text')
,`Time` datetime
,`Last_Access` datetime
,`Access_Count` int(11)
);
-- --------------------------------------------------------

--
-- Table structure for table `FileInformation`
--

CREATE TABLE IF NOT EXISTS `FileInformation` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `FK_StuffToHold_Id` int(11) NOT NULL COMMENT 'Hold id foreign key',
  `Filename` varchar(100) NOT NULL,
  `Filesize` int(11) NOT NULL COMMENT 'Filesize in bytes',
  `FK_MimeTypes_Id` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `FK_StuffToHold_Id_Index` (`FK_StuffToHold_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `MimeTypes`
--

CREATE TABLE IF NOT EXISTS `MimeTypes` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `MimeType` varchar(200) NOT NULL,
  `Icon` varchar(100) NOT NULL DEFAULT 'defaulticon.png',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `StuffToHold`
--

CREATE TABLE IF NOT EXISTS `StuffToHold` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Access_id` varchar(4) NOT NULL,
  `Type` enum('Desk','File','Text') NOT NULL,
  `Time` datetime NOT NULL,
  `Last_Access` datetime NOT NULL COMMENT 'Las Access Time',
  `Access_Count` int(11) NOT NULL COMMENT 'Amount of Requests',
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Access_Id_Index` (`Access_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `StuffToHold_to_Desk`
--

CREATE TABLE IF NOT EXISTS `StuffToHold_to_Desk` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `FK_StuffToHold_Id` int(11) NOT NULL,
  `FK_Desk_Id` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `StuffToHold_Id_Index` (`FK_StuffToHold_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Structure for view `allfiles`
--
DROP TABLE IF EXISTS `allfiles`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `allfiles` AS select `Finfo`.`Id` AS `Id`,`Finfo`.`FK_StuffToHold_Id` AS `FK_StuffToHold_Id`,`Finfo`.`Filename` AS `Filename`,`Finfo`.`Filesize` AS `Filesize`,`Mtypes`.`MimeType` AS `MIME`,`Mtypes`.`Icon` AS `Icon` from (`FileInformation` `Finfo` join `MimeTypes` `Mtypes` on((`Finfo`.`FK_MimeTypes_Id` = `Mtypes`.`Id`)));

-- --------------------------------------------------------

--
-- Structure for view `desktohold`
--
DROP TABLE IF EXISTS `desktohold`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `desktohold` AS select `H1`.`Id` AS `Desk_Id`,`H2`.`Id` AS `Id`,`H2`.`Access_id` AS `Access_id`,`H2`.`Type` AS `Type`,`H2`.`Time` AS `Time`,`H2`.`Last_Access` AS `Last_Access`,`H2`.`Access_Count` AS `Access_Count` from (`StuffToHold` `H1` join (`StuffToHold_to_Desk` `Map` join `StuffToHold` `H2`) on(((`H1`.`Id` = `Map`.`FK_Desk_Id`) and (`H2`.`Id` = `Map`.`FK_StuffToHold_Id`))));
