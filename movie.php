<html>
<head>
    <title>Movie</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://unpkg.com/bamboo.css" rel="stylesheet">
</head>
<body>
<?php
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

// REQUIREMENTS
// Show hyperlinks to the actor pages for each actor that was in this movie.
// Show the average score of the movie based on the user feedback.
// Show all user comments.
// Contain an “add Comment” link/button, which links to the movie’s review page described below.

$movie_sql = "SELECT * FROM Movie WHERE id={$_GET["id"]} OR id=706";
$movie_result = $conn->query($movie_sql);

if ($movie_result->num_rows > 0) {
    $row = $movie_result->fetch_assoc();
    echo "<h1>" . $row["title"]. "</h1>";
    echo "<p>" . $row["year"] . ", " . $row["rating"] . ", " . $row["company"] . "</p>";
} else {
  die("Movie does not exist");
}

echo "<h1>Actors Involved</h1>";
$movie_actor_sql = "SELECT aid, role FROM MovieActor WHERE mid={$_GET["id"]}";
$movie_actor_result = $conn->query($movie_actor_sql);
if ($movie_actor_result->num_rows > 0) {
    echo "<table><tr><th>Role</th><th>Name</th></tr>";
    while ($row = $movie_actor_result->fetch_assoc()) {
        $actor = $conn->query("SELECT last, first FROM Actor WHERE id=" . $row["aid"])->fetch_assoc();
        echo "<tr><td>{$row["role"]}</td><td><a href=\"/actor.php?id={$row["aid"]}\">{$actor["first"]} {$actor["last"]}</a></td></tr>";
    }
    echo "</table>";
}

echo "<h1>User Review</h1>";
$user_sql = "SELECT name, time, rating, AVG(rating) OVER() avg_rating, comment FROM Review WHERE mid={$_GET["id"]}";
$user_result = $conn->query($user_sql);

echo "<h2>average score</h2>";
if ($user_result->num_rows > 0) {
    $avg_score = $user_result->fetch_assoc();
    echo "<p>Average Score: {$avg_score["avg_rating"]}";
} else {
    echo "<p>No reviews.</p>";
}

echo "<h2>comments</h2>";
$user_result->data_seek(0);
if ($user_result->num_rows > 0) {
    echo "<table><tr><th>User</th><th>Comment</th></tr>";
    while ($row = $user_result->fetch_assoc()) {
        echo "<tr><td>{$row["name"]}</td><td>{$row["comment"]}</td></tr>";
    }
    echo "</table>";
} else {
    echo "<p>No reviews.</p>";
}
echo "<h2><a href=\"/review.php?id={$_GET["id"]}\">review page</a></h2>";
?>

</body>
</html>