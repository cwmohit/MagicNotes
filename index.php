<?php

session_start();
$username=$_SESSION['username'];

if(!isset($_SESSION['username'])){
    header('location: login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes App</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
<?php  include 'nav.php';    ?>

    <div class="container my-3">
        <h3>Welcome-<?php echo $username;  ?> to Magic Notes</h3>
        <div class="card">
              
            <div class="card-body">
                <div class="form-group">
                    <h5 class="card-title">Add title</h5>
                    <input type="text" class="form-control" id="addTitle" aria-describedby="Help" placeholder="Enter Title">
                   
                  </div>
                
                <div class="form-group">
                    <h5 class="card-title">Add a Note</h5>
                    <textarea class="form-control" id="addTxt" rows="3" ></textarea>
                </div>
                <button class="btn btn-primary" id="addBtn">Add Note</button>
            </div>
        </div>

        <hr>
        <h1>Your Notes</h1>
        <hr>
        <div id="notes" class="row container-fluid">
           
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <script src="app.js"></script>
</body>

</html>