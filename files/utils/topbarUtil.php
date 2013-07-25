<?php

class topbarUtil {

    //TODO check precedence
    private $m;
    private $db;
    private $collection;
    public function printTopBar ($rootDir , $class , $login , $topbarDisplay , $languagesDisplay , $signUpDisplay ,$language ,
            $UseToBeSession , $showIcon = true)
    {
        if(session_id() == '') 
            session_start();
        if (isset($_SESSION['locale']))
            $urlRedirect = substr($_SESSION['locale'],0,2);
        else 
            $urlRedirect = "en";
       $lang       =  $urlRedirect;     
    ?>    
    
        <div class="topbar" id="topbarMainDiv" > 
                        <div class="fill" id="topbarfill">
                            <div class="container span16" id="topbarContainer"> 
                                <?php
                                    if ($showIcon)
                                    {
                                    ?>
                                <a href="<?php echo $rootDir; ?>index.php" alt="Home page"><img class="brand" id="turtleimg" lang="<?php echo $lang?>" src="<?php echo $rootDir; ?>files/turtles.png" /></a> 
                                    <?php
                                    }//Close show icon
                                    ?>
                                <ul class="nav" id="turtleHeaderUl" lang="<?php echo $lang?>"> 
                                    <?php

                                        if ($topbarDisplay['turtleacademy'] == "true")
                                        {
                                            echo "<li><a href='".$rootDir."index.php'><strong>"; echo _("TurtleAcademy"); echo "</strong></a></li>";
                                        }
                                        if (isset($topbarDisplay['exercise']) && $topbarDisplay['exercise'] == "true") 
                                        {
                                            echo "<li><a href='".$rootDir."learn.php'><strong>"; echo _("Lessons"); echo "</strong></a></li>";
                                        }
                                        if ($topbarDisplay['helpus'] == "true")
                                        {
                                            echo "<li><a href='".$rootDir."needed.php'><strong>"; echo _("Help Us"); echo "</strong></a></li>";
                                        }
                                        if ($topbarDisplay['playground'] == "true")
                                        {
                                            echo "<li><a href='".$rootDir."playground/" .$urlRedirect ."'><strong>"; echo _("Playground"); echo "</strong></a></li>";
                                        } 
                                        if ($topbarDisplay['news'] == "true")
                                        {
                                            echo "<li><a href='".$rootDir."turtlenews.php'><strong>"; echo _("News"); echo "</strong></a></li>";
                                        }
                                        if ($topbarDisplay['forum'] == "true")
                                        {
                                            echo "<li><a href='".$rootDir."forum.php'><strong>"; echo _("Forums"); echo "</strong></a></li>";
                                        }
                                        if ($topbarDisplay['about'] == "true")
                                        {
                                            echo "<li><a href='".$rootDir."project/doc'><strong>"; echo  _("About"); echo "</strong></a></li>";
                                        }
                                    ?>
                                </ul> 
                                <?php
                                    if ($languagesDisplay == "true")
                                    {
                                ?>

                                <form class="<?php  
                                                    echo $class . " form-inline";                                
                                            ?>" action="" id="turtleHeaderLanguage" lang="<?php echo $lang?>">  
                                    <select name="selectedLanguage" id="selectedLanguage" style="width:120px;"> 
                                        <option value='<?php echo $language['en']; ?>' data-image="<?php echo $rootDir; ?>Images/msdropdown/icons/blank.gif" data-imagecss="flag us" data-title="United States">English</option>
                                        <option value='<?php echo $language['es']; ?>' data-image="<?php echo $rootDir; ?>Images/msdropdown/icons/blank.gif" data-imagecss="flag es" data-title="Spain">Español</option>
                                        <option value='<?php echo $language['he']; ?>' data-image="<?php echo $rootDir; ?>Images/msdropdown/icons/blank.gif" data-imagecss="flag il" data-title="Israel">עברית</option>
                                        <option value='<?php echo $language['zh']; ?>' data-image="<?php echo $rootDir; ?>Images/msdropdown/icons/blank.gif" data-imagecss="flag cn" data-title="China">中文</option>
                                        <option value='<?php echo $language['ru']; ?>' data-image="<?php echo $rootDir; ?>Images/msdropdown/icons/blank.gif" data-imagecss="flag ru" data-title="Russain">Русский</option>
                                    </select>
                                </form>       
                                <?php
                                    }//End if language display
                                    if (isset($_SESSION['username']))
                                    {  
                                ?>                       
                                    <!--  <p class="pull-right">Hello <a href="#"> -->
                                            <nav class="<?php echo $login ?>"  id="turtleHeaderLoggedUser">
                                                <ul class="nav nav-pills <?php echo $login ?>" id="loggedUserUl">

                                                    <li style="padding: 10px 10px 11px;"> <?php echo _("Hello");?></li>
                                                    <li class="cc-button-group btn-group"> 
                                                        <a class="dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" >
                                                        <?php
                                                            $displayUserName    = $_SESSION['username'];  
                                                            if (isset($_SESSION['isOpenID']))
                                                            {
                                                                $emailDetails = explode('@',$_SESSION['username']);
                                                                $displayUserName = $emailDetails[0];
                                                            }
                                                                echo $displayUserName;
                                                        ?>                                               
                                                        </a>
                                                        <ul class="dropdown-menu" id="ddmenu"role="menu" aria-labelledby="dLabel">
                                                            <li><a tabindex="-1" href="/users.php"   class="innerLink" id="help-nav"><?php echo _("My account");?></a></li>
                                                            <li><a tabindex="-1" href="/project/doc" class="innerLink" id="hel-nav"><?php echo _("Help");?></a></li>
                                                            <li><a href="<?php echo $rootDir; ?>logout.php" class="innerLink"><?php echo _("Log out");?></a></li>
                                                        </ul>
                                                    </li>
                                                </ul> 
                                            </nav>                                                                     

                                <?php
                                    }
                                    else
                                    {
                                        //Only if need to display signup button
                                        if($signUpDisplay == "true")
                                        {
                                ?>       
                                        <ul class="nav <?php echo $login ?>" id="turtleHeaderLogIn" lang="<?php echo $lang?>"> 
                                            <li> <a class='nava' href="<?php echo $rootDir; ?>registration.php" id="turtleHeaderUlLogin" lang="<?php echo $lang?>"><strong><?php echo _("Login");?></strong></a></li> 
                                            <!--<button id="menuRegBtn"><?php echo _("Sign Up for free");?></button> -->
                                            <li id="registrateBtn" ><a id="menuRegBtn" href="<?php echo $rootDir; ?>registration.php" ><?php echo _("Sign Up for free");?></a></li>
                                        </ul>                         
                                <?php
                                        } //End of if condition ? show signUP
                                    }
                                ?> 
                            </div> 
                        </div>            
                    </div> <!-- End of Top menu --> 
        <?php
    }  
}
