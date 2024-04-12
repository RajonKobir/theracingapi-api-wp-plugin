<?php



function my_template_array(){
    $temps = [];
    $temps['horse-racing-api.php'] = __( 'Horse Racing API', 'BestOfBets' );
    

    return $temps;
}

function my_template_register($page_templates, $theme, $post){
    $templates = my_template_array();
    foreach($templates as $key => $value){
        $page_templates[$key] = $value;
    }

    return $page_templates;
}

add_filter('theme_page_templates', 'my_template_register', 10, 3 );


function my_template_select($template)
{
    global $post, $wp_query, $wpdb;

    $page_temp_slug = get_page_template_slug($post -> ID);
    // echo MYPLUGIN_PATH.'inc/page-templates/' .  $page_temp_slug;

    $templates = my_template_array();
    if(isset($templates[$page_temp_slug]) ){
        $template = MYPLUGIN_PATH.'inc/page-templates/' .  $page_temp_slug;
    }

    return $template;

}
add_filter('template_include', 'my_template_select', 99 );