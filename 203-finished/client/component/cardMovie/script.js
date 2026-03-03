

import { loadTemplate } from '../../js/utilis.js';

let template = await loadTemplate('./component/cardMovie/template.html');


let Movie = {}; 



Movie.format =  function(obj) {
    let html = template;
    html = html.replace('{{titre}}', obj.titre);
    html = html.replace('{{realisateur}}', obj.realisateur);
    html = html.replace('{{release_year}}', obj.release_year);
    html = html.replaceAll('{{url_film_img}}', obj.url_film_img);
    html = html.replace('{{moyenneMovie}}', Math.round(obj.moyenne_notation * 10) / 10);
    html = html.replaceAll('{{id_movies}}', obj.id_movies);
    return html;
}

Movie.render = async function(selector, data){
    let html = '';
    for(let obj of data){
        html += Movie.format(obj);
    }
    let where = document.querySelector(selector);
    where.innerHTML =  html;
}


export {Movie}
