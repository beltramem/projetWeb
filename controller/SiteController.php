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
	
	public function setFriendRequest()
	{
		$model = new model;
		// $model->
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