
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
        <div class="container">
            

            <div id="the_gist" class="span11">
                <h1>The Gist : </h1>
                <p>
                    We (Turtle academy, Inc.) run an online service called TurtleAcademy, found at www.turtleacademy.com ("Website").
                    We’re excited for you to try it out. Everything on TurtleAcademy is currently free, with premium services a possibility in the future.
                    All of your Content (as defined below) can be shared with the public and may be shared automatically.
                    Please be careful to review how all of your Content is being shared to ensure you are vigilant in protecting your privacy.
                    If you have any questions, feel free to contact us.
                </p>
            </div>
            <div id="the_terms" class="span11">
                <h1>Terms of Service: </h1>
                <p>
                    The following terms and conditions govern all use of the website and all Content, services and products available at or through the Website.
                    For purposes of these Terms of Service, the term “Content” includes, without limitation , written posts and comments, information, data, text, photographs, software, scripts, graphics, and interactive features generated, provided, or otherwise made accessible on or through this Website.
                    The Website is owned and operated by Turtle academy, Inc. (“Turtle academy”). The Website is offered subject to your acceptance without modification of all of the terms and conditions contained herein and all other operating rules, policies (including, without limitation) and procedures that may be published from time to time on this Site by Turtle academy (collectively, the “Agreement”).
                    Please read this Agreement carefully before accessing or using the Website. By accessing or using any part of the web site, you agree to become bound by the terms and conditions of this agreement. If you do not agree to all the terms and conditions of this agreement, then you may not access the Website or use any services. If these terms and conditions are considered an offer by Turtle academy, acceptance is expressly limited to these terms. The Website is available only to individuals who are at least 7 years old.
                </p>
                <p>
                    <b>1.	Your turtleacademy.com Account and Site.</b> If you create an account on the Website, you are responsible for maintaining the security of your account and you are fully responsible for all activities that occur under the account and any other actions taken in connection with the account. You must immediately notify Turtle academy of any unauthorized uses of your account or any other breaches of security. Turtle academy will not be liable for any acts or omissions by You, including any damages of any kind incurred as a result of such acts or omissions.  
                </p>
                <p>
                    2.	By submitting Content to Turtle academy, you grant Turtle academy a world-wide, royalty-free, and non-exclusive license to reproduce, modify, adapt and publish the Content solely for the purpose of displaying, distributing and promoting your Content. If you delete Content, Turtle academy will use reasonable efforts to remove it from the Website, but you acknowledge that caching or references to the Content may not be made immediately unavailable.
                </p>
                <p>
                    3.	From time to time, we may solicit users of the Website, including you, to contribute to and create new lessons. You hereby grant us the right to own all right, title and interest (including patent rights, copyright rights, trade secret rights, mask work rights, trademark rights, sui generis database rights and all other rights of any sort throughout the world) to any and all Contributions you make to the Website, and you hereby make all assignments necessary to accomplish the foregoing ownership.
                    To the extent allowed by law, you also agree to waive all rights of paternity, integrity, disclosure and withdrawal and any other rights that may be known as or referred to as “moral rights,” “artist’s rights,” “droit moral,” or the like with respect to any Contributions you make.
                </p>
                <p>
                    4.	Without limiting any of those representations or warranties, Turtle academy has the right (though not the obligation) to, in Turtle academy sole discretion (i) refuse or remove any content that, in Turtle academy reasonable opinion, violates any Turtle academy policy or is in any way harmful or objectionable, or (ii) terminate or deny access to and use of the Website to any individual or entity for any reason, in Turtle academy sole discretion. Turtle academy will have no obligation to provide a refund of any amounts previously paid.
                </p>    
                <p>
                    5.	<b>Copyright Infringement and DMCA Policy.</b> As Turtle academy asks others to respect its intellectual property rights, it respects the intellectual property rights of others. If you believe that material located on or linked to by the Website violates your copyright, you are encouraged to notify Turtle academy in accordance with Turtle academy Digital Millennium Copyright Act (“DMCA”) Policy. Turtle academy will respond to all such notices, including as required or appropriate by removing the infringing material or disabling all links to the infringing material. Turtle academy will terminate a visitor’s access to and use of the Website if, under appropriate circumstances, the visitor is determined to be a repeat infringer of the copyrights or other intellectual property rights of Turtle academy or others. 
                </p>
                <p>
                    6.	<b>Intellectual Property.</b> This Agreement does not transfer from Turtle academy to you any Turtle academy or third party intellectual property, and all right, title and interest in and to such property will remain (as between the parties) solely with Turtle academy turtleacademy.com, the Website logo, and all other trademarks, service marks, graphics and logos used in connection with the Website are trademarks or registered trademarks of Turtle academy or Turtle academy licensors. Other trademarks, service marks, graphics and logos used in connection with the Website may be the trademarks of other third parties. Your use of the Website grants you no right or license to reproduce or otherwise use any Turtle academy or third-party trademarks.
                </p>
                <p>
                    7.	<b>Advertisements.</b> Turtle academy reserves the right to display advertisements on Turtleacademy
                </p>
                <p>
                    8.	<b>Changes.</b> Turtle academy reserves the right, at its sole discretion, to modify or replace any part of this Agreement. It is your responsibility to check this Agreement periodically for changes. Your continued use of or access to the Website following the posting of any changes to this Agreement constitutes acceptance of those changes. Turtle academy may also, in the future, offer new services and/or features through the Website (including, the release of new tools and resources). Such new features and/or services shall be subject to the terms and conditions of this Agreement.
                </p>
                <p>
                    9.	<b>Termination.</b> Turtle academy may terminate your access to all or any part of the Website at any time, with or without cause, with or without notice, effective immediately. If you wish to terminate this Agreement or your Website account (if you have one), you may simply discontinue using the Website. All provisions of this Agreement which by their nature should survive termination shall survive termination, including, without limitation, ownership provisions, warranty disclaimers, indemnity and limitations of liability.
                </p>
                <p>
                    10.	<b>Disclaimer of Warranties.</b> The Website is provided “as is”. Turtle academy and its suppliers and licensors hereby disclaim all warranties of any kind, express or implied, including, without limitation, the warranties of merchantability, fitness for a particular purpose and non-infringement. Neither Turtle academy nor its suppliers and licensors, makes any warranty that the Website will be error free or that access thereto will be continuous or uninterrupted. You understand that you download from, or otherwise obtain content or services through, the Website at your own discretion and risk.
                </p>
                <p>
                    11.	<b>Limitation of Liability.</b> In no event will Turtle academy, or its suppliers or licensors, be liable with respect to any subject matter of this agreement under any contract, negligence, strict liability or other legal or equitable theory for: (i) any special, incidental or consequential damages; (ii) the cost of procurement or substitute products or services; (iii) for interruption of use or loss or corruption of data; or (iv) for any amounts that exceed the fees paid by you to Turtle academy under this agreement during the twelve (12) month period prior to the cause of action. Turtle academy shall have no liability for any failure or delay due to matters beyond their reasonable control. The foregoing shall not apply to the extent prohibited by applicable law.
                </p>
                <p>
                    12.	<b>General Representation and Warranty.</b> You represent and warrant that (i) your use of the Website will be in strict accordance with the Turtle academy Privacy Policy, with this Agreement and with all applicable laws and regulations (including without limitation any local laws or regulations in your country, state, city, or other governmental area, regarding online conduct and acceptable content, and including all applicable laws regarding the transmission of technical data exported from the United States or the country in which you reside) and (ii) your use of the Website will not infringe or misappropriate the intellectual property rights of any third party.
                </p>
                <p>
                    13.	<b>Indemnification.</b> You agree to indemnify and hold harmless Turtle academy, its contractors, and its licensors, and their respective directors, officers, employees and agents from and against any and all claims and expenses, including attorneys’ fees, arising out of your use of the Website, including but not limited to your violation of this Agreement.  
                </p>
                <p>
                    14.	<b>Miscellaneous.</b> This Agreement constitutes the entire agreement between Turtle academy and you concerning the subject matter hereof, and they may only be modified by a written amendment signed by an authorized executive of Turtle academy, or by the posting by Turtle academy of a revised version.
                </p>
            </div>
        </div> <!-- End container div -->
    </body>    
</html>