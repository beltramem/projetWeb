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


function execScript(game,player){
	console.log(game)
	console.log(player)
	var request = createXHR()
	request.onreadystatechange = function()
	{
			if(request.readyState===4)
			{
				var body = document.getElementsByTagName('body')
				body[0].innerHTML = request.responseText
			}
	}
	request.open('GET', "?page=gameRoom/fire/&game="+game+"&player="+player, true)
	request.send()
} 


function init()
{
	var idGame = document.getElementById("gameId")
	idGame = idGame.innerHTML
	var fireButton = document.getElementsByClassName("fire")
	console.log(fireButton[0]);

	for (var i=0;i<fireButton.length;i++)
	{
		fireButton[i].onclick = function()
		{
			var player = this.id
			execScript(idGame,player)
		}
	}
}

window.onload =init()