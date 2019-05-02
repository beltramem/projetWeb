<!-- <meta http-equiv="refresh" content="6" /> -->
<body>
	<section class="button">
		<a href="?page=gameRoom/leave/&game=<?= $data["game"] ?>"><button>quitter</button></a>
		<?php
		if($data["startOk"])
		{
			echo "<a href='?page=gameRoom/start/&game=".$data['game']."><button>commencer la partie</button></a>";
		}
		?>
	</section>
		<label>numéro de la partie = </label><label id="gameId"><?= $data["game"] ?></label>
		<section class="player" id="player_section">
		</section>
		<section class="invite">
		<label>Inviter un joueur (pseudo): </label><input type="text" id="invitName" name="name" maxlength="8"><button id="inviteByName">inviter</button>	
		<section id="friend_section">
		</section>
	
	</section>
</body>

<script type="text/javascript" src="./js/gameRoom.js"></script>
