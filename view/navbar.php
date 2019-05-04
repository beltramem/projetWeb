<header>
		<nav>
			<ul>
				<li class="titre">Les Blaireaux et les Kékés</li>
				<li><img class="menu" src="img/menu.png"></img></li>
			</ul>
			<a href="?page=playerStat"><img class="play-button" src="img/play-button.png"></img></a>
		</nav>
	</header>
	<div class="retractable-menu">
		
		<ul>
			<li id="pseudo"><a><?= $_SESSION["pseudo"] ?></a></li>
			<li class="deco"><a href="?page=player/disconnect">déconnexion</a></li> 
			<li class="mode-menu"><a href="">Jour</a><a href="">nuit</a><a href="">noir</a></li> 
			<li class="account-menu"><a href="">Mon compte</a></li>
			<li class="friend_adder">
				<a><label>ajouter un amis(pseudo): </label></a>
				<input type="text" id="invitName" name="name" maxlength="8">
				<button id="inviteByName">inviter</button>
			</li>
			<li class="invitation-menu" > <a><label class="invitations">Invitations</label></a>
				<section id="invitationResponse">
				</section>
			</li>
		</ul>
	</div>
<script type="text/javascript" src="./js/header.js"></script>