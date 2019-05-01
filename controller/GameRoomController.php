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
		$data["game"]=parameters()["game"];
		if ($data["nbPlayer"]==count($data["players"]))
		{
			$data["startOk"]=true;
		}else {$data["startOk"]=false;}
		$this->render("index",$data);
	}

	public function about()
	{
		$this->render("about");
	}
}