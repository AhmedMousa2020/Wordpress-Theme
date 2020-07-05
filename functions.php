<?php



require_once get_template_directory() . '/wp-bootstrap-navwalker.php';


add_theme_support( 'post-thumbnails' );



/*git the css files*/

function add_style()
{
    wp_enqueue_style('bootstrap-css',get_template_directory_uri().'/css/bootstrap.min.css');
    wp_enqueue_style('fontawesome-css',get_template_directory_uri().'/css/font-awesome.min.css');
    wp_enqueue_style('main',get_template_directory_uri().'/css/main.css');
}

/*git the js files*/

function add_scripts()
{
    //remove registeration for old jquery
    wp_deregister_script('jquery');
    //register a neew jquery in footer
    wp_register_script('jquery',includes_url('/js/jquery/jquery.js'),false,'',true);
    //Enqueue the new jquery
    wp_enqueue_script('jquery');
    wp_enqueue_script('bootstrap-js',get_template_directory_uri().'/js/bootstrap.min.js',array(),false,true);
    wp_enqueue_script('main-js',get_template_directory_uri().'/js/main.js',array(),false,true);
}


function custom_menu()
{
    register_nav_menus(array(
        'bootstrap-menu'=>'Navigation Bar',
        'footer-menu'   =>'Footer Menu'
    ));
}

function bootstrap_menu()
{
     wp_nav_menu(array(
         'theme_location'=>'bootstrap-menu',
         'menu_class'    =>'nav navbar-nav navbar-right',
         'container'     =>'false',
         'depth'         =>2,
         'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
         'walker'            => new WP_Bootstrap_Navwalker()
     ));
}


function extend_excerpt_length($length)
{
    if(is_author())
    {
        return 40;
    }elseif(is_category())
    {
        return 50;
    }
    else
    {
    return 40;
    }
}

function excerpt_change_dot($more)
{
    return ' ...';
}

add_filter('excerpt_length','extend_excerpt_length');
add_filter('excerpt_more','excerpt_change_dot');

add_action('wp_enqueue_scripts','add_style');
add_action('wp_enqueue_scripts','add_scripts');
add_action('init','custom_menu');


function numbering_pagination()
{
   global $wp_query;

   $all_pages=$wp_query->max_num_pages;

   $curent_page=max(1,get_query_var('paged'));

   if($all_pages > 1)
   {
       return paginate_links(array(

           'base'    => get_pagenum_link() . '%_%' ,
           'format'  => 'page/%#%',
           'current' =>$curent_page ,

       ));
   }
}


    function main_sidebar()
    {
       register_sidebar(array(
           'name'         =>'Main Sidebar',
           'id'           =>'main-sidebar',
           'description'  =>'sidebar Appeare evryware',
           'class'        =>'main-sidebar',
           'before_widget'=>'<div class="widget-content">',
           'after_widget' =>'</div>',
           'before_title' =>'<h3 class="widget-title">',
           'after_title'  =>'</h3>'
       )); 
    }

    add_action('widgets_init','main_sidebar');


    function rempve_paragraph($content)
    {
        remove_filter('the_content','wpautop');
        return $content;
    }

    add_filter('the_content','rempve_paragraph',0);

?>