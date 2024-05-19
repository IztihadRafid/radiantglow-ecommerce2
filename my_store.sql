-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2024 at 11:30 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_table`
--

CREATE TABLE `admin_table` (
  `admin_id` int(11) NOT NULL,
  `admin_username` varchar(100) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_table`
--

INSERT INTO `admin_table` (`admin_id`, `admin_username`, `admin_email`, `admin_password`) VALUES
(4, 's', 's@gmail.com', '$2y$10$Q5o2Qd8TU66hhrWV7NIMT.OBpxtn4RQdB.MEBlKRLWjvB5SkXj1Lu'),
(5, 'nigar', 'nigar@gmail.com', '$2y$10$EjmOX/lYaAznN2uCTBDheOYpXzFtpu2sbdNRqWcIGgVibP/ZHn70e');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_title`) VALUES
(2, 'David Beckham'),
(3, 'Ajmal'),
(4, 'Hemes'),
(5, 'Havoc'),
(6, 'XStudios'),
(7, 'Herbal Essences'),
(9, 'Vaseline'),
(23, 'Nivea');

-- --------------------------------------------------------

--
-- Table structure for table `cart_details`
--

CREATE TABLE `cart_details` (
  `product_id` int(11) NOT NULL,
  `ip_address` varchar(100) NOT NULL,
  `quantity` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_title`) VALUES
(1, 'Skincare'),
(2, 'Perfumes'),
(3, 'Hair care'),
(8, 'Oral Care');

-- --------------------------------------------------------

--
-- Table structure for table `orders_pending`
--

CREATE TABLE `orders_pending` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `invoice_number` int(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(255) NOT NULL,
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders_pending`
--

INSERT INTO `orders_pending` (`order_id`, `user_id`, `invoice_number`, `product_id`, `quantity`, `order_status`) VALUES
(7, 2, 1284302735, 13, 1, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_title` varchar(100) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_keywords` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `product_image1` varchar(255) NOT NULL,
  `product_image2` varchar(255) NOT NULL,
  `product_image3` varchar(255) NOT NULL,
  `product_price` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_title`, `product_description`, `product_keywords`, `category_id`, `brand_id`, `product_image1`, `product_image2`, `product_image3`, `product_price`, `date`, `status`) VALUES
