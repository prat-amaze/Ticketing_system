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

<style>
	body {
		background-color: black;
		color: neonblue;
	}
</style>

<div class="content home">

	<h2>Tickets</h2>
	<br>
	<center>
		<nav class="navbar bg-body-tertiary">
			<div class="container-fluid">
				<form class="d-flex" role="search" method="GET" action="">
					<input class="form-control me-2" type="search" name="search" placeholder="Search Tickets" aria-label="Search">
					<button class="btn btn-outline-success" type="submit">Search</button>
				</form>
			</div>
		</nav>
	</center>
	<p style="color:#1589FF">You can view the progress of work assigned by you below.</p>
	
	<div class="tickets-list">
	<?php 
		if(isset($_GET['search']) && !empty($_GET['search'])) {
			$searchTerm = $_GET['search'];
			$query = "SELECT * FROM tickets WHERE title LIKE '%$searchTerm%' OR msg LIKE '%$searchTerm%' ORDER BY created DESC";
			$result = mysqli_query($conn, $query);
			$tickets = mysqli_fetch_all($result, MYSQLI_ASSOC);
		}
		?>
		
		<?php foreach ($tickets as $ticket): ?>
		<?php if($_SESSION['email']==$ticket['assigned_by']):?>
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
    
    <style>
	.btn {
		background-color: grey;
		color: neonblue;
	}
</style>

<div class="btns">
	<a href="home.php" class="btn" style="background-color: grey !important; color: neonblue;">Back</a>
</div>
</div>

<?=template_footer()?>
