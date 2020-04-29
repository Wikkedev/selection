
1- Création des tables avec phpmyadmin -> fichier mysql.sql
	- 20 minutes
	
2- 

Ressources utilisées :
	- https://getbootstrap.com

	- https://www.geeksforgeeks.org pour pattern bien que http://html5pattern.com/Emails conseil de ne pas utiliser pattern pour verifier l'email. L'envoi d'un mail à l'adresse avec un lien de validation est plus sûr avant de créer un compte.

	- le site php.net pour les fonctions

	- Il y a longtemps, j'ai beaucoup surfer sur openclassroom (anciennement site du zéro) mais je n'en ai pas eu besoin pour cet exercice.

	- Les ressources que j'utilise le plus souvent sont enregistrées dans mes favoris (bootstrap, fontawesome, jquery ...) et pour le reste, "google et mon ami".

	- J'ai utiisé mes connaissances et la manière de faire aquis depuis plusieurs années.

	- J'y ai passé environ 8 heures réparties sur 2 jours (28 et 29 avril)

	- J'ai dû chercher ce qu'était le CRUD, (ha, les accronymes). Je sais faire, mais je ne savais pas qu'on regroupait ces fonctions sous ce terme.

	- Tout n'est pas developpé et j'espère que ce n'est pas le but de l'exercice. 

	- Je me suis aussi refusé de faire du copier/coller de solutions toutes codées pour "créer un composant d'accès aux données (Repository/DAO) SQL". j'en ai trouvé : https://codeshack.io/crud-application-php-pdo-mysql/ , https://codereview.stackexchange.com/questions/71256/small-php-dao-app , https://codes-sources.commentcamarche.net/source/38288-classe-objet-dao-couche-d-acces-a-mysql-data-access-object , http://phpdao.com/, https://www.modelit.xyz/blog/connection-mysql-php-dao/ , ....
	J'ai préférer montrer ce que je sais faire.

GITHUB
	Vous trouverez les fichiers sur mon GITHUB que j'ai créer pour cette exercice et j'ai mis les fichiers sur mon site interet 'www.lerefugeinformatique' (dont je ne me suis pas occupé depuis plusieurs année ). Voici le lien : http://www.lerefugeinformatique.fr/simplon/index.php?p=mon_compte
	Vous aurez ainsi un aperçu visuel de mon travail.


Mon résonnement :
 	N'importe qui peut créer des catégories avec la possibilité d'ajouter, modifier, supprimer ces catégories qui sont listées sur la page.
	Pour le reste, il faut être connecté.
	Donc il y a une page pour créer un compte USER (insert_user.php). Puis l'utilisateur se connecte depuis la page d'accueil en cliquant sur connection.
	L'utilisateur arrive sur la page mon compte (mon_compte.php) où il peut voir et modifier les informations qu'il a saisi lors de l'inscription.
	L'utilisateur peut aussi à partir de cette page créer un Topic. 

	Je me suis arreté à la création de ce topic puisque j'ai déja montré que je pouvais modifier ou supprimer les entités. 
	Si j'allais plus loin, je rendrais cliquable un topic ouvrant une page dans laquelle on verait tous les messages (post) de ce topic avec la possibilité d'en ajouter un nouveau.
	La page post.php que j'ai commencé à créer, permettrait de visualiser les posts aprés avoir selectionné un topic mais seuls les utilisateurs connectés pourraient ajouter un message.
	Message qui pourrait etre modifié ou supprimé suivant les besoins.






	
	