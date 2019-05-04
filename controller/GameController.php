<?php

// require("model/GameCreateModel.php");

class GameController extends Controller 
{
	public function __construct() 
	{
	}
	
	// public function avoidSquare($xSize, $ySize, $map)
	// {
		// for($i=0; $i<$xSize; $i++)
		// {
			// for($j=0; $j<$ySize; $j++)
			// {
			
				// if($map[$i][$j]==1)
				// {
					
				// }
					
			// }
		// }
	// }
	//gentils 8 - méchants 9
	public function PlayerInitPos($xSize,$ySize,$map){
		$gc=new GameModel();
		//positionner les blaireaux
		//ici, 1/3 des joueurs sont des blaireaux
		//on place les blaireaux aléatoirement sur la carte
		$nbPlayers=3;

	    $nbBlaireau=(int)($nbPlayers/3);
	    $nbAPoser=$nbBlaireau;
	    
	    for($i=0;$i<$nbBlaireau;$i++){
	    $posCorrect=false;    
	        
	       while(!$posCorrect){
	            $positX=rand(1,$xSize-2);
	            $positY=rand(1,$ySize-2);
	     		
	     		//vérification que la case est bien vide
	            if($map[$positX][$positY]==0){	                
	            	$posCorrect=true;
	            }
	          
	            
	        }
	        $map[$positX][$positY]=9;
            $gc->addPositionBlaireau($positX,$positY);
            
		                
		            
		        
		}

		//positionner les kékés
		//2/3 des joueurs sont des kékés
		//on place les kékés aléatoirement sur la carte
		$ecart=2;
		$nbKeke=$nbPlayers-$nbBlaireau;
		for($i=0;$i<$nbKeke;$i++){
			
			$posCorrect=false;
			While(!$posCorrect){
				$positX=rand(1,$xSize-2);
				$positY=rand(1,$ySize-2);
				$posCorrect=true;

				//vérification que la case est bien vide
				 if($map[$positX][$positY]!=0){
	                $posCorrect==false;
	            }

	            //vérification qu'il n'y a pas un blaireau juste à côté
	            for($i=$positX-1;$i<=$positX+1;$i++){
	                for($j=$positY-1;$j<=$positY+1;$j++){
	                    if($map[$i][$j]==9){
	                        $posCorrect=false;
	                    }
	                }
                }
            }
        }
				
			$posCorrect=true;
			$gc->addPositionKeke($positX,$positY);
			$map[$positX][$positY]=8;

		return $map;
	}
	
	public function powerup($xSize,$ySize,$map)
	{
		$averageSize = ($xSize+$ySize)/2;
		$nbInvisible = 1;
		$nbBoots = 1;
		$nbShield = 1;
		$nbSuperView = 1;
		$nbIncognito = 1;
		$morePower = 0;
		if($averageSize>10)
		{
			$morePower = $morePower +2;
		}
		elseif($averageSize<=30)
		{
			$morePower = $morePower +4;
		}
		
		for ($i=1; $i<=$morePower; $i++)
		{
			$powerChoice = rand(0,4);
			if($powerChoice==0)
			{
				$nbInvisible++;
			}
			elseif($powerChoice==1)
			{
				
			}
			elseif($powerChoice==2)
			{
				$nbShield++;
			}
			elseif($powerChoice==3)
			{
				$nbSuperView++;
			}
			elseif($powerChoice==4)
			{
				$nbIncognito++;
			}
		}
		
		do
		{
			if($nbInvisible>0)
			{
				$powerupOk = false;
				do
				{
					$x = rand(1,$xSize-2);
					$y = rand(1,$ySize-2);
					if($map[$x][$y]==0)
					{
						$map[$x][$y] = 3.1;
						$powerupOk = true;
						$nbInvisible--;
					}
				}while(!$powerupOk);
			}
			if($nbBoots>0)
			{
				$powerupOk = false;
				do
				{
					$x = rand(1,$xSize-2);
					$y = rand(1,$ySize-2);
					if($map[$x][$y]==0)
					{
						$map[$x][$y] = 4.1;
						$powerupOk = true;
						$nbBoots--;
					}
				}while(!$powerupOk);
			}
			if($nbShield>0)
			{
				$powerupOk = false;
				do
				{
					$x = rand(1,$xSize-2);
					$y = rand(1,$ySize-2);
					if($map[$x][$y]==0)
					{
						$map[$x][$y] = 5.1;
						$powerupOk = true;
						$nbShield--;
					}
				}while(!$powerupOk);
			}
		    if($nbSuperView>0)
			{
				$powerupOk = false;
				do
				{
					$x = rand(1,$xSize-2);
					$y = rand(1,$ySize-2);
					if($map[$x][$y]==0)
					{
						$map[$x][$y] = 6.1;
						$powerupOk = true;
						$nbSuperView--;
					}
				}while(!$powerupOk);
			}
			if($nbIncognito>0)
			{
				$powerupOk = false;
				do
				{
					$x = rand(1,$xSize-2);
					$y = rand(1,$ySize-2);
					if($map[$x][$y]==0)
					{
						$map[$x][$y] = 7.1;
						$powerupOk = true;
						$nbIncognito--;
					}
				}while(!$powerupOk);
			}
		}while($nbIncognito >0 || $nbBoots>0 || $nbSuperView >0 || $nbShield>0 || $nbBoots>0);
		
		return $map;
	}
	
