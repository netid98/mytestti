<?php 
session_start();

require_once 'GL.php';
date_default_timezone_set('Asia/Tehran');

/**
* admin
*/
class admin extends Page
{
	public $title = "Admin";

	public function index()
	{
		$u = new user();
		$u_s = $u->getall();

		$this->view('admin/users' , $u_s);
	}

	public function do_report()
	{
		$iot = new inouttime();
		$iot->userid = $this->val('uid');
		$iot->date = $this->val('date');
		$res = $iot->getByuserid();
		$this->view('admin/report' , $res);
	}



	public $arg = ['email','pwd' , 'repwd' , 'name' , 'tell'];


	public function do_register()
	{
		$this->view('admin/signup');	
	}

	public function valid(& $kv)
	{
		if (!$this->valid_input($kv)) {
			$this->Addmsg("Req is not valid");
			return true;
		}
		if ($this->val('repwd') != $this->val('pwd') ) {
			$this->Addmsg("password is not valid");
			return true;
		}
		
		return false;
	}

	public function do_signup()
	{
		if ($this->valid($_POST)) {
			$this->index();
			return;
		}
		$u = new user();
		$u->email = $this->val('email');
		$u->pwd = $this->val('pwd');
		$u->name = $this->val('name');
		$u->tell = $this->val('tell');
		$u->isAdmin = 0;
		if ($u->isvalid_model($this)) {
			$this->index();
			return;
		}
		$res = $u->save();
		$_SESSION['user'] = ['uid' => $res[1] , 'isAdmin' => 0];
		$this->redirect('/admin.php');
	}


}

$admin = new admin();
$ac = exe();
if (method_exists($admin, $ac)) {
	if(isset($_SESSION['user']['isAdmin']) && $_SESSION['user']['isAdmin'] == 1)
		$admin->$ac();
	else
		$admin->redirect('/home.php');
}

	
