<header class="header">
    <div class="header__container">
        <nav class="header__navigation">
            <a href="/register" class="header__link">Registro</a>
            <a href="/login" class="header__link">Login</a>
        </nav>

        <div class="header__content">
            <a href="/">
                <h1 class="header__logo">&#60;DevWebCamp /></h1>
            </a>

            <p class="header__text">Octubre 5-6 - 2023</p>
            <p class="header__text header__text--mode">En Línea - Presencial</p>

            <a href="/registro" class="header__button">Comprar Pase</a>
        </div>
    </div>
</header>

<div class="navbar">
    <div class="navbar__content">
        <a href="/">
            <h2 class="navbar__logo"> &#60;DevWebCamp /></h2>
        </a>

        <nav class="navigation">
            <a href="/devwebcamp" class="navigation__link 
                <?php echo isActiveLink('/devwebcamp') ? 'navigation__link--active' : ''; ?>
                ">
                Evento
            </a>
            <a href="/paquetes" class="navigation__link 
                <?php echo isActiveLink('/paquetes') ? 'navigation__link--active' : ''; ?>
                ">Paquetes</a>
            <a href="/workshops-conferencias" class="navigation__link 
                <?php echo isActiveLink('/workshops-conferencias') ? 'navigation__link--active' : ''; ?>
                ">Workshops / Conferencias</a>
            <a href="/registro" class="navigation__link <?php echo isActiveLink('/registro') ? 'navigation__link--active' : ''; ?>
                ">Comprar Pase</a>
        </nav>
    </div>
</div>