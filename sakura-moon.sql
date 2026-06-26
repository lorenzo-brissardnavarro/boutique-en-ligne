-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 26 juin 2026 à 11:07
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sakura-moon`
--

-- --------------------------------------------------------

--
-- Structure de la table `additional_image`
--

CREATE TABLE `additional_image` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `additional_image`
--

INSERT INTO `additional_image` (`id`, `image`, `product_id`) VALUES
(3, 'chouchou-sakura-2-20260614.webp', 7),
(6, 'boucles-lotus-2-20260614220608.webp', 1),
(9, 'chouchou-sakura-fonc---2-20260616083656.webp', 9);

-- --------------------------------------------------------

--
-- Structure de la table `caddie`
--

CREATE TABLE `caddie` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `caddie`
--

INSERT INTO `caddie` (`id`, `user_id`) VALUES
(1, 1),
(4, 8);

-- --------------------------------------------------------

--
-- Structure de la table `caddie_content`
--

CREATE TABLE `caddie_content` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `caddie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `category_name`) VALUES
(1, 'Boucles d\'oreilles'),
(2, 'Trousses'),
(3, 'Chouchous'),
(5, 'Marque-pages'),
(6, 'Parures');

-- --------------------------------------------------------

--
-- Structure de la table `favorite`
--

CREATE TABLE `favorite` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `favorite`
--

INSERT INTO `favorite` (`id`, `product_id`, `user_id`) VALUES
(2, 1, 1),
(3, 5, 1);

-- --------------------------------------------------------

--
-- Structure de la table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `number` varchar(255) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `order`
--

INSERT INTO `order` (`id`, `number`, `total_price`, `user_id`) VALUES
(2, 'CMD-20260612-000002', 137.00, 1),
(3, 'CMD-20260612-000003', 29.80, 1),
(6, 'CMD-20260622-000006', 26.97, 8),
(8, 'CMD-20260623-000008', 25.80, 1);

-- --------------------------------------------------------

--
-- Structure de la table `order_content`
--

CREATE TABLE `order_content` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `order_content`
--

