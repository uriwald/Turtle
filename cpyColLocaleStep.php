<html>
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <body>
        <h4>Insert Mongo Id to copy between collections </h4>
        <form action="processColCopyLocaleStep.php" method="post"> 
                Mongo Id :           <input name="mongoid" type="text" /> 
                copy from :          <input name="copyfrom" type="text" /> 
                copy to:             <input name="copyto" type="text" /> 
                step number:         <input name="stepno" type="text" />     
                locale value:
                <select name="selectedLanguage">
                    <option name="en" value="locale_en_US">English</option>
                    <option name="he" value="locale_he_IL">עברית</option>
                    <option name="zh" value="locale_zh_CN">中文</option>
                    <option name="es" value="locale_es_AR">Español</option>
                    <option name="ru" value="locale_ru_RU">русский</option>
                </select>
            <input type="submit" />
        </form>     
        <?php
            require_once("environment.php");

                $m = new Mongo();

                // select a database
                $db = $m->$dbName;

                // select a collection (analogous to a relational database's table)
                $lessons = $db->$dbLessonCollection;

                // find everything in the collection
                $cursor = $lessons->find();
                $cursor->sort(array('precedence' => 1));

                foreach ($cursor as $lessonStructure) {
                    $objID         =            $lessonStructure['_id'];
                    $title         =            $lessonStructure['title']['locale_en_US'];
                    echo "Lesson name is <b>" .$title  . "</b> id is <b>".$objID  . "</b> ";  
                }


        ?>
    </body>
</html>

