<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
include 'functions.php';

// Connect to MySQL using the below function
$conn = connect_mysql();
session_start();
$query = 'SELECT * FROM users';
$result = mysqli_query($conn, $query);
$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

$msg = '';
$verificationSent = false;
$verificationCode = '';

if (isset($_POST['email'])) {
  // Validation checks... make sure the POST data is not empty
  if (empty($_POST['email'])) {
      $msg = 'Please write your email address';
  } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      $msg = 'Please provide a valid email address!';
  } else {
    try {
      $mail = new PHPMailer(true);
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';  // Replace with your SMTP server host
      $mail->SMTPAuth = true;
      $mail->Username = 'xxx@xx.xx.ac.in';  // Replace with your SMTP username
      $mail->Password = 'xxxxxxxx';  // Replace with your SMTP password
      $mail->SMTPSecure = 'ssl';
      $mail->Port = 465;

      $mail->setFrom('xxx@xx.xx.ac.in');  // Replace with the sender's email address and name
      $mail->addAddress($_POST['email']);  // Replace with the recipient's email address
      //$mail->addAddress('receiver2@example.com', 'Name');  // You can add additional recipients if needed

      $code = rand(1000, 9999);

      $mail->isHTML(true);
      $mail->Subject = 'ACR office verification code';
      $mail->Body = $code;
      //$mail->AltBody = 'Body in plain text for non-HTML mail clients';

      $mail->send();
      $_SESSION['verification_code'] = $code;
      $_SESSION['email'] = $_POST['email'];
      $verificationSent = true;
      $verificationCode = $code;
    } catch (Exception $e) {
      echo '<p style="color:red;">Message could not be sent. Mailer Error: {$mail->ErrorInfo}"</p>';
    }
  }
}

if (isset($_POST['pass'])) {
  if (isset($_SESSION['verification_code']) && $_POST['pass'] == $_SESSION['verification_code']) {
    $email = $_SESSION['email'];
    foreach ($users as $user) {
      if ($email == $user['email']) {
        $password = $user['pass'];
      }
    }
    echo "<script>
            alert('Your password is: $password');
            window.location.href = 'index.php';
          </script>";
    exit;
  } else {
    echo '<p style="color: red;">Invalid verification code.</p>';
  }
}
?>

<!doctype html>
<html lang="en">
  <head>
  <link rel = "icon" href = "https://upload.wikimedia.org/wikipedia/en/thumb/6/69/IIT_Madras_Logo.svg/1200px-IIT_Madras_Logo.svg.png" type = "image/x-icon">

  <body style="background-color:black;">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Verification</title>
    <link rel = "icon" href = "https://upload.wikimedia.org/wikipedia/en/thumb/6/69/IIT_Madras_Logo.svg/1200px-IIT_Madras_Logo.svg.png" type = "image/x-icon">
  </head>
  <body>

  <!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-black">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Ticket System</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="sign_up.php">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php">Log in</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Email form -->
<center>
<div class="container mt-5">
  <?php if (!$verificationSent) { ?>
    <form action="" method="post">
      <div class="mb-3">
        <label for="email" class="form-label" style="color:white">Enter your email address here</label>
        <input type="email" name="email" class="form-control" placeholder="pratyush@example.com" id="email" aria-describedby="emailHelp" required>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  <?php } else { ?>
    <p style="color:white">A verification code has been sent to your email address.</p>
    <p style="color:white">Please check your email and enter the verification code below:</p>
    <form action="" method="post">
      <div class="mb-3">
        <label for="pass" style="color:white">Verification Code</label>
        <input type="password" name="pass" placeholder="Enter your OTP here..." id="pass" required>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  <?php } ?>
</div>
  </center>

<center><img src="https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcSdxRHia5iJRO23n3Vo4kR7ghVAVQCyXvX56nwpA3keU-o0f4p3"></center>

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXa
