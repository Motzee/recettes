<main>
	<article>
		<?php 
			//listing des recettes dispo :
			$listeRecettes = ["rosessables"] ;

			//si variable en url existe, non nulle et appartient à une liste pré-établie de recettes, 
			if(isset($_GET['recette']) && $_GET['recette'] != null && in_array($_GET['recette'], $listeRecettes)) {
				$page = $_GET['recette'] ;
				$chemin = "vues/$page.php" ;
				include($chemin) ;
			}
			//sinon : afficher la page par défaut
			else {
				include("vues/index.php") ;
			}
		?>
</article>
</main>

