-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 03, 2022 at 10:51 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.0.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myadmin`
--

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `directory` varchar(100) NOT NULL,
  `date` varchar(50) NOT NULL,
  `added_by` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `judgement`
--

CREATE TABLE `judgement` (
  `id` int(11) NOT NULL,
  `case_number` varchar(50) NOT NULL,
  `case_name` varchar(255) NOT NULL,
  `Judge` varchar(100) NOT NULL,
  `heard_date` varchar(50) NOT NULL,
  `delivered_date` varchar(50) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `court` varchar(100) NOT NULL,
  `year` varchar(20) NOT NULL,
  `judgement_number` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `judgement`
--

INSERT INTO `judgement` (`id`, `case_number`, `case_name`, `Judge`, `heard_date`, `delivered_date`, `url`, `court`, `year`, `judgement_number`, `user_id`) VALUES
(7, '', 'Sphamandla Nkambule v The World', 'S. Nkambule', 'Oct 31, 2022', 'Oct 29, 2022', './webfiles/judgements/7.pdf', '2', '2022', 1, 1),
(8, '', 'Sphamandla Nkambule v The World', 'S. Nkambule', 'Oct 31, 2022', 'Oct 29, 2022', './webfiles/judgements/8.pdf', '2', '2022', 2, 1),
(9, '', 'Sphamandla Nkambule v The World', 'S. Nkambule', 'Oct 31, 2022', 'Oct 29, 2022', './webfiles/judgements/9.pdf', '3', '2022', 1, 1),
(10, '', 'Sphamandla Nkambule v The World', 'S. Nkambule', 'Oct 31, 2022', 'Oct 29, 2022', './webfiles/judgements/10.pdf', '3', '2022', 2, 1),
(11, '', 'Sphamandla Nkambule v The World', 'S. Nkambule', 'Oct 31, 2022', 'Oct 29, 2022', './webfiles/judgements/11.pdf', '1', '2022', 1, 1),
(12, '', 'Sphamandla Nkambule v The World', 'S. Nkambule', 'Oct 31, 2022', 'Oct 29, 2022', './webfiles/judgements/12.pdf', '2', '2022', 3, 1),
(13, '', 'Mind v Mind', 'T. Dlamini', 'Nov 01, 2022', 'Nov 04, 2022', NULL, 'High Court', '2022', 1, 1),
(14, '', 'I v Me', 'Self', 'Nov 01, 2022', 'Nov 04, 2022', NULL, 'High Court', '2022', 2, 1),
(15, '', 'I v Me', 'Self', 'Nov 01, 2022', 'Nov 04, 2022', NULL, 'High Court', '2022', 3, 1),
(16, '', '', '', '', '', NULL, '', '', 1, 1),
(17, '', 'test v test', 'T. Dlamini', 'Nov 01, 2022', 'Nov 06, 2022', NULL, 'High Court', '2022', 4, 1),
(18, '10 of 2020', 'test2', 'test ', 'Nov 02, 2022', 'Nov 07, 2022', NULL, 'High Court', '2022', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `judges`
--

CREATE TABLE `judges` (
  `id` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `court` varchar(50) NOT NULL,
  `img` varchar(100) NOT NULL,
  `added_by` varchar(50) NOT NULL,
  `join_date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `judges`
--

