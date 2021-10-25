<html>
<head>
  <a href="/">Home</a>
    <title>Actor</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://unpkg.com/bamboo.css" rel="stylesheet">
</head>
<body>
<?php

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

echo "<h1>Actor Information";
echo "<hr>";

$actor_sql = "SELECT DISTINCT * FROM Actor WHERE first<>'NULL' AND id={$_GET["id"]}";
$rs = $db->query($actor_sql);

if ($rs->num_rows > 0) {
    $row = $rs->fetch_assoc();
    $aid = $row['id']; 
    $first = $row['first']; 
    $last = $row['last'];
    $sex = $row['sex'];
    $dob = $row['dob'];
    $dod = $row['dod'];

    $still_alive = "Still Alive";

    if ($dod === NULL) {
        $dod = $still_alive;
    }
    echo "<h2>$first $last</h2>";

    echo "<table>
        <tr>
            <th>Sex</th>
            <th>Date of Birth</th>
            <th>Date of Death</th>
        </tr>";

    echo "<tr>
            <td>$sex</td>
            <td>$dob</td> 
            <td>$dod</td>
        </tr>"; 
    echo "</table>";
} else {
    echo "<p>Actor does not exist</p>";
}

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
            <td>$role</td>
            <td>
                <a href=\"/movie.php?id={$row["mid"]}\">
                    {$row['title']}
                </a>
            </td>
        </tr>";
}
echo "</table>";
?>
</body>
</html>