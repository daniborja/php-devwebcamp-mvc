<main class="auth">
    <h2 class="auth__heading"><?php echo $title ?></h2>
    <p class="auth__text">Regístrate en DevWebcamp</p>

    <?php
    require_once __DIR__ . '/../templates/alerts.php'
    ?>

    <form method="POST" action="/registro" class="form">
        <div class="form__field">
            <label for="name" class="form__label">Nombre</label>
            <input type="text" id="name" name="name" placeholder="Tu Nombre" class="form__input" value="<?php echo $user->name; ?>">
        </div>

        <div class="form__field">
            <!-- lastName as AR needed: lastName = $user->lastName -->
            <label for="lastName" class="form__label">Apellido</label>
            <input type="text" id="lastName" name="lastName" placeholder="Tu Apellido" class="form__input" value="<?php echo $user->lastName; ?>">
        </div>

        <div class="form__field">
            <label for="email" class="form__label">Email</label>
            <input type="email" id="email" name="email" placeholder="Tu Email" class="form__input" value="<?php echo $user->email; ?>">
        </div>

        <div class="form__field">
            <label for="password" class="form__label">Password</label>
            <input type="password" id="password" name="password" placeholder="Tu Password" class="form__input">
        </div>

        <div class="form__field">
            <label for="password2" class="form__label">Repetir Password</label>
            <input type="password" id="password2" name="password2" placeholder="Repetir Password" class="form__input">
        </div>

        <input type="submit" class="form__submit" value="Creat Cuenta">
    </form>

    <div class="actions">
        <a href="/login" class="actions__link">¿Ya tienes cuenta? Iniciar Sesión</a>
        <a href="/olvide-password" class="actions__link">¿Olvidaste tu Password?</a>
    </div>

</main>