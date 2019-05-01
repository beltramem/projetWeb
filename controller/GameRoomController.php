<?php

require("model/GameRoomModel.php");

class GameRoomController extends Controller 
{
	
	public function __construct() 
	{
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
		$data["friends"]= array();
		foreach ($friends as $friend)
		{
			if(!in_array($friend,$data["players"]))
			{
				array_push($data["friends"], $friend);
			}
		}
		if (!isset($data["friends"]))
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
		$this->render("index",$data);
	}

	public function about()
	{
		$this->render("about");
	}
}