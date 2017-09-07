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

add_shortcode( 'prefix_form', 'prefix_form' );
```
