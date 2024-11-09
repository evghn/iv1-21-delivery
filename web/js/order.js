$(() => {
    $('.order-form').on('change', '#order-check', function() {
        $('#order-outpost_id option:first').prop('selected', true);        
        if ($(this).prop('checked')) {
            //check
            $('#order-comment').prop('disabled', false);
            $('#order-outpost_id').removeClass('is-invalid');
            $('#order-comment').removeClass('is-valid');
            $('#form-order').yiiActiveForm('add', {"id":"order-comment","name":"comment","container":".field-order-comment","input":"#order-comment","error":".invalid-feedback","validate":function (attribute, value, messages, deferred, $form) {yii.validation.required(value, messages, {"message":"Необходимо заполнить «Comment»."});yii.validation.string(value, messages, {"message":"Значение «Comment» должно быть строкой.","max":255,"tooLong":"Значение «Comment» должно содержать максимум 255 символа.","skipOnEmpty":1});}});            
            $('#form-order').yiiActiveForm('remove','order-outpost_id') // id field
        } else {
            // uncheck
            $('#order-comment').prop('disabled', true);
            $('#order-comment').removeClass('is-invalid');
            $('#order-outpost_id').removeClass('is-valid');
            $('#form-order').yiiActiveForm('remove','order-comment') // id field
            $('#form-order').yiiActiveForm('add', {"id":"order-outpost_id","name":"outpost_id","container":".field-order-outpost_id","input":"#order-outpost_id","error":".invalid-feedback","validate":function (attribute, value, messages, deferred, $form) {yii.validation.required(value, messages, {"message":"Необходимо заполнить «Outpost ID»."});yii.validation.number(value, messages, {"pattern":/^[+-]?\d+$/,"message":"Значение «Outpost ID» должно быть целым числом.","skipOnEmpty":1});}})
        }
    })

    // click on checkbox
    // $('#order-check').on('change', function() {
    //     if ($(this).prop('checked')) {

    //     } else {

    //     }
        
    // })


})