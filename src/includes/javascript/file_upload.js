/*  file_upload.js
*   Mischa Lehmann
*   ducksource@duckpond.ch
*   Version:1.0
*
*   Make asynchronous file uploads possible
*   Require:
*       - dojs.js
*       - utils.js
*       - progress_bar.js
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
*   [   Waranty       / /   Signet          ]
*   =================/ /=====================   
*   !!Wo0t!!
*/

/*==========================*/
/*==== Global variables ====*/
/*==========================*/
var FILE_INPUTS = new Array();

/*==========================*/
/*======= Functions ========*/
/*==========================*/

function init_fileupload(){ 
    FILE_INPUTS = get_fileupload_inputs();
}

// Object which specifies a file_input

function file_input(finput){
    this.finput = finput;

    // =====================
    // Attach submit buttons
    this.submit_btns = new Array();

    this.add_submit_btn = function(ele){
        // hide submit buttons
        hide_element(ele);
        // add button to array
        this.submit_btns.push(submit);
    }


    // ===================
    // Attach progress bars
    this.progress = 0; // progress in percent
    this.progress_bars =  progress_get(this.finput.name);

    // set new progress status
    this.progress_set = function(setprogress){
        this.progress = setprogress;

        for(var i=0;i<this.progress_bars.length;i++){
            this.progress_bars[i].progress_set(this.progress);
        }
    }

    // =========================
    // Attach file info grabber

    this.file;

    this.finfo_set = function(e){
        this.finput = e.target;
        this.file = this.finput.files[0]; // get file info see: https://developer.mozilla.org/en/DOM/File
    }

    this.finput.addEventListener('change',this.finfo_set,false);
}

function get_fileupload_inputs(){
    var ret_inputs = new Array();
    var inputs = document.getElementsByTagName('input');

    // get all file inputs
    for(var i=0;i<inputs.length;i++){
        var input = inputs[i];

        if(input.type == 'file'){ // is this a file upload?
            var fup = new file_input(input);

            // add submit buttons
            for(var j=0;j<input.parentNode.elements.length;j++){
                var ele = input.parentNode.elements[j];
                if(ele.type == 'submit'){
                    fup.add_submit_btn(ele); 
                }
            }

            ret_inputs.push(fup);
        }
    }

    return ret_inputs;
}

/*==========================*/
/*========== Code ==========*/
/*==========================*/

// Add to init functions
add_init_function(init_fileupload);
