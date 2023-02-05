<?php 
session_start();


require_once 'GL.php';

/**
* 
*/
class profile extends Page
{

	public $arg = [];

	public $title = "profile";

	public function index()
	{
		if (!isset($_SESSION["user"])) {
			header('Location: /signin.php');
		}
		$this->view('user/pro');
	}

	public function valid(& $kv)
	{
		if (!$this->valid_input($kv)) {
			$this->Addmsg("Req is not valid");
			return true;
		}
		
		return false;
	}

	public function do_update()
	{
		if (!isset($_SESSION["user"])) {
			header('Location: /signin.php');
		}
		if ($this->valid($_POST)) {
			$this->index();
			return;
		}
		$u = new user();
		$u->id = $_SESSION["user"];
		$u->name = $this->val('name');
		$u->pwd = $this->val('pwd');
		if ($u->isvalid_model($this)) {
			$this->index();
			return;
		}
		$res = $u->update();
		if ($res == 1) {
			header('Location: /index.php');
		}
	}








}



$p = new profile();
$ac = exe();
if (method_exists($p , $ac)) {
	$p->$ac();
}