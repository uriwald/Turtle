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
class loadBs {
    private $root;
    private $bp; 
    public function __construct($root)  
     {
            $this->root = $root; 
            $this->bp= $root."files/bootstrap/";

     }  
    public function loadFiles( $js = true , $js_min = true , $css = true , ){
        if ($js == "true")
            echo "<script type='application/javascript' src='". $this->bp . "js/bootstrap.js' ></script>" ; 
        if ($js_min == "true")    
             echo "<script type='application/javascript' src='". $this->bp . "js/bootstrap.min.js' ></script>" ; 
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
