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
class loadJq {
    private $root;
    private $jq; 
    public function __construct($root)  
     {
            $this->root = $root; 
            $this->jq= $root."ajax/libs/jqueryui/1.10.0/";

     }  
    public function loadFiles( $js_custom = true , $js_alerts = true , $js_temple = true , $js_storage = true 
            , $css_alerts = true , $css_custom = true){
        if ($js_custom == "true")
            echo "<script type='application/javascript' src='". $this->jq . "js/jquery-ui-1.10.0.custom.js' ></script>" ; 
        if ($js_alerts == "true")    
             echo "<script type='application/javascript' src='". $this->root . "alerts/jquery.alerts.js' ></script>" ; 
        if ($js_temple == "true")    
             echo "<script type='application/javascript' src='". $this->root . "files/jquery.tmpl.js' ></script>" ; 
        if ($js_storage == "true")    
             echo "<script type='application/javascript' src='". $this->root . "files/jquery.Storage.js' ></script>" ;
        
        if ($css_alerts == "true")
            echo "<link href='" . $this->root . "alerts/jquery.alerts.css' rel='stylesheet' >" ; 
        if ($css_custom == "true")
            echo "<link href='" . $this->jq . "css/ui-lightness/jquery-ui-1.10.0.custom.css' rel='stylesheet' >" ; 

    }
}

?>