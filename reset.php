<!DOCTYPE html>
<?php
if (session_id() == '')
    session_start();
//$fullPath    =   "files/bootstrap/twitter-bootstrap-sample-page-layouts-master/";  
$phpDirPath = "files/registration/inc/php/";
$inc_dir_path = "files/registration/inc/";
//$relPath    =   "files/bootstrap/twitter-bootstrap-sample-page-layouts-master/";
$ddPath = "files/test/dd/";
$jqueryui = "ajax/libs/jqueryui/1.10.0/";
include_once $phpDirPath . 'config.php';
include_once $phpDirPath . 'functions.php';
require_once ('environment.php');
require_once ("localization.php");
require_once ("files/cssUtils.php");
$action = array();
$action['result'] = null;
 
if (isset($_GET['l'])) {
    $locale = $_GET['l'];
    $_SESSION['locale'] = $locale;
} else if (!isset($_SESSION['locale'])) {
    $locale = "en_US";
} else {
    $locale = $_SESSION['locale'];
}
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Login &amp; Sign Up Page 1</title>
        <meta name="description" content="">
        <meta name="author" content="">
<?php
$file_path = "locale/" . $locale . "/LC_MESSAGES/messages.po";
$po_file = "<link   rel='gettext' type='application/x-po' href='locale/" . $locale . "/LC_MESSAGES/messages.po'" . " />";
if (file_exists($file_path))
    echo $po_file;
if ($locale == "he_IL")
    echo "<link rel='stylesheet' type='text/css' href='files/css/registration_rtl.css' /> ";
