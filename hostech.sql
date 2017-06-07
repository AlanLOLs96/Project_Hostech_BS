-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2017 at 11:03 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hostech`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_details`
--

CREATE TABLE `admin_details` (
  `admin_no` int(4) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(300) NOT NULL,
  `fullname` varchar(30) NOT NULL,
  `role` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_details`
--

INSERT INTO `admin_details` (`admin_no`, `username`, `password`, `fullname`, `role`) VALUES
(1, 'domK', '*832EB84CB764129D05D498ED9CA7E5CE9B8F83EB', 'Dominic Karikattil', 'admin'),
(2, 'abyV', '*832EB84CB764129D05D498ED9CA7E5CE9B8F83EB', 'Aby Vargehese', 'admin'),
(3, 'rubenT', '*832EB84CB764129D05D498ED9CA7E5CE9B8F83EB', 'Ruben Thotupuram', 'admin'),
(4, 'alanL', '*832EB84CB764129D05D498ED9CA7E5CE9B8F83EB', 'Alan Lal', 'asist'),
(5, 'shibuG', '*832EB84CB764129D05D498ED9CA7E5CE9B8F83EB', 'Shibu George', 'asist');

-- --------------------------------------------------------

--
-- Table structure for table `complaint_details`
--

CREATE TABLE `complaint_details` (
  `comp_no` int(11) NOT NULL,
  `admno` int(11) NOT NULL,
  `roomno` int(11) NOT NULL,
  `complaint_type` varchar(20) NOT NULL,
  `description` varchar(300) NOT NULL,
  `complaint_date` date NOT NULL,
  `fixing_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complaint_details`
--

INSERT INTO `complaint_details` (`comp_no`, `admno`, `roomno`, `complaint_type`, `description`, `complaint_date`, `fixing_date`) VALUES
(1, 6936, 839, 'Furniture', 'Bed Leg Broke', '2017-04-25', '2017-04-25'),
(2, 6813, 945, 'Plumbing', 'water droping on my roomates head', '2017-04-25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `inmate_contacts`
--

CREATE TABLE `inmate_contacts` (
  `admno` int(11) NOT NULL,
  `inmate_phone` bigint(10) NOT NULL,
  `parent_phone` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inmate_contacts`
--

INSERT INTO `inmate_contacts` (`admno`, `inmate_phone`, `parent_phone`) VALUES
(6516, 9953879343, 9811241207),
(6549, 9995774976, 9847485279),
(6554, 9541104914, 9656045415),
(6563, 7736762025, 8606707108),
(6573, 8156924102, 9447302563),
(6581, 9633089281, 9811788414),
(6582, 9548867362, 9447828512),
(6589, 7034449836, 9656304248),
(6600, 974664204, 9447560575),
(6616, 9447329412, 8281122609),
(6621, 9526592826, 9447566410),
(6629, 9605122356, 9895561760),
(6634, 7034477344, 9947057233),
(6635, 9446912441, 9447326663),
(6637, 954474006, 9961088797),
(6656, 9349035190, 9388035190),
(6664, 9961418715, 9605925941),
(6671, 8129055064, 9447403515),
(6696, 9946822933, 9447578728),
(6699, 9497303471, 9495333471),
(6710, 9495181302, 9447808402),
(6717, 9995805005, 96899348212),
(6723, 8281091385, 9447242196),
(6777, 9497709232, 9656615194),
(6797, 9945645679, 9946157394),
(6801, 9048489009, 9447209787),
(6813, 8547963327, 9497321429),
(6827, 7559044599, 9447044599),
(6842, 9567870659, 9495042163),
(6851, 8086171434, 9947963183),
(6857, 8547902725, 9526814272),
(6858, 755923060, 9961684675),
(6865, 7559083445, 9544712060),
(6872, 7025858862, 9447980991),
(6880, 7559955907, 9048713777),
(6897, 9061651303, 7559092013),
(6915, 9496940415, 9400694415),
(6917, 7025903001, 9747915082),
(6923, 9847029052, 9995898530),
(6933, 8606534572, 9847658228),
(6936, 9656331482, 9605681027),
(6937, 9495759466, 9447359055),
(6942, 9207461808, 9847186976),
(6945, 7025044030, 9446197417),
(6952, 9061558945, 8281283463),
(6962, 8129888083, 9447295742),
(6967, 967168212, 9447828512),
(6969, 7025557103, 9446124024),
(6975, 8281436572, 9961183252),
(6978, 7559034403, 9447540429),
(6986, 9946842099, 9947650532),
(6994, 9958455438, 9947145400);

-- --------------------------------------------------------

--
-- Table structure for table `inmate_details`
--

CREATE TABLE `inmate_details` (
  `admno` int(4) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(300) NOT NULL,
  `fullname` varchar(30) NOT NULL,
  `gender` char(1) NOT NULL,
  `semester` int(2) NOT NULL,
  `branch` char(3) NOT NULL,
  `roomno` char(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inmate_details`
--

INSERT INTO `inmate_details` (`admno`, `username`, `password`, `fullname`, `gender`, `semester`, `branch`, `roomno`) VALUES
(6516, 'anu6516', '*7FA757A8ECD0FF4409CD74BB369491FE9C1420AD', 'Anu Abraham', 'M', 6, 'CSE', '798'),
(6549, 'athul6549', '*BF69CBAFE2C147E4418FB9FE348F0EA9B7369AEC', 'Athul Jacob Mathew', 'M', 6, 'EEE', '998'),
(6554, 'abin6554', '*6118B0384644FCD458E14C60E2389E695B63208E', 'Abin James', 'M', 6, 'CSE', '945'),
(6563, 'delna6563', '*777D5B74F06BF050F9E7C17A7CAB1106B81961A5', 'Delna Rose Johnson', 'F', 6, 'EEE', '149'),
(6573, 'amanta6573', '*272849DB99CF10A36EFD6771C99FC4E2F02EBEF8', 'Amanta Sunny', 'F', 6, 'CSE', '234'),
(6581, 'ashish6581', '*571CA2318995CBD2924394EB476AFE046333B66E', 'Ashish Johnson', 'M', 6, 'CSE', '945'),
(6582, 'arun6582', '*D4C0381A88F6795E86FC51AEC4AE7EA88A34C807', 'Arun Nagath Chandrasekharan', 'M', 6, 'CHE', '944'),
(6589, 'jesly6589', '*4E28B1473323C46627E483366A2EE62B0876874F', 'Jesly Jose', 'F', 6, 'ECE', '199'),
(6600, 'bony6600', '*A35914B7A9C3E910D6804C097D9251028D7195F3', 'Bony Feriah', 'M', 6, 'ECE', '600'),
(6616, 'chippy6616', '*D43E4F2EC3FF1ADB0F3193C054B7ECCDDAC5816B', 'Chippy Johnson', 'F', 6, 'CHE', '556'),
(6621, 'anie6621', '*786FCD4C1932579A303184F617E4DB56EFADAAB0', 'Anie Joshan', 'F', 4, 'EEE', '235'),
(6629, 'anand6629', '*84CB9C94C220E6329185DEE63AF05F62A6820380', 'Anand Anil', 'M', 4, 'CSE', '798'),
(6634, 'anagha6634', '*E7E2D0A08B5992E233522522950F81A0763578BE', 'Anagha James', 'F', 4, 'EEE', '324'),
(6635, 'jeena6635', '*75E19E1AD2AAA03A7533A63AE0F18EF72E0225E2', 'Jeena M Jacob', 'F', 6, 'ECE', '231'),
(6637, 'aiswarya6637', '*30EF2438C9B5AE4437DE56CAEFCC5A847677C831', 'Aiswarya Sathayadas', 'F', 4, 'CHE', '132'),
(6656, 'aswin6656', '*1D3C66BAD4CD7CD4B05D4E70F0F910422AF8B625', 'Aswin B Nair', 'M', 4, 'EEE', '976'),
(6664, 'honey6664', '*E2B2E899C1C552208A9E80CDF77356BDA2FE5045', 'Honey Mol Sebastian', 'F', 6, 'CSE', '323'),
(6671, 'jibu6671', '*05B23E0F25C3236C1ED81B94DC3276C2AB4EC3B7', 'Jibu Varghese Philip', 'M', 6, 'CSE', '998'),
(6696, 'antony6696', '*45426741647BF94369390FDBA95DA13EB171BCAA', 'Antony Varkey', 'M', 4, 'CHE', '600'),
(6699, 'akhila6699', '*030B6CFE0EDBCC78288149503B0F2175ED55F7DD', 'Akhila Sebastian', 'F', 4, 'ECE', '443'),
(6710, 'athul6710', '*7D4E608DB4EDDE774F29597AA7BE62DFE7B06128', 'Athul Tony Manuel', 'M', 4, 'EEE', '839'),
(6717, 'fareeda6717', '*457EA39CEC70552F4EFA795608D6D7DB430F3677', 'Fareeda Rahim P A', 'F', 6, 'CSE', '234'),
(6723, 'anju6723', '*834B8C6BE1B23747732B36319B8E384E5B86C0EE', 'Anju Vijayakumar', 'F', 4, 'CHE', '132'),
(6777, 'blosom6777', '*297CEDB858B55743D845FF5AAF31A12ED0A87D32', 'Blosom Ann Jose', 'F', 6, 'CHE', '445'),
(6797, 'jini6797', '*7F2664809B5417F603D9BFACAC07083449B376AF', 'Jini Jacob', 'F', 6, 'ECE', '231'),
(6801, 'alex6801', '*A0CCF67D40E3DC6B38EDE04C6B9FBC1FCBB71858', 'Alex Jose', 'M', 4, 'ECE', '792'),
(6813, 'abin6813', '*E371060D6ECF9C7633544B5AB43928EF57077C0D', 'Abin Anil Varghese', 'M', 4, 'CHE', '945'),
(6827, 'angel6827', '*9F7B87A4249720DC4FA1623B0557510802887B44', 'Angel Rose', 'F', 4, 'EEE', '235'),
(6842, 'aleesha6842', '*1989910B44217CE03F6ABFEDA6A00DCEA70B36F0', 'Aleesha Philip', 'F', 4, 'CSE', '323'),
(6851, 'anto6851', '*177CE7C60239A6C5218CBFB55B03CBDE763929EB', 'Anto Bose', 'M', 4, 'EEE', '900'),
(6857, 'ann6857', '*617D1052A88DE729652ED1971343E73F885CEED5', 'Ann Maria Alex', 'F', 4, 'EEE', '444'),
(6858, 'ajin6858', '*54AFD7B54CFF41EACF9D644FBCBC1E97CD7C998B', 'Ajin Thomas', 'M', 4, 'ECE', '743'),
(6865, 'anoop6865', '*7C821A7861D7F24F080AA57156A44F88BE327B97', 'Anoop Varghese', 'M', 4, 'CSE', '600'),
(6872, 'akash6872', '*961354053FDCF4A7FB5F7BB45D26D20F4531F493', 'Akash T A', 'M', 8, 'CSE', '792'),
(6880, 'christopher6880', '*832FA1DDDD2C3D80EB08DEB359085C1D49FF472C', 'Christopher Henry Jacob', 'M', 8, 'CHE', '798'),
(6897, 'akash6897', '*E34C94C182E4C82C77E3B8EFAAB64BE3FBF060F0', 'Akash Reji', 'M', 8, 'ECE', '944'),
(6915, 'deepak6915', '*4C078CF5C4F10C66FF5FD4263D7A833CC3E8A607', 'Deepak Thalian', 'M', 8, 'ECE', '678'),
(6917, 'femin6917', '*B8048DF29835630375C10AE17590753FA4F96842', 'Femin James', 'F', 8, 'CHE', '149'),
(6923, 'athira6923', '*3E95D2E57FE1967121951230427D726F5AB09828', 'Athira Mary Ivan', 'F', 8, 'CHE', '110'),
(6933, 'annie6933', '*7A331FF108F2553315DBC269D7D4877A17FEB6CC', 'Annie Elizabeth', 'F', 8, 'ECE', '445'),
(6936, 'alan6936', '*1DC54B5835F493A5354B9880AF091EE12736676B', 'Alan Lal', 'M', 8, 'CHE', '839'),
(6937, 'ann6937', '*D48F18D31A4B75233D45CF57010D66AC3C6F4714', 'Ann Maria Stanley', 'F', 8, 'EEE', '556'),
(6942, 'jeena6942', '*9D859BBB8FC853820E31D5A5081ECE1E0F6046F0', 'Jeena Jacob', 'F', 2, 'ECE', '446'),
(6945, 'anju6945', '*19301CA6FE9211D871518BFE3CD73551E789C4AF', 'Anju Abraham', 'F', 2, 'CHE', '326'),
(6952, 'achumol6952', '*038FC4C6A99491438F7B744F4EFABB19593054C4', 'Achumol Abraham', 'F', 2, 'ECE', '443'),
(6962, 'derin6962', '*85606265D121CD925EBDE85E44E7E9FB6A5D6CEA', 'Derin Jose', 'M', 2, 'EEE', '839'),
(6967, 'akhil6967', '*06CBE2FF212A25C8C01DA18AB956A481CDA726B2', 'Akhil Nagath Chandrasekharan', 'M', 2, 'EEE', '998'),
(6969, 'dhanusree6969', '*FAB87AA4D56B888EFB3E692E1B08A5859F2136C5', 'Dhanusree M S', 'F', 2, 'ECE', '446'),
(6975, 'ann6975', '*4C8C6E054DCB8EDA8761D94D43DDECAF297DA5BC', 'Ann Maria Sebastian', 'F', 2, 'ECE', '444'),
(6978, 'amal6978', '*20F4A5F3252E4B802635A11A47F32D63CCB53720', 'Amal Jacob Mathew', 'M', 2, 'ECE', '792'),
(6986, 'anu6986', '*2314C18AE0F38708ACFEDA47949BCD23DA3FEF99', 'Anu Cherian', 'F', 2, 'EEE', '110'),
(6994, 'david6994', '*ACD241C24507A309D3D598CD4C2856A707962E77', 'David Joseph Thomas', 'M', 2, 'CSE', '976');

-- --------------------------------------------------------

--
-- Table structure for table `outpass_details`
--

CREATE TABLE `outpass_details` (
  `pass_no` int(4) NOT NULL,
  `admno` int(4) NOT NULL,
  `issue_date` date NOT NULL,
  `destination` varchar(100) NOT NULL,
  `purpose` varchar(100) NOT NULL,
  `leaving_date` date NOT NULL,
  `leaving_time` time NOT NULL,
  `return_date` date NOT NULL,
  `return_time` time NOT NULL,
  `warden_approval` tinyint(1) NOT NULL DEFAULT '0',
  `warden_reject` int(1) NOT NULL DEFAULT '0',
  `return_confirm` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sick_leave_details`
--

CREATE TABLE `sick_leave_details` (
  `leave_no` int(4) NOT NULL,
  `admno` int(4) NOT NULL,
  `roomno` int(3) NOT NULL,
  `date_applied` date NOT NULL,
  `reason` mediumtext NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `seen` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sick_leave_details`
--

INSERT INTO `sick_leave_details` (`leave_no`, `admno`, `roomno`, `date_applied`, `reason`, `start_time`, `end_time`, `seen`) VALUES
(1, 6936, 839, '2017-04-26', 'Chikun Gunia', '09:00:00', '16:30:00', 1),
(2, 6813, 945, '2017-04-25', 'Head Ache', '08:59:00', '16:00:00', NULL),
(3, 6582, 944, '2017-04-25', 'heavy fever', '09:30:00', '17:30:00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_details`
--
ALTER TABLE `admin_details`
  ADD PRIMARY KEY (`admin_no`);

--
-- Indexes for table `complaint_details`
--
ALTER TABLE `complaint_details`
  ADD PRIMARY KEY (`comp_no`),
  ADD KEY `admno` (`admno`);

--
-- Indexes for table `inmate_contacts`
--
ALTER TABLE `inmate_contacts`
  ADD PRIMARY KEY (`admno`);

--
-- Indexes for table `inmate_details`
--
ALTER TABLE `inmate_details`
  ADD PRIMARY KEY (`admno`);

--
-- Indexes for table `outpass_details`
--
ALTER TABLE `outpass_details`
  ADD PRIMARY KEY (`pass_no`),
  ADD KEY `admno` (`admno`);

--
-- Indexes for table `sick_leave_details`
--
ALTER TABLE `sick_leave_details`
  ADD PRIMARY KEY (`leave_no`),
  ADD KEY `roomno` (`roomno`),
  ADD KEY `admno` (`admno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `complaint_details`
--
ALTER TABLE `complaint_details`
  MODIFY `comp_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `outpass_details`
--
ALTER TABLE `outpass_details`
  MODIFY `pass_no` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sick_leave_details`
--
ALTER TABLE `sick_leave_details`
  MODIFY `leave_no` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `complaint_details`
--
ALTER TABLE `complaint_details`
  ADD CONSTRAINT `complaint_details_ibfk_1` FOREIGN KEY (`admno`) REFERENCES `inmate_details` (`admno`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inmate_contacts`
--
ALTER TABLE `inmate_contacts`
  ADD CONSTRAINT `foreign key details-contacts` FOREIGN KEY (`admno`) REFERENCES `inmate_details` (`admno`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `outpass_details`
--
ALTER TABLE `outpass_details`
  ADD CONSTRAINT `outpass_details_ibfk_1` FOREIGN KEY (`admno`) REFERENCES `inmate_details` (`admno`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sick_leave_details`
--
ALTER TABLE `sick_leave_details`
  ADD CONSTRAINT `sick_leave_details_ibfk_1` FOREIGN KEY (`admno`) REFERENCES `inmate_details` (`admno`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
