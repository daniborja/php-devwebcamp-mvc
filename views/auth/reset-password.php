<main class="auth">
    <h2 class="auth__heading"><?php echo $title ?></h2>
    <p class="auth__text">Coloca tu nuevo Password</p>

    <?php require_once __DIR__ . '/../templates/alerts.php'; ?>

    <?php if (!$hasError) { ?>

        <!-- no action to send the same url with token  -->
        <form method="POST" class="form">
            <div class="form__field">
                <label for="password" class="form__label">Password</label>
                <input type="password" id="password" name="password" placeholder="Tu Nuevo Password" class="form__input">
            </div>

            <input type="submit" class="form__submit" value="Guardar Password">
        </form>

        <div class="actions">
            <a href="/login" class="actions__link">¿Ya tienes cuenta? Iniciar Sesión</a>
            <a href="/registro" class="actions__link">¿Aún no tienes una cuenta? obtener una</a>
        </div>

    <?php } ?>

</main>