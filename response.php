
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>
        Turtle Academy - learn logo programming in your browser           
        </title>    

        <script type='application/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.js'></script> 
        <script type='application/javascript' src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.js'></script>
       
        <script  type="text/javascript" src="ajax/libs/jquery/1.6.4/jquery.js"></script> <!--- equal to googleapis -->
        <script  type="text/javascript" src="ajax/libs/jqueryui/1.8.16/jquery-ui.js"></script> <!--- equal to googleapis -->
       <!---  <script  type="text/javascript" src="files/lang/he.js"></script> Translation of commands used in logo.js-->
        
        
        <!--<script  type="text/javascript" src="ajax/libs/jquery/jquery.min.js"></script> <!--- equal to googleapis -->
        
        <script type="application/javascript" src="files/compat.js"></script> <!-- ECMAScript 5 Functions -->
        <script type="application/javascript" src="files/logo.js"></script> <!-- Logo interpreter -->
        <script type="application/javascript" src="files/turtle.js"></script> <!-- Canvas turtle -->
        <script type="application/javascript" src="files/jquery.tmpl.js"></script> <!-- jquerytmpl -->

                
        
        <script type="text/javascript">
                var locale = "en_US";
        </script>
        <!--<link   rel="gettext" type="application/x-po" href="locale/he_IL/LC_MESSAGES/messages.po" /> <!-- Static Loading hebrew definition -->
        <script type="application/javascript">  <!-- former readMongo -->
        var lessons = [{"title":"njkn","precedence":100,"pending":false,"steps":{"1":{"title":"hnbkjnj","action":"asdf","solution":"czxv","hint":"vbm","explanation":"<p>\n\tasdf<\/p>\n"},"2":{"title":"dfdasf","action":"","solution":"","hint":"asdfdas","explanation":""}}},]  
        
        </script> <!-- Lessons scripts -->
        <script type="application/javascript" src="files/Gettext.js"></script> <!-- Using JS GetText -->
        <script type="application/javascript" src="files/interface.js?locale=en_US"></script> <!-- Interface scripts -->
        <script type="application/javascript" src="files/jqconsole.js"></script> <!-- Console -->
        <script type="application/javascript" src="files/jquery.Storage.js"></script> <!-- Storage -->
        <link rel='stylesheet' href='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/smoothness/jquery-ui.css' type='text/css' media='all'/>
        <link rel='stylesheet' href='./files/css/interface.css' type='text/css' media='all'/>
        <link rel='stylesheet' href='./files/css/interface.css' type='text/css' media='all'/><link rel='stylesheet' href='./files/css/interface_ltr.css' type='text/css' media='all'/>    
        <script type="application/javascript"> <!-- Google Analytics Tracking -->

            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-26588530-1']);
            _gaq.push(['_trackPageview']);

            (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();

        </script>
    </head>
    <body> 
        

        <header id="title">
            <h1><img src="files/turtles.png" alt="צב במשקפיים">
            Turtle Academy 
            </h1>
        </header>
        <div id="main">
            <div id="header" class="menu" >
                <div id="progress">
                </div>
            </div>
            <div id="logoer"> 
                <div id="display"> 
                    <!-- <canvas id="sandbox" width="660" height="350" class="ui-corner-all ui-widget-content" style="position: absolute; z-index: 0;">-->
                    <canvas id="sandbox" width="660" height="350" class="ui-corner-all ui-widget-content">   
                            <span style="color: red; background-color: yellow; font-weight: bold;">
                            Your browser does not support canvas - an updated browser is recommended                                      
                            </span>
                    </canvas>
                    <!--<canvas id="turtle" width="660" height="350" style="position: absolute; z-index: 1;"> -->
                    <canvas id="turtle" width="660" height="350">   
                        <!-- drawing box -->
                    </canvas>
                </div>

                <div id="console" class="ui-corner-all ui-widget-content"><!-- command box --></div>
            </div>

            <div id="accordion">
            </div>
            <div id="lessonnav">
                     
                    <button id="prevlesson">
                    &larr;Prev            
                    </button>
                    <button id="nextlesson"> 
                    &rarr;Next 
                    </button>

                                  
            </div>
        </div>
  
    </body></html>