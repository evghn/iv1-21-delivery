$(() => {
    $('.order-form').on('change', '#order-check', () =>
        $.pjax.reload({
            container: '#order-outpost-pjax',
            type: "POST",
            data: $('#form-order').serialize(),            
            push: false,
            replace: false,
            timeout: 5000000
        })
    )


    $('#order-outpost-pjax').on('pjax:complete', () => 
        $('#form-order').submit()
    )
})
