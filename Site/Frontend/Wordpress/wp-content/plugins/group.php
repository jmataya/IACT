<?php
/*
Plugin Name: Group Info
Plugin URI: http://www.iactpgh.com
Description: Get the info for a group from an IACT event.
Author: Jeff Mataya
Version: 1
Author URI: http://www.iactpgh.com
*/

    function postAspect($field, $content)
    {
        if ($content != "")
        {
        echo "<p><em>".$field."</em><br />";

            $tok = strtok($content, ";");
            while ($tok != false)
            {
                echo $tok."<br />";
                $tok = strtok(";");
            }
            echo "</p>";
        }
    }

    function performQuery($query)
    {
        // Connect to the 'iact' database on a local MySQL install.
        $hostname = 'iacteventinfo.db.6692675.hostedresource.com';
        $username = 'iacteventinfo';
        $password = 'WSP@ssw0rd';
        $dbname = 'iacteventinfo';
        @ $db = mysqli_connect($hostname, $username, $password, $dbname);

        if (mysqli_connect_errno())
        {
            // TODO - Jeff: Implement better error messaging.
            echo 'Error: Database unavailable';
            exit;
        }       

        $result = mysqli_query($db, $query);

        mysqli_close($db);
        return $result;
    }


function getGroupInfo()
{
     // Get the query string parameter.
                            $groupNumber = $_GET['g'];
                    
                            // Get basic information about the group.
                            // At this time, this is just the name.
                            if ($result = performQuery("call get_group('1', '".$groupNumber."')"))
                            {
                                while ($row = mysqli_fetch_array($result))
                                {
                                    echo "<h2>";
                                    echo $row['group_name'];
                                    echo "</h2>";
                                }

                                mysqli_free_result($result);
                            }

                            // List the members of the group.
                            echo "<p><em>Members</em></br>";
                            echo "<ul>";
                            if ($result = performQuery("call get_group_members('".$groupNumber."')"))
                            {
                                while ($row = mysqli_fetch_array($result))
                                {
                                    echo "<li>".$row['first_name']." ".$row['last_name']."</li>";
                                }

                                mysqli_free_result($result);
                            }
                            echo "</ul></p>";

                            // Get solution proposed by the group.
                            echo "<h2>Solution</h2>";
                            if ($result = performQuery("call get_execute('".$groupNumber."')"))
                            {
                                while ($row = mysqli_fetch_array($result))
                                {
                                    postAspect('Problem', $row['problem']);
                                    postAspect('Solution', $row['solution']);
                                    postAspect('Technologies Needed', $row['technology']);
                                    postAspect('Team Needed', $row['team']);
                                    postAspect('Resources Needed', $row['resources']);
                                    postAspect('Plan for Funding', $row['funding']);
                                }

                                mysqli_free_result($result);
                            }

}

function widget_myGroupInfo($args)
{
    extract($args);
    echo $before_widget;
    echo $before_title;?><?php echo $after_title;
    getGroupInfo();
    echo $after_widget;
}

function myGroupInfo_init()
{
    register_sidebar_widget(__('Group Info'), 'widget_myGroupInfo');
}
add_action("plugins_loaded", "myGroupInfo_init");
?>
