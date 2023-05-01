# DevWebCamp

## Get Started
  -- Iniciar 1 proyecto q ya trae gulp y composer:
    - Commands

```bash
    # instalar las deps de compose
    composer install

    # gulp
    pnpm run dev

    # php server
    cd public
    php -S localhost:3000
    
```



## Dev
  -- Styles con Sass y BEM
    - Creamos    /pages    en   /src/scss
      - Creamos los diferentes modulos
    - Usamos el     `&`    para unir los atributos de SASS
      - Como todos los header vas a terminar con     __heading     creo un mixin q aplique styles a todos los q terminan con eso:    
      
```scss
[class$='__heading'] {
    @include m.page-name;
}
```


## EnvV en PHP
-- Para trabajar con   .env   usamos el paquete con compose
    `compose require vlucas/phpdotenv`

-- PHP Convention:
  - Methods:                    camelCase
  - Attributes/Properties:      snake_case
    - Para q tenga concordancia con DB
      - Vanilla PHP





## DB
-- User va a ser 1 sola tablas SIN ROLES
  - En la misma tabla indica si es un Admin o no como un Boolean (TINYINT(1))



-- Alerts       <--  alerts.php
  - Se hace 1 doble foreach xq se crea un Arreglo Asociativo
    - Con este la key principal nos dice q tipo de alerta es: success/error
      - X eso es importante la 1ra key

-- Forms MVC
  - Name en el HTML tal cual se Espera en el Active Record
    - Si se usa    `$user->lastName`     en el input el name debera ser     lastName


-- Pasar Parametros / QueryParams x URL
  - En el Router no se hace nada especial para aceptarlos
    - Para LEERLOS: usamos el  `$_GET`, con s para Sanitizar q es nuestra propia fn
      - Accedemos con la misma key q enciamos como QueryParam, en este caso como token

```php
    $token = s($_GET['token']);
    if (!$token) header('Location: /');
```




-- Dashboard Design
  - Para el Layout se tiene:
    - globals:      html {height: 100%;}
    - dashboard:    .dashboard {display: flex, height:100% , &__grid {display: flex, flex: 1}}


  -- Sidebar Active con la Ruta:
    - Creamos el     `isActiveEvent`    q return 1 boolean si contiene el path enviado
      - En base a ese boolean colocamos una clase
        - En  _dashboard  agregamos esa clase al hover para q compartan styles












## Speakers
  -- Form
    -- Crear Ponente:
      - Como vamos a subir archivos utilizamos    enctype
    <form method="POST" action="/admin/ponentes/crear" enctype="multipart/form-data" class="form">

      - Inyectamos el Form con un      `fieldset`
        - Este tag es para agrupar radio-buttons/checks, etc.
        - Lo hacemos asi para solo usar el template de estre form en donde se requiera
          - En este caso en      `/speakers/form.php`
                `<?php include_once __DIR__ . '/form.php'; ?>`
      

        -- Box shadow examples (CSS):
          - url:         https://getcssscan.com/css-box-shadow-examples



    -- Tags Technologies:
      - Con Vanilla JS



    -- `SideMenu Fixed`
      - Mantener fijo el SideMenu del  Dashboard
        - En el  .content:      `overflow-y: scroll;`
        - En el PADRE .grid:    `overflow-y: auto;`

      - Inputs del Form se Desvordan x el   input FILE
        - Asi q lo solvente en      `_forms.csss`   >  &--file  >  margin: 0 -3rem 0 0;
          - Margin de -3rem xq el padding del parent es de 3rem



  -- Leer la Image enviada en el form y generar el png/webp
    - Error GD:         `sudo pacman -S php-gd`
    - Como guardamos 2 imagenes con 2 extensiones, en DB solo guardamos el name de la misma, nada mas.


  


  -- `EDITAR en MVC  (form)`
    - El form NOOOO tiene Action
      - Para q se envie la req al mismo url con el queryparam del    `?id`
      - En MVC se W mucho con queryparmas
    - Obtenemso el  QueryParam en el Controller  con el   $_GET
          $id = $_GET['id'];
    - Validamos el id y si existe un Speaker asociado a ese id
      - Lo enviamos a la View, y como ya tenemos el html listo, pues carga en auto la info del speaker

    -- Load Image
      - Lo hacemos con una var temp para q solo se cargue en EDIT
      - Evitamos su Drag and Drop

    -- Tags
      - Como los enviamos con un Input Hidden asi mismo los recibimos
        - Se llena el input hidden y esa info de la DB debemos recuperarlos
        - Simple convertimos el string q viene de db a un arr y showTags()

    -- Networks (social)
      - Como estamos manejando esto como un Associative Array debemos trajarlo

    -- Save Update
      - Controlamos el POST en el method del router .post()   <-   lo de siempre
        - Manejamos la logica en el Controller
          - EL ID lo enviamos por QueryParam
            - Lo obtenemos con el    $_GET    en el controller
            - En el Form del View NO colocamos Action para q asi el POST se haga a la misma URL
              - Que llevara el id como QueryParam  (?id)



  -- `DELETE in MVC (form)`
    - Creamos la RUTA   `/delete`   q al ser mvc tiene embebido el front, asi q solo puede ser .post()
    - En la    View     creamos un  Input Hidden q va a tener
        <input type="hidden" name="id" value="<?php echo $speaker->id ?>">
           - El name es con lo q recuperamos en el controller: $id = $_POST['id'];
           - Value, el ID del Speaker
    - Validamos el ID
      - Como usamos ActiveRecord necesitamos la Instancia del Speaker, asi q buscamos x ID, 
        - Si pasa la validacion eliminamos
          - $speaker->delete();     <--  ActiveRecord





  -- Paginacion / `Paging`
    - Creamos una    Class   (namespace de Classes)  para la Paginacion

    - Para hacer dinamico el Paging y lo mas reutilizable posible contamos los registros de db en el mismo ActiveRecord
      - `countTotalRecords()`
        - creamos la query >> ejecutamos la query con self::db->query() >> el fetch arr para q traiga el resultado como arr asociativo >> return del array_shift para q retorne solo el valor
      
    - En ActiveRecord creamos el 
      -  `paging()`
        - Para traernos los registros paginados de DB
        - Creamos la logica para numeros y enlaces

    - Solo lo llamamos en el Controller y lo pasamos a la View
      - Lo pasamos asi:     `'pagination' => $pagination->pagination()`
      - En la View solo un echo de eso y nada mas












