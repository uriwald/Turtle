
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">
    <?php
    require_once("environment.php");
    require_once("localization.php");
    require_once("files/footer.php");
    require_once('files/utils/topbarUtil.php');
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
        echo "<link rel='stylesheet' href='/files/css/index.css' type='text/css' media='all'/>";

        // Case user logged in we will clear the storage data and load it from db
        $isUserLoggedIn = isset($_SESSION['username']);
        if ($isUserLoggedIn) {
            ?>   
            <script type="application/javascript" src="<?php echo $rootDir; ?>clearStorageData.php"></script>
            <?php
        }
        ?>
            <link rel='stylesheet' href='/files/css/faq.css' type='text/css' media='all'/>
    </head>
    <body>
        <div id="faq-main">       
            <?php
                //Printing the topbar menu
                topbarUtil::printTopBar("index");
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
                
                $faqs->sort(array('type' => 1));
                foreach ($faqs as $faq)
                {
                    echo $faq['question']['en_US'];
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
                <div id="faq-main" class="span16">
                    <table>
                        <tbody>
                            <tr>
                                
                                <td class="span7">
                                    <div>
                                        <h3>
                                             About Turtle Academy
                                        </h3>
                                        <ul>
                                        <?php 
                                        foreach ($faqsTypeA as $faq)
                                                {                               
                                        ?>
                                            <li>
                                                <a href="/articles/<?php echo $faq['id']; ?>"><?php echo  $faq['question']['en_US']; ?></a>
                                            </li>

                                        <?php
                                        }
                                        ?>
                                        </ul>
                                    </div>  

                                </td>
                                <td class="span7">
                                    <div>
                                        <h3>
                                            Using Turtle Academy
                                        </h3>
                                        <ul>
                                            <li>
                                                <a href="/customer/portal/articles/337790-what-is-khan-academy-">How to sign up</a>
                                            </li>
                                            <li
                                                <a href="/customer/portal/articles/337790-what-is-khan-academy-">How to reset my password</a>
                                            </li>
                                            <li></li>
                                            <li></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="span7">
                                    <div>
                                        <h3>
                                            Feedback and suggestions
                                        </h3>
                                        <ul>
                                            <li>
                                                <a href="/customer/portal/articles/337790-what-is-khan-academy-">What is Turtle Academy?</a>
                                            </li>
                                            <li
                                                <a href="/customer/portal/articles/337790-what-is-khan-academy-">How was it started?</a>
                                            </li>
                                            <li></li>
                                            <li></li>
                                        </ul>
                                    </div>                                     
                                </td>
                                <td class="span7">
                                    <div>
                                        <h3>
                                            Turtle Academy in the Classroom
                                        </h3>
                                        <ul>
                                            <li>
                                                <a href="/customer/portal/articles/337790-what-is-khan-academy-">How to sign up</a>
                                            </li>
                                            <li
                                                <a href="/customer/portal/articles/337790-what-is-khan-academy-">How to reset my password</a>
                                            </li>
                                            <li></li>
                                            <li></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                        </tbody>
                    </table>

                </div> <!-- Close of support main -->
                <div id="support-side">

                </div>

            </div> <!-- Close of Container div -->
        </div> <!-- Close faq main -->

        <script> 
            $(document).ready(function() {
                selectLanguage("<?php echo $_SESSION['locale']; ?>" ,  "<?php echo $rootDir; ?>language/", "index.php" ,"en" ); 
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