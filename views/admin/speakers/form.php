<fieldset>
    <legend class="formulario__legend">Información Personal</legend>

    <div class="form__field">
        <label for="name" class="form__label">Nombre</label>
        <input
            type="text"
            class="form__input"
            id="name"
            name="name"
            placeholder="Nombre Ponente"
            value="<?php echo $speaker->name ?? '' ?>"
        >
    </div>
    
    <div class="form__field">
        <label for="last_name" class="form__label">Nombre</label>
        <input
            type="text"
            class="form__input"
            id="last_name"
            name="last_name"
            placeholder="Apellido Ponente"
            value="<?php echo $speaker->last_name ?? '' ?>"
        >
    </div>
</fieldset>