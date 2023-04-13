<main class="schedule">
    <h2 class="schedule__heading"><?php echo $title; ?></h2>
    <p class="schedule__description">Talletes y Conferencias dictados por expertos en desarrollo web</p>

    <div class="events">
        <h3 class="events__heading">&lt;Conferencias /></h3>

        <p class="events__date">Viernes 5 de Octubre</p>
        <div class="events__list">
            <?php foreach ($events['friday_conferences'] as $event) { ?>
                <div class="event">
                    <p class="event__hour"><?php echo $event->hour->hour; ?></p>

                    <div class="event__information">
                        <h4 class="event__name"><?php echo $event->name ?></h4>

                        <div>
                            <p class="event__information"><?php echo $event->description ?></p>
                        </div>

                        <div class="event__author-info">
                            <picture>
                                <source srcset="/img/speakers/<?php echo $event->speaker->image; ?>.webp" type="image/webp" draggable="false">
                                <source srcset="/img/speakers/<?php echo $event->speaker->image; ?>.png" type="image/png" draggable="false">
                                <img src="/img/speakers/<?php echo $event->speaker->image; ?>.png" alt="Imagen Ponente" draggable="false">
                            </picture>

                            <p class="event__author-name">
                                <?php echo $event->speaker->name . ' ' . $event->speaker->last_name; ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <p class="events__date">Sábado 6 de Octubre</p>
        <div class="events__list">

        </div>
    </div>

    <div class="events events--workshops">
        <h3 class="events__heading">&lt;Workshops /></h3>

        <p class="events__date">Viernes 5 de Octubre</p>
        <div class="events__list">

        </div>

        <p class="events__date">Sábado 6 de Octubre</p>
        <div class="events__list">

        </div>
    </div>
</main>