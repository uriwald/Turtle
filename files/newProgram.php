
<!DOCTYPE html>
<?php
if (session_id() == '')
    session_start();
require_once("../environment.php");
require_once("../localization.php");

if (!isset($_SESSION['username']))
{
    $_SESSION['redirectBack'] = "files/newProgram.php";
         header('Location: '.$sitePath . "registration.php");
     //   header('refresh:3; url='.$sitePath . "registration.php");
    echo "<center><h1 id='redirect'> You will be redirected in order to log in </h1></center>";
}

require_once("cssUtils.php");
require_once("utils/languageUtil.php");
require_once('utils/topbarUtil.php');

?>    
<head> 
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>
        <?php
        echo _("Turtle Academy - learn logo programming in your browser");
        echo _(" free programming materials for kids");
        ?>  
    </title>     

    <?php
    require_once("utils/includeCssAndJsFiles.php"); 
    includeCssAndJsFiles::includePageFiles("user-program"); 
    echo "<script type='application/javascript' src='" . $rootDir . "files/jquery.Storage.js' ></script>";
    ?>   

    <?php
    $file_path = $sitePath. "locale/" . $localeDomain . "/LC_MESSAGES/messages.po'";
    $po_file = "<link   rel='gettext' type='application/x-po' href='".$sitePath. "locale/" . $localeDomain . "/LC_MESSAGES/messages.po'" . " />";
    if (file_exists($file_path))
        echo $po_file;
    else
        echo $po_file;
    /*
    echo "<script type='application/javascript' src='" . $rootDir . "files/jqconsole.js' ></script>\n";
    echo "<script type='application/javascript' src='" . $rootDir . "ajax/libs/jquery/editable/jquery.editable.js'></script>";
    echo "<link   href='".$rootDir."files/codemirror/mode/logo/logo.css' rel='stylesheet'></link>";
     * 
     */
    ?>        
     <!-- <script type="application/javascript" src="<?php echo $rootDir; ?>files/interface_user_program.js?locale=<?php echo $localeDomain ?>"></script> <!-- Interface scripts -->

    <!--<link rel="stylesheet" href="codemirror/mode/logo/logo.css"> -->
