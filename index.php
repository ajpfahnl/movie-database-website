<!doctype html>
<html>
<head>
    <a href="/">Home</a>
    <title>Home</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://unpkg.com/bamboo.css" rel="stylesheet">
</head>

<body>
<h1>Movie Website Database</h1>
<p>This website contains movie information including the actors, and user reviews.</p>
<h2>General Search</h2>
<form action="./search.php" method="get">
    Actor: <input type="text" name="actor"><br>
    Movie: <input type="text" name="movie"><br>
    <br><input type="submit" value="Search">
</form>

<br>

<h2>Search Movie by ID</h2>
<p>If you know the particular movie id, search here:</p>
<form action="./movie.php" method="get">
    <input type="text" name="id"><br>
    <input type="submit" value="Search">
</form>

<br>

<h2>Search Actor by ID</h2>
<p>If you know the particular actor id, search here:</p>
<form action="./actor.php" method="get">
    <input type="text" name="id"><br>
    <input type="submit" value="Search">
</form>

<br>

<h2>Search Review by ID</h2>
<p>If you know the particular review id, search here:</p>
<form action="./review.php" method="get">
    <input type="text" name="id"><br>
    <input type="submit" value="Search">
</form>
</body>
</html>
