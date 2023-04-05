<aside class="dashboard__sidebar">
    <nav class="dashboard__menu">
        <a href="/admin/dashboard" 
            class="dashboard__link <?php echo isActiveLink('/dashboard') ? 'dashboard__link--active' : ''; ?>"
        >
            <i class="fa-solid fa-house dashboard__icon"></i>
            <span class="dashboard__menu-text">Inicio</span>
        </a>

        <a href="/admin/ponentes" 
            class="dashboard__link <?php echo isActiveLink('/ponentes') ? 'dashboard__link--active' : ''; ?>"
        >
            <i class="fa-solid fa-microphone dashboard__icon"></i>
            <span class="dashboard__menu-text">Ponentes</span>
        </a>

        <a href="/admin/eventos" 
            class="dashboard__link <?php echo isActiveLink('/eventos') ? 'dashboard__link--active' : ''; ?>"
        >
            <i class="fa-solid fa-calendar dashboard__icon"></i>
            <span class="dashboard__menu-text">Eventos</span>
        </a>

        <a href="/admin/registrados" 
            class="dashboard__link <?php echo isActiveLink('/registrados') ? 'dashboard__link--active' : ''; ?>"
        >
            <i class="fa-solid fa-user dashboard__icon"></i>
            <span class="dashboard__menu-text">Registrados</span>
        </a>

        <a href="/admin/regalos" 
            class="dashboard__link <?php echo isActiveLink('/regalos') ? 'dashboard__link--active' : ''; ?>"
        >
            <i class="fa-solid fa-gift dashboard__icon"></i>
            <span class="dashboard__menu-text">Regalos</span>
        </a>
    </nav>
</aside>