<?php

//Start pagination
    function pagination($limit,$adjacents,$page,$start,$num_of_programs , $targetpage)
    {
        $limit = 15;
        $adjacents = 3;
      //if no page var is given, set start to 0
      //  $num_of_programs = $allPrograms->count();
        $total_pages = ceil($num_of_programs/$limit);
        $lastpage   = $total_pages;
        $prev = $page - 1;							//previous page is page - 1
        $next = $page + 1;							//next page is page + 1
                    //lastpage is = total pages / items per page, rounded up.
        $lpm1 = $lastpage - 1;
        //echo $num_of_programs;
        $pagination = "";
        $targetpage = curPageURL();
        if (isset($_GET['page']))
        {
            if ($page >=1 && $page < 10)
                $targetpage = substr ($targetpage, 0,  strlen ($targetpage) -2);
            elseif ($page >=10 && $page < 100)
                $targetpage = substr ($targetpage, 0,  strlen ($targetpage) -3);
            else {
              $targetpage = substr ($targetpage, 0,  strlen ($targetpage) -4);  
            }
        }
        if($lastpage > 1)
        {	
                $pagination .= "<div class=\"pagination\">";
                //previous button
                if ($page > 1) 
                        $pagination.= "<a href=\"$targetpage/$prev\">� previous</a>";
                else
                        $pagination.= "<span class=\"disabled\">� previous</span>";	

                //pages	
                if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
                {	
                        for ($counter = 1; $counter <= $lastpage; $counter++)
                        {
                                if ($counter == $page)
                                        $pagination.= "<span class=\"current\">$counter</span>";
                                else
                                        $pagination.= "<a href=\"$targetpage/$counter\">$counter</a>";					
                        }
                }
                elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
                {
                        //close to beginning; only hide later pages
                        if($page < 1 + ($adjacents * 2))		
                        {
                                for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
                                {
                                        if ($counter == $page)
                                                $pagination.= "<span class=\"current\">$counter</span>";
                                        else
                                                $pagination.= "<a href=\"$targetpage/$counter\">$counter</a>";					
                                }
                                $pagination.= "...";
                                $pagination.= "<a href=\"$targetpage/$lpm1\">$lpm1</a>";
                                $pagination.= "<a href=\"$targetpage/$lastpage\">$lastpage</a>";		
                        }
                        //in middle; hide some front and some back
                        elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
                        {
                                $pagination.= "<a href=\"$targetpage/1\">1</a>";
                                $pagination.= "<a href=\"$targetpage/2\">2</a>";
                                $pagination.= "...";
                                for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
                                {
                                        if ($counter == $page)
                                                $pagination.= "<span class=\"current\">$counter</span>";
                                        else
                                                $pagination.= "<a href=\"$targetpage/$counter\">$counter</a>";					
                                }
                                $pagination.= "...";
                                $pagination.= "<a href=\"$targetpage/$lpm1\">$lpm1</a>";
                                $pagination.= "<a href=\"$targetpage/$lastpage\">$lastpage</a>";		
                        }
                        //close to end; only hide early pages 
                        else
                        { 
                                $pagination.= "<a href=\"$targetpage\1\">1</a>";
                                $pagination.= "<a href=\"$targetpage\2\">2</a>";
                                $pagination.= "...";
                                for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
                                {
                                        if ($counter == $page)
                                                $pagination.= "<span class=\"current\">$counter</span>";
                                        else
                                                $pagination.= "<a href=\"$targetpage/$counter\">$counter</a>";					
                                }
                        }
                    }

                        //next button
                        if ($page < $counter - 1) 
                                $pagination.= "<a href=\"$targetpage/$next\">next �</a>";
                        else
                                $pagination.= "<span class=\"disabled\">next �</span>";
                        $pagination.= "</div>\n";		
        }
        return $pagination;
    }
                            // END pagination
?>