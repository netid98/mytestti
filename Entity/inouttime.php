<?php 	

require_once 'Entity.php';
require_once 'GL.php';

/**
* 
*/
class inouttime extends Entity
{
	public $id;
	public $userid;
	public $time;
	public $date;
	public $IO;

	public function getoneByuserid_today()
	{
		$datetmp = date('Y-m-d' , time());
		$datearr = explode('-', $datetmp);
		$datearr = persian_calendar::g2p($datearr[0] , $datearr[1] , $datearr[2]);
		$date = implode('', $datearr);
		$res = DB::Select_ALL(static::class , ['date' => $date , 'userid' => $this->userid] 
			, '*' , 'AND' , 'time' , '0,1' , true);
		if ($res) {
			$objarr = $this->map($res);
			return $objarr[0];
		}
		return [];
	}

	public function getByuserid()
	{
		$cond = ['userid' => $this->userid];
		if($this->date)
			$cond['date'] = $this->date;
		$res = DB::Select_All(static::class , $cond, '*' , 'AND' , 'time' );
		if($res) {
			return $this->map($res);
		}
		return [];
	}
	
	public function getBydate($date)
	{
		$res = DB::Select_ONE(static::class , ['date' => $date]);
		if ($res) {
			return $this->map($res);
		}
		return [];	
	}
}