<?php

session_start();

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Signup</title>

</head>

<body>
    <?php
include 'dbconnect.php';
if(isset($_POST['submit'])){

 if(isset($_GET['token'])){
        $token=$_GET['token'];

        $newpassword=mysqli_real_escape_string($con,$_POST['password']);
        $cpassword=mysqli_real_escape_string($con,$_POST['cpassword']);

        $pass=password_hash($newpassword,PASSWORD_BCRYPT);
        $cpass=password_hash($cpassword,PASSWORD_BCRYPT);

        
        if($newpassword===$cpassword){
            $updatequery="update registration set password='$pass' where token='$token'";
            $iquery=mysqli_query($con,$updatequery);
            if($iquery){
             $_SESSION['msg']="Your password has been updated";
             header("location: login.php");
            }else{
                $_SESSION['passmsg']="Your password has not updated";
                header("location: reset_password.php");
            }
        
            }else{
                $_SESSION['passmsg']="Password is not matching";
                header("location: reset_password.php");
            }
     }else{
         echo "No token found";
     }
}



?>
    <?php  include 'nav.php';    ?>


    <div class="container my-3 p-0">
        <div class="row">
            <div class="col-md-4 m-auto">

                <h1 class="text-center">Create Account</h1>
                <div>
                    <h5 class="text-center ">Reset Your Password</h5>
                    <p class="bg-info text-white text-center px-5"><?php if(isset($_SESSION['passmsg'])){ echo $_SESSION['passmsg']; } ?></p>
                </div>
                <form class=" p-2"  method="POST">


                    <div class="form-group ">

                        <input type="password" maxlength="23" class="form-control" id="Password" name="password"
                            placeholder="New Password" Required>

                    </div>
                    <div class="form-group">

                        <input type="password" class="form-control" id="cPassword" name="cpassword"
                            placeholder="Confirm Password" Required>
                        <small id="emailHelp" class="form-text text-muted">Make sure to type the same password</small>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary btn-block">Update Password</button>
                    <p class="text-center my-2">Have an Account <a href="login.php">Login Here</a></p>
                </form>

            </div>

        </div>

    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
</body>

</html>