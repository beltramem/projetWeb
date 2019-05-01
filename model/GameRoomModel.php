<?php

class GameRoomModel extends Model
{
	
	function fire($game,$pseudo)
	{
		$query="call fireGame(".$game.",'".$pseudo."')";
		$st = db()->prepare($query);
		$st->execute();
	}
	
	function getOwner($game)
	{
		$query = "call get_owner(".$game.")";
		$st = db()->prepare($query);
		$st->execute();
		$owner = $st->fetch();
		// var_dump($query);
		return $owner;
	}
	
	function ownerLeave($game,$player)
	{
		$query = "call owner_leave(".$game.",'".$player."')";
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
		// echo $query;
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