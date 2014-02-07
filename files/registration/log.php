<?php
	//include("sql.php"); //Connect to SQL
        require_once '../utils/userUtil.php';

	if(!isset($_SESSION)){session_start();}
        //session_unset();
        require_once("../../environment.php");
        
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
                		//header("location: loginnuser.php"); //Rediect
		exit(); //Block scripts
	}

	//Check Password
	if($password == '') {
		$errmsg[] = 'Password missing'; //Error
		$errflag = true; //Set flag so it says theres an error
                		header("location: loginnpass.php"); //Rediect
		exit(); //Block scripts
	}
        //If we got the user name and password check if user available
        if (!$errflag)
        {
            echo "sdds";
            $userExist  =   userUtil::varify_user($username, $password);
            if (!$userExist)
               // $_SESSION['username'] = $username;
          //  else
            {
               $errmsg[] = 'User not exist';
               $errflag = true;        
            }
        }

	//If there are input validations, redirect back to the registration form
	if($errflag) {
		$_SESSION['ERRMSG'] = $errmsg; //Write errors
		//session_write_close(); //Close session
		header("location: loginn.php"); //Rediect
		exit(); //Block scripts
	}


        //Check whether the query was successful or not
        if ( $username == "burbur" && $password = "563")
        {
            $_SESSION['Admin'] = true ;
            header("location: lessons.php");
            $_SESSION['username'] = "admin";
            $_SESSION['permision'] = 1;
            $validateUser = true;
        }
        else if ( $username == "guest" && $password = "guest")
        {
            $_SESSION['Guest'] = true ;
            header("location: lesson.php");
            $_SESSION['username'] = "guest";
            $_SESSION['permision'] = 2;
            $validateUser = true;
        }
        else if ( $username == "translator" && $password = "translator")
        {
            $_SESSION['translator'] = true ;
            header("location: lessons.php");
            $_SESSION['username'] = "translator";
            $_SESSION['permision'] = 2;
            $validateUser = true;
        }
        
        else if ( $username == "eneditor" && $password = "eneditor")
        {
            $_SESSION['translator'] = true ;
            header("location: lessons.php");
            $_SESSION['username'] = "eneditor";
            $_SESSION['permision'] = 100;
            $validateUser = true;
        }
        else if ( $username == "gereditor" && $password = "gereditor")
        {
            $_SESSION['translator'] = true ;
            header("location: lessons.php");
            $_SESSION['username'] = "gereditor";
            $_SESSION['permision'] = 103;
            $validateUser = true;
        }
        else if ( $username == "rueditor" && $password = "rueditor")
        {
            $_SESSION['translator'] = true ;
            header("location: lessons.php");
            $_SESSION['username'] = "gereditor";
            $_SESSION['permision'] = 107;
            $validateUser = true;
        }
        //Case registered user go to user page
        else {
           $_SESSION['username'] = $username;
           header("location: users.php"); 
        }
        if ($validateUser)
        {
            $m = new Mongo();
            $db = $m->$db_name;
            $loginLog = $db->login_volunteers;
            date_default_timezone_set('America/Los_Angeles');
            $date = date('Y-m-d H:i:s');
            $structure = array("username" => $username = $_POST['username'], "date" => $date);
            $result = $loginLog->insert($structure, array('safe' => true));
        }

?>
