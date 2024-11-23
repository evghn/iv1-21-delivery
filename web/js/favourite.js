$(() => {
    
  
    $("#favourite-pjax").on("click", ".btn-favourites", function (e) {
      e.preventDefault();
      const a = $(this);
      
      $.ajax({
        url: a.attr("href"),
        type: "POST",
        data: { id: a.data("id") },
        success() {
          $.pjax.reload('#favourite-pjax');
        },
      });
      
    });
  
    // $("#productsearch-category_id").on("change", function () {
    //   const val = $(this).find("option:selected").val();
    //   const url = `/catalog-ajax/index?ProductSearch[title]=${$(
    //     "#productsearch-title"
    //   ).val()}&ProductSearch[category_id]=${val}&_pjax=#catalog-pjax`;
    //   $.pjax.reload({
    //     container: "#catalog-pjax",
    //     url: url,
    //   });
    // });

  
    // $("#productsearch-title").on("input", function (e) {
    //   const url = `/catalog-ajax/index?ProductSearch[title]=${$(
    //     this
    //   ).val()}&ProductSearch[category_id]=${$("#productsearch-category_id")
    //     .find("option:selected")
    //     .val()}&_pjax=#catalog-pjax`;
    //   $.pjax.reload({
    //     container: "#catalog-pjax",
    //     url: url,
    //   });
    // });
  });
  