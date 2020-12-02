-- phpMyAdmin SQL Dump
-- version 2.11.2.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 05, 2007 at 07:37 PM
-- Server version: 5.0.45
-- PHP Version: 5.2.3-1+lenny1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `proyecto`
--

-- --------------------------------------------------------

--
-- Table structure for table `alumnos`
--

CREATE TABLE IF NOT EXISTS `alumnos` (
  `id` int(10) NOT NULL auto_increment,
  `nombre` varchar(30) NOT NULL,
  `apellidos` varchar(30) NOT NULL,
  `no_control` varchar(30) NOT NULL,
  `carrera` varchar(30) NOT NULL,
  `correo` varchar(30) NOT NULL,
  `ingreso` varchar(31) NOT NULL,
  `egreso` varchar(31) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `correo` (`correo`),
  UNIQUE KEY `no_control` (`no_control`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `alumnos`
--

INSERT INTO `alumnos` (`id`, `nombre`, `apellidos`, `no_control`, `carrera`, `correo`, `ingreso`, `egreso`) VALUES
(43, 'base de datos', 'torres', '98765432', 'Ing.', 'antonio@hotmail.com', '1983', '1983');
