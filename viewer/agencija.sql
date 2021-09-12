-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2020 at 08:13 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agencija`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategorija`
--

CREATE TABLE `kategorija` (
  `kategorijaID` int(11) NOT NULL,
  `nazivKategorije` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategorija`
--

INSERT INTO `kategorija` (`kategorijaID`, `nazivKategorije`) VALUES
(1, 'Letovanje'),
(2, 'Zimovanje'),
(3, 'Izlet');

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `korisnikID` int(11) NOT NULL,
  `imeIPrezime` varchar(255) NOT NULL,
  `kIme` varchar(255) NOT NULL,
  `lozinka` varchar(255) NOT NULL,
  `administrator` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`korisnikID`, `imeIPrezime`, `kIme`, `lozinka`, `administrator`) VALUES
(1, 'Vanja Jovic', 'vanja', 'vanja', 1),
(2, 'Pera Peric', 'pera', 'pera', 0),
(3, 'Aleksa Aleksic', 'aleksa', 'aleksa', 0),
(4, 'Voja Vojic', 'voja', 'voja', 0),
(5, 'Mica Mikic', 'mica', 'mica', 0);

-- --------------------------------------------------------

--
-- Table structure for table `porudzbina`
--

CREATE TABLE `porudzbina` (
  `porudzbinaID` int(11) NOT NULL,
  `datumPorudzbine` date NOT NULL,
  `ukupanIznos` double NOT NULL,
  `korisnikID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `porudzbina`
--

INSERT INTO `porudzbina` (`porudzbinaID`, `datumPorudzbine`, `ukupanIznos`, `korisnikID`) VALUES
(15, '2020-02-05', 2200, 3),
(16, '2020-02-05', 1100, 3);

-- --------------------------------------------------------

--
-- Table structure for table `proizvodi`
--

CREATE TABLE `proizvodi` (
  `id` int(11) NOT NULL,
  `naziv` varchar(1000) NOT NULL,
  `opis` varchar(1000) NOT NULL,
  `cena` double NOT NULL,
  `kategorijaID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `proizvodi`
--

INSERT INTO `proizvodi` (`id`, `naziv`, `opis`, `cena`, `kategorijaID`) VALUES
(1, 'Jahorina skijanje', 'Hotel Snesko 7 dana', 550, 2),
(2, 'Maldivi', 'Obezbedjen avion 10 dana', 2000, 1),
(3, 'Berlin', 'Prolece 3 dana ', 250, 3),
(5, 'Bansko', 'Skijanje u Bugarskoj 10 dana', 500, 2),
(6, 'Pariz', 'Dan zaljubljenih 4 noci', 700, 3);

-- --------------------------------------------------------

--
-- Table structure for table `stavkaporudzbine`
--

CREATE TABLE `stavkaporudzbine` (
  `rb` int(11) NOT NULL,
  `porudzbinaID` int(11) NOT NULL,
  `proizvodID` int(11) NOT NULL,
  `kolicina` int(11) NOT NULL,
  `iznos` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stavkaporudzbine`
--

INSERT INTO `stavkaporudzbine` (`rb`, `porudzbinaID`, `proizvodID`, `kolicina`, `iznos`) VALUES
(19, 15, 2, 2, 2200),
(20, 16, 1, 2, 1100);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategorija`
--
ALTER TABLE `kategorija`
  ADD PRIMARY KEY (`kategorijaID`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`korisnikID`);

--
-- Indexes for table `porudzbina`
--
ALTER TABLE `porudzbina`
  ADD PRIMARY KEY (`porudzbinaID`);

--
-- Indexes for table `proizvodi`
--
ALTER TABLE `proizvodi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stavkaporudzbine`
--
ALTER TABLE `stavkaporudzbine`
  ADD PRIMARY KEY (`rb`,`porudzbinaID`),
  ADD KEY `porudzbinaID` (`porudzbinaID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategorija`
--
ALTER TABLE `kategorija`
  MODIFY `kategorijaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `korisnikID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `porudzbina`
--
ALTER TABLE `porudzbina`
  MODIFY `porudzbinaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `proizvodi`
--
ALTER TABLE `proizvodi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `stavkaporudzbine`
--
ALTER TABLE `stavkaporudzbine`
  MODIFY `rb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `stavkaporudzbine`
--
ALTER TABLE `stavkaporudzbine`
  ADD CONSTRAINT `stavkaporudzbine_ibfk_1` FOREIGN KEY (`porudzbinaID`) REFERENCES `porudzbina` (`porudzbinaID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
