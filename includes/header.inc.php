<nav class="navbar navbar-dafault navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle collapsed" type="button" 
                data-toggle="collapse" data-target="#navbar" 
                aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a href="<?= URL ?>" class="navbar-brand">Boutique</a>
        </div>

        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="?page=catalogue">Catalogue</a></li>
                <li><a href="?page=panier">Panier</a></li>

                <?php if (isConnected()) : ?>

                <li><a href="?page=profil">Profil</a></li>
                <li><a href="?page=connexion&action=deconnexion">Déconnexion</a></li>

                <?php else : ?>

                <li><a href="?page=inscription">S&apos;inscrire</a></li>
                <li><a href="?page=connexion">Connexion</a></li>

                <?php endif; 

                if (isConnected() && isAdmin()) : ?>
                
                <li><a href="<?= URL ?>admin">Back Office</a></li>

                <?php endif; ?>
                
            </ul>
        </div>
    </div>
</nav>