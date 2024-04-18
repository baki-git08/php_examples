<?php
    //connect to database
    $connect = mysqli_connect('localhost', 'Baki', 'bucks1234', 'bucks_pizzaria');

    //check if connection is okay
    if(!$connect){
        echo 'connection is bad: ' . mysqli_connect_error();
    }

?>