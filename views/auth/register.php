<main class="auth">
    <h2 class="auth__heading"><?php echo $title ?></h2>
    <p class="auth__text">Regístrate en DevWebcamp</p>

    <form action="" class="form">
        <div class="form__field">
            <label for="name" class="form__label">Nombre</label>
            <input type="text" id="name" name="name" placeholder="Tu Nombre" class="form__input">
        </div>

        <div class="form__field">
            <label for="last_name" class="form__label">Apellido</label>
            <input type="text" id="last_name" name="last_name" placeholder="Tu Apellido" class="form__input">
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