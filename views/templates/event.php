<div class="event swiper-slide">
    <p class="event__hour"><?php echo $event->hour->hour; ?></p>

    <div class="event__information">
        <h4 class="event__name"><?php echo $event->name ?></h4>

        <p class="event__introduction"><?php echo $event->description ?></p>

        <div class="event__author-info">
            <picture>
                <source srcset="/img/speakers/<?php echo $event->speaker->image; ?>.webp" type="image/webp" draggable="false">
                <source srcset="/img/speakers/<?php echo $event->speaker->image; ?>.png" type="image/png" draggable="false">
                <img loading="lazy" src="/img/speakers/<?php echo $event->speaker->image; ?>.png" alt="Imagen Ponente" width="200" height="300" class="event__author-image" draggable="false">
            </picture>

            <p class="event__author-name">
                <?php echo $event->speaker->name . ' ' . $event->speaker->last_name; ?>
            </p>
        </div>
    </div>
</div>