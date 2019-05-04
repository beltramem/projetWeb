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

function addFriend(player)
{
	var request = createXHR()
	request.onreadystatechange = function()
	{
			if(request.readyState===4)
			{
			}
	}
	request.open('GET', "?page=Friend/AddFriend/&player="+player, true)
	request.send()
}

function reloadFriendRequest()
{
	var request = createXHR()
	request.onreadystatechange = function()
	{
			if(request.readyState===4)
			{
				var FriendRequest_section = document.getElementById("FriendRequest_section");
				FriendRequest_section.innerHTML = request.responseText
				var NoButton = document.getElementsByClassName("no")
				for (var i=0;i<NoButton.length;i++)
				{
					NoButton[i].onclick = function()
					{
						var player = this.id
						dropFriendRequest(player)
					}
				}				
				
				var YesButton = document.getElementsByClassName("yes")
				for (var i=0;i<YesButton.length;i++)
				{
					YesButton[i].onclick = function()
					{
						var player = this.id
						addFriend(player)
					}
				}
			}
	}
	request.open('GET', "?page=FriendRequest/getFriendRequestView", true)
	request.send()
}

function dropFriendRequest(player)
{
	var request = createXHR()
	request.onreadystatechange = function()
	{
			if(request.readyState===4)
			{
			}
	}
	request.open('GET', "?page=FriendRequest/DropFriendRequest/&player="+player, true)
	request.send()
}

function init()
{
	var NoButton = document.getElementsByClassName("no")
		for (var i=0;i<NoButton.length;i++)
		{
			NoButton[i].onclick = function()
			{
				var player = this.id
				dropFriendRequest(player)
			}
		}
}

function chroneScript()
{

	reloadFriendRequest()
	setTimeout(chroneScript,5000);
	
}
init()
chroneScript();