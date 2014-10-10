<?php
/*  sample_inc.php
*   Mischa Lehmann
*   ducksource@duckpond.ch
*   Version:1.0
*
*   sample include subfile
*   Require:
*       - Requirement
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

if(!defined('INCLUDED')){
    exit('Go away!');
}

// do PHP stuff


// initialize page template variables
$this->page->init(  'layout/holdit.php',array(    'title' => $this->page->var_get('title').'- HoldIt',
                        'status' => $new_hold['status'],
                        'message' => $new_hold['message'],
                        'access_id' => $new_hold['access_id']));
// render the page
$this->page->render();
?>
