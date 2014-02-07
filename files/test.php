
<!DOCTYPE html>
<?php
if (session_id() == '')
    session_start();

require_once("../environment.php");
require_once("../localization.php");
//require_once("footer.php");
//require_once("cssUtils.php");
//require_once("utils/languageUtil.php");
//require_once('utils/topbarUtil.php');
?>    
<head> 
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>
        <?php
            echo _("Turtle Academy - learn logo programming in your browser");
            echo _(" free programming materials for kids");
        ?>  
        </title>     
        <link rel=stylesheet href="codemirror/doc/docs.css">

        <link rel="stylesheet" href="codemirror/lib/codemirror.css">
        <script src="codemirror/lib/codemirror.js"></script>

        <script src="codemirror/addon/runmode/runmode.js"></script>
        <script src="codemirror/addon/edit/closebrackets.js"></script>
        <script src="codemirror/addon/edit/matchbrackets.js"></script>
        <script src="codemirror/addon/display/placeholder.js"></script> 

        <script src="codemirror/addon/selection/active-line.js"></script>
        <script src="codemirror/mode/logo/logo.js"></script>
        <link rel="stylesheet" href="codemirror/mode/logo/logo.css">
        <?php
           // require_once("utils/includeCssAndJsFiles.php"); 
        ?>   

        <?php
        $file_path = "../locale/" . $locale . "/LC_MESSAGES/messages.po";
        $po_file = "<link   rel='gettext' type='application/x-po' href='../locale/" . $locale . "/LC_MESSAGES/messages.po'" . " />";
        if (file_exists($file_path))
            echo $po_file;
         //echo "<script type='application/javascript' src='".$rootDir."files/jqconsole.js' ></script>\n" ;
        ?>        
        <!-- <script type="application/javascript" src="<?php echo $root_dir; ?>files/interface_plain.js?locale=<?php echo $locale ?>"></script> <!-- Interface scripts -->
         
        <link rel="stylesheet" href="codemirror/mode/logo/logo.css">
    </head>
<div>
    

<h2>Active Programm</h2>
<form><textarea id="code" name="code">
</textarea>
</form>

<script>

</script>
</div>
    <div id="runbtn" >
        <input type="button" value="Run">
        
        </input>
    </div>
    <div id="run" >
        <textarea rows="4" cols="50"></textarea>
        
    </div>
   
<script>

    var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
        mode: "application/xml",
        styleActiveLine: true,
        lineNumbers: true,
        lineWrapping: true
    });
    /*
     $(document).ready(function() {                 
                    $("#runbtn").click(function() {                                
                        alert(editor.getValue());
                    });            
            });  
       */
</script>