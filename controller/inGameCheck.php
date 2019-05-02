<?php
require("model/Model.php");

if(isset($_SESSION["pseudo"]))
{
	$model = new model();
	$ingame = $model->findBy("playerStat","player","'".$_SESSION["pseudo"]."'");
	// var_dump($ingame[0]);
	if(count($ingame)>0)
	{
		$_SESSION["ingame"]=$ingame[0]["game"];
		$idGame = (int)$ingame[0]["game"];
		$gameState= $model->findBy("game","id",$idGame);
		$gameState= $gameState[0]["state"];
		$_SESSION["gameState"] = $gameState;
	}
}

?>