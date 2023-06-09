<h2 class="dashboard__heading"><?php echo $title; ?></h2>

<div class="dashboard__container-button">
    <a href="/admin/ponentes" class="dashboard__button">
        <i class="fa-solid fa-circle-arrow-left"></i>
        Volver
    </a>
</div>

<div class="dashboard__form-container">

    <?php include_once __DIR__ . './../../templates/alerts.php'; ?>

    <!-- enctype for imgs/files -->
    <form method="POST" action="/admin/ponentes/crear" enctype="multipart/form-data" class="form">

        <?php include_once __DIR__ . '/form.php'; ?>


        <input type="submit" value="Registrar Ponente" class="form__submit form__submit--register">
    </form>

</div>