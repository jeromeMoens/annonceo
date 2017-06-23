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


/*-------------------------------------*/

/*PHOTOS de catégorie 5: Maison*/
INSERT INTO photo (id_photo, photo1, photo2, photo3, photo4, photo5) VALUES
('', 'https://img0.leboncoin.fr/ad-large/78727fa1aeed325ce311ced85f69ad0edab03dba.jpg', 'https://img5.leboncoin.fr/ad-large/5fb17d00f123340edf1cfc4d39e82466f38f8334.jpg', '', '', ''),
('', 'https://img6.leboncoin.fr/ad-large/8f5e250266f382b415b7d6f44372651c39750d85.jpg', 'https://img7.leboncoin.fr/ad-large/f39605ccd40dc32c0eb5086b42794dca5ee7cea7.jpg', 'https://img6.leboncoin.fr/ad-large/c983eca9711194ab9594ce90ac1ded243b041a2e.jpg', '', ''),
('', 'https://img3.leboncoin.fr/ad-large/10f441a32b9069bdb8eb3eb3e3f1adca180fda5a.jpg', 'https://img1.leboncoin.fr/ad-large/83dc3982b74722c270a4495db1ebf3a173bcd1ff.jpg', '', '', ''),
('', 'https://img0.leboncoin.fr/ad-large/071f568109a007641ababb9259de8fae2ac9bada.jpg', 'https://img1.leboncoin.fr/ad-large/23b95d432ad6a54c3d9e340fb1bae77c07556e11.jpg
', 'https://img5.leboncoin.fr/ad-large/a28f159585d6e5baa06d633012e1cd1a61be685a.jpg', '', ''),
('', 'https://img4.leboncoin.fr/ad-large/327f148c593976a5edcf7f8c9c3c2482919b6c10.jpg', 'https://img1.leboncoin.fr/ad-large/bb7d188c0f3f14016c39994dbcb6a6148bb5632b.jpg', '', '', '');



/*ANNONCES de catégorie 5: Maison*/
INSERT INTO annonce (id_annonce, titre, description_courte, description_longue, prix, photo, pays, ville, adresse, cp, id_membre, id_photo, id_categorie, date_enregistrement) VALUES

('', 'Combiné fourmicro-ondesgrill SAMSUNG', 'Combiné fourmicro-ondesgrill SAMSUNG', 'Suite à un déménagement je dois me séparer de mon super four micro-ondes combiné Samsung, acheté en mars 2016. Sous garantie jusqu’à mars 2018.
Fonctions four, grill, micro-onde et combiné. Cuisson croustillante = très pratique pour les pizzas et quiches !
- Modèle : Samsung CE107MT-4B
- Diamètre du plateau : 31,8 cm
- Capacité : 28 l
- Puissance micro-ondes : 900 W
- Puissance gril : 1500 W
- Puissance four : 2100 W - 40°C à 200°C
- Touche de départ instantané, "touche 30s".
- "TDS" : triple système de diffusion d ondes, pour une meilleure homogénéité de cuisson.
- Plat croustilleur et programmes spécifiques spécialement dédiés à la cuisson des pizzas, tartes, volailles
', 140, 'https://img0.leboncoin.fr/ad-large/78727fa1aeed325ce311ced85f69ad0edab03dba.jpg', 'France', 'Colombes', '24, Allée des Roses', '92700', 2, 1, 5, ''),

('', 'stickers triangle noir', 'stickers triangle noir', 'Grands stickers triangle à coller au mur pour une déco originale. idéal pour une chambre d enfant. La plaquette est composée de 52 stickers.
Envoi par la Poste ou remise en mains propres à Bonneuil sur marne.', 5, 'https://img6.leboncoin.fr/ad-large/8f5e250266f382b415b7d6f44372651c39750d85.jpg', 'France', 'Bonneuil-sur-Marne', '77, bv Jean-Nouvel', '94380', 6, 2, 5, ''),

('', 'Table et chaises', 'Table et chaises', 'Ensemble table plus 6 chaises . Les chaises sont en parfait état , la table a été abîmée par une bougie , d où les bandes violettes qui la recouvrent .
Mesure de la table longueur 150 hauteur 76. Largeur 90 .
Le tout 200Euro , à retirer uniquement le 2 juillet', 200, 'https://img3.leboncoin.fr/ad-large/10f441a32b9069bdb8eb3eb3e3f1adca180fda5a.jpg', 'France', 'Paris', '4,rue du puit', '75011', 5, 3, 5, ''),


('', 'Tapis akar grisblanc La Redoute', 'Tapis akar grisblanc La Redoute', 'Bonjour, Je vends ce tapis tissé à plat, Dakar gris & blanc La Redoute pour 25€ au lieu de 60€.
Acheté il y a 6 mois donc quasi neuf. Dimensions : 120 x 170 cm. A venir chercher sur Paris 9', 25, 'https://img0.leboncoin.fr/ad-large/071f568109a007641ababb9259de8fae2ac9bada.jpg', 'France', 'Paris', '53, rue Chevreul', '75009', 4, 4, 5, ''),

('', 'Ventilateur sur pied', 'Ventilateur sur pied', 'Vend ventilateur sur pied de marque bionaire. Très très puissant, 3 vitesses. Contact uniquement par SMS !
A VENIR CHERCHER SUR PLACE à Maisons-Alfort.
Ou pour voir mes autres annonces taper : Mrpaschère
', 50, 'https://img4.leboncoin.fr/ad-large/327f148c593976a5edcf7f8c9c3c2482919b6c10.jpg', 'France', 'Maisons-Alfort', '13, rue de la Marne', '94700', 3, 5, 5, '');


/*-------------------------------------*/

/*PHOTOS de catégorie 5: Vacances*/
INSERT INTO photo (id_photo, photo1, photo2, photo3, photo4, photo5) VALUES
('', 'https://img1.leboncoin.fr/ad-image/ec5ed9c2d32e63e1bcba6c269499e9d40fd889e8.jpg', 'https://img6.leboncoin.fr/ad-large/324f5c76bddc64bab3dad79bae868ac22fe463a5.jpg', 'https://img3.leboncoin.fr/ad-large/e0986e1d0bd59d4cf64328806634560ea47f7bdf.jpg', 'https://img1.leboncoin.fr/ad-large/38747869f2263f5403ed51531a4b6aec791ca8a1.jpg', 'https://img3.leboncoin.fr/ad-large/770a096c4db8fd25f4ff32dbe37a1e13332e0e13.jpg'),
('', 'https://img4.leboncoin.fr/ad-large/2d286ec2bcefecc092108ce130b62f703eab7fd0.jpg', 'https://img0.leboncoin.fr/ad-large/4f0495bcd0cf3ef42f10ba73025e0747be2ab2d7.jpg', 'https://img1.leboncoin.fr/ad-large/68931a42568514aac94914cc895fdb5110a2df70.jpg', '', ''),
('', 'https://img0.leboncoin.fr/ad-image/fab5516138fd3a28db5c1ea04ba1227091500f9a.jpg', 'https://img0.leboncoin.fr/ad-large/ead9192fc329f3de96cfc95233e943536de451db.jpg', 'https://img3.leboncoin.fr/ad-large/97b014a72d32ce5e166da358fad368bab7959c32.jpg', '', ''),
('', 'https://img3.leboncoin.fr/ad-large/f40201bbebc855b95f87caba3b8cbe32325ae38a.jpg', 'https://img3.leboncoin.fr/ad-large/3258438d8d69141a828cbd02288692d76d2ff663.jpg', 'https://img2.leboncoin.fr/ad-large/d8704905cb5526ba25428780ed604e47e18d566e.jpg', '', ''),
('', 'https://img3.leboncoin.fr/ad-large/a0a4c921681e00c180b5d21ad0387805b45b631d.jpg', 'https://img7.leboncoin.fr/ad-large/55adaeeb1b7759a15cdb7260bfeecdf9528bfa2e.jpg', 'https://img4.leboncoin.fr/ad-large/47ca7bbfd1aec5a1cb18638b05efe6fe02df68bf.jpg', 'https://img3.leboncoin.fr/ad-large/685062bb1464cf7b621c4a027d388ac4e02a84ca.jpg', 'https://img5.leboncoin.fr/ad-large/2c373caf36dc90bf6e862f85f9e247bfeeb21f7f.jpg');




/*ANNONCES de catégorie 6: Vacances*/
INSERT INTO annonce (titre, description_courte, description_longue, prix, photo, pays, ville, adresse, cp, id_membre, id_photo, id_categorie, date_enregistrement) VALUES

('Charming & Cosy Flat', 'Charming & Cosy Flat in Le Marais ', 'Bonjour, Cet appartement lumineux et bien équipé est situé au coeur de Paris dans l un des quartiers touristiques les plus populaires: Le Marais. À seulement 300 mètres de la Place des Vosges, cet appartement est la base idéale pour votre séjour à Paris. Ce charmant appartement comprend une chambre double, un salon, un coin repas, une cuisine bien équipée et une salle de bains.
À bientôt !
', 500, 'https://img1.leboncoin.fr/ad-image/ec5ed9c2d32e63e1bcba6c269499e9d40fd889e8.jpg', 'France', 'Paris', '12, rue Barbette', '75003', '', 6, 6, ''),

('Appartement 68m² pour6 avec Climatisation', 'Appartement 68m² pour6 avec Climatisation', 'Location de vacances Bed and Breakfast
2 CHAMBRES pour 4 personnes, Prix : 69€/nuits, 2 nuits minimum + 22€ de forfait nettoyage.
La Caution est de 350€ en liquide à l entrée .Réception ouverte 24 sur 24h 2 Chambres avec porte fenètre, balcon orienté sud, équipé de Wifi, Télé, lit double. Dans un appartement Calme et lumineux pour 4 personnes dans un beau 3 pièces entièrement rénové en centre-ville avec de nombreux commerces et moyen de transport, métro au pied de l immeuble. A deux pas du marché aux puces (5 millions de visiteur par an), et de la colline des peintres de Montmartre, Cuisine dinatoire toute équipée , salle de bain baignoire, wc séparé.
Métro ligne n°13 Garibaldi et n°4 porte de Clignancourt 
', 390, 'https://img4.leboncoin.fr/ad-large/2d286ec2bcefecc092108ce130b62f703eab7fd0.jpg', 'France', 'Paris', '17, rue de la crèmerie', '75018', '', 7, 6, ''),

('Chambre pavillon jardin ', 'Charming & Cosy Flat in Le Marais ', 'pour vous détendre à 20 min de Paris, en bordure de forêt ,nous vous accueillons dans une chambre de 15m2 av wc sdb 4m2 attenants privatifs, profitez d un accès direct jardin par la porte fenêtre dans la chambre , un petit salon de jardin vous y attend, Vous disposez au choix , de 2 lits 90 ou d un grand lit de 180. (possibilite lit bébé sur demande. )Linge de toilette et de lit fournis, lit fait à votre arrivée, frigo et micro onde à disposition , petit déjeuner en supplément 5Euro(s)/ pers. et possibilité plateau repas 8Euro(s)/ pers. WIFFI Haut Debit .A 20min Paris par rer D, gare 25 min à pieds, 10 min en voiture, ou bus à 5min pour allez gare.
proximité commerces, restaurants, forêt de sénart, parc caillebotte, Dojo yerres,lycée St Pierre (possibilité location jeune étudiant )
pour toute demande ENVOYEZ UN MAIL je réponds dans la journée et je vous envoie le lien pour reservation.
, pour Juin : dispo du 30 juin au 2juillet. pour Juillet : dispo du 7 au 9, du 13 au 16 du 21 au 28 pour Aout : du 19 au 31.
A partir de septembre libre sauf we du23 au 24
', 37, 'https://img0.leboncoin.fr/ad-image/fab5516138fd3a28db5c1ea04ba1227091500f9a.jpg', 'France', 'Yerres', 'Allée des forêts', '91330', '', 8, 6, ''),

('Grand 2 pièces de 70 m2 à RAMBOUILLET ', 'Grand 2 pièces de 70 m2 à RAMBOUILLET ', 'RAMBOUILLET à 50 m de la station du bus qui vous conduit à la gare RER, 30 minutes de PARIS MONTPARNASSE, venez découvrir ce grand 2 pièces tout équipé de 70m2. Cuisine, espace repas et salon accès terrasse privative, salle de bains double avec baignoire balnéo/jacuzzi et douche à jets, dressing aménagé, et vaste chambre avec lit king size. Situé dans une chaumière pleine de charme, profitez du jardin de 2000 m2, clos, arboré et sécurisé.
115 € la nuit (petit déjeuner possible + 8 €)
Je suis joignable au : 0781808563 ou par mail : lorinvest.in@gmail.com
Bon séjour chez nous.
', 115, 'https://img3.leboncoin.fr/ad-large/f40201bbebc855b95f87caba3b8cbe32325ae38a.jpg', 'France', 'Rambouillet', 'Rue Mitterand', '78120 ', '', 9, 6, ''),

('Location chambre d hôtes  ', 'Location chambre d hôtes ', 'A louer chambre d hôtes avec sdb double vasque douche Italienne en tout 60 m2 . Pouvant accueillir de 1 à 4 personnes de la même famille ou même groupe dormants 2 par 2. Très confortable de bon standing et lumineuse dans un pavillon particulier au 3éme étage. Vue sur la marne et les villes aux alentours. Par beau temps on aperçois la pointe de la tour Eiffel.
Place de Stationnement sur la terrasse , Wi Fi , penderie , 2 grands lits de 160 cm très confortable commode, tv, bureau, canapé, frigo, bouilloire, . idéal affaire, visite de la famille ou loisir. Exemple par nuit avec petit déj : pour 1 pers 75 € . 2 pers 85 € 3 ou 4 pers 135 € petit déjeuner inclus. Location à la semaine me contacter par mail ou téléphone.
Entrée de la ville proche commerces à pied. Accès RER A (Est parisien ) en bus ou à pied 1 km. Centre de Paris en transport 15 Min Disney 25 Min.
Plus de photos sur demande avec plaisir.
', 100, 'https://img3.leboncoin.fr/ad-large/a0a4c921681e00c180b5d21ad0387805b45b631d.jpg', 'France', 'Bry-sur-Marne', 'Rue Clemenceau', '94360', '', 10, 6, '');
