<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of translationUtil
 *
 * @author lucio
 * 
 * 
 */
 require_once ("lessonsUtil.php");
class translationUtil extends lessonsUtil {
    
     public function __construct($locale,$localePrefix,$db,$lessonObjId)  
     {  
         parent::__construct($locale,$localePrefix,$db,$lessonObjId);

            $this->locale = $locale;
            $this->localePrefix = $localePrefix; 
            $this->db = $db; 
     }  
     /**
      *
      * @param type $colname - which collection should we bring the data from
      * @return type 
      */
     public static function show_collection_item_to_translate($colname) 
     {
           $m       = new Mongo();
           $db      = $m->turtleTestDb;	
           $strings = $db->$colname;
           $results = $strings->find();
           return $results;
     }
     
     public static  function get_language($locale)
    {
        $lang = "English";
        if ($locale == "he_IL")
            $lang = "Hebrew";
        else if ($locale == "ru_RU")
            $lang = "Russian";
        else if ($locale == "es_AR")
            $lang = "Spanish";
        else if ($locale == "zh_CN")
            $lang = "Chinese";
        else if ($locale == "ar_JO")
            $lang = "Arabic";
        else if ($locale == "de_DE")
            $lang = "German";
        else if ($locale == "pt_BR")
            $lang = "Portuguese";
        else if ($locale == "pl_PL")
            $lang = "Polish";
        else if ($locale == "nl_NL")
            $lang = "Duetch";
        else if ($locale == "it_IT")
            $lang = "Italian";
        else if ($locale == "hr_HR")
            $lang = "Croatian";
        return $lang;
    }
   
}

?>