include_once("files/inc/dropdowndef.php");
include_once("files/inc/boostrapdef.php");
include_once("files/inc/jquerydef.php");
?>     
        <script  type="text/javascript" src="<?php echo $jqueryui . 'js/jquery-ui-1.10.0.custom.js' ?>"></script> <!--- equal to googleapis -->
        <link rel='stylesheet' href='<?php echo $jqueryui . 'css/ui-lightness/jquery-ui-1.10.0.custom.css' ?>' type='text/css' media='all'/> 
        <script type="application/javascript" src="files/logo.js"></script> <!-- Logo interpreter -->
        <script type="application/javascript" src="files/turtle.js"></script> <!-- Canvas turtle -->
        <link rel='stylesheet' href='files/css/topbar.css' type='text/css' media='all'/>
        <?php
        cssUtils::loadcss($locale, $root_dir . "files/css/topbar");
        $file_path = "locale/" . $locale . "/LC_MESSAGES/messages.po";
        $po_file = "<link   rel='gettext' type='application/x-po' href='locale/" . $locale . "/LC_MESSAGES/messages.po'" . " />";
        if (file_exists($file_path))
            echo $po_file;
        ?>        
        <script type="text/javascript">
            var locale = "<?php echo $locale; ?>";
        </script>
        <script type="application/javascript" src="files/Gettext.js"></script> <!-- Using JS GetText -->
        <link rel='stylesheet' href='./files/css/interface.css' type='text/css' media='all'/> 
        <link rel='stylesheet' href='./files/css/footer.css' type='text/css' media='all'/> 
        <script src="ajax/libs/jquery/validator/dist/jquery.validate.js" type="text/javascript"></script>
        <script type='text/javascript'> 
            //$.validator.setDefaults({
            //        submitHandler: function() { alert("submitted!"); }
            //});
            $(document).ready(function(){
                var gt = new Gettext({'domain' : 'messages'});
                $('#topbar').dropdown();
                $('#username_in').focus();
            
                $("#reset-pass-form").validate({
                    rules: {
                        password: {
                            required: true,
                            minlength: 5
                        },
                        retypepassword: {
                            required: true,
                            minlength: 5,
                            equalTo: "#password"
                        }
                    },
                    messages: {
                        password: {
                            required: gt.gettext("Please enter your username"), 
                            minlength: gt.gettext("Your username must contain at least 4 characters")
                        },
                        retypepassword: {
                            required    : gt.gettext("Please enter your password"),
                            minlength   : gt.gettext("Your password must contain at least 5 characters"),
                            equalTo     : gt.gettext("password and retype password should be the same")  
                        }
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
                $('#forgot-password-form').slideUp(300, function(){ $(this).addClass('hide'); });
                $('#'+c).slideDown(300, function(){
                    $(this).removeClass('hide');
                    $('input:first', this).focus();
                });
                c = null;
            });

        </script>

        <!-- Le styles 
        <link href="<?php echo $fullPath . 'styles/bootstrap.min.css'; ?>" rel="stylesheet">-->
        <style type="text/css">

            .switch{
                display:inline-block;
                cursor:pointer;
            }
        </style>
    </head>
    <body> 
        <!-- Here I should put the varification code -->
<?php
//Handling case of submit
if (isset($_POST['password'])) {
    //1. Need to update user with the new password
    $m = new Mongo();
    $db = $m->turtleTestDb;
    $usersRemindPass = $db->users_remind_pass;
    $users = $db->users;
    $email = $_GET['email'];
    $key = $_GET['key'];
    $userQuery = array('email' => $email, 'key' => $key);
    $check_key = $usersRemindPass->findOne($userQuery);
    $uesrid = $check_key['userid'];
    $confirmid = $check_key['_id'];
    
    $the_object_id = new MongoId($uesrid);
    $criteria = $users->findOne(array("_id" => $the_object_id));
     
    $pass   =   md5($_POST['password']);
    $criteria_update = $criteria;
    $criteria_update['password'] = $pass;
    $update_users = $users->update($criteria, $criteria_update);
    //2. Need to remove user from user_remind_password 
    $result = $usersRemindPass->remove(array('email' => $email), array("safe" => true));
    echo "Congratulation you have change yoru password succeessfully." ." ";
    echo "Please <a href='registration.php'> Login </a> using your new password";
}
// Loading the retype password forem     
$istest = false;
$showResetForm = false;
if (empty($_GET['email']) || empty($_GET['key'])) {
    if ($istest) {
        $action['result'] = 'success';
        $action['text'] = "User has been confirmed. Thank-You! please <a href='" . $root_dir . "registration.php'>" . _('login') . "</a>";
        ?> 
                <?php
            } else {
                $action['result'] = 'error';
                $action['text'] = 'We are missing email address or generated key. Please double check your email.';
            }
        }
        if ($action['result'] != 'error' && !$istest) {
            $m = new Mongo();
            $db = $m->turtleTestDb;
            $usersremind = $db->users_remind_pass;
            $users = $db->users;
            //cleanup the variables
            $email = $_GET['email'];
            $key = $_GET['key'];

            //check if the key is in the database
            //$check_key = mysql_query("SELECT * FROM `confirm` WHERE `email` = '$email' AND `key` = '$key' LIMIT 1") or die(mysql_error());
            $userQuery = array('email' => $email, 'key' => $key);
            $check_key = $usersremind->findOne($userQuery);
            $resultcount = $usersremind->count($userQuery);

            //$uesrid; 
            //foreach ($check_key as $doc) {
            //    $uesrid = $doc['userid'];
            // }
            $uesrid = $check_key['userid'];
            $remindid = $check_key['_id'];
            $confirm_id_mongo = new MongoId($remindid);
            if ($resultcount != 0) {
                $showResetForm = true;
            }
        }

        $class = ($locale == "he_IL" ? "pull-right" : "pull-left");
        $login = ($locale != "he_IL" ? "pull-right" : "pull-left");
        //php varification code
        if ($showResetForm) {
            ?>
            <div class="topbar" id="topbarMainDiv"> 
                <div class="fill" id="topbarfill">
                    <div class="container span13" id="topbarContainer"> 
                        <img class="brand" id="turtleimg" src="files/turtles.png" alt="צב במשקפיים">

                        <ul class="nav" id="turtleHeaderUl"> 
                            <li><a href="<?php echo $root_dir; ?>index.php" style="color:gray;" ><?php echo _("TurtleAcademy"); ?></a></li> 
                            <!--<li class="active"><a href="index.html"><?php echo _("Sample"); ?></a></li> -->
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
                        if (isset($_SESSION['username'])) {
                            ?>                       
                                    <!--  <p class="pull-right">Hello <a href="#"> -->
                            <nav class="<?php echo $login ?>" style="width:200px;" id="turtleHeaderLoggedUser">
                                <ul class="nav nav-pills <?php echo $login ?>" id="loggedUserUl">

                                    <li style="padding: 10px 10px 11px;"> <?php echo _("Hello"); ?></li>
                                    <li class="cc-button-group btn-group"> 
                                        <a class="dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" style="color:#ffffff; background-color: rgba(0, 0, 0, 0.5);" >
                            <?php
                            echo $_SESSION['username'];
                            ?>
                                            <b class="caret"></b>
                                        </a>
                                        <ul class="dropdown-menu" id="ddmenu"role="menu" aria-labelledby="dLabel">
                                            <li><a tabindex="-1" href="/docs"   class="innerLink" id="help-nav"><?php echo _("My account"); ?></a></li>
                                            <li><a tabindex="-1" href="/docs" class="innerLink" id="hel-nav"><?php echo _("Help"); ?></a></li>
                                            <li><a href="logout.php" class="innerLink"><?php echo _("Log out"); ?></a></li>
                                        </ul>


                                    </li>
                                </ul> 
                            </nav>                                                                     
                            </a>

        <?php
    } else {
        
    }
    ?>
                    </div>
                </div> <!-- Ending fill barf -->
            </div> <!-- Ending top bar -->


            <div class="container">
                <div class='row'>
                    <div class="well span5">
                        <form class='form-stacked' id='reset-pass-form' action='' method='post'>
                            <h2><?php echo _("Reset your password"); ?></h2>
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
                            <div class="clearfix">
                                <label for="password" id="signInUserNameLbl"><?php echo _("Password"); ?></label>
                                <div class="input">
                                    <input id="password" name="password" size="30" type="password"/>

                                </div>
                            </div>
                            <input id="comefrom" name="comefrom" size="30" type="text" value="registration.php" style="display:none;"/>        
                            <div class="clearfix">
                                <label for="retypepassword" id="signInPasswordLbl"><?php echo _("Retype Password"); ?></label>
                                <div class="input">
                                    <input id="retypepassword" name="retypepassword" size="30" type="password"/>

                                </div>
                            </div>                  
                            <div class='cleaner_h20'></div>
                            <input type='submit' value='<?php echo _("Reset"); ?>&raquo;' id='reset' name='reset' class="btn primary"/>
                        </form>        
                    </div>
                </div>
                <div class='cleaner'></div>

                <footer style='text-align:center;'>
                    <p>&copy; <?php echo _("TurtleAcademy"); ?></p>
                </footer>

            </div> <!-- /c
          </body>   
        
        
            <?php echo show_errors($action); ?>
        
            <?php
            include $inc_dir_path . 'elements/footer.php';
        } // End of showing form
        ?>