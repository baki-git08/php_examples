<?php 

    include('config/db_connect.php');

    // 1) construct query, 2) make query, 3) fetch results 
    
    //write query for all pizzas
    $sql = 'SELECT title, ingredients, id FROM bucks_pizzaria ORDER BY created_at';

    //make query & get result
    $result = mysqli_query($connect, $sql);

    //fetch resulting rows as an array - here we are putting ALL the results inside an array
    $pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    //free results from memory
    mysqli_free_result($result);

    //close connect to database
    mysqli_close($connect);

    //list ingredients into a LIST using explode() function - gives as an array
    explode(',', $pizzas[0]['ingredients']);

?>  

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php'); ?>

<div class="container display_page">
<h4 class="bg-white">Pizzas!</h4>
    <div class="row">

        <?php foreach($pizzas as $pizza) : ?>

            <div class="col" >
                <div class="cards card">
                    <div class="card_content">
                        <h6 class="text-uppercase"> <?php echo htmlspecialchars($pizza['title']); ?> </h6>
                        <ul> <?php foreach(explode(',', $pizza['ingredients']) as $ing) : ?></ul>
                            <li class="text-capitalize list"> <?php echo htmlspecialchars($ing); ?> </li>
                        <?php endforeach ?>
                    </div>
                </div>
<!-- we want to dedicate each pizza its own details pages-->
            <div class="card-action card"> <a class="text-decoration-none" style="background-color:#cbb09c; color: white" href="details.php?id=<?php echo $pizza['id'] ?>"> More info</a></div>
    </div>

        <?php endforeach; ?> 

        <?php // little example on how to use " : " and "endif"  "endforeach" syntax ?>
        <?php if(count($pizzas) >= 3) : ?>
            <p class="text-primary bg-white">There are 2 more or more pizzas</p>
        <?php else: ?>
        <p class="text-primary bg-white ">There are less than 3 pizza options</p>
        <?php endif; ?>
        <?php ?>
        


    </div>
</div>

<?php include('templates/footer.php'); ?>
    
    

</html>