(1, 'Ajmal Sacrifice Perfume', 'Ajmal Sacrifice Perfume by Ajmal, Launched in 2007, Ajmal Sacrifice for Her is a white floral fragrance that is especially beautiful at night in cooler months. Jasmine is the star of this perfume, the sweet floral top note alongside water notes. The middl', 'Ajmal Sacrifice Perfume,perfume,ajmal,sacrifice', 2, 3, 'Ajmal Sacrifice Perfume1.jpg', 'ajmal sacrifice perfume2.jpg', 'Ajmal Sacrifice Perfume3.jpg', '2070', '2024-04-07 08:03:38', 'true'),
(2, 'Ajmal Violet Musc Perfume', 'Ajmal Violet Musc Perfume by Ajmal, Ajmal Violet Musc is a powdery, floral fragrance with sensual hints of musk and wood accords. Launched in 2015 as a part of the M Series collection, this perfume was created using raw, high-quality materials, resulting ', 'Ajmal Violet Musc Perfume,perfume,ajmal,violet,musc', 2, 3, 'Ajmal Violet Musc Perfume2.jpg', 'Ajmal Violet Musc Perfume.jpg', 'Ajmal Violet Musc Perfume3.jpg', '1600', '2024-05-17 16:01:52', 'true'),
(3, 'Herbal Essences BioRenew Hydrate Shampoo', 'Herbal Essences, Shampoo and Conditioner Kit with Natural Source Ingredients, Color Safe, Bio Renew Coconut Milk, 20.2 fl oz, Kit', 'Herbal Essences, shampoo, conditioner, hair', 3, 7, 'Herbal Essences, Shampoo and Paraben Free Conditioner Kit1.jpg', 'Herbal Essences, Shampoo and Paraben Free Conditioner Kit2.jpg', 'Herbal Essences, Shampoo and Paraben Free Conditioner Kit1.jpg', '1600', '2024-04-07 08:31:04', 'true'),
(4, 'Vaseline Men Anti Acne Face Wash', 'Vaseline Men Anti Acne Face Wash - 100g is a perfect product for men who are suffering from acne and oily face. It makes your face clean but also helps to reduce access to oil, restore damaged skin, and enhance overall skin condition. It targets acne bact', 'vaseline, men, face wash,skin', 1, 9, 'vaseline face wash1.jpg', 'vaseline men face wash2.jpg', 'vaseline face wash1.jpg', '370', '2024-05-17 18:10:20', 'true'),
(5, 'Vaseline Radiant X DEEP  body cream', 'An ultra-nourishing body cream, enriched with 100% pure Shea Butter, Coconut Oil, Vitamin C and Peptides. Vaseline® Radiant X Deep Nourishment Body Cream provides intense moisturization, leaving the skin noticeably softer, smoother, and radiant.', 'vaseline, cream, body, radiant, nourish', 1, 9, 'vaseline nourish body cream1.jpg', 'vaseline nourish body cream2.jpg', 'vaseline nourish body cream1.jpg', '352', '2024-05-17 18:11:33', 'true'),
(6, 'Vaseline Radiant X deep body Lotion', 'The new Vaseline® Radiant X Even Tone is a nourishing body lotion enriched with 1% Niacinamide to even skin tone and Ultra-Hydrating lipds to fortify skin barrier. It is also enriched with Coconut Oil, Vitamin C and Peptides. Experience 72-hour moisture, ', 'vaseline, body, lotion, nourish, radiant', 1, 9, 'vaseline body lotion1.jpg', 'vaseline body lotion2.jpg', 'vaseline body lotion1.jpg', '475', '2024-05-17 18:21:08', 'true'),
(7, 'Vaseline intensive Care Almond Smooth Lotion', 'The new Vaseline® Intensive Care™ Almond Smooth Lotion with Almond Oil is created with Vitamin E for smooth, hydrated skin. Its fast-drying formula makes it an ideal daily lotion for dry skin, helping to keep your skin looking healthy and nourished.', 'vaseline, lotion, body, almond, smooth', 1, 8, 'vaseline smooth lotion body lotion1.jpg', 'vaseline smooth body lotion2.jpg', 'vaseline smooth lotion body lotion1.jpg', '560', '2024-04-08 07:23:20', 'true'),
(8, 'Vaseline body oil', 'Harness the glowing power of our new Vaseline® Radiant X Replenishing Body Oil, formulated with 1% Lipids, Jojoba, Coconut Oil and Vitamin E. With a combination of deeply nourishing ingredients that works harmoniously to provide skin hydration, it will le', 'vaseline, oil, body', 1, 8, 'vaseline radiant body oil1.jpg', 'vaseline radiant body oil2.jpg', 'vaseline radiant body oil1.jpg', '500', '2024-04-08 07:42:52', 'true'),
(9, 'Vaseline Skin Care Lotion', 'A Vaseline® body lotion for sensitive skin, co-created with dermatologists and formulated using colloidal oatmeal and ultra-hydrating lipids to provide long-lasting and soothing moisture – 88% more moisture compared to untreated skin – from the first use', 'vaseline, skin, lotion', 1, 9, 'vaseline sensitive skin lotion1.jpg', 'vaseline sensitive skin lotion1.jpg', 'vaseline sensitive skin lotion1.jpg', '350', '2024-05-17 18:20:16', 'true'),
(10, 'Havoc Silver Perfume Spray', 'Havoc Silver Perfume Spray is a premium fragrance that exudes sophistication and luxury. Made in the U.K, this fragrance is now available in Bangladesh and is perfect for both men and women. The sleek and stylish bottle contains 75ml of perfume, making it', 'havoc, spray, body, perfume', 2, 5, 'Havoc Silver Deodorant Body Spray1.jpg', 'Havoc Silver Deodorant Body Spray2.jpg', 'Havoc Silver Deodorant Body Spray1.jpg', '460', '2024-04-08 07:50:14', 'true'),
(11, 'Havoc Gold Perfume Spray', 'Havoc Gold Perfume Spray is an iconic perfume spray. It is a unisex spray that can be used as a cologne and a body spray. This spray comes with an elegant powdery mossy aldehydic green chypre floral fragrance. This is a retro combination of faint musk and', 'havoc, body, spray, perfume', 2, 5, 'Havoc Gold Deodorant Body Spray1.jpg', 'Havoc Gold Deodorant Body Spray.jpg', 'Havoc Gold Deodorant Body Spray1.jpg', '600', '2024-04-08 07:52:07', 'true'),
(12, 'Nivea Oil Infused Lotion', 'NIVEA Oil Infused Lotion with Coconut Scent & Monoi Oil absorbs quickly and transforms dry skin into beautifully nourished skin', 'nivea, lotion, body, oil', 1, 23, 'Nivea OIL INFUSED LOTION1.jpg', 'nivea OIL INFUSED LOTION2.jpg', 'Nivea OIL INFUSED LOTION1.jpg', '430', '2024-05-18 09:11:04', 'true'),
(13, 'Nivea Orchid & Argan Oil Infused Lotion', 'Orchid & Argan Oil Infused Body Lotion transforms dry skin into radiant, soft skin with a lovely Orchid scent', 'oil, nivea, body, lotion', 1, 1, 'nivea ORCHID & ARGAN OIL INFUSED LOTION1.jpg', 'nivea ORCHID & ARGAN OIL INFUSED LOTION1.jpg', 'nivea ORCHID & ARGAN OIL INFUSED LOTION1.jpg', '560', '2024-04-08 08:00:10', 'true'),
(14, 'Nivea Maximum Hydration', 'Caring body wash w/ Aloe Vera for long-lasting moisture: NIVEA MEN Maximum Hydration Body Wash', 'nivea, body, oil', 1, 23, 'nivea maximum hydration1.jpg', 'nivea maximum hydration1.jpg', 'nivea maximum hydration1.jpg', '800', '2024-05-18 09:12:16', 'true'),
(15, 'Nivea Deep Clean Shave Gel', 'Leaves skin feeling clean while providing an exceptional close shave. Formulated with Natural Charcoal and has a masculine Vanilla & Bourbon scent.', 'nivea, body, skin, shave,gel', 1, 1, 'DEEP CLEAN SHAVE SHAVING GEL.jpg', 'DEEP CLEAN SHAVE SHAVING GEL.jpg', 'DEEP CLEAN SHAVE SHAVING GEL.jpg', '475', '2024-04-08 08:04:07', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `user_orders`
--

CREATE TABLE `user_orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount_due` int(255) NOT NULL,
  `invoice_number` int(255) NOT NULL,
  `total_products` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_orders`
--

INSERT INTO `user_orders` (`order_id`, `user_id`, `amount_due`, `invoice_number`, `total_products`, `order_date`, `order_status`) VALUES
(7, 2, 0, 1913544745, 0, '2024-05-18 08:39:46', 'pending'),
(8, 2, 560, 1284302735, 1, '2024-05-18 08:41:21', 'pending'),
(9, 2, 460, 1908476006, 1, '2024-05-18 08:43:24', 'Complete'),
(10, 2, 1600, 1134462633, 1, '2024-05-18 08:54:16', 'pending'),
(11, 2, 1600, 2142603509, 1, '2024-05-18 08:54:33', 'pending'),
(13, 2, 1600, 1195676385, 1, '2024-05-18 08:57:24', 'pending'),
(14, 2, 1600, 1820632447, 1, '2024-05-18 08:57:42', 'pending'),
(15, 2, 460, 53851230, 1, '2024-05-18 08:58:20', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `user_payments`
--

CREATE TABLE `user_payments` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `invoice_number` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_payments`
--

INSERT INTO `user_payments` (`payment_id`, `order_id`, `invoice_number`, `amount`, `payment_mode`, `date`) VALUES
(2, 9, 1908476006, 460, 'Cash On Delivery', '2024-05-18 08:43:24');

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_image` varchar(255) NOT NULL,
  `user_ip` varchar(100) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `user_mobile` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`user_id`, `username`, `user_email`, `user_password`, `user_image`, `user_ip`, `user_address`, `user_mobile`) VALUES
(2, 'honey', 'h@gmail.com', '$2y$10$7rwhsxXWsH6wJX6miW2iSut7yypkB2Cu30U6PL9OyGKwigTXK3veG', 'depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg', '::1', 'sdf', 234234);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_table`
--
ALTER TABLE `admin_table`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `orders_pending`
--
ALTER TABLE `orders_pending`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `user_orders`
--
ALTER TABLE `user_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `user_payments`
--
ALTER TABLE `user_payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_table`
--
ALTER TABLE `admin_table`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders_pending`
--
ALTER TABLE `orders_pending`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user_orders`
--
ALTER TABLE `user_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user_payments`
--
ALTER TABLE `user_payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
