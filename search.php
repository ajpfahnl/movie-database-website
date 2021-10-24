<html>
<head>
  <a href="/">Home</a>
    <title>Search</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://unpkg.com/bamboo.css" rel="stylesheet">
</head>
<h1>Search</h1>
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
// If no parameter is given in the URL, the page must display one or more
//     search boxes to let the user search for a movie and for an actor. (For
//     an actor/actress, you should examine first/last name, and for a movie,
//     you should examine title.)
// If (a set of) keyword(s) are provided as the actor parameter of the URL, the
//     page must return the list of actors whose first or last name contains
//     the keyword(s). Clicking on each movie must lead to the corresponding
//     actor page.
// If (a set of) keyword(s) are provided as the movie parameter of the URL, the
//     page must return the list of movies whose title contains the keyword(s).
//     Clicking on each actor must lead to the corresponding movie page.
// The search page should support multi-word search, such as “Tom Hanks,” and
//     be case-insensitive. For multi-word search, interpret space as “AND”.
//     That is, return all actors that contain “Tom” AND “Hanks” in their first
//     or last name columns. To support case-insensitive search, you can apply
//     the LOWER() function to both the column (to be searched in) and the
//     string (that you search for).

$actor = $_GET["actor"];
$movie = $_GET["movie"];

// if ((strlen($actor) == 0) && (strlen($movie) == 0)) {
echo "<form action=\"./search.php\" method=\"get\">
    Actor: <input type=\"text\" name=\"actor\"><br>
    Movie: <input type=\"text\" name=\"movie\"><br><br>
    <input type=\"submit\" value=\"Search\">
</form>";
// }
if (strlen($actor) > 0) {
  $actor_arr = explode(" ", $actor);
  $sql = "SELECT * FROM Actor WHERE";
  $first = true;
  foreach ($actor_arr as $a) {
    if (!$first) {
      $sql = $sql . " AND";
    }
    else {
      $first = false;
    }
    $sql = $sql . " (LOWER(first) LIKE '%". $a . "%' OR LOWER(last) LIKE '%" . $a ."%')";
  }
  $sql_result = $conn->query($sql);
  echo "<h2>Actor Results</h2>";
  if ($sql_result->num_rows > 0) {
      echo "<table><tr><th>Actor</tr>";
      while ($row = $sql_result->fetch_assoc()) {
          echo "<tr><td><a href=\"/actor.php?id={$row["id"]}\">{$row["first"]} {$row["last"]}</a></td></tr>";
      }
      echo "</table>";
  }
  else {
    echo "<p>No results</p>";
  }
}
if (strlen($movie) > 0) {
  $movie_arr = explode(" ", $movie);
  $sql = "SELECT * FROM Movie WHERE";
  $first = true;
  foreach ($movie_arr as $m) {
    if (!$first) {
      $sql = $sql . " AND";
    }
    else {
      $first = false;
    }
    $sql = $sql . " (LOWER(title) LIKE '%". $m . "%')";
  }
  $sql_result = $conn->query($sql);
  echo "<h2>Movie Results</h2>";
  if ($sql_result->num_rows > 0) {
      echo "<table><tr><th>Movie</tr>";
      while ($row = $sql_result->fetch_assoc()) {
          echo "<tr><td><a href=\"/movie.php?id={$row["id"]}\">{$row["title"]}</a></td></tr>";
      }
      echo "</table>";
  }
  else {
    echo "<p>No results</p>";
  }
}
?>
</body>
</html>