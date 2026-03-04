<?php





/*renvoie les données de tout les films*/ 
function getMovies(){
    $cnx = new PDO("mysql:host=localhost;dbname=paugnat7", "paugnat7", "paugnat7");
    $answer = $cnx->query("SELECT MOVIES.*, AVG(NOTATION.note) AS moyenne_notation FROM MOVIES LEFT JOIN NOTATION ON MOVIES.id_movies = NOTATION.id_movies GROUP BY MOVIES.id_movies "); 
    $res = $answer->fetchAll(PDO::FETCH_OBJ);
    return $res;
}

/*renvoie les données de tout les profils*/ 
function getProfiles(){
    $cnx = new PDO("mysql:host=localhost;dbname=paugnat7", "paugnat7", "paugnat7");
    $answer = $cnx->query("SELECT `nom`,`id_profils` FROM `PROFILS`"); 
    $res = $answer->fetchAll(PDO::FETCH_OBJ);
    return $res;
}

/*renvoie les données de categories*/ 
function getCategories(){
    $cnx = new PDO("mysql:host=localhost;dbname=paugnat7", "paugnat7", "paugnat7");
    $answer = $cnx->query("SELECT `libelle`,`id_categories` FROM `CATEGORIES`"); 
    $res = $answer->fetchAll(PDO::FETCH_OBJ);
    return $res;
}

/*renvoie l'URL du film demandé*/ 
function getMovie($id){
    $cnx = new PDO("mysql:host=localhost;dbname=paugnat7", "paugnat7", "paugnat7");
    $answer = $cnx->query("SELECT `titre`, `url_film_trailer`, `id_movies` FROM `MOVIES` WHERE `id_movies`='$id' "); 
    $res = $answer->fetchAll(PDO::FETCH_OBJ);
    return $res;

}

/*renvoie les films recommandés*/ 
function getFilmReco(){
    $cnx = new PDO("mysql:host=localhost;dbname=paugnat7", "paugnat7", "paugnat7");
    $answer = $cnx->query("SELECT * FROM `MOVIES` WHERE MOVIES.recommandation = 1"); 
    $res = $answer->fetchAll(PDO::FETCH_OBJ);
    return $res;
}

/*renvoie les films non recommandés*/ 
function getFilmNonReco(){
    $cnx = new PDO("mysql:host=localhost;dbname=paugnat7", "paugnat7", "paugnat7");
    $answer = $cnx->query("SELECT * FROM `MOVIES` WHERE recommandation = 0"); 
    $res = $answer->fetchAll(PDO::FETCH_OBJ);
    return $res;
}

/*renvoie les données du film en fonction d'une categorie*/ 
function getMoviesByCategory($idCategorie){
    $cnx = new PDO("mysql:host=localhost;dbname=paugnat7", "paugnat7", "paugnat7");
    $answer = $cnx->query("SELECT MOVIES.*, AVG(NOTATION.note) AS moyenne_notation FROM `MOVIES`  INNER JOIN CATEGORIES ON MOVIES.id_categories = CATEGORIES.id_categories  LEFT JOIN NOTATION ON MOVIES.id_movies = NOTATION.id_movies WHERE CATEGORIES.id_categories = '$idCategorie' GROUP BY MOVIES.id_movies"); 
    $res = $answer->fetchAll(PDO::FETCH_OBJ);
    return $res;
}

/*ajoute une nouvelle donnée MOVIE à la BDD*/
function updateMovie($title, $real, $year, $img, $trailer, $categorie, $reco){
    $cnx = new PDO("mysql:host=localhost;dbname=paugnat7", "paugnat7", "paugnat7");
    $answer = $cnx->query("INSERT INTO `MOVIES`(titre, realisateur, release_year, url_film_img, url_film_trailer, id_categories, recommandation) VALUES ('$title','$real','$year','$img','$trailer','$categorie','$reco')");
    $res = $answer->rowCount();
    return $res;
}

/*ajoute une nouvelle donnée PROFIL à la BDD*/
function updateProfil($nom){
    $cnx = new PDO("mysql:host=localhost;dbname=paugnat7", "paugnat7", "paugnat7");
    $answer = $cnx->query("INSERT INTO `PROFILS`(nom) VALUES ('$nom')");
    $res = $answer->rowCount();
    return $res;
}

