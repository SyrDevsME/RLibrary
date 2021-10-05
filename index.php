<!DOCTYPE html>
<html>
<head>
	<title>My project</title>
	<link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
<body>
	<div class="nav">
		<a class="image" href="./index.php"><img src="./img/logo.jpg"></a>

		<div class="nav-links">
			<a href="./movies.php">Movies</a>
			<a href="./series.php">Series</a>
			<a href="./animation.php">Animation</a>
			<a href="./plays.php">Plays</a>
		</div>

	   	<!-- <div class="registration">
	   		<button class="signin">Sign in</button>
		    <button class="signup">Sign up</button>
		</div> -->
	</div>

	<div class="main-container">
		<form class="search-bar" action="index.php" method="get">
			<input type="text" name="query" value="" placeholder="Type your search words here...">
		</form>

		<div class="entries">
			<?php
				// error_reporting (E_ALL ^ E_NOTICE); // disable error reporting

				$username = "root";
				$password = "";
			    $database = new PDO (
			    	"mysql:host=localhost;dbname=movies_library;charset=utf8;",
			    	$username,
			    	$password
			    );
			   	

	      		$sql = $database->prepare("SELECT * FROM `movies`");
			   	$sql->execute();

			   	function render_entries() {
			   		global $sql;
			   		$counter = 0; // counter for adding "break" divs every 4 entries

			   		if ($sql->rowCount() > 0) {
					   	foreach ($sql as $result) {
					   		echo "<div class='entry'>";
					   		echo "<img src={$result['img_link']} />";
					   		echo "<a href='{$result['download_link']}'>{$result['title']}</a>";
					   		echo "</div>";
					   		$counter++;

					   		if ($counter == 4) {
					   			echo "<div class='break'></div>";
					   			$counter = 0;
					   		}
					   	}
				   	}

				   	else
				   		echo "<span class='not-found-msg'>No entries found.</span>";

			   	}

			   	/* Entries Code Body */

			   	if (isset($_GET['query'])) {
				   	$query = $_GET['query'];

					$sql = $database->prepare("SELECT * FROM `movies` WHERE (`title` LIKE '%".$query."%')");
			   		$sql->execute();

			   		render_entries();
			   	}

			   	else
			   		render_entries();
			?> 
		</div>
	</div>
</body>
</html>