
<body>
	<section class="player">
		<label>numéro de la partie = </label><label id="gameId"><?= $data["game"] ?></label>
		<table id="players">
		<tr>
			<th>joueurs</th>
			<th><?= htmlspecialchars(count($data["players"]))?>/<?= htmlspecialchars($data["nbPlayer"][0]) ?></th>
		</tr>
		<?php
			foreach($data["players"] as $player)
			{
				echo "<tr>";
				echo "<td>".$player['player']."</td>";
				echo "<td><button class=fire id=".$player["player"].">virer</button></td>";
				echo"</tr>";
			}
		?>
		</table>
		
		<label>Inviter un joueur (pseudo): </label><input type="text" id="name" name="name" maxlength="8"><button>inviter</button>	

		<table id="friend">
		<tr>
			<th>inviter des amis</th>
		</tr>
		<?php
			foreach($data["friends"] as $friend)
			{
				echo "<tr>";
				echo "<td>".$friend."</td>";
				if ($data["invitOk"])
				{	
					echo "<td><button>inviter</button></td>";
				}
				echo"</tr>";
			}
		?>
		</table>
	
	
	</section>
</body>

<script type="text/javascript" src="./js/gameRoom.js"></script>
