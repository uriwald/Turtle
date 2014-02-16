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
       
        public static function find_program_comments($program_id) 
        {
            $m = new Mongo();
            $db = $m->turtleTestDb;	
            $programcol = $db->programs;
            $program = $programcol->findOne(array("_id" => $program_id));
            return $program['comments'];
            //Case no user found          
        }
        
        //Getting the user rank for the program
        public static function program_ave_rank($program_id) 
        {
            $m = new Mongo();
            $db = $m->turtleTestDb;	
            $programcol = $db->programs;
            $program = $programcol->findOne(array("_id" => $mongoid));
            $rank = $program['rank'];
            if (!is_array($rank))
            {
                return null;
            }
            else{
                    
            }
            return $program['comments'];
            //Case no user found          
        }
        
        public static function program_rank_by_user($program_id , $username) 
        {
            $m = new Mongo();
            $db = $m->turtleTestDb;	
            $programcol = $db->programs;
            $program = $programcol->findOne(array("_id" => $program_id));
            $ranks = $program['ranks'];
            $user_prev_rank = 0;
            if (is_array($ranks))
            {
                $user_prev_rank = 7;
                foreach ($ranks as $rank)
                {
                    if ($rank['username'] == $username)
                    {
                        $user_prev_rank =  $rank['value'];
                        break;
                    }
                }
            }
            return $user_prev_rank;
            //Case no user found          
        }
     }  
?>
