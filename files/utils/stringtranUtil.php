<?php

/*
 * This class will hold helping functinos for 
 * Lesson translation report page
 */
class stringtranUtil {

    public function addNewLocale($localeName) {
        $m                  = new Mongo();
        $db                 = $m->turtleTestDb;
        $strcol             = $db->stringTranslation;
        $strings            = $strcol->find();
        
        foreach ($strings as $string)
        {
            $page                   =   $string['page'];
            $context                =   $string['context'];
            $str                    =   $string['str'];
            $translate              =   $string['translate'];
            $display                =   $string['display']; 
            if (!isset($translate["locale_" . $localeName]))
                $translate["locale_" . $localeName]  =   "";
            if (!isset($display[$localeName]))
                $display[$localeName]  =   true;
            $result     =   $strcol->update($string, array("page" => $page , "context" => $context , "str" => $str ,
                                                    "translate" => $translate ,"display" => $display  ));

        }
    }

}

?>
