<?php

if(isset($_SESSION['user'])){
    $_SESSION['flash']['warning'] = 'Vous êtes déjà connecté';
    echo "<script>location.href='index.php?p=mon_compte';</script>";
    exit();
}


if(!empty($_POST) && !empty($_POST['email']) && !empty($_POST['password'])){
	
        $req2 = $db->query("SELECT password FROM user WHERE email = '".$_POST['email']."'");
        $obj = $req2->fetch_object();
    
        if($req2->num_rows > 0 && password_verify($_POST['password'],$obj->password)){
            $req = $db->query("SELECT id, email, birthdate FROM user WHERE email = '".$_POST['email']."'");
            if ($req->num_rows > 0) {
                $user = $req->fetch_object();
                $_SESSION['user'] = $user;
				
				$_SESSION['flash']['success'] = 'Vous êtes maintenant connecté' ;//
                       echo "<script>location.href='index.php?p=mon_compte';</script>";
                        exit();
            }
            else{
                $_SESSION['flash']['danger'] = '1- Identifiant ou mot de passe incorrecte.';
                echo "<script>location.href='index.php';</script>";
                exit();
            }
        }
        else{
            $_SESSION['flash']['danger'] = '2- Identifiant ou mot de passe incorrecte. <br />Ou vous n\'avez pas activé votre compte. Vérifiez vos mail.';
            echo "<script>location.href='index.php';</script>";
            exit();
        }
}
else {
    $_SESSION['flash']['danger'] = 'Veuillez indiquer quelques informations (identifiant et mot de passe) pour la connexion.<br>
Sinon, je ne vais pas pouvoir vous connecter.';
        echo "<script>location.href='index.php';</script>";
        exit();
}
?>
