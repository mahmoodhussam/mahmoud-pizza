<?php 
	include('config/db_config.php');
	// write query 
	$sql = 'SELECT * FROM pizzas';
	$result = mysqli_query($conn, $sql);
	$pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);
	mysqli_free_result($result);
	mysqli_close($conn);
	// print_r($pizzas);
?>
<!DOCTYPE html>	
<html>
<?php include("templates/header.php") ?>
	<div class="row justify-content-center m-0 p-0 mb-5">
		<?php foreach($pizzas as $pizza):  ?>
			<div class="col-4 text-center my-5">
				<img src="images/pizza.png" alt="pizza" width="50%" />
				<h5><?php echo htmlspecialchars($pizza["title"]) . "<br />"; ?></h5>
				<span><?php echo htmlspecialchars($pizza["phone"]) . "<br />"; ?></span>
				<span><?php echo htmlspecialchars($pizza["email"]) . "<br />"; ?></span>
				<a class="btn btn-warning text-white my-3" href="display_info.php?id=<?php echo $pizza["id"]; ?>">Read more</a>
			</div>
		<?php endforeach; ?>	
	</div>
<?php include("templates/footer.php") ?>
</html>