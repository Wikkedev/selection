<?php

    $serveur='serveur';
    $login='login';
    $mot_de_passe='password';
    $nom_bd='nom_de_la_base';

	$db = new mysqli($serveur, $login, $mot_de_passe, $nom_bd);

	if ($db->connect_errno){
		die('Erreur de connexion : ' . $db->connect_error);
	}
	$db->set_charset("utf8");

