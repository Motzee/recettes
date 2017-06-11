<main>

    <article>
    <?php 
        if(isset($pseudo) && isset($statut)) {
    ?>
        <h2>Bienvenue <?php echo $pseudo ; ?></h2>
        <h3>Votre compte</h3>
        <p class="flex-reparti">
            <a href="modeles/deconnexion.php" title="Fermer la session">Se déconnecter</a>
            <a href="modeles/desinscription.php" title="Se désinscrire (mais que deviennent toutes les recettes postées par la personne ?)">Supprimer son compte définitivement</a>
        </p>
        <h3>Vos recettes</h3>
 
    <?php
        } else {
    ?>
        <h2>Authentifiez-vous</h2>
        <p class="centrer">Pour pouvoir éditer et poster des recettes, il vous faut être identifié/e</p>
        <form id="logsign" class="form-align" method="POST" action="modeles/logsign.php">
            <p><label for="pseudo" class="champ_aligne" required >Pseudo</label><input id="pseudo" name="pseudo" type="text" required /></p>
            <p><label for="mdp" class="champ_aligne" required >Mot de passe</label><input id="mdp" name="mdp" type="password" required /></p>
            <p class="champ_decale radio">
                <span><input type="radio" name="authentifie" value="login" id="login" checked="checked" /> <label for="login">Se connecter</label></span>
            <span><input type="radio" name="authentifie" value="signin" id="signin" /> <label for="signin">Créer un compte</label></span></p>
            <p><input type="submit" value="S'authentifier" class="champ_decale"/></p>
        </form>

    <?php
        }
    ?>
    </article>

    
</main>