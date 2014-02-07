
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">  
    <?php
    if (session_id() == '')
        session_start();
    //If the user is not logged in yet redirect
    require_once("../../environment.php");
    $is_public_user_page = false;
    if (isset($_GET['username']))
        $is_public_user_page = true;
    $display_page = true;
    
    require_once("../../localization.php");
    require_once("../footer.php");
    require_once("../cssUtils.php");
    require_once("../utils/languageUtil.php");
    require_once('../utils/topbarUtil.php');
    require_once('../utils/badgesUtil.php');
    require_once('../utils/userUtil.php');

    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        $display_username = $username;
    }
    if ($is_public_user_page) {
        $username = $_GET['username'];
        $display_username = $username;
    } else {
        $display_username = "";
        if (isset($_SESSION['username'])) {
            $display_username = $_SESSION['username'];
            // update the user badgse
            badgesUtil :: update_user_badges($display_username);
        }
    }
    ?>


<html dir="<?php echo $dir ?>" lang="<?php echo $lang ?>">
    <head>
        <meta charset="utf-8">
        <title> <?php $display_username ?></title>
        <meta name="description" content="">
        <meta name="author" content="">
        <?php
        require_once("../utils/includeCssAndJsFiles.php");
        includeCssAndJsFiles::include_all_page_files("users");
        ?>
    </head>
    <body>
        <?php
        //Will display the page only if user is register ,, if not will be redirected
        if ($display_page) {
            //Printing the topbar menu
            topbarUtil::print_topbar("users");
            ?>
            <div class="container span16" id="mainContainer">
            <?php
            if ($is_public_user_page) {
                ?>

                    <div> <h2> <?php echo $display_username . " Public Page"; ?></h2> </div>
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
                                    <th class='span4'><?php echo _("Precedence"); ?></th>
                                    <th class='span4'><?php echo _("Actions"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            
                            $allPrograms = userUtil::find_public_programs();
                            $allPrograms->sort(array('precedence' => 1));
                            $i = 0;
                            foreach ($allPrograms as $program) {
                                $i++;
                            ?>
                                <tr>
                                    <td>
                                        <a class='' href="<?php
                                            echo $root_dir . "users/profile/";
                                            $programCreator    = $program['username'];
                                            $hasMail = false;
                                            if (strpos($programCreator, '@') !== false) {
                                                $hasMail            =   true;
                                                $name_before_adding_mail_address  = explode('@', $programCreator);
                                                $programCreator     = $name_before_adding_mail_address[0];
                                            }
                                            echo $programCreator;
                                            if ($hasMail)
                                                echo "_email";
                                            ?>"> 
                                            <?php

                                                echo $programCreator;
                                            ?>  
                                        </a>
                                    </td>
                                    <td><?php echo $program['programName'] ?></td>
                                    <td><input type='text' id="precedence<?php echo $i ?>" value="<?php echo $program['precedence'] ?>"> </input></td>
                                    <td>
                                        <a class='btn small info' href="<?php
                                            echo $root_dir . "users/programs/";
                                            echo $program['_id'];
                                            ?>">
                                            <?php
                                                echo _("View");
                       
                                            ?>
                                        </a>
                                        <a class='btn small info pressed' id="<?php echo $i ?>" value="<?php echo $program['_id'];?>">
                                            <?php
                                                echo _("Save");
                       
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

         <script type="application/javascript">  
             $(document).ready(function() { 
                    $('.btn-group').button();
                    $().button('toggle');
                    $(".pressed").click(function() {
                        var id                       = $(this).attr('id');
                        var programId                = $(this).attr('value');
                        var precedence               = $('#' + 'precedence' + id).val();   
                        
                        $.ajax({
                            type : 'POST',
                            url : 'updateProgramStatus.php',
                            dataType : 'json',
                            data: {
                                precedence                 : precedence,
                                programId                   : programId

                            },
                            success: function(data) { 
                                alert('successfully save');
                            } ,
                            error: function(XMLHttpRequest, textStatus, errorThrown) {
                                alert(XMLHttpRequest.responseText);
                            }
                        });

                    });
            });
         </script>
    <?php
} // End of rull Checking for session.username exists
?>
    </body>
</html>
