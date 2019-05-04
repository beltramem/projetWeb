var camera, scene, renderer;
//var right, up , at;

var map;
var keybord = {};
var murHitBox = 0.5 ;

//player variable
var joueur;
var vitesseJoueur = 1 ;
var cameraJoueur;
var lightJoueur;
var JoueurHitBox = 0.5;
var direction ;
var manger = false ;
var couleurKeke= 0xffffff;
var couleurblaireau= 0x000000 ;
var couleurNeutre = 0xFA05FE;
var joueurCouleur=0xffffff;



//bonus
var superV=false;

/*
1 : haut
2 : droit
3 : bas
4 : gauche
*/
function addLights() {
  var lightOne = new THREE.DirectionalLight(0xffffff);
  lightOne.position.set(1, 1, 1);
  scene.add(lightOne);

  var lightTwo = new THREE.DirectionalLight(0xffffff, 0.5);
  lightTwo.position.set(1, -1, -1);
  scene.add(lightTwo);
}

function plateau() {
  var texture = new THREE.TextureLoader().load('texture/sol.jpg');
  texture.wrapS = THREE.RepeatWrapping;
  texture.wrapT = THREE.RepeatWrapping;
  texture.repeat.set( 4, 4 );
  var geometry = new THREE.PlaneGeometry( map[0].length , map.length ); //(largeur,hauteur)
  //couleur terre
  var material = new THREE.MeshPhongMaterial({
    map : texture, side: THREE.DoubleSide
  });
  
  // Combine la geometry et le materiaux pour faire le sol
  var sol = new THREE.Mesh(geometry, material);

  // Ajout du sol dans la scene
  scene.add(sol);

  // position du sol
  // on ce place au milieu de la map
  sol.position.x = ( map[0].length / 2 ) - 0.5; 
  sol.position.y = -0.5;
  sol.position.z = ( map.length / 2 ) - 0.5;
  sol.rotation.x=Math.PI / 2; // rotation a 90 °
}
function creationMur() {
  map = [
    [0, 1, 1, 0, 1, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 1, 0, 0, 1, 0, ],
    [1, 1, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 1, 0, 0, 1, 0, ],
    [0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 1, 1, 1, 1, 1, 0, 1, 1, 0, 0, 1, 0, ],
    [0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, ],
    [0, 1, 1, 0, 0, 0, 0, 0, 7, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, ],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, ],
    [1, 1, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, ],
    [0, 0, 0, 0, 1, 0, 0, 0, 6, 0, 11, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, ],
    [0, 0, 0, 0, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, ],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, ],
    [0, 0, 0, 0, 0, 0, 0, 0, 6, 0, 7, 0, 1, 0, 1, 0, 0, 1, 0, 1, 0, 1, ],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 1, 0, 0, 1, 0, 0, 0, 1, ],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 1, 0, 1, 0, 0, 1, 1, 1, 0, 1, ],
    [0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 1, ],
    [0, 0, 0, 0, 0, 0, 1, 0, 0, 1, 1, 1, 1, 0, 1, 0, 0, 0, 0, 0, 0, 1, ],
    [1, 1, 1, 0, 1, 1, 1, 1, 0, 1, 0, 1, 1, 0, 1, 0, 0, 0, 0, 0, 0, 1, ],
    [0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, ],
    [1, 1, 1, 0, 0, 0, 0, 0, 0, 1, 0, 1, 0, 1, 0, 0, 0, 0, 0, 0, 1, 1, ],
    [0, 0, 1, 0, 1, 1, 1, 1, 0, 0, 0, 1, 0, 1, 0, 0, 0, 0, 0, 0, 1, 1, ],
    [0, 0, 1, 1, 1, 0, 0, 0, 0, 1, 0, 1, 0, 1, 0, 0, 0, 0, 0, 0, 1, 1, ]
  ];

  // detail du mur*******************
  var texture = new THREE.TextureLoader().load('texture/bibliotheque.jpg');
  var geometryCube = new THREE.BoxGeometry(1, 1 );
  var materialMur = new THREE.MeshPhongMaterial({ map :texture});
  //Test bonus*****************
  var materialVue = new THREE.MeshBasicMaterial({ color : 0xffff00});
  var materialInconnu = new THREE.MeshBasicMaterial({ color : 0xff0000});
  //*********************
  //on parcourt la map et on place tous les éléments
  for (var i = 0; i <  map.length; i++) { // parcourt de haut en bas
    for (var j = 0; j < map[i].length; j++) { // parcourt de gauche a droite
      if (map[i][j] == 1) {
        var cube = new THREE.Mesh(geometryCube, materialMur);
        cube.position.set(j,0,i);
        scene.add(cube);
      }
      if(map[i][j] == 11)
      {
        joueurSpawn(j,i,0)
      }
      if(map[i][j] == 6)
      {
        var cube = new THREE.Mesh(geometryCube, materialVue);
        cube.position.set(j,0,i);
        scene.add(cube);
      }
      if(map[i][j] == 7)
      {
        var cube = new THREE.Mesh(geometryCube, materialInconnu);
        cube.position.set(j,0,i);
        scene.add(cube);
      }
    }
  }
}


function joueurSpawn(a, b ,c) {
    var geometry = new THREE.BoxGeometry( 1, 1 ); //(largeur,hauteur)
    var material = new THREE.MeshPhongMaterial({ color: joueurCouleur, });
    var cube = new THREE.Mesh(geometry, material);
    cameraJoueur = new THREE.PerspectiveCamera(100, window.innerWidth / window.innerHeight, 0.01 ,1000);
    cameraJoueur.position.set(0,c,0)
    cameraJoueur.lookAt(0,0,0);
    joueur = new THREE.Group();
    joueur.add(cube);
    joueur.add(cameraJoueur);
    joueur.position.set(a, 0, b);
    scene.add(joueur);
    direction = 1 ; //direction de base
}

