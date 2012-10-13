 <link rel='stylesheet' href='./files/css/footer.css' type='text/css' media='all'/>
<?php
        $currentFile = $_SERVER["PHP_SELF"];
        $parts = Explode('/', $currentFile);
        $currentPage = $parts[count($parts) - 1];
        $doc = _('project doc');
        $newLesson  =   _('Create new Lesson');
        $footer =
        "
        <footer id='footer'>
            <div>
                <ul>
                    &copy; TurtleAcademy 
                    <li>
                         
                        <a id='doc' title='תעוד הפרוייקט' href='doc.html'>
                        ". 
                        $doc ."
                        </a>
                    </li>  
                    <li>
                        <a href='lesson.php'>Create new Lesson</a>
                    </li>
                </ul
                <div id='langicons'>
                    <a href=$currentPage?locale=he_IL><img src='Images/flags/Israel.png'  title='עברית' class='flagIcon' /></a>
                    <a href=$currentPage> <img src='Images/flags/UnitedStates.png'  title='English' class='flagIcon' /></a>              
                </div>    
        </footer>            
        "       
?>