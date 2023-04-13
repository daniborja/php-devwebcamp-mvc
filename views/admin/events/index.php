<h2 class="dashboard__heading"><?php echo $title; ?></h2>

<div class="dashboard__container-button">
    <a href="/admin/eventos/crear" class="dashboard__button">
        <i class="fa-solid fa-circle-plus"></i>
        Añadir Evento
    </a>
</div>

<div class="dashboard__container">
    <?php if (!empty($events)) { ?>
        <table class="table">
            <thead class="table__thead">
                <tr class="table__tr">
                    <th scope="col" class="table__th">Evento</th>
                    <th scope="col" class="table__th">Tipo</th>
                    <th scope="col" class="table__th">Día y Hora</th>
                    <th scope="col" class="table__th">Ponente</th>
                    <th scope="col" class="table__th"></th>
                </tr>
            </thead>

            <tbody class="table__tbody">
                <?php foreach ($events as $event) { ?>
                    <tr class="table__tr">
                        <td class="table__td">
                            <?php echo $event->name; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $event->category->name; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $event->day->name . ' | ' . $event->hour->hour; ?>
                        </td>
                        <td class="table__td">
                            <?php echo $event->speaker->name . " " . $event->speaker->last_name; ?>
                        </td>

                        <!-- actions -->
                        <td class="table__td--actions">
                            <a href="/admin/eventos/editar?id=<?php echo $event->id ?>" class="table__action table__action--edit">
                                <i class="fa-solid fa-pencil"></i>
                                Editar
                            </a>
                            <form method="POST" action="/admin/eventos/eliminar" class="table__form">
                                <input type="hidden" name="id" value="<?php echo $event->id ?>">
                                <button type="submit" class="table__action table__action--delete">
                                    <i class="fa-solid fa-circle-xmark"></i>
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

    <?php } else { ?>
        <p class="text-center">No Hay Eventos Aún</p>
    <?php } ?>

</div>


<?php echo $pagination; ?>