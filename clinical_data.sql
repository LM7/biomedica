-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Giu 16, 2014 alle 17:04
-- Versione del server: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `clinical_data`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `administrators`
--

CREATE TABLE IF NOT EXISTS `administrators` (
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  PRIMARY KEY (`username`,`password`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `administrators`
--

INSERT INTO `administrators` (`username`, `password`) VALUES
('claudia', 'claudia'),
('lorenzo', 'lorenzo'),
('luca', 'luca'),
('tommaso', 'tommaso');

-- --------------------------------------------------------

--
-- Struttura della tabella `cns`
--

CREATE TABLE IF NOT EXISTS `cns` (
  `ng_cns` int(11) NOT NULL,
  `insertion_date_cns` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `breath` char(1) NOT NULL,
  `id` char(1) NOT NULL,
  `hypotonia` char(1) NOT NULL,
  `ataxia` char(1) NOT NULL,
  `apraxia` char(1) NOT NULL,
  `nystagmus` char(1) NOT NULL,
  PRIMARY KEY (`ng_cns`,`insertion_date_cns`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `eyes`
--

CREATE TABLE IF NOT EXISTS `eyes` (
  `ng_eyes` int(11) NOT NULL,
  `insertion_date_eyes` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `leber_amaurosis` char(1) NOT NULL,
  `retinopathy` char(1) NOT NULL,
  `coloboma` char(1) NOT NULL,
  PRIMARY KEY (`ng_eyes`,`insertion_date_eyes`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `kidneys`
--

CREATE TABLE IF NOT EXISTS `kidneys` (
  `ng_kidneys` int(11) NOT NULL,
  `insertion_date_kidneys` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `renal_failure` char(1) NOT NULL,
  `nph` char(1) NOT NULL,
  `cystis` char(1) NOT NULL,
  `eco_blood_alterations` char(1) NOT NULL,
  PRIMARY KEY (`ng_kidneys`,`insertion_date_kidneys`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `liver`
--

CREATE TABLE IF NOT EXISTS `liver` (
  `ng_liver` int(11) NOT NULL,
  `insertion_date_liver` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `eco_blood_alterations_liver` char(1) NOT NULL,
  `hf` char(1) NOT NULL,
  PRIMARY KEY (`ng_liver`,`insertion_date_liver`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `mti`
--

CREATE TABLE IF NOT EXISTS `mti` (
  `ng_mti` int(11) NOT NULL,
  `insertion_date_mti` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `em_cele` char(1) NOT NULL,
  `hydroceph` char(1) NOT NULL,
  `dw` char(1) NOT NULL,
  `cc_hypopl` char(1) NOT NULL,
  PRIMARY KEY (`ng_mti`,`insertion_date_mti`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `patient`
--

CREATE TABLE IF NOT EXISTS `patient` (
  `ng` int(11) NOT NULL,
  `insertion_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `family` varchar(10) NOT NULL,
  `sex` char(1) NOT NULL,
  `consang` char(1) NOT NULL,
  `cns` char(1) NOT NULL,
  `eyes` char(1) NOT NULL,
  `kidneys` char(1) NOT NULL,
  `liver` char(1) NOT NULL,
  `polydactyly` char(1) NOT NULL,
  `tongue` char(1) NOT NULL,
  `heart` char(1) NOT NULL,
  `dysmorphic` char(1) NOT NULL,
  `mti` char(1) NOT NULL,
  `notes` varchar(300) NOT NULL,
  `diagnosis` varchar(100) NOT NULL,
  PRIMARY KEY (`ng`,`insertion_date`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `polydactyly`
--

CREATE TABLE IF NOT EXISTS `polydactyly` (
  `ng_polydactyly` int(11) NOT NULL,
  `insertion_date_polydactyly` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `postaxial` char(1) NOT NULL,
  `mesa_preaxial` char(1) NOT NULL,
  PRIMARY KEY (`ng_polydactyly`,`insertion_date_polydactyly`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `tongue`
--

CREATE TABLE IF NOT EXISTS `tongue` (
  `ng_tongue` int(11) NOT NULL,
  `insertion_date_tongue` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cleft_lip_palat` char(1) NOT NULL,
  PRIMARY KEY (`ng_tongue`,`insertion_date_tongue`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
