<!DOCTYPE html>

<?php require_once("modeles/gere-session.php") ; ?>

<html lang="fr">

<?php require_once("ressources/head.php") ; ?>

<body>
	
	<?php
	
	include_once('vues/architect_header.php') ;
	
        if($statut == "visiteur") {
            echo 'Cet espace est réservé aux membres inscrits. Vous pouvez vous créer un compte gratuitement ou vous identifier en cliquant <a href="login.php" title="accéder à la page d\'inscription et d\'authentification">sur ce lien</a>' ;
        } else {
            include_once('vues/v_edit-recette.php') ;
        }
        
        
	include_once('vues/architect_footer.php') ;
	
	?>

</body>
</html>