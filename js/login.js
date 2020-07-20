var elUsername = document.getElementById('username');
var elPassword = document.getElementById('password');
var elMsg = document.getElementById('feedback');
var elForm = document.getElementById('login');
var elSubmit = document.getElementById('test');

// Event Listener - Checks if username or password is a certain length
function checkUsername(minLength) {
    if (elUsername.value.length < minLength) {
        elMsg.innerHTML = '<p> Username must be ' + minLength + ' characters or more</p>';
        event.preventDefault(); //don't submit the form (submit == default)
    }
    else {
        elMsg.innerHTML = ''; // Clear error message
    }
}

function checkPassword(minLength) {
    if (elPassword.value.length < minLength) {
        elMsg.innerHTML = '<p> Password must be ' + minLength + ' characters or more</p>';
        event.preventDefault(); //don't submit the form (submit == default)
    }
    else {
        elMsg.innerHTML = ''; // Clear error message
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



elForm.addEventListener('submit', function(event) {
    checkPassword(7);
    checkUsername(7);
    checkUsers(event);
}, false);

var usernameExists = false;
var passwordCorrect = false;

function checkUsers(event) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'json/userlogins.json', false);
    xhr.onload = function() {
        if(this.status == 200){
            usernameExists = false;
            passwordCorrect = false;

            var users = JSON.parse(this.responseText);

            for(var i in users) {
                if(users[i].username == elUsername.value) {
                    usernameExists = true;
                    if(users[i].password == elPassword.value) {
                        passwordCorrect = true;
                    }
                }
            }

            if(usernameExists == false) {
                elMsg.innerHTML = '<p>The username '+elUsername.value+' does not exist.</p>';
                event.preventDefault();
            } else {
                if(passwordCorrect == false) {
                    elMsg.innerHTML = '<p>The password you entered is incorrect.</p>';
                    event.preventDefault();
                } else {
                    elMsg.innerHTML = '';
                }
            }
        }
    }
    xhr.send();
}

elSubmit.addEventListener('click', function(event) {
    checkUsers(event);
}, false);