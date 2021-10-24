<html>
<head>
    <a href="/">Home</a>
    <title>Movie</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://unpkg.com/bamboo.css" rel="stylesheet">
</head>
<body>
<h1>Movie Information</h1>
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

$movie_sql = "SELECT * FROM Movie WHERE id={$_GET["id"]}";
$movie_result = $conn->query($movie_sql);

if ($movie_result->num_rows > 0) {
    $row = $movie_result->fetch_assoc();
    echo "<h2>" . $row["title"]. "</h2>";
    echo "<p>" . $row["year"] . ", " . $row["rating"] . ", " . $row["company"] . "</p>";
} else {
  die("<p>Movie does not exist</p>");
}

echo "<h2>Actors Involved</h1>";
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

echo "<h2>User Review</h1>";
echo "<form style=\"text-align:center\" action=\"/review.php?id={$_GET["id"]}\">
    <input type=\"submit\" value=\"Add comment\" />
</form>";
$user_sql = "SELECT name, time, rating, AVG(rating) OVER() avg_rating, comment FROM Review WHERE mid={$_GET["id"]}";
$user_result = $conn->query($user_sql);

if ($user_result->num_rows > 0) {
    $avg_score = $user_result->fetch_assoc();
    echo "<p><b>Average Rating</b>: {$avg_score["avg_rating"]}</p>";
} else {
    echo "<p>Average Rating: Not available</p>";
}

$user_result->data_seek(0);
if ($user_result->num_rows > 0) {
    echo "<table><tr><th>User</th><th>Comment</th><th>Rating</th><th>Time</th></tr>";
    while ($row = $user_result->fetch_assoc()) {
        echo "<tr><td>{$row["name"]}</td><td>{$row["comment"]}</td><td>{$row["rating"]}</td><td>{$row["time"]}</td></tr>";
    }
    echo "</table>";
} else {
    echo "<p>No reviews.</p>";
}
?>

</body>
</html>