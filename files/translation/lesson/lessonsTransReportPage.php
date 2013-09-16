<?php
    $fileDirectory = "../../";
    require_once($fileDirectory."utils/translationUtil.php");
    include_once($fileDirectory."inc/dropdowndef.php");
    include_once($fileDirectory."inc/boostrapdef.php");
    include_once($fileDirectory."inc/jquerydef.php");

    
    echo "<link rel='stylesheet' href=' " . $fileDirectory ."css/lessonReport.css' type='text/css' media='all'/>";
    
    
    if(session_id() == '') 
        session_start();

    if (isset ($_GET['locale']))
    {
        $locale = $_GET['locale'];
    }
    else
        $locale = "es_AR";
    $_SESSION['locale'] = "en_US";
    $fullLocalePath     =   "locale_".$locale;
    
    $m = new Mongo();
    $db                 = $m->turtleTestDb;
    $strcol             = $db->lessons_translate_status;
    $lessons            = $strcol->find();
    //Should be sorted by precedence
    $lessons->sort(array('precedence' => 1));
    $lang               = getLanguage($locale);
    
    echo "<div> <h1> Lesson translate to " . $lang . " report </h1></div>";
    foreach ($lessons as $lesson)
    {
        $progress       =   $lesson['in_progress'];
        $completed      =   $lesson['completed'];
        $title          =   $lesson['title'];
        $lessonId       =   $lesson['lesson_id']; 
        $translated     =   $completed[$fullLocalePath] == "true";
        $headerClass    =   "no_full_translate";
        if ($translated)
            $headerClass = "full_translate";
    ?>    
    <div class="span12">
        <h2 class="<?php echo $headerClass; ?>"> 

            <?php echo $title;?>
        
        </h2>
        <div class=""> 
            <span>
                <?php
                    if ($translated)
                        echo " Lesson is completely translated"; 
                    else
                        echo " <b> Lesson is NOT completely translated </b>";
                ?>
            </span> 
        </div>
        <?php
            if ($completed[$fullLocalePath] != "true")
            { // Only if lesson is not completly translated we will check progress atatus
        ?>        
        
        <div class=""> 
            <span>
                <?php 
                    if ($progress[$fullLocalePath] == "true")
                        echo "Lesson is now under progress"; 
                    else
                        echo "Trnaslation of lesson haven't been started";
                ?>
            </span> 
        </div>
        <?php
            }
         ?>
        <div class=""> 
            <span>
                <?php 
                
                    echo "<a href='../../../translating.php?lesson=$lessonId&lfrom=en_US&ltranslate=$locale' > <span class='lessonh'> Translate Lesson " . $title . " to " .$lang ."  </span> </a>";
                
                ?>
            </span> 
        </div>
    </div>    

    <?php
    } // Ending foreach loop
    echo "</div>"; //Closing the header div
    ?>
    <div class=""> 
        <span>
            <?php 

                echo "<span><a href='../strings/showStrByLocale.php?locale=$locale' > <span class='lessonh'>Translate Strings</span> </a></span><br/>";
                echo "<span><a href='../../turtleNews/newsTrans.php?locale=$locale' > <span class='lessonh'>Translate News</span> </a></span>";
            ?>
        </span> 
    </div>
    <?php
    function getLanguage($locale)
    {
        $lang = "English";
        if ($locale == "he_IL")
            $lang = "Hebrew";
        else if ($locale == "ru_RU")
            $lang = "Russian";
        else if ($locale == "es_AR")
            $lang = "Spanish";
        else if ($locale == "zh_CN")
            $lang = "Chinese";
        else if ($locale == "ar_JO")
            $lang = "Arabic";
        else if ($locale == "de_DE")
            $lang = "German";
        else if ($locale == "pt_BR")
            $lang = "Portuguese";
        return $lang;
    }
    ?>

