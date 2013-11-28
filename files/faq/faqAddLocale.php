<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


   
    
     function addNewLocale($localeName) {
        $m                  = new Mongo();
        $db                 = $m->turtleTestDb;
        $strcol             = $db->faq;
        $lessonsfaqs        = $strcol->find();
        
        foreach ($lessonsfaqs as $lessonfaq)
        {

            $questions      =   $lessonfaq["question"] ;
            $answers        =   $lessonfaq["answer"] ;
            if (!isset ($questions["$localeName"]))
            {
                $questions["$localeName"] = "";
                $answers["$localeName"] = ""; 
                $newdata = array('$set' => array("question" => $questions , "answer" => $answers));
                $strcol->update($lessonfaq, $newdata); 
            }
        }
    }
     addNewLocale("pt_BR");
     addNewLocale("it_IT");
?>
