<header id="header" class="header-main">
    <div class="brand header-brand"><a href="/">Boutik</a></div>

    <nav class="navbar header-navbar">
        <ul class="nav-items navbar-nav">
            <li class="nav-item"><a href="?page=catalogue">Catalogue</a></li>
            <li class="nav-item"><a href="?page=panier">Panier</a></li>

            <?php if (isAuthenticated()) : ?>

            <li class="nav-item"><a href="?page=profil">Profil</a></li>
            <li class="nav-item"><a href="?page=connexion&action=deconnexion">Déconnexion</a></li>

            <?php else : ?>

            <li class="nav-item"><a href="?page=inscription">S&apos;inscrire</a></li>
            <li class="nav-item"><a href="?page=connexion">Connexion</a></li>

            <?php endif; 

            if (isAuthenticated() && isAdmin()) : ?>
            
            <li class="nav-item"><a href="<?= URL ?>/admin">Back Office</a></li>

            <?php endif; ?>
        </ul>
    </nav>

    <div class="ham-wrapper">
        <button class="ham-btn"></button>
    </div>
</header>