</head>
<body>
        <?php
            //Printing the topbar menu
            topbarUtil::printTopBar("program"); 
            
        ?>
    <div class="container" style="width:1200px;">
        <h2 id="program-info-header">Program 1</h2>
            <!-- <textarea class='input-xlarge' type='text'  id='program-title-txt' placeholder='Enter  your program title...'></textarea> -->
        <div id="command-to-draw">
            <div id="cm-side">          
                <form id="txtarea-container-form"><textarea id="code" name="code" placeholder="Write your code here .. e.g fd 50"></textarea></form>        
            </div>

            <div id="logoerplain"> 
                <div id="displayplain"> 
                    <canvas id="sandbox" width="600" height="400px" class="ui-corner-all ui-widget-content">   
                        <span style="color: red; background-color: yellow; font-weight: bold;">
                            <?php
                            echo _("TurtleAcademy learn programming for free");
                            echo _("Your browser is not supporting canvas");
                            echo _("We recoomnd you to use Chrome or Firefox browsers");
                            ?>                                      
                        </span> 
                    </canvas>
                    <canvas id="turtle" width="600" height="400px" >    
                    </canvas>
                </div>
            </div>
        </div> <!-- Close div command to drawing -->
        <div id="instructions"> 
            <div id="code-error-div">
                <input id="err-msg" type="text" placeholder="An error message will appear here"> </input>    
            </div>
            <div id="action-buttons" > 
                <form> 
                    <input id="btn_save_program" type="button" value="<?php echo _("Save");?>" class="btn small info pressed"></input>
                    <input id="btn_clear" type="button" value="<?php echo _("Clear");?>" class="btn small info pressed"></input>
                    <input id="runbtn" type="button" value="<?php echo _("Run");?>" class="btn small info pressed"></input>
                </form>
            </div>
            <div id ="tab-row">
            </div>
            <div id="documentation">
                <div id="doc-container" class ="span21">
                    <div class="docs-column span4">
                        <h4>Basic Commands</h4>
                        <ul>
                            <li>
                                <h5> fd(x) , forward(x)</h5>
                                <p> Moves the turtle x points</p>
                            </li>
                            <li>
                                <h5> back (x) , bk(x)</h5>
                                <p> The turtle back x points</p>   
                            </li>
                            <li>
                                <h5> left(x) , lt(x)</h5>
                                <p> Rotate the turtle left x degrees</p>                               
                            </li>
                            <li>
                                <h5> right(x) , rt(x)</h5>
                                <p> Rotate the turtle left x degrees</p>                               
                            </li>
                            <li>
                                <h5> clearscreen, cs</h5>
                                <p> Will clear the screen and return the turtle home</p>                               
                            </li>
                        </ul> 
                    </div>
                    <div class="docs-column span4">
                        <h4>Controlling the Pen</h4>
                        <ul>
                            <li>
                                <h5>penup , pu</h5>
                                <p>Turtle stops leaving a trail </p>
                            </li>
                            <li>
                                <h5>pendown , pd</h5>
                                <p> The turtle will leave a trail</p>   
                            </li>
                            <li>
                                <h5>setwidth (x)</h5>
                                <p> Will set the pen width to X</p>   
                            </li>
                            <li>
                                <h5>hideturtle , ht</h5>
                                <p>Hide the turtle </p>                               
                            </li>
                            <li>
                                <h5>showturtle , st</h5>
                                <p>Show the turtle </p>                               
                            </li>
                            <li>
                                <h5>home</h5>
                                <p>Moves the turtle to center, pointing upwards</p>                               
                            </li>
                            <li>
                                <h5>setx (num) , sety (num)</h5>
                                <p>Move turtle to the specified location</p>                               
                            </li>
                            <li>
                                <h5>setxy (num1,num2)</h5>
                                <p>Move turtle to the specified location</p>                               
                            </li>                       
                            <li>
                                <h5>setheading (x) , sh (x)</h5>
                                <p>Rotate the turtle to the specified heading </p>                               
                            </li>
                            </li>                       
                            <li>
                                <h5>arc (RADIUS , ANGLE)</h5>
                                <p>Will craete an arc distance RADIUS covering ANGLE angle </p>                               
                            </li>             
                            <li>
                                <h5>pos , xcor , ycor</h5>
                                <p>Outputs the current turtle position as [ x y ], x or y respectively </p>                               
                            </li>  
                            <li>
                                <h5>heading </h5>
                                <p>Outputs the current turtle heading </p>                               
                            </li>  
                            <li>
                                <h5>towards</h5>
                                <p>Outputs the heading towards the specified [ x y ] coordinates</p>                               
                            </li>                          
                        </ul>    
                    </div>

                    <div class="docs-column span4">
                        <h4>Loops and procedure</h4>
                        <ul>
                            <li>
                                <h5>repeat x [ statements ... ]</h5>
                                <p> Repeat statements x times</p>
                            </li>
                            <li>
                                <h5>repcount</h5>
                                <p>Outputs the current iteration number of the current repeat or forever</p>   
                            </li>
                            <li>
                                <h5>for controllist [ statements ...]</h5>
                                <p>Typical for loop. The controllist specifies three or four members: the local varname, start value, limit value, and optional step size</p>   
                            </li>                       
                            <li>
                                <h5> to PROCNAME inputs ... statements ... end</h5>
                                <p>Define a new named procedure with optional inputs</p>                               
                            </li>
                            <li>
                                <h5>make varname expr</h5>
                                <p>Update a variable or define a new global variable. The variable name must be quoted, e.g. make "foo 5</p>                               
                            </li>
                            <li>
                                <h5> : VARNAME</h5>
                                <p>access the content of VARNAME</p>                               
                            </li>
                            <h4>Lists</h4>
                            <li>
                                <h5> list thing1 thing2 ...</h5>
                                <p>Create a new list from the inputs</p>                               
                            </li>
                            <li>
                                <h5> first listname</h5>
                                <p>Outputs the first item from the list</p>                               
                            </li>
                            <li>
                                <h5> butfirst listname , bf listname</h5>
                                <p>Outputs all the items of listname except for the first item</p>                               
                            </li>
                            <li>
                                <h5> last listname</h5>
                                <p>Outputs the last item from the list</p>                               
                            </li>
                            <li>
                                <h5> butlast listname</h5>
                                <p>Outputs all the items of listname except for the last item</p>                               
                            </li>
                            <li>
                                <h5>item index list</h5>
                                <p>Outputs the indexlist item of the list or array</p>                               
                            </li>

                            <li>
                                <h5> pick listname</h5>
                                <p>Outputs one item from a list, at random</p>                               
                            </li>





                        </ul> 
                    </div>
                    <div class="docs-column span4">
                        <h4>Colors</h4>
                        <ul>
                            <li>
                                <h5> setcolor (x)</h5>
                                <p> Will set the turtle color accroding to the following table</p>
                                <p>
                                <table id="colortable">
                                    <tr>
                                        <td style="background-color: black; color: white;">0: black
                                        <td style="background-color: blue;">1: blue
                                        <td style="background-color: lime;">2: green
                                    <tr>    
                                        <td style="background-color: cyan;">3: cyan  
                                        <td style="background-color: red;">4: red
                                        <td style="background-color: magenta;">5: magenta
                                    <tr>
                                        <td style="background-color: yellow;">6: yellow
                                        <td style="background-color: white;">7: white

                                        <td style="background-color: brown;">8: brown
                                    <tr>
                                        <td style="background-color: tan;">9: tan
                                        <td style="background-color: green;">10: green
                                        <td style="background-color: aquamarine;">11: aqua

                                    <tr>
                                        <td style="background-color: salmon;">12: salmon
                                        <td style="background-color: purple;">13: purple
                                        <td style="background-color: orange;">14: orange
                                    <tr>
                                        <td style="background-color: gray;">15: gray
                                </table>
                                </p>
                            <li>
                                <h5>fill</h5>
                                <p>Does a paint bucket flood fill at the turtle's position</p>                               
                            </li>
                            <li>
                                <h5>filled fillcolor [ statements ... ]</h5>
                                <p>Execute statements without drawing but keeping track of turtle movements. When complete, fill the region traced by the turtle with fillcolor and outline the region with the current pen style</p>                               
                            </li>
                            </li>
                        </ul> 
                    </div>
                    <div class="docs-column span4">
                        <h4>Math</h4>
                        <ul>
                            <li>
                                <h5> sum x y</h5>
                                <p> sum x y </p>
                            </li>
                            <li>
                                <h5> minus x y</h5>
                                <p> return the distance between x and y</p>   
                            </li>
                            <li>
                                <h5> random (x)</h5>
                                <p> Will choose a random number between 0 - (x-1)</p>                               
                            </li>
                        </ul> 
                    </div>
                </div>      
            </div>
        </div> <!-- Close of container div --> 

</body>
<script>
 
    var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
        styleActiveLine: true,
        lineNumbers: true,
        lineWrapping: true
    });
    var programid = null; 
    <?php
        if (isset($_SESSION['username']))
            echo "var username = '" . $_SESSION['username'] . "';";
        else
            echo "var username = null;";
    ?> 
    selectLanguage("<?php echo $_SESSION['locale']; ?>" , "<?php echo $rootDir; ?>program/lang/" , "newProgram.php" ,"<?php echo substr($_SESSION['locale'], 0, 2) ?>" );

</script>