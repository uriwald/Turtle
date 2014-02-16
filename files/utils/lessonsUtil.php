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
    private $turtleId   = 10 ;
    
    # Constructor  
    public function __construct($locale,$localePrefix,$db,$lessonObjId)  
     {  
                $this->locale = $locale;
                $this->localePrefix = $localePrefix; 
                $this->db = $db; 
                $this->lessonObjId = $lessonObjId;
                $this->precedence = 50 ;
                $this->turtleId = 50 ;
                self ::set_lesson_steps_and_titles();
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

    public function set_lesson_steps_and_titles() {
        $theObjId           = new MongoId($this->lessonObjId);
        $cursor             = $this->db->findOne(array("_id" => $theObjId));
        $this->titles       = $cursor["title"];
        $this->steps        = $cursor["steps"];
        if (isset($cursor["precedence"]))
        {
             $this->precedence   = $cursor["precedence"];
        }
        if (isset($cursor["lesson_turtle_id"]))
        {
             $this->turtleId   = $cursor["lesson_turtle_id"];
        }
    }

    public function print_steps() {
        print_r($this->steps);
    }
    
    public function get_steps_by_locale($locale) {
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
    
    public function get_steps_by_created_locale($locale) {
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
    
    public function get_precedence(){
        return $this->precedence;
    }
    public function get_turtle_id(){
        return $this->turtleId;
    }

    public function get_title_by_locale($locale) {
        $title_by_locale = "";
        if(isset($this->titles))
        {
            foreach ($this->titles as $key => $value) {
                if (isset($this->titles[$key])) 
                {
                    if ($key == $locale) {
                        $title_by_locale = $value;
                    }
                } 
                else 
                { 
                  //  $this->titles = $this->titles[$key];
                }
            }
        }
        return $title_by_locale;
    }
}

?>
