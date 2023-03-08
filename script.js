document.querySelector("#comment-form-container").style.display = "none";

document.querySelector("#comment-button").addEventListener("click", function() {
    document.querySelector("#comment-form-container").style.display = "block";
    document.querySelector("#comment-button").style.display = "none"
});