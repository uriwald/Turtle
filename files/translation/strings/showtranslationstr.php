 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php

    require_once("../../../environment.php");
    require_once("../../../localization.php"); 
    require_once("../../utils/collectionUtil.php");
    require_once("../../utils/includeCssAndJsFiles.php"); 
?>
    <table>
        <tbody>
                <thead>
                    <tr>
                        <th class='span3'>String</th>
                        <th class='span1'>Page Code</th>
                        <th class='span3'>Chinese</th>
                        <th class='span3'>Spanish</th>
                        <th class='span3'>Russian</th>
                        <th class='span3'>German</th>
                        <th class='span3'>Portuguese</th>
                        <th class='span3'>Polish</th>
                        <th class='span3'>Finnish</th>
                        <th class='span3'>Duetch</th>
                        <th class='span5'>Display Lang</th>
                    </tr>
                </thead>
                  <?php
                        $transString    =   collectionUtil::getAllCollectionObjects("stringTranslation");
                        $i              = 0;
                        foreach ($transString as $str)
                        {
                            $i++ ;
                            if (!isset ($str["translate"]["locale_ru_RU"]))
                                print_r ($str); 
                                    
                            $ru         =   $str["translate"]["locale_ru_RU"];
                            $zh         =   $str["translate"]["locale_zh_CN"];
                            $es         =   $str["translate"]["locale_es_AR"];
                            $de         =   $str["translate"]["locale_de_DE"];
                            $pt         =   $str["translate"]["locale_pt_BR"];
                            $pl         =   $str["translate"]["locale_pl_PL"];
                            $nl         =   $str["translate"]["locale_nl_NL"];
                            $fi         =   $str["translate"]["locale_fi_FI"];
                            $displayArr =   $str["display"];

                  ?>           
                                <tr>
                                    <td id='str<?php echo $i ?>'><?php echo $str['str']; ?></td>
                                    <td > <input type="text" id="pagecode<?php echo $i ?>" style="width:30px;" value="<?php echo $str['pagecode'];  ?>"></input></td>
                                    <td><?php echo $zh; ?></td>
                                    <td><?php echo $es; ?></td>
                                    <td><?php echo $ru; ?></td>
                                    <td><?php echo $de; ?></td>
                                    <td><?php echo $pt; ?></td>
                                    <td><?php echo $pl; ?></td>
                                    <td><?php echo $fi; ?></td>
                                    <td><?php echo $nl; ?></td>
                                    
                                    <td>
                                        <div class="controls span5">
                                                <input type="checkbox" value="option1" id="display_zh<?php echo $i ?>" <?php if ($displayArr['zh_CN'] == "true") echo "checked=true";?>> ZH
                                                <input type="checkbox" value="option2" id="display_ru<?php echo $i ?>" <?php if ($displayArr['ru_RU'] == "true") echo "checked=true";?>> RU
                                                <input type="checkbox" value="option3" id="display_es<?php echo $i ?>" <?php if ($displayArr['es_AR'] == "true") echo "checked=true";?>> ES
                                                <input type="checkbox" value="option4" id="display_de<?php echo $i ?>" <?php if ($displayArr['de_DE'] == "true") echo "checked=true";?>> DE
                                                <input type="checkbox" value="option5" id="display_pt<?php echo $i ?>" <?php if ($displayArr['pt_BR'] == "true") echo "checked=true";?>> PT
                                                <input type="checkbox" value="option6" id="display_pl<?php echo $i ?>" <?php if ($displayArr['pl_PL'] == "true") echo "checked=true";?>> PL
                                                <input type="checkbox" value="option6" id="display_fi<?php echo $i ?>" <?php if ($displayArr['fi_FI'] == "true") echo "checked=true";?>> FI
                                                <input type="checkbox" value="option6" id="display_nl<?php echo $i ?>" <?php if ($displayArr['nl_NL'] == "true") echo "checked=true";?>> NL

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
                        var display_pt       = $('#' + 'display_pt' + id).is(":checked"); 
                        var display_de       = $('#' + 'display_de' + id).is(":checked"); 
                        var display_pl       = $('#' + 'display_pl' + id).is(":checked"); 
                        var display_nl       = $('#' + 'display_nl' + id).is(":checked"); 
                        var display_fi       = $('#' + 'display_fi' + id).is(":checked"); 

                        var pagecode         = $('#' + 'pagecode' + id).val();
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
                                display_es :   display_es,
                                display_pt :   display_pt,
                                display_de :   display_de,
                                display_pl :   display_pl,
                                display_nl :   display_nl,
                                display_fi :   display_fi,
                                pagecode   :   pagecode
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