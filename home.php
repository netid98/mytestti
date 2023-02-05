<?php 
session_start();

require_once 'GL.php';
date_default_timezone_set('Asia/Tehran');

class home extends Page
{
	public $title = "Home page";

	public function index()
	{
		if (!isset($_SESSION["user"])) {
			header('Location: /signin.php');
		}
		$iot = new inouttime();
		$iot->userid = $_SESSION["user"]['uid'];
		$iotdb = $iot->getoneByuserid_today();
		if($iotdb){
			if($iotdb->IO == 'I'){
				$iotdb->formaction = 'do_iamGoingout';
			}else if($iotdb->IO == 'O'){
				$iotdb->formaction = 'do_iamHere';
			}
		}else{
			$iotdb = new stdClass();
			$iotdb->formaction = 'do_iamHere';	
		}
		$this->view('home/index' , $iotdb);
	}

	public function do_iamHere()
	{
		if (!isset($_SESSION["user"])) {
			header('Location: /signin.php');
		}
		$iot = new inouttime();
		$iot->IO = 'I';
		$iot->userid = $_SESSION["userid"]['uid'];
		$iot->time = time();
		$datearr = explode('-', date('Y-m-d' , time()) );
		$datearr = persian_calendar::g2p($datearr[0] , $datearr[1] , $datearr[2]);
		$iot->date = implode('', $datearr);
		$res = $iot->save();
		if ($res[0] == 1) {
			$this->redirect('/home.php');
		}
	}

	public function do_iamGoingout()
	{
		if (!isset($_SESSION["user"])) {
			header('Location: /signin.php');
		}
		$iot = new inouttime();
		$iot->IO = 'O';
		$iot->userid = $_SESSION["userid"]['uid'];
		$iot->time = time();
		$datearr = explode('-', date('Y-m-d' , time()) );
		$datearr = persian_calendar::g2p($datearr[0] , $datearr[1] , $datearr[2]);
		$iot->date = implode('', $datearr);
		$res = $iot->save();
		if ($res[0] == 1) {
			$this->redirect('/home.php');
		}
	}

	public function do_iamNotHere()
	{
		
	}

}





$h = new home();
$ac = exe();
if (method_exists($h , $ac)) {
	$h->$ac();
}