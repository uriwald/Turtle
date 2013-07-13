/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

 function selectLanguage (locale , dir , indexPage , indexLocale)
 {
            $('.dropdown-toggle').dropdown();
            $.Storage.set("locale",locale);
            //Show selected lanugage from dropdown                   
            try { 
                    var pages = $("#selectedLanguage").msDropdown({on:{change:function(data, ui) {
                            var val = data.value;
                            if(val!="")
                                    window.location = dir + val; 
                    }}}).data("dd");
                    var pagename    = document.location.pathname.toString();
                    pagename        = pagename.split("/");
                    var pageIndex   = pagename[pagename.length-1];
                    if (pageIndex == "" || pageIndex == indexPage || pageIndex == "playground")
                            pageIndex   = indexLocale;
                    pages.setIndexByValue(pageIndex);
                    //$("#ver").html(msBeautify.version.msDropdown);
            } catch(e) {
                    //console.log(e);	
            } 
 }