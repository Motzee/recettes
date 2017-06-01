<main>
	<article>
        <h2>Poster une recette</h2>

<form method="POST" action="modeles/post_recette.php">

    <p><label for="titreRecette" class="champ_aligne recquis">Titre de la recette :</label>
        <input id="titreRecette" name="titreRecette" type="text" maxlength="255" required /></p>

    <p><label for="auteurRecette" class="champ_aligne">Auteur/e :</label>
        <input id="auteurRecette" name="auteurRecette" type="text" maxlength="30"/></p>

    <p><label for="categRecette" class="champ_aligne recquis">Catégorie de la recette :</label>
        <select name="categRecette" id="categRecette">
            <option>Entrées</option>
            <option>Plats</option>
            <option>Boissons</option>
            <option>Desserts</option>
            <option>Gâteaux</option>
            <option>Glaces</option>
            <option>Friandises</option>
            <option>Non-comestibles</option>
        </select></p>

    <p><label for="photoRecette" class="champ_aligne" title="placez votre photo dans le dossier ressources/img/photos, et indiquez dans la case son nom suivi de son extension">Nom de la photo d'illustration :</label>
        <input id="photoRecette" name="photoRecette" type="text" maxlength="50"/></p>

    <p><label for="ingredientsRecette" title="Séparer les différents ingrédients par des point-virgules" class="champ_aligne recquis">Ingrédients nécessaires :</label>
        <textarea id="ingredientsRecette" name="ingredientsRecette" required ></textarea></p>

    <p><label for="consignesRecette" title="Séparer les différentes étapes par des point-virgules" class="champ_aligne recquis">Consignes de la recette :</label>
        <textarea id="consignesRecette" name="consignesRecette" required ></textarea></p>

    <p><label for="astuceRecette" class="champ_aligne">Astuce (facultatif) :</label>
        <input id="astuceRecette" name="astuceRecette" type="text"/></p>

    <p><input type="submit" value="Poster"  class="champ_decale"/></p>
</form>

    </article>
</main>