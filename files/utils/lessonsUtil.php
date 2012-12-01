<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of lessonsUtil
 *
 * @author lucio
 */
class lessonsUtil {

    private $locale = "en_US";
    private $localePrefix = "locale_";
    private $db;
    private $lessonObjId;
    private $steps;
    private $titles;
    private $precedence = 100 ;

    
    # Constructor  
    public function __construct($locale,$localePrefix,$db,$lessonObjId)  
     {  
                $this->locale = $locale;
                $this->localePrefix = $localePrefix; 
                $this->db = $db; 
                $this->lessonObjId = $lessonObjId;
                $this->precedence = 50 ;
                self ::setLessonStepsAndTitles();
     }  

    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }

        return $this;
    }

    public function setLessonStepsAndTitles() {
        $theObjId           = new MongoId($this->lessonObjId);
        $cursor             = $this->db->findOne(array("_id" => $theObjId));
        $this->titles       = $cursor["title"];
        $this->steps        = $cursor["steps"];
        if (isset($cursor["precedence"]))
             $this->precedence   = $cursor["precedence"];
    }

    public function printSteps() {
        print_r($this->steps);
    }
    
    public function getStepsByLocale($locale) {
        // Here i put default value
        // I don't think it's the best practise better return null for translation issues
        $localeSteps = null;
        if(isset($this->steps))
        {
            foreach ($this->steps as $key => $value) {
                if (isset($this->steps[$key][$locale])) {

                    $localeSteps[$key] = $this->steps[$key][$locale];
                }
            }
        }
        return $localeSteps;
    }
    public function getPrecedence(){
        return $this->precedence;
    }

    public function getTitleByLocale($locale) {
        $titleByLocale = "";
        if(isset($this->titles))
        {
            foreach ($this->titles as $key => $value) {
                if (isset($this->titles[$key])) 
                {
                    if ($key == $locale) {
                        $titleByLocale = $value;
                    }
                } 
                else 
                { 
                  //  $this->titles = $this->titles[$key];
                }
            }
        }
        return $titleByLocale;
    }
}

?>
