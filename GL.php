<?php 

require_once 'DB.php';
require_once 'Page.php';
require_once 'persian_calendar.php';

require_once 'Entity/user.php';
require_once 'Entity/inouttime.php';
	
	function exe()
	{
		$name = null;
		switch ($_SERVER['REQUEST_METHOD']) {
			case 'POST':
				if (isset($_POST['ac']))
					$name = $_POST['ac'];
				break;

			case 'GET':
				if (isset($_GET['ac']))
					$name = $_GET['ac'];
				break;

			case 'PUT':
				break;
			default:
				# code...
				break;
		}

		if (!$name) {
			$name = 'index';
		}
		return $name;
	}













