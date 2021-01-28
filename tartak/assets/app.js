/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application
import './bootstrap';

var $ = require('jquery');

require('bootstrap');

$(document).ready(function() {
    $('.addToCartModal').on('click', function () {
        let product_id = $(this).attr('data-id');
        let product_name = $(this).attr('data-product_name');
        let product_type = $(this).attr('data-product_type');
        console.log(product_name);
        $('#material').val(product_id);
        $('#product_name').html(product_name+' - '+product_type);
    })
});