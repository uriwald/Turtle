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
class loadDd {
    private $root;
    private $dd; 
    public function __construct($root)  
     {
            $this->root = $root; 
            $this->dd= $root."files/test/dd/";

     }  
    public function loadFiles( $js_min = true , $js_dd_min = true , $css_dd = true , $css_skin = true , $css_flags = true){
        if ($js_min == "true")
            echo "<script type='application/javascript' src='". $this->dd . "js/jquery/jquery-1.8.2.min.js' ></script>" ; 
        if ($js_dd_min == "true")    
            echo "<script type='application/javascript' src='". $this->dd . "js/msdropdown/jquery.dd.min.js' ></script>" ; 
        if ($css_dd == "true")    
             echo "<link href='" . $this->dd . "css/msdropdown/dd.css' rel='stylesheet' >" ;    
        if ($css_skin == "true")
            echo "<link href='" . $this->dd . "css/msdropdown/skin2.css' rel='stylesheet' >" ; 
        if ($css_flags == "true")
            echo "<link href='" . $this->dd . "css/msdropdown/flags.cs' rel='stylesheet' >" ; 

    }
}

?>