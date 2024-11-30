$(() => {

    $('#admin-order-pjax').on('click', '.btn-cancel-modal', function(e) {
        e.preventDefault();
        $('#form-cancel').attr('action', $(this).attr('href'));
        $('#order-comment_admin').val('');
        $('#cancel-modal').modal('show');        
    })

    $('#form-cancel-pjax').on('click', '.btn-modal-close', (e) => {
        e.preventDefault();
        $('#cancel-modal').modal('hide');      
    })

    $('#form-cancel-pjax').on('pjax:end', () => {
        $('#cancel-modal').modal('hide');
        $.pjax.reload("#admin-order-pjax");
    })

})