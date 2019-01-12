-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2017 at 05:13 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parkir1`
--

-- --------------------------------------------------------

--
-- Table structure for table `lokasi`
--

CREATE TABLE `lokasi` (
  `LokasiID` int(11) NOT NULL,
  `Lokasi` varchar(50) DEFAULT NULL,
  `Kapasitas` int(11) DEFAULT NULL,
  `Slot` int(11) DEFAULT NULL,
  `SatpamID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lokasi`
--

INSERT INTO `lokasi` (`LokasiID`, `Lokasi`, `Kapasitas`, `Slot`, `SatpamID`) VALUES
(1, 'Labtek V', 10, 7, 1),
(2, 'Labtek VIII', 10, 10, 2),
(3, 'GKU Timur', 10, 9, 3),
(4, 'Aula Barat', 10, 8, 4),
(5, 'Aula Timur', 10, 10, 5),
(6, 'SBM', 10, 10, 6),
(7, 'PLN', 10, 10, 7);

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswaumum`
--

CREATE TABLE `mahasiswaumum` (
  `NomorPlat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggaran`
--

CREATE TABLE `pelanggaran` (
  `PelanggaranID` int(11) NOT NULL,
  `SatpamID` int(11) DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pelanggaran`
--

INSERT INTO `pelanggaran` (`PelanggaranID`, `SatpamID`, `Status`) VALUES
(1, 1, 'Perlu dikunci'),
(2, 2, 'Perlu dikunci'),
(3, 1, 'Masalah selesai'),
(4, 1, 'Masalah selesai'),
(5, 1, 'Masalah selesai'),
(6, 1, 'Masalah selesai'),
(7, 1, 'Masalah selesai'),
(8, 1, 'Melanggar, sudah ditelepon'),
(9, 1, 'Melanggar, belum ditelepon'),
(10, 1, 'Melanggar, sudah ditelepon'),
(11, 1, 'Melanggar, sudah ditelepon'),
(12, 1, 'Perlu dikunci'),
(13, 1, 'Perlu dikunci'),
(14, 1, 'Melanggar, belum ditelepon'),
(15, 1, 'Melanggar, belum ditelepon'),
(16, 1, 'Perlu dikunci'),
(17, 1, 'Masalah selesai');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `PetugasID` int(11) NOT NULL,
  `Name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`PetugasID`, `Name`) VALUES
(1, 'Asep');

-- --------------------------------------------------------

--
-- Table structure for table `satpam`
--

CREATE TABLE `satpam` (
  `SatpamID` int(11) NOT NULL,
  `Nama` varchar(50) DEFAULT NULL,
  `Telepon` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `satpam`
--

INSERT INTO `satpam` (`SatpamID`, `Nama`, `Telepon`) VALUES
(1, 'Atep Suratep', '085656565656'),
(2, 'Tatang Suratang', '081008811'),
(3, 'Jajat Sudrajat', '0227515751'),
(4, 'Dadang Daradang', '12345678'),
(5, 'Tuti Tukang Tipu', '09909009'),
(6, 'Atep Suratep', '666666'),
(7, 'Nicki Minaj', '69696969');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `StaffID` int(11) NOT NULL,
  `Nama` varchar(50) DEFAULT NULL,
  `Telepon` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`StaffID`, `Nama`, `Telepon`) VALUES
(1, 'Rodiyah', '12345668');

-- --------------------------------------------------------

--
-- Table structure for table `tamu`
--

CREATE TABLE `tamu` (
  `ID` int(11) NOT NULL,
  `Nama` varchar(50) DEFAULT NULL,
  `Telepon` varchar(50) DEFAULT NULL,
  `Instansi` varchar(50) DEFAULT NULL,
  `TamuID` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tamu`
--

INSERT INTO `tamu` (`ID`, `Nama`, `Telepon`, `Instansi`, `TamuID`) VALUES
(9, 'Garmastewira', '0811221906', 'ITB', '12345'),
(10, 'Ghifari', '69240', 'ITB', '1234'),
(11, 'ggg', '00001', 'itb', '135');

-- --------------------------------------------------------

--
-- Table structure for table `transaksimahasiswaumum`
--

CREATE TABLE `transaksimahasiswaumum` (
  `TransaksiMahasiswaUmumID` int(11) NOT NULL,
  `JamMasuk` datetime DEFAULT NULL,
  `JamKeluar` datetime DEFAULT NULL,
  `Tagihan` int(11) DEFAULT NULL,
  `PetugasID` int(11) DEFAULT NULL,
  `NomorPlat` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaksimahasiswaumum`
--

INSERT INTO `transaksimahasiswaumum` (`TransaksiMahasiswaUmumID`, `JamMasuk`, `JamKeluar`, `Tagihan`, `PetugasID`, `NomorPlat`) VALUES
(1, '2017-05-04 10:45:18', '2017-05-04 10:47:07', 2000, 1, 'D2111AA'),
(2, '2017-05-04 12:43:12', '2017-05-04 12:43:20', 2000, 1, 'D1997JN');

-- --------------------------------------------------------

--
-- Table structure for table `transaksistafftamu`
--

CREATE TABLE `transaksistafftamu` (
  `TransaksiStaffTamuID` int(11) NOT NULL,
  `JamMasuk` datetime DEFAULT NULL,
  `JamKeluar` datetime DEFAULT NULL,
  `LokasiID` int(11) DEFAULT NULL,
  `PelanggaranID` int(11) DEFAULT NULL,
  `PetugasID` int(11) DEFAULT NULL,
  `StaffID` int(11) DEFAULT NULL,
  `TamuID` int(11) DEFAULT NULL,
  `Kepentingan` varchar(50) DEFAULT NULL,
  `NomorPlat` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaksistafftamu`
--

INSERT INTO `transaksistafftamu` (`TransaksiStaffTamuID`, `JamMasuk`, `JamKeluar`, `LokasiID`, `PelanggaranID`, `PetugasID`, `StaffID`, `TamuID`, `Kepentingan`, `NomorPlat`) VALUES
(12, '2017-05-04 12:28:38', '2017-05-04 12:36:55', 4, 17, 1, 1, NULL, 'Mengajar', 'D2171IX');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(50) DEFAULT NULL,
  `Password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lokasi`
--
ALTER TABLE `lokasi`
  ADD PRIMARY KEY (`LokasiID`),
  ADD KEY `SatpamID` (`SatpamID`);

--
-- Indexes for table `mahasiswaumum`
--
ALTER TABLE `mahasiswaumum`
  ADD PRIMARY KEY (`NomorPlat`);

--
-- Indexes for table `pelanggaran`
--
ALTER TABLE `pelanggaran`
  ADD PRIMARY KEY (`PelanggaranID`),
  ADD KEY `SatpamID` (`SatpamID`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`PetugasID`);

--
-- Indexes for table `satpam`
--
ALTER TABLE `satpam`
  ADD PRIMARY KEY (`SatpamID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`StaffID`);

--
-- Indexes for table `tamu`
--
ALTER TABLE `tamu`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `transaksimahasiswaumum`
--
ALTER TABLE `transaksimahasiswaumum`
  ADD PRIMARY KEY (`TransaksiMahasiswaUmumID`),
  ADD KEY `PetugasID` (`PetugasID`),
  ADD KEY `NomorPlat` (`NomorPlat`);

--
-- Indexes for table `transaksistafftamu`
--
ALTER TABLE `transaksistafftamu`
  ADD PRIMARY KEY (`TransaksiStaffTamuID`),
  ADD KEY `TamuID` (`TamuID`),
  ADD KEY `LokasiID` (`LokasiID`),
  ADD KEY `PelanggaranID` (`PelanggaranID`),
  ADD KEY `StaffID` (`StaffID`),
  ADD KEY `PetugasID` (`PetugasID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lokasi`
--
ALTER TABLE `lokasi`
  MODIFY `LokasiID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `pelanggaran`
--
ALTER TABLE `pelanggaran`
  MODIFY `PelanggaranID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `PetugasID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `satpam`
--
ALTER TABLE `satpam`
  MODIFY `SatpamID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `StaffID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tamu`
--
ALTER TABLE `tamu`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `transaksimahasiswaumum`
--
ALTER TABLE `transaksimahasiswaumum`
  MODIFY `TransaksiMahasiswaUmumID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `transaksistafftamu`
--
ALTER TABLE `transaksistafftamu`
  MODIFY `TransaksiStaffTamuID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `lokasi`
--
ALTER TABLE `lokasi`
  ADD CONSTRAINT `lokasi_ibfk_1` FOREIGN KEY (`SatpamID`) REFERENCES `satpam` (`SatpamID`);

--
-- Constraints for table `pelanggaran`
--
ALTER TABLE `pelanggaran`
  ADD CONSTRAINT `pelanggaran_ibfk_1` FOREIGN KEY (`SatpamID`) REFERENCES `satpam` (`SatpamID`);

--
-- Constraints for table `transaksimahasiswaumum`
--
ALTER TABLE `transaksimahasiswaumum`
  ADD CONSTRAINT `transaksimahasiswaumum_ibfk_1` FOREIGN KEY (`PetugasID`) REFERENCES `petugas` (`PetugasID`);

--
-- Constraints for table `transaksistafftamu`
--
ALTER TABLE `transaksistafftamu`
  ADD CONSTRAINT `transaksistafftamu_ibfk_1` FOREIGN KEY (`TamuID`) REFERENCES `tamu` (`ID`),
  ADD CONSTRAINT `transaksistafftamu_ibfk_2` FOREIGN KEY (`LokasiID`) REFERENCES `lokasi` (`LokasiID`),
  ADD CONSTRAINT `transaksistafftamu_ibfk_3` FOREIGN KEY (`PelanggaranID`) REFERENCES `pelanggaran` (`PelanggaranID`),
  ADD CONSTRAINT `transaksistafftamu_ibfk_4` FOREIGN KEY (`StaffID`) REFERENCES `staff` (`StaffID`),
  ADD CONSTRAINT `transaksistafftamu_ibfk_5` FOREIGN KEY (`PetugasID`) REFERENCES `petugas` (`PetugasID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
