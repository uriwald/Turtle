 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
    require_once("../../../environment.php");
    require_once("../../../localization.php"); 
    require_once("../../utils/collectionUtil.php");
    require_once("../../utils/includeCssAndJsFiles.php"); 
    includeCssAndJsFiles::includePageFiles("string-translate"); 
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
                  
                        $transString    =   collectionUtil::getAllCollectionObjects("stringTranslation");
                        $transString->sort(array('pagecode' => 1));
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