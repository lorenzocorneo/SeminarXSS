<?php 
	if(isset($_SESSION['username'])) { ?>
		<div class="newpost">
		<span><?php echo $_SESSION['id'] . " - " . $_SESSION['username'] ?>, <a href="logout.php">logout</a></span>
		</div>
<?php	} else {
	echo '<div class="newpost">no active user</div>';
}
?>