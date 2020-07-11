var elUsername = document.getElementById('username');
var elPassword = document.getElementById('pass');
var elMsg = document.getElementById('feedback');


// Event Listener - Checks if username or password is a certain length
function checkUsername(minLength) {
    if (elUsername.value.length < minLength) {
        elMsg.innerHTML = '<p> Username must be ' + minLength + ' characters or more</p>';
    }
    else {
        elMsg.innerHTML = '' // Clear error message
    }
}

function checkPassword(minLength) {
    if (elPassword.value.length < minLength) {
        elMsg.innerHTML = '<p> Password must be ' + minLength + ' characters or more</p>';
    }
    else {
        elMsg.innerHTML = '' // Clear error message
    }
}

elUsername.addEventListener('blur', function() {checkUsername(7)}, false);
elPassword.addEventListener('blur', function() {checkPassword(7)}, false);

//Event Listener - gives focus to input box when loaded
function setup() {
    var textInput;
    textInput = document.getElementById('username');
    textInput.focus();
}

window.addEventListener('load', setup, false);
