<?php
include 'functions.php';
// Connect to MySQL using the connect_mysql() function
$conn = connect_mysql();
session_start();
// Check if the ID param in the URL exists
if (!isset($_GET['id'])) {
    exit('No ID specified!');
}
// MySQL query that selects the ticket by the ID column, using the ID GET request variable
$stmt = mysqli_prepare($conn, 'SELECT * FROM tickets WHERE id = ?');
mysqli_stmt_bind_param($stmt, 'i', $_GET['id']);
mysqli_stmt_execute($stmt);
$ticket = mysqli_stmt_get_result($stmt)->fetch_assoc();
// Check if ticket exists
if (!$ticket) {
    exit('Invalid ticket ID!');
}

// Update status
if (isset($_GET['status']) && in_array($_GET['status'], array('reopened', 'closed', 'resolved','open'))) {
    $stmt = mysqli_prepare($conn, 'UPDATE tickets SET status = ? WHERE id = ?');
    mysqli_stmt_bind_param($stmt, 'si', $_GET['status'], $_GET['id']);
    mysqli_stmt_execute($stmt);
    header('Location: view.php?id=' . $_GET['id']);
    exit;
}

// Check if the comment form has been submitted
if (isset($_POST['msg']) && !empty($_POST['msg'])) {
    // Insert the new comment into the "tickets_comments" table
    $stmt = mysqli_prepare($conn, 'INSERT INTO tickets_comments (ticket_id, msg, by_) VALUES (?, ?,?)');
    //getting name for comments
    $quer = 'SELECT * FROM users';
    $resul = mysqli_query($conn, $quer);
    $users = mysqli_fetch_all($resul, MYSQLI_ASSOC);
    foreach ($users as $user) {
        if ($_SESSION['email'] == $user['email']) {
            $by_ = $user['name'];
        }
    }

    mysqli_stmt_bind_param($stmt, 'iss', $_GET['id'], $_POST['msg'], $by_);
    mysqli_stmt_execute($stmt);
    header('Location: view.php?id=' . $_GET['id']);
    exit;
}
$stmt = mysqli_prepare($conn, 'SELECT * FROM tickets_comments WHERE ticket_id = ? ORDER BY created DESC');
mysqli_stmt_bind_param($stmt, 'i', $_GET['id']);
mysqli_stmt_execute($stmt);
$comments = mysqli_stmt_get_result($stmt)->fetch_all(MYSQLI_ASSOC);
?>

<?=template_header('Ticket')?>
<style>
    body {
        background-color: black;
    }

    .content.view {
        color: #00ffff;
    }

    .ticket {
        background-color: #222222;
    }

    .ticket .created {
        color: #00ccff;
    }

    .ticket .msg {
        color: #00ccff;
    }

    .btn {
        background-color: #00ccff;
        color: #ffffff;
    }

    .btn.red {
        background-color: #b63838;
    }

    .btn:hover {
        background-color: #0088cc;
    }

    .comments .comment p {
        color: #00ccff;
    }

    .comments .comment span {
        color: #00ccff;
    }

    .comments textarea {
        color: #00ccff;
    }

    .comments input[type="submit"] {
        background-color: #00ccff;
        color: #ffffff;
    }

    .comments input[type="submit"]:hover {
        background-color: #0088cc;
    }

    .file-name {
        color: #ffffff;
    }
</style>

<div class="content view">
    <h2><?=htmlspecialchars($ticket['title'], ENT_QUOTES)?> <span class="<?=$ticket['status']?>">(<?=$ticket['status']?>)</span></h2>

    <div class="ticket">
        <p class="created"><?=date('F dS, G:ia', strtotime($ticket['created']))?></p>
        <p class="msg"><?=nl2br(htmlspecialchars($ticket['msg'], ENT_QUOTES))?></p>

        <?php if (!empty($ticket['file_name'])): ?>
            <p class="file-name" style="color: #ffffff;">File: <?=$ticket['file_name']?></p>
            <p class="file-download"><a href="uploads/<?=$ticket['file_name']?>">Reference File</a></p>
        <?php endif; ?>
        <?php echo "from ".$ticket["assigned_by"];?><br><br>
        <?php if($ticket['status']=='open' || $ticket['status']=='reopened'): ?>
        <?php echo "please complete this within ".$ticket["priority"]." hours";?><br>
        <?php endif; ?>
    </div>

    <div class="btns">
        <a href="view.php?id=<?=$_GET['id']?>&status=reopened" class="btn" style="background-color: orange;">Reopen</a>
        <a href="view.php?id=<?=$_GET['id']?>&status=closed" class="btn red">Close</a>
        <a href="view.php?id=<?=$_GET['id']?>&status=resolved" class="btn">Resolve</a>
        <a href="view.php?id=<?=$_GET['id']?>&status=open" class="btn" style="background-color: grey;">Open</a>
    </div>

    <div class="comments">
        <?php foreach($comments as $comment): ?>
            <div class="comment">
                <div>
                    <i class="fas fa-comment fa-2x"></i>
                </div>
                <p>
                    <span><?=date('F dS, G:ia', strtotime($comment['created']))?></span>
                    <span><?=$comment['by_'];?></span>
                    <?=nl2br(htmlspecialchars($comment['msg'], ENT_QUOTES))?>
                </p>
            </div>
        <?php endforeach; ?>

        <form action="" method="post">
            <textarea name="msg" placeholder="Enter your comment..."></textarea>
            <input type="submit">
        </form>
    </div>

    <div class="btns">
        <a href="home.php" class="btn" style="background-color: #424242;">Back</a>
    </div>
</div>

<?=template_footer()?>

