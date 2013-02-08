    
<?php
        $currentFile    = $_SERVER["PHP_SELF"];
        $parts          = Explode('/', $currentFile);
        $currentPage    = $parts[count($parts) - 1];
        $doc            = _('Project doc');
        $newLesson      = _('Create new Lesson');
        $contactUs      = _('Contact Us');
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
                        <a href='users.php'>".$newLesson."</a>
                    </li>
                    <li>
                        <a href='mailto:support@turtleacademy.com'>".$contactUs."</a>
                    </li>
                </ul>
 
        </footer>            
        "        
?>