<?php

class SiteController extends Controller 
{
	public function __construct() 
	{
	}
	
	public function getInvitation()
	{
		$model = new Model;
		$data["invitations"] = $model->findBy("invitation","recipient","'".$_SESSION["pseudo"]."'");
		$this->viewer("invitations",$data);
	}
	
	public function getFriendRequest()
	{
		$model = new Model;
		$data["friendRequest"] = $model->findBy("friendRequest","playerTwo","'".$_SESSION["pseudo"]."'");
		$this->viewer("friendRequest",$data);
	}
	

	public function index() 
	{
		$this->render("index");
	}

	public function about()
	{
		$this->render("about");
	}
}