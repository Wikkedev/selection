<?php
if (isset($_POST['valider']) && !empty($_POST) ) {
    $errors = array();
	if (empty($_POST['id_category']) ) {
		$errors['id_category'] = "Vous n\'avez pas choisi la catégorie.";
	} 
	if (empty($_POST['title']) ) {
		$errors['title'] = "Vous n'avez pas saisi le nom du sujet.";
	} 
	
	if (empty($errors)) {
		if (empty($errors)) {
			
			$req = $db->query("INSERT INTO topic SET
					title = '".addslashes($_POST['title'])."',
					id_user = '".$_SESSION['user']->id."',
					id_category = '".$_POST['id_category']."'

					") OR die($db->error);

			$_SESSION['flash']['success'] = 'Ce sujet a été ajouté.';
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
	if (empty($_POST['title']) ) {
		$errors['title'] = "Vous n\'avez pas ajouté de sujet.";
	} 

	if (empty($errors)) {
		if (empty($errors)) {
			
			$req = $db->query("UPDATE topic SET
					title = '" . addslashes($_POST['title']) . "'
					WHERE id = '".$_POST['id']."'
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

<h1 class="text-center">TOPIC</h1>

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
if (isset($_GET['id_topic'])){
	$rqt_topic = $db->query("SELECT title FROM topic, id_category WHERE id = '".$_GET['id_topic']."' AND id_user = '".$_SESSION['user']->id."'");
	$topic = $rqt_topic->fetch_object();
	$name = "modifier";
}
else {
	$topic = '';
	$name = "valider";
}

?>


<h2>Ajouter ou modifer un Sujet</h2>
<form action="" method="POST">
	<div class="row">
		<div class="form-group col-md-12" id="">
			<input type="hidden" name="id_topic" value="<?=$_GET['id_topic'];?>" ?>
			
			<label class="control-label" for="mail">Sujet</label>
			<input type="text" name="title" class="form-control " value="<?=stripslashes($post->title);?>" required size="70" />
			
			<?php
			$rqt_cat = $db->query("SELECT id, label FROM category ORDER BY label");?>
			<select name="id_category" >
				<option>Coisissez une catégorie</option>
				<?php
				while( $cat = $rqt_cat->fetch_object()){
					if(isset($topic->id_category) && $topic->id_category == $cat->id){$select = 'selected="selected"';} else {$select = '';} ?>
					<option value="<?=$cat->id;?>" <?=$select;?>><?=$cat->label;?></option>
					<?php
				} ?>
			</select>

		</div>
	</div>
	<br>


	<button type="submit" class="btn btn-success" name="<?=$name;?>"><?=$name;?></button>
</form>



