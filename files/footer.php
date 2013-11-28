    
<?php
        $currentFile    = $_SERVER["PHP_SELF"];
        $parts          = Explode('/', $currentFile);
        $currentPage    = $parts[count($parts) - 1];
        $doc            = _('Doc'); 
        $newLesson      = _('Create new Lesson');
        $faq            = _('FAQ');
        $contactUs      = _('Contact Us');
        if (!isset ($rootDir))
             $rootDir = "/";
        if (!isset ($locale))
            $locale = "en_US";
        $footer =
        "
        <footer id='footer'>

            <div id='footer_elem' lang='" . $lang ."'>
                <ul>
                    <li lang='" . $localeDomain ."'>
                        <a id='doc' title='Project documentation' href='".$rootDir."/project/doc/".$lang."'>
                        <b>
                        ". 
                        $doc ."
                        </b>
                        </a>
                    </li>  
                    <li lang='" . $localeDomain ."'>
                        
                        <a href='".$rootDir."faq.php'><b>".$faq."</b></a>
                        
                    </li>
                    <li lang='" . $localeDomain ."'>
                        
                        <a href='mailto:support@turtleacademy.com'><b>".$contactUs."</b></a>
                        
                    </li>
                </ul>
             </div> 
             <div id='turtleAt'>
                <p> &copy; 2013 TurtleAcademy </p>
            </div>
        </footer>            
        "        
?>