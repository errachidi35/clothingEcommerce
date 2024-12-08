-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 12 jan. 2024 à 13:01
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ecom`
--

-- --------------------------------------------------------

--
-- Structure de la table `ecom_admin`
--

CREATE TABLE `ecom_admin` (
  `id` int(11) NOT NULL,
  `adminfastname` varchar(20) NOT NULL,
  `adminlastname` varchar(20) NOT NULL,
  `adminemail` varchar(200) NOT NULL,
  `level` varchar(100) NOT NULL,
  `adminpass` varchar(250) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `ecom_admin`
--

INSERT INTO `ecom_admin` (`id`, `adminfastname`, `adminlastname`, `adminemail`, `level`, `adminpass`, `address`) VALUES
(1, 'Tanjil', 'hasan', 'tanjilh136@gmail.com', 'uploads/70f6f1bec7.jpg', '827ccb0eea8a706c4c34a16891f84e7b', ''),
(2, 'Tanjil', 'Hasan', 'tanjilh136@gmail.com', 'uploads/70f6f1bec7.jpg', '27d421e4938e934fd3e0f1620e4b5919', 'sreepur,savar'),
(3, 'abdo', 'abdo', 'abdo2003@gmail.com', '', '4a7d1ed414474e4033ac29ccb8653d9b', '');

-- --------------------------------------------------------

--
-- Structure de la table `ecom_admin_message`
--

CREATE TABLE `ecom_admin_message` (
  `id` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `ecom_admin_message`
--

INSERT INTO `ecom_admin_message` (`id`, `email`, `subject`, `message`, `date`) VALUES
(1, 'tanjilh136@gmail.com', 'Test Sunject', 'Message', '2017-09-21'),
(2, 'tanjilh136@gmail.com', 'Test Subject', 'Message', '2017-09-21');

-- --------------------------------------------------------

--
-- Structure de la table `ecom_brand`
--

CREATE TABLE `ecom_brand` (
  `id` int(11) NOT NULL,
  `brand` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `ecom_brand`
--

INSERT INTO `ecom_brand` (`id`, `brand`) VALUES
(1, 'Nike'),
(2, 'Adidas'),
(3, 'Under Armour');

-- --------------------------------------------------------

--
-- Structure de la table `ecom_cart`
--

CREATE TABLE `ecom_cart` (
  `cartid` int(11) NOT NULL,
  `sid` varchar(250) NOT NULL,
  `proid` int(11) NOT NULL,
  `proname` varchar(30) NOT NULL,
  `price` float NOT NULL,
  `size` varchar(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ecom_category`
--

