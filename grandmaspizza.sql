-- phpMyAdmin SQL Dump
-- version 4.6.5
-- https://www.phpmyadmin.net/
--
-- Host: mysql.grandmaspizza.online-presence.com
-- Generation Time: Mar 11, 2017 at 10:09 AM
-- Server version: 5.6.25-log
-- PHP Version: 7.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grandmaspizza`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `Address_Id` int(11) NOT NULL,
  `Address_1` varchar(255) NOT NULL,
  `Address_2` varchar(255) DEFAULT NULL,
  `City` varchar(255) NOT NULL,
  `Postal_Code` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`Address_Id`, `Address_1`, `Address_2`, `City`, `Postal_Code`) VALUES
(2, 'Xhelal', 'Bajram', 'Rahovec', '21000'),
(3, 'Xhelal Hajda Toni', 'Bajram Veliu', 'Rahovec', '21000'),
(4, 'Xhelal Hajda Toni', '', 'Rahovec', ''),
(5, 'Xhelal Hajda', 'Bajram Veliu', 'Rahovec', ''),
(6, 'Deshmoret e Kombit', '', 'Rahovec', ''),
(7, 'Xhelal Hajda ', '', 'Rahovec', ''),
(8, 'Myhedin Zika', '', 'Rahoveciiiii', ''),
(9, 'Myhedin ', 'Zika', 'Rahovec', '21540'),
(10, 'asd', 'asd', 'asd', 'asd'),
(11, 'Xhelal Hajda Toni', 'Bajram', 'Rahovec', '21000'),
(12, 'Xhelal Hajda Toni', '', 'Rahovec', '21000'),
(13, 'Anton Harapi', 'su 2/5 llamella 5', 'prishtine', '10000'),
(14, 'Anton Harapi', 'Anton Harapi', 'Prishtine', '10000'),
(15, 'hhhh', 'aaa', 'asdasd', '21620'),
(16, 'aaa', 'bbb', 'Rahovec', '21000'),
(18, 'Test', 'Testing', 'Rahovec', '210505'),
(19, 'Lagja Kalabria', 'Banesat e Lesnes', 'Prishtina', '10000'),
(20, 'Testim', 'Testim', 'Rahovec', '21000');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`c_id`, `c_name`) VALUES
(1, 'Normal Pizza'),
(2, 'Vegeterian Pizzas'),
(5, 'Daily Offers');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `C_Id` int(11) NOT NULL,
  `C_Name` varchar(100) NOT NULL,
  `C_Email` varchar(255) NOT NULL,
  `C_Subject` varchar(255) NOT NULL,
  `C_Message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`C_Id`, `C_Name`, `C_Email`, `C_Subject`, `C_Message`) VALUES
