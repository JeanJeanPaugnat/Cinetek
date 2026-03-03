import { loadTemplate } from '../../js/utilis.js';

let template = await loadTemplate('./component/cardTrailerMovie/template.html');

let cardTrailerMovie = {}; 

cardTrailerMovie.commentaire = async function(idmovie){
    let response = await fetch("../server/script.php?action=getcomment&idmovies=" + idmovie);
    let datacomment = await response.json();
    let commentaire = await Entitycommentaire.render(datacomment);
    return commentaire;
}

cardTrailerMovie.format = async function(obj) {
    let html = template;
    html = html.replace('{{titre}}', obj.titre);
    html = html.replace('{{url_film_trailer}}', obj.url_film_trailer);
    html = html.replaceAll('{{id_movies}}', obj.id_movies);
    let commentaire = await cardTrailerMovie.commentaire(obj.id_movies);

    // Ajouter les commentaires au HTML généré
    html = html.replace('{{comments}}', commentaire);

    return html;
}

cardTrailerMovie.render = async function(selector, data){
    let html = '<a class="croixMenu" href="https://paugnat-sae203.mmi-limoges.fr/client/"><p>x</p><a>';
    for(let obj of data){
        html += await cardTrailerMovie.format(obj);
    }
    let where = document.querySelector(selector);
    where.innerHTML = html;
}

export { cardTrailerMovie }
