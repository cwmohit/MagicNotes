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

    <title>Login</title>
</head>

<body>
<?php  include 'nav.php';    ?>
<?php

include 'dbconnect.php';

if(isset($_POST['submit'])){
    $email=$_POST['email'];
    $password=$_POST['password'];

    $emailsearch="select * from registration where email='$email' and status='active'";
    $query=mysqli_query($con,$emailsearch);

   $email_count=mysqli_num_rows($query);

   if($email_count){
       $email_pass=mysqli_fetch_assoc($query);

       $db_pass=$email_pass['password'];
         
       $_SESSION['username']=$email_pass['username'];

       $pass_decode=password_verify($password,$db_pass);

       if($pass_decode){

        if(isset($_POST['rememberme'])){
         setcookie('emailcookie',$email,time()+86400);
         setcookie('passwordcookie',$password,time()+86400);
            header("location:index.php");
        }else{
            header("location:index.php");
        }
                 
       }else{
        ?>
        <script>
        alert("Password Incorrect");
        </script>
        <?php
       }

   }else{
    ?>
    <script>
    alert("Invalid Email");
    </script>
    <?php
   }

}



?>



    <div class="container my-4 ">
        <div class="row">
            <div class="col-md-4 m-auto">

                <h1 class="text-center">Create Account</h1>
                <div>
                 <h5 class="text-center my-4">Get Started</h5>
                   <p>
                   <a href="" class="btn btn-block btn-danger btn-gmail">Login via Gmail</a>
                   <a href="" class="btn btn-block btn-primary btn-gmail">Login via Facebook</a>
                   </p>
                </div>
                <p class="text-center">OR</p><hr class="w-50">
                <div>
                 <p class="bg-success text-white px-2 py-1"> <?php  if(isset($_SESSION['msg']))
                                                             {echo $_SESSION['msg']; }else{ echo "You are Logged out, Please login";} ?></p>
                </div>
                <form class=" p-2" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
                 
                    <div class="form-group">
                        
                        <input type="text"  class="form-control" id="email" aria-describedby="emailHelp"
                            name="email" placeholder="Email Address" value="<?php if(isset($_COOKIE['emailcookie'])){ echo $_COOKIE['emailcookie']; } ?>" Required>

                    </div>
                  
                    <div class="form-group ">
                        
                        <input type="password" maxlength="23" class="form-control" id="Password" name="password" placeholder="Password" value="<?php if(isset($_COOKIE['emailcookie'])){ echo $_COOKIE['passwordcookie']; } ?>" Required>

                    </div>
                    <div class="form-group ">
                        
                       <input type="checkbox" name="rememberme"> Remember me

                    </div>
               

                    <button type="submit" name="submit" class="btn btn-primary btn-block">Login Now</button>
                    <p class="text-center my-2">Forgot Your Password don't worry? <a href="recover_email.php">Click Here</a></p>
                    <p class="text-center my-2">Not Have an Account <a href="signup.php">Sign Up Here</a></p>
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