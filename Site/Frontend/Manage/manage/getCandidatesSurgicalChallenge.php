<html>
<head>
<title>Event Candidates</title>
</head>
<body>
<h1>Candidates</h1>
<table border="1">
<tr>
<th>Name</th>
<th>School</th>
<th>Department</th>
<th>Level</th>
<th>Email</th>
<th> Reason</th>
</tr>
<tr> 
</tr>
<?php
    $hostname = 'iacteventinfo.db.6692675.hostedresource.com';
    $username = 'iacteventinfo';
    $password = 'WSP@ssw0rd';
    $dbname = 'iacteventinfo';
    @ $db = mysqli_connect($hostname, $username, $password, $dbname);

    if (mysqli_connect_errno()) {
        echo 'Error';
        exit;
    }

    $sproc = "select * from candidates_surgical where event_id=4";
    if ($result = mysqli_query($db, $sproc)) {
        while ($row = mysqli_fetch_array($result)) {
	    echo "<tr>";
	    echo "<td>";
	    $name = $row['first_name']." ".$row['last_name'];
	    echo $name;
	    echo "</td>";
	    echo "<td>";
	    $school = $row['school'];
	    echo $school;
	    echo "</td>";
echo "<td>";
	    $department = $row['department'];
	    echo $department;
	    echo "</td>";
echo "<td>";
	    $level = $row['level'];
	    echo $level;
	    echo "</td>";
echo "<td>";
	    $email = $row['email'];
	    echo $email;
	    echo "</td>";
echo "<td>";
	    $reason = $row['reason'];
	    echo $reason;
	    echo "</td>";
	    echo "</tr>";
        }	
}
        mysqli_free_result($result);
?>
</table>
</body>
</html>
