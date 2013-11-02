
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">  
  <?php
    if (session_id() == '')
        session_start();
    //If the user is not logged in yet redirect
    require_once("environment.php");
    if (!isset($_SESSION['username']))
    {
        $_SESSION['redirectBack'] = "users.php";
      //  header('Location: '.$sitePath . "registration.php");
         header('refresh:3; url='.$sitePath . "registration.php");
        echo "<center><h1 id='redirect'> You will be redirected in order to log in </h1></center>";
    }
    
    require_once("localization.php");
    require_once("files/footer.php");
    require_once("files/cssUtils.php");
    require_once("files/utils/languageUtil.php");
    require_once('files/utils/topbarUtil.php');
    require_once('files/utils/badgesUtil.php'); 
    require_once('files/utils/userUtil.php');
    if (isset ($_SESSION['username']))
    {
        $displayUserName = $_SESSION['username'];   
        // update the user badgse
        badgesUtil :: updateUserBadges($displayUserName);
        // get the new user badges

        $lessonsNamesArray = Array("", "Logo's turtle", "Controlling the Turtle and Pen", "Turtle world", "The turtle answer", "Cool labels", "Loops",
            "Polygons", "The pen width", "The turtle is learning", "Colors and Printing", "Variables", "Procedure",
            "The for loop", "Recursion", "Lists", "Accessing the list");
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
        echo "<link rel='stylesheet' type='text/css' href='".$rootDir."files/css/users.css'/> "; 
        echo "<link rel='stylesheet' type='text/css' href='".$rootDir."files/css/badges.css'/> "; 
        echo "<link rel='stylesheet' type='text/css' href='".$rootDir."files/css/topbar.css'/> "; 
        ?>

    </head>
    <body>
        <?php
        //Will display the page only if user is register ,, if not will be redirected
            if (isset($_SESSION['username']))
            {
            //Printing the topbar menu
            topbarUtil::printTopBar("users"); 
            
        ?>
        <div class="container span16" id="mainContainer">
            <div class='cleaner_h40'></div>

            <div class='row'>
                <div class="well span4 sidebar" id="user_menu" lang="<?php echo $lang ?>">
                    <h4>
                    <?php
                        echo $displayUserName;
                    ?>
                    </h4>
                    <div class='cleaner_h10'></div>
                    <p>
                        <a href='#'>
                        <?php echo _("Account Settings");
                            echo "(";echo _("coming soon");echo ")"; 
                        ?>
                        </a>
                    </p>
                    <?php
                    if (isset($_SESSION['institute']))
                    {
                    ?>
                        <p>
                            <a href='<?php echo $rootDir; ?>files/institute/addInstituteUser.php?l=<?php echo $locale; ?>'>
                                <?php echo _("Add a new user"); ?>
                            </a>
                        </p>
                    <?php
                    }
                    ?>
                    <p>
                        <a href='<?php echo $rootDir; ?>files/newProgram.php?l=<?php echo $locale; ?>'>
                            <?php echo _("Create a new program"); ?>
                        </a>
                    </p>
                    <p>
                        <a href='lesson.php?l=<?php echo $locale; ?>'>
                            <?php echo _("Add a new lesson"); ?>
                        </a>
                    </p>
                    <p> 
                        <a href='#myProgress'>
                            <?php echo _("My progress"); ?>
                        </a>
                    </p>
                    <p>
                        <a href='#'>
                            <?php echo _("Help"); ?>
                        </a>
                    </p>
                </div><!-- end of user_menu -->
                <div class=" span10 tab-pane active" id="myProgress">
                    <h2>
                        <?php echo _("My progress");?>  
                    </h2>
                    <div class='cleaner_h20'></div>
                    <!-- Display User badges--->
                    <div class="badges">
                    <?php
                        
                        $badges = badgesUtil::getUserBadges($_SESSION['username']);
                        // Should use foreatch loop for all badges
                        //echo $badges;
                        $badgesArr           =   explode(",",$badges);
                        if (in_array("1", $badgesArr)) 
                        { 
                            echo "<div class='badge' title='finish lesson number 1' >";                       
                                echo "<img class='badgeImg' id='turtleimg' src='".$sitePath ."/Images/badges/lightshield.jpg' />";
                            echo "</div>";
                        }
                        if (in_array("2", $badgesArr)) 
                        { 
                            echo "<div class='badge' title='Finish the first 2 lessons' >";                       
                                echo "<p> Brown shield </p>";
                                echo "<img class='badgeImg' id='turtleimg' src='".$sitePath ."/Images/badges/brownshield.jpg' />";
                            echo "</div>";
                        }
                        if (in_array("3", $badgesArr)) 
                        { 
                            echo "<div class='badge' title='Familar with the Turtle World' >";                       
                                echo "<p> Gold shield </p>";
                                echo "<img class='badgeImg' id='turtleimg' src='".$sitePath ."/Images/badges/goldenshield.jpg' />";
                            echo "</div>";
                        }

                        /*
                        echo "<div class='badge' title='completed recurssion' >";
                        echo "<p> recursive turtle </p>";
                        echo "<img class='badgeImg' id='turtleimg' src='/Images/badges/oriented.png' />";
                        echo "</div>";
                        
                        
                        echo "<div class='badge' title='Completed first 8 lessons' >";
                        echo "<p> fighter turtle </p>";
                        echo "<img class='badgeImg' id='turtleimg' src='/Images/badges/oriented.png' />";
                         * 
                         
                        echo "</div>";
                         */
                         
                    ?>
                    </div> 
                    
                    <!--
                    <p>
                        <?php
                        echo _("Steps that I have done :) ");
                        if (isset($_SESSION['username'])) {
                            $username = $_SESSION['username'];
                            $m = new Mongo();
                            $db = $m->turtleTestDb;
                            $userProgress = $db->user_progress;
                            $numberOfLessons = 20;
                            //check if the key is in the database
                            //$check_key = mysql_query("SELECT * FROM `confirm` WHERE `email` = '$email' AND `key` = '$key' LIMIT 1") or die(mysql_error());
                            $userQuery = array('username' => $username);
                            $check_key = $userProgress->findOne($userQuery);
                            $resultcount = $userProgress->count($userQuery);
                            if ($resultcount != 0) {
                                $UserProgressData = $check_key['stepCompleted'];
                                $steps = explode(",", $UserProgressData);
                                $numOfSteps = count($steps);
                                $numOfSteps = $numOfSteps - 1;
                                echo " So far you have " . $numOfSteps . " " . "Points " . "</br>";
                                $NumberOfStepsDoneInlesson = array_fill(0, $numberOfLessons, 0);
                                $lessonNumber = 0;
                                for ($i = 0; $i <= $numOfSteps; $i++) {
                                    //echo $steps[$i];
                                    if ($steps[$i] != "" && $steps[$i] != null) {


                                        if (strlen($steps[$i]) == 6) {
                                            //echo "equal 6";
                                            $lessonNumber = substr($steps[$i], 2, 1);
                                        } else {
                                            //echo "equal" . strlen($steps[$i]);
                                            $lessonNumber = substr($steps[$i], 2, 2);
                                        }
                                        //echo "**lesson number is " . $lessonNumber . "";  // bcd 
                                        //$NumberOfStepsDoneInlesson[$lessonNumber]++;
                                        //echo " THE STEP IS " . $steps[$i] . "END OF STEP";
                                    }
                                }
                                $count = 0;
                                $numStepsInLesson = 10;
                                //print_r($NumberOfStepsDoneInlesson);

                                for ($i = 0; $i < $numberOfLessons; $i++) {
                                    if ($NumberOfStepsDoneInlesson[$i] > 0) {
                                        echo "<b>" . "At Lesson  '" . $lessonsNamesArray[$i] . "' you have done" . " " . $NumberOfStepsDoneInlesson[$i] . " " . " steps so far which are" . ": </br></b>";
                                        for ($j = 0; $j < $NumberOfStepsDoneInlesson[$i]; $j++) {
                                            if ($steps[$count] != null && $steps[$count] != "") {
                                                if ($i < 10)
                                                    echo substr($steps[$count], 4, 1) . "  ";
                                                else
                                                    echo substr($steps[$count], 5, 1) . "  ";
                                                $count++;
                                            }
                                        }
                                        echo "</br>";
                                    }
                                }
                            }
                            else {  //No progress was detected by user
                                echo " No Pregress was made yet";
                            }
                        }
                        ?>
                    </p>    
                    -->
                </div>
                <div class='span16'id="usrLessonDiv" lang="<?php echo $lang ?>"> 
                    <h2><?php echo _("Your Programs"); ?></h2>
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
                                        <a class='btn small info' href="<?php echo $rootDir . "files/updateProgram.php?programid=";
                                            echo $program['_id'] . "&username=";
                                            echo $username;
                                        ?> 

                                           ">  <?php echo _("Edit"); ?></a>
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
            selectLanguage("<?php echo $_SESSION['locale']; ?>" ,  "<?php echo $rootDir; ?>users/", "users.php" ,"en" ); 
        });
    </script>
        <?php
            } // End of rull Checking for session.username exists
        ?>
    </body>
</html>