/*ajoute une nouvelle donnée PLAYLIST à la BDD*/
function updatePlayslist($idmov, $idpro){
    $cnx = new PDO("mysql:host=localhost;dbname=paugnat7", "paugnat7", "paugnat7");
    $answer = $cnx->query("INSERT INTO `PLAYLIST`(id_movies, id_profils) VALUES ('$idmov', '$idpro')");
    $res = $answer->rowCount();
    return $res;
}

/*renvoie les données de playlist*/
function getPlaylist($idprofil){
    $cnx = new PDO("mysql:host=localhost;dbname=paugnat7", "paugnat7", "paugnat7");
    $answer = $cnx->query("SELECT MOVIES.*, AVG(NOTATION.note) AS moyenne_notation FROM MOVIES INNER JOIN PLAYLIST ON MOVIES.id_movies = PLAYLIST.id_movies LEFT JOIN NOTATION ON MOVIES.id_movies = NOTATION.id_movies WHERE PLAYLIST.id_profils = '$idprofil' GROUP BY MOVIES.id_movies"); 
    $res = $answer->fetchAll(PDO::FETCH_OBJ);
    return $res;
}

/*supprime un movie à la playlist de l'utilisateur selectionné*/
function removeFromPlaylist($idmov, $idpro){
    $cnx = new PDO("mysql:host=localhost;dbname=paugnat7", "paugnat7", "paugnat7");
    $answer = $cnx->query("DELETE FROM `PLAYLIST` WHERE id_movies = '$idmov' AND id_profils = '$idpro'"); 
    $res = $answer->fetchAll(PDO::FETCH_OBJ);
    return $res;
}

/*supprime un profil de la table et toutes les données associées*/
function deleteProfile($idpro){
    $cnx = new PDO("mysql:host=localhost;dbname=paugnat7", "paugnat7", "paugnat7");
    $answer = $cnx->query("DELETE FROM `PLAYLIST` WHERE id_profils = '$idpro'");
    $answer = $cnx->query("DELETE FROM `PROFILS` WHERE id_profils = '$idpro'");
    $res = $answer->rowCount();
    return $res;
}


function addFilmReco($idmovie){
    $cnx = new PDO("mysql:host=localhost;dbname=paugnat7", "paugnat7", "paugnat7");
    $answer = $cnx->query("UPDATE `MOVIES` SET `recommandation`= 1 WHERE id_movies = '$idmovie'"); 
    $res = $answer->fetchAll(PDO::FETCH_OBJ);
    return $res;
}

function deleteFilmReco($idmovie){
    $cnx = new PDO("mysql:host=localhost;dbname=paugnat7", "paugnat7", "paugnat7");
    $answer = $cnx->query("UPDATE `MOVIES` SET `recommandation`= 0 WHERE id_movies = '$idmovie'"); 
    $res = $answer->fetchAll(PDO::FETCH_OBJ);
    return $res;
}

function getMoviesReco(){
    $cnx = new PDO("mysql:host=localhost;dbname=paugnat7", "paugnat7", "paugnat7");
    $answer = $cnx->query("SELECT MOVIES.*, AVG(NOTATION.note) AS moyenne_notation FROM MOVIES LEFT JOIN NOTATION ON MOVIES.id_movies = NOTATION.id_movies  WHERE recommandation = 1 GROUP BY MOVIES.id_movies");
    $res = $answer->fetchAll(PDO::FETCH_OBJ);
    return $res;
}

function getrecherceFilm($keyword){
    $cnx = new PDO("mysql:host=localhost;dbname=paugnat7", "paugnat7", "paugnat7");
    $answer = $cnx->prepare("SELECT MOVIES.*, AVG(NOTATION.note) AS moyenne_notation FROM MOVIES LEFT JOIN NOTATION ON MOVIES.id_movies = NOTATION.id_movies WHERE titre LIKE :keyword GROUP BY MOVIES.id_movies");
    $answer->execute(array(":keyword" => '%'.$keyword.'%'));
    $res = $answer->fetchAll(PDO::FETCH_OBJ);
    return $res;
}

