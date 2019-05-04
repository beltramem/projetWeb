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

	function getFriendRequestData()
	{
		$model = new Model();
		$data["friendRequest"] = $model->findBy("friendrequest","playerTwo","'".$_SESSION["pseudo"]."'");
		return $data;
	}
	
	function getFriendRequestView()
	{
		$data = array();
		$data = $this->getFriendRequestData($data);
		$this->viewer("friendRequest",$data);
	}
	
	public function index()
	{
		$model = new Model();
		$this->render("index");
	}
	
	public function DropFriendRequest()
	{
		$playerOne = parameters()["player"];	
		$playerTwo = $_SESSION["pseudo"];
		$model = new FriendrequestModel();
		$model->drop($playerOne,$playerTwo);
	}
}