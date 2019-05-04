<?php

require("model/InvitationModel.php");

class PlayerStatController extends Controller 
{
	
	public function __construct() 
	{
	}
	
	public function joinGame()
	{
		$game = parameters()["game"];
		$player = parameters()["player"];
		$model = new PlayerStatModel();
		$model->joinGame($game,$player);
		header("Location: ?page=playerStat/gameRoom/&game=".$game);
	}
	
	public function ivitPlayer()
	{
		$game = parameters()["game"];
		$player = parameters()["player"];
		$model = new InvitationModel();
		$model->invitPlayer($game,$player);
	}

	public function leave()
	{
		$model = new PlayerStatModel();
		$owner = $this->getOwner();
		$player = $_SESSION["pseudo"];
		$game = parameters()["game"];
		if($_SESSION["pseudo"]==$owner[0])
		{
			$model->ownerLeave($game,$player);
		}
		else
		{
			$model->leave($player);
		}
		header("Location:.");
	}
	
	public function start()
	{
		
	}
	
	public function getOwner()
	{
		$model = new GameModel();
		$owner = $model->getOwner(parameters()["game"]);
		return $owner;
	}
	
	public function fire()
	{
		$game=parameters()["game"];
		$pseudo=parameters()["player"];
		$model = new playerStatModel();
		$model->fire($game,$pseudo);
	}
	
	public function getPlayerdata($data)
	{
		$model = new PlayerStatModel();
		$idGame = parameters()["game"];
		// echo $idGame;
		$data["players"] = $model->getPlayer($idGame);
		$data["nbPlayer"] = $model->getNbPlayer();
		return $data;
	}
	
	public function getplayerView()
	{
		$data = array();
		$data = $this->getPlayerData($data);
		$data["owner"] = $this->getOwner();
		$data["fireOk"]=false;	
		if ($data["owner"][0] == $_SESSION["pseudo"])
		{
			$data["fireOk"]=true;
		}
		$this->viewer("player",$data);

	}
	
	public function getFriendData($data)
	{
		$model = new PlayerStatModel();
		$friends = $model->getFriend();
		$data["friends"]= $friends;
		foreach ($friends as $friend)
		{
			foreach($data["players"] as $player)
			{
				if ($player['player'] == $friend)
				{
					$key = array_search($friend,$friends);
					unset($data["friends"][$key]);
				}
				
			}
		}
		if (count($data["friends"])<1)
		{
			$data["friends"]=array("aucun amis à inviter");
			$data["invitOk"]=false;
		}
		else
		{
			$data["invitOk"]=true;
		}
		return $data;
	}
	
	public function getFriendView()
	{
		$data = array();
		$data = $this->getPlayerdata($data);
		$data = $this->getFriendData($data);
		$this->viewer("friend",$data);
	}
	
	public function index()
	{
		$this->render("index");
	}
	
	public function gameRoom() 
	{
		$data = array();
		$data = $this->getPlayerData($data);
		$data = $this->getFriendData($data);
		$data["owner"] = $this->getOwner();
		$data["game"]=parameters()["game"];
		$data["startOk"]=false;
		if ($_SESSION["pseudo"]==$data["owner"][0]&&($data["nbPlayer"]==count($data["players"])))
		{
			$data["startOk"]=true;
		}
		$this->render("gameRoom",$data);
	}

	public function about()
	{
		$this->render("about");
	}
}