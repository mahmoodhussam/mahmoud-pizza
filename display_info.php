<?php 
    include('config/db_config.php');    
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM pizzas WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $data = mysqli_fetch_assoc($result);
        }
    }	
    if (isset($_POST['submit'])) {
        echo "test here...";
        $id = $_POST['pizza_id'];
        $sql = "DELETE FROM pizzas WHERE id = $id";
        if (mysqli_query($conn, $sql)) {
            header("location: index.php");
        }
    }
?>
<!DOCTYPE html>	
 <html>
 	<?php include("templates/header.php"); ?>
    <div class="text-center my-4">
    <?php if(isset($data)):  ?>
        <img src="images/pizza.png" alt="pizza" width="20%" />
        <h2 class="mt-5"><?php echo htmlspecialchars($data["title"]); ?></h2>
        <h4>email: <?php echo htmlspecialchars($data["email"]); ?></h4>
        <h6>Phone: <?php echo htmlspecialchars($data["phone"]); ?></h6>
        <h6>Ingredients</h6>
        <?php foreach(explode(',', $data["ingredients"]) as $ing): ?>
            <span class="text-center my-2"><?php echo $ing; ?></span>
        <?php endforeach; ?>
        <form class="my-3" method="post" action="display_info.php">
            <input type="hidden" name="pizza_id" value="<?php echo htmlspecialchars($data["id"]); ?>" />
            <input type="submit" name="submit" value="Delete" class="btn btn-danger" />
        </form>
    <?php else:  ?>
        <h4>Thres no pizza</h4>
    <?php endif; ?>

    </div>

 	<?php include("templates/footer.php"); ?>
 </html>
