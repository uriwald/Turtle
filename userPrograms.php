
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">  
    <?php
    if (session_id() == '')
        session_start();
    //If the user is not logged in yet redirect
    require_once("environment.php");
    $isPublicUserPage = false;
    if (isset($_GET['username']))
        $isPublicUserPage = true;
    $displayPage = true;
    
    require_once("localization.php");
    require_once("files/footer.php");
    require_once("files/cssUtils.php");
    require_once("files/utils/languageUtil.php");
    require_once('files/utils/topbarUtil.php');
    require_once('files/utils/badgesUtil.php');
    require_once('files/utils/userUtil.php');

    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        $displayUserName = $username;
    }
    if ($isPublicUserPage) {
        $username = $_GET['username'];
        $displayUserName = $username;
    } else {
        $displayUserName = "";
        if (isset($_SESSION['username'])) {
            $displayUserName = $_SESSION['username'];
            // update the user badgse
            badgesUtil :: updateUserBadges($displayUserName);
        }
    }
    ?>


<html dir="<?php echo $dir ?>" lang="<?php echo $lang ?>">
    <head>
        <meta charset="utf-8">
        <title> <?php $displayUserName ?></title>
        <meta name="description" content="">
        <meta name="author" content="">
        <?php
        require_once("files/utils/includeCssAndJsFiles.php");
        includeCssAndJsFiles::includePageFiles("users");
        ?>
    </head>
    <body>
        <?php
        //Will display the page only if user is register ,, if not will be redirected
        if ($displayPage) {
            //Printing the topbar menu
            topbarUtil::printTopBar("users");
            ?>
            <div class="container span16" id="mainContainer">
            <?php
            if ($isPublicUserPage) {
                ?>

                    <div> <h2> <?php echo $displayUserName . " Public Page"; ?></h2> </div>
                <?php }; //Close div condition ?>
                <div class='cleaner_h40'></div>

                <div class='row'>
                       
                    <div class='span16'id="usrLessonDiv" lang="<?php echo $lang ?>"> 

                        <h2><?php
                                  echo _("programs created by users");
                            ?>
                        </h2>
                        <table class='zebra-striped ads' id="my_lessons" lang="<?php echo $lang ?>">
                            <thead>
                                <tr>
                                    <th class='span4'><?php echo _("creator"); ?></th>
                                    <th class='span4'><?php echo _("program name"); ?></th>
                                    <th class='span4'><?php echo _("Date Created"); ?></th>
                                    <th class='span4'><?php echo _("Last updated"); ?></th>
                                    <th class='span4'><?php echo _("Actions"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            
                            $allPrograms = userUtil::findPublicPrograms();
                            foreach ($allPrograms as $program) {
                            ?>
                                <tr>
                                    <td>
                                        <a class='' href="<?php
                                            echo $rootDir . "users/profile/";
                                            echo $program['username'];
                                            ?>"> 
                                            <?php echo $program['username'];?>  
                                        </a>
                                    </td>
                                    <td><?php echo $program['programName'] ?></td>
                                    <td><?php echo $program['dateCreated'] ?></td>
                                    <td><?php echo $program['lastUpdated'] ?></td>
                                    <td>
                                        <a class='btn small info' href="<?php
                                            echo $rootDir . "users/programs/";
                                            echo $program['_id'];
                                            ?>">
                                            <?php
                                                echo _("View");
                       
                                            ?>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                            } // End of foreach loop
                            ?> 
                            </tbody>  
                        </table>
                    </div><!-- end of center content -->
                </div>
            <?php
            if (isset($footer))
                echo $footer;
            ?>
            </div>

            <script> 
                $(document).ready(function() {
                     selectLanguage("<?php echo $_SESSION['locale']; ?>" ,  "<?php echo $rootDir; ?>users/<?php if ($isPublicUserPage) echo "profile" . "/" . $username; ?>/", "users.php" ,"en" );                     
                 });
            </script>
    <?php
} // End of rull Checking for session.username exists
?>
    </body>
</html>
