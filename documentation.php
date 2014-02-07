<?php
if (session_id() == '')
    session_start();

require_once("environment.php");
require_once("localization.php");
require_once("files/footer.php");
require_once("files/cssUtils.php");
include_once("files/inc/jquerydef.php");
include_once("files/inc/boostrapdef.php");
require_once('files/utils/topbarUtil.php');
?>
<!DOCTYPE html>
<html dir="ltr"> 
    <head> 
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
        <title> <?php echo _("Project Documentation"); ?></title>
        <?php
             require_once("files/utils/includeCssAndJsFiles.php"); 
            includeCssAndJsFiles::include_all_page_files("doc");
        ?>
         

        
    </head>
    <body>
        <?php
            //Printing the topbar menu
            topbarUtil::print_topbar("documentation"); 
        ?> 
        <div class="container" role="docs">
            <div class="row" lang="<?php echo $lang ?>">    
                <article class="span18 docs">
                    <header class="page-header" id="page-header" lang="<?php echo $lang ?>">
                        <h1>
                        <?php 
                                echo _("About");
                                echo " ";
                                echo _("Turtle academy"); 
                        ?>
                        </h1>
                    </header> 
                    <!-- Side menu navigator -->
                    <div class="span5" id="doc_section" lang="<?php echo $lang ?>"> 
                        <div class="well" style="padding: 8px 0;">
                            <ul class="nav nav-list" id="Doc" lang="<?php echo $lang ?>">
                                <li class="nav-header" id="about" lang="<?php echo $lang ?>"><?php echo _("About"); ?></li>
                                <li style="width:100%;" class="active"><a class="innerLink" lang="<?php echo $lang ?>" href="#about_the_project" data-toggle="tab"><i class="icon-heart innerIcon" lang="<?php echo $lang ?>"></i> <?php echo _("About the project"); ?> </a></li>
                                <li style="width:100%;"><a class="innerLink" lang="<?php echo $lang ?>" href="#why_was_it_done" data-toggle="tab"><i class="icon-leaf innerIcon" lang="<?php echo $lang ?>"></i> <?php echo _("Why was it done"); ?> </a></li>
                                <li style="width:100%;"><a class="innerLink" lang="<?php echo $lang ?>" href="#why_to_register" data-toggle="tab"><i class="icon-bell innerIcon" lang="<?php echo $lang ?>"></i>  <?php echo _("Why to register"); echo" ?"; ?> </a></li> 
                                <li style="width:100%;"><a class="innerLink" lang="<?php echo $lang ?>" href="#who_are_we" data-toggle="tab"><i class="icon-fire innerIcon" lang="<?php echo $lang ?>"></i>  <?php echo _("Who we are ?"); ?> </a></li>
                                <li style="width:100%;"><a class="innerLink" lang="<?php echo $lang ?>" href="#tricks" data-toggle="tab"><i class=" icon-star innerIcon" lang="<?php echo $lang ?>"></i> <?php echo _("Tricks"); ?></a></li>
                                <li style="width:100%;"><a class="innerLink" lang="<?php echo $lang ?>" href="#credits" data-toggle="tab"><i class="icon-thumbs-up innerIcon" lang="<?php echo $lang ?>"></i> <?php echo _("Credits"); ?></a></li>
                                <li style="width:100%;"><a class="innerLink" lang="<?php echo $lang ?>" href="#contact_us" data-toggle="tab"><i class="icon-envelope innerIcon" lang="<?php echo $lang ?>"></i> <?php echo _("Contact us"); ?></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- End of Side menu navigator -->
                    <!-- Middle div information -->
                    <div id="doc" class="span10" lang="<?php echo $lang ?>">
                        <div class="tab-content"> <!-- Tab content -->
                            <div class="tab-pane active" id="about_the_project">
                                <h2>
                                <?php 
                                    echo _("About the project"); 
                                ?>  
                                </h2>
                                <div class='cleaner_h20'></div>
                                <p>
                                <?php
                                    echo _("The project contains a client side learning environment and a compiler for the <a target='_bjlank' href='http://he.wikipedia.org/wiki/%D7%9C%D7%95%D7%92%D7%95_(%D7%A9%D7%A4%D7%AA_%D7%AA%D7%9B%D7%A0%D7%95%D7%AA)'>Logo</a> Programming language.");
                                    echo _("The project enables to learn the Logo language and programming principles and can be used for programming logo");
                                ?>
                                </p>    
                                <div id="logo2" class="logo-draw-example"></div>
                            </div><!-- / Config -->
                            <div class="tab-pane" id="why_was_it_done">
                                <h2>     
                                    <?php echo _("Why was it done"); ?>
                                </h2>
                                <div class='cleaner_h20'></div> 
                                <p>
                                    <?php
                                        echo _("My brother has been volunteering in a primary school in Israel for the past few years.");
                                        echo _("He was trying to instill the basic programming skills in the children and he discovered that there are three main problems.");
                                        echo _("The first is the language barrier (all the programming languages are using English and the children's do not speak the language ),");
                                        echo _("the second issue is that currently there are not many online learning programs which address children.");
                                        echo _("The third issue is the installation requirement of an appropriate programming environment in order to be able to start programming.");
                                        echo _("For this reason we thought it would be a good idea to join forces and create TurtleAcademy");
                                        echo _("The inspiration for the project came from other projects like <a target='_blank' href='http://www.khanacademy.org/'> Khanacademy</a> And a javascript learning project named <a target='_blank' href='http://www.codecademy.com/'>Codecademy</a>");
                                    ?>
                                </p>
                                <div id="logo3" class="logo-draw-example"></div>            
                            </div><!--/ why was it done -->
                            <div class="tab-pane" id="why_to_register">
                                <h2>     
                                <?php 
                                    echo _("Why to register"); 
                                ?>
                                </h2>
                                <div class='cleaner_h20'></div>
                                <p>
                                <?php
                                    echo "<strong>";
                                    echo _("Save your progress") . "</strong> - ";
                                    echo _("Your progress will be kept , and you will be able to see exactly which steps you have done before") . ".";
                                ?>
                                </p>
                                <p>
                                <?php
                                    echo "<strong>";
                                    echo _("Remember your special commands") . "</strong> - ";
                                    echo _("You can teach the turtle some new commands") . ". ";
                                    echo _("See the lessons 'The turtle is learning'") . " , ";
                                    echo _("in order for the commands to be save in your next visit  you should be a register user");
                                ?>
                                </p>
                                <p>
                                <?php
                                    echo "<strong>";
                                    echo _("Special lessons") . "</strong> - ";
                                    echo _("There are special lessons available only for registered users") . ", ";
                                    echo _("cool lessons with cool features");
                                ?>
                                </p>
                                <p>
                                <?php
                                    echo "<strong>";
                                    echo _("Its free") . "</strong> - ";
                                    echo _("The registration is for free") . ".";
                                ?>
                                </p>
                                <div id="logo7" class="logo-draw-example"></div>            
                            </div><!--/ why to register -->
                            <div class="tab-pane" id="who_are_we"> <!-- Who are we -->
                                <h2>       
                                <?php 
                                    echo _("Who we are ?"); 
                                ?>
                                </h2>
                                <div class='cleaner_h20'></div>
                                <table class='zebra-striped' id='main-items' lang="<?php echo $lang ?>">
                                    <thead>
                                        <tr>
                                            <th class='span2'></th>
                                            <th class='span2 whoarewe'><?php echo _("Name"); ?></th>
                                            <th class='span8 whoarewe' ><?php echo _("About"); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class='mini-thumbnail'><img src='/Images/team/lucio.jpg' style='width:100px;height:80px;'/></td>
                                            <td class="whoarewe"><?php echo _("Lucio"); ?></td>
                                            <td class="whoarewe"><?php echo _("Webmaster  and  amateur ping pong player"); ?></td>
                                        </tr>
                                        <tr>
                                            <td class='mini-thumbnail'><img src='/Images/team/ofer.JPG' style='width:100px;height:80px;'/></td>
                                            <td class="whoarewe"><?php echo _("Ofer"); ?></td>
                                            <td class="whoarewe"><?php echo _("Father of three , amateur entrepreneur"); ?></td>
                                        </tr>
                                        <tr>
                                            <td class='mini-thumbnail'><img src='/Images/team/amir.JPG' style='width:100px;height:80px;'/></td>
                                            <td class="whoarewe"><?php echo _("Amir"); ?></td>
                                            <td class="whoarewe"><?php echo _("Colnect master , uncle of six"); ?></td>
                                        </tr>

                                        <tr>
                                            <td class='mini-thumbnail'><img src='/Images/team/andy.jpg' style='width:100px;height:80px;'/></td>
                                            <td class="whoarewe"><?php echo _("Andy"); ?></td>
                                            <td class="whoarewe"><?php echo _("Feeding the turtle , Spanish section"); ?></td>
                                        </tr>     
                                        <tr>
                                            <td class='mini-thumbnail'><img src='/Images/team/mona.JPG' style='width:100px;height:80px;'/></td>
                                            <td class="whoarewe"><?php echo _("Mona"); ?></td>
                                            <td class="whoarewe"><?php echo _("Yoga master , Chinese section"); ?></td>
                                        </tr> 
                                        <tr>
                                            <td class='mini-thumbnail'><img src='/Images/team/oliver.jpg' style='width:100px;height:80px;'/></td>
                                            <td class="whoarewe"><?php echo _("Oliver"); ?></td>
                                            <td class="whoarewe"><?php echo _("Father of twins, German section"); ?></td>
                                        </tr>  
                                        <tr>
                                            <td class='mini-thumbnail'><img src='/Images/team/alexandre.jpg' style='width:100px;height:80px;'/></td>
                                            <td class="whoarewe"><?php echo _("Alexandre"); ?></td>
                                            <td class="whoarewe"><?php echo _("Decipher my fav things on the icons around me ; ) , Potruguese section"); ?></td>
                                        </tr>  
                                        <tr>
                                            <td class='mini-thumbnail'><img src='/Images/team/ayelet.JPG' style='width:100px;height:80px;'/></td>
                                            <td class="whoarewe"><?php echo _("Ayelet"); ?></td>
                                            <td class="whoarewe"><?php echo _("Full time mother"); ?></td>
                                        </tr>
                                        <tr>
                                            <td class='mini-thumbnail'><img src='/Images/team/dana.JPG' style='width:100px;height:80px;'/></td>
                                            <td class="whoarewe"><?php echo _("Dana"); ?></td>
                                            <td class="whoarewe"><?php echo _("Tiger painter , likes to read lessons");?></td>
                                        </tr>
                                        <!--
                                        <tr>
                                            <td class='mini-thumbnail'><img src='/Images/team/almog.jpg' style='width:100px;height:80px;'/></td>
                                            <td class="whoarewe"><?php echo _("Almog"); ?></td>
                                            <td class="whoarewe"><?php echo _("Blogger , made his first QA steps at the age of seven"); ?></td>
                                        </tr>
                                        <tr>
                                            <td class='mini-thumbnail'><img src='/Images/team/inbar.jpg' style='width:100px;height:80px;'/></td>
                                            <td class="whoarewe"><?php echo _("Inbar"); ?></td>
                                            <td class="whoarewe"><?php echo _("Very talented Wii player"); ?></td>
                                        </tr>
                                        <tr>
                                            <td class='mini-thumbnail'><img src='/Images/team/raz.jpg' style='width:100px;height:80px;'/></td>
                                            <td class="whoarewe"><?php echo _("Raz"); ?></td>
                                            <td class="whoarewe"><?php echo _("QA and vegetarian"); ?></td>
                                        </tr>
                                        <tr>
                                            <td class='mini-thumbnail'><img src='/Images/team/yuval.jpg' style='width:100px;height:80px;'/></td>
                                            <td class="whoarewe"><?php echo _("Yuval"); ?></td>
                                            <td class="whoarewe"><?php echo _("QA and future Messi"); ?></td>
                                        </tr>  
                                        -->
                                    </tbody>
                                </table>
                                <div id="logo4" class="logo-draw-example"></div>
                            </div> <!-- Who are we -->

                            <div class="tab-pane" id="tricks">
                                <h2>  
                                <?php 
                                    echo _("Tricks"); 
                                ?>
                                </h2>
                                <div class='cleaner_h20'></div>
                                <p>
                                <?php
                                    echo _("New commands that have been learned will be saved even after the browser restarts");
                                    echo "</br>";
                                    echo _("The turtle remembers the student's progress over time, allowing the student to follow his own progress");
                                    echo "</br>";
                                    echo _("The drawing that appear below actually show live logo programs !");
                                    echo "</br>";
                                ?>
                                </p>
                                <div id="logo5" class="logo-draw-example"></div>
                            </div><!-- / Tricks -->

                            <div class="tab-pane" id="credits">
                                <h2>
                                <?php 
                                    echo _("Credits"); 
                                ?>
                                </h2>
                                <div class='cleaner_h20'></div>
                                <p>
                                    <?php
                                        echo _("A lot of written libraries facilitate the creation of the website");
                                        echo "</br>";
                                        echo "<a target='_blank' href='http://www.calormen.com/Logo/'> ";
                                        echo _("Joshua Bell - wrote the logo component");
                                        echo "</a>";
                                        echo "</br>";
                                        echo "<a target='_blank' href='http://www.mathcats.com/gallery/15wordcontest.html'> ";
                                        echo _("Math cats - Logo 15 word challange compitition");
                                        echo "</a>";
                                        echo "</br>";
                                        echo "<a target='_blank' href='https://github.com/replit/jq-console'> ";
                                        echo ("jsconsole- wrote the input element ( Console )");
                                        echo "</a>";
                                        echo "</br>";
                                        echo "<a target='_blank' href='http://jquery.com'> ";
                                        echo _("jquery - component which enabled easy java scripting");
                                        echo "</a>";
                                        echo "</br>";
                                        echo "<a target='_blank' href='http://jqueryui.com/'> ";
                                        echo _("jqueryui - a collection of graphical components");
                                        echo "</a>";
                                        echo "</br>";
                                        echo "<a target='_blank' href='http://api.jquery.com/category/plugins/templates/'> ";
                                        echo _("jquerytemplates - enable transmission of data to html");
                                        echo "</a>";
                                        echo "</br>";
                                    ?>
                                </p>
                                <div id="logo6" class="logo-draw-example"></div>
                            </div><!-- / Credits -->

                            <div class="tab-pane" id="contact_us">
                                <h2> 
                                <?php 
                                    echo _("Contact us"); 
                                ?>
                                </h2>
                                <div class='cleaner_h20'></div>
                                <p>
                                <?php
                                    echo _("Turtle Academy") . " ";
                                    echo _("is open to hear any ideas or suggestion") . " ";
                                    echo _("or problems") . ".";
                                    echo _("Please contact us.");
                                ?>
                                </p>
                                <p>
                                    <a href="mailto:support@turtleacademy.com" target="_blank"> <?php echo _("Send an email"); ?> </a>
                                </p>
                            </div><!-- / Contact Us -->
                        </div> <!-- Tab content -->
                    </div> <!-- Middle div information -->
                </article>
            </div> <!--/row-->
        <?php
            if (isset($footer))
                echo $footer;
        ?> 
        </div> <!--/end of container-->
        <!-- Creating logo symbols -->
        <script>
        $(document).ready(function() {
            selectLanguage("<?php echo $_SESSION['locale']; ?>" , "<?php echo $root_dir; ?>project/doc/" , "documentation.php" ,"en_US" );
        })
            function do_logo(id ,cmd) {
                $('#'+id).css('width', '300px').css('height', '200px').append('<canvas id="'+id+'c" width="300" height="200" style="position: absolute; z-index: 0;"></canvas>' +
                    '<canvas id="'+id+'t" width="300" height="200" style="position: absolute; z-index: 1;"></canvas>');
                var canvas_element2 = document.getElementById(id+"c");
                var turtle_element2 = document.getElementById(id+"t");
                var turtle2 = new CanvasTurtle(
                canvas_element2.getContext('2d'),
                turtle_element2.getContext('2d'),
                canvas_element2.width, canvas_element2.height);

                g_logo2 = new LogoInterpreter(turtle2, null);
                g_logo2.run(cmd);
            } 
            do_logo ('logo2', 'cs pu setxy -40 -20 pd repeat 8 [fd 40 rt 360/8] ht');
            do_logo ('logo3', 'repeat 10 [repeat 8 [fd 20 rt 360/8] rt 360/10] ht');
            do_logo ('logo4', 'repeat 14 [fd repcount*8 rt 90] ht');
            do_logo ('logo5', 'window repeat 10 [fd 5 * repcount repeat 3 [fd 18 rt 360/3] rt 360/10] ht');
            do_logo ('logo6', 'window pu home repeat 20 [ setlabelheight 20-repcount fd repcount label "HTML5Fest bk repcount rt 18 ] ht');
            do_logo ('logo7', 'cs pu setxy -20 -20 pd repeat 8 [rt 45 repeat 4 [repeat 90 [fd 1 rt 2] rt 90]] ht');
        </script>
    </body>
</html>