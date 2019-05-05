<?php

class PlayerStatModel extends Model
{
	private $id;
	private $player;
	private $game;
	private $posX;
	private $posY;
	private $invisible;
	private $boots;
	private $shield;
	private $superView;
	private $incognito;
	private $team;

	

	
	function joinGame($game,$player)
	{
		$query="call join_game(".$game.",'".$player."')";
		var_dump($query);
		$st = db()->prepare($query);
		$st->execute();
	}
	
	function fire($game,$pseudo)
	{
		$query="call fireGame(".$game.",'".$pseudo."')";
		$st = db()->prepare($query);
		$st->execute();
	}
	
	
	function ownerLeave($game,$player)
	{
		$query = "call owner_leave(".$game.",'".$player."')";
		$st = db()->prepare($query);
		$st->execute();
	}
	
	function leave($player)
	{
		$query = "call player_leave('".$player."')";
		var_dump($query);
		$st = db()->prepare($query);
		$st->execute();
	}
	
	function getNbPlayer()
	{
		$query="call get_nb_player(".parameters()["game"].")";
		$st = db()->prepare($query);
		$st->execute();
		$nbPlayer = $st->fetch();
		return $nbPlayer;
	}
	
	function getFriend()
	{
		$query = "call get_friend('".$_SESSION["pseudo"]."')";
		// echo $query;
		$st = db()->prepare($query);
		$st->execute();
		while($row = $st->fetch(PDO::FETCH_ASSOC))
		{
			if($row["friendOne"]==$_SESSION["pseudo"])
			{
				$data[] = $row["friendTwo"];
			}
			else
			{
				$data[] = $row["friendOne"];
			}
		}
			 
		// var_dump($data);
		return $data;
	}
 
	function getPlayer($idGame)
	{
		$query = "call get_playerName_game(".$idGame.")";
		$st = db()->prepare($query);
		$st->execute();
		while($row = $st->fetch(PDO::FETCH_ASSOC))
		{
			$data[] = $row;
		}
			 
		// var_dump($data);
		return $data;
	}

}