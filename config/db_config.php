<?php 
	$conn = mysqli_connect("localhost", "root", "", "mahmoud-pizza");
	if (!$conn) {
		echo "There is connection error " . mysqli_connect_error();
	}
 ?>