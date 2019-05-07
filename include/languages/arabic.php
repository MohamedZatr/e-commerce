<?php

function lang($phases)
{
	static $lang = array
						(
						  'Message' => 'مرحبا',
						  'Admin'   => 'مدير'
						);
	return $lang[$phases];
}