## Events
-- Comenzamos x el Model > Routing > Controller > View


-- Creamos el Model de `Category`
  - El Model Hereda de Avtice Record pero NO tiene constructor ni nada
    - Las properties estan directamente en el Class
      - Solo se requiere la class para usar lo q tenemos del Active Record
  - Los traemos de DB y se lo pasamos a la View
    - Como tine id y name pues simplemente se usa un    foreach     en la View para recorrelos


-- `Days` Model
  - Al igual q Category, NO tiene contructor ni nada mas
    - Las properties/attributes estan directo en la Class
      - Xq no va a tener mayor logica, ni validaciones
  - En el View es un  RadioButton
  - El Model NO va a tener CREATE, nio Validations x eso NO tiene Constructor


-- `Hours` Model
  - En la View va a ser un ul>li>check
  - El Model NO va a tener CREATE, nio Validations x eso NO tiene Constructor






-- `Event` Model
  - Creamos la tabla en DB, luego el model
    - Tiene las relaciones con las otras tabals (fk: foreing key)
    
  -- View
    - Categories:
      - Manejamos el    'selected'   en base al id q viene de la instancia con el id q estamos iterando
      
    - Horas:
      - Va a ser dinamico con JS para q en base al dia se puedan seleccionar unicamente las horas disponibles
      - Dia: Radio button
        - Se envia al controller el    `day_id`    con el value del   input hidden
      

  -- `EventSchedule` Model
    - Para el API creamos 1 Model para traer Solo lo q Necesito de la tabla de Events
      - En ActiveRecord creo el    `whereArray`
    - Con esta API consultamos solo la disponibilidad de horario
      - Ya q en JS filtramos la respuesta y los dias q ya esten tomados pues los deshabilitamos
      - Se hace mucha logica
        - La mas importante reiniciar los Values de los    Input Hidden   q si se envian al back.
        - Reiniciar los styles
    

  -- Buscador de Ponente
    - Igualmente se envia el ID del Speaker con un     Input Hidden
      - Q se llena con JS




-- `CREATE Event`
  - Event tiene relaciones con muchas otras tablas, pero aqui con ActiveRecord SOLO Pasamos los ID q seran la fk a esas tablas
    - `NOOOOOO` necesitamos instanciar objetos para cada una de las relaciones
      - Se podra hacer asi en Java y Nest.js ????
        - No se xq al crear las Entities si se da tipo de dato y en esa entity se hace la relacion
          - Java xq usa Hibernate
          - Nest.js xq usa TypeORM




