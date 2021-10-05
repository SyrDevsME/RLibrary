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
	<div class="menu">
			<a href="animation.php?q=new">New Animation</a>
			<a href="animation.php?q=best">Best Animation</a>
			<a href="animation.php?q=popular">Most Popular</a>
	</div>
	<div class="main-container">
	    <form class="search-bar" action="animation.php" method="get">
			<input type="text" name="query" value="" placeholder="Type your search words here...">
		</form>

	    <!-- <form class="filters" action="index.php" method="get">
	    	<select name="year" onchange="this.form.submit()">
	    		<option disabled selected>Year</option>
	    		<?php
	    			// $counter = 1994;
	    			// for ($i = 2021; $i >= 1994; $i--)
	    			// 	echo "<option value='{$i}'>{$i}</option>";
	    		?>
	    	</select>
	    	<select name="country">
	    		<option disabled selected>Country</option>
	    		<option value="English">English</option>
	    		<option value="French">French</option>
	    		<option value="Arab">Arab</option>
	    		<option value="Canada">Canada</option>
	    		<option value="UK">UK</option>
	    		<option value="Brazile">Brazile</option>
	    	</select>
	    	<select name="genre">
	    		<option disabled selected>Genre</option>
	    		<option value="Action">Action</option>
	    		<option value="Fantasy">Fantasy</option>
	    		<option value="Horror">Horror</option>
	    		<option value="History">History</option>
	    		<option value="Thiller">Thiller</option>
	    		<option value="War">War</option>
	    		<option value="Crime">Crime</option>
	    		<option value="Drama">Drama</option>
	    	</select>
	    	<select name="res">
	    		<option disabled selected>Resolution</option>
	    		<option value="1080p">1080p</option>
	    		<option value="720p">720p</option>
	    		<option value="480p">480p</option>
	    	</select>
	    </form> -->

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
			   	

	      		$sql = $database->prepare("SELECT * FROM `animations`");
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

					$sql = $database->prepare("SELECT * FROM `animations` WHERE (`title` LIKE '%".$query."%')");
			   		$sql->execute();

			   		render_entries();
			   	}
			   	else if (isset($_GET['q'])) { // entries sort functionality
			   		if ($_GET['q'] == 'latest') {
			   			$sql = $database->prepare("SELECT * FROM `movies` WHERE year >= 2021");
			   			$sql->execute();
			   		}

			   		if ($_GET['q'] == 'new') {
			   			$sql = $database->prepare("SELECT * FROM `animations` WHERE year >= 2014");
			   			$sql->execute();

			   		}

			   		if ($_GET['q'] == 'best') {
			   			$sql = $database->prepare("SELECT * FROM `animations` WHERE res = 1080");
			   			$sql->execute();

			   		}

			   		if ($_GET['q'] == 'popular') {
			   			$sql = $database->prepare("SELECT * FROM `animations` WHERE views > 100");
			   			$sql->execute();
			   		}

			   		render_entries();
			   	}

			   	else
			   		render_entries();
			?> 
		</div>
	</div>
</body>
</html>