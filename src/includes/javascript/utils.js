/*  utils.js
*   Mischa Lehmann
*   ducksource@duckpond.ch
*   Version:1.0
*
*   Frequently used funtions
*   Require:
*
*
*   Licence:
*   You're allowed to edit and publish my source in all of your free and open-source projects.
*   Please send me an e-mail if you'll implement this source in one of your commercial or proprietary projects.
*   Leave this Header untouched!
*
*   Warranty:
*       Warranty void if signet is broken
*   ================== / /===================
*   [       Waranty   / /   Signet          ]
*   =================/ /=====================   
*   !!Wo0t!!
*/

/*==========================*/
/*==== Global variables ====*/
/*==========================*/

/*==========================*/
/*======= Functions ========*/
/*==========================*/

// Try to call one of the given functions as variable arguments
// EXAMPLE : select_function(function(){alert('T1')},function(){alert('T2')});
function select_function(){
    var ret;
    for (var i=0;i<arguments.length;i++) {
        try {
            ret = arguments[i](); // try function
        }
        catch (e) {
            continue;
        }
        break;
    }
    return ret;
}

// get name-mathing elements of a specific tag
function get_matching_elements(element_tag,element_name_prefix){
    var ret = new Array(); // the returning elements
    var elements = document.getElementsByTagName(element_tag);
    var getmatching = RegExp('^'+element_name_prefix+'\_.*'); // prepare regex

    for(var i=0;i<elements.length;i++){
        var ele = elements[i];
        if(getmatching.test(ele.getAttribute('name'))){
            ret.push(ele);
        }
    }

    return ret;
}

function hide_element(ele){
    if(ele.className == 'visibleelement'){
        ele.className = 'hiddenelement';
    }
}

function unhide_element(ele){
    if(ele.className == 'hiddenelement'){
        ele.className = 'visibleelement';
    }
}


function get_style(class_name,attribute_name) {
    var ret='';
    for(i=0;i<document.styleSheets.length;i++){
        var classes = document.styleSheets[i].cssRules || document.styleSheets[i].rules;
        var match_class = new RegExp('^'+class_name+'$','im');
        var match_attr = new RegExp(attribute_name+'[\s]*:[^;]*;','im');

        for(var j=0;j<classes.length;j++) {
            if(match_class.test(classes[j].selectorText)) {
                var csstext = (classes[j].cssText) ? classes[j].cssText : classes[j].style.cssText;
                var attr = new String(match_attr.exec(csstext)); // get attribute
                ret = attr.substring((attr.indexOf(':')+1),attr.lastIndexOf(';'));
            }
        }
    }
    return ret;
}

/*==========================*/
/*========== Code ==========*/
/*==========================*/


