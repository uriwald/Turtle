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
                      <th class='span2'>Precedence</th>
                      <th class='span5'>In progress</th>
                      <th class='span5'>Completed</th>
                      <th class='span6'>Comments</th>
                      <th class='span2'>Action</th>
                  </tr>
                </thead>
                  <?php
                        $lessons    =   translationUtil::showColItemToTranslate("lessons_translate_status");
                        $i          = 0;
                        foreach ($lessons as $lesson)
                        {
                            $i++;
                            $comments = "";
                            if (isset($lesson['comments']))
                                $comments     = $lesson['comments'] ;
                            $progress       =   $lesson['in_progress'];
                            $completed      =   $lesson['completed'];
                            $lessonid       =   $lesson['lesson_id'] ;
                            $lessonTitle    =   $lesson['title'] ;
                            $lessonPre      =   $lesson['precedence']; 
                  ?>
                  
                  <tr>
                      <td></td>
                      <td> <?php echo $lessonTitle ?> </td>
                      <td><input style='width: 60px' type='text' id='precedence<?php echo $i ?>'  value='<?php echo $lessonPre; ?>'></input></td>
                      <td>
                            <div class="controls span5">
                                    <input type="checkbox" value="option1" id="progress_zh<?php echo $i ?>" <?php if ($progress['locale_zh_CN'] == "true") echo "checked=true";?>> ZH
                                    <input type="checkbox" value="option2" id="progress_ru<?php echo $i ?>" <?php if ($progress['locale_ru_RU'] == "true") echo "checked=true";?>> RU
                                    <input type="checkbox" value="option3" id="progress_es<?php echo $i ?>" <?php if ($progress['locale_es_AR'] == "true") echo "checked=true";?>> ES
                                    <input type="checkbox" value="option4" id="progress_he<?php echo $i ?>" <?php if ($progress['locale_he_IL'] == "true") echo "checked=true";?>> HE
                                    <input type="checkbox" value="option5" id="progress_de<?php echo $i ?>" <?php if ($progress['locale_de_DE'] == "true") echo "checked=true";?>> DE

                            </div>
                      </td>
                      <td> 
                            <div class="controls span5">
                                    <input type="checkbox" value="option1" id="finish_zh<?php echo $i ?>" <?php if ($completed['locale_zh_CN'] == "true") echo "checked=true";?>> ZH
                                    <input type="checkbox" value="option2" id="finish_ru<?php echo $i ?>" <?php if ($completed['locale_ru_RU'] == "true") echo "checked=true";?>> RU
                                    <input type="checkbox" value="option3" id="finish_es<?php echo $i ?>" <?php if ($completed['locale_es_AR'] == "true") echo "checked=true";?>> ES
                                    <input type="checkbox" value="option4" id="finish_he<?php echo $i ?>" <?php if ($completed['locale_he_IL'] == "true") echo "checked=true";?>> HE
                                    <input type="checkbox" value="option4" id="finish_de<?php echo $i ?>" <?php if ($completed['locale_de_DE'] == "true") echo "checked=true";?>> DE
                            </div>
                      </td>
                      <td><textarea type='text' id='comments<?php echo $i ?>' rows="3" value='<?php echo $comments; ?>'><?php echo $comments; ?></textarea></td>
                      <td>
                        <div class='btn small info pressed' id='<?php echo $i ?>' value="<?php echo $lessonid ?>">save</div>
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
                        var lessonId                = $(this).attr('value');
                        var comments                = $('#' + 'comments' + id).val();  
                        var precedence               = $('#' + 'precedence' + id).val();   
                        var progress_ru             = $('#' + 'progress_ru' + id).is(":checked");
                        var progress_zh             = $('#' + 'progress_zh' + id).is(":checked");
                        var progress_es             = $('#' + 'progress_es' + id).is(":checked");
                        var progress_he             = $('#' + 'progress_he' + id).is(":checked");
                        var progress_de             = $('#' + 'progress_de' + id).is(":checked");
                        
                        var finish_ru             = $('#' + 'finish_ru' + id).is(":checked");
                        var finish_zh             = $('#' + 'finish_zh' + id).is(":checked");
                        var finish_es             = $('#' + 'finish_es' + id).is(":checked");
                        var finish_he             = $('#' + 'finish_he' + id).is(":checked");
                        var finish_de             = $('#' + 'finish_de' + id).is(":checked");
                        
                        //alert("hello--" + str + "--" + page + "--" + context + "----" + input);
                        $.ajax({
                            type : 'POST',
                            url : 'saveLessonProgressStatus.php',
                            dataType : 'json',
                            data: {
                                progress_ru                : progress_ru,
                                progress_zh                : progress_zh,
                                progress_es                : progress_es,
                                progress_he                : progress_he,
                                progress_de                : progress_de,
                                finish_ru                  : finish_ru,
                                finish_zh                  : finish_zh,
                                finish_es                  : finish_es,
                                finish_he                  : finish_he,
                                finish_de                  : finish_de,
                                comments                   : comments,
                                precedence                 : precedence,
                                lessonId                   : lessonId

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