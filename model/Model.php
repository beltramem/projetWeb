<?php

class Model
{
	public function __construct($id=null)
	{
		$class = get_class($this);
		$table =strtolower($class);
		if ($id == null)
		{
			$st = db()->prepare("insert into $table default values returning id$table");
			$st->execute();
			$row =$st->fetch();
			$field = "id".$table;
			$this->$field = $row[$field];
		} else
		{
			$st = db()->prepare("select * from $table where id$table=:id");
			$st->binValue(":id", $id);
			$st->execute();
			if ($st->rowCount() != 1 )
			{
				throw new Exception("Not in table: ".$table." id: ".$id);
			} else 
			{
				$row = $st->fetch(PDO::FETCH_ASSOC);
				foreach($row as $field=>$value)
				{
					if (substr($field, 0,2) == "id")
					{
						$linkedField = substr($field, 2);
						$linkedClass = ucfirst($linkedClass);
						if ($linkedClass != get_class($this))
							$this->$linkedField = new $linkedClass($value);
						else
							$this->$field = $value;
					} else
						$this->$field = $value;
				}
			}
		}
	}
	public static function findAll($table)
	{
		$st = db()->prepare("select * from $table");
		$st->execute();
		$list = array();
		while($row = $st->fetch(PDO::FETCH_ASSOC))
		{
			$list[] = $row;
		}
		return $list;
	}
	
	public static function findBy($table,$field,$value)
	{
		$query = "select * from ".$table." where ".$field."='".$value."'";
		$st = db()->prepare($query);
		$st->execute();
		$list = array();
		while($row = $st->fetch(PDO::FETCH_ASSOC))
		{
			$list[] = $row;
		}
		return $list;
	}
	
	
	public function __toString()
	{
		return get_class($this).": ".$this->name;
	}
}