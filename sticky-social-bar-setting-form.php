<?php

global $wpdb;

$stickySocialBarTable  = $wpdb->prefix . "sticky_social_bar";
settings_fields('sticky-social-bar');

//Update submit value
if(!empty($_POST['link'])) {

    $data = array('facebook'  => isset($_POST['link']['facebook'])? $_POST['link']['facebook']:'',
                  'twitter'   => isset($_POST['link']['twitter'])? $_POST['link']['twitter']:'',
                  'vemo'      => isset($_POST['link']['vemo'])? $_POST['link']['vemo']:'',
                  'rss'       => isset($_POST['link']['rss'])? $_POST['link']['rss']:'',
                  'pinterest' => isset($_POST['link']['pinterest'])? $_POST['link']['pinterest']:'',
                  'tumblr'    => isset($_POST['link']['tumblr'])? $_POST['link']['tumblr']:'',
                  'linkedin'  => isset($_POST['link']['linkedin'])? $_POST['link']['linkedin']:''
                );

    $wpdb->update($stickySocialBarTable, $data, array('id' => 1));
}

// Define form value
$result = $wpdb->get_results("SELECT * FROM {$stickySocialBarTable} WHERE id = 1");
$link   = (!empty($_POST['link'])) ? $_POST['link'] : get_object_vars($result[0]);
?>

<div class="wrap">
    <h2>Sticky Social Bar Setting</h2>

    <?php if(!empty($_POST['link'])) : ?>
    <div class="updated inline below-h2">
        <p> All links are updated successfully. </p>
    </div>
<br/>
<?php endif; ?>

    <form method="post" action="<?php echo $_SERVER['REQUEST_URI']?>">
        <?php wp_nonce_field('update-options'); ?>
        <label for="link[facebook]">
            Facebook:
        </label>
        <input type="text" name="link[facebook]" id='facebook' value="<?php echo $link['facebook']; ?>"/>
        <br/>

        <label for="link[facebook]">
            Twitter:
        </label>
        <input type="text" name="link[twitter]" id='twitter' value="<?php echo $link['twitter']; ?>"/>
        <br/>

        <label for="link[facebook]">
            Vemo:
        </label>
        <input type="text" name="link[vemo]" id='vemo' value="<?php echo $link['vemo']; ?>"/>
        <br/>


        <label for="link[facebook]">
            Pinterest:
        </label>
        <input type="text" name="link[pinterest]" id='pinterest' value="<?php echo $link['pinterest']; ?>"/>
        <br/>

        <label for="link[facebook]">
            RSS:
        </label>
        <input type="text" name="link[rss]" id='rss' value="<?php echo $link['rss']; ?>"/>
        <br/>

        <label for="link[linkedin]">
            LinkedIn:
        </label>
        <input type="text" name="link[linkedin]" id='linkedin' value="<?php echo $link['linkedin']; ?>"/>
        <br/>

        <label for="link[linkedin]">
            Tumblr:
        </label>
        <input type="text" name="link[tumblr]" id='tumblr' value="<?php echo $link['tumblr']; ?>"/>
        <br/>

        <input type="submit" class="button-primary" name="save-fav-icon" value="<?php _e('Save Changes') ?>"/>
        <input type="hidden" name="action" value="update"/>
    </form>
</div>