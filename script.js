document.querySelector("#comment-form-container").style.display = "none";

document.querySelector("#comment-button").addEventListener("click", function() {
    document.querySelector("#comment-form-container").style.display = "block";
    document.querySelector("#comment-button").style.display = "none"
});

function loadArticle(){
// Vérifie si la hauteur du contenu est plus petite que la hauteur de la fenêtre
if (document.body.clientHeight > window.innerHeight) {
    // Les commentaires sont en dessous du contenu
    document.querySelector('#commDiv').style.marginTop = '20px';
} else {
    // Les commentaires sont tout en bas de la page web
    document.querySelector('#commDiv').style.position = 'fixed';
    document.querySelector('#commDiv').style.bottom = '20px';
}
}

function updateCharCounter() {
    const textarea = document.getElementById('contenu');
    const counter = document.getElementById('char-counter');
    const remainingChars = 255 - textarea.value.length;
    counter.innerText = `${remainingChars}/255`;
}