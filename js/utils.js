/**
 * UTILS
 * Ensemble de fonctions utilitaires en particulier quelques encapsulations des fonctions de bases de jquery
 */

function isNumber(s) {
    return !isNaN(s - 0);
}

function printHTML(dom, htm) {
    $(dom).html(htm);
}

function printSupHTML(dom, htm) {
    $(dom).append(htm);
}

function printAfterHTML(dom, htm) {
    $(dom).after(htm);
}
function printBeforeHTML(dom, htm) {
    $(dom).before(htm);
}

//redirige vers la page d'url 'location '
function redirect(location) { 
    window.location.href = location;
}
