$(() => {

    $("#order-check").on('change', function (e) {
        const another = $('.field-order-comment');
        another.toggleClass('d-none');
        if ($(this).prop('checked')) {
            // another.
        }

        const form = $('#order-form')
        // form.data('yiiActiveForm').validate_only = true;
// form.one('afterValidate', afterValidateEvent);
form.yiiActiveForm('validate', true); //run validation
        // .yiiActiveForm('validate');
        // form.yiiActiveForm('validateAttribute', 'profileform-email');
    })
})