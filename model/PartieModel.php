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
			$upd = db()->prepare("UPDATE playerstat SET posX=".$pX." , posY=".$pY." WHERE player='".$player."'");
			$upd->execute();
			break;
			}
		}
	

	}
	
	public function setPowerup($ind){
			$player=$_SESSION["pseudo"];
			switch ($ind){
				case 2:
					$upd = db()->prepare("UPDATE playerstat SET incognito=1 WHERE player='".$player."'");
									$upd->execute();
					break;
				case 3:
					$upd = db()->prepare("UPDATE playerstat SET incognito=0 WHERE player='".$player."'");
									$upd->execute();
					break;
				//devient invisible
				case 4:
					$upd = db()->prepare("UPDATE playerstat SET invisible=1 WHERE player='".$player."'");
									$upd->execute();
					break;
				
				//redevient visible
				case 5:
					$upd = db()->prepare("UPDATE playerstat SET invisible=0 WHERE player='".$player."'");
								$upd->execute();
					break;
				
			}
		}

		public function changeTeam(){
			$players=$this->getPlayersPosition($idGame);
			for($i=0;$i<count($players);$i++){
				if($i["team"]=="keke"){
					$upd = db()->prepare("UPDATE playerstat SET team='blaireau' WHERE player='".$player."'");
								$upd->execute();
					break;
				}
				else{
					$upd = db()->prepare("UPDATE playerstat SET team='keke' WHERE player='".$player."'");
								$upd->execute();
				}
			}
			
		}
}
