/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

$(document).ready(function() {
    let $test = [
        "query01", "query04", "query08",
        "query12", "query13", "query15",
        "query19-1",
        "query19-2",
        "query19-3",
        "query19-4",
        "query19-5",
        "query19-6",
    ];
    $.each( $test, function(i, l){
        initTextByRadio(l);
    });
    $.each( $test, function(i, l){
        toggleTextByRadio(l);
    });
});

function initTextByRadio($test) {
    if ($('input:radio[name^='+$test+']:checked').val() === 'yes') {
        $('input:text[name^='+$test+']').prop('disabled', false);
    } else {
        $('input:text[name^='+$test+']').prop('disabled', true);
        $('input:text[name^='+$test+']').val('');
    }
}


function toggleTextByRadio($test) {
    $('input:radio[name^='+$test+']').change(function() {
        if (this.value === 'yes') {
            $('input:text[name^='+$test+']').prop('disabled', false);
        }
        else if (this.value === 'no') {
            $('input:text[name^='+$test+']').prop('disabled', true);
            $('input:text[name^='+$test+']').val('');
        }
    });
}
