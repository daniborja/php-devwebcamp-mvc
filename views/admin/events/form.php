<fieldset class="form__fieldset">
    <legend class="form__legend">Información Evento</legend>

    <div class="form__field">
        <label for="name" class="form__label">Nombre Evento</label>
        <input
            type="text"
            class="form__input"
            id="name"
            name="name"
            placeholder="Nombre Evento"
            value="<?php echo $speaker->name ?? '' ?>"
        >
    </div>

    <div class="form__field">
        <label for="description" class="form__label">Descripción</label>
        <textarea
            class="form__input"
            id="description"
            name="description"
            placeholder="Descripción Evento"
            rows="8"
            value="<?php echo $speaker->name ?? '' ?>"
        ></textarea>
    </div>
</fieldset>