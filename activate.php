<?php

session_start();

include 'dbconnect.php';

if(isset($_GET['token'])){
    $token=$_GET['token'];
    $updatequery="update registration set status='active' where token='$token'";

    $query=mysqli_query($con,$updatequery);

    if($query){
        if(isset($_SESSION['msg'])){
            $_SESSION['msg']="Account updated successfully";
            header("location: login.php");
        }else{
            $_SESSION['msg']="You are loggedout";
            header("location: login.php");
        }
    }else{
        $_SESSION['msg']="Account not updated";
        header("location: signup.php");
    }



}


?>