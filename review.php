<html>
<head>
  <a href="/">Home</a>
    <title>Review</title>
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
// When the request URL contains only an id parameter like 
//     http://localhost:8888/review.php?id=705, the page must include input
//     boxes to let the user to input their name, the rating of the movie and
//     their comment on the movie.
// When the request contains mid, name, rating and comment parameters, you must
//     insert a row to the Review table with the provided values. The value for
//     the time column should be the time when the review is submitted. The
//     returned page from this URL must display “confirmation text” saying that
//     the review has been successfully added.

echo "<h1>Add New Review Here:</h1>";

// $movie_id = $_GET["id"];
// $movie_title = $_GET["title"];

echo "<h2>Movie Title: </h2>";

// search movie title here

$movie = "SELECT DISTINCT * FROM Movie WHERE title<>'NULL' AND id={$_GET["movie"]}";
//echo "test query<br>";
$rs = $db->query($movie);
//echo "after query<br>";

while ($row = $rs->fetch_assoc()) {
  //echo "after fetch<br>";
  $mid = $row['id'];
  $title = $row['title'];

  // echo "$title";
  echo "<tr>
          <td><b>$title</b></td><br><br>
        </tr>";
}

/*
// echo "<form>
echo "<form action=\"./review.php\" method=\"get\">
    Your Name: <input type=\"text\" name=\"username\"><br>
    Rating (From 1 to 10): <input type=\"text\" name=\"rating\"><br>
    Comment: <textarea></textarea><br><br>
    <input type=\"submit\" value=\"Rating It!\">
</form>";
*/

function SaveToMyOwnDatabase() {
  $db = new mysqli('localhost', 'cs143', '', 'class_db');
  if ($db->connect_errno > 0) { 
      die('Unable to connect to database [' . $db->connect_error . ']'); 
  }
  // $add_review =  "INSERT INTO Review VALUES ({$_GET["name"]}, now(), {$_GET["movie"]}, {$_GET["rating"]}, {$_GET["comment"]})";
  $add_review =  "INSERT INTO Review VALUES (\"Van\", now(), {$_GET["movie"]}, {$_GET["rating"]}, {$_GET["comment"]})";
  // $add_review =  "INSERT INTO Review VALUES (\"Van\", now(), 705, 10, \"good\")";
  // $add_review =  "INSERT INTO Review VALUES (\"Van\", now(), 705, 10, \"good\")";
  $rs2 = $db->query($add_review);
  
  /*
  echo "name: {$_GET["name"]}";
  echo "movie: {$_GET["movie"]}";
  echo "rating: {$_GET["rating"]}";
  echo "comment: {$_GET["comment"]}";
  */

  // echo "console.log(\"name: {$_GET["name"]}\");"

  /*
  console.log("name: {$_GET["name"]}");
  console.log("movie: {$_GET["movie"]}");
  console.log("rating: {$_GET["rating"]}");
  console.log("comment: {$_GET["comment"]}");
  */
}

// action=\"./review.php\" method=\"get\" <form id=\"myForm\" onSubmit=\"SaveToMyOwnDatabase()\">

// echo "<form action=\"./review.php\" method=\"get\" <form id=\"myForm\" onSubmit=\"SaveToMyOwnDatabase()\">
//     <input type=\"hidden\" id=\"movie\" name=\"movie\" value={$_GET["movie"]}>
//     <label for=\"name\">Your name:</label>
//     <input type=\"text\" id=\"name\" name=\"name\"><br>
    
//     <label for=\"rating\">Rating (Out of 10):</label>
//     <input type=\"text\" id=\"rating\" name=\"rating\"><br>
    
//     <label for=\"comment\">Comment:</label>
//     <textarea id=\"comment\" name=\"comment\" rows=\"4\" cols=\"50\"></textarea><br><br>
    
//     <input type=\"submit\" onSubmit=\"SaveToMyOwnDatabase()\" value=\"Rating It!\">

//     </form>";

// Adding review to the Review Table
// $add_review =  "INSERT INTO Review (name, now(), mid, rating, comment)";
// $rs2 = $db->query($add_review);

// After submission, print out confirmation text
// echo "Thanks for your comment! Your review has been successfully added. ";
// echo "DONE1<br>";
// $add_review =  "INSERT INTO Review VALUES (\"Van\", now(), 705, 10, \"good\")";
// echo "DONE2<br>";
// $rs2 = $db->query($add_review);
// echo "DONE3<br>";
//SaveToMyOwnDatabase();
// echo "DONE4<br>";
// redirect review page to movie page

// if(array_key_exists('submitbutton', $_GET)){
//   SaveToMyOwnDatabase();
// }

print '<form id="myForm" onSubmit=<?php SaveToMyOwnDatabase() ?>>
    <input type="hidden" id="movie" name="movie" value=<?php echo "{$_GET["movie"]}" ?>>
    
    <label for="name">Your name:</label>
    <input type="text" id="name" name="name" value=<?php echo "{$_GET["name"]}" ?>><br>
    
    <label for="rating">Rating (Out of 10):</label>
    <input type="text" id="rating" name="rating" value=<?php echo "{$_GET["rating"]}" ?>><br>
    
    <label for="comment">Comment:</label>
    <textarea id="comment" name="comment" value=<?php echo "{$_GET["comment"]}" ?> rows="4" cols="50"></textarea><br><br>
    
    <input type="submit" value="Rating It!">

</form>';

?>

</body>
</html>