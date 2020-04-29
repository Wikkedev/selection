<?php 

session_start();

header('Content-type: text/html; charset=uft-8');

include('connect.php');

if(isset($_GET['label'])){
    if ($_GET['label'] != ''){
          
		$rqt = $db->query("SELECT id FROM category WHERE id = '".$_GET['id']."'");

        if ($rqt->num_rows > 0){
            $db->query("UPDATE category SET
						label = '".$_GET['label']."'
                        
					WHERE id ='".$_GET['id']."'");

            $_SESSION['flash']['success'] = 'Cette catégorie a été modifiée.';

           echo "ok";   

        }
		else {
			$_SESSION['flash']['danger'] = 'Vous essayez de modifier une catégorie qui n\'existe pas !';
			echo 'pas ok';
		}
	}

    

}



	

			 



