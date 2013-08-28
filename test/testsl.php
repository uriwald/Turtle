<?php  
            require_once("environment.php"); 
            $m              = new Mongo();
            // select a database
            $db             = $m->$dbName;
            $lessons        =   $db->lessons_created_by_guest;
            $localPosted    =   "he_IL";
            echo $lessons;
            $theObjId = new MongoId($_GET['objid']);
            $cursor = $lessons->find(array("_id" => $theObjId));
            echo "var lessons = [";
                foreach ($cursor as $lessonStructure) {                    
                    //  Unset the lesson ID
                    //   echo " some lessons found";
                    $lessonStructure['id'] = '' . $lessonStructure['_id'];
                    unset($lessonStructure['_id']);
                    // print_r($lessonStructure);
                    // If the requested language is in the current json collection
                    //echo "isset?  ".$lessonStructure['locale_' . $_GET[$localPosted]];
                    if (isset($lessonStructure['locale_' . $localPosted])) {
                        //  echo "isset ".$lessonStructure['locale_' . $_GET[$localPosted]];
                        $lessonStructure = $lessonStructure['locale_' . $localPosted];
                    }
                    
                    if (isset($lessonStructure["steps"])) {
                        // echo "is set steps";
                        $lessonSteps = $lessonStructure["steps"];
                    }
                    //echo " printing lesson steps ";
                    //print_r($lessonSteps);
                    $showItem = true;
                    foreach ($lessonSteps as $key => $value) {
                        //echo "enterLessonSteps";
                        //echo "Key = " . $key ;
                        // If we hahve locale for the current step we will set him
                        if (isset($lessonSteps[$key]['locale_' . $localPosted])) {
                            $lessonSteps[$key] = $lessonSteps[$key]['locale_' . $localPosted];
                        } else {
                            $showItem = false;
                        }
                        // unsetting the other locale values
                        foreach ($value as $kkey => $vvalue) {
                            //echo "Key = " . $kkey ;
                            if (strpos($kkey, 'locale') === 0) {
                                unset($lessonSteps[$key][$kkey]);
                            }
                        }
                    }
                    $lessonStructure["steps"] = $lessonSteps;
                    $finalTitle = $lessonStructure["title"];
                    //Now handling the title

                    $lessonTitles = $lessonStructure["title"];
                    foreach ($lessonTitles as $key => $value) {
                        //echo "@@@".$key;
                        if ($key == 'locale_' . $localPosted) {
                            $finalTitle = $lessonTitles[$key];
                        }
                    }
                    $lessonStructure["title"] = $finalTitle;

                    // cleanup extra locales
                    foreach ($lessonStructure as $key => $value) {
                        if (strpos($key, 'locale') === 0) {
                            unset($lessonStructure[$key]);
                        }
                    }
                        echo json_encode($lessonStructure);
                        echo ",";
                    

                    //$i++;
                }
                echo "]";

            ?>  