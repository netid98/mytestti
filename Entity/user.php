<?php

require_once 'Entity.php';
require_once 'GL.php';

/**
* User
*/
class user extends Entity
{

	public $id;
	public $email;
	public $pwd;
	public $name;
	public $tell;

	public function isvalid_model(& $control)
	{	
		$isvalid = false;

		if (!filter_var($this->email , FILTER_VALIDATE_EMAIL)) {
			$control->Addmsg("email is not valid");
			$isvalid = true;
		}

		return $isvalid;
	}

	public function getall()
	{
		$res = DB::Select_All(static::class , ['isAdmin' => 0]);
		if ($res) {
			return $this->map($res);
		}
		return [];
	}

	public function getByemail()
	{
		$res = DB::Select_ONE(static::class , ['email'=>$this->email , 'isAdmin' => 0]);
		if ($res) {
			return $this->map($res);
		}
		return [];
	}



}