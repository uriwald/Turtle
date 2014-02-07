<?php
    if (session_id() == '')
        session_start();
    require_once("../../../environment.php");
    require_once("../../../localization.php"); 
    require_once("../../utils/collectionUtil.php");
    require_once("../../utils/includeCssAndJsFiles.php"); 
    includeCssAndJsFiles::include_all_page_files("lesson-translate"); 
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
                        $lessons    =   collectionUtil::get_all_collection_objects("lessons_translate_status");
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
                                    <input type="checkbox" value="option6" id="progress_pt<?php echo $i ?>" <?php if ($progress['locale_pt_BR'] == "true") echo "checked=true";?>> PT
                                    <input type="checkbox" value="option7" id="progress_pl<?php echo $i ?>" <?php if ($progress['locale_pl_PL'] == "true") echo "checked=true";?>> PL
                                    <input type="checkbox" value="option8" id="progress_nl<?php echo $i ?>" <?php if ($progress['locale_nl_NL'] == "true") echo "checked=true";?>> NL
                                    <input type="checkbox" value="option9" id="progress_fi<?php echo $i ?>" <?php if ($progress['locale_fi_FI'] == "true") echo "checked=true";?>> FI

                            </div>
                      </td>
                      <td> 
                            <div class="controls span5">
                                    <input type="checkbox" value="option1" id="finish_zh<?php echo $i ?>" <?php if ($completed['locale_zh_CN'] == "true") echo "checked=true";?>> ZH
                                    <input type="checkbox" value="option2" id="finish_ru<?php echo $i ?>" <?php if ($completed['locale_ru_RU'] == "true") echo "checked=true";?>> RU
                                    <input type="checkbox" value="option3" id="finish_es<?php echo $i ?>" <?php if ($completed['locale_es_AR'] == "true") echo "checked=true";?>> ES
                                    <input type="checkbox" value="option4" id="finish_he<?php echo $i ?>" <?php if ($completed['locale_he_IL'] == "true") echo "checked=true";?>> HE
                                    <input type="checkbox" value="option5" id="finish_de<?php echo $i ?>" <?php if ($completed['locale_de_DE'] == "true") echo "checked=true";?>> DE
                                    <input type="checkbox" value="option6" id="finish_pt<?php echo $i ?>" <?php if ($completed['locale_pt_BR'] == "true") echo "checked=true";?>> PT
                                    <input type="checkbox" value="option7" id="finish_pl<?php echo $i ?>" <?php if ($completed['locale_pl_PL'] == "true") echo "checked=true";?>> Pl
                                    <input type="checkbox" value="option8" id="finish_nl<?php echo $i ?>" <?php if ($completed['locale_nl_NL'] == "true") echo "checked=true";?>> NL
                                    <input type="checkbox" value="option9" id="finish_fi<?php echo $i ?>" <?php if ($completed['locale_fi_FI'] == "true") echo "checked=true";?>> FI                                    
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
                        var progress_pt             = $('#' + 'progress_pt' + id).is(":checked");
                        var progress_pl             = $('#' + 'progress_pl' + id).is(":checked");
                        var progress_fi             = $('#' + 'progress_fi' + id).is(":checked");
                        var progress_nl             = $('#' + 'progress_nl' + id).is(":checked");
                        
                        var finish_ru             = $('#' + 'finish_ru' + id).is(":checked");
                        var finish_zh             = $('#' + 'finish_zh' + id).is(":checked");
                        var finish_es             = $('#' + 'finish_es' + id).is(":checked");
                        var finish_he             = $('#' + 'finish_he' + id).is(":checked");
                        var finish_de             = $('#' + 'finish_de' + id).is(":checked");
                        var finish_pt             = $('#' + 'finish_pt' + id).is(":checked");
                        var finish_pl             = $('#' + 'finish_pl' + id).is(":checked");
                        var finish_fi             = $('#' + 'finish_fi' + id).is(":checked");
                        var finish_nl             = $('#' + 'finish_nl' + id).is(":checked");
                        
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
                                progress_pt                : progress_pt,
                                progress_pl                : progress_pl,
                                progress_fi                : progress_fi,
                                progress_nl                : progress_nl,
                                finish_ru                  : finish_ru,
                                finish_zh                  : finish_zh,
                                finish_es                  : finish_es,
                                finish_he                  : finish_he,
                                finish_de                  : finish_de,
                                finish_pt                  : finish_pt,
                                finish_pl                  : finish_pl,
                                finish_fi                  : finish_fi,
                                finish_nl                  : finish_nl,
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