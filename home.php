<?php
include 'functions.php';
// Connect to MySQL using the below function
$conn = connect_mysql();
session_start();
// MySQL query that retrieves all the tickets from the database
$query = 'SELECT * FROM tickets ORDER BY created DESC';
$result = mysqli_query($conn, $query);
$tickets = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<?=template_header('Tickets')?>

<div class="content home">
	<body style="background-color:#000000; color: #00FFFF;">
		<h2>Tickets</h2>

		<div class="btns">
			<a href="create.php" class="btn">Create Ticket</a>
			<a href="tasks.php" class="btn" style="background-color: red;">Tasks</a>
			<a href="tickets.php" class="btn" style="background-color: grey;">Tickets</a>
		</div>

		<p>Welcome to the index page.</p>

		<p> You can view recently allotted tasks below.</p>

		<?php $int=0?>
		<div class="tickets-list">
			<?php foreach ($tickets as $ticket): ?>
			<?php if($_SESSION["email"]==$ticket["email"]):
				$int= $int +1;
				if($int >5):
				break;
				endif;
			?>
			<a href="view.php?id=<?=$ticket['id']?>" class="ticket">
				<span class="con">
					<?php if ($ticket['status'] == 'open'): ?>
					<i class="far fa-clock fa-2x"></i>
					<?php elseif ($ticket['status'] == 'resolved'): ?>
					<i class="fas fa-check fa-2x"></i>
					<?php elseif ($ticket['status'] == 'closed'): ?>
					<i class="fas fa-times fa-2x"></i>
					<?php endif; ?>
				</span>
				<span class="con">
					<span class="title"><?=htmlspecialchars($ticket['title'], ENT_QUOTES)?></span>
					<span class="int" style="color:red"><?=htmlspecialchars($ticket['priority'], ENT_QUOTES)?> hours</span>
				</span>
				<span class="con created"><?=date('F dS, G:ia', strtotime($ticket['created']))?></span>
			</a>
			<?php endif; ?>
			<?php endforeach; ?>
		</div>

	</div>
</body>

<?=template_footer()?>
