<!DOCTYPE html>
<?php
    if(session_id() == '') 
        session_start();
    $fullPath    =   "files/bootstrap/twitter-bootstrap-sample-page-layouts-master/";  
    $phpDirPath  =   "files/registration/inc/php/";
    $incDirPath  =   "files/registration/inc/";
    $relPath    =   "files/bootstrap/twitter-bootstrap-sample-page-layouts-master/";
    $ddPath     =   "files/test/dd/";
    $jqueryui   =   "ajax/libs/jqueryui/1.10.0/";
    include_once $phpDirPath . 'config.php';
    include_once $phpDirPath . 'functions.php';
    require_once ('environment.php');
    require_once("localization.php");
    
    if (isset ($_GET['l']))
    {
        $locale = $_GET['l']  ;
        $_SESSION['locale'] = $locale;
    }
    else if ( !isset ($_SESSION['locale']))
    {
        $locale = "en_US";
    }  
    else
    {
      $locale  = $_SESSION['locale'];
    }
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Login &amp; Sign Up Page 1</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <?php
        $file_path = "locale/".$locale."/LC_MESSAGES/messages.po";
        $po_file =  "<link   rel='gettext' type='application/x-po' href='locale/".$locale."/LC_MESSAGES/messages.po'"." />";       
        if ( file_exists($file_path))
            echo $po_file;    
        if ($locale == "he_IL")
            echo "<link rel='stylesheet' type='text/css' href='files/css/registration_rtl.css' /> ";
    ?>     
    <!-- Adding the dropdown dd directory related -->
        <script src="<?php echo $ddPath . 'js/jquery/jquery-1.8.2.min.js'?>"></script> 
        <link rel="stylesheet" type="text/css" href="<?php echo $ddPath . 'css/msdropdown/dd.css'?>" />
        <script src="<?php echo $ddPath . 'js/msdropdown/jquery.dd.min.js'?>"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo $ddPath . 'css/msdropdown/skin2.css' ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo $ddPath .  'css/msdropdown/flags.css' ?>" /> 
     <!-- Finish the dropdown dd directory related -->

               
        <!--<script  type="text/javascript" src="ajax/libs/jquery/1.6.4/jquery.js"></script> <!--- equal to googleapis -->
        <script  type="text/javascript" src="<?php echo $jqueryui .  'js/jquery-ui-1.10.0.custom.js' ?>"></script> <!--- equal to googleapis -->
        <link rel='stylesheet' href='<?php echo $jqueryui .  'css/ui-lightness/jquery-ui-1.10.0.custom.css' ?>' type='text/css' media='all'/> 
        <script type="application/javascript" src="files/logo.js"></script> <!-- Logo interpreter -->
        <script type="application/javascript" src="files/turtle.js"></script> <!-- Canvas turtle -->
        <script type="application/javascript" src="files/jquery.tmpl.js"></script> <!-- jquerytmpl -->
        <!--<script src="<?php echo $relPath . 'scripts/jquery.min.js' ?>"></script>-->
        <?php
            $file_path = "locale/".$locale."/LC_MESSAGES/messages.po";
            $po_file =  "<link   rel='gettext' type='application/x-po' href='locale/".$locale."/LC_MESSAGES/messages.po'"." />";       
            if ( file_exists($file_path))
                echo $po_file;            
        ?>        
        <script type="text/javascript">
                var locale = "<?php echo $locale; ?>";
        </script>
        <script type="application/javascript" src="files/Gettext.js"></script> <!-- Using JS GetText -->

        <script type="application/javascript" src="files/jquery.Storage.js"></script> <!-- Storage -->
        <!-- Disable script when working on local mode without internet 
        <link rel='stylesheet' href='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/smoothness/jquery-ui.css' type='text/css' media='all'/> 
        -->
        <link rel='stylesheet' href='./files/css/interface.css' type='text/css' media='all'/> 
        <link rel='stylesheet' href='./files/css/footer.css' type='text/css' media='all'/> 
        <link href="<?php echo $relPath . 'styles/bootstrap.min.css' ?>" rel="stylesheet"> 
        <!--<script type="application/javascript" src="<?php echo $relPath . 'scripts/bootstrap-dropdown.js' ?>"></script>  Bootstaps drop down -->
        <script type="application/javascript" src="files/bootstrap/js/bootstrap.js"></script> <!-- Storage -->
        <script type="application/javascript" src="files/bootstrap/js/bootstrap.min.js"></script> <!-- Storage --> 
            <script src="ajax/libs/jquery/validator/dist/jquery.validate.js" type="text/javascript"></script>
            <script  type="text/javascript" src="<?php echo $jqueryui .  'js/jquery-ui-1.10.0.custom.js' ?>"></script> <!--- equal to googleapis -->
        <link rel='stylesheet' href='<?php echo $jqueryui .  'css/ui-lightness/jquery-ui-1.10.0.custom.css' ?>' type='text/css' media='all'/> 
    <script type='text/javascript'> 
        //$.validator.setDefaults({
        //        submitHandler: function() { alert("submitted!"); }
        //});
        $(document).ready(function(){
            var gt = new Gettext({'domain' : 'messages'});
            $('#topbar').dropdown();
            $('#username_in').focus();
            $("#sign-in-form").validate({
                    rules: {
                            username: {
                                    required: true,
                                    minlength: 4
                            },
                            password: {
				required: true,
				minlength: 5
                            }
                    },
                    messages: {
                            username: {
                                    required: gt.gettext("Please enter your username"), 
                                    minlength: gt.gettext("Your username must contain at least 4 characters")
                            },
                            password: {
                                    required: gt.gettext("Please enter your password"),
                                    minlength: gt.gettext("Your password must contain at least 5 characters")
                            }
                    }
            }); 
            $("#sign-up-form").validate({
                    rules: {
                            username: {
                                    required: true,
                                    minlength: 4
                            },
                            password: {
				required: true,
				minlength: 5
                            },
                            email : {
                                required: true,
				email: true
                            }
                    },
                    messages: {
                            username: {
                                    required: gt.gettext("Please enter your username"), 
                                    minlength: gt.gettext("Your username must contain at least 4 characters")
                            },
                            password: {
                                    required: gt.gettext("Please enter your password"),
                                    minlength: gt.gettext("Your password must contain at least 5 characters")
                            },
                            email: "Please enter a valid email address"
                    }
            }); 
            try {
                var pages = $("#selectedLanguage").msDropdown({on:{change:function(data, ui) {
                        var val = data.value;
                        $.Storage.set("locale",val);
                        if(val!="")
                            {
                                window.location.assign('registration.php?l=' + val);
                                
                            }
                                //window.location = 'registration.php?l=' + val ;
                }}}).data("dd");
                var pageIndex   =  $.Storage.get("locale");
                if (pageIndex == "")
                    pageIndex   = "en_US";
                pages.setIndexByValue(pageIndex);
            } catch(e) {
                    console.log(e);	
            }
        });
 
        $(document).delegate('.switch', 'click', function(){

            var c = $(this).attr('data-switch');
            $('#sign-in-form').slideUp(300, function(){ $(this).addClass('hide'); });
            $('#forgot-password-form').slideUp(300, function(){ $(this).addClass('hide'); });
            $('#'+c).slideDown(300, function(){
                $(this).removeClass('hide');
                $('input:first', this).focus();
             });
            c = null;
       });
    </script>
    
    <!-- Le styles -->
    <link href="<?php echo $fullPath . 'styles/bootstrap.min.css'; ?>" rel="stylesheet">
    <style type="text/css">

      .switch{
        display:inline-block;
        cursor:pointer;
      }
    </style>

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="<?php echo $fullPath . 'images/favicon.ico'; ?>">
    <link rel="apple-touch-icon" href="<?php echo $fullPath . 'images/apple-touch-icon.png'; ?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo $fullPath . 'images/apple-touch-icon-72x72.png'; ?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo $fullPath . 'images/apple-touch-icon-114x114.png'; ?>">
  </head>
  <body>
    <?php  
    //setup some variables/arrays
    $action = array();
    $action['result'] = null;

    $text = array();

    //check if the form has been submitted
    if(isset($_POST['signup'])){

            //cleanup the variables
            //prevent mysql injection
            /*
                $username = mysql_real_escape_string($_POST['username']);
                $password = mysql_real_escape_string($_POST['password']);
                $email = mysql_real_escape_string($_POST['email']);
            */
            $username   = $_POST['username'];
            $password   = $_POST['password'];
            $email      = $_POST['email'];
            //quick/simple validation
            if(empty($username)){ $action['result'] = 'error'; array_push($text,'You forgot your username'); }
            if(empty($password)){ $action['result'] = 'error'; array_push($text,'You forgot your password'); }
            if(empty($email)){ $action['result'] = 'error'; array_push($text,'You forgot your email'); }
            //print_r($action);

            if($action['result'] != 'error'){
                    $password = md5($password);	
                    $m = new Mongo();
                    $db = $m->turtleTestDb;	
                    $users = $db->users;
                    //Query if email already exist and approved
                    $queryEmail             = array('email' => $email ,"confirm" => true);
                    $existEmail             = $users->count($queryEmail);
                    $queryUsername          = array('username' => $username ,"confirm" => true);
                    $existUsername          = $users->count($queryUsername);
                    if ($existEmail > 0 ) //Check if email already exist
                    {
                        $action['result'] = 'error'; 
                        array_push($text,'Email is already being used /n please enter a valid email');
                    }
                    else if ($existUsername > 0 ) //Check if email already exist
                    {
                        $action['result'] = 'error'; 
                        array_push($text,'Username is already being used');
                    }
                    else {
                        //add to the database
                        //$add = mysql_query("INSERT INTO `users` VALUES(NULL,'$username','$password','$email',0)");
                        $userStructure = array("username" => $username, "password" => $password, "email" => $email , "confirm" => false);
                        $userResult = $users->insert($userStructure, array('safe' => true));
                        $userid = $userStructure['_id'];		
                        if($userResult){
                                //get the new user id
                                //$userid = mysql_insert_id();
                                $users = $db->users_waiting_approvment;
                                //create a random key
                                //$key = $username . $email . date('mY');
                                $key = $username . $email ;
                                $key = md5($key);
                                //add confirm row
                                //$confirm = mysql_query("INSERT INTO `confirm` VALUES(NULL,'$userid','$key','$email')");	
                                $userStructure = array("userid" => $userid, "key" => $key, "email" => $email );
                                $userConfirmResult = $users->insert($userStructure, array('safe' => true));
                                if($userConfirmResult){
                                        //include the swift class
                                        include_once $phpDirPath .'swift/swift_required.php';
                                        //put info into an array to send to the function
                                        $info = array(
                                                'username' => $username,
                                                'email' => $email,
                                                'key' => $key);
                                        //send the email
                                        if(send_email($info , $sitePath)){
                                        //if(send_email_test($info)){				
                                                $action['result'] = 'success';
                                                array_push($text,'Thanks for signing up. Please check your email for confirmation!');
                                        }else{
                                                $action['result'] = 'error';
                                                array_push($text,'Could not send confirm email');

                                        }
                                }else{

                                        $action['result'] = 'error';
                                        //array_push($text,'Confirm row was not added to the database. Reason: ' . mysql_error());
                                        array_push($text,'Confirm row was not added to the database. Reason: ' );
                                }
                            }
                    }
                    //else{
                    //        $action['result'] = 'error';
                    //        array_push($text,'User could not be added to the database. Reason: ' . mysql_error());
                    //}
            }
            $action['text'] = $text;
    }
 
            $class = ($locale == "he_IL" ?  "pull-right" :  "pull-left");    
            $login = ($locale != "he_IL" ?  "pull-right" :  "pull-left");    
   ?>
    <div class="topbar" style="position: static;">
            <div class="fill">
                <div class="container span13" > 
                    <img class="brand" id="turtleimg" src="files/turtles.png" alt="צב במשקפיים">

                    <ul class="nav" id="turtleHeaderUl"> 
                            <li><a href="index.php" style="color:gray;" ><?php echo _("TurtleAcademy");?></a></li> 
                            <!--<li class="active"><a href="index.html"><?php echo _("Sample");?></a></li> -->
                    </ul>

                    <form class="<?php  
                                        echo $class . " form-inline";                                
                                    ?>" action="" id="turtleHeaderLanguage">  
                        <select name="selectedLanguage" id="selectedLanguage" style="width:120px;">
                            <option value='en_US' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag us" data-title="United States">English</option>
                            <option value='es_AR' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag es" data-title="Spain">Español</option>
                            <option value='he_IL' data-image="Images/msdropdown/icons/blank.gif" data-imagecss="flag il" data-title="Israel">עברית</option>
                            <option value='zh_CN' data-image="images/msdropdown/icons/blank.gif" data-imagecss="flag cn" data-title="China">中文</option>
                        </select>
                    </form>       
                    <?php
                        if (isset($_SESSION['username']))
                        {
                    ?>                       
                            <!--  <p class="pull-right">Hello <a href="#"> -->
                                <nav class="<?php echo $login ?>" style="width:200px;" id="turtleHeaderLoggedUser">
                                    <ul class="nav nav-pills <?php echo $login ?>" id="loggedUserUl">

                                        <li style="padding: 10px 10px 11px;"> <?php echo _("Hello");?></li>
                                        <li class="cc-button-group btn-group"> 
                                            <a class="dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" style="color:#ffffff; background-color: rgba(0, 0, 0, 0.5);" >
                                            <?php
                                                echo $_SESSION['username'];
                                            ?>
                                                <b class="caret"></b>
                                            </a>
                                            <ul class="dropdown-menu" id="ddmenu"role="menu" aria-labelledby="dLabel">
                                                <li><a tabindex="-1" href="/docs"   class="innerLink" id="help-nav"><?php echo _("My account");?></a></li>
                                                <li><a tabindex="-1" href="/docs" class="innerLink" id="hel-nav"><?php echo _("Help");?></a></li>
                                                <li><a href="logout.php" class="innerLink"><?php echo _("Log out");?></a></li>
                                            </ul>


                                        </li>
                                    </ul> 
                                </nav>                                                                     
                                </a>

                    <?php
                        }
                        else
                        {

                        }
                        ?>
                </div>
            </div> <!-- Ending fill barf -->
        </div> <!-- Ending top bar -->
          
          
    <div class="container">
        <div class='row'>
        <!-- Main hero unit for a primary marketing message or call to action -->
            <div class="well span6 offset2">
                <form class='form-stacked' id='sign-up-form' method="post" action="">
                    <h2><?php echo _("Sign Up for Free"); ?></h2>
                    <?php
                        echo show_errors($action);
                    ?>
                    <div class='cleaner_h20'></div>        
                    <div class="clearfix">
                        <label for="email_up" id="signUpEmailLbl"><?php echo _("Email"); ?></label>
                        <div class="input">
                            <input id="email" name="email" size="30" type="text" class='xlarge'/>
                                <!--
                                <span class="help-block">
                                <span class='label important'>Warning</span> incorrect email address
                                </span>
                                -->
                        </div>
                    </div>        
                    <div class="clearfix">
                        <label for="username_up" id="signUpUserNameLbl"><?php echo _("Username"); ?></label>
                        <div class="input">
                            <input id="username" name="username" size="30" type="text" class='xlarge'/>
                            </br>
                            <!--
                            <span class="help-block">
                            <span class='label important'>Warning</span> the username already exists
                            </span>
                            -->
                        </div>
                    </div>         
                    <div class="clearfix">
                        <label for="pwd_up" id="signUpUserNameLPwdLbl"><?php echo _("Password"); ?></label>
                        <div class="input">
                            <input id="password" name="password" size="30" type="password" class='xlarge'/>
                                <!--
                                <span class="help-block">
                                <span class='label important'>Warning</span> too easy - even I can guess it
                            </span>
                            -->
                        </div>
                    </div>        
                    <div class='cleaner_h10'></div>           
                    <ul class="inputs-list">
                        <li>
                            <label>
                                <input type="checkbox" name="terms_up" id='terms_up' value="yes" checked='true' />
                                <span for='terms_up' id="signupAgreeToTerms"><?php echo _("Agree to"); ?> <a href='#'><?php echo _("Terms of Use"); ?></a></span>
                            </label>
                        </li>
                    </ul>       
                    <div class='cleaner_h20'></div>
                    <input type='submit' value='<?php echo _("Sign Up"); ?>&raquo;' id='signup' name='signup' class="btn primary"/>
                </form>
            </div>    
            <div class="well span5">
                <form class='form-stacked' id='sign-in-form' action='log.php' method='post'>
                    <h2><?php echo _("Sign In"); ?></h2>
                    <?php
                        $err="<span class='help-block'>";
                        if ( isset ($_SESSION['err_login_msg']) )
                        {
                            foreach($_SESSION['err_login_msg'] as $msg) { //Get each error
                                    $err .= "<span class='label important'>" . $msg . "</span>"; //Write them to a variable
                            }
                        }
                        $err .= "</span>";
                        echo $err;
                        if (isset ($_SESSION['err_login_msg']))
                            unset($_SESSION['err_login_msg']);
                    ?>
                    <div class='cleaner_h20'></div>           
                    <div class="clearfix">
                        <label for="username" id="signInUserNameLbl"><?php echo _("Username"); ?></label>
                        <div class="input">
                            <input id="username" name="username" size="30" type="text"/>
                            <!--
                            <span class="help-block">
                            <span class='label important'>Warning</span> the username already exists
                            </span>
                            -->
                        </div>
                    </div>
                    <input id="comefrom" name="comefrom" size="30" type="text" value="registration.php" style="display:none;"/>        
                    <div class="clearfix">
                        <label for="password" id="signInPasswordLbl"><?php echo _("Password"); ?></label>
                        <div class="input">
                            <input id="password" name="password" size="30" type="password"/>
                            <!--
                            <span class="help-block">
                            <span class='label important'>Warning</span> too easy - even I can guess it
                        </span>
                        -->
                        </div>
                    </div>           
                    <ul class="inputs-list">
                        <li>
                            <label>
                                <input type="checkbox" name="remember_checkbox" id='remember_checkbox' value="yes" checked='true' />
                                <span for='remember_in' id='remember_span'><?php echo _("Remember me"); ?></span>
                            </label>
                        </li>
                    </ul>          
                    <div class='cleaner_h20'></div>
                    <input type='submit' value='<?php echo _("Sign In"); ?>&raquo;' id='submit_in' name='submit_in' class="btn primary"/>
                    <span class='switch' data-switch='forgot-password-form'><?php echo _("Forgot my password"); ?></span>
                </form>        
                <form class='form-stacked hide' id='forgot-password-form'>
                    <h2><?php echo _("Forgot Password"); ?></h2>
                    <div class='cleaner_h20'></div>
                    <div class="clearfix">
                        <label for="email_pwd" id="forgotEmail"><?php echo _("Email"); ?></label>
                        <div class="input">
                            <input id="email_pwd" name="email_pwd" size="30" type="text"/>
                            <!--
                            <span class="help-block">
                            <span class='label important'>Warning</span> the username already exists
                            </span>
                            -->
                            <div class='cleaner_h10'></div>
                            <span class='switch' data-switch='sign-in-form<?php echo _("Never mind, I remember my password"); ?></span>
                        </div>
                    </div>           
                    <div class='cleaner_h20'></div>
                    <input type='submit' value='<?php echo _("Remind me"); ?>&raquo;' id='submit_pwd' name='submit_pwd' class="btn primary"/>
                </form>
            </div>
        </div>
        <div class='cleaner'></div>
 
        <footer style='text-align:center;'>
            <p>&copy; <?php echo _("TurtleAcademy"); ?></p>
        </footer>

    </div> <!-- /container -->

  </body>
</html>
