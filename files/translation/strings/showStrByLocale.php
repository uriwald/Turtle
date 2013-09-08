<?php
    $rootDirectory ="../../";
    require_once($rootDirectory ."utils/translationUtil.php");
    include_once($rootDirectory ."inc/dropdowndef.php");
    include_once($rootDirectory ."inc/boostrapdef.php");
    include_once($rootDirectory ."inc/jquerydef.php");
    $locale = "zh_CN";
    if (isset ($_GET['locale']))
        $locale =   $_GET['locale'];
?>
    <table>
        <tbody>
                <thead>
                    <tr>
                        <th class='span2'></th>
                        <th class='span2'>String</th>
                        <th class='span2'>Appear in page</th>
                        <th class='span2'>Context</th>
                        <th class='span2'>Translation</th>
                        <th class='span2'>Action</th>
                    </tr>
                </thead>
                  <?php
                        $transString    =   translationUtil::showColItemToTranslate("stringTranslation");
                        $i              = 0;
                        foreach ($transString as $str)
                        {
                            $i++ ;
                            if ($str["display"][$locale] == "true")
                            {
                  ?>           
                                <tr>
                                    <td></td>
                                    <td id='str<?php echo $i ?>'><?php echo $str['str'] ?></td>
                                    <td id='page<?php echo $i ?>'><?php echo $str['page'] ?></td>
                                    <td id='context<?php echo $i ?>'><?php echo $str['context'] ?></td>
                                    <td>
                                        <!--<input type='text' id='input<?php echo $i ?>' value='<?php echo $str["translate"]["locale_" . $locale] ?>'></input> -->
                                        <textarea row="3" id='input<?php echo $i ?>'><?php echo $str["translate"]["locale_" . $locale] ?> </textarea>
                                    </td> 
                                    <td>
                                        <div class='btn small info pressed' id='<?php echo $i ?>'>save</div>
                                    </td>
                                </tr>
                  <?php
                            } //End if condition
                        } //End foreach loop
                  ?> 
        </tbody>  
    </table>
         <script type="application/javascript">  
             $(document).ready(function() {
           
                    $(".pressed").click(function() {
                        var id               = $(this).attr('id');
                        var thestring        = "str"+id;
                        var thepage          = "page"+id;
                        var thecontext       = "context"+id;
                        var theinput         = "input"+id;
                        var str              = $('#' + thestring).text();
                        var page             = $('#' + thepage).text();
                        var context          = $('#' + thecontext).text();
                        var input            = $('#' + theinput).val();
                        var locale           = '<?php echo "locale_" . $locale?>';
                        //alert("hello--" + str + "--" + page + "--" + context + "----" + input);
                        $.ajax({
                            type : 'POST',
                            url : 'saveStrTranslation.php',
                            dataType : 'json',
                            data: {
                                str        :   str,
                                page       :   page,
                                context    :   context,
                                input      :   input ,
                                locale     :   locale
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