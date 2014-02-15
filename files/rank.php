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
<link rel="stylesheet" href="<?php echo $site_path; ?>/files/codemirror/lib/codemirror_turtle.css">
<?php
    $logged_in_user = false;
    $sendTo = "";
    if (isset($_SESSION['username']))
    {
        $logged_in_user = true;
        $sendTo = $_SESSION['username'];
    }
    $sendTo = "";
    $program_id = $_GET['programid'];
    $m = new Mongo();
    $db = $m->turtleTestDb;
    $programs = "programs";
    $programs_collection = $db->$programs;
    $the_object_id = new MongoId($program_id);
    $criteria = $programs_collection->findOne(array("_id" => $the_object_id));
    $program_name = $criteria['programName'];
    $bodytag = str_replace("\n", "↵", $criteria['code']);                    
?> 

<?php
$total_score        =   $criteria['totalRankScore'];
$num_of_ranks       =   $criteria['numOfRanks'];
if ($num_of_ranks == 0)
    $ave_rank = 0;
else
{
    $ave_rank           =   $total_score /  $num_of_ranks;
    $ave_rank           =   round($ave_rank, 2);
}
if ($logged_in_user)
{
    $the_object_id = new MongoId($program_id);
    $user_privous_rank = programUtil::program_rank_by_user($the_object_id , $_SESSION['username']);
    $selected_class ="";

    $please_rank_msg    =   _("Please rank");


    echo"<div id='rank_div'>";

        $span_rank = "";
        for ($i=1 ; $i<6 ; $i++)
        {
            if ($i == $user_privous_rank)
            {
                $selected_class="_active";
                $please_rank_msg =  _("Your rank") . " " .$i;
            }
            $span_rank .= "<span class='rank$selected_class' value='$i'>$i</span>";
            $selected_class="";
        
        }         
        echo "<span>" . $please_rank_msg . " " . $span_rank . "</span>";
     
    echo"</div>";
    echo "<div class='cleaner_h10'></div>";
    echo"<div id='program_score'>";
    echo "<span>" . "Average score :" .$ave_rank ."</span>     ";
    echo "<span class='tiny_rank'>" . "number of votes :" . $num_of_ranks."</span>     ";
    echo "<span class='tiny_rank'>" . "Toal score :" .$total_score ."</span>";
   
    echo"</div>";
    echo "<div class='cleaner_h10'></div>";
    //echo $user_privous_rank;
}
else{
      ?>
       <span> <?php echo _("You must"); ?> <a href="<?php echo $root_dir . "registration.php";?>"><?php echo _("login"); ?> </a> <?php echo _("to rank"); ?></span> 
    <?php  
    echo"</div>";
    echo "<div class='cleaner_h10'></div>";
    echo"<div id='program_score'>";  
    echo "<span>" . "Average score :" .$ave_rank ."</span>     ";
    echo "<span class='tiny_rank'>" . "number of votes :" . $num_of_ranks."</span>     ";
    echo "<span class='tiny_rank'>" . "Toal score :" .$total_score ."</span>";
    echo"</div>";
}
?>
<script>      
    $(".rank").click(function() {    
        var value = $( this ).text();
        save_user_rank(value);
     }); 
         function save_user_rank(value)
    {
        var saveProgramUrl  = sitePath + "files/savePorgramRank.php";
         $.ajax({
                type : 'POST',
                url : saveProgramUrl,
                dataType : 'json',
                data: {
                    programid       :   programid,
                    value           :   value,
                    username        : username
                },

                success : function(data){
                    $("#rank").load(sitePath + 'files/rank.php?programid=' + programid);             
                },       
                error : function(XMLHttpRequest, textStatus, errorThrown) {
                    alert(XMLHttpRequest.responseText);  
                }
            });
    }
</script>