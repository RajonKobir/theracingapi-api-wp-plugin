<?php 

/**
 * Add Metaboxx
 */
add_action('add_meta_boxes', 'bestofbets_horse_racing_api_metaboxes');
function bestofbets_horse_racing_api_metaboxes() {
    add_meta_box(
            'bestofbets_horse_racing_api_metabox', 'Horse Racing API Settings', 'bestofbets_horse_racing_api_callback', 'bestofbets_post_type'
    );
}



function bestofbets_horse_racing_api_callback($post) { 
    ?>

    <h1>Horse Racing API Settings</h1>
    <h3>Horse Racing API Sandbox or Production:</h3>
    <p>
        <input type="radio" 
               name="bestofbets_horse_racing_api_sanbox_or_production" id="bestofbets_horse_racing_api_sanbox_or_production1" 
               value="sandbox"  
               class="regular-text" <?php if(get_post_meta($post->ID, 'bestofbets_horse_racing_api_sanbox_or_production', true) == 'sandbox'){echo 'checked';}else{ echo ''; }   ?>
               />
        <label for="bestofbets_horse_racing_api_sanbox_or_production1" style="font-weight: 600; font-size: 15px">Sandbox</label>
        <input type="radio" 
               name="bestofbets_horse_racing_api_sanbox_or_production" id="bestofbets_horse_racing_api_sanbox_or_production2" 
               value="production"  
               class="regular-text" <?php if(get_post_meta($post->ID, 'bestofbets_horse_racing_api_sanbox_or_production', true) == 'production'){echo 'checked';}else{ echo ''; }   ?>
               />
        <label for="bestofbets_horse_racing_api_sanbox_or_production2" style="font-weight: 600; font-size: 15px">Production</label>
    </p>

    <label for="bestofbets_horse_racing_api_sandbox_clientid" style="font-weight: 600; font-size: 15px">Horse Racing API Sandbox Username:</label>
    <p>
        <input type="text" 
               name="bestofbets_horse_racing_api_sandbox_clientid" id="bestofbets_horse_racing_api_sandbox_clientid" 
               value="<?php echo get_post_meta($post->ID, 'bestofbets_horse_racing_api_sandbox_clientid', true) ?>"  
               class="regular-text"
               />
    </p>

    <label for="bestofbets_horse_racing_api_sandbox_clientsecret" style="font-weight: 600; font-size: 15px">Horse Racing API Sandbox Password:</label>
    <p>
        <input type="text" 
               name="bestofbets_horse_racing_api_sandbox_clientsecret" id="bestofbets_horse_racing_api_sandbox_clientsecret" 
               value="<?php echo get_post_meta($post->ID, 'bestofbets_horse_racing_api_sandbox_clientsecret', true) ?>"  
               class="regular-text"
               />
    </p>
    <label for="bestofbets_horse_racing_api_production_clientid" style="font-weight: 600; font-size: 15px">Horse Racing API Production Username:</label>
    <p>
        <input type="text" 
               name="bestofbets_horse_racing_api_production_clientid" id="bestofbets_horse_racing_api_production_clientid" 
               value="<?php echo get_post_meta($post->ID, 'bestofbets_horse_racing_api_production_clientid', true) ?>"  
               class="regular-text"
               />
    </p>

    <label for="bestofbets_horse_racing_api_production_clientsecret" style="font-weight: 600; font-size: 15px">Horse Racing API Production Password:</label>
    <p>
        <input type="text" 
               name="bestofbets_horse_racing_api_production_clientsecret" id="bestofbets_horse_racing_api_production_clientsecret" 
               value="<?php echo get_post_meta($post->ID, 'bestofbets_horse_racing_api_production_clientsecret', true) ?>"  
               class="regular-text"
               />
    </p>

    <?php

    // echo MYPLUGIN_NAME;
    echo '<br>';
    echo '<br>';

}


// update post
add_action('save_post', 'update_bestofbets_horse_racing_api_metaboxes');
function update_bestofbets_horse_racing_api_metaboxes($post_id) {

        if(isset($_POST['bestofbets_horse_racing_api_sanbox_or_production'])){
            update_post_meta($post_id, 'bestofbets_horse_racing_api_sanbox_or_production', $_POST['bestofbets_horse_racing_api_sanbox_or_production']);
        }
        if(isset($_POST['bestofbets_horse_racing_api_sandbox_clientid'])){
            update_post_meta($post_id, 'bestofbets_horse_racing_api_sandbox_clientid', $_POST['bestofbets_horse_racing_api_sandbox_clientid']);
        }
        if(isset($_POST['bestofbets_horse_racing_api_sandbox_clientsecret'])){
            update_post_meta($post_id, 'bestofbets_horse_racing_api_sandbox_clientsecret', $_POST['bestofbets_horse_racing_api_sandbox_clientsecret']);
        }
        if(isset($_POST['bestofbets_horse_racing_api_production_clientid'])){
            update_post_meta($post_id, 'bestofbets_horse_racing_api_production_clientid', $_POST['bestofbets_horse_racing_api_production_clientid']);
        }
        if(isset($_POST['bestofbets_horse_racing_api_production_clientsecret'])){
            update_post_meta($post_id, 'bestofbets_horse_racing_api_production_clientsecret', $_POST['bestofbets_horse_racing_api_production_clientsecret']);
        }
        if(isset($_POST['bestofbets_horse_racing_api_ninja_form_id'])){
            update_post_meta($post_id, 'bestofbets_horse_racing_api_ninja_form_id', $_POST['bestofbets_horse_racing_api_ninja_form_id']);
        }
}

