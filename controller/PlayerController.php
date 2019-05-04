<?php

// require("model/ConnexionModel.php");

class PlayerController extends Controller 
{
	public function __construct() 
	{
	}
	
	public function disconnect()
	{
		unset($_SESSION["pseudo"]);
		header("Location: .");
	}

	public function connexion() 
	{
		$model = new PlayerModel;
		if(!empty($_POST["pseudo"]) && !empty($_POST["pass"]))
		{
			
			$player = $model->findBy("player","pseudo","'".$_POST["pseudo"]."'");
			// var_dump($player);
			if($player!=null)
			{
				$md5Pass = md5($_POST["pass"]);
				if($md5Pass == $player[0]["mdp"])
				{
					$_SESSION["pseudo"]=$_POST["pseudo"];
					header("Location: .");
				}
				else
				{
					$this->render("connexion");			
				}
			}
			else
			{
				$this->render("connexion");
			}
	}
		else
		{
			$this->render("connexion");
		}
	}
	
	public function create() 
	{
		$model = new PlayerModel;
		if(!empty($_POST['pseudo']))
		{
			if(strlen($_POST['pseudo'])>=4)
			{
				if($_POST['pass'] == $_POST['pass2'])
				{
					$model->addAccount();
					header("Location: .");
				}
				else
				{
					$this->render("create");
					echo "les deux mote de passe ne correspondent pas";
				}
			}
			else
			{
				$this->render("create");
				echo "le pseudo doit faire plus de 5 caractère de longeur";
			}
		}
		else
		{
			$this->render("create");
		}
	}
	
	public function about()
	{
		$this->render("about");
	}
}