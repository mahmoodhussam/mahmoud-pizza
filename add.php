<?php 
	include('config/db_config.php');
	$errors = array("email" => "", "title" => "", "ingredients" => "", "phone" => "");
	$email = $phone = $title = $ingredients = '';
	if(isset($_POST['submit'])) {
		if(empty($_POST['email'])) {
			$errors['email'] =  "Please Enter Email";
		} else {
			$email = $_POST['email'];
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$errors['email'] = "Please Enter Email in correct formate";
			}
		}
		if(empty($_POST['phone'])) {
			$errors['phone'] = "Phone is required";
		} else {
			$phone = $_POST['phone'];
		}
		if(empty($_POST['title'])) {	
			$errors['title'] = "Please Enter Title";
		} else {
			$title = $_POST['title'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $title)) {
				$errors['title'] = 'Title must be letters and spaces only';
			}
		}
		if(empty($_POST['ingredients'])) {
			$errors['ingredients'] = "Please Enter Ingredients";
		} else {
			$ingredients = $_POST['ingredients'];
			if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/',$ingredients)) {
				$errors['ingredients'] = 'Ingredients must be a comma separated list';
			}
		}
		if(!array_filter($errors)) {
			echo "test";
			$email = mysqli_real_escape_string($conn,$email);
			$phone = mysqli_real_escape_string($conn,$phone);
			$title = mysqli_real_escape_string($conn,$title);
			$ingredients = mysqli_real_escape_string($conn,$ingredients); 
			$sql = "INSERT INTO pizzas(email, phone, title, ingredients) VALUES ('$email', '$phone', '$title', '$ingredients')";
			if (mysqli_query($conn, $sql)) {
				header('Location: index.php');
			}
		}
	}
?>

<!DOCTYPE html>
<html>

<?php include("templates/header.php") ?>
	<form class="mt-5 d-flex flex-column align-items-center" action="add.php" method="POST">
		<div class="mb-4 w-50">
			<label class="mb-2">Email</label>
			<input type="text" name="email" class="w-100 px-2" value="<?php echo htmlspecialchars($email); ?>" />
			<span class="text-danger"><?php echo $errors['email']; ?></span>
		</div>
		<div class="mb-4 w-50">
			<label class="mb-2">Phone</label>
			<input type="phone" name="phone" class="w-100 px-2" value="<?php echo htmlspecialchars($phone); ?>" />
			<span class="text-danger"><?php echo $errors['phone']; ?></span>
		</div>
		<div class="mb-4 w-50">
			<label class="mb-2">Title</label>
			<input type="text" name="title" class="w-100 px-2" value="<?php echo htmlspecialchars($title); ?>" />
			<span class="text-danger"><?php echo $errors['title']; ?></span>
		</div>
		<div class="mb-4 w-50">
			<label class="mb-2">Ingredients</label>
			<input type="text" name="ingredients" class="w-100 py-2 px-2" value=
			"<?php echo htmlspecialchars($ingredients); ?>" />
		<span class="text-danger"><?php echo $errors['ingredients']; ?></span>
		</div>
		<input title="Submit" type="submit" name="submit" class="btn btn-warning text-white mt-3 mb-5" />
	</form>

<?php include("templates/footer.php") ?>
</html>