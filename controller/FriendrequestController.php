<?php


class FriendrequestController extends Controller 
{
	public function __construct() 
	{
	}
	
	function addFriendRequest()
	{
		$recipient = parameters()["recipient"];
		$model = new FriendrequestModel();
		$model->add($_SESSION["pseudo"],$recipient);
	}

	public function getFriendRequest()
	{
		$model = new Model;
		$data["friendRequest"] = $model->findBy("friendRequest","playerTwo","'".$_SESSION["pseudo"]."'");
		$this->render("index",$data);
	}
}