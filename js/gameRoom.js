

function createXHR ( ) {
		var resultat = null ;
		try { // test pour opera , Mozilla ,...
			resultat = new XMLHttpRequest ( ) ;
		}
		catch (Error) {
			try { //test pour IE > 5.0
			resultat = new ActiveXObject( "Msxml2.XMLHTTP" ) ;
			}
		catch ( Error ) {
			try { // test pour IE 5.0
				resultat = new ActiveXObject( "Microsoft.XMLHTTP" ) ;
			}
			catch ( Error ) {
				resultat = null ;
			}
		}} 
		return resultat ;
}


function fireScript(game,player){
	var request = createXHR()
	request.onreadystatechange = function()
	{
			if(request.readyState===4)
			{
				var player_section = document.getElementById("player_section");
				player_section.innerHTML = request.responseText
					var fireButton = document.getElementsByClassName("fire")
					for (var i=0;i<fireButton.length;i++)
					{
						fireButton[i].onclick = function()
						{
							var player = this.id
							fireScript(game,player)
						}
					}
			}
	}
	request.open('GET', "?page=gameRoom/fire/&game="+game+"&player="+player, true)
	request.send()
} 

function inviteScript(game,player){
	var request = createXHR()
	request.open('GET', "?page=gameRoom/ivitPlayer/&game="+game+"&player="+player, true)
	request.send()
} 


function reloadplayer(game)
{

		var request = createXHR()
	request.onreadystatechange = function()
	{
			if(request.readyState===4)
			{
				var player_section = document.getElementById("player_section");
				player_section.innerHTML = request.responseText
				var invitButton = document.getElementsByClassName("invitation")
				for (var i=0;i<invitButton.length;i++)
				{
					invitButton[i].onclick = function()
					{
						var player = this.id
						inviteScript(game,player)
					}
				}
			}
	}
	request.open('GET', "?page=gameRoom/getPlayerView/&game="+game, true)
	request.send()
}

function reloadfriend(game)
{

		var request = createXHR()
	request.onreadystatechange = function()
	{
			if(request.readyState===4)
			{
				var friend_section = document.getElementById("friend_section");
				friend_section.innerHTML = request.responseText
			}
	}
	request.open('GET', "?page=gameRoom/getFriendView/&game="+game, true)
	request.send()
}


function init()
{
	var idGame = document.getElementById("gameId")
	idGame = idGame.innerHTML
	
	var inviteByName = document.getElementById("inviteByName")
	inviteByName.onclick = function()
		{
			var player = document.getElementById("invitName").value;
			inviteScript(idGame,player)
		}
	

	
	// console.log(fireButton[0]);

	chroneScript()
}

function chroneScript()
{
	var idGame = document.getElementById("gameId")
	idGame = idGame.innerHTML
	reloadplayer(idGame);
	reloadfriend(idGame)
	setTimeout(chroneScript,5000);
	
}

window.onload =init()