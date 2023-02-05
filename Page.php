<?php 


/**
* 
*/
class Page
{

	public  $errmsg = [];

	public  function Addmsg($msg)
	{
		$this->errmsg[] = $msg;
	}

	public function Getmsg()
	{
		if (empty($this->errmsg))
			return null;

		$msgs = null;
		foreach ($this->errmsg as $v) {
			$msgs = "<span class=\"alert alert-info\">$v</span>";
		}
		return $msgs;
	}

	public function val($k)
	{
		switch ($_SERVER['REQUEST_METHOD']) 
		{
			case 'POST':
				return isset($_POST[$k]) ? $_POST[$k] : null;
				break;

			case 'GET':
				return isset($_GET[$k]) ? $_GET[$k] : null;
				break;

			case 'PUT':
				break;
		}
	}


	public function view($name , $data=null)
	{
		$path = 'HtmlPage/';
		require_once $path .'header.php';

		require_once $path . $name.'.php';

		require_once $path . 'footer.php';
	}

	public function redirect($page)
	{
		header("Location: $page");
		exit();
	}

	public function formatdate($date)
	{
		$y = substr($date, 0, 4);
		$m = substr($date, 4, 2);
		$d = substr($date, 6, 2);
		return $y.'-'.$m.'-'.$d;
	}


	public function maparg($model , & $values)
	{
		$x = 0;
		foreach ($this->col as $k) {
			$model->$k = $values($this->arg[$x]);
			$x++;
		}
		return $model;
	}


	public function valid_input(& $values)
	{
		foreach ($this->arg as $k) {
			if (!isset($values[$k])) {
				return false;
			}
		}
		return true;
	}





}