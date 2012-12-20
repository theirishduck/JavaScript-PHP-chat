-- phpMyAdmin SQL Dump
-- version 3.5.3
-- http://www.phpmyadmin.net
--
-- Hoszt: localhost
-- Létrehozás ideje: 2012. dec. 20. 20:53
-- Szerver verzió: 5.1.63-0+squeeze1
-- PHP verzió: 5.3.3-7+squeeze14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Adatbázis: `chat`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet: `c_messages`
--

CREATE TABLE IF NOT EXISTS `c_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` text NOT NULL,
  `nickname` text NOT NULL,
  `room_id` int(10) unsigned NOT NULL,
  `message` text NOT NULL,
  `created` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tábla szerkezet: `c_people`
--

CREATE TABLE IF NOT EXISTS `c_people` (
  `token` text NOT NULL,
  `name` text NOT NULL,
  `last_activity` int(4) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tábla szerkezet: `c_rooms`
--

CREATE TABLE IF NOT EXISTS `c_rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
