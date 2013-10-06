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

	//$username = Fix($_POST['username']); //Username
	//$password = Fix($_POST['password']); //Password
        $username           = $_POST['username'];
        $password           = $_POST['password'];
        $comefrom           = "index.php";
        $lessonReportPage   = "files/translation/lesson/lessonsTransReportPage.php";
        if (isset ($_POST['comefrom']))
            $comefrom = $_POST['comefrom'];

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

        //Check whether the query was successful or not
        if ( $username == "burbur" && $password = "563") 
        {
            
            $_SESSION['Admin'] = true ;
            $_SESSION['username'] = "admin";
            $_SESSION['permision'] = 1;
            $validateUser = true;
            header("location: admin.php");
        }
        else if ( $username == "guest" && $password = "guest")
        {
            $_SESSION['Guest'] = true ;
            
            $_SESSION['username'] = "guest";
            $_SESSION['permision'] = 2;
            $validateUser = true;
            header("location: lesson.php");
        }
        else if ( $username == "translator" && $password = "translator")
        {
            $_SESSION['translator'] = true ;
            
            $_SESSION['username'] = "translator";
            $_SESSION['permision'] = 2;
            $validateUser = true;
            header("location: " .$lessonReportPage."?locale=zh_CN");
        }
        else if ( $username == "eseditor" && $password = "eseditor")
        {
            $_SESSION['translator'] = true ;
            
            $_SESSION['username'] = "translator";
            $_SESSION['permision'] = 2;
            $validateUser = true;
            header("location: " .$lessonReportPage."?locale=es_AR");
        }
        else if ( $username == "degerman" && $password = "degerman")
        {
            $_SESSION['translator'] = true ;
            
            $_SESSION['username'] = "translator";
            $_SESSION['permision'] = 2;
            $validateUser = true;
            header("location: " .$lessonReportPage."?locale=de_DE");
        }
        else if ( $username == "brroberto" && $password = "brroberto")
        {
            $_SESSION['translator'] = true ;          
            $_SESSION['username'] = "Brazil";
            $_SESSION['permision'] = 2;
            $validateUser = true;
            header("location: " .$lessonReportPage."?locale=pt_BR");
        }
        else if ( $username == "plorigin" && $password = "plorigin")
        {
            $_SESSION['translator'] = true ;          
            $_SESSION['username'] = "Poland";
            $_SESSION['permision'] = 2;
            $validateUser = true;
            header("location: " .$lessonReportPage."?locale=pl_PL");
        }
        else if ( $username == "arjotr" && $password = "arjotr")
        {
            $_SESSION['translator'] = true ;
            
            $_SESSION['username'] = "translator";
            $_SESSION['permision'] = 2;
            $validateUser = true;
            header("location: " .$lessonReportPage."?locale=ar_JO"); 
        }
        else if ( $username == "eneditor" && $password = "eneditor")
        {
            $_SESSION['translator'] = true ;
            header("location: lessons.php");
            $_SESSION['username'] = "eneditor";
            $_SESSION['permision'] = 100;
            $validateUser = true;
        }
        else if ( $username == "areditor" && $password = "areditor")
        {
            $_SESSION['translator'] = true ;
            header("location: lessons.php");
            $_SESSION['username'] = "areditor"; 
            $_SESSION['permision'] = 108;
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
        else if ( $username == "thai" && $password = "thai")
        {
            $_SESSION['translator'] = true ;
            header("location: lessons.php");
            $_SESSION['username'] = "theditor";
            $_SESSION['permision'] = 109;
            $validateUser = true; 
        }
        else if ( $username == "rueditor" && $password = "rueditor")
        { 
            $_SESSION['translator'] = true ;         
            $_SESSION['username'] = "rueditor";
            $_SESSION['permision'] = 107;
            $validateUser = true;
            header("location: " .$lessonReportPage."?locale=ru_RU");
        }
        //If we got the user name and password check if user available
        //and put the info in users_login collection
        else if (!$errflag)
        {
            $userExist  =   userUtil::varifyUser($username, $password);
            if (!$userExist)
            {
               $errmsg[] = 'User does not exist';
               $errflag = true;        
            }
            //If there are input validations, redirect back to the registration form
            if($errflag) {
                    $_SESSION['ERRMSG'] = $errmsg; //Write errors
                    $_SESSION['err_login_msg'] = $errmsg ;
                    header("location: " . $comefrom); //Rediect
                    exit(); //Block scripts
            } 
            else { //Case User is valid
                //Check if the user is an institute admin
                    $m = new Mongo();
                    $db = $m->turtleTestDb;
                    $usercol = $db->users;
                    $user = $usercol->findOne(array('username' => $username ));
                    $_SESSION['username'] = $username;                 
                    if (isset($user['institute']))
                    {
                        $_SESSION['institute'] = $user['institute'];
                        $_SESSION['institute_email'] = $user['email'];
                        $_SESSION['institute_name'] = $user['institute_name'];
                        $_SESSION['institute_description'] = $user['institute_description'];
                    }
                    ?>
                    <script type="application/javascript" src="<?php echo $rootDir; ?>clearStorageData.php"></script> <!-- Clear storage from previous use scripts -->
                    <?php
                    header("location: ".$rootDir."learn.php" ); 
            }
        }
        //Case registered user go to user page 
        else {
           $_SESSION['username'] = $username;
           header("location: ".$rootDir."users.php"); 
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
