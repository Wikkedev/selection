/* Création des tables */

/* creation de la table user avec une clé primaire sur id et auto-incrémentation */
CREATE TABLE `user` (
	`id` int(11) NOT NULL,
	`email` text NOT NULL,
	`password` text NOT NULL,
	`birthdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table des utilisateurs';

ALTER TABLE `user` ADD PRIMARY KEY (`id`);
ALTER TABLE `user` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

/* création de la table category avec une clé primaire sur id et auto-incrémentation */
CREATE TABLE `category` (
	`id` int(11) NOT NULL,
	`label` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table des categories';

ALTER TABLE `category` ADD PRIMARY KEY (`id`);
ALTER TABLE `category` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

/* création de la table topic avec une clé primaire sur id et auto-incrémentation 
Le topic fait reference à la categorie (id_category) et a été créé par un utilisateur (id_user) */
CREATE TABLE `topic` (
	`id` int(11) NOT NULL,
	`title` text NOT NULL,
	`id_user` int(11) NOT NULL,
	`id_category` int(11) NOT NULL
	
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table des sujets';

ALTER TABLE `topic` ADD PRIMARY KEY (`id`);
ALTER TABLE `topic` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

/* création de la table post avec une clé primaire sur id et auto-incrémentation 
Le post fait reference à un topic (id_category) et a été créé par un utilisateur (id_user) */
CREATE TABLE `post` (
	`id` int(11) NOT NULL,
	`post_date` date NOT NULL,
	`content` text NOT NULL,
	`id_user` int(11) NOT NULL,
	`id_topic` int(11) NOT NULL
	
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table des categories';

ALTER TABLE `post` ADD PRIMARY KEY (`id`);
ALTER TABLE `post` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;