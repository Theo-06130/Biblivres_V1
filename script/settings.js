const Prenom = document.getElementById("Prenom");
const Nom = document.getElementById("name");
const email = document.getElementById("email");
const tel = document.getElementById("tel");
const password = document.getElementById("password");
const confirm_password = document.getElementById("confirm_password");



function disable_input() {
    Prenom.disabled = true;
    Nom.disabled = true;
    email.disabled = true;
    tel.disabled = true;
    password.disabled = true;
    confirm_password.disabled = true;
}

function enable_input() {
    Prenom.disabled = false;
    Nom.disabled = false;
    email.disabled = false;
    tel.disabled = false;
    password.disabled = false;
    confirm_password.disabled = false;
    console.log('dispo');
}



