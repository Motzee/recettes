<main>
    <article>
        <h2>Supprimer la recette</h2>
<form action="modeles/del-recette.php" method="POST">
        <p>Etes-vous sûr/e de vouloir supprimer la recette ci-dessous ?</p>
        <input type="hidden" name="nomRecette" value="<?php echo $_GET['nom'] ?>" />
        <input type="hidden" name="categRecette" value="<?php echo $_GET['categ'] ?>" />
        <p><em>Aperçu de la recette à mettre</em></p>
        <input type="submit" value="Oui, supprimer !">
</form>

    </article>
</main>