<?php
require_once 'LocalCache.php';

       $myLocalCache = new Cache\LocalCache() ;
       $StorageVal = $myLocalCache->get("lessonStepsValues");
       print_r($StorageVal);

?>
