<?php

global $version;
$version = "3.0";

// Installation Function
function stickysocialbar_install()
{
    global $version, $wpdb;

	if (!version_compare($version, '3.0', '>=')) {

        error_log('Please install version greater than 3.0');
        echo 'Please install version greater than 3.0';
    }

    $stickySocialBarTable  = $wpdb->prefix . "sticky_social_bar";
    $createTableSql = "CREATE TABLE IF NOT EXISTS `{$stickySocialBarTable}` (
                      `id` tinyint(2) NOT NULL,
                      `facebook` varchar(500) DEFAULT NULL,
                      `twitter` varchar(500) DEFAULT NULL,
                      `vemo` varchar(500) DEFAULT NULL,
                      `pinterest` varchar(500) DEFAULT NULL,
                      `linkedin` varchar(500) DEFAULT NULL,
                      `rss` varchar(500) DEFAULT NULL,
                      `tumblr` varchar(500) DEFAULT NULL,
                      `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                      PRIMARY KEY (`id`)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    $insertSql      = "INSERT INTO `{$stickySocialBarTable}` (`id`, `facebook`, `twitter`, `vemo`, `pinterest`, `linkedin`, `rss`, `tumblr`, `update_date`) VALUES ('1', '#', '#', '#', '#', '#', '#', '#', CURRENT_TIMESTAMP);";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    dbDelta($createTableSql);
    dbDelta($insertSql);
}

// Un-installation function
function stickysocialbar_uninstall()
{
    global $wpdb;
    $stickySocialBarTable  = $wpdb->prefix . "sticky_social_bar";

    //Checking and driping the table
    if ($wpdb->get_var("show tables like '$stickySocialBarTable'") == $stickySocialBarTable) {
        $sql = "DROP TABLE {$stickySocialBarTable}";
        $wpdb->query($sql);
    }
}
