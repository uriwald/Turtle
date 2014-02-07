 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
    require_once("files/utils/collectionUtil.php");
    var_dump($_POST);
    
    $mongoid        =   new MongoId($_POST['mongoid']);
    $db_name         =   "turtleTestDb";
    $colFromName    =   $_POST['copyfrom'];
    $colToName      =   $_POST['copyto'];
    $locale         =   $_POST['selectedLanguage'];
    $stepnum        =  $_POST['stepno'];
    //echo $_POST['mongoid'] ;
    //echo $colFromName ;
    //echo $colToName ;
    
    collectionUtil::copy_locale_lesson_between_collections($mongoid ,$db_name,$colFromName , $colToName , $locale , $stepnum);
?>