(1, 'Myhedin', 'myhedinzika@gmail.com', 'Testing purpose', 'A123123'),
(2, 'Myhedin', 'myhedinzika@gmail.com', 'MyhedinZika', 'A123123'),
(3, 'Test@1AM', 'myhedinzika@gmail.com', 'TEST@1AM', 'Testing'),
(4, 'Test@1.01AM', 'myhedinzika@gmail.com', 'TEST@1.01AM', 'Testing'),
(5, 'tgt', 'contact@grandmapizzas.com', 'tgte', 'rtge'),
(6, 'LocalTest', 'LocalTest@gmail.com', 'Local Test', 'Local Test'),
(7, 'Myhedin', 'myhedinzika@gmail.com', 'Pershendetje', 'Testimi i Kontakt Formes'),
(8, 'Pizza', 'Test@gmail.com', 'Pizza 2', 'Pizzzzzzzzzzzza'),
(9, 'Besart', 'besartzeka@hotmail.com', 'Pershendetje', 'A ka mundesi nje pizze me madhesi 30 deri 40cm ... Ju falemnderit'),
(10, '5 Dec Test', 'myhedinzika@gmail.com', 'Test', '12312312'),
(11, 'Test', 'adsasd@adssda.com', 'Test', 'Test'),
(12, 'Test', 'myhedinzika@gmail.com', 'Test', 'Testimi i kontakt formes me ane te email'),
(13, 'Test', 'myhedinzika@gmail.com', 'Test', 'Testimi i kontakt formes me ane te email'),
(14, 'Myhedin', 'myhedinzika@gmail.com', 'Myhedin Zika', 'Testimi'),
(15, 'Myhedin', 'myhedinzika@gmail.com', 'Myhedin Zika', 'Testimi'),
(16, 'Myhedin', 'myhedinzika@gmail.com', 'Testing', 'Testing'),
(17, 'myhe', 'myhedinloves@mailinator.com', 'test', 'test'),
(18, 'Myhedin', 'myhedinzika@gmail.com', 'Testing', 'Testing'),
(19, 'Myhedin', 'myhedinzika@gmail.com', 'Testing', 'Testing'),
(20, 'myhe', 'myhedinloves@mailinator.com', 'test', 'test'),
(21, 'Myhedin', 'myhedinzika@gmail.com', 'Testing', 'AASAS'),
(22, 'Myhedin', 'myhedinzika@gmail.com', 'Testing', 'AASAS'),
(23, 'Myhedin', 'myhedinzika@gmail.com', 'Testing', 'AASASsadsa'),
(24, 'myhe', 'test@mailinator.com', 'test', 'test'),
(25, 'Myhedin', 'myhedinzika@gmail.com', 'Testing', 'Testing'),
(26, 'Myhedin', 'myhedinzika@gmail.com', 'Pershendetje ', 'Pershendetje a ka mundesi nje pice?'),
(27, 'Myhedin', 'myhedinzika@gmail.com', 'Nje testim', 'Testing this '),
(28, 'Myhedin', 'myhedinzika@gmail.com', 'Nje testim', 'Testing this '),
(29, 'Myhedin', 'myhedinzika@gmail.com', 'Nje testim', 'Testing this '),
(30, 'Myhedin', 'myhedinzika@gmail.com', 'Nje testim', 'Testing this '),
(31, 'Myhedin', 'myhedinzika@gmail.com', 'Nje testim', 'Testing this '),
(32, 'Myhedinasdaa', 'myhedinzikasad@gmail.com', 'Nje testimasdasd', 'Testing this adssad'),
(33, 'Myhedinasdaa', 'myhsadedinzikasad@gmail.com', 'Nje testimasdasd', 'Testing thiasds adssad'),
(34, 'Myhedinasdaa', 'myhsadedinzikasad@gmail.com', 'Nje testimasdasd', 'Testing thiasds adssad'),
(35, 'Myhedinasdaa', 'myhsadedinzikasad@gmail.com', 'Nje testimasdasd', 'Testing thiasds adssad'),
(36, 'Myhedinasdaa', 'myhsadedinzikasad@gmail.com', 'Nje testimasdasd', 'Testing thiasds adssad'),
(37, 'Myhedin', 'myhedinzika@gmail.com', 'Testing', 'AASASsadsa'),
(38, 'Myhedin', 'myhedin@gmail.com', 'E shtune', 'Test'),
(39, 'Myhedin', 'myhedin@gmail.com', 'E shtune', 'Test'),
(40, 'Myhedin', 'myhedin@gmail.com', 'E shtune', 'Test'),
(41, 'Myhedin', 'myhedin@gmail.com', 'E shtune', 'Test'),
(42, 'Testing', 'Test@gmail.com', 'Testing', 'Testing this thing ffs'),
(43, 'Myhedin', 'myhedinzika@gmail.com', 'Testing', 'AASASsadsa'),
(44, 'Myhedin Zika', 'myhedinzika@gmail.com', 'Pershendetje', '		Hi! My name is Myhedin Zika.\\r\\n\\r\\n		Jam duke e testuar\\r\\n\\r\\n		From Myhedin Zika\\r\\n		My email is myhedinzika@gmail.com\\r\\n'),
(45, 'Myhedin', 'myhedin@gmail.com', 'Hello', '		Hi! My name is Myhedin.\\r\\n\\r\\n		My message is: Keep up the good work \\r\\n\\r\\n		From Myhedin\\r\\n		My email is myhedin@gmail.com\\r\\n'),
(46, 'Myhedin', 'myhedinzika@gmail.com', 'Pizza Familjare', '		Hi! My name is Myhedin.\\r\\n\\r\\n		My message is: Pershendetje, a ka mundesi te shtoni si opsion Pizen Familjare!\\r\\n\\r\\nJu faleminderit\\r\\n\\r\\n		From Myhedin\\r\\n		My email is myhedinzika@gmail.com\\r\\n'),
(47, 'Grupi AWET', 'awet@ubt-uni.net', 'AWET', '		Hi! My name is Grupi AWET.\\r\\n\\r\\n		My message is: AWET SPRINTI I DYTE\\r\\n\\r\\n		From Grupi AWET\\r\\n		My email is awet@ubt-uni.net\\r\\n'),
(48, 'Myhedin ', 'myhedinzika@gmail.com', 'Pershendetje', 'Hi! My name is Myhedin .\\r\\n\\r\\nMy message is: Ky eshte veq nje testim\\r\\n\\r\\nFrom: Myhedin \\r\\nEmail: myhedinzika@gmail.com\\r\\n'),
(49, 'Test', 'adsasd@adssda.com', 'test', 'Hi! My name is Test.\\r\\n\\r\\nMy message is: test\\r\\n\\r\\nFrom: Test\\r\\nEmail: adsasd@adssda.com\\r\\n'),
(50, 'Test', 'Test@gmail.com', 'tESTING', 'Hi! My name is Test.\\r\\n\\r\\nMy message is: tEST\\r\\n\\r\\nFrom: Test\\r\\nEmail: Test@gmail.com\\r\\n'),
(51, 'test', 'adsasd@adssda.com', 'test', 'Hi! My name is test.\\r\\n\\r\\nMy message is: test\\r\\n\\r\\nFrom: test\\r\\nEmail: adsasd@adssda.com\\r\\n'),
(52, 'test', 'adsasd@adssda.com', 'test', 'Hi! My name is test.\\r\\n\\r\\nMy message is: test\\r\\n\\r\\nFrom: test\\r\\nEmail: adsasd@adssda.com\\r\\n'),
(53, 'Myhedin', 'Myhedinzika@gmail.com', 'Pershendetje', 'Hi! My name is Myhedin.\\r\\n\\r\\nMy message is: Tungjatjeta\\r\\n\\r\\nFrom: Myhedin\\r\\nEmail: Myhedinzika@gmail.com\\r\\n'),
(54, 'Tung', 'myhedinzika@gmail.com', 'Test', 'Hi! My name is Tung.\\r\\n\\r\\nMy message is: ABCDEF\\r\\n\\r\\nFrom: Tung\\r\\nEmail: myhedinzika@gmail.com\\r\\n'),
(55, 'Testing', 'Abc@gmail.com', 'Testing', 'Hi! My name is Testing.\\r\\n\\r\\nMy message is: ABCA\\r\\n\\r\\nFrom: Testing\\r\\nEmail: Abc@gmail.com\\r\\n'),
(56, 'Test', 'adsasd@adssda.com', 'aads', 'Hi! My name is Test.\\r\\n\\r\\nMy message is: dsasad\\r\\n\\r\\nFrom: Test\\r\\nEmail: adsasd@adssda.com\\r\\n'),
(57, 'Myhedin', 'myhedin@live.com', 'Testing', 'Hi! My name is Myhedin.\\r\\n\\r\\nMy message is: Testing\\r\\n\\r\\nFrom: Myhedin\\r\\nEmail: myhedin@live.com\\r\\n'),
(58, 'Testing', 'Az@test.com', 'Test', 'Hi! My name is Testing.\\r\\n\\r\\nMy message is: Test\\r\\n\\r\\nFrom: Testing\\r\\nEmail: Az@test.com\\r\\n'),
(59, 'Myhedin', 'Myhedin@facebook.com', 'Test', 'Hi! My name is Myhedin.\\r\\n\\r\\nMy message is: Testing\\r\\n\\r\\nFrom: Myhedin\\r\\nEmail: Myhedin@facebook.com\\r\\n'),
(60, 'test', 'test@rahovec.com', 'testing', 'Hi! My name is test.\\r\\n\\r\\nMy message is: testing\\r\\n\\r\\nFrom: test\\r\\nEmail: test@rahovec.com\\r\\n'),
(61, 'Testing', 'Test@twitch.tv', 'Testing', 'Hi! My name is Testing.\\r\\n\\r\\nMy message is: Testing\\r\\n\\r\\nFrom: Testing\\r\\nEmail: Test@twitch.tv\\r\\n'),
(62, 'test', 'myhedinzika@gmail.com', 'Testing', 'Hi! My name is test.\\r\\n\\r\\nMy message is: Test\\r\\n\\r\\nFrom: test\\r\\nEmail: myhedinzika@gmail.com\\r\\n'),
(63, 'test', 'mihedin_zika@hotmail.com', 'testing', 'Hi! My name is test.\\r\\n\\r\\nMy message is: .....\\r\\n\\r\\nFrom: test\\r\\nEmail: mihedin_zika@hotmail.com\\r\\n'),
(64, 'testing', 'mihedin_zika@hotmail.com', 'TEST', 'Hi! My name is testing.\\r\\n\\r\\nMy message is: TESTq\\r\\n\\r\\nFrom: testing\\r\\nEmail: mihedin_zika@hotmail.com\\r\\n'),
(65, 'test', 'myhedinzika@gmail.com', 'Testing', 'Hi! My name is test.\\r\\n\\r\\nMy message is: Test\\r\\n\\r\\nFrom: test\\r\\nEmail: myhedinzika@gmail.com\\r\\n'),
(66, 'test', 'myhedinzika@gmail.com', 'test', 'Hi! My name is test.\\r\\n\\r\\nMy message is: test\\r\\n\\r\\nFrom: test\\r\\nEmail: myhedinzika@gmail.com\\r\\n'),
(67, 'Test', 'myhedinzika@gmail.com', 'test', 'Hi! My name is Test.\\r\\n\\r\\nMy message is: test\\r\\n\\r\\nFrom: Test\\r\\nEmail: myhedinzika@gmail.com\\r\\n'),
(68, 'Test123', 'adsasd@adssda.com', 'asd', 'Hi! My name is Test123.\\r\\n\\r\\nMy message is: adsasd\\r\\n\\r\\nFrom: Test123\\r\\nEmail: adsasd@adssda.com\\r\\n'),
(69, 'asdsad', 'adsasd@adssda.com', 'asdasd', 'Hi! My name is asdsad.\\r\\n\\r\\nMy message is: adsads\\r\\n\\r\\nFrom: asdsad\\r\\nEmail: adsasd@adssda.com\\r\\n'),
(70, 'ttest', 'adsasd@adssda.com', 'aa', 'Hi! My name is ttest.\\r\\n\\r\\nMy message is: assa\\r\\n\\r\\nFrom: ttest\\r\\nEmail: adsasd@adssda.com\\r\\n'),
(71, 'Rambo', 'jon@jon.com', 'test', 'Hi! My name is Rambo.\\r\\n\\r\\nMy message is: this is my message!!!!\\r\\n\\r\\nFrom: Rambo\\r\\nEmail: jon@jon.com\\r\\n'),
(72, 'jonnnnn', 'jonnnn@rambo.co.uk', 'test 2', 'Hi! My name is jonnnnn.\\r\\n\\r\\nMy message is: test 2\\r\\n\\r\\nFrom: jonnnnn\\r\\nEmail: jonnnn@rambo.co.uk\\r\\n'),
(73, 'Test', 'adsasd@adssda.com', 'test', 'Hi! My name is Test.\\r\\n\\r\\nMy message is: test\\r\\n\\r\\nFrom: Test\\r\\nEmail: adsasd@adssda.com\\r\\n'),
(74, 'test', 'Test@gmail.com', 'test', 'Hi! My name is test.\\r\\n\\r\\nMy message is: test\\r\\n\\r\\nFrom: test\\r\\nEmail: Test@gmail.com\\r\\n'),
(75, 'test', 'Test@gmail.com', 'test', 'Hi! My name is test.\\r\\n\\r\\nMy message is: test\\r\\n\\r\\nFrom: test\\r\\nEmail: Test@gmail.com\\r\\n'),
(76, 'jon 3', 'jonny@wibbley.com', 'test 3', 'Hi! My name is jon 3.\\r\\n\\r\\nMy message is: test 3\\r\\n\\r\\nFrom: jon 3\\r\\nEmail: jonny@wibbley.com\\r\\n'),
(77, 'Bobby', 'bobby@binglybum.com', 'test 4', 'Hi! My name is Bobby.\\r\\n\\r\\nMy message is: test 4\\r\\n\\r\\nFrom: Bobby\\r\\nEmail: bobby@binglybum.com\\r\\n'),
(78, 'Myhedin', 'Myhedinzika@gmail.com', 'Test', 'Hi! My name is Myhedin.\\r\\n\\r\\nMy message is: MyhedinZika\\r\\n\\r\\nFrom: Myhedin\\r\\nEmail: Myhedinzika@gmail.com\\r\\n'),
(79, 'Myhedin', 'Myhedin@live.com', 'Test', 'Hi! My name is Myhedin.\\r\\n\\r\\nMy message is: Test\\r\\n\\r\\nFrom: Myhedin\\r\\nEmail: Myhedin@live.com\\r\\n'),
(80, 'Test', 'grandmaspizza@hotmail.com', 'Test', 'Hi! My name is Test.\\r\\n\\r\\nMy message is: Test\\r\\n\\r\\nFrom: Test\\r\\nEmail: grandmaspizza@hotmail.com\\r\\n'),
(81, 'test', 'myhedin@gmail.com', 'test', 'Hi! My name is test.\\r\\n\\r\\nMy message is: test\\r\\n\\r\\nFrom: test\\r\\nEmail: myhedin@gmail.com\\r\\n'),
(82, 'Test', 'Myhedinzika@gmail.com', 'test', 'Hi! My name is Test.\\r\\n\\r\\nMy message is: test\\r\\n\\r\\nFrom: Test\\r\\nEmail: Myhedinzika@gmail.com\\r\\n'),
(83, 'Test123', 'bobby@hotmail.com', 'bob', 'Hi! My name is Test123.\\r\\n\\r\\nMy message is: test\\r\\n\\r\\nFrom: Test123\\r\\nEmail: bobby@hotmail.com\\r\\n'),
(84, 'Myhedin', 'mihedin_zika@live.com', 'Test', 'Hi! My name is Myhedin.\\r\\n\\r\\nMy message is: Testing\\r\\n\\r\\nFrom: Myhedin\\r\\nEmail: mihedin_zika@live.com\\r\\n'),
(85, 'Jerry', 'jerry.maguire@foxstudios.com', 'Give me', 'Hi! My name is Jerry.\\r\\n\\r\\nMy message is: a prize!\\r\\n\\r\\nFrom: Jerry\\r\\nEmail: jerry.maguire@foxstudios.com\\r\\n'),
(86, 'hey', 'hey@heyhey.com', 'hey', 'Hi! My name is hey.\\r\\n\\r\\nMy message is: hey\\r\\n\\r\\nFrom: hey\\r\\nEmail: hey@heyhey.com\\r\\n'),
(87, 'bert', 'burt-reybolds@testing.com', 'hi', 'Hi! My name is bert.\\r\\n\\r\\nMy message is: mmmm pizxza\\r\\n\\r\\nFrom: bert\\r\\nEmail: burt-reybolds@testing.com\\r\\n'),
(88, 'jonwebsite', 'jon@jonw.co.uk', 'testing from pizza site', 'Hi! My name is jonwebsite.\\r\\n\\r\\nMy message is: testtttttt\\r\\n\\r\\nFrom: jonwebsite\\r\\nEmail: jon@jonw.co.uk\\r\\n'),
(89, 'Testing', 'myhedinzika@gmail.com', 'Testing', 'Hi! My name is Testing.\\n\\nMy message is: Another fucking test\\n\\nFrom: Testing\\nEmail: myhedinzika@gmail.com\\n'),
(90, 'Testing', 'myhedinzika@gmail.com', 'Testing', 'Hi! My name is Testing.\\r\\n\\r\\nMy message is: Another fucking test\\r\\n\\r\\nFrom: Testing\\r\\nEmail: myhedinzika@gmail.com\\r\\n'),
(91, 'johnny', 'testing@gmail.com', 'Test', 'Testing another time'),
(92, 'Myhedin', 'myhedinzika@gmail.com', 'Testimi i Contact Formes', 'Just a simple test if the contact form is working or not'),
(93, 'Myhedin', 'myhedinzika@gmail.com', 'Test', 'Testimi'),
(94, 'Myhedin', 'myhedinzika@gmail.com', 'Tuesday December 20', 'Testimi i kontakt formes'),
(95, 'Myhedin', 'myhedinzika@gmail.com', 'Testimi i Contact Formes', 'testimi i contact formes'),
(96, 'Myhedin', 'hs33911@ubt-uni.net', 'Test', 'Test 12312312321 :)');

