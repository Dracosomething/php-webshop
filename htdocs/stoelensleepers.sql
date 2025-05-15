-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2025 at 02:13 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12
SET
  SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

START TRANSACTION;

SET
  time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;

/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;

/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;

/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stoelensleepers`
--
-- --------------------------------------------------------
--
-- Table structure for table `carts`
--
CREATE TABLE
  `carts` (
    `ID` int (255) NOT NULL,
    `customer_id` int (255) NOT NULL,
    `ordered` tinyint (1) NOT NULL DEFAULT 0
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `carts`
--
INSERT INTO
  `carts` (`ID`, `customer_id`, `ordered`)
VALUES
  (36, 1, 0);

-- --------------------------------------------------------
--
-- Table structure for table `cart_items`
--
CREATE TABLE
  `cart_items` (
    `ID` int (255) NOT NULL,
    `order_id` int (255) NOT NULL,
    `product_id` tinyint (1) NOT NULL,
    `amount` int (50) NOT NULL
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `cart_items`
--
INSERT INTO
  `cart_items` (`ID`, `order_id`, `product_id`, `amount`)
VALUES
  (17, 36, 7, 7),
  (18, 36, 2, 9);

-- --------------------------------------------------------
--
-- Table structure for table `categories`
--
CREATE TABLE
  `categories` (
    `ID` int (255) NOT NULL,
    `name` varchar(50) NOT NULL
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--
INSERT INTO
  `categories` (`ID`, `name`)
VALUES
  (1, 'chairs'),
  (2, 'chair draggers');

-- --------------------------------------------------------
--
-- Table structure for table `orders`
--
CREATE TABLE
  `orders` (
    `ID` int (255) NOT NULL,
    `customer_id` int (255) NOT NULL,
    `order_date` date NOT NULL
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- --------------------------------------------------------
--
-- Table structure for table `order_items`
--
CREATE TABLE
  `order_items` (
    `ID` int (255) NOT NULL,
    `order_id` int (255) NOT NULL,
    `product_id` int (255) NOT NULL,
    `amount` int (50) NOT NULL
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- --------------------------------------------------------
--
-- Table structure for table `products`
--
CREATE TABLE
  `products` (
    `ID` int (255) NOT NULL,
    `name` varchar(50) NOT NULL,
    `description` varchar(250) NOT NULL,
    `price` float NOT NULL,
    `image` varchar(50) NOT NULL,
    `categorie_id` int (255) NOT NULL
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `products`
--
INSERT INTO
  `products` (
    `ID`,
    `name`,
    `description`,
    `price`,
    `image`,
    `categorie_id`
  )
VALUES
  (
    1,
    'Professional Chair',
    'The perfect chair for an profesional chair dragger',
    35.2,
    './img/chair_advanced.png',
    1
  ),
  (
    2,
    'Beginners Chair',
    'A very simple chair, every beginner uses this.',
    10.11,
    './img/chair_beginner.png',
    1
  ),
  (
    3,
    'Advanced Chair',
    'A simple yet comfy chair. Very usefull if your experienced at chair pulling.',
    20,
    './img/chair_middle.png',
    1
  ),
  (
    4,
    'Deluxe Chair',
    'This chair is for comfort and not designed to be pulled.',
    100.4,
    './img/chair_deluxe.png',
    1
  ),
  (
    5,
    'Gerard',
    'Gerard is our best selling chair puller. He use the highly comfortable Simple Blue Chair. Gerard loves his job.',
    40.25,
    './img/gerard.png',
    2
  ),
  (
    7,
    'jerry',
    'The always cheerful jerry will take your chair everywhere. Be it high mountains or low canyons. Not the most expensive to buy but still a good chair puller. Jerry uses the unique Wooden Chair.',
    15,
    './img/jerry.png',
    2
  ),
  (
    8,
    'Simple Blue Chair',
    'This beautiful blue chair does not only look comfortable but also is comfortable. For just €20,35 the Simple Blue Chair can be yours. It\'s design a combination of a more classical chair with a more modern chair. It\'s made from a nice material so it w',
    20.35,
    './img/blue_chair_comfy.png',
    1
  ),
  (
    9,
    'Wooden Chair',
    'This simple and classic chair design never fails to be comfortable. It will always be a nice option for beginners.',
    12.56,
    './img/wood_chair.png',
    1
  ),
  (
    10,
    'klaas',
    'This enthusiastic new rookie of ours will take your chair anywhere. While he might be new to the job, he still is a great choice. He uses our great beginner chair.',
    13.24,
    './img/klaas.png',
    2
  ),
  (
    11,
    'Jan Willem',
    'This fine gentleman ones pulled the kings throne. While he might be a bid expensive it`s worth it. He uses our greatest chair, the deluxe chair and will take you anywhere.',
    100.99,
    './img/jan_willem.png',
    2
  ),
  (
    12,
    'joppie',
    'While he doesnt look very happy, we assure you that he is still a great chair puller. HE uses our advanced chair.',
    20.23,
    './img/joppie.png',
    2
  ),
  (
    13,
    'joop',
    'This is our professional chair puller. He even takes part in competitions. He is fast and can catch up with anyone. Rumours say that he even pulled usane bolds chair. He uses our Proffesional chair',
    23,
    './img/joop.png',
    2
  );

-- --------------------------------------------------------
--
-- Table structure for table `users`
--
CREATE TABLE
  `users` (
    `ID` int (255) NOT NULL,
    `first_name` varchar(50) NOT NULL,
    `infix` varchar(15) DEFAULT NULL,
    `last_name` varchar(50) NOT NULL,
    `street_name` varchar(55) NOT NULL,
    `street_name_addon` varchar(5) DEFAULT NULL,
    `house_number` int (10) NOT NULL,
    `zipcode` varchar(50) NOT NULL,
    `city` varchar(50) NOT NULL,
    `email` varchar(50) NOT NULL,
    `password` varchar(250) NOT NULL
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `users`
--
INSERT INTO
  `users` (
    `ID`,
    `first_name`,
    `infix`,
    `last_name`,
    `street_name`,
    `street_name_addon`,
    `house_number`,
    `zipcode`,
    `city`,
    `email`,
    `password`
  )
VALUES
  (
    1,
    'lars',
    '',
    'falk',
    'eenstraat',
    '',
    12,
    '6721 EA',
    'Zuidhorn',
    'larsfalk08@gmail.com',
    '123456789'
  ),
  (
    39,
    '1',
    '',
    '1',
    '1',
    '',
    1,
    '1',
    '1',
    '1@gmail.com',
    '1'
  ),
  (
    40,
    '1',
    '',
    '1',
    '1',
    '',
    1,
    '1',
    '1',
    '1@gmail.com',
    '1'
  );

--
-- Indexes for dumped tables
--
--
-- Indexes for table `carts`
--
ALTER TABLE `carts` ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items` ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories` ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders` ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items` ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products` ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users` ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--
--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts` MODIFY `ID` int (255) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 37;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items` MODIFY `ID` int (255) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 19;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories` MODIFY `ID` int (255) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders` MODIFY `ID` int (255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items` MODIFY `ID` int (255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products` MODIFY `ID` int (255) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users` MODIFY `ID` int (255) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 41;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;