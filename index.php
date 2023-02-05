<?php 
require_once 'persian_calendar.php';
date_default_timezone_set('Asia/Tehran');

class test
{

	public static function say()
	{
		
		echo date('H:i:s' , time()) . '<hr>';

		$datetmp = date('Y-m-d' , time());
		$datearr = explode('-', $datetmp);
		$datearr = persian_calendar::g2p($datearr[0] , $datearr[1] , $datearr[2]);
		echo implode('-', $datearr);
	}
}

test::say();
