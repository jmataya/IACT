<?php
/*
Plugin Name: Submit Surgical Innovation Challenger
Plugin URI: http://www.iactpgh.com
Description: Submit a new entry for the surgical innovation participant.
Author: Jeff Mataya
Version: 1
Author URI: http://www.iactpgh.com
*/

function submitSurgicalChallenge()
{
    // TODO: Put database credentials in a standard location.
    // TODO: Get a parameter to determine which event to write to.
    // Create short variable names.
    $first_name=htmlspecialchars(trim($_POST['first_name']));
    $last_name=htmlspecialchars(trim($_POST['last_name']));
    $university=htmlspecialchars(trim($_POST['university']));
    $department=htmlspecialchars(trim($_POST['department']));
    $degree=htmlspecialchars(trim($_POST['degree']));
    $email=htmlspecialchars(trim($_POST['email']));
    $reason=htmlspecialchars(trim($_POST['reason']));

    // Check the lengths of the variables
    if (strlen($first_name) > 45)
    {
        echo 'Error: invalid first name.';
        exit;
    }
    if (strlen($last_name) > 45)
    {
        echo 'Error: invalid last name.';
        exit;
    }
    if (strlen($university) > 120)
    {
        echo 'Error: invalid university.';
        exit;
    }
    if (strlen($department) > 120)
    {
        echo 'Error: invalid department.';
        exit;
    }
    if (strlen($degree) > 45)
    {
        echo 'Error: invalid degree.';
        exit;
    }
    if (strlen($email) > 120)
    {
        echo 'Error: invalid email.';
        exit;
    }
    if (strlen($reason) > 2000)
    {
        echo 'Error: invalid reason.';
        exit;
    }

    // Connect to the local MySQL database.
    $hostname = 'iacteventinfo.db.6692675.hostedresource.com';
    $username = 'iacteventinfo';
    $password = 'WSP@ssw0rd';
    $dbname = 'iacteventinfo';
    @ $db = mysqli_connect($hostname, $username, $password, $dbname);

    if (mysqli_connect_error())
    {
        // TODO - Jeff: Implement better error messaging.
        echo 'Error: Database unavailable';
        exit;
    }

    $query = "call add_candidate_surgical('"
        .$first_name."','"
        .$last_name."','"
        .$university."','"
        .$department."','"
        .$degree."','"
        .$email."','"
        .$reason."')";
                         
    $result = mysqli_query($db, $query);

    if ($result != 1)
    {  
        echo "<p>There was an error submitting your application. Please try again. If you are still having difficulties, please contact info@iactpgh.com.</p>";
        echo "<p><a href=\"..\apply\">Try Again</a></p>";
    }
    else
    {
        echo "<p>Your application has been successfully submitted to IACT. Thank you!</p>";
        echo "<p>Return to the <a href=\"..\">event home/a></p>";
    }
               
    mysqli_close($db);
}

function widget_submitSurgicalChallenge($args)
{
    extract($args);
    echo $before_widget;
    echo $before_title;?><?php echo $after_title;
    submitSurgicalChallenge();
    echo $after_widget;
}

function mySubmitSurgicalChallenge_init()
{
    register_sidebar_widget(__('Submit Surgical Challenge User'), 'widget_mySubmitSurgicalChallenge');
}
add_action("plugins_loaded", "mySubmitSurgicalChallenge_init");
?>
