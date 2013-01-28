<?php
echo "<html><head>";
require_once 'LocalCache.php';
echo "</head>";
       $myLocalCache = new Cache\LocalCache() ;
       $values = "q(0)11";
       
       $StorageVal = $myLocalCache->get($values);
       echo $StorageVal ;
       print_r($StorageVal);
echo "</html>";
?>
 