<?php 

/**
* 
*/
class Entity
{


	public function save()
	{
		return DB::Insert(static::class , get_object_vars($this));
	}


	public function getByid()
	{
		$res = DB::Select_ONE(static::class , ["id" => $this->id]);
		return $this->map($res);
	}

	public function delete()
	{
		return DB::Delete(static::class , ["id" => $this->id]);
	}

	public function update()
	{
		$all =  get_object_vars($this);
		unset($all['id']);
		foreach ($all as $k => $v) {
			if (empty($all[$k])) {
				unset($all[$k]);
			}
		}
		return DB::Update(static::class , $all , ["id" => $this->id]);
	}




	public function map($dbres)
	{
		$many = [];
		$classname = static::class;
		for($i=0; $i<count($dbres); $i++) {
			if (isset($dbres[$i])) {
				$tmp = new $classname();
				foreach ($dbres[$i] as $k => $v) {
					$tmp->$k = $dbres[$i][$k];
				}
				$many[] = $tmp;
			}else{
				$one = new $classname();
				foreach ($dbres as $k => $v) {
					$one->$k = $dbres[$k];
				}
				return $one;
			}
		}
		return $many;
	}











}