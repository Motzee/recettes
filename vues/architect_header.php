<header id="entete">
	<h1><img id="logo-banniere" src="ressources/img/logo.png" alt="" title="" /><a href="index.php" tile="retour à l'accueil">Cahier de recettes de LaLicorne</a>
	</h1>
	<nav>
		<ul>
		<?php
			$categories = array(
				"Entrées" =>  "entrees",
				"Plats" => "plats",
				"Desserts" => "desserts",
				"Boissons" => "boissons",
				"Gâteaux" => "gateaux",
				"Glaces" => "glaces",
				"Friandises" => "friandises",
				"Non-comestible" => "non-comestibles"
			 ) ;

			foreach($categories as $nom => $categorie) {
				echo "<li>$nom" ;
				lectureMenu($categorie) ;
				echo "</li>" ;
			}
		?>	
		</ul>
	</nav>
<?php

function lectureMenu($categorie) {
	$menu = file_get_contents('vues/recipes/menu.json') ;
    $menu = json_decode($menu);

    //ajout de la référence
    $contenuCateg = $menu->$categorie ;
	
	if(!get_object_vars($contenuCateg) && !get_class_methods($contenuCateg)) {
		
	} else {
		echo "<ul>" ;
	
		foreach($contenuCateg as $nom => $titre) {
			echo '<li><a href="recette.php?categ='.$categorie.'&recette='.$nom.'" title="recette de '.$titre.'">'.$titre.'</a></li>' ;
		}
		echo "</ul>" ;
	}
}

?>
</header>