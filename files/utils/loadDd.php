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

    public function __construct($root, $env, $address = "files/test/dd/") {
        parent::__construct($root, $env, $address);
    }
    public function loadFiles($js_dd_min = true, $css_dd = true, $css_skin = true, $css_flags = true) {

        if ($js_dd_min)
            echo "<script type='application/javascript' src='" . $this->addr . "js/msdropdown/jquery.dd.min.js' ></script>";

        if ($css_dd)
            echo "<link href='" . $this->addr . "css/msdropdown/dd.css' rel='stylesheet' >";
        if ($css_skin)
            echo "<link href='" . $this->addr . "css/msdropdown/skin2.css' rel='stylesheet' >";
        if ($css_flags)
            echo "<link href='" . $this->addr . "css/msdropdown/flags.css' rel='stylesheet' >";
    }

}

?>