<?php
	session_start();
	error_reporting(0);

	$mysqli = new mysqli("localhost", "root", "root", "XSS");

	$connection = mysql_connect("localhost", "root", "root");
	mysql_select_db("XSS");

	if(isset($_POST['newpost'])) {
		$title = $_POST['title'];
		$content = $_POST['content'];
		// if(!$insert_stmnt = $mysqli->prepare("INSERT INTO Post (id_user, title, content) VALUES (?, ?, ?)")) {
		// 	die('Error : ('. $mysqli->errno .') '. $mysqli->error);
		// }
		// $insert_stmnt->bind_param('iss', $_SESSION['id'], $title, $content);
		// if($insert_stmnt->execute()){
		//     print 'Success! ID of last inserted record is : ' .$insert_stmnt->insert_id .'<br />'; 
		// }else{
		//     die('Error : ('. $mysqli->errno .') '. $mysqli->error);
		// }
		$id = $_SESSION['id'];

		$return = mysql_query("INSERT INTO Post (id_user, title, content) VALUES ($id, '$title', '$content')");
		echo "INSERT INTO Post (id_user, title, content) VALUES ($id, '$title', '$content')";
		if(! $return )
		{
		  die('Could not enter data: ' . mysql_error());
		}
	}

	$select_stmnt = $mysqli->prepare("SELECT title, content, creation FROM Post ORDER BY id DESC");
	$select_stmnt->execute();
	$select_stmnt->bind_result($t, $c, $d);
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
	        <form action="" method="POST">
	        	<div class="newpost">
	        		<div>
		        		<input type="text" id="title" name="title" placeholder="Title..."></input>
		        	</div>
	        		<div>
		        		<input type="text" id="content" name="content" placeholder="Post content..."></input>
		        	</div>
		        	<div>
		        		<input type="submit" id="newpost" name="newpost" value="Post" />
		        	</div>	
		        </div>
	        </form>
	        <div>
	        	<?php
	        		while($select_stmnt->fetch()) {
	        			print '<div class="post">';
	        			print '<h3>'.$t.' - '.$d.'</h3>';
	        			print '<p>'.$c.'</p></div>';
	        		}
	        	?>
	        </div>
        </div>
    </body>
</html>