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

isset($laRecette -> {'photo'}) ? $photoRecette = $laRecette -> {'photo'} : $photoRecette = null ;

$ingredientsRecette = $laRecette -> {'ingredients'} ;

$etapesRecette = $laRecette -> {'etapes'} ;

isset($laRecette -> {'astuce'}) ? $astuceRecette = $laRecette -> {'astuce'} : $astuceRecette = null ;

?>

<main><article>
    <h2><?php echo $titreRecette ; ?></h2>
	<p><em>Recette proposée par <?php echo $auteurRecette ; ?></em></p>

<section>
	<aside>
		<figure>
			<img id="illustration-article" src="<?php
                if($photoRecette == null) {
                    echo "ressources/img/illustration.jpg" ;
                } else {
                    echo "ressources/photos/$photoRecette" ;
                }
            ?>" alt="photo de <?php echo $titreRecette ; ?>" title="" />
		</figure>
		<div>
			<h3>Ingrédients :</h3>
			<?php 
				echo "<ul>" ;
				$ingredients = explode("[*]", $ingredientsRecette) ;
				
				foreach($ingredients as $ingr) {
					echo "<li>$ingr</li>" ;
				}
				echo "</ul>" ;
			?>
		</div>
	</aside>
	<?php 
				echo "<ol>" ;
				$etapes = explode("[*]", $etapesRecette) ;
				
				foreach($etapes as $step) {
					echo "<li>$step</li>" ;
				}
				echo "</ol>" ;
			?>

    <p>Astuce : <?php echo $astuceRecette ; ?></p>
	<hr class="cleareur"/>
</section>
<?php
if((isset($pseudo) && $pseudo == $auteurRecette) || (isset($pseudo) && $statut == "admin")) {
?>
	<p class="droite">
<a href="edit-recette.php?<?php echo "categ=" . $catego. "&recette=". $recette."&act=suppr" ;?>" title=""><img src="ressources/img/suppr.png" alt="" title="" class="icon"/></a>
<a href="edit-recette.php?<?php echo "categ=" . $catego. "&recette=". $recette ;?>" title=""><img src="ressources/img/edit.png" alt="" title="" class="icon"/></a>
</p>
<?php
}
?> 
</article></main>
