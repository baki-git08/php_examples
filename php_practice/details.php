<?php 

include('config/db_connect.php');

if(isset($_POST['delete'])){

    $id_to_delete = mysqli_real_escape_string($connect, $_POST['id_to_delete']); 
    
    $sql = "DELETE FROM bucks_pizzaria WHERE id = $id_to_delete";

    if(mysqli_query($connect, $sql)){
        header('Location: index.php');
    } else {
        echo "error";
    }
}

// check GET request id parameter
if(isset($_GET['id'])){

    $id = mysqli_real_escape_string($connect, $_GET['id']);

    $sql = "SELECT * FROM bucks_pizzaria WHERE id = $id";

    //get query results
    $result = mysqli_query($connect, $sql);

    // fetch results in array - we are only fetching the ID
    // we use "mysqli_fetch_assoc($)" to fetch one set of results and not everything
    $pizza = mysqli_fetch_assoc($result);

    // free up memory 
    mysqli_free_result($result);

    // close database
    mysqli_close($connect);

  //  print_r($pizza);


}

?>

<!DOCTYPE html>
<html lang="en">

    <?php include('templates/header.php'); ?>  
    
    <div class="container detail">
        <?php if(isset($pizza)) :  ?>

            <div class="card_content">
                <!-- output title -->
                <h3 class="text-uppercase"> <?php echo htmlspecialchars($pizza['title']); ?> </h3> 
                <!-- output email -->
                <p><?php echo 'Created by: ' . htmlspecialchars($pizza['email']); ?></p>
                <!-- created at (time-stamp) -->
                <p> <?php echo 'Created at: ' . htmlspecialchars($pizza['created_at']); ?> </p>
                <h5>Ingredients: </h5>
                 <p class="text-lowercase"> <?php echo htmlspecialchars($pizza['ingredients']); ?>  </p>  

                <!-- DELETE FORM -->
                <!-- action 'page you are in??' -->
                <form action="details.php" method="POST" style="background-color: transparent">
                    <input type="hidden" name="id_to_delete" class="brand-text" value= "<?php echo $pizza['id'] ?>" >
                    <input type="submit" name="delete" value="Delete" class="btn button">
                </form>
            </div>

         <?php else:  ?>
            <h1> <?php echo 'this pizza does not exist';  ?>  </h1>
        <?php endif ?>
    </div>
 
    <?php include('templates/footer.php'); ?>

</html>