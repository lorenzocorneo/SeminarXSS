<?php
	session_start();

	if(isset($_POST['submit'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		$mysqli = new mysqli("localhost", "root", "root", "XSS");
		$statement = $mysqli->prepare("SELECT id, username FROM User WHERE username=? AND password=?");
		$statement->bind_param("ss", $username, $password);
		$statement->execute();
		$statement->bind_result($id, $uname);
		$statement->store_result();
		//echo $statement->num_rows;

		if($statement->num_rows == 1) {
			$statement->fetch();
			$_SESSION['id'] = $id;
			$_SESSION['username'] = $uname;
			header("Location: http://localhost:8888/xss/post_xss.php");
		} else {
			echo "NOT GOOD!";
		}

		// $connection = mysql_connect("localhost", "root", "root");
		// $database = mysql_select_db("XSS", $connection);
		// $loginquery = "SELECT username from User WHERE username='$username' AND password='$password'";
		// // echo $loginquery;
		// $query = mysql_query("SELECT username from User WHERE username='$username' AND password='$password'", $connection);
		// $result = mysql_num_rows($query);
		// //echo "Result = " . $result;
		// if($result == 1) {
		// 	$_SESSION['username'] = $username;
		// 	header("Location: http://localhost:8888/xss/post_xss.php");
		// } else {
		// 	echo "Login NOT GOOD!";
		// }
	}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>PHP Test</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
    	<div id="wrapper">
    		<div id="header">
	        	<h1>XSS Seminar - Group 13</h1>
	        </div>
	        <?php include('user_status.php'); ?>
	        <div class="newpost">
		        <form action="" method="POST">
			        <div>
			        	Username: <input type="text" id="username" name="username" placeholder="username" />
			        </div>
			        <div>
			        	Password: <input type="password" id="password" name="password" placeholder="password" />
			        </div>
			        <div>
			        	<input type="submit" id="submit" name="submit" value="Login" />
			        </div>
		        </form>
	        </div>
        </div>
    </body>
</html>