/*	selectsend.js
*	Mischa Lehmann
*	ducksource@duckpond.ch
*	Version:1.0
*
*	prepare a select input element for automatic form sending
*	Require:
*		- utils.js
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

/*==========================*/
/*======= Functions ========*/
/*==========================*/

function selectsend_init(){
	var elements = get_matching_elements('form','select');
	for(var i=0;i<elements.length;i++){
		var form = elements[i];
		if(form.length == 2){ // a selectsend form should only have to elements...
			for(var j=0;j<form.length;j++){
				var ele = form.elements[j];
				if(ele.getAttribute('type') == 'submit'){ // remove submit button	
					hide_element(ele);
				}else{
					ele.addEventListener('change',selectsend,false) // The W3C Way
				}
			}
		}
	}
}

function selectsend(){
	// perform select send..
	this.parentNode.submit(); // this only works in mozilla / opera
}

/*==========================*/
/*========== Code ==========*/
/*==========================*/

// Add to init functions
add_init_function(selectsend_init);

