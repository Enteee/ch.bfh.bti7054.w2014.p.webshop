<?php
/*  layout_inc.php
*   Mischa Lehmann
*   ducksource@duckpond.ch
*   Version:1.0
*
*   the layouting test page
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

if(!$this->config['debug']){
    exit('Go away!');
}

/* Initialize template */
$this->page->init('layout/layout.php',
                array( 
                ),
                array(
                ));
?>