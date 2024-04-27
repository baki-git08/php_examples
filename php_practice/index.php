<?php

    $errors = array('email'=> '', 'username' =>'', 'password'=> '');

   if(isset($_GET['submit'])){

    //special htmlspecialchars, converts input to html entited
    // prevents attacks 
    if(empty($_GET['username'])){
        $errors['username'] = 'Username is required <br>';
    } else {
        $username = $_GET['username'];
        if(!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.* )(?=.*[^a-zA-Z0-9]).{8,16}$/m', $username))
        {
            $errors['title'] = 'letters and numbers';
        }
    }

    if(empty($_GET['email'])){
        $errors['email'] = 'An email is required <br />';
    } else {
        $email = $_GET['email'];
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
           $errors['email'] = 'Email is not a valid email address';
        }
    }

    if(empty($_GET['password'])){
        $errors['password'] = 'Password is required <br>';
    } else {
        $password = $_GET['password'];
        if(!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.* )(?=.*[^a-zA-Z0-9]).{8,16}$/m', $password)){
            $errors['password'] = 'Password must be';
        }
    }

    if(!array_filter($errors)){
        header('Location: homepage.php'); 
    }
    //header('Location: homepage.php');   
}
?>


<html lang="en">
    
<?php include('linker/linker.php'); ?>

    <div class="container bg-primary">
        <form class="homepage-form" action="homepage.php" method="GET">
            <label for="username">Username: </label> 
            <input name="username" type="text" placeholder="Enter your name"> 
            <u class="text-danger"><?php echo $errors['username']; ?></u>

            <label for="email">Email: </label>
            <input name="email"type="email" placeholder="Enter.email@gmail.com">
            <u class="text-danger"><?php echo $errors['email']; ?></u>

            <label for="password">Password</label>
            <input name="password" type="password" placeholder="!@#$%^&*(">
            <u class="text-danger"><?php echo $errors['email']; ?></u>

            <input name="submit" type="submit" value="SUBMIT" class="btn btn-danger">
        </form>
    </div>
</html>