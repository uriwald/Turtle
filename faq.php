
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">
    <?php
    require_once("environment.php");
    require_once("localization.php");
    require_once("files/footer.php");
    require_once('files/utils/topbarUtil.php');
    require_once("files/faq/faqSideNav.php");
    
    
    ?>

<html dir="<?php echo $dir ?>" lang="<?php echo $lang ?>"> 
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>
            <?php
            echo _("Turtle Academy - learn logo programming in your browser");
            echo _(" free programming materials for kids");
            ?>  
        </title>     
        <?php
            require_once("files/utils/includeCssAndJsFiles.php"); 
            includeCssAndJsFiles::include_all_page_files("faq");
            //echo "<link rel='stylesheet' href='/files/css/index.css' type='text/css' media='all'/>";

            // Case user logged in we will clear the storage data and load it from db
            $is_user_log_in = isset($_SESSION['username']);
            if ($is_user_log_in) {
                ?>   
                <script type="application/javascript" src="<?php echo $root_dir; ?>clearStorageData.php"></script>
                <?php 
            }
        ?>
          
    </head>
    <body>
        <div id="main">       
            <?php
                //Printing the topbar menu
                topbarUtil::print_topbar("faq");
                //Get fuc items
                $m                  = new Mongo();
                $db                 = $m->turtleTestDb;
                $strcol             = $db->faq;
                $faqs               = $strcol->find();
                //
                $faqsTypeA          =   array();
                $faqsTypeB          =   array();
                $faqsTypeC          =   array();
                $faqsTypeD          =   array();
                $faqsTypeE          =   array();
                
                $faqs->sort(array('precedence' => 1));
                
                function printFaqSectionItems($faqArray)
                {
                    global $locale,$lang;
                    foreach ($faqArray as $faq)
                    {                               
                    ?>
                        <li>
                            <a href="<?php echo $GLOBALS['root_dir']; ?>articles/<?php echo $faq['id']; ?>/<?php echo $lang ;?>">
                                <?php 
                                    if (isset($faq['question'][$locale]) && strlen($faq['question'][$locale]) > 3)
                                        echo $faq['question'][$locale]; 
                                    else
                                        echo  $faq['question']['en_US']; 
                                ?>
                            </a>
                        </li>
                    <?php
                    }
                }
                foreach ($faqs as $faq)
                {
                    //echo $faq['question']['en_US'];
                    $type   =  $faq['type'];
                    switch ($type) {
                        case 1:
                            array_push($faqsTypeA, $faq);
                            break;
                        case 2:
                            array_push($faqsTypeB, $faq);
                            break;
                        case 3:
                            array_push($faqsTypeC, $faq);
                            break;
                        case 4:
                            array_push($faqsTypeD, $faq);
                            break;
                        case 5:
                            array_push($faqsTypeE, $faq);
                            break;
                    }
                }
                
            ?>
            <div class="contianer">
                <div id="margin" class ="span5">
                    
                </div>
                <div id="faq-main" class="span15" lang="<?php echo $lang; ?>">
                    <table>
                        <tbody>
                            <tr>
                                
                                <td class="span7">
                                    <div>
                                        <h2>
                                             <?php echo _("About Turtle Academy"); ?>
                                        </h2>
                                        <ul>
                                        <?php 
                                            printFaqSectionItems($faqsTypeA); 
                                        ?>
                                        </ul>
                                    </div>  

                                </td>
                                <td class="span7">
                                    <div>
                                        <h2>
                                            <?php echo _("Using Turtle Academy site"); ?>
                                            
                                        </h2>
                                        <ul>
                                        <?php 
                                            printFaqSectionItems($faqsTypeB); 
                                        ?>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="span7">
                                    <div>
                                        <h2>
                                            <?php echo _("Volunteering"); ?>
                                            
                                        </h2>
                                        <ul>
                                            <li>
                                        <?php 
                                            printFaqSectionItems($faqsTypeC); 
                                        ?>
                                        </ul>
                                    </div>                                     
                                </td>
                                <td class="span7">
                                    <div>
                                        <h2>
                                            <?php echo _("Turtle Academy for teachers"); ?>
                                            
                                        </h2>
                                        <ul>
                                        <?php 
                                            printFaqSectionItems($faqsTypeD); 
                                        ?>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                        </tbody>
                    </table>

                </div> <!-- Close of support main -->
                <?php
                    echo $sideNav;
                ?>
                <!--
                <div id="support-side" class="span6">
                    <table>
                        <tbody>
                            <tr>
                                
                                <td class="span7">
                                    <div>
                                        <h2>
                                             <?php echo _("Contact Us"); ?>
                                        </h2>
                                        <ul>
                                            <li>
                                                    <a href="<?php echo $GLOBALS['root_dir']; ?>articles/<?php echo $faq['id']; ?>"><?php echo  _("Report a problem") ?></a>
                                            </li>
                                            <li>
                                                    <a href="<?php echo $GLOBALS['root_dir']; ?>articles/<?php echo $faq['id']; ?>"><?php echo  _("Submit a comment") ?></a>
                                            </li>
                                            <li>
                                                    <a href="<?php echo $GLOBALS['root_dir']; ?>articles/<?php echo $faq['id']; ?>"><?php echo  _("Suggest a feature") ?></a>
                                            </li>
                                        </ul>
                                    </div>  

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div> -->
            </div> <!-- Close of Container div -->

        </div> <!-- Close faq main -->

        <script> 
            $(document).ready(function() {
                selectLanguage("<?php echo $_SESSION['locale']; ?>" ,  "<?php echo $root_dir; ?>language/", "index.php" ,"en" ); 
                // Definition for people opinion carousel
                $('.carousel').carousel({
                    interval: 15000 
                })
                $("#myCarousel").carousel('cycle');
                $('#myCarousel').hover(function () {   
                    $(this).carousel('pause')
                    $(this).carousel(0)
                })
                // End of Definition for people opinion carousel
            });
        </script>
    </body>
</html> 