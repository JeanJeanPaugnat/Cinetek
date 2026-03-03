<?php

require("model.php");


/*CONTROLE DE LA DEMANDE pour voir tout les films*/
if (isset($_REQUEST['action'])) {
  if ($_REQUEST['action'] == 'getmovies') {
      // Si l'action est "getmovies" et que la catégorie est spécifié
      if (isset($_REQUEST['category']) && !empty($_REQUEST['category'])) {
          $category = $_REQUEST['category'];
          $request = getMoviesByCategory($category);
          echo json_encode($request);
          exit();
      } else {
          // Sinon, renvoyer tous les films
          $movie = getMovies();
          echo json_encode($movie);
          exit();
      }
  }
}

/*CONTROLE de la demande des profils*/
if (isset($_REQUEST['action']) && $_REQUEST['action']=='getprofiles') {
  $profil = getProfiles();
  echo json_encode($profil);
  exit();
}

/*CONTROLE de la demande des categories*/
if (isset($_REQUEST['action']) && $_REQUEST['action']=='getcategories') {
  $categorie = getCategories();
  echo json_encode($categorie);
  exit();
}

/*CONTROLE de la demande des films recommandés*/
if (isset($_REQUEST['action']) && $_REQUEST['action']=='getfilmreco') {
  $categorie = getFilmReco();
  echo json_encode($categorie);
  exit();
}

/*CONTROLE de la demande des films non recommandés*/
if (isset($_REQUEST['action']) && $_REQUEST['action']=='getfilmnonreco') {
  $categorie = getFilmNonReco();
  echo json_encode($categorie);
  exit();
}


/*CONTROLE de la demande de l'idmovie demandé pour avoir le trailer */
if (isset($_REQUEST['action']) && $_REQUEST['action']=='getMovie') {
  $num = $_REQUEST['id_movies'];
  $request = getMovie($num);
  echo json_encode($request);
  exit();
}

/*CONTROLE de la demande des playlist par rapport à un utilisateur*/
if (isset($_REQUEST['action']) && $_REQUEST['action']=='getplaylist') {
  $idprofile = $_REQUEST['idprofile'];
  $request = getPlaylist($idprofile);
  echo json_encode($request);
  exit();
}

/*AJOUT d'un film */
if (isset($_REQUEST['action']) && $_REQUEST['action']=='addmovie'){
  $titre = $_REQUEST['titre'];
  $realisateur = $_REQUEST['realisateur'];
  $sortieAnnee = $_REQUEST['sortieAnnee'];
  $urlImg = $_REQUEST['urlImg'];
  $urlTrailer = $_REQUEST['urlTrailer'];
  $categorie = $_REQUEST['categorie'];
  $recommandation = $_REQUEST['recommandation'];
  $request = updateMovie($titre, $realisateur, $sortieAnnee, $urlImg, $urlTrailer, $categorie, $recommandation);
  if ($request>0){
    echo "Le film $titre de $sortieAnnee avec $categorie a été correctement ajouté à la base de donnée ($urlImg; $urlTrailer)";
  }
  else{
    echo "Un problème est survenu";
  }
  exit();
}

/*AJOUT d'un film en recommandation*/
if (isset($_REQUEST['action']) && $_REQUEST['action']=='addfilmreco'){
  $id_movies = $_REQUEST['filmNonReco'];
  $request = addFilmReco($id_movies);
  if ($request>0){
    echo "Le film $id_movies a été ajouté aux recommandations";
  }
  else{
    echo "Un problème est survenu";
  }
  exit();
}

/*RETIRE un film en recommandation*/
if (isset($_REQUEST['action']) && $_REQUEST['action']=='deletefilmreco'){
  $id_movies = $_REQUEST['filmOuiReco'];
  $request = deleteFilmReco($id_movies);
  if ($request>0){
    echo "Le film $id_movies a été retiré aux recommandations";
  }
  else{
    echo "Un problème est survenu";
  }
  exit();
}

/*AJOUT d'un profil utilisateur*/
if (isset($_REQUEST['action']) && $_REQUEST['action']=='addprofile'){
  $name = $_REQUEST['name'];
  $request = updateProfil($name);
  if ($request>0){
    echo "Le profil $name a été ajouté à la base de donnée";
  }
  else{
    echo "Un problème est survenu";
  }
  exit();
}

