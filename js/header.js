
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

function invitationScript(game,player){
	var request = createXHR()
	request.onreadystatechange = function()
	{
			if(request.readyState===4)
			{
				var invitation = document.getElementById("invitationResponse")
				// console.log(invitation.innerHTML);
				invitation.innerHTML = request.responseText
			}
	}
	request.open('GET', "?page=site/getInvitation", true)
	request.send()
} 

function inviteRequestScript(invitName)
{
	var request = createXHR()
	request.onreadystatechange = function()
	{
	}
	request.open('GET', "?page=FriendRequest/addFriendRequest/&recipient="+invitName, true)
	request.send()
}

function init()
{
	var inviteByNameButton = document.getElementById("inviteByName")
	inviteByNameButton.onclick= function()
		{
			var invitName = document.getElementById("invitName").value;
			inviteRequestScript(invitName)
		}
}

function chroneScript()
{

	invitationScript();
	setTimeout(chroneScript,5000);
	
}
init()
chroneScript();