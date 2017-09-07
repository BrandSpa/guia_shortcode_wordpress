<?php

function prefix_form_sc( $atts ) {
    $at = shortcode_atts( array(
      'form_name' => '',
      'url_action' => '/wp-admin/admin-ajax.php',
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

      var formData = $(this).serialize();
      var data = {action: 'contact_store', data: formData};

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
