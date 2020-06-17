// For updating copywrite info every year

var today = new Date();
var year = today.getFullYear();
var dans_birthdate = new Date('May 10, 1990');
var justins_birthdate = new Date('June 15, 1999');
var brandons_birthdate = new Date('April 3, 1998');
var troys_birthdate = new Date('March 2, 1997');

function getAge(birthdate) {
    var age = today.getTime() - birthdate.getTime();
    age = Math.floor(age / 31556900000);
    return age;
}

dans_age = getAge(dans_birthdate);
justins_age = getAge(justins_birthdate);
brandons_age = getAge(brandons_birthdate);
troys_age = getAge(troys_birthdate);


var dan = document.getElementById('dans_age');
dan.innerHTML = 'He is ' + dans_age + ' years old.';       // Set html id to varible value

var justin = document.getElementById('justins_age');
justin.innerHTML = 'He is ' + justins_age + ' years old.';       // Set html id to varible value

var brandon = document.getElementById('brandons_age');
brandon.innerHTML = 'He is ' + brandons_age + ' years old.';       // Set html id to varible value

var troy = document.getElementById('troys_age');
troy.innerHTML = 'He is ' + troys_age + ' years old.';       // Set html id to varible value


var cr = document.getElementById('copyright');
cr.innerHTML = 'Copyright ' + year + ' &copy; Daniel Dreise, Justin Turcotte, Troy Annette, Brandon Harkness';  // Set html contained within html id "copyright"

//var test = document.getElementById('today');
//test.innerHTML = year;
