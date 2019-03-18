
require('../css/app.scss');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
// const $ = require('jquery');

console.log('Hello Webpack Encore! Edit me in assets/js/app.js');


var $ = require('jquery');

$(document).ready(function() {

    var d = Date(Date.now());

    $('h1.now').append('<h5>' + $('h1.now').html() + d.toString() + '</h5>');
});