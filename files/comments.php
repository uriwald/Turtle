<?php
if (session_id() == '')
    session_start();
require_once("../environment.php");
require_once("../localization.php");
require_once("cssUtils.php");
require_once("utils/languageUtil.php");
require_once('utils/topbarUtil.php');
require_once('utils/programUtil.php');
?>
<link rel="stylesheet" href="<?php echo $sitePath; ?>/files/codemirror/lib/codemirror_turtle.css">
<?php
    $logged_in_user = false;
    $sendTo = "";
    if (isset($_SESSION['username']))
    {
        $logged_in_user = true;
        $sendTo = $_SESSION['username'];
    }
    $sendTo = "";
    $programId = $_GET['programid'];
    $m = new Mongo();
    $db = $m->turtleTestDb;
    $programs = "programs";
    $programsCollection = $db->$programs;
    $theObjId = new MongoId($programId);
    $criteria = $programsCollection->findOne(array("_id" => $theObjId));
    $programName = $criteria['programName'];
    $bodytag = str_replace("\n", "↵", $criteria['code']);                    
?>
                <?php
                    if ($logged_in_user)
                    {
                ?>
                <form id="add_comment_form"> 
                        <textarea id="commentTxtArea" placeholder="Add comment to the program.."></textarea>
                        <input id="btn_comment" type="button" value="submit comment" class="btn small info pressed"></input>
                </form>
                <?php
                    }
                    else{
                ?>
<div><span> You must <a href="<?php echo $rootDir . "registration.php";?>">login</a> to comment</span></div>
                <?php
                    }
                 ?> 
                </div>
                <div id="numOfComments">
                    <?php echo $criteria['numOfComments']; echo " " ; echo "Comments"?>
                </div>
                <div id ="user-comments">
                   <?php
                        $comments = programUtil::findProgramComments($theObjId);
                        //print_r($comments); 
                        if (is_array($comments) )
                        {
                            foreach ($comments as $comment)
                            {
                                echo "<div class='comment-contain'>";
                                    echo "<div class='comment-title'>"; 
                                         echo "<span>";
                                         ?>
                                         <a class='' href="<?php
                                                echo $rootDir . "users/profile/";
                                                echo $comment['user'];
                                                ?>"> 
                                                 <?php echo $comment['user']; ?>
                                         </a>
                                         <?php
                                         echo "</span>";    
                                         echo "<span class='title-time'>"; 
                                            $date = new DateTime($comment['time']);
                                            echo $date->format('Y-m-d');
                                         echo "</span>"; 
                                    echo "</div>";
                                    echo "<div class='comment-content'>"; 
                                        echo "<p>";
                                            echo $comment['comment'];
                                        echo "</p>";
                                    echo "</div>";
                                echo "</div>";  // Closing of comment-contain
                            }
                        }
                   ?>
                </div>
                <script>      
                          $("#btn_comment").click(function() {  
        //programid username
        if (username != null)
            {
                var saveCommentUrl  = sitePath + "files/saveProgramComment.php";
                var updateMsgUrl    = sitePath + "files/messages/saveNewMessage.php";
                var cmt = $("#commentTxtArea").val();
                $.ajax({
                    type : 'POST',
                    url : saveCommentUrl,
                    dataType : 'json',
                    data: {
                        comment         : cmt,
                        programid       : programid,
                        username        : username
                    },

                    success : function(data){
                        //alert('success');
                        $("#comments").load(sitePath + 'files/comments.php?programid=' + programid);
                    },       
                    error : function(XMLHttpRequest, textStatus, errorThrown) {
                        alert('fail');  
                    }
                });
                $.ajax({
                    type : 'POST',
                    url : updateMsgUrl,
                    dataType : 'json',
                    data: {
                        comment         : cmt,
                        programid       : programid,
                        username        : username,
                        programCreator  : programCreator,
                        programSubject  : '<?php echo $criteria['programName'];?>'
                    },
                    success : function(data){
                        alert('success');
                        $("#comments").load(sitePath + 'files/comments.php?programid=' + programid);
                    },       
                    error : function(XMLHttpRequest, textStatus, errorThrown) {
                        alert(XMLHttpRequest.responseText);  
                    }
                });
            }
         else{
             alert('Only register users can comment');
         }
    });
    </script>