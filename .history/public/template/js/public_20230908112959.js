$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

function loadMoreProducts(event) {
    event.preventDefault();
    const page = $("#page").val();
    $.ajax({
        type: "POST",
        dataType: "JSON",
        data: { page },
        url: "services/load-products",
        success(result) {
            if (result.html) {
                $("#list-products").append(result.html);
                $("#page").val(+page + 1);
                if (!result.canLoadMore) {
                    $("#btn-loadMoreProducts").addClass("d-none");
                }
            }
        },
    });
}

function showModal(product, event) {
    event.preventDefault();
    product = JSON.parse(product);
    // $("#dataProduct-1").attr("data-thumb", product.image);
    // $("#dataProduct-2").attr("src", product.image);
    // $("#dataProduct-3").attr("href", product.image);
    // $("#dataProduct-4").text(product.name);
    // $("#dataProduct-5").text(`${product.price_sale}$`);
    // $("#dataProduct-6").text(product.description);
    // $("#dataProduct-8").attr("value", product.id);
    // $(".js-modal1").addClass("show-modal1");
    const dataFill = document.querySelectorAll(".dataModal");
    console.log(product.description);
    dataFill[0].src = product.image;
    dataFill[1].href = product.image;
    dataFill[2].innerHTML = product.name;
    dataFill[3].innerHTML = product.price_sale
        ? product.price_sale
        : product.price;
    dataFill[4].innerHTML = product.description;
}
