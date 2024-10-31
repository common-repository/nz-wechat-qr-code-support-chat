<?php
/**
* Plugin Name: Wechat QR Code Support Chat
* Plugin URI: http://everblinks.com.cn
* Description: This plugin adds a sticky box at bottom in frontend to place a wechat QR code to make online support chat more easy.
* Version: 1.0
* Author: Syed Nazrul Hassan
* Author URI: https://nazrulhassan.wordpress.com/
* Author Email: nazrulhassanmca@gmail.com
* License: GPL3
*/
if ( ! defined( 'ABSPATH' ) ) exit;
add_action('admin_menu', 'wechat_create_menu');

function wechat_create_menu() {
add_menu_page('Wechat Settings', 'Wechat Settings', 'administrator', 'wechat', 'wechat_plugin_settings_page' , plugin_dir_url( __FILE__ ).'/assets/images/icon.png' );	
}
add_action( 'admin_init', 'wechat_plugin_settings' );
function wechat_plugin_settings() {
//register our settings
register_setting( 'wechat_settings_group', 'wechat_icon' );
register_setting( 'wechat_settings_group', 'wechat_text' );
register_setting( 'wechat_settings_group', 'wechat_qrcode' );
register_setting( 'wechat_settings_group', 'wechat_mobile' );
register_setting( 'wechat_settings_group', 'wechat_text_before' );
register_setting( 'wechat_settings_group', 'wechat_text_after' );
}
function wechat_plugin_settings_page() {
?>
<div class="wrap">
<h2><?php _e( 'Wechat Settings', 'wechat' ); ?></h2>
<form method="post" action="options.php">
<?php settings_fields( 'wechat_settings_group' ); ?>
<?php do_settings_sections( 'wechat_settings_group' ); ?>
<table class="form-table">
    <tr valign="top">
        <th scope="row"><?php _e( 'Wechat Sticky Icon Url', 'wechat' ); ?></th>
        <td><input type="text" class="regular-text" placeholder="<?php _e( 'Please enter icon url', 'wechat' ); ?>" name="wechat_icon" value="<?php echo esc_attr( get_option('wechat_icon') ); ?>" /></td>
    </tr>
    
    <tr valign="top">
        <th scope="row"><?php _e( 'Wechat Sticky Text', 'wechat' ); ?></th>
        <td><input type="text" class="regular-text" placeholder="<?php _e( 'Please enter text before icon', 'wechat' ); ?>" name="wechat_text" value="<?php echo esc_attr( get_option('wechat_text') ); ?>" /></td>
    </tr>
    
    <tr valign="top">
        <th scope="row"><?php _e( 'Wechat QR Code Url', 'wechat' ); ?></th>

        <td><input type="text" class="regular-text" placeholder="<?php _e( 'Please enter QR code url', 'wechat' ); ?>" name="wechat_qrcode" value="<?php echo esc_attr( get_option('wechat_qrcode') ); ?>" /></td>
    </tr>

    <tr valign="top">
        <th scope="row"><?php _e( 'Wechat Responsive Text', 'wechat' ); ?></th>
        <td><input type="text" class="regular-text" placeholder="<?php _e( 'This text appears on devices less than 768px of width', 'wechat' ); ?>" name="wechat_mobile" value="<?php echo esc_attr( get_option('wechat_mobile') ); ?>" /></td>
    </tr>


    <tr valign="top">
        <th scope="row"><?php _e( 'Text Before', 'wechat' ); ?></th>
        <td><input type="text" class="regular-text" placeholder="<?php _e( 'This text appears before QR code', 'wechat' ); ?>" name="wechat_text_before" value="<?php echo esc_attr( get_option('wechat_text_before') ); ?>" /></td>
    </tr>

    <tr valign="top">
        <th scope="row"><?php _e( 'Text After', 'wechat' ); ?></th>
        <td><input type="text" class="regular-text" placeholder="<?php _e( 'This text appears after QR code', 'wechat' ); ?>" name="wechat_text_after" value="<?php echo esc_attr( get_option('wechat_text_after') ); ?>" /></td>
    </tr>
</table>
<?php submit_button(); ?>
</form>
</div>
<?php } ?>
<?php 
function wechat_frontend_name () { ?>

<div id="footer_icon"><?php echo get_option('wechat_text') ; ?>
    <?php $image = '' == get_option('wechat_icon') ? plugin_dir_url( __FILE__ ).'/assets/images/wechat.png': get_option('wechat_icon'); ?>
    <img src="<?php echo $image ; ?>" width="35" />

</div>
<div id="footer_qrcode">
    <span id="close">
        <img src="<?php echo plugin_dir_url( __FILE__ ) ;?>/assets/images/cross.png"/>
    </span><br/>
    <p class="before"><?php echo get_option('wechat_text_before') ; ?></p>
    <?php $qrcode = '' == get_option('wechat_qrcode') ? plugin_dir_url( __FILE__ ).'/assets/images/wechatqr.png' : get_option('wechat_qrcode'); ?>
    <img src="<?php echo $qrcode ; ?>" width="300" />
    <p class="after"><?php echo get_option('wechat_text_after') ; ?></p>
</div>
<div id="mobile_text"><?php echo get_option('wechat_mobile') ; ?></div>
<?php }
add_action('wp_footer', 'wechat_frontend_name');
function wechat_css() {
    wp_enqueue_style( 'wechatcss',  plugin_dir_url( __FILE__ ) . 'assets/css/wechat.css' );
}
add_action( 'wp_enqueue_scripts', 'wechat_css' );

function wechat_js() {
   wp_enqueue_script( 'wechatjs', plugin_dir_url( __FILE__ ) . 'assets/js/wechat.js', array('jquery'), '1', true );
}
add_action( 'wp_enqueue_scripts', 'wechat_js' );
?>