	public function fill_wall($xSize,$ySize,$map)
	{
		for ($x=1 ; $x<$xSize-1; $x++)
		{
			for ($y=1; $y<$ySize-1 ; $y++)
			{
				if($map[$x+1][$y]==1 && $map[$x-1][$y]==1 && $map[$x][$y+1]==1 && $map[$x][$y-1]==1)
				{
					$map[$x][$y]=1;
				}
			}
		}
		return $map;
	}
	
	public function room($xSize, $ySize , $map)
	{
		$xRoomSize = rand($xSize/8, $xSize/4);
		$yRoomSize = rand($ySize/8, $ySize/4);
		$xOpening = rand($xRoomSize/5, $xRoomSize/3);
		$yOpening = rand($yRoomSize/5, $yRoomSize/3);
		$xBorderSpacing = rand(1,$xRoomSize-$xOpening);
		$yBorderSpacing = rand(1,$yRoomSize-$yOpening);
		
		$xStartPosition = rand(0,$xSize-$xRoomSize);
		$yStartPosition = rand(0,$ySize-$yRoomSize);
		
		
		// mûrs 
		for($i=$xStartPosition;$i<$xStartPosition+$xRoomSize;$i++)
		{
			$map[$yStartPosition][$i]=1;
			$map[$yStartPosition+$yRoomSize][$i]=1;
		}
		for($i=$yStartPosition;$i<$yStartPosition+$yRoomSize;$i++)
		{
			$map[$i][$xStartPosition]=1;
			$map[$i][$xStartPosition+$xRoomSize-1]=1;
		}
		
		// ouvertures
		for($i=$xStartPosition+$xBorderSpacing;$i<$xStartPosition+$xBorderSpacing+$xOpening;$i++)
		{
			$map[$yStartPosition][$i]=0;
			$map[$yStartPosition+$yRoomSize][$i]=0;
		}
		for($i=$yStartPosition+$yBorderSpacing;$i<$yStartPosition+$yBorderSpacing+$yOpening;$i++)
		{
			$map[$i][$xStartPosition]=0;
			$map[$i][$xStartPosition+$xRoomSize-1]=0;
		}
		
		return $map;
	}
	
