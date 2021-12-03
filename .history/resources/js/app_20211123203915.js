require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

$( function ()
{
    console.log('run jquery');
} )
