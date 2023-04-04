<main class="auth">
    <h2 class="auth__heading"><?php echo $title ?></h2>
    <p class="auth__text">Recupera tu acceso a DevWebCamp</p>

    <form action="" class="form">
        <div class="form__field">
            <label for="email" class="form__label">Email</label>
            <input type="email" id="email" name="email" placeholder="Tu Email" class="form__input">
        </div>

        <input type="submit" class="form__submit" value="Enviar Instrucciones">
    </form>

    <div class="actions">
        <a href="/login" class="actions__link">¿Ya tienes cuenta? Iniciar Sesión</a>
        <a href="/registro" class="actions__link">¿Aún no tienes una cuenta? obtener una</a>
    </div>

</main>