<?php

$data = NULL;

class Controller 
{
	public function __construct()
	{}
		public function render($view, $d=null)
		{
			global $data;
			include_once "view/header.php";
			if(isset($_SESSION["pseudo"]))
			{
				include_once "view/navbar.php";
			}
			else
			{
				include_once "view/defaultHeader.php";
			}
			$controller = get_class($this);
			$model = substr($controller, 0, strpos($controller, "Controller"));
			$data = $d;
			include_once "view/".strtolower($model)."/".$view.".php";
			include_once "view/footer.php";
		}
}