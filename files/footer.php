    
<?php
        $currentFile = $_SERVER["PHP_SELF"];
        $parts = Explode('/', $currentFile);
        $currentPage = $parts[count($parts) - 1];
        $doc = _('project doc');
        $newLesson  = _('Create new Lesson');
        if (!isset ($locale))
            $locale = "en_US";
        $footer =
        "
        <footer id='footer'>
            <div>
                <ul>
                    &copy; TurtleAcademy 
                    <li>
                         
                        <a id='doc' title='Project documentation' href='doc.php?locale=".$locale."'>
                        ". 
                        $doc ."
                        </a>
                    </li>  
                    <li>
                        <a href='lessonsCreatedByGuests.php'>".$newLesson."</a>
                    </li>
                </ul>
 
        </footer>            
        "        
                /*
                //                    <a href=$currentPage?locale=he_IL><img src='Images/flags/Israel.png'  title='עברית' class='flagIcon' /></a>
                //   <a href=$currentPage> <img src='Images/flags/UnitedStates.png'  title='English' class='flagIcon' /></a>   
                 *                 <div id='langicons'>
                    <a href=he.php><img src='Images/flags/Israel.png'  title='עברית' class='flagIcon' /></a>
                    <a href=index.php> <img src='Images/flags/UnitedStates.png'  title='English' class='flagIcon' /></a> 
                    <a href=zh.php> <img src='Images/flags/China.png'  title='中文' class='flagIcon' /></a>  
                    <a href=es.php> <img src='Images/flags/Argentina.png'  title='Español' class='flagIcon' /></a> 
                </div>   
                 */
?>