-- Traer todos los Eventos & Paging
  - Como SOLO vienen los ID de las Relaciones, pues debemos hacer el curce de info
    - Lo normal es hacerlo con JOIN de SQL
    - Lo va a hacer con  1   find    y    foreach    para c/evento
      - Ver como hacerlo con JOIN
        - El porblema es q al usar ActiveRecord tras realizar la query se mapea el resultado de la Query a 1 Instancia de Model
          - Por eso, aunque se triaga la info con JOIN, esta NOOO pasa a formar parte del Objeto/Intance ya que no tiene esa Key el Model


  -- Editar Evento
    - Traer la info
    - JS es medio medio xq toca estar pilas con las clases de la HORA tomada x ese evento













## Public Pages
-- Init: Como no es dinamico no necesita db
  - Router > Controller > View > SCSS



-- Conferencias y Workshops
  -- Debemos ordenar la data x dia&category para sarle a la view
    - Esto lo hacemos creando el    `order`    en el    `ActiveRecord`
      - Ordena la data y la envia (events)
        - Ordenamso x DIA y CATEGORY agrupando en un ArrayAsociativo
          - Esto el lo hace con muuuuchos if, pero lo hice con un matricial q permite escalar mejor


  - Usamos un Modificador de Sass
    - Para dar estilos a todo el     '.events--workshops'




-- `Slider`
  - Vamos a Instalar paquetes de 3ros con NPM y a usar `Webpack` para agregarla al bundle de js q crea Gulp
    - Instalamos las deps
        `pnpm add -D webpack-stream webpack`
        `pnpm add -D css-loader style-loader`
    - Lo importamos en Gulp
    ```js
    const webpack = require('webpack-stream');

    // Agregamos el pipe de webpack al 'function javascript()'
        .pipe(
            webpack({
                mode: 'production',
                entry: './src/js/app.js',
            })
        )
    // en el   app.js   IMportamos todos los demas archivos de JS para q los tome en cuenta
    ```

  -- Instalamos  Swiper:    `pnpm add swiper`
    - Creamos la logica

  -- Templave Event.php
    - Para reutilizar html y classes
      - Fue IMMMPORTANTEEE tener el modificador con Sass ya que asi pudimos darle estilos al Parten q Envuelve al Event Template



  -- ActiveLink (Next.js/React) en PHP MVC
    - 

















- html:
    - Evitar Seleccion de Text:   `onselectstart="return false"`
    <div class="form__field" onselectstart="return false">
    - Evitar Drag & Drop:         `draggable="false"`

    - Images Optimizadas
      - Usar el   Picture & Source   <--  Gulp se encarga de generar los tipos de img
        - Imgs en el Build direactamente
    ```html
    <div class="devwebcamp__image">
        <picture>
            <source srcset="build/img/sobre_devwebcamp.avif" type="image/avif" draggable="false">
            <source srcset="build/img/sobre_devwebcamp.webp" type="image/webp" draggable="false">
            <img loading="lazy" src="build/img/sobre_devwebcamp.jpg" alt="Imagen DevWebCamp" width="200" height="300" draggable="false">
        </picture>
    </div>
    ```
        - Sin la URL como EnvV

```php
 <div class="event__author-info">
    <picture>
        <source srcset="/img/speakers/<?php echo $event->speaker->image; ?>.webp" type="image/webp" draggable="false">
        <source srcset="/img/speakers/<?php echo $event->speaker->image; ?>.png" type="image/png" draggable="false">
        <img loading="lazy" src="/img/speakers/<?php echo $event->speaker->image; ?>.png" alt="Imagen Ponente" width="200" height="300" class="event__image-author" draggable="false">
    </picture>
</div>
```

        - Imgs with URL
```html
<div class="form__image">
    <picture>
        <source srcset="<?php echo $_ENV['HOST'] . '/img/speakers/' . $speaker->image; ?>.webp" type="image/webp" draggable="false" >
        <source srcset="<?php echo $_ENV['HOST'] . '/img/speakers/' . $speaker->image; ?>.png" type="image/png" draggable="false" >
        <img
            src="<?php echo $_ENV['HOST'] . '/img/speakers/' . $speaker->image; ?>.png"
            alt="Imagen Ponente"
            draggable="false"
        >
    </picture>
</div>
```






    // TODO:
      -- Relaciones SQL
        - Relacion entre   Person (User & Speaker)
          - Asi Tengo Person de la cual extiende User y Speaker
            - C/u tiene lo unico de ellos y comparten lo mismo con Person
        -  



