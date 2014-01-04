
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
    //Will be redirected only if is not log in and didn't try to get to public page
    if (!isset($_SESSION['username']) && (!$isPublicUserPage)) {
        $_SESSION['redirectBack'] = "users.php";
        header('refresh:3; url=' . $sitePath . "registration.php");
        $displayPage = false;
        echo "<center><h1 id='redirect'> You will be redirected in order to log in </h1></center>";
    }
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
    } else if ($isPublicUserPage) {
        $username = $_GET['username'];
        $displayUserName = $username;
    } else {
        $displayUserName = "";
    }

    if (isset($_SESSION['username'])) {
        $displayUserName = $_SESSION['username'];
        // update the user badgse
        badgesUtil :: updateUserBadges($displayUserName);
    }
    ?>


<html dir="<?php echo $dir ?>" lang="<?php echo $lang ?>">
    <head>
        <meta charset="utf-8">
        <title>Account 1</title>
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
                    <div class="well span4 sidebar" id="user_menu" lang="<?php echo $lang ?>">
                        <h4>
                <?php
                echo $displayUserName;
                ?>
                        </h4>
                        <div class='cleaner_h10'></div>
    <?php
    if (!$isPublicUserPage) {
        ?>
                            <p>
                                <a href='#'>
                                <?php
                                echo _("Account Settings");
                                echo "(";
                                echo _("coming soon");
                                echo ")";
                                ?>
                                </a>
                            </p>
        <?php
    }
    if (isset($_SESSION['institute'])) {
        ?>
                            <p>
                                <a href='<?php echo $rootDir; ?>files/institute/addInstituteUser.php?l=<?php echo $localeDomain; ?>'>
                            <?php echo _("Add a new user"); ?>
                                </a>
                            </p>
                            <?php
                        }
                        if (!$isPublicUserPage) {
                            ?>
                            <p>
                                <a href='<?php echo $rootDir; ?>files/newProgram.php?l=<?php echo $localeDomain; ?>'>
        <?php echo _("Create a new program"); ?>
                                </a>
                            </p>
                            <!--
                            <p>
                                <a href='lesson.php?l=<?php echo $localeDomain; ?>'>
                            <?php echo _("Add a new lesson"); ?>
                                </a>
                            </p>
                            -->
                                    <?php
                                }
                                ?>
                        <p> 
                        <?php
        
                        $m = new Mongo();
                        $db = $m->turtleTestDb;
                        $strcol = $db->messages;
                        $messagesRecieveQuery = array('sendto' => $username);
                        $messagesGeneral = array('sendto' => 'all');
                        $allMessages = array('$or' => array( array('sendto' => $username), array('sendto' => 'all')));
                        
                        $newMessagesQuery     = array ('sendto' => $username , 'read' => false);
                        $messageSentQuery = array('sendfrom' => $username);
                        //$messagesRecieve = $strcol->find($messagesRecieveQuery);
                        $messagesRecieve = $strcol->find($allMessages);
                        
                        $messagesSent = $strcol->findOne($messageSentQuery);
                        $msgRecieveCount = $strcol->count($messagesRecieveQuery);
                        $numOfNewMsg    = $strcol->count($newMessagesQuery);
                     
                        ?>
                            <a href='#myMessages' id="myMessageslink">
                                <?php 
                                    echo _("My Messages"); 
                                    if ($numOfNewMsg >0)
                                    {
                                ?>
                                <i class="icon-envelope innerIcon" lang="en"></i>
                                <?php 
                                    echo $numOfNewMsg; 
                                } // End if numofMsg >0

                        ?>
                            </a>
   
                        </p>
                        <p> 
                            <a href='#myProgress' id="myProgresslink">
                                
    <?php
    if ($isPublicUserPage)
        echo _("User progress");
    else
        echo _("My progress");
    ?>
                            </a>
                        </p>
                        <p> 
                            <a href='<?php echo $rootDir . "users/" . $displayUserName; ?>'>
                                <?php
                                if ($isPublicUserPage)
                                    echo _("User Public Profile");
                                else
                                    echo _("My Public Profile");
                                ?>
                            </a>
                        </p>
                        <p>
                            <a href='<?php echo $rootDir . "project/doc/" . $lang; ?>'>
                                <?php echo _("Help"); ?>
                            </a>
                        </p>
                    </div><!-- end of user_menu -->
                    <div class=" span10 tab-pane " id="myMessages" >
                        <h2>
                            My messages
                        </h2>   

                        <table>
                            <thead>
                                <tr>
                                    <th class='span2'><?php echo _("From"); ?></th>
                                    <th class='span2'><?php echo _("Date"); ?></th>
                                    <th class='span4'><?php echo _("Subject"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                        <?php

                        foreach ($messagesRecieve as $message) {
                            $class = '';
                            if ($message['read'])
                                $class = "read";
                            ?>
                                    <tr>
                                        <td> <?php echo $message['sendfrom'] ?></td>
                                        <td> <?php echo $message['date'] ?></td>
                                        <td> <a id ="<?php echo $message['_id']; ?>"  title ="<?php echo $message['subject']; ?>" class="openMessage <?php echo $class;?>"> <?php echo $message['subject'] ?> </a></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>    

                    <div class=" span10 tab-pane active" id="myProgress">
                        <h2>
    <?php
    if ($isPublicUserPage)
        echo _("User progress");
    else
        echo _("My progress");
    ?>  
                        </h2>
                        <div class='cleaner_h20'></div>
                        <!-- Display User badges--->
                        <div class="badges">
    <?php
    $badges = badgesUtil::getUserBadges($username);
    // Should use foreatch loop for all badges
    //echo $badges;
    $badgesArr = explode(",", $badges);
    if (in_array("1", $badgesArr)) {
        echo "<div class='badge' title='finish lesson number 1' >";
        echo "<p> Green shield </p>";
        echo "<img class='badgeImg' id='turtleimg' src='" . $sitePath . "/Images/badges/lightshield.jpg' />";
        echo "</div>";
    }
    if (in_array("2", $badgesArr)) {
        echo "<div class='badge' title='Finish the first 2 lessons' >";
        echo "<p> Brown shield </p>";
        echo "<img class='badgeImg' id='turtleimg' src='" . $sitePath . "/Images/badges/brownshield.jpg' />";
        echo "</div>";
    }
    if (in_array("3", $badgesArr)) {
        echo "<div class='badge' title='Familar with the Turtle World' >";
        echo "<p> Gold shield </p>";
        echo "<img class='badgeImg' id='turtleimg' src='" . $sitePath . "/Images/badges/goldenshield.jpg' />";
        echo "</div>";
    }
    ?>
                        </div> 

                    </div>
                    <div class='span16'id="usrLessonDiv" lang="<?php echo $lang ?>"> 

                        <h2><?php
                        if ($isPublicUserPage)
                            echo _("User Programs");
                        else
                            echo _("Your Programs");
    ?>
                        </h2>
                        <table class='zebra-striped ads' id="my_lessons" lang="<?php echo $lang ?>">
                            <thead>
                                <tr>
                                    <th class='span4'><?php echo _("Name"); ?></th>
                                    <th class='span4'><?php echo _("Date Created"); ?></th>
                                    <th class='span4'><?php echo _("Last updated"); ?></th>
                                    <th class='span4'><?php echo _("Actions"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $userPrograms = userUtil::findUserPrograms($username);
                            foreach ($userPrograms as $program) {
                                ?>
                                    <tr>
                                        <td><?php echo $program['programName'] ?></td>
                                        <td><?php echo $program['dateCreated'] ?></td>
                                        <td><?php echo $program['lastUpdated'] ?></td>
                                        <td>
                                            <!--<div class='btn small success disabled'>Renewed</div> 
                                            ?programid=527115cea51ffb9d25000000&username=lucio-->
                                            <a class='btn small info' href="<?php
                        if ($isPublicUserPage)
                            echo $rootDir . "users/programs/";
                        else
                            echo $rootDir . "files/updateProgram.php?programid=";
                        echo $program['_id'];
                        if (!$isPublicUserPage) {
                            echo"&username=";
                            echo $username;
                        }
                        ?> 

                                               ">  <?php
                        if ($isPublicUserPage)
                            echo _("View");
                        else
                            echo _("Edit");
                        ?>
                                            </a>
                                            <!--<div class='btn small danger'>Remove</div> -->
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
                  
                  
                    $('.openMessage').each(function() {
                        var id = $(this).attr('id');
                        var title = $(this).attr('title');
                        var $dialog = $('<div></div>');
                        var $link = $(this).live('click', function() {
                            var locale      = $.Storage.get('locale');
                      
                            if (window.isLessonSaved == false)
                                alert(gt.gettext("You must save the lesson before show lesson"));
                            else
                            {  
                                $dialog                           
                                .load('message.php?id=' + id ) /* When opening the message will sign it as read message*/
                                .dialog({
                                    title: $link.attr('title'),
                                    width: 700 ,
                                    height : 300
                                }); 
                                $link.click(function() {
                                    $dialog.dialog('open');
                                    dialogCreatedOnce = true;
                                    return false;
                                });
                                return false;
                            }
                        });                                           
                    });
                    
                    selectLanguage("<?php echo $_SESSION['locale']; ?>" ,  "<?php echo $rootDir; ?>users/", "users.php" ,"en" ); 
                    $('#myMessages').hide();
                    $('#myMessageslink').click(function() {
                        $('#myProgress').hide();
                        $('#myMessages').show();
                    });
                    $('#myProgresslink').click(function() {
                        $('#myMessages').hide();
                        $('#myProgress').show();
                    
                    });
                
                        
                });
            </script>
    <?php
} // End of rull Checking for session.username exists
?>
    </body>
</html>
