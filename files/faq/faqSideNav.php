<?php
$reportproblem      = "<a href='" . $GLOBALS['sitePath'] . "/files/faq/faqReportProblem.php'>" . _("Report a problem") . "</a>";
$submitcomment      = "<a href='" . $GLOBALS['sitePath'] . "/files/faq/faqComment.php'>" . _("Submit a comment") . "</a>";
$suggestfeature     = "<a href='" . $GLOBALS['sitePath'] . "files/faq/faqSuggestFeature.php'>" . _("Suggest a feature") . "</a>";
$sideNav ="<div id='support-side' class='span6'>
                    <table>
                        <tbody>
                            <tr> 
                                <td class='span7'>
                                    <div>
                                        <h2>
                                             " . _("Contact Us") ."
                                        </h2>
                                        <ul>
                                            <li> " . $reportproblem . "
                                            </li>
                                            <li> " . $submitcomment . "
                                            </li>
                                            <li> " . $suggestfeature . "
                                            </li>
                                        </ul>
                                    </div>  

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>";
?>