<?php
if (session_id() == '')
    session_start();
$phpDirPath = "../registration/inc/php/";
include_once $phpDirPath . 'config.php';
include_once $phpDirPath . 'functions.php';
require_once ('../../environment.php');
require_once ("../../localization.php");
require_once ('../utils/topbarUtil.php');
require_once ('../openid.php');
require_once ('../utils/userUtil.php');
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
         echo "<link rel='stylesheet' href='../css/institute.css' type='text/css' media='all'/>";
         
        ?>     
                <link rel='stylesheet' href='<?php echo $root_dir; ?>files/css/zocial.css' type='text/css' media='all'/>   
 
        <script>
        $(document).ready(function(){
            $('#topbar').dropdown();
        });
        </script>
    </head>
    <body>
    <?php
    topbarUtil::print_topbar("institute");
    if (!isset($_SESSION['institute_email']))
        {
            echo " You don't have institute admin permission Please contact site administrator" ;
        }
        else
        {
    ?>    
       <div class='span16'id="usrLessonDiv" lang="<?php echo $lang ?>">          
            <h1><?php echo $_SESSION['institute_name'];echo " ";echo _("Student List"); ?></h1>
            <h3><p> <?php echo $_SESSION['institute_description']; ?></p></h3>
            <table class='zebra-striped ads' id="my_lessons" lang="<?php echo $lang ?>">
                <thead>
                    <tr>
                        <th class='span4'><?php echo _("Username"); ?></th>
                        <th class='span4'><?php echo _("Join date"); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $instituteStudents = userUtil::get_institiute_users_by_institue_admin_email($_SESSION['institute_email']);
                    foreach ($instituteStudents as $student) {
                        
                        ?>
                        <tr>
                            <td>
                            <a class='' href="<?php
                                            echo $root_dir . "users/profile/";
                                            $username    = $student['username'];
                                            echo $username; 
                                            ?>"> 
                                            <?php
                                                echo $username;
                                            ?>  
                                        </a>
                            </td>
                            <td><?php if (isset($student['date'])) echo $student['date']; ?></td>
                        </tr>
                        <?php
                    } // End of foreach loop
                    ?> 
                </tbody>  
            </table>
            <p><a href="addInstituteUser.php"> <?php echo _("Back to add student page"); ?> </a></p>
            <p><a href='<?php echo $root_dir; ?>users.php'> <?php echo _("Back to my account"); ?> </a></p>
        </div><!-- end of center content -->
        <?php
            }
        ?>
    </body>