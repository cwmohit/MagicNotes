<?php
//connecting to the database
$servername="localhost";
$username="root";
$password="";
$database="signup";

//create a connection
$con=mysqli_connect($servername,$username,$password,$database);

//Die if connection was not successful
if(!$con){
    die("Sorry we failed to connect: ". mysqli_connect_error());
}




?>