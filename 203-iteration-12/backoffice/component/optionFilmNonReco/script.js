

import { loadTemplate } from '../../js/utilis.js';

let template = await loadTemplate('./component/optionFilmNonReco/template.html');


let optionFilmNonReco = {}; 


optionFilmNonReco.format =  function(obj) {
    let html = template;
    html = html.replace('{{id_movies}}', obj.id_movies);
    html = html.replace('{{titre}}', obj.titre);
    return html;
}

optionFilmNonReco.render = async function(selector, data){
    let html = '';
    for(let obj of data){
        html += optionFilmNonReco.format(obj);
    }
    let where = document.querySelector(selector);
    where.innerHTML = html;
}


export {optionFilmNonReco}
