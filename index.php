
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
        includeCssAndJsFiles::includePageFiles("index"); 
        
        // Case user logged in we will clear the storage data and load it from db
        $isUserLoggedIn =   isset($_SESSION['username']);

        ?>
    </head>
    <div id="index-main">
        <!--Should be different for log in user and for a guest -->
    <?php
        //Printing the topbar menu
        topbarUtil::printTopBar("index"); 
    ?>
        <div class="container">
            <!-- Main hero unit including welcoming messages and code samples -->
            <div class="hero-unit" id="hero-top" lang="<?php echo $lang ?>">
                <h1 id="hero-main-title"><?php echo _("Turtle Academy"); ?></h1> 
                <h2 id="hero-secondary-title"><?php echo _("The easy way to learn programming"); ?></h2>
                <p class="top"><?php echo _("Turtle Academy makes it surprisingly easy to start creating amazing shapes using the LOGO language"); ?></p>
                <p class="top"><?php echo _("Here are some examples for easy and fun programming"); ?></p>
                <!-- Including the code samples -->
                <div class='span14 example-continer' lang="<?php echo $lang ?>">
                    <div class="span4 example" >
                        <p class="example-title"> <?php echo _("Create a Spiral"); ?></p>
                        <p class="example-code"> <?php echo _("for [i 10 100 10]     [fd :i rt 90] ht"); ?> </p>
                        <div id="logo2"></div>
                        <h2> <!--<img src='images/sample/icon1.png' alt=''/> --></h2>
                    </div>
                    <div class="span4 example" >
                        <p class="example-title"> <?php echo _("Cool flower"); ?></p>
                        <p class="example-code"> <?php echo _("repeat 8 [rt 45 repeat 6 [repeat 90 [fd 1 rt 2] rt 90]] ht"); ?></p>
                        <div id="logo3"></div>
                        <h2> <!--<img src='images/sample/icon1.png' alt=''/> --></h2>

                    </div>
                    <div class="span4 example" >
                        <p class="example-title"> <?php echo _("Crazy octagon"); ?></p>
                        <p class="example-code"> <?php echo _("cs repeat 36 [ rt 10 repeat 8 [ fd 25 lt 45]] ht"); ?></p>
                        <div id="logo4"></div>
                        <h2> <!--<img src='images/sample/icon1.png' alt=''/> --></h2>
                    </div>
                    <div class="span2">
                    </div>
                </div> <!-- End of code sapmles -->
                <div id="start-logo" align="center">
                    <p class="top" id="start-logo-p"><strong><?php echo _("Let's start having fun programming"); ?></strong></p>
                    <div id="goto-buttons">
                        <p class="top"><a class="btn primary large indbtn" href ="<?php echo $rootDir; ?>learn.php"><?php echo _("Free Lessons"); ?> </a> <a class="btn primary large indbtn" href ="<?php echo $rootDir; ?>registration.php"><?php echo _("Sign In for free"); ?></a></p>

                    </div> 
                </div>
            </div>
            
            <!-- Users review about Turtle Academy -->
            <div id="myCarousel" class="carousel slide">
                <div class="carousel-inner" id="crousel-quote" lang="<?php echo $lang ?>">
                    <div class="active item">
                        <div class="carousel"> 
                            <div>
                                <h1> "<?php echo _("I got the passion for programming thanks to Turtle Academy"); ?>"</h1>
                            </div>
                            <h3> <?php echo _("Jin Sin Lin - China"); ?></h3>   
                        </div>        
                    </div>
                    <div class="item">
                        <div class="carousel"> 
                            <div>
                                <h1> "<?php echo _("Really easy to use") ?>"</h1>
                            </div>
                            <h3> <?php echo _("Lucio - Israel"); ?></h3> 
                        </div>
                    </div>
                    <div class="item">
                        <div class="carousel"> 
                            <div>
                                <h1 id="running-quote"> "<?php echo _("My son is enjoying studying programming"); ?>"</h1>
                            </div>
                            <h3> <?php echo _("Matt Hok - England"); ?></h3>   
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Users review about Turtle Academy -->
            
            <!-- want to help and project goals columns --> 
            <div class="row span16" id="row-info" lang="<?php echo $lang ?>"> 
                <div class="span9 row-info-div" id="project_goal_div"> 
                    <h2><?php echo _("Project goal"); ?> <!--<img src='images/sample/icon1.png' alt=''/> --></h2>
                    <p><?php echo _("Our objective is to teach programming principles in a fun and easy way making programming an accessible competancy to every child in the world");
                            echo "."; ?>
                    </p>
                    <p><?php echo _("In the (quite near) future everything we will do will require basic programming abilities, and therefore it is important to learn this skill and learn to like it"); ?></p>
                    <p><?php echo _("Making programming visual provides very quick rewards for the efforts, making it perfect for young children who often have trouble setting long term goals") ?> </p>
                </div>

                <div class="span5 row-info-div">
                    <h2><?php echo _("Want to help");
                        echo "?"; ?> <!--<img src='images/sample/icon2.png' alt=''/>--> 
                    </h2>
                    <p> <?php echo _("In order to make programming approachable for more people we need volunteers to translate the site to their own native languages"); ?>.</p>
                    <p>
                        <?php echo _("If you wish to help please"); echo " ";?>
                        <a href="mailto:support@turtleacademy.com" target="_blank"> <?php echo _("Contact Us"); ?> </a>
                    </p>
                </div>
            </div>
        </div> <!-- /container -->
        <?php echo $footer; ?>

    </div> <!-- End of main index-->
   
    <script> 
        //Function to create a logo drawing on a new canvas
        function do_logo(id ,cmd) {
            $('#'+id).css('width', '200px').css('height', '160px').append('<canvas id="'+id+'c" width="200" height="160" ></canvas>' +
                '<canvas id="'+id+'t" width="200" height="160" ></canvas>');
            var canvas_element2 = document.getElementById(id+"c");
            var turtle_element2 = document.getElementById(id+"t");
            var turtle2 = new CanvasTurtle(
            canvas_element2.getContext('2d'),
            turtle_element2.getContext('2d'),
            canvas_element2.width, canvas_element2.height);

            g_logo2 = new LogoInterpreter(turtle2, null);
            g_logo2.run(cmd);
        } 
        // Logo samples
        do_logo ('logo2', 'cs pu setxy 0 -10 pd for [i 10 100 10] [fd :i rt 90] ht');
        do_logo ('logo3', 'cs pu setxy -30 -20 pd repeat 8 [rt 45 repeat 6 [repeat 90 [fd 1 rt 2] rt 90]] ht');
        do_logo ('logo4', 'cs pu setxy 10 0 pd repeat 36 [ rt 10 repeat 8 [ fd 25 lt 45]] ht');
        
        $(document).ready(function() {
            selectLanguage("<?php echo $_SESSION['locale']; ?>" ,  "<?php echo $rootDir; ?>language/", "index.php" ,"en" ); 
            // Definition for people opinion carousel
            $('.carousel').carousel({
                interval: 15000 
            })
            $("#myCarousel").carousel('cycle');
            $('#myCarousel').hover(function () {   
                $(this).carousel('pause')
                $(this).carousel(0)
            })
            // End of Definition for people opinion carousel
        });
    </script>
</html> 