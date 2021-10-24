<html>
<head><title>Actor</title></head>
<body>
<?php

/*
$servername = "localhost";
$username = "cs143";
$password = "";
$dbname = "class_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
*/ 

$db = new mysqli('localhost', 'cs143', '', 'class_db');
if ($db->connect_errno > 0) { 
    die('Unable to connect to database [' . $db->connect_error . ']'); 
}

// REQUIREMENTS
// This page must take the actor id as the id parameter of the request URL and
// display the corresponding actor’s information, including their name and the
// movies that they were in. For example, the URL 
// http://localhost:8888/actor.php?id=4033 must display the information on Ms.
// Drew Barrymore.

//     Note: Any name=value pair appearing after ? in the URL (e.g., id=4033
//     in http://localhost:8888/actor.php?id=4033) is available as
//     $_GET['name'] (e.g., _GET['id']) in your PHP code.

//     For every movie that the actor was in, the actor page must include a
//     hyperlink to the corresponding “movie page” described next.

// echo "TODO";
// echo "NOT FINISHED";


// $actor_sql = "SELECT * FROM Actor id={$_GET["id"]} OR id=4033"

// $actor_sql = "SELECT * FROM Actor WHERE id=14142";
$actor_sql = "SELECT * FROM Actor WHERE id={$_GET["id"]}";
$rs = $db->query($actor_sql);


while ($row = $rs->fetch_assoc()) { 
    $aid = $row['id']; 
    $first = $row['first']; 
    $last = $row['last'];
    $sex = $row['sex'];
    $dob = $row['dob'];
    $dod = $row['dod'];
    print "$aid, $first, $last, $sex, $dob, $dod<br>"; 
    // echo "$id, $first, $last, $sex, $dob, $dod<br>";
}

echo "curr_id = {$_GET["id"]} ";

/////////////////////////////////////

$actor2_sql = "SELECT * FROM MovieActor WHERE aid={$_GET["id"]}";
$rs = $db->query($actor2_sql);

while ($row = $rs->fetch_assoc()) { 
    $mid = $row['mid']; 
    $role = $row['role'];
    print "$mid, $role<br>"; 
    // echo "$id, $first, $last, $sex, $dob, $dod<br>";
}

/*
if ($rs->num_rows > 0) {
    $row = $rs->fetch_assoc()
    $first = $row['first']; 
    $last = $row['last'];
    $sex = $row['sex'];
    $dob = $row['dob'];
    $dod = $row['dod'];
    echo "$id, $first, $last, $sex, $dob, $dod<br>";
}
*/

/*
if ($rs -> num_rows > 0) {
    $row = $rs->fetch_assoc();
    echo "<h1>" . $row["title"]. "</h1>";
    echo "<p>" . $row["year"] . ", " . $row["rating"] . ", " . $row["company"] . "</p>";
} else {
    die("Actor does not exist");
}
*/


?>
</body>
</html>