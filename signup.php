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

$username=mysqli_real_escape_string($con,$_POST['name']);
$email=mysqli_real_escape_string($con,$_POST['email']);
$mobile=mysqli_real_escape_string($con,$_POST['mobile']);
$password=mysqli_real_escape_string($con,$_POST['password']);
$cpassword=mysqli_real_escape_string($con,$_POST['cpassword']);

$pass=password_hash($password,PASSWORD_BCRYPT);
$cpass=password_hash($cpassword,PASSWORD_BCRYPT);

$token=bin2hex(random_bytes(15));


$emailquery="select * from `registration` where `email`='$email'";
$query=mysqli_query($con,$emailquery);

$emailcount=mysqli_num_rows($query);

if($emailcount>0){
    ?>
    <script>
    alert("Email already exist");
    </script>
    <?php
}else{
    if($password===$cpassword){
    $insertquery="INSERT INTO `registration` (`username`, `email`, `mobile`, `password`, `cpassword`,`token`,`status`) VALUES ('$username','$email','$mobile','$pass','$cpass','$token','inactive')";
    $iquery=mysqli_query($con,$insertquery);
    if($iquery){
      
        $subject="Email Activation";
        $body="Hi, $username. Click here to activate your account http://localhost/signupsystem/activate.php?token=$token";
        $header="From: cwmohit@gmail.com";

        if(mail($email,$subject,$body,$header)){
           $_SESSION['msg']="Cheak your mail to activate your account $email";
           header("location: login.php");
        }else{
            echo "Email sending failed....";
        }
    }
    }else{
        ?>
    <script>
    alert("Password are not matching");
    </script>
    <?php
    }
}

}



?>
    <?php  include 'nav.php';    ?>


    <div class="container my-3 p-0">
        <div class="row">
            <div class="col-md-4 m-auto">

                <h1 class="text-center">Create Account</h1>
                <div>
                    <h5 class="text-center ">Get Started</h5>
                    <p>
                        <a href="" class="btn btn-block btn-danger btn-gmail">Login via Gmail</a>
                        <a href="" class="btn btn-block btn-primary btn-gmail">Login via Facebook</a>
                    </p>

                    <p class="text-center">OR</p>
                </div>
                <form class=" p-2" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
                    <div class="form-group">

                        <input type="text" class="form-control" id="name" aria-describedby="nameHelp" name="name"
                            placeholder="Full Name" Required>

                    </div>
                    <div class="form-group">

                        <input type="text" class="form-control" id="email" aria-describedby="emailHelp" name="email"
                            placeholder="Email Address" Required>

                    </div>
                    <div class="form-group">

                        <input type="tel" class="form-control" id="mobile" aria-describedby="emailHelp" name="mobile"
                            placeholder="Mobile Number" Required>

                    </div>
                    <div class="form-group ">

                        <input type="password" maxlength="23" class="form-control" id="Password" name="password"
                            placeholder="Password" Required>

                    </div>
                    <div class="form-group">

                        <input type="password" class="form-control" id="cPassword" name="cpassword"
                            placeholder="Confirm Password" Required>
                        <small id="emailHelp" class="form-text text-muted">Make sure to type the same password</small>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary btn-block">Signup</button>
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