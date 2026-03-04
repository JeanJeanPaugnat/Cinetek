
// addmovie&title=Interstellar&direction=
let requestAddmovie = async function(){
    let titre = document.querySelector('input[name="titre"]');
    let realisateur = document.querySelector('input[name="realisateur"]');
    let sortieAnnee = document.querySelector('input[name="sortieAnnee"]');
    let urlImg = document.querySelector('input[name="urlImg"]');
    let urlTrailer = document.querySelector('input[name="urlTrailer"]');
    let categorie = document.querySelector('#categorie');
    let recommandation = document.getElementById('recommandation')

    let response = await fetch("https://mmi.unilim.fr/~paugnat7/server/script.php?action=addmovie&title=" + titre.value +"&realisateur=" + realisateur.value + "&sortieAnnee=" + sortieAnnee.value + "&urlImg=" + urlImg.value + "&urlTrailer=" + urlTrailer.value + "&categorie=" + categorie.value + "&recommandation" + recommandation.value );
    let data = await response.json();
}

let requestProfiles = async function(){
    // attente de la réponse à la requête demandant les données d'une collection de Lego
    let response = await fetch("https://mmi.unilim.fr/~paugnat7/server/script.php?action=getprofiles" );
    // attente de l'extration des données en format json de la réponse à la requête
    let dataprof = await response.json();
    optionProfile.render('.profil', dataprof);
}

let requestCategories = async function(){
    // attente de la réponse à la requête demandant les données d'une collection de Lego
    let response = await fetch("https://mmi.unilim.fr/~paugnat7/server/script.php?action=getcategories" );
    // attente de l'extration des données en format json de la réponse à la requête
    let datacat = await response.json();
    optionCategorie.render('.categorie', datacat);
}

let requestFilmReco = async function(){
    let response = await fetch("https://mmi.unilim.fr/~paugnat7/server/script.php?action=getfilmreco" );
    let datareco = await response.json();
    optionFilmReco.render('.filmOuiReco', datareco);
}

let requestFilmNonReco = async function(){
    let response = await fetch("https://mmi.unilim.fr/~paugnat7/server/script.php?action=getfilmnonreco" );
    let datanonreco = await response.json();
    optionFilmNonReco.render('.filmNonReco', datanonreco);
}


let deletefilmreco = async function(){
    let filmOuiReco = document.getElementById('filmOuiReco')
    let response = await fetch("https://mmi.unilim.fr/~paugnat7/server/script.php?action=deletefilmreco&idfilm=" + filmOuiReco.value );
}

let addfilmreco = async function(){
    let filmNonReco = document.getElementById('filmNonReco')
    let response = await fetch("https://mmi.unilim.fr/~paugnat7/server/script.php?action=addfilmreco&idfilm=" + filmNonReco.value );
}

let requestFilm = async function(){
    let response = await fetch("https://mmi.unilim.fr/~paugnat7/server/script.php?action=requestfilm" );
    let datanonreco = await response.json();
    optionFilm.render('.Film', datanonreco);
}

let requestCommentaire = async function(){
    let response = await fetch("https://mmi.unilim.fr/~paugnat7/server/script.php?action=getfilmnoncomment" );
    let datanonreco = await response.json();
    optionComment.render('.Comment', datanonreco);
}

let deletefilmcomment = async function(){
    let filmComment = document.getElementById('Comment')
    let response = await fetch("https://mmi.unilim.fr/~paugnat7/server/script.php?action=deletefilmcomment&idfilm=" + filmComment.value );
}

let requestValidCommentaire = async function(){
    let response = await fetch("https://mmi.unilim.fr/~paugnat7/server/script.php?action=getfilmnonvalidcomment" );
    let datanonreco = await response.json();
    optionValidComment.render('.CommentValid', datanonreco);
}

let validationfilmcomment = async function(){
    let filmValidComment = document.getElementById('CommentValid')
    let response = await fetch("https://mmi.unilim.fr/~paugnat7/server/script.php?action=validationfilmcomment&idfilm=" + filmValidComment.value );
}