/*AJOUT d'un film pour un profil utilisateur selectionné*/
if (isset($_REQUEST['action']) && $_REQUEST['action']=='addtoplaylist'){
  $idmovie = $_REQUEST['idmovie'];
  $idprofile = $_REQUEST['idprofile'];
  $request = updatePlayslist($idmovie, $idprofile);
  if ($request>0){
    echo "Le profil $name a été ajouté à la base de donnée";
  }
  else{
    echo "Un problème est survenu";
  }
  exit();
}

/*ENLEVE un film d'une playslist de l'utilisateur selectionné */ 
if (isset($_REQUEST['action']) && $_REQUEST['action']=='removefromplaylist') {
  $idmovie = $_REQUEST['idmovie'];
  $idprofile = $_REQUEST['idprofile'];
  $request = removeFromPlaylist($idmovie, $idprofile);
  echo json_encode($request);
  exit();
}

/*ENLEVE un profil à la BDD*/ 
if (isset($_REQUEST['action']) && $_REQUEST['action']=='deleteprofile'){
  $idProfile = $_REQUEST['profil'];
  $request = deleteProfile($idProfile);
  if ($request>0){
    echo "Le profil $idProfile a été supprimé à la base de donnée";
  }
  else{
    echo "Un problème est survenu";
  }
  exit();
}

/*CONTROLE de la demande des films en recommandation*/
if (isset($_REQUEST['action']) && $_REQUEST['action']=='getmoviesreco') {
  $MoviesReco = getMoviesReco();
  echo json_encode($MoviesReco);
  exit();
}

if (isset($_REQUEST['action']) && $_REQUEST['action']=='getfilmnoncomment') {
  $MoviesComments = getFilmnonComment();
  echo json_encode($MoviesComments);
  exit();
}

if (isset($_REQUEST['action']) && $_REQUEST['action']=='getfilmnonvalidcomment') {
  $MoviesvalidComments = getFilmnonValidComment();
  echo json_encode($MoviesvalidComments);
  exit();
}

if (isset($_REQUEST['action']) && $_REQUEST['action']=='requestfilm') {
  $films = getRequestFilm();
  echo json_encode($films);
  exit();
}

if (isset($_REQUEST['action']) && $_REQUEST['action']=='recherchefilm') {
  $recherceFilm = $_REQUEST['motcle'];
  $Moviesrecherhce = getrecherceFilm($recherceFilm);
  echo json_encode($Moviesrecherhce);
  exit();
}


if (isset($_REQUEST['action']) && $_REQUEST['action']=='addnotation'){
  $idprofile = $_REQUEST['idprofile'];
  $valeurNote = $_REQUEST['valeurNote'];
  $idmovie = $_REQUEST['idmovie'];
  $request = addNotation($idprofile, $valeurNote, $idmovie);
  exit();
}

if (isset($_REQUEST['action']) && $_REQUEST['action']=='deletefilmnote'){
  $Film = $_REQUEST['Film'];
  $request = deleteFilmNote($Film);
  if ($request>0){
    echo "Le film $Film n'a plus aucune note";
  }
  else{
    echo "Un problème est survenu";
  }
  exit();
}

if (isset($_REQUEST['action']) && $_REQUEST['action']=='addcommentaire'){
  $idprofile = $_REQUEST['idprofile'];
  $valeurComment = $_REQUEST['valeurComment'];
  $idmovie = $_REQUEST['idmovie'];
  $formatDate = $_REQUEST['date'];
  $request = addCommentaire($idprofile, $valeurComment, $idmovie, $formatDate);
  exit();
}

if (isset($_REQUEST['action']) && $_REQUEST['action']=='getcomment'){
  $movie = $_REQUEST['idmovies'] ?? 0;
  $request = getCommentaire($movie);
  echo json_encode($request);
  exit();
  
}

if (isset($_REQUEST['action']) && $_REQUEST['action']=='validationfilmcomment'){
  $movie = $_REQUEST['CommentValid'];
  $request = updateFilmnonValidComment($movie);
  echo json_encode($request);
  if ($request>0){
    echo "Le comment $movie a été validé";
  }
  else{
    echo "Un problème est survenu";
  }
  exit();
  
}

if (isset($_REQUEST['action']) && $_REQUEST['action']=='deletefilmcomment'){
  $film = $_REQUEST['idfilm'] ?? 0;
  $request = deleteFilmComment($film);
  if ($request>0){
    echo "Le comment $film a été supprimé";
  }
  else{
    echo "Un problème est survenu";
  }
  exit();
  
}

http_response_code(404);

?>