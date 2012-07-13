<?php
	//login.php
	session_start(); //Start the session
	if(isset($_SESSION['ERRMSG']) && is_array($_SESSION['ERRMSG']) && count($_SESSION['ERRMSG']) >0 ) { //If the error session exists
		$err = "<table>"; //Start a table
		foreach($_SESSION['ERRMSG'] as $msg) { //Get each error
			$err .= "<tr><td>" . $msg . "</td></tr>"; //Write them to a variable
		}
		$err .= "</table>"; //Close the table
		unset($_SESSION['ERRMSG']); //Delete the session
	}
?>
<html>
	<head>
		<title>My Login Form</title>
	</head>
	<body>
		<form action='log.php' method='post'>
			<table align="center">
				<tr>
					<td><?php if(isset($_SESSION['ERRMSG'])) echo $err; ?></td>
				</tr>
				<tr>
					<td>Username</td>
					<td><input type='text' name='username'></td>
				</tr>
				<tr>
					<td>Password</td>
					<td><input type='password' name='password'></td>
				</tr>
				<tr>
					<td><input type='submit' value='Login'></td>
					<td><a href="register.php">Register</a></td>
				</tr>
			</table>
		</form>
	</body>
</html>
