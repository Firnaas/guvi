<?php 
	session_start(); 

	if (!isset($_SESSION['uname'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: index.html');
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['uname']);
		header("location: index.html");
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>GUVI Internship</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Details</h2>
	</div>
	<div class="content">

		<!-- notification message -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php 
						echo $_SESSION['success']; 
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>

		<!-- logged in user information -->
		<?php  if (isset($_SESSION['uname'])) : ?>
			<p>Welcome <strong><?php echo $_SESSION['uname']; ?></strong></p>
			
			<div class="input-group but" >
				<a href="detail.php?logout='1'"> <button type="submit" class="btn right" name="signin">logout</button></a>
			</div>
			<form method="post" action="server.php">
				<div class="input-group">
					<label>First Name</label>
					<input type="text" name="fname" required>
				</div>
				<div class="input-group">
					<label>Last Name</label>
					<input type="text" name="lname" required>
				</div>
				<div class="input-group">
					<label>Phone No.</label>
					<input type="text" name="phone" required="0123456789">
				</div>
				<div class="input-group">
					<label>Title</label>
					<input type="text" name="title" >
				</div>
				<div class="input-group">
					<label>Department</label>
					<input type="text" name="dept">
				</div>
				<div class="input-group">
					<label>Account No.</label>
					<input type="text" name="account">
				</div>
				<div class="input-group">
					<label>Country</label>
					<input type="text" name="country" required>
				</div>
				<div class="input-group">
					<button type="submit" class="btn" name="save">Save</button>
				</div>
				
			</form>
		<?php endif ?>
	</div>
		
</body>
</html>