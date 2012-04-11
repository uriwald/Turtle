<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cssUtils
 *
 * @author lucio
 */
class cssUtils {
    public static function loadcss($locale , $cssToLoad) {
            $cssToLoad_rtl = $cssToLoad . "_rtl.css";
            $cssToLoad_ltr = $cssToLoad . "_ltr.css";
            echo "<link rel='stylesheet' href='$cssToLoad.css' type='text/css' media='all'/>";
            $css = "<link rel='stylesheet' href='$cssToLoad_ltr' type='text/css' media='all'/>";
            $css_rtl     = "<link rel='stylesheet' href='$cssToLoad_rtl' type='text/css' media='all'/>"; 
            if ($locale != "he_IL" )
            {
                echo $css;    
            }
            else
            {
                echo $css_rtl;
            }
    }
}

?>
