-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2020 at 11:26 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `schiphol`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_klachten` ()  BEGIN
	DECLARE dezedatum DATETIME;
    DECLARE dezepostcode VARCHAR(6);
    DECLARE dezeklacht VARCHAR(200);
    
    SELECT klacht.datum, klacht.postcode, klachtsoort.klachtsoort
    FROM klacht
    INNER JOIN klachtsoort
    ON klacht.ID_klachtsoort = klachtsoort.ID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_prioriteit` ()  BEGIN    
	SELECT klacht.datum, klacht.postcode, klachtsoort.klachtsoort, klacht.prioriteit
    FROM klacht
    INNER JOIN klachtsoort
    ON klacht.ID_klachtsoort = klachtsoort.ID
    ORDER BY klacht.prioriteit;
        
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `gebruiker`
--

CREATE TABLE `gebruiker` (
  `ID` smallint(6) NOT NULL,
  `naam` varchar(45) NOT NULL,
  `postcode` varchar(6) NOT NULL,
  `geboortedatum` date NOT NULL,
  `email` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gebruiker`
--

INSERT INTO `gebruiker` (`ID`, `naam`, `postcode`, `geboortedatum`, `email`) VALUES
(1, 'John van den Berg', '1098LV', '1984-10-07', 'jvdb@live.nl'),
(2, 'Celia Hayna', '1999BB', '1986-05-24', 'ch@gmail.com'),
(3, 'Justin Boom', '2000AA', '1991-05-03', 'jv@live.nl'),
(4, 'Roemer Gallo', '1999BB', '1085-05-31', 'rg@hotmail.com'),
(5, 'Jaap van der Broek', '1098LV', '1990-03-30', 'jaap@gmail.com'),
(83, 'fe', '1999BB', '2020-01-07', 'thimoyo@gmail.com'),
(84, 'Henk-Jan', '1099TT', '2020-01-15', 'henkjan@gmail.com'),
(85, 'Kees van der Broek', '1099TT', '1973-03-21', 'keesvdb@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `klacht`
--

CREATE TABLE `klacht` (
  `ID` smallint(6) NOT NULL,
  `ID_gebruiker` smallint(6) NOT NULL,
  `ID_klachtsoort` smallint(6) NOT NULL,
  `datum` datetime NOT NULL,
  `prioriteit` int(11) NOT NULL DEFAULT 1,
  `afgehandeld` tinyint(1) NOT NULL,
  `klacht` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `klacht`
--

INSERT INTO `klacht` (`ID`, `ID_gebruiker`, `ID_klachtsoort`, `datum`, `prioriteit`, `afgehandeld`, `klacht`) VALUES
(1, 84, 1, '2020-01-30 12:12:59', 1, 0, 'Het is slecht voor het milieu.'),
(2, 85, 2, '2020-01-31 11:16:08', 1, 0, 'Ik voel me onveilig rond de vliegtuigen');

--
-- Triggers `klacht`
--
DELIMITER $$
CREATE TRIGGER `trigger_afhandelen` BEFORE UPDATE ON `klacht` FOR EACH ROW BEGIN
	IF NEW.afgehandeld = 1 THEN
    	SET NEW.prioriteit = 0;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `klachtsoort`
--

CREATE TABLE `klachtsoort` (
  `ID` smallint(6) NOT NULL,
  `klachtsoort` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `klachtsoort`
--

INSERT INTO `klachtsoort` (`ID`, `klachtsoort`) VALUES
(1, 'milieu'),
(2, 'veiligheid'),
(3, 'geluid');

-- --------------------------------------------------------

--
-- Table structure for table `postcode`
--

CREATE TABLE `postcode` (
  `postcode` varchar(6) NOT NULL,
  `ID` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `postcode`
--

INSERT INTO `postcode` (`postcode`, `ID`) VALUES
('1098LV', 1),
('1090XX', 2),
('1098LX', 3),
('1099TT', 4),
('1999BB', 5),
('2000AA', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gebruiker`
--
ALTER TABLE `gebruiker`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `klacht`
--
ALTER TABLE `klacht`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_klachtsoort` (`ID_klachtsoort`);

--
-- Indexes for table `klachtsoort`
--
ALTER TABLE `klachtsoort`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `postcode`
--
ALTER TABLE `postcode`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gebruiker`
--
ALTER TABLE `gebruiker`
  MODIFY `ID` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `klacht`
--
ALTER TABLE `klacht`
  MODIFY `ID` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `klachtsoort`
--
ALTER TABLE `klachtsoort`
  MODIFY `ID` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `postcode`
--
ALTER TABLE `postcode`
  MODIFY `ID` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `klacht`
--
ALTER TABLE `klacht`
  ADD CONSTRAINT `klacht_ibfk_1` FOREIGN KEY (`ID_klachtsoort`) REFERENCES `klachtsoort` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
