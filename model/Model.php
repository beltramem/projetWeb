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
	public static function findAll()
	{
		$class =get_called_class();
		$table = strtolower($class);
		$st = db()->prepare("select id$table from $table");
		$st->execute();
		$list = array();
		while($row = $st->fetch(PDO::FETCH_ASSOC))
		{
			$list[] = new $class($row["id".$table]);
		}
		return $list;
	}
	
	public static function findBy($table,$field,$value)
	{
		$query = "select * from ".$table." where ".$field."='".$value."'";
		var_dump($query);
		$st = db()->prepare($query);
		$st->execute();
		$row = $st->fetch();
		return $row;
	}
	
	public function __get($fieldName)
	{
		$varName = "_".$fieldName;
		if (property_exists(get_class($this), $varName))
			return $this->$varName;
		else
			throw new Exception("Unknow variable: ".$fieldName);
	}

	public function __set($fieldName, $value)
	{
		$varName = "_".$fieldName;
		if ($value != null)
		{
			if (property_exists(get_class($this), $varName))
			{
				$this->$varName = $value;
				$class = get_class($this);
				$table = strtolower($class);
				$id = "_id".$fieldName;
				if (isset($value->$id))
				{
					$st = db()->prepare("update $table set id$table=:id");
					$id = substr($id, 1);
					$st->binValue(":val", $value);
				}
				else
				{
					$st = db()->prepare("update $table set $fieldName=:val where id$table=:id");
					$st->binValue(":val", $value);
				}
				$id = "id".$table;
				$st->binValue(":id", $this->$id);
				$st->execute();
			}
			else
			{
				throw new Exception("Unknow variable: ".$fieldName);
			}
		}
	}
	public function __toString()
	{
		return get_class($this).": ".$this->name;
	}
}