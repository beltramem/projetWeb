<?php

require("model/ConnexionModel.php");

class ConnexionController extends Controller 
{
	public function __construct() 
	{
	}
	
	public function disconnect()
	{
		unset($_SESSION["pseudo"]);
		header("Location: .");
	}

	public function index() 
	{
		$model = new ConnexionModel;
		if(!empty($_POST["pseudo"]) && !empty($_POST["pass"]))
		{
			
			$player = $model->findBy("player","pseudo","'".$_POST["pseudo"]."'");
			// var_dump($player);
			if($player!=null)
			{
				$md5Pass = md5($_POST["pass"]);
				if($md5Pass == $player[0]["mdp"])
				{
					var_dump("bite");
					$_SESSION["pseudo"]=$_POST["pseudo"];
					header("Location: .");
				}
				else
				{
					$this->render("index");			
				}
			}
			else
			{
				$this->render("index");
			}
	}
		else
		{
			$this->render("index");
		}
	}

	public function about()
	{
		$this->render("about");
	}
}