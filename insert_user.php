<?php
function str_random($length){
    $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
    return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
}

if (isset($_POST['valider']) && !empty($_POST)) {
    $errors = array();
	if (empty($_POST['email']) ) {
		$errors['email'] = "Votre email n'est pas valide.";
	} 
	else {
		$req = $db->query("SELECT id FROM user WHERE email = '" . $_POST['email'] . "'");
		$mail = $req->fetch_object();
		if ($mail) {
			$_SESSION['flash']['danger'] = 'Cet email est déjà utilisé pour un autre compte.';
			echo "<script>location.href='index.php';</script>";
			exit();
		}
	}

	if (empty($_POST['password'])) {
		$errors['password'] = "Vous devez saisir un mot de passe valide.";
	}

	$d = explode('/',$_POST['birthdate']);
	$date = $d[2].'-'.$d[1].'-'.$d[0];


	if (empty($errors)) {
		if (empty($errors)) {
			$token = str_random(64);
			$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

			$req = $db->query("INSERT INTO user SET
					email = '" . $_POST['email'] . "',
					password = '" . $password . "',
					birthdate = '".$date."'

					") OR die($db->error);

			$_SESSION['flash']['success'] = 'l\'utilisateur a été créé. Vous pouvez vous connecter.';
			echo "<script>location.href='index.php';</script>";
			exit();
		}
		else {
			$_SESSION['flash']['danger'] = 'un probleme est survenu<br>.'.print_r($errors);
			echo "<script>location.href='index.php';</script>";
			exit();
		}
	}
}

?>

<h1 class="text-center">Créer un utilisateur</h1>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <p>Vous n'avez pas rempli le formulaire correctement</p>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; 

?>

<hr>


<form action="" method="POST">
	<div class="row">
		<div class="form-group col-md-12" id="">

			<label class="control-label" for="mail">Saisissez votre email</label>
			<input type="text" name="email" class="form-control " id="mail" value="" size="70" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2, 4}$" />

		</div>
	</div>
	<br>

	<div class="row">
		<div class="col-md-12" id="">
			<label class="required control-label" for="password">Choisissez un mot de passe</label><br>
			Le mot de passe doit contenir au moins 8 caracteres avec des lettres minuscules, des lettres majuscules, des chiffres ainsi que des caractères spéciaux comme #, {, [, @, + ...
		</div>
	</div>

	<div class="row">
		<div class="form-group col-md-12" >

			<input type="password" name="password" class="form-control" id="password" value="" size="12" required title="8 caracteres minimum" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" />
		</div>
	</div>

	<div class="row">
		<div class="form-group col-md-12">
			<label class="required control-label" for="password">Veuillez saisir votre date de naissance au format JJ/MM/AAAA</label>
			<input type="birthdate" name="birthdate" class="form-control" id="birthdate" value="" size="12" required pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])/(0[1-9]|1[012])/[0-9]{4}" />
		</div>
	</div>

	<button type="submit" class="btn btn-success" name="valider">Valider</button>
	<button type="reset" class="btn btn-default" onclick="javascript:window.location.reload();">Recommencer</button>
</form>



