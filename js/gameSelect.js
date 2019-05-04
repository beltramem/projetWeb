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


function reloadPlay()
{
	var player = document.getElementById("pseudo").innerHTML
	console.log(player)
	var request = createXHR()
	request.onreadystatechange = function()
	{
			if(request.readyState===4)
			{
				var play_section = document.getElementById("play_section");
				play_section.innerHTML = request.responseText
				var play_table = document.getElementById("play_games");
				var tr = play_table.getElementsByTagName("tr")
				for (var i=0;i<tr.length;i++)
				{
					tr[i].onclick= function()
					{
						var id = this.getElementsByTagName("td")[0].innerHTML
						document.location='?page=playerStat/joinGame/&player='+player+'&game='+id
					}
				}
			}
	}
	request.open('GET', "?page=Game/GetUnstartGameView", true)
	request.send()
}

function reloadSpectate()
{
	var player = document.getElementById("pseudo").innerHTML
	console.log(player)
	var request = createXHR()
	request.onreadystatechange = function()
	{
			if(request.readyState===4)
			{
				var spectate_section = document.getElementById("spectate_section");
				spectate_section.innerHTML = request.responseText
				var spectate_table = document.getElementById("spectate_games");
				var tr = spectate_table.getElementsByTagName("tr")
				for (var i=0;i<tr.length;i++)
				{
					tr[i].onclick= function()
					{
						var id = this.getElementsByTagName("td")[0].innerHTML
						document.location='?page=player/SpectateGame/&player='+player+'&game='+id
					}
				}
			}
	}
	request.open('GET', "?page=Game/GetSpectateGameView", true)
	request.send()
}

function init()
{	
	chroneScript()
}

function chroneScript()
{
	reloadPlay()
	reloadSpectate()
	setTimeout(chroneScript,3000);
	
}

window.onload =init()