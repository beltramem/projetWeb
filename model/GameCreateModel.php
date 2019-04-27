<?php

class GameCreateModel extends Model
{
	
	
	function add_game($duration,$private)
	{
		$query = "call add_game(".$private.",".$_POST["nbPlayer"].",".$duration.")";
		//$query = "select * from game";
		$st = db()->prepare($query);
		$st->execute();
		$idGame = $st->fetch();
		return $idGame;
	}
	
	function stock_map($map,$id)
	{
		$xSize = count($map);
		$ySize = count($map[0]);
		
		$query = "call add_map(".$id.",".$xSize.",".$ySize.")";
		db()->exec($query);
		for($x=0;$x<$xSize;$x++)
		{
			for($y=0;$y<$ySize;$y++)
			{
				$query = "call add_square(".$x.",".$y.",".$id.",".$map[$x][$y].")";
				db()->exec($query);
			}
		}
	}
}