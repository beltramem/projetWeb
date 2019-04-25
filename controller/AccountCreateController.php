<?php

require('model/AccountCreateModel.php');

class AccountCreateController extends Controller 
{
	
	public function __construct() 
	{
	}
	
	public function index() 
	{
		$model = new AccountCreateModel;
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
					$this->render("index");
					echo "les deux mote de passe ne correspondent pas";
				}
			}
			else
			{
				$this->render("index");
				echo "le pseudo doit faire plus de 5 caractère de longeur";
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