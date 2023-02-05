<?php 

//require_once 'GL.php';

/**
* DB
*/
class DB
{
	private static $db = null;

    private static function getConDb(){
        if (static::$db == null) {
            static::$db = new PDO('mysql:host=127.0.0.1;dbname=myweb;charset=utf8', 'root' , '');
        }
        return static::$db;
    }

    public static function Insert($tbl ,  $val)
    {
        try {
            $keys = "";
            $cols = "";
            $arr_value = array();
            foreach ($val as $k => $v) {
                $cols .= ($k . ',');
                $keys .= ('?,');
                array_push($arr_value, $v);
            }
            $keys = substr($keys, 0, (strlen($keys) - 1));
            $cols = substr($cols, 0, (strlen($cols) - 1));
            
            $db = static::getConDb();
            $stmt = $db->prepare("INSERT INTO " . $tbl . "(" . $cols . ") VALUES(" . $keys . ")");
            $stmt->execute($arr_value);
            
            return (array(
                $stmt->rowCount(),
                $db->lastInsertId()
            ));
        } catch (Exception $e) {
            return null;
        }
    }

    public static function Delete($tbl,  $condition, $and_or = 'AND')
    {
        try {
            $cols = "";
            $arr_value = array();
            
            $sql = "DELETE FROM " . $tbl . " WHERE ";
            foreach ($condition as $k => $v) {
                $sql .= $k . " =? $and_or ";
                array_push($arr_value, $v);
            }
            if ($and_or == 'AND') {
                $sql = substr($sql, 0, (strlen($sql) - 4));
            } else {
                $sql = substr($sql, 0, (strlen($sql) - 3));
            }
            
            $db = $db = static::getConDb();
            $stmt = $db->prepare($sql);
            $stmt->execute($arr_value);
            return ($stmt->rowCount());
        } catch (Exception $e) {
            return null;
        }
    }

    public static function Update($tbl,  $val,  $condition, $and_or = 'AND')
    {
        try {
            $sql = "UPDATE " . $tbl . " SET ";
            $arr_value = array();
            foreach ($val as $k => $v) {
                $sql .= $k . " =? , ";
                array_push($arr_value, $v);
            }
            $sql = substr($sql, 0, (strlen($sql) - 2));
            $sql .= " WHERE ";
            foreach ($condition as $k => $v) {
                $sql .= $k . " = ? $and_or ";
                array_push($arr_value, $v);
            }
            if ($and_or == 'AND') {
                $sql = substr($sql, 0, (strlen($sql) - 4));
            } else {
                $sql = substr($sql, 0, (strlen($sql) - 3));
            }
            
            $db = $db = static::getConDb();
            $stmt = $db->prepare($sql);
            $stmt->execute($arr_value);
            return ($stmt->rowCount());
        } catch (Exception $e) {
            return null;
        }
    }

