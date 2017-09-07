<?php

function prefix_form_sc( $atts ) {
    $at = shortcode_atts( array(
      'url_action' => '#',
      'placeholder_name' => '',
      'placeholder_lastname' => ''
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
    <button>Enviar</button>
  </form>

<?php
  return ob_get_clean();
}

add_shortcode( 'prefix_form', 'prefix_form' );

// usar shortcode
//[prefix_form placeholder_name="Nombre" placeholder_lastname="Apellido"]
