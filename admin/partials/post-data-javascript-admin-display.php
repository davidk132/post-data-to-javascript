<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://www.davidkissinger.com
 * @since      1.0.0
 *
 * @package    Post_Data_Javascript
 * @subpackage Post_Data_Javascript/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="wrap">
  <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
  <h3>Put your post data on the DOM as JavaScript</h3>
  <p>Render individual fields of designated post types as a JavaScript object on the page. This is ideal for when you just want to display data and stylize it with a third-party JavaScript library or something you roll on your own.</p>
  <p>If you want a full-fledged API with CRUD applications, then this plugin is not for you. Try the WP-API or another library instead.</p>
  <form action="options.php" method="post">
    <?php
      settings_fields( $this->plugin_name );
      do_settings_sections( $this->plugin_name );
      submit_button();
    ?>
  </form>
</div>

<?php
