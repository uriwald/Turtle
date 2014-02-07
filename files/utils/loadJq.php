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

class loadJq extends load_files {

    public function __construct($root, $env, $address = "ajax/libs/jqueryui/1.10.0/") {
        parent::__construct($root, $env, $address);
    }

    public function loadFiles($js_min = true, $js_custom = true, $js_alerts = true,
            $js_temple = true, $js_storage = true , $css_alerts = true, $css_custom = true) {
       
        if ($js_min) {
            if ($this->env == "local")
                echo "<script type='application/javascript' src='" . $this->addr . "js/jquery/jquery-1.8.2.min.js' ></script>";
            else
                echo "<script type='application/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js'></script>";
        }
        if ($js_custom == "true") {
            // Ruin the change language 

            if ($this->env == "local")
                echo "<script type='application/javascript' src='" . $this->addr . "js/jquery-ui-1.10.0.custom.js' ></script>";
            else
                echo "<script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.0/jquery-ui.min.js'></script>";
        }
        if ($js_alerts == "true")
            echo "<script type='application/javascript' src='" . $this->root . "alerts/jquery.alerts.js' ></script>";
        if ($js_temple == "true")
            echo "<script type='application/javascript' src='" . $this->root . "files/jquery.tmpl.js' ></script>";
        if ($js_storage == "true")
            echo "<script type='application/javascript' src='" . $this->root . "files/jquery.Storage.js' ></script>";

        if ($css_alerts == "true")
            echo "<link href='" . $this->root . "alerts/jquery.alerts.css' rel='stylesheet' >";

        if ($css_custom == "true") {
            echo "<link href='" . $this->addr . "css/ui-lightness/jquery-ui-1.10.0.custom.css' rel='stylesheet' >";
        }
    }

}

?>