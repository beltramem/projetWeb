<?php

require("model/PartieModel.php");

class partieController extends Controller 
{
	public function __construct() 
	{
	}
	
	function getmap()
	{
		$model = new PartieModel();
		$players =$model->getMap(157);
		//var_dump($players);
		return $players;
	}
	
	function getPlayersPosition()
	{
		$model = new PartieModel;
		$players =$model->getPlayersPosition(157);
		return $players;
	}

	function reception(){
		$em=new PartieModel();
		$key=$_GET["param"];

		switch ($key){
			case 'z':
				$em->setPlayersPosition(0); break;
			case 'q':
				$em->setPlayersPosition(-1); break;
			case 'd':
				$em->setPlayersPosition(1); break;
		}

		/*
		$oiseaux=new SimpleXMLElement("<messages/>");
		$oiseaux->addChild("message",$touche);
		$oiseaux->asXML('data2.xml');
		*/
	}

	function affichage(){

		
		$map=$this->getmap();
		$joueurs=$this->getPlayersPosition();
		var_dump($joueurs);
		
		$nbrX=count($map);
		for($x=0;$x<$nbrX;$x++)
		{
			$nbrY=count($map[$x]);
			for($y=0;$y<$nbrY;$y++)
			{
				for($k=0; $k<count($joueurs);$k++){
					if($joueurs[$k]['posX']==$x&&$joueurs[$k]['posY']==$y){
						if($joueurs[$k]['team']=="blaireau")
							$map[$x][$y]=9;
						else
							$map[$x][$y]=8;
					}

				}
				echo $map[$x][$y];
			}
			echo "<br>";
		}
		//$this->viewer("partie",0);
		
	}

	public function index() 
	{
		$this->render("index");
		/*
		$em=new EssaiModel();
		$essai=$em->setPlayersPosition(0);
		echo " <br> session = ".$essai;
		*/
		//$map=$this->getmap();
		//$joueurs=$this->getPlayersPosition();
		//$this->affichage();


	}

	public function about()
	{
		$this->render("about");
	}
}