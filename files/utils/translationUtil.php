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
     public static function showStrToTranslate() 
     {
           $m       = new Mongo();
           $db      = $m->turtleTestDb;	
           $strings = $db->stringTranslation;
           $results = $strings->find();
           return $results;
     }
   
}

?>
