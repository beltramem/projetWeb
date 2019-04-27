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
	
	function add_owner($id)
	{
		echo $id;
		$query = "call add_playerStat('".$_SESSION["pseudo"]."',".$id.")";
		db()->exec($query);
	}
	
	function stock_map($map,$id)
	{
		$xSize = count($map);
		$ySize = count($map[0]);
		
		// echo $xSize;
		// echo $ySize;
		$query = "call add_map(".$id.",".$xSize.",".$ySize.")";
		db()->exec($query);
		for($x=0;$x<$xSize-1;$x++)
		{
			for($y=0;$y<$ySize-1;$y++)
			{
				$query = "call add_square(".$x.",".$y.",".$id.",".$map[$x][$y].")";
				db()->exec($query);
			}
		}
	}
}