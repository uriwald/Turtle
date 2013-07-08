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
        $urlRedirect = substr($_SESSION['locale'],0,2);
    ?>    
    
        <div class="topbar" id="topbarMainDiv"> 
                        <div class="fill" id="topbarfill">
                            <div class="container span16" id="topbarContainer"> 
                                <?php
                                    if ($showIcon)
                                    {
                                    ?>
                                <a href="<?php echo $rootDir; ?>index.php" ><img class="brand" id="turtleimg" src="<?php echo $rootDir; ?>files/turtles.png" alt="Home page"/></a> 
                                    <?php
                                    }//Close show icon
                                    ?>
                                <ul class="nav" id="turtleHeaderUl"> 
                                    <?php
                                        if (isset($topbarDisplay['exercise']) && $topbarDisplay['exercise'] == "true") 
                                        {
                                            echo "<li class='navli'><a class='nava' id='navaa' href='".$rootDir."learn.php'><b>"; echo _("Lessons"); echo "</b></a></li>";
                                        }
                                        if ($topbarDisplay['turtleacademy'] == "true")
                                        {
                                            echo "<li class='navli'><a class='nava' id='navaa' href='".$rootDir."index.php'><b>"; echo _("TurtleAcademy"); echo "</b></a></li>";
                                        }
                                        if ($topbarDisplay['helpus'] == "true")
                                        {
                                            echo "<li class='navli'><a class='nava' id='navab' href='".$rootDir."needed.php'><b>"; echo _("Help Us"); echo "</b></a></li>";
                                        }
                                        if ($topbarDisplay['playground'] == "true")
                                        {
                                            echo "<li class='navli'><a class='nava' id='navac' href='".$rootDir."playground/" .$urlRedirect ."'><b>"; echo _("Playground"); echo "</b></a></li>";
                                        } 
                                        if ($topbarDisplay['news'] == "true")
                                        {
                                            echo "<li class='navli'><a class='nava' id='navad' href='".$rootDir."turtlenews.php'><b>"; echo _("News"); echo "</b></a></li>";
                                        }
                                        if ($topbarDisplay['forum'] == "true")
                                        {
                                            echo "<li class='navli'><a class='nava' id='navae' href='".$rootDir."forum.php'><b>"; echo _("Forums"); echo "</b></a></li>";
                                        }
                                        if ($topbarDisplay['about'] == "true")
                                        {
                                            echo "<li class='navli'><a class='nava' id='navaf' href='".$rootDir."project/doc'><b>"; echo  _("About"); echo "</b></a></li>";
                                        }
                                    ?>
                                </ul> 
                                <?php
                                    if ($languagesDisplay == "true")
                                    {
                                ?>

                                <form class="<?php  
                                                    echo $class . " form-inline";                                
                                            ?>" action="" id="turtleHeaderLanguage">  
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
                                        <ul class="nav <?php echo $login ?>" id="turtleHeaderUl"> 

                                            <li class="navli"> <a class='nava' href="<?php echo $rootDir; ?>registration.php" id="turtleHeaderUlLogin"><b><?php echo _("Login");?></b></a></li> 
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
