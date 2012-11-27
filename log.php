<?php
	//include("sql.php"); //Connect to SQL

	session_start(); //Start session for writing
        session_unset();
        require_once("environment.php");

        $validateUser = false ;
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


        //Check whether the query was successful or not
        if ( $username == "burbur" && $password = "563")
        {
            $_SESSION['Admin'] = true ;
            header("location: lessons.php");
            $_SESSION['user'] = "admin";
            $_SESSION['permision'] = 1;
            $validateUser = true;
        }
        if ( $username == "guest" && $password = "guest")
        {
            $_SESSION['Guest'] = true ;
            header("location: lesson.php");
            $_SESSION['user'] = "guest";
            $_SESSION['permision'] = 2;
            $validateUser = true;
        }
        if ( $username == "translator" && $password = "translator")
        {
            $_SESSION['translator'] = true ;
            header("location: lessons.php");
            $_SESSION['user'] = "translator";
            $_SESSION['permision'] = 2;
            $validateUser = true;
        }
        
        if ( $username == "eneditor" && $password = "eneditor")
        {
            $_SESSION['translator'] = true ;
            header("location: lessons.php");
            $_SESSION['user'] = "eneditor";
            $_SESSION['permision'] = 100;
            $validateUser = true;
        }
        if ( $username == "gereditor" && $password = "gereditor")
        {
            $_SESSION['translator'] = true ;
            header("location: lessons.php");
            $_SESSION['user'] = "gereditor";
            $_SESSION['permision'] = 103;
            $validateUser = true;
        }
        if ( $username == "rueditor" && $password = "rueditor")
        {
            $_SESSION['translator'] = true ;
            header("location: lessons.php");
            $_SESSION['user'] = "gereditor";
            $_SESSION['permision'] = 107;
            $validateUser = true;
        }
        if ($validateUser)
        {
            $m = new Mongo();
            $db = $m->$dbName;
            $loginLog = $db->login_volunteers;
            date_default_timezone_set('America/Los_Angeles');
            $date = date('Y-m-d H:i:s');
            $structure = array("username" => $username = $_POST['username'], "date" => $date);
            $result = $loginLog->insert($structure, array('safe' => true));
        }

?>
