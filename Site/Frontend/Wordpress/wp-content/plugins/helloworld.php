<?php
/*
Plugin Name: Hello World
Plugin URI: http://www.iactpgh.com
Description: Sample Plugin
Author: Jeff Mataya
Version: 1
Author URI: http://www.iactpgh.com
*/

function sampleHelloWorld()
{
    $title = "Explore IACT";
    $links = array(
        0 => "http://localhost/iact/aging",
        1 => "Browse Past Events",
        2 => "http://localhost/iact/workshops.php",
        3 => "Discover Why IACT is Unique",
        4 => "http://localhost/iact/contact.php",
        5 => "Get Involved");
    createSidebar($title, $links);
}

function createSidebar($title, $links)
{
    echo "<div id=\"sidebar\"><div id=\"title\">";
    echo "<h3>".$title."</h3>";
    echo "</div>";
    echo "<div id=\"navigation\">";
    echo "<ul id=\"firstLevel\">";
    
    $count = count($links);
    for ($i = 0; $i < $count; $i = $i + 2)
    {
        echo "<li><a href=\"".$links['$i']."\">".$links['$i' + 1]."</a></li>";
    }

    echo "</ul>";
    echo "</div></div>";
}

function widget_myHelloWorld($args)
{
    extract($args);
    echo $before_widget;
    echo $before_title;?>My Widget Title<?php echo $after_title;
    sampleHelloWorld();
    echo $after_widget;
}

function myHelloWorld_init()
{
    register_sidebar_widget(__('Hello World'), 'widget_myHelloWorld');
}
add_action("plugins_loaded", "myHelloWorld_init");
?>
