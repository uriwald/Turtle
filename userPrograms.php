
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

            <script> 
                $(document).ready(function() {
                     selectLanguage("<?php echo $_SESSION['locale']; ?>" ,  "<?php echo $rootDir; ?>users/<?php if ($isPublicUserPage) echo "profile" . "/" . $username; ?>/", "users.php" ,"en" );                     
                 });
                 function do_logo(id ,cmd) {
                $('#'+id).css('width', '50px').css('height', '50px').append('<canvas id="'+id+'c" width="50" height="50" style="position: absolute; z-index: 0;"></canvas>' +
                    '<canvas id="'+id+'t" width="50" height="50" style="position: absolute; z-index: 1;"></canvas>');
                var canvas_element2 = document.getElementById(id+"c");
                var turtle_element2 = document.getElementById(id+"t");
                var turtle2 = new CanvasTurtle(
                canvas_element2.getContext('2d'),
                turtle_element2.getContext('2d'),
                canvas_element2.width, canvas_element2.height);
                var rate = 0.1;
                g_logo2 = new LogoInterpreter(turtle2, null );
                g_logo2.setRatio(rate);
                g_logo2.run(cmd);
            } 
            </script>
<html dir="<?php echo $dir ?>" lang="<?php echo $lang ?>">
    <head>
        <meta charset="utf-8">
        <title> <?php $displayUserName ?></title>
        <meta name="description" content="">
        <meta name="author" content="">
        <?php
        require_once("files/utils/includeCssAndJsFiles.php");
        includeCssAndJsFiles::includePageFiles("users");
        echo "<link rel='stylesheet' href='".$rootDir."files/css/pagination.css' type='text/css' media='all'/>"; 
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
                                    <th class='span1'><?php echo _("num"); ?></th>
                                    <th class='span1'><?php echo _("pic"); ?></th>
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
                            $allPrograms->sort(array('precedence' => 1));
                            //Start pagination
                            $limit = 15;
                            $adjacents = 3;
                            if (isset($_GET['page']))
                            {
                                $page = $_GET['page'];
                                $start = ($page - 1) * $limit +1; 
                            }
                            else
                            {
                                $start = 1;
                                $page = 1; //if no page var is given, default to 1.
                            }
                            	
					//if no page var is given, set start to 0
                            $num_of_programs = $allPrograms->count();
                            $total_pages = ceil($num_of_programs/$limit);
                            $lastpage   = $total_pages;
                            $prev = $page - 1;							//previous page is page - 1
                            $next = $page + 1;							//next page is page + 1
                         		//lastpage is = total pages / items per page, rounded up.
                            $lpm1 = $lastpage - 1;
                            //echo $num_of_programs;
                            $pagination = "";
                            $targetpage = $_SERVER['PHP_SELF'];
                            if($lastpage > 1)
                            {	
                                    $pagination .= "<div class=\"pagination\">";
                                    //previous button
                                    if ($page > 1) 
                                            $pagination.= "<a href=\"$targetpage?page=$prev\">� previous</a>";
                                    else
                                            $pagination.= "<span class=\"disabled\">� previous</span>";	

                                    //pages	
                                    if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
                                    {	
                                            for ($counter = 1; $counter <= $lastpage; $counter++)
                                            {
                                                    if ($counter == $page)
                                                            $pagination.= "<span class=\"current\">$counter</span>";
                                                    else
                                                            $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
                                            }
                                    }
                                    elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
                                    {
                                            //close to beginning; only hide later pages
                                            if($page < 1 + ($adjacents * 2))		
                                            {
                                                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
                                                    {
                                                            if ($counter == $page)
                                                                    $pagination.= "<span class=\"current\">$counter</span>";
                                                            else
                                                                    $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
                                                    }
                                                    $pagination.= "...";
                                                    $pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
                                                    $pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";		
                                            }
                                            //in middle; hide some front and some back
                                            elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
                                            {
                                                    $pagination.= "<a href=\"$targetpage?page=1\">1</a>";
                                                    $pagination.= "<a href=\"$targetpage?page=2\">2</a>";
                                                    $pagination.= "...";
                                                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
                                                    {
                                                            if ($counter == $page)
                                                                    $pagination.= "<span class=\"current\">$counter</span>";
                                                            else
                                                                    $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
                                                    }
                                                    $pagination.= "...";
                                                    $pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
                                                    $pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";		
                                            }
                                            //close to end; only hide early pages
                                            else
                                            {
                                                    $pagination.= "<a href=\"$targetpage?page=1\">1</a>";
                                                    $pagination.= "<a href=\"$targetpage?page=2\">2</a>";
                                                    $pagination.= "...";
                                                    for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
                                                    {
                                                            if ($counter == $page)
                                                                    $pagination.= "<span class=\"current\">$counter</span>";
                                                            else
                                                                    $pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
                                                    }
                                            }
                                    }

                                    //next button
                                    if ($page < $counter - 1) 
                                            $pagination.= "<a href=\"$targetpage?page=$next\">next �</a>";
                                    else
                                            $pagination.= "<span class=\"disabled\">next �</span>";
                                    $pagination.= "</div>\n";		
                            }
                            
                            
                            $i = 0;
                            $display_program_in_page = false;
                            foreach ($allPrograms as $program) {
                                
                                $i++;
                                if ($i == $start)
                                    $display_program_in_page = true;
                                if ($i == $start + $limit )
                                    $display_program_in_page = false;
                                if ($display_program_in_page)
                                {
                            ?>
                                <tr>
                                    <td class="span1"><?php echo $i;?></td>
                                    <td id="logo<?php echo $i;?>"></td>
                                    <td>
                                        <a class='' href="<?php
                                            echo $rootDir . "users/profile/";
                                            $programCreator    = $program['username'];
                                            $hasMail = false;
                                            if (strpos($programCreator, '@') !== false) {
                                                $hasMail            =   true;
                                                $nameBeforeMailAdd  = explode('@', $programCreator);
                                                $programCreator     = $nameBeforeMailAdd[0];
                                            }
                                            echo $programCreator;
                                            if ($hasMail)
                                                echo "_email";
                                            ?>"> 
                                            <?php
                                                echo $programCreator;
                                                $code = $program['code'];
                                              
                                                $newstr = str_replace("\n", " ", $code);
                                         
                                            ?>  
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
                                <script>
                                    do_logo ('<?php echo "logo" . $i;?> ', '<?php echo $newstr; ?>');
                             </script>
                            <?php

                                }// End if it's a program we need to display in this page
                            } // End of foreach loop
                            ?> 
                            </tbody>  
                        </table>
                        <?php echo $pagination; ?>
                    </div><!-- end of center content -->
                </div>
                 <div id="logo1"></div>
            <?php
            if (isset($footer))
                echo $footer;
            ?>
            </div>
        <script>
                    do_logo ('logo1', 'penup setxy -180 40 rt 90 setlabelheight 110 setcolor 1 label "Weiyun setxy -100 -120 label "Hua ht');

        </script>


    <?php
} // End of rull Checking for session.username exists
?>
    </body>
</html>