INSERT INTO `judges` (`id`, `Name`, `position`, `court`, `img`, `added_by`, `join_date`) VALUES
(2, 'Sphamandla Nkambule', 'Hon. Justice', 'High Court', 'webfiles/defaults/Judges/JUDGE.png', 'sphamandla', '2022-07-26');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `date` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `phone`, `date`, `message`, `status`) VALUES
(2, 'Banele Sibandze', 'banele@gmail.com', '76543210', '22-07-2022', 'Strong people can have weak moments. Even the strongest believers still struggle. Everyone has places of brokenness, a thorn that they’re dealing with. But what if your thorn is there so you realize that you need God’s wisdom in your life? That you won’t find what you need in the north, the south, the east, or the west, but from the Lord', 1);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `date` varchar(50) NOT NULL,
  `time` varchar(10) NOT NULL,
  `added_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `message`, `date`, `time`, `added_by`) VALUES
(3, '', '<h1 class=\"pg-headline\">Italian Prime Minister Mario Draghi resigns as coalition collapses</h1>\n<p><img src=\"https://cdn.cnn.com/cnnnext/dam/assets/220721093448-draghi-mattarella-072122-exlarge-169.jpg\" alt=\"\" width=\"780\" height=\"438\"></p>\n<div class=\"pg-rail-tall__head js-pg-rail-tall__head\">\n<section id=\"large-media\" class=\"zn zn-large-media zn-body zn--idx-0 zn--ordinary zn-has-one-container\" data-eq-pts=\"xsmall: 0, medium: 460, large: 780, full16x9: 1100\" data-vr-zone=\"zone-0-0\" data-zone-label=\"headerMedia\" data-containers=\"1\" data-zn-id=\"large-media\" data-eq-state=\"xsmall medium large\">\n<div class=\"l-container\">\n<div class=\"media__caption el__gallery_image-title\">\n<div class=\"element-raw appearance-standard\"><span style=\"text-decoration: underline;\"><em>Italy\'s Prime Minister Mario Draghi (R) submitted his resignation to Italy\'s President Sergio Mattarella at the Quirinale presidential palace in Rome on Thursday.</em></span></div>\n</div>\n</div>\n</section>\n</div>\n<div class=\"pg-rail-tall__body\">\n<section id=\"body-text\" class=\"zn zn-body-text zn-body zn--idx-0 zn--ordinary zn-has-multiple-containers zn-has-13-containers\" data-eq-pts=\"xsmall: 0, medium: 460, large: 780, full16x9: 1100\" data-vr-zone=\"zone-1-0\" data-zone-label=\"bodyText\" data-containers=\"13\" data-zn-id=\"body-text\" data-eq-state=\"xsmall medium large\">\n<div class=\"l-container\">\n<div class=\"el__leafmedia el__leafmedia--sourced-paragraph\">\n<p class=\"zn-body__paragraph speakable\" data-paragraph-id=\"paragraph_7E2D30D2-4B85-B553-207A-1F842F98D046\"><cite class=\"el-editorial-source\">Rome, Italy (CNN)</cite>Italian Prime Minister Mario Draghi submitted his resignation to President Sergio Mattarella on Thursday,&nbsp;<del></del>plunging the European Union\'s third-largest economy into fresh political turmoil.</p>\n</div>\n<div class=\"zn-body__paragraph\" data-paragraph-id=\"paragraph_6D515006-4EE9-885B-B372-1F8791BC6A95\">Draghi\'s resignation comes after several key parties in his coalition -- the powerful 5-Star movement, the largest party in the country\'s coalition government, center-right Forza Italia and the far-right League -- boycotted a confidence vote in the government Wednesday night.</div>\n<div class=\"zn-body__paragraph\" data-paragraph-id=\"paragraph_F8CEF591-2918-D5EB-C868-1FF7C19EA944\">Mattarella, who accepted the resignation, is scheduled to meet with the speakers of Parliament on Thursday afternoon, the presidential palace said in a statement. The next step is to call for a snap election.</div>\n<div class=\"ad ad--epic ad--tablet\" data-ad-text=\"show\">\n<div data-ad-id=\"ad_nat_btf_01\" data-ad-position=\"tablet\" data-ad-refresh=\"default\">&nbsp;</div>\n</div>\n<div class=\"ad ad--epic ad--desktop\" data-ad-text=\"show\">\n<div data-ad-id=\"ad_nat_btf_01\" data-ad-position=\"desktop\" data-ad-refresh=\"default\">&nbsp;</div>\n</div>\n<div class=\"zn-body__paragraph\" data-paragraph-id=\"paragraph_8E986FAF-88B5-4D3C-8D7D-1FF1B03CE878\">Last week, Draghi first tendered his resignation after the 5-Star movement withdrew its support in a parliamentary confidence vote on a package designed to tackle Italy\'s cost-of-living crisis. Draghi had previously said that he would not lead a government that did not include 5-Star.</div>\n<div class=\"zn-body__paragraph\" data-paragraph-id=\"paragraph_234141B7-8E58-1F2A-C11F-1FEC62525FFB\">That resignation, however, was rejected by Italy\'s President Sergio Mattarella, who urged him to stay and find a solution.</div>\n<div class=\"zn-body__read-all\">\n<div class=\"zn-body__paragraph\" data-paragraph-id=\"paragraph_9EAD98D5-8D44-3597-547A-1FEA77501E43\">On Thursday, the FTSEMIB, Italy\'s main stock market, was down more than 2.5% after the country\'s government was left on the brink of collapse.</div>\n<div class=\"zn-body__paragraph\" data-paragraph-id=\"paragraph_9EAD98D5-8D44-3597-547A-1FEA77501E43\">&nbsp;</div>\n<div class=\"zn-body__paragraph\" data-paragraph-id=\"paragraph_9EAD98D5-8D44-3597-547A-1FEA77501E43\"><img src=\"https://cdn.cnn.com/cnnnext/dam/assets/220721093929-02-draghi-parliament-072122-exlarge-169.jpg\" alt=\"\" width=\"780\" height=\"438\"></div>\n<div class=\"zn-body__paragraph\" data-paragraph-id=\"paragraph_9EAD98D5-8D44-3597-547A-1FEA77501E43\">\n<div class=\"zn-body__read-all\">\n<div class=\"el__embedded el__embedded--fullwidth\">\n<div class=\"el__image--fullwidth js__image--fullwidth\">\n<div>\n<div class=\"media__caption el__gallery_image-title\">\n<div class=\"element-raw appearance-fullwidth\"><em>Italy\'s Prime Minister Mario Draghi addresses to the lower house of parliament ahead of a vote of confidence in Rome on Wednesday.</em></div>\n</div>\n</div>\n</div>\n</div>\n<div class=\"zn-body__paragraph\" data-paragraph-id=\"paragraph_8506C41A-44D4-CD52-CAA3-1FF98329DD39\">&nbsp;</div>\n</div>\n<p class=\"zn-body__paragraph zn-body__footer\">CNN\'s Sharon Braithwaite contributed reporting.</p>\n</div>\n</div>\n</div>\n</section>\n</div>', '21 Jul 2022', '14 : 22', 'sphamandla');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `Fullname` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `role` varchar(50) NOT NULL,
  `img` varchar(100) NOT NULL,
  `join_date` varchar(50) NOT NULL,
  `state` varchar(20) NOT NULL,
  `create_by` varchar(50) NOT NULL,
  `online_offline` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `Fullname`, `gender`, `email`, `password`, `role`, `img`, `join_date`, `state`, `create_by`, `online_offline`) VALUES
(1, 'root', 'Sphamandla Nkambulee', 'male', '', '5d5b024200e3d57bfcf639c339266fdc', 'Administrator', './webfiles/users/pp/1.png', '00-00-0000', 'active', 'self', 1),
(2, 'sphamandla', 'Sphamandla Nkambule', '', 'nkambulesphamandla@gmail.com', '730509ed42d9c48bd89ba3ebba1d767f', '', './webfiles/users/pp/2.jpg', '20 July 2022', 'active', 'root', 1),
(4, 'f_user', 'test user 2', 'Female', '', '5d5b024200e3d57bfcf639c339266fdc', 'Secritery', './webfiles/users/pp/4.png', '21 July 2022', 'inactive', 'sphamandla', 1),
(5, 'john', 'John Doe', 'Male', 'johndoe@gmail.com', '5d5b024200e3d57bfcf639c339266fdc', 'Clerk', './webfiles/defaults/m_avator.png', '21 July 2022', 'inactive', 'sphamandla', 1),
(7, 'Tester ', 'Tester ', 'Female', 'malindzia.n123@gmail.com', '9e80a49d2feef8bea5d1a80c5cb4890a', 'Secritery', './webfiles/defaults/f_avator.png', '3 November 2022', 'active', 'root', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `judgement`
--
ALTER TABLE `judgement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `judges`
--
ALTER TABLE `judges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `judgement`
--
ALTER TABLE `judgement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `judges`
--
ALTER TABLE `judges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
