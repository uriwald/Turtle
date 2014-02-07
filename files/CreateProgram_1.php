
<!DOCTYPE html>
<?php
if (session_id() == '')
    session_start();

require_once("../environment.php");
require_once("../localization.php");
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
    
    <script src="codemirror/lib/codemirror.js"></script>

    <script src="codemirror/addon/runmode/runmode.js"></script>
    <script src="codemirror/addon/edit/closebrackets.js"></script>
    <script src="codemirror/addon/edit/matchbrackets.js"></script>
    <script src="codemirror/addon/display/placeholder.js"></script> 

    <script src="codemirror/addon/selection/active-line.js"></script>
    
    
    <script src="codemirror/mode/logo/logo.js"></script>    
    <link rel="stylesheet" href="codemirror/mode/logo/logo.css">
    <link rel="stylesheet" href="codemirror/lib/codemirror_turtle.css">
    <?php
    require_once("utils/includeCssAndJsFiles.php");
    ?>   

    <?php
    $file_path = "../locale/" . $locale . "/LC_MESSAGES/messages.po";
    $po_file = "<link   rel='gettext' type='application/x-po' href='../locale/" . $locale . "/LC_MESSAGES/messages.po'" . " />";
    if (file_exists($file_path))
        echo $po_file;
    echo "<script type='application/javascript' src='" . $root_dir . "files/jqconsole.js' ></script>\n";
    ?>        
    <script type="application/javascript" src="<?php echo $root_dir; ?>files/interface_user_program.js?locale=<?php echo $locale ?>"></script> <!-- Interface scripts -->

    <link rel="stylesheet" href="codemirror/mode/logo/logo.css">
</head>
<body>
        <div id="program-info">
            <h2>Active Program</h2>
                <label class='program-title-lbl' > Program title</label>
                <textarea class='input-xlarge' type='text'  id='program-title-txt' placeholder='Enter program title...'></textarea>
                <label class='program-description-lbl' > Program description </label>
                <textarea class='input-xlarge' type='text'  id='program-description-txt' placeholder='Enter program description...'></textarea>  
        </div>
    <div id="command-to-draw">

        <div id="cm-side"> 
            
            <form id="txtarea-container-form"><textarea id="code" name="code" placeholder="Code goes here..."></textarea></form> 
            <input id="err-msg" type="text"> </input>
        </div>
        <div id="runbtndiv" >
            <input id="runbtn" type="button" value="Run"></input>
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
                <canvas id="turtle" width="600" height="400px">   
                </canvas>
            </div>
        </div>
    </div> <!-- Close div command to drawing -->
    <div id="instructions"> 
        <form>
            <input id="d" type="button" value="Save"></input>
            <input id="btn_clear" type="button" value="Clear"></input>
            <input id="a" type="button" value="Nothing"></input>
        </form>
    </div>
</body>
<script>
 var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
        styleActiveLine: true,
        lineNumbers: true,
        lineWrapping: true
    });
    
</script> 