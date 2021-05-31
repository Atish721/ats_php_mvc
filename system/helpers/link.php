<?php

/**
 * @package		ATS PHP MVC
 * @author		Atish Chandole
 * @since       31 May 2021
 */

function linkCSS($cssPath){
    $url = BASEURL . "/" .$cssPath;
    echo '<link rel="stylesheet" href="'. $url .'">';
}

function linkJS($jsPath){
    $url = BASEURL. "/". $jsPath;
    echo '<script src="'. $url .'"></script>';
}
