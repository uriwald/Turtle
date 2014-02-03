
<!DOCTYPE html>
<?php
if (session_id() == '')
    session_start();
$_SESSION['comefrom'] = $_SERVER['PHP_SELF']; 
require_once("../environment.php");
require_once("../localization.php");
require_once("cssUtils.php");
require_once("utils/languageUtil.php");
require_once('utils/topbarUtil.php');
require_once('utils/programUtil.php');
require_once('progdoc.php');
?>    
<head> 
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>
        <?php
        echo _("Turtle Academy - learn logo programming in your browser");
        echo _(" free programming materials for kids");
        ?>  
    </title>     

    <script src="<?php echo $sitePath; ?>/files/codemirror/lib/codemirror.js"></script>

    <script src="<?php echo $sitePath; ?>/files/codemirror/addon/runmode/runmode.js"></script>
    <script src="<?php echo $sitePath; ?>/files/codemirror/addon/edit/closebrackets.js"></script>
    <script src="<?php echo $sitePath; ?>/files/codemirror/addon/edit/matchbrackets.js"></script>
    <script src="<?php echo $sitePath; ?>/files/codemirror/addon/display/placeholder.js"></script> 

    <script src="<?php echo $sitePath; ?>/files/codemirror/addon/selection/active-line.js"></script>
    <script src="<?php echo $sitePath; ?>/files/codemirror/mode/logo/logo.js"></script>    
    <link rel="stylesheet" href="<?php echo $sitePath; ?>/files/codemirror/mode/logo/logo.css">
    <link rel="stylesheet" href="<?php echo $sitePath; ?>/files/codemirror/lib/codemirror_turtle.css">
     <link rel="stylesheet" href="<?php echo $sitePath ;?>/files/codemirror/lib/codemirror.css">
    <?php
    require_once("utils/includeCssAndJsFiles.php"); 
    includeCssAndJsFiles::includePageFiles("user-program"); 
    echo "<script type='application/javascript' src='" . $rootDir . "files/jquery.Storage.js' ></script>";
    ?>   

    <?php
    $file_path = "../locale/" . $localeDomain . "/LC_MESSAGES/messages.po";
    $po_file = "<link   rel='gettext' type='application/x-po' href='$sitePath/locale/" . $localeDomain . "/LC_MESSAGES/messages.po'" . " />";
    
    if (file_exists($file_path))
       echo $po_file;
    else {
        echo "<script> var translationNotLoaded = 5; </script>";      
      } 
    echo "<script type='application/javascript' src='" . $rootDir . "files/jqconsole.js' ></script>\n";
    echo "<script type='application/javascript' src='" . $rootDir . "ajax/libs/jquery/editable/jquery.editable.js'></script>";
    ?>        

    <link rel="stylesheet" href="<?php echo $sitePath; ?>/files/codemirror/mode/logo/logo.css">
</head>
<html dir="<?php echo $dir ?>" lang="<?php echo $lang ?>">
<body>
    <?php
    //Printing the topbar menu
    topbarUtil::printTopBar("programUpdate"); 
            
    $programId = $_GET['programid'];
    $m = new Mongo();
    $db = $m->turtleTestDb;
    $programs = "programs";
    $programsCollection = $db->$programs;
    $theObjId = new MongoId($programId);
    $criteria = $programsCollection->findOne(array("_id" => $theObjId));
    $programName = $criteria['programName'];
    $bodytag = str_replace("\n", "↵", $criteria['code']);
    ?>
    <div class="container" style="width:1200px;">
        <div id="program-info">
            <h2 id="program-info-header"><?php echo $programName; ?></h2>
                <!-- <textarea class='input-xlarge' type='text'  id='program-title-txt' placeholder='Enter  your program title...'></textarea> -->
        </div>
        <div id="command-to-draw">

            <div id="cm-side">          
                <form id="txtarea-container-form"><textarea id="code" name="code" placeholder="Code goes here..."></textarea></form>        
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
                    <input id="runbtn" type="button" value="<?php echo _('run'); ?>" class="btn small info pressed"></input>
                </form>
            </div>
            
            <div id="comments">
                <!--
                <div id="comment-in">
                     <form> 
                        <textarea id="commentTxtArea" placeholder="Add comment to the program.."></textarea>
                        <input id="btn_comment" type="button" value="submit comment" class="btn small info pressed"></input>
                    </form>
                </div>
                <div id="numOfComments">
                    <?php echo $criteria['numOfComments']; echo " " ; echo "Comments"?>
                </div>
                <div id ="user-comments">
                   <?php
                        $comments = programUtil::findProgramComments($theObjId);
                        //print_r($comments); 
                        if (is_array($comments) )
                        {
                            foreach ($comments as $comment)
                            {
                                echo "<div class='comment-contain'>";
                                    echo "<div class='comment-title'>"; 
                                    ?>
                                    <a class='' href="<?php
                                            echo $rootDir . "users/profile/";
                                            echo $comment['user'];
                                            ?>"> 
                                            <?php echo $program['username'];?>  
                                    </a>
                                    <?php
                                        
                                    echo "</div>";
                                    echo "<div class='comment-content'>"; 
                                        echo "<p>";
                                            echo $comment['comment'];
                                        echo "</p>";
                                    echo "</div>";
                                echo "</div>";  // Closing of comment-contain
                            }
                        }
                   ?>
                </div>
                -->
            </div>
            <?php
                echo $programDoc;
            ?>
        </div> <!-- Closing of container -->

</body>
   
<script>
    var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
        styleActiveLine: true,
        lineNumbers: true,
        lineWrapping: true
    });
        
    editor.setValue('<?php echo $bodytag; ?>'); 
    var programid = '<?php echo $programId ?>' ;
    var programCreator = '<?php echo $criteria['username'] ;?>';
    <?php
        if (isset($_SESSION['username']))
            echo "var username = '" . $_SESSION['username'] . "';";
        else
            echo "var username = null;";
    ?> 
    selectLanguage("<?php echo $_SESSION['locale']; ?>" , "<?php echo $rootDir; ?>users/programs/<?php echo $programId; ?>/" , "viewProgram.php" ,"<?php echo substr($_SESSION['locale'], 0, 2) ?>" );

</script> 
 </html>