<?php

class PartieModel extends Model
{

	public function getMap($idGame)
	{
		$st = db()->prepare("select nbX, nbY from map where game=".$idGame);
		$st->execute();
		$map=$st->fetch(PDO::FETCH_ASSOC);
		//var_dump($map);
		$st = db()->prepare("call get_map(".$idGame.")");
		$st->execute();

		$list = array();
		
		for($x=0;$x<$map["nbX"];$x++)
		{
			for($y=0;$y<$map["nbY"];$y++)
			{
				$row = $st->fetch(PDO::FETCH_ASSOC);
				$list[$x][$y] = $row["val"];
			}
		}
		
		// while($row = $st->fetch(PDO::FETCH_ASSOC))
		// {
			// $list[] = $row;
		// }
		return $list;
	}
	
	public function getPlayersPosition($idGame)
	{
		$st = db()->prepare("call get_players_position(".$idGame.")");
		$st->execute();
		$list = array();
		while($row = $st->fetch(PDO::FETCH_ASSOC))
		{
			$list[] = $row;
		}

		return $list;
	}

	public function setPlayersPosition($ind){
		$player=$_SESSION["pseudo"];
		$directions= db()->prepare("SELECT posX,posY,direction FROM playerstat WHERE player='".$player."'");
		$directions->execute();

		//Lorsque le joueur veut tourner
		if($ind!=0){
			while ($selection = $directions->fetch() ){
				$newdir=abs(($selection["direction"]+$ind)%4);
				$upd = db()->prepare("UPDATE playerstat SET direction=".$newdir." WHERE player='".$player."'");
				$upd->execute();
			}
		}

		//lorsque le joueur veut avancer
		else{


			while ($direction = $directions->fetch() ){

				switch ($direction["direction"]){
					case 0:
						$newX=-1;
						$newY=0;
						break;
					case 1:
						$newX=0;
						$newY=-1;
						break;
					case 2:
						$newX=1;
						$newY=0;
						break;
					case 3:
						$newX=0;
						$newY=1;
						break;
				}

			
			$pX=$direction["posX"]+$newX;
			$pY=$direction["posY"]+$newY;
	/*
			$map=$this->getMap();
			$collision=$map->
				switch ($collison){
				//sol sans obstacle
					case 0:
						$upd = db()->prepare("UPDATE playerstat SET posX=".$pX." , posY=".$pY." WHERE player='".$player."'");
						$upd->execute();
						break;

				//mur
					case 1:
						break;

				//flaques magiques
					case 2:
						break;
				//invisibilité
					case 3:
						$upd = db()->prepare("UPDATE playerstat SET posX=".$pX." , posY=".$pY.", invisible=1 WHERE player='".$player."'");
						$upd->execute();
						break;
					//bottes magiques
					case 4:
						$bonus=4;
						$upd = db()->prepare("UPDATE playerstat SET posX=".$pX." , posY=".$pY.", boots=1 WHERE player='".$player."'");
						$upd->execute();
						break;
					//bouclier
					case 5:
						$bonus=5;
						$upd = db()->prepare("UPDATE playerstat SET posX=".$pX." , posY=".$pY.", shield=1 WHERE player='".$player."'");
						$upd->execute();
						break;
					//supervue
					case 6:
						$bonus=6;
						$upd = db()->prepare("UPDATE playerstat SET posX=".$pX." , posY=".$pY.", superView=1 WHERE player='".$player."'");
						$upd->execute();
						break;
					//incognito
					case 7:
						$bonus=7;
						$upd = db()->prepare("UPDATE playerstat SET posX=".$pX." , posY=".$pY.", incognito=1 WHERE player='".$player."'");
						$upd->execute();
						break;

*/
						$upd = db()->prepare("UPDATE playerstat SET posX=".$pX." , posY=".$pY." WHERE player='".$player."'");
						$upd->execute();
						break;
			}
		}
				     
			
		

	}
}