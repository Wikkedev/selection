<?php 

session_start();
header('Content-type: text/html; charset=uft-8');

include('connect.php');
if(isset($_GET['id']) && $_GET['id'] != ''){

    $id = $_GET['id'];

	$db->query("DELETE from category WHERE id = '".$id."'");

    $_SESSION['flash']['success'] = 'Cette categorie a été supprimée.';

    echo "ok";
}

	

			 



