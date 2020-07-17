 <!doctype html>
<html>
<head>
	<title>Login</title>
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
				Please Log-In to your account!!
			</div>
			<form method="post" action="Welcome.php">
				<p>Username</p>
				<input type="text" name="username">
				<p>Password</p>
				<input type="password" name="password">

				<p></p>
				<input type="submit" name="login" value="Log In" class="button greenbtn">

				<p class="smltxt">Not yet registered?</p>
				<a href="signup.php"><input type="button" name="signup" value="Sign Up" class="button redbtn"></a>
			</form>

			<div id="errors">

			</div>
		</div>
	</div>
</body>

</html>