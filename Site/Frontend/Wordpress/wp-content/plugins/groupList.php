<?php
/*
Plugin Name: Group List
Plugin URI: http://www.iactpgh.com
Description: Get the list of groups from an IACT event.
Author: Jeff Mataya
Version: 1
Author URI: http://www.iactpgh.com
*/

function getGroupList()
{
    getGroups();
}

function getGroups()
{
    $hostname = 'iacteventinfo.db.6692675.hostedresource.com';
    $username = 'iacteventinfo';
    $password = 'WSP@ssw0rd';
    $dbname = 'iacteventinfo';
    $event_id = 1;
    @ $db = mysqli_connect($hostname, $username, $password, $dbname);

    if (mysqli_connect_errno()) {
        echo 'Error';
        exit;
    }
    
    $sproc = "call get_groups('".$event_id."')";
    if ($result = mysqli_query($db, $sproc)) {
        while ($row = mysqli_fetch_array($result)) {
            $name = "<a href=\"group/?g=".$row['group_id']."\">".$row['group_name']."</a>";
            $leader = $row['first_name']." ".$row['last_name'];

            echo "<p><em>";
            echo $name;
            echo "</em><br />";
            echo "Leader: ".$leader;
            echo "</p>";
        }

        mysqli_free_result($result);
    }   
}

function widget_myGroupList($args)
{
    extract($args);
    echo $before_widget;
    echo $before_title;?><?php echo $after_title;
    getGroupList();
    echo $after_widget;
}

function myGroupList_init()
{
    register_sidebar_widget(__('Group List'), 'widget_myGroupList');
}
add_action("plugins_loaded", "myGroupList_init");
?>
