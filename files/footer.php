    
<?php
        $currentFile    = $_SERVER["PHP_SELF"];
        $parts          = Explode('/', $currentFile);
        $currentPage    = $parts[count($parts) - 1];
        $doc            = _('Doc'); 
        $newLesson      = _('Create new Lesson');
        $faq            = _('FAQ');
        $donate         = _('Donate');
        $contactUs      = _('Contact Us');
        $turtleac       = _('TurtleAcademy');
        if (!isset ($root_dir))
             $root_dir = "/";
        if (!isset ($locale))
            $locale = "en_US";
        $footer =
        "
        <footer id='footer'>

            <div id='footer_elem' lang='" . $lang ."'>
                <ul>
                    <li lang='" . $locale_domain ."'>
                        <a id='doc' title='Project documentation' href='".$site_path."/project/doc/".$lang."'>
                        <b>
                        ". 
                        $doc ."
                        </b>
                        </a>
                    </li>  
                    <li lang='" . $locale_domain ."'>
                         <a href='".$root_dir."faq.php'><b>".$faq."</b></a>   
                    </li>
                    <li lang='" . $locale_domain ."'>                       
                        <a href='mailto:support@turtleacademy.com'><b>".$contactUs."</b></a>              
                    </li>
                    <li lang='" . $locale_domain ."'>
                        <a href='".$root_dir."donate.php'><b>".$donate."</b></a>                      
                    </li>
                </ul>
             </div> 
             <div id='turtleAt'>
                <p> &copy; 2013 " . $turtleac . " </p>
            </div>
        </footer>            
        "        
?>