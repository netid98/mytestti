<?php 
session_start();

require_once 'GL.php';

/**
* signin
*/
class signin extends Page
{

	public $arg = ['email','pwd'];

	public $title = "signin to sys";

	public function index()
	{
		$this->view('Auth/signin');
	}

	public function valid(& $kv)
	{
		if (!$this->valid_input($kv)) {
			$this->Addmsg("Req is not valid");
			return true;
		}
		
		return false;
	}

	public function do_signin()
	{
		if ($this->valid($_POST)) {
			$this->index();
			return;
		}
		$user = new user();
		$user->email = $this->val('email');
		$user->pwd = $this->val('pwd');
		if ($user->isvalid_model($this)) {
			$this->index();
			return;
		}
		$userdb = $user->getByemail();
		if ($userdb) {
			$_SESSION['user'] = ['uid' => $userdb->id , 'isAdmin' => 0];
			header('Location: /home.php');
		}else{
			$this->Addmsg("Account not found!!!");
			$this->index();
		}
	}

	public function do_signout()
	{
		if (isset($_SESSION['user'])) {
			unset($_SESSION['user']);
		}
		header('Location: /index.php');
	}

}

$signin = new signin();
$ac = exe();
if (method_exists($signin, $ac)) {
	$signin->$ac();
}

	