    public static function Select_ALL($tbl, $condition, $columns = '*', $and_or = 'AND', $order = null, $limit = null, $isdesc = true)
    {
        try {
            return (DB::Select($tbl, $columns, $condition, $and_or, $order, $isdesc, $limit)->fetchAll(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            return null;
        }
    }

    public static function Select_ONE( $tbl, $condition, $columns = '*', $and_or = 'AND')
    {
        try {
            $null = null;
            $false = false;
            return (DB::Select($tbl, $columns, $condition, $and_or, $null, $false, $null)->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            return null;
        }
    }

    public static function Select_LIKE_ALL( $tbl, $columns, $condition, $and_or = 'AND', $order = null, $limit = null, $isdesc = true)
    {
        try {
            return (DB::Select_LIKE($tbl, $columns, $condition, $and_or, $order, $isdesc, $limit, $and_or)->fetchAll(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            return null;
        }
    }

    public static function Select_LIKE_ONE( $tbl, $columns, $condition, $and_or = 'AND')
    {
        try {
            $null = null;
            $false = false;
            return (DB::Select_LIKE($tbl, $columns, $condition, $and_or, $null, $false, $null)->fetch(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            return null;
        }
    }

    public static function InnerJoin( & $tbl1, & $tbl2, $on, $condition, $and_or = 'AND', $order = null, $limit = null, $isdesc = true)
    {
        try {
            $allcol = "*";
            if ($tbl1['cols'] != null || $tbl2['cols'] != null) {
                $allcol = "";
                foreach ($tbl1['cols'] as $v) {
                    $allcol .= $tbl1['table'] . "." . $v . ", ";
                }
                foreach ($tbl2['cols'] as $v) {
                    $allcol .= $tbl2['table'] . "." . $v . ", ";
                }
                $allcol = substr($allcol, 0, (strlen($allcol) - 2));
            }
            
            $sql = "SELECT " . $allcol . " FROM " . $tbl1['table'] . " INNER JOIN " . $tbl2['table'] . " ON " . $on;
            
            if ($condition) {
                $sql .= " WHERE ";
                foreach ($condition as $val) {
                    $sql .= $val . " " . $and_or . " ";
                }
                $sql = substr($sql, 0, (strlen($sql) - 4));
            }
            
            if ($order != null) {
                if ($isdesc) {
                    $sql .= ' ORDER BY ' . $orderby . ' DESC';
                } else {
                    $sql .= ' ORDER BY ' . $orderby;
                }
            }
            
            $db = $db = static::getConDb();
            $stmt = $db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {}
    }

    public static function Exec(& $val, & $query)
    {
        try {
            $db = static::getConDb();
            $stmt = $db->prepare($query);
            $stmt->execute($val);
            return $stmt;
        } catch (Exception $e) {
            return null;
        }
    }

    // ______________________________________________________________________________
    
    private static function Select($tbl, & $columns, & $condition, & $and_or, & $orderby, & $isdesc, & $limit)
    {
        $sql = "SELECT " . $columns . " FROM " . $tbl . " WHERE ";
        $arr_value = array();
        if ($condition != null) {
            foreach ($condition as $k => $v) {
                $sql .= $k . " =? $and_or ";
                array_push($arr_value, $v);
            }
            
            if ($and_or == 'AND') {
                $sql = substr($sql, 0, (strlen($sql) - 4));
            } elseif ($and_or == 'OR') {
                $sql = substr($sql, 0, (strlen($sql) - 3));
            }
        } else {
            $sql = substr($sql, 0, (strlen($sql) - 6));
        }
        
        if ($orderby != null) {
            if ($isdesc) {
                $sql .= ' ORDER BY ' . $orderby . ' DESC';
            } else {
                $sql .= ' ORDER BY ' . $orderby;
            }
        }
        
        if ($limit != null && strpos($limit, ',') !== false) {
            $temp = explode(',', $limit);
            if ($temp && is_int(intval($temp[0])) && is_int(intval($temp[1])) && ($temp[0] != $temp[1])) {
                if ($temp[0] < $temp[1]) {
                    $sql .= ' LIMIT ' . $temp[0] . ' , ' . $temp[1];
                } else {
                    $sql .= ' LIMIT ' . $temp[1] . ' , ' . $temp[0];
                }
            }
        }
        $db = static::getConDb();
        $stmt = $db->prepare($sql);
        $stmt->execute($arr_value);
        
        return $stmt;
    }

    private static function Select_LIKE(& $tbl, & $columns, & $condition, & $and_or, & $orderby, & $isdesc, & $limit)
    {
        $sql = "SELECT " . $columns . " FROM " . $tbl . " WHERE ";
        $arr_value = array();
        if ($condition != null) {
            foreach ($condition as $k => $v) {
                $v = "%" . $v . "%";
                array_push($arr_value, $v);
                $sql .= $k . " LIKE ? $and_or ";
            }
            
            if ($and_or == 'AND') {
                $sql = substr($sql, 0, (strlen($sql) - 4));
            } elseif ($and_or == 'OR') {
                $sql = substr($sql, 0, (strlen($sql) - 3));
            }
        } else {
            $sql = substr($sql, 0, (strlen($sql) - 6));
        }
        
        if ($orderby != null) {
            if ($isdesc) {
                $sql .= ' ORDER BY ' . $orderby . ' DESC';
            } else {
                $sql .= ' ORDER BY ' . $orderby;
            }
        }
        
        if ($limit != null) {
            $temp = explode(',', $limit);
            if ($temp && is_int(intval($temp[0])) && is_int(intval($temp[1])) && ($temp[0] != $temp[1])) {
                if ($temp[0] < $temp[1]) {
                    $sql .= ' LIMIT ' . $temp[0] . ' , ' . $temp[1];
                } else {
                    $sql .= ' LIMIT ' . $temp[1] . ' , ' . $temp[0];
                }
            }
        }
        
        $db = $db = static::getConDb();
        $stmt = $db->prepare($sql);
        $stmt->execute($arr_value);
        return $stmt;
    }











}