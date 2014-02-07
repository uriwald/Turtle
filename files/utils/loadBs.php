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
class loadBs extends load_files{
    public function __construct($root , $env ,$address = "/files/bootstrap/")  
     {
            parent::__construct($root , $env ,$address ); 
     }  
     
    public function load_fiels( $js = true , $js_min = true , $js_carosel = true , $css = true  ){
        if ($js == "true")
        {
                echo "<script type='application/javascript' src='". $this->addr . "js/bootstrap.js' ></script>" ; 
        }
        if ($js_min == "true")    
        {
            //From cdn caouse problem
           // if ($this->env == "local")
                echo "<script type='application/javascript' src='". $this->addr . "js/bootstrap.min.js' ></script>" ; 
           // else
            //    echo "<script src='http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.2.1/bootstrap.min.js'>";
        }
        if ($js_carosel == "true")
            echo "<script type='application/javascript' src='". $this->root . "twitter-bootstrap/twitter-bootstrap-v2/docs/assets/js/bootstrap-carousel.js' ></script>" ; 
        
        if ($css == "true")
            echo "<link href='" . $this->addr . "css/bootstrap.all.css' rel='stylesheet' >" ; 

    } 
}
?>