	public function intern_wall($xSize,$ySize, $map)
	{
		$startOk = false;
		$startFalse = 0;
		$avort=false;
		do
		{
			$xStartPosition = rand(3,$xSize-3);
			$yStartPosition = rand(3,$ySize-3);
			
			if($map[$xStartPosition+1][$yStartPosition]==0 && $map[$xStartPosition-1][$yStartPosition]==0 && $map[$xStartPosition][$yStartPosition+1]==0 && $map[$xStartPosition][$yStartPosition-1]==0 && $map[$xStartPosition+1][$yStartPosition+1]==0 && $map[$xStartPosition-1][$yStartPosition+1]==0 && $map[$xStartPosition+1][$yStartPosition-1]==0 && $map[$xStartPosition-1][$yStartPosition-1]==0)
			{
				$startOk = true;
			}
			elseif($startFalse < 6)
			{
				$startFalse++;
			}
			else
			{
				$avort = true;
			}
		}while (!$startOk && !$avort);
		
		
		if ($startOk)
		{
			$averageSize = ($xSize+$ySize)/2;
			$size = rand(5,$averageSize-1);
			
			$x = $xStartPosition;
			$y = $yStartPosition;
		
			do
			{
				$directionOk = false;
				$directionChoice = rand(0,3);
				
				/*
					x+ on va vers la droite
					x- on va à gauche
					y+ on descend
					y- on monte
				*/
				
				if($directionChoice ==0 && $map[$x][$y+1]==0)
				{
					$directionOk= true;
					$direction = "y+";
				}
				elseif($directionChoice ==1 && $map[$x][$y-1]==0)
				{
					$directionOk= true;
					$direction = "y-";
				}
				elseif($directionChoice ==2 && $map[$x+1][$y]==0)
				{
					$directionOk= true;
					$direction = "x+";
				}
				elseif($directionChoice ==3 && $map[$x-1][$y]==0)
				{
					$directionOk= true;
					$direction = "x-";
				}
			}while(!$directionOk);
			
			$directionOk = false;
			$currentSize = 0;
			$directionFalse = 0;
			
			do
			{
				// on place un mûrs sur la case actuelle
				$map[$x][$y] = 1;
				
				// on choisit si on tourne et dans quel sens
				$directionShift = rand(1,12);
				
				
				// après avoir choisit le sens aléatoirement on vérifie que si l'on continue dans ce sens nous ne rencontrons pas de mûr pour éviter d'avoir un ou plusieurs joueurs bloqués entre 4 mûrs et isolé des autres
				
				/*
					x+ on va vers la droite
					x- on va à gauche
					y+ on descend
					y- on monte
				*/
				
				//si on tourne à gauche
				
				if($directionShift <= 3)
				{
					//si on descend ou on monte
					if($direction=="y+" || $direction=="y-")
					{
						if ($x >2 && $map[$x-1][$y]==0)
						{
							$x--;
							$direction = "x-";
							$directionOk = true;
						}
					}
					
					elseif($direction=="x+")
					{
						if($y > 2 && $map[$x][$y-1]==0)
						{
							$y--;
							$direction = "y-";
							$directionOk = true;
						}
					}
					elseif($direction=="x-")
					{
						if($y < $ySize-3 && $map[$x][$y+1]==0)
						{
							$y++;
							$direction = "y+";
							$directionOk = true;
						}
					}
				}
				
				//si on reste droit
				elseif($directionShift <= 9)
				{
					if($direction=="y+")
					{
						if ($y<$ySize-3 && $map[$x][$y+1]==0)
						{
							$y++;
							$direction = "y+";
							$directionOk = true;
						}
					}
					elseif($direction=="y-")
					{
						if($y > 2 && $map[$x][$y-1]==0)
						{
							$y--;
							$direction = "y-"; 
							$directionOk = true;
						}
					}
					elseif($direction=="x+")
					{
						if($x < $xSize-3 && $map[$x+1][$y]==0)
						{
							$x++;
							$direction = "x+";
							$directionOk = true;
						}
					}
					elseif($direction=="x-")
					{
						if($x >2 && $map[$x-1][$y]==0)
						{
							$x--;
							$direction = "x-";
							$directionOk = true;
						}
					}
				}
				
				
				// si on tourne à droite
				elseif($directionShift <= 12)
				{
					//si on descend ou on monte
					if($direction=="y+" || $direction=="y-")
					{
						if ($x < $xSize-3 && $map[$x+1][$y]==0)
						{
							$x++;
							$direction = "x++";
							$directionOk = true;
						}
					}
					
					elseif($direction=="x+")
					{
						if($y < $ySize-3 && $map[$x][$y+1]==0)
						{
							$y++;
							$direction = "y+";
							$directionOk = true;
						}
					}
					elseif($direction=="x-")
					{
						if($y > 2 && $map[$x][$y-1]==0)
						{
							$y--;
							$direction = "y-";
							$directionOk = true;
						}
					}
				}
				
				
				// si on est dans un direction qui ne rencontre pas de mûrs on a déjà déplacer le curseur sur la case suivante et on augmente la taille du mûrs
				if($directionOk)
				{
					$currentSize++;
					$directionOk=false;
					$directionFalse =0;
				}
				// si c'est une mauvaise tentative (si on va dans cette direction on rencontre un mûr) et si on a fait moins de 5 tentative dans une direction qui rencontre un mûrs on ajoute 1 au conteur de mauvaise tentative et on recommence le choix de la direction de la même case
				elseif($directionFalse <= 4)
				{
					$directionFalse++;
					// var_dump($directionFalse);
				}
				// si c'est une mauvaise tentative et qu'on en a fait 5 on finit le mûr ici même s'il n'a pas atteint la taille voulut on considère un blocage pour eviter de rester bloqué dans la boucle
				else
				{
					$currentSize = $size;
				}
				
			}while( $currentSize < $size);
		}
		
		return $map;
	}
	
