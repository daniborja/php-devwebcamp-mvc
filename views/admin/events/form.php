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
            value="<?php echo $event->name ?? ''; ?>"
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
        ><?php echo $event->description ?? ''; ?></textarea>
    </div>

    <div class="form__field">
        <label for="category" class="form__label">Categoría o Tipo de Evento</label>
        <!-- category_id es como le llega el value del select al controller: -->
        <select name="category_id" id="category" class="form__select">
            <option value="">- Seleccionar -</option>

            <?php foreach($categories as $category) { ?>
                <option 
                    value="<?php echo $category->id ?>"
                    <?php echo ($event->category_id === $category->id) ? 'selected' : ''; ?>
                >
                    <?php echo $category->name; ?>
                </option>
            <?php } ?>

        </select>
    </div>

    <div class="form__field">
        <label for="category" class="form__label">Selecciona el día</label>

        <div class="form__radio">
            <?php foreach($days as $day) { ?>
                <div>
                    <label for="<?php echo strtolower($day->name); ?>" class="form__radio--label">
                        <?php echo $day->name; ?>
                    </label>
                    <input
                        type="radio"
                        name="day"
                        id="<?php echo strtolower($day->name); ?>"
                        value="<?php echo $day->id; ?>"

                    >
                </div>
            <?php } ?>
        </div>

        <input type="hidden" name="day_id" value="">
    </div>

    <div class="form__field">
        <label for="" class="form__label">Seleccionar Hora</label>

        <ul class="hours" id="hours" onselectstart="return false">
            <?php foreach($hours as $hour) { ?>
                <li
                    class="hours__hour hours__hour--disabled"
                    data-hour-id="<?php echo $hour->id ?>" ><?php echo $hour->hour; ?>
                </li>
            <?php } ?>
        </ul>

        <input type="hidden" name="hour_id" value="">
    </div>
</fieldset>


<fieldset class="form__fieldset">
    <legend class="form__legend">Información Extra</legend>

    <div class="form__field">
        <label for="speakers" class="form__label">Ponentes</label>
        <input
            type="text"
            class="form__input"
            id="speakers"
            placeholder="Buscar Ponente"
        >
        <div class="speakers-list">
            <ul class="speakers-list__ul" id="speakers-list__ul"></ul>
            <p class="speakers-list__p"></p>
        </div>

        <input type="hidden" name="speaker_id" value="">
    </div>

    <div class="form__field">
        <label for="available_places" class="form__label">Lugares Disponibles</label>
        <input
            type="number"
            min="1"
            class="form__input"
            id="available_places"
            name="available_places"
            placeholder="Ej. 20"
            value="<?php echo $event->available_places ?>"
        >
    </div>

</fieldset>