
<!DOCTYPE html>
<?php
if (session_id() == '')
    session_start();

require_once("../environment.php");
require_once("../localization.php");
require_once("cssUtils.php");
require_once("utils/languageUtil.php");
require_once('utils/topbarUtil.php');
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

    <script src="<?php echo $sitePath ;?>/files/codemirror/lib/codemirror.js"></script>

    <script src="<?php echo $sitePath ;?>/files/codemirror/addon/runmode/runmode.js"></script>
    <script src="<?php echo $sitePath ;?>/files/codemirror/addon/edit/closebrackets.js"></script>
    <script src="<?php echo $sitePath ;?>/files/codemirror/addon/edit/matchbrackets.js"></script>
    <script src="<?php echo $sitePath ;?>/files/codemirror/addon/display/placeholder.js"></script> 

    <script src="<?php echo $sitePath ;?>/files/codemirror/addon/selection/active-line.js"></script>


    <script src="<?php echo $sitePath ;?>/files/codemirror/mode/logo/logo.js"></script>    
    <link rel="stylesheet" href="<?php echo $sitePath ;?>/files/codemirror/mode/logo/logo.css">
    <link rel="stylesheet" href="<?php echo $sitePath ;?>/files/codemirror/lib/codemirror_turtle.css">
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
        echo "<script> var empty = 5; </script>";
        
      }
    echo "<script type='application/javascript' src='" . $rootDir . "files/jqconsole.js' ></script>\n";
    echo "<script type='application/javascript' src='" . $rootDir . "ajax/libs/jquery/editable/jquery.editable.js'></script>";
    ?>        
    <link rel="stylesheet" href="<?php echo $sitePath ;?>/files/codemirror/mode/logo/logo.css">
</head>
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
                    <input id="btn_update_program" type="button" value="Update" class="btn small info pressed"></input>
                    <input id="btn_clear" type="button" value="Clear" class="btn small info pressed"></input>
                    <input id="btn_delete" type="button" value="Delete Program" class="btn small info pressed"></input>
                    <input id="btn_create" type="button" value="Create a new Program" class="btn small info pressed"></input>
                    <input id="runbtn" type="button" value="Run" class="btn small info pressed"></input>
                    <!--<input id="btn_save_canvas" type="button" value="saveImg" class="btn small info pressed"></input>-->
                    <input id="btn_public_page" type="button" value="Program Public page" class="btn small info pressed"></input>
                    <input type='checkbox' id='publicProgramsCheckbox' name='publicProgramsCheckbox' value='is public' <?php if ($criteria['displayInProgramPage'] && $criteria['displayInProgramPage'] != "false" ) echo "checked='true'";?>>public</input>
                </form>
            </div>
            <div id ="tab-row">
            </div>
            <?php
                echo $programDoc;
            ?>
        </div> <!-- Closing of instruction -->

</body>
<script>
    var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
        styleActiveLine: true,
        lineNumbers: true,
        lineWrapping: true
    });
        
    editor.setValue('<?php echo $bodytag; ?>'); 
    var programid = '<?php echo $programId ?>' ;
    <?php
        if (isset($_SESSION['username']))
            echo "var username = '" . $_SESSION['username'] . "';";
        else
            echo "var username = null;";
    ?> 
    selectLanguage("<?php echo $_SESSION['locale']; ?>" , "<?php echo $rootDir; ?>program/update/<?php  echo $_GET['programid'];?>/" , "updateProgram.php" ,"<?php echo substr($_SESSION['locale'], 0, 2) ?>" );
    
    $("#btn_public_page").click(function() {    
        jConfirm('Are you sure you want to go to your public page?'  , 'Public Page', function(r) {
            if (r)
            {
                location.href = "<?php echo $sitePath; ?>" + "/users/programs/" + "<?php  echo $_GET['programid'];?>";           
            }
            else
            {
                location.href = sitePath + "/program/lang" + "<?php echo substr($_SESSION['locale'], 0, 2) ?>";
            } 
        });
    });
</script> 