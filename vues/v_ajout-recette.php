<main>
	<article>
        <h2>Poster une recette</h2>

<form method="POST" action="modeles/post_recette.php">

    <p><label for="titreRecette" class="champ_aligne">Titre de la recette :</label>
        <input id="titreRecette" name="titreRecette" type="text" required /></p>

    <p><label for="auteurRecette" class="champ_aligne">Auteur/e :</label>
        <input id="auteurRecette" name="auteurRecette" type="text"/></p>

    <p><label for="categRecette" class="champ_aligne">Catégorie de la recette :</label>
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

    <p>illustration (en attente)</p>

    <p><label for="ingredientsRecette" title="Séparer les différents ingrédients par des point-virgules" class="champ_aligne">Ingrédients nécessaires :</label>
        <textarea id="ingredientsRecette" name="ingredientsRecette" required ></textarea></p>

    <p><label for="consignesRecette" title="Séparer les différentes étapes par des point-virgules" class="champ_aligne">Consignes de la recette :</label>
        <textarea id="consignesRecette" name="consignesRecette" required ></textarea></p>

    <p><label for="astuceRecette" class="champ_aligne">Astuce (facultatif) :</label>
        <input id="astuceRecette" name="astuceRecette" type="text"/></p>

    <p><input type="submit" value="Poster"  class="champ_decale"/></p>
</form>

    </article>
</main>