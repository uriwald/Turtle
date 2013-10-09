<?php

class topbarUtil {
    public static function printTopBar($topbarPage)
    {
        global $rootDir;
        $topbarSpanSize = 16;
           //Topbar menu display items
            $topbarDisplay = array (
                "turtleacademy" => false,
                "exercise" => false,
                "helpus" => false,
                "playground" => false,
                "forum" => false,
                "news" => false,
                "about" => false,
                "sample" => false
            );

            $signUpDisplay = true;
            $languagesDisplay = true;

            $language = array(
                "en" => "en",
                "de" => "de",
                "es" => "es",
                "fi" => "fi",
                "pt" => "pt",
                "pl" => "pl",
                "ru" => "ru",
                "he" => "he",              
                "zh" => "zh"
                );
            //Will be sorted in the correct order 
            $displaylanguage = array(
                "en" => true,
                "de" => false,
                "es" => true,
                "pt" => false,
                "pl" => false,
                "fi" => false,
                "ru" => true,
                "he" => true,
                "zh" => true   
            );
            $countryFlagName = array(
                "en" => "us",
                "de" => "de",
                "es" => "es",
                "fi" => "fi", 
                "pt" => "br",
                "pl" => "pl",
                "ru" => "ru",
                "he" => "il",
                "zh" => "cn"
                     
            );
            $countryNativeName = array(
                "en" => "English",
                "ru" => "Русский",
                "es" => "Español",
                "fi" => "Finnish",
                "zh" => "中文",
                "he" => "עברית",
                "de" => "Deutsch",
                "pt" => "br",
                "pl" => "polish"
            );
            switch ($topbarPage) {
                case "learn": 
                     $topbarDisplay['playground'] = true ; 
                     $topbarDisplay['news'] = true ; $topbarDisplay['about'] = true ; 
                     $displaylanguage['de'] = true ; $displaylanguage['pt'] = true; $displaylanguage['pl']=true;$displaylanguage['fi']=true;
                    break;
                case "index":
                    $signUpDisplay = false;
                    $topbarDisplay['playground'] = true ; 
                    $topbarDisplay['news'] = true ; $topbarDisplay['about'] = true ; 
                    $topbarDisplay['exercise'] = true ;
                    break;
                case "playground":
                    $topbarDisplay['about'] = true ; 
                    $topbarDisplay['exercise'] = true ;
                    break;
                case "institute":
                    $signUpDisplay = true;
                    $languagesDisplay = false;
                case "users":
                    $topbarDisplay['about'] = true ; 
                    $topbarDisplay['exercise'] = true ;
                case "registration":
                    $signUpDisplay = false;
                    $topbarDisplay['about'] = true ; 
                    $topbarDisplay['exercise'] = true ;
                    $language['en'] = "en_US"; $language['ru'] = "ru_RU"; $language['he'] = "he_IL";
                    $language['es'] = "es_AR"; $language['zh'] = "zh_CN"; $language['de'] = "de_DE"; 
                    $language['pt'] = "pt_BR"; $language['pl'] = "pl_PL";
                    $topbarSpanSize = 13;
                    break;
                case "news":
                    $topbarDisplay['turtleacademy'] = true ; 
                    $topbarDisplay['exercise'] = true ;
                    break;
                case "documentation":
                    $topbarDisplay['turtleacademy'] = true ; 
                    $topbarDisplay['exercise'] = true ;
                    break;                
                
                
            }        
            topbarUtil::printTopBarSelected($rootDir, $topbarDisplay, $languagesDisplay , $signUpDisplay, 
                    $language ,$topbarSpanSize , $displaylanguage , $countryNativeName , $countryFlagName);
    }
     private static function printTopBarSelected($rootDir, $topbarDisplay, $langDropDown, $signUpDisplay,
             $language,$topbarSpanSize ,$displaylanguage , $countryNativeName , $countryFlagName , $showTurtleIcon = true) 
    {
        global $cssleft, $cssright, $lang;
        ?>    
        <div class="topbar" id="topbarMainDiv" > 
            <div class="fill" id="topbarfill">
                <div class="container span<?php echo $topbarSpanSize; ?>" id="topbarContainer"> 
                    <?php
                    if ($showTurtleIcon) {
                        ?>
                        <a href="<?php echo $rootDir; ?>index.php" alt="Home page"><img class="brand" id="turtleimg" lang="<?php echo $lang ?>" src="<?php echo $rootDir; ?>files/turtles.png" /></a> 
                        <?php
                    }//Close show icon
                    ?>
                    <ul class="nav" id="turtleHeaderUl" lang="<?php echo $lang ?>"> 
                        <?php
                        if ($topbarDisplay['turtleacademy'] == "true") {
                            echo "<li><a href='" . $rootDir . "index.php'>";
                            echo _("TurtleAcademy");
                            echo "</a></li>";
                        }
                        if (isset($topbarDisplay['exercise']) && $topbarDisplay['exercise'] == "true") {
                            echo "<li><a href='" . $rootDir . "learn.php'>";
                            echo _("Lessons");
                            echo "</a></li>";
                        }
                        if ($topbarDisplay['helpus'] == "true") {
                            echo "<li><a href='" . $rootDir . "needed.php'>";
                            echo _("Help Us");
                            echo "</a></li>";
                        }
                        if ($topbarDisplay['playground'] == "true") {
                            echo "<li><a href='" . $rootDir . "playground/" . $lang . "'>";
                            echo _("Playground");
                            echo "</a></li>";
                        }
                        if ($topbarDisplay['news'] == "true") {
                            echo "<li><a href='" . $rootDir . "turtlenews.php'>";
                            echo _("News");
                            echo "</a></li>";
                        }
                        if ($topbarDisplay['forum'] == "true") {
                            echo "<li><a href='" . $rootDir . "forum.php'>";
                            echo _("Forums");
                            echo "</a></li>";
                        }
                        if ($topbarDisplay['about'] == "true") {
                            echo "<li><a href='" . $rootDir . "project/doc'>";
                            echo _("About");
                            echo "</a></li>";
                        }
                        ?>
                    </ul> 
                    <?php
                    if ($langDropDown == "true") {
                        ?>
                        <form class="<?php
                                        echo "pull-$cssleft form-inline";
                                    ?>" action="" id="turtleHeaderLanguage" lang="<?php echo $lang ?>">
                            <select name="selectedLanguage" id="selectedLanguage"> 
                            <?php
                                $blankImagePath = $rootDir . "Images/msdropdown/icons/blank.gif";
                                foreach ($language as $langKey=>$langVal)
                                {
                                    if ($displaylanguage[$langKey]) 
                                        echo "<option value='$langVal' data-image='$blankImagePath' data-imagecss='flag $countryFlagName[$langKey]' data-title='$countryNativeName[$langKey]'> $countryNativeName[$langKey] </option> ";
                                }
                            ?> 
                               <!-- 
                                <option value='<?php echo $language['en']; ?>' data-image="<?php echo $rootDir; ?>Images/msdropdown/icons/blank.gif" data-imagecss="flag us" data-title="United States">English</option>
                                <option value='<?php echo $language['de']; ?>' data-image="<?php echo $rootDir; ?>Images/msdropdown/icons/blank.gif" data-imagecss="flag de" data-title="German">Deutsch</option>
                                <option value='<?php echo $language['es']; ?>' data-image="<?php echo $rootDir; ?>Images/msdropdown/icons/blank.gif" data-imagecss="flag es" data-title="Spain">Español</option>
                                <option value='<?php echo $language['pl']; ?>' data-image="<?php echo $rootDir; ?>Images/msdropdown/icons/blank.gif" data-imagecss="flag pl" data-title="Russain">polish</option>
                                <option value='<?php echo $language['pt']; ?>' data-image="<?php echo $rootDir; ?>Images/msdropdown/icons/blank.gif" data-imagecss="flag br" data-title="Polish">Português</option>
                                <option value='<?php echo $language['ru']; ?>' data-image="<?php echo $rootDir; ?>Images/msdropdown/icons/blank.gif" data-imagecss="flag ru" data-title="Russain">Русский</option>
                                <option value='<?php echo $language['he']; ?>' data-image="<?php echo $rootDir; ?>Images/msdropdown/icons/blank.gif" data-imagecss="flag il" data-title="Israel">עברית</option>
                                <option value='<?php echo $language['zh']; ?>' data-image="<?php echo $rootDir; ?>Images/msdropdown/icons/blank.gif" data-imagecss="flag cn" data-title="China">中文</option>
                               -->
                            </select>
                        </form>       
            <?php
        }//End if language display
        //If the user is exist
        if (isset($_SESSION['username'])) {
            ?>                       
                        <nav class="<?php echo "pull-$cssright"; ?>"  id="turtleHeaderLoggedUser">
                            <ul class="nav nav-pills <?php echo "pull-$cssright"; ?>" id="loggedUserUl"> 

                                <li class="cc-button-group btn-group"> 
                                    <a class="dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" >
                                        <?php
                                        $displayUserName = $_SESSION['username'];
                                        if (isset($_SESSION['isOpenID'])) {
                                            $emailDetails = explode('@', $_SESSION['username']);
                                            $displayUserName = $emailDetails[0];
                                        }
                                        echo $displayUserName;
                                        ?>                                               
                                    </a>
                                    <ul class="dropdown-menu" id="ddusermenu"role="menu" aria-labelledby="dLabel">
                                        <li><a tabindex="-1" href="<?php echo $rootDir; ?>users.php"   class="innerLink" id="help-nav"><?php echo _("My account"); ?></a></li>
                                        <li><a tabindex="-1" href="<?php echo $rootDir; ?>project/doc" class="innerLink" id="hel-nav"><?php echo _("Help"); ?></a></li>
                                        <li><a href="<?php echo $rootDir; ?>logout.php" class="innerLink"><?php echo _("Log out"); ?></a></li>
                                    </ul>
                                </li>
                            </ul> 
                        </nav>                                                                     

            <?php
        } //End if user exist 
        else //Only if need to display signup button
        {   
            if ($signUpDisplay) {
            ?>       
                <ul class="nav <?php echo "pull-$cssright "; ?>" id="turtleHeaderLogIn" lang="<?php echo $lang ?>"> 
                    <li> <a class='nava' href="<?php echo $rootDir; ?>registration.php" id="turtleHeaderUlLogin" lang="<?php echo $lang ?>"><?php echo _("Login"); ?></a></li> 
                    <li id="registrateBtn" ><a id="menuRegBtn" href="<?php echo $rootDir; ?>registration.php" ><?php echo _("Sign Up for free"); ?></a></li>
                </ul>                         
        <?php
            } //End of if condition ? show signUP
        }
        ?> 
                </div> <!-- topbarContainer -->
            </div>    <!-- topbarfill -->        
        </div> <!-- End of Top menu --> 
<?php
    } // Close function printTopBar

} // Close class topbarUtil

            