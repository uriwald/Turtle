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
class loadTurtle {
    private $root;
    private $env;
    private $locale;
    private $bp; 
    public function __construct($root , $env) 
     {
            $this->root = $root; 
            $this->env  = $env; 
            $this->bp= $root."files/bootstrap/";

     }  

    public function loadFiles( $js = true , $js_min = true , $css = true  ){
        if ($js == "true")
        {
                echo "<script type='application/javascript' src='". $this->bp . "js/bootstrap.js' ></script>" ; 
        }
        if ($js_min == "true")    
        {
            //if ($this->env == "local")
                echo "<script type='application/javascript' src='". $this->bp . "js/bootstrap.min.js' ></script>" ; 
            //else
            //    echo "<script src='http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.2.1/bootstrap.min.js'>";
        }
        if ($css == "true")
            echo "<link href='" . $this->bp . "css/bootstrap.all.css' rel='stylesheet' >" ; 
        //will try to use to boostrap.all file instead of 2 diffrent files
        
        /*
        if ($css == "true")
            echo "<link href='" . $this->bp . "css/bootstrap.css' rel='stylesheet' >" ; 
        if ($css_min == "true")
            echo "<link href='" . $this->bp . "twitter-bootstrap-sample-page-layouts-master/styles/bootstrap.min.css' rel='stylesheet' >" ;
        
         */ 

    }
}

?>
        <script type="application/javascript" src="<?php echo $rootDir; ?>files/js/langSelect.js"></script> <!-- Language select -->                         
        <script type="application/javascript" src="<?php echo $rootDir; ?>files/logo.js"></script> <!-- Logo interpreter -->
        <script type="text/javascript" src="<?php echo $rootDir; ?>files/floodfill.js"></script>
        <script type="application/javascript" src="<?php echo $rootDir; ?>files/turtle.js"></script> <!-- Canvas turtle -->
        <script src="http://www.nihilogic.dk/labs/canvas2image/canvas2image.js"></script>
        <script type="application/javascript" src="<?php echo $rootDir; ?>readMongo.php?locale=<?php echo $locale?>"></script> <!-- Lessons scripts -->
        <script type="application/javascript" src="<?php echo $rootDir; ?>files/Gettext.js"></script> <!-- Using JS GetText -->
        <script type="application/javascript" src="<?php echo $rootDir; ?>files/interface.js?locale=<?php echo $locale?>"></script> <!-- Interface scripts -->
        <script type="application/javascript" src="<?php echo $rootDir; ?>files/jqconsole.js"></script> 