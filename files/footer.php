<?php
        $currentFile = $_SERVER["PHP_SELF"];
        $parts = Explode('/', $currentFile);
        $currentPage = $parts[count($parts) - 1];
        $doc = _('project doc');
        $footer =
        "
        <footer id='footer'>
            &copy; TurtleAcademy, 
                <a id='doc' title='תעוד הפרוייקט' href='doc.html'>
                ". 
                $doc ."
                </a>
            <div id='langicons'>
                <a href=$currentPage?locale=he_IL><img src='Images/flags/il.png'  title='עברית' /></a>
                <a href=$currentPage> <img src='Images/flags/us.png'  title='English' /></a>              
            </div>    
        </footer>            
        "
?>