-- --------------------------------------------------------

--
-- Table structure for table `dailyoffer`
--

CREATE TABLE `dailyoffer` (
  `DailyId` int(11) NOT NULL,
  `DO_Name` varchar(255) NOT NULL,
  `DO_Price` double NOT NULL,
  `PizzaFK` int(11) NOT NULL,
  `SizeFK` int(11) NOT NULL,
  `DrinksFK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dailyoffer`
--

INSERT INTO `dailyoffer` (`DailyId`, `DO_Name`, `DO_Price`, `PizzaFK`, `SizeFK`, `DrinksFK`) VALUES
(3, 'Super Deal', 6.66, 1, 2, 5),
(4, '9 AM to 11 AM', 7.55, 2, 3, 7),
(5, '9 PM to 11 PM', 6.5, 6, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `drinks`
--

CREATE TABLE `drinks` (
  `D_id` int(11) NOT NULL,
  `D_Name` varchar(255) NOT NULL,
  `D_Photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `drinks`
--

INSERT INTO `drinks` (`D_id`, `D_Name`, `D_Photo`) VALUES
(3, 'Coca Cola', 'CocaCola.png'),
(4, 'Sprite', 'Sprite.png'),
(5, 'Fanta', 'Fanta.png'),
(6, 'Multi Sola', 'Multisola.png'),
(7, 'Schweppes', 'Schweppes.png');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `g_id` int(11) NOT NULL,
  `g_title` varchar(255) NOT NULL,
  `g_description` text NOT NULL,
  `g_photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`g_id`, `g_title`, `g_description`, `g_photo`) VALUES
(24, '', 'Restaurants may be classified or distinguished in many different ways. The primary factors are usually the food itself (e.g. vegetarian, seafood, steak); the cuisine ( Italian, Chinese, Japanese, Indian, French, Mexican, Thai) and/or the style of offering (e.g. tapas bar, a sushi train, a tastet restaurant, a buffet restaurant or a yum cha restaurant).Restaurants may differentiate themselves on factors including speed (see fast food), formality, location, cost, service, or novelty themes (such as automated restaurants).\\r\\nRestaurants range from inexpensive and informal lunching or dining places catering to people working nearby, with modest food served in simple settings at low prices, to expensive establishments serving refined food and fine wines in a formal setting', '456461.png'),
(25, '', 'Customers usually wear casual clothing. In the latter case, depending on culture and local traditions, customers might wear semi-casual, semi-formal or formal wear. Typically, at mid- to high-priced restaurants, customers sit at tables, their orders are taken by a waiter, who brings the food when it is ready.\\r\\nAfter eating, the customers then pay the bill. In some restaurants, such as workplace cafeterias, there are no waiters; the customers use trays, on which they place cold items that they select from a refrigerated container and hot items which they request from cooks, and then they pay a cashier before they sit down', '744273.png'),
(26, '', 'Another restaurant approach which uses few waiters is the buffet restaurant. Customers serve food onto their own plates and then pay at the end of the meal. Buffet restaurants typically still have waiters to serve drinks and alcoholic beverages. Fast food restaurants are also considered a restaurant.\\r\\nThe travelling public has long been catered for with ship\'s messes and railway restaurant cars which are, in effect, travelling restaurants.Many railways, the world over, also cater for the needs of travellers by providing railway refreshment rooms, a form of restaurant, at railway stations. In the 2000s, a number of travelling restaurants, specifically designed for tourists, have been created. These can be found on trams, boats, buses, etc.', '546280.png'),
(27, '', 'A restaurant\'s proprietor is called a restaurateur /ËŒrÉ›stÉ™rÉ™ËˆtÉœËr/; like \'restaurant\', this derives from the French verb restaurer, meaning \"to restore\". Professional cooks are called chefs, with there being various finer distinctions (e.g. sous-chef, chef de partie). Most restaurant (other than fast food restaurants and cafeterias) will have various waiting staff to serve food, beverages and alcoholic drinks, including busboys who remove used dishes and cutlery. In finer restaurants, this may include a host or hostess, a maÃ®tre d\'hÃ´tel to welcome customers and to seat them, and a sommelier or wine waiter to help patrons select wines.In Ancient Greece and Ancient Rome, thermopolia (singular thermopolium) were small restaurant-bars that offered food and drinks to customers. A typical thermopolium had little L-shaped counters in which large storage vessels were sunk, which would contain either hot or cold food. Their popularity was linked to the lack of kitchens in many dwellings and the ease with which people could purchase prepared foods. Furthermore, eating out was considered a very important aspect of socializing', '47544.png'),
(28, '', 'In China, food catering establishments which may be described as restaurants were known since the 11th century in Kaifeng, China\'s capital during the first half of the Song dynasty (960â€“1279). Probably growing out of the tea houses and taverns that catered to travellers, Kaifeng\'s restaurants blossomed into an industry catering to locals as well as people from other regions of China.[9] There is a direct correlation between the growth of the restaurant businesses and institutions of theatrical stage drama, gambling and prostitution which served the burgeoning merchant middle class during the Song dynasty.[10] Restaurants catered to different styles of cuisine, price brackets, and religious requirements. Even within a single restaurant much choice was available, and people ordered the entree they wanted from written menus.[9] An account from 1275 writes of Hangzhou, the capital city for the last half of the dynasty:', '11848.png'),
(29, '', 'The modern idea of a restaurant â€“ as well as the term itself â€“ appeared in Paris in the 18th century.[13] For centuries Paris had taverns which served food at large common tables, but they were notoriously crowded, noisy, not very clean, and served food of dubious quality. In about 1765 a new kind of eating establishment, called a \"Bouillon\", was opened on rue des Poulies, near the Louvre, by a man named Boulanger. It had separate tables, a menu, and specialized in soups made with a base of meat and eggs, which were said to be restaurants or, in English \"restoratives\". Other similar bouillons soon opened around Paris.[14] Thanks to Boulanger and his imitators, these soups moved from the category of remedy into the category of health food and ultimately into the category of ordinary food. Their existence was predicated on health, not gustatory, requirements.[15]\\r\\n\\r\\nThe first luxury restaurant in Paris, called the Taverne Anglaise, was opened at the beginning of 1786, shortly before the French Revolution, by Antoine Beauvilliers, the former chef of the Count of Provence, at the Palais-Royal. It had mahogany tables, linen tablecloths, chandeliers, well-dressed and trained waiters, a long wine list and an extensive menu of elaborately prepared and presented dishes', '575211.png');

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `i_id` int(11) NOT NULL,
  `i_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`i_id`, `i_name`) VALUES
(1, 'Babycorn'),
(2, 'Barbeque Chicken'),
(3, 'Black Olives'),
(4, 'Capsicum'),
(5, 'Chicken Rashers'),
(6, 'Chunky Chicken'),
(7, 'Crisp Capsicum'),
(8, 'Double Barbeque Chicken'),
(9, 'Double Chicken Rashers'),
(10, 'Extra Cheese'),
(11, 'Fresh Tomato'),
(12, 'Golden Corn'),
(13, 'Hot n Spicy Chicken'),
(14, 'Jalapeno'),
(15, 'Mushroom'),
(16, 'Onion'),
(17, 'Paneer\\r\\n'),
(18, 'Red Paprika'),
(19, 'Red Pepper'),
(20, 'Spicy Chicken'),
(21, 'Yellow Bell Pepper');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `loginattempts_id` int(11) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `failedCounter` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `Order_Id` int(11) NOT NULL,
  `Total` double NOT NULL,
  `Status` varchar(100) NOT NULL,
  `Address_Id` int(11) DEFAULT NULL,
  `User_Id` int(11) NOT NULL,
  `orderDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`Order_Id`, `Total`, `Status`, `Address_Id`, `User_Id`, `orderDate`) VALUES
(27, 0, 'In_Progress', NULL, 9, '2017-01-04 20:32:13'),
(28, 24.32, 'In_Progress', 12, 48, '2016-12-16 20:32:13'),
(29, 155, 'In_Progress', 14, 48, '2017-02-05 20:32:13'),
(35, 3.5, 'Completed', 4, 48, '2017-01-18 20:32:13'),
(37, 7, 'Canceled', 3, 29, '2017-02-05 20:32:13'),
(38, 3.5, 'Completed', 4, 50, '2017-02-05 20:32:13'),
(39, 37.5, 'Canceled', 4, 50, '2017-02-05 20:32:13'),
(40, 9, 'Completed', 3, 29, '2017-02-05 20:32:13'),
(41, 3.5, 'Canceled', 3, 29, '2017-02-05 20:32:13'),
(42, 0, 'Canceled', NULL, 50, '2017-02-05 20:32:13'),
(43, 3.5, 'Canceled', 18, 50, '2017-02-05 20:32:13'),
(44, 0, 'Canceled', NULL, 50, '2017-02-05 20:32:13'),
(45, 42.5, 'Pending', 19, 50, '2017-02-05 20:32:13'),
(46, 0, 'Canceled', NULL, 29, '2017-02-06 22:52:15'),
(49, 3.5, 'Pending', 20, 29, '2017-02-06 23:04:26'),
(50, 0, 'Canceled', NULL, 29, '2017-02-06 23:07:57'),
(51, 3.5, 'Pending', 3, 29, '2017-02-06 23:13:22'),
(52, 14, 'Pending', 20, 29, '2017-02-07 09:48:15'),
(53, 0, 'In_Progress', NULL, 10, '2017-02-08 10:15:33'),
(54, 6, 'Pending', 3, 29, '2017-02-08 12:24:47'),
(55, 0, 'In_Progress', NULL, 50, '2017-02-08 13:26:24'),
(56, 0, 'In_Progress', NULL, 29, '2017-02-10 23:46:16');

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `OrderProductsId` int(11) NOT NULL,
  `Size` int(11) DEFAULT NULL,
  `Quantity` int(11) NOT NULL,
  `Order_IdFK` int(11) NOT NULL,
  `Pizza_IdFK` int(11) DEFAULT NULL,
  `DailyIdFK` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`OrderProductsId`, `Size`, `Quantity`, `Order_IdFK`, `Pizza_IdFK`, `DailyIdFK`) VALUES
