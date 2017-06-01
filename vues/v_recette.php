<?php
//à sécuriser
$catego = $_GET['categ'] ;
$recette = $_GET['recette'] ;

//je récupère le fichier json équivalent sur le serveur, je le transforme en objet php
$fichier = "vues/recipes/".$catego."/".$recette.".json" ;

$laRecette = file_get_contents($fichier) ;
$laRecette = json_decode($laRecette) ;

$titreRecette = $laRecette -> {'titre'} ;
$auteurRecette = $laRecette -> {'auteur'} ;
//si vide, faire celle par défaut
$photoRecette = $laRecette -> {'photo'} ;

$ingredientsRecette = $laRecette -> {'ingredients'} ;

$etapesRecette = $laRecette -> {'etapes'} ;
$astuceRecette = $laRecette -> {'astuce'} ;

?>

<main><article>
    <h2><?php echo $titreRecette ; ?></h2>
	<p><em>Recette proposée par <?php echo $auteurRecette ; ?></em></p>

<section>
	<aside>
		<figure>
			<img id="illustration-article" src="ressources/photos/<?php echo $photoRecette ; ?>" alt="photo de <?php echo $titreRecette ; ?>" title="" />
		</figure>
		<div>
			<h3>Ingrédients :</h3>
			<ul>
				<li><?php echo $ingredientsRecette ; //faire une boucle pour lister les ingrédients
				?></li>
			</ul>
		</div>
	</aside>
	<ol><li><?php echo $etapesRecette ; //faire une boucle pour lister les étapes
	?>
		</li>
	</ol>

    <p>Astuce : <?php echo $astuceRecette ; ?></p>
	<hr class="cleareur"/>
</section>
<p class="align_droite">
<a href="delete-recette.php?<?php echo "categ=" . $catego. "&nom=". $recette ;?>" title=""><img src="ressources/img/suppr.png" alt="" title="" class="icon"/></a>
<a href="edit-recette.php?<?php echo "categ=" . $catego. "&nom=". $recette ;?>" title=""><img src="ressources/img/edit.png" alt="" title="" class="icon"/></a>
</p>
    
</article></main>