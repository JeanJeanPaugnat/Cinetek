

import { loadTemplate } from '../../js/utilis.js';

let template = await loadTemplate('./component/optionValidComment/template.html');


let optionValidComment = {}; 


optionValidComment.format =  function(obj) {
    let html = template;
    html = html.replace('{{id_commentaires}}', obj.id_commentaires);
    html = html.replace('{{titre}}', obj.titre);
    html = html.replace('{{commentaire}}', obj.commentaire);
    return html;
}

optionValidComment.render = async function(selector, data){
    let html = '';
    for(let obj of data){
        html += optionValidComment.format(obj);
    }
    let where = document.querySelector(selector);
    where.innerHTML = html;
}


export {optionValidComment}
