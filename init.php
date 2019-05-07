<?php

	include "connect.php";

	// Routes
	$language = 'include/languages/'; //languages Directory 
    $tpl = 'include/templets/'; // templets Directory
	$css = 'layout/defulte/css/'; // Css Directory
	$fun ='include/functions/';//Function Dirctory
    $js = 'layout/defulte/js/'; // Js Directory
	
	// include the important files
    
	include $tpl . 'header.php';
	if(!isset($NoNavBar))
	{
		include $tpl . 'navbar.php';
	}
