<?php

require("model/GameRoomModel.php");

class GameRoomController extends Controller 
{
	
	public function __construct() 
	{
	}

	public function leave()
	{
		$model = new GameRoomModel();
		$owner = $this->getOwner();
		$player = $_SESSION["pseudo"];
		$game = parameters()["game"];
		if($_SESSION["pseudo"]==$owner[0])
		{
			$model->ownerLeave($game,$player);
		}
		header("Location:.");
	}
	
	public function start()
	{
		
	}
	
	public function getOwner()
	{
		$model = new GameRoomModel();
		$owner = $model->getOwner(parameters()["game"]);
		return $owner;
	}
	
	public function fire()
	{
		$game=parameters()["game"];
		$pseudo=parameters()["player"];
		$model = new GameRoomModel();
		$model->fire($game,$pseudo);
		$this->index();
	}
	
	public function getPlayer($data)
	{
		$model = new GameRoomModel();
		$idGame = parameters()["game"];
		// echo $idGame;
		$data["players"] = $model->getPlayer($idGame);
		$data["nbPlayer"] = $model->getNbPlayer();
		return $data;
	}
		
	public function getFriend($data)
	{
		$model = new GameRoomModel();
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
	
	public function index() 
	{
		$data = array();
		$data = $this->getPlayer($data);
		$data = $this->getFriend($data);
		$data["owner"] = $this->getOwner();
		$data["game"]=parameters()["game"];
		$data["fireOk"]=false;	
		if ($data["owner"][0] == $_SESSION["pseudo"])
		{
			$data["fireOk"]=true;
		}
		$data["startOk"]=false;
		if ($_SESSION["pseudo"]==$data["owner"][0]&&($data["nbPlayer"]==count($data["players"])))
		{
			$data["startOk"]=true;
		}
		$this->render("index",$data);
	}

	public function about()
	{
		$this->render("about");
	}
}