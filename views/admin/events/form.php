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

    <div class="form__field">
        <label for="category" class="form__label">Categoría o Tipo de Evento</label>
        <!-- category_id es como le llega el value del select al controller: -->
        <select name="category_id" id="category" class="form__select">
            <option value="">- Seleccionar -</option>

            <?php foreach($categories as $category) { ?>
                <option value="<?php echo $category->id ?>">
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
                        value="<?php echo $day->name; ?>"
                    >
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="form__field">
        <label for="" class="form__label">Seleccionar Hora</label>

        <ul class="hours">
            <?php foreach($hours as $hour) { ?>
                <li class="hours__hour" ><?php echo $hour->hour; ?></li>
            <?php } ?>
        </ul>

    </div>

</fieldset>
