<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of loadBs
 *
 * @author Lucio
 */
include_once 'loadFiles.php';
class loadTurtle extends load_files{
    private $locale; 
    
    public function __construct($locale , $root , $env ,$address = "files/test/dd/" ) 
    {
         parent::__construct($root , $env ,$address); 
         $this->locale  = $locale;
     }  

    public function load_files( $js_lang = true , $js_logo = true , $js_turtle = true , $js_fill = true ,
            $js_canvas = true , $js_mongo = true , $js_getText = true , $js_interface = true , $js_console = true)
    {
        
        if ($js_lang == "true")
        {
                echo "<script type='application/javascript' src='". $this->root . "files/js/langSelect.js' ></script>" ; 
        }
        if ($js_logo == "true")
        {
                echo "<script type='application/javascript' src='". $this->root . "files/logo.js' ></script>" ; 
        }
        if ($js_turtle == "true")
        {
                echo "<script type='application/javascript' src='". $this->root . "files/turtle.js' ></script>" ; 
        }
        if ($js_fill == "true")
        {
                echo "<script type='application/javascript' src='". $this->root . "files/floodfill.js' ></script>" ; 
        }
        if ($js_canvas == "true")
        {
                echo "<script type='application/javascript' src='http://www.nihilogic.dk/labs/canvas2image/canvas2image.js'</script>" ; 
        }       
         if ($js_mongo == "true")
        {
               echo "<script type='application/javascript' src='". $this->root . "readMongo.php?locale=" . $this->locale ."' ></script>" ;  
        }         
        if ($js_getText == "true")
        {
                echo "<script type='application/javascript' src='". $this->root . "files/Gettext.js' ></script>" ; 
        }  
        if ($js_interface == "true")
        {
            echo "<script type='application/javascript' src='". $this->root . "files/interface.js?locale=" . $this->locale ."' ></script>" ;
        }
 
        if ($js_console == "true")
        {
                echo "<script type='application/javascript' src='". $this->root . "files/jqconsole.js' ></script>" ; 
        }  
        
    }
}


?>
      