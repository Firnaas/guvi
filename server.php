<?php 
	session_start();

	// variable declaration
	$uname = "";
	$email    = "";
	$errors = array(); 
	$_SESSION['success'] = "";

	// connect to database
	$db = mysqli_connect('localhost', 'root', '', 'guvi');

	// REGISTER USER
	if (isset($_POST['signup'])) {
		// receive all input values from the form
		$uname = mysqli_real_escape_string($db, $_POST['uname']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$pass1 = mysqli_real_escape_string($db, $_POST['pass1']);
		$pass2 = mysqli_real_escape_string($db, $_POST['pass2']);

		// form validation: ensure that the form is correctly filled
		if (empty($uname)) { array_push($errors, "Username is required"); }
		if (empty($email)) { array_push($errors, "Email is required"); }
		if (empty($pass1)) { array_push($errors, "Password is required"); }

		if ($pass1 != $pass2) {
			array_push($errors, "The two passwords do not match");
		}

		// register user if there are no errors in the form
		if (count($errors) == 0) {
			$pass = md5($pass1);//encrypt the password before saving in the database
			$sql = "INSERT INTO users (username, email, password) 
					  VALUES('$uname', '$email', '$pass')";
			mysqli_query($db, $sql);

			header('location: index.html');
		}

	}

	// ... 

	// LOGIN USER
	if (isset($_POST['signin'])) {
		$uname = mysqli_real_escape_string($db, $_POST['uname']);
		$pass = mysqli_real_escape_string($db, $_POST['pass']);

		if (empty($uname)) {
			array_push($errors, "Username is required");
		}
		if (empty($pass)) {
			array_push($errors, "Password is required");
		}

		if (count($errors) == 0) {
			$pass = md5($pass);
			$sql = "SELECT * FROM users WHERE username='$uname' AND password='$pass'";
			$results = mysqli_query($db, $sql);

			if (mysqli_num_rows($results) == 1) {
				$_SESSION['uname'] = $uname;
				$_SESSION['success'] = "You are now logged in";
				header('location: detail.php');
			}else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}

	//Details
	if (isset($_POST['save'])) {
		if(file_exists('details.json'))
		{
			$file='details.json';
			
			$extra= array(
				'First name' => $_POST['fname'],
				'Last name' => $_POST['lname'],
				'Phone' => $_POST['phone'],
				'Title' => $_POST['title'],
				'Department' => $_POST['dept'],
				'account' => $_POST['account'],
				'Country'=> $_POST['country']
			);
			$array_data[]=$extra;
			$final_data = json_encode($array_data);
			if(file_put_contents($file, $final_data))
			{
				$message=" Data successfully stored";
			}
			$fname = mysqli_real_escape_string($db, $_POST['fname']);
			$lname = mysqli_real_escape_string($db, $_POST['lname']);
			$phone = mysqli_real_escape_string($db, $_POST['phone']);
			$title = mysqli_real_escape_string($db, $_POST['title']);
			$dept = mysqli_real_escape_string($db, $_POST['dept']);
			$account = mysqli_real_escape_string($db, $_POST['account']);
			$country = mysqli_real_escape_string($db, $_POST['country']);
		
		
			$sql = "INSERT INTO info (firstname, lastname, phone, title, dept, account, country) 
					  VALUES('$fname', '$lname', '$phone', '$title', '$dept', '$account', '$country')";
			mysqli_query($db, $sql);
			header('location: details.php');
			}
		else
		{
			$error="JSON file does not exists";
		}
	}

	//retrieve records
	$results = mysqli_query($db, "SELECT * FROM info ORDER BY id desc LIMIT 1");

?>