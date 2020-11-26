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


$email=mysqli_real_escape_string($con,$_POST['email']);

$emailquery="select * from `registration` where `email`='$email'";
$query=mysqli_query($con,$emailquery);

$emailcount=mysqli_num_rows($query);

if($emailcount){
    $userdata=mysqli_fetch_array($query);
    $username=$userdata['username'];
    $token=$userdata['token'];
        $subject="Password Reset";
        $body="Hi, $username. Click here to reset your password http://localhost/signupsystem/reset_password.php?token=$token";
        $header="From: cwmohit@gmail.com";

        if(mail($email,$subject,$body,$header)){
           $_SESSION['msg']="Cheak your mail to reset your password $email";
           header("location: login.php");
        }else{
            echo "Email sending failed....";
        }
    }else{
        echo "No email found";
    }
}


?>
    <?php  include 'nav.php';    ?>


    <div class="container my-3 p-0">
        <div class="row">
            <div class="col-md-4 m-auto">

                <h1 class="text-center">MagicNotes</h1>
                <div>
                    <h5 class="text-center ">Recover Your Account</h5>
                </div>
                <form class=" p-2" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">

                    <div class="form-group">

                        <input type="text" class="form-control" id="email" aria-describedby="emailHelp" name="email"
                            placeholder="Email Address" Required>

                    </div>
                    <button type="submit" name="submit" class="btn btn-primary btn-block">Send Mail</button>
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