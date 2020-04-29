<script>
	function modif_cat(id, label) {
		var html = $.ajax({
			url: "modif_cat.php",
			data: "id=" + id + "&label=" + label,
			async: false
		}).responseText;
		if (html != '') {
			window.location.reload();
		}
	}
	function suppr_cat(id) {
		var html = $.ajax({
			url: "suppr_cat.php",
			data: "id=" + id,
			async: false
		}).responseText;
		if (html != '') {
			window.location.reload();
		}
	}
</script>
<?php
if (isset($_POST['valider']) && !empty($_POST) ) {
    $errors = array();
	if (empty($_POST['label']) ) {
		$errors['label'] = "Vous n'avez rien inscrit dans le champ \"nom de la categorie\".";
	} 
	else {
		$req = $db->query("SELECT id FROM category WHERE label = '" . $_POST['label'] . "'");
		$categ = $req->fetch_object();
		if ($categ) {
			$_SESSION['flash']['danger'] = 'Cette catégorie existe déjà.';
			echo "<script>location.href='index.php?p=category';</script>";
			exit();
		}
	}

	if (empty($errors)) {
		if (empty($errors)) {
			
			$req = $db->query("INSERT INTO category SET
					label = '" . addslashes($_POST['label']) . "'

					") OR die($db->error);

			$_SESSION['flash']['success'] = 'la catégorie a été créée.';
			echo "<script>location.href='index.php?p=category';</script>";
			exit();
		}
		else {
			$_SESSION['flash']['danger'] = 'un probleme est survenu<br>.'.print_r($errors);
			echo "<script>location.href='index.php?p=category';</script>";
			exit();
		}
	}
}

?>

<h1 class="text-center">Catégories</h1>

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
$category = array();
$rqt_cat = $db->query("SELECT id, label FROM category");
if ($rqt_cat->num_rows > 0) {
	while($cat = $rqt_cat->fetch_object()){
		$category[$cat->id] = $cat->label;
	}
}
?>
<h2>Liste des catégories</h2>
<table class="table table-bordered">
	<thead>
		<tr>
			<th> Id </th>
			<th> Label </th>
			<th class="text-center"> <i class="fas fa-trash"></i> </th>
		</tr>
	</thead>

	<tbody>
		
	
		<?php
		if (!empty($category)){
			foreach($category as $key => $value){ ?>
				<tr>
					<td class=""><?=$key;?></td>
					<td class="">
						<div id="label<?=$key;?>">
							<?=$value;?> <i class="fas fa-pencil-alt" onclick="javascript:$('#label<?=$key;?>').hide(); $('#modif<?=$key;?>').show(500);"></i>
						</div>
						<div id="modif<?=$key;?>" style="display:none;" class="form-inline">
							
								<input type="hidden" id="modif_id<?=$key;?>" value="<?=$key;?>" />
								<input type="text" id="modif_label<?=$key;?>" class="form-control " value="<?=$value;?>" size="70" required  />
								<button type="button" class="btn btn-success" onclick="javascript:modif_cat($('#modif_id<?=$key;?>').val(),$('#modif_label<?=$key;?>').val());">modifier</button>
							
							  
						</div>
					</td>
					<td class="text-center text-danger"><i class="fas fa-trash" onclick="javascript:if(!confirm('êtes vous sûr ?')){return false;} else{suppr_cat('<?=$key;?>');}"></i></td>
				</tr>
				<?php
			}
		}
		else { ?>
			<tr><td colspan="2">Vous n'avez pas créé de categorie.</td></tr>
			<?php
		}
		?>
		
	</tbody>
</table>

<hr>

<h2>Ajouter une catégorie</h2>
<form action="" method="POST">
	<div class="row">
		<div class="form-group col-md-12" id="">

			<label class="control-label" for="mail">Nom de la catégorie</label>
			<input type="text" name="label" class="form-control " value="" size="70" required  />

		</div>
	</div>
	<br>


	<button type="submit" class="btn btn-success" name="valider">Valider</button>
	<button type="reset" class="btn btn-default" onclick="javascript:window.location.reload();">Recommencer</button>
</form>



