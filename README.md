## Crear shortcode wordpress

https://codex.wordpress.org/Shortcode_API

Un shortcode es una función que retorna un html, el cual puede ser tan interactivo como uno quiera.

#### La sintaxis basica de un shortcode dentro del editor de wordpress.

```
[prefix_form placeholder_name="Nombre" placeholder_lastname="Apellido" btn_text="Enviar"]
```
#### y retornaría:

```html
<form action="#">
  <input type="text" placeholder="Nombre" name="name" />
  <input type="text" placeholder="Apellido" name="lastname" />
  <button>Enviar</button>
</form>
```

#### Para que lo de arriba retorne un formulario se debe crear la siguiente función:

```PHP
<?php

function prefix_form_sc( $atts ) {
    $at = shortcode_atts( array(
      'url_action' => '#',
      'placeholder_name' => '',
      'placeholder_lastname' => '',
      'btn_text' => ''
    ), $atts );

  ob_start();
?>

<!-- Aquí va el html -->

  <form action="<?php echo $at['url_action'] ?>">
    <input
      type="text"
      placeholder="<?php echo $at['placeholder_name']  ?>"
      name="name"
    />
    <input
      type="text"
      placeholder="<?php echo $at['placeholder_lastname']  ?>"
      name="lastname"
    />
    <button><?php echo $at['btn_text'] ?></button>
  </form>

<?php
  return ob_get_clean();
}

add_shortcode( 'prefix_form', 'prefix_form_sc' );
```

#### Se puede agregar javascript
```PHP
<?php

function prefix_form_sc( $atts ) {
    $at = shortcode_atts( array(
      'form_name' => '',
      'url_action' => '#',
      'placeholder_name' => '',
      'placeholder_lastname' => '',
      'btn_text' => ''
    ), $atts );

  ob_start();
?>

<!-- Aquí va el html -->

  <form id="<?php echo $at['form_name'] ?>" action="<?php echo $at['url_action'] ?>">
    <input
      type="text"
      placeholder="<?php echo $at['placeholder_name']  ?>"
      name="name"
    />
    <input
      type="text"
      placeholder="<?php echo $at['placeholder_lastname']  ?>"
      name="lastname"
    />
    <button><?php echo $at['btn_text'] ?></button>
  </form>

  <script>
    $("#<?php echo $at['form_name'] ?>").on('submit', function(event) {
      event.preventDefault();

      var data = $(this).serialize();

      $.ajax({
        url: '<?php echo $at['url_action'] ?>',
        data: data
      })
      .then(function(res) {
        console.log(res);
      });
    });
  </script>

<?php
  return ob_get_clean();
}

add_shortcode( 'prefix_form', 'prefix_form_sc' );
```

```
  [prefix_form
    form_name="contacto"
    action_url="http://localhost/wp-admin/admin-ajax.php"
    placeholder_name="Nombre"
    placeholder_lastname="Apellido"
    btn_text="Enviar"
  ]
```

```html
<form id="contacto" action="http://localhost/wp-admin/admin-ajax.php">
  <input
    type="text"
    placeholder="<?php echo $at['placeholder_name']  ?>"
    name="name"
  />
  <input
    type="text"
    placeholder="<?php echo $at['placeholder_lastname']  ?>"
    name="lastname"
  />
  <button><?php echo $at['btn_text'] ?></button>
</form>

<script>

  //Cuando se oprima click en el boton del formuario
  $("#contacto").on('submit', function(event) {
    /*
      Previene que la acción por defecto no se ejecute
      en este caso que el formulario no refresque el navegador.
    */
    event.preventDefault();
    /*
      $(this) es igual a $("#contacto")
      serialize agarra todos los campos del formulario y los transforma
      en información para enviar al servidor.
    */
    var data = $(this).serialize();
    /*
      ajax envia una petición asincrónica al servidor
      cuando el servidor contesta la funcion then se
      ejecuta y retorna el resultado.
    */
    $.ajax({
      url: 'http://localhost/wp-admin/admin-ajax.php',
      data: data
    })
    .then(function(res) {
      console.log(res);
    });
  });
</script>

```
