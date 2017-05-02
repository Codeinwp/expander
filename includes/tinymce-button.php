<?php

function expander_add_tinymce_button(){
  global $typenow;

  //check permissions

  if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ){
    return;
  }

  //verify post type

  if ( ! in_array( $typenow, array( 'post', 'page' ) ) )
    return;


  //check if WYSIWYG is enabled

  if ( get_user_option( 'rich_editing' ) == 'true' ){

    add_filter( 'mce_external_plugins', 'expander_add_tinymce_plugin' );
    add_filter( 'mce_buttons', 'expander_register_tinymce_button' );

  }

}
add_action( 'admin_head', 'expander_add_tinymce_button' );

function expander_add_tinymce_plugin( $plugin_array ){

//button script path //change this to plugin dir
$plugin_array['expander_button'] = plugins_url( '../assets/js/tinymce-button.js?v1.0.0'.time(), __FILE__ );
return $plugin_array;

}

function expander_register_tinymce_button( $buttons ){

array_push( $buttons, 'expander_button');
return $buttons;

}
