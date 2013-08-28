 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
    $rootDirectory ="../../";
    require_once($rootDirectory ."utils/translationUtil.php");
    include_once($rootDirectory ."inc/dropdowndef.php");
    include_once($rootDirectory ."inc/boostrapdef.php");
    include_once($rootDirectory ."inc/jquerydef.php");
?>
    <table>
        <tbody>
                <thead>
                    <tr>
                        <th class='span2'></th>
                        <th class='span3'>String</th>
                        <th class='span3'>Chinese</th>
                        <th class='span3'>Spanish</th>
                        <th class='span3'>Russian</th>
                        <th class='span5'>Display Lang</th>
                    </tr>
                </thead>
                  <?php
                        $transString    =   translationUtil::showColItemToTranslate("stringTranslation");
                        $i              = 0;
                        foreach ($transString as $str)
                        {
                            $i++ ;
                            $ru         =   $str["translate"]["locale_ru_RU"];
                            $zh         =   $str["translate"]["locale_zh_CN"];
                            $es         =   $str["translate"]["locale_es_AR"];
                            $displayArr =   $str["display"];

                  ?>           
                                <tr>
                                    <td></td>
                                    <td id='str<?php echo $i ?>'><?php echo $str['str']; ?></td>
                                    <td><?php echo $zh; ?></td>
                                    <td><?php echo $es; ?></td>
                                    <td><?php echo $ru; ?></td>
                                    <td>
                                        <div class="controls span5">
                                                <input type="checkbox" value="option1" id="display_zh<?php echo $i ?>" <?php if ($displayArr['zh_CN'] == "true") echo "checked=true";?>> ZH
                                                <input type="checkbox" value="option2" id="display_ru<?php echo $i ?>" <?php if ($displayArr['ru_RU'] == "true") echo "checked=true";?>> RU
                                                <input type="checkbox" value="option3" id="display_es<?php echo $i ?>" <?php if ($displayArr['es_AR'] == "true") echo "checked=true";?>> ES
                                        </div>
                                    </td>
                                    <td>
                                        <div class='btn small info pressed' id='<?php echo $i ?>'>save</div>
                                    </td>
                                </tr>
                  <?php
                        } //End foreach loop
                  ?> 
        </tbody>  
    </table>
         <script type="application/javascript">  
             $(document).ready(function() {
           
                    $(".pressed").click(function() {
                        var id               = $(this).attr('id');
                        var thestring        = "str"+id;
                        var display_ru       = $('#' + 'display_ru' + id).is(":checked");  
                        var display_zh       = $('#' + 'display_zh' + id).is(":checked");  
                        var display_es       = $('#' + 'display_es' + id).is(":checked");  
                        var str              = $('#' + thestring).text();

                        //alert("hello--" + str + "--" + page + "--" + context + "----" + input);
                        $.ajax({
                            type : 'POST',
                            url : 'saveStrDisplayStatus.php',
                            dataType : 'json',
                            data: {
                                str        :   str,
                                display_ru :   display_ru,
                                display_zh :   display_zh,
                                display_es :   display_es  
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