//permet de savoir si un bouton a été appuyé
function onKeyDown(e) {
  keybord[e.keyCode] = true ;
}

 //permet de savoir si un bouton a été relaché
function onKeyUp(e) {
  keybord[e.keyCode] = false ;
}

function onWindowResize() {

  cameraJoueur.aspect = window.innerWidth / window.innerHeight;
  cameraJoueur.updateProjectionMatrix();
  renderer.setSize(window.innerWidth, window.innerHeight);

}
function render() {
    renderer.render(scene, cameraJoueur);
}

function animate() {
    requestAnimationFrame(animate);
    //joueur.matrix.extractBasis(right,up,at);//(x,y,z)
    var y = parseInt(joueur.position.x, 10) ;
    var x = parseInt(joueur.position.z, 10) ;
    //map[x][y]=0;
    var collision = false ;

      if(keybord[38]) {//haut
        if(map[x][y] == 7)
        {
          joueur.children[0].material.color.setHex(couleurNeutre);
          var t = setTimeout(function(){ joueur.children[0].material.color.setHex(joueurCouleur); }, 500);
        }
         /*
         joueur.position.add(at.multiplyScalar(-vitesseJoueur));
         joueur.matrix.extractBasis(right,up,at);
         */
        if((direction == 1)) // haut
        {
          if(superV==true)
          {
            annuleSuperVue(x,y);
          }
          if(map[x-(JoueurHitBox+murHitBox)][y] != 1)
          {
            joueur.position.z -= 1;
            if(map[x-(JoueurHitBox+murHitBox)][y] == 6)
            {
              superVue((x-(JoueurHitBox+murHitBox)), y);
            }
          }
        }
        if(direction == 2) // droite
        {
          if(superV==true)
          {
            annuleSuperVue(x,y+1);
          }
          if(map[x][y+(JoueurHitBox+murHitBox)] != 1)
          {
            joueur.position.x += vitesseJoueur;
            if(map[x][y+(JoueurHitBox+murHitBox)] == 6)
            {
              superVue(x,(y+(JoueurHitBox+murHitBox)));
            }
          }
        }
        if((direction == 3)) //bas
        {
          if(superV==true)
          {
            annuleSuperVue(x+1,y);
          }
          if(map[x+(JoueurHitBox+murHitBox)][y] != 1)
          {
            joueur.position.z += vitesseJoueur;
            if(map[x+(JoueurHitBox+murHitBox)][y] == 6)
            {
              superVue((x+(JoueurHitBox+murHitBox)),y);
            }
          }
        }
        if((direction == 4) ) //gauche
        {
          if(superV==true)
          {
            annuleSuperVue(x,y-1);
          }
          if(map[x][y] != 1)
          {
            joueur.position.x -= vitesseJoueur;
            if(map[x][y-(JoueurHitBox+murHitBox)] == 6)
            {
              superVue(x,y-1);
            }
          }
        }
        keybord[38]=false;
      }
      if(keybord[40]) {//bas à enlever
        if(direction == 1)
         joueur.position.z += vitesseJoueur;
          
        else
          if(direction == 2)
            joueur.position.x -= vitesseJoueur;
          else
            if(direction == 3)
              joueur.position.z -= vitesseJoueur;
            else
              if(direction == 4)
                joueur.position.x += vitesseJoueur;
      }

      if(keybord[37] ) {//gauche
        joueur.rotation.y += 90 * Math.PI / 180;
        keybord[37]=false;
        if(direction == 1)
        direction = 4;
        else
          direction --;
      }

      if(keybord[39]){//droite
        joueur.rotation.y -= 90 * Math.PI / 180 ;
        keybord[39]=false;
        if(direction == 4)
          direction = 1;
        else
          direction ++;
      }
      
    render();
}

function changeTeam(){
  if(joueurCouleur==couleurblaireau)
    joueurCouleur=couleurKeke;
  else
    joueurCouleur=couleurblaireau;
  joueur.children[0].material.color.setHex(joueurCouleur);
}
function annuleSuperVue(x,y){
  cameraJoueur.position.y=0;
  cameraJoueur.lookAt(y,0,x);
  scene.fog.density = 0.5 ;
  superV=false;
}
function superVue(x,y)
{
  cameraJoueur.position.y=20;
  cameraJoueur.lookAt(y,0,x);
  lightJoueur= new THREE.PointLight( 0xffffff, 1, 100);
  scene.fog.density = 0.00025 ;
  superV=true;
}
function init() {
    // Creation de la scene
    scene = new THREE.Scene();
    scene.background = new THREE.Color( 0xcce0ff );
    scene.fog = new THREE.FogExp2( 0xcce0ff, 0.5);
    var lumiere = new THREE.AmbientLight(0x666666);
    scene.add(lumiere);
    // parametre du rendu
    renderer = new THREE.WebGLRenderer();
    renderer.setPixelRatio(window.devicePixelRatio);
    renderer.setSize(window.innerWidth, window.innerHeight);

    // On connecte l'HTML et le rendu
    var corps = document.getElementById('corps');
    corps.appendChild(renderer.domElement);

    creationMur();
    plateau();
    var t = setInterval( changeTeam, 5000);


    //permet de savoir le moment où le bouton est appuyé ou relaché
    document.addEventListener('keydown', onKeyDown);
    document.addEventListener('keyup', onKeyUp);
    //au cas ou le fenetre change de taille
    window.addEventListener('resize', onWindowResize, false);
}

init();
animate();