$(() => {
    $('#order-pjax').on('change', '#order-check',  function() {
        $.pjax.reload({
            container: "#order-pjax",
            method: "POST",
            data:  $('#form-order').serialize(),
            pushState: false,
            replaceState: false,
            timeout: 5000,
        })
    })    
})