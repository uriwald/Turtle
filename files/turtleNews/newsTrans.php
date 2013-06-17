<?php
    require_once("../utils/translationUtil.php");
    include_once("../inc/dropdowndef.php");
    include_once("../inc/boostrapdef.php");
    include_once("../inc/jquerydef.php");
    $locale = "zh_CN";
    if (isset ($_GET['locale']))
        $locale =   $_GET['locale'];
?>
    <table>
        <tbody>
                <thead>
                  <tr>
                      <th class='span2'></th>
                      <th class='span2'>headline</th>
                      <th class='span2'>headline translation</th>
                      <th class='span2'>Context</th>
                      <th class='span2'>context translation</th>
                      <th class='span2'>Action</th>
                  </tr>
                </thead>
                  <?php
                        $newsItems    =   translationUtil::showColItemToTranslate("news");
                        $i              = 0;
                        foreach ($newsItems as $newsItem)
                        {
                            $itemid = $newsItem['itemid'] ;
                  ?>
                  
                  <tr>
                      <td></td>
                      <td id='headline<?php echo $itemid ?>'> <?php echo $newsItem['headline'] ?> </td>
                      <td><textarea id='headline_translate<?php echo $itemid ?>' rows="3"><?php echo $newsItem['headline_translate'] ["locale_" . $locale]?></textarea></td>
                      <td id='context<?php echo $itemid ?>'><?php echo $newsItem['context'] ?></td>
                      <td><textarea id='context_translate<?php echo $itemid ?>' rows="3"> <?php echo $newsItem['context_translate'] ["locale_" . $locale] ?></textarea></td>
                      <td>
                        <div class='btn small info pressed' id='<?php echo $itemid ?>'>save</div>
                      </td>
                  </tr>
                  <?php
                        } 
                  ?> 
            </tbody>  
          </table>
         <script type="application/javascript">  
             $(document).ready(function() {
           
                    $(".pressed").click(function() {
                        var id                      = $(this).attr('id');
                        var headlinen               = "headline"+id;
                        var headlinen_translate     = "headline_translate"+id;
                        var contextn                = "context"+id;
                        var contextn_translate      = "context_translate"+id;
                        var headline                = $('#' + headlinen).text();
                        var headline_translate      = $('#' + headlinen_translate).val();
                        var context                 = $('#' + contextn).text();
                        var context_translate       = $('#' + contextn_translate).val();
                        var locale                  = '<?php echo "locale_" . $locale?>';
                        //alert("hello--" + str + "--" + page + "--" + context + "----" + input);
                        $.ajax({
                            type : 'POST',
                            url : 'saveNewsTranslation.php',
                            dataType : 'json',
                            data: {
                                headline                : headline,
                                headline_translate      : headline_translate,
                                context                 : context,
                                context_translate       : context_translate ,
                                id                      : id,
                                locale                  : locale
                            },
                            success: function(data) { 
                                alert('successfully save');
                            } ,
                            error: function(XMLHttpRequest, textStatus, errorThrown) {
                                alert('en error occured');
                            }
                        });
                    });
            });
         </script>