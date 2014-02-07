<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">
    <?php
    require_once("environment.php");
    require_once("localization.php");
    require_once("files/footer.php");
    require_once('files/utils/topbarUtil.php');
    ?>
<html dir="<?php echo $dir ?>" lang="<?php echo $lang ?>"> 
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>
            <?php
            echo _("Turtle Academy - learn logo programming in your browser"); 
            echo _(" free programming materials for kids");
            ?>  
        </title>     
        <?php
        require_once("files/utils/includeCssAndJsFiles.php");
        echo "<link rel='stylesheet' href='/files/css/index.css' type='text/css' media='all'/>";
        echo "<link rel='stylesheet' href='/files/css/faq.css' type='text/css' media='all'/>";

        // Case user logged in we will clear the storage data and load it from db
        $is_user_log_in = isset($_SESSION['username']);
        if ($is_user_log_in) {
            ?>   
            <script type="application/javascript" src="<?php echo $root_dir; ?>clearStorageData.php"></script>
            <?php
        }
        ?>
    </head>
    <body>
        <?php
            //Printing the topbar menu
            topbarUtil::print_topbar("index"); 
        ?>
        <div id="answers_main">
            <div class="contianer span16">
                <div id="faq-header">
                        <a href="<?php echo $site_path."/language/".$lang; ?>" alt="Home page">
                            <img class="brand" id="turtleimg" lang="<?php echo $lang ?>" src="<?php echo $root_dir; ?>files/turtles.png" />
                        </a> 

                </div>
                <div class="article">
                    <div id="question-title">
                        <h2> What is Turtle Academy ? </h2>
                    </div> <!-- Close of support main -->
                    <div class="article" id="question-answer">
                        <p>
                            blue blue blue
                        </p>
                    </div>
                </div>

            </div> <!-- Close of Container div -->
        </div> <!-- close answers main -->
    </body>
</html>