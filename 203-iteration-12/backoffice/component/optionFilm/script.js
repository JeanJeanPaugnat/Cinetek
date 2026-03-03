

import { loadTemplate } from '../../js/utilis.js';

let template = await loadTemplate('./component/optionFilm/template.html');


let optionFilm = {}; 


optionFilm.format =  function(obj) {
    let html = template;
    html = html.replace('{{id_movies}}', obj.id_movies);
    html = html.replace('{{titre}}', obj.titre);
    return html;
}

optionFilm.render = async function(selector, data){
    let html = '';
    for(let obj of data){
        html += optionFilm.format(obj);
    }
    let where = document.querySelector(selector);
    where.innerHTML = html;
}


export {optionFilm}
