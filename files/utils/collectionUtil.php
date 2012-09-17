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
    
    public function CollectionItemChangeAttribute ($mongoid , $attName , $attVal)
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


}

?>
