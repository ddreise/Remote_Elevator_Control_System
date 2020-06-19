var eListener, elForm;
var firstNameFeedback, lastNameFeedback, emailFeedback, studentFacultyFeedback, burritosFeedback, commentsFeedback;
var firstNameInput, lastNameInput, emailInput, studentInput, facultyInput, burritosInput, commentsInput;

elForm = document.getElementById('access');

firstNameFeedback = document.getElementById('firstNameFeedback');
lastNameFeedback = document.getElementById('lastNameFeedback');
emailFeedback = document.getElementById('emailFeedback');
studentFacultyFeedback = document.getElementById('studentFacultyFeedback');
burritosFeedback = document.getElementById('burritosFeedback');
commentsFeedback = document.getElementById('commentsFeedback');

firstNameInput = document.getElementById('firstName');
lastNameInput = document.getElementById('lastName');
emailInput = document.getElementById('email');
studentInput = document.getElementById('student');
facultyInput = document.getElementById('faculty');
burritosInput = document.getElementById('burritos');
commentsInput = document.getElementById('comments');

function checkFirstName(event)
{
    if(firstNameInput.value.length < 1)
    {
        firstNameFeedback.innerHTML = 'YOU NEED TO ENTER YOUR FIRST NAME!!!';
        event.preventDefault(); //don't submit the form (submit == default)
    }
    else
    {
        firstNameFeedback.innerHTML = '';
    }
}

function checkLastName(event)
{
    if(lastNameInput.value.length < 1)
    {
        lastNameFeedback.innerHTML = 'YOU NEED TO ENTER YOUR LAST NAME!!!';
        event.preventDefault();
    }
    else
    {
        lastNameFeedback.innerHTML = '';
    }
}

function checkEmail(event)
{
    if(emailInput.value.length < 1)
    {
        emailFeedback.innerHTML = 'YOU NEED TO ENTER YOUR EMAIL!!!';
        event.preventDefault();
    }
    else
    {
        emailFeedback.innerHTML = '';
    }
}

function checkStudentFaculty(event)
{
    if(!studentInput.checked && !facultyInput.checked)
    {
        studentFacultyFeedback.innerHTML = 'YOU NEED TO TELL US IF YOU ARE STUDENT OR FACULTY!!!';
        event.preventDefault();
    }
    else
    {
        studentFacultyFeedback.innerHTML = '';
    }
}

function checkBurritos(event)
{
    if(burritosInput.selectedIndex <= 0)
    {
        burritosFeedback.innerHTML = 'YOU NEED TO TELL US IF YOU LIKE BURRITOS!!!';
        event.preventDefault();
    }
    else
    {
        burritosFeedback.innerHTML = '';
    }
}

function checkComments(event)
{
    if(commentsInput.value.length < 1)
    {
        commentsFeedback.innerHTML = 'YOU NEED TO TELL US HOW YOU FEEL ABOUT BURRITOS!!!';
        event.preventDefault();
    }
    else
    {
        commentsFeedback.innerHTML = '';
    }
}

function charCount(e)
{
    var textEntered, charDisplay, counter, lastKey;
    textEntered = document.getElementById('comments').value;                    //text from user
    charDisplay = document.getElementById('charactersLeft');                    //element displaying remaining characters
    lastKey = document.getElementById('lastKey');                               //element displaying last key user input

    counter = (180 - (textEntered.length) - 1);                                 //remaining characters
    
    if(counter < 0)
    {
        charDisplay.innerHTML = 'STOP!! YOU EXCEED THE MAX NUM OF CHARS ALLOWED!';
    }
    else
    {
        charDisplay.innerHTML = 'Characters remaining: ' + counter;                 //displays remaining characters
    }

    lastKey.innerHTML = 'Last key input: ' + String.fromCharCode(e.keyCode);    //output last key
}

eListener = document.getElementById('comments');                                //get the comments element <textarea>
eListener.addEventListener('keypress', charCount, false);                       //listen for keypress events inside <textarea> and call the charCount function
elForm.addEventListener('submit', function(event) {
    checkFirstName(event);
    checkLastName(event);
    checkEmail(event);
    checkStudentFaculty(event);
    checkBurritos(event);
    checkComments(event);
}, false);