<main>
	<article>
<?php

if(!isset($_GET['act']) || $_GET['act'] != "suppr") {

   echo "<h2>Poster une recette</h2>" ;

    //s'il s'agit d'une édition
    if(isset($_GET['categ']) && isset($_GET['recette'])) {
        $catego = $_GET['categ'] ;
        $recette = $_GET['recette'] ;

        $edit = true ;

        //on récupère la recette et on prépare les variables
        $fichier = "vues/recipes/".$catego."/".$recette.".json" ;

        $laRecette = file_get_contents($fichier) ;
        $laRecette = json_decode($laRecette) ;

        $titreRecette = $laRecette -> {'titre'} ;
        $auteurRecette = $laRecette -> {'auteur'} ;

        isset($laRecette -> {'photo'}) ? $photoRecette = $laRecette -> {'photo'} : $photoRecette = null ;

        $ingredientsRecette = $laRecette -> {'ingredients'} ;

        $etapesRecette = $laRecette -> {'etapes'} ;

        isset($laRecette -> {'astuce'}) ? $astuceRecette = $laRecette -> {'astuce'} : $astuceRecette = null ;
    } else {
        $edit = false ;
    }
    ?>
    <form id="edit-recette" method="POST" action="modeles/post_recette.php">
        <p><label for="titreRecette" class="champ_aligne" required >Titre de la recette</label>
            <input id="titreRecette" name="titreRecette" type="text" maxlength="255" <?php
                if($edit == true) {
                    echo 'value="'.$titreRecette.'"' ;
                }
            ?>required /></p>

        <p><label for="auteurRecette" class="champ_aligne" required >Auteur/e</label>
            <input id="auteurRecette" name="auteurRecette" type="text" maxlength="30" value="<?php echo $pseudo ; ?>" /></p>

        <p><label for="categRecette" class="champ_aligne" required >Catégorie de la recette</label>
            <select name="categRecette" id="categRecette" required >
        <?php
            $categories = ["entrees", "plats", "boissons", "desserts", "gateaux", "glaces", "friandises", "non-comestibles"] ;

            foreach($categories as $categ) {
                if($categ == $catego) {
                    echo "<option selected>$categ</option>" ;
                } else {
                    echo "<option>$categ</option>" ;
                }
            }
        ?>
            </select></p>

        <p><label for="photoRecette" class="champ_aligne" title="placez votre photo dans le dossier ressources/img/photos, et indiquez dans la case son nom suivi de son extension">Nom de la photo d'illustration</label>
            <input id="photoRecette" name="photoRecette" type="text" maxlength="50" <?php
                if($edit == true) {
                    echo 'value="'.$photoRecette.'"' ;
                }
            ?>/></p>

        <p><label for="ingredientsRecette" title="Séparer les différents ingrédients par des [*]" class="champ_aligne" required >Ingrédients nécessaires</label>
            <textarea id="ingredientsRecette" name="ingredientsRecette" required ><?php
                if($edit == true) {
                    echo $ingredientsRecette ;
                }
            ?></textarea></p>

        <p><label for="consignesRecette" title="Séparer les différentes étapes par des [*]" class="champ_aligne" required >Consignes de la recette</label>
            <textarea id="consignesRecette" name="consignesRecette" required ><?php
                if($edit == true) {
                    echo $etapesRecette ;
                }
            ?></textarea></p>

        <p><label for="astuceRecette" class="champ_aligne">Astuce</label>
            <input id="astuceRecette" name="astuceRecette" type="text" <?php
                if($edit == true) {
                    echo 'value="'.$astuceRecette.'"' ;
                }
            ?>/></p>

        <?php
        if($edit == true) {
            echo '<input name="edition-recette" type="hidden" value="'.$recette.'" />' ;
            echo '<input name="edition-categ" type="hidden" value="'.$catego.'" />' ;
        }
        ?>
        <p><input type="submit" value="Poster"  class="champ_decale"/></p>
    </form>
<?php
} else {
?>
<h2>Supprimer une recette</h2>
<?php
    if(isset($_GET['categ']) && isset($_GET['recette'])) {
        $catego = $_GET['categ'] ;
        $recette = $_GET['recette'] ;
    ?>
        <form id="edit-recette" method="POST" action="modeles/del_recette.php">
            <p>Etes-vous sûr/e de vouloir supprimer la recette <?php echo $recette ; ?> ?
            <input name="nomRecette" type="hidden" value="<?php echo $recette ; ?>" />
            <input name="categRecette" type="hidden" value="<?php echo $catego ; ?>" />
            <p><input type="submit" value="Oui, supprimer définitivement"  class="champ_decale"/></p>
        </form>
    <?php
    }
}
?>
    </article>
</main>
