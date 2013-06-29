<?php

class topbarUtil {
    //TODO check precedence
    private $m;
    private $db;
    private $collection;
    public function printTopBar ($rootDir , $class , $login , $topbarDisplay , $languagesDisplay , $_SESSION)
    {
    ?>    
    
        <div class="topbar" id="topbarMainDiv"> 
                        <div class="fill" id="topbarfill">
                            <div class="container span16" id="topbarContainer"> 
                                <img class="brand" id="turtleimg" src="<?php echo $rootDir; ?>files/turtles.png" alt="צב במשקפיים">

                                <ul class="nav" id="turtleHeaderUl"> 
                                    <?php
                                        if ($topbarDisplay['turtleacademy'] == "true")
                                        {
                                            echo "<li><a href='".$rootDir."index.php'>"; echo _("TurtleAcademy"); echo "</a></li>";
                                        }
                                        if ($topbarDisplay['helpus'] == "true")
                                        {
                                            echo "<li><a href='".$rootDir."needed.php'>"; echo _("Help Us"); echo "</a></li>";
                                        }
                                        if ($topbarDisplay['playground'] == "true")
                                        {
                                            echo "<li><a href='".$rootDir."playground'>"; echo _("Playground"); echo "</a></li>";
                                        }
                                        if ($topbarDisplay['news'] == "true")
                                        {
                                            echo "<li><a href='".$rootDir."forum.php'>"; echo _("News"); echo "</a></li>";
                                        }
                                        if ($topbarDisplay['about'] == "true")
                                        {
                                            echo "<li><a href='".$rootDir."inturtlenewsdex.php'>"; echo  _("About"); echo "</a></li>";
                                        }

   
                                    ?>
                                    <!--
                                    <li><a href="<?php echo $rootDir; ?>index.php" ><?php echo _("TurtleAcademy");?></a></li> 
                                    <li><a href="<?php echo $rootDir; ?>needed.php" ><?php echo _("Help Us");?></a></li> 
                                    <li><a href="<?php echo $rootDir; ?>playground" ><?php echo _("Playground");?></a></li>
                                    <li><a href="<?php echo $rootDir; ?>forum.php" ><?php echo _("Forums");?></a></li>
                                    <li><a href="<?php echo $rootDir; ?>turtlenews.php" ><?php echo _("News");?></a></li>
                                    <li><a href="<?php echo $rootDir; ?>project/doc" ><?php echo _("About");?></a></li>
                                  <li class="active"><a href="index.html"><?php echo _("Sample");?></a></li> -->
                                </ul> 
                                <?php
                                    if ($languagesDisplay == "true")
                                    {
                                ?>

                                <form class="<?php  
                                                    echo $class . " form-inline";                                
                                            ?>" action="" id="turtleHeaderLanguage">  
                                    <select name="selectedLanguage" id="selectedLanguage" style="width:120px;"> 
                                        <option value='en' data-image="<?php echo $rootDir; ?>Images/msdropdown/icons/blank.gif" data-imagecss="flag us" data-title="United States">English</option>
                                        <option value='es' data-image="<?php echo $rootDir; ?>Images/msdropdown/icons/blank.gif" data-imagecss="flag es" data-title="Spain">Español</option>
                                        <option value='he' data-image="<?php echo $rootDir; ?>Images/msdropdown/icons/blank.gif" data-imagecss="flag il" data-title="Israel">עברית</option>
                                        <option value='zh' data-image="<?php echo $rootDir; ?>Images/msdropdown/icons/blank.gif" data-imagecss="flag cn" data-title="China">中文</option>
                                        <option value='ru' data-image="<?php echo $rootDir; ?>Images/msdropdown/icons/blank.gif" data-imagecss="flag ru" data-title="Russain">Русский</option>
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
                                ?>       
                                        <ul class="nav <?php echo $login ?>" id="turtleHeaderUl"> 

                                            <li><a href="<?php echo $rootDir; ?>registration.php" id="turtleHeaderUlLogin"><?php echo _("Login");?></a></li> 
                                            <li><a class='btn primary large' href="<?php echo $rootDir; ?>registration.php" ><?php echo _("Sign Up for free");?></a></li> 
                                        </ul>                         
                                <?php
                                    }
                                ?>
                            </div>
                        </div>            
                    </div> <!-- End of Top menu --> 
        <?php
    }  
}
