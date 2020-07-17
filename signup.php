  <!doctype html>
<html>
<head>
	<title>Sign Up</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="home.css">

	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Dancing+Script" />

	
</head>

<body>
	<div class="home">

		<div class="head">
			The Great Quiz
		</div>

		<div class="pop-up">
			<div class="pop-up-head">
				Register Yourself NOW!!!
			</div>
			<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" >
				<p>Your Name</p>
				<input type="text" name="name">
				<p>Username</p>
				<input type="text" name="username">
				<p>Password</p>
				<input type="password" name="password">

				<p></p>
				<input type="submit" name="signup" value="Sign Up" class="button greenbtn">

				<p class="smltxt">Already registered?</p>
				<a href="login.php"><input type="button" name="login" value="Log In" class="button redbtn"></a>

				<?php

					$sqlcon=new mysqli('127.0.0.1', 'root', '', 'thegreatquiz');

					if(!$sqlcon)
					{
						print"<h1>Unable to connect to MySQL</h1>";
					}

					if ($sqlcon ->connect_error) {
  						die("Connection failed: " . $conn->connect_error);
					} 


					if(isset($_POST['name']))
					{
						$name=trim($_POST['name']);
					}
					else
					{
						$name='';
					}

					if(isset($_POST['username']))
					{
						$username=trim($_POST['username']);
						$sqluser="SELECT username FROM user WHERE username='$username' ";
						$checkuser=mysqli_query($sqlcon, $sqluser);
						$count=mysqli_num_rows($checkuser);
     					if($count)
      					{
           					echo '<p style="color:red;font-size: 1.2rem;font-weight:bold;">Username is already taken</p>';
      					}
					}
					else
					{
						$username='';
					}

					if(isset($_POST['password']))
					{
						$password=trim($_POST['password']);
					}
					else
					{
						$password='';
					}


					if(empty($name) || empty($username) || empty($password))
					{
						echo '<p style="color:red;font-size: 1.2rem;font-weight:bold;">
							Please fill all the fields given in the form
						</p>';
					}
					else
					{
						$rtncode= insertAuthor($sqlcon, $name, $username, $password);
					}
				?>
			</form>
		</div>
	</div>

	

</body>

</html>

<?php
	

	function insertAuthor($sqlcon, $name, $username, $password)
	{
		$statement = "insert into user (username,password,name,qnId)" ;
		$statement .="values(" ;
		$statement .="'".$username."', '".$password."', '".$name."', 0";
		$statement .=")";

		$result= $sqlcon->query($statement);
	}
?>