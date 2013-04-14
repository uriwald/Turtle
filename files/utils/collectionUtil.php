<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of collectionUtil
 *
 * @author Lucio
 */
class collectionUtil {
    //TODO check precedence
    private $m;
    private $db;
    private $collection;

    
    # Constructor  
    public function __construct($db,$collection)  
     {
                $m = new Mongo();
                $this->m = $m;
                $thisdb = $m->$db; 
                $this->collection = $thisdb->$collection;$this->db = $thisdb; 
                $this->collection = $thisdb->$collection;
                echo "Ddd";
     }  
    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }


    public function printCollectionItems() {      

        $cursor = $this->collection->find();
        echo "xx";
        $this->collection->update($cursor , array('$set' => array('pending' => true)),array("multiple" => true)) ; 

    }
    
    
    public function printCollectionItem ($mongoid)
    {
        $criteria = $this->collection->findOne(array("_id" => $mongoid));
        $cursor = $criteria;
        
        print_r($cursor);
        $cursor["pending"] = true ;
          $result = $this->collection->update($criteria,$cursor);
        print_r($cursor);
    }
    
    public function CollectionItemAddAttribute ($mongoid , $attName , $attVal)
    {
        $criteria = $this->collection->findOne(array("_id" => $mongoid));
        $cursor = $criteria;
        //print_r($cursor);
        $cursor[$attName] = $attVal ;
          $result = $this->collection->update($criteria,$cursor);
        //print_r($cursor);
    }
    public function cloneColumn ($mongoid , $attOldName , $attNewName)
    {
        $criteria           = $this->collection->findOne(array("_id" => $mongoid));
        $cursor             = $criteria;
    
        $attributeValue     = $cursor[$attOldName];
        $this->collection->update($cursor , array('$unset' => array($attOldName)),array("multiple" => true)) ;
        $this->collection->update($cursor , array('$set' => array($attNewName => $attributeValue)),array("multiple" => true)) ;
        //print_r($cursor);
    }
    
        
    public function cloneColumns($attOldName , $attNewName) {      

        $cursor = $this->collection->find();
        foreach ($cursor as $user_object) {
            $attributeValue ="";
            if (isset ($user_object[$attOldName]))
            {
                $attributeValue     = $user_object[$attOldName];
                echo "New User Object " . $user_object[$attOldName] . "</br>" ;
                $this->collection->update($user_object , array('$set' => array($attNewName => $attributeValue)),array("multiple" => true)) ;
            }
        }
        echo "done cloning " . $attOldName . " to " . $attNewName;

    }
    
    public function CollectionItemChangeAttributeVal ($mongoid , $attName , $attVal)
    { 
        $criteria = $this->collection->findOne(array("_id" => $mongoid));
        $cursor = $criteria;
        $cursor["$attName"] = $attVal ;
          $result = $this->collection->update($criteria,$cursor);
    }
    
    public function CollectionItemsAddAttribute($attName , $attVal) {      

        $cursor = $this->collection->find();
        $this->collection->update($cursor , array('$set' => array($attName => $attVal)),array("multiple" => true)) ; 

    }
    public function getStepsByLocale($locale) {

        $localeSteps = $this->steps;
        foreach ($this->steps as $key => $value) {
            if (isset($this->steps[$key][$locale])) {

                $localeSteps[$key] = $this->steps[$key][$locale];
            }
        }
        return $localeSteps;
    }
    /*
     * We assusme the the same MongoID is exist in both of the collection
     * good for example to move data from lessons to lessons_translate
     */
    public static function copyFullLessonBetweenCollections($mongoid ,$dbName,$colFromName , $colToName) {
        $mo = new Mongo();
        // select a database
        $dbb = $mo->$dbName;
        // select a collection (analogous to a relational database's table)
        $colFrom    = $dbb->$colFromName;
        // print_r($colFrom);
        $colTo      = $dbb->$colToName;
        $criteria1  = $colFrom->findOne(array("_id" => $mongoid));
        //print_r($criteria1);
        $criteria2  = $colTo->findOne(array("_id" => $mongoid));
        //print_r($criteria2);
        if (!isset($criteria2))
            
        {
            if (isset($criteria1))
                $colTo->insert($criteria1);
        }
        if (isset($criteria1) && isset($criteria2))
        {
            echo " Updating" ;
            print_r($criteria1);
            $colTo->update($criteria2,$criteria1);
            
        }
    }
    public static function copyLocaleLessonBetweenCollections($mongoid ,$dbName,$colFromName , $colToName , $locale , $stepnum) {
        $mo = new Mongo();
        // select a database
        $dbb = $mo->$dbName;
        // select a collection (analogous to a relational database's table)
        $colFrom    = $dbb->$colFromName;
        // print_r($colFrom);
        $steps              = "steps";
        $colTo              = $dbb->$colToName;
        $criteria1          = $colFrom->findOne(array("_id" => $mongoid));
        print_r ($criteria1[$steps][$stepnum][$locale]);
        $criteria2          = $colTo->findOne(array("_id" => $mongoid));
        $criteria2Copy      = $criteria2;
        $criteria2Copy[$steps][$stepnum][$locale] = $criteria1[$steps][$stepnum][$locale];
        if (isset ($criteria2[$steps][$stepnum][$locale]))
             print_r ($criteria2[$steps][$stepnum][$locale]);
        $colTo->update($criteria2,$criteria2Copy);
    }
    
}
?>