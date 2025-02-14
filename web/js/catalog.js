const error_modal = (text) => {
  $('#text-error').html(text);
  $('#info-modal').modal('show');
}

const cartItemCount = () => $.pjax.reload("#cart-item-count", {
  url: $("#cart-item-count").data('url'),
  method: 'POST',
  replace: false,
  push: false,
  timeout: 5000
})

$(() => {
  // $('.btn-test').on('click', function(e) {
  //     e.preventDefault();

  //     console.log('btn click!');
  //     console.log($(this).data('id'));

  //     // ver 1 - return false;
  // })



  $("#catalog-pjax").on("click", ".btn-cart-add", function (e) {
    e.preventDefault();
    const a = $(this);

    $.ajax({
      url: a.attr("href"),
      method: 'POST',
      success(data) {
          if (data) {
            if (data.status) {
              $.pjax.reload("#catalog-pjax", {
                push: false,
                timeout: 5000,
              });
            } else {
              error_modal(data.message);
            }
          }
      },
    });
  });


  $("#catalog-pjax").on('pjax:end', () => cartItemCount())


  $("#catalog-pjax").on("click", ".btn-reaction", function (e) {
    e.preventDefault();
    const a = $(this);

    $.ajax({
      url: a.attr("href"),
      success(data) {
          a.find(".count-action").html(data);
      },
    });
  });

  $("#catalog-pjax").on("click", ".btn-favourites", function (e) {
    e.preventDefault();
    const a = $(this);

    // get
    // $.ajax({
    //     url:  a.attr('href'),
    //     success(data) {
    //         a.html(data ? '❤' : '🤍')
    //     }
    // })

    $.ajax({
      url: a.attr("href"),
      type: "POST",
      data: { id: a.data("id") },
      // dataType: dataType
      success(data) {
        a.html(data.status ? "❤" : "🤍");
      },
    });
  });

  $("#productsearch-category_id").on("change", function () {
    const val = $(this).find("option:selected").val();
    const url = `/catalog-ajax/index?ProductSearch[title]=${$(
      "#productsearch-title"
    ).val()}&ProductSearch[category_id]=${val}&_pjax=#catalog-pjax`;
    $.pjax.reload({
      container: "#catalog-pjax",
      url: url,
    });
  });

  // $('#catalog-pjax').on('keyup', '#productsearch-title', function(e) {
  //     if (e.key == 'Enter') {
  //         $('#form-filter').submit()
  //     }
  //     // console.log(e.key, )
  // })

  $("#productsearch-title").on("input", function (e) {
    const url = `/catalog-ajax/index?ProductSearch[title]=${$(
      this
    ).val()}&ProductSearch[category_id]=${$("#productsearch-category_id")
      .find("option:selected")
      .val()}&_pjax=#catalog-pjax`;
    $.pjax.reload({
      container: "#catalog-pjax",
      url: url,
    });
  });
});
