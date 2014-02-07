<?php

/*
 * This class will hold helping functinos for 
 * Lesson translation report page
 */
class stringtranUtil {

    public function add_new_locale($localeName) {
        $m                  = new Mongo();
        $db                 = $m->turtleTestDb;
        $strcol             = $db->stringTranslation;
        $strings            = $strcol->find();
        
        foreach ($strings as $string)
        {
            if (isset($string['pagecode']))     
                $page                   =   $string['pagecode'];
            else {
                $page = "8";
            }
            $context                =   $string['context'];
            $str                    =   $string['str'];
            $translate              =   $string['translate'];
            $display                =   $string['display']; 
            if (!isset($translate["locale_" . $localeName]))
                $translate["locale_" . $localeName]  =   "";
            if (!isset($display[$localeName]))
                $display[$localeName]  =   true;
            $result     =   $strcol->update($string, array("pagecode" => $page , "context" => $context , "str" => $str ,
                                                    "translate" => $translate ,"display" => $display  ));

        }
    }

}

?>
