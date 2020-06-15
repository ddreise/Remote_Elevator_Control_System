// For updating copywrite info every year

var today = new Date();
var year = today.getFullYear();
var dans_birthdate = new Date('May 10, 1990');

var dans_age = today.getTime() - dans_birthdate.getTime();    // Age in milliseconds
dans_age = Math.floor(dans_age / 31556900000);                // Format for readability 

var msg = document.getElementById('dans_age');
msg.innerHTML = '<p>He is ' + dans_age + ' years old.</p>';       // Set html id to varible value

var cr = document.getElementById('copyright');
cr.innerHTML = '<p>Copyright ' + year + ' &copy; Daniel Dreise, Justin Turcotte, Troy Annette, Brandon Harkness </p>';  // Set html contained within html id "copyright"

