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

  function my_login_logo() { ?>
    <style type="text/css">
      #login h1 a, .login h1 a {
        background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/carpe-telam-logo.png);
        height: 80px;
        width: 80px;
        background-size: 80px 80px;
        background-repeat: no-repeat;
        padding-bottom: 30px;
      }
      #backtoblog {
        display: none;
      }
    </style>
  <?php }
  add_action( 'login_enqueue_scripts', 'my_login_logo' );

  function my_login_logo_url() {
    return 'https://www.carpetelam.com';
  }
  add_filter( 'login_headerurl', 'my_login_logo_url' );

  function my_login_logo_url_title() {
    return 'Carpe Telam';
  }
  add_filter( 'login_headertitle', 'my_login_logo_url_title' );

  /**
   * Set the URL to redirect to on login.
   *
   * @return string URL to redirect to on login. Must be absolute.
   */
  function my_forcelogin_redirect() {
    return home_url( '/wp-admin/' );
  }
  add_filter( 'v_forcelogin_redirect', 'my_forcelogin_redirect' );

  /**
   * Filter Force Login to allow exceptions for specific URLs.
   *
   * @param array $whitelist An array of URLs. Must be absolute.
   * @return array
   */
  function my_forcelogin_whitelist( $whitelist ) {
    $whitelist[] = home_url( '/privacy-policy/' );
    return $whitelist;
  }
  add_filter( 'v_forcelogin_whitelist', 'my_forcelogin_whitelist' );

?>
