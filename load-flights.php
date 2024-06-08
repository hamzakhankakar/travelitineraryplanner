<?php

include 'database.php';

$search_term = $_POST['flights'];

$sql = "SELECT title FROM flights WHERE title LIKE '%{$search_term}%' LIMIT 4";
$result = mysqli_query($conn, $sql) or die("SQL Query Failed.");

if(mysqli_num_rows($result) > 0){
	while ($row = mysqli_fetch_assoc($result)) {
		echo "<div><a class='items-link' href='single-movie.php?name={$row['title']}' target='_blank'>{$row['title']}</a></div>";
	}
} else {
	echo "<div>Flights not found.</div>";
}

?>