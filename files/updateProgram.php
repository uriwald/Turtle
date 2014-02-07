
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

    <script src="<?php echo $site_path ;?>/files/codemirror/lib/codemirror.js"></script>
    <script src="<?php echo $site_path ;?>/files/codemirror/addon/runmode/runmode.js"></script>
    <script src="<?php echo $site_path ;?>/files/codemirror/addon/edit/closebrackets.js"></script>
    <script src="<?php echo $site_path ;?>/files/codemirror/addon/edit/matchbrackets.js"></script>
    <script src="<?php echo $site_path ;?>/files/codemirror/addon/display/placeholder.js"></script> 

    <script src="<?php echo $site_path ;?>/files/codemirror/addon/selection/active-line.js"></script>


    <script src="<?php echo $site_path ;?>/files/codemirror/mode/logo/logo.js"></script>    
    <link rel="stylesheet" href="<?php echo $site_path ;?>/files/codemirror/mode/logo/logo.css">
    <link rel="stylesheet" href="<?php echo $site_path ;?>/files/codemirror/lib/codemirror_turtle.css">
     <link rel="stylesheet" href="<?php echo $site_path ;?>/files/codemirror/lib/codemirror.css">
    <?php
    require_once("utils/includeCssAndJsFiles.php"); 
    includeCssAndJsFiles::include_all_page_files("user-program"); 
    echo "<script type='application/javascript' src='" . $root_dir . "files/jquery.Storage.js' ></script>";
    ?>   

    <?php
    $file_path = "../locale/" . $locale_domain . "/LC_MESSAGES/messages.po";
    $po_file = "<link   rel='gettext' type='application/x-po' href='$site_path/locale/" . $locale_domain . "/LC_MESSAGES/messages.po'" . " />";
    
    if (file_exists($file_path))
       echo $po_file;
    else {
        echo "<script> var translationNotLoaded = 5; </script>";      
      } 
    echo "<script type='application/javascript' src='".$root_dir."files/Gettext.js' ></script>" ; 
    echo "<script type='application/javascript' src='" . $root_dir . "files/jqconsole.js' ></script>\n";
    echo "<script type='application/javascript' src='" . $root_dir . "ajax/libs/jquery/editable/jquery.editable.js'></script>";
    ?>        
    <link rel="stylesheet" href="<?php echo $site_path ;?>/files/codemirror/mode/logo/logo.css">
</head>
<html dir="<?php echo $dir ?>" lang="<?php echo $lang ?>"> 
<body>
    <?php
    //Printing the topbar menu
    topbarUtil::print_topbar("programUpdate"); 
    $program_id = $_GET['programid'];
    $m = new Mongo();
    $db = $m->turtleTestDb;
    $programs = "programs";
    $programs_collection = $db->$programs;
    $the_object_id = new MongoId($program_id);
    $criteria = $programs_collection->findOne(array("_id" => $the_object_id));
    $program_name = $criteria['programName'];
    $bodytag = str_replace("\n", "↵", $criteria['code']);
    ?>
    <div class="container" style="width:1200px;">
        <div id="program-info">
            <h2 id="program-info-header"><?php echo $program_name; ?></h2>
                <!-- <textarea class='input-xlarge' type='text'  id='program-title-txt' placeholder='Enter  your program title...'></textarea> -->
        </div>
        <div id="command-to-draw">

            <div id="cm-side" lang="<?php echo $lang ?>">          
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
                    <input id="btn_update_program" type="button" value="<?php echo _("Update"); ?>" class="btn small info pressed"></input>
                    <input id="btn_clear" type="button" value="<?php echo _("Clear"); ?>" class="btn small info pressed"></input>
                    <input id="btn_delete" type="button" value="<?php echo _("Delete Program"); ?>" class="btn small info pressed"></input>
                    <input id="btn_create" type="button" value="<?php echo _("Create a new Program"); ?>" class="btn small info pressed"></input>
                    <input id="runbtn" type="button" value="<?php echo _("Run"); ?>" class="btn small info pressed"></input>
                    <!--<input id="btn_save_canvas" type="button" value="saveImg" class="btn small info pressed"></input>-->
                    <input id="btn_public_page" type="button" value="<?php echo _("Program Public page"); ?>" class="btn small info pressed"></input>
                    <input type='checkbox' id='publicProgramsCheckbox' name='publicProgramsCheckbox' value='is public' <?php if ($criteria['displayInProgramPage'] && $criteria['displayInProgramPage'] != "false" ) echo "checked='true'";?>><?php echo _("public"); ?></input>
                </form>
            </div>
            <div id ="tab-row">
            </div>
            <?php
                echo $program_documentation;
            ?>
        </div> <!-- Closing of instruction  /* rtlMoveVisually : <?php if ($locale_domain == "he_IL") echo "true"; else echo"false" ?>, */ -->
       
</body>
<script>
    var editor = CodeMirror.fromTextArea(document.getElementById("code"), {

        styleActiveLine: true,
        lineNumbers: true,
        direction : '<?php echo $dir ?>',
        lineWrapping: true
        
    });
        
    editor.setValue('<?php echo $bodytag; ?>'); 
    var programid = '<?php echo $program_id ?>' ;
    <?php
        if (isset($_SESSION['username']))
            echo "var username = '" . $_SESSION['username'] . "';";
        else
            echo "var username = null;";
    ?> 
    selectLanguage("<?php echo $_SESSION['locale']; ?>" , "<?php echo $root_dir; ?>program/update/<?php  echo $_GET['programid'];?>/" , "updateProgram.php" ,"<?php echo substr($_SESSION['locale'], 0, 2) ?>" );
    
    $("#btn_public_page").click(function() {    
        jConfirm('Are you sure you want to go to your public page?'  , 'Public Page', function(r) {
            if (r)
            {
                location.href = "<?php echo $site_path; ?>" + "/users/programs/" + "<?php  echo $_GET['programid'];?>";           
            }
            else
            {
                location.href = sitePath + "/program/lang" + "<?php echo substr($_SESSION['locale'], 0, 2) ?>";
            } 
        });
    });
</script> 
    </html>