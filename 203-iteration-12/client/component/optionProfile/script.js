

import { loadTemplate } from '../../js/utilis.js';

let template = await loadTemplate('./component/optionProfile/template.html');


let optionProfile = {}; 


optionProfile.format =  function(obj) {
    let html = template;
    html = html.replace('{{name}}', obj.nom);
    html = html.replace('{{id_profil}}', obj.id_profils);
    return html;
}

optionProfile.render = async function(selector, data){
    let html = '';
    for(let obj of data){
        html += optionProfile.format(obj);
    }
    let where = document.querySelector(selector);
    where.innerHTML = html;
}


export {optionProfile}
