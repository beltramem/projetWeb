<?php

require("model/ConnexionModel.php");

class ConnexionController extends Controller 
{
	public function __construct() 
	{
	}

	public function index() 
	{
		$model = new ConnexionModel;
		if(!empty($_POST["pseudo"]) && !empty($_POST["pass"]))
		{
			
			$player = $model->findBy("player","pseudo",$_POST["pseudo"]);
			if($player!=null)
			{
				$md5Pass = md5($_POST["pass"]);
				if($md5Pass == $player["mdp"])
				{
					$_SESSION["pseudo"]=$_POST["pseudo"];
					header("Location: .");
				}
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