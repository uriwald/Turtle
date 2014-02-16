<?php
	//include("sql.php"); //Connect to SQL
        require_once 'files/utils/userUtil.php';

	if(!isset($_SESSION))
            session_start();
        //session_unset();
        require_once("environment.php");
        
        $validateUser       = false ;
	$errmsg             = array(); //Array to store errors
	
	$errflag            = false; //Error flag


        $username           = $_POST['username'];
        $password           = $_POST['password'];
        $comefrom           = "index.php";
        $lessonReportPage   = "files/translation/lesson/lessonsTransReportPage.php";
        if (isset ($_POST['comefrom']))
            $comefrom = $_POST['comefrom'];
        if (isset ($_SESSION['comefrom']))
            $comefrom = $_SESSION['comefrom'];
	//Check Username
	if($username == '') {
		$errmsg[] = 'Username missing'; //Error
		$errflag = true; //Set flag so it says theres an error
                		//header("location: loginnuser.php"); //Rediect
                $_SESSION['err_login_msg'] = $errmsg ;
                header("location: " . $comefrom);
		exit(); //Block scripts
	}

	//Check Password
	if($password == '') {
		$errmsg[] = 'Password missing'; //Error
		$errflag = true; //Set flag so it says theres an error
                		 //header("location: loginnpass.php"); //Rediect
                $_SESSION['err_login_msg'] = $errmsg ;
                header("location: " . $comefrom);
		exit(); //Block scripts
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
