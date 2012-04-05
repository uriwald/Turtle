<meta http-equiv=Content-Type
      content="text/html; charset=utf-8"> 
<a id="doc" title="backHome" href="http://10.0.0.4/test2/">
    בית
</a>

<?php
/* * *****
  This class will handle translation locale added to the existing lesson
 * ***** *////////////////////////
session_start();
if (array_key_exists('translateLanguage', $_POST)) {
    echo "translation language exist ";
}
$lessonSteps = array();
for ($i = 1; $i <= $_POST['numOfObjects']; $i += 1) {
    $title = "title" . $i;
    $explanation = "explanation" . $i;
    $action = "action" . $i;
    $solution = "solution" . $i;
    $hint = "hint" . $i;
    $translatArray = array("title" => $_POST[$title], "explanation" => $_POST[$explanation], "action" => $_POST[$action],
        "solution" => $_POST[$solution], "hint" => $_POST[$hint]);
    echo "Tmp Array is";
    var_dump($translatArray);
    $lessonSteps[$i] = $translatArray;
}

$m = new Mongo();
// select a database
$db = $m->turtleTestDb;

// select a collection (analogous to a relational database's table)
$lessons = $db->lessons;
$buri = $lessons->find();

$theObjId = new MongoId($_POST['ObjId']);
$criteria = $lessons->findOne(array("_id" => $theObjId));



$originLanguageStepsArr = $criteria["steps"];
$originalTitle = $criteria["title"];

$i = 1;
$localeValue = "locale_" . $_POST['language'];
$finalArrAfterAddTranslation = array();

foreach ($originLanguageStepsArr as $lessonStep) {
    $lessonStep["$localeValue"] = $lessonSteps[$i];
    $finalArrAfterAddTranslation[$i] = $lessonStep;
    $i = $i + 1;
}

$lessonsTitle = array();
//$lessonsTitle["locale_en_US"] = $originalTitle;  
$lessonsTitle = $originalTitle;
$lessonsTitle["$localeValue"] = $_POST['lessonTitle'];
$result = $lessons->update($criteria, array('$set' => array("steps" => $finalArrAfterAddTranslation, "title" => $lessonsTitle)));
?>
<a id="doc" title="backHome" href="http://10.0.0.4/test2/">
    Home
</a>
