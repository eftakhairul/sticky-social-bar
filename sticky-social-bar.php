<?php
/*
Plugin Name: Sticky Social Bar
Plugin URI: http://eftakhairul.com
Description: Sticky social bar is a simple container of social media icons, glued to the right side of the browser window. 
Version: 1.0
Author: Eftakhairul Islam 
Author URI: http://eftakhairul.com
Wordpress version supported: 3.0 and above
License: GPL2
*/

include("installation-sticky-social-bar.php");

register_activation_hook (__FILE__,'stickysocialbar_install');
register_deactivation_hook (__FILE__,'stickysocialbar_uninstall');



//Admin menu
if ( is_admin() ) {
    add_action('admin_menu', 'stickysocialbar_admin_create_menu');
}


/**
 *  Create admin menu
 */
function stickysocialbar_admin_create_menu()
{
    add_menu_page('Sticky Social Bar', 'Sticky Social Bar', 'administrator', 'sticky-social-bar-setting', 'sticky_social_bar_setting_form',plugins_url('/Sticky-Social-Bar/images/icon_pref_settings.gif',1));
}

/**
 *  Load the setting from
 */
function sticky_social_bar_setting_form()
{
    include("sticky-social-bar-setting-form.php");
}

//Main function Sticky Social Bar
add_action('wp_head', 'sticky_social_bar_css');

//CSS
function sticky_social_bar_css() {
?>
<style type="text/css">
    .sticky-container {
		/*background-color: #333;*/
		padding: 0px;
		margin: 0px;
		position: fixed;
		right: -155px;
		top:130px;
		width: 200px;

	}

	.sticky li {
		list-style-type: none;
		background-color: #333;
		color: #efefef;
		height: 43px;
		padding: 0px;
		margin: 0px 0px 1px 0px;
		-webkit-transition:all 0.25s ease-in-out;
		-moz-transition:all 0.25s ease-in-out;
		-o-transition:all 0.25s ease-in-out;
		transition:all 0.25s ease-in-out;
		cursor: pointer;
		filter: url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\'><filter id=\'grayscale\'><feColorMatrix type=\'matrix\' values=\'0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0 0 0 1 0\'/></filter></svg>#grayscale");
                filter: gray;
                -webkit-filter: grayscale(100%);

	}

	.sticky li:hover {
		margin-left: -115px;
		/*-webkit-transform: translateX(-115px);
		-moz-transform: translateX(-115px);
		-o-transform: translateX(-115px);
		-ms-transform: translateX(-115px);
		transform:translateX(-115px);*/
		/*background-color: #8e44ad;*/
		filter: url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\'><filter id=\'grayscale\'><feColorMatrix type=\'matrix\' values=\'1 0 0 0 0, 0 1 0 0 0, 0 0 1 0 0, 0 0 0 1 0\'/></filter></svg>#grayscale");
                -webkit-filter: grayscale(0%);
	}

	.sticky li a img {
		float: left;
		margin: 5px 5px;
		margin-right: 10px;

	}

	.sticky li a p {
		padding: 0px;
		margin: 0px;
		text-transform: uppercase;
		line-height: 43px;
        text-decoration: none !important;
        color: #ECF0F1;
        font-family: "Lato";
    }
</style>
<?php
}

//HTML
add_action( 'get_footer', 'sticky_social_bar_html' );

function sticky_social_bar_html() {
    global $wpdb;
    $stickySocialBarTable  = $wpdb->prefix . "sticky_social_bar";
    $result = $wpdb->get_results("SELECT * FROM {$stickySocialBarTable} WHERE id = 1");
    $links   = get_object_vars($result[0]);
    unset($links['id']);
    unset($links['update_date']);
?>
<div class="sticky-container">
    <ul class="sticky">
        <?php foreach($links as $name => $link) : ?>
            <?php if(!empty($link)): ?>
            <li>
                <a target="_blank" href="<?php echo $link ?>">
                    <img width="32" height="32" alt="" src="<?php echo site_url(); ?>/wp-content/plugins/Sticky-Social-Bar/images/<?php echo $name ?>.png" />
                    <p><?php echo ucfirst($name) ?></p>
                </a>
            </li>
            <?php endif ?>
        <?php endforeach ?>
    </ul>
</div>
<?php
}