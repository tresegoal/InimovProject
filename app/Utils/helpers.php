<?php

if(!function_exists('flashing')){

	function flashing($message, $type = 'success')
	{
		session()->flash('notification.message', $message);
		session()->flash('notification.type', $type);
	}
}