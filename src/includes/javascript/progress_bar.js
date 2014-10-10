/*  progress_bar.js
*   Mischa Lehmann
*   ducksource@duckpond.ch
*   Version:1.0
*
*   Add progress bar funtionaltiy to element
*   Require:
*       - utils.js
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
var PROGRESS_BARS = new Array();

/*==========================*/
/*======= Functions ========*/
/*==========================*/

// A progress element (normally this is an image)
function progress_element(element){
    var getnumbers = new RegExp('[0-9]+','gm');

    // set data
    this.progress = 0;
    this.progress_element = element;
    this.progress_width = getnumbers.exec(get_style('#'+this.progress_element.id,'width'));
    this.progress_pxpercent = this.progress_width/100; // pixel per percent
    this.progress_x = this.progress_width*-1;
    this.progress_y = 0;

    this.progress_set = function(setprogress){
        // over-/underflow protect
        setprogress = (setprogress > 100) ? 100 : setprogress;
        setprogress = (setprogress < 0) ? 0 : setprogress;
        
        this.progress = setprogress;

        this.progress_x = (setprogress*this.progress_pxpercent)-this.progress_width;
        this.progress_y = setprogress*this.progress_pxpercent;
        this.progress_element.style.backgroundPosition=this.progress_x+'px '+this.progress_y+'px'; // ugly i know
    }

    this.progress_set(this.progress);
}

function init_progress(){
    var imgs = get_matching_elements('img','progress'); // get all the progress-bars

    for(var i=0;i<imgs.length;i++){
        var img = imgs[i];
        var linked_element = img.name.substr(img.name.indexOf('_')+1);
        var pele = new progress_element(img);
        PROGRESS_BARS.push(pele);
    }

    // ==============================
    // Automatic attach progress bars
    
    // from metadata
    for(var metadata_name in METADATA){
        var progress = METADATA[metadata_name];
        var pbars = progress_get(metadata_name);

        for(var i=0;i<pbars.length;i++){
            var pbar = pbars[i];
            pbar.progress_set(progress);
        }
    }
}

// get a list of all progressbars named like progress_(linkelement_name)
function progress_get(linkelement_name){
    var ret = new Array();

    for(var i=0;i<PROGRESS_BARS.length;i++){
        var pbar = PROGRESS_BARS[i];
        // does this img match the file input?
        if(pbar.progress_element.name.search('progress_'+linkelement_name)<0){
            continue;
        }
        
        // is a linked progress-bar
        unhide_element(pbar.progress_element); // show progress-bar
        ret.push(pbar);
    }

    return ret;
}

/*==========================*/
/*========== Code ==========*/
/*==========================*/

// Add to init functions
add_init_function(init_progress);
