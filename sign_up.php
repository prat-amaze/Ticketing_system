<?php
include 'functions.php';
$conn = connect_mysql();

$msg= '';

if (isset($_POST['name'], $_POST['email'], $_POST['pass'])) {
  $username = $_POST["name"];
  $useremail = $_POST["email"];

  $existname = "SELECT * FROM `users` WHERE name = '$username'";
  $result = mysqli_query($conn, $existname);
  $numExistname = mysqli_num_rows($result);

  $existemail = "SELECT * FROM `users` WHERE email = '$useremail'";
  $resul = mysqli_query($conn, $existemail);
  $numExistemail = mysqli_num_rows($resul);

    // Validation checks... make sure the POST data is not empty
    if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['pass'])) {
        $msg = 'Please complete the form!';
    } else if($numExistname > 0){
      echo '<p style="color: red;">Username already exists</p>';
    }else if($numExistemail > 0){
      echo '<p style="color: red;">Email already exists</p>';  
    } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $msg = 'Please provide a valid email address!';
    } else {
        // Insert new record into the users table
        $query = 'INSERT INTO users (name, email, pass) VALUES (?, ?, ?)';
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'sss', $_POST['name'], $_POST['email'], $_POST['pass']);
        mysqli_stmt_execute($stmt);

        // Redirect to the Log_in.php page
        header('Location: index.php');
        exit;
    }
}
?>

<?=template_header('Sign Up')?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
  box-sizing: border-box;
}

/* Create two equal columns that floats next to each other */
.column {
  float: left;
  width: 50%;
  padding: 10px;
  height: 300px; /* Should be removed. Only for demonstration */
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}
</style>
</head>
<body style="background-color:black;">
<div class="content create">
    <h2>Sign up</h2>

    <div class="row">

  <div class="column" style="background-color:black;">
    <form action="" method="post">
            <label for="name" style="color:white">Name</label>
            <input type="text" name="name" placeholder="Pratyush" id="name" required><br>

            <label for="email" style="color:white">Email</label>
            <input type="email" name="email" placeholder="pratyush@example.com" id="email" required><br>

            <label for="pass" style="color:white">Password</label>
            <input type="password" name="pass" minlength="8" placeholder="Enter your password here..." id="pass" required>
            <p style="color:white">Password has to be 8 characters long.</p>

            <input type="submit" value="Create">
        </form>
  </div>

  <div class="column">
    <img src="https://pbs.twimg.com/profile_images/1593536628038868992/KRk8xjW3_400x400.jpg">
  </div>
</div>

    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>
