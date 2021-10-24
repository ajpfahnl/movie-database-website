<html>
<head><title>Actor</title></head>

<style>
table, th, td {
  border: 0.5px solid black;
}
</style>
</head>

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

echo "<h1>Actor Information Page:</h1>";
echo "<hr>";
echo "<h2>Actor Information Is: </h2>";

echo "<table>
        <tr>
            <th>Name</th>
            <th>Sex</th>
            <th>Date of Birth</th>
            <th>Date of Death</th>
        </tr>";

$actor_sql = "SELECT DISTINCT * FROM Actor WHERE first<>'NULL' AND id={$_GET["id"]}";
$rs = $db->query($actor_sql);

while ($row = $rs->fetch_assoc()) { 
    $aid = $row['id']; 
    $first = $row['first']; 
    $last = $row['last'];
    $sex = $row['sex'];
    $dob = $row['dob'];
    $dod = $row['dod'];

    // echo gettype($dod), "\n";

    $still_alive = "Still Alive";

    if ($dod === NULL) {
        $dod = $still_alive;
    }

    echo "<tr>
            <td>$first $last</td>
            <td>$sex</td>
            <td>$dob</td> 
            <td>$dod</td>
        </tr>"; 
    // echo "$id, $first, $last, $sex, $dob, $dod<br>";
}

echo "</table>";

// echo "curr_id = {$_GET["id"]} ";
// echo "test test";

/////////////////////////////////////

// $actor2_sql = "SELECT * FROM MovieActor WHERE aid={$_GET["id"]}";
$actor2_sql = "SELECT DISTINCT * FROM Movie M LEFT OUTER JOIN MovieActor MA ON M.id=MA.mid WHERE title<>'NULL' AND MA.aid={$_GET["id"]}";
$rs2 = $db->query($actor2_sql);

echo "<h2>Actor's Movies and Role: </h2>";

echo "<table>
        <tr>
            <th>Role</th>
            <th>Title</th>
        </tr>";

while ($row = $rs2->fetch_assoc()) { 
    $role = $row['role'];
    $title = $row['title']; 
    echo "<tr>
            <td>\"$role\"</td>
            <td>
                <a href=\"/movie.php?id={$row["mid"]}\">
                    {$row['title']}
                </a>
            </td>
        </tr>"; 
    // echo "$id, $first, $last, $sex, $dob, $dod<br>";

}

/*
<td>$title</td>
<td>{$title['title']}</td>
<td>
    <a href=\"/movie.php?title={$row["title"]}\"></a>
</td>
*/

echo "</table>";

////////////////////////////////////

// $link = "SELECT * FROM Movie M LEFT OUTER JOIN MovieActor MA ON M.id=MA.mid";
// $rs3 = $db->query($link);

/*
if ($rs3->num_rows > 0) {
    $row = $rs3->fetch_assoc()
    $first = $row['first']; 
    $last = $row['last'];
    $sex = $row['sex'];
    $dob = $row['dob'];
    $dod = $row['dod'];
    echo "$id, $first, $last, $sex, $dob, $dod<br>";
}
*/

?>
</body>
</html>