<?php
    $rootDir         = "../../";
    //Getting Post parameter for FAQ item
    $question       = $_POST['faqQ'];
    $answer         = $_POST['faqA'];
    $type           = $_POST['type'];
    $id             = $_POST['id'];
    
    //Check if the Question was inserted correctly
    $flag = true ;
    if (strlen($question) > 1 && strlen($answer) > 1)
    {
        echo "Question and answer were inserted ok" ;
    }
    else {
            echo "Length is bad " ;
            $flag = false ;
    }
    if ($flag)
    {
        echo "Your Qustion is  " .$question  . " "  . ".<br />";
        echo "Your Answer is  is  " .$answer  . " "  . ".<br />";
        echo "Type is " .$type . " "  . ".<br />"; 
        echo "Your id is " .$id . " "  . ".<br />"; 
        
        $m = new Mongo();
        $db = $m->turtleTestDb;
        $strcol = $db->faq;
        $locales         = array("zh_CN"  ,"es_AR" ,"he_IL"  ,"ru_RU" ,
            "de_DE" , "nl_NL" , "fi_FI"  );
        $questions["en_US"] =   $question;
        $answers["en_US"]   =   $answer;
        foreach($locales as $locale)
        {
           $questions["$locale"]    ="";
           $answers["$locale"]      ="";
        }

        
        //$date = date('Y-m-d H:i:s'); 
        //Here the record will be added in any case
        
            $obj = array( "question" => $questions , "answer" => $answers , "type" => $type
                            , "id" => $id, "precedence" => "9999");
            $strcol->insert($obj);
            echo " NewsItem was successfully inserted";
            $adminPage  =   $rootDir . "admin.php";
            echo "<a href='" . $adminPage . "'> <span class='lessonh'> Go back to Admin page </span> </a>";

      
    } 
    
?>