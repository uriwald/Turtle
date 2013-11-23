<?php

    //Handle 2 cases 1 is that Item was translated 
    //Second the item was edited
    $question       = $_POST['faqQ'];
    $answer         = $_POST['faqA'];
    $faqId          = $_POST['id'];
    $locale         = $_POST['locale'];
    
    //If the item is Edited Item
    if (!$_POST['isTrnaslate'])
    {
        $type           = $_POST['type'];         
        $precedence     = $_POST['precedence'];
    }
    
    $m = new Mongo();
    $db = $m->turtleTestDb;
    $strcol = $db->faq;
    
    // Find the FAQ item
    $faqQuery            = array('id' => $faqId);
    $faqExist            = $strcol->findOne($faqQuery);
    $resultcount         = $strcol->count($faqQuery);
    
    if ($resultcount > 0)
    {
        if($_POST['isTrnaslate'])
        {
            $type           = $faqExist['type'];  
            $precedence     = $faqExist['precedence'];
        }
        
        $faqanswer              = $faqExist['answer'];
        $faqquestion            = $faqExist['question'];
        $faqtype                = $type;
        $faqid                  = $faqExist['id'];
        $faqprecedence          = $precedence;
        
        $faqanswer[$locale]   = $answer;
        $faqquestion[$locale] = $question;
        
        $result     =   $strcol->update($faqExist, array("answer" => $faqanswer , "question" => $faqquestion , "type" => $faqtype ,
                                                    "id" => $faqid ,"precedence" => $faqprecedence ));
    }
    

?>
