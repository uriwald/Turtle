<meta http-equiv=Content-Type
      content="text/html; charset=utf-8"> 
<a id="doc" title="backHome" href="http://10.0.0.4/test2/">
    Home
</a>

<?php
session_start();
echo $_POST["precedence"];
$lessonSteps = array();
for ($i = 1; $i <= $_POST['numOfObjects']; $i += 1) {
    $title = "title" . $i;
    $explanation = "explanation" . $i;
    $action = "action" . $i;
    $solution = "solution" . $i;
    $hint = "hint" . $i;
    $translatArray = array("title" => $_POST[$title], "explanation" => $_POST[$explanation], "action" => $_POST[$action],
        "solution" => $_POST[$solution], "hint" => $_POST[$hint]);
    $lessonSteps[$i] = $translatArray;
}
$m = new Mongo();
// select a database
$db = $m->turtleTestDb;
// select a collection (analogous to a relational database's table)
$precedence = 1;
$lessons = $db->lessons;
//If we set a precedence

if (isset ($_POST["precedence"]) )
    $precedence =$_POST["precedence"] ;
//Case we are inserting a new lesson
if (!isset($_POST["ObjId"]) OR $_POST["ObjId"] == null OR strlen($_POST["ObjId"]) < 2) {
    $titles = array('locale_he_IL' => $_POST['lessonTitle']);
    $structure = array("steps" => $lessonSteps, "title" => $titles);
    $result = $lessons->insert($structure, array('safe' => true));
} else { //updating existing lesson
    $theObjId = new MongoId($_POST['ObjId']);
    $criteria = $lessons->findOne(array("_id" => $theObjId));

    //Case we want to remove object 
    if (isset($_POST["formDelete"])) {
        $result = $lessons->remove(array('_id' => $theObjId), true);
    } else {
        $originLanguageStepsArr = $criteria["steps"];
        $originalTitle = $criteria["title"];
        echo $originalTitle;
        $i = 1;
        $localeValue = "locale_" . $_POST['language'];
        $finalArrAfterTranslation = array();

        foreach ($originLanguageStepsArr as $lessonStep) {
            $lessonStep["$localeValue"] = $lessonSteps[$i];
            $finalArrAfterTranslation[$i] = $lessonStep;
            $i = $i + 1;
        }
         $lessonsTitle = $originalTitle;
        //$lessonsTitle = array();
        //$lessonsTitle['locale_he_IL'] = "";
        //$lessonsTitle['locale_en_US'] = "";
        
        $lessonsTitle["$localeValue"] = $_POST['lessonTitle'];
        //print_r($finalArrAfterTranslation);
       // $result = $lessons->update($criteria, array('$set' => array("steps" => $finalArrAfterTranslation, "title" => $lessonsTitle , "precedence" => $precedence)));
    }
}
?>
<a id="doc" title="backHome" href="http://10.0.0.4/test2/">
    Home
</a>
