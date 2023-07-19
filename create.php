<?php
include 'functions.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

// Establish connections
$conn = connect_mysql();
session_start();

$query = 'SELECT * FROM users';
$result = mysqli_query($conn, $query);
$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Output message variable
$msg = '';
$fileName = null; // Initialize the $fileName variable

// Check if POST data exists (the user submitted the form)
if (isset($_POST['title'], $_POST['name'], $_POST['msg'])) {
    // Validation checks... make sure the POST data is not empty
    if (empty($_POST['title']) || empty($_POST['msg'])) {
        $msg = 'Please complete the form!';
    } else {
        // Check if a file was uploaded
        // if (!empty($_FILES['file']['name'])) {
        //     // Get file details
        //     $fileName = $_FILES['file']['name'];
        //     $fileTmpName = $_FILES['file']['tmp_name'];
        //     $fileSize = $_FILES['file']['size'];
        //     $fileType = $_FILES['file']['type'];

        //     // Read file data
        //     $fileData = file_get_contents($fileTmpName);

        //     // Check file size (limit: 15MB)
        //     if ($fileSize > 15 * 1024 * 1024) {
        //         $msg = 'File size should be less than 15MB!';
        //         // You can also consider redirecting back to the form with an error message.
        //     }
        // }

        // Insert new record into the tickets table
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $uploadOk = 1;
        $FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check file size
        if ($_FILES["file"]["size"] > 15 * 1024 * 1024) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
              echo "The file ". htmlspecialchars( basename( $_FILES["file"]["name"])). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

        $query = 'INSERT INTO tickets (title, name, msg, priority, file_name, assigned_by) VALUES (?, ?, ?,?, ?,?)';
        $stmt = mysqli_prepare($conn, $query) or die(mysqli_error($conn));
        mysqli_stmt_bind_param($stmt, 'sssiss', $_POST['title'], $_POST['name'], $_POST['msg'], $_POST['priority'], $_FILES["file"]["name"], $_SESSION['email']);
        mysqli_stmt_execute($stmt);
        $_SESSION['from'] = $_SESSION['email'];
        $ticketId = mysqli_insert_id($conn);

        foreach ($users as $user) {
            if ($_POST['name'] == $user['name']) {
                $rec = $user['email'];
            }
        }

        // Mail
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';  // Replace with your SMTP server host
            $mail->SMTPAuth = true;
            $mail->Username = 'Xxxx@xxx.xx.ac.in';  // Replace with your SMTP username
            $mail->Password = 'xxxxxxxx';  // Replace with your SMTP password
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('Xxxx@xxx.xx.ac.in');  // Replace with the sender's email address and name
            $mail->addAddress($rec);  // Replace with the recipient's email address
            //$mail->addAddress('receiver2@example.com', 'Name');  // You can add additional recipients if needed

            $mail->isHTML(true);
            $mail->Subject = $_POST['title'];
            $mail->Body = $_POST['msg'];
            //$mail->AltBody = 'Body in plain text for non-HTML mail clients';

            $mail->send();
            echo "Mail has been sent successfully!";
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

        // Redirect to the view ticket page. The user will see their created ticket on this page.
        header('Location: home.php?id=' . $ticketId);
        exit;
    }
}
?>

<?=template_header('Create Ticket')?>

<div class="content create">
    <body style="background-color:#000000; color: #00FFFF;">

    <center>
        <h2 style="color: #00FFFF">Create Ticket</h2>
        <form action="create.php" method="post" enctype="multipart/form-data">
            <label for="title">Title</label>
            <input type="text" name="title" placeholder="Title" id="title" required>

            <label for="name">For</label>
            <input type="text" name="name" placeholder="Name" id="name" required list="nameSuggestions">
            <datalist id="nameSuggestions">
                <?php foreach ($users as $user): ?>
                    <option value="<?= $user['name'] ?>"></option>
                <?php endforeach; ?>
            </datalist>

            <br>
            <label for="msg">Message</label>
            <textarea name="msg" placeholder="Enter your message here..." id="msg" required></textarea>
            
            <label for="priority">you want this task to be finished within</label>
            <input type="int" name="priority" placeholder="type no of hours" id="priority" required>

            <label for="file">Select a file: file size should be less than 15mb</label>
            <input type="file" id="file" name="file">

            <?php if (isset($fileName)): ?>
                <p style="color: white;">Selected File: <?= $fileName ?></p>
            <?php endif; ?>

            <input type="submit" value="Create">

            <div class="btns">
                <a href="home.php" class="btn" style="background-color:#424242;">Back</a>
            </div>
        </form>
    </center>

    <?php if ($msg): ?>
        <p style="color: #00FFFF;"><?= $msg ?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>
