$(() => {
    $('#order-pjax').on('change', '#order-check', function() {
        if ($(this).prop('checked')) {
            
            // $('#order-comment').prop('disabled', false);
            $('#order-comment').parents('.comment-filed').removeClass('d-none');


            $('#order-outpost_id').removeClass('is-invalid');
        } else {
            // $('#order-comment').prop('disabled', true);
            $('#order-comment').parents('.comment-filed').addClass('d-none');

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