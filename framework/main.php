<?php
/*
 *  Theme Settings
 */
require_once 'admin/theme-settings/global-options.php';
require_once 'admin/theme-settings/customizer.php';
/*
 *  Page Templates
 */  
 require_once 'pages-templates/front-page.php';
/*
 *  CPT 
 */
require_once 'cpt/events.php';

/*
 *  Gutenberg Blocks
 */
require_once 'gutenberg-blocks/slider-gallery/slider-gallery.php';

/*
 * Disable unnecessary Features
 */
require_once 'modules/optimize/disable-features.php';


/*
 *  Head Module
 */
require_once 'modules/head/module.php';
require_once 'modules/head/head.php';


