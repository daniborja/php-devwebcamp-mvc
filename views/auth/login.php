<main class="auth">
    <h2 class="auth__heading"><?php echo $title ?></h2>
    <p class="auth__text">Inicia Sesión en DevWebCamp</p>

    <form action="" class="form">
        <div class="form__field">
            <label for="email" class="form__label">Email</label>
            <input type="email" id="email" name="email" placeholder="Tu Email" class="form__input">
        </div>

        <div class="form__field">
            <label for="password" class="form__label">Email</label>
            <input type="password" id="password" name="password" placeholder="Tu Password" class="form__input">
        </div>

        <input type="submit" class="form__submit" value="Iniciar Sesión">
    </form>

    <div class="actions">
        <a href="/registro" class="actions__link">¿Aún no tienes una cuenta? obtener una</a>
        <a href="/olvide-password" class="actions__link">¿Olvidaste tu Password?</a>
    </div>

</main>