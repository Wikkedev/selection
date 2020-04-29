<?php
function str_random($length){
    $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
    return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
}

if (isset($_POST['modifier']) && !empty($_POST)) {
    $errors = array();
	if (empty($_POST['email']) ) {
		$errors['email'] = "Votre email n'est pas valide.";
	} 

	$d = explode('/',$_POST['birthdate']);
	$date = $d[2].'-'.$d[1].'-'.$d[0];

	
		

	if (empty($errors)) {
		if (empty($errors)) {
			if (empty($_POST['password'])) {

				$db->query("UPDATE user SET
						email = '" . $_POST['email'] . "',
						birthdate = '".$date."'
						WHERE id = '".$_SESSION['user']->id."'
						") OR die($db->error);
			}
			else {
				$token = str_random(64);
				$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
				$db->query("UPDATE user SET
						email = '" . $_POST['email'] . "',
						password = '" . $password . "',
						birthdate = '".$date."'
						WHERE id = '".$_SESSION['user']->id."'
						") OR die($db->error);
				
			}
			
			$req = $db->query("SELECT id, email, birthdate FROM user WHERE id = '".$_SESSION['user']->id."'");
                $user = $req->fetch_object();
                $_SESSION['user'] = $user;

			$_SESSION['flash']['success'] = 'Vos informations ont été modifiées.';
			echo "<script>location.href='index.php?p=mon_compte';</script>";
			exit();
		}
		else {
			$_SESSION['flash']['danger'] = 'un probleme est survenu<br>.'.print_r($errors);
			echo "<script>location.href='index.php?p=mon_compte';</script>";
			exit();
		}
	}
}

?>
<?php
$topic = array();
$rqt_topic = $db->query("SELECT id, title, id_category FROM topic WHERE id_user = '".$_SESSION['user']->id."'");
if($rqt_topic->num_rows > 0){
	while($to = $rqt_topic->fetch_object()){
		$rqt_cat = $db->query("SELECT id, label FROM category WHERE id = '".$to->id_category."'");
		$cat = $rqt_cat->fetch_object();
		$topic[$to->id] = $to->title.'|'.$cat->label;
	}
}
?>

<h1 class="text-center">Mon Compte</h1>

<?php if(isset($_SESSION['user'])){ ?>
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

	/*$rqt_user = $db->query("SELECT id, email, birthdate FROM user WHERE id = '".$_SESSION['auth']->id."'");
	$user = $rqt_user->fetch_object();*/

	$d = explode('-',$_SESSION['user']->birthdate);
	$date = $d[2].'/'.$d[1].'/'.$d[0];
	?>

	<hr>

	<div class="row">
		<div class="col-sm-6">
			<h2> Mes coordonnées </h2>
			<form action="" method="POST">
				<div class="row">
					<div class="form-group col-md-12" id="">

						<label class="control-label" for="mail">Votre email</label>
						<input type="text" name="email" class="form-control " id="mail" value="<?=$_SESSION['user']->email;?>" size="70" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2, 4}$" />

					</div>
				</div>
				<br>

				<div class="row">
					<div class="col-md-12" id="">
						<label class="required control-label" for="password">Votre mot de passe</label><br>
						<em>Votre mot de passe ne peut pas être affiché ici car il est cripté dans la base de donnée et seul vous le connaissez.<br>
						<b>Si vous saisissez quelque chose ici, le systeme prendra en compte cette information comme nouveau mot de passe</b><br>
						Le mot de passe doit contenir au moins 8 caracteres avec des lettres minuscules, des lettres majuscules, des chiffres ainsi que des caractères spéciaux comme #, {, [, @, + ...</em>
					</div>
				</div>

				<div class="row">
					<div class="form-group col-md-12" >

						<input type="password" name="password" class="form-control" id="password" value="" size="12" title="8 caracteres minimum" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" placeholder="********"/>
					</div>
				</div>

				<div class="row">
					<div class="form-group col-md-12">
						<label class="required control-label" for="password">Votre date de naissance au format JJ/MM/AAAA</label>
						<input type="birthdate" name="birthdate" class="form-control" id="birthdate" value="<?=$date;?>" size="12" required pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])/(0[1-9]|1[012])/[0-9]{4}" />
					</div>
				</div>

				<button type="submit" class="btn btn-success" name="modifier">Modifier</button>

			</form>
		</div>
		<div class="col-sm-6">
			<h2> Mes Sujets </h2>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>id</th>

						<th>Topic</th>
						<th>Catégorie</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td colspan="4"><a href="index.php?p=topic" class="btn btn-success">Créer un nouveau sujet</a></td>
					</tr>
					<?php
					//$post[$to->id] = $to->post_date.'|'.$to->content.'|'.$to->id_user.'|'.$to->id_topic.'|'.$to->topic_title.'|'.$to->category;
					foreach($topic as $key => $value){
						$t = explode('|', $value);
						$dp = explode('-',$p[0]);
						$date_post = $d[2].'/'.$d[1].'/'.$d[0];
						?>
						<tr>
							<td><?=$key;?></td>

							<td><?=$t[0];?></td>
							<td><?=$t[1];?></td>
						</tr>
						<?php
					} ?>
				</tbody>
			</table>
		</div>
	</div>
		<?php
}
else {?>
	<div class="alert alert-info">
		Vous devez vous <a href="index.php?p=insert_user">Vous inscrire</a> ou vous connecter pour accéder aux informations.<br>
		Pour vous connecter, vous pouvez utiliser les identifiants suivant :<br>
		identifiant : simplon@mail.com <br>
		Mot de passe : Simplon@123
	</div>
	<?php
}



