<?php 

include('config/db_connect.php');

// errors variable, is initialised as an array.
// emails, title, ingredients are assigned empty pockets so when the is an error the pockets are filled

// THIS WILL ENABLE US TO OUT TO FORM

$errors =array('email' =>'', 'NameOfPizza'=> '' , 'ingredients' => '');


if(isset($_POST['submit'])){
    //special htmlspecialchars, converts input to html entited
    // prevents attacks 
    if(empty($_POST['email'])){
        $errors['email'] = 'An email is required <br />';}
    //else{echo htmlspecialchars($_POST['email']);}

    // using built-in php function to validate email
    else{
        $email = $_POST['email'];
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
           $errors['email'] = 'Email is not a valid email address';
        }
    }

    if(empty($_POST['NameOfPizza'])){
        $errors['NameOfPizza'] = 'Name Of Pizza is required <br />';}
    else{
        $nameOfPizza = $_POST['NameOfPizza'];
        if(!preg_match('/^[a-zA-Z\s]+$/', $nameOfPizza)){
            $errors['title'] = 'Title must be only letters and spaces only';
        }
    }

    if(empty($_POST['ingredients']))
    {$errors['ingredients'] = 'Ingredients are required <br />';}
    else{
        $ingredients = $_POST['ingredients'];
        if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){
            $errors['ingredients'] = 'Ingredients must be only letters, commas and spaces only';
        }   
    }

    // form submits with no errors, therefore it will add redirect to index page
    // we do this to display the new data added
    if(!array_filter($errors)){
        // protetion from harmful code from being injected in database
        // override variables
        $email = mysqli_real_escape_string($connect,  $_POST['email']);
        $nameOfPizza = mysqli_real_escape_string($connect,  $_POST['NameOfPizza']);
        $ingredients = mysqli_real_escape_string($connect,  $_POST['ingredients']);
        
        //add data to database
        $sql = "INSERT INTO bucks_pizzaria(title, ingredients , email) VALUES ('$nameOfPizza', '$ingredients', ' $email') ";

        if(!mysqli_query($connect, $sql)){
           echo 'query error: '; 
        } else {
            // redirect
            header('Location: index.php');}
        
    }

    
}

?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php'); ?>
<div class="display_page">
    <div class="container">

    <form class="front_page_form" action="homepage.php" method="POST">
        <div class="form-group">
            <label for="email">Email</label>
            <input class="login" type="text" name="email" placeholder="Email"> 
            <u class="text-danger"><?php echo $errors['email']; ?></u>

        </div>
        <div class="form-group">
            <label for="NameOfPizza">Name of your pizza</label>
            <input class="login" type="text" name="NameOfPizza" placeholder="Name of pizza">
            <u class="text-danger"><?php echo $errors['NameOfPizza']; ?></u>
        </div> 
        <div class="form-group">    
            <label for="ingredients">Ingredients</label>
            <input class="login" type="text" name="ingredients" placeholder="List with comma">
            <u class="text-danger"><?php echo $errors['ingredients']; ?></u>
        </div>
            <input type="submit" name="submit" value="SUBMIT" class="btn button">
    </form>
    </div>
</div>

<?php include('templates/footer.php'); ?>
    
    

</html>