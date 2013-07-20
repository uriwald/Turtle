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
class loadBs extends loadFiles{
    public function __construct($root , $env ,$address = "files/bootstrap/")  
     {
            parent::__construct($root , $env ,$address ); 
     }  
    public function loadFiles( $js = true , $js_min = true , $css = true  ){
        if ($js == "true")
        {
                echo "<script type='application/javascript' src='". $this->addr . "js/bootstrap.js' ></script>" ; 
        }
        if ($js_min == "true")    
        {
            //if ($this->env == "local")
                echo "<script type='application/javascript' src='". $this->addr . "js/bootstrap.min.js' ></script>" ; 
            //else
            //    echo "<script src='http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.2.1/bootstrap.min.js'>";
        }
        if ($css == "true")
            echo "<link href='" . $this->addr . "css/bootstrap.all.css' rel='stylesheet' >" ; 
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
