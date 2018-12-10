
<?php 

	include 'server.php';

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
		<!-- logged in user information -->
		<?php  if (isset($_SESSION['uname'])) : ?>
					<div class="input-group but" >
						<a href="detail.php?logout='1'"> <button type="submit" class="btn right" name="signin">logout</button></a>
					</div>
			
	</div>
	<div class="content">
		<?php
		if(file_exists('details.json'))
		{
			$file='details.json';
			$data=file_get_contents($file);
			$array_data=json_decode($data, true);
			var_dump($array_data);
			
		}
		else
		{
			$error="JSON file does not exists";
		}
		?>
		
		<?php endif ?>
	</div>
		
</body>
</html>