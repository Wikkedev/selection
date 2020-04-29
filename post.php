<?php
if (isset($_POST['valider']) && !empty($_POST) ) {
    $errors = array();
	if (empty($_POST['content']) ) {
		$errors['content'] = "Vous n\'avez pas ajouté de message.";
	} 
	if (empty($_POST['id_topic']) ) {
		$errors['content'] = "Vous n'avez pas choisi de sujet.";
	} 
	
	if (empty($errors)) {
		if (empty($errors)) {
			
			$req = $db->query("INSERT INTO post SET
					post_date = '".date("Y-m-d", time())."',
					content = '".addslashes($_POST['content'])."',
					id_user = '".$_SESSION['user']->id."',
					id_topic = '".$_POST['id_topic']."'

					") OR die($db->error);

			$_SESSION['flash']['success'] = 'Ce post a été ajouté.';
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
if (isset($_POST['modifier']) && !empty($_POST) ) {
	if (empty($_POST['content']) ) {
		$errors['content'] = "Vous n\'avez pas ajouté de message.";
	} 

	if (empty($errors)) {
		if (empty($errors)) {
			
			$req = $db->query("UPDATE post SET
					post_date = '".date("Y-m-d", time())."',
					content = '" . addslashes($_POST['content']) . "'
					WHERE id = '".$_POST['id_post']."'
					") OR die($db->error);

			$_SESSION['flash']['success'] = 'le post a été modifié.';
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

<h1 class="text-center">POST</h1>

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
echo $retour;
?>

<hr>
<?php
if (isset($_GET['id_post'])){
	$rqt_post = $db->query("SELECT content FROM post WHERE id = '".$_GET['id']."' AND id_user = '".$_SESSION['user']->id."'");
	$post = $rqt_post->fetch_object();
	$name = "modifier";
}
else {
	$post = '';
	$name = "valider";
}

?>

<hr>

<h2>Ajouter un post</h2>
<form action="" method="POST">
	<div class="row">
		<div class="form-group col-md-12" id="">
			<input type="hidden" name="id_topic" value="<?=$_GET['topic'];?>" />
			<input type="hidden" name="id_post" value="<?=$_GET['id_post'];?>" ?>
			
			<label class="control-label" for="mail">Commentaire</label>
			<textarea name="content" class="form-control " value="<?=stripslashes($post->content);?>" required cols="20" rows="10"></textarea>

		</div>
	</div>
	<br>


	<button type="submit" class="btn btn-success" name="<?=$name;?>"><?=$name;?></button>
</form>