function addNotation($idprof, $valNote, $idmov){
    $cnx = new PDO("mysql:host=localhost;dbname=paugnat7", "paugnat7", "paugnat7");
    $answer = $cnx->query("REPLACE INTO `NOTATION` (id_movies, id_profils, note)VALUES ('$idmov', '$idprof', '$valNote')");
    $res = $answer->fetchAll(PDO::FETCH_OBJ);
    return $res;
}

function getRequestFilm(){
    $cnx = new PDO("mysql:host=localhost;dbname=paugnat7", "paugnat7", "paugnat7");
    $answer = $cnx->query("SELECT * FROM MOVIES"); 
    $res = $answer->fetchAll(PDO::FETCH_OBJ);
    return $res;
}

function deleteFilmNote($id){
    $cnx = new PDO("mysql:host=localhost;dbname=paugnat7", "paugnat7", "paugnat7");
    $answer = $cnx->query("DELETE FROM NOTATION WHERE id_movies = '$id'"); 
    $res = $answer->fetchAll(PDO::FETCH_OBJ);
    return $res;
}

function addCommentaire($idprofile, $valeurComment, $idmovie, $formatDate){
    $cnx = new PDO("mysql:host=localhost;dbname=paugnat7", "paugnat7", "paugnat7");
    $answer = $cnx->query("INSERT INTO `COMMENTAIRES`(`id_movies`, `id_profils`, `commentaire`, `date_de_creation`,`etat` ) VALUES ('$idmovie','$idprofile','$valeurComment','$formatDate','en cours de validation')"); 
    $res = $answer->fetchAll(PDO::FETCH_OBJ);
    return $res;
}

function getCommentaire($idmovie){
    $cnx = new PDO("mysql:host=localhost;dbname=paugnat7", "paugnat7", "paugnat7");
    $answer = $cnx->query("SELECT COMMENTAIRES.*, PROFILS.nom, NOTATION.note AS moyenne_notation FROM COMMENTAIRES JOIN PROFILS ON COMMENTAIRES.id_profils = PROFILS.id_profils LEFT JOIN NOTATION ON COMMENTAIRES.id_movies = NOTATION.id_movies AND COMMENTAIRES.id_profils = NOTATION.id_profils WHERE COMMENTAIRES.id_movies = '$idmovie' AND COMMENTAIRES.etat = 'validé' GROUP BY COMMENTAIRES.id_commentaires"); 
    $res = $answer->fetchAll(PDO::FETCH_OBJ);
    return $res;
}

function getFilmnonComment(){
    $cnx = new PDO("mysql:host=localhost;dbname=paugnat7", "paugnat7", "paugnat7");
    $answer = $cnx->query("SELECT COMMENTAIRES.*, MOVIES.titre FROM COMMENTAIRES JOIN MOVIES ON COMMENTAIRES.id_movies = MOVIES.id_movies"); 
    $res = $answer->fetchAll(PDO::FETCH_OBJ);
    return $res;
}

function getFilmnonValidComment(){
    $cnx = new PDO("mysql:host=localhost;dbname=paugnat7", "paugnat7", "paugnat7");
    $answer = $cnx->query("SELECT COMMENTAIRES.*, MOVIES.titre FROM COMMENTAIRES JOIN MOVIES ON COMMENTAIRES.id_movies = MOVIES.id_movies WHERE COMMENTAIRES.etat = 'en cours de validation'"); 
    $res = $answer->fetchAll(PDO::FETCH_OBJ);
    return $res;
}

function updateFilmnonValidComment($idmovie){
    $cnx = new PDO("mysql:host=localhost;dbname=paugnat7", "paugnat7", "paugnat7");
    $answer = $cnx->query("UPDATE COMMENTAIRES SET etat= 'validé' WHERE `id_commentaires`= '$idmovie'"); 
    $res = $answer->fetchAll(PDO::FETCH_OBJ);
    return $res;
}

function deleteFilmComment($idfilm){
    $cnx = new PDO("mysql:host=localhost;dbname=paugnat7", "paugnat7", "paugnat7");
    $answer = $cnx->query("DELETE FROM `COMMENTAIRES` WHERE id_commentaires = '$idfilm'"); 
    $res = $answer->fetchAll(PDO::FETCH_OBJ);
    return $res;
}

?>
