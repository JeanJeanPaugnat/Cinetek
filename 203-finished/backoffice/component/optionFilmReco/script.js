

import { loadTemplate } from '../../js/utilis.js';

let template = await loadTemplate('./component/optionFilmReco/template.html');


let optionFilmReco = {}; 


optionFilmReco.format =  function(obj) {
    let html = template;
    html = html.replace('{{id_movies}}', obj.id_movies);
    html = html.replace('{{titre}}', obj.titre);
    return html;
}

optionFilmReco.render = async function(selector, data){
    let html = '';
    for(let obj of data){
        html += optionFilmReco.format(obj);
    }
    let where = document.querySelector(selector);
    where.innerHTML = html;
}


export {optionFilmReco}
