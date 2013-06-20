<?php
    $fileDirectory = "../../";
    require_once($fileDirectory."utils/translationUtil.php");
    include_once($fileDirectory."inc/dropdowndef.php");
    include_once($fileDirectory."inc/boostrapdef.php");
    include_once($fileDirectory."inc/jquerydef.php");
    $locale = "zh_CN";
    if (isset ($_GET['locale']))
        $locale =   $_GET['locale'];
?>
    <table>
        <tbody>
                <thead>
                  <tr>
                      <th class='span2'></th>
                      <th class='span2'>Title</th>
                      <th class='span6'>In progress</th>
                      <th class='span6'>Completed</th>
                      <!--
                      <th class='span2'>es</th>
                      <th class='span2'>zh</th>
                      <th class='span2'>ru</th>
                      <th class='span2'>il</th> -->
                  </tr>
                </thead>
                  <?php
                        $lessons    =   translationUtil::showColItemToTranslate("lessons_translate_status");
                        $i              = 0;
                        foreach ($lessons as $lesson)
                        {
                            $lessonid    = $lesson['lesson_id'] ;
                            $lessonTitle = $lesson['title'] ;
                  ?>
                  
                  <tr>
                      <td></td>
                      <td> <?php echo $lessonTitle ?> </td>
                      <td>
                            <div class="controls span8">
                                    <input type="checkbox" value="option1" id="inlineCheckbox1"> ZH
                                    <input type="checkbox" value="option2" id="inlineCheckbox2"> RU
                                    <input type="checkbox" value="option3" id="inlineCheckbox3"> ES
                                    <input type="checkbox" value="option3" id="inlineCheckbox3"> HE
                            </div>
                      </td>
                      <td>
                            <div class="btn-group" data-toggle="buttons-checkbox">
                                <button type="button" class="btn btn-primary" data-toggle="button">he</button>
                                <button type="button" class="btn btn-primary" data-toggle="button">ru</button>
                                <button type="button" class="btn btn-primary" data-toggle="button">es</button>
                                <button type="button" class="btn btn-primary" data-toggle="button">zh</button>
                            </div>
                      </td>
                  </tr>
                  <?php
                        } 
                  ?>  
            </tbody>  
          </table>
         <script type="application/javascript">  
             $(document).ready(function() { 
                    $('.btn-group').button();
                    $().button('toggle');
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