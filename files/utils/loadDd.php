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
class loadDd extends loadFiles {

    public function __construct($root , $env ,$address = "files/test/dd/")  
     {
            parent::__construct($root , $env ,$address); 

     }  
    public function loadFiles( $js_min = true , $js_dd_min = true , $css_dd = true , $css_skin = true , $css_flags = true){
        if ($js_min == "true")
        {
           // if ($this->env == "local")
                echo "<script type='application/javascript' src='". $this->addr . "js/jquery/jquery-1.8.2.min.js' ></script>" ; 
            //else
             //   echo "<script type='application/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js'>"; 
        }
        if ($js_dd_min == "true")    
            echo "<script type='application/javascript' src='". $this->addr . "js/msdropdown/jquery.dd.min.js' ></script>" ; 
        
        if ($css_dd == "true")    
             echo "<link href='" . $this->addr . "css/msdropdown/dd.css' rel='stylesheet' >" ;    
        if ($css_skin == "true")
            echo "<link href='" . $this->addr . "css/msdropdown/skin2.css' rel='stylesheet' >" ; 
        if ($css_flags == "true")
            echo "<link href='" . $this->addr . "css/msdropdown/flags.css' rel='stylesheet' >" ; 

    }
}

?>