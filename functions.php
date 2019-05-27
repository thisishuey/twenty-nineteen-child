<?php

  function my_theme_enqueue_styles() {
    $parent_style = 'parent-style';
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
      get_stylesheet_directory_uri() . '/style.css',
      array( $parent_style ),
      wp_get_theme()->get('Version')
    );
  }
  add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

  /**
   * Add WPGraphQL args to custom post types
   *
   * @param array $args
   * @param string $post_type
   * @return array
   */
  function my_custom_post_type_graphql( $args, $post_type ) {
    switch( $post_type ) {
      case 'projects':
        $args['show_in_graphql'] = true;
        $args['graphql_single_name'] = 'Project';
        $args['graphql_plural_name'] = 'Projects';
        break;
    }
    return $args;
  }
  add_filter( 'register_post_type_args', 'my_custom_post_type_graphql', 10, 2 );

?>
