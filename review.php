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

echo "<h2>Movie Title: </h2>";

$movie = "SELECT DISTINCT * FROM Movie WHERE title<>'NULL' AND id={$_GET["id"]}";
$rs = $db->query($movie);

while ($row = $rs->fetch_assoc()) {
  $mid = $row['id'];
  $title = $row['title'];

  echo "<tr>
          <td><b>$title</b></td><br><br>
        </tr>";
}

function SaveToMyOwnDatabase() {
  $db = new mysqli('localhost', 'cs143', '', 'class_db');
  if ($db->connect_errno > 0) { 
      die('Unable to connect to database [' . $db->connect_error . ']'); 
  }
  $add_review =  "INSERT INTO Review VALUES (\"{$_GET["name"]}\", now(), {$_GET["id"]}, {$_GET["rating"]}, \"{$_GET["comment"]}\")";
  $rs2 = $db->query($add_review);
  
}


?>

<form id="myForm" onSubmit=<?php SaveToMyOwnDatabase() ?>>
    <input type="hidden" id="id" name="id" value=<?php echo "{$_GET["id"]}" ?>>
    <input type="hidden" id="submitted" name="submitted" value="TRUE" ?>>

    <label for="name">Your name:</label>
    <input type="text" id="name" name="name" value=<?php echo "{$_GET["name"]}" ?>><br>
    
    <label for="rating">Rating (Out of 10):</label>
    <input type="text" id="rating" name="rating" value=<?php echo "{$_GET["rating"]}" ?>><br>
    
    <label for="comment">Comment:</label>
    <textarea id="comment" name="comment" value=<?php echo "{$_GET["comment"]}" ?> rows="4" cols="50"></textarea><br><br>
    
    <input type="submit" value="Rating It!">

</form>

<?php

  $mid = $_GET["submitted"];
  if( $mid === "TRUE"){
      echo "Thanks for your comment! Your review has been successfully added. ";
      echo "<a href=\"/movie.php?id={$_GET["id"]}\">
             click this to go back to see the movie
            </a>";
  }

?>

</body>
</html>