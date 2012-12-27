<!DOCTYPE html>
<html dir="ltr">
    <head>
        <title> <?php  echo _("Project Documentation"); ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <?php
            if (!isset($locale))
                if (isset($_GET['locale']))
                    $locale = $_GET['locale'];
                else
                     $locale = "en_US";
            require_once("localization.php");
            $file_path = "locale/".$locale."/LC_MESSAGES/messages.po";
            $po_file =  "<link   rel='gettext' type='application/x-po' href='locale/".$locale."/LC_MESSAGES/messages.po'"." />";           
            if ( file_exists($file_path))
                echo $po_file;           
        ?>
    </head>
    <body>
        <div>
            <h2>
                <?php  echo _("About the project"); ?> 
            </h2>            
            <div id="logo1"></div>
            <h3>
                <?php  echo _("About the project"); ?>  
            </h3>
                <?php
                    echo _("The project contains a client side learning environment and a compiler for the <a target='_bjlank' href='http://he.wikipedia.org/wiki/%D7%9C%D7%95%D7%92%D7%95_(%D7%A9%D7%A4%D7%AA_%D7%AA%D7%9B%D7%A0%D7%95%D7%AA)'>Logo</a> Programming language.");
                    echo _("The project enables to learn the Logo language and programming principles and can be used for programming logo");
                ?>
            <div id="logo2"></div>
            <h3>     
                <?php
                    echo _("Why was it done");
                ?>
            </h3>
                <?php
                    echo _("My brother has been volunteering in a primary school in Israel for the past few years.");
                    echo _("He was trying to instill the basic programming skills in the children and he discovered that there are three main problems.");
                    echo _("The first is the language barrier (all the programming languages are using English and the children's do not speak the language ),"); 
                    echo _("the second issue is that currently there are not many online learning programs which address children.");
                    echo _("The third issue is the installation requirement of an appropriate programming environment in order to be able to start programming.");
                ?>
            <br/>    
            <br/>
                <?php
                    echo _("For this reason we thought it would be a good idea to join forces and create TurtleAcademy");
                    echo _("The inspiration for the project came from other projects like <a target='_blank' href='http://www.khanacademy.org/'> Khanacademy</a> And a javascript learning project named <a target='_blank' href='http://www.codecademy.com/'>Codecademy</a>");
                    
                ?>    
            <h3>       
                <?php
                    echo _("Who are we ?");
                ?>
            </h3>
            <?php
                echo _("Lucio  - Webmaster  and  amateur ping pong player");  echo "</br>";          
                echo _("Ofer   - Father of three , amateur entrepreneur");    echo "</br>";             
                echo _("Amir   - Colnect master , uncle of six");             echo "</br>";             
                echo _("Dana   - Tiger painter , likes to read lessons");     echo "</br>";  
                echo _("Ayelet - Full time mother");                          echo "</br>";             
                echo _("Almog  - Blogger , made his first QA steps at the age of seven"); echo "</br>";        
                echo _("Inbar  - Very talented Wii player");                  echo "</br>";          
                echo _("Raz    - QA and vegetarian");                         echo "</br>";
                echo _("Yuval  - QA and future Messi");                       echo "</br>";
            ?>        
            <div id="logo4"></div>
            <h3>  
                <?php
                    echo _("Tricks");
                ?>
            </h3>
            
            <?php
             echo _("New commands that have been learned will be saved even after the browser restarts"); echo "</br>";
             echo _("The turtle remembers the student's progress over time, allowing the student to follow his own progress"); "</br>";
             echo _("The drawing that appear below actually show live logo programs !"); echo "</br>";
            ?>
       <div id="logo5"></div>
            <h3>
                <?php
                    echo _("Credits");
                ?>
            </h3>
            <?php
                echo _("A lot of written libraries facilitate the creation of the website"); echo "</br>";
                echo _("<a target='_blank' href='http://www.calormen.com/Logo/'> Joshua Bell - wrote the logo component </a>"); echo "</br>";
                echo _("<a target='_blank' href='https://github.com/replit/jq-console'> jsconsole- wrote the input element ( Console ) </a>"); echo "</br>";
                echo _("<a target='_blank' href='http://jquery.com'> jquery - component which enabled easy java scripting </a>"); echo "</br>";
                echo _("<a target='_blank' href='http://jqueryui.com/'> jqueryui - a collection of graphical components </a>"); echo "</br>";
                echo _("<a target='_blank' href='http://api.jquery.com/category/plugins/templates/'> jquerytemplates - enable transmission of data to html </a>"); echo "</br>";
            ?>    
            <div id="logo6"></div>
            
             <h3> 
                 <?php
                    echo _("Contact us");
                ?>
             </h3>
            
        <a href="mailto:webmaster@turtleacademy.com"> <?php echo _("Send an email"); ?> </a>
        </div>
        <script>
            function do_logo(id ,cmd) {
                $('#'+id).css('width', '100px').css('height', '100px').append('<canvas id="'+id+'c" width="100" height="100" style="position: absolute; z-index: 0;"></canvas>' +
                    '<canvas id="'+id+'t" width="100" height="100" style="position: absolute; z-index: 1;"></canvas>');
                var canvas_element2 = document.getElementById(id+"c");
                var turtle_element2 = document.getElementById(id+"t");
                var turtle2 = new CanvasTurtle(
                canvas_element2.getContext('2d'),
                turtle_element2.getContext('2d'),
                canvas_element2.width, canvas_element2.height);

                g_logo2 = new LogoInterpreter(turtle2, null);
                g_logo2.run(cmd);
            } 
            do_logo ('logo1', 'fd 20');
            do_logo ('logo2', 'repeat 8 [fd 10 rt 360/8]');
            //do_logo ('logo3', 'repeat 10 [repeat 8 [fd 10 rt 360/8] rt 360/10]');
            do_logo ('logo4', 'repeat 10 [fd repcount*8 rt 90] ht');
            do_logo ('logo5', 'window repeat 10 [fd 3 * repcount repeat 3 [fd 15 rt 360/3] rt 360/10] ht');
            do_logo ('logo6', 'window pu home repeat 20 [ setlabelheight 20-repcount fd repcount label "HTML5Fest bk repcount rt 18 ] ht');
        </script>

    </body>
</html>

<?php

?>
