<!DOCTYPE html>
<?php
if (session_id() == '')
    session_start();
$phpDirPath = "../registration/inc/php/";
include_once $phpDirPath . 'config.php';
include_once $phpDirPath . 'functions.php';
require_once ('../../environment.php');
require_once ("../../localization.php"); 
require_once ("../cssUtils.php");
require_once ('../utils/topbarUtil.php');
?>
<html dir="<?php echo $dir ?>" lang="en">
    <head>
        <meta charset="utf-8">
        <title>Add Student</title>
        <meta name="description" content="">
        <meta name="author" content="">
        <?php

        require_once("../utils/includeCssAndJsFiles.php");
        includeCssAndJsFiles::include_all_page_files("institute");
        ?>     
        <script src="<?php echo $root_dir; ?>ajax/libs/jquery/validator/dist/jquery.validate.js" type="text/javascript"></script>
        <script type='text/javascript'> 
            $(document).ready(function(){
                var gt = new Gettext({'domain' : 'messages'});
                $('#topbar').dropdown();
                $('#username_in').focus();
                
                $("#sign-up-new-student-form").validate({
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
                        },
                        email: gt.gettext("Please enter a valid email address")
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
                $('#sign-up-new-student-form').slideUp(300, function(){ $(this).addClass('hide'); });
                $('#add-existing-user-form').slideUp(300, function(){ 
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
function addUserToDb($username, $password, $users, $db) {
    $date = date('Y-m-d H:i:s');
    $userStructure = array("username" => $username, "password" => $password,"badges" => "", "email" => "",
        "confirm" => true, "institute_email" => $_SESSION['institute_email'] , "date" => $date);
    $userResult = $users->insert($userStructure, array('safe' => true));
}
 if (!isset($_SESSION['institute_email']))
 {
     echo " You don't have institute admin permission Please contact site administrator" ;
 } 
 else
 {
//Strings for Password reset
    $strContactSupoort = _("please contact the TurtleAcademy support");
//In case the user properly inserted into the database
    $strWelcomeMsg   = _("Welcome to TurtleAcademy");
//String for checking Email and username validation

    $strUserNExist  = _("Username is already exist in the system");
    $strChooseNewUN = _("please choose another username");

//setup some variables/arrays
    $action = array();
    $action['result'] = null;
    $text = array();

    //If a new user is want to signup
    if (isset($_POST['signup'])) {
        $isTestUser = false;
        $username = $_POST['username'];
        $password = $_POST['password'];
        //quick/simple validation
        if (empty($username)) {
            $action['result'] = 'error';
            array_push($text, 'You forgot your username');
        }
        if (empty($password)) {
            $action['result'] = 'error';
            array_push($text, 'You forgot your password');
        }

        if ($action['result'] != 'error') {
            $password = md5($password);
            $m = new Mongo();
            $db = $m->turtleTestDb; 
            $users = $db->users;

            //Check if username is already taken
            $queryUsername = array('username' => $username);
            $existUsername = $users->count($queryUsername);


            if ($isTestUser) { //Case of testing we will insert to db
                addUserToDb($username, $password, $users, $db);
            } else if ($existUsername > 0) { //Check if email already exist
                $action['result'] = 'error';
                array_push($text, $strUserNExist . " " . $strChooseNewUN);
            } else {
                addUserToDb($username, $password, $users, $db);
                $action['result'] = 'info';
                array_push($text, "New User - " . $username . " has been added" );
            }
        }
        $action['text'] = $text;
    }
    if (isset($_POST['reg_exist_user']))
    {
    //setup some variables/arrays
        $action = array();
        $action['result'] = null;
        $text = array();
        
        $email = $_POST['email'];
        $m = new Mongo();
        $db = $m->turtleTestDb; 
        $users = $db->users;
        //Check if the user exists
        $queryEmail = array('email' => $email);
        $existEmail = $users->count($queryEmail);
        if ($existEmail == 1)
        {
            $user = $users->findone($queryEmail);
            $cursor = $user;
            $cursor["institute_email"] = $_SESSION['institute_email']  ;
            $users->update($user,$cursor);
            $action['result'] = 'info';
            array_push($text, "Existing User - " . $email . " has been updated" );
        }
        else{
            $action['result'] = 'error';
            array_push($text, 'Problem with email address');
        }
         $action['text'] = $text;

    }
        //Printing the topbar menu
        topbarUtil::print_topbar("registration");
        ?>



        <div class="container">
            <div class='row'>
                <!-- Main hero unit for a primary marketing message or call to action -->
                <div class="well span6 offset2">
                    <form class='form-stacked' id='sign-up-new-student-form' method="post" action="">
                        <h2><?php echo _("Hello"); echo " " ; echo $_SESSION['institute_name']; ?></h2>
                        <h2><?php echo _("Add Student"); ?></h2>
                        <?php
                        echo show_errors($action);
                        ?>     
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
                        <input type='submit' value='<?php echo _("Add student"); ?>&raquo;' id='signup' name='signup' class="btn primary"/>
                        <span class='switch' data-switch='add-existing-user-form'><?php echo _("Add existing User"); ?></span>
                        <div class="cleaner_h10"></div>
                        <div id="view_student_link">
                            <a href="viewStudentList.php"> <?php echo _("View student List"); ?> </a> 
                        </div>
                        <div class="cleaner_h10"></div>
                        <div id="view_student_link">
                            <a href="userPrograms.php"> <?php echo _("View student programs"); ?> </a> 
                        </div>
                        <div class="cleaner_h10"></div>
                        <div id="view_student_link">
                            <a href="userClassPrograms.php"> <?php echo _("Let student watch class programs"); ?> </a> 
                        </div>
                    </form>
                    <form class='form-stacked hide' id='add-existing-user-form' method='post'> 
                        <h2><?php echo _("Add existing student"); ?></h2>
                        <div class='cleaner_h20'></div>
                        <div class="clearfix" lang="<?php echo $dir ?>">
                            <label for="email" id="forgotEmail"><?php echo _("Email"); ?></label>
                            <div class="input" lang="<?php echo $dir ?>">
                                <input id="email" name="email" size="30" type="text"/>
                                <div class='cleaner_h10'></div> 
                                <span class='switch' data-switch='sign-up-new-student-form' id="neverMindSwitch"> <?php echo _("Back to add non existing user"); ?></span>
                            </div>
                        </div>           
                        <div class='cleaner_h10'></div>
                        <input type='submit' value='<?php echo _("Add to students"); ?>&raquo;' id='reg_exist_user' name='reg_exist_user' class="btn primary"/>
                    </form>
                </div>    
              
            </div>
            <div class='row span12 offset120'>
                <p id='contact_us'>
                    <?php echo _("Having some problems to register");echo "? " ;echo _("please"); ?>
                    <a href="mailto:support@turtleacademy.com" target="_blank"> <?php echo _("Contact Us"); ?> </a>
                </p> 
            </div> 
            <div class='cleaner'></div>

            <footer style='text-align:center;'>
                <p>&copy; <?php echo _("TurtleAcademy"); ?></p>
                 <p><a href='<?php echo $root_dir; ?>users.php'> <?php echo _("Back to my account"); ?> </a></p>
            </footer>

        </div> <!-- /container -->

    </body>
</html>

<?php
 } // Ending else condition if enabling only institute admin to add users
?> 