(23, 1, 1, 27, 1, NULL),
(24, 1, 1, 27, 2, NULL),
(25, 2, 2, 28, 1, NULL),
(26, NULL, 2, 28, NULL, 3),
(27, 1, 0, 29, 1, NULL),
(28, 3, 3, 29, 1, NULL),
(29, 3, 20, 29, 2, NULL),
(30, 1, 1, 27, 1, NULL),
(31, 1, 1, 29, 2, NULL),
(45, 1, 1, 35, 1, NULL),
(48, 1, 1, 37, 1, NULL),
(49, 1, 1, 38, 1, NULL),
(51, 1, 10, 39, 1, NULL),
(53, 1, 1, 39, 2, NULL),
(55, 1, 1, 37, 1, NULL),
(56, 1, 1, 40, 1, NULL),
(57, 1, 1, 40, 2, NULL),
(58, 1, 1, 40, 3, NULL),
(59, 1, 1, 41, 1, NULL),
(60, 1, 1, 42, 1, NULL),
(61, 1, 1, 42, 2, NULL),
(62, 1, 1, 43, 1, NULL),
(63, 1, 1, 44, 1, NULL),
(65, 1, 5, 45, 3, NULL),
(66, 1, 11, 45, 6, NULL),
(67, 1, 2, 46, 1, NULL),
(72, 1, 1, 49, 1, NULL),
(73, 1, 1, 50, 1, NULL),
(74, 1, 1, 51, 1, NULL),
(76, 1, 4, 52, 1, NULL),
(78, 1, 1, 53, 1, NULL),
(79, 1, 1, 53, 1, NULL),
(81, 1, 1, 55, 1, NULL),
(83, 1, 1, 54, 1, NULL),
(84, 1, 1, 54, 2, NULL),
(85, 1, 1, 56, 1, NULL),
(86, 1, 2, 53, 1, NULL),
(87, 1, 1, 27, 1, NULL),
(88, 1, 5, 53, 1, NULL),
(89, 1, 6, 53, 2, NULL),
(90, 2, 1, 56, 1, NULL),
(91, 3, 2, 56, 1, NULL),
(92, 1, 3, 56, 8, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `Payments_Id` int(11) NOT NULL,
  `Failed` int(11) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Order_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pizza`
--

CREATE TABLE `pizza` (
  `p_id` int(11) NOT NULL,
  `p_name` varchar(255) NOT NULL,
  `p_photo` varchar(255) NOT NULL,
  `Category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pizza`
--

INSERT INTO `pizza` (`p_id`, `p_name`, `p_photo`, `Category`) VALUES
(1, 'Grandmas Pizza', '167735.png', 1),
(2, 'Non Veg Suprem', 'NonVegSupreme.png', 1),
(3, 'Chicken Golden Delight', 'ChickenGoldenDelight.png', 1),
(4, 'Chunky Fiesta', 'Chunkyfiesta.png', 1),
(5, 'Seventh Heaven', 'SeventhHeaven.png', 1),
(6, 'Chef\'s Chicken Choise\\r\\n', 'ChefsChickenChoice.png', 1),
(7, 'Margherita', 'Margherita.png', 2),
(8, 'Deluxe Veggie', 'Deluxeveggie.png', 2),
(9, 'Country Special', 'Countryspecial.png', 2),
(10, 'Cloud 9', 'Cloud9.png', 2),
(11, 'Veggie Paradise', 'VeggieParadise.png', 2),
(12, 'Farm House', 'Farmhouse.png', 2);

-- --------------------------------------------------------

--
-- Table structure for table `pizza_ingredient`
--

CREATE TABLE `pizza_ingredient` (
  `pizza` int(11) NOT NULL,
  `ingredient` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pizza_ingredient`
--

INSERT INTO `pizza_ingredient` (`pizza`, `ingredient`) VALUES
(10, 1),
(11, 1),
(2, 2),
(5, 2),
(1, 3),
(2, 3),
(6, 3),
(11, 3),
(4, 4),
(6, 5),
(1, 6),
(2, 6),
(4, 6),
(2, 7),
(6, 7),
(8, 7),
(9, 7),
(10, 7),
(11, 7),
(12, 7),
(3, 8),
(1, 9),
(5, 9),
(1, 10),
(3, 10),
(7, 10),
(9, 11),
(10, 11),
(12, 11),
(3, 12),
(8, 12),
(2, 13),
(5, 14),
(10, 14),
(1, 15),
(2, 15),
(8, 15),
(12, 15),
(2, 16),
(4, 16),
(5, 16),
(8, 16),
(9, 16),
(10, 16),
(12, 16),
(8, 17),
(10, 17),
(6, 18),
(11, 18),
(5, 19),
(4, 20),
(5, 21);

-- --------------------------------------------------------

--
-- Table structure for table `pizza_size`
--

CREATE TABLE `pizza_size` (
  `pizza` int(11) NOT NULL,
  `size` int(11) NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pizza_size`
--

INSERT INTO `pizza_size` (`pizza`, `size`, `price`) VALUES
(1, 1, 3.5),
(1, 2, 5.5),
(1, 3, 7.5),
(2, 1, 2.5),
(2, 2, 4.5),
(2, 3, 6.5),
(3, 1, 3),
(3, 2, 5),
(3, 3, 7),
(4, 1, 2.5),
(4, 2, 4.5),
(4, 3, 6.5),
(5, 1, 3),
(5, 2, 5),
(5, 3, 7),
(6, 1, 2.5),
(6, 2, 4.5),
(6, 3, 6.5),
(7, 1, 1.5),
(7, 2, 3.5),
(7, 3, 4.5),
(8, 1, 2.5),
(8, 2, 4.5),
(8, 3, 6.5),
(9, 1, 3),
(9, 2, 5),
(9, 3, 7),
(10, 1, 2.5),
(10, 2, 4.5),
(10, 3, 6.5),
(11, 1, 2),
(11, 2, 4),
(11, 3, 6),
(12, 1, 2),
(12, 2, 4),
(12, 3, 6);

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `diameter` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`id`, `name`, `diameter`) VALUES
(1, 'Small', 20),
(2, 'Medium', 30),
(3, 'Large', 40);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `userSurname` varchar(100) NOT NULL,
  `userEmail` varchar(255) NOT NULL,
  `userPassword` varchar(255) NOT NULL,
  `userGender` char(1) NOT NULL,
  `userPhone` varchar(50) NOT NULL,
  `userStatus` int(11) NOT NULL,
  `tokenCode` varchar(100) NOT NULL,
  `userAdmin` int(11) NOT NULL,
  `joining_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `userName`, `userSurname`, `userEmail`, `userPassword`, `userGender`, `userPhone`, `userStatus`, `tokenCode`, `userAdmin`, `joining_date`) VALUES
(9, 'Bledar', 'Dakaj', 'bd35191@ubt-uni.net', '$2y$10$RL5qsras1orALpjUX14MQOdcpcgTF1jqP6SmJHxe1M.9ub.5VH6EC', 'M', '049598005', 1, 'a226386307d2ffddade4020a076492f0', 1, '2016-12-16 13:11:07'),
(10, 'Bleona', 'Gjocaj', 'bg35196@ubt-uni.net', '$2y$10$ELjoDP9V5jkWIlFFAjahW.w/00wuKXM3AuAMWyG63zmcVizAyjQEy', 'F', '044269095', 1, 'ae2dc68b9b49bc78fca25b72e271089e', 1, '2016-12-16 13:11:07'),
(29, 'Myhedin', 'Zika', 'myhedinzika@gmail.com', '$2y$10$ggJkZgq.PIl2lFNPiKudU.UEujonwE1yqLvkMWfKETyZt8/gfIOxa', 'M', '+37745983982', 1, '50513cf08274b467f19f7738f914f8a4', 0, '2016-12-16 21:18:19'),
(48, 'Kenan', 'Durguti', 'kdurguti9@gmail.com', '$2y$10$wMujqgOideIpFY1aSufrkeIgV9CFPPeWRQY5QD9o6nDd.cpMDhV7C', 'M', '1231233', 1, '9de6d96fc68aa05893b8ed23b989346a', 0, '2017-01-09 17:28:44'),
(49, 'Hakan', 'Shehu', 'hakan.shehu@ubt-uni.net', '$2y$10$qZ0JgS7SUWxXuf36JAFJjOhDokbhNNZCoYTPLJ/B.FYB6xjrsVPRS', 'M', '123456', 1, '61b1088254b48f43bba4ec889a3bb048', 0, '2017-01-17 21:48:42'),
(50, 'Myhedin', 'Zika', 'mz33396@ubt-uni.net', '$2y$10$cy8/qninRMO6DdCHCjIGveA17/eW79.5uFrRpbbhTc7QASJQcr5AG', 'M', '37745983982', 1, '5cbd255517fe31fc901279bd62032776', 2, '2017-02-04 23:47:38'),
(51, 'Besart', 'Zeka', 'besartzeka@hotmail.com', '$2y$10$KmUAmolc5yWxRbr2yhjfTepYPAh82RqrIDiM1y.pkdvMfZHdmohZO', 'M', '0037744505500', 1, '490331f12652446bc2de02b52b428dcb', 3, '2017-02-05 23:27:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`Address_Id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`C_Id`);

--
-- Indexes for table `dailyoffer`
--
ALTER TABLE `dailyoffer`
  ADD PRIMARY KEY (`DailyId`),
  ADD KEY `PizzaFK` (`PizzaFK`,`SizeFK`,`DrinksFK`),
  ADD KEY `SizeFK` (`SizeFK`),
  ADD KEY `DrinksFK` (`DrinksFK`);

--
-- Indexes for table `drinks`
--
ALTER TABLE `drinks`
  ADD PRIMARY KEY (`D_id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`g_id`);

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`i_id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`loginattempts_id`),
  ADD UNIQUE KEY `ip` (`ip`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Order_Id`),
  ADD KEY `Address_Id` (`Address_Id`),
  ADD KEY `User_Id` (`User_Id`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`OrderProductsId`),
  ADD KEY `DailyIdFK` (`DailyIdFK`),
  ADD KEY `PizzaIDFK` (`Pizza_IdFK`),
  ADD KEY `OrderIdFK` (`Order_IdFK`),
  ADD KEY `Size` (`Size`),
  ADD KEY `Size_2` (`Size`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`Payments_Id`),
  ADD KEY `Order_Id` (`Order_Id`);

--
-- Indexes for table `pizza`
--
ALTER TABLE `pizza`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `pizza_fk0` (`Category`);

--
-- Indexes for table `pizza_ingredient`
--
ALTER TABLE `pizza_ingredient`
  ADD PRIMARY KEY (`pizza`,`ingredient`),
  ADD KEY `pizza_ingredient_fk1` (`ingredient`);

--
-- Indexes for table `pizza_size`
--
ALTER TABLE `pizza_size`
  ADD PRIMARY KEY (`pizza`,`size`),
  ADD KEY `pizza_size_fk1` (`size`);

--
-- Indexes for table `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `userEmail` (`userEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `Address_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `C_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;
--
-- AUTO_INCREMENT for table `dailyoffer`
--
ALTER TABLE `dailyoffer`
  MODIFY `DailyId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `drinks`
--
ALTER TABLE `drinks`
  MODIFY `D_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `g_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `i_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `loginattempts_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `Order_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `OrderProductsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `Payments_Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pizza`
--
ALTER TABLE `pizza`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `size`
--
ALTER TABLE `size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `dailyoffer`
--
ALTER TABLE `dailyoffer`
  ADD CONSTRAINT `DrinksFK` FOREIGN KEY (`DrinksFK`) REFERENCES `drinks` (`D_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `PizzaFK` FOREIGN KEY (`PizzaFK`) REFERENCES `pizza` (`p_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `SizeFK` FOREIGN KEY (`SizeFK`) REFERENCES `size` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `AddressIdFK` FOREIGN KEY (`Address_Id`) REFERENCES `address` (`Address_Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `UserIdFK` FOREIGN KEY (`User_Id`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_products`
--
ALTER TABLE `order_products`
  ADD CONSTRAINT `DailyIDFK` FOREIGN KEY (`DailyIdFK`) REFERENCES `dailyoffer` (`DailyId`) ON DELETE CASCADE,
  ADD CONSTRAINT `OrderIDFK` FOREIGN KEY (`Order_IdFK`) REFERENCES `orders` (`Order_Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `OrderSize` FOREIGN KEY (`Size`) REFERENCES `size` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `PizzaIDFK` FOREIGN KEY (`Pizza_IdFK`) REFERENCES `pizza` (`p_id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `POrderIDFK` FOREIGN KEY (`Order_Id`) REFERENCES `orders` (`Order_Id`) ON DELETE CASCADE;

--
-- Constraints for table `pizza`
--
ALTER TABLE `pizza`
  ADD CONSTRAINT `pizza_fk0` FOREIGN KEY (`Category`) REFERENCES `category` (`c_id`) ON DELETE CASCADE;

--
-- Constraints for table `pizza_ingredient`
--
ALTER TABLE `pizza_ingredient`
  ADD CONSTRAINT `pizza_ingredient_fk0` FOREIGN KEY (`pizza`) REFERENCES `pizza` (`p_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pizza_ingredient_ibfk_1` FOREIGN KEY (`ingredient`) REFERENCES `ingredients` (`i_id`) ON DELETE CASCADE;

--
-- Constraints for table `pizza_size`
--
ALTER TABLE `pizza_size`
  ADD CONSTRAINT `pizza_size_fk0` FOREIGN KEY (`pizza`) REFERENCES `pizza` (`p_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pizza_size_fk1` FOREIGN KEY (`size`) REFERENCES `size` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
