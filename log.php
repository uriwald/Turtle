<?php
	//include("sql.php"); //Connect to SQL

	session_start(); //Start session for writing

//	function Fix($str) { //Clean the fields
//		$str = trim($str);
//		if(get_magic_quotes_gpc()) {
//			$str = stripslashes($str);
//		}
//		return mysql_real_escape_string($str);
//	}

	$errmsg = array(); //Array to store errors
	
	$errflag = false; //Error flag

	//$username = Fix($_POST['username']); //Username
	//$password = Fix($_POST['password']); //Password
        $username = $_POST['username'];
        $password = $_POST['password'];

	//Check Username
	if($username == '') {
		$errmsg[] = 'Username missing'; //Error
		$errflag = true; //Set flag so it says theres an error
	}

	//Check Password
	if($password == '') {
		$errmsg[] = 'Password missing'; //Error
		$errflag = true; //Set flag so it says theres an error
	}


	//If there are input validations, redirect back to the registration form
	if($errflag) {
		$_SESSION['ERRMSG'] = $errmsg; //Write errors
		session_write_close(); //Close session
		header("location: login.php"); //Rediect
		exit(); //Block scripts
	}

	//Create SELECT query
        /*
	$qry = "SELECT * FROM `users` WHERE `Username` = '$username' AND `Password` = '" . md5($password) . "'";
	$result = mysql_query($qry);
	*/
	

        //Check whether the query was successful or not
        if ( $username == "burbur" && $password = "563")
        {
            $_SESSION['Admin'] = true ;
            header("location: lesson.php");
        }
        
        /*
	if(mysql_num_rows($result) == 1) {
		while($row = mysql_fetch_assoc($result)) {
			$_SESSION['UID'] = $row['UID']; //Retrieve the UID from the database and put it into a session
			$_SESSION['USERNAME'] = $username; //Set the username as a session
			session_write_close(); //Close the session
			header("location: member.php"); //Redirect
		}
	} else {
		$_SESSION['ERRMSG'] = "Invalid username or password"; //Error
		session_write_close(); //Close the session
		header("location: login.php"); //Rediect
		exit(); //Block scripts
	}
         */
?>
