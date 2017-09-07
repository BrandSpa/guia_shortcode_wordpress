<?php

add_action( 'wp_ajax_nopriv_contact_store', 'contact_store' );
add_action( 'wp_ajax_contact_store', 'contact_store' );

function contact_store() {
  $res = $_POST['data'];
  header('Content-type: application/json');
  echo json_encode($res);
  die();
}
