<?php

/**
 * @package        ATS PHP MVC
 * @author        Atish Chandole
 * @since       31 May 2021
 */

spl_autoload_register(function ($className) {

    include "classes/$className.php";

});

$rout = new rout;
