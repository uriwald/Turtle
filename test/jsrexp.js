/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


    var regexIdentifier = /^(\.?[A-Za-zא-ת\u4E00-\u9FA5\u0100-\u04FF\u0E00-\u0E5B\u0600-\u06FF][A-Za-zא-ת\u4E00-\u9FA5\u0100-\u04FF0u0E00-\u0E5B\u0600-\u06FF-9_.\?]*)(.*?)$/;
    //var nondigitcaracter =  new RegExp('[0-9
     //^(\+|\-|\*|\/|%|\^|>=|<=|<>|=|<|>)$/;
    var nondigitcaracter =  /([0-9])$/;
    var withnum = "forward50";
    var withnonum = "forward" 
    if (withnum.match(nondigitcaracter))
        alert('String ' + withnum + " doens't contain numbers");
    if (withnonum.match(nondigitcaracter))
        alert('String ' + withnonum + " doens't contain numbers");
        