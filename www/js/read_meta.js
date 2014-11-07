/*	read_meta.js
*	Mischa Lehmann
*	ducksource@duckpond.ch
*	Version:1.0
*
*	read meta-data and provide them as variable
*	Require:
*		- dojs.js
*
*
*	Licence:
*	You're allowed to edit and publish my source in all of your free and open-source projects.
*	Please send me an e-mail if you'll implement this source in one of your commercial or proprietary projects.
*	Leave this Header untouched!
*
*	Warranty:
*		Warranty void if signet is broken
*	================== / /===================
*	[    Waranty      / /    Signet         ]
*	=================/ /=====================
*	!!Wo0t!!
*/

/*==========================*/
/*==== Global variables ====*/
/*==========================*/

var METADATA = new Array();

/*==========================*/
/*======= Functions ========*/
/*==========================*/

function init_metadata(){

	// =============
	// Read metadata

	var metadatas = document.getElementsByTagName('meta');
	for(var i=0;i<metadatas.length;i++){
		var metadata = metadatas[i];
		if(metadata.name && metadata.content){ // does this metadat has name and content?..
			if(!METADATA[metadata.name]){
				METADATA[metadata.name] = metadata.content;
			}
		}
	}	
}

/*==========================*/
/*========== Code ==========*/
/*==========================*/
add_init_function(init_metadata);
