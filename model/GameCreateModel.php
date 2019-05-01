<?php

class GameCreateModel extends Model
{
	
	
	function add_game($duration,$private)
	{
		$query = "call add_game(".$private.",".$_POST["nbPlayer"].",".$duration.")";
		// echo $query;
		$st = db()->prepare($query);
		$st->execute();
		$idGame = $st->fetch();
		// var_dump($idGame);
		return $idGame;
	}
	
	function add_owner($id)
	{
		// echo $id;
		$query = "call add_ownerStat('".$_SESSION["pseudo"]."',".$id.")";
		echo $query;
		db()->exec($query) or die("c'est pété");
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
	function addPositionBlaireau($positX,$positY){
		
		$players= db()->prepare('SELECT * FROM playerstat WHERE team=0  ORDER BY RAND() LIMIT 1');
		$players->execute();

			if(isset($players))
			{
				/*var_dump($players);
				echo "je suis passée par ici aussi, baccho!";*/
				while ($selection = $players->fetch() ){
				    $upd=db()->exec('UPDATE playerstat SET posX='.$positX.', posY='.$positY.', team=2 WHERE id='.$selection["id"]);

				     
				}
			}
			else{
				echo ("pas de joueurs blaireau!!!");
			}

	}

	function addPositionKeke($positX,$positY){

		$players= db()->prepare('SELECT * FROM playerstat WHERE team=0  ORDER BY RAND() LIMIT 1');
		$players->execute();

			if(isset($players))
			{
				while ($selection = $players->fetch() ){
				    $upd=db()->exec('UPDATE playerstat SET posX='.$positX.', posY='.$positY.', team=1 WHERE id='.$selection["id"]);
				}
			}
			else{
				echo ("pas de joueurs keke!!!");
			}

	}
	
	
}
