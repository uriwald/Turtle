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
            includeCssAndJsFiles::includePageFiles("institute");
         echo "<link rel='stylesheet' href='../css/institute.css' type='text/css' media='all'/>";
         
        ?>     
                <link rel='stylesheet' href='<?php echo $rootDir; ?>files/css/zocial.css' type='text/css' media='all'/>   
 
        <script>
        $(document).ready(function(){
            $('#topbar').dropdown();
        });
        </script>
    </head>
    <body>
    <?php
    topbarUtil::printTopBar("institute");
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
                    $instituteStudents = userUtil::getInstitiuteUsersByInstitueAdminEmail($_SESSION['institute_email']);
                    foreach ($instituteStudents as $student) {
                        
                        ?>
                        <tr>
                            <td><?php echo $student['username']; ?></td>
                            <td><?php echo $student['date']; ?></td>
                        </tr>
                        <?php
                    } // End of foreach loop
                    ?> 
                </tbody>  
            </table>
            <p><a href="addInstituteUser.php"> <?php echo _("Back to add student page"); ?> </a></p>
            <p><a href='<?php echo $rootDir; ?>users.php'> <?php echo _("Back to my account"); ?> </a></p>
        </div><!-- end of center content -->
        <?php
            }
        ?>
    </body>