<?php
include 'functions.php';
$conn = connect_mysql();
session_start();
?>
<!doctype html>
<html lang="en">
<script>
function myFunction() {
  var x = document.getElementById("pass");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Log in</title>
    <link rel = "icon" href = "https://upload.wikimedia.org/wikipedia/en/thumb/6/69/IIT_Madras_Logo.svg/1200px-IIT_Madras_Logo.svg.png" type = "image/x-icon">
  
    <style>
        body {
            background-image: url('https://drive.google.com/uc?export=view&id=1IJ-XuaGQZzpfMfAUu8bPCntgFco63GNN');
            background-size: cover;
            background-repeat: no-repeat;
            color: #fff; /* Set text color to white */
        }

        .container {
            background-color: rgba(255, 255, 255, 0.8); /* Add a semi-transparent white background to the container */
            padding: 20px;
            border-radius: 10px;
        }

        h1 {
            color: #333; /* Set heading color to black */
        }
    </style>

  </head>
  
  <body>
    <br>
    <br>
    <br>
    <center><h1>Log in</h1></center>

<?php
$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email'], $_POST['pass'])) {
        $query = 'SELECT * FROM users';
        $result = mysqli_query($conn, $query);
        $creds = mysqli_fetch_all($result, MYSQLI_ASSOC);
        foreach ($creds as $em) {
            if ($_POST['email'] == $em['email']) {
                if ($_POST['pass'] == $em['pass']) {
                    $_SESSION['email']=$_POST['email'];
                    header('Location: home.php');
                    exit;
                } else {
                    echo '<p style="color: red;">Enter a valid password</p>';
                }
            }
        }
        echo '<p style="color: red;">No such user works here</p>';
    } else {
        echo '<p style="color: red;">Please provide an email and password</p>';
    }
}
?>

<div class="container mt-5">
        <form action="" method="post">
            <div class="form-group">
                <label for="email" style="color:black">Email address</label>
                <input type="email" class="form-control" placeholder="pratyush@example.com" id="email" name="email" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="pass" style="color:black">Password</label>
                <input type="password" class="form-control" id="pass" name="pass">
                <input type="checkbox" onclick="myFunction()">Show Password
                <!-- <input typr="checkbox"> -->
            </div>
            <p style="color:black">forgot password? <a class="fcc-btn" href="verification.php">click here</a></p>

  <br>


  <center><button type="submit" class="btn btn-primary">Log in</button></center>
</form>

</div>
 
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->

<br>

<!-- register -->
<style>
  .highlighted-ul {
    display: flex;
    justify-content: center;
    background-color: rgba(128, 128, 128, 0.7);
    padding: 10px;
    width: 25%;
    margin: 0 auto;
  }

  .highlighted-ul .nav-item {
    display: flex;
    justify-content: center;
    align-items: center;
  }
</style>

<div class="highlighted-ul">
  <ul class="nav justify-content-center">
    <li class="nav-item">
      <p style="text-align: center;">Don't have an account? <a class="fcc-btn" href="sign_up.php" style="color:black">Sign up</a></p>
    </li>
  </ul>
</div>

  </body>
</html>