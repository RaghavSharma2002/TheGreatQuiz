  <!doctype html>
<html>
<head>
	<title>Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="home.css">
	<link rel="stylesheet" type="text/css" href="leaderboard.css">

	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Dancing+Script" />

	
</head>

<body>
	<div class="home">

		<div class="head">
			The Great Quiz
		</div>

		<div class="pop-up">
			<?php
				$sqlcon=new mysqli('127.0.0.1', 'root', '', 'thegreatquiz');

				if(!$sqlcon)
				{
					print"<h1>Unable to connect to MySQL</h1>";
				}
				if ($sqlcon ->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				}

				$sqlusers="SELECT username,name,score FROM user ORDER BY score DESC";
				$getusers=mysqli_query($sqlcon, $sqlusers);
				$count=mysqli_num_rows($getusers);
			?>

			<table id="users">
				<tr>
					<th>Name</th>
					<th>Username</th>
					<th>Score</th>
				</tr>
				<?php
					for($i=0; $i < $count; $i++)
					{
						$row = $getusers->fetch_assoc();

						print"<tr>";
						print("<td>".$row['name']."</td>");
						print("<td>".$row['username']."</td>");
						print("<td>".$row['score']."</td>");
						print"</tr>";
					}
				?>
			</table>
		</div>
</body>