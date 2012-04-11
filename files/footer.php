<?php
        $currentFile = $_SERVER["PHP_SELF"];
        $parts = Explode('/', $currentFile);
        $currentPage = $parts[count($parts) - 1];
        
        $footer =
        "
        <footer id='footer'>
            &copy; TurtleAcademy, <a id='doc' title='תעוד הפרוייקט' href='doc.html'>
            <?php
                 echo _('project doc'');
            //        תעוד הפרוייקט                     
             ?> 
                                 
            </a>
            <div id='langicons'>
                <a href=$currentPage?locale=he_IL><img src='Images/flags/il.png'  title='עברית' /></a>
                <a href=$currentPage> <img src='Images/flags/us.png'  title='English' /></a>              
            </div>    
        </footer>            
        "
?>
