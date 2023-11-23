const Prenom = document.getElementById("Prenom");
const Nom = document.getElementById("name");
const email = document.getElementById("email");
const tel = document.getElementById("tel");
const password = document.getElementById("password");
const confirm_password = document.getElementById("confirm_password");
const edit = document.getElementById("edit");
const img_easter_egg = document.getElementById("img_easter_egg")

let egg = 0
function easter_egg() {
    if (egg == 5) {
        img_easter_egg.style.display = "block";
    } else {
        egg++
        console.log(egg);
    }
}



// function disable_input() {
//     Prenom.disabled = true;
//     Nom.disabled = true;
//     email.disabled = true;
//     tel.disabled = true;
//     password.disabled = true;
//     confirm_password.disabled = true;
// }

// function enable_input() {
//     Prenom.disabled = false;
//     Nom.disabled = false;
//     email.disabled = false;
//     tel.disabled = false;
//     password.disabled = false;
//     confirm_password.disabled = false;
//     console.log('dispo');
// }



