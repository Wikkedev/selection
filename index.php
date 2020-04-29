<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
include('connect.php');

include('url.php');



if(isset($_GET['deconnect'])){
    unset($_SESSION['user']);
    //vidersession();
    $_SESSION['flash']['success'] = 'Vous êtes maintenant déconnecté';
    echo "<script>location.href='index.php';</script>";
    exit();
}
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Simplon</title>
	
	<link  href="bootstrap-4.4.1/css/bootstrap.css" rel="stylesheet" type="text/css">
	
	<link href="fontawesome-free-5.13.0/css/all.css" rel="stylesheet" type="text/css">
	
</head>


<body>
	<div class="container">

		<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
			<a class="navbar-brand" href="index.php">Simplon</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
			<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
				<div class="navbar-nav">
					<a class="nav-item nav-link active" href="index.php">Accueil </a>
					<a class="nav-item nav-link" href="#">Sujets</a>
					<a class="nav-item nav-link" href="index.php?p=category">Catégories</a>
					<a class="nav-item nav-link" href="index.php?p=mon_compte">Mon compte</a>

				</div>
			</div>
			<?php
			if (isset($_SESSION['user'])){ ?>
				<div class="list-inline hidden-sm hidden-xs ">
					<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
						<i class="fas fa-user"></i> (<?=$_SESSION['user']->id;?>) <?=stripslashes($_SESSION['user']->email);?>
					</a>
					<ul class="dropdown-menu dropdown-menu-right dropdown-animation p-2">
						<li class="light-gray-bg"><a href="index.php?p=Mon compte <?=$mon_compte;?>">Mon compte</a></li>
						<li class="light-gray-bg"><a href="index.php?p=Modifier mon mot de passe">Modifier mon mot de passe</a></li>
						<li class="light-gray-bg"><a href="index.php?deconnect"><span class="glyphicon glyphicon-off" ></span> Se déconnecter</a></li>
					</ul>
				</div>
				<?php
			} 
			else { ?>
				<div class="header-top-dropdown text-right">
					<div class="btn">
						<a href="index.php?p=insert_user" class="btn btn-default btn-sm"><i class="fas fa-user"></i> Inscription</a>
					</div>
					<div class="btn dropdown">
						<button type="button" class="btn dropdown-toggle btn-default btn-sm" data-toggle="dropdown"><i class="fas fa-lock pr-10"></i> Connexion</button>
						<ul class="dropdown-menu dropdown-menu-right dropdown-animation" aria-labelledby="header-top-drop-2">
							<li>
								<form class="text-dark p-2" action="index.php?p=connexion" method="POST">
									<div class="form-group form-inline">
										<label for="email" class="control-label">Identifiant :</label>
										<input type="text" class="form-control" placeholder="" name="email" id="email">
									</div>
									<div class="form-group form-inline">
										<label class="control-label">Mot de passe :</label>
										<input type="password" class="form-control" placeholder="" name="password">
									</div>
									<div class="separator"></div>

									<button type="submit" class="btn btn-success btn-sm">Connexion</button>&nbsp;&nbsp;&nbsp;&nbsp;
									
								</form>
							</li>
						</ul>
					</div>
				</div>
				<?php
			} ?>
		</nav>
		
		<div class="clearfix">
			<?php if(isset($_SESSION['flash'])): ?>
				<?php foreach($_SESSION['flash'] as $type => $message): ?>
					<div class="container">
						<div class="alert alert-<?= $type; ?>">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<?= $message; ?>
						</div>
					</div>
				<?php endforeach; ?>
				<?php unset($_SESSION['flash']); ?>
			<?php endif; ?>
		</div>

		
		<?php
		if ( (isset($_GET['p'])) && (isset($pageOK[$_GET['p']])) ) {
			include($pageOK[$_GET['p']]);
		}
		else if ( (isset($_GET['p'])) && (isset($page_membres[$_GET['p']]))  ) {
			include($page_membres[$_GET['p']]);
		}
		else{
			include('mon_compte.php');
		}
		?>
	</div>
	<div class="footer">
        <div class="container">
            <div class="subfooter-inner">
                <div class="row">
                    <div class="col-md-12">
                        <p class="text-center">WikkeDev © <?=date("Y", time());?> All Rights Reserved</p> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery-3.5.0.min.js"></script>
	<script src="js/popper.min.js"></script>      
	<script src="bootstrap-4.4.1/js/bootstrap.min.js"></script>
	
	
</body>
</html>