CREATE TABLE `ecom_category` (
  `id` int(11) NOT NULL,
  `catname` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `ecom_category`
--

INSERT INTO `ecom_category` (`id`, `catname`) VALUES
(1, 'Shirts'),
(2, 'T-Shirts'),
(3, 'Pants'),
(4, 'Jackets'),
(5, 'Shoes');

-- --------------------------------------------------------

--
-- Structure de la table `ecom_customer`
--

CREATE TABLE `ecom_customer` (
  `userid` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `pass` varchar(225) NOT NULL,
  `date` date NOT NULL,
  `zip` varchar(10) NOT NULL,
  `country` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `ecom_customer`
--

INSERT INTO `ecom_customer` (`userid`, `name`, `email`, `image`, `pass`, `date`, `zip`, `country`, `city`, `phone`) VALUES
(3, 'Md Rakibul Hasan Ant', 'mdanto345@gmail.com', 'NULL', '0803e2e4e36693ebeea4d5c935b695d5', '2020-04-11', '', '', '', '+8801849624222'),
(4, 'abdo', 'abdo@gmail.com', '', '0000', '2024-01-10', '', '', '', ''),
(5, 'aaaaa', 'AAAAA@gmail.com', 'NULL', 'e10adc3949ba59abbe56e057f20f883e', '2024-01-10', '', '', '', '+212643452262'),
(6, 'AAAAB', 'AAAAAB@gmail.com', 'NULL', 'd52ba56b3b104f1475fdbbe8090760c9', '2024-01-11', '', '', '', '0643452262');

-- --------------------------------------------------------

--
-- Structure de la table `ecom_customer_message`
--

CREATE TABLE `ecom_customer_message` (
  `messageid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `messagedate` date DEFAULT NULL,
  `useremail` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `ecom_customer_message`
--

INSERT INTO `ecom_customer_message` (`messageid`, `userid`, `subject`, `message`, `messagedate`, `useremail`) VALUES
(1, 1, 'Message Subject', 'Mesage Body', '2017-09-21', 'tanjilh136@gmail.com'),
(2, 2, 'Another Message Subject', 'Another Mesage Body', '2017-09-21', 'tanjilh136@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `ecom_customer_order`
--

CREATE TABLE `product_order` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `ecom_customer_order` (
  `id` int(11) NOT NULL,
  `customerid` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `ecom_customer_order`
--


-- --------------------------------------------------------

--
-- Structure de la table `ecom_product`
--

CREATE TABLE `ecom_product` (
  `proid` int(11) NOT NULL,
  `proname` varchar(20) NOT NULL,
  `catid` int(11) NOT NULL,
  `brandid` int(11) NOT NULL,
  `body` text NOT NULL,
  `price` float NOT NULL,
  `image` varchar(200) NOT NULL,
  `gender` varchar(11) NOT NULL,
  `quant_S` int(11) NOT NULL,
  `quant_L` int(11) NOT NULL,
  `quant_M` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `ecom_product`
--



-- --------------------------------------------------------

--
-- Structure de la table `ecom_product_review`
--

CREATE TABLE `ecom_product_review` (
  `revid` int(11) NOT NULL,
  `cmrid` int(11) NOT NULL,
  `proid` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `review` text NOT NULL,
  `rate` int(11) NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `ecom_product_review`
--

INSERT INTO `ecom_product_review` (`revid`, `cmrid`, `proid`, `name`, `email`, `phone`, `review`, `rate`, `date`) VALUES
(1, 1, 10, 'Tanjil Hasan', 'tanjilh136@gmail.com', '+880111111111', ':P this ', 3, '2020-04-16'),
(2, 1, 4, 'Tanjil Hasan', 'tanjilh136@gmail.com', '+88012222222222', 'Test Rewiew', 3, '2020-04-08'),
(3, 6, 12, 'abbb', 'abbb@gmail.com', '0643452262', 'heajbcaehkjckaencljnaeclba ejcvbaehbvakva d;bc a:kj', 9, '2024-01-11');

-- --------------------------------------------------------

--
-- Structure de la table `ecom_social_media`
--

CREATE TABLE `ecom_social_media` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `link` text NOT NULL,
  `icon` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `ecom_social_media`
--

INSERT INTO `ecom_social_media` (`id`, `name`, `link`, `icon`) VALUES
(1, 'Facebook', '#', 'fa-facebook'),
(2, 'Twitter', '#', 'fa-twitter');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `ecom_admin`
--
ALTER TABLE `ecom_admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ecom_admin_message`
--
ALTER TABLE `ecom_admin_message`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ecom_brand`
--
ALTER TABLE `ecom_brand`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ecom_cart`
--
ALTER TABLE `ecom_cart`
  ADD PRIMARY KEY (`cartid`);

--
-- Index pour la table `ecom_category`
--
ALTER TABLE `ecom_category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ecom_customer`
--
ALTER TABLE `ecom_customer`
  ADD PRIMARY KEY (`userid`);

--
-- Index pour la table `ecom_customer_message`
--
ALTER TABLE `ecom_customer_message`
  ADD PRIMARY KEY (`messageid`);

--
-- Indexes for table `product_order`
--
ALTER TABLE `product_order`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ecom_customer_order`
--
ALTER TABLE `ecom_customer_order`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ecom_product`
--
ALTER TABLE `ecom_product`
  ADD PRIMARY KEY (`proid`);

--
-- Index pour la table `ecom_product_review`
--
ALTER TABLE `ecom_product_review`
  ADD PRIMARY KEY (`revid`);

--
-- Index pour la table `ecom_social_media`
--
ALTER TABLE `ecom_social_media`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `ecom_admin`
--
ALTER TABLE `ecom_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `ecom_admin_message`
--
ALTER TABLE `ecom_admin_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `ecom_brand`
--
ALTER TABLE `ecom_brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `ecom_cart`
--
ALTER TABLE `ecom_cart`
  MODIFY `cartid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `ecom_category`
--
ALTER TABLE `ecom_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;


--
-- AUTO_INCREMENT for table `product_order`
--
ALTER TABLE `product_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `ecom_customer`
--
ALTER TABLE `ecom_customer`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `ecom_customer_message`
--
ALTER TABLE `ecom_customer_message`
  MODIFY `messageid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `ecom_customer_order`
--
ALTER TABLE `ecom_customer_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `ecom_product`
--
ALTER TABLE `ecom_product`
  MODIFY `proid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `ecom_product_review`
--
ALTER TABLE `ecom_product_review`
  MODIFY `revid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `ecom_social_media`
--
ALTER TABLE `ecom_social_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
