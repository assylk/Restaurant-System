-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 12 fév. 2024 à 20:25
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `restaurantdb`
--

-- --------------------------------------------------------

--
-- Structure de la table `Accounts`
--

CREATE TABLE `Accounts` (
  `account_id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `register_date` date DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Accounts`
--

INSERT INTO `Accounts` (`account_id`, `email`, `register_date`, `phone_number`, `password`) VALUES
(1, 'admin@admin.com', '2024-01-28', '111111111', 'admin'),
(12, 'assylchk@gmail.com', '2024-01-28', '56309545', 'Assylchk0'),
(13, 'hazem@gmail.com', '2024-02-10', '432334234', 'Assylchk0');

-- --------------------------------------------------------

--
-- Structure de la table `Bills`
--

CREATE TABLE `Bills` (
  `bill_id` int(11) NOT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  `reservation_id` int(11) DEFAULT NULL,
  `table_id` int(11) DEFAULT NULL,
  `card_id` int(11) DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `bill_time` datetime DEFAULT NULL,
  `payment_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Bills`
--

INSERT INTO `Bills` (`bill_id`, `staff_id`, `member_id`, `reservation_id`, `table_id`, `card_id`, `payment_method`, `bill_time`, `payment_time`) VALUES
(1, 1, 1, 1920241, 1, NULL, 'cash', '2024-01-22 18:22:06', '2024-01-22 18:23:15'),
(2, 1, 1, 1920244, 2, NULL, 'cash', '2024-01-22 18:24:17', '2024-01-22 18:34:02'),
(3, 1, 1, 1020245, 2, NULL, 'cash', '2024-01-28 19:56:34', '2024-01-28 20:16:25'),
(4, NULL, NULL, NULL, 8, NULL, NULL, '2024-01-28 20:42:22', NULL),
(5, 1, 1, 2020241, 8, 12, 'card', '2024-01-28 20:42:31', '2024-01-28 20:43:22'),
(6, NULL, NULL, NULL, 7, NULL, NULL, '2024-01-28 21:12:55', NULL),
(7, NULL, NULL, NULL, 3, NULL, NULL, '2024-01-28 21:13:11', NULL),
(8, NULL, NULL, NULL, 4, NULL, NULL, '2024-01-28 21:13:17', NULL),
(9, NULL, NULL, NULL, 5, NULL, NULL, '2024-01-28 21:13:26', NULL),
(10, NULL, NULL, NULL, 6, NULL, NULL, '2024-01-28 21:13:36', NULL),
(11, NULL, NULL, NULL, 9, NULL, NULL, '2024-01-28 21:13:42', NULL),
(12, NULL, NULL, NULL, 10, NULL, NULL, '2024-01-28 21:13:47', NULL),
(13, 1, 1, 2020241, 2, NULL, 'cash', '2024-01-28 22:19:39', '2024-01-28 22:20:38'),
(14, NULL, NULL, NULL, 7, NULL, NULL, '2024-01-28 22:23:35', NULL),
(15, 1, 1, 1221, 7, NULL, 'cash', '2024-01-28 22:23:40', '2024-01-28 22:25:08'),
(16, 1, 2, 2020241, 3, 13, 'card', '2024-02-10 19:32:44', '2024-02-10 19:35:39'),
(17, 1, 2, 2020241, 1, 14, 'card', '2024-02-11 12:42:27', '2024-02-11 13:30:51'),
(18, 1, 2, 2020241, 6, 15, 'card', '2024-02-11 13:31:15', '2024-02-11 13:33:41'),
(19, NULL, NULL, NULL, 2, NULL, NULL, '2024-02-11 13:36:19', NULL),
(20, 1, 2, 2020241, 2, NULL, 'cash', '2024-02-11 13:36:22', '2024-02-11 13:49:13');

-- --------------------------------------------------------

--
-- Structure de la table `Bill_Items`
--

CREATE TABLE `Bill_Items` (
  `bill_item_id` int(11) NOT NULL,
  `bill_id` int(11) DEFAULT NULL,
  `item_id` varchar(6) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Bill_Items`
--

INSERT INTO `Bill_Items` (`bill_item_id`, `bill_id`, `item_id`, `quantity`) VALUES
(1, 1, '1', 7),
(3, 2, '1', 3),
(4, 3, '1', 5),
(7, 4, '1', 1),
(8, 5, '1', 4),
(9, 6, '1', 2),
(10, 13, 'B1', 1),
(11, 13, 'O2', 1),
(12, 15, 'B2', 3),
(13, 7, 'B1', 2),
(14, 7, 'B3', 2),
(15, 16, 'B1', 2),
(16, 16, 'B3', 3),
(17, 17, 'B1', 2),
(18, 10, 'B1', 3),
(19, 18, 'B1', 3),
(20, 20, 'D1', 3);

-- --------------------------------------------------------

--
-- Structure de la table `card_payments`
--

CREATE TABLE `card_payments` (
  `card_id` int(11) NOT NULL,
  `account_holder_name` varchar(255) NOT NULL,
  `card_number` varchar(16) NOT NULL,
  `expiry_date` varchar(7) NOT NULL,
  `security_code` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `card_payments`
--

INSERT INTO `card_payments` (`card_id`, `account_holder_name`, `card_number`, `expiry_date`, `security_code`) VALUES
(12, 'azdzdaz', '223232132213232', '11/2030', '122'),
(13, 'Hazem', '1212323321221212', '03/2026', '234'),
(14, 'zaz', '1212323321221212', '12/2024', '122'),
(15, 'dazz', '1212323321221212', '11/2030', '122');

-- --------------------------------------------------------

--
-- Structure de la table `Kitchen`
--

CREATE TABLE `Kitchen` (
  `kitchen_id` int(11) NOT NULL,
  `table_id` int(11) DEFAULT NULL,
  `item_id` varchar(6) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `time_submitted` datetime DEFAULT NULL,
  `time_ended` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Kitchen`
--

INSERT INTO `Kitchen` (`kitchen_id`, `table_id`, `item_id`, `quantity`, `time_submitted`, `time_ended`) VALUES
(1, 1, '1', 3, '2024-01-22 18:22:18', '2024-01-28 19:56:28'),
(2, 2, '1', 1, '2024-01-22 18:24:25', '2024-01-28 19:56:29'),
(3, 2, '1', 1, '2024-01-28 19:56:39', '2024-01-28 20:15:07'),
(4, 8, '1', 1, '2024-01-28 20:42:27', '2024-01-28 21:17:39'),
(5, 8, '1', 4, '2024-01-28 20:42:35', '2024-01-28 21:17:39'),
(6, 7, '1', 2, '2024-01-28 21:13:05', '2024-01-28 21:17:40'),
(7, 2, 'B1', 1, '2024-01-28 22:19:49', '2024-01-28 22:21:21'),
(8, 2, 'O2', 1, '2024-01-28 22:19:54', '2024-01-28 22:21:22'),
(9, 7, 'B2', 3, '2024-01-28 22:23:45', '2024-01-28 22:24:17'),
(10, 3, 'B1', 2, '2024-02-10 19:32:15', '2024-02-10 19:33:26'),
(11, 3, 'B3', 2, '2024-02-10 19:32:34', '2024-02-10 19:33:39'),
(12, 3, 'B1', 2, '2024-02-10 19:32:54', '2024-02-10 19:33:41'),
(13, 3, 'B3', 3, '2024-02-10 19:32:56', '2024-02-10 19:33:42'),
(14, 1, 'B1', 2, '2024-02-11 12:42:40', NULL),
(15, 6, 'B1', 3, '2024-02-11 13:31:09', NULL),
(16, 6, 'B1', 3, '2024-02-11 13:31:19', NULL),
(17, 2, 'D1', 3, '2024-02-11 13:36:27', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `Memberships`
--

CREATE TABLE `Memberships` (
  `member_id` int(11) NOT NULL,
  `member_name` varchar(255) DEFAULT NULL,
  `points` int(11) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Memberships`
--

INSERT INTO `Memberships` (`member_id`, `member_name`, `points`, `account_id`) VALUES
(1, 'Assyl Chouikh', 194, 12),
(2, 'Hazem', 157, 13);

-- --------------------------------------------------------

--
-- Structure de la table `Menu`
--

CREATE TABLE `Menu` (
  `item_id` varchar(6) NOT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `item_type` varchar(255) DEFAULT NULL,
  `item_category` varchar(255) DEFAULT NULL,
  `item_price` decimal(10,2) DEFAULT NULL,
  `item_description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Menu`
--

INSERT INTO `Menu` (`item_id`, `item_name`, `item_type`, `item_category`, `item_price`, `item_description`) VALUES
('B1', 'French toast', 'House Dessert', 'Breakfast', '11.00', 'French toast'),
('B2', 'Hashbrown breakfast casserole', 'House Dessert', 'Breakfast', '8.50', 'Hashbrown breakfast'),
('B3', 'Pumpkin waffles', 'House Dessert', 'Breakfast', '13.50', 'Pumpkin waffles'),
('D1', 'Frozen yogurt', 'House Dessert', 'Desserts', '9.00', 'Ice cream'),
('D2', 'Cupcake', 'House Dessert', 'Desserts', '8.50', 'Pastry'),
('D3', 'Eclair', 'House Dessert', 'Desserts', '6.00', 'Eclair'),
('H1', 'Coca', 'Cold Pressed Juice', 'Soda', '2.50', 'Soda'),
('H2', 'Boga', 'Cold Pressed Juice', 'Soda', '2.50', 'Soda'),
('H3', 'Viva', 'Cold Pressed Juice', 'Soda', '2.50', 'Soda'),
('L1', 'Coronation chicken salad', 'Salad', 'Lunch', '14.00', 'Coronation chicken salad'),
('L2', 'Avocado panzanella', 'Pasta', 'Lunch', '11.00', 'Avocado panzanella'),
('L3', 'Lentil soup', 'Side Dishes', 'Lunch', '9.00', 'Lentil soup'),
('O1', 'Milk Shake', 'Classic Cocktails', 'Drinks and Tea', '8.50', 'Milk Shake'),
('O2', 'Iced Tea', 'House Cocktails', 'Drinks and Tea', '6.50', 'Iced Tea'),
('O3', 'Orange Juice', 'House Cocktails', 'Drinks and Tea', '7.00', 'Orange Juice'),
('T1', 'Fajitas', 'Side Dishes', 'Dinner', '11.00', 'Fajitas'),
('T2', 'Curry noodles', 'Pasta', 'Dinner', '16.00', 'Curry noodles'),
('T3', 'Beef stroganoff', 'Breakfast', 'Dinner', '18.00', 'Beef stroganoff');

-- --------------------------------------------------------

--
-- Structure de la table `Reservations`
--

CREATE TABLE `Reservations` (
  `reservation_id` int(11) NOT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `table_id` int(11) DEFAULT NULL,
  `reservation_time` time DEFAULT NULL,
  `reservation_date` date DEFAULT NULL,
  `head_count` int(11) DEFAULT NULL,
  `special_request` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Reservations`
--

INSERT INTO `Reservations` (`reservation_id`, `customer_name`, `table_id`, `reservation_time`, `reservation_date`, `head_count`, `special_request`) VALUES
(2020241, 'Hazem', 1, '20:00:00', '2024-02-10', 4, 'view');

-- --------------------------------------------------------

--
-- Structure de la table `Restaurant_Tables`
--

CREATE TABLE `Restaurant_Tables` (
  `table_id` int(11) NOT NULL,
  `capacity` int(11) DEFAULT NULL,
  `is_available` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Restaurant_Tables`
--

INSERT INTO `Restaurant_Tables` (`table_id`, `capacity`, `is_available`) VALUES
(1, 4, 1),
(2, 4, 1),
(3, 4, 1),
(4, 6, 1),
(5, 6, 1),
(6, 6, 1),
(7, 6, 1),
(8, 8, 1),
(9, 8, 1),
(10, 8, 1);

-- --------------------------------------------------------

--
-- Structure de la table `Staffs`
--

CREATE TABLE `Staffs` (
  `staff_id` int(11) NOT NULL,
  `staff_name` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Staffs`
--

INSERT INTO `Staffs` (`staff_id`, `staff_name`, `role`, `account_id`) VALUES
(1, 'John Smith', 'Waiter', 1),
(2, 'Susan Johnson', 'Waiter', 2),
(3, 'James Brown', 'Waiter', 3),
(4, 'Alice Davis', 'Waiter', 4),
(5, 'Mike Wilson', 'Waiter', 5),
(6, 'Lisa Martinez', 'Chef', 6),
(7, 'Robert Miller', 'Manager', 7),
(8, 'Emily Moore', 'Manager', 8),
(9, 'David Taylor', 'Chef', 9),
(10, 'Olivia Anderson', 'Chef', 10);

-- --------------------------------------------------------

--
-- Structure de la table `Table_Availability`
--

CREATE TABLE `Table_Availability` (
  `availability_id` int(11) NOT NULL,
  `table_id` int(11) DEFAULT NULL,
  `reservation_date` date DEFAULT NULL,
  `reservation_time` time DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Table_Availability`
--

INSERT INTO `Table_Availability` (`availability_id`, `table_id`, `reservation_date`, `reservation_time`, `status`) VALUES
(2020241, 1, '2024-02-10', '20:00:00', 'no');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Accounts`
--
ALTER TABLE `Accounts`
  ADD PRIMARY KEY (`account_id`);

--
-- Index pour la table `Bills`
--
ALTER TABLE `Bills`
  ADD PRIMARY KEY (`bill_id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `member_id` (`member_id`),
  ADD KEY `reservation_id` (`reservation_id`),
  ADD KEY `table_id` (`table_id`),
  ADD KEY `card_id` (`card_id`);

--
-- Index pour la table `Bill_Items`
--
ALTER TABLE `Bill_Items`
  ADD PRIMARY KEY (`bill_item_id`),
  ADD KEY `bill_id` (`bill_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Index pour la table `card_payments`
--
ALTER TABLE `card_payments`
  ADD PRIMARY KEY (`card_id`);

--
-- Index pour la table `Kitchen`
--
ALTER TABLE `Kitchen`
  ADD PRIMARY KEY (`kitchen_id`),
  ADD KEY `table_id` (`table_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Index pour la table `Memberships`
--
ALTER TABLE `Memberships`
  ADD PRIMARY KEY (`member_id`),
  ADD KEY `account_id` (`account_id`);

--
-- Index pour la table `Menu`
--
ALTER TABLE `Menu`
  ADD PRIMARY KEY (`item_id`);

--
-- Index pour la table `Reservations`
--
ALTER TABLE `Reservations`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `table_id` (`table_id`);

--
-- Index pour la table `Restaurant_Tables`
--
ALTER TABLE `Restaurant_Tables`
  ADD PRIMARY KEY (`table_id`);

--
-- Index pour la table `Staffs`
--
ALTER TABLE `Staffs`
  ADD PRIMARY KEY (`staff_id`),
  ADD KEY `account_id` (`account_id`);

--
-- Index pour la table `Table_Availability`
--
ALTER TABLE `Table_Availability`
  ADD PRIMARY KEY (`availability_id`),
  ADD KEY `table_id` (`table_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Accounts`
--
ALTER TABLE `Accounts`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `Bills`
--
ALTER TABLE `Bills`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `Bill_Items`
--
ALTER TABLE `Bill_Items`
  MODIFY `bill_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `card_payments`
--
ALTER TABLE `card_payments`
  MODIFY `card_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `Kitchen`
--
ALTER TABLE `Kitchen`
  MODIFY `kitchen_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `Memberships`
--
ALTER TABLE `Memberships`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `Reservations`
--
ALTER TABLE `Reservations`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2020242;

--
-- AUTO_INCREMENT pour la table `Restaurant_Tables`
--
ALTER TABLE `Restaurant_Tables`
  MODIFY `table_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `Staffs`
--
ALTER TABLE `Staffs`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `Table_Availability`
--
ALTER TABLE `Table_Availability`
  MODIFY `availability_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2020242;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Bills`
--
ALTER TABLE `Bills`
  ADD CONSTRAINT `bills_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `Staffs` (`staff_id`),
  ADD CONSTRAINT `bills_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `Memberships` (`member_id`),
  ADD CONSTRAINT `bills_ibfk_3` FOREIGN KEY (`reservation_id`) REFERENCES `Reservations` (`reservation_id`),
  ADD CONSTRAINT `bills_ibfk_4` FOREIGN KEY (`table_id`) REFERENCES `Restaurant_Tables` (`table_id`),
  ADD CONSTRAINT `bills_ibfk_5` FOREIGN KEY (`card_id`) REFERENCES `card_payments` (`card_id`);

--
-- Contraintes pour la table `Bill_Items`
--
ALTER TABLE `Bill_Items`
  ADD CONSTRAINT `bill_items_ibfk_1` FOREIGN KEY (`bill_id`) REFERENCES `Bills` (`bill_id`),
  ADD CONSTRAINT `bill_items_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `Menu` (`item_id`);

--
-- Contraintes pour la table `Kitchen`
--
ALTER TABLE `Kitchen`
  ADD CONSTRAINT `kitchen_ibfk_1` FOREIGN KEY (`table_id`) REFERENCES `Restaurant_Tables` (`table_id`),
  ADD CONSTRAINT `kitchen_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `Menu` (`item_id`);

--
-- Contraintes pour la table `Memberships`
--
ALTER TABLE `Memberships`
  ADD CONSTRAINT `memberships_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `Accounts` (`account_id`);

--
-- Contraintes pour la table `Reservations`
--
ALTER TABLE `Reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`table_id`) REFERENCES `Restaurant_Tables` (`table_id`);

--
-- Contraintes pour la table `Staffs`
--
ALTER TABLE `Staffs`
  ADD CONSTRAINT `staffs_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `Accounts` (`account_id`);

--
-- Contraintes pour la table `Table_Availability`
--
ALTER TABLE `Table_Availability`
  ADD CONSTRAINT `table_availability_ibfk_1` FOREIGN KEY (`table_id`) REFERENCES `Restaurant_Tables` (`table_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