INSERT INTO `order_content` (`id`, `order_id`, `product_id`, `quantity`, `unit_price`) VALUES
(3, 2, 1, 6, 12.90),
(4, 2, 2, 1, 14.90),
(5, 2, 4, 1, 14.90),
(6, 2, 5, 2, 14.90),
(7, 3, 3, 2, 14.90),
(12, 6, 7, 3, 8.99),
(14, 8, 1, 2, 12.90);

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id`, `product_name`, `description`, `price`, `stock`, `image`, `is_active`, `category_id`) VALUES
(1, 'Boucles d\'oreilles Lotus Blanc – Élégance florale', 'Apportez une touche de douceur et de raffinement à votre style avec ces magnifiques boucles d\'oreilles en forme de lotus blanc. Symbole de pureté, de sérénité et de renouveau, le lotus est une fleur emblématique qui s\'accorde aussi bien avec une tenue du quotidien qu\'avec une occasion spéciale.\n\nLeur design ajouré met délicatement en valeur les pétales de la fleur, offrant un bijou à la fois léger, élégant et intemporel.\n\nUn accessoire idéal pour les amoureuses de la nature, de la culture asiatique ou des bijoux au style zen et minimaliste.\n\nCaractéristiques :\n- Motif : Fleur de lotus\n- Couleur : Blanc\n- Matière : \n- Dimensions : 5,5 × 2,9 cm (h × l) avec le crochet\n- Poids : 2g\n- Fermeture : Crochet en laiton\n- Fabrication artisanale\n\nLa symbolique du Lotus : \nDans de nombreuses cultures asiatiques, le lotus est un symbole de pureté, de sérénité et de renouveau. Capable de s\'épanouir dans les eaux les plus troubles, il représente la force intérieure, l\'équilibre et la beauté qui naît des épreuves. Ces boucles d\'oreilles s\'inspirent de cette fleur emblématique pour apporter une touche d\'élégance, de douceur et de spiritualité à votre quotidien.', 12.90, 8, 'boucles-lotus-1-20260614203411.webp', 0, 1),
(2, 'Boucles d\'oreilles Carpe Koï – Argent', 'Inspirées de la célèbre carpe koï japonaise, ces élégantes boucles d\'oreilles symbolisent la persévérance, la force et la chance. Leur design finement ajouré met en valeur chaque détail des nageoires, apportant légèreté et mouvement à ce bijou unique.\n\nÀ la fois originales et raffinées, elles sont parfaites pour compléter une tenue du quotidien ou ajouter une touche d\'inspiration asiatique à un look plus habillé.\n\nDisponibles en plusieurs coloris, elles s\'adaptent à tous les styles et toutes les envies.\n\nCaractéristiques : \n- Motif : Carpe koï japonaise\n- Couleur : Argent\n- Matière : métal\n- Dimensions : 7,6 × 3,7 cm (h × l) avec le crochet\n- Poids : 2g\n- Fermeture : Crochet en laiton\n- Fabrication artisanale\n\nLa symbolique de la carpe koï :\nDans la culture japonaise, la carpe koï est un symbole de courage, de persévérance, de réussite et de prospérité. Elle représente la capacité à surmonter les épreuves et à avancer avec détermination, ce qui en fait un bijou aussi élégant que porteur de sens.', 8.90, 1, 'boucles-poisson-argent-1-20260602.webp', 1, 1),
(3, 'Boucles d\'oreilles Carpe Koï – Noir', 'Inspirées de la célèbre carpe koï japonaise, ces élégantes boucles d\'oreilles symbolisent la persévérance, la force et la chance. Leur design finement ajouré met en valeur chaque détail des nageoires, apportant légèreté et mouvement à ce bijou unique.\n\nÀ la fois originales et raffinées, elles sont parfaites pour compléter une tenue du quotidien ou ajouter une touche d\'inspiration asiatique à un look plus habillé.\n\nDisponibles en plusieurs coloris, elles s\'adaptent à tous les styles et toutes les envies.\n\nCaractéristiques : \n- Motif : Carpe koï japonaise\n- Couleur : Noir\n- Matière : métal\n- Dimensions : 7,6 × 3,7 cm (h × l) avec le crochet\n- Poids : 2g\n- Fermeture : Crochet en laiton\n- Fabrication artisanale\n\nLa symbolique de la carpe koï :\nDans la culture japonaise, la carpe koï est un symbole de courage, de persévérance, de réussite et de prospérité. Elle représente la capacité à surmonter les épreuves et à avancer avec détermination, ce qui en fait un bijou aussi élégant que porteur de sens.', 8.90, 8, 'boucles-poisson-noir-1-20260602.webp', 1, 1),
(4, 'Boucles d\'oreilles Carpe Koï – Or', 'Inspirées de la célèbre carpe koï japonaise, ces élégantes boucles d\'oreilles symbolisent la persévérance, la force et la chance. Leur design finement ajouré met en valeur chaque détail des nageoires, apportant légèreté et mouvement à ce bijou unique.\n\nÀ la fois originales et raffinées, elles sont parfaites pour compléter une tenue du quotidien ou ajouter une touche d\'inspiration asiatique à un look plus habillé.\n\nDisponibles en plusieurs coloris, elles s\'adaptent à tous les styles et toutes les envies.\n\nCaractéristiques : \n- Motif : Carpe koï japonaise\n- Couleur : Or\n- Matière : métal\n- Dimensions : 7,6 × 3,7 cm (h × l) avec le crochet\n- Poids : 2g\n- Fermeture : Crochet en laiton\n- Fabrication artisanale\n\nLa symbolique de la carpe koï :\nDans la culture japonaise, la carpe koï est un symbole de courage, de persévérance, de réussite et de prospérité. Elle représente la capacité à surmonter les épreuves et à avancer avec détermination, ce qui en fait un bijou aussi élégant que porteur de sens.', 8.90, 10, 'boucles-poisson-or-1-20260602.webp', 1, 1),
(5, 'Boucles d\'oreilles Carpe Koï – Rouge', 'Inspirées de la célèbre carpe koï japonaise, ces élégantes boucles d\'oreilles symbolisent la persévérance, la force et la chance. Leur design finement ajouré met en valeur chaque détail des nageoires, apportant légèreté et mouvement à ce bijou unique.\n\nÀ la fois originales et raffinées, elles sont parfaites pour compléter une tenue du quotidien ou ajouter une touche d\'inspiration asiatique à un look plus habillé.\n\nDisponibles en plusieurs coloris, elles s\'adaptent à tous les styles et toutes les envies.\n\nCaractéristiques : \n- Motif : Carpe koï japonaise\n- Couleur : Rouge\n- Matière : métal\n- Dimensions : 7,6 × 3,7 cm (h × l) avec le crochet\n- Poids : 2g\n- Fermeture : Crochet en laiton\n- Fabrication artisanale\n\nLa symbolique de la carpe koï :\nDans la culture japonaise, la carpe koï est un symbole de courage, de persévérance, de réussite et de prospérité. Elle représente la capacité à surmonter les épreuves et à avancer avec détermination, ce qui en fait un bijou aussi élégant que porteur de sens.', 8.90, 4, 'boucles-poisson-rouge-1-20260602.webp', 1, 1),
(6, 'Trousse de maquillage Éventail Vert – Esprit Japonais', 'Alliez élégance et praticité avec cette jolie trousse de maquillage aux motifs d\'éventails japonais dans des tons verts apaisants. Son design raffiné, inspiré de l\'esthétique traditionnelle japonaise, en fait un accessoire aussi pratique qu\'élégant.\n\nIdéale pour ranger votre maquillage, vos produits de beauté ou vos petits accessoires du quotidien, cette trousse vous accompagnera aussi bien à la maison qu\'en voyage. Sa taille généreuse permet d\'organiser facilement tous vos indispensables.\n\nUn indispensable pour les amoureux du Japon et des accessoires au style délicat.\n\nCaractéristiques : \n- Type : Trousse de maquillage\n- Motif : Éventails japonais (Sensu)\n- Couleur : Vert et blanc\n- Matière : 100% Coton\n- Dimensions : 24 × 12 × 10 cm (L × l × H)\n- Fermeture : Fermeture éclair\n- Doublure intérieure : Toile cirée lavable\n- Fabrication artisanale\n- Lavage à la main\n\nLa symbolique de l\'éventail japonais : \nAu Japon, l\'éventail traditionnel, appelé Sensu, est un symbole de chance, de prospérité et d\'avenir prometteur. Sa forme qui s\'ouvre progressivement évoque l\'expansion, les nouvelles opportunités et la réussite. Présent lors des cérémonies, des danses traditionnelles et des fêtes, il représente également l\'élégance et le raffinement de la culture japonaise.', 24.90, 4, 'trousse-m-verte-1-20260613.webp', 1, 2),
(7, 'Chouchou en coton Fleuri Clair – Esprit Sakura', 'Ajoutez une touche de douceur et d\'élégance à votre coiffure avec ce magnifique chouchou en coton aux délicats motifs floraux inspirés des fleurs de cerisier japonaises.\n\nConfortable et agréable à porter, il maintient vos cheveux sans les abîmer tout en apportant une note poétique à votre style. Que ce soit pour une queue-de-cheval, un chignon ou simplement porté au poignet comme accessoire, ce chouchou s\'adapte à toutes les occasions.\n\nSon imprimé inspiré de l\'univers japonais en fait un accessoire idéal pour les amoureux de la culture asiatique et des motifs fleuris.\n\nCaractéristiques :\n- Type : Chouchou pour cheveux\n- Matière : 100% Coton\n- Motif : Fleurs de cerisier (Sakura)\n- Couleur : Bleu clair, rose et noir\n- Diamètre : 5cm\n- Élastique : Souple et résistant\n- Fabrication artisanale\n\nLa symbolique du Sakura :\nAu Japon, les fleurs de cerisier, appelées Sakura, symbolisent la beauté, le renouveau et la douceur de vivre. Elles rappellent que les plus beaux instants sont souvent les plus précieux, faisant de ce chouchou un accessoire aussi pratique que chargé de poésie.', 6.90, 1, 'chouchou-sakura-1-20260614.webp', 1, 3),
(9, 'Chouchou en coton Fleuri Rouge – Esprit Sakura', 'Sublimez votre coiffure avec ce chouchou en coton aux magnifiques motifs de fleurs de cerisier sur un fond rouge profond. Inspiré de l\'élégance japonaise, il apporte une touche de couleur et de raffinement à toutes vos tenues.\n\nConçu pour maintenir les cheveux confortablement sans les abîmer, il convient aussi bien pour une queue-de-cheval, un chignon ou simplement porté au poignet comme un accessoire tendance.\n\nSon imprimé floral évoque la beauté des cerisiers en fleurs et l\'atmosphère apaisante du printemps japonais.\n\nCaractéristiques : \n- Type : Chouchou pour cheveux\n- Matière : 100% Coton\n- Motif : Fleurs de cerisier (Sakura)\n- Couleur : Rouge bordeaux, rose et blanc\n- Diamètre : 5cm\n- Élastique : Souple et résistant\n- Fabrication artisanale\n\nLa symbolique du Sakura : \nAu Japon, les fleurs de cerisier (Sakura) symbolisent la beauté, le renouveau et la nature éphémère des plus beaux moments. Ce chouchou s\'inspire de cette tradition pour apporter une touche de poésie et d\'élégance à votre quotidien.', 6.90, 6, 'chouchou-sakura-fonc---1-20260616083656.webp', 1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id`, `role_name`) VALUES
(1, 'admin'),
(2, 'client');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `address` text DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `firstname`, `surname`, `email`, `phone`, `birthday`, `address`, `password`, `role_id`) VALUES
(1, 'Harry', 'Cover', 'harry-cover@gmail.com', '0601010101', '2000-01-01', '75 Boulevard Napoléon', '$2y$10$JQVSu4.6gMYVGfyKpowl0OEEnFMfnIQMG/LhGFPAvsTGPBY7lwQJm', 2),
(2, 'root', 'root', 'root@gmail.com', '0602020202', '2002-02-02', '107 Boulevard de la République', '$2y$10$KPwUtd6/igxy571.Mr3E0uTWI5nH9kpStpfLF2/GRvRLu3DRKHmj6', 1),
(8, 'Jean', 'Dupont', 'jean@laplateforme.io', '0707070707', '2000-08-18', '81 Avenue d\'Asie', '$2y$10$9ORL6a1EdsLSeWIk9yX.QeR1RzOObidHmkp6AUoDfHgFwiIJ9Ye1C', 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `additional_image`
--
ALTER TABLE `additional_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_additional_image_product` (`product_id`);

--
-- Index pour la table `caddie`
--
ALTER TABLE `caddie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_caddie_user` (`user_id`);

--
-- Index pour la table `caddie_content`
--
ALTER TABLE `caddie_content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_caddie_content_caddie` (`caddie_id`),
  ADD KEY `fk_caddie_content_product` (`product_id`);

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_favorite_product` (`product_id`),
  ADD KEY `fk_favorite_user` (`user_id`);

--
-- Index pour la table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order_user` (`user_id`);

--
-- Index pour la table `order_content`
--
ALTER TABLE `order_content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order_content_product` (`product_id`),
  ADD KEY `fk_order_content_order` (`order_id`);

--
-- Index pour la table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_product_category` (`category_id`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_user_role` (`role_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `additional_image`
--
ALTER TABLE `additional_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `caddie`
--
ALTER TABLE `caddie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `caddie_content`
--
ALTER TABLE `caddie_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `favorite`
--
ALTER TABLE `favorite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `order_content`
--
ALTER TABLE `order_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `additional_image`
--
ALTER TABLE `additional_image`
  ADD CONSTRAINT `fk_additional_image_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `caddie`
--
ALTER TABLE `caddie`
  ADD CONSTRAINT `fk_caddie_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `caddie_content`
--
ALTER TABLE `caddie_content`
  ADD CONSTRAINT `fk_caddie_content_caddie` FOREIGN KEY (`caddie_id`) REFERENCES `caddie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_caddie_content_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `favorite`
--
ALTER TABLE `favorite`
  ADD CONSTRAINT `fk_favorite_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `fk_favorite_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `fk_order_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `order_content`
--
ALTER TABLE `order_content`
  ADD CONSTRAINT `fk_order_content_order` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_order_content_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Contraintes pour la table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_product_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_role` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
