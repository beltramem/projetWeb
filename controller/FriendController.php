<?php


class FriendController extends Controller 
{
	public function __construct() 
	{
	}
	
	function addFriend()
	{
		$player = parameters()["player"];
		$model = new FriendModel();
		$model->add($player,$_SESSION["pseudo"]);
	}
}