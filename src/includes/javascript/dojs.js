/*	dojs.js
*	Mischa Lehmann
*	ducksource@duckpond.ch
*	Version:1.0
*
*	javascript scheduler
*	Require:
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
var INIT_FUNCTIONS = new Array(); // functions callint at init process
var SCHEDULE_FUNCTIONS = new Array(); // functions sheduled for a later execution
var RUNNING_TIMEOUT = new Array(); // Running timeouts..

/*==========================*/
/*======= Functions ========*/
/*==========================*/

// add a function for direct execution when the page is completely loaded
function add_init_function(addfunc){
	INIT_FUNCTIONS.push(addfunc);
}

// add a function for scheduled execution
function add_schedule_function(addfunc,set_schedule_time,set_repeating){
	this.orig_schedule_time = set_schedule_time;
	this.schedule_time = set_schedule_time; // schedule time
	this.func = addfunc; // the function for calling
	this.repeating = set_repeating; // repeating (0: no repeating,-1:repeat forever)

	SCHEDULE_FUNCTIONS.push(this);
}

function dojs(){
	var now = (new Date()).getTime();
	var init_functions_length = INIT_FUNCTIONS.length;

	// ===========================
	// call all the init functions

	for (var i=0;i<init_functions_length;i++){
		INIT_FUNCTIONS.shift()();
	}

	
	do_schedule(now); // set process time of all the schedule functions
}

function do_schedule(starttime){
	var now = (new Date()).getTime();
	var timediff = now - starttime;
	var sleeptime = -1;
	
	for (var i in RUNNING_TIMEOUT){ // clear all running timeouts
		clearTimeout(i);
	}

	for (var i=0;i<SCHEDULE_FUNCTIONS.length;i++){ // call all the init functions
		funchold = SCHEDULE_FUNCTIONS[i];
		if(funchold.schedule_time <= timediff){ // is it time to execute the function?
			funchold.func(); // yes.. then execute the function
			funchold.schedule_time+=funchold.orig_schedule_time; // increase schedule time..

			if(funchold.repeating > 0){ // there are outstanding repetitions
				funchold.repeating--;
			}else if(funchold.repeating == 0){
				SCHEDULE_FUNCTIONS.splice(i,1); // remove function
			}
		}

		var new_sleeptime = funchold.schedule_time-timediff;
		if(new_sleeptime < sleeptime || sleeptime < 0){
			sleeptime = new_sleeptime;
		}

		// because setTimeout is very unprecise make sleeptime underflow protect..
		sleeptime = (sleeptime <= 0) ? 1: sleeptime;
	}

	// repeat after sleeptime(milliseconds)
	if(sleeptime > 0){
		RUNNING_TIMEOUT.push(setTimeout('do_schedule('+starttime+')',sleeptime));
	}
}

/*==========================*/
/*========== Code ==========*/
/*==========================*/

window.onload = dojs; // do js when window is fully loaded
