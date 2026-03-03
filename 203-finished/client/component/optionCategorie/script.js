

import { loadTemplate } from '../../js/utilis.js';

let template = await loadTemplate('./component/optionCategorie/template.html');


let optionCategorie = {}; 


optionCategorie.format =  function(obj) {
    let html = template;
    html = html.replace('{{libelle}}', obj.libelle);
    html = html.replace('{{id_categories}}', obj.id_categories);
    return html;
}

optionCategorie.render = async function(selector, data){
    let html = '<option value="0">Catégorie</option>';
    for(let obj of data){
        html += optionCategorie.format(obj);
    }
    let where = document.querySelector(selector);
    where.innerHTML = html;
}


export {optionCategorie}
