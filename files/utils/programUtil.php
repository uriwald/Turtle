<?php
     class programUtil {
        public static function find_public_programs() 
        {
            $m = new Mongo();
            $db = $m->turtleTestDb;	
            $programs = $db->programs;


            $userProgramQuery       =  array('displayInProgramPage' => true);
            $results     = $programs->find($userProgramQuery);
            return $results;
            //Case no user found          
        }
       
     public static function find_program_comments($mongoid) 
        {
            $m = new Mongo();
            $db = $m->turtleTestDb;	
            $programcol = $db->programs;
            $program = $programcol->findOne(array("_id" => $mongoid));
            return $program['comments'];
            //Case no user found          
        }
     }  
?>
