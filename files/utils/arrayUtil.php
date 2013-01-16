<?php
    class arrayUtil {
        
        /* In case of removing an element will fix the array  to contain the elements from [1] to end
         * 
         */
        public static function reindexArray ($arrayInput) {
           $arrayOutput     =   array_values($arrayInput); // Will reindex from 0
           $arrayLen        =   count($arrayOutput);
           for ($i=$arrayLen; $i>0; $i--)
            {
               $j = $i - 1 ;
               $arrayOutput[$i] =   $arrayOutput[$j];
            }
           unset($arrayOutput[0]);
           return $arrayOutput;
           //var_dump($arrayOutput);
        }
    }
       

?>
