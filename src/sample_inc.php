<?php
/*  sample_inc.php
*   Mischa Lehmann
*   ducksource@duckpond.ch
*   Version:1.0
*
*   a sample page. use this as template
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

/* Do fancy PHP shizzle */

/* Initialize template */
$this->page->init('layout/sample_page.php',
                    /* tempalte variables, used for rendering */
                    array(
                        'title' => $this->page->var_get('title').' - sample_page',
                    ),
                    /* metadata variables, used in <meta> */
                    array(
                        'sample' => 'sample metadata'
                    ));
?>
