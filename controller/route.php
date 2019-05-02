<?php

$parameters = array();
if (isset($_POST))
	foreach($_POST as $k=>$v)
		$parameters[$k] = $v;
if (isset($_GET))
	foreach($_GET as $k=>$v)
		$parameters[$k] = $v;

function parameters()
{
	global $parameters;
	return $parameters;
}


if(isset($_SESSION["pseudo"]))
{
	// include_once "controller/inGameCheck.php";
	// if(isset($_SESSION["ingame"]))
		// {
			// if($_SESSION["gameState"]=="create")
			// {
				// $c = new GameRoomController;
				// $c->index();
			// }
		// }
	if (isset(parameters()["page"]))
	{
		$route = parameters()["page"];
		// var_dump($route);
		if ("default")
			list($controller, $action) = array("site","error");
		if (strpos($route, "/") === FALSE)
			list($controller, $action) = array($route,"index");
		else
			list($controller, $action) = explode("/", $route);

		$controller = ucfirst($controller)."Controller";
		$c = new $controller();
		$c->$action();
	}else 
	{
		$c = new SiteController();
		$c->index();
	}
}

elseif(isset(parameters()["page"])&&parameters()["page"]=="accountCreate")
{
	$c = new AccountCreateController;
	$c->index();
}
else
{
	$c = new ConnexionController;
	$c->index();
}