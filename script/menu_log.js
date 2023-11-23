const SignUp = document.getElementById("SignUp");
const LogIn = document.getElementById("LogIn");
const MeConnecter = document.getElementById("MeConnecter");
const chevron = document.getElementById("chevron");

let show = false;


function log() {
    if (show == false) {
        show_log()
        show = true
    } else {
        Hide_log()
        show = false
    }
}






function show_log() {
    SignUp.style.transform = "translateX(110px)"
    LogIn.style.transform = "translateX(110px)"
    chevron.style.rotate = "90deg"
}

function Hide_log() {
    SignUp.style.transform = "translateX(0)"
    LogIn.style.transform = "translateX(0)"
    chevron.style.rotate = "0deg"
}