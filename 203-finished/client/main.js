

let requestMovie = async function(){
    // attente de la réponse à la requête demandant les données d'une collection de Lego
    let response = await fetch("https://mmi.unilim.fr/~paugnat7/server/script.php?action=getmovies" );
    // attente de l'extration des données en format json de la réponse à la requête
    let data = await response.json();
    Movie.render('.mainContainer', data);
}

let clearMain = function(){

    let element = document.querySelector('.mainContainer');
    element.innerHTML = ''
}

let requestTrailer = async function(id){
    let response = await fetch("https://mmi.unilim.fr/~paugnat7/server/script.php?action=getMovie&id_movies=" + id );
    let datatrailer = await response.json();
    let test = cardTrailerMovie.render('.SectionMain', datatrailer)
}


let requestMovieByCategorie = async function(){
    let categorie = document.querySelector('#categorie')

    let response = await fetch("https://mmi.unilim.fr/~paugnat7/server/script.php?action=getmovies&category=" + categorie.value );
    let datacatego = await response.json();
    Movie.render('.mainContainer', datacatego);

}

let requestProfiles = async function(){
    let response = await fetch("https://mmi.unilim.fr/~paugnat7/server/script.php?action=getprofiles" );
    let dataprof = await response.json();
    optionProfile.render('.profil', dataprof);
}

let requestCategories = async function(){
    let response = await fetch("https://mmi.unilim.fr/~paugnat7/server/script.php?action=getcategories" );
    let datacat = await response.json();
    optionCategorie.render('.categorie', datacat);
}

let requestaddplaylist = async function(id){
    let profil = document.getElementById('profil')
    let response = await fetch("https://mmi.unilim.fr/~paugnat7/server/script.php?action=addtoplaylist&idmovie=" + id + "&idprofile=" + profil.value );
}

let requestMovieByProfil = async function(){
    let profil = document.getElementById('profil')
    let response = await fetch("https://mmi.unilim.fr/~paugnat7/server/script.php?action=getplaylist&idprofile=" + profil.value);
    let data = await response.json();
    MoviePlay.render('.playlistContainer', data);
}

let removefromplaylist = async function(id){
    let profil = document.getElementById('profil')
    let response = await fetch("https://mmi.unilim.fr/~paugnat7/server/script.php?action=removefromplaylist&idmovie=" + id + "&idprofile=" + profil.value );
}

let requestMovieReco = async function(){
    let response = await fetch("https://mmi.unilim.fr/~paugnat7/server/script.php?action=getmoviesreco" );
    let data = await response.json();
    MovieReco.render('.recoContainer', data);
}

let rechercheFilm = async function(){
    let motclefilm = document.querySelector("#rechercheInput").value
    let response = await fetch("https://mmi.unilim.fr/~paugnat7/server/script.php?action=recherchefilm&motcle=" + motclefilm );
    let data = await response.json();
    Movie.render('.mainContainer', data);
}

let requestNotation = async function(id){
    let notation = document.getElementById('notation').value
    let profil = document.getElementById('profil').value
    let response = await fetch("https://mmi.unilim.fr/~paugnat7/server/script.php?action=addnotation&idprofile=" + profil + "&valeurNote=" + notation + "&idmovie=" + id);
}

let requestSendComment = async function(id) {
    let comment = document.getElementById('comment').value;
    let profil = document.getElementById('profil').value;

    let currentDate = new Date();

    let day = currentDate.getDate();
    let month = currentDate.getMonth() + 1; 
    let year = currentDate.getFullYear();

    let formattedDate = year + '-' + (month < 10 ? '0' : '') + month + '-' + (day < 10 ? '0' : '') + day;
    let response = await fetch("https://mmi.unilim.fr/~paugnat7/server/script.php?action=addcommentaire&idprofile=" + profil + "&idmovie=" + id + "&valeurComment=" + comment + "&date=" + formattedDate);
}


