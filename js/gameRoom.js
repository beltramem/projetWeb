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
				document.location.reload(true);
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
	
	var invitButton = document.getElementsByClassName("invitation")
	for (var i=0;i<invitButton.length;i++)
	{
		invitButton[i].onclick = function()
		{
			var player = this.id
			inviteScript(idGame,player)
		}
	}
	
	// console.log(fireButton[0]);
	var fireButton = document.getElementsByClassName("fire")
	for (var i=0;i<fireButton.length;i++)
	{
		fireButton[i].onclick = function()
		{
			var player = this.id
			fireScript(idGame,player)
		}
	}
}

window.onload =init()