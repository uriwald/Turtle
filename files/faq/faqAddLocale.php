<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


   
    
     function addNewLocale($localeName) {
        $m                  = new Mongo();
        $db                 = $m->turtleTestDb;
        $strcol             = $db->lessons_faq;
        $lessonsfaqs        = $strcol->find();
        
        foreach ($lessonsfaqs as $lessonfaq)
        {

            $questions      =   $lessonfaq["question"] ;
            $answers        =   $lessonfaq["answer"] ;
            $questions["$localeName"] = "";
            $answers["$localeName"] = ""; 
            $newdata = array('$set' => array("question" => $questions , "answer" => $answers));
            $strcol->update($lessonfaq, $newdata); 
        }
    }
     addNewLocale("br_BR");
?>
