-- this is the model used for the database (in french)

CREATE DATABASE IF NOT EXISTS boutique;

USE boutique ;

CREATE TABLE IF NOT EXISTS membre (
  id_membre int(3) NOT NULL AUTO_INCREMENT,
  pseudo varchar(20) NOT NULL,
  mdp varchar(60) NOT NULL,
  nom varchar(20) NOT NULL,
  prenom varchar(20) NOT NULL,
  email varchar(50) NOT NULL,
  civilite enum('m','f') NOT NULL,
  ville varchar(20) NOT NULL,
  code_postal int(5) unsigned zerofill NOT NULL,
  adresse varchar(50) NOT NULL,
  statut int(1) NOT NULL DEFAULT '0',
  date_enregistrement DATETIME,
  date_modification DATETIME,
  PRIMARY KEY (id_membre),
  UNIQUE KEY pseudo (pseudo),
  UNIQUE KEY email (email)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;


INSERT INTO membre (id_membre, pseudo, mdp, nom, prenom, email, civilite, ville, code_postal, adresse, statut) VALUES
(1, 'membre', '$2y$10$TuqJbXsu7yNMeZW0MM0L4OI79fpmC.tb3sqt7fQxnO9hUvU4jawSS', 'membre', 'membre', 'membre@exemple.com', 'f', 'Toulouse', 31000, '55 rue bayard', 0),
(2, 'admin', '$2y$10$DTLHxTGP90/jF5vagdWM3u1tbhNCeSOFFQa2rmwasDwnT2cYxww7e', 'admin', 'admin', 'admin@exemple.com', 'm', 'Paris', 75015, '33 rue mademoiselle', 1);


CREATE TABLE IF NOT EXISTS produit (
  id_produit int(3) NOT NULL AUTO_INCREMENT,
  reference varchar(20) NOT NULL,
  categorie varchar(20) NOT NULL,
  titre varchar(100) NOT NULL,
  description text NOT NULL,
  couleur varchar(20) NOT NULL,
  taille varchar(5) NOT NULL,
  sexe enum('m','f','mixte') NOT NULL,
  photo varchar(250) NOT NULL,
  prix int(3) NOT NULL,
  stock int(3) NOT NULL,
  PRIMARY KEY (id_produit)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

INSERT INTO produit (id_produit, reference, categorie, titre, description, couleur, taille, sexe, photo, prix, stock) VALUES
(1, '11-d-23', 'tshirt', 'Tshirt Col V', 'Tee-shirt en coton flammé liseré contrastant', 'bleu', 'M', 'm', 'https://picsum.photos/300/200?image=12', 20, 53),
(2, '66-f-15', 'tshirt', 'Tshirt Col V rouge', 'c''est vraiment un super tshirt en soir&eacute;e !', 'rouge', 'L', 'm', 'https://picsum.photos/300/200?image=25', 15, 230),
(3, '88-g-77', 'tshirt', 'Tshirt Col rond vert', 'Il vous faut ce tshirt Made In France !!!', 'vert', 'L', 'm', 'https://picsum.photos/300/200?image=42', 29, 63),
(4, '55-b-38', 'tshirt', 'Tshirt jaune', 'le jaune reviens &agrave; la mode, non? :-)', 'jaune', 'S', 'm', 'https://picsum.photos/300/200?image=125', 20, 3),
(5, '31-p-33', 'tshirt', 'Tshirt noir original', 'voici un tshirt noir tr&egrave;s original :p', 'noir', 'XL', 'm', 'https://picsum.photos/300/200?image=22', 25, 80),
(6, '56-a-65', 'chemise', 'Chemise Blanche', 'Les chemises c''est bien mieux que les tshirts', 'blanc', 'L', 'm', 'https://picsum.photos/300/200?image=57', 49, 73),
(7, '63-s-63', 'chemise', 'Chemise Noir', 'Comme vous pouvez le voir c''est une chemise noir...', 'noir', 'M', 'm', 'https://picsum.photos/300/200?image=35', 59, 120),
(8, '77-p-79', 'pull', 'Pull gris', 'Pull gris pour l''hiver', 'gris', 'XL', 'f', 'https://picsum.photos/300/200?image=68', 79, 99);