	public function extern_wall($xSize, $ySize, $map)
	{
		// détermine les bordure
		for($i=0;$i<$ySize;$i++)
		{
			$map[0][$i] =1;
			$map[$xSize-1][$i] =1;
		}
		for($i=0;$i<$xSize;$i++)
		{
			$map[$i][0] = 1;
			$map[$i][$ySize-1] = 1;
		}
		
		// détermine ouverture

		$opening = rand($xSize/3, $xSize/2);
		$borderSpacing = rand(1,$xSize-$opening);
		$opening2 = rand($ySize/3, $ySize/2);
		$borderSpacing2 = rand(1,$ySize-$opening2);
		for($i=$borderSpacing;$i<$borderSpacing+$opening-1;$i++)
		{
			$map[0][$i] = 0;
			$map[$xSize-1][$i] = 0;
		}
		for($i=$borderSpacing2;$i<$borderSpacing2+$opening2-1;$i++)
		{
			$map[$i][0] = 0;
			$map[$i][$ySize-1] = 0;
		}
		
		return $map;
	}
	
	public function magic_pudlle($xSize,$ySize,$map)
	{
		$averageSize = ($xSize+$ySize)/2;
		if($averageSize<10)
		{
			$nbMagicPuddle = rand(2,3); 
		}
		elseif($averageSize<=30)
		{
			$nbMagicPuddle = rand(3,5);
		}
		else
		{
			$nbMagicPuddle = rand(3,6);
		}
		
		do
		{
			$magicPuddleOk = false;
			do
			{
				$x = rand(1,$xSize-2);
				$y = rand(1,$ySize-2);
				if($map[$x][$y]==0)
				{
					$map[$x][$y] = 2;
					$magicPuddleOk = true;
					$nbMagicPuddle--;
				}
			}while(!$magicPuddleOk);
			
			
		}while($nbMagicPuddle>0);
		return $map;
	}
	
	public function create_map()
	{
		$model = new GameModel;
		
		
		$xSize = 30;
		$ySize = 35;
		// création tab
		$map = array_fill(0,$xSize,array_fill(0,$ySize,0));
		
		// appel fonction map extern mûrs externes et ouvertures
		$map = $this->extern_wall($xSize,$ySize,$map);
		
		// appel fonction pièce interieur
			// $nbRoom = $xSize+$ySize/500;
		$averageSize = ($xSize+$ySize)/2;
		if($averageSize <30)
		{
			$nbWall = 12;
		}
		if($averageSize>=30)
		{
			$nbWall = 20;
		}
		if($averageSize>=35)
		{
			
			$nbWall = 60;
		}
		
		for($i=0;$i<$nbWall;$i++)
		{
			//$map = $this->room($xSize,$ySize,$map);
			$map = $this->intern_wall($xSize, $ySize, $map);
		}
		
		$map = $this->fill_wall($xSize, $ySize, $map);
		$map = $this->powerup($xSize, $ySize, $map);
		$map = $this->magic_pudlle($xSize, $ySize, $map);
		$map = $this->PlayerInitPos($xSize,$ySize,$map);
		
		
		// affichage debug
		// echo "<table>";
		// for($i=0 ; $i<$xSize; $i++)
		// { 
			// echo "<tr>";
			// for($j=0 ; $j<$ySize; $j++)
			// {
				// echo "<td>".$map[$i][$j]."</td>";
			// }
			// echo "</tr>";
		// }
		// echo "</table>";
		
		return $map;
	}

	public function index() 
	{
		
		if(isset($_POST["submit"]))
		{
			$duration = $_POST["durationMin"]*60+$_POST["durationSec"];
			if(isset($_POST["private"]))
			{
				$private = 1;
			}
			else
			{
				$private = 0;
			}	
			$model = new GameModel();
			$gameId = $model->add_game($duration,$private);
			$map = $this->create_map();
			// var_dump($map);
			$model->stock_map($map,$gameId[0]);
			$model->add_owner($gameId[0]);
			header("Location: ?page=playerstat/gameRoom/&game=".$gameId[0]);
		}
		else
		{
			//$this->create_map();
			$this->render("index");
		}
	}

	public function about()
	{
		$this->render("about");
	}
}
