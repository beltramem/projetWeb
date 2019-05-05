
document.addEventListener('keypress', (event) => {
    const nomTouche = event.key;
    if(nomTouche=="z"||nomTouche=="q"||nomTouche=="d")
    	envoi(nomTouche);

  });


function envoi(recup){

  var objetXHR = new XMLHttpRequest();
  objetXHR.open("get","?page=partie/reception&param="+recup,false );
  objetXHR.send(null);

}

function reload(){
 	
  	 charge();
  	setTimeout(reload,100);
}

function charge(){
	var objetXHR = new XMLHttpRequest();
	//alert("je charge");
	var idGame = document.getElementById("truc");
	console.log(""+idGame);
	objetXHR.onreadystatechange = function()
	{
			if(objetXHR.readyState===4)
			{
				idGame.innerHTML=objetXHR.responseText;
			}
	}

 	 objetXHR.open("get","?page=partie/affichage",true );
  	 objetXHR.send(null);
}

  