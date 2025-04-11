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

    $('#order-pjax').on('pjax:complete', function() {
        $('#form-order').submit();
    })

    $('#order-pjax').on('change', '#order-type_pay_id',  function() {
        // if ($('#order-type_pay_id option:selected').text() == "По QR-коду") {
        // if ($('#order-type_pay_id option:selected').val() == "3") {
        if ($(this).val() == "3") {
            $(".alert-pay").removeClass("d-none")
        } else {
            $(".alert-pay").addClass("d-none")
        }
    })
})