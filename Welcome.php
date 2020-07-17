 <!doctype html>
<html>
<head>
	<title>Welcome</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="home.css">
	<link rel="stylesheet" type="text/css" href="question.css">

	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Dancing+Script" />

	
</head>

<body>

	<div class="home">

		<div class="head">
			The Great Quiz
		</div>

		<div class="lo">
			<a href="login.php"><span style="width:2rem;"><input type="button" value="Logout" class="redbtn"></span></a>
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


				$username= $_POST['username'];
				$password= $_POST['password'];



				$sqluser="SELECT name,qnId FROM user WHERE username='$username' AND password='$password'";
				$checkuser=mysqli_query($sqlcon, $sqluser);
				$user_row=$checkuser->fetch_assoc();
				$count=mysqli_num_rows($checkuser);

				if(isset($_POST['option'])){

					$prevqn="SELECT corropt,level FROM question WHERE qnId=";
					$prevqn.=$user_row['qnId'];
					$getans=mysqli_query($sqlcon,$prevqn);
					$prevans=$getans->fetch_assoc();

					if($_POST['option']==$prevans['corropt']){
						$updscore="UPDATE user SET score=score +'".$prevans['level']."' WHERE username='$username' AND password='$password'";
					}else{
						$updscore="UPDATE user SET score=score-1 WHERE username='$username' AND password='$password'";
					}
					$givescore=mysqli_query($sqlcon,$updscore);
				}

				if(isset($_POST['option']) || $user_row['qnId']==0){
					$upd="UPDATE user SET qnId=qnId+1 WHERE username='$username' AND password='$password'";
					$upd_res=mysqli_query($sqlcon,$upd);
				}

				if($count){
					$sqlqnid="SELECT qnId FROM user WHERE username='$username' AND password='$password'";
					$getqnid=mysqli_query($sqlcon,$sqlqnid);
					$currqnid=$getqnid->fetch_assoc();
				
					$qn="SELECT * FROM question WHERE qnId=";
					$qn.=$currqnid['qnId'];
					$getQn=mysqli_query($sqlcon,$qn);
					$row = $getQn->fetch_assoc();

					$sqlscore="SELECT score FROM user WHERE username='$username' AND password='$password'";
					$getscore=mysqli_query($sqlcon,$sqlscore);
					$score=$getscore->fetch_assoc();
				}
			?>
			<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" >
			<div class="sub-head">
				<?php
					if(!$count){
						print'<span style="color:red;">Invalid Login</span>';
						print"</body>";
						print"</html>";
						exit();
					}else if($user_row['qnId']>=20){
						print'<span style="color:red;">You Have Completed the Quiz!!</span>';
						print"<br />";
						print("Your Final Score: ".$score['score']);
						print "<a href='leaderboard.php'><input type='button' value='Leaderboard' class='button greenbtn'></a>";
						print"</body>";
						print"</html>";
						exit();
					}
					else{
						print "<input type='hidden' name='username' value='".$username."' />";
						print "<input type='hidden' name='password' value='".$password."' />";
					}
				?>
			</div>
			<div class="qn_info">
				<?php
					if($count){
						print("Level: ".$row['level']);
						print "<br />";
						print("Question No: ".$row['qnId']);
						print("<br />");
						print("Marking: +".$row['level'].", -1");
						print("<br />");
						print("Your Current Score: ".$score['score']);

					}
				?>
			</div>
			<div class="text">
				<?php
					if($count){
						print"<br />";
						print($row['qnText']);
						print"<br />";

						for($i='A'; $i<='D';$i++)
						{
							$opt='<br/>';
							$opt.='<input type="radio" name="option" value="';
							$opt.=$row["opt".$i];
							$opt.='">';
							$opt.=$row["opt".$i];
							print($opt);
						}
						
					}
				?>				 
			</div>
			<div class="btnholder">
				<input type="submit" name="start" value="Next" class="button greenbtn">
			</div>

		</form>
		</div>
	</div> 
</body>