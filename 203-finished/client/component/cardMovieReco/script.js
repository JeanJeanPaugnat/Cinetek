

import { loadTemplate } from '../../js/utilis.js';

let template = await loadTemplate('./component/cardMovieReco/template.html');


let MovieReco = {}; 



MovieReco.format =  function(obj) {
    let html = template;
    html = html.replace('{{titre}}', obj.titre);
    html = html.replace('{{realisateur}}', obj.realisateur);
    html = html.replace('{{release_year}}', obj.release_year);
    html = html.replaceAll('{{url_film_img}}', obj.url_film_img);
    html = html.replace('{{moyenneMovie}}', Math.round(obj.moyenne_notation * 10) / 10);
    html = html.replaceAll('{{id_movies}}', obj.id_movies);
    return html;
}

MovieReco.render = async function(selector, data) {
    let html = '';
    let isFirstSlide = true; // Ajoutez cette variable pour vérifier si c'est le premier slide

    for (let obj of data) {
        // Formattez chaque objet de données en HTML
        let formattedHtml = MovieReco.format(obj);

        // Si c'est le premier slide, ajoutez-lui l'attribut data-active
        if (isFirstSlide) {
            formattedHtml = formattedHtml.replace('<div class="cardmoviereco slide"', '<div class="cardmoviereco slide" data-active');
            isFirstSlide = false; // Marquez le premier slide comme traité
        }

        html += formattedHtml;
    }

    // Sélectionnez l'endroit où insérer le HTML généré
    let where = document.querySelector(selector);
    // Insérez le HTML dans cet endroit
    where.innerHTML = html;
}





export {MovieReco}
