    
<?php
        $currentFile    = $_SERVER["PHP_SELF"];
        $parts          = Explode('/', $currentFile);
        $currentPage    = $parts[count($parts) - 1];
        $doc            = _('Project doc');
        $newLesson      = _('Create new Lesson');
        $contactUs      = _('Contact Us');
        if (!isset ($rootDir))
             $rootDir = "/";
        if (!isset ($locale))
            $locale = "en_US";
        $footer =
        "
        <footer id='footer' style='margin-top:220px'>
            <div>
                <ul>
                    &copy; TurtleAcademy 
                    <li>
                         
                        <a id='doc' title='Project documentation' href='".$rootDir."doc.php?locale=".$locale."'>
                        ". 
                        $doc ."
                        </a>
                    </li>  
                    <li>
                        <a href='".$rootDir."users.php'>".$newLesson."</a>
                    </li>
                    <li>
                        <a href='mailto:support@turtleacademy.com'>".$contactUs."</a>
                    </li>
                </ul>
             </div>   
        </footer>            
        "        
?>