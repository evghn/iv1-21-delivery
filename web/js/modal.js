$(() => {
    $('#order-pjax, #block-btn').on('click', '.btn-confirm', function(e) {
        e.preventDefault();
        $('#confirm-modal')
            .find('.btn-delete')
            .attr('href', $(this).attr('href'))
        $('#confirm-modal').modal('show')        
    })
    
    $('#confirm-modal').on('click', '.btn-cancel', function(e) {
        e.preventDefault();
        $('#confirm-modal').modal('hide')
    })


    $('#confirm-modal').on('click', '[data-pjx^="#"]', function(e) {
        e.preventDefault();
        const pjx = $(this).data('pjx')
        $.ajax({
            url: $(this).attr('href'),
            method: 'POST',
            success: function(data) {                
                if (data) {                    
                    $.pjax.reload({container: pjx})
                    $('#confirm-modal').modal('hide')
                }
            }
        })
        return false;
    })
})