-- phpMyAdmin SQL Dump
-- version 2.11.9.6
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Feb 25, 2016 at 08:36 PM
-- Server version: 5.0.95
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `emailflyersads`
--

-- --------------------------------------------------------

--
-- Table structure for table `email_newsletters`
--

CREATE TABLE IF NOT EXISTS `email_newsletters` (
  `unique_id` mediumint(10) NOT NULL auto_increment,
  `email_type` char(10) NOT NULL default 'drip' COMMENT 'drip, newsletter, welcome',
  `email_subject` varchar(150) NOT NULL,
  `html_body` text NOT NULL,
  `text_body` text NOT NULL,
  `from_name` char(25) NOT NULL,
  `from_email` varchar(150) NOT NULL,
  `bounce_email` varchar(150) NOT NULL,
  `drip_days` smallint(5) NOT NULL default '0',
  `drip_order` smallint(6) NOT NULL default '0',
  `schedule_date` datetime NOT NULL,
  `active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`unique_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

--
-- Table structure for table `email_tracking`
--

CREATE TABLE IF NOT EXISTS `email_tracking` (
  `tracking_id` mediumint(10) NOT NULL auto_increment,
  `type` char(5) NOT NULL default 'open' COMMENT 'open, link',
  `member_id` mediumint(9) NOT NULL,
  `email_id` mediumint(8) NOT NULL,
  `ip` varchar(100) default NULL,
  `host` varchar(50) default NULL,
  `url` text,
  `date_added` datetime NOT NULL,
  PRIMARY KEY  (`tracking_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2011 ;

-- --------------------------------------------------------

--
-- Table structure for table `realtor_list`
--

CREATE TABLE IF NOT EXISTS `realtor_list` (
  `list_id` mediumint(10) NOT NULL auto_increment,
  `name` varchar(50) default NULL,
  `company` varchar(60) default NULL,
  `address` varchar(100) default NULL,
  `city` varchar(50) default NULL,
  `state` char(2) default NULL,
  `zip` varchar(10) default NULL,
  `email` varchar(100) NOT NULL default '',
  `phone` varchar(25) default NULL,
  `opt_out` tinyint(1) NOT NULL default '0',
  `opt_out_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `active` char(3) NOT NULL default 'yes',
  `email_area` varchar(50) NOT NULL default '',
  `association` varchar(5) default NULL,
  `county` varchar(50) NOT NULL default '',
  `ip1` varchar(20) NOT NULL default '',
  `host1` varchar(75) NOT NULL default '',
  `ip2` varchar(20) NOT NULL default '',
  `host2` varchar(75) NOT NULL default '',
  `notes` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`list_id`),
  KEY `email` (`email`),
  KEY `email_area` (`email_area`),
  KEY `city` (`city`,`state`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7157684 ;

-- --------------------------------------------------------

--
-- Table structure for table `sent_emails`
--

CREATE TABLE IF NOT EXISTS `sent_emails` (
  `unique_id` mediumint(9) NOT NULL auto_increment,
  `list_id` mediumint(9) NOT NULL default '0',
  `newsletter_id` mediumint(9) NOT NULL default '0',
  `date_sent` datetime NOT NULL,
  PRIMARY KEY  (`unique_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=101 ;

-- --------------------------------------------------------

--
-- Table structure for table `sent_jobs`
--

CREATE TABLE IF NOT EXISTS `sent_jobs` (
  `job_id` int(11) NOT NULL auto_increment,
  `job_type` varchar(25) NOT NULL default '',
  `start_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `run_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `sent_emails` mediumint(11) NOT NULL default '0',
  `server` varchar(20) NOT NULL default '',
  `flyer_id` mediumint(15) NOT NULL default '0',
  PRIMARY KEY  (`job_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=182788 ;
