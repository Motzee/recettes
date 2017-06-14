<main>
    <article class="centrer">
        <h2>Bienvenue dans mon carnet de recettes</h2>
        <p>Pour préparer de bonnes choses, utilise le menu de navigation ci-dessus<br/>
        <img src="ressources/img/arrow-top.png" alt="voir les liens ci-dessus" title="flèche vers haut" class="arrow" />
        </p>
        <?php
        if(isset($pseudo)) {
			echo '<p>Pour consigner de bonnes choses, utilise le lien présent dans le footer en pied de page<br/>
            <img src="ressources/img/arrow-bottom.png" alt="voir lien ci-dessous" title="flèche vers bas" class="arrow" />
            </p>' ;
		}
        ?>
    </article>
</main>