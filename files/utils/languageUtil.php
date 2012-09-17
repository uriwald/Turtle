<?php

class languageUtil {
    //TODO check precedence
    private $m;
    private $db;
    private $collection;

     public function __construct($db,$collection)  
     {
                $m = new Mongo();
                $this->m = $m;
                $thisdb = $m->$db; 
                $this->db = $thisdb; 
                $this->collection = $thisdb->$collection;
     }  
    public  function findIfLocaleExist($locale) {

        $cursor = $this->collection->find((array(
            'locale' => array('$in' => array($locale))))
        );
        $array = iterator_to_array($cursor);
        if (empty($array))
            return false;
        else
            return true;
    }

}
?>
