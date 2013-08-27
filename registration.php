<!DOCTYPE html>
<?php
if (session_id() == '')
    session_start();
$phpDirPath = "files/registration/inc/php/";
include_once $phpDirPath . 'config.php';
include_once $phpDirPath . 'functions.php';
require_once ('environment.php');
require_once ("localization.php");
require_once ("files/cssUtils.php");
require_once ('files/openid.php');
require_once ('files/utils/topbarUtil.php');
?>
<html dir="<?php echo $dir ?>" lang="en">
    <head>
        <meta charset="utf-8">
        <title>Login &amp; Sign Up Page 1</title>
        <meta name="description" content="">
        <meta name="author" content="">
        <?php
         echo "<link rel='stylesheet' type='text/css' href='" . $rootDir ."files/css/registration.css' /> ";

        require_once("files/utils/includeCssAndJsFiles.php");
        ?>     
        <link rel='stylesheet' href='<?php echo $rootDir; ?>files/css/zocial.css' type='text/css' media='all'/>   
        <script src="ajax/libs/jquery/validator/dist/jquery.validate.js" type="text/javascript"></script>
        <script type='text/javascript'> 
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
                        email: gt.gettext("Please enter a valid email address")
                    }
                }); 
                $("#forgot-password-form").validate({
                    rules: {
                        email_pwd : {
                            required: true,
                            email: true
                        }
                    },
                    messages: {
                        email_pwd: gt.gettext("Please enter a valid email address")
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
                $('#termsofuse').each(function() {
                    var locale      = $.Storage.get('locale');      
                    if (locale != "he_IL")
                        var $dialog = $('<div dir="ltr"></div>');
                    else
                        var $dialog = $('<div dir="rtl"></div>');
                    var $link = $(this).one('click', function() {                      
                        $dialog                           
                        .load('termsOfUse.php')
                        .dialog({
                            title: "Terms of use",
                            width: 700,
                            close: function( event, ui ) {
                            }

                        }); 
                        $link.click(function() {
                            $dialog.dialog('open');
                            return false;
                        });
                        return false;                       
                    });                                           
                });                       
            });
 
            $(document).delegate('.switch', 'click', function(){

                var c = $(this).attr('data-switch');
                $('#sign-in-form').slideUp(300, function(){ $(this).addClass('hide'); });
                $('#forgot-password-form').slideUp(300, function(){ 
                    $(this).addClass('hide'); 
                });
                $('#'+c).slideDown(300, function(){
                    $(this).removeClass('hide');
                    $('input:first', this).focus();
                });
                c = null;
            });

        </script>

    </head>
    <body>
<?php
//setup some variables/arrays
$action = array();
$action['result'] = null;

$text = array();

//check if the form has been submitted
if (isset($_POST['signup'])) {
    $isTestUser = false;
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    //quick/simple validation
    if (empty($username)) {
        $action['result'] = 'error';
        array_push($text, 'You forgot your username');
    }
    if (empty($password)) {
        $action['result'] = 'error';
        array_push($text, 'You forgot your password');
    }
    if (empty($email)) {
        $action['result'] = 'error';
        array_push($text, 'You forgot your email');
    }
    //print_r($action);
    if ($action['result'] != 'error') {
        $password = md5($password);
        $m = new Mongo();
        $db = $m->turtleTestDb;
        $users = $db->users;

        //Query if email already exist and approved
        $queryEmail = array('email' => $email, "confirm" => true);
        $existEmail = $users->count($queryEmail);
        $queryUsername = array('username' => $username, "confirm" => true);
        $existUsername = $users->count($queryUsername);

        //String for checking Email and username validation
        $strEmailExist = _("Email is being used by a registered user");
        $strForgotPass = _("if you forgot your password please press reset password");
        $strUserNExist = _("Username is already exist in the system");
        $strChooseNewUN = _("please choose another username");

        if ($isTestUser) { //Case of testing we will insert to db
            addUserToDb($username, $password, $email, $users, $db);
        } else if ($existEmail > 0) { //Check if email already exist
            $action['result'] = 'error';
            array_push($text, $strEmailExist . " " . $strForgotPass);
        } else if ($existUsername > 0) { //Check if email already exist
            $action['result'] = 'error';
            array_push($text, $strUserNExist . " " . $strChooseNewUN);
        } else {
            addUserToDb($username, $password, $email, $users, $db);
        }
    }
    $action['text'] = $text;
}

function createOpenIdObject($identity, $returnUrl) {
    global $sitePath;
    $openid = new LightOpenID($sitePath);
    $openid->identity = $identity;
    $openid->required = array(
        'namePerson/first',
        'namePerson/last',
        'contact/email',
        'pref/language',
    );
    $openid->returnUrl = $sitePath . $returnUrl; // 'http://turtle.com/loginopen.php';
    return $openid;
}

function addUserToDb($username, $password, $email, $users, $db) {
    global $phpDirPath, $sitePath, $text, $action;
    $date = date('Y-m-d H:i:s');
    $userStructure = array("username" => $username, "password" => $password, "email" => $email,
        "confirm" => false, "date" => $date);
    $userResult = $users->insert($userStructure, array('safe' => true));
    $userid = $userStructure['_id'];
    if ($userResult) {
        //get the new user id
        //$userid = mysql_insert_id();
        $users = $db->users_waiting_approvment;
        //create a random key
        $key = $username . $email;
        $key = md5($key);
        //add confirm row
        //$confirm = mysql_query("INSERT INTO `confirm` VALUES(NULL,'$userid','$key','$email')");	
        $userStructure = array("userid" => $userid, "key" => $key, "email" => $email);
        $userConfirmResult = $users->insert($userStructure, array('safe' => true));

        //In case the user properly inserted into the database
        $strWelcomeMsg = _("Welcome to TurtleAcademy");
        $strResetMsg = _("TurtleAcademy password reset");
        if ($userConfirmResult) {
            //include the swift class
            include_once $phpDirPath . 'swift/swift_required.php';
            //put info into an array to send to the function
            $locale = $_SESSION['locale'];
            $info = array(
                'username' => $username,
                'email' => $email,
                'key' => $key,
                'locale' => $locale,
                'msgWelcome' => $strWelcomeMsg,
                'msgReset' => $strResetMsg);
            //send the email
            $templateType = "signup_template";
            if ($locale != "en_US")
                $templateType = $templateType . "_" . $locale;

            if (send_email($info, $sitePath, $templateType)) {
                $thanks = _("Thanks for signing up");
                $checkEmail = _("Please check your email for confirmation");
                $action['result'] = 'success';
                array_push($text, $thanks . ". " . $checkEmail . "!!");

                //header("location: files/registerok.php"); 
            } else {
                $action['result'] = 'error';
                array_push($text, 'Could not send confirm email');
            }
        } else {

            $action['result'] = 'error';
            //array_push($text,'Confirm row was not added to the database. Reason: ' . mysql_error());
            array_push($text, 'Confirm row was not added to the database. Reason: ');
        }
    }
}

if (isset($_POST['email_pwd'])) {
    //varifaction it's a mail will be done by js
    $email = $_POST['email_pwd'];
    //$password = md5($password);	
    $m = new Mongo();
    $db = $m->turtleTestDb;
    $users = $db->users;
    //Query if email already exist and approved
    $queryEmail = array('email' => $email, "confirm" => true);
    $existEmail = $users->count($queryEmail);
    if ($existEmail > 0) { //Check if email already exist then we will continue
        $curretnUser = $users->findOne($queryEmail);
        $password = $curretnUser['password'];
        $username = $curretnUser['username'];
        $userid = $curretnUser['_id'];
        $users = $db->users_remind_pass;
        $key = $username . $email;
        $key = md5($key);
        $userStructure = array("userid" => $userid, "key" => $key, "email" => $email);
        $userConfirmResult = $users->insert($userStructure, array('safe' => true));

        //String for Password reset
        $strContinueReset = _("Please check your email to continue with password reset");
        $strErrSendConfirmMail = _("Error while sending confirm Email");
        $strContactSupoort = _("please contact the TurtleAcademy support");
        //In case the user properly inserted into the database
        $strWelcomeMsg = _("Welcome to TurtleAcademy");
        $strResetMsg = _("TurtleAcademy password reset");
        if ($userConfirmResult) {
            //include the swift class
            include_once $phpDirPath . 'swift/swift_required.php';

            //put info into an array to send to the function
            $info = array(
                'username' => $username,
                'email' => $email,
                'key' => $key,
                'locale' => $locale,
                'msgWelcome' => $strWelcomeMsg,
                'msgReset' => $strResetMsg);
            //send the email
            if (send_email($info, $sitePath, "resetpass_template")) {
                $action['result'] = 'success';
                array_push($text, $strContinueReset);
            } else {
                $action['result'] = 'error';
                array_push($text, $strErrSendConfirmMail . " " . $strContactSupoort);
            }
        } else {

            $action['result'] = 'error';
            array_push($text, $strErrSendConfirmMail . " " . $strContactSupoort);
        }
    }
    $action['text'] = $text;
}
        //Printing the topbar menu
        topbarUtil::printTopBar("registration"); 
?>



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
                        <div class="clearfix" lang="<?php echo $dir ?>">
                            <label for="email_up" id="signUpEmailLbl"><?php echo _("Email"); ?></label>
                            <div class="input" lang="<?php echo $dir ?>">
                                <input id="email" name="email" size="30" type="text" class='xlarge'/>
                            </div>
                        </div>        
                        <div class="clearfix" lang="<?php echo $dir ?>">
                            <label for="username_up" id="signUpUserNameLbl"><?php echo _("Username"); ?></label>
                            <div class="input" lang="<?php echo $dir ?>">
                                <input id="username" name="username" size="30" type="text" class='xlarge'/>
                                </br>
                            </div>
                        </div>         
                        <div class="clearfix" lang="<?php echo $dir ?>">
                            <label for="pwd_up" id="signUpUserNameLPwdLbl"><?php echo _("Password"); ?></label>
                            <div class="input" lang="<?php echo $dir ?>">
                                <input id="password" name="password" size="30" type="password" class='xlarge'/>
                            </div>
                        </div>        
                        <div class='cleaner_h10'></div>           
                        <ul class="inputs-list">
                            <li>
                                <label class="checkCondition" lang="<?php echo $dir ?>">
                                    <input type="checkbox" name="terms_up" id='terms_up' value="yes" checked='true' />
                                    <span for='terms_up' id="signupAgreeToTerms"><?php echo _("Agree to"); ?> <a id="termsofuse" href='#'><?php echo _("Terms of Use"); ?></a></span>
                                </label>
                            </li>
                        </ul>       
                        <div class='cleaner_h10'></div>
                        <input type='submit' value='<?php echo _("Sign Up"); ?>&raquo;' id='signup' name='signup' class="btn primary"/>
                    </form>
                </div>    
                <div class="well span5">
                    <form class='form-stacked hide' id='forgot-password-form' method='post'> 
                        <h2><?php echo _("Forgot Password"); ?></h2>
                        <div class='cleaner_h20'></div>
                        <div class="clearfix" lang="<?php echo $dir ?>">
                            <label for="email_pwd" id="forgotEmail"><?php echo _("Email"); ?></label>
                            <div class="input" lang="<?php echo $dir ?>">
                                <input id="email_pwd" name="email_pwd" size="30" type="text"/>
                                <div class='cleaner_h10'></div> 
                                <span class='switch' data-switch='sign-in-form' id="neverMindSwitch"> <?php echo _("Never mind, I remember my password"); ?></span>
                            </div>
                        </div>           
                        <div class='cleaner_h10'></div>
                        <input type='submit' value='<?php echo _("Remind me"); ?>&raquo;' id='submit_pwd' name='submit_pwd' class="btn primary"/>
                    </form>
                    <form class='form-stacked' id='sign-in-form' action='log.php' method='post'>
                        <h2><?php echo _("Sign In"); ?></h2>
                        <?php
                        $err = "<span class='help-block'>";
                        if (isset($_SESSION['err_login_msg'])) {
                            foreach ($_SESSION['err_login_msg'] as $msg) { //Get each error
                                $err .= "<span class='label important'>" . $msg . "</span>"; //Write them to a variable
                            }
                        }
                        $err .= "</span>";
                        echo $err;
                        if (isset($_SESSION['err_login_msg']))
                            unset($_SESSION['err_login_msg']);
                        ?>
                        <div class='cleaner_h20'></div>           
                        <div class="clearfix" lang="<?php echo $dir ?>">
                            <label for="username" id="signInUserNameLbl"><?php echo _("Username"); ?></label>
                            <div class="input" lang="<?php echo $dir ?>">
                                <input id="username" name="username" size="30" type="text"/>
                            </div>
                        </div>
                        <input id="comefrom" name="comefrom" size="30" type="text" value="registration.php" style="display:none;"/>        
                        <div class="clearfix" lang="<?php echo $dir ?>">
                            <label for="password" id="signInPasswordLbl"><?php echo _("Password"); ?></label>
                            <div class="input" lang="<?php echo $dir ?>">
                                <input id="password" name="password" size="30" type="password"/>
                            </div>
                        </div>           
                        <ul class="inputs-list">
                            <li>
                                <label class="checkCondition" lang="<?php echo $dir ?>">
                                    <input type="checkbox" name="remember_checkbox" id='remember_checkbox' value="yes" checked='true' />
                                    <span for='remember_in' id='remember_span'><?php echo _("Remember me"); ?></span>
                                </label>
                            </li>
                        </ul>          
                        <div class='cleaner_h10'></div>
                        <input type='submit' value='<?php echo _("Sign In"); ?>&raquo;' id='submit_in' name='submit_in' class="btn primary"/>

                        <span class='switch' data-switch='forgot-password-form'><?php echo _("Forgot my password"); ?></span> </br></br></br>

                        <!--
                        <a href="<?php echo $googleid->authUrl() ?>" class="zocial google"><?php echo _("Sign In");
                        echo " ";
                        echo _("with google") ?></a>
                        </br></br>
                        <a href="<?php echo $yahooid->authUrl() ?>" class="zocial yahoo"><?php echo _("Sign In");
                        echo " ";
                        echo _("with Yahoo") ?></a>
                        --> 

                    </form>        
                    <form class='form-stacked' id='forgot-password-form' method='post'> 
                        <h2><?php echo _("Forgot Password"); ?></h2>
                        <div class='cleaner_h20'></div>
                        <div class="clearfix" lang="<?php echo $dir ?>">
                            <label for="email_pwd" id="forgotEmail"><?php echo _("Email"); ?></label>
                            <div class="input" lang="<?php echo $dir ?>">
                                <input id="email_pwd" name="email_pwd" size="30" type="text"/>
                                <div class='cleaner_h10'></div>
                                <span class='switch' data-switch='sign-in-form'> <?php echo _("Never mind, I remember my password"); ?></span>
                            </div>
                        </div>           
                        <div class='cleaner_h10'></div>
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
