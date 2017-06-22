-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 22 Juin 2017 à 10:53
-- Version du serveur :  10.1.13-MariaDB
-- Version de PHP :  5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `annonceo`
--

-- --------------------------------------------------------

--
-- Structure de la table `annonce`
--

CREATE TABLE `annonce` (
  `id_annonce` int(3) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `description_courte` varchar(255) NOT NULL,
  `description_longue` text NOT NULL,
  `prix` int(11) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `pays` varchar(20) NOT NULL,
  `ville` varchar(20) NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `cp` int(5) NOT NULL,
  `id_membre` int(3) NOT NULL,
  `id_photo` int(3) NOT NULL,
  `id_categorie` int(3) NOT NULL,
  `date_enregistrement` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id_categorie` int(3) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `motscles` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `id_commentaire` int(3) NOT NULL,
  `id_membre` int(3) NOT NULL,
  `id_annonce` int(3) NOT NULL,
  `commentaire` text NOT NULL,
  `date_enregistrement` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `id_membre` int(3) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `mdp` varchar(60) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `civilite` enum('m','f') NOT NULL,
  `statut` int(1) NOT NULL,
  `date_enregistrement` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

CREATE TABLE `note` (
  `id_note` int(3) NOT NULL,
  `id_membre1` int(3) NOT NULL,
  `id_membre2` int(3) NOT NULL,
  `note` int(3) NOT NULL,
  `avis` text NOT NULL,
  `date_enregistrement` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

CREATE TABLE `photo` (
  `id_photo` int(3) NOT NULL,
  `photo1` varchar(255) NOT NULL,
  `photo2` varchar(255) NOT NULL,
  `photo3` varchar(255) NOT NULL,
  `photo4` varchar(255) NOT NULL,
  `photo5` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `annonce`
--
ALTER TABLE `annonce`
  ADD PRIMARY KEY (`id_annonce`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id_categorie`);

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id_commentaire`);

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`id_membre`);

--
-- Index pour la table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`id_note`);

--
-- Index pour la table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`id_photo`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `annonce`
--
ALTER TABLE `annonce`
  MODIFY `id_annonce` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id_categorie` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id_commentaire` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `id_membre` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `note`
--
ALTER TABLE `note`
  MODIFY `id_note` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `photo`
--
ALTER TABLE `photo`
  MODIFY `id_photo` int(3) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



INSERT INTO membre (id_membre, pseudo, mdp, nom, prenom, telephone, email, civilite, statut, date_enregistrement) VALUES
('', 'admin', 'admin', 'admin', 'admin', '00 00 00 00 00', 'admin@hotmail.com', 'm', '1', now() ),
('', 'Mathieu', 'ventilo', 'Moens', 'Jérôme', '06 45 75 92 15', 'je.moens@hotmail.com', 'm', '0', now() ),
('', 'juju', 'yo', 'Paillason', 'Julien', '06 12 45 75 95', 'ju.paillason@hotmail.com', 'm', '0', now() ),
('', 'lu', 'wouesh', 'Troillet', 'Lucile', '06 45 42 63 12', 'lu.troillet@hotmail.com', 'f', '0', now() ),
('', 'gogo', 'golem', 'Dito', 'Flavie', '06 53 69 75 12', 'go.dito@hotmail.com', 'f', '0', now() ),
('', 'nuage', 'nuage77', 'Tollens', 'Valérie', '06 43 75 12 95', 'nuage77@gmail.com', 'f', '0', now() ),
('', 'motard', 'motodecourse', 'Feder', 'George', '01 42 75 23 38', 'motard@gmail.com', 'h', '0', now() ),
('', 'pingu', 'mdp1', 'Duteil', 'Yves', '06 23 12 72 46', 'yves.duteil@hotmail.com', 'm', '0', now() );



INSERT INTO categorie (id_categorie, titre, motscles) VALUES
('', 'Immobilier', 'ventes immobilières, locations, colocations, bureaux et commerces'),
('', 'Multimedia', 'informatique, consoles & jeux vidéo, image & son, téléphonie'),
('', 'Vehicules', 'voitures, motos, caravaning, utilitaires, equipement, nautisme'),
('', 'Loisirs', 'DVD/Films, CD/Musique, Livres, Animaux, Vélos, Sports, Collection, Jeux, Vins & Gastronomie'),
('', 'Maison', 'ameublement, électroménager, arts de la table, décoration, linge de maison, bricolage, jardinage, vêtements, accessoires'),
('', 'Vacances', 'locations & gîtes, chambres d\'hôtes, campings, hôtels');


INSERT INTO photo (id_photo, photo1, photo2, photo3, photo4, photo5) VALUES
('', 'https://img0.leboncoin.fr/ad-large/78727fa1aeed325ce311ced85f69ad0edab03dba.jpg', 'https://img5.leboncoin.fr/ad-large/5fb17d00f123340edf1cfc4d39e82466f38f8334.jpg', '', '', ''),
('', 'https://img6.leboncoin.fr/ad-large/8f5e250266f382b415b7d6f44372651c39750d85.jpg', 'https://img7.leboncoin.fr/ad-large/f39605ccd40dc32c0eb5086b42794dca5ee7cea7.jpg', 'https://img6.leboncoin.fr/ad-large/c983eca9711194ab9594ce90ac1ded243b041a2e.jpg', '', ''),
('', 'https://img3.leboncoin.fr/ad-large/10f441a32b9069bdb8eb3eb3e3f1adca180fda5a.jpg', 'https://img1.leboncoin.fr/ad-large/83dc3982b74722c270a4495db1ebf3a173bcd1ff.jpg', '', '', ''),
('', 'https://img0.leboncoin.fr/ad-large/071f568109a007641ababb9259de8fae2ac9bada.jpg', 'https://img1.leboncoin.fr/ad-large/23b95d432ad6a54c3d9e340fb1bae77c07556e11.jpg
', 'https://img5.leboncoin.fr/ad-large/a28f159585d6e5baa06d633012e1cd1a61be685a.jpg', '', '', ''),
('', 'https://img4.leboncoin.fr/ad-large/327f148c593976a5edcf7f8c9c3c2482919b6c10.jpg', 'https://img1.leboncoin.fr/ad-large/bb7d188c0f3f14016c39994dbcb6a6148bb5632b.jpg', '', '', '');



/*Annonces Maison*/
INSERT INTO annonce (titre, description_courte, description_longue, prix, photo, pays, ville, adresse, cp, id_membre, id_photo, id_categorie, date_enregistrement) VALUES

('', 'Combiné fourmicro-ondesgrill SAMSUNG (garanti)', 'Combiné fourmicro-ondesgrill SAMSUNG (garanti)', 'Suite à un déménagement je dois me séparer de mon super four micro-ondes combiné Samsung, acheté en mars 2016. Sous garantie jusqu’à mars 2018 (la facture est fournie).
Fonctions four, grill, micro-onde et combiné (Cuisson croustillante = très pratique pour les pizzas et quiches !)
- Modèle : Samsung CE107MT-4B
- Diamètre du plateau : 31,8 cm
- Capacité : 28 l
- Puissance micro-ondes : 900 W
- Puissance gril : 1500 W
- Puissance four : 2100 W (40°C à 200°C)
- Touche de départ instantané, "touche 30s".
- "TDS" : triple système de diffusion d\'ondes, pour une meilleure homogénéité de cuisson.
- Plat croustilleur et programmes spécifiques spécialement dédiés à la cuisson des pizzas, tartes, volailles
', 140, 'https://img0.leboncoin.fr/ad-large/78727fa1aeed325ce311ced85f69ad0edab03dba.jpg', 'France', 'Colombes', '24, Allée des Roses', '92700', '', '', '5', now()),

('', 'stickers triangle noir ', 'stickers triangle noir ', 'Grands stickers triangle à coller au mur pour une déco originale. idéal pour une chambre d\'enfant. La plaquette est composée de 52 stickers.
Envoi par la Poste ou remise en mains propres à Bonneuil sur marne.', 5, 'https://img6.leboncoin.fr/ad-large/8f5e250266f382b415b7d6f44372651c39750d85.jpg', 'France', 'Bonneuil-sur-Marne', '77, bv Jean-Nouvel', '94380', '', '', '', now()),

('Table et chaises', 'Table et chaises', 'Ensemble table plus 6 chaises . Les chaises sont en parfait état , la table a été abîmée par une bougie , d où les bandes violettes qui la recouvrent .
Mesure de la table longueur 150 hauteur 76. Largeur 90 .
Le tout 200Euro(s) , à retirer uniquement le 2 juillet', 200, 'https://img3.leboncoin.fr/ad-large/10f441a32b9069bdb8eb3eb3e3f1adca180fda5a.jpg', 'France', 'Paris', '4,rue du puit', '75011', '', '', '5', now()),


('Tapis akar grisblanc La Redoute', 'Tapis akar grisblanc La Redoute', 'Bonjour, Je vends ce tapis tissé à plat, Dakar gris & blanc La Redoute pour 25€ au lieu de 60€.
Acheté il y a 6 mois donc quasi neuf. Dimensions : 120 x 170 cm. A venir chercher sur Paris 9', 25, 'https://img0.leboncoin.fr/ad-large/071f568109a007641ababb9259de8fae2ac9bada.jpg', 'France', 'Paris', '53, rue Chevreul', '75009', '', '', '5', now()),

('Ventilateur sur pied', 'Ventilateur sur pied', 'Vend ventilateur sur pied de marque bionaire. Très très puissant, 3 vitesses. Contact uniquement par SMS !
A VENIR CHERCHER SUR PLACE à Maisons-Alfort.
Ou pour voir mes autres annonces taper : Mrpaschère
', 50, 'https://img4.leboncoin.fr/ad-large/327f148c593976a5edcf7f8c9c3c2482919b6c10.jpg', 'France', 'Maisons-Alfort', '13, rue de la Marne', '94700', '', '', '5', now());

/*Vacances */
INSERT INTO annonce (titre, description_courte, description_longue, prix, photo, pays, ville, adresse, cp, id_membre, id_photo, id_categorie, date_enregistrement) VALUES

('Ventilateur sur pied', 'Ventilateur sur pied', 'Vend ventilateur sur pied de marque bionaire. Très très puissant, 3 vitesses. Contact uniquement par SMS !
A VENIR CHERCHER SUR PLACE à Maisons-Alfort.
Ou pour voir mes autres annonces taper : Mrpaschère
', 50, 'https://img4.leboncoin.fr/ad-large/327f148c593976a5edcf7f8c9c3c2482919b6c10.jpg', 'France', 'Maisons-Alfort', '13, rue de la Marne', '94700', '', '', '6', now());
