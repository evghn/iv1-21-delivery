$(() => {
    $('#order-pjax').on('change', '#order-check', function() {
        if ($(this).prop('checked')) {
            $('#order-comment').prop('disabled', false);
            $('#order-outpost_id').removeClass('is-invalid');
        } else {
            $('#order-comment').prop('disabled', true);
            $('#order-comment').removeClass('is-invalid');
        }
    })  
    
    // $('#order-pjax').on('change', '#order-check', function() {
        
    //     formData

    //     $.pjax.reload({
    //         container: '#id-container', 
    //         url: 'url',
    //         data: dataForm
    //     })

    // })  
    
    
})