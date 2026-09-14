$(document).ready(function() {
    if (localStorage.getItem("coockieconsent") === null){
        document.querySelector('.cookieconsent').style.display = 'block';
    }  
});
    
function setCookieConsent() {
    localStorage.setItem('coockieconsent', 'yes');
    document.querySelector('.cookieconsent').style.display = 'none';
}