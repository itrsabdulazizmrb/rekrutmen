<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/userguide3/general/hooks.html
|
*/

// Add views column to post_blog table if it doesn't exist
$hooks['post_controller_constructor'] = array(
    'class'    => '',
    'function' => 'add_views_column_to_post_blog',
    'filename' => 'Blog_hooks.php',
    'filepath' => 'hooks',
    'params'   => array()
);
