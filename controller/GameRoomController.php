<?php

require("model/GameRoomModel.php");

class GameRoomController extends Controller 
{
	public function __construct() 
	{
	}

	public function index() 
	{
		$idGame = parameters()["game"];
		// echo $idGame;
		$model = new GameRoomModel();
		$data["players"] = $model->getPlayer($idGame);
		$data["nbPlayer"] = $model->getNbPlayer();
		$friends = $model->getFriend();
		foreach ($friends as $friend)
		{
			foreach($data["players"] as $player)
			{
				if($friend==$player)
				{
					$data["friends"];
				}
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
		$this->render("index",$data);
	}

	public function about()
	{
		$this->render("about");
	}
}