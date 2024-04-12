<?php

// uninstalling the cron
if ( wp_next_scheduled( 'my_cron_event' ) ) {
    wp_clear_scheduled_hook( 'my_cron_event' );
}