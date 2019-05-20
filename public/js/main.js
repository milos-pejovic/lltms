var form = $('.google-event-register-form');
var inputFields = form.find('input.input-field');

/**
 * Alternative approach to showing errors:
 * Create error messages html within template. Each message is invisible by defualt.
 * In template, use php to check if each message should be displayed (by adding css class tat displays it). This is done in backend.
 * Make the same validaiton rules in JS and use them in frontend. If there is an error, display the same errors that backend displays. 
 */

/**
 * 
 * @param {type} field
 * @param {type} show
 * @return {undefined}
 */
function showError(field, show) {
    var inputField = $('.google-event-register-form input[name="' + field + '"]')
    if (show){
        inputField.css('background-color', '#fcaeae');
    } else {
        inputField.css('background-color', '#fff');
    }
}

/**
 * 
 * @param {type} field
 * @param {type} regExpPattern
 * @return {Boolean}
 */
function validateField(field, regExpPattern) {
    var value = $('input[name="'+field+'"]').val().trim();
    if (value == '' || value.match(regExpPattern) !== null){
        showError(field, true);
        return false;
    } else {
        showError(field, false);
        return true;
    }
}

$('input[name="name"]').on('blur', function() {
    validateField('name', /[^a-zA-Z\s]/gi);
});

$('input[name="email"]').on('blur', function() {
    validateField('email', /[\\w\.]+@[a-zA-Z_]+?\\.[a-zA-Z]{2,3}$/);
});

$('input[name="phone"]').on('blur', function() {
    validateField('phone', /[^0-9\s-/]/gi);
});

// TODO time

$('input[name="time"]').on('blur', function() {
    validateField('time', /[^a-zA-Z\s]/gi);
});

// TODO date

$('input[name="date"]').on('blur', function() {
    validateField('date', /[^a-zA-Z\s]/gi);
});
