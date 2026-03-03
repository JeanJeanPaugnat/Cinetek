

import { loadTemplate } from '../../js/utilis.js';

let template = await loadTemplate('./component/commentaire/template.html');


let Entitycommentaire = {}; 


Entitycommentaire.format =  function(obj) {
    let html = template;
    html = html.replace('{{nom}}', obj.nom);
    html = html.replace('{{date_de_creation}}', obj.date_de_creation);
    html = html.replace('{{commentaire}}', obj.commentaire);
    html = html.replace('{{note}}', Math.round(obj.moyenne_notation * 10) / 10);

    return html;
}

Entitycommentaire.render = async function(data){
    let html = '';
    if (data.length > 0) {
        for(let obj of data){
            html += Entitycommentaire.format(obj);
        }   
    }
    return html
}


export {Entitycommentaire}


