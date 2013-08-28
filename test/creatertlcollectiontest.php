<?php
require_once ("files/utils/languageUtil.php");
$m = new Mongo();
$db = $m->selectDB('turtleTestDb');
$collection = new MongoCollection($db, 'rtlLanguages');
$locale = "he_ILL";
$cursor = $collection->find(array(
    'locale' => array('$in' => array($locale)))
);
$cursorr = $collection->find();
var_dump($cursor);
var_dump($cursorr);

$array = iterator_to_array($cursor);
if (empty($array))
    echo " Empty";
else
    var_dump($array);

$lu = new languageUtil("turtleTestDb" , "rtlLanguages");
if ($lu->findIfLocaleExist($locale))
    echo "Locale already exist";
?>