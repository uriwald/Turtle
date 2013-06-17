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
     public static function showColItemToTranslate($colname) 
     {
           $m       = new Mongo();
           $db      = $m->turtleTestDb;	
           $strings = $db->$colname;
           $results = $strings->find();
           return $results;
     }